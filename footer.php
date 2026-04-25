<!-- Contact & Footer -->
<footer class="footer" id="contact">
    <div class="container footer-container">
        <div class="footer-info">
            <a href="#" class="logo footer-logo">
                <span class="logo-text">HYDRIA CONSTRUCTION</span>
            </a>
            <?php
            $settings = [];
            try {
                require_once 'db.php';
                $stmt = $pdo->query("SELECT s_key, s_value FROM settings");
                while ($row = $stmt->fetch()) {
                    $settings[$row['s_key']] = $row['s_value'];
                }
            } catch (PDOException $e) {}
            ?>
            <p class="footer-desc"><?= htmlspecialchars($settings['footer_desc'] ?? 'Building excellence for over 20 years. Let\'s discuss your next project.') ?></p>
            <div class="contact-details">
                <p>📍 <?= htmlspecialchars($settings['company_address'] ?? 'Batong Malake, Los Baños, Laguna') ?></p>
                <p>📞 <?= htmlspecialchars($settings['company_phone'] ?? '+63 123 456 7890') ?></p>
                <p>✉️ <?= htmlspecialchars($settings['company_email'] ?? 'info@hydriaconstruction.com') ?></p>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/hydriaconstruction" target="_blank" rel="noopener noreferrer"
                    class="social-icon">Facebook</a>
            </div>
        </div>

        <div class="footer-form">
            <h3 class="form-title">Send Us a Message</h3>
            <form class="contact-form" id="contactForm">
                <input type="text" placeholder="Your Name" required class="form-input">
                <input type="email" placeholder="Your Email" required class="form-input">
                <select class="form-input" required>
                    <option value="" disabled selected>Service Interested In</option>
                    <option value="residential">Residential</option>
                    <option value="commercial">Commercial</option>
                    <option value="industrial">Industrial</option>
                    <option value="other">Other</option>
                </select>
                <textarea placeholder="Tell us about your project..." rows="4" required class="form-input"></textarea>
                <button type="submit" class="btn btn-primary btn-block">Submit Inquiry</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Hydria Construction Inc. All rights reserved. <a href="login.php" class="staff-login">Staff Login</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="script.js"></script>
</body>

</html>