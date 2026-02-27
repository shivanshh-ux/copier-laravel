<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Offer;
use App\Models\MediaUpload;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'active_customers' => Customer::where('status', 'active')->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_plans' => Plan::count(),
            'active_plans' => Plan::where('is_active', true)->count(),
            'total_offers' => Offer::count(),
            'active_offers' => Offer::where('is_active', true)->count(),
            'total_media' => MediaUpload::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('amount'),
        ];

        $recent_orders = Order::with(['customer', 'plan'])->latest()->take(5)->get();
        $recent_customers = Customer::with('plan')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recent_orders', 'recent_customers'));
    }
}
