<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind CSS 4 CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Custom Theme Styles -->
    <link rel="stylesheet" type="text/tailwindcss" href="src/styles/index.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.13/dist/lenis.min.js"></script>

    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <title><?php echo isset($pageTitle) ? $pageTitle : 'Copier — Algorithmic & Copy Trading Platform | Est. 2026'; ?></title>
    
    <?php if (isset($pageDescription)): ?>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <?php endif; ?>
</head>
<body class="min-h-screen flex flex-col" style="background: #060D1A; color: #E2E8F0;">
