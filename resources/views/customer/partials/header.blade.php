@php
$navLinks = [
    ['label' => 'Home',     'route' => 'home'],
    ['label' => 'About',    'route' => 'about'],
    ['label' => 'Services', 'route' => 'services'],
    ['label' => 'Help',     'route' => 'help'],
];

if (!Auth::guard('customer')->check()) {
    $navLinks[] = ['label' => 'Login', 'route' => 'login'];
}
@endphp

<!-- Scroll Progress Bar -->
<div class="fixed top-0 left-0 right-0 z-[100] h-[2px]" style="background: rgba(0,212,255,0.1)">
    <div id="scroll-progress" class="h-full transition-none" style="background: linear-gradient(90deg, #1E5FAD, #00D4FF); width: 0%; box-shadow: 0 0 8px rgba(0,212,255,0.6);"></div>
</div>

<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" style="background: linear-gradient(180deg, rgba(6,13,26,0.92) 0%, rgba(6,13,26,0.6) 100%); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group flex-shrink-0" aria-label="Copier - Algo Trading">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center relative overflow-hidden transition-transform duration-300 group-hover:scale-110 flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF)">
                    <i data-lucide="trending-up" class="text-white" style="width:16px; height:16px; stroke-width: 2.5;"></i>
                </div>
                <div class="min-w-0">
                    <span class="text-xl sm:text-2xl tracking-widest uppercase block" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; background: linear-gradient(90deg, #ffffff, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1;">Copier</span>
                    <p class="text-[9px] sm:text-[10px] tracking-[0.3em] uppercase opacity-60 hidden xs:block" style="color: #00D4FF; margin-top: -2px; line-height: 1;">Algo Trading</p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1" role="navigation">
                @foreach ($navLinks as $link)
                    @php
                        $isActive = request()->routeIs($link['route']);
                    @endphp
                    <a href="{{ route($link['route']) }}" class="relative px-4 py-2 text-sm tracking-wide transition-all duration-300 group rounded-lg" style="color: {{ $isActive ? '#00D4FF' : 'rgba(226,232,240,0.8)' }}; font-weight: {{ $isActive ? '600' : '400' }};">
                        <span class="relative z-10">{{ $link['label'] }}</span>
                        @if ($isActive)
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 w-4/5 rounded-full" style="background: linear-gradient(90deg, #1E5FAD, #00D4FF)"></span>
                        @endif
                        <span class="absolute inset-0 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: rgba(0,212,255,0.07)"></span>
                    </a>
                @endforeach
                
                @if (Auth::guard('customer')->check())
                <a href="{{ route('profile') }}" class="ml-4 w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; box-shadow: 0 0 20px rgba(0,212,255,0.25);" title="Your Profile">
                    <i data-lucide="user" style="width:18px; height:18px; stroke-width: 2.5;"></i>
                </a>
                @endif
            </nav>

            <!-- Right side: hamburger (mobile) -->
            <div class="flex items-center gap-2 lg:hidden">
                <button id="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false" class="relative w-9 h-9 sm:w-10 sm:h-10 flex flex-col items-center justify-center gap-[5px] rounded-lg transition-all duration-300 focus:outline-none flex-shrink-0" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(0,212,255,0.2);">
                    <span class="ham-line block w-5 h-[2px] rounded-full transition-all duration-400 origin-center" style="background: #00D4FF;"></span>
                    <span class="ham-line block w-5 h-[2px] rounded-full transition-all duration-400" style="background: #00D4FF;"></span>
                    <span class="ham-line block h-[2px] rounded-full transition-all duration-400 origin-center" style="background: #00D4FF; width: 12px;"></span>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden" aria-hidden="true" style="opacity: 0; pointer-events: none; transition: opacity 0.4s ease;">
    <!-- Backdrop -->
    <div id="mobile-backdrop" class="absolute inset-0" style="background: rgba(6,13,26,0.75); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"></div>
    <!-- Drawer -->
    <div id="mobile-drawer" class="absolute top-0 right-0 h-full flex flex-col pt-20 pb-8 px-6 overflow-y-auto" style="width: min(320px, 85vw); background: linear-gradient(180deg, #0F1E35 0%, #060D1A 100%); border-left: 1px solid rgba(0,212,255,0.15); transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);">
        <nav class="flex flex-col gap-1">
            @foreach ($navLinks as $link)
                @php
                    $isActive = request()->routeIs($link['route']);
                @endphp
                <a href="{{ route($link['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300" style="background: {{ $isActive ? 'rgba(0,212,255,0.1)' : 'transparent' }}; color: {{ $isActive ? '#00D4FF' : 'rgba(226,232,240,0.85)' }}; border-left: {{ $isActive ? '3px solid #00D4FF' : '3px solid transparent' }}; font-weight: {{ $isActive ? '600' : '400' }}; text-decoration: none; font-size: 0.95rem; letter-spacing: 0.02em;">
                    {{ $link['label'] }}
                </a>
            @endforeach
            
            @if (Auth::guard('customer')->check())
            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300" style="background: {{ request()->routeIs('profile') ? 'rgba(0,212,255,0.1)' : 'transparent' }}; color: {{ request()->routeIs('profile') ? '#00D4FF' : 'rgba(226,232,240,0.85)' }}; border-left: {{ request()->routeIs('profile') ? '3px solid #00D4FF' : '3px solid transparent' }}; font-weight: {{ request()->routeIs('profile') ? '600' : '400' }}; text-decoration: none; font-size: 0.95rem; letter-spacing: 0.02em;">
                Profile
            </a>
            @endif
        </nav>
        <div class="mt-auto pt-8" style="border-top: 1px solid rgba(0,212,255,0.1)">
            <p class="text-center text-xs mt-4 opacity-40" style="color: #E2E8F0;">© 2026 Copier. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
(function(){
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu   = document.getElementById('mobile-menu');
    const drawer = document.getElementById('mobile-drawer');
    const backdrop = document.getElementById('mobile-backdrop');
    const lines  = toggle ? toggle.querySelectorAll('.ham-line') : [];
    let open = false;

    function openMenu(){
        open = true;
        menu.style.opacity = '1';
        menu.style.pointerEvents = 'auto';
        menu.setAttribute('aria-hidden','false');
        drawer.style.transform = 'translateX(0)';
        toggle.setAttribute('aria-expanded','true');
        document.body.style.overflow = 'hidden';
        // Animate hamburger → X
        if(lines.length >= 3){
            lines[0].style.transform = 'translateY(7px) rotate(45deg)';
            lines[1].style.opacity = '0';
            lines[2].style.transform = 'translateY(-7px) rotate(-45deg)';
            lines[2].style.width = '20px';
        }
    }
    function closeMenu(){
        open = false;
        menu.style.opacity = '0';
        menu.style.pointerEvents = 'none';
        menu.setAttribute('aria-hidden','true');
        drawer.style.transform = 'translateX(100%)';
        toggle.setAttribute('aria-expanded','false');
        document.body.style.overflow = '';
        if(lines.length >= 3){
            lines[0].style.transform = '';
            lines[1].style.opacity = '1';
            lines[2].style.transform = '';
            lines[2].style.width = '12px';
        }
    }

    if(toggle) toggle.addEventListener('click', ()=> open ? closeMenu() : openMenu());
    if(backdrop) backdrop.addEventListener('click', closeMenu);

    // Scroll progress
    window.addEventListener('scroll', function(){
        const el = document.getElementById('scroll-progress');
        if(el){
            const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            el.style.width = Math.min(pct, 100) + '%';
        }
        // Header blur on scroll
        const header = document.getElementById('main-header');
        if(header){
            if(window.scrollY > 20){
                header.style.background = 'rgba(6,13,26,0.97)';
                header.style.boxShadow = '0 1px 30px rgba(0,0,0,0.4)';
            } else {
                header.style.background = 'linear-gradient(180deg, rgba(6,13,26,0.92) 0%, rgba(6,13,26,0.6) 100%)';
                header.style.boxShadow = 'none';
            }
        }
    }, { passive: true });
})();
</script>

