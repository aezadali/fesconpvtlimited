<?php
/**
 * Health, Safety & Environment (HSE) Policy - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'HSE Policy & Safety Standards | Fescon (Pvt.) Ltd';
$current_page = 'hse-policy';

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER (With Photo Background)
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/electricity-electrical-safety-maintenance-service-system-technician-hand-checking-electric-current-voltage-circuit-breaker-321402543.webp'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-shield-alt"></i> Quality &amp; Compliance Standards
            </div>
            
            <h1 class="page-hero-title">
                Health, Safety &amp; <span class="highlight">Environment (HSE)</span> Policy
            </h1>
            
            <p class="page-hero-subtitle">
                At Fescon, zero-harm and occupational safety are foundational values. We maintain strict adherence to international OSHA, ISO 45001, and Pakistan Engineering Council (PEC) OSH-CSP standards across all high-voltage and civil construction project sites.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">HSE Policy</span>
                <span class="count-tag">ISO 45001 &bull; ISO 14001 Certified</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     POLICY CONTENT SECTION (Light Corporate Theme)
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
        
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 44px; box-shadow: var(--shadow-card);" data-reveal>
            
            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 24px; margin-bottom: 32px;">
                <span class="section-tag"><i class="fas fa-file-contract"></i> Statutory Compliance Framework</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 12px 0 10px;">
                    Comprehensive HSE Operating Code
                </h2>
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.7; margin: 0;">
                    Health, Safety, and Environment (HSE) standards at Fescon are rigorously enforced to eliminate job-site accidents, safeguard workforce health, and protect ecological ecosystems. Our operating protocols strictly comply with <strong>OSHA (Occupational Safety and Health Administration)</strong>, <strong>ISO 45001</strong>, <strong>ISO 14001</strong>, and the <strong>Pakistan OSH-CSP Code of Practice</strong>.
                </p>
            </div>

            <!-- 1. Health Standards -->
            <div style="margin-bottom: 36px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 700;">
                        1
                    </div>
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0;">Occupational Health Standards</h3>
                </div>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 14px;">
                    Health standards prioritize the physical and mental well-being of all engineers, field operators, and contractor personnel:
                </p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-check-circle" style="color: var(--brand-red); margin-right: 6px;"></i> Exposure Control</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Monitoring and controlling exposure to silica dust, transformer dielectric fluids, and toxic emissions.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-hard-hat" style="color: var(--brand-red); margin-right: 6px;"></i> Certified PPE</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Mandatory deployment of calibrated arc-flash suits, high-dielectric insulated helmets, safety boots, and respirators.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-user-md" style="color: var(--brand-red); margin-right: 6px;"></i> Medical Surveillance</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Pre-employment and periodic medical checkups, on-site first aid stations, and emergency trauma protocols.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-tint" style="color: var(--brand-red); margin-right: 6px;"></i> Site Hygiene &amp; Sanitation</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Continuous supply of potable drinking water, clean sanitation facilities, and heat-stress management shelters.</span>
                    </div>
                </div>
            </div>

            <!-- 2. Safety Standards -->
            <div style="margin-bottom: 36px; border-top: 1px solid var(--border-light); padding-top: 28px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 700;">
                        2
                    </div>
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0;">Job-Site Safety Standards</h3>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-bolt" style="color: var(--brand-red); margin-right: 6px;"></i> High-Voltage Lockout/Tagout (LOTO)</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Strict electrical grounding, de-energization verifications, and multi-lock permits for substation bays and grid lines.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-angle-double-up" style="color: var(--brand-red); margin-right: 6px;"></i> Tower Stringing &amp; Fall Arrest</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">100% tie-off policies, certified twin-lanyard harnesses, and tested static life-lines for transmission tower erection.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-truck-monster" style="color: var(--brand-red); margin-right: 6px;"></i> Heavy Crane &amp; Rigging Safety</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Daily third-party rigging gear checks, load-chart compliance, and exclusion-zone barricading during transformer lifts.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-fire-extinguisher" style="color: var(--brand-red); margin-right: 6px;"></i> Fire &amp; Explosion Prevention</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Thermal imaging, automatic fire-suppression checks, hot-work permits, and Class-C electrical extinguishers on-site.</span>
                    </div>
                </div>
            </div>

            <!-- 3. Environmental Sustainability -->
            <div style="margin-bottom: 36px; border-top: 1px solid var(--border-light); padding-top: 28px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 700;">
                        3
                    </div>
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0;">Environmental Protection (ISO 14001)</h3>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-recycle" style="color: var(--brand-red); margin-right: 6px;"></i> Responsible Waste Recycling</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Segregation of non-hazardous civil debris, safe containment of oil wastes, and licensed recycling partnerships.</span>
                    </div>
                    <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 18px 20px;">
                        <strong style="color: #0f172a; font-size: 0.92rem; display: block; margin-bottom: 4px;"><i class="fas fa-leaf" style="color: var(--brand-red); margin-right: 6px;"></i> Ecological Restoration</strong>
                        <span style="font-size: 0.86rem; color: #64748b;">Right-of-way flora conservation, tree replantation programs along transmission corridors, and soil erosion control.</span>
                    </div>
                </div>
            </div>

            <!-- Contact / Compliance Channel -->
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; margin-top: 36px;">
                <div>
                    <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 6px;">HSE Audits &amp; Incident Reporting Channel</h4>
                    <p style="font-size: 0.88rem; color: #64748b; margin: 0;">Direct compliance line to Fescon HSE Director &amp; Safety Officers: <strong>hse@fescon.com.pk</strong></p>
                </div>
                <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> Contact HSE Office
                </a>
            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>