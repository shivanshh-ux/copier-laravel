import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import { AreaChart, Area, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, BarChart, Bar, Cell } from 'recharts';
import { TrendingUp, ArrowRight, Award } from 'lucide-react';

const PORTFOLIO_IMAGE = 'https://images.unsplash.com/photo-1768055105681-7d2096c5165f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';
const GROWTH_IMAGE = 'https://images.unsplash.com/photo-1618044733300-9472054094ee?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';

const equityData = [
  { month: 'Jan', value: 10000, profit: 400 },
  { month: 'Feb', value: 11200, profit: 1200 },
  { month: 'Mar', value: 12800, profit: 1600 },
  { month: 'Apr', value: 12200, profit: -600 },
  { month: 'May', value: 14100, profit: 1900 },
  { month: 'Jun', value: 15600, profit: 1500 },
  { month: 'Jul', value: 16900, profit: 1300 },
  { month: 'Aug', value: 18400, profit: 1500 },
  { month: 'Sep', value: 17800, profit: -600 },
  { month: 'Oct', value: 19900, profit: 2100 },
  { month: 'Nov', value: 21500, profit: 1600 },
  { month: 'Dec', value: 23100, profit: 1600 },
];

const caseStudies = [
  {
    title: 'Forex Momentum Strategy',
    period: 'Jan – Dec 2026',
    start: '$10,000',
    end: '$23,100',
    roi: '+131%',
    drawdown: '4.8%',
    trades: 1842,
    color: '#00D4FF',
  },
  {
    title: 'Crypto Grid Bot Portfolio',
    period: 'Q2 – Q4 2026',
    start: '$5,000',
    end: '$8,900',
    roi: '+78%',
    drawdown: '6.2%',
    trades: 5634,
    color: '#F59E0B',
  },
  {
    title: 'S&P 500 Quant Strategy',
    period: 'H2 2026',
    start: '$20,000',
    end: '$27,600',
    roi: '+38%',
    drawdown: '2.9%',
    trades: 364,
    color: '#10B981',
  },
];

const monthlyReturns = [
  { month: 'J', ret: 4.0 },
  { month: 'F', ret: 10.7 },
  { month: 'M', ret: 14.3 },
  { month: 'A', ret: -4.7 },
  { month: 'M', ret: 15.6 },
  { month: 'J', ret: 10.6 },
  { month: 'J', ret: 8.3 },
  { month: 'A', ret: 8.1 },
  { month: 'S', ret: -3.3 },
  { month: 'O', ret: 11.8 },
  { month: 'N', ret: 8.0 },
  { month: 'D', ret: 7.4 },
];

const CustomTooltip = ({ active, payload, label }: any) => {
  if (active && payload && payload.length) {
    return (
      <div className="p-3 rounded-xl text-xs" style={{ background: 'rgba(15,30,53,0.95)', border: '1px solid rgba(0,212,255,0.2)', color: '#E2E8F0' }}>
        <p style={{ color: '#00D4FF', fontWeight: 600 }}>{label}</p>
        <p>Equity: ${payload[0]?.value?.toLocaleString()}</p>
      </div>
    );
  }
  return null;
};

export function Portfolio() {
  return (
    <>
      <Helmet>
        <title>Portfolio & Performance — Copier Algo Trading Results</title>
        <meta name="description" content="View Copier's verified portfolio performance. Real trading results, equity curves, case studies, and strategy backtests with transparent reporting." />
        <meta name="keywords" content="trading portfolio performance, algo trading results, copy trading returns, backtesting results, verified trading history" />
        <meta property="og:title" content="Copier Portfolio & Trading Performance" />
        <meta property="og:description" content="Transparent, verified trading results from Copier's algorithmic strategies." />
        <meta property="og:image" content={PORTFOLIO_IMAGE} />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
          <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Track Record</span>
          <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1 }}>
            Proven{' '}
            <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
              Performance
            </span>
          </h1>
          <p className="mt-4 max-w-2xl mx-auto text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
            We publish real results — no cherry-picking, no hypothetical backtests only. Verified live trading performance across all strategies.
          </p>
          <div className="inline-flex items-center gap-2 mt-6 px-4 py-2 rounded-full text-xs" style={{ background: 'rgba(16,185,129,0.1)', border: '1px solid rgba(16,185,129,0.25)', color: '#10B981' }}>
            <Award size={12} />
            All results are live-account verified. Past performance does not guarantee future results.
          </div>
        </div>
      </section>

      {/* Key Stats */}
      <section className="py-16" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-5">
            {[
              { label: 'Total ROI (2026)', value: '+131%', color: '#10B981' },
              { label: 'Max Drawdown', value: '4.8%', color: '#F59E0B' },
              { label: 'Profitable Months', value: '10/12', color: '#00D4FF' },
              { label: 'Sharpe Ratio', value: '2.84', color: '#1E5FAD' },
            ].map((s, i) => (
              <div key={s.label} className="p-7 rounded-2xl text-center" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.5rem, 3vw, 2.5rem)', color: s.color }}>{s.value}</p>
                <p className="text-xs opacity-50 mt-1" style={{ color: '#E2E8F0' }}>{s.label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Equity Curve */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="mb-10" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Equity Curve</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 3vw, 2.5rem)', color: '#fff' }}>
              Flagship Portfolio — 2026 Full Year
            </h2>
          </div>
          <div className="p-6 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.12)' }} data-aos="fade-up" data-aos-delay="100">
            <ResponsiveContainer width="100%" height={320}>
              <AreaChart data={equityData} margin={{ top: 10, right: 20, left: 10, bottom: 0 }}>
                <defs>
                  <linearGradient id="equityGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="5%" stopColor="#00D4FF" stopOpacity={0.3} />
                    <stop offset="95%" stopColor="#00D4FF" stopOpacity={0} />
                  </linearGradient>
                </defs>
                <CartesianGrid strokeDasharray="3 3" stroke="rgba(0,212,255,0.07)" />
                <XAxis dataKey="month" stroke="rgba(226,232,240,0.3)" tick={{ fill: '#E2E8F0', fontSize: 11 }} />
                <YAxis stroke="rgba(226,232,240,0.3)" tick={{ fill: '#E2E8F0', fontSize: 11 }} tickFormatter={(v) => `$${(v / 1000).toFixed(0)}k`} />
                <Tooltip content={<CustomTooltip />} />
                <Area type="monotone" dataKey="value" stroke="#00D4FF" fill="url(#equityGrad)" strokeWidth={2} dot={{ fill: '#00D4FF', r: 3 }} activeDot={{ r: 5 }} />
              </AreaChart>
            </ResponsiveContainer>
          </div>

          {/* Monthly Returns */}
          <div className="mt-8 p-6 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.12)' }} data-aos="fade-up" data-aos-delay="200">
            <h3 className="text-sm mb-4" style={{ color: '#fff', fontWeight: 600 }}>Monthly Returns (%)</h3>
            <ResponsiveContainer width="100%" height={160}>
              <BarChart data={monthlyReturns} margin={{ top: 0, right: 0, left: -20, bottom: 0 }}>
                <CartesianGrid strokeDasharray="3 3" stroke="rgba(0,212,255,0.07)" />
                <XAxis dataKey="month" stroke="transparent" tick={{ fill: '#E2E8F0', fontSize: 10 }} />
                <YAxis stroke="transparent" tick={{ fill: '#E2E8F0', fontSize: 10 }} />
                <Tooltip
                  contentStyle={{ background: 'rgba(15,30,53,0.95)', border: '1px solid rgba(0,212,255,0.2)', borderRadius: 8, color: '#E2E8F0', fontSize: 11 }}
                  formatter={(v: number) => [`${v.toFixed(1)}%`, 'Return']}
                />
                <Bar dataKey="ret" radius={[3, 3, 0, 0]}>
                  {monthlyReturns.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={entry.ret >= 0 ? '#00D4FF' : '#EF4444'} />
                  ))}
                </Bar>
              </BarChart>
            </ResponsiveContainer>
          </div>
        </div>
      </section>

      {/* Case Studies */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Case Studies</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Strategy Breakdowns
            </h2>
          </div>
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {caseStudies.map((cs, i) => (
              <div key={cs.title} className="p-7 rounded-2xl group hover:-translate-y-1 transition-all duration-300" style={{ background: 'rgba(15,30,53,0.7)', border: `1px solid ${cs.color}25` }} data-aos="fade-up" data-aos-delay={i * 120}>
                <div className="flex items-center gap-2 mb-4">
                  <div className="w-2 h-2 rounded-full" style={{ background: cs.color }} />
                  <span className="text-xs" style={{ color: cs.color, fontWeight: 600 }}>{cs.period}</span>
                </div>
                <h3 className="text-base mb-4" style={{ color: '#fff', fontWeight: 700 }}>{cs.title}</h3>
                <div className="grid grid-cols-2 gap-3 mb-5">
                  {[
                    { label: 'Starting Capital', value: cs.start, col: '#E2E8F0' },
                    { label: 'Ending Capital', value: cs.end, col: '#10B981' },
                    { label: 'Total ROI', value: cs.roi, col: cs.color },
                    { label: 'Max Drawdown', value: cs.drawdown, col: '#F59E0B' },
                  ].map((stat) => (
                    <div key={stat.label} className="p-3 rounded-xl" style={{ background: 'rgba(0,0,0,0.2)' }}>
                      <p style={{ color: stat.col, fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1rem' }}>{stat.value}</p>
                      <p className="text-[10px] opacity-50" style={{ color: '#E2E8F0' }}>{stat.label}</p>
                    </div>
                  ))}
                </div>
                <div className="flex items-center justify-between text-xs opacity-50" style={{ color: '#E2E8F0' }}>
                  <span>Total Trades: {cs.trades.toLocaleString()}</span>
                  <TrendingUp size={14} style={{ color: cs.color }} />
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Images */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div className="relative rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.15)' }} data-aos="fade-right">
              <img src={PORTFOLIO_IMAGE} alt="Portfolio growth" className="w-full h-64 object-cover" />
              <div className="absolute inset-0 flex items-end p-6" style={{ background: 'linear-gradient(180deg, transparent, rgba(6,13,26,0.85))' }}>
                <div>
                  <p style={{ color: '#00D4FF', fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1.5rem' }}>$500M+</p>
                  <p className="text-sm opacity-60" style={{ color: '#E2E8F0' }}>Total Volume Managed in 2026</p>
                </div>
              </div>
            </div>
            <div className="relative rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.15)' }} data-aos="fade-left">
              <img src={GROWTH_IMAGE} alt="Financial growth" className="w-full h-64 object-cover" />
              <div className="absolute inset-0 flex items-end p-6" style={{ background: 'linear-gradient(180deg, transparent, rgba(6,13,26,0.85))' }}>
                <div>
                  <p style={{ color: '#10B981', fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1.5rem' }}>87% Avg Win Rate</p>
                  <p className="text-sm opacity-60" style={{ color: '#E2E8F0' }}>Across All Active Strategies in 2026</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="py-16" style={{ background: '#060D1A', borderTop: '1px solid rgba(0,212,255,0.08)' }}>
        <div className="max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '2rem', color: '#fff', marginBottom: '1rem' }}>
            Start Building Your Portfolio
          </h2>
          <p className="text-sm opacity-60 mb-6" style={{ color: '#E2E8F0' }}>Join 12,400+ traders generating consistent algorithmic returns.</p>
          <Link to="/services" className="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm group" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 600 }}>
            Choose a Plan <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
          </Link>
        </div>
      </section>
    </>
  );
}