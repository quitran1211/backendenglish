<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::withCount('subscriptions')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.subscription-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.subscription-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        SubscriptionPlan::create($validated);

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Gói đăng ký đã được tạo thành công!');
    }

    public function show(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->loadCount(['subscriptions' => function ($q) {
            $q->where('status', 'active');
        }]);

        $subscriptions = $subscriptionPlan->subscriptions()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.subscription-plans.show', compact('subscriptionPlan', 'subscriptions'));
    }

    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('admin.subscription-plans.edit', compact('subscriptionPlan'));
    }

    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $subscriptionPlan->update($validated);

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Gói đăng ký đã được cập nhật!');
    }

    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        // Soft delete
        if ($subscriptionPlan->subscriptions()->where('status', 'active')->exists()) {
            return back()->with('error', 'Không thể xóa gói này vì đang có người dùng đăng ký!');
        }

        $subscriptionPlan->delete();

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Gói đăng ký đã được chuyển vào thùng rác!');
    }

    public function trash()
    {
        $plans = SubscriptionPlan::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(20);

        return view('admin.subscription-plans.trash', compact('plans'));
    }

    public function restore($id)
    {
        $plan = SubscriptionPlan::onlyTrashed()->findOrFail($id);
        $plan->restore();

        return redirect()->route('subscription-plans.trash')
            ->with('success', 'Gói đăng ký đã được khôi phục!');
    }

    public function forceDelete($id)
    {
        $plan = SubscriptionPlan::onlyTrashed()->findOrFail($id);

        if ($plan->subscriptions()->exists()) {
            return back()->with('error', 'Không thể xóa vĩnh viễn vì còn dữ liệu liên quan!');
        }

        $plan->forceDelete();

        return redirect()->route('subscription-plans.trash')
            ->with('success', 'Gói đăng ký đã được xóa vĩnh viễn!');
    }

    public function toggleActive(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->update([
            'is_active' => ! $subscriptionPlan->is_active,
        ]);

        $status = $subscriptionPlan->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return back()->with('success', "Gói đăng ký đã được {$status}!");
    }
}
