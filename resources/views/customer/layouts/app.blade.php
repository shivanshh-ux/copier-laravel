<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="@yield('description', 'Copier Algo Trading — Professional algorithmic trading solutions. Automate your trades with precision and intelligence.')">
    <title>@yield('title', 'Copier — Algo Trading')</title>

    <!-- Tailwind CSS 4 CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Custom Theme Styles -->
    <link rel="stylesheet" type="text/tailwindcss" href="{{ asset('assets/css/index.css') }}">

    @if(request()->routeIs('home'))
        @include('customer.partials.preloader_styles')
    @elseif(request()->routeIs('about', 'services', 'help'))
        @include('customer.partials.page_loader_styles')
    @endif

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.13/dist/lenis.min.js"></script>

    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Three.js for 3D background -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    @stack('styles')
    <style>
        #bg-canvas {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0; pointer-events: none;
        }
        /* ── PAGE TRANSITION ── */
        #page-transition {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(135deg, #020914, #0A1628);
            transform: scaleY(0); transform-origin: bottom;
            transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
            pointer-events: none;
        }
        #page-transition.entering {
            transform: scaleY(1); transform-origin: top;
        }
    </style>
</head>
<body class="@yield('body-class', 'min-h-screen flex flex-col')" style="background: #060D1A; color: #E2E8F0;">

    @stack('overlays')
    
    <!-- 3D Background Canvas -->
    <canvas id="bg-canvas"></canvas>

    <!-- Page transition overlay -->
    <div id="page-transition"></div>

    @if(request()->routeIs('home'))
        @include('customer.partials.preloader')
    @elseif(request()->routeIs('about', 'services', 'help'))
        @include('customer.partials.page_loader')
    @endif
    @hasSection('hide-header')
    @else
        @include('customer.partials.header')
    @endif

    <div class="page-wrapper">
        @yield('content')
    </div>

    @hasSection('hide-footer')
    @else
        @include('customer.partials.footer')
    @endif

    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.8.0/countUp.umd.min.js"></script>

    <!-- Global Website Logic (Smooth Scroll, Transitions, Lucide) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Lucide Icons
            if (typeof lucide !== 'undefined') lucide.createIcons();

            // Lenis Smooth Scroll
            if (typeof Lenis !== 'undefined') {
                window.lenis = new Lenis({
                    duration: 1.2,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    wheelMultiplier: 1.1,
                    touchMultiplier: 2,
                    smoothWheel: true,
                    smoothTouch: false,
                });

                // Sync ScrollTrigger with Lenis
                if (typeof ScrollTrigger !== 'undefined') {
                    window.lenis.on('scroll', ScrollTrigger.update);
                    gsap.ticker.add((time) => {
                        window.lenis.raf(time * 1000);
                    });
                    gsap.ticker.lagSmoothing(0);
                } else {
                    function raf(time) {
                        window.lenis.raf(time);
                        requestAnimationFrame(raf);
                    }
                    requestAnimationFrame(raf);
                }

                // Initial state
                @if(request()->routeIs('home'))
                    window.lenis.stop();
                    document.body.style.overflow = 'hidden';
                @else
                    document.body.style.overflow = '';
                    window.lenis.start();
                @endif

                // Listen for preloader finish
                window.addEventListener('preloaderFinished', () => {
                    window.lenis.start();
                    document.body.style.overflow = '';
                });
            }

            // AOS initialization
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50
                });
            }

            // Global Page Transitions
            const overlay = document.getElementById('page-transition');
            document.querySelectorAll('a[href]').forEach(link => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('http') || href.startsWith('mailto') || href.startsWith('tel')) return;
                
                link.addEventListener('click', e => {
                    // Don't transition if it's an external-looking link or JS handled
                    if (link.hostname !== window.location.hostname) return;
                    
                    e.preventDefault();
                    if (overlay) {
                        overlay.classList.add('entering');
                        setTimeout(() => { window.location.href = href; }, 480);
                    } else {
                        window.location.href = href;
                    }
                });
            });

            // Handle browser back/forward and cleanup
            window.addEventListener('pageshow', (event) => {
                if (overlay) {
                    overlay.style.transition = 'none';
                    overlay.style.transform = 'scaleY(0)';
                    overlay.classList.remove('entering');
                    setTimeout(() => { overlay.style.transition = ''; }, 50);
                }
            });

            // Hide Page Loader when fully loaded
            const pageLoader = document.getElementById('page-loader');
            if (pageLoader) {
                window.addEventListener('load', () => {
                    setTimeout(() => {
                        pageLoader.classList.add('hidden');
                        document.body.style.overflow = '';
                    }, 300); // Slight delay for smoothness
                });
            }
        });
    </script>

    @include('customer.partials.background_script')
    @stack('scripts')

</body>
</html>

