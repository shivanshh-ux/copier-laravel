<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. LENIS BUTTERY SMOOTH SCROLL
    const lenis = new Lenis({
        duration: 1.4,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), 
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1.2,
        smoothTouch: false,
        touchMultiplier: 2,
    });

    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);
    } else {
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }

    // 2. GSAP PREMIUM 3D ANIMATIONS
    if (typeof gsap !== 'undefined') {
        gsap.set(".page-wrapper", { perspective: 1200 });
        const sections = document.querySelectorAll('section:not(#preloader-content)');
        sections.forEach(section => {
            gsap.from(section, {
                scrollTrigger: { trigger: section, start: "top 85%", toggleActions: "play none none none" },
                opacity: 0, z: -80, rotateX: 8, scale: 0.96,
                duration: 1.1, ease: "power3.out"
            });
        });

        const titles = document.querySelectorAll('h1, h2, .section-title');
        titles.forEach(title => {
            gsap.from(title, {
                scrollTrigger: { trigger: title, start: "top 90%", toggleActions: "play none none none" },
                opacity: 0, rotateX: 20, y: 40, z: -60,
                duration: 1.0, ease: "back.out(1.4)"
            });
        });

        document.querySelectorAll('.btn-primary, .btn-outline, .card').forEach(el => {
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

    lucide.createIcons();
    AOS.init({ duration: 800, easing: 'ease-out-cubic', once: false, offset: 80 });

    const header = document.getElementById('main-header');
    const progressDiv = document.getElementById('scroll-progress');

    lenis.on('scroll', ({ scroll }) => {
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

        if (progressDiv) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scroll / docHeight) * 100 : 0;
            progressDiv.style.width = progress + '%';
        }
    });

    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuContent = mobileMenu.querySelector('div:last-child');
    let isMenuOpen = false;

    if(mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                mobileMenu.style.opacity = '1';
                mobileMenu.style.pointerEvents = 'auto';
                mobileMenuContent.style.transform = 'translateX(0)';
                lenis.stop(); 
            } else {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.pointerEvents = 'none';
                mobileMenuContent.style.transform = 'translateX(100%)';
                lenis.start(); 
            }
        });
    }
});
</script>

