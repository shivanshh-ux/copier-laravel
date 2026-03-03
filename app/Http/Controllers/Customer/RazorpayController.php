<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    private $razorpayId;
    private $razorpayKey;

    public function __construct()
    {
        $this->razorpayId = config('services.razorpay.key');
        $this->razorpayKey = config('services.razorpay.secret');
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::find($request->plan_id);
        $amount = $plan->discounted_price ?? $plan->actual_price;

        if (empty($this->razorpayId) || empty($this->razorpayKey)) {
            return back()->with('error', 'Razorpay is not configured. Please add RAZORPAY_KEY_ID and RAZORPAY_KEY_SECRET to your .env file.');
        }

        try {
            $api = new Api($this->razorpayId, $this->razorpayKey);

            // Create Razorpay Order
            $razorpayOrder = $api->order->create([
                'receipt'         => 'order_rcptid_' . time(),
                'amount'          => $amount * 100, // amount in the smallest currency unit (paise for INR)
                'currency'        => $plan->currency ?? 'INR',
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to connect to Razorpay. Please check your internet connection or API keys.');
        }

        // Create Local Order record
        $order = Order::create([
            'customer_id'       => Auth::guard('customer')->id(),
            'plan_id'           => $plan->id,
            'amount'            => $amount,
            'status'            => 'pending',
            'razorpay_order_id' => $razorpayOrder['id'],
            'notes'             => json_encode(['razorpay_order' => $razorpayOrder->toArray()]) // Store full object for retrieval
        ]);

        return redirect()->route('razorpay.checkout', $order->id);
    }

    public function showCheckout(Order $order)
    {
        // Safety check
        if ($order->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }

        $plan = $order->plan;
        $razorpayOrder = json_decode($order->notes, true)['razorpay_order'] ?? null;

        if (!$razorpayOrder) {
            // Re-create if missing for some reason
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $razorpayOrder = $api->order->create([
                'receipt'         => 'order_rcptid_' . $order->id,
                'amount'          => $order->amount * 100,
                'currency'        => $plan->currency ?? 'INR',
            ]);
            $order->update(['razorpay_order_id' => $razorpayOrder['id'], 'notes' => json_encode(['razorpay_order' => $razorpayOrder->toArray()])]);
        }

        return view('customer.checkout', [
            'order'         => $order,
            'plan'          => $plan,
            'razorpayOrder' => $razorpayOrder,
            'razorpayId'    => $this->razorpayId,
        ]);
    }

    public function handleCallback(Request $request)
    {
        $input = $request->all();

        $api = new Api($this->razorpayId, $this->razorpayKey);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $attributes = [
                    'razorpay_order_id' => $input['razorpay_order_id'],
                    'razorpay_payment_id' => $input['razorpay_payment_id'],
                    'razorpay_signature' => $input['razorpay_signature']
                ];

                $api->utility->verifyPaymentSignature($attributes);

                // Signature is valid, update order
                $order = Order::where('razorpay_order_id', $input['razorpay_order_id'])->first();
                if ($order) {
                    $order->update([
                        'status'              => 'active',
                        'razorpay_payment_id' => $input['razorpay_payment_id'],
                        'razorpay_signature'  => $input['razorpay_signature'],
                    ]);

                    // Optionally update customer plan
                    $customer = Auth::guard('customer')->user();
                    $customer->update(['plan_id' => $order->plan_id]);

                    return redirect()->route('profile')->with('success', 'Payment successful! Your plan is now active.');
                }
            } catch (\Exception $e) {
                Log::error('Razorpay Error: ' . $e->getMessage());
                return redirect()->route('profile')->with('error', 'Payment verification failed.');
            }
        }

        return redirect()->route('profile')->with('error', 'Payment failed.');
    }
}
