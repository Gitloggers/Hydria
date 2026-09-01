<?php include_once 'header.php'; ?>

<!-- Hero Section -->
<section id="home" class="hero-bg relative pt-40 pb-28 md:pt-48 md:pb-36 lg:pt-56 lg:pb-40">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -bottom-20 -left-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-0 w-[400px] h-[400px] bg-accent/5 rounded-full blur-2xl"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 reveal">
            <div
                class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/20">
                <span class="w-2 h-2 bg-accent rounded-full animate-pulse-glow"></span>
                <span class="text-white text-xs font-bold uppercase tracking-widest">Trusted Since 2004 · Los Baños,
                    Laguna</span>
            </div>

            <h1 class="font-display text-5xl md:text-6xl lg:text-7xl text-white leading-tight flex flex-col gap-2">
                <span class="reveal reveal-delay-1">BUILDING</span>
                <span class="text-accent reveal reveal-delay-2">EXCELLENCE</span>
                <span class="flex items-center gap-4 reveal reveal-delay-3">
                    FOR <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/20 border-accent/20"
                        style="-webkit-text-stroke: 1px #F15A24;">20 YEARS</span>
                </span>
            </h1>

            <p class="text-white/60 text-lg md:text-xl max-w-xl leading-relaxed reveal reveal-delay-4">
                Hydria Construction Inc. delivers premium quality <span
                    class="text-white font-bold underline decoration-accent/50 underline-offset-4">residential,
                    commercial, and industrial</span> solutions in Los Baños and beyond.
            </p>

            <div class="flex flex-wrap gap-5 pt-6 pb-4 reveal reveal-delay-5">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=hydriaconstructioninc@gmail.com&su=Project%20Inquiry"
                    target="_blank" rel="noopener"
                    class="group inline-flex items-center gap-2 px-8 py-4 bg-accent hover:bg-accent-hover text-white font-black text-sm rounded-xl transition-all duration-300 shadow-xl shadow-accent/20 hover:shadow-accent/40 hover:scale-105">
                    WORK WITH US
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#projects"
                    class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white/20 hover:border-white text-white font-black text-sm rounded-xl transition-all duration-300 hover:bg-white/5">
                    VIEW OUR WORK
                </a>
            </div>
        </div>

        <!-- Hero Stats Card -->
        <div class="flex flex-col gap-4 reveal reveal-delay-4 mt-8 lg:mt-0">
            <div
                class="bg-white/80 backdrop-blur-md shadow-2xl border border-primary/10 rounded-3xl p-8 hover:border-accent/40 transition-all reveal reveal-delay-5">
                <div class="text-6xl font-display text-accent">20+</div>
                <div class="text-primary font-black text-xl mt-1">Years of Experience</div>
                <div class="text-slate-500 text-sm mt-1 font-bold italic">Building a legacy of quality craftsmanship.
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div
                    class="bg-white/80 backdrop-blur-md shadow-xl border border-primary/10 rounded-3xl p-6 reveal reveal-delay-6">
                    <div class="text-4xl font-display text-primary">500+</div>
                    <div class="text-primary font-bold text-sm mt-1 uppercase tracking-tighter">Projects Done</div>
                </div>
                <div
                    class="bg-primary border border-primary rounded-3xl p-6 shadow-xl shadow-primary/20 reveal reveal-delay-7">
                    <div class="text-4xl font-display text-accent">98%</div>
                    <div class="text-white font-bold text-sm mt-1 uppercase tracking-tighter">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="relative reveal">
                <div class="aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl">
                    <img src="<?php echo isset($base_path) ? $base_path : ''; ?>assets/highlight.jpg"
                        alt="Construction Quality" class="w-full h-full object-cover">
                </div>
                <div
                    class="absolute -bottom-6 -right-6 md:-bottom-10 md:-right-10 bg-primary p-6 md:p-10 rounded-[1.5rem] md:rounded-[2rem] shadow-2xl border-4 border-white">
                    <div class="text-center">
                        <span class="block text-3xl md:text-5xl font-display text-accent">2004</span>
                        <span
                            class="block text-white text-[10px] md:text-xs font-black uppercase tracking-[0.2em] mt-2">Established</span>
                    </div>
                </div>
            </div>

            <div class="space-y-8 reveal">
                <div class="space-y-4">
                    <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em] reveal reveal-delay-1">WHO WE
                        ARE</h2>
                    <h3 class="text-primary text-5xl font-display leading-tight reveal reveal-delay-2">TRUSTED QUALITY,
                        <br> ABSOLUTE RELIABILITY.
                    </h3>
                    <p class="text-slate-600 text-lg leading-relaxed reveal reveal-delay-3">
                        Hydria Construction Inc. is a trusted, family-run company rooted in Los Baños, Laguna.
                        With two decades of experience, we have built our reputation on a foundation of
                        unyielding quality and a commitment to transforming visions into reality.
                    </p>
                </div>

                <div class="grid gap-6">
                    <div
                        class="flex gap-4 p-6 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:shadow-md">
                        <div
                            class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-6 h-6 text-accent"></i>
                        </div>
                        <div>
                            <h4 class="text-primary font-black text-sm uppercase">Quality Craftsmanship</h4>
                            <p class="text-slate-500 text-sm mt-1">We use premium materials and proven techniques for
                                every build.</p>
                        </div>
                    </div>
                    <div
                        class="flex gap-4 p-6 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:shadow-md">
                        <div
                            class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-6 h-6 text-accent"></i>
                        </div>
                        <div>
                            <h4 class="text-primary font-black text-sm uppercase">On-Time Delivery</h4>
                            <p class="text-slate-500 text-sm mt-1">Rigorous project management keeps our construction on
                                schedule.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-24 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div
            class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#F15A24_1px,transparent_1px)] [background-size:40px_40px]">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 reveal">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
            <div class="space-y-4 reveal reveal-delay-1">
                <h2 class="text-accent font-display text-6xl md:text-7xl">Our Specialization</h2>
                <div class="w-24 h-1.5 bg-accent"></div>
            </div>
            <p class="text-white/60 text-lg max-w-md reveal reveal-delay-2">Comprehensive architectural and structural
                services tailored to your specific industrial or residential needs.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. Planning and Design -->
            <div
                class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="layout" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Planning and Design</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Every great structure starts with a clear plan. We
                    work closely with you to develop detailed designs that align with your vision, timeline, and site
                    requirements.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Architectural and Site Planning
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Structural and Engineering Design
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        2D Floor Plans and 3D Visualization
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Material and Specification Selection
                    </li>
                </ul>
            </div>

            <!-- 2. Estimating and Budgeting -->
            <div
                class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="calculator" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Estimating and Budgeting</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">No surprises, no hidden costs. We provide
                    accurate, itemized cost estimates so you can plan with confidence from start to finish.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Detailed Cost Breakdown
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Material and Labor Costing
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Budget Monitoring and Control
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Value Engineering Options
                    </li>
                </ul>
            </div>

            <!-- 3. Permit Acquisition -->
            <div
                class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="file-text" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Permit Acquisition</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">We handle the paperwork so you don't have to —
                    managing all approvals and ensuring your project is fully compliant before ground breaks.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Building Permit Processing
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Zoning and Land Use Compliance
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Barangay and LGU Clearances
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Document Preparation and Submission
                    </li>
                </ul>
            </div>

            <!-- 4. Consultation -->
            <div
                class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="users" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Consultation</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Not sure where to start? Our experts are here to
                    listen, advise, and guide you through every phase of your project — from concept to planning.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Initial Project Assessment
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Feasibility Study and Site Evaluation
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Design and Material Recommendations
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Timeline and Project Scoping
                    </li>
                </ul>
            </div>

            <!-- 5. Construction Works -->
            <div
                class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="hammer" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Construction Works</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">From groundbreaking to handover, we deliver
                    quality construction with skilled tradespeople, premium materials, and strict safety standards.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Excavation and Foundation Works
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Structural Framing and Concrete Works
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Masonry and Roofing
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Site Management and Safety Compliance
                    </li>
                </ul>
            </div>

            <!-- 6. Plumbing and Electrical Work -->
            <div
                class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="zap" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Plumbing and Electrical Work</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Safe, reliable systems behind every wall. Our
                    licensed plumbers and electricians install and maintain the utilities that keep your property
                    running smoothly.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Water Supply and Drainage Systems
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Electrical Wiring and Panel Installation
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Fixture and Outlet Installation
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Maintenance and Repair Services
                    </li>
                </ul>
            </div>

            <!-- 7. Interior and Exterior Finishes -->
            <div
                class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="paint-bucket" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Interior and Exterior Finishes</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">The details that make the difference. We bring
                    polish and personality to every surface — inside and out.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Flooring and Ceiling Works
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Wall Finishing and Painting
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Facade Cladding and Waterproofing
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Tile, Stone, and Decorative Works
                    </li>
                </ul>
            </div>

            <!-- 8. Renovation -->
            <div
                class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="refresh-cw" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Renovation</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Give your space a new life. We renovate with care
                    — preserving what matters while upgrading what doesn't.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Kitchen and Bathroom Remodeling
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Structural Repairs and Upgrades
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Full Property Overhaul
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Commercial Space Renovation
                    </li>
                </ul>
            </div>

            <!-- 9. Expansion -->
            <div
                class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="maximize" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Expansion</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Growing family, growing needs? We design and build
                    seamless additions that integrate naturally with your existing structure.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Room and Floor Additions
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Garage and Carport Extensions
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Second Floor and Rooftop Development
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Structural Integration and Reinforcement
                    </li>
                </ul>
            </div>

            <!-- 10. Glass Works -->
            <div
                class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div
                    class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="box" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Glass Works</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Elegant, modern, and built to last. We bring
                    light, openness, and sophistication to any space through quality glass installation.</p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Window and Door Glass Installation
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Glass Partitions and Curtain Walls
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Glass Railings and Balustrades
                    </li>
                    <li class="flex items-center gap-3 text-white/70 text-sm font-medium">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full"></span>
                        Tempered and Laminated Glass Supply
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Projects Gallery – Horizontal Carousel -->
<section id="projects" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Section Heading -->
        <div class="text-center space-y-3 mb-14 reveal">
            <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em]">OUR PORTFOLIO</h2>
            <h3 class="text-primary text-5xl font-display">ARCHITECTURAL MILESTONES</h3>
        </div>

        <!-- Mobile swipe hint (auto-fades) -->
        <div class="swipe-hint" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>
            Swipe to explore
        </div>

        <!-- Swiper Carousel -->
        <div class="swiper projects-swiper">
            <div class="swiper-wrapper">
                <?php
                require_once 'db.php';
                try {
                    $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
                            $title     = htmlspecialchars($row['title']    ?? 'Project Title');
                            $category  = htmlspecialchars($row['category'] ?? 'Category');
                            $image_url = htmlspecialchars($row['image_url'] ?? 'assets/villa.png');
                            if (strpos($image_url, 'assets/') === 0) {
                                $image_url = (isset($base_path) ? $base_path : '') . $image_url;
                            }
                            echo "
                            <div class=\"swiper-slide\">
                                <div class=\"proj-card\">
                                    <img src=\"$image_url\" alt=\"$title\" class=\"proj-img\" draggable=\"false\" loading=\"lazy\">
                                    <div class=\"proj-overlay\">
                                        <div class=\"proj-overlay-text\">
                                            <span class=\"proj-category\">$category</span>
                                            <h4 class=\"proj-title\">$title</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<div class=\"swiper-slide\"><p class='text-center py-20 text-slate-400'>No projects found in the database.</p></div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class=\"swiper-slide\"><p class='text-center py-20 text-slate-400'>Database connection error.</p></div>";
                }
                ?>
            </div>
        </div>

        <!-- Dot Pagination -->
        <div id="proj-pagination" class="flex justify-center gap-2 mt-10"></div>
    </div>
</section>

<style>
/* ═══════════════════════════════════════════════
   Projects Carousel — Full Responsive Styles
   Brand: Royal Blue #0A3D7C · Orange #F15A24
   ═══════════════════════════════════════════════ */

/* ── Carousel container ── */
.projects-swiper {
    overflow: visible;          /* allow edge-fade to work */
    width: 100%;
    padding-bottom: 4px;        /* room for box-shadow on cards */
    /* Mask: content fades at the right edge to hint at more slides */
    -webkit-mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 4%,
        black 88%,
        transparent 100%
    );
    mask-image: linear-gradient(
        to right,
        transparent 0%,
        black 4%,
        black 88%,
        transparent 100%
    );
}

/* On very small screens skip the left fade so the first card isn't clipped */
@media (max-width: 480px) {
    .projects-swiper {
        -webkit-mask-image: linear-gradient(
            to right,
            black 0%,
            black 88%,
            transparent 100%
        );
        mask-image: linear-gradient(
            to right,
            black 0%,
            black 88%,
            transparent 100%
        );
    }
}

/* ── Slide sizing ── */
.projects-swiper .swiper-slide {
    height: auto;               /* let aspect-ratio drive height */
    border-radius: 2rem;
    /* subtle 3-D depth shift as non-active slides recede */
    opacity: 0.85;
    transform: scale(0.97);
    transition: opacity 0.4s ease, transform 0.4s ease;
    will-change: transform, opacity;
}

/* Fully-visible/active slide */
.projects-swiper .swiper-slide-active,
.projects-swiper .swiper-slide-visible {
    opacity: 1;
    transform: scale(1);
}

/* ── Project card ── */
.proj-card {
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: 2rem;
    background: #e2e8f0;        /* slate-200 placeholder */

    /* Responsive card height via aspect-ratio */
    aspect-ratio: 4 / 5;

    box-shadow:
        0 4px 16px rgba(10, 61, 124, 0.10),
        0 1px  4px rgba(10, 61, 124, 0.06);

    cursor: grab;
    transition:
        box-shadow 0.4s ease,
        transform  0.4s ease;
}
.proj-card:active { cursor: grabbing; }

/* Lift & deepen shadow on hover (desktop) */
@media (hover: hover) {
    .proj-card:hover {
        box-shadow:
            0 20px 48px rgba(10, 61, 124, 0.18),
            0  6px 16px rgba(10, 61, 124, 0.10);
        transform: translateY(-4px);
    }
    /* Zoom image on card hover */
    .proj-card:hover .proj-img {
        transform: scale(1.08);
    }
    /* Reveal overlay on hover */
    .proj-card:hover .proj-overlay {
        opacity: 1;
    }
    .proj-card:hover .proj-overlay-text {
        transform: translateY(0);
        opacity: 1;
    }
}

/* ── Card image ── */
.proj-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    pointer-events: none;
    user-select: none;
    -webkit-user-drag: none;
}

/* ── Gradient overlay ── */
.proj-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(10, 61, 124, 0.92) 0%,
        rgba(10, 61, 124, 0.22) 50%,
        transparent 100%
    );
    opacity: 0;
    transition: opacity 0.45s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2rem;
}

/* ── Overlay text ── */
.proj-category {
    color: #F15A24;
    font-size: 0.7rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    margin-bottom: 0.4rem;
    font-family: Inter, sans-serif;
}

.proj-title {
    color: #fff;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.6rem;
    line-height: 1.15;
    margin: 0;
}

.proj-overlay-text {
    transform: translateY(12px);
    opacity: 0;
    transition:
        transform 0.45s cubic-bezier(0.22, 1, 0.36, 1),
        opacity   0.45s ease;
    transition-delay: 0.05s;
}

/* On touch devices always show overlay (no hover) */
@media (hover: none) {
    .proj-overlay {
        opacity: 1;
        background: linear-gradient(
            to top,
            rgba(10, 61, 124, 0.80) 0%,
            rgba(10, 61, 124, 0.10) 55%,
            transparent 100%
        );
    }
    .proj-overlay-text {
        transform: translateY(0);
        opacity: 1;
    }
}

/* ── Swipe hint badge (mobile only) ── */
.swipe-hint {
    display: none;
}

@media (max-width: 767px) {
    .swipe-hint {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin: 0 auto 1.5rem;
        padding: 0.35rem 0.9rem;
        background: rgba(10, 61, 124, 0.07);
        border: 1px solid rgba(10, 61, 124, 0.14);
        border-radius: 9999px;
        font-size: 0.72rem;
        font-weight: 700;
        color: #0A3D7C;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        /* Fade out after 3 s once the user starts scrolling */
        animation: hintFade 4s ease 1.5s forwards;
    }
    .swipe-hint svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        animation: nudge 1.2s ease-in-out infinite;
    }
    @keyframes nudge {
        0%, 100% { transform: translateX(0); }
        50%       { transform: translateX(4px); }
    }
    @keyframes hintFade {
        0%   { opacity: 1; }
        80%  { opacity: 1; }
        100% { opacity: 0; pointer-events: none; }
    }

    /* Slightly shorter cards on mobile */
    .proj-card {
        aspect-ratio: 3 / 4;
    }
}

/* ── Pagination dots ── */
#proj-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    margin-top: 2.25rem;
    min-height: 16px;
}

#proj-pagination .swiper-pagination-bullet {
    width: 8px;
    height: 8px;
    background: #0A3D7C;
    opacity: 0.22;
    border-radius: 9999px;
    transition: width 0.35s cubic-bezier(0.22, 1, 0.36, 1),
                background 0.25s ease,
                opacity 0.25s ease;
    cursor: pointer;
    display: inline-block;
    flex-shrink: 0;
}

#proj-pagination .swiper-pagination-bullet-active {
    width: 28px;
    background: #F15A24;
    opacity: 1;
}

/* ── Section heading responsive ── */
@media (max-width: 480px) {
    #projects h3.font-display {
        font-size: 2.4rem;
    }
}
</style>

<!-- Why Choose Us -->
<section class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="space-y-4 reveal">
                    <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em] reveal reveal-delay-1">WHY
                        HYDRIA</h2>
                    <h3 class="text-primary text-5xl font-display leading-tight reveal reveal-delay-2">WE BUILD FOR THE
                        <br> NEXT GENERATION
                    </h3>
                </div>

                <div class="space-y-6">
                    <div class="flex gap-6 reveal reveal-delay-1">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">01</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Unmatched Expertise</h4>
                            <p class="text-slate-500">20+ years of local presence in Laguna means we understand the
                                terrain and the standards perfectly.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 reveal reveal-delay-2">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">02</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Transparency First</h4>
                            <p class="text-slate-500">Clear budgeting and regular updates. No hidden costs, no
                                surprises—just honest construction.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 reveal reveal-delay-3">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">03</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Modern Standards</h4>
                            <p class="text-slate-500">We integrate the latest structural technologies and eco-friendly
                                practices in all our builds.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div
                    class="aspect-square rounded-full border-[32px] border-white shadow-2xl overflow-hidden relative z-10">
                    <img src="<?php echo isset($base_path) ? $base_path : ''; ?>assets/logo.png" alt="Modern Building"
                        class="w-full h-full object-cover">
                </div>
                <div
                    class="absolute -top-10 -left-10 w-40 h-40 bg-accent rounded-full blur-3xl opacity-20 animate-pulse">
                </div>
                <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-primary rounded-full blur-3xl opacity-10"></div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>