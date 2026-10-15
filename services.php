<?php
/**
 * Services - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Interactive Service Cards & Technical Capabilities
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Engineering Services & EPC Solutions | Fescon (Pvt.) Ltd';
$current_page = 'services';

// Fetch all core services from DB
$services = get_all_services();

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER (With Photo Background)
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-services.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-layer-group"></i> PEC Category C-A (No Limit) Capabilities
            </div>
            
            <h1 class="page-hero-title">
                Engineering, Procurement &amp; <span class="highlight">Construction</span> Solutions
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Services</span>
                <span class="count-tag"><?php echo count($services); ?> Core Disciplines</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     CORE SERVICES GRID SECTION (Clean Light Theme)
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px; position: relative;">
    <div class="container">

        <div style="text-align: center; max-width: 760px; margin: 0 auto 60px;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Multidisciplinary Competencies
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #0f172a; margin: 0 0 16px; line-height: 1.25;">
                Turnkey Engineering Across the Energy Value Chain
            </h2>
            <p style="font-size: 1.05rem; color: #475569; line-height: 1.65; margin: 0;">
                From preliminary engineering feasibility and FEED designs through turnkey site erection, testing, commissioning, and preventive maintenance.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 32px;">
            <?php foreach ($services as $srv): ?>
            <div class="service-card" data-reveal style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); display: flex; flex-direction: column; transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.3s ease;">
                
                <!-- Service Media Header -->
                <div style="position: relative; height: 230px; overflow: hidden; background: #e2e8f0;">
                    <img src="<?php echo asset_url($srv['image_url']); ?>" 
                         alt="<?php echo htmlspecialchars($srv['name']); ?>" 
                         loading="lazy"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);"
                         onerror="this.src='<?php echo asset_url('assets/images/placeholder.svg'); ?>';">
                    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.6) 100%);"></div>
                    
                    <!-- Icon Floating Badge -->
                    <div style="position: absolute; bottom: 16px; left: 20px; width: 52px; height: 52px; border-radius: var(--radius-md); background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 1.4rem; box-shadow: 0 8px 20px rgba(198,40,40,0.4);">
                        <i class="<?php echo htmlspecialchars($srv['icon_class'] ?: 'fas fa-cogs'); ?>"></i>
                    </div>

                    <?php if (!empty($srv['project_count'])): ?>
                    <div style="position: absolute; top: 16px; right: 16px;">
                        <span style="background: rgba(255,255,255,0.92); backdrop-filter: blur(8px); border: 1px solid var(--border-light); color: #0f172a; font-size: 0.72rem; font-weight: 700; padding: 5px 12px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <?php echo (int)$srv['project_count']; ?> Projects
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Service Content -->
                <div style="padding: 28px 26px 26px; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px; line-height: 1.3;">
                        <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($srv['slug']); ?>" style="color: inherit; text-decoration: none; transition: color 0.2s;">
                            <?php echo htmlspecialchars($srv['name']); ?>
                        </a>
                    </h3>

                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.6; margin: 0 0 20px; flex-grow: 1;">
                        <?php echo htmlspecialchars($srv['short_description'] ?: substr(strip_tags($srv['full_description'] ?? ''), 0, 130) . '...'); ?>
                    </p>

                    <!-- Service Capabilities Checklist -->
                    <ul style="list-style: none; padding: 0; margin: 0 0 22px; display: flex; flex-direction: column; gap: 8px; border-top: 1px solid var(--border-light); padding-top: 14px;">
                        <?php 
                        $srv_bullets = get_service_features($srv['slug']);
                        foreach ($srv_bullets as $bullet): 
                        ?>
                        <li style="font-size: 0.84rem; color: #334155; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-check-circle" style="color: var(--brand-red); font-size: 0.85rem;"></i>
                            <span><?php echo htmlspecialchars($bullet); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Action Link -->
                    <div style="border-top: 1px solid var(--border-light); padding-top: 18px; display: flex; align-items: center; justify-content: space-between;">
                        <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($srv['slug']); ?>" 
                           style="color: var(--brand-red); font-size: 0.88rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 0.05em;">
                            <span>Scope &amp; Specifications</span>
                            <i class="fas fa-arrow-right" style="font-size: 0.85rem;"></i>
                        </a>
                        <span style="font-size: 0.78rem; color: #64748b; font-weight: 500;">Industrial Grade</span>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- =========================================================
     ENGINEERING STANDARDS & METHODOLOGY
========================================================= -->
<section style="background: #ffffff; padding: 80px 0; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 28px;" data-reveal>
            
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 30px 24px; box-shadow: var(--shadow-subtle);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 18px;">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">PEC Category C-A</h4>
                <p style="color: #475569; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Licensed by the Pakistan Engineering Council under the highest C-A (No-Limit) tier, authorizing the execution of mega-scale public and private utility contracts.
                </p>
            </div>

            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 30px 24px; box-shadow: var(--shadow-subtle);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 18px;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">ISO Quality &amp; Safety</h4>
                <p style="color: #475569; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    ISO 9001 (Quality), ISO 14001 (Environmental Management), and ISO 45001 (Occupational Health &amp; Safety) certifications govern all our field operations.
                </p>
            </div>

            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 30px 24px; box-shadow: var(--shadow-subtle);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 18px;">
                    <i class="fas fa-truck-monster"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">Heavy Plant &amp; Fleet</h4>
                <p style="color: #475569; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Proprietary stringing tensioners, high-reach mobile cranes, dielectric oil treatment plants, and secondary injection test sets ensure rapid field deployment.
                </p>
            </div>

            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 30px 24px; box-shadow: var(--shadow-subtle);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: var(--brand-red); font-size: 1.35rem; margin-bottom: 18px;">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">Registered PE Engineers</h4>
                <p style="color: #475569; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Over 50+ professional engineers, certified project managers (PMP), and specialized testing technicians deployed across nationwide operational sites.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     TECHNICAL INQUIRY CTA SECTION
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0;">
    <div class="container">
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 30px; box-shadow: var(--shadow-card);" data-reveal>
            <div style="max-width: 680px;">
                <span class="section-tag"><i class="fas fa-comments"></i> Technical Consultation</span>
                <h3 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-bottom: 10px;">
                    Need a Custom Engineering or EPC Proposal?
                </h3>
                <p style="font-size: 1rem; color: #475569; margin: 0; line-height: 1.6;">
                    Connect with our technical estimators and project managers to discuss bid specifications, feasibility studies, and turnkey project execution.
                </p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary">
                    <i class="fas fa-file-signature"></i> Request Project Proposal
                </a>
            </div>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>