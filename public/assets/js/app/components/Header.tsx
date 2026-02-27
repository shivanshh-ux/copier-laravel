import { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router';
import { TrendingUp } from 'lucide-react';

const navLinks = [
  { label: 'Home', path: '/' },
  { label: 'About', path: '/about' },
  { label: 'Services', path: '/services' },
  { label: 'Catalog', path: '/catalog' },
  { label: 'Trading', path: '/trading' },
  { label: 'MetaTrader', path: '/metatrader' },
  { label: 'Portfolio', path: '/portfolio' },
  { label: 'Help', path: '/help' },
];

export function Header() {
  const [isOpen, setIsOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const { pathname } = useLocation();

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    setIsOpen(false);
  }, [pathname]);

  useEffect(() => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
    return () => { document.body.style.overflow = ''; };
  }, [isOpen]);

  return (
    <>
      <header
        className="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
        style={{
          background: scrolled
            ? 'rgba(6,13,26,0.96)'
            : 'linear-gradient(180deg, rgba(6,13,26,0.85) 0%, transparent 100%)',
          backdropFilter: scrolled ? 'blur(16px)' : 'none',
          borderBottom: scrolled ? '1px solid rgba(0,212,255,0.12)' : 'none',
          boxShadow: scrolled ? '0 4px 32px rgba(0,0,0,0.4)' : 'none',
        }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-20">
            {/* Logo */}
            <Link
              to="/"
              className="flex items-center gap-3 group"
              aria-label="Copier - Algo Trading"
            >
              <div
                className="w-10 h-10 rounded-xl flex items-center justify-center relative overflow-hidden transition-transform duration-300 group-hover:scale-110"
                style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)' }}
              >
                <TrendingUp size={20} color="#fff" strokeWidth={2.5} />
                <div
                  className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                  style={{ background: 'linear-gradient(135deg, #00D4FF, #1E5FAD)' }}
                />
                <TrendingUp
                  size={20}
                  color="#fff"
                  strokeWidth={2.5}
                  className="absolute opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                />
              </div>
              <div>
                <span
                  className="text-2xl tracking-widest uppercase"
                  style={{
                    fontFamily: "'Rajdhani', sans-serif",
                    fontWeight: 700,
                    background: 'linear-gradient(90deg, #ffffff, #00D4FF)',
                    WebkitBackgroundClip: 'text',
                    WebkitTextFillColor: 'transparent',
                    backgroundClip: 'text',
                  }}
                >
                  Copier
                </span>
                <p className="text-[10px] tracking-[0.3em] uppercase opacity-60" style={{ color: '#00D4FF', marginTop: '-4px' }}>
                  Algo Trading
                </p>
              </div>
            </Link>

            {/* Desktop Nav */}
            <nav className="hidden lg:flex items-center gap-1" role="navigation" aria-label="Main navigation">
              {navLinks.map((link) => {
                const isActive = pathname === link.path;
                return (
                  <Link
                    key={link.path}
                    to={link.path}
                    className="relative px-4 py-2 text-sm tracking-wide transition-all duration-300 group rounded-lg"
                    style={{
                      color: isActive ? '#00D4FF' : 'rgba(226,232,240,0.8)',
                      fontWeight: isActive ? 600 : 400,
                    }}
                    aria-current={isActive ? 'page' : undefined}
                  >
                    <span className="relative z-10">{link.label}</span>
                    {isActive && (
                      <span
                        className="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 w-4/5 rounded-full"
                        style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)' }}
                      />
                    )}
                    <span
                      className="absolute inset-0 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                      style={{ background: 'rgba(0,212,255,0.07)' }}
                    />
                  </Link>
                );
              })}
              <Link
                to="/services"
                className="ml-4 px-6 py-2.5 rounded-xl text-sm tracking-wide transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5"
                style={{
                  background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)',
                  color: '#fff',
                  fontWeight: 600,
                  boxShadow: '0 0 20px rgba(0,212,255,0.25)',
                }}
              >
                Get Started
              </Link>
            </nav>

            {/* Animated Hamburger */}
            <button
              onClick={() => setIsOpen(!isOpen)}
              className="lg:hidden relative w-10 h-10 flex flex-col items-center justify-center gap-[5px] rounded-lg transition-all duration-300 z-50 focus:outline-none"
              style={{
                background: isOpen ? 'rgba(0,212,255,0.15)' : 'rgba(255,255,255,0.05)',
                border: '1px solid rgba(0,212,255,0.2)',
              }}
              aria-label={isOpen ? 'Close menu' : 'Open menu'}
              aria-expanded={isOpen}
              aria-controls="mobile-menu"
            >
              {/* Line 1 */}
              <span
                className="block w-5 h-[2px] rounded-full transition-all duration-500 origin-center"
                style={{
                  background: '#00D4FF',
                  transform: isOpen ? 'translateY(7px) rotate(45deg)' : 'none',
                }}
              />
              {/* Line 2 */}
              <span
                className="block w-5 h-[2px] rounded-full transition-all duration-500"
                style={{
                  background: isOpen ? '#1E5FAD' : '#00D4FF',
                  opacity: isOpen ? 0 : 1,
                  transform: isOpen ? 'scaleX(0)' : 'none',
                }}
              />
              {/* Line 3 */}
              <span
                className="block h-[2px] rounded-full transition-all duration-500 origin-center"
                style={{
                  background: '#00D4FF',
                  width: isOpen ? '20px' : '14px',
                  transform: isOpen ? 'translateY(-7px) rotate(-45deg)' : 'none',
                }}
              />
            </button>
          </div>
        </div>
      </header>

      {/* Mobile Menu Overlay */}
      <div
        id="mobile-menu"
        className="fixed inset-0 z-40 lg:hidden transition-all duration-500"
        style={{
          opacity: isOpen ? 1 : 0,
          pointerEvents: isOpen ? 'auto' : 'none',
        }}
        aria-hidden={!isOpen}
      >
        {/* Backdrop */}
        <div
          className="absolute inset-0"
          style={{ background: 'rgba(6,13,26,0.7)', backdropFilter: 'blur(8px)' }}
          onClick={() => setIsOpen(false)}
        />
        {/* Drawer */}
        <div
          className="absolute top-0 right-0 h-full w-80 max-w-[90vw] flex flex-col pt-24 pb-8 px-6 transition-transform duration-500"
          style={{
            background: 'linear-gradient(180deg, #0F1E35 0%, #060D1A 100%)',
            borderLeft: '1px solid rgba(0,212,255,0.15)',
            transform: isOpen ? 'translateX(0)' : 'translateX(100%)',
          }}
        >
          {/* Glow */}
          <div
            className="absolute top-24 right-0 w-48 h-48 rounded-full opacity-20 pointer-events-none"
            style={{ background: '#00D4FF', filter: 'blur(60px)' }}
          />
          <nav className="flex flex-col gap-2" role="navigation" aria-label="Mobile navigation">
            {navLinks.map((link, i) => {
              const isActive = pathname === link.path;
              return (
                <Link
                  key={link.path}
                  to={link.path}
                  className="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300"
                  style={{
                    background: isActive ? 'rgba(0,212,255,0.1)' : 'transparent',
                    color: isActive ? '#00D4FF' : 'rgba(226,232,240,0.85)',
                    borderLeft: isActive ? '3px solid #00D4FF' : '3px solid transparent',
                    fontWeight: isActive ? 600 : 400,
                    transitionDelay: `${i * 40}ms`,
                    transform: isOpen ? 'translateX(0)' : 'translateX(20px)',
                    opacity: isOpen ? 1 : 0,
                  }}
                >
                  <span className="text-base tracking-wide">{link.label}</span>
                </Link>
              );
            })}
          </nav>
          <div className="mt-8 pt-8" style={{ borderTop: '1px solid rgba(0,212,255,0.1)' }}>
            <Link
              to="/services"
              className="block w-full text-center px-6 py-3 rounded-xl text-sm tracking-wide transition-all duration-300"
              style={{
                background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)',
                color: '#fff',
                fontWeight: 600,
              }}
            >
              Get Started Today
            </Link>
            <p className="text-center text-xs mt-4 opacity-40" style={{ color: '#E2E8F0' }}>
              © 2026 Copier. All rights reserved.
            </p>
          </div>
        </div>
      </div>
    </>
  );
}
