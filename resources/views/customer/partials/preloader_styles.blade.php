<style>
    /* ===================== PRELOADER ===================== */
    #preloader {
        position: fixed; inset: 0; z-index: 99999;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; background: #020914;
        transition: opacity 0.9s ease, visibility 0.9s ease;
    }
    #preloader.hidden { opacity:0; visibility:hidden; pointer-events:none; }
    #preloader-bg { position:absolute; inset:0; overflow:hidden; }
    .pl-grid-layer {
        position:absolute; inset:-10%;
        background-image: linear-gradient(rgba(0,180,255,0.07) 1px,transparent 1px), linear-gradient(90deg,rgba(0,180,255,0.07) 1px,transparent 1px);
        background-size:50px 50px;
        animation: gridShift 6s linear infinite;
    }
    @keyframes gridShift { 0%{transform:translate(0,0);} 100%{transform:translate(50px,50px);} }
    .pl-orb { position:absolute; border-radius:50%; filter:blur(90px); animation:orbFloat linear infinite; pointer-events:none; }
    @keyframes orbFloat {
        0%{transform:translate(0,0) scale(1);opacity:0.5;}
        33%{transform:translate(var(--ox1),var(--oy1)) scale(1.15);opacity:0.7;}
        66%{transform:translate(var(--ox2),var(--oy2)) scale(0.9);opacity:0.4;}
        100%{transform:translate(0,0) scale(1);opacity:0.5;}
    }
    .pl-scanline { position:absolute;inset:0; background:repeating-linear-gradient(0deg,transparent,transparent 2px,rgba(0,180,255,0.018) 2px,rgba(0,180,255,0.018) 4px); pointer-events:none; }
    .data-stream { position:absolute;width:1px; background:linear-gradient(180deg,transparent 0%,rgba(0,212,255,0.6) 50%,transparent 100%); animation:streamFlow linear infinite; opacity:0; top:-200px; }
    @keyframes streamFlow { 0%{transform:translateY(0);opacity:0;} 5%{opacity:1;} 95%{opacity:0.5;} 100%{transform:translateY(calc(100vh + 300px));opacity:0;} }
    .hex-deco { position:absolute; opacity:0.04; animation:hexPulse 4s ease-in-out infinite; }
    @keyframes hexPulse { 0%,100%{opacity:0.04;transform:scale(1);} 50%{opacity:0.08;transform:scale(1.05);} }
    #preloader-content { position:relative;z-index:10;display:flex;flex-direction:column;align-items:center;gap:2rem;width:100%;padding:2rem; }
    #ball { position:absolute;width:14px;height:14px;border-radius:50%; background:radial-gradient(circle at 35% 35%,#7EEEFF,#00D4FF 60%,#0066BB); box-shadow:0 0 12px #00D4FF,0 0 30px rgba(0,212,255,0.7),0 0 60px rgba(0,212,255,0.4),0 0 100px rgba(0,212,255,0.2); transform:translate(-50%,-50%);pointer-events:none;z-index:20; }
    .ball-trail { position:absolute;border-radius:50%;background:#00D4FF;transform:translate(-50%,-50%);pointer-events:none;z-index:19; }
    #loading-bar-wrap { width:min(90vw,420px);height:2px;background:rgba(0,180,255,0.1);border-radius:2px;overflow:hidden;position:relative; }
    #loading-bar { height:100%;width:0%;background:linear-gradient(90deg,#0a2d7a,#1E5FAD,#00D4FF,#7EEEFF);border-radius:2px;box-shadow:0 0 14px #00D4FF,0 0 30px rgba(0,212,255,0.4);transition:width 0.08s linear; }
    #loading-bar::after { content:'';position:absolute;top:0;left:-40px;width:40px;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.5),transparent);animation:barShimmer 1.2s ease infinite; }
    @keyframes barShimmer { 0%{left:-40px;} 100%{left:calc(100% + 40px);} }
    #loading-pct { font-family:'Rajdhani',sans-serif;font-size:0.75rem;letter-spacing:0.3em;color:rgba(0,212,255,0.55);text-transform:uppercase; }
    .corner-deco { position:absolute;width:40px;height:40px;border-color:rgba(0,212,255,0.3);border-style:solid; }
    .corner-deco.tl{top:20px;left:20px;border-width:2px 0 0 2px;}
    .corner-deco.tr{top:20px;right:20px;border-width:2px 2px 0 0;}
    .corner-deco.bl{bottom:20px;left:20px;border-width:0 0 2px 2px;}
    .corner-deco.br{bottom:20px;right:20px;border-width:0 2px 2px 0;}
    #sys-status { display:flex;gap:1rem;align-items:center; }
    .status-dot { display:flex;align-items:center;gap:0.4rem;font-family:'Rajdhani',sans-serif;font-size:0.7rem;letter-spacing:0.1em;color:rgba(0,212,255,0.45); }
    .status-dot::before { content:'';width:5px;height:5px;border-radius:50%;background:#00D4FF;box-shadow:0 0 6px #00D4FF;animation:dotPulse 1.5s ease-in-out infinite; }
    .status-dot:nth-child(2)::before{animation-delay:0.5s;}
    .status-dot:nth-child(3)::before{animation-delay:1s;}
    @keyframes dotPulse { 0%,100%{opacity:1;}50%{opacity:0.3;} }

    /* ── SKIP BUTTON ── */
    #preloader-skip {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.5rem 1.4rem;
        border-radius: 2rem;
        font-family: 'Rajdhani', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: rgba(0,212,255,0.6);
        background: rgba(0,212,255,0.06);
        border: 1px solid rgba(0,212,255,0.2);
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.6s ease, background 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.25s ease;
        margin-top: 0.5rem;
    }
    #preloader-skip:hover {
        background: rgba(0,212,255,0.14);
        border-color: rgba(0,212,255,0.5);
        color: #00D4FF;
        transform: scale(1.04);
    }
    #preloader-skip:active { transform: scale(0.97); }

</style>

