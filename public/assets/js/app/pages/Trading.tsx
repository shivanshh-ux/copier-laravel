import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import { Activity, ArrowRight, CheckCircle, Clock, Cpu, Globe, TrendingUp, Zap } from 'lucide-react';

const TRADING_IMAGE = 'https://images.unsplash.com/photo-1767424196045-030bbde122a4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx0cmFkaW5nJTIwcGxhdGZvcm0lMjBmb3JleCUyMGNoYXJ0c3xlbnwxfHx8fDE3NzE5MzM3MTB8MA&ixlib=rb-4.1.0&q=80&w=1080';
const SERVER_IMAGE = 'https://images.unsplash.com/photo-1663932210347-164a05ed0ccd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';

const tradingSteps = [
  { step: '01', title: 'Connect Your Broker', desc: 'Link your MT4/MT5 account or supported broker API in under 2 minutes.' },
  { step: '02', title: 'Select Strategy', desc: 'Browse the catalog and select 1 or more strategies matching your risk profile.' },
  { step: '03', title: 'Set Parameters', desc: 'Configure lot size, max drawdown, daily loss limits, and trading hours.' },
  { step: '04', title: 'Go Live', desc: 'Activate automation and monitor real-time performance from your dashboard.' },
];

const markets = [
  { name: 'Forex', pairs: '100+', icon: Globe, desc: 'Major, minor, and exotic currency pairs with tight spreads.' },
  { name: 'Crypto', pairs: '50+', icon: TrendingUp, desc: 'BTC, ETH, ADA, and 47 more digital assets.' },
  { name: 'Stocks', pairs: '500+', icon: Activity, desc: 'US, EU, and Asian equities with algorithmic precision.' },
  { name: 'Indices', pairs: '30+', icon: BarChart2, desc: 'DAX, S&P 500, NASDAQ, and global index CFDs.' },
  { name: 'Commodities', pairs: '20+', icon: Zap, desc: 'Gold, Silver, Oil, Natural Gas, and agricultural commodities.' },
  { name: 'Options', pairs: '1000+', icon: Cpu, desc: 'Listed options with strategy builders and Greeks management.' },
];

function BarChart2({ size = 24, style = {}, className = '' }: { size?: number; style?: React.CSSProperties; className?: string }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={size}
      height={size}
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
      style={style}
      className={className}
    >
      <line x1="18" y1="20" x2="18" y2="10" />
      <line x1="12" y1="20" x2="12" y2="4" />
      <line x1="6" y1="20" x2="6" y2="14" />
    </svg>
  );
}

const liveSignals = [
  { pair: 'EUR/USD', signal: 'BUY', price: '1.08234', tp: '1.08650', sl: '1.07890', confidence: 87, time: '2m ago' },
  { pair: 'BTC/USDT', signal: 'SELL', price: '67,420', tp: '65,800', sl: '68,500', confidence: 74, time: '5m ago' },
  { pair: 'XAU/USD', signal: 'BUY', price: '2,341.50', tp: '2,368.00', sl: '2,320.00', confidence: 91, time: '8m ago' },
  { pair: 'GBP/JPY', signal: 'BUY', price: '192.340', tp: '193.800', sl: '191.200', confidence: 82, time: '11m ago' },
  { pair: 'US100', signal: 'SELL', price: '19,845', tp: '19,400', sl: '20,100', confidence: 78, time: '15m ago' },
];

export function Trading() {
  return (
    <>
      <Helmet>
        <title>Live Trading — Copier Automated Trading Platform</title>
        <meta name="description" content="Explore Copier's live trading capabilities. Automated execution across Forex, Crypto, Stocks, Indices, and Commodities with real-time signals and AI-driven insights." />
        <meta name="keywords" content="live trading, automated trading, forex signals, crypto signals, trading automation platform 2026" />
        <meta property="og:title" content="Copier Live Trading Platform" />
        <meta property="og:description" content="Trade smarter with AI-powered automation across 700+ instruments." />
        <meta property="og:image" content={TRADING_IMAGE} />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="absolute top-1/2 left-0 w-96 h-96 rounded-full opacity-10 pointer-events-none" style={{ background: '#1E5FAD', filter: 'blur(100px)' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
          <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs tracking-widest uppercase mb-6" style={{ background: 'rgba(16,185,129,0.1)', border: '1px solid rgba(16,185,129,0.25)', color: '#10B981' }}>
            <span className="w-1.5 h-1.5 rounded-full animate-pulse" style={{ background: '#10B981' }} />
            Markets Open — Live Trading Active
          </div>
          <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1 }}>
            Automated Trading,{' '}
            <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
              24/7 Execution
            </span>
          </h1>
          <p className="mt-4 max-w-2xl mx-auto text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
            Our trading engine monitors 700+ instruments simultaneously, executing in under 10ms with zero emotional bias.
          </p>
        </div>
      </section>

      {/* Live Signals Panel */}
      <section className="py-16" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between mb-8" data-aos="fade-up">
            <div>
              <span className="text-xs uppercase tracking-[0.3em] block mb-1" style={{ color: '#00D4FF' }}>Live Feed</span>
              <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.5rem, 3vw, 2rem)', color: '#fff' }}>Recent Trading Signals</h2>
            </div>
            <div className="flex items-center gap-2 text-xs" style={{ color: '#10B981' }}>
              <span className="w-2 h-2 rounded-full animate-pulse" style={{ background: '#10B981' }} />
              Live Feed
            </div>
          </div>
          <div className="rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.12)' }}>
            {/* Table header */}
            <div className="grid grid-cols-6 gap-4 px-6 py-3 text-xs uppercase tracking-widest opacity-40" style={{ background: 'rgba(0,0,0,0.3)', color: '#E2E8F0' }}>
              <span>Instrument</span>
              <span>Signal</span>
              <span>Entry Price</span>
              <span>Take Profit</span>
              <span>Stop Loss</span>
              <span>Confidence</span>
            </div>
            {liveSignals.map((signal, i) => (
              <div
                key={signal.pair}
                className="grid grid-cols-6 gap-4 px-6 py-4 items-center transition-all duration-300 hover:bg-white/[0.02]"
                style={{ borderTop: i > 0 ? '1px solid rgba(0,212,255,0.06)' : 'none' }}
                data-aos="fade-up"
                data-aos-delay={i * 60}
              >
                <div>
                  <p className="text-sm" style={{ color: '#fff', fontWeight: 600 }}>{signal.pair}</p>
                  <p className="text-xs opacity-40" style={{ color: '#E2E8F0' }}>{signal.time}</p>
                </div>
                <span
                  className="text-xs px-3 py-1 rounded-full w-fit"
                  style={{
                    background: signal.signal === 'BUY' ? 'rgba(16,185,129,0.15)' : 'rgba(239,68,68,0.15)',
                    color: signal.signal === 'BUY' ? '#10B981' : '#EF4444',
                    fontWeight: 700,
                  }}
                >
                  {signal.signal}
                </span>
                <span className="text-sm" style={{ color: '#E2E8F0' }}>{signal.price}</span>
                <span className="text-sm" style={{ color: '#10B981' }}>{signal.tp}</span>
                <span className="text-sm" style={{ color: '#EF4444' }}>{signal.sl}</span>
                <div className="flex items-center gap-2">
                  <div className="flex-1 h-1.5 rounded-full overflow-hidden" style={{ background: 'rgba(255,255,255,0.1)' }}>
                    <div
                      className="h-full rounded-full"
                      style={{
                        width: `${signal.confidence}%`,
                        background: signal.confidence > 85 ? '#10B981' : signal.confidence > 75 ? '#F59E0B' : '#EF4444',
                      }}
                    />
                  </div>
                  <span className="text-xs" style={{ color: '#E2E8F0' }}>{signal.confidence}%</span>
                </div>
              </div>
            ))}
          </div>
          <p className="text-xs opacity-30 mt-3 text-center" style={{ color: '#E2E8F0' }}>
            * Signals shown are for informational purposes only and do not constitute financial advice.
          </p>
        </div>
      </section>

      {/* How It Works */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Process</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Trading in 4 Simple Steps
            </h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {tradingSteps.map((step, i) => (
              <div key={step.step} className="relative p-7 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                {i < tradingSteps.length - 1 && (
                  <div className="hidden lg:block absolute top-1/3 -right-3 w-6 z-10">
                    <ArrowRight size={20} style={{ color: 'rgba(0,212,255,0.3)' }} />
                  </div>
                )}
                <div className="text-4xl mb-4 opacity-15" style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, color: '#00D4FF' }}>
                  {step.step}
                </div>
                <div className="w-px h-8 mb-4" style={{ background: 'linear-gradient(180deg, #00D4FF, transparent)' }} />
                <h3 className="text-base mb-2" style={{ color: '#fff', fontWeight: 600 }}>{step.title}</h3>
                <p className="text-sm opacity-55 leading-relaxed" style={{ color: '#E2E8F0' }}>{step.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Markets */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
              <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Markets</span>
              <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', color: '#fff', marginBottom: '1.25rem' }}>
                Trade Every Market from One Platform
              </h2>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {markets.map((m, i) => {
                  const Icon = m.icon;
                  return (
                    <div key={m.name} className="p-5 rounded-xl group hover:scale-105 transition-all duration-300" style={{ background: 'rgba(15,30,53,0.6)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 80}>
                      <div className="flex items-center gap-3 mb-2">
                        <Icon size={16} style={{ color: '#00D4FF' }} />
                        <span className="text-sm" style={{ color: '#fff', fontWeight: 600 }}>{m.name}</span>
                        <span className="ml-auto text-xs px-2 py-0.5 rounded-full" style={{ background: 'rgba(0,212,255,0.1)', color: '#00D4FF' }}>{m.pairs}</span>
                      </div>
                      <p className="text-xs opacity-50 leading-relaxed" style={{ color: '#E2E8F0' }}>{m.desc}</p>
                    </div>
                  );
                })}
              </div>
            </div>
            <div className="relative" data-aos="fade-left">
              <div className="absolute -inset-4 rounded-3xl opacity-20" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', filter: 'blur(20px)' }} />
              <div className="relative rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.2)' }}>
                <img src={TRADING_IMAGE} alt="Trading platform" className="w-full h-80 object-cover" />
                <div className="absolute inset-0" style={{ background: 'linear-gradient(180deg, transparent 50%, rgba(6,13,26,0.8) 100%)' }} />
                {/* Overlay stats */}
                <div className="absolute bottom-6 left-6 right-6 grid grid-cols-3 gap-3">
                  {[{ v: '<10ms', l: 'Execution' }, { v: '99.9%', l: 'Uptime' }, { v: '700+', l: 'Instruments' }].map((s) => (
                    <div key={s.l} className="text-center p-3 rounded-xl" style={{ background: 'rgba(6,13,26,0.8)', backdropFilter: 'blur(8px)', border: '1px solid rgba(0,212,255,0.15)' }}>
                      <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, color: '#00D4FF' }}>{s.v}</p>
                      <p className="text-[10px] opacity-50" style={{ color: '#E2E8F0' }}>{s.l}</p>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Infrastructure */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div className="relative order-2 lg:order-1" data-aos="fade-right">
              <div className="absolute -inset-4 rounded-3xl opacity-15" style={{ background: '#1E5FAD', filter: 'blur(30px)' }} />
              <img src={SERVER_IMAGE} alt="Server infrastructure" className="relative rounded-2xl w-full h-72 object-cover" style={{ border: '1px solid rgba(0,212,255,0.15)' }} />
            </div>
            <div className="order-1 lg:order-2" data-aos="fade-left">
              <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Infrastructure</span>
              <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 3.5vw, 2.8rem)', color: '#fff', marginBottom: '1.25rem' }}>
                Enterprise-Grade Infrastructure
              </h2>
              <p className="text-sm leading-relaxed opacity-60 mb-6" style={{ color: '#E2E8F0' }}>
                Our co-located servers sit metres from exchange matching engines, delivering execution speeds that retail platforms can't match.
              </p>
              <ul className="space-y-3">
                {[
                  { icon: Clock, text: 'Sub-10ms order execution via FIX protocol' },
                  { icon: CheckCircle, text: '99.9% uptime SLA with redundant failover' },
                  { icon: Cpu, text: 'AWS & Azure dual-cloud redundancy' },
                  { icon: Activity, text: 'Real-time risk monitoring engine' },
                ].map(({ icon: Icon, text }) => (
                  <li key={text} className="flex items-center gap-3 text-sm" style={{ color: '#E2E8F0' }}>
                    <span className="w-7 h-7 rounded-lg flex items-center justify-center shrink-0" style={{ background: 'rgba(0,212,255,0.1)' }}>
                      <Icon size={13} style={{ color: '#00D4FF' }} />
                    </span>
                    <span className="opacity-70">{text}</span>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
