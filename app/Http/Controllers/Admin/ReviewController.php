<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'nullable|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('uploads/reviews'), $imageName);
            $data['avatar'] = 'uploads/reviews/'.$imageName;
        }

        Review::create($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'nullable|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($review->avatar && file_exists(public_path($review->avatar))) {
                unlink(public_path($review->avatar));
            }
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('uploads/reviews'), $imageName);
            $data['avatar'] = 'uploads/reviews/'.$imageName;
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        if ($review->avatar && file_exists(public_path($review->avatar))) {
            unlink(public_path($review->avatar));
        }
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            $reviews = Review::whereIn('id', $ids)->get();
            foreach ($reviews as $review) {
                if ($review->avatar && file_exists(public_path($review->avatar))) {
                    unlink(public_path($review->avatar));
                }
                $review->delete();
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
