<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $plans = Plan::with('offers')->where('is_active', true)->get();
        return view('customer.services', compact('plans'));
    }
}
