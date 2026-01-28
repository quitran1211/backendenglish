<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\Subscription;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // Users (không tính admin)
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'premium_users' => User::where('role', '!=', 'admin')
                ->where('is_premium', true)
                ->count(),
            'free_users' => User::where('role', '!=', 'admin')
                ->where('is_premium', false)
                ->count(),

            // Lessons
            'total_lessons' => Lesson::count(),
            'free_lessons' => Lesson::free()->count(),
            'premium_lessons' => Lesson::premium()->count(),

            // Subscriptions
            'active_subscriptions' => Subscription::active()->count(),
            'expiring_soon' => Subscription::expiringSoon(7)->count(),
            'expired_subscriptions' => Subscription::expired()->count(),

            // Revenue
            'total_revenue' => PaymentTransaction::completed()->sum('amount'),
            'revenue_this_month' => PaymentTransaction::completed()
                ->whereMonth('paid_at', now()->month)
                ->sum('amount'),
            'revenue_last_month' => PaymentTransaction::completed()
                ->whereMonth('paid_at', now()->subMonth()->month)
                ->sum('amount'),
        ];

        // Recent subscriptions
        $recentSubscriptions = Subscription::with(['user', 'plan'])
            ->latest()
            ->take(10)
            ->get();

        // Recent transactions
        $recentTransactions = PaymentTransaction::with(['user', 'plan'])
            ->latest()
            ->take(10)
            ->get();

        // Chart data - Revenue by month (last 12 months)
        $revenueByMonth = PaymentTransaction::completed()
            ->selectRaw('DATE_FORMAT(paid_at, "%Y-%m") as month, SUM(amount) as total')
            ->where('paid_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard.dashboard', compact(
            'stats',
            'recentSubscriptions',
            'recentTransactions',
            'revenueByMonth'
        ));
    }
}
