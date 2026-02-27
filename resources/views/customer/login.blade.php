@extends('customer.layouts.app')

@section('title', 'Login — Copier Algo Trading')
@section('description', 'Log in to your Copier account to manage your algorithmic trading strategies and portfolio.')

@section('hide-header', true)
@section('hide-footer', true)

@section('content')

<main class="min-h-screen flex items-center justify-center relative overflow-hidden py-20" style="background: transparent">
    <!-- Background Decor -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px); background-size: 80px 80px;"></div>
    <div class="absolute top-1/4 -left-20 w-96 h-96 rounded-full opacity-10 pointer-events-none" style="background: #1E5FAD; filter: blur(120px);"></div>
    <div class="absolute bottom-1/4 -right-20 w-96 h-96 rounded-full opacity-10 pointer-events-none" style="background: #00D4FF; filter: blur(120px);"></div>

    <div class="relative w-full max-w-md px-4" data-aos="fade-up">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center relative overflow-hidden transition-transform duration-300 group-hover:scale-110" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF)">
                    <i data-lucide="trending-up" class="text-white" style="width:24px; height:24px; stroke-width: 2.5;"></i>
                </div>
                <span class="text-3xl tracking-widest uppercase" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; background: linear-gradient(90deg, #ffffff, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Copier</span>
            </a>
        </div>

        <!-- Login Card -->
        <div class="p-8 rounded-3xl relative overflow-hidden" style="background: rgba(15,30,53,0.6); border: 1px solid rgba(0,212,255,0.15); backdrop-filter: blur(20px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
            <div class="absolute inset-0 opacity-5 pointer-events-none" style="background: linear-gradient(135deg, #00D4FF 0%, transparent 100%);"></div>
            
            <h2 class="text-2xl mb-2" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; color: #fff;">Welcome Back</h2>
            <p class="text-sm opacity-50 mb-8" style="color: #E2E8F0;">Enter your credentials to access your dashboard.</p>

            <form action="#" method="POST" class="space-y-5" onsubmit="event.preventDefault(); window.location.href='{{ route('profile') }}';">
                @csrf
                <div>
                    <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 opacity-30" style="width:18px; height:18px; color: #E2E8F0;"></i>
                        <input type="email" placeholder="name@company.com" required 
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                               style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs uppercase tracking-widest opacity-60" style="color: #00D4FF; font-weight: 600;">Password</label>
                        <a href="#" class="text-[10px] uppercase tracking-widest hover:text-[#00D4FF] transition-colors" style="color: rgba(0,212,255,0.5); font-weight: 700;">Forgot?</a>
                    </div>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 opacity-30" style="width:18px; height:18px; color: #E2E8F0;"></i>
                        <input type="password" placeholder="••••••••" required 
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                               style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-2">
                    <input type="checkbox" id="remember" class="w-4 h-4 rounded border-none bg-black/40 text-[#00D4FF] focus:ring-0">
                    <label for="remember" class="text-xs opacity-60" style="color: #E2E8F0;">Remember me for 30 days</label>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl text-sm flex items-center justify-center gap-2 group transition-all duration-300 hover:shadow-[0_0_30px_rgba(0,212,255,0.3)] hover:-translate-y-0.5" 
                        style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; font-weight: 700; margin-top: 1.5rem;">
                    Sign In to Dashboard
                    <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform duration-300" style="width:18px; height:18px;"></i>
                </button>
            </form>

            <div class="mt-8 pt-8 text-center" style="border-top: 1px solid rgba(255,255,255,0.08)">
                <p class="text-xs opacity-50" style="color: #E2E8F0;">Don't have an account? 
                    <a href="{{ route('signup') }}" class="text-[#00D4FF] font-semibold hover:underline">Sign up</a>
                </p>
            </div>
        </div>
        
        <p class="text-center text-[10px] mt-8 opacity-30 uppercase tracking-[0.2em]" style="color: #E2E8F0;">© 2026 Copier Algo Trading. Secure Institutional Access.</p>
    </div>
</main>

@endsection

@push('scripts')
@endpush

