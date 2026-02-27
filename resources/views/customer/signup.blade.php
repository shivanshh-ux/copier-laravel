@extends('customer.layouts.app')

@section('title', 'Sign Up — Copier Algo Trading')
@section('description', 'Create your Copier account to start automating your trading with professional algorithmic strategies.')

@section('hide-header', true)
@section('hide-footer', true)

@push('styles')
@endpush

@section('content')

<main class="min-h-screen flex items-center justify-center relative overflow-hidden py-20" style="background: transparent">
    <!-- Background Decor -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px); background-size: 80px 80px;"></div>
    <div class="absolute top-1/4 -right-20 w-96 h-96 rounded-full opacity-10 pointer-events-none" style="background: #1E5FAD; filter: blur(120px);"></div>
    <div class="absolute bottom-1/4 -left-20 w-96 h-96 rounded-full opacity-10 pointer-events-none" style="background: #00D4FF; filter: blur(120px);"></div>

    <div class="relative w-full max-w-xl px-4" data-aos="fade-up">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 rounded-3xl overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.6)]" style="background: rgba(15,30,53,0.6); border: 1px solid rgba(0,212,255,0.15); backdrop-filter: blur(20px);">
            <!-- Left Info Panel (Hidden on small) -->
            <div class="hidden lg:flex lg:col-span-2 p-8 flex-col justify-between relative overflow-hidden" style="background: linear-gradient(225deg, #1E5FAD 0%, #060D1A 100%);">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('https://images.unsplash.com/photo-1611974714014-4b50d1bb204c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080'); background-size: cover; mix-blend-mode: overlay;"></div>
                
                <div class="relative z-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-12">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: #fff; color: #1E5FAD;">
                            <i data-lucide="trending-up" style="width:16px; height:16px; stroke-width: 3;"></i>
                        </div>
                        <span class="text-xl tracking-widest uppercase text-white font-bold" style="font-family: 'Rajdhani', sans-serif;">Copier</span>
                    </a>
                    
                    <h2 class="text-3xl mb-6" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; color: #fff; line-height: 1.1;">Join the Future of Trading</h2>
                    
                    <ul class="space-y-4">
                        @foreach (['Institutional Precision', '24/7 Automation', 'Secure Infrastructure'] as $feat)
                            <li class="flex items-center gap-3 text-sm text-white/70">
                                <i data-lucide="check-circle" style="width:16px; height:16px; color: #00D4FF;"></i>
                                {{ $feat }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="relative z-10 mt-12">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                        <p class="text-xs italic text-white/50 mb-2">"The speed of execution is unmatched. A game changer for my portfolio."</p>
                        <p class="text-[10px] uppercase tracking-widest text-[#00D4FF] font-bold">— Alex R., Enterprise Trader</p>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="lg:col-span-3 p-8">
                <div class="mb-8 lg:hidden flex justify-center">
                     <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-gradient-to-br from-[#1E5FAD] to-[#00D4FF]">
                            <i data-lucide="trending-up" class="text-white" style="width:16px; height:16px;"></i>
                        </div>
                        <span class="text-xl tracking-widest uppercase text-white font-bold" style="font-family: 'Rajdhani', sans-serif;">Copier</span>
                    </a>
                </div>

                <h2 class="text-2xl mb-2" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; color: #fff;">Create Account</h2>
                <p class="text-sm opacity-50 mb-8" style="color: #E2E8F0;">Start your 14-day free trial today.</p>

                <form id="signup-form" action="{{ route('signup.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ request('plan') }}">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">First Name</label>
                            <input type="text" name="first_name" placeholder="John" required 
                                   class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                                   style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Last Name</label>
                            <input type="text" name="last_name" placeholder="Doe" required 
                                   class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                                   style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required 
                               class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                               style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+1 (555) 000-0000" required 
                               class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30" 
                               style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Choose Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Min. 8 characters" required 
                                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30 pr-10" 
                                       style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                                <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/70 transition-colors">
                                    <i data-lucide="eye" style="width:16px; height:16px;"></i>
                                </button>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block text-xs uppercase tracking-widest mb-2 opacity-60" style="color: #00D4FF; font-weight: 600;">Confirm Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" required 
                                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all focus:ring-1 focus:ring-[#00D4FF]/30 pr-10" 
                                       style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0;">
                                <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/70 transition-colors">
                                    <i data-lucide="eye" style="width:16px; height:16px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <p class="text-[10px] opacity-40 leading-relaxed" style="color: #E2E8F0;">
                        By clicking Sign Up, you agree to our <a href="#" class="underline">Terms</a>, <a href="#" class="underline">Privacy Policy</a> and <a href="#" class="underline">Risk Disclosure</a>.
                    </p>

                    <button type="submit" id="submit-btn" class="w-full py-4 rounded-xl text-sm flex items-center justify-center gap-2 group transition-all duration-300 hover:shadow-[0_0_30px_rgba(0,212,255,0.3)] hover:-translate-y-0.5" 
                            style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; font-weight: 700; margin-top: 1rem;">
                        <span class="btn-text">Create Your Account</span>
                        <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform duration-300" style="width:18px; height:18px;"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-xs opacity-50" style="color: #E2E8F0;">Already have an account? 
                        <a href="{{ route('login') }}" class="text-[#00D4FF] font-semibold hover:underline">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('overlays')
@endpush

@push('scripts')
<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('data-lucide', 'eye-off');
    } else {
        input.type = 'password';
        icon.setAttribute('data-lucide', 'eye');
    }
    if (typeof lucide !== 'undefined') lucide.createIcons();
}

document.getElementById('signup-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const btn = document.getElementById('submit-btn');
    const btnText = btn.querySelector('.btn-text');
    const originalText = btnText.innerText;
    
    // Disable button
    btn.disabled = true;
    btnText.innerText = 'Creating Account...';
    
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(async response => {
        const data = await response.json();
        if (response.ok && data.success) {
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                background: '#0d1526',
                color: '#fff',
                confirmButtonColor: '#00D4FF',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = data.redirect;
            });
        } else {
            throw new Error(data.message || 'Something went wrong');
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error',
            text: error.message,
            icon: 'error',
            background: '#0d1526',
            color: '#fff',
            confirmButtonColor: '#1E5FAD'
        });
        btn.disabled = false;
        btnText.innerText = originalText;
    });
});
</script>
@endpush

