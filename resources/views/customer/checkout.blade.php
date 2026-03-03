@extends('customer.layouts.app')

@section('title', 'Secure Checkout — Copier Algo Trading')
@section('description', 'Complete your purchase to activate your professional trading algorithm.')

@section('hide-header', true)
@section('hide-footer', true)

@push('styles')
<style>
    .grid-bg {
        background-image: linear-gradient(rgba(0,212,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,0.03) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    .checkout-card {
        background: rgba(10, 22, 45, 0.7);
        border: 1px solid rgba(0, 212, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 2rem;
    }
    .price-num {
        font-family: 'Rajdhani', sans-serif;
        font-weight: 700;
        color: #00D4FF;
    }
    @media (max-width: 640px) {
        .checkout-card { padding: 1.5rem !important; border-radius: 1.5rem; }
        .checkout-card h2 { font-size: 1.75rem !important; }
        .price-num { font-size: 1.5rem !important; }
    }
</style>
@endpush

@section('content')
<main class="min-h-screen flex items-center justify-center relative overflow-hidden py-12 px-4" style="background: transparent">
    <!-- Background Decor -->
    <div class="absolute inset-0 grid-bg opacity-40 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full opacity-[0.05] pointer-events-none" style="background: radial-gradient(circle, #1E5FAD 0%, transparent 70%);"></div>

    <div class="relative w-full max-w-2xl" data-aos="zoom-in">
        <div class="checkout-card p-8 sm:p-12 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-[#1E5FAD] to-[#00D4FF]">
                        <i data-lucide="shield-check" class="text-white" style="width:20px; height:20px;"></i>
                    </div>
                    <span class="text-2xl tracking-widest uppercase text-white font-bold" style="font-family: 'Rajdhani', sans-serif;">Secure Checkout</span>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2" style="font-family: 'Rajdhani', sans-serif;">Final Step: Activate Your Plan</h2>
                <p class="text-white/50 text-sm">Please review your order details below to complete the activation.</p>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6 mb-10">
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xs uppercase tracking-widest text-[#00D4FF] font-bold">Selected Plan</span>
                        <span class="text-xs uppercase tracking-widest text-white/40 font-bold">Subtotal</span>
                    </div>
                    <div class="flex justify-between items-end">
                        <div class="min-w-0">
                            <h3 class="text-xl font-bold text-white mb-1" style="font-family: 'Rajdhani', sans-serif;">{{ $plan->name }}</h3>
                            <p class="text-xs text-white/40">{{ $plan->duration_days }} Days Protection • Active Connection</p>
                        </div>
                        <div class="text-right">
                            <span class="price-num text-2xl">
                                {{ $plan->currency == 'INR' ? '₹' : '$' }}{{ number_format($order->amount, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center px-4">
                    <span class="text-white/60 font-semibold">Total Amount Payable</span>
                    <span class="text-white text-2xl font-bold" style="font-family: 'Rajdhani', sans-serif;">
                        {{ $plan->currency == 'INR' ? '₹' : '$' }}{{ number_format($order->amount, 2) }}
                    </span>
                </div>
            </div>

            <!-- Razorpay Button -->
            <button id="rzp-button1" class="w-full py-4 rounded-xl text-lg flex items-center justify-center gap-3 group transition-all duration-300 hover:shadow-[0_0_40px_rgba(0,212,255,0.4)] hover:-translate-y-1" 
                    style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; font-weight: 700;">
                <i data-lucide="credit-card" style="width:20px; height:20px;"></i>
                <span>Pay Securely with Razorpay</span>
            </button>

            <!-- Back link -->
            <div class="mt-8 text-center">
                <a href="{{ route('services') }}" class="text-xs text-white/30 hover:text-[#00D4FF] transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" style="width:12px; height:12px;"></i>
                    Cancel & Return to Plans
                </a>
            </div>

            <!-- Security Badges -->
            <div class="mt-10 pt-8 border-t border-white/5 flex flex-wrap justify-center gap-6 opacity-40">
                <div class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-white">
                    <i data-lucide="lock" class="w-3 h-3 text-[#00D4FF]"></i>
                    SSL Encrypted
                </div>
                <div class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-white">
                    <i data-lucide="shield-check" class="w-3 h-3 text-[#00D4FF]"></i>
                    PCI-DSS Compliant
                </div>
                <div class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-white">
                    <i data-lucide="award" class="w-3 h-3 text-[#00D4FF]"></i>
                    Secure Gateway
                </div>
            </div>
        </div>
    </div>
</main>

<form id="razorpay-form" action="{{ route('razorpay.callback') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    const options = {
        "key": "{{ $razorpayId }}",
        "amount": "{{ $razorpayOrder['amount'] }}",
        "currency": "{{ $razorpayOrder['currency'] }}",
        "name": "Copier Algo Trading",
        "description": "Payment for {{ $plan->name }}",
        "order_id": "{{ $razorpayOrder['id'] }}",
        "handler": function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpay-form').submit();
        },
        "prefill": {
            "name": "{{ Auth::guard('customer')->user()->name }}",
            "email": "{{ Auth::guard('customer')->user()->email }}",
            "contact": "{{ Auth::guard('customer')->user()->phone }}"
        },
        "theme": {
            "color": "#1E5FAD"
        }
    };
    const rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function (e) {
        rzp1.open();
        e.preventDefault();
    }
</script>
@endsection
