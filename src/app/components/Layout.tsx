import { useEffect, useRef } from 'react';
import { Outlet, useLocation } from 'react-router';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { Header } from './Header';
import { Footer } from './Footer';

export function Layout() {
  const { pathname } = useLocation();
  const progressRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    AOS.init({
      duration: 800,
      easing: 'ease-out-cubic',
      once: false,
      offset: 80,
    });
  }, []);

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    AOS.refresh();
  }, [pathname]);

  // Scroll progress bar (anime.js style)
  useEffect(() => {
    const handleScroll = () => {
      if (!progressRef.current) return;
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
      progressRef.current.style.width = `${progress}%`;
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, [pathname]);

  return (
    <div className="min-h-screen flex flex-col" style={{ background: '#060D1A', color: '#E2E8F0' }}>
      {/* Scroll Progress Bar */}
      <div className="fixed top-0 left-0 right-0 z-[100] h-[2px]" style={{ background: 'rgba(0,212,255,0.1)' }}>
        <div
          ref={progressRef}
          className="h-full transition-none"
          style={{
            background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)',
            width: '0%',
            boxShadow: '0 0 8px rgba(0,212,255,0.6)',
          }}
        />
      </div>
      <Header />
      <main className="flex-1">
        <Outlet />
      </main>
      <Footer />
    </div>
  );
}