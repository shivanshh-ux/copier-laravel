import { useState } from 'react';
import { Helmet } from 'react-helmet-async';
import { TrendingUp, TrendingDown, BarChart2, Zap, Globe, Search } from 'lucide-react';

const CATALOG_IMAGE = 'https://images.unsplash.com/photo-1748609160056-7b95f30041f0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';

type Category = 'All' | 'Forex' | 'Crypto' | 'Stocks' | 'Indices' | 'Commodities';

const strategies = [
  { id: 1, name: 'Momentum Alpha', category: 'Forex', type: 'Trend Following', pair: 'EUR/USD', winRate: 84, avgReturn: '+18.4%', drawdown: '5.2%', timeframe: 'M15', risk: 'Medium', color: '#00D4FF' },
  { id: 2, name: 'BTC Scalper Pro', category: 'Crypto', type: 'Scalping', pair: 'BTC/USDT', winRate: 79, avgReturn: '+24.7%', drawdown: '8.1%', timeframe: 'M5', risk: 'High', color: '#F59E0B' },
  { id: 3, name: 'Nasdaq Grid Bot', category: 'Indices', type: 'Grid Trading', pair: 'US100', winRate: 88, avgReturn: '+12.2%', drawdown: '3.8%', timeframe: 'H1', risk: 'Low', color: '#10B981' },
  { id: 4, name: 'Gold Swing EA', category: 'Commodities', type: 'Swing Trading', pair: 'XAU/USD', winRate: 76, avgReturn: '+21.5%', drawdown: '9.4%', timeframe: 'H4', risk: 'Medium', color: '#F59E0B' },
  { id: 5, name: 'GBP Mean Rev.', category: 'Forex', type: 'Mean Reversion', pair: 'GBP/USD', winRate: 82, avgReturn: '+15.8%', drawdown: '4.6%', timeframe: 'H1', risk: 'Low', color: '#00D4FF' },
  { id: 6, name: 'ETH Arbitrage', category: 'Crypto', type: 'Arbitrage', pair: 'ETH/USDT', winRate: 93, avgReturn: '+9.3%', drawdown: '1.8%', timeframe: 'M1', risk: 'Low', color: '#10B981' },
  { id: 7, name: 'S&P500 Quant', category: 'Stocks', type: 'Quantitative', pair: 'SPX', winRate: 81, avgReturn: '+16.9%', drawdown: '6.3%', timeframe: 'D1', risk: 'Medium', color: '#1E5FAD' },
  { id: 8, name: 'Oil Breakout', category: 'Commodities', type: 'Breakout', pair: 'WTI/USD', winRate: 74, avgReturn: '+28.6%', drawdown: '12.1%', timeframe: 'H4', risk: 'High', color: '#F59E0B' },
  { id: 9, name: 'JPY Carry Trade', category: 'Forex', type: 'Carry Trade', pair: 'USD/JPY', winRate: 86, avgReturn: '+11.7%', drawdown: '3.1%', timeframe: 'D1', risk: 'Low', color: '#00D4FF' },
  { id: 10, name: 'DAX Options Bot', category: 'Indices', type: 'Options Hedge', pair: 'GER40', winRate: 80, avgReturn: '+19.3%', drawdown: '7.2%', timeframe: 'H1', risk: 'Medium', color: '#10B981' },
  { id: 11, name: 'ADA Trend EA', category: 'Crypto', type: 'Trend Following', pair: 'ADA/USDT', winRate: 77, avgReturn: '+32.5%', drawdown: '14.8%', timeframe: 'M30', risk: 'High', color: '#F59E0B' },
  { id: 12, name: 'AAPL Momentum', category: 'Stocks', type: 'Momentum', pair: 'AAPL', winRate: 83, avgReturn: '+14.4%', drawdown: '5.9%', timeframe: 'D1', risk: 'Medium', color: '#1E5FAD' },
];

const categories: Category[] = ['All', 'Forex', 'Crypto', 'Stocks', 'Indices', 'Commodities'];

const riskColors: Record<string, string> = {
  Low: '#10B981',
  Medium: '#F59E0B',
  High: '#EF4444',
};

export function Catalog() {
  const [active, setActive] = useState<Category>('All');
  const [search, setSearch] = useState('');

  const filtered = strategies.filter((s) => {
    const matchCat = active === 'All' || s.category === active;
    const matchSearch = s.name.toLowerCase().includes(search.toLowerCase()) || s.pair.toLowerCase().includes(search.toLowerCase());
    return matchCat && matchSearch;
  });

  return (
    <>
      <Helmet>
        <title>Strategy Catalog — Copier Algo Trading Strategies</title>
        <meta name="description" content="Browse Copier's extensive catalog of algorithmic trading strategies for Forex, Crypto, Stocks, Indices, and Commodities. Find the perfect strategy to copy." />
        <meta name="keywords" content="trading strategy catalog, algo trading strategies, forex strategies, crypto trading bots, copy trading strategies" />
        <meta property="og:title" content="Copier Strategy Catalog" />
        <meta property="og:description" content="Browse 200+ algo trading strategies across all markets." />
        <meta property="og:image" content={CATALOG_IMAGE} />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
          <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Strategy Library</span>
          <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1 }}>
            Trading Strategy{' '}
            <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
              Catalog
            </span>
          </h1>
          <p className="mt-4 max-w-2xl mx-auto text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
            200+ rigorously backtested strategies across all asset classes. Filter, compare, and deploy in one click.
          </p>
        </div>
      </section>

      {/* Filters & Search */}
      <section className="py-10 sticky top-20 z-30" style={{ background: 'rgba(6,13,26,0.95)', backdropFilter: 'blur(12px)', borderBottom: '1px solid rgba(0,212,255,0.1)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex flex-col sm:flex-row items-center gap-4">
            {/* Search */}
            <div className="relative flex-1 max-w-sm">
              <Search size={14} className="absolute left-3 top-1/2 -translate-y-1/2 opacity-40" style={{ color: '#E2E8F0' }} />
              <input
                type="text"
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                placeholder="Search strategies..."
                className="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm outline-none"
                style={{ background: 'rgba(255,255,255,0.05)', border: '1px solid rgba(0,212,255,0.15)', color: '#E2E8F0' }}
              />
            </div>
            {/* Category tabs */}
            <div className="flex flex-wrap gap-2">
              {categories.map((cat) => (
                <button
                  key={cat}
                  onClick={() => setActive(cat)}
                  className="px-4 py-2 rounded-lg text-xs tracking-wide transition-all duration-300"
                  style={{
                    background: active === cat ? 'linear-gradient(135deg, #1E5FAD, #00D4FF)' : 'rgba(255,255,255,0.05)',
                    color: active === cat ? '#fff' : 'rgba(226,232,240,0.6)',
                    fontWeight: active === cat ? 700 : 400,
                    border: active === cat ? 'none' : '1px solid rgba(0,212,255,0.1)',
                  }}
                >
                  {cat}
                </button>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Strategies Grid */}
      <section className="py-16" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <p className="text-xs opacity-40 mb-6" style={{ color: '#E2E8F0' }}>
            Showing {filtered.length} of {strategies.length} strategies
          </p>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            {filtered.map((s, i) => (
              <div
                key={s.id}
                className="p-5 rounded-2xl group hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                style={{
                  background: 'linear-gradient(135deg, rgba(15,30,53,0.9), rgba(22,40,68,0.7))',
                  border: '1px solid rgba(0,212,255,0.1)',
                }}
                data-aos="fade-up"
                data-aos-delay={Math.min(i * 50, 400)}
              >
                {/* Header */}
                <div className="flex items-start justify-between mb-4">
                  <div>
                    <h3 className="text-sm mb-0.5" style={{ color: '#fff', fontWeight: 600 }}>{s.name}</h3>
                    <p className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>{s.pair} · {s.timeframe}</p>
                  </div>
                  <span className="text-xs px-2 py-0.5 rounded-full shrink-0" style={{ background: `${s.color}18`, color: s.color, fontWeight: 600 }}>
                    {s.category}
                  </span>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-3 gap-2 mb-4">
                  <div className="text-center p-2 rounded-lg" style={{ background: 'rgba(0,0,0,0.2)' }}>
                    <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1rem', color: '#10B981' }}>{s.winRate}%</p>
                    <p className="text-[10px] opacity-50" style={{ color: '#E2E8F0' }}>Win Rate</p>
                  </div>
                  <div className="text-center p-2 rounded-lg" style={{ background: 'rgba(0,0,0,0.2)' }}>
                    <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1rem', color: s.color }}>{s.avgReturn}</p>
                    <p className="text-[10px] opacity-50" style={{ color: '#E2E8F0' }}>Avg Return</p>
                  </div>
                  <div className="text-center p-2 rounded-lg" style={{ background: 'rgba(0,0,0,0.2)' }}>
                    <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1rem', color: '#EF4444' }}>{s.drawdown}</p>
                    <p className="text-[10px] opacity-50" style={{ color: '#E2E8F0' }}>Drawdown</p>
                  </div>
                </div>

                {/* Type & Risk */}
                <div className="flex items-center justify-between">
                  <span className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>{s.type}</span>
                  <span className="text-xs px-2 py-0.5 rounded-full" style={{ background: `${riskColors[s.risk]}15`, color: riskColors[s.risk], fontWeight: 600 }}>
                    {s.risk} Risk
                  </span>
                </div>

                {/* Mini chart bars */}
                <div className="mt-4 flex items-end gap-0.5 h-6 opacity-40 group-hover:opacity-70 transition-opacity">
                  {Array.from({ length: 16 }).map((_, j) => (
                    <div
                      key={j}
                      className="flex-1 rounded-t-sm transition-all duration-300"
                      style={{
                        height: `${Math.random() * 100}%`,
                        background: j > 10 ? s.color : 'rgba(255,255,255,0.3)',
                        minHeight: '2px',
                      }}
                    />
                  ))}
                </div>
              </div>
            ))}
          </div>
          {filtered.length === 0 && (
            <div className="text-center py-20" style={{ color: '#E2E8F0' }}>
              <BarChart2 size={40} className="mx-auto mb-4 opacity-20" />
              <p className="opacity-40">No strategies found. Try a different filter.</p>
            </div>
          )}
        </div>
      </section>
    </>
  );
}
