import { useState } from 'react';
import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import {
  ChevronDown, Mail, MessageCircle, BookOpen, Phone,
  Search, ArrowRight, Clock, CheckCircle, Zap, Shield, Settings, TrendingUp,
} from 'lucide-react';

const HELP_IMAGE = 'https://images.unsplash.com/photo-1516910817563-4df1c1b69058?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080';

const categories = [
  { icon: Zap, label: 'Getting Started', count: 12 },
  { icon: Settings, label: 'Account & Setup', count: 18 },
  { icon: TrendingUp, label: 'Trading & Strategies', count: 24 },
  { icon: Shield, label: 'Security & Privacy', count: 9 },
  { icon: BookOpen, label: 'MetaTrader Guides', count: 15 },
  { icon: CheckCircle, label: 'Billing & Subscriptions', count: 11 },
];

const faqs = [
  {
    category: 'Getting Started',
    q: 'How do I get started with Copier?',
    a: 'Sign up for a plan on our Services page, then follow the onboarding wizard to connect your broker and MetaTrader account. The whole process takes under 10 minutes.',
  },
  {
    category: 'Getting Started',
    q: 'Is there a free trial available?',
    a: 'Yes! All plans come with a 14-day free trial. No credit card required to start. You can explore all features before committing.',
  },
  {
    category: 'Trading',
    q: 'What markets can I trade with Copier?',
    a: 'Copier supports Forex (100+ pairs), Cryptocurrencies (50+), Stocks (500+), Indices (30+), Commodities (20+), and Options (1000+).',
  },
  {
    category: 'Trading',
    q: 'Can I customize risk settings for each strategy?',
    a: 'Absolutely. Each strategy allows you to set custom lot sizes, maximum daily loss limits, max drawdown thresholds, trading hours, and more from the strategy settings panel.',
  },
  {
    category: 'MetaTrader',
    q: 'Does Copier work with MetaTrader 4 and MetaTrader 5?',
    a: 'Yes, we provide Expert Advisors (EAs) for both MT4 and MT5. Simply download the EA, install it in your terminal\'s Experts folder, and enter your API key to connect.',
  },
  {
    category: 'Account',
    q: 'How many trading accounts can I connect?',
    a: 'This depends on your plan. Starter supports 1 account, Professional supports 5, and Enterprise supports unlimited accounts across multiple brokers.',
  },
  {
    category: 'Account',
    q: 'Can I upgrade or downgrade my plan?',
    a: 'Yes, you can change your plan at any time. Upgrades take effect immediately. Downgrades take effect at the start of the next billing cycle.',
  },
  {
    category: 'Security',
    q: 'Is my trading data and financial information secure?',
    a: 'We use bank-level AES-256 encryption for all data at rest and in transit. We never store your broker passwords — only read-only API keys. Our infrastructure is SOC 2 compliant.',
  },
  {
    category: 'Billing',
    q: 'What payment methods do you accept?',
    a: 'We accept all major credit/debit cards (Visa, Mastercard, AmEx), PayPal, bank transfers, and select cryptocurrencies (BTC, USDT).',
  },
  {
    category: 'Technical',
    q: 'What happens to my trades if Copier goes offline?',
    a: 'Our platform has 99.9% uptime with dual-cloud redundancy. Any open trades remain active at your broker. We recommend VPS hosting for additional protection.',
  },
];

function FAQItem({ faq }: { faq: typeof faqs[0] }) {
  const [open, setOpen] = useState(false);
  return (
    <div
      className="rounded-xl overflow-hidden transition-all duration-300"
      style={{ background: open ? 'rgba(0,212,255,0.05)' : 'rgba(15,30,53,0.6)', border: `1px solid ${open ? 'rgba(0,212,255,0.3)' : 'rgba(0,212,255,0.1)'}` }}
    >
      <button
        onClick={() => setOpen(!open)}
        className="w-full flex items-center justify-between p-5 text-left"
      >
        <div className="flex items-center gap-3 flex-1">
          <span className="text-xs px-2 py-0.5 rounded-full shrink-0" style={{ background: 'rgba(0,212,255,0.1)', color: '#00D4FF', fontSize: '10px' }}>
            {faq.category}
          </span>
          <span className="text-sm" style={{ color: '#fff', fontWeight: 500 }}>{faq.q}</span>
        </div>
        <ChevronDown
          size={16}
          className="shrink-0 ml-3 transition-transform duration-300"
          style={{ color: '#00D4FF', transform: open ? 'rotate(180deg)' : 'none' }}
        />
      </button>
      {open && (
        <div className="px-5 pb-5">
          <p className="text-sm leading-relaxed opacity-65" style={{ color: '#E2E8F0' }}>{faq.a}</p>
        </div>
      )}
    </div>
  );
}

export function Help() {
  const [search, setSearch] = useState('');
  const [activeCategory, setActiveCategory] = useState('All');

  const filteredFAQs = faqs.filter((f) => {
    const matchSearch = f.q.toLowerCase().includes(search.toLowerCase()) || f.a.toLowerCase().includes(search.toLowerCase());
    const matchCat = activeCategory === 'All' || f.category === activeCategory;
    return matchSearch && matchCat;
  });

  const faqCategories = ['All', ...Array.from(new Set(faqs.map((f) => f.category)))];

  return (
    <>
      <Helmet>
        <title>Help Center — Copier Algo Trading Support</title>
        <meta name="description" content="Get help with Copier's algorithmic trading platform. FAQs, setup guides, MetaTrader tutorials, account management, and 24/7 support." />
        <meta name="keywords" content="copier help center, algo trading support, MetaTrader setup guide, trading FAQ, broker connection guide" />
        <meta property="og:title" content="Copier Help Center & Support" />
        <meta property="og:description" content="24/7 support, comprehensive FAQs, and guides for Copier's trading platform." />
        <meta property="og:image" content={HELP_IMAGE} />
      </Helmet>

      {/* Hero */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="absolute top-1/2 right-0 w-96 h-96 rounded-full opacity-10 pointer-events-none" style={{ background: '#1E5FAD', filter: 'blur(100px)' }} />
        <div className="max-w-3xl mx-auto px-4 sm:px-6 text-center" data-aos="fade-up">
          <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Help Center</span>
          <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1, marginBottom: '1.25rem' }}>
            How Can We{' '}
            <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
              Help You?
            </span>
          </h1>
          {/* Search */}
          <div className="relative max-w-xl mx-auto">
            <Search size={16} className="absolute left-4 top-1/2 -translate-y-1/2 opacity-40" style={{ color: '#E2E8F0' }} />
            <input
              type="text"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              placeholder="Search for answers..."
              className="w-full pl-12 pr-4 py-4 rounded-2xl text-sm outline-none transition-all"
              style={{
                background: 'rgba(15,30,53,0.9)',
                border: '1px solid rgba(0,212,255,0.2)',
                color: '#E2E8F0',
              }}
            />
          </div>
        </div>
      </section>

      {/* Help Categories */}
      <section className="py-16" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-10" data-aos="fade-up">
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.5rem, 3vw, 2rem)', color: '#fff' }}>
              Browse by Category
            </h2>
          </div>
          <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            {categories.map((cat, i) => {
              const Icon = cat.icon;
              return (
                <button
                  key={cat.label}
                  onClick={() => setActiveCategory(cat.label.split(' ')[0])}
                  className="p-5 rounded-2xl text-center group hover:-translate-y-1 transition-all duration-300"
                  style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }}
                  data-aos="fade-up"
                  data-aos-delay={i * 60}
                >
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style={{ background: 'rgba(0,212,255,0.1)' }}>
                    <Icon size={18} style={{ color: '#00D4FF' }} />
                  </div>
                  <p className="text-xs mb-1" style={{ color: '#fff', fontWeight: 600 }}>{cat.label}</p>
                  <p className="text-[10px] opacity-40" style={{ color: '#E2E8F0' }}>{cat.count} articles</p>
                </button>
              );
            })}
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-10" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>FAQ</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Frequently Asked Questions
            </h2>
          </div>

          {/* Category Filter */}
          <div className="flex flex-wrap gap-2 mb-8 justify-center" data-aos="fade-up">
            {faqCategories.map((cat) => (
              <button
                key={cat}
                onClick={() => setActiveCategory(cat)}
                className="px-4 py-2 rounded-lg text-xs tracking-wide transition-all duration-300"
                style={{
                  background: activeCategory === cat ? 'linear-gradient(135deg, #1E5FAD, #00D4FF)' : 'rgba(255,255,255,0.05)',
                  color: activeCategory === cat ? '#fff' : 'rgba(226,232,240,0.6)',
                  fontWeight: activeCategory === cat ? 700 : 400,
                  border: activeCategory === cat ? 'none' : '1px solid rgba(0,212,255,0.1)',
                }}
              >
                {cat}
              </button>
            ))}
          </div>

          <div className="space-y-3" data-aos="fade-up" data-aos-delay="100">
            {filteredFAQs.map((faq) => (
              <FAQItem key={faq.q} faq={faq} />
            ))}
            {filteredFAQs.length === 0 && (
              <div className="text-center py-12 opacity-40" style={{ color: '#E2E8F0' }}>
                <Search size={32} className="mx-auto mb-3" />
                <p>No results found. Try a different search term.</p>
              </div>
            )}
          </div>
        </div>
      </section>

      {/* Contact Cards */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Contact Us</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              Still Need Help?
            </h2>
            <p className="mt-3 opacity-55 text-sm" style={{ color: '#E2E8F0' }}>Our support team is available around the clock.</p>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { icon: MessageCircle, title: 'Live Chat', desc: 'Chat with our support team in real time.', badge: 'Online Now', color: '#10B981' },
              { icon: Mail, title: 'Email Support', desc: 'support@copier.trade — reply within 2 hours.', badge: '< 2h Reply', color: '#00D4FF' },
              { icon: Phone, title: 'Phone Support', desc: '+1 (800) COPIER-1 — available 9am–9pm EST.', badge: 'Mon–Fri', color: '#1E5FAD' },
              { icon: BookOpen, title: 'Documentation', desc: 'Detailed technical docs and API reference.', badge: 'Always Open', color: '#F59E0B' },
            ].map((c, i) => {
              const Icon = c.icon;
              return (
                <div key={c.title} className="p-7 rounded-2xl group hover:-translate-y-1 transition-all duration-300 cursor-pointer" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                  <div className="flex items-start justify-between mb-5">
                    <div className="w-11 h-11 rounded-xl flex items-center justify-center" style={{ background: `${c.color}15` }}>
                      <Icon size={20} style={{ color: c.color }} />
                    </div>
                    <span className="text-[10px] px-2 py-1 rounded-full" style={{ background: `${c.color}15`, color: c.color, fontWeight: 700 }}>{c.badge}</span>
                  </div>
                  <h3 className="text-base mb-2" style={{ color: '#fff', fontWeight: 600 }}>{c.title}</h3>
                  <p className="text-xs opacity-55 leading-relaxed" style={{ color: '#E2E8F0' }}>{c.desc}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* Contact Form */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-2xl mx-auto px-4 sm:px-6">
          <div className="text-center mb-10" data-aos="fade-up">
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 2.5rem)', color: '#fff' }}>
              Send a Message
            </h2>
          </div>
          <div className="p-8 rounded-2xl" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.12)' }} data-aos="fade-up" data-aos-delay="100">
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
              {['Full Name', 'Email Address'].map((field) => (
                <div key={field}>
                  <label className="block text-xs mb-2 opacity-60" style={{ color: '#E2E8F0' }}>{field}</label>
                  <input
                    type={field === 'Email Address' ? 'email' : 'text'}
                    placeholder={field}
                    className="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                    style={{ background: 'rgba(0,0,0,0.3)', border: '1px solid rgba(0,212,255,0.12)', color: '#E2E8F0' }}
                    onFocus={(e) => { e.currentTarget.style.borderColor = 'rgba(0,212,255,0.4)'; }}
                    onBlur={(e) => { e.currentTarget.style.borderColor = 'rgba(0,212,255,0.12)'; }}
                  />
                </div>
              ))}
            </div>
            <div className="mb-5">
              <label className="block text-xs mb-2 opacity-60" style={{ color: '#E2E8F0' }}>Subject</label>
              <select
                className="w-full px-4 py-3 rounded-xl text-sm outline-none"
                style={{ background: 'rgba(0,0,0,0.3)', border: '1px solid rgba(0,212,255,0.12)', color: '#E2E8F0' }}
              >
                <option>General Inquiry</option>
                <option>Technical Support</option>
                <option>Billing & Subscriptions</option>
                <option>MetaTrader Setup</option>
                <option>Strategy Questions</option>
                <option>Partnership</option>
              </select>
            </div>
            <div className="mb-6">
              <label className="block text-xs mb-2 opacity-60" style={{ color: '#E2E8F0' }}>Message</label>
              <textarea
                rows={4}
                placeholder="Describe your question or issue..."
                className="w-full px-4 py-3 rounded-xl text-sm outline-none resize-none"
                style={{ background: 'rgba(0,0,0,0.3)', border: '1px solid rgba(0,212,255,0.12)', color: '#E2E8F0' }}
                onFocus={(e) => { e.currentTarget.style.borderColor = 'rgba(0,212,255,0.4)'; }}
                onBlur={(e) => { e.currentTarget.style.borderColor = 'rgba(0,212,255,0.12)'; }}
              />
            </div>
            <button
              className="w-full py-3.5 rounded-xl text-sm flex items-center justify-center gap-2 group transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg"
              style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 700 }}
            >
              Send Message
              <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
            </button>
            <div className="flex items-center gap-2 mt-4 justify-center text-xs opacity-40" style={{ color: '#E2E8F0' }}>
              <Clock size={11} />
              Average response time: under 2 hours
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
