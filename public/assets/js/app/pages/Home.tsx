import { useEffect, useRef } from 'react';
import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import Typed from 'typed.js';
import CountUp from 'react-countup';
import { useInView } from 'react-intersection-observer';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import {
  TrendingUp, Shield, Zap, BarChart2, ChevronRight, Star,
  Activity, Target, Globe, ArrowRight, CheckCircle, Bot,
} from 'lucide-react';

const HERO_IMAGE = 'https://images.unsplash.com/photo-1672870153636-32a5e5218792?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxhbGdvcml0aG1pYyUyMHRyYWRpbmclMjBzdG9jayUyMG1hcmtldCUyMGRhcmt8ZW58MXx8fHwxNzcxOTMzNzA5fDA&ixlib=rb-4.1.0&q=80&w=1080';
const DASH_IMAGE = 'https://images.unsplash.com/photo-1748609160056-7b95f30041f0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaW5hbmNpYWwlMjBkYXRhJTIwYW5hbHl0aWNzJTIwZGFzaGJvYXJkfGVufDF8fHx8MTc3MTkwMDgwMnww&ixlib=rb-4.1.0&q=80&w=1080';
const ROBOT_IMAGE = 'https://images.unsplash.com/photo-1742767069929-0c663150b164?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx0cmFkaW5nJTIwc2lnbmFscyUyMGF1dG9tYXRpb24lMjByb2JvdHxlbnwxfHx8fDE3NzE5MzM3MTZ8MA&ixlib=rb-4.1.0&q=80&w=1080';

const stats = [
  { label: 'Active Traders', end: 12400, prefix: '', suffix: '+', icon: Globe },
  { label: 'Trades Executed', end: 5, prefix: '', suffix: 'M+', icon: Activity },
  { label: 'Win Rate', end: 87, prefix: '', suffix: '%', icon: Target },
  { label: 'ROI Average', end: 43, prefix: '', suffix: '%', icon: TrendingUp },
];

const features = [
  {
    icon: Bot,
    title: 'AI-Powered Automation',
    desc: 'Our proprietary algorithms analyze market data in milliseconds, executing trades with superhuman precision 24/7.',
  },
  {
    icon: Shield,
    title: 'Risk Management',
    desc: 'Built-in stop-loss, drawdown controls, and risk scoring ensure your capital is always protected.',
  },
  {
    icon: Zap,
    title: 'Ultra-Low Latency',
    desc: 'Co-located servers near major exchanges deliver execution speeds under 10ms for optimal entry and exit.',
  },
  {
    icon: BarChart2,
    title: 'Real-Time Analytics',
    desc: 'Live dashboards with P&L tracking, equity curves, and advanced reporting at your fingertips.',
  },
  {
    icon: Globe,
    title: 'Multi-Market Access',
    desc: 'Trade Forex, Crypto, Stocks, Commodities, and Indices from a single unified platform.',
  },
  {
    icon: CheckCircle,
    title: 'Copy Trading',
    desc: 'Mirror trades from top-performing experts automatically. Set your lot size, risk, and copy rules.',
  },
];

const testimonials = [
  {
    name: 'James K.',
    role: 'Professional Trader',
    text: 'Copier transformed my trading. The automation saved me hours daily and my ROI jumped by 38% in the first quarter.',
    rating: 5,
  },
  {
    name: 'Sarah M.',
    role: 'Hedge Fund Manager',
    text: "The copy trading feature is exceptional. I'm running 6 strategies simultaneously with flawless execution.",
    rating: 5,
  },
  {
    name: 'Ahmed R.',
    role: 'Retail Investor',
    text: "As a beginner, Copier's guided setup and clear analytics helped me understand markets while making consistent gains.",
    rating: 5,
  },
  {
    name: 'Linda T.',
    role: 'Forex Specialist',
    text: 'The MetaTrader integration is seamless. My EA runs without interruption and the reporting is world-class.',
    rating: 5,
  },
];

function StatCard({ item, index }: { item: typeof stats[0]; index: number }) {
  const { ref, inView } = useInView({ triggerOnce: true, threshold: 0.3 });
  const Icon = item.icon;
  return (
    <div
      ref={ref}
      className="text-center p-8 rounded-2xl relative overflow-hidden group"
      style={{
        background: 'linear-gradient(135deg, rgba(15,30,53,0.8), rgba(22,40,68,0.8))',
        border: '1px solid rgba(0,212,255,0.12)',
        backdropFilter: 'blur(10px)',
      }}
      data-aos="fade-up"
      data-aos-delay={index * 100}
    >
      <div
        className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
        style={{ background: 'linear-gradient(135deg, rgba(0,212,255,0.05), rgba(30,95,173,0.05))' }}
      />
      <div
        className="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-4"
        style={{ background: 'rgba(0,212,255,0.1)' }}
      >
        <Icon size={22} style={{ color: '#00D4FF' }} />
      </div>
      <div
        className="text-4xl mb-1"
        style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, color: '#00D4FF' }}
      >
        {item.prefix}
        {inView ? <CountUp end={item.end} duration={2.5} separator="," /> : '0'}
        {item.suffix}
      </div>
      <p className="text-sm opacity-60 tracking-wide" style={{ color: '#E2E8F0' }}>{item.label}</p>
    </div>
  );
}

export function Home() {
  const typedRef = useRef<HTMLSpanElement>(null);
  const animeRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!typedRef.current) return;
    const typed = new Typed(typedRef.current, {
      strings: [
        'Algorithmic Trading.',
        'Copy Trading.',
        'Smart Automation.',
        'Consistent Profits.',
        'Portfolio Growth.',
      ],
      typeSpeed: 60,
      backSpeed: 35,
      backDelay: 1800,
      loop: true,
      cursorChar: '|',
    });
    return () => typed.destroy();
  }, []);

  // Anime.js: float the hero ticker cards
  useEffect(() => {
    let anims: Array<{ pause?: () => void }> = [];
    import('animejs').then((mod) => {
      const animate = mod.animate ?? mod.default?.animate ?? mod.default;
      if (!animeRef.current || typeof animate !== 'function') return;
      const cards = animeRef.current.querySelectorAll('.ticker-card');
      cards.forEach((card, i) => {
        const a = animate(card, {
          translateY: ['-6px', '6px'],
          duration: 2200,
          direction: 'alternate',
          loop: true,
          ease: 'inOutSine',
          delay: i * 400,
        });
        if (a) anims.push(a);
      });
    });
    return () => anims.forEach((a) => a.pause?.());
  }, []);

  return (
    <>
      <Helmet>
        <title>Copier — Algorithmic & Copy Trading Platform | Est. 2026</title>
        <meta name="description" content="Copier is a professional algo trading platform offering copy trading, automated strategies, MetaTrader integration, and real-time analytics. Start trading smarter in 2026." />
        <meta name="keywords" content="algo trading, copy trading, algorithmic trading, MetaTrader, forex automation, trading bot, Copier trading platform 2026" />
        <meta property="og:title" content="Copier — Algorithmic & Copy Trading Platform" />
        <meta property="og:description" content="Professional algo trading. Automate, copy, and grow with precision." />
        <meta property="og:image" content={HERO_IMAGE} />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
      </Helmet>

      {/* ── HERO ── */}
      <section className="relative min-h-screen flex items-center overflow-hidden pt-20">
        {/* BG Image */}
        <div className="absolute inset-0">
          <img
            src={HERO_IMAGE}
            alt="Algorithmic trading background"
            className="w-full h-full object-cover"
          />
          <div
            className="absolute inset-0"
            style={{
              background:
                'linear-gradient(135deg, rgba(6,13,26,0.92) 0%, rgba(10,22,40,0.85) 40%, rgba(6,13,26,0.75) 100%)',
            }}
          />
        </div>
        {/* Animated grid */}
        <div
          className="absolute inset-0 opacity-[0.04] pointer-events-none"
          style={{
            backgroundImage:
              'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)',
            backgroundSize: '60px 60px',
          }}
        />
        {/* Glow orbs */}
        <div
          className="absolute top-1/3 right-1/4 w-96 h-96 rounded-full opacity-15 pointer-events-none"
          style={{ background: '#1E5FAD', filter: 'blur(100px)' }}
        />
        <div
          className="absolute bottom-1/4 left-1/4 w-64 h-64 rounded-full opacity-20 pointer-events-none"
          style={{ background: '#00D4FF', filter: 'blur(80px)' }}
        />

        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div className="max-w-2xl">
              <div
                className="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs tracking-widest uppercase mb-6"
                style={{
                  background: 'rgba(0,212,255,0.1)',
                  border: '1px solid rgba(0,212,255,0.25)',
                  color: '#00D4FF',
                }}
                data-aos="fade-down"
              >
                <span className="w-1.5 h-1.5 rounded-full animate-pulse" style={{ background: '#00D4FF' }} />
                Established 2026 — Next-Gen Trading Technology
              </div>

              <h1
                className="mb-6"
                data-aos="fade-up"
                data-aos-delay="100"
                style={{
                  fontFamily: "'Rajdhani', sans-serif",
                  fontWeight: 700,
                  fontSize: 'clamp(2.5rem, 6vw, 5rem)',
                  lineHeight: 1.1,
                  color: '#fff',
                }}
              >
                Trade Smarter
                <br />
                with{' '}
                <span
                  style={{
                    background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)',
                    WebkitBackgroundClip: 'text',
                    WebkitTextFillColor: 'transparent',
                    backgroundClip: 'text',
                  }}
                >
                  <span ref={typedRef} />
                </span>
              </h1>

              <p
                className="text-lg leading-relaxed mb-10 max-w-2xl opacity-75"
                style={{ color: '#E2E8F0' }}
                data-aos="fade-up"
                data-aos-delay="200"
              >
                Copier delivers professional algorithmic trading solutions — copy expert strategies, automate your execution, and grow your portfolio with institutional-grade technology.
              </p>

              <div
                className="flex flex-wrap gap-4"
                data-aos="fade-up"
                data-aos-delay="300"
              >
                <Link
                  to="/services"
                  className="flex items-center gap-2 px-8 py-4 rounded-xl text-sm tracking-wide transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group"
                  style={{
                    background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)',
                    color: '#fff',
                    fontWeight: 600,
                    boxShadow: '0 0 30px rgba(0,212,255,0.3)',
                  }}
                >
                  View Trading Packages
                  <ChevronRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
                </Link>
                <Link
                  to="/catalog"
                  className="flex items-center gap-2 px-8 py-4 rounded-xl text-sm tracking-wide transition-all duration-300 hover:-translate-y-1"
                  style={{
                    background: 'rgba(255,255,255,0.06)',
                    color: '#E2E8F0',
                    fontWeight: 500,
                    border: '1px solid rgba(255,255,255,0.12)',
                    backdropFilter: 'blur(8px)',
                  }}
                >
                  Explore Strategies
                </Link>
              </div>

              {/* Trust badges */}
              <div
                className="flex flex-wrap items-center gap-6 mt-10 pt-10"
                style={{ borderTop: '1px solid rgba(255,255,255,0.08)' }}
                data-aos="fade-up"
                data-aos-delay="400"
              >
                {['MT4 & MT5 Ready', 'ISO Secured', '24/7 Support', 'GDPR Compliant'].map((badge) => (
                  <div
                    key={badge}
                    className="flex items-center gap-2 text-xs opacity-60"
                    style={{ color: '#E2E8F0' }}
                  >
                    <CheckCircle size={13} style={{ color: '#10B981' }} />
                    {badge}
                  </div>
                ))}
              </div>
            </div>

            {/* Animated ticker cards */}
            <div ref={animeRef} className="hidden lg:flex flex-col gap-4 items-end" data-aos="fade-left">
              {[
                { pair: 'EUR/USD', val: '+2.34%', color: '#10B981', dir: '▲' },
                { pair: 'BTC/USDT', val: '+5.12%', color: '#00D4FF', dir: '▲' },
                { pair: 'XAU/USD', val: '-0.87%', color: '#EF4444', dir: '▼' },
                { pair: 'US100', val: '+1.95%', color: '#10B981', dir: '▲' },
              ].map((t, i) => (
                <div
                  key={t.pair}
                  className="ticker-card flex items-center gap-4 px-5 py-3 rounded-xl"
                  style={{
                    background: 'rgba(15,30,53,0.85)',
                    border: '1px solid rgba(0,212,255,0.15)',
                    backdropFilter: 'blur(12px)',
                    minWidth: '200px',
                    marginRight: i % 2 === 0 ? '0' : '2rem',
                  }}
                >
                  <div className="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style={{ background: `${t.color}18` }}>
                    <span style={{ color: t.color, fontSize: '14px' }}>{t.dir}</span>
                  </div>
                  <div className="flex-1">
                    <p className="text-xs" style={{ color: '#fff', fontWeight: 600 }}>{t.pair}</p>
                    <p style={{ color: t.color, fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '0.95rem' }}>{t.val}</p>
                  </div>
                  <div className="flex items-end gap-0.5 h-5">
                    {Array.from({ length: 8 }).map((_, j) => (
                      <div key={j} className="w-1 rounded-t-sm" style={{ height: `${20 + Math.sin(j + i) * 15}px`, background: t.color, opacity: 0.5 }} />
                    ))}
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* Scroll indicator */}
        <div
          className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce opacity-40"
          style={{ color: '#E2E8F0' }}
        >
          <span className="text-xs tracking-widest uppercase">Scroll</span>
          <div
            className="w-px h-8"
            style={{ background: 'linear-gradient(180deg, rgba(255,255,255,0.4), transparent)' }}
          />
        </div>
      </section>

      {/* ── STATS ── */}
      <section
        className="py-16"
        style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-6">
            {stats.map((item, i) => (
              <StatCard key={item.label} item={item} index={i} />
            ))}
          </div>
        </div>
      </section>

      {/* ── FEATURES ── */}
      <section
        className="py-24"
        style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16" data-aos="fade-up">
            <span
              className="text-xs uppercase tracking-[0.3em] mb-3 block"
              style={{ color: '#00D4FF' }}
            >
              Why Choose Copier
            </span>
            <h2
              className="mb-4"
              style={{
                fontFamily: "'Rajdhani', sans-serif",
                fontWeight: 700,
                fontSize: 'clamp(1.8rem, 4vw, 3rem)',
                color: '#fff',
              }}
            >
              Built for{' '}
              <span
                style={{
                  background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)',
                  WebkitBackgroundClip: 'text',
                  WebkitTextFillColor: 'transparent',
                  backgroundClip: 'text',
                }}
              >
                Serious Traders
              </span>
            </h2>
            <p className="max-w-2xl mx-auto opacity-60 text-sm leading-relaxed" style={{ color: '#E2E8F0' }}>
              From retail investors to institutional traders, Copier's platform provides the tools needed to trade algorithmically with confidence.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {features.map((f, i) => {
              const Icon = f.icon;
              return (
                <div
                  key={f.title}
                  className="p-7 rounded-2xl group relative overflow-hidden transition-all duration-500 hover:-translate-y-1"
                  style={{
                    background: 'linear-gradient(135deg, rgba(15,30,53,0.8), rgba(22,40,68,0.6))',
                    border: '1px solid rgba(0,212,255,0.1)',
                  }}
                  data-aos="fade-up"
                  data-aos-delay={i * 80}
                >
                  <div
                    className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    style={{ background: 'linear-gradient(135deg, rgba(0,212,255,0.05), transparent)' }}
                  />
                  <div
                    className="w-12 h-12 rounded-xl flex items-center justify-center mb-5 transition-transform duration-300 group-hover:scale-110"
                    style={{ background: 'linear-gradient(135deg, rgba(30,95,173,0.3), rgba(0,212,255,0.2))' }}
                  >
                    <Icon size={22} style={{ color: '#00D4FF' }} />
                  </div>
                  <h3
                    className="mb-3 text-base"
                    style={{ color: '#fff', fontWeight: 600 }}
                  >
                    {f.title}
                  </h3>
                  <p className="text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
                    {f.desc}
                  </p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── DASHBOARD SHOWCASE ── */}
      <section
        className="py-24"
        style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
              <span
                className="text-xs uppercase tracking-[0.3em] mb-3 block"
                style={{ color: '#00D4FF' }}
              >
                Platform Overview
              </span>
              <h2
                className="mb-5"
                style={{
                  fontFamily: "'Rajdhani', sans-serif",
                  fontWeight: 700,
                  fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)',
                  color: '#fff',
                  lineHeight: 1.2,
                }}
              >
                Real-Time Analytics{' '}
                <span
                  style={{
                    background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)',
                    WebkitBackgroundClip: 'text',
                    WebkitTextFillColor: 'transparent',
                    backgroundClip: 'text',
                  }}
                >
                  at Your Command
                </span>
              </h2>
              <p className="opacity-60 text-sm leading-relaxed mb-8" style={{ color: '#E2E8F0' }}>
                Monitor live positions, P&L curves, drawdown metrics, and strategy performance — all in one intuitive dashboard designed for speed and clarity.
              </p>
              <ul className="space-y-4 mb-8">
                {[
                  'Live trade execution monitoring',
                  'Multi-account portfolio view',
                  'Historical backtesting reports',
                  'Instant alert notifications',
                ].map((item) => (
                  <li key={item} className="flex items-center gap-3 text-sm opacity-70" style={{ color: '#E2E8F0' }}>
                    <span
                      className="w-5 h-5 rounded-full flex items-center justify-center shrink-0"
                      style={{ background: 'rgba(16,185,129,0.15)' }}
                    >
                      <CheckCircle size={12} style={{ color: '#10B981' }} />
                    </span>
                    {item}
                  </li>
                ))}
              </ul>
              <Link
                to="/trading"
                className="inline-flex items-center gap-2 text-sm group"
                style={{ color: '#00D4FF', fontWeight: 600 }}
              >
                Explore Trading Tools
                <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
              </Link>
            </div>

            <div className="relative" data-aos="fade-left">
              <div
                className="absolute -inset-4 rounded-3xl opacity-30"
                style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', filter: 'blur(20px)' }}
              />
              <div
                className="relative rounded-2xl overflow-hidden"
                style={{ border: '1px solid rgba(0,212,255,0.2)' }}
              >
                <img
                  src={DASH_IMAGE}
                  alt="Trading analytics dashboard"
                  className="w-full h-80 object-cover"
                />
                <div
                  className="absolute inset-0"
                  style={{ background: 'linear-gradient(180deg, transparent 40%, rgba(6,13,26,0.8) 100%)' }}
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── TESTIMONIALS ── */}
      <section
        className="py-24"
        style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12" data-aos="fade-up">
            <span
              className="text-xs uppercase tracking-[0.3em] mb-3 block"
              style={{ color: '#00D4FF' }}
            >
              Testimonials
            </span>
            <h2
              style={{
                fontFamily: "'Rajdhani', sans-serif",
                fontWeight: 700,
                fontSize: 'clamp(1.8rem, 4vw, 3rem)',
                color: '#fff',
              }}
            >
              What Our Traders Say
            </h2>
          </div>

          <div data-aos="fade-up" data-aos-delay="100">
            <Swiper
              modules={[Autoplay, Pagination]}
              autoplay={{ delay: 4000, disableOnInteraction: false }}
              pagination={{ clickable: true }}
              spaceBetween={24}
              slidesPerView={1}
              breakpoints={{ 640: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }}
            >
              {testimonials.map((t) => (
                <SwiperSlide key={t.name} style={{ paddingBottom: '40px' }}>
                  <div
                    className="p-7 rounded-2xl h-full"
                    style={{
                      background: 'linear-gradient(135deg, rgba(15,30,53,0.9), rgba(22,40,68,0.7))',
                      border: '1px solid rgba(0,212,255,0.1)',
                    }}
                  >
                    <div className="flex gap-1 mb-4">
                      {Array.from({ length: t.rating }).map((_, i) => (
                        <Star key={i} size={14} fill="#F59E0B" style={{ color: '#F59E0B' }} />
                      ))}
                    </div>
                    <p
                      className="text-sm leading-relaxed mb-5 opacity-70 italic"
                      style={{ color: '#E2E8F0' }}
                    >
                      "{t.text}"
                    </p>
                    <div className="flex items-center gap-3">
                      <div
                        className="w-9 h-9 rounded-full flex items-center justify-center text-xs"
                        style={{
                          background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)',
                          color: '#fff',
                          fontWeight: 700,
                        }}
                      >
                        {t.name[0]}
                      </div>
                      <div>
                        <p className="text-sm" style={{ color: '#fff', fontWeight: 600 }}>{t.name}</p>
                        <p className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>{t.role}</p>
                      </div>
                    </div>
                  </div>
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        </div>
      </section>

      {/* ── CTA ── */}
      <section
        className="py-24 relative overflow-hidden"
        style={{ background: 'linear-gradient(135deg, #0A1628 0%, #0F1E35 100%)' }}
      >
        <div
          className="absolute inset-0 opacity-[0.04] pointer-events-none"
          style={{
            backgroundImage:
              'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)',
            backgroundSize: '40px 40px',
          }}
        />
        <div
          className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] rounded-full opacity-20 pointer-events-none"
          style={{ background: '#1E5FAD', filter: 'blur(80px)' }}
        />
        <div className="relative max-w-3xl mx-auto px-4 text-center" data-aos="zoom-in">
          <h2
            className="mb-5"
            style={{
              fontFamily: "'Rajdhani', sans-serif",
              fontWeight: 700,
              fontSize: 'clamp(2rem, 4vw, 3.5rem)',
              color: '#fff',
            }}
          >
            Ready to Trade Like a{' '}
            <span
              style={{
                background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)',
                WebkitBackgroundClip: 'text',
                WebkitTextFillColor: 'transparent',
                backgroundClip: 'text',
              }}
            >
              Professional?
            </span>
          </h2>
          <p className="text-sm leading-relaxed mb-8 opacity-60" style={{ color: '#E2E8F0' }}>
            Join 12,400+ traders worldwide using Copier to automate, copy, and grow their trading portfolios with confidence.
          </p>
          <div className="flex flex-wrap gap-4 justify-center">
            <Link
              to="/services"
              className="px-10 py-4 rounded-xl text-sm tracking-wide transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
              style={{
                background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)',
                color: '#fff',
                fontWeight: 700,
                boxShadow: '0 0 40px rgba(0,212,255,0.35)',
              }}
            >
              Start Trading Now
            </Link>
            <Link
              to="/help"
              className="px-10 py-4 rounded-xl text-sm tracking-wide transition-all duration-300 hover:-translate-y-1"
              style={{
                background: 'rgba(255,255,255,0.05)',
                color: '#E2E8F0',
                border: '1px solid rgba(255,255,255,0.12)',
                fontWeight: 500,
              }}
            >
              Learn More
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}