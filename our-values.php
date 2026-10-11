<?php
/**
 * Our Core Values - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Our Core Values & Engineering Principles | Fescon (Pvt.) Ltd';
$current_page = 'our-values';

require_once __DIR__ . '/includes/modern-header.php';
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0378-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-bullseye"></i> Operational Pillars
            </div>
            
            <h1 class="page-hero-title">
                Our Core Values &amp; <span class="highlight">Principles</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Over 30 years of engineering integrity, safety compliance, and technological precision guiding every substation, transmission line, and civil infrastructure project we execute.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Our Values</span>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container">
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 30px;">
            
            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Integrity &amp; Ethical Governance</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    We conduct all public utility tenders, private contracts, and technical testing with transparent governance, financial accountability, and adherence to PEC standards.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-award"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Engineering Excellence</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Zero tolerance for substandard execution. We engineer high-voltage transmission lines, grid stations, and industrial foundations to exact IEEE and IEC specifications.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Zero-Harm Safety Culture</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Certified under ISO 45001, we ensure strict safety training, lockout/tagout permits, arc-flash gear, and emergency readiness across all field sites.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-user-check"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Client-Centric Collaboration</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    We operate as long-term engineering partners for NTDC, WAPDA, DISCOs, and industrial developers, delivering on schedule and within budget parameters.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Technological Innovation</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Integrating modern grid automation, digital secondary testing, laser surveying, and advanced project management tools into infrastructure construction.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 30px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.45rem; margin-bottom: 20px;">
                    <i class="fas fa-seedling"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 12px;">Environmental Stewardship</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Committed to ISO 14001 ecological preservation, right-of-way flora conservation, and sustainable civil engineering practices across Pakistan.
                </p>
            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>