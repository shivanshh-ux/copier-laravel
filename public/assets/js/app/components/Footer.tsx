import { Link } from 'react-router';
import { TrendingUp, Twitter, Linkedin, Youtube, Mail, Phone, MapPin, ArrowRight } from 'lucide-react';

const footerLinks = {
  company: [
    { label: 'Home', path: '/' },
    { label: 'About Us', path: '/about' },
    { label: 'Portfolio', path: '/portfolio' },
    { label: 'Help Center', path: '/help' },
  ],
  services: [
    { label: 'Trading Packages', path: '/services' },
    { label: 'Strategy Catalog', path: '/catalog' },
    { label: 'Live Trading', path: '/trading' },
    { label: 'MetaTrader Setup', path: '/metatrader' },
  ],
};

export function Footer() {
  return (
    <footer
      className="relative overflow-hidden"
      style={{
        background: 'linear-gradient(180deg, #060D1A 0%, #030810 100%)',
        borderTop: '1px solid rgba(0,212,255,0.1)',
      }}
    >
      {/* Grid background */}
      <div
        className="absolute inset-0 opacity-[0.03] pointer-events-none"
        style={{
          backgroundImage:
            'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)',
          backgroundSize: '60px 60px',
        }}
      />
      {/* Glow orbs */}
      <div
        className="absolute bottom-0 left-1/4 w-96 h-48 opacity-10 pointer-events-none"
        style={{ background: '#1E5FAD', filter: 'blur(80px)' }}
      />
      <div
        className="absolute top-0 right-1/4 w-72 h-48 opacity-10 pointer-events-none"
        style={{ background: '#00D4FF', filter: 'blur(80px)' }}
      />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        {/* Top */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
          {/* Brand */}
          <div className="lg:col-span-1">
            <Link to="/" className="flex items-center gap-3 mb-5" aria-label="Copier">
              <div
                className="w-10 h-10 rounded-xl flex items-center justify-center"
                style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)' }}
              >
                <TrendingUp size={20} color="#fff" strokeWidth={2.5} />
              </div>
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
            </Link>
            <p className="text-sm leading-relaxed mb-5 opacity-60" style={{ color: '#E2E8F0' }}>
              Professional algorithmic trading solutions. Automate your trades with precision and intelligence. Est. 2026.
            </p>
            <div className="flex gap-3">
              {[
                { icon: Twitter, label: 'Twitter', href: '#' },
                { icon: Linkedin, label: 'LinkedIn', href: '#' },
                { icon: Youtube, label: 'YouTube', href: '#' },
              ].map(({ icon: Icon, label, href }) => (
                <a
                  key={label}
                  href={href}
                  aria-label={label}
                  className="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 hover:-translate-y-1"
                  style={{
                    background: 'rgba(255,255,255,0.05)',
                    border: '1px solid rgba(0,212,255,0.15)',
                    color: '#00D4FF',
                  }}
                  onMouseEnter={(e) => {
                    (e.currentTarget as HTMLElement).style.background = 'rgba(0,212,255,0.15)';
                    (e.currentTarget as HTMLElement).style.borderColor = 'rgba(0,212,255,0.5)';
                  }}
                  onMouseLeave={(e) => {
                    (e.currentTarget as HTMLElement).style.background = 'rgba(255,255,255,0.05)';
                    (e.currentTarget as HTMLElement).style.borderColor = 'rgba(0,212,255,0.15)';
                  }}
                >
                  <Icon size={15} />
                </a>
              ))}
            </div>
          </div>

          {/* Company Links */}
          <div>
            <h4
              className="text-sm uppercase tracking-[0.2em] mb-5"
              style={{ color: '#00D4FF', fontWeight: 600 }}
            >
              Company
            </h4>
            <ul className="space-y-3">
              {footerLinks.company.map((link) => (
                <li key={link.path}>
                  <Link
                    to={link.path}
                    className="text-sm flex items-center gap-2 opacity-60 hover:opacity-100 transition-all duration-300 group"
                    style={{ color: '#E2E8F0' }}
                  >
                    <ArrowRight
                      size={12}
                      className="opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300"
                      style={{ color: '#00D4FF' }}
                    />
                    {link.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Services Links */}
          <div>
            <h4
              className="text-sm uppercase tracking-[0.2em] mb-5"
              style={{ color: '#00D4FF', fontWeight: 600 }}
            >
              Services
            </h4>
            <ul className="space-y-3">
              {footerLinks.services.map((link) => (
                <li key={link.path}>
                  <Link
                    to={link.path}
                    className="text-sm flex items-center gap-2 opacity-60 hover:opacity-100 transition-all duration-300 group"
                    style={{ color: '#E2E8F0' }}
                  >
                    <ArrowRight
                      size={12}
                      className="opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300"
                      style={{ color: '#00D4FF' }}
                    />
                    {link.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h4
              className="text-sm uppercase tracking-[0.2em] mb-5"
              style={{ color: '#00D4FF', fontWeight: 600 }}
            >
              Contact
            </h4>
            <ul className="space-y-4">
              {[
                { icon: Mail, text: 'support@copier.trade' },
                { icon: Phone, text: '+1 (800) COPIER-1' },
                { icon: MapPin, text: 'New York, NY — Est. 2026' },
              ].map(({ icon: Icon, text }) => (
                <li
                  key={text}
                  className="flex items-start gap-3 text-sm opacity-60"
                  style={{ color: '#E2E8F0' }}
                >
                  <Icon size={14} className="mt-0.5 shrink-0" style={{ color: '#00D4FF' }} />
                  {text}
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Divider */}
        <div
          className="h-px mb-6"
          style={{ background: 'linear-gradient(90deg, transparent, rgba(0,212,255,0.3), transparent)' }}
        />

        {/* Bottom */}
        <div className="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs opacity-40" style={{ color: '#E2E8F0' }}>
          <p>© 2026 Copier Algo Trading. All rights reserved.</p>
          <div className="flex gap-6">
            <a href="#" className="hover:opacity-80 transition-opacity">Privacy Policy</a>
            <a href="#" className="hover:opacity-80 transition-opacity">Terms of Service</a>
            <a href="#" className="hover:opacity-80 transition-opacity">Risk Disclosure</a>
          </div>
        </div>
      </div>
    </footer>
  );
}
