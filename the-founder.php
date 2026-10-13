<?php
/**
 * The Founder / CEO Bio - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'The Founder & CEO Bio | Engr. Ehsan Ullah';
$current_page = 'the-founder';

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-about.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-user-tie"></i> Executive Profile
            </div>
            
            <h1 class="page-hero-title">
                The Founder &amp; <span class="highlight">CEO Bio</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Visionary engineering leadership and international business development across energy, construction, and global trade.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">CEO Bio</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     FOUNDER / CEO BIO SECTION
========================================================= -->
<section style="background: #ffffff; padding: 90px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 50px; align-items: center;">
            
            <!-- Founder Portrait Card -->
            <div data-reveal style="text-align: center;">
                <div style="position: relative; display: inline-block; max-width: 420px; width: 100%;">
                    <div style="position: absolute; inset: -12px; background: linear-gradient(135deg, rgba(198,40,40,0.15), rgba(15,23,42,0.06)); border-radius: var(--radius-xl); transform: rotate(-2deg); z-index: 0;"></div>
                    <div style="position: relative; z-index: 1; background: #ffffff; padding: 14px; border-radius: var(--radius-xl); box-shadow: var(--shadow-xl); border: 1px solid var(--border-light);">
                        <img src="<?php echo asset_url('assets/images/ceo-bio.png'); ?>" alt="Engr. Ehsan Ullah - Entrepreneur / CEO" style="width: 100%; height: auto; border-radius: calc(var(--radius-xl) - 6px); display: block; object-fit: cover;">
                        <div style="padding: 24px 16px 14px;">
                            <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0 0 6px;">ENGR. EHSAN ULLAH</h3>
                            <p style="font-size: 0.95rem; color: var(--brand-red); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 14px;">Entrepreneur / CEO</p>
                            <div style="display: flex; flex-direction: column; gap: 8px; align-items: center; justify-content: center;">
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">MSc in Electrical Engineering (Power)</span>
                                <span style="background: var(--bg-light-alt); border: 1px solid var(--border-light); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; color: #475569; font-weight: 600;">15+ Years Multidisciplinary Leadership</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Founder Bio Details -->
            <div data-reveal>
                <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 12px;">
                    <i class="fas fa-id-card"></i> Executive Biography
                </div>
                
                <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: 800; color: #0f172a; line-height: 1.2; margin: 0 0 6px; font-family: 'Cinzel', serif;">
                    ENGR. EHSAN ULLAH
                </h2>
                
                <div style="font-size: 1.05rem; font-weight: 700; color: var(--brand-red); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 24px;">
                    Entrepreneur / CEO
                </div>

                <!-- Bio Paragraphs -->
                <div style="font-size: 1.02rem; color: #334155; line-height: 1.85; display: flex; flex-direction: column; gap: 16px; margin-bottom: 28px;">
                    <p style="margin: 0;">
                        Engr. Ehsan Ullah Laang is an engineer, entrepreneur and business leader with 15+ years of experience in engineering, construction, manufacturing, agriculture, foods, furniture and business development. He holds MSc in Electrical Engineering (Power).
                    </p>
                    <p style="margin: 0;">
                        As Founder and CEO, he leads a diversified business portfolio across Oman, Türkiye, Pakistan and Qatar, with interests in engineering, construction, manufacturing, foods &amp; beverage, agriculture, real estate and trading.
                    </p>
                    <p style="margin: 0;">
                        His focus is on building professionally managed businesses, developing international partnerships and creating sustainable long-term growth.
                    </p>
                </div>

                <!-- Global Presence & Diversified Sectors -->
                <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 22px 24px; margin-bottom: 30px;">
                    <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: var(--brand-red); margin-bottom: 12px;">
                        International Business Portfolio
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 14px;">
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
                    <div style="font-size: 0.9rem; color: #475569; font-weight: 600; line-height: 1.6; padding-top: 12px; border-top: 1px dashed var(--border-light);">
                        <i class="fas fa-layer-group text-red" style="margin-right: 6px;"></i> Engineering &bull; Construction &bull; Manufacturing &bull; Agriculture &bull; Foods &bull; Investment &bull; Business Development
                    </div>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
                    <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary" style="padding: 12px 28px;">
                        <i class="fas fa-envelope"></i> Contact CEO Office
                    </a>
                    <a href="<?php echo $base_url; ?>/index.php#ceo-message" class="btn btn-outline-dark" style="padding: 12px 24px;">
                        <i class="fas fa-quote-left"></i> View CEO Message
                    </a>
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
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Sustainable Growth</h3>
                <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                    Building professionally managed businesses and creating long-term value through international partnerships and enduring engineering excellence.
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
                <span style="display: inline-block; font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brand-red); margin-bottom: 8px;">Executive Office</span>
                <h2 style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); font-weight: 800; color: #ffffff; margin: 0 0 10px;">Connect With the CEO Office</h2>
                <p style="font-size: 0.95rem; color: #cbd5e1; margin: 0; line-height: 1.6;">For corporate partnerships, joint ventures, and international business inquiries across Oman, Türkiye, Pakistan, and Qatar.</p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary" style="padding: 14px 32px; font-size: 1rem;">
                    <i class="fas fa-paper-plane"></i> Contact CEO Office
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>