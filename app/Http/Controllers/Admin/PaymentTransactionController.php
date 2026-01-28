<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class PaymentTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentTransaction::with(['user', 'subscription', 'plan']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Search by transaction code
        if ($request->filled('search')) {
            $query->where('transaction_code', 'like', '%'.$request->search.'%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('email', 'like', '%'.$request->search.'%');
                });
        }

        // Date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->paginate(20);

        // Statistics
        $stats = [
            'total_completed' => PaymentTransaction::completed()->count(),
            'total_pending' => PaymentTransaction::pending()->count(),
            'total_failed' => PaymentTransaction::failed()->count(),
            'total_revenue' => PaymentTransaction::completed()->sum('amount'),
            'revenue_today' => PaymentTransaction::completed()
                ->whereDate('paid_at', today())
                ->sum('amount'),
            'revenue_this_month' => PaymentTransaction::completed()
                ->whereMonth('paid_at', now()->month)
                ->sum('amount'),
        ];

        return view('admin.transactions.index', compact('transactions', 'stats'));
    }

    public function show(PaymentTransaction $transaction)
    {
        $transaction->load(['user', 'subscription', 'plan']);

        return view('admin.transactions.show', compact('transaction'));
    }

    public function destroy(PaymentTransaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Giao dịch đã được xóa!');
    }

    public function trash()
    {
        $transactions = PaymentTransaction::onlyTrashed()
            ->with(['user', 'subscription', 'plan'])
            ->latest('deleted_at')
            ->paginate(20);

        return view('admin.transactions.trash', compact('transactions'));
    }

    public function restore($id)
    {
        $transaction = PaymentTransaction::onlyTrashed()->findOrFail($id);
        $transaction->restore();

        return redirect()->route('transactions.trash')
            ->with('success', 'Giao dịch đã được khôi phục!');
    }

    public function forceDelete($id)
    {
        $transaction = PaymentTransaction::onlyTrashed()->findOrFail($id);
        $transaction->forceDelete();

        return redirect()->route('transactions.trash')
            ->with('success', 'Giao dịch đã được xóa vĩnh viễn!');
    }

    public function updateStatus(Request $request, PaymentTransaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $transaction->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'completed' ? now() : $transaction->paid_at,
        ]);

        // Update subscription if completed
        if ($validated['status'] === 'completed' && $transaction->subscription) {
            $transaction->subscription->update(['status' => 'active']);
            $transaction->subscription->updateUserPremiumStatus();
        }

        return back()->with('success', 'Trạng thái giao dịch đã được cập nhật!');
    }

    public function refund(Request $request, PaymentTransaction $transaction)
    {
        if ($transaction->status !== 'completed') {
            return back()->with('error', 'Chỉ có thể hoàn tiền giao dịch đã hoàn thành!');
        }

        $transaction->update(['status' => 'refunded']);

        // Cancel subscription nếu có
        if ($transaction->subscription) {
            $transaction->subscription->update(['status' => 'cancelled']);
            $transaction->subscription->updateUserPremiumStatus();
        }

        return back()->with('success', 'Đã hoàn tiền giao dịch!');
    }

    public function stats()
    {
        $stats = [
            'total_revenue' => PaymentTransaction::completed()->sum('amount'),
            'total_transactions' => PaymentTransaction::count(),
            'avg_transaction' => PaymentTransaction::completed()->avg('amount'),

            'by_status' => PaymentTransaction::selectRaw('status, COUNT(*) as count, SUM(amount) as total')
                ->groupBy('status')
                ->get(),

            'by_method' => PaymentTransaction::selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
                ->where('status', 'completed')
                ->groupBy('payment_method')
                ->get(),
        ];

        return view('admin.transactions.stats', compact('stats'));
    }

    public function revenueByMonth()
    {
        $revenue = PaymentTransaction::selectRaw('DATE_FORMAT(paid_at, "%Y-%m") as month, SUM(amount) as total, COUNT(*) as count')
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('admin.transactions.revenue-by-month', compact('revenue'));
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,complete,fail',
            'ids' => 'required|array',
            'ids.*' => 'exists:payment_transactions,id',
        ]);

        $count = 0;

        switch ($validated['action']) {
            case 'delete':
                PaymentTransaction::whereIn('id', $validated['ids'])->delete();
                $count = count($validated['ids']);
                $message = "Đã xóa {$count} giao dịch!";
                break;

            case 'complete':
                PaymentTransaction::whereIn('id', $validated['ids'])
                    ->update(['status' => 'completed', 'paid_at' => now()]);
                $count = count($validated['ids']);
                $message = "Đã đánh dấu {$count} giao dịch hoàn thành!";
                break;

            case 'fail':
                PaymentTransaction::whereIn('id', $validated['ids'])
                    ->update(['status' => 'failed']);
                $count = count($validated['ids']);
                $message = "Đã đánh dấu {$count} giao dịch thất bại!";
                break;
        }

        return back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $transactions = PaymentTransaction::with(['user', 'plan'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->get();

        $filename = 'transactions_'.date('YmdHis').'.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'Transaction Code', 'User', 'Email', 'Amount', 'Payment Method', 'Status', 'Paid At']);

        foreach ($transactions as $txn) {
            fputcsv($output, [
                $txn->id,
                $txn->transaction_code,
                $txn->user->name,
                $txn->user->email,
                $txn->amount,
                $txn->payment_method,
                $txn->status,
                $txn->paid_at?->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Xác nhận thanh toán (approve)
     */
    public function approve(PaymentTransaction $transaction)
    {
        if ($transaction->status === 'completed') {
            return redirect()->back()->with('error', 'Giao dịch đã được xác nhận trước đó');
        }

        if (! $transaction->proof_image) {
            return redirect()->back()->with('error', 'Giao dịch chưa có chứng từ');
        }

        // Cập nhật trạng thái
        $transaction->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        // Kích hoạt subscription
        if ($transaction->subscription) {
            $transaction->subscription->update(['status' => 'active']);
            $transaction->subscription->updateUserPremiumStatus();
        }

        return redirect()->back()->with('success', 'Đã xác nhận thanh toán thành công');
    }

    /**
     * Từ chối thanh toán (reject)
     */
    public function reject(PaymentTransaction $transaction)
    {
        if ($transaction->status === 'completed') {
            return redirect()->back()->with('error', 'Không thể từ chối giao dịch đã hoàn thành');
        }

        // Cập nhật trạng thái
        $transaction->update([
            'status' => 'failed',
        ]);

        // Hủy subscription nếu có
        if ($transaction->subscription) {
            $transaction->subscription->update(['status' => 'cancelled']);
        }

        return redirect()->back()->with('success', 'Đã từ chối giao dịch');
    }

    /**
     * Xóa ảnh chứng từ
     */
    public function deleteProof(PaymentTransaction $transaction)
    {
        if ($transaction->proof_image) {
            // Xóa file
            if (Storage::exists('public/'.$transaction->proof_image)) {
                Storage::delete('public/'.$transaction->proof_image);
            }

            // Cập nhật database
            $transaction->update([
                'proof_image' => null,
                'proof_uploaded_at' => null,
            ]);

            return redirect()->back()->with('success', 'Đã xóa chứng từ');
        }

        return redirect()->back()->with('error', 'Không tìm thấy chứng từ');
    }
    // app/Http/Controllers/Admin/PaymentTransactionController.php

    public function showProofImage($id)
    {
        $transaction = PaymentTransaction::findOrFail($id);

        if (! $transaction->proof_image) {
            abort(404, 'Không tìm thấy chứng từ');
        }

        $path = storage_path('app/public/'.$transaction->proof_image);

        if (! file_exists($path)) {
            abort(404, 'File không tồn tại');
        }

        return response()->file($path);
    }
}
