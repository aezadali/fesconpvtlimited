<?php
/**
 * Corporate Social Responsibility (CSR) Policy - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Corporate Social Responsibility (CSR) | Fescon (Pvt.) Ltd';
$current_page = 'csr-policy';

require_once __DIR__ . '/includes/modern-header.php';
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/vehicle_based_street_lighting_system-min.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-leaf"></i> Sustainable Impact &amp; Community Care
            </div>
            
            <h1 class="page-hero-title">
                Corporate Social <span class="highlight">Responsibility (CSR)</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">CSR Policy</span>
                <span class="count-tag">Corporate Policy</span>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
        
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 44px; box-shadow: var(--shadow-card);" data-reveal>
            
            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 24px; margin-bottom: 32px;">
                <span class="section-tag"><i class="fas fa-hand-holding-heart"></i> Corporate Social Responsibility</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 12px 0 10px;">
                    Our Social Impact Framework
                </h2>
                <div style="background: rgba(198,40,40,0.06); border-left: 4px solid var(--brand-red); padding: 20px 24px; border-radius: 6px; margin: 18px 0 16px;">
                    <p style="font-size: 1.05rem; color: #1e293b; line-height: 1.75; margin: 0; font-weight: 500;">
                        "We believe in creating a positive and lasting impact on society. Our CSR priorities are Education, Health and Support for Widows, along with community development, skills development, environmental initiatives and support for vulnerable communities."
                    </p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 36px;">
                
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">1. Education &amp; Skills Development</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Empowering youth through scholarships, technical vocational training, engineering apprenticeships, and modern classroom educational infrastructure.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">2. Health &amp; Medical Outreach</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Facilitating community medical camps, subsidizing primary health clinics, providing clean water installations, and supporting urgent healthcare needs.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">3. Support for Widows &amp; Vulnerable Communities</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Providing dedicated monthly stipends, welfare aid, micro-enterprise support, and social safety nets for widows and underprivileged families.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">4. Environmental Initiatives &amp; Community Development</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Driving extensive afforestation programs, renewable solar community kits, local infrastructure upgrades, and environmental conservation.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>