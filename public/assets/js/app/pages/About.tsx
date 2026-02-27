import { Helmet } from 'react-helmet-async';
import { Link } from 'react-router';
import { TrendingUp, Users, Award, Lightbulb, Target, Heart, ArrowRight } from 'lucide-react';

const ABOUT_IMAGE = 'https://images.unsplash.com/photo-1631038506857-6c970dd9ba02?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaW50ZWNoJTIwb2ZmaWNlJTIwdGVhbSUyMHByb2Zlc3Npb25hbHN8ZW58MXx8fHwxNzcxOTMzNzEwfDA&ixlib=rb-4.1.0&q=80&w=1080';

const milestones = [
  { year: '2026 Q1', title: 'Copier Founded', desc: 'Launched with a mission to democratize algorithmic trading for all investor types.' },
  { year: '2026 Q2', title: 'Platform Beta', desc: 'Released beta version with copy trading and basic automation features.' },
  { year: '2026 Q3', title: 'MetaTrader Launch', desc: 'Full MT4 & MT5 integration deployed with 99.9% uptime guarantee.' },
  { year: '2026 Q4', title: '10,000 Traders', desc: 'Crossed 10,000 active traders milestone with 5M+ trades executed.' },
];

const team = [
  { name: 'Marcus Chen', role: 'CEO & Co-Founder', bio: '15 years in quantitative finance, former Goldman Sachs quant.', initial: 'MC' },
  { name: 'Sofia Reyes', role: 'CTO & Co-Founder', bio: 'Ex-Google engineer specializing in low-latency trading systems.', initial: 'SR' },
  { name: 'Daniel Park', role: 'Head of Strategy', bio: 'Hedge fund veteran with 200+ profitable trading algorithms.', initial: 'DP' },
  { name: 'Aisha Williams', role: 'Head of Risk', bio: 'Risk management specialist from JP Morgan, CFA certified.', initial: 'AW' },
];

const values = [
  { icon: Target, title: 'Precision', desc: 'Every line of code and trade execution is optimized for maximum accuracy.' },
  { icon: Heart, title: 'Transparency', desc: 'We share real performance data. No misleading promises, only verified results.' },
  { icon: Lightbulb, title: 'Innovation', desc: 'Continuously evolving our AI models and infrastructure to stay ahead of markets.' },
  { icon: Users, title: 'Community', desc: 'A thriving ecosystem of traders, developers, and analysts sharing knowledge.' },
];

export function About() {
  return (
    <>
      <Helmet>
        <title>About Copier — Our Story, Team & Mission | Algo Trading 2026</title>
        <meta name="description" content="Learn about Copier, the algorithmic trading company founded in 2026. Meet our team, understand our mission, and discover how we're changing the trading landscape." />
        <meta name="keywords" content="about Copier, algo trading company, trading team, fintech 2026, algorithmic trading history" />
        <meta property="og:title" content="About Copier — Our Story & Mission" />
        <meta property="og:description" content="Founded in 2026, Copier is revolutionizing algorithmic trading for all investors." />
        <meta property="og:image" content={ABOUT_IMAGE} />
      </Helmet>

      {/* ── PAGE HERO ── */}
      <section className="relative pt-32 pb-20 overflow-hidden" style={{ background: 'linear-gradient(180deg, #060D1A 0%, #0A1628 100%)' }}>
        <div className="absolute inset-0 opacity-[0.04] pointer-events-none" style={{ backgroundImage: 'linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px)', backgroundSize: '60px 60px' }} />
        <div className="absolute top-1/2 right-0 w-96 h-96 rounded-full opacity-10 pointer-events-none" style={{ background: '#1E5FAD', filter: 'blur(100px)' }} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>About Us</span>
            <h1 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(2.5rem, 5vw, 4rem)', color: '#fff', lineHeight: 1.1 }}>
              The Future of Trading{' '}
              <span style={{ background: 'linear-gradient(90deg, #1E5FAD, #00D4FF)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent', backgroundClip: 'text' }}>
                Is Algorithmic
              </span>
            </h1>
            <p className="mt-4 max-w-2xl mx-auto text-sm leading-relaxed opacity-60" style={{ color: '#E2E8F0' }}>
              Copier was born in 2026 from a simple belief: every trader deserves access to the same tools used by Wall Street's finest institutions.
            </p>
          </div>
        </div>
      </section>

      {/* ── STORY ── */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div className="relative" data-aos="fade-right">
              <div className="absolute -inset-4 rounded-3xl opacity-20" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', filter: 'blur(20px)' }} />
              <div className="relative rounded-2xl overflow-hidden" style={{ border: '1px solid rgba(0,212,255,0.2)' }}>
                <img src={ABOUT_IMAGE} alt="Copier team at work" className="w-full h-96 object-cover" />
                <div className="absolute inset-0" style={{ background: 'linear-gradient(180deg, transparent 50%, rgba(6,13,26,0.7) 100%)' }} />
                <div className="absolute bottom-6 left-6 right-6">
                  <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs" style={{ background: 'rgba(0,212,255,0.15)', border: '1px solid rgba(0,212,255,0.3)', color: '#00D4FF' }}>
                    <span className="w-1.5 h-1.5 rounded-full animate-pulse" style={{ background: '#00D4FF' }} />
                    Est. 2026 — New York, USA
                  </div>
                </div>
              </div>
            </div>

            <div data-aos="fade-left">
              <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Our Story</span>
              <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 3vw, 2.5rem)', color: '#fff', marginBottom: '1.25rem' }}>
                Democratizing Algo Trading
              </h2>
              <div className="space-y-4 text-sm leading-relaxed opacity-70" style={{ color: '#E2E8F0' }}>
                <p>Founded in early 2026, Copier emerged from the frustration of seeing retail traders lose to institutional algorithms. Our founding team — quants, engineers, and traders — came together to level the playing field.</p>
                <p>We built Copier from the ground up using the same principles that power the world's best hedge funds: rigorous backtesting, disciplined risk management, and relentless optimization.</p>
                <p>Today, Copier serves thousands of traders across 60+ countries, processing millions of trades monthly with institutional-grade infrastructure and unmatched transparency.</p>
              </div>
              <div className="grid grid-cols-2 gap-4 mt-8">
                {[{ label: '60+', desc: 'Countries Served' }, { label: '12K+', desc: 'Active Traders' }, { label: '99.9%', desc: 'Platform Uptime' }, { label: '$500M+', desc: 'Volume Managed' }].map((s) => (
                  <div key={s.label} className="p-4 rounded-xl" style={{ background: 'rgba(0,212,255,0.05)', border: '1px solid rgba(0,212,255,0.1)' }}>
                    <p style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '1.75rem', color: '#00D4FF' }}>{s.label}</p>
                    <p className="text-xs opacity-50" style={{ color: '#E2E8F0' }}>{s.desc}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── VALUES ── */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Our Values</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>
              What Drives Us
            </h2>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {values.map((v, i) => {
              const Icon = v.icon;
              return (
                <div key={v.title} className="p-7 rounded-2xl group hover:-translate-y-1 transition-all duration-300" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                  <div className="w-12 h-12 rounded-xl flex items-center justify-center mb-5" style={{ background: 'rgba(0,212,255,0.1)' }}>
                    <Icon size={22} style={{ color: '#00D4FF' }} />
                  </div>
                  <h3 className="text-base mb-2" style={{ color: '#fff', fontWeight: 600 }}>{v.title}</h3>
                  <p className="text-sm opacity-60 leading-relaxed" style={{ color: '#E2E8F0' }}>{v.desc}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── TIMELINE ── */}
      <section className="py-24" style={{ background: '#060D1A' }}>
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Milestones</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>Our Journey</h2>
          </div>
          <div className="relative">
            <div className="absolute left-1/2 top-0 bottom-0 w-px" style={{ background: 'linear-gradient(180deg, #1E5FAD, #00D4FF, transparent)' }} />
            <div className="space-y-12">
              {milestones.map((m, i) => (
                <div key={m.year} className={`flex items-start gap-8 ${i % 2 === 0 ? 'flex-row' : 'flex-row-reverse'}`} data-aos={i % 2 === 0 ? 'fade-right' : 'fade-left'}>
                  <div className={`flex-1 ${i % 2 === 0 ? 'text-right' : 'text-left'}`}>
                    <div className="p-5 rounded-xl inline-block" style={{ background: 'rgba(15,30,53,0.8)', border: '1px solid rgba(0,212,255,0.12)' }}>
                      <span className="text-xs tracking-widest uppercase" style={{ color: '#00D4FF' }}>{m.year}</span>
                      <h3 className="text-base mt-1 mb-2" style={{ color: '#fff', fontWeight: 600 }}>{m.title}</h3>
                      <p className="text-sm opacity-60" style={{ color: '#E2E8F0' }}>{m.desc}</p>
                    </div>
                  </div>
                  <div className="relative z-10 w-4 h-4 rounded-full shrink-0 mt-5" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', boxShadow: '0 0 12px rgba(0,212,255,0.5)' }} />
                  <div className="flex-1" />
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── TEAM ── */}
      <section className="py-24" style={{ background: 'linear-gradient(180deg, #0A1628 0%, #060D1A 100%)' }}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-14" data-aos="fade-up">
            <span className="text-xs uppercase tracking-[0.3em] mb-3 block" style={{ color: '#00D4FF' }}>Leadership</span>
            <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: 'clamp(1.8rem, 4vw, 3rem)', color: '#fff' }}>Meet the Team</h2>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {team.map((member, i) => (
              <div key={member.name} className="p-6 rounded-2xl text-center group hover:-translate-y-2 transition-all duration-300" style={{ background: 'rgba(15,30,53,0.7)', border: '1px solid rgba(0,212,255,0.1)' }} data-aos="fade-up" data-aos-delay={i * 100}>
                <div className="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 text-lg" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontFamily: "'Rajdhani', sans-serif", fontWeight: 700 }}>
                  {member.initial}
                </div>
                <h3 className="text-base mb-1" style={{ color: '#fff', fontWeight: 600 }}>{member.name}</h3>
                <p className="text-xs mb-3" style={{ color: '#00D4FF' }}>{member.role}</p>
                <p className="text-xs opacity-55 leading-relaxed" style={{ color: '#E2E8F0' }}>{member.bio}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── CTA ── */}
      <section className="py-16" style={{ background: '#060D1A', borderTop: '1px solid rgba(0,212,255,0.08)' }}>
        <div className="max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
          <h2 style={{ fontFamily: "'Rajdhani', sans-serif", fontWeight: 700, fontSize: '2rem', color: '#fff', marginBottom: '1rem' }}>
            Ready to Join the Copier Family?
          </h2>
          <p className="text-sm opacity-60 mb-6" style={{ color: '#E2E8F0' }}>
            Experience professional algo trading trusted by thousands globally.
          </p>
          <Link to="/services" className="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm group" style={{ background: 'linear-gradient(135deg, #1E5FAD, #00D4FF)', color: '#fff', fontWeight: 600 }}>
            View Our Packages <ArrowRight size={16} className="group-hover:translate-x-1 transition-transform duration-300" />
          </Link>
        </div>
      </section>
    </>
  );
}
