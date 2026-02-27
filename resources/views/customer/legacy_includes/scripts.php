<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- AOS (Animate On Scroll) -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Typed.js -->
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

<!-- Anime.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>

<!-- CountUp.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.8.0/countUp.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ─────────────────────────────────────────────
    // 1. LENIS BUTTERY SMOOTH SCROLL
    // ─────────────────────────────────────────────
    const lenis = new Lenis({
        duration: 1.4,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Expo ease-out
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1.2,
        smoothTouch: false,
        touchMultiplier: 2,
    });

    // Hook Lenis into GSAP's ticker for perfect sync with ScrollTrigger
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);
    } else {
        // Fallback RAF loop if GSAP isn't present
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }

    // ─────────────────────────────────────────────
    // 2. GSAP PREMIUM 3D ANIMATIONS
    // ─────────────────────────────────────────────
    if (typeof gsap !== 'undefined') {
        gsap.set(".page-wrapper", { perspective: 1200 });

        // 3D Section Reveals
        const sections = document.querySelectorAll('section:not(#preloader-content)');
        sections.forEach(section => {
            gsap.from(section, {
                scrollTrigger: { trigger: section, start: "top 85%", toggleActions: "play none none none" },
                opacity: 0, z: -80, rotateX: 8, scale: 0.96,
                duration: 1.1, ease: "power3.out"
            });
        });

        // 3D Title Reveals
        const titles = document.querySelectorAll('h1, h2, .section-title');
        titles.forEach(title => {
            gsap.from(title, {
                scrollTrigger: { trigger: title, start: "top 90%", toggleActions: "play none none none" },
                opacity: 0, rotateX: 20, y: 40, z: -60,
                duration: 1.0, ease: "back.out(1.4)"
            });
        });

        // Staggered 3D Card Entrances
        const cardGroups = document.querySelectorAll('.features-grid, .cards-grid, .pricing-grid');
        cardGroups.forEach(group => {
            const cards = group.querySelectorAll(':scope > *');
            gsap.from(cards, {
                scrollTrigger: { trigger: group, start: "top 85%", toggleActions: "play none none none" },
                opacity: 0, scale: 0.85, z: -120, rotateY: -15, y: 40,
                duration: 0.9, ease: "power3.out", stagger: 0.1
            });
        });

        // Interactive 3D Hover Tilt
        document.querySelectorAll('.btn-primary, .btn-outline, .card-3d').forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                gsap.to(el, { rotateX: -y * 12, rotateY: x * 12, z: 30, scale: 1.04, duration: 0.35, ease: "power2.out" });
            });
            el.addEventListener('mouseleave', () => {
                gsap.to(el, { rotateX: 0, rotateY: 0, z: 0, scale: 1, duration: 0.5, ease: "elastic.out(1, 0.5)" });
            });
        });
    }

    // ─────────────────────────────────────────────
    // 3. INITIALIZE OTHER LIBS
    // ─────────────────────────────────────────────
    lucide.createIcons();

    AOS.init({ duration: 800, easing: 'ease-out-cubic', once: false, offset: 80 });

    // ─────────────────────────────────────────────
    // 4. HEADER SCROLL EFFECT (via Lenis)
    // ─────────────────────────────────────────────
    const header = document.getElementById('main-header');
    const progressDiv = document.getElementById('scroll-progress');

    lenis.on('scroll', ({ scroll }) => {
        // Header glass effect
        if (scroll > 20) {
            header.style.background = 'rgba(6,13,26,0.96)';
            header.style.backdropFilter = 'blur(16px)';
            header.style.borderBottom = '1px solid rgba(0,212,255,0.12)';
            header.style.boxShadow = '0 4px 32px rgba(0,0,0,0.4)';
        } else {
            header.style.background = 'linear-gradient(180deg, rgba(6,13,26,0.85) 0%, transparent 100%)';
            header.style.backdropFilter = 'none';
            header.style.borderBottom = 'none';
            header.style.boxShadow = 'none';
        }

        // Scroll progress bar
        if (progressDiv) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scroll / docHeight) * 100 : 0;
            progressDiv.style.width = progress + '%';
        }
    });

    // ─────────────────────────────────────────────
    // 5. MOBILE MENU TOGGLE
    // ─────────────────────────────────────────────
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuContent = mobileMenu.querySelector('div:last-child');
    let isMenuOpen = false;

    mobileToggle.addEventListener('click', () => {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenu.classList.add('opacity-100');
            mobileMenuContent.classList.remove('translate-x-full');
            lenis.stop(); // Pause smooth scroll while menu is open
            mobileToggle.children[0].style.transform = 'translateY(7px) rotate(45deg)';
            mobileToggle.children[1].style.opacity = '0';
            mobileToggle.children[1].style.transform = 'scaleX(0)';
            mobileToggle.children[2].style.transform = 'translateY(-7px) rotate(-45deg)';
            mobileToggle.children[2].style.width = '20px';
        } else {
            mobileMenu.classList.add('opacity-0', 'pointer-events-none');
            mobileMenu.classList.remove('opacity-100');
            mobileMenuContent.classList.add('translate-x-full');
            lenis.start(); // Resume smooth scroll
            mobileToggle.children[0].style.transform = 'none';
            mobileToggle.children[1].style.opacity = '1';
            mobileToggle.children[1].style.transform = 'none';
            mobileToggle.children[2].style.transform = 'none';
            mobileToggle.children[2].style.width = '14px';
        }
    });

    mobileMenu.querySelector('div:first-child').addEventListener('click', () => {
        mobileToggle.click();
    });
});
</script>
