<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicReviewController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'rating'  => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $data = $request->only(['name', 'role', 'rating', 'content']);
        $data['is_active'] = false; // Admin must approve

        if ($request->hasFile('avatar')) {
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('uploads/reviews'), $imageName);
            $data['avatar'] = 'uploads/reviews/'.$imageName;
        }

        Review::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully! It will appear once approved by admin.'
        ]);
    }
}
