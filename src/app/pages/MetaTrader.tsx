import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import { ArrowRight, CheckCircle, Download, Monitor, Settings, Shield, Zap } from 'lucide-react';

const MT_IMAGE = 'https://images.unsplash.com/photo-1634836466795-2b71a032821c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtZXRhdHJhZGVyJTIwZm9yZXglMjB0ZXJtaW5hbCUyMHNjcmVlbnN8ZW58MXx8fHwxNzcxOTMzNzExfDA&ixlib=rb-4.1.0&q=80&w=1080';
const DASH_IMAGE = 'https://images.unsplash.com/photo-1748609160056-7b95f30041f0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';

const mt4Features = [
  'Expert Advisors (EA) Support',
  'Custom Indicators Library',
  'Strategy Tester',
  'Multi-currency Charts',
  '9 Timeframes',
  'One-Click Trading',
  'Market Alerts',
];

const mt5Features = [
  'All MT4 Features Included',
  '21 Timeframes',
  'Economic Calendar Built-in',
  'Depth of Market (DOM)',
  'Python & C# Integration',
  'Hedging & Netting',
  'Stock & Futures Support',
  'Advanced Pending Orders',
];

const integrationSteps = [
  {
    step: '01',
    title: 'Download MetaTrader',
    desc: 'Download MT4 or MT5 from your broker or MetaQuotes. Both platforms are fully supported by Copier.',
    icon: Download,
  },
  {
    step: '02',
    title: 'Install Copier EA',
    desc: 'Copy our Expert Advisor (.ex4 or .ex5 file) into your MT4/MT5 Experts folder and restart the terminal.',
    icon: Settings,
  },
  {
    step: '03',
    title: 'Configure Connection',
    desc: 'Enter your Copier API key in the EA settings. Enable AutoTrading and configure your risk parameters.',
    icon: Shield,
  },
  {
    step: '04',
    title: 'Start Copying',
    desc: 'Go live! Your MetaTrader will now receive and execute trades from your selected Copier strategies.',
    icon: Zap,
  },
];

const faqs = [
  { q: 'Does Copier work with any broker?', a: "Yes, Copier works with any broker that supports MT4 or MT5. We've tested with 50+ brokers worldwide." },
  { q: 'Can I run multiple EAs simultaneously?', a: 'Absolutely. The Copier EA can run alongside other EAs on your terminal without conflict.' },
  { q: 'What happens if my internet goes down?', a: 'Our cloud execution ensures trades are placed even if your connection drops. VPS hosting is recommended for 24/7 operation.' },
  { q: 'Is there a latency difference between MT4 and MT5?', a: 'MT5 generally offers marginally better execution on modern systems. Both are fully supported and optimized.' },
];

export function MetaTrader() {
  return (
    <>
      <Helmet>
        <title>MetaTrader Integration — MT4 & MT5 Copier Platform</title>
        <meta name="description" content="Seamlessly integrate Copier's algorithmic trading with MetaTrader 4 and 5. Install our Expert Advisor, copy strategies automatically, and trade with precision." />
        <meta name="keywords" content="MetaTrader 4, MetaTrader 5, MT4 EA, MT5 Expert Advisor, algo trading MT4, forex automation MetaTrader" />
        <meta property="og:title" content="Copier MetaTrader MT4 & MT5 Integration" />
        <meta property="og:description" content="Full MT4 and MT5 support for automated copy trading and algo execution." />
        <meta property="og:image" content={MT_IMAGE} />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="absolute top-0 right-1/3 w-96 h-96 rounded-full opacity-10 pointer-events-none" style={{ background: '#1E5FAD', filter: 'blur(100px)' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>MetaTrader</span>
              <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1, marginBottom: '1.25rem' }}>
                Full MT4 & MT5{' '}
                <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
                  Integration
                </span>
              </h1>
              <p className="text-sm leading-relaxed opacity-60 mb-8" style={{ color: '#E2E8F0' }}>
                Plug Copier directly into the world's most popular trading platforms. Our Expert Advisor bridges your MetaTrader terminal with our cloud engine for seamless automated execution.
              </p>
              <div className="flex flex-wrap gap-4">
                <Link to="/help" className="flex items-center gap-2 px-7 py-3 rounded-xl text-sm group" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 600 }}>
                  Download MT4 EA <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
                </Link>
                <Link to="/help" className="flex items-center gap-2 px-7 py-3 rounded-xl text-sm" style={{ background: 'rgba(255,255,255,0.05)', color: '#E2E8F0', border: '1px solid rgba(0,212,255,0.2)' }}>
                  Download MT5 EA
                </Link>
              </div>
            </div>
            <div className="relative">
              <div className="absolute -inset-4 rounded-3xl opacity-25" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', filter: 'blur(24px)' }} />
              <div className="relative rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.25)' }}>
                <img src={MT_IMAGE} alt="MetaTrader platform" className="w-full h-80 object-cover" />
                <div className="absolute inset-0" style={{ background: 'linear-gradient(180deg, transparent 40%, rgba(6,13,26,0.7) 100%)' }} />
                <div className="absolute top-4 left-4 flex gap-2">
                  {['MT4 Ready', 'MT5 Ready'].map((b) => (
                    <span key={b} className="px-3 py-1 rounded-full text-xs" style={{ background: 'rgba(0,212,255,0.15)', border: '1px solid rgba(0,212,255,0.3)', color: '#00D4FF', fontWeight: 600 }}>{b}</span>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Platform Comparison */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Platform Comparison</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>MT4 vs MT5 — Which to Choose?</h2>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {/* MT4 */}
            <div className="p-8 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(30,95,173,0.3)' }} data-aos="fade-right">
              <div className="flex items-center gap-3 mb-6">
                <div className="w-12 h-12 rounded-xl flex items-center justify-center text-sm" style={{ background: 'linear-gradient(135deg, #1E5FAD, #2D7DD2)', color: '#fff', fontFamily: "'Rajdhani', sans-serif", fontWeight: 700 }}>MT4</div>
                <div>
                  <h3 className="text-base" style={{ color: '#fff', fontWeight: 700 }}>MetaTrader 4</h3>
                  <p className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>Industry standard since 2005</p>
                </div>
              </div>
              <p className="text-sm opacity-60 leading-relaxed mb-6" style={{ color: '#E2E8F0' }}>
                The world's most trusted Forex trading platform. Ideal for currency trading with a massive EA library and community.
              </p>
              <ul className="space-y-3">
                {mt4Features.map((f) => (
                  <li key={f} className="flex items-center gap-2.5 text-sm opacity-80" style={{ color: '#E2E8F0' }}>
                    <CheckCircle size={14} style={{ color: '#1E5FAD', flexShrink: 0 }} />
                    {f}
                  </li>
                ))}
              </ul>
              <div className="mt-6 p-3 rounded-xl text-center text-sm" style={{ background: 'rgba(30,95,173,0.1)', color: '#2D7DD2', fontWeight: 600 }}>
                Best for: Forex & CFD Traders
              </div>
            </div>
            {/* MT5 */}
            <div className="p-8 rounded-2xl relative overflow-hidden" style={{ background: 'linear-gradient(180deg, rgba(0,100,130,0.2), rgba(0,212,255,0.05))', border: '1px solid rgba(0,212,255,0.3)' }} data-aos="fade-left">
              <div className="absolute top-0 right-0 px-4 py-1 text-xs" style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 700 }}>Recommended</div>
              <div className="flex items-center gap-3 mb-6 mt-3">
                <div className="w-12 h-12 rounded-xl flex items-center justify-center text-sm" style={{ background: 'linear-gradient(135deg, #00A8CC, #00D4FF)', color: '#fff', fontFamily: "'Rajdhani', sans-serif", fontWeight: 700 }}>MT5</div>
                <div>
                  <h3 className="text-base" style={{ color: '#fff', fontWeight: 700 }}>MetaTrader 5</h3>
                  <p className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>Next-generation multi-asset platform</p>
                </div>
              </div>
              <p className="text-sm opacity-60 leading-relaxed mb-6" style={{ color: '#E2E8F0' }}>
                The evolved successor with multi-asset support, deeper analytics, and modern architecture for stocks, futures, and Forex.
              </p>
              <ul className="space-y-3">
                {mt5Features.map((f) => (
                  <li key={f} className="flex items-center gap-2.5 text-sm opacity-80" style={{ color: '#E2E8F0' }}>
                    <CheckCircle size={14} style={{ color: '#00D4FF', flexShrink: 0 }} />
                    {f}
                  </li>
                ))}
              </ul>
              <div className="mt-6 p-3 rounded-xl text-center text-sm" style={{ background: 'rgba(0,212,255,0.1)', color: '#00D4FF', fontWeight: 600 }}>
                Best for: Multi-Asset & Advanced Traders
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Integration Steps */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Setup Guide</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Connect in Under 5 Minutes
            </h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {integrationSteps.map((step, i) => {
              const Icon = step.icon;
              return (
                <div key={step.step} className="relative p-7 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                  <div className="flex items-center gap-3 mb-5">
                    <div className="w-10 h-10 rounded-xl flex items-center justify-center" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)' }}>
                      <Icon size={18} color="#fff" />
                    </div>
                    <span style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '2rem', color: 'rgba(0,212,255,0.2)' }}>{step.step}</span>
                  </div>
                  <h3 className="text-base mb-2" style={{ color: '#fff', fontWeight: 600 }}>{step.title}</h3>
                  <p className="text-sm opacity-55 leading-relaxed" style={{ color: '#E2E8F0' }}>{step.desc}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* FAQs */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>FAQs</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Common Questions
            </h2>
          </div>
          <div className="space-y-4">
            {faqs.map((faq, i) => (
              <div key={faq.q} className="p-6 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 80}>
                <h3 className="text-sm mb-3" style={{ color: '#00D4FF', fontWeight: 600 }}>{faq.q}</h3>
                <p className="text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>{faq.a}</p>
              </div>
            ))}
          </div>
          <div className="text-center mt-10" data-aos="fade-up">
            <Link to="/help" className="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm group" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 600 }}>
              Visit Full Help Center <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
