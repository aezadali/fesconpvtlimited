<?php
/**
 * About Us - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Cinematic Parallax & Leadership Showcase
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'About Us | Fescon (Pvt.) Ltd - Power Engineering Leader';
$current_page = 'about-us';

$db = get_db();
$team_members = $db->query("SELECT * FROM team_members WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 4")->fetchAll();

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0378-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-building"></i> Established Engineering Leadership
            </div>
            
            <h1 class="page-hero-title">
                Engineering Tomorrow's <span class="highlight">Power Grid</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Fescon (Pvt.) Ltd is a premier multidisciplinary engineering enterprise licensed under PEC Category C-A (No-Limit). We spearhead large-scale high-voltage transmission, EPC substation construction, and sustainable civil &amp; MEP infrastructure nationwide.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">About Us</span>
                <span class="count-tag">30+ Years Operational Delivery</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     FOUR PILLARS OF EXCELLENCE
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 50px; position: relative;">
    <div class="container">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 50px;" data-reveal>
            <span class="section-tag"><i class="fas fa-shield-alt"></i> Core Strengths</span>
            <h2 class="section-title">
                Four Pillars of <span class="highlight">Engineering Excellence</span>
            </h2>
            <p class="section-subtitle center">
                The institutional principles that define Fescon's technical leadership, quality standards, and trusted utility delivery.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 26px;" data-reveal>
            
            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 26px; box-shadow: var(--shadow-card); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 20px;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.25rem; margin: 0 0 10px; font-weight: 700;">Professionalism</h3>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0;">
                    Expert Registered Engineers delivering mathematically calculated, innovative solutions across multiple engineering disciplines with zero deviation from specs.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 26px; box-shadow: var(--shadow-card); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 20px;">
                    <i class="fas fa-medal"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.25rem; margin: 0 0 10px; font-weight: 700;">Uncompromising Quality</h3>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0;">
                    Rigorous ISO 9001 quality audits, Factory Acceptance Tests (FAT), and international IEEE/IEC compliance across all equipment and installations.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 26px; box-shadow: var(--shadow-card); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 20px;">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.25rem; margin: 0 0 10px; font-weight: 700;">Timely Completion</h3>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0;">
                    On-time national grid project commissioning through critical-path planning, proprietary heavy fleet, and seamless site coordination.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 26px; box-shadow: var(--shadow-card); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 20px;">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.25rem; margin: 0 0 10px; font-weight: 700;">Safety &amp; Environment</h3>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0;">
                    ISO 14001 and ISO 45001 certified HSE frameworks ensuring zero-harm worksites and environmentally conscious execution on high-voltage sites.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     CEO MESSAGE & LEADERSHIP SPOTLIGHT (MATCHES HOME PAGE)
========================================================= -->
<section class="about-spotlight-section" id="ceo-message" style="background: #ffffff; padding: 100px 0;">
    <div class="container">
        <div class="about-grid">
            
            <!-- Visual Column with CEO Photo -->
            <div class="about-visual-column" data-reveal>
                <div class="about-image-frame">
                    <img src="<?php echo $base_url; ?>/assets/images/ceo.jpg" alt="Engr. Ehsan Ullah - Entrepreneur &amp; CEO" loading="lazy" style="object-position: center top;">
                </div>
                <div class="about-experience-badge">
                    <div class="years">15+</div>
                    <div class="text">Years of Executive Leadership</div>
                </div>
            </div>

            <!-- Content Column -->
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
                        <div style="font-size: 0.88rem; color: var(--brand-red); font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;">Entrepreneur / CEO</div>
                    </div>
                </div>

                <div class="ceo-message-quote" style="background: var(--bg-light-alt); border-left: 4px solid var(--brand-red); padding: 24px 26px; border-radius: var(--radius-sm); margin-bottom: 20px;">
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0 0 14px;">
                        Engr. Ehsan Ullah Laang is an engineer, entrepreneur and business leader with 15+ years of experience in engineering, construction, manufacturing, agriculture, foods, furniture and business development. He holds MSc in Electrical Engineering (Power).
                    </p>
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0 0 14px;">
                        As Founder and CEO, he leads a diversified business portfolio across Oman, Türkiye, Pakistan and Qatar, with interests in engineering, construction, manufacturing, foods &amp; beverage, agriculture, real estate and trading.
                    </p>
                    <p style="font-size: 0.98rem; color: #475569; line-height: 1.75; margin: 0;">
                        His focus is on building professionally managed businesses, developing international partnerships and creating sustainable long-term growth.
                    </p>
                </div>

                <!-- Global Footprint & Diversified Sectors -->
                <div style="margin-bottom: 26px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 12px;">
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.88rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇴🇲</span> Oman
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.88rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇹🇷</span> Türkiye
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.88rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇵🇰</span> Pakistan
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.88rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇶🇦</span> Qatar
                        </span>
                    </div>
                    <div style="font-size: 0.86rem; color: #64748b; font-weight: 600; line-height: 1.6; padding-top: 10px; border-top: 1px dashed var(--border-light);">
                        <i class="fas fa-layer-group text-red" style="margin-right: 6px;"></i> Engineering &bull; Construction &bull; Manufacturing &bull; Agriculture &bull; Foods &bull; Investment &bull; Business Development
                    </div>
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

<!-- =========================================================
     MISSION & VISION SPLIT SECTION
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 32px;" data-reveal>
            
            <div style="background: #ffffff; border: 1px solid var(--border-light); border-top: 4px solid var(--brand-red); border-radius: var(--radius-lg); padding: 38px 32px; box-shadow: var(--shadow-card);">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 54px; height: 54px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); font-size: 1.4rem; margin-bottom: 20px;">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.45rem; font-weight: 700; margin: 0 0 14px;">Our Mission</h3>
                <p style="color: #475569; font-size: 0.96rem; line-height: 1.75; margin: 0;">
                    To revolutionize the power and energy landscape across Pakistan and international markets by providing cutting-edge engineering solutions, expert guidance, efficient turnkey execution, and unparalleled lifecycle technical support to our clients while fostering indigenous engineering excellence.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-top: 4px solid #0f172a; border-radius: var(--radius-lg); padding: 38px 32px; box-shadow: var(--shadow-card);">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 54px; height: 54px; border-radius: 12px; background: rgba(15,23,42,0.08); color: #0f172a; font-size: 1.4rem; margin-bottom: 20px;">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.45rem; font-weight: 700; margin: 0 0 14px;">Our Vision</h3>
                <p style="color: #475569; font-size: 0.96rem; line-height: 1.75; margin: 0;">
                    To be universally recognized as Pakistan's most trusted and technologically proficient EPC infrastructure partner, benchmarked against international standards of engineering safety, reliability, and sustainable cross-border development.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     ENGINEERING LEADERSHIP TEAM SPOTLIGHT
========================================================= -->
<section style="background: #ffffff; padding: 85px 0 100px; position: relative;">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin: 0 auto 50px;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Multidisciplinary Talent
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #0f172a; margin: 0 0 16px; line-height: 1.25;">
                Key Technical &amp; Operational Leadership
            </h2>
            <p style="font-size: 1rem; color: #475569; line-height: 1.65; margin: 0;">
                Our core management and senior engineering personnel bring decades of field-tested leadership in high-voltage power generation, transmission, and grid engineering.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px;">
            <?php foreach ($team_members as $m): ?>
            <div class="team-card" data-reveal style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); padding: 28px 24px; text-align: center; transition: transform 0.3s ease, border-color 0.3s ease;">
                <div style="width: 110px; height: 110px; border-radius: 50%; overflow: hidden; margin: 0 auto 18px; border: 3px solid var(--brand-red); background: #ffffff; box-shadow: var(--shadow-sm);">
                    <img src="<?php echo asset_url($m['image_url'] ?: 'assets/images/placeholder.svg'); ?>" 
                         alt="<?php echo htmlspecialchars($m['name']); ?>" 
                         style="width: 100%; height: 100%; object-fit: cover;"
                         onerror="this.src='<?php echo asset_url('assets/images/placeholder.svg'); ?>';">
                </div>
                <h4 style="color: #0f172a; font-size: 1.2rem; font-weight: 700; margin: 0 0 4px;">
                    <?php echo htmlspecialchars($m['name']); ?>
                </h4>
                <div style="color: var(--brand-red); font-size: 0.88rem; font-weight: 600; margin-bottom: 10px;">
                    <?php echo htmlspecialchars($m['designation']); ?>
                </div>
                <?php if (!empty($m['education'])): ?>
                <div style="color: #64748b; font-size: 0.82rem; line-height: 1.5; margin-bottom: 14px;">
                    <?php echo htmlspecialchars($m['education']); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($m['bio'])): ?>
                <p style="color: #475569; font-size: 0.85rem; line-height: 1.6; margin: 0; border-top: 1px solid var(--border-light); padding-top: 14px;">
                    <?php echo htmlspecialchars($m['bio']); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 40px;" data-reveal>
            <a href="<?php echo $base_url; ?>/team.php" class="btn btn-outline" style="padding: 12px 28px;">
                <span>View Full Team Directory</span>
                <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </a>
        </div>
    </div>
</section>

<!-- =========================================================
     CINEMATIC PARALLAX CTA BANNER
========================================================= -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 80px 0; color: #ffffff; text-align: center;">
    <div class="container" style="max-width: 860px; margin: 0 auto;" data-reveal>
        <span style="display: inline-block; background: rgba(198,40,40,0.2); border: 1px solid rgba(198,40,40,0.5); color: #ff6b6b; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; padding: 6px 18px; border-radius: 999px; margin-bottom: 20px;">
            Partner With Fescon (Pvt.) Ltd
        </span>
        <h2 style="font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 800; line-height: 1.25; margin: 0 0 18px; color: #ffffff;">
            Connect with Our Project Management Office
        </h2>
        <p style="font-size: 1.05rem; color: #cbd5e1; line-height: 1.7; margin: 0 auto 32px; max-width: 680px;">
            Let our experienced engineering team support your infrastructure expansion with proven reliability, compliance, and on-schedule execution.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary" style="padding: 14px 34px;">
                <i class="fas fa-envelope"></i> Contact Engineering Office
            </a>
            <a href="<?php echo $base_url; ?>/projects.php" class="btn btn-outline-dark" style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.25); color: #ffffff; padding: 14px 28px;">
                <i class="fas fa-th"></i> Explore Our Projects
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>