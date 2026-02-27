<?php
$current_page = basename($_SERVER['PHP_SELF'], ".php");

$navLinks = [
    ['label' => 'Home',     'path' => 'index'],
    ['label' => 'About',    'path' => 'about'],
    ['label' => 'Services', 'path' => 'services'],
    ['label' => 'Help',     'path' => 'help'],
    ['label' => 'Login',    'path' => 'login'],
];
?>

<!-- Scroll Progress Bar -->
<div class="fixed top-0 left-0 right-0 z-[100] h-[2px]" style="background: rgba(0,212,255,0.1)">
    <div id="scroll-progress" class="h-full transition-none" style="background: linear-gradient(90deg, #1E5FAD, #00D4FF); width: 0%; box-shadow: 0 0 8px rgba(0,212,255,0.6);"></div>
</div>

<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" style="background: linear-gradient(180deg, rgba(6,13,26,0.92) 0%, rgba(6,13,26,0.6) 100%); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
    <div class="w-full px-3 sm:px-4 md:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16 md:h-20">

            <!-- Logo - Made more compact on mobile -->
            <a href="index.php" class="flex items-center gap-1.5 sm:gap-2 md:gap-3 group flex-shrink-0" aria-label="Copier - Algo Trading">
                <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 rounded-lg sm:rounded-xl flex items-center justify-center relative overflow-hidden transition-transform duration-300 group-hover:scale-110 flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF)">
                    <i data-lucide="trending-up" class="text-white" style="width:14px; height:14px; stroke-width: 2.5;"></i>
                </div>
                <div class="min-w-0">
                    <span class="text-base sm:text-xl md:text-2xl tracking-widest uppercase block" style="font-family: 'Rajdhani', sans-serif; font-weight: 700; background: linear-gradient(90deg, #ffffff, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.1;">Copier</span>
                    <p class="text-[8px] sm:text-[9px] md:text-[10px] tracking-[0.2em] sm:tracking-[0.3em] uppercase opacity-60 hidden min-[400px]:block" style="color: #00D4FF; margin-top: -2px; line-height: 1;">Algo Trading</p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-1" role="navigation">
                <?php foreach ($navLinks as $link): ?>
                    <?php
                        $path = $link['path'] . '.php';
                        $isActive = ($current_page == $link['path']);
                    ?>
                    <a href="<?php echo $path; ?>" class="relative px-4 py-2 text-sm tracking-wide transition-all duration-300 group rounded-lg" style="color: <?php echo $isActive ? '#00D4FF' : 'rgba(226,232,240,0.8)'; ?>; font-weight: <?php echo $isActive ? '600' : '400'; ?>;">
                        <span class="relative z-10"><?php echo $link['label']; ?></span>
                        <?php if ($isActive): ?>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 w-4/5 rounded-full" style="background: linear-gradient(90deg, #1E5FAD, #00D4FF)"></span>
                        <?php endif; ?>
                        <span class="absolute inset-0 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: rgba(0,212,255,0.07)"></span>
                    </a>
                <?php endforeach; ?>
                <a href="profile.php" class="ml-4 w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; box-shadow: 0 0 20px rgba(0,212,255,0.25);" title="Your Profile">
                    <i data-lucide="user" style="width:18px; height:18px; stroke-width: 2.5;"></i>
                </a>
            </nav>

            <!-- Mobile menu - Improved spacing and sizing -->
            <div class="flex items-center gap-1.5 sm:gap-2 lg:hidden">
                <button id="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false" class="relative w-8 h-8 sm:w-9 sm:h-9 flex flex-col items-center justify-center gap-1 rounded-lg transition-all duration-300 focus:outline-none flex-shrink-0" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(0,212,255,0.2);">
                    <span class="ham-line block w-4 sm:w-5 h-[2px] rounded-full transition-all duration-400 origin-center" style="background: #00D4FF;"></span>
                    <span class="ham-line block w-4 sm:w-5 h-[2px] rounded-full transition-all duration-400" style="background: #00D4FF;"></span>
                    <span class="ham-line block w-2.5 sm:w-3 h-[2px] rounded-full transition-all duration-400 origin-center" style="background: #00D4FF;"></span>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Menu Overlay - Improved for all screen sizes -->
<div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden" aria-hidden="true" style="opacity: 0; pointer-events: none; transition: opacity 0.4s ease;">
    <!-- Backdrop -->
    <div id="mobile-backdrop" class="absolute inset-0" style="background: rgba(6,13,26,0.75); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"></div>
    <!-- Drawer - Made responsive -->
    <div id="mobile-drawer" class="absolute top-0 right-0 h-full flex flex-col pt-16 sm:pt-20 pb-6 px-4 sm:px-6 overflow-y-auto" style="width: min(280px, 75vw); max-width: 320px; background: linear-gradient(180deg, #0F1E35 0%, #060D1A 100%); border-left: 1px solid rgba(0,212,255,0.15); transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);">
        <nav class="flex flex-col gap-1">
            <?php foreach ($navLinks as $link): ?>
                <?php
                    $path = $link['path'] . '.php';
                    $isActive = ($current_page == $link['path']);
                ?>
                <a href="<?php echo $path; ?>" class="flex items-center gap-3 px-3 py-2.5 sm:px-4 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300" style="background: <?php echo $isActive ? 'rgba(0,212,255,0.1)' : 'transparent'; ?>; color: <?php echo $isActive ? '#00D4FF' : 'rgba(226,232,240,0.85)'; ?>; border-left: <?php echo $isActive ? '3px solid #00D4FF' : '3px solid transparent'; ?>; font-weight: <?php echo $isActive ? '600' : '400'; ?>; text-decoration: none; font-size: 0.9rem; letter-spacing: 0.02em;">
                    <?php echo $link['label']; ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <div class="mt-auto pt-6" style="border-top: 1px solid rgba(0,212,255,0.1)">
            <p class="text-center text-[10px] sm:text-xs mt-4 opacity-40" style="color: #E2E8F0;">© 2026 Copier. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
(function(){
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu   = document.getElementById('mobile-menu');
    const drawer = document.getElementById('mobile-drawer');
    const backdrop = document.getElementById('mobile-backdrop');
    const lines  = toggle ? toggle.querySelectorAll('.ham-line') : [];
    let open = false;

    function openMenu(){
        open = true;
        menu.style.opacity = '1';
        menu.style.pointerEvents = 'auto';
        menu.setAttribute('aria-hidden','false');
        drawer.style.transform = 'translateX(0)';
        toggle.setAttribute('aria-expanded','true');
        document.body.style.overflow = 'hidden';
        // Animate hamburger → X
        if(lines.length >= 3){
            lines[0].style.transform = 'translateY(5px) rotate(45deg)';
            lines[1].style.opacity = '0';
            lines[2].style.transform = 'translateY(-5px) rotate(-45deg)';
            lines[2].style.width = lines[0].style.width;
        }
    }
    function closeMenu(){
        open = false;
        menu.style.opacity = '0';
        menu.style.pointerEvents = 'none';
        menu.setAttribute('aria-hidden','true');
        drawer.style.transform = 'translateX(100%)';
        toggle.setAttribute('aria-expanded','false');
        document.body.style.overflow = '';
        if(lines.length >= 3){
            lines[0].style.transform = '';
            lines[1].style.opacity = '1';
            lines[2].style.transform = '';
            // Restore original width
        }
    }

    if(toggle) toggle.addEventListener('click', ()=> open ? closeMenu() : openMenu());
    if(backdrop) backdrop.addEventListener('click', closeMenu);

    // Scroll progress
    window.addEventListener('scroll', function(){
        const el = document.getElementById('scroll-progress');
        if(el){
            const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            el.style.width = Math.min(pct, 100) + '%';
        }
        // Header blur on scroll
        const header = document.getElementById('main-header');
        if(header){
            if(window.scrollY > 20){
                header.style.background = 'rgba(6,13,26,0.97)';
                header.style.boxShadow = '0 1px 30px rgba(0,0,0,0.4)';
            } else {
                header.style.background = 'linear-gradient(180deg, rgba(6,13,26,0.92) 0%, rgba(6,13,26,0.6) 100%)';
                header.style.boxShadow = 'none';
            }
        }
    }, { passive: true });
})();
</script>
