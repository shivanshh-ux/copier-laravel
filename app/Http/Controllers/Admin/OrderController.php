<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'plan']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $plans = Plan::where('is_active', true)->get();
        return view('admin.orders.create', compact('customers', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'plan_id'     => 'nullable|exists:plans,id',
            'amount'      => 'required|numeric|min:0',
            'status'      => 'required|in:pending,active,cancelled,completed',
            'notes'       => 'nullable|string',
        ]);

        Order::create($request->all());
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'plan']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();
        $plans = Plan::where('is_active', true)->get();
        $order->load(['customer', 'plan']);
        return view('admin.orders.edit', compact('order', 'customers', 'plans'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'plan_id'     => 'nullable|exists:plans,id',
            'amount'      => 'required|numeric|min:0',
            'status'      => 'required|in:pending,active,cancelled,completed',
            'notes'       => 'nullable|string',
        ]);

        $order->update($request->only(['customer_id', 'plan_id', 'amount', 'status', 'notes']));
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
}
