<?php include_once 'header.php'; ?>

<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-bg">
        <img src="assets/web_bg.png" alt="Construction Site Background">
    </div>
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1 data-aos="zoom-out" data-aos-duration="1200">20 Years of Building Excellence</h1>
        <p data-aos="fade-up" data-aos-delay="200">Making your vision a reality in Los Baños and beyond. We deliver
            premium
            quality residential, commercial, and industrial construction solutions.</p>
        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
            <a href="#projects" class="btn btn-primary">Explore Our Work</a>
            <a href="#contact" class="btn btn-outline">Contact Us Today</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about" id="about">
    <div class="container about-container">
        <div class="about-text" data-aos="fade-right">
            <h2 class="section-title">Who We Are</h2>
            <p>Hydria Construction Inc. is a trusted, family-run company rooted in Los Baños, Laguna. With two
                decades of experience, we have built our reputation on a foundation of unyielding quality, absolute
                reliability, and a commitment to transforming our clients' visions into concrete reality.</p>
            <ul class="about-features">
                <li data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">✓</div>
                    <div>
                        <h3>Quality Craftsmanship</h3>
                        <p>We use premium materials and proven techniques.</p>
                    </div>
                </li>
                <li data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">✓</div>
                    <div>
                        <h3>On-Time Delivery</h3>
                        <p>Rigorous project management keeps us on schedule.</p>
                    </div>
                </li>
                <li data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">✓</div>
                    <div>
                        <h3>Client-Centric Approach</h3>
                        <p>Your vision and satisfaction are our top priorities.</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="about-image" data-aos="zoom-in">
            <div class="glass-card experience-card">
                <span class="experience-number">20+</span>
                <span class="experience-text">Years of<br>Experience</span>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services section-dark" id="services">
    <div class="container">
        <div class="section-header text-center" data-aos="flip-up">
            <h2 class="section-title">Our Services</h2>
            <p>Comprehensive construction solutions tailored to your specific needs.</p>
        </div>

        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">🏠</div>
                <h3 class="service-title">Residential Construction</h3>
                <p class="service-desc">From custom dream homes to complete renovations, we build comfortable and
                    durable living spaces.</p>
            </div>
            <!-- Service 2 -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">🏢</div>
                <h3 class="service-title">Commercial Builds</h3>
                <p class="service-desc">Creating functional and inspiring commercial spaces, offices, and retail
                    establishments.</p>
            </div>
            <!-- Service 3 -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">🏭</div>
                <h3 class="service-title">Industrial Facilities</h3>
                <p class="service-desc">Robust and scalable industrial construction designed for maximum operational
                    efficiency.</p>
            </div>
            <!-- Service 4 -->
            <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                <div class="service-icon">📋</div>
                <h3 class="service-title">Project Management</h3>
                <p class="service-desc">Expert oversight, from initial planning and budgeting to final execution and
                    handover.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="projects" id="projects">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Work Gallery</h2>
            <p>Showcasing our architectural milestones.</p>
        </div>

        <div class="bento-grid">
            <?php
            require_once 'db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                $i = 0;

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                        $title = htmlspecialchars($row['title'] ?? 'Project Title');
                        $category = htmlspecialchars($row['category'] ?? 'Category');
                        $image_url = htmlspecialchars($row['image_url'] ?? '');

                        // Every 3rd project is large
                        $isLarge = ($i % 3 == 0) ? 'large' : '';
                        $animation = ($i % 2 == 0) ? 'fade-right' : 'fade-left';
                        if ($isLarge)
                            $animation = 'zoom-in';

                        echo "<div class=\"project-card $isLarge\" data-aos=\"$animation\" data-aos-delay=\"" . (($i % 3) * 100) . "\">";
                        if (!empty($image_url)) {
                            echo "    <img src=\"$image_url\" alt=\"$title\" class=\"project-img-placeholder\" style=\"object-fit: cover; display: block;\">";
                        } else {
                            echo "    <div class=\"project-img-placeholder\" style=\"background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));\"></div>";
                        }
                        echo "    <div class=\"project-info\">";
                        echo "        <h3>$title</h3>";
                        echo "        <p>$category</p>";
                        echo "    </div>";
                        echo "</div>";

                        $i++;
                    }
                } else {
                    echo "<p>No projects found in the database.</p>";
                }
            } catch (PDOException $e) {
                echo "<p>Projects database not initialized yet.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Contact Section (Footer include will handle this, but let's ensure contact ID exists) -->
<section id="contact" style="padding:0;"></section>

<?php include_once 'footer.php'; ?>