<?php
/**
 * Fescon (Pvt.) Ltd - Modern Corporate Homepage
 * Precision Engineering, Turnkey EPC, Transmission, Substations & Infrastructure
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = "Fescon (Pvt.) Ltd | Engineering Excellence, Power Transmission & Turnkey EPC";
$current_page = 'index';

// Fetch dynamic data from database
$slider_clients = get_all_clients();
$services = get_all_services();
$featured_projects = get_projects(['featured' => 1]);
if (empty($featured_projects)) {
    $featured_projects = array_slice(get_projects(), 0, 6);
}

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- 1. CINEMATIC PARALLAX HERO SECTION -->
<section class="hero-section" id="hero">
    <div class="hero-parallax-bg" aria-hidden="true"></div>
    <div class="hero-overlay-gradient" aria-hidden="true"></div>
    <div class="hero-grid-mesh" aria-hidden="true"></div>

    <div class="container">
        <div class="hero-content-wrapper" data-reveal>
            <div class="hero-badge">
                <i class="fas fa-bolt"></i> PEC Category C-A (No Limit) &bull; 30+ Years Leadership
            </div>

            <h1 class="hero-title">
                POWERING NATIONS. <br>
                BUILDING <span class="accent">INFRASTRUCTURE.</span>
            </h1>

            <p class="hero-description">
                Fescon (Pvt.) Ltd is a trusted turnkey EPC and infrastructure engineering contractor delivering high-voltage substations, grid transmission networks, heavy civil works, and integrated MEP solutions for national utilities and industrial leaders across Pakistan.
            </p>

            <div class="hero-cta-group">
                <a href="#services" class="btn btn-primary">
                    <i class="fas fa-layer-group"></i> Our Capabilities
                </a>
                <a href="#projects" class="btn btn-outline-white">
                    <i class="fas fa-project-diagram"></i> Explore Projects
                </a>
                <a href="tel:+923041112766" class="btn btn-outline-white" style="border-color:rgba(211,47,47,0.5);">
                    <i class="fas fa-phone-alt" style="color:var(--brand-red-bright);"></i> +92 304 1112766
                </a>
            </div>

            <!-- Floating Key Metrics Grid -->
            <div class="hero-stats-grid">
                <div class="hero-stat-card" data-reveal data-reveal-delay="100">
                    <div class="hero-stat-number">
                        <span class="counter-val" data-target="30">30</span><span class="plus">+</span>
                    </div>
                    <div class="hero-stat-label">Years of Proven Engineering Delivery</div>
                </div>

                <div class="hero-stat-card" data-reveal data-reveal-delay="200">
                    <div class="hero-stat-number">
                        <span class="counter-val" data-target="200">200</span><span class="plus">+</span>
                    </div>
                    <div class="hero-stat-label">Grid &amp; EPC Infrastructure Projects</div>
                </div>

                <div class="hero-stat-card" data-reveal data-reveal-delay="300">
                    <div class="hero-stat-number">
                        <span class="counter-val" data-target="500">500</span><span class="plus">MW+</span>
                    </div>
                    <div class="hero-stat-label">Transmission &amp; Substation Capacity</div>
                </div>

                <div class="hero-stat-card" data-reveal data-reveal-delay="400">
                    <div class="hero-stat-number">
                        <span class="counter-val" data-target="100">100</span><span class="plus">%</span>
                    </div>
                    <div class="hero-stat-label">Safety Compliance &amp; Zero Lost-Time Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. TRUSTED CLIENTS & PARTNERS INFINITE MARQUEE -->
<section class="clients-section">
    <div class="container">
        <div class="clients-intro-row">
            <span class="clients-intro-text">Trusted by National Power Utilities &amp; Key Institutions</span>
            <a href="<?php echo $base_url; ?>/collaborations/" style="color:#94a3b8; font-size:0.82rem; font-weight:600;">
                View All Partners <i class="fas fa-arrow-right" style="color:var(--brand-red-bright); margin-left:4px;"></i>
            </a>
        </div>
    </div>

    <div class="marquee-container" aria-label="Client and partner logos">
        <div class="marquee-track">
            <?php for ($rep = 0; $rep < 2; $rep++): ?>
                <?php foreach ($slider_clients as $sc): ?>
                    <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($sc['slug']); ?>" 
                       title="View projects completed with <?php echo htmlspecialchars($sc['name']); ?>" 
                       class="client-logo-card">
                        <img src="<?php echo htmlspecialchars(asset_url($sc['logo_url'])); ?>" 
                             alt="<?php echo htmlspecialchars($sc['name']); ?>" 
                             loading="lazy">
                    </a>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- 3. CEO MESSAGE & LEADERSHIP SPOTLIGHT -->
<section class="about-spotlight-section" id="ceo-message">
    <div class="container">
        <div class="about-grid">
            <div class="about-visual-column" data-reveal>
                <div class="about-image-frame">
                    <img src="<?php echo $base_url; ?>/assets/images/ceo-message.jpg" alt="Engr. Ehsan Ullah - CEO" loading="lazy" style="object-position: center top;">
                </div>
                <div class="about-experience-badge">
                    <div class="years">15+</div>
                    <div class="text">Years of Executive Leadership</div>
                </div>
            </div>

            <div class="about-content-column" data-reveal data-reveal-delay="200">
                <span class="section-tag"><i class="fas fa-quote-left"></i> Executive Leadership</span>
                <h2 class="section-title" style="margin-bottom: 20px;">
                    CEO <span class="highlight">Message</span>
                </h2>
                
                <div class="ceo-signature-intro" style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-light);">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.3rem; font-weight: 800; color: #0f172a; font-family: 'Cinzel', serif; letter-spacing: 0.02em;">ENGR. EHSAN ULLAH</div>
                        <div style="font-size: 0.88rem; color: var(--brand-red); font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;">CEO</div>
                    </div>
                </div>

                <div class="ceo-message-quote" style="background: var(--bg-light-alt); border-left: 4px solid var(--brand-red); padding: 26px 28px; border-radius: var(--radius-sm); margin-bottom: 22px;">
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0 0 14px;">
                        "Welcome to FESCON Pakistan. We are committed to delivering engineering excellence through innovative, reliable, and sustainable solutions across infrastructure, energy, industrial, building projects and Oil and Gas field. Our success is built on professionalism, quality, safety, and long-term partnerships."
                    </p>
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0;">
                        "With a highly skilled team and a client-focused approach, we strive to exceed expectations by delivering every project with precision, integrity, and technical expertise—contributing to Pakistan’s continued growth and development."
                    </p>
                </div>

                <div style="display:flex; gap:16px; align-items:center; flex-wrap:wrap;">
                    <a href="<?php echo $base_url; ?>/the-founder.php" class="btn btn-primary">
                        <i class="fas fa-user-tie"></i> View Bio
                    </a>
                    <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-outline-dark">
                        <i class="fas fa-paper-plane"></i> Contact CEO Office
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. MODERN CORE ENGINEERING SERVICES -->
<section class="services-section" id="services">
    <div class="container">
        <div class="text-center" data-reveal>
            <span class="section-tag"><i class="fas fa-tools"></i> Capabilities</span>
            <h2 class="section-title">
                Comprehensive <span class="highlight">Engineering Portfolios</span>
            </h2>
            
        </div>

        <div class="services-grid">
            <?php foreach ($services as $idx => $s): ?>
                <div class="service-modern-card" data-reveal data-reveal-delay="<?php echo ($idx % 3) * 150; ?>">
                    <div class="service-card-media">
                        <img src="<?php echo htmlspecialchars(asset_url($s['image_url'])); ?>" 
                             alt="<?php echo htmlspecialchars($s['name']); ?>" 
                             loading="lazy">
                        <div class="service-card-overlay"></div>
                        <div class="service-card-icon-box">
                            <i class="<?php echo htmlspecialchars($s['icon_class'] ?? 'fas fa-cog'); ?>"></i>
                        </div>
                    </div>

                    <div class="service-card-body">
                        <h3 class="service-card-title">
                            <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($s['slug']); ?>">
                                <?php echo htmlspecialchars($s['name']); ?>
                            </a>
                        </h3>
                        <p class="service-card-description">
                            <?php echo htmlspecialchars($s['short_description']); ?>
                        </p>

                        <ul class="service-card-features">
                            <?php 
                            $service_bullets = get_service_features($s['slug']);
                            foreach ($service_bullets as $bullet): 
                            ?>
                                <li class="service-card-feature-item">
                                    <i class="fas fa-check"></i> <?php echo htmlspecialchars($bullet); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div>
                            <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($s['slug']); ?>" class="service-card-link-btn">
                                Explore Service <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 5. CINEMATIC PARALLAX FEATURED PROJECTS SHOWCASE -->
<section class="parallax-projects-section" id="projects">
    <div class="parallax-projects-bg" aria-hidden="true"></div>
    <div class="parallax-projects-overlay" aria-hidden="true"></div>

    <div class="container projects-content-wrapper">
        <div class="text-center" data-reveal>
            <span class="section-tag"><i class="fas fa-project-diagram"></i> Proven Track Record</span>
            <h2 class="section-title">
                Featured <span class="highlight">Infrastructure Projects</span>
            </h2>
            
        </div>

        <!-- Filter Tabs -->
        <div class="projects-filter-bar" data-reveal>
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="epc-projects">EPC Projects</button>
            <button class="filter-btn" data-filter="energy-transmission-distribution">Transmission &amp; Grid</button>
            <button class="filter-btn" data-filter="planning-and-designing">Planning &amp; Design</button>
        </div>

        <!-- Projects Grid -->
        <div class="projects-grid">
            <?php foreach ($featured_projects as $pidx => $p): ?>
                <div class="project-card" 
                     data-category="<?php echo htmlspecialchars($p['service_slug'] ?? 'all'); ?>" 
                     data-reveal data-reveal-delay="<?php echo ($pidx % 3) * 150; ?>">
                    <div class="project-card-image">
                        <img src="<?php echo htmlspecialchars(asset_url($p['image_url'])); ?>" 
                             alt="<?php echo htmlspecialchars($p['title']); ?>" 
                             loading="lazy">
                        <?php if (!empty($p['client_name'])): ?>
                            <div class="project-client-badge">
                                <i class="fas fa-handshake" style="color:var(--brand-red-bright);"></i>
                                <?php echo htmlspecialchars(explode(' ', $p['client_name'])[0]); ?>
                            </div>
                        <?php endif; ?>
                        <div class="project-status-badge">
                            <?php echo htmlspecialchars($p['status'] ?? 'Completed'); ?>
                        </div>
                    </div>

                    <div class="project-card-body">
                        <div class="project-meta-row">
                            <span class="project-meta-item"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($p['location'] ?? 'Pakistan'); ?></span>
                            <?php if (!empty($p['completion_year'])): ?>
                                <span class="project-meta-item"><i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($p['completion_year']); ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="project-card-title">
                            <a href="<?php echo $base_url; ?>/project-detail.php?project=<?php echo urlencode($p['slug']); ?>">
                                <?php echo htmlspecialchars($p['title']); ?>
                            </a>
                        </h3>

                        <p class="project-card-summary">
                            <?php echo htmlspecialchars($p['summary'] ?? $p['description'] ?? ''); ?>
                        </p>

                        <div class="project-card-footer">
                            <span class="project-service-tag">
                                <i class="<?php echo htmlspecialchars($p['service_icon'] ?? 'fas fa-bolt'); ?>"></i>
                                <?php echo htmlspecialchars($p['service_name'] ?? 'Engineering'); ?>
                            </span>
                            <a href="<?php echo $base_url; ?>/project-detail.php?project=<?php echo urlencode($p['slug']); ?>" class="project-view-link">
                                Details <i class="fas fa-chevron-right" style="font-size:0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center" style="margin-top: 50px;" data-reveal>
            <a href="<?php echo $base_url; ?>/projects/" class="btn btn-primary">
                <i class="fas fa-th-large"></i> Explore All Completed Projects
            </a>
        </div>
    </div>
</section>

<!-- 6. WHY CHOOSE FESCON / ENGINEERING STRENGTHS -->
<section class="strengths-section">
    <div class="container">
        <div class="text-center" data-reveal>
            <span class="section-tag"><i class="fas fa-medal"></i> Why Fescon</span>
            <h2 class="section-title">
                The Gold Standard in <span class="highlight">Infrastructure Reliability</span>
            </h2>
            
        </div>

        <div class="strengths-grid">
            <div class="strength-card" data-reveal data-reveal-delay="100">
                <div class="strength-icon-box">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="strength-card-title">Category C-A Accreditation</h3>
                <p class="strength-card-text">
                    Highest category license issued by Pakistan Engineering Council with 'No Limit' on financial project size, enabling full-scale national infrastructure participation.
                </p>
            </div>

            <div class="strength-card" data-reveal data-reveal-delay="200">
                <div class="strength-icon-box">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3 class="strength-card-title">Zero-Harm HSE Culture</h3>
                <p class="strength-card-text">
                    Robust occupational health, environmental, and safety frameworks adhering to ISO 45001 and ISO 14001, maintaining an industry-leading zero lost-time accident record.
                </p>
            </div>

            <div class="strength-card" data-reveal data-reveal-delay="300">
                <div class="strength-icon-box">
                    <i class="fas fa-truck-monster"></i>
                </div>
                <h3 class="strength-card-title">Heavy Fleet &amp; Instrumentation</h3>
                <p class="strength-card-text">
                    Company-owned high-precision diagnostic tools, dielectric test sets, boom cranes, cable-pulling winches, and concrete batching units for rapid mobilization.
                </p>
            </div>

            <div class="strength-card" data-reveal data-reveal-delay="400">
                <div class="strength-icon-box">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h3 class="strength-card-title">Technical Expertise</h3>
                <p class="strength-card-text">
                    Multidisciplinary teams of PEC-registered electrical, civil, and mechanical engineers with specialized expertise in high-voltage grids and industrial plant construction.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 7. CERTIFICATIONS & ACCREDITATIONS CAROUSEL -->
<section class="certifications-section">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px;" data-reveal>
            <div>
                <span class="section-tag"><i class="fas fa-stamp"></i> Compliance &amp; Enlistments</span>
                <h2 class="section-title" style="margin-bottom:0;">
                    Official <span class="highlight">Registrations</span> &amp; Licenses
                </h2>
            </div>
            <a href="<?php echo $base_url; ?>/certifications/" class="btn btn-outline-dark btn-sm">
                View All Certifications <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="cert-carousel-wrapper" data-reveal>
            <div class="swiper cert-swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="cert-card">
                            <img src="<?php echo $base_url; ?>/assets/images/cer.png" alt="Pakistan Engineering Council Category C-A" loading="lazy">
                            <h4 class="cert-title">PEC License C-A</h4>
                            <span class="cert-issuer">Pakistan Engineering Council</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="cert-card">
                            <img src="<?php echo $base_url; ?>/assets/images/img-1.png" alt="ISO 9001 Quality Management Certification" loading="lazy">
                            <h4 class="cert-title">ISO 9001:2015</h4>
                            <span class="cert-issuer">Quality Management System</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="cert-card">
                            <img src="<?php echo $base_url; ?>/assets/images/img-2.png" alt="ISO 14001 Environmental Management" loading="lazy">
                            <h4 class="cert-title">ISO 14001:2015</h4>
                            <span class="cert-issuer">Environmental Management</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="cert-card">
                            <img src="<?php echo $base_url; ?>/assets/images/img-3.png" alt="ISO 45001 Occupational Health & Safety" loading="lazy">
                            <h4 class="cert-title">ISO 45001:2018</h4>
                            <span class="cert-issuer">Occupational Health &amp; Safety</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="cert-card">
                            <img src="<?php echo $base_url; ?>/assets/images/img-4.png" alt="NTDC & DISCOs Enlistment Certificate" loading="lazy">
                            <h4 class="cert-title">DISCOs Pre-Qualification</h4>
                            <span class="cert-issuer">WAPDA / NTDC / IESCO / FESCO</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination cert-swiper-pagination" style="position:static; margin-top:20px;"></div>
            </div>
        </div>
    </div>
</section>

<!-- 8. DIRECT ENGINEERING INQUIRY & CONSULTATION SPLIT SECTION -->
<section class="inquiry-section" id="contact">
    <div class="container">
        <div class="inquiry-split-grid">
            <!-- Left: Contact Details -->
            <div class="inquiry-info-column" data-reveal>
                <span class="section-tag"><i class="fas fa-envelope-open-text"></i> Connect With Us</span>
                <h2 class="section-title">
                    Ready to Build Your Next <span class="highlight">Infrastructure Asset?</span>
                </h2>
                <p class="section-subtitle">
                    Connect directly with our senior engineering estimators and project managers for technical bids, RFP submissions, feasibility studies, or turnkey project execution.
                </p>

                <div class="inquiry-contact-methods">
                    <a href="tel:+923041112766" class="contact-method-card" style="text-decoration:none;">
                        <div class="contact-method-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-method-details">
                            <h5>Direct Call / WhatsApp</h5>
                            <p>+92 304 1112766</p>
                        </div>
                    </a>

                    <a href="mailto:info@fescon.com.pk" class="contact-method-card" style="text-decoration:none;">
                        <div class="contact-method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-method-details">
                            <h5>Engineering Inquiries</h5>
                            <p>info@fescon.com.pk</p>
                        </div>
                    </a>

                    <div class="contact-method-card">
                        <div class="contact-method-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-method-details">
                            <h5>Head Office Location</h5>
                            <p>Islamabad, Pakistan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Consultation Form -->
            <div class="inquiry-form-card" data-reveal data-reveal-delay="200">
                <h3 class="inquiry-form-title">Request Technical Consultation</h3>
                <p class="inquiry-form-subtitle">Fill out the form below and an engineer will respond within 24 hours.</p>

                <form id="consultation-form" action="<?php echo $base_url; ?>/contact-handler.php" method="POST">
                    <div class="form-group-grid">
                        <div class="form-group">
                            <label class="form-label" for="contact_name">Full Name *</label>
                            <input type="text" id="contact_name" name="your-name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_phone">Phone / WhatsApp *</label>
                            <input type="tel" id="contact_phone" name="your-tel" class="form-control" placeholder="+92 300 1234567" required>
                        </div>
                    </div>

                    <div class="form-group-grid">
                        <div class="form-group">
                            <label class="form-label" for="contact_email">Email Address *</label>
                            <input type="email" id="contact_email" name="your-email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_service">Project Scope / Service</label>
                            <select id="contact_service" name="your-subject" class="form-control" style="cursor:pointer;">
                                <option value="EPC Projects">Turnkey EPC Projects</option>
                                <option value="Energy Transmission">Energy Transmission &amp; Distribution</option>
                                <option value="Substation Augmentation">Substation / Bay Augmentation</option>
                                <option value="Planning and Designing">Planning &amp; Designing</option>
                                <option value="Civil Works">Civil Infrastructure Works</option>
                                <option value="MEP Solutions">MEP Solutions</option>
                                <option value="Operation & Maintenance">Operation &amp; Maintenance</option>
                                <option value="General Inquiry">General Corporate Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="contact_message">Project Details / Message *</label>
                        <textarea id="contact_message" name="your-message" class="form-control" placeholder="Describe your project scope, location, or technical requirements..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-paper-plane"></i> Submit Inquiry
                    </button>

                    <div class="form-response-msg"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>