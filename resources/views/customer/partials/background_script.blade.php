<script>
/* ── THREE.JS 3D BACKGROUND ── */
(function() {
    const canvas = document.getElementById('bg-canvas');
    if (!canvas) return;
    const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x000000, 0);

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 0, 28);

    // ── PARTICLE FIELD ──
    const particleCount = 1800;
    const positions = new Float32Array(particleCount * 3);
    const colors = new Float32Array(particleCount * 3);
    for (let i = 0; i < particleCount; i++) {
        positions[i * 3]     = (Math.random() - 0.5) * 100;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 100;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 60;
        const mix = Math.random();
        colors[i * 3]     = mix * 0.12 + (1 - mix) * 0.0;
        colors[i * 3 + 1] = mix * 0.53 + (1 - mix) * 0.37;
        colors[i * 3 + 2] = mix * 0.68 + (1 - mix) * 1.0;
    }
    const pGeo = new THREE.BufferGeometry();
    pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    pGeo.setAttribute('color', new THREE.BufferAttribute(colors, 3));
    const pMat = new THREE.PointsMaterial({ size: 0.18, vertexColors: true, transparent: true, opacity: 0.7, sizeAttenuation: true });
    const particles = new THREE.Points(pGeo, pMat);
    scene.add(particles);

    // ── FLOATING GRID PLANE ──
    const gridGeo = new THREE.PlaneGeometry(120, 120, 30, 30);
    const gridMat = new THREE.MeshBasicMaterial({ color: 0x00D4FF, wireframe: true, transparent: true, opacity: 0.04 });
    const grid = new THREE.Mesh(gridGeo, gridMat);
    grid.rotation.x = -Math.PI / 2.8;
    grid.position.y = -18;
    scene.add(grid);

    // ── FLOATING TORUS RINGS ──
    const rings = [];
    const ringConfigs = [
        { r: 8, tube: 0.04, color: 0x00D4FF, x: -10, y: 4, z: -5, rx: 1.2, ry: 0.3 },
        { r: 5, tube: 0.03, color: 0x1E5FAD, x: 12, y: -3, z: -10, rx: 0.5, ry: 1.1 },
        { r: 12, tube: 0.025, color: 0x00D4FF, x: 0, y: -8, z: -20, rx: Math.PI/4, ry: 0 },
        { r: 3.5, tube: 0.035, color: 0x7EEEFF, x: 8, y: 8, z: -8, rx: 0.8, ry: 0.5 },
    ];
    ringConfigs.forEach(cfg => {
        const geo = new THREE.TorusGeometry(cfg.r, cfg.tube, 16, 80);
        const mat = new THREE.MeshBasicMaterial({ color: cfg.color, transparent: true, opacity: 0.35 });
        const mesh = new THREE.Mesh(geo, mat);
        mesh.position.set(cfg.x, cfg.y, cfg.z);
        mesh.rotation.x = cfg.rx;
        mesh.rotation.y = cfg.ry;
        scene.add(mesh);
        rings.push({ mesh, speed: 0.003 + Math.random() * 0.005 });
    });

    // ── CONNECTING LINES ──
    const linePoints = [];
    for (let i = 0; i < 40; i++) {
        const x1 = (Math.random() - 0.5) * 80, y1 = (Math.random() - 0.5) * 60;
        const x2 = x1 + (Math.random() - 0.5) * 20, y2 = y1 + (Math.random() - 0.5) * 15;
        linePoints.push(new THREE.Vector3(x1, y1, -15), new THREE.Vector3(x2, y2, -15));
    }
    const lineGeo = new THREE.BufferGeometry().setFromPoints(linePoints);
    const lineMat = new THREE.LineBasicMaterial({ color: 0x00D4FF, transparent: true, opacity: 0.06 });
    scene.add(new THREE.LineSegments(lineGeo, lineMat));

    // ── MOUSE PARALLAX ──
    let mouseX = 0, mouseY = 0, targetX = 0, targetY = 0;
    document.addEventListener('mousemove', e => {
        mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
        mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
    });

    // ── SCROLL SYNC ──
    // We use window.lenis.animatedScroll for the smoothest possible sync with Lenis
    function getScrollY() {
        return (window.lenis && window.lenis.animatedScroll !== undefined) ? window.lenis.animatedScroll : window.scrollY;
    }

    // ── ANIMATION LOOP ──
    let t = 0;
    function animate() {
        requestAnimationFrame(animate);
        t += 0.005;

        targetX += (mouseX - targetX) * 0.04;
        targetY += (mouseY - targetY) * 0.04;

        const currentScroll = getScrollY();

        camera.position.x = targetX * 3;
        camera.position.y = -targetY * 2 - currentScroll * 0.008;
        camera.lookAt(0, 0, 0);

        particles.rotation.y = t * 0.06;
        particles.rotation.x = t * 0.02;

        grid.rotation.z = Math.sin(t * 0.3) * 0.05;
        grid.position.y = -18 + Math.sin(t * 0.4) * 1.5;

        rings.forEach((r, i) => {
            r.mesh.rotation.z += r.speed;
            r.mesh.rotation.x += r.speed * 0.4;
        });

        renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }, { passive: true });
})();
</script>

