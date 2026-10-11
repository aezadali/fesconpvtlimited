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
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0378-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-leaf"></i> Sustainable Impact &amp; Community Care
            </div>
            
            <h1 class="page-hero-title">
                Corporate Social <span class="highlight">Responsibility (CSR)</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Fescon is committed to ethical engineering stewardship, local community development, clean environmental conservation, and human capital empowerment across all operating regions in Pakistan.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">CSR Policy</span>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
        
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 44px; box-shadow: var(--shadow-card);" data-reveal>
            
            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 24px; margin-bottom: 32px;">
                <span class="section-tag"><i class="fas fa-hand-holding-heart"></i> Our Community Pledge</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 12px 0 10px;">
                    Sustainable Community Stewardship
                </h2>
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.7; margin: 0;">
                    We believe our engineering solutions should elevate not just power grids, but the socioeconomic fabric of the communities we build in. Our CSR initiatives focus on community health, technical education, youth employment, and ecological preservation.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 36px;">
                
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Technical Vocational Training</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Sponsoring apprentice programs for local youth living near project sites, teaching certified electrical wiring, welding, and civil craftsmanship.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-solar-panel"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Clean Energy Initiatives</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Providing off-grid solar kits to rural clinics and community schools along remote transmission line pathways in Punjab and KPK.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-tree"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Afforestation Drives</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Planting over 10,000 indigenous trees annually to offset carbon footprints and restore natural vegetative cover around substation compounds.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Disaster Relief Support</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Deploying heavy earthmoving machinery, mobile generators, and engineering crews during national emergencies and flood restorations.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>