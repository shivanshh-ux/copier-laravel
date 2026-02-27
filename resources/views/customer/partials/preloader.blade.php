<!-- ===================== PRELOADER ===================== -->
<div id="preloader">
    <div class="corner-deco tl"></div><div class="corner-deco tr"></div>
    <div class="corner-deco bl"></div><div class="corner-deco br"></div>
    <div id="preloader-bg">
        <div class="pl-grid-layer"></div>
        <div class="pl-scanline"></div>
        <svg class="hex-deco" style="top:-5%;left:-5%;width:45%;max-width:400px;" viewBox="0 0 400 400" fill="none">
            <polygon points="200,10 380,110 380,290 200,390 20,290 20,110" stroke="#00D4FF" stroke-width="1"/>
            <polygon points="200,50 345,130 345,270 200,350 55,270 55,130" stroke="#00D4FF" stroke-width="0.5"/>
            <polygon points="200,90 310,150 310,250 200,310 90,250 90,150" stroke="#00D4FF" stroke-width="0.3"/>
        </svg>
        <svg class="hex-deco" style="bottom:-8%;right:-5%;width:40%;max-width:350px;animation-delay:2s;" viewBox="0 0 400 400" fill="none">
            <polygon points="200,10 380,110 380,290 200,390 20,290 20,110" stroke="#1E5FAD" stroke-width="1"/>
            <polygon points="200,60 340,140 340,260 200,340 60,260 60,140" stroke="#00D4FF" stroke-width="0.5"/>
        </svg>
        <div class="pl-orb" style="width:550px;height:550px;background:rgba(0,60,160,0.4);top:-20%;left:-12%;--ox1:100px;--oy1:80px;--ox2:-50px;--oy2:140px;animation-duration:16s;"></div>
        <div class="pl-orb" style="width:450px;height:450px;background:rgba(0,160,255,0.18);bottom:-15%;right:-8%;--ox1:-80px;--oy1:-100px;--ox2:40px;--oy2:-50px;animation-duration:13s;"></div>
        <div class="pl-orb" style="width:320px;height:320px;background:rgba(0,30,100,0.5);top:35%;right:20%;--ox1:60px;--oy1:-70px;--ox2:-40px;--oy2:40px;animation-duration:10s;"></div>
    </div>
    <div id="preloader-content">
        <div id="ball-container" style="position:fixed;inset:0;pointer-events:none;z-index:20;overflow:hidden;">
            <div id="ball"></div>
        </div>
        <div id="text-stage" style="text-align:center;line-height:1.15;">
            <div style="position:relative;display:inline-block;overflow:hidden;">
                <div id="reveal-emperor" style="font-family:'Rajdhani',sans-serif;font-weight:700;font-size:clamp(2.8rem,8vw,5.5rem);letter-spacing:0.18em;color:#00D4FF;text-shadow:0 0 20px #00D4FF,0 0 50px rgba(0,212,255,0.5);clip-path:inset(0 100% 0 0);white-space:nowrap;line-height:1.1;">EMPEROR</div>
            </div>
            <br>
            <div id="deco-divider" style="display:inline-block;width:0px;height:1px;background:linear-gradient(90deg,transparent,rgba(0,212,255,0.6),transparent);transition:width 0.5s ease;margin:0.25rem 0;vertical-align:middle;"></div>
            <br>
            <div style="position:relative;display:inline-block;overflow:hidden;">
                <div id="reveal-copier" style="font-family:'Rajdhani',sans-serif;font-weight:600;font-size:clamp(1.3rem,3.5vw,2.4rem);letter-spacing:0.35em;color:rgba(0,212,255,0.85);text-shadow:0 0 14px rgba(0,212,255,0.7);clip-path:inset(0 100% 0 0);white-space:nowrap;line-height:1.2;">COPIER&nbsp;&nbsp;TRADING</div>
            </div>
        </div>
        <div id="loading-bar-wrap"><div id="loading-bar"></div></div>
        <div id="sys-status">
            <div class="status-dot">ALGO ENGINE</div>
            <div class="status-dot">MARKET FEED</div>
            <div class="status-dot">RISK MGMT</div>
        </div>
        <div id="loading-pct">Initializing · 0%</div>
        <!-- Skip button -->
        <button id="preloader-skip" onclick="skipPreloader()" aria-label="Skip preloader">
            <i data-lucide="skip-forward" style="width:13px;height:13px;"></i>
            Skip
        </button>
    </div>
</div>

<script>
    /* ── PRELOADER ANIMATION ── */
    (function(){
        const preloader=document.getElementById('preloader'),ball=document.getElementById('ball'),
              ballCont=document.getElementById('ball-container'),revEmp=document.getElementById('reveal-emperor'),
              revCop=document.getElementById('reveal-copier'),decoDiv=document.getElementById('deco-divider'),
              loadingBar=document.getElementById('loading-bar'),loadingPct=document.getElementById('loading-pct');
        const bg=document.getElementById('preloader-bg');
        if(!bg) return;
        for(let i=0;i<10;i++){const d=document.createElement('div');d.className='data-stream';d.style.cssText=`left:${(Math.random()*100).toFixed(1)}%;height:${(60+Math.random()*140).toFixed(0)}px;animation-duration:${(2.8+Math.random()*3).toFixed(2)}s;animation-delay:${(Math.random()*6).toFixed(2)}s;`;bg.appendChild(d);}
        const TRAIL_N=14,trails=[];
        for(let i=0;i<TRAIL_N;i++){const t=document.createElement('div');t.className='ball-trail';const s=14-i*0.85;t.style.cssText=`width:${Math.max(1.5,s)}px;height:${Math.max(1.5,s)}px;opacity:${((1-(i/TRAIL_N))*0.55).toFixed(2)};top:0;left:0;`;ballCont.appendChild(t);trails.push(t);}
        const trailHist=[];
        function moveBall(x,y){ball.style.left=x+'px';ball.style.top=y+'px';trailHist.unshift({x,y});if(trailHist.length>TRAIL_N*4)trailHist.pop();trails.forEach((t,i)=>{const h=trailHist[Math.min(i*3,trailHist.length-1)];if(h){t.style.left=h.x+'px';t.style.top=h.y+'px';}});}
        function lerp(a,b,t){return a+(b-a)*t;}
        function easeOut(t){return 1-(1-t)*(1-t);}
        function easeInOut(t){return t<0.5?2*t*t:-1+(4-2*t)*t;}
        function ease3(t){return t*t*(3-2*t);}
        const PH=[700,1300,350,1500,500,800];
        const labels=['Booting System','Connecting Feeds','Loading Strategies','Calibrating Risk','Syncing Markets','Launching'];
        function updatePct(p){const pct=Math.min(100,Math.round(p));loadingBar.style.width=pct+'%';loadingPct.textContent=labels[Math.min(labels.length-1,Math.floor(pct/18))]+' · '+pct+'%';}
        let startTs=null;
        function getHSpan(el){const r=el.getBoundingClientRect();return{left:r.left,right:r.right,cy:r.top+r.height*0.5,width:r.width};}
        function tick(ts){
            if(!startTs)startTs=ts;
            const elapsed=ts-startTs;
            let acc=0,ph=PH.length-1,lt=1;
            for(let i=0;i<PH.length;i++){if(elapsed<acc+PH[i]){ph=i;lt=(elapsed-acc)/PH[i];break;}acc+=PH[i];}
            lt=Math.min(1,lt);
            const empSpan=getHSpan(revEmp),copSpan=getHSpan(revCop);
            const entryX=window.innerWidth*0.05,entryY=-40;
            const arcMidX=lerp(entryX,empSpan.left,0.5),arcMidY=empSpan.cy-120;
            let bx,by;
            if(ph===0){const t=easeOut(lt);if(t<0.5){const tt=easeOut(t*2);bx=lerp(entryX,arcMidX,tt);by=lerp(entryY,arcMidY,tt);}else{const tt=easeInOut((t-0.5)*2);bx=lerp(arcMidX,empSpan.left-8,tt);by=lerp(arcMidY,empSpan.cy,tt);}updatePct(lt*8);}
            else if(ph===1){const t=ease3(lt);bx=lerp(empSpan.left-8,empSpan.right+8,t);by=empSpan.cy;revEmp.style.clipPath=`inset(0 ${(100-lt*100).toFixed(1)}% 0 0)`;updatePct(8+lt*40);}
            else if(ph===2){revEmp.style.clipPath='inset(0 0% 0 0)';decoDiv.style.width=(easeOut(lt)*Math.max(empSpan.width,copSpan.width)*0.85)+'px';const midX=(empSpan.right+copSpan.left)*0.5+40,midY=(empSpan.cy+copSpan.cy)*0.5-30;if(lt<0.5){const tt=easeOut(lt*2);bx=lerp(empSpan.right+8,midX,tt);by=lerp(empSpan.cy,midY,tt);}else{const tt=easeInOut((lt-0.5)*2);bx=lerp(midX,copSpan.left-8,tt);by=lerp(midY,copSpan.cy,tt);}updatePct(48+lt*8);}
            else if(ph===3){revEmp.style.clipPath='inset(0 0% 0 0)';const t=ease3(lt);bx=lerp(copSpan.left-8,copSpan.right+8,t);by=copSpan.cy;revCop.style.clipPath=`inset(0 ${(100-lt*100).toFixed(1)}% 0 0)`;updatePct(56+lt*38);}
            else if(ph===4){revCop.style.clipPath='inset(0 0% 0 0)';const t=easeOut(lt);bx=lerp(copSpan.right+8,window.innerWidth+60,t);by=copSpan.cy;updatePct(94+lt*5);}
            else if(ph===5){bx=window.innerWidth+60;by=copSpan?copSpan.cy:window.innerHeight*0.5;updatePct(99+lt);preloader.style.opacity=Math.max(0,1-easeInOut(lt*1.1)).toString();if(lt>=0.92){preloader.classList.add('hidden');
                // Dispatch event for other components (like Lenis) to start
                window.dispatchEvent(new CustomEvent('preloaderFinished'));
                return;
            }}
            moveBall(bx,by);requestAnimationFrame(tick);
        }
        document.body.style.overflow='hidden';

        /* ── SKIP BUTTON ── */
        window.skipPreloader = function() {
            preloader.style.transition = 'opacity 0.5s ease, visibility 0.5s ease';
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
            preloader.style.pointerEvents = 'none';
            document.body.style.overflow = '';
            window.dispatchEvent(new CustomEvent('preloaderFinished'));
            setTimeout(() => preloader.classList.add('hidden'), 520);
        };

        /* Fade in Skip button after 1 second so it's not too intrusive */
        setTimeout(() => {
            const skipBtn = document.getElementById('preloader-skip');
            if (skipBtn) skipBtn.style.opacity = '1';
        }, 1000);

        setTimeout(()=>requestAnimationFrame(tick),200);
    })();
</script>

