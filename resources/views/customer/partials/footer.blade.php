<footer class="relative overflow-hidden" style="background: linear-gradient(180deg, #060D1A 0%, #030810 100%); border-top: 1px solid rgba(0,212,255,0.1);">
    <!-- Grid background -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px); background-size: 60px 60px;"></div>

    <!-- Glow orbs -->
    <div class="absolute bottom-0 left-1/4 w-72 h-40 opacity-10 pointer-events-none" style="background: #1E5FAD; filter: blur(80px);"></div>
    <div class="absolute top-0 right-1/4 w-56 h-40 opacity-10 pointer-events-none" style="background: #00D4FF; filter: blur(80px);"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16 pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 lg:gap-12 mb-10 sm:mb-12">

            <!-- Brand -->
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-4 sm:mb-5" style="text-decoration:none;">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF)">
                        <i data-lucide="trending-up" class="text-white" style="width:18px; height:18px; stroke-width: 2.5;"></i>
                    </div>
                    <span class="text-xl sm:text-2xl tracking-widest uppercase" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; background: linear-gradient(90deg, #ffffff, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Copier</span>
                </a>
                <p class="text-sm leading-relaxed mb-4 sm:mb-5 opacity-60 max-w-xs" style="color: #E2E8F0;">Professional algorithmic trading solutions. Automate your trades with precision and intelligence. Est. 2026.</p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(0,212,255,0.15); color: #00D4FF;" aria-label="Twitter"><i data-lucide="twitter" style="width:15px; height:15px;"></i></a>
                    <a href="#" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(0,212,255,0.15); color: #00D4FF;" aria-label="LinkedIn"><i data-lucide="linkedin" style="width:15px; height:15px;"></i></a>
                    <a href="#" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(0,212,255,0.15); color: #00D4FF;" aria-label="YouTube"><i data-lucide="youtube" style="width:15px; height:15px;"></i></a>
                </div>
            </div>

            <!-- Company Links -->
            <div>
                <h4 class="text-xs uppercase tracking-[0.2em] mb-4 sm:mb-5" style="color: #00D4FF; font-weight: 600;">Company</h4>
                <ul class="space-y-2 sm:space-y-3">
                    <li><a href="{{ route('home') }}"    class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Home</a></li>
                    <li><a href="{{ route('about') }}"    class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Services</a></li>
                    <li><a href="{{ route('help') }}"     class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Help Center</a></li>
                </ul>
            </div>

            <!-- Account Links -->
            <div>
                <h4 class="text-xs uppercase tracking-[0.2em] mb-4 sm:mb-5" style="color: #00D4FF; font-weight: 600;">Account</h4>
                <ul class="space-y-2 sm:space-y-3">
                    <li><a href="{{ route('login') }}"   class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Login</a></li>
                    <li><a href="{{ route('signup') }}"  class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Create Account</a></li>
                    <li><a href="{{ route('profile') }}" class="text-sm opacity-60 hover:opacity-100 transition-opacity duration-300" style="color: #E2E8F0; text-decoration:none;">Your Profile</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-xs uppercase tracking-[0.2em] mb-4 sm:mb-5" style="color: #00D4FF; font-weight: 600;">Contact</h4>
                <ul class="space-y-3 sm:space-y-4">
                    <li class="flex items-start gap-3 text-sm opacity-60" style="color: #E2E8F0;">
                        <i data-lucide="mail" class="flex-shrink-0 mt-0.5" style="width:14px; height:14px; color: #00D4FF;"></i>
                        <span>support@copier.trade</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm opacity-60" style="color: #E2E8F0;">
                        <i data-lucide="phone" class="flex-shrink-0 mt-0.5" style="width:14px; height:14px; color: #00D4FF;"></i>
                        <span>+1 (800) COPIER-1</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm opacity-60" style="color: #E2E8F0;">
                        <i data-lucide="map-pin" class="flex-shrink-0 mt-0.5" style="width:14px; height:14px; color: #00D4FF;"></i>
                        <span>New York, NY — Est. 2026</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="h-px mb-6" style="background: linear-gradient(90deg, transparent, rgba(0,212,255,0.3), transparent);"></div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs opacity-40" style="color: #E2E8F0;">
            <p class="text-center sm:text-left">© 2026 Copier Algo Trading. All rights reserved.</p>
            <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                <a href="#" style="color: #E2E8F0; text-decoration:none;">Privacy Policy</a>
                <a href="#" style="color: #E2E8F0; text-decoration:none;">Terms of Service</a>
                <a href="#" style="color: #E2E8F0; text-decoration:none;">Risk Disclosure</a>
            </div>
        </div>
    </div>
</footer>

