<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::withCount(['customers', 'orders'])->latest()->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'actual_price'      => 'required|numeric|min:0',
            'discounted_price'  => 'nullable|numeric|min:0|lt:actual_price',
            'duration_days'     => 'required|integer|min:1',
            'is_active'         => 'boolean',
        ]);

        $description = $request->description;
        if ($description) {
            $description = str_replace(['<br>', '<br/>', '<br />'], "\n", $description);
            $description = strip_tags($description);
        }

        Plan::create([
            'name'             => $request->name,
            'description'      => $description,
            'actual_price'     => $request->actual_price,
            'discounted_price' => $request->discounted_price,
            'duration_days'    => $request->duration_days,
            'is_active'        => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'actual_price'     => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'duration_days'    => 'required|integer|min:1',
            'is_active'        => 'boolean',
        ]);

        $description = $request->description;
        if ($description) {
            $description = str_replace(['<br>', '<br/>', '<br />'], "\n", $description);
            $description = strip_tags($description);
        }

        $plan->update([
            'name'             => $request->name,
            'description'      => $description,
            'actual_price'     => $request->actual_price,
            'discounted_price' => $request->discounted_price ?: null,
            'duration_days'    => $request->duration_days,
            'is_active'        => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Plan::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
