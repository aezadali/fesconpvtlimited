<?php
/**
 * Employee & Labor Welfare Policy - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Employee & Labor Welfare Policy | Fescon (Pvt.) Ltd';
$current_page = 'welfare-policy';

require_once __DIR__ . '/includes/modern-header.php';
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/IMG_4737-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-heart"></i> Workforce Care &amp; Dignity
            </div>
            
            <h1 class="page-hero-title">
                Employee &amp; Labor <span class="highlight">Welfare Policy</span>
            </h1>
            
            <p class="page-hero-subtitle">
                FESCON INTERNATIONAL LLC is committed to the wellbeing, dignity and development of our employees. We provide a safe and respectful workplace, fair treatment, appropriate welfare facilities, training and development opportunities, and a workplace free from discrimination, harassment, forced labour and child labour.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Welfare Policy</span>
                <span class="count-tag">Corporate Policy</span>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
        
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 44px; box-shadow: var(--shadow-card);" data-reveal>
            
            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 24px; margin-bottom: 32px;">
                <span class="section-tag"><i class="fas fa-users"></i> FESCON INTERNATIONAL LLC &bull; Corporate Policies</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 12px 0 10px;">
                    Workforce Well-Being &amp; Labor Welfare Policy
                </h2>
                <div style="background: rgba(198,40,40,0.06); border-left: 4px solid var(--brand-red); padding: 20px 24px; border-radius: 6px; margin: 18px 0 16px;">
                    <p style="font-size: 1.05rem; color: #1e293b; line-height: 1.75; margin: 0; font-weight: 500;">
                        "FESCON INTERNATIONAL LLC is committed to the wellbeing, dignity and development of our employees. We provide a safe and respectful workplace, fair treatment, appropriate welfare facilities, training and development opportunities, and a workplace free from discrimination, harassment, forced labour and child labour."
                    </p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Safe &amp; Respectful Workplace</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Maintaining uncompromising standards of safety, dignity, and personal respect across all offices, operational sites, and field accommodation camps.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Fair Treatment &amp; Welfare Facilities</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Fair compensation, comprehensive healthcare, hygienic quarters, nutritious catering, filtered water, and appropriate resting amenities.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Training &amp; Development</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Continuous technical upskilling, safety certifications, leadership development, and clear career advancement pathways for all personnel.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Zero Discrimination &amp; Forced Labour</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Strict zero-tolerance policy against discrimination, harassment, forced labour, and child labour, supported by independent grievance channels.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>