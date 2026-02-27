<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Plan;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('plan')->latest()->get();
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('admin.offers.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'plan_id'           => 'nullable|exists:plans,id',
            'actual_price'      => 'required|numeric|min:0',
            'discounted_price'  => 'required|numeric|min:0',
            'valid_until'       => 'nullable|date',
            'is_active'         => 'boolean',
        ]);

        Offer::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'plan_id'          => $request->plan_id,
            'actual_price'     => $request->actual_price,
            'discounted_price' => $request->discounted_price,
            'valid_until'      => $request->valid_until,
            'is_active'        => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully.');
    }

    public function edit(Offer $offer)
    {
        $plans = Plan::where('is_active', true)->get();
        return view('admin.offers.edit', compact('offer', 'plans'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'plan_id'          => 'nullable|exists:plans,id',
            'actual_price'     => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0',
            'valid_until'      => 'nullable|date',
            'is_active'        => 'boolean',
        ]);

        $offer->update([
            'title'            => $request->title,
            'description'      => $request->description,
            'plan_id'          => $request->plan_id,
            'actual_price'     => $request->actual_price,
            'discounted_price' => $request->discounted_price,
            'valid_until'      => $request->valid_until,
            'is_active'        => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully.');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offers.index')->with('success', 'Offer deleted.');
    }
}
