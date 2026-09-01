<!-- Footer -->
<footer class="bg-slate-50 pt-20 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-20">
            <div class="lg:col-span-2 space-y-8">
                <?php
                $settings = [];
                try {
                    require_once 'db.php';
                    $stmt = $pdo->query("SELECT s_key, s_value FROM settings");
                    while ($row = $stmt->fetch()) {
                        $settings[$row['s_key']] = $row['s_value'];
                    }
                } catch (PDOException $e) {
                }
                ?>
                <a href="#home" class="flex items-center gap-3 mb-8 group">
                    <img src="<?php echo isset($base_path) ? $base_path : ''; ?>assets/logo.png" alt="Hydria Logo"
                        class="h-12 w-auto transition-transform group-hover:scale-110">
                    <span class="font-display text-3xl tracking-wider text-primary uppercase">HYDRIA</span>
                </a>
                <p class="text-slate-500 text-lg leading-relaxed max-w-md">
                    <?= htmlspecialchars($settings['footer_desc'] ?? 'Building excellence for over 20 years. Let\'s discuss your next project.') ?>
                </p>
                <div class="flex items-center gap-4">
                    <a href="https://www.facebook.com/hydriaconstruction" target="_blank"
                        class="px-6 py-4 bg-white border border-slate-200 rounded-2xl flex items-center gap-4 text-primary hover:bg-primary hover:text-white transition-all shadow-md hover:shadow-xl hover:-translate-y-1 group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 flex-shrink-0">
                            <circle cx="12" cy="12" r="12" fill="#1877F2" />
                            <path fill="#fff"
                                d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z" />
                        </svg>
                        <span class="font-black text-sm uppercase tracking-wider">Follow us on Facebook</span>
                    </a>
                </div>
            </div>

            <div class="space-y-6">
                <h4 class="text-primary font-black text-sm uppercase tracking-widest">Contact Info</h4>
                <ul class="space-y-4">
                    <li class="flex gap-3 text-slate-500 italic">
                        <i data-lucide="map-pin" class="w-5 h-5 text-accent flex-shrink-0"></i>
                        7619 San Antonio, Los Baños, Laguna
                    </li>
                    <li class="flex gap-3 text-slate-500">
                        <i data-lucide="phone" class="w-5 h-5 text-accent flex-shrink-0"></i>
                        +63 921 419 2186
                    </li>
                    <li class="flex gap-3 text-slate-500">
                        <i data-lucide="mail" class="w-5 h-5 text-accent flex-shrink-0"></i>
                        hydriaconstructioninc@gmail.com
                    </li>
                </ul>
            </div>

            <div class="space-y-6">
                <h4 class="text-primary font-black text-sm uppercase tracking-widest">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="#home" class="text-slate-500 hover:text-primary transition-colors">Home</a></li>
                    <li><a href="#about" class="text-slate-500 hover:text-primary transition-colors">About Us</a></li>
                    <li><a href="#services" class="text-slate-500 hover:text-primary transition-colors">Our Services</a>
                    </li>
                    <li><a href="#projects" class="text-slate-500 hover:text-primary transition-colors">Work Gallery</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="bg-primary py-8 relative">
        <div class="max-w-7xl mx-auto px-6 text-center text-white/40 text-xs font-bold uppercase tracking-widest">
            &copy; <?= date('Y') ?> Hydria Construction Inc. All rights reserved.
        </div>
        <a href="login.php"
            class="absolute bottom-2 right-4 text-[10px] text-white/5 hover:text-accent transition-colors">Staff
            Portal</a>
    </div>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();

    // Mobile Menu Toggle
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Navbar Scroll Effect
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 50) {
            nav.classList.add('py-2', 'shadow-xl');
            nav.classList.remove('py-4');
        } else {
            nav.classList.remove('py-2', 'shadow-xl');
            nav.classList.add('py-4');
        }
    });

    // Reveal on Scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // Projects Carousel (Swiper) — scroll / drag to navigate
    if (document.querySelector('.projects-swiper')) {
        new Swiper('.projects-swiper', {
            loop: false,
            grabCursor: true,
            watchSlidesProgress: true,
            slidesPerView: 1,
            spaceBetween: 24,
            speed: 500,
            freeMode: {
                enabled: true,
                momentum: true,
                momentumRatio: 0.6,
            },
            mousewheel: {
                enabled: true,
                forceToAxis: true,   // only intercept horizontal scroll intent
            },
            pagination: {
                el: '#proj-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 28,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                }
            }
        });
    }
</script>
</body>

</html>