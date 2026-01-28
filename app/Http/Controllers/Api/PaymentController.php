<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_method' => 'required|in:vnpay,momo,bank_transfer',
        ]);

        $user = $request->user();

        $transaction = PaymentTransaction::create([
            'user_id' => $user->id,
            'subscription_id' => $validated['subscription_id'],
            'transaction_code' => PaymentTransaction::generateTransactionCode(),
            'amount' => 0, // Will be updated later
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tạo giao dịch thành công',
            'data' => [
                'transaction' => $transaction,
                'payment_url' => $this->generatePaymentUrl($transaction),
            ],
        ]);
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'transaction_code' => 'required|string',
            'status' => 'required|in:completed,failed',
            'payment_gateway_transaction_id' => 'nullable|string',
        ]);

        $transaction = PaymentTransaction::where('transaction_code', $validated['transaction_code'])
            ->firstOrFail();

        $transaction->update([
            'status' => $validated['status'],
            'payment_gateway_transaction_id' => $validated['payment_gateway_transaction_id'] ?? null,
            'paid_at' => $validated['status'] === 'completed' ? now() : null,
        ]);

        // Update subscription if completed
        if ($validated['status'] === 'completed' && $transaction->subscription) {
            $transaction->subscription->update(['status' => 'active']);
            $transaction->subscription->updateUserPremiumStatus();
        }

        return response()->json([
            'success' => true,
            'message' => 'Xác thực giao dịch thành công',
            'data' => $transaction,
        ]);
    }

    /**
     * Lịch sử giao dịch
     */
    public function history(Request $request)
    {
        $user = $request->user();

        $transactions = PaymentTransaction::where('user_id', $user->id)
            ->with(['subscription.plan'])
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $transactions,
        ]);
    }

    /**
     * Kiểm tra trạng thái giao dịch
     */
    public function checkStatus($transactionCode)
    {
        $transaction = PaymentTransaction::where('transaction_code', $transactionCode)
            ->with(['subscription.plan'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'transaction_code' => $transaction->transaction_code,
                'status' => $transaction->status,
                'amount' => $transaction->amount,
                'payment_method' => $transaction->payment_method,
                'paid_at' => $transaction->paid_at,
                'subscription' => $transaction->subscription,
            ],
        ]);
    }

    /**
     * Upload chứng từ chuyển khoản
     */
    // app/Http/Controllers/Api/SubscriptionController.php hoặc PaymentController.php

    /**
     * Upload chứng từ thanh toán
     */
    public function uploadProof(Request $request, $transactionCode)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
        ]);

        $transaction = PaymentTransaction::where('transaction_code', $transactionCode)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        if ($transaction->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Giao dịch đã được xác nhận, không cần upload chứng từ',
            ], 400);
        }

        // Upload file
        if ($request->hasFile('proof_image')) {
            // Xóa ảnh cũ nếu có
            if ($transaction->proof_image && \Storage::exists('public/'.$transaction->proof_image)) {
                \Storage::delete('public/'.$transaction->proof_image);
            }

            // Lưu ảnh mới
            $path = $request->file('proof_image')->store('payment-proofs', 'public');
            $transaction->update([
                'proof_image' => $path,
                'proof_uploaded_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Upload chứng từ thành công',
            'data' => [
                'proof_image_url' => \Storage::url($transaction->proof_image),
                'uploaded_at' => $transaction->proof_uploaded_at,
            ],
        ]);
    }
}
