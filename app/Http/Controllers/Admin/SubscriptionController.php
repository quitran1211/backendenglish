<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscription::with(['user', 'plan']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by user
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        // Filter by plan
        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }

        // Filter expiring soon
        if ($request->has('expiring_soon')) {
            $query->expiringSoon(7);
        }

        $subscriptions = $query->latest()->paginate(20);

        // Statistics
        $stats = [
            'total_active' => Subscription::active()->count(),
            'expiring_soon' => Subscription::expiringSoon(7)->count(),
            'expired' => Subscription::expired()->count(),
            'total_revenue' => Subscription::where('status', 'active')->sum('amount_paid'),
        ];

        $plans = SubscriptionPlan::active()->get();

        return view('admin.subscriptions.index', compact('subscriptions', 'stats', 'plans'));
    }

    public function create(Request $request)
    {
        $plans = SubscriptionPlan::active()->orderBy('sort_order')->get();
        $users = User::orderBy('username')->get();
        $selectedUserId = $request->get('user_id');

        return view('admin.subscriptions.create', compact('plans', 'users', 'selectedUserId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:subscription_plans,id',
            'payment_method' => 'nullable|string|max:50',
            'amount_paid' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $plan = SubscriptionPlan::findOrFail($validated['plan_id']);
        $expiresAt = Carbon::now()->addDays($plan->duration_days);

        $subscription = Subscription::create([
            'user_id' => $validated['user_id'],
            'plan_id' => $validated['plan_id'],
            'status' => 'active',
            'started_at' => now(),
            'expires_at' => $expiresAt,
            'payment_method' => $validated['payment_method'] ?? 'admin_grant',
            'amount_paid' => $validated['amount_paid'] ?? 0,
            'notes' => $validated['notes'],
        ]);

        // Update user premium status
        $subscription->updateUserPremiumStatus();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Đăng ký đã được tạo thành công!');
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'plan', 'transactions']);

        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        $plans = SubscriptionPlan::active()->orderBy('sort_order')->get();

        return view('admin.subscriptions.edit', compact('subscription', 'plans'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'expires_at' => 'nullable|date',
            'status' => 'required|in:active,expired,cancelled',
            'notes' => 'nullable|string',
        ]);

        $subscription->update($validated);
        $subscription->updateUserPremiumStatus();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Đăng ký đã được cập nhật!');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Đăng ký đã được chuyển vào thùng rác!');
    }

    public function trash()
    {
        $subscriptions = Subscription::onlyTrashed()
            ->with(['user', 'plan'])
            ->latest('deleted_at')
            ->paginate(20);

        return view('admin.subscriptions.trash', compact('subscriptions'));
    }

    public function restore($id)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->restore();
        $subscription->updateUserPremiumStatus();

        return redirect()->route('subscriptions.trash')
            ->with('success', 'Đăng ký đã được khôi phục!');
    }

    public function forceDelete($id)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->forceDelete();

        return redirect()->route('subscriptions.trash')
            ->with('success', 'Đăng ký đã được xóa vĩnh viễn!');
    }

    public function cancel(Subscription $subscription)
    {
        $subscription->update(['status' => 'cancelled']);
        $subscription->updateUserPremiumStatus();

        return back()->with('success', 'Đăng ký đã bị hủy!');
    }

    public function extend(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'additional_days' => 'required|integer|min:1|max:365',
        ]);

        if ($subscription->expires_at && $subscription->expires_at->isFuture()) {
            $newExpiresAt = $subscription->expires_at->addDays($validated['additional_days']);
        } else {
            $newExpiresAt = Carbon::now()->addDays($validated['additional_days']);
        }

        $subscription->update([
            'expires_at' => $newExpiresAt,
            'status' => 'active',
        ]);

        $subscription->updateUserPremiumStatus();

        return back()->with('success', "Đã gia hạn thêm {$validated['additional_days']} ngày!");
    }

    public function checkExpired()
    {
        $expired = Subscription::where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($expired as $subscription) {
            $subscription->update(['status' => 'expired']);
            $subscription->updateUserPremiumStatus();
        }

        return back()->with('success', "Đã cập nhật {$expired->count()} đăng ký hết hạn!");
    }

    public function expiringSoon()
    {
        $subscriptions = Subscription::expiringSoon(7)
            ->with(['user', 'plan'])
            ->get();

        return view('admin.subscriptions.expiring-soon', compact('subscriptions'));
    }

    public function revenueReport()
    {
        // Revenue by month
        $revenueByMonth = Subscription::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount_paid) as total')
            ->where('status', 'active')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        // Revenue by plan
        $revenueByPlan = Subscription::selectRaw('plan_id, SUM(amount_paid) as total, COUNT(*) as count')
            ->where('status', 'active')
            ->with('plan')
            ->groupBy('plan_id')
            ->get();

        return view('admin.subscriptions.revenue-report', compact('revenueByMonth', 'revenueByPlan'));
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:cancel,delete,restore',
            'ids' => 'required|array',
            'ids.*' => 'exists:subscriptions,id',
        ]);

        $count = 0;

        switch ($validated['action']) {
            case 'cancel':
                $subscriptions = Subscription::whereIn('id', $validated['ids'])->get();
                foreach ($subscriptions as $subscription) {
                    $subscription->update(['status' => 'cancelled']);
                    $subscription->updateUserPremiumStatus();
                    $count++;
                }
                $message = "Đã hủy {$count} đăng ký!";
                break;

            case 'delete':
                Subscription::whereIn('id', $validated['ids'])->delete();
                $count = count($validated['ids']);
                $message = "Đã xóa {$count} đăng ký!";
                break;

            case 'restore':
                $subscriptions = Subscription::onlyTrashed()->whereIn('id', $validated['ids'])->get();
                foreach ($subscriptions as $subscription) {
                    $subscription->restore();
                    $subscription->updateUserPremiumStatus();
                    $count++;
                }
                $message = "Đã khôi phục {$count} đăng ký!";
                break;
        }

        return back()->with('success', $message);
    }

    public function export(Request $request)
    {
        // Export to CSV
        $subscriptions = Subscription::with(['user', 'plan'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->get();

        $filename = 'subscriptions_'.date('YmdHis').'.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $output = fopen('php://output', 'w');

        // Header
        fputcsv($output, ['ID', 'User', 'Email', 'Plan', 'Status', 'Started At', 'Expires At', 'Amount Paid']);

        // Data
        foreach ($subscriptions as $sub) {
            fputcsv($output, [
                $sub->id,
                $sub->user->name,
                $sub->user->email,
                $sub->plan->name ?? 'N/A',
                $sub->status,
                $sub->started_at?->format('Y-m-d'),
                $sub->expires_at?->format('Y-m-d'),
                $sub->amount_paid,
            ]);
        }

        fclose($output);
        exit;
    }
}
