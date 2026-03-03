<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanActivationController extends Controller
{
    public function activate(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::find($request->plan_id);
        $customer = Auth::guard('customer')->user();

        // Update customer's plan
        $customer->update([
            'plan_id' => $plan->id
        ]);

        // Create an 'active' order record for tracking
        Order::create([
            'customer_id' => $customer->id,
            'plan_id'     => $plan->id,
            'amount'      => $plan->discounted_price ?? $plan->actual_price,
            'status'      => 'active',
            'notes'       => 'Plan activated directly (Trial/Direct Activation)'
        ]);

        return redirect()->route('profile')->with('success', 'Plan activated successfully! You are now on the ' . $plan->name . ' plan.');
    }
}
