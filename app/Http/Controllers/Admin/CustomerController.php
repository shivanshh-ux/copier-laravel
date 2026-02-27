<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with('plan');

        // Handle both direct and Tabulator filter formats
        $search = $request->search;
        $status = $request->status;

        if ($request->has('filters')) {
            foreach ($request->filters as $filter) {
                if ($filter['field'] === 'search') $search = $filter['value'];
                if ($filter['field'] === 'status') $status = $filter['value'];
            }
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        if ($status) {
            $query->where('status', $status);
        }

        if ($request->ajax() || $request->wantsJson() || $request->query('json')) {
            $customers = $query->latest()->paginate($request->size ?? 15);
            return response()->json($customers);
        }

        $customers = $query->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Customer::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function create()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('admin.customers.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'plan_id' => 'nullable|exists:plans,id',
            'status'  => 'required|in:active,inactive',
        ]);

        Customer::create($request->all());
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        $plans = Plan::where('is_active', true)->get();
        return view('admin.customers.edit', compact('customer', 'plans'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email,' . $customer->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'plan_id' => 'nullable|exists:plans,id',
            'status'  => 'required|in:active,inactive',
        ]);

        $customer->update($request->only(['name', 'email', 'phone', 'address', 'plan_id', 'status']));
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted.');
    }
}
