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
$team_members = $db->query("SELECT * FROM team_members WHERE is_active = 1 ORDER BY sort_order ASC")->fetchAll();

require_once __DIR__ . '/includes/header.php';
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
                Fescon (Pvt.) Ltd is a premier Pakistani multidisciplinary engineering enterprise, licensed under PEC Category C-A (No-Limit). We spearhead large-scale high-voltage transmission, EPC substation construction, and sustainable civil &amp; MEP infrastructure nationwide.
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
<section style="background: #f8fafc; padding: 70px 0 30px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;" data-reveal>
            
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 30px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem; margin-bottom: 20px;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.2rem; margin: 0 0 10px; font-weight: 700;">Professionalism</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Expert Registered Engineers delivering innovative, mathematically calculated solutions across multiple disciplines with zero deviation from specs.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 30px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem; margin-bottom: 20px;">
                    <i class="fas fa-medal"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.2rem; margin: 0 0 10px; font-weight: 700;">Uncompromising Quality</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Rigorous ISO 9001 quality audits, rigorous factory acceptance tests (FAT), and international IEEE/IEC compliance on all equipment.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 30px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem; margin-bottom: 20px;">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.2rem; margin: 0 0 10px; font-weight: 700;">Timely Completion</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    On-time utility project delivery through algorithmic critical-path planning, proprietary heavy fleet, and seamless site coordination.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 30px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem; margin-bottom: 20px;">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.2rem; margin: 0 0 10px; font-weight: 700;">Safety &amp; Environment</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    ISO 14001 and ISO 45001 certified HSE frameworks ensuring zero-harm work sites and environmentally conscious engineering execution.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     CEO SPOTLIGHT SECTION
========================================================= -->
<section style="background: #f8fafc; padding: 60px 0 100px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.08); display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 0;" data-reveal>
            
            <!-- CEO Photo & Credentials -->
            <div style="position: relative; min-height: 420px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; padding: 40px;">
                <div style="position: absolute; inset: 0; background: radial-gradient(circle at center, rgba(198,40,40,0.2) 0%, rgba(11,15,23,0.95) 70%);"></div>
                
                <div style="position: relative; z-index: 2; text-align: center;">
                    <div style="width: 260px; height: 260px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 4px solid #c62828; box-shadow: 0 12px 30px rgba(0,0,0,0.6);">
                        <img src="<?php echo asset_url('assets/images/ceo.png'); ?>" alt="Engr. Ehsan Ullah - CEO Fescon" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h3 style="color: #0f172a; font-size: 1.4rem; font-weight: 700; margin: 0 0 4px;">Engr. Ehsan Ullah</h3>
                    <p style="color: #ff6b6b; font-size: 0.9rem; font-weight: 600; margin: 0 0 8px;">Chief Executive Officer (CEO)</p>
                    <span style="display: inline-block; background: rgba(255,255,255,0.08); color: #cbd5e1; font-size: 0.78rem; padding: 4px 12px; border-radius: 20px;">
                        PEC Registered Professional Engineer
                    </span>
                </div>
            </div>

            <!-- CEO Statement Text -->
            <div style="padding: 50px 40px; display: flex; flex-direction: column; justify-content: center;">
                <div style="color: #c62828; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                    Executive Message
                </div>
                <h2 style="font-size: clamp(1.8rem, 2.5vw, 2.3rem); font-weight: 800; color: #ffffff; line-height: 1.25; margin: 0 0 20px;">
                    "Pioneering Reliability in Pakistan's Power Sector"
                </h2>
                <div style="color: #cbd5e1; font-size: 1rem; line-height: 1.7; margin-bottom: 24px;">
                    <p style="margin-bottom: 16px;">
                        Welcome to Fescon. Our journey is driven by a passionate team of specialized engineers in Electrical, Civil, Mechanical, and Environmental fields. At Fescon, we are firmly committed to delivering sustainable, forward-thinking infrastructure that powers national industrial growth.
                    </p>
                    <p style="margin: 0;">
                        With continuous investments in advanced testing technology, rigorous quality controls, and unmatched customer service, we stand ready to support Pakistan's utilities—WAPDA, NTDC, and DISCOs—into the next era of energy modernization.
                    </p>
                </div>
                <div style="display: flex; gap: 20px; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 24px;">
                    <div>
                        <div style="color: #0f172a; font-size: 1.5rem; font-weight: 800;">30+</div>
                        <div style="color: #94a3b8; font-size: 0.8rem;">Years of Experience</div>
                    </div>
                    <div style="height: 35px; width: 1px; background: rgba(255,255,255,0.1);"></div>
                    <div>
                        <div style="color: #0f172a; font-size: 1.5rem; font-weight: 800;">100%</div>
                        <div style="color: #94a3b8; font-size: 0.8rem;">PEC Compliance</div>
                    </div>
                    <div style="height: 35px; width: 1px; background: rgba(255,255,255,0.1);"></div>
                    <div>
                        <div style="color: #0f172a; font-size: 1.5rem; font-weight: 800;">C-A</div>
                        <div style="color: #94a3b8; font-size: 0.8rem;">No Limit Category</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     MISSION & VISION SPLIT SECTION
========================================================= -->
<section style="background: #f8fafc; padding: 80px 0; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 32px;" data-reveal>
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px;">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 52px; height: 52px; border-radius: 12px; background: #c62828; color: #0f172a; font-size: 1.3rem; margin-bottom: 20px; box-shadow: 0 8px 16px rgba(198,40,40,0.35);">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.5rem; font-weight: 700; margin: 0 0 14px;">Our Mission</h3>
                <p style="color: #cbd5e1; font-size: 0.96rem; line-height: 1.7; margin: 0;">
                    To revolutionize the power and energy landscape by providing cutting-edge engineering solutions, expert guidance, efficient turnkey execution, and unparalleled lifecycle technical support to our clients while fostering local engineering excellence.
                </p>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px;">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 52px; height: 52px; border-radius: 12px; background: #fef2f2; border: 1px solid rgba(198,40,40,0.2); color: #ef4444; font-size: 1.3rem; margin-bottom: 20px;">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.5rem; font-weight: 700; margin: 0 0 14px;">Our Vision</h3>
                <p style="color: #cbd5e1; font-size: 0.96rem; line-height: 1.7; margin: 0;">
                    To be universally recognized as Pakistan's most trusted and technologically proficient EPC infrastructure partner, benchmarked against international standards of engineering safety, reliability, and sustainable development.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     ENGINEERING LEADERSHIP TEAM
========================================================= -->
<section style="background: #f8fafc; padding: 80px 0 100px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <div style="text-align: center; max-width: 760px; margin: 0 auto 50px;" data-reveal>
            <div style="color: #c62828; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Multidisciplinary Talent
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #ffffff; margin: 0 0 16px; line-height: 1.25;">
                Key Technical &amp; Operational Leadership
            </h2>
            <p style="font-size: 1rem; color: #94a3b8; line-height: 1.65; margin: 0;">
                Our core management and senior engineering personnel bring decades of field-tested leadership in high-voltage power generation, transmission, and grid engineering.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px;">
            <?php foreach ($team_members as $m): ?>
            <div class="team-card" data-reveal style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 24px; text-align: center; transition: transform 0.3s ease, border-color 0.3s ease;">
                <div style="width: 110px; height: 110px; border-radius: 50%; overflow: hidden; margin: 0 auto 18px; border: 3px solid rgba(198,40,40,0.5); background: #f1f5f9;">
                    <img src="<?php echo asset_url($m['image_url'] ?: 'assets/images/placeholder.svg'); ?>" 
                         alt="<?php echo htmlspecialchars($m['name']); ?>" 
                         style="width: 100%; height: 100%; object-fit: cover;"
                         onerror="this.src='<?php echo asset_url('assets/images/placeholder.svg'); ?>';">
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 4px;">
                    <?php echo htmlspecialchars($m['name']); ?>
                </h4>
                <div style="color: #ff6b6b; font-size: 0.85rem; font-weight: 600; margin-bottom: 10px;">
                    <?php echo htmlspecialchars($m['designation']); ?>
                </div>
                <?php if (!empty($m['education'])): ?>
                <div style="color: #94a3b8; font-size: 0.78rem; line-height: 1.5; margin-bottom: 14px;">
                    <?php echo htmlspecialchars($m['education']); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($m['bio'])): ?>
                <p style="color: #cbd5e1; font-size: 0.82rem; line-height: 1.55; margin: 0; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 14px;">
                    <?php echo htmlspecialchars($m['bio']); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =========================================================
     CINEMATIC PARALLAX CTA BANNER
========================================================= -->
<section class="parallax-section" style="position: relative; overflow: hidden; padding: 90px 0; background: #f8fafc; color: #0f172a; text-align: center;">
    <div class="parallax-bg" data-parallax-speed="0.25" style="position: absolute; top: -20%; left: 0; width: 100%; height: 140%; background: url('<?php echo asset_url('assets/images/DJI_0323-scaled.jpg'); ?>') center/cover no-repeat; filter: brightness(0.22) contrast(1.15); pointer-events: none;"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(11,15,23,0.92) 0%, rgba(198,40,40,0.18) 50%, rgba(11,15,23,0.95) 100%);"></div>

    <div class="container" style="position: relative; z-index: 2; max-width: 860px; margin: 0 auto; padding: 0 24px;" data-reveal>
        <span style="display: inline-block; background: rgba(198,40,40,0.2); border: 1px solid rgba(198,40,40,0.5); color: #ff6b6b; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; padding: 6px 16px; border-radius: 999px; margin-bottom: 20px;">
            Partner With Fescon (Pvt.) Ltd
        </span>
        <h2 style="font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 800; line-height: 1.25; margin: 0 0 18px; color: #ffffff;">
            Connect with Our Project Management Office
        </h2>
        <p style="font-size: 1.05rem; color: #cbd5e1; line-height: 1.65; margin: 0 auto 32px; max-width: 680px;">
            Let our experienced engineering team support your infrastructure expansion with proven reliability, compliance, and on-schedule execution.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo $base_url; ?>/contact-us/" style="background: #c62828; color: #ffffff; padding: 14px 34px; border-radius: 8px; font-weight: 700; font-size: 0.95rem; text-decoration: none; box-shadow: 0 8px 24px rgba(198,40,40,0.4); transition: transform 0.2s, background 0.2s;">
                Contact Engineering Office
            </a>
            <a href="<?php echo $base_url; ?>/projects/" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; padding: 14px 28px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                Explore Our Projects
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>