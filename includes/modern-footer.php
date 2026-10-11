<?php
require_once __DIR__ . '/config.php';
?>
<!-- Modern Corporate Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-top-grid">
            <!-- Col 1: Brand & Credentials -->
            <div class="footer-brand-col">
                <a href="<?php echo $base_url; ?>/" aria-label="Fescon Homepage">
                    <img src="<?php echo $base_url; ?>/assets/images/logo.png" alt="Fescon (Pvt.) Ltd" class="footer-logo-img">
                </a>
                <p class="footer-bio-text">
                    Fescon (Pvt.) Ltd is an accredited engineering, procurement, construction (EPC), and infrastructure development contractor specializing in high-voltage substations, power transmission, civil works, and integrated MEP solutions across Pakistan.
                </p>
                <div class="footer-pec-badge">
                    <i class="fas fa-award"></i> Registered with Pakistan Engineering Council (PEC) - Category C-A (No Limit)
                </div>
                <div class="footer-social-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="social-circle-btn" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://wa.me/923008815488" target="_blank" rel="noopener noreferrer" class="social-circle-btn" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:info@fescon.com.pk" class="social-circle-btn" aria-label="Email Us">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Core Engineering Capabilities -->
            <div>
                <h4 class="footer-col-title">Core Services</h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=planning-and-designing"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Planning &amp; Designing</a></li>
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=epc-projects"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Turnkey EPC Projects</a></li>
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=energy-transmission-distribution"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Energy Transmission</a></li>
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=operation-maintenance"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Operation &amp; Maintenance</a></li>
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=mep-solutions"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> MEP Solutions</a></li>
                    <li><a href="<?php echo $base_url; ?>/service-detail.php?service=civil-works"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Heavy Civil Infrastructure</a></li>
                </ul>
            </div>

            <!-- Col 3: Company & Policies -->
            <div>
                <h4 class="footer-col-title">Quick Links</h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo $base_url; ?>/about-us/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> About Fescon</a></li>
                    <li><a href="<?php echo $base_url; ?>/projects/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Portfolio &amp; Projects</a></li>
                    <li><a href="<?php echo $base_url; ?>/certifications/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Certifications &amp; ISO</a></li>
                    <li><a href="<?php echo $base_url; ?>/collaborations/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Client Collaborations</a></li>
                    <li><a href="<?php echo $base_url; ?>/hse-policy/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> HSE Policy &amp; Safety</a></li>
                    <li><a href="<?php echo $base_url; ?>/welfare-policy/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Welfare &amp; CSR Policies</a></li>
                    <li><a href="<?php echo $base_url; ?>/careers/"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i> Careers &amp; Jobs</a></li>
                </ul>
            </div>

            <!-- Col 4: Corporate Head Office -->
            <div>
                <h4 class="footer-col-title">Head Office</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Islamabad, Pakistan</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span><a href="tel:+923008815488" style="color:inherit;">+92 300 8815488</a></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span><a href="mailto:info@fescon.com.pk" style="color:inherit;">info@fescon.com.pk</a></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-globe"></i>
                    <span><a href="https://fescon.com.pk" target="_blank" rel="noopener noreferrer" style="color:inherit;">www.fescon.com.pk</a></span>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom-bar">
            <div class="footer-bottom-flex">
                <p>&copy; <?php echo date('Y'); ?> Fescon (Pvt.) Ltd. All Rights Reserved. Engineered with precision.</p>
                <p>Licensed by Pakistan Engineering Council (PEC) | Category C-A (No Limit)</p>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Action Widgets -->
<div class="floating-actions-container">
    <a href="https://wa.me/923008815488" target="_blank" rel="noopener noreferrer" class="floating-whatsapp-btn" title="Chat on WhatsApp" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <button class="scroll-top-btn" title="Scroll to top" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<!-- JavaScript Dependencies -->
<script src="<?php echo $base_url; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/swiper.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/modern-theme.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/main.js"></script>

</body>
</html>
