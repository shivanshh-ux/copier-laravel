<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        
        // Check if user has an active/completed plan
        $hasActivePlan = Order::where('customer_id', $customer->id)
            ->whereIn('status', ['active', 'completed'])
            ->exists();

        // Load master account and slaves if plan is active
        $masterAccount = null;
        if ($hasActivePlan) {
            $masterAccount = $customer->masterAccount()->with('slaveAccounts')->first();
        }

        return view('customer.profile', compact('customer', 'hasActivePlan', 'masterAccount'));
    }
}
