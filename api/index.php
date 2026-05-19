<?php include_once 'header.php'; ?>

<!-- Hero Section -->
<section id="home" class="hero-bg relative pt-40 pb-28 md:pt-48 md:pb-36 lg:pt-56 lg:pb-40">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -bottom-20 -left-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-0 w-[400px] h-[400px] bg-accent/5 rounded-full blur-2xl"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 reveal">
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/20">
                <span class="w-2 h-2 bg-accent rounded-full animate-pulse-glow"></span>
                <span class="text-white text-xs font-bold uppercase tracking-widest">Trusted Since 2004 · Los Baños, Laguna</span>
            </div>

            <h1 class="font-display text-5xl md:text-6xl lg:text-7xl text-white leading-tight flex flex-col gap-2">
                <span class="reveal reveal-delay-1">BUILDING</span>
                <span class="text-accent reveal reveal-delay-2">EXCELLENCE</span>
                <span class="flex items-center gap-4 reveal reveal-delay-3">
                    FOR <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/20 border-accent/20" style="-webkit-text-stroke: 1px #C9A84C;">20 YEARS</span>
                </span>
            </h1>

            <p class="text-white/60 text-lg md:text-xl max-w-xl leading-relaxed reveal reveal-delay-4">
                Hydria Construction Inc. delivers premium quality <span class="text-white font-bold underline decoration-accent/50 underline-offset-4">residential, commercial, and industrial</span> solutions in Los Baños and beyond.
            </p>

            <div class="flex flex-wrap gap-5 pt-6 pb-4 reveal reveal-delay-5">
                <a href="#contact" class="group inline-flex items-center gap-2 px-8 py-4 bg-accent hover:bg-[#B3933B] text-white font-black text-sm rounded-xl transition-all duration-300 shadow-xl shadow-accent/20 hover:shadow-accent/40 hover:scale-105">
                    GET A FREE QUOTE
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#projects" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white/20 hover:border-white text-white font-black text-sm rounded-xl transition-all duration-300 hover:bg-white/5">
                    VIEW OUR WORK
                </a>
            </div>
        </div>

        <!-- Hero Stats Card -->
        <div class="flex flex-col gap-4 reveal reveal-delay-4 mt-8 lg:mt-0">
            <div class="bg-white/80 backdrop-blur-md shadow-2xl border border-primary/10 rounded-3xl p-8 hover:border-accent/40 transition-all reveal reveal-delay-5">
                <div class="text-6xl font-display text-accent">20+</div>
                <div class="text-primary font-black text-xl mt-1">Years of Experience</div>
                <div class="text-slate-500 text-sm mt-1 font-bold italic">Building a legacy of quality craftsmanship.</div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/80 backdrop-blur-md shadow-xl border border-primary/10 rounded-3xl p-6 reveal reveal-delay-6">
                    <div class="text-4xl font-display text-primary">500+</div>
                    <div class="text-primary font-bold text-sm mt-1 uppercase tracking-tighter">Projects Done</div>
                </div>
                <div class="bg-primary border border-primary rounded-3xl p-6 shadow-xl shadow-primary/20 reveal reveal-delay-7">
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
                    <img src="assets/highlight.jpg" alt="Construction Quality" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 md:-bottom-10 md:-right-10 bg-primary p-6 md:p-10 rounded-[1.5rem] md:rounded-[2rem] shadow-2xl border-4 border-white">
                    <div class="text-center">
                        <span class="block text-3xl md:text-5xl font-display text-accent">2004</span>
                        <span class="block text-white text-[10px] md:text-xs font-black uppercase tracking-[0.2em] mt-2">Established</span>
                    </div>
                </div>
            </div>
            
            <div class="space-y-8 reveal">
                <div class="space-y-4">
                    <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em] reveal reveal-delay-1">WHO WE ARE</h2>
                    <h3 class="text-primary text-5xl font-display leading-tight reveal reveal-delay-2">TRUSTED QUALITY, <br> ABSOLUTE RELIABILITY.</h3>
                    <p class="text-slate-600 text-lg leading-relaxed reveal reveal-delay-3">
                        Hydria Construction Inc. is a trusted, family-run company rooted in Los Baños, Laguna. 
                        With two decades of experience, we have built our reputation on a foundation of 
                        unyielding quality and a commitment to transforming visions into reality.
                    </p>
                </div>

                <div class="grid gap-6">
                    <div class="flex gap-4 p-6 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:shadow-md">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check-circle-2" class="w-6 h-6 text-accent"></i>
                        </div>
                        <div>
                            <h4 class="text-primary font-black text-sm uppercase">Quality Craftsmanship</h4>
                            <p class="text-slate-500 text-sm mt-1">We use premium materials and proven techniques for every build.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-6 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:shadow-md">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-6 h-6 text-accent"></i>
                        </div>
                        <div>
                            <h4 class="text-primary font-black text-sm uppercase">On-Time Delivery</h4>
                            <p class="text-slate-500 text-sm mt-1">Rigorous project management keeps our construction on schedule.</p>
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
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#C9A84C_1px,transparent_1px)] [background-size:40px_40px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 reveal">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
            <div class="space-y-4 reveal reveal-delay-1">
                <h2 class="text-accent font-display text-6xl md:text-7xl">Our Specialization</h2>
                <div class="w-24 h-1.5 bg-accent"></div>
            </div>
            <p class="text-white/60 text-lg max-w-md reveal reveal-delay-2">Comprehensive architectural and structural services tailored to your specific industrial or residential needs.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. Planning and Design -->
            <div class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="layout" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Planning and Design</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Every great structure starts with a clear plan. We work closely with you to develop detailed designs that align with your vision, timeline, and site requirements.</p>
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
            <div class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="calculator" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Estimating and Budgeting</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">No surprises, no hidden costs. We provide accurate, itemized cost estimates so you can plan with confidence from start to finish.</p>
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
            <div class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="file-text" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Permit Acquisition</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">We handle the paperwork so you don't have to — managing all approvals and ensuring your project is fully compliant before ground breaks.</p>
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
            <div class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="users" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Consultation</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Not sure where to start? Our experts are here to listen, advise, and guide you through every phase of your project — from concept to planning.</p>
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
            <div class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="hammer" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Construction Works</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">From groundbreaking to handover, we deliver quality construction with skilled tradespeople, premium materials, and strict safety standards.</p>
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
            <div class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="zap" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Plumbing and Electrical Work</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Safe, reliable systems behind every wall. Our licensed plumbers and electricians install and maintain the utilities that keep your property running smoothly.</p>
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
            <div class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="paint-bucket" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Interior and Exterior Finishes</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">The details that make the difference. We bring polish and personality to every surface — inside and out.</p>
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
            <div class="reveal reveal-delay-2 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="refresh-cw" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Renovation</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Give your space a new life. We renovate with care — preserving what matters while upgrading what doesn't.</p>
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
            <div class="reveal reveal-delay-3 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="maximize" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Expansion</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Growing family, growing needs? We design and build seamless additions that integrate naturally with your existing structure.</p>
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
            <div class="reveal reveal-delay-1 group bg-[#1a1a1a] p-10 rounded-[2.5rem] transition-all duration-500 hover:scale-[1.02] border border-white/5 hover:border-accent/30 hover:shadow-2xl hover:shadow-accent/5">
                <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                    <i data-lucide="box" class="w-8 h-8 text-white"></i>
                </div>
                <h4 class="text-white text-2xl font-bold mb-4">Glass Works</h4>
                <p class="text-white/40 text-sm mb-8 leading-relaxed">Elegant, modern, and built to last. We bring light, openness, and sophistication to any space through quality glass installation.</p>
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

<!-- Projects Gallery -->
<section id="projects" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em]">OUR PORTFOLIO</h2>
            <h3 class="text-primary text-5xl font-display">ARCHITECTURAL MILESTONES</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            require_once 'db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                $i = 0;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                        $title = htmlspecialchars($row['title'] ?? 'Project Title');
                        $category = htmlspecialchars($row['category'] ?? 'Category');
                        $image_url = htmlspecialchars($row['image_url'] ?? 'assets/villa.png');
                        
                        echo "
                        <div class=\"reveal reveal-delay-1 group relative overflow-hidden rounded-[2rem] bg-slate-100 aspect-[4/5] shadow-lg hover:shadow-2xl transition-all duration-500\">
                            <img src=\"$image_url\" alt=\"$title\" class=\"w-full h-full object-cover transition-transform duration-700 group-hover:scale-110\">
                            <div class=\"absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-10\">
                                <span class=\"text-accent font-black text-xs uppercase tracking-widest mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500\">$category</span>
                                <h4 class=\"text-white text-2xl font-display transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75\">$title</h4>
                            </div>
                        </div>";
                        $i++;
                    }
                } else {
                    echo "<p class='col-span-full text-center py-20 text-slate-400'>No projects found in the database.</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='col-span-full text-center py-20 text-slate-400'>Database connection error.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-24 bg-slate-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="space-y-4 reveal">
                    <h2 class="text-accent font-black text-sm uppercase tracking-[0.3em] reveal reveal-delay-1">WHY HYDRIA</h2>
                    <h3 class="text-primary text-5xl font-display leading-tight reveal reveal-delay-2">WE BUILD FOR THE <br> NEXT GENERATION</h3>
                </div>
                
                <div class="space-y-6">
                    <div class="flex gap-6 reveal reveal-delay-1">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">01</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Unmatched Expertise</h4>
                            <p class="text-slate-500">20+ years of local presence in Laguna means we understand the terrain and the standards perfectly.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 reveal reveal-delay-2">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">02</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Transparency First</h4>
                            <p class="text-slate-500">Clear budgeting and regular updates. No hidden costs, no surprises—just honest construction.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 reveal reveal-delay-3">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent font-bold">03</span>
                        </div>
                        <div>
                            <h4 class="text-primary font-bold text-lg mb-2">Modern Standards</h4>
                            <p class="text-slate-500">We integrate the latest structural technologies and eco-friendly practices in all our builds.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="aspect-square rounded-full border-[32px] border-white shadow-2xl overflow-hidden relative z-10">
                    <img src="assets/hero.png" alt="Modern Building" class="w-full h-full object-cover">
                </div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-accent rounded-full blur-3xl opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-primary rounded-full blur-3xl opacity-10"></div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>