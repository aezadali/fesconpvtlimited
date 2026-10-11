<?php
/**
 * The Founder / CEO Message - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'The Founder & CEO Message | Fescon (Pvt.) Ltd';
$current_page = 'the-founder';

require_once __DIR__ . '/includes/modern-header.php';
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0378-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-user-tie"></i> Executive Leadership
            </div>
            
            <h1 class="page-hero-title">
                The Founder &amp; <span class="highlight">CEO Message</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Visionary engineering leadership driving national grid infrastructure, power development, and civil engineering excellence across Pakistan.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">The Founder</span>
            </div>
        </div>
    </div>
</section>

<!-- Founder Profile & Message Section -->
<section style="background: #ffffff; padding: 90px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 50px; align-items: center;">
            
            <!-- Founder Portrait Card -->
            <div data-reveal style="text-align: center;">
                <div style="position: relative; display: inline-block; max-width: 420px; width: 100%;">
                    <div style="position: absolute; inset: -12px; background: linear-gradient(135deg, rgba(198,40,40,0.15), rgba(15,23,42,0.06)); border-radius: var(--radius-xl); transform: rotate(-2deg); z-index: 0;"></div>
                    <div style="position: relative; z-index: 1; background: #ffffff; padding: 14px; border-radius: var(--radius-xl); box-shadow: var(--shadow-xl); border: 1px solid var(--border-light);">
                        <img src="<?php echo asset_url('assets/images/ceo.jpg'); ?>" alt="Engr. Ehsan Ullah - Founder &amp; CEO" style="width: 100%; height: auto; border-radius: calc(var(--radius-xl) - 6px); display: block; object-fit: cover;">
                        <div style="padding: 24px 16px 12px;">
                            <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0 0 6px;">Engr. Ehsan Ullah</h3>
                            <p style="font-size: 0.95rem; color: var(--brand-red); font-weight: 600; margin: 0 0 14px;">Founder &amp; Chief Executive Officer</p>
                            <div style="display: inline-flex; gap: 10px; align-items: center; justify-content: center;">
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">PEC Certified</span>
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">Power Sector Specialist</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Founder Bio & Message -->
            <div data-reveal>
                <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 12px;">
                    <i class="fas fa-quote-left"></i> Message From Leadership
                </div>
                <h2 style="font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 800; color: #0f172a; line-height: 1.25; margin: 0 0 24px;">
                    Pioneering Engineering Solutions for a Resilient Tomorrow
                </h2>
                
                <div style="font-size: 1.05rem; color: #334155; line-height: 1.8; margin-bottom: 24px;">
                    <p style="margin-bottom: 18px;">
                        <strong>Welcome to FESCON (Pvt.) Limited!</strong> Our journey is driven by a passionate team of dedicated engineers specializing in Electrical, Civil, Mechanical, Information Technology, and Environmental engineering domains. At FESCON, we are committed to delivering cutting-edge, sustainable solutions that meet the demanding challenges of today while actively shaping a smarter, greener tomorrow.
                    </p>
                    <p style="margin-bottom: 18px;">
                        With an uncompromising focus on technical excellence, transparent collaboration, and rigorous environmental responsibility, we strive to engineer lasting value for our clients, public utility partners, and communities. From critical 500kV / 220kV transmission networks and grid substations to major civil infrastructure works, we pride ourselves on precision execution and zero-harm safety standards.
                    </p>
                    <p style="margin: 0;">
                        Together with our partners, we will continue to push technical boundaries, adopt future-proof technologies, and achieve new milestones in nationwide energy development.
                    </p>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center; padding-top: 20px; border-top: 1px solid var(--border-light);">
                    <div>
                        <div style="font-size: 1.25rem; font-weight: 800; color: #0f172a; font-family: 'Cinzel', serif;">Engr. Ehsan Ullah</div>
                        <div style="font-size: 0.85rem; color: #64748b;">Managing Director &amp; CEO, Fescon (Pvt.) Ltd</div>
                    </div>
                    <div style="margin-left: auto;">
                        <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary" style="padding: 12px 24px;">
                            <i class="fas fa-envelope"></i> Contact CEO Office
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Core Leadership Pillars -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 50px;" data-reveal>
            <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 10px;">
                <i class="fas fa-compass"></i> Guiding Principles
            </div>
            <h2 style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); font-weight: 800; color: #0f172a; margin: 0 0 12px;">
                Leadership Philosophy
            </h2>
            <p style="font-size: 0.95rem; color: #64748b; margin: 0;">
                The foundational commitments instilled across every project, engineering department, and field team at FESCON.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 28px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 20px;">
                    <i class="fas fa-drafting-compass"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Technical Precision</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Employing international standards (IEEE, IEC, ASTM) in substation design, power transmission, and civil structural engineering.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 28px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 20px;">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Zero-Harm Execution</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Ensuring that occupational safety and environmental preservation remain uncompromised across high-risk field operations.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 28px; box-shadow: var(--shadow-card);" data-reveal>
                <div style="width: 52px; height: 52px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 20px;">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">National Contribution</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Building robust power grid infrastructure that directly strengthens Pakistan’s energy security and economic prosperity.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 70px 0; color: #ffffff;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 30px;" data-reveal>
            <div style="max-width: 650px;">
                <span style="display: inline-block; font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brand-red); margin-bottom: 8px;">Partner With Us</span>
                <h2 style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); font-weight: 800; color: #ffffff; margin: 0 0 10px;">Ready to Engineer Your Next Power Project?</h2>
                <p style="font-size: 0.95rem; color: #cbd5e1; margin: 0; line-height: 1.6;">Connect directly with FESCON’s project management and engineering leadership to discuss grid solutions, power consultancy, and civil construction.</p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary" style="padding: 14px 32px; font-size: 1rem;">
                    <i class="fas fa-paper-plane"></i> Get in Touch Today
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>