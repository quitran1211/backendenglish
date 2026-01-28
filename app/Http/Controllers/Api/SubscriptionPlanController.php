<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::active()
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $plans->map(function ($plan) {
                return [
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'description' => $plan->description,
                    'duration_days' => $plan->duration_days,
                    'duration_text' => $plan->duration_text,
                    'price' => $plan->price,
                    'formatted_price' => $plan->formatted_price,
                    'is_active' => $plan->is_active,
                ];
            }),
        ]);
    }

    public function show($id)
    {
        $plan = SubscriptionPlan::active()->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $plan->id,
                'name' => $plan->name,
                'description' => $plan->description,
                'duration_days' => $plan->duration_days,
                'duration_text' => $plan->duration_text,
                'price' => $plan->price,
                'formatted_price' => $plan->formatted_price,
                'features' => [
                    'unlimited_premium_lessons' => true,
                    'no_ads' => true,
                    'download_materials' => true,
                    'priority_support' => true,
                ],
            ],
        ]);
    }
}
