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
                        <div style="padding: 24px 16px 14px;">
                            <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0 0 6px;">ENGR. EHSAN ULLAH</h3>
                            <p style="font-size: 0.95rem; color: var(--brand-red); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 14px;">Entrepreneur / CEO</p>
                            <div style="display: flex; flex-direction: column; gap: 8px; align-items: center; justify-content: center;">
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">MSc Electrical Engineering (Power)</span>
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">15+ Years Multidisciplinary Leadership</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Founder Bio & Message -->
            <div data-reveal>
                <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 12px;">
                    <i class="fas fa-quote-left"></i> Executive Profile &amp; Bio
                </div>
                <h2 style="font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 800; color: #0f172a; line-height: 1.25; margin: 0 0 24px;">
                    Engr. Ehsan Ullah Laang &bull; <span class="highlight">Entrepreneur &amp; CEO</span>
                </h2>
                
                <div style="font-size: 1.05rem; color: #334155; line-height: 1.85; margin-bottom: 24px;">
                    <p style="margin-bottom: 16px;">
                        <strong>Engr. Ehsan Ullah Laang</strong> is an engineer, entrepreneur and business leader with <strong>15+ years of experience</strong> in engineering, construction, manufacturing, agriculture, foods, furniture and business development. He holds an <strong>MSc in Electrical Engineering (Power)</strong>.
                    </p>
                    <p style="margin-bottom: 16px;">
                        As Founder and CEO, he leads a diversified business portfolio across <strong>Oman, Türkiye, Pakistan and Qatar</strong>, with active interests in engineering, construction, manufacturing, foods &amp; beverage, agriculture, real estate and trading.
                    </p>
                    <p style="margin-bottom: 20px;">
                        His strategic focus is on building professionally managed businesses, developing international partnerships and creating sustainable long-term economic growth.
                    </p>
                </div>

                <!-- Executive Statement & FESCON Oman Vision -->
                <div style="background: var(--bg-light-alt); border-left: 4px solid var(--brand-red); padding: 26px 28px; border-radius: var(--radius-sm); margin-bottom: 26px;">
                    <div style="font-size: 0.86rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: var(--brand-red); margin-bottom: 8px;">
                        Executive Message &bull; FESCON Oman
                    </div>
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0 0 14px;">
                        "Welcome to FESCON Oman. We are committed to delivering engineering excellence through innovative, reliable, and sustainable solutions across infrastructure, energy, industrial, building projects and Oil and Gas field. Our success is built on professionalism, quality, safety, and long-term partnerships."
                    </p>
                    <p style="font-size: 1.02rem; color: #334155; line-height: 1.8; margin: 0;">
                        "With a highly skilled team and a client-focused approach, we strive to exceed expectations by delivering every project with precision, integrity, and technical expertise—contributing to Oman’s continued growth and development."
                    </p>
                </div>

                <!-- Global Presence & Diversified Sectors -->
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 20px 24px; margin-bottom: 26px;">
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: var(--brand-red); margin-bottom: 10px;">
                        International Business Portfolio
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 12px;">
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇴🇲</span> Oman
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇹🇷</span> Türkiye
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇵🇰</span> Pakistan
                        </span>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 700; color: #0f172a; box-shadow: var(--shadow-sm); display: inline-flex; align-items: center; gap: 6px;">
                            <span>🇶🇦</span> Qatar
                        </span>
                    </div>
                    <div style="font-size: 0.88rem; color: #64748b; font-weight: 600; line-height: 1.6; padding-top: 10px; border-top: 1px dashed var(--border-light);">
                        <i class="fas fa-layer-group text-red" style="margin-right: 6px;"></i> Engineering &bull; Construction &bull; Manufacturing &bull; Agriculture &bull; Foods &bull; Investment &bull; Business Development &bull; Oil &amp; Gas
                    </div>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center; padding-top: 10px;">
                    <div>
                        <div style="font-size: 1.25rem; font-weight: 800; color: #0f172a; font-family: 'Cinzel', serif;">ENGR. EHSAN ULLAH</div>
                        <div style="font-size: 0.85rem; color: #64748b;">Founder &amp; Chief Executive Officer</div>
                    </div>
                    <div style="margin-left: auto;">
                        <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary" style="padding: 12px 24px;">
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