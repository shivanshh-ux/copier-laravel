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

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $customers = $query->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
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
