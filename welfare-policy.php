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
                Fescon ensures fair remuneration, safe working conditions, comprehensive medical coverage, and professional human dignity for every member of our workforce across all construction camps and engineering offices.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Welfare Policy</span>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
        
        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 44px; box-shadow: var(--shadow-card);" data-reveal>
            
            <div style="border-bottom: 1px solid var(--border-light); padding-bottom: 24px; margin-bottom: 32px;">
                <span class="section-tag"><i class="fas fa-users"></i> Human Dignity &amp; Fair Labor</span>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 12px 0 10px;">
                    Workforce Well-Being Principles
                </h2>
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.7; margin: 0;">
                    Our labor welfare framework strictly follows International Labor Organization (ILO) conventions and Pakistan Labor Laws, ensuring fair wages, non-discrimination, safe camp housing, and round-the-clock emergency support.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Comprehensive Health Insurance</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Group hospitalization and accidental insurance coverage for all on-roll employees, engineers, and site technicians.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-campground"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Hygienic Living Quarters</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Climate-controlled site accommodation camps with hygienic mess catering, filtered water plants, and recreational areas.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Fair Remuneration &amp; Bonuses</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Guaranteed minimum wage compliance, overtime compensation, project completion bonuses, and prompt monthly payroll.
                    </p>
                </div>

                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 24px;">
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Equal Opportunity &amp; Zero Harassment</h3>
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0;">
                        Zero tolerance for workplace discrimination, harassment, or forced labor with independent grievance redressal channels.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>