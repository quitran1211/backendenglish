<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    // ✅ THÊM METHOD NÀY
    public function premiumStatus(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user_is_premium' => $user->is_premium ?? false,
                'premium_expires_at' => $user->premium_expires_at,
                'has_active_subscription' => $user->activeSubscription ? true : false,
            ],
        ]);
    }

    /**
     * Mua gói subscription (chỉ chuyển khoản ngân hàng)
     */
    public function purchase(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
        ]);

        $user = $request->user();
        $plan = SubscriptionPlan::findOrFail($validated['plan_id']);

        // ⭐ Kiểm tra user đã có premium active chưa
        $existingSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->first();

        if ($existingSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã có gói Premium đang hoạt động',
                'data' => [
                    'current_subscription' => $existingSubscription->load('plan'),
                ],
            ], 400);
        }

        DB::beginTransaction();
        try {
            // ⭐ 1. Tạo Subscription (status: pending)
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status' => 'pending', // Chờ admin xác nhận thanh toán
                'started_at' => now(),
                'expires_at' => now()->addDays($plan->duration_days),
                'payment_method' => 'bank_transfer',
                'amount_paid' => $plan->price,
            ]);

            // ⭐ 2. Tạo Payment Transaction
            $transaction = PaymentTransaction::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'plan_id' => $plan->id,
                'transaction_code' => PaymentTransaction::generateTransactionCode(),
                'amount' => $plan->price,
                'payment_method' => 'bank_transfer',
                'status' => 'pending',
            ]);

            // ⭐ 3. Thông tin chuyển khoản
            $bankInfo = $this->getBankTransferInfo($transaction);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => [
                    'subscription' => $subscription->load('plan'),
                    'transaction' => $transaction,
                    'bank_info' => $bankInfo,
                    'expires_at' => $subscription->expires_at,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hủy subscription
     */
    public function cancel(Request $request, $id)
    {
        $user = $request->user();

        $subscription = Subscription::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($subscription->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Gói đã được hủy trước đó',
            ], 400);
        }

        $subscription->update(['status' => 'cancelled']);

        // Cập nhật user premium status
        $subscription->updateUserPremiumStatus();

        return response()->json([
            'success' => true,
            'message' => 'Đã hủy gói thành công',
            'data' => $subscription,
        ]);
    }

    /**
     * Gia hạn subscription
     */
    public function renew(Request $request, $id)
    {
        $user = $request->user();

        $oldSubscription = Subscription::where('id', $id)
            ->where('user_id', $user->id)
            ->with('plan')
            ->firstOrFail();

        DB::beginTransaction();
        try {
            // Tạo subscription mới
            $newSubscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $oldSubscription->plan_id,
                'status' => 'pending',
                'started_at' => now(),
                'expires_at' => now()->addDays($oldSubscription->plan->duration_days),
                'payment_method' => 'bank_transfer',
                'amount_paid' => $oldSubscription->plan->price,
            ]);

            // Tạo transaction
            $transaction = PaymentTransaction::create([
                'user_id' => $user->id,
                'subscription_id' => $newSubscription->id,
                'plan_id' => $oldSubscription->plan_id,
                'transaction_code' => PaymentTransaction::generateTransactionCode(),
                'amount' => $oldSubscription->plan->price,
                'payment_method' => 'bank_transfer',
                'status' => 'pending',
            ]);

            $bankInfo = $this->getBankTransferInfo($transaction);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn gia hạn thành công',
                'data' => [
                    'subscription' => $newSubscription->load('plan'),
                    'transaction' => $transaction,
                    'bank_info' => $bankInfo,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Lấy thông tin chuyển khoản ngân hàng
     */
    /**
     * Lấy thông tin chuyển khoản ngân hàng
     */
    private function getBankTransferInfo($transaction)
    {
        // ⭐ DEBUG - XÓA SAU KHI TEST XONG
        \Log::info('Bank Config:', [
            'name' => config('bank.name'),
            'code' => config('bank.code'),
            'account_number' => config('bank.account_number'),
            'account_name' => config('bank.account_name'),
        ]);

        return [
            'bank_name' => config('bank.name'),
            'account_number' => config('bank.account_number'),
            'account_name' => config('bank.account_name'),
            'branch' => config('bank.branch'),
            'amount' => $transaction->amount,
            'transfer_content' => $transaction->transaction_code,
            'qr_code' => $this->generateQRCode($transaction),
            'note' => 'Vui lòng chuyển khoản ĐÚNG SỐ TIỀN và NỘI DUNG để được xác nhận nhanh chóng',
        ];
    }

    /**
     * Generate QR Code
     */
    private function generateQRCode($transaction)
    {
        $bankCode = config('bank.code');
        $accountNumber = config('bank.account_number');
        $accountName = config('bank.account_name');
        $amount = $transaction->amount;
        $description = $transaction->transaction_code;

        $qrUrl = "https://img.vietqr.io/image/{$bankCode}-{$accountNumber}-compact2.jpg";
        $qrUrl .= "?amount={$amount}";
        $qrUrl .= '&addInfo='.urlencode($description);
        $qrUrl .= '&accountName='.urlencode($accountName);

        return $qrUrl;
    }
}
