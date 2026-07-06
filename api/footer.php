<!-- Contact Section -->
<section id="contact" class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-primary rounded-[3rem] overflow-hidden shadow-2xl relative">
            <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block">
                <img src="<?php echo isset($base_path) ? $base_path : ''; ?>assets/school.jpg" alt="Contact Us"
                    class="w-full h-full object-cover opacity-50">
                <div class="absolute inset-0 bg-gradient-to-r from-primary to-transparent"></div>
            </div>

            <div class="relative z-10 p-10 lg:p-20 lg:w-3/5">
                <div class="space-y-4 mb-10">
                    <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em]">GET IN TOUCH</h2>
                    <h3 class="text-white text-5xl font-display">LET'S BUILD SOMETHING GREAT</h3>
                    <p class="text-white/60">Ready to start your project? Send us a message and our expert team will get
                        back to you within 24 hours.</p>
                </div>

                <form id="contactForm" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <input type="text" id="name" placeholder="Full Name" required
                            class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-white/30 focus:outline-none focus:border-accent transition-colors">
                        <input type="email" id="email" placeholder="Email Address" required
                            class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-white/30 focus:outline-none focus:border-accent transition-colors">
                    </div>
                    <select id="service" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:outline-none focus:border-accent transition-colors appearance-none">
                        <option value="" disabled selected class="bg-primary">Service Interested In</option>
                        <option value="residential" class="bg-primary">Residential</option>
                        <option value="commercial" class="bg-primary">Commercial</option>
                        <option value="industrial" class="bg-primary">Industrial</option>
                        <option value="other" class="bg-primary">Other</option>
                    </select>
                    <textarea id="message" placeholder="Tell us about your project..." rows="4" required
                        class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-white/30 focus:outline-none focus:border-accent transition-colors"></textarea>

                    <button type="submit"
                        class="w-full py-5 bg-accent hover:bg-[#B3933B] text-white font-black rounded-2xl transition-all shadow-xl shadow-accent/20 flex items-center justify-center gap-3 group">
                        SUBMIT INQUIRY
                        <i data-lucide="send"
                            class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    </button>
                    <div id="formStatus" class="text-center text-sm font-bold mt-4"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-slate-50 pt-20 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-20">
            <div class="lg:col-span-2 space-y-8">
                <a href="#home" class="flex items-center gap-3">
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
                        0926-735-0297
                    </li>
                    <li class="flex gap-3 text-slate-500">
                        <i data-lucide="mail" class="w-5 h-5 text-accent flex-shrink-0"></i>
                        hydriaconstruction@gmail.com
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

    // Email Real-Time Validation
    const emailInput = document.getElementById('email');
    const emailHint = document.createElement('p');
    emailHint.id = 'emailHint';
    emailHint.className = 'text-xs font-bold mt-1 transition-all';
    emailHint.style.display = 'none';
    emailInput.insertAdjacentElement('afterend', emailHint);

    function validateEmailFormat(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email);
    }

    let emailDebounce;
    emailInput.addEventListener('input', () => {
        const val = emailInput.value.trim();
        clearTimeout(emailDebounce);

        if (val.length === 0) {
            emailHint.style.display = 'none';
            emailInput.style.borderColor = '';
            return;
        }

        if (!validateEmailFormat(val)) {
            emailHint.textContent = '⚠ Enter a valid email (e.g. you@gmail.com)';
            emailHint.style.display = 'block';
            emailHint.style.color = '#f87171';
            emailInput.style.borderColor = '#f87171';
            return;
        }

        // Display checking state immediately when format matches
        emailHint.textContent = '⚡ Verifying domain...';
        emailHint.style.display = 'block';
        emailHint.style.color = '#f59e0b'; // amber-500
        emailInput.style.borderColor = '#f59e0b';

        emailDebounce = setTimeout(async () => {
            try {
                const res = await fetch(`validate-email.php?email=${encodeURIComponent(val)}`);
                const result = await res.json();

                // Check that the user hasn't typed anything else in the meantime
                if (emailInput.value.trim() !== val) return;

                if (result.valid) {
                    emailHint.textContent = '✓ Looks good!';
                    emailHint.style.color = '#34d399';
                    emailInput.style.borderColor = '#34d399';
                } else {
                    emailHint.textContent = `⚠ ${result.message}`;
                    emailHint.style.color = '#f87171';
                    emailInput.style.borderColor = '#f87171';
                }
            } catch (e) {
                if (emailInput.value.trim() !== val) return;
                // Offline or fetch failure fallback
                emailHint.textContent = '✓ Format looks correct';
                emailHint.style.color = '#34d399';
                emailInput.style.borderColor = '#34d399';
            }
        }, 600);
    });

    emailInput.addEventListener('blur', () => {
        if (emailInput.value.trim().length === 0) {
            emailHint.style.display = 'none';
            emailInput.style.borderColor = '';
        }
    });

    // Contact Form Handler
    document.getElementById('contactForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const status = document.getElementById('formStatus');
        const submitBtn = e.target.querySelector('button[type="submit"]');

        // Client-side email format check before hitting server
        const emailVal = document.getElementById('email').value.trim();
        if (!validateEmailFormat(emailVal)) {
            status.textContent = '⚠ Please enter a valid email address.';
            status.className = 'text-center text-sm font-bold mt-4 text-red-400';
            document.getElementById('email').focus();
            return;
        }

        status.textContent = 'Sending...';
        status.className = 'text-center text-sm font-bold mt-4 text-white/50';
        submitBtn.disabled = true;

        const formData = {
            name: document.getElementById('name').value,
            email: emailVal,
            service: document.getElementById('service').value,
            message: document.getElementById('message').value
        };

        try {
            const response = await fetch('process-contact.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });
            const result = await response.json();

            if (result.success) {
                status.textContent = 'Message sent successfully!';
                status.className = 'text-center text-sm font-bold mt-4 text-accent';
                e.target.reset();
                emailHint.style.display = 'none';
                emailInput.style.borderColor = '';
            } else {
                status.textContent = result.message || 'Error sending message.';
                status.className = 'text-center text-sm font-bold mt-4 text-red-400';
            }
        } catch (error) {
            status.textContent = 'Network error. Please try again.';
            status.className = 'text-center text-sm font-bold mt-4 text-red-400';
        } finally {
            submitBtn.disabled = false;
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
</script>
</body>

</html>