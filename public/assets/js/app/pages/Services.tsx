import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import { CheckCircle, Star, Zap, Shield, TrendingUp, ArrowRight, Crown } from 'lucide-react';

const packages = [
  {
    name: 'Starter',
    price: '$49',
    period: '/month',
    badge: null,
    color: '#1E5FAD',
    desc: 'Perfect for beginners discovering algorithmic trading.',
    features: [
      '1 Trading Account',
      'Up to 3 Copy Strategies',
      'Basic Analytics Dashboard',
      'Email Support',
      'MT4 / MT5 Integration',
      'Risk Score Alerts',
      '5 Trades/Minute',
    ],
    notIncluded: ['AI Strategy Builder', 'Priority Execution', 'API Access', 'Dedicated Manager'],
  },
  {
    name: 'Professional',
    price: '$149',
    period: '/month',
    badge: 'Most Popular',
    color: '#00D4FF',
    desc: 'Designed for active traders who demand performance.',
    features: [
      '5 Trading Accounts',
      'Unlimited Copy Strategies',
      'Advanced Analytics & Reports',
      '24/7 Priority Support',
      'MT4 / MT5 Integration',
      'AI Strategy Builder',
      '50 Trades/Minute',
      'API Access',
      'Real-time Notifications',
    ],
    notIncluded: ['Dedicated Account Manager', 'White-label Option'],
  },
  {
    name: 'Enterprise',
    price: '$399',
    period: '/month',
    badge: 'Best Value',
    color: '#F59E0B',
    desc: 'Full institutional-grade access for serious traders and funds.',
    features: [
      'Unlimited Trading Accounts',
      'Unlimited Copy Strategies',
      'Custom Strategy Development',
      'Dedicated Account Manager',
      'MT4 / MT5 Integration',
      'Full API Access',
      'Unlimited Trades/Minute',
      'White-label Option',
      'Backtesting Engine',
      'Priority Co-location',
      'Custom Risk Profiles',
    ],
    notIncluded: [],
  },
];

const addons = [
  { icon: TrendingUp, title: 'VPS Trading Server', price: '$19/mo', desc: 'Ultra-low latency server near major exchanges.' },
  { icon: Zap, title: 'Signal Alerts Pack', price: '$29/mo', desc: '200+ daily signals across Forex, Crypto & Indices.' },
  { icon: Shield, title: 'Extended Backtest', price: '$39/mo', desc: '20 years of historical data with tick-by-tick accuracy.' },
  { icon: Star, title: 'Strategy Marketplace', price: 'Free', desc: 'Access 500+ community-built trading strategies.' },
];

export function Services() {
  return (
    <>
      <Helmet>
        <title>Trading Packages & Pricing — Copier Algo Trading</title>
        <meta name="description" content="Choose the perfect algorithmic trading package. Starter, Professional, and Enterprise plans with copy trading, AI strategies, and MT4/MT5 integration." />
        <meta name="keywords" content="algo trading packages, copy trading pricing, trading subscription plans, MetaTrader integration cost" />
        <meta property="og:title" content="Copier Trading Packages & Pricing" />
        <meta property="og:description" content="From Starter to Enterprise — find your perfect algo trading package." />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
          <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Pricing & Plans</span>
          <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1 }}>
            Choose Your{' '}
            <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
              Trading Plan
            </span>
          </h1>
          <p className="mt-4 max-w-2xl mx-auto text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
            All plans include core automation features. Upgrade or downgrade at any time. 14-day free trial available.
          </p>
        </div>
      </section>

      {/* Packages */}
      <section className="py-16" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            {packages.map((pkg, i) => (
              <div
                key={pkg.name}
                className="relative rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2"
                style={{
                  background: pkg.badge === 'Most Popular'
                    ? 'linear-gradient(180deg, rgba(0,100,130,0.3), rgba(0,212,255,0.05))'
                    : 'rgba(15,30,53,0.8)',
                  border: `1px solid ${pkg.badge === 'Most Popular' ? 'rgba(0,212,255,0.4)' : 'rgba(0,212,255,0.1)'}`,
                  boxShadow: pkg.badge === 'Most Popular' ? '0 0 40px rgba(0,212,255,0.15)' : 'none',
                }}
                data-aos="fade-up"
                data-aos-delay={i * 120}
              >
                {pkg.badge && (
                  <div className="absolute top-0 left-0 right-0 py-2 text-center text-xs tracking-widest uppercase" style={{ background: `linear-gradient(90deg, #1E5FAD, #00D4FF)`, color: '#fff', fontWeight: 700 }}>
                    {pkg.badge === 'Most Popular' ? '⭐ ' : '👑 '}{pkg.badge}
                  </div>
                )}
                <div className={`p-8 ${pkg.badge ? 'pt-14' : ''}`}>
                  <h3 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1.5rem', color: '#fff', marginBottom: '0.5rem' }}>{pkg.name}</h3>
                  <p className="text-xs opacity-55 mb-5" style={{ color: '#E2E8F0' }}>{pkg.desc}</p>
                  <div className="flex items-end gap-1 mb-6">
                    <span style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '3rem', color: pkg.color }}>{pkg.price}</span>
                    <span className="text-sm opacity-50 mb-2" style={{ color: '#E2E8F0' }}>{pkg.period}</span>
                  </div>
                  <Link
                    to="/help"
                    className="block w-full py-3 rounded-xl text-sm text-center transition-all duration-300 hover:-translate-y-0.5 mb-7"
                    style={pkg.badge === 'Most Popular'
                      ? { background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 700 }
                      : { background: 'rgba(255,255,255,0.06)', color: '#E2E8F0', border: `1px solid ${pkg.color}40`, fontWeight: 600 }
                    }
                  >
                    Get Started
                  </Link>
                  <div className="space-y-3 mb-5">
                    {pkg.features.map((f) => (
                      <div key={f} className="flex items-center gap-2.5 text-sm" style={{ color: '#E2E8F0' }}>
                        <CheckCircle size={14} style={{ color: '#10B981', flexShrink: 0 }} />
                        {f}
                      </div>
                    ))}
                  </div>
                  {pkg.notIncluded.length > 0 && (
                    <div className="space-y-3 opacity-30">
                      {pkg.notIncluded.map((f) => (
                        <div key={f} className="flex items-center gap-2.5 text-sm line-through" style={{ color: '#E2E8F0' }}>
                          <span className="w-3.5 h-3.5 rounded-full border shrink-0" style={{ borderColor: '#E2E8F0' }} />
                          {f}
                        </div>
                      ))}
                    </div>
                  )}
                </div>
              </div>
            ))}
          </div>

          <p className="text-center text-xs opacity-40 mt-8" style={{ color: '#E2E8F0' }}>
            All prices in USD. Cancel anytime. No hidden fees. Risk Disclosure applies.
          </p>
        </div>
      </section>

      {/* Add-ons */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Add-Ons</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 3vw, 2.5rem)', color: '#fff' }}>Supercharge Your Plan</h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {addons.map((a, i) => {
              const Icon = a.icon;
              return (
                <div key={a.title} className="p-6 rounded-2xl group hover:-translate-y-1 transition-all duration-300" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 80}>
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style={{ background: 'rgba(0,212,255,0.1)' }}>
                    <Icon size={18} style={{ color: '#00D4FF' }} />
                  </div>
                  <div className="flex items-start justify-between mb-2">
                    <h3 className="text-sm" style={{ color: '#fff', fontWeight: 600 }}>{a.title}</h3>
                    <span className="text-xs px-2 py-0.5 rounded-full" style={{ background: 'rgba(0,212,255,0.15)', color: '#00D4FF', fontWeight: 600 }}>{a.price}</span>
                  </div>
                  <p className="text-xs opacity-55 leading-relaxed" style={{ color: '#E2E8F0' }}>{a.desc}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* FAQ Mini */}
      <section className="py-16" style={{ background: '#060D1A', borderTop: '1px solid rgba(0,212,255,0.08)' }}>
        <div className="max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '2rem', color: '#fff', marginBottom: '1rem' }}>Have Questions?</h2>
          <p className="text-sm opacity-60 mb-6" style={{ color: '#E2E8F0' }}>Our support team is available 24/7 to help you choose the right plan.</p>
          <div className="flex flex-wrap gap-4 justify-center">
            <Link to="/help" className="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm group" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 600 }}>
              Visit Help Center <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
            </Link>
            <Link to="/about" className="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm" style={{ background: 'rgba(255,255,255,0.05)', color: '#E2E8F0', border: '1px solid rgba(255,255,255,0.1)' }}>
              Learn More
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
