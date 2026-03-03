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

        // Handle both direct and Tabulator filter formats
        $status = $request->status;
        $search = $request->search;

        if ($request->has('filters')) {
            foreach ($request->filters as $filter) {
                if ($filter['field'] === 'status') $status = $filter['value'];
                if ($filter['field'] === 'search') $search = $filter['value'];
            }
        }

        if ($status) {
            $query->where('status', $status);
        }
        if ($search) {
            $query->whereHas('customer', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->ajax() || $request->wantsJson() || $request->query('json')) {
            $orders = $query->latest()->paginate($request->size ?? 15);
            return response()->json($orders);
        }

        $orders = $query->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Order::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
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

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
