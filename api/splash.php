<?php
/**
 * Hydria Splash Screen — Self-Assembling Logo
 *
 * Included from header.php on public pages. Plays once per browser tab
 * session; skipped entirely when the visitor prefers reduced motion.
 * Self-contained (markup + styles + script) — no build step required.
 *
 * Replay behavior: set SPLASH_EVERY_LOAD = true in the script below to
 * replay on every page load instead of once per session, or append
 * ?splash=1 to the URL to force a one-off replay (handy for demos).
 *
 * The inline SVG is redrawn to match the official logo: bold tapered
 * swoosh arcing under the house, large tracked HYDRIA wordmark with the
 * chevron-A sized to the cap height, and a wider subtitle.
 */
?>
<div id="hydria-splash" aria-hidden="true">
    <div class="splash-logo">
        <svg viewBox="70 170 860 800" xmlns="http://www.w3.org/2000/svg" role="img" focusable="false">
            <g id="house-logo">
                <!-- Left Chimney + Wall (extends down to match the right pillar's bottom) -->
                <g class="sp sp-chimney">
                    <rect x="305" y="220" width="52.5" height="325" fill="#0A3D7C" />
                </g>

                <!-- Left Roof Beam -->
                <g class="sp sp-roof-left">
                    <polygon points="205,435 500,212.5 500,262.5 240,460" fill="#0A3D7C" />
                </g>

                <!-- Right Roof Beam -->
                <g class="sp sp-roof-right">
                    <polygon points="500,212.5 795,435 760,460 500,262.5" fill="#F15A24" />
                </g>

                <!-- Right Support Pillar -->
                <g class="sp sp-pillar">
                    <rect x="675" y="400" width="40" height="145" fill="#F15A24" />
                </g>

                <!-- Central Window (2x2) -->
                <g class="sp sp-window">
                    <rect x="450" y="375" width="100" height="110" fill="#0A3D7C" />
                </g>

                <!-- Window inner dividers -->
                <g class="sp sp-dividers">
                    <rect x="494" y="375" width="12" height="110" fill="#FFFFFF" />
                    <rect x="450" y="424" width="100" height="12" fill="#FFFFFF" />
                </g>

                <!-- Cat looking out the window (plump back-of-head silhouette with whiskers) -->
                <g class="sp sp-cat">
                    <path d="M 508 485 L 509.5 474 C 510.5 469, 512 465, 513 461 C 513.8 457, 514.2 453.5, 515 451 L 517 443 L 523 449 Q 528 452.5, 533 449 L 539 443 L 541 451 C 541.8 453.5, 542.2 457, 543 461 C 544 465, 545.5 469, 546.5 474 L 548 485 Z" fill="#FFFFFF" />
                    <g stroke="#FFFFFF" stroke-width="1.3" stroke-linecap="round">
                        <line x1="512" y1="455.5" x2="505" y2="452" />
                        <line x1="511.5" y1="460" x2="504.5" y2="460" />
                        <line x1="512" y1="464.5" x2="505" y2="468" />
                        <line x1="544" y1="455.5" x2="549.5" y2="452" />
                        <line x1="544.5" y1="460" x2="550" y2="460" />
                        <line x1="544" y1="464.5" x2="549.5" y2="468" />
                    </g>
                </g>

                <!-- Swoosh: slim tapered crescent arcing under the house -->
                <path class="sp-spw" d="M 100 640 Q 500 485 900 640 Q 500 570 100 640 Z" fill="#0A3D7C" />

                <!-- HYDRI Text (x + chevron position set by JS after fonts load) -->
                <g class="sp sp-wordmark">
                    <text id="sp-wordmark-text" x="133" y="860" font-family="Inter, Arial, sans-serif" font-weight="900" font-size="142" fill="#0A3D7C" letter-spacing="30">HYDRI</text>
                </g>

                <!-- Chevron 'A' (cap-height matched, positioned after the wordmark) -->
                <g class="sp sp-chevron" id="sp-chevron" transform="translate(30 0)">
                    <polygon points="770,860 830,758 890,860 865,860 830,806 795,860" fill="#F15A24" />
                </g>

                <!-- Subtitle — CONSTRUCTION INC — -->
                <g class="sp sp-subtitle">
                    <text x="500" y="940" text-anchor="middle" font-family="Inter, Arial, sans-serif" font-weight="800" font-size="50" fill="#F15A24" letter-spacing="6">— CONSTRUCTION INC —</text>
                </g>
            </g>
        </svg>
    </div>
</div>

<style>
/* ═══════════════════════════════════════════════
   Hydria Splash — Logo Assembly
   Brand: Royal Blue #0A3D7C · Orange #F15A24
   ═══════════════════════════════════════════════ */

#hydria-splash {
    display: none; /* revealed by JS only — no-JS visitors go straight to the site */
}

#hydria-splash.is-active {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    inset: 0;
    z-index: 9999; /* above the fixed navbar (z-50) */
    background:
        radial-gradient(ellipse 90% 70% at 50% 42%, rgba(241, 90, 36, 0.08), transparent 60%),
        radial-gradient(ellipse 130% 90% at 50% 62%, rgba(10, 61, 124, 0.45), transparent 75%),
        #061327;
    opacity: 1;
    transition: opacity 0.6s ease;
}

#hydria-splash.is-leaving {
    opacity: 0;
    pointer-events: none;
}

/* Scroll lock while the splash covers the page */
html.hydria-splash-lock,
html.hydria-splash-lock body {
    overflow: hidden;
}

.splash-logo {
    width: min(76vmin, 580px);
    aspect-ratio: 860 / 800;
    filter: drop-shadow(0 24px 48px rgba(0, 0, 0, 0.45));
}

.splash-logo svg {
    width: 100%;
    height: 100%;
    overflow: visible; /* pieces fly in from outside the frame */
}

/* Piece entrance: one keyframe set, per-piece direction via custom props */
.sp {
    transform-box: fill-box;
    transform-origin: center;
    animation-name: splash-in;
    animation-timing-function: cubic-bezier(0.22, 1, 0.36, 1); /* pieces land, not stop */
    animation-fill-mode: both;
}

@keyframes splash-in {
    from {
        opacity: 0;
        transform: translate(var(--fx, 0px), var(--fy, 0px)) rotate(var(--fr, 0deg)) scale(var(--fs, 1));
    }
    to {
        opacity: 1;
        transform: translate(0px, 0px) rotate(0deg) scale(1);
    }
}

.sp-roof-left  { --fx: -240px; --fy: -190px; --fr: -16deg; animation-duration: 0.75s; animation-delay: 0.05s; }
.sp-roof-right { --fx: 240px;  --fy: -190px; --fr: 16deg;  animation-duration: 0.75s; animation-delay: 0.20s; }
.sp-chimney    { --fx: 0px;    --fy: -300px; --fr: -6deg;  animation-duration: 0.60s; animation-delay: 0.45s; }
.sp-pillar     { --fx: 0px;    --fy: 250px;  --fr: 6deg;   animation-duration: 0.60s; animation-delay: 0.60s; }
.sp-window     { --fs: 0.35;                               animation-duration: 0.50s; animation-delay: 0.85s; }
.sp-dividers   { --fs: 0.50;                               animation-duration: 0.45s; animation-delay: 1.02s; }
.sp-cat        { --fs: 0.40;                               animation-duration: 0.40s; animation-delay: 1.18s; }
.sp-wordmark   { --fx: 0px;    --fy: 28px;                 animation-duration: 0.60s; animation-delay: 1.60s; }
.sp-chevron    { --fx: 0px;    --fy: 28px;                 animation-duration: 0.60s; animation-delay: 1.72s; }

/* Swoosh sweeps out from its center like it's being drawn */
.sp-spw {
    transform-box: fill-box;
    transform-origin: center;
    animation: splash-sweep 0.95s cubic-bezier(0.6, 0.05, 0.3, 1) 1.30s both;
}

@keyframes splash-sweep {
    from { opacity: 0; transform: scaleX(0.04); }
    30%  { opacity: 1; }
    to   { opacity: 1; transform: scaleX(1); }
}

/* Subtitle rises in while its letter-spacing settles */
.sp-subtitle {
    --fy: 20px;
    animation-name: splash-in, splash-track;
    animation-duration: 0.6s;
    animation-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
    animation-fill-mode: both;
    animation-delay: 1.90s;
}

@keyframes splash-track {
    from { letter-spacing: 20px; }
    to   { letter-spacing: 6px; }
}
</style>

<script>
(function () {
    var SPLASH_EVERY_LOAD = false; // true → replay on every page load (demo/refresh mode)

    var d = document, w = window, el = d.getElementById('hydria-splash');
    if (!el) return;

    function kill() {
        if (el.parentNode) el.parentNode.removeChild(el);
        d.documentElement.classList.remove('hydria-splash-lock');
    }

    /* Center the HYDRI + chevron-A lockup: measure the rendered wordmark
       width and snug the chevron against it (works across font fallbacks). */
    function positionLockup() {
        try {
            var ctx = d.createElement('canvas').getContext('2d');
            if (!ctx) return;
            ctx.font = '900 142px Inter, Arial, sans-serif';
            var textW = ctx.measureText('HYDRI').width + 4 * 30; // 4 inter-letter gaps
            var gap = 16, chevW = 120;
            var textX = Math.max(60, 500 - (textW + gap + chevW) / 2);
            var t = d.getElementById('sp-wordmark-text');
            var c = d.getElementById('sp-chevron');
            if (t) t.setAttribute('x', textX);
            if (c) c.setAttribute('transform', 'translate(' + (textX + textW + gap - 770) + ' 0)');
        } catch (e) {}
    }

    try {
        // Respect reduced-motion: no splash at all
        if (w.matchMedia && w.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        // Once per browser tab session (?splash=1 forces a replay)
        var force = w.location.search.indexOf('splash=1') !== -1;
        if (!force && !SPLASH_EVERY_LOAD) {
            var seen = null;
            try { seen = w.sessionStorage.getItem('hydria_splash_seen'); } catch (e) {}
            if (seen) return;
            try { w.sessionStorage.setItem('hydria_splash_seen', '1'); } catch (e) {}
        }

        positionLockup();
        if (d.fonts && d.fonts.ready) d.fonts.ready.then(positionLockup);

        d.documentElement.classList.add('hydria-splash-lock');
        el.classList.add('is-active');

        // ~2.5s assembly + 0.4s hold, then 0.6s fade to the site
        w.setTimeout(function () { el.classList.add('is-leaving'); }, 2900);
        w.setTimeout(kill, 3550); // safety net if animation events never fire
    } catch (err) {
        kill(); // never let the splash block the site
    }

    // Back/forward cache restore: never resurrect the splash
    w.addEventListener('pageshow', function (ev) {
        if (ev.persisted) kill();
    });
})();
</script>
