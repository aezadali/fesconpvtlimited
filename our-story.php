<?php
/**
 * Our Story & History - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Our Story & History | Fescon (Pvt.) Ltd';
$current_page = 'our-story';

require_once __DIR__ . '/includes/modern-header.php';
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0319-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-history"></i> Corporate Heritage
            </div>
            
            <h1 class="page-hero-title">
                Our Story &amp; <span class="highlight">Evolution</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Our Story</span>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section style="background: #ffffff; padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 40px; align-items: stretch;">
            
            <!-- Mission Card -->
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-top: 4px solid var(--brand-red); border-radius: var(--radius-lg); padding: 40px 34px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: var(--shadow-card);" data-reveal>
                <div>
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 24px;">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <span style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); display: block; margin-bottom: 8px;">Purpose &amp; Commitment</span>
                    <h2 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0 0 16px;">Our Mission</h2>
                    <p style="font-size: 1rem; color: #475569; line-height: 1.75; margin: 0 0 20px;">
                        The mission of FESCON is to revolutionize the electrical and civil infrastructure landscape across Pakistan by providing innovative solutions, expert technical guidance, efficient turnkey execution, and unparalleled post-commissioning support to our clients and public utilities.
                    </p>
                </div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; color: #334155;"><i class="fas fa-check text-red" style="margin-right: 6px;"></i> Technical Innovation</span>
                    <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; color: #334155;"><i class="fas fa-check text-red" style="margin-right: 6px;"></i> Prompt Execution</span>
                </div>
            </div>

            <!-- Vision Card -->
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-top: 4px solid #0f172a; border-radius: var(--radius-lg); padding: 40px 34px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: var(--shadow-card);" data-reveal>
                <div>
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(15,23,42,0.08); color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 24px;">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #0f172a; display: block; margin-bottom: 8px;">Long-Term Aspiration</span>
                    <h2 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0 0 16px;">Our Vision</h2>
                    <p style="font-size: 1rem; color: #475569; line-height: 1.75; margin: 0 0 20px;">
                        To be the foremost engineering authority in power transmission, grid station automation, and heavy civil construction—setting the benchmark for quality, safety, and sustainable engineering that empowers industries and communities nationwide.
                    </p>
                </div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; color: #334155;"><i class="fas fa-check text-red" style="margin-right: 6px;"></i> Sustainable Grid</span>
                    <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 6px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; color: #334155;"><i class="fas fa-check text-red" style="margin-right: 6px;"></i> Industry Benchmark</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Timeline / Milestone Journey -->
<section style="background: var(--bg-light-alt); padding: 90px 0 110px;">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 60px;" data-reveal>
            <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 10px;">
                <i class="fas fa-road"></i> Milestones of Excellence
            </div>
            <h2 style="font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 800; color: #0f172a; margin: 0 0 14px;">
                The Growth of FESCON
            </h2>
            <p style="font-size: 0.95rem; color: #64748b; margin: 0;">
                A track record of continuous technical expansion, trusted utility partnerships, and monumental engineering deliveries.
            </p>
        </div>

        <div style="position: relative; max-width: 860px; margin: 0 auto;">
            <!-- Center Line -->
            <div style="position: absolute; left: 30px; top: 10px; bottom: 10px; width: 3px; background: linear-gradient(to bottom, var(--brand-red), #cbd5e1); z-index: 1;"></div>

            <!-- Milestone 1 -->
            <div style="position: relative; padding-left: 80px; margin-bottom: 48px;" data-reveal>
                <div style="position: absolute; left: 16px; top: 0; width: 32px; height: 32px; border-radius: 50%; background: var(--brand-red); border: 4px solid #ffffff; box-shadow: var(--shadow-md); z-index: 2; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 0.75rem;">
                    <i class="fas fa-flag"></i>
                </div>
                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 30px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="font-size: 0.85rem; font-weight: 800; color: var(--brand-red); text-transform: uppercase; letter-spacing: 1px;">2014 &bull; Foundation</span>
                        <span style="background: rgba(198,40,40,0.1); color: var(--brand-red); font-size: 0.75rem; font-weight: 700; padding: 3px 10px; border-radius: 12px;">Inception</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Establishment of FESCON Engineering</h3>
                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                        Founded by veteran power engineers with a mission to deliver specialized high-voltage consultancy, relay testing, and substation design across Pakistan.
                    </p>
                </div>
            </div>

            <!-- Milestone 2 -->
            <div style="position: relative; padding-left: 80px; margin-bottom: 48px;" data-reveal>
                <div style="position: absolute; left: 16px; top: 0; width: 32px; height: 32px; border-radius: 50%; background: var(--brand-red); border: 4px solid #ffffff; box-shadow: var(--shadow-md); z-index: 2; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 0.75rem;">
                    <i class="fas fa-bolt"></i>
                </div>
                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 30px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="font-size: 0.85rem; font-weight: 800; color: var(--brand-red); text-transform: uppercase; letter-spacing: 1px;">2017 &bull; Utility Expansion</span>
                        <span style="background: rgba(198,40,40,0.1); color: var(--brand-red); font-size: 0.75rem; font-weight: 700; padding: 3px 10px; border-radius: 12px;">NTDC &amp; DISCOs</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Enlistment &amp; 132kV / 220kV Grid Turnkey Works</h3>
                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                        Secured national pre-qualifications with NTDC, LESCO, FESCO, GEPCO, and IESCO. Successfully executed 132kV GIS and AIS substation installations and multi-circuit transmission line stringing.
                    </p>
                </div>
            </div>

            <!-- Milestone 3 -->
            <div style="position: relative; padding-left: 80px; margin-bottom: 48px;" data-reveal>
                <div style="position: absolute; left: 16px; top: 0; width: 32px; height: 32px; border-radius: 50%; background: var(--brand-red); border: 4px solid #ffffff; box-shadow: var(--shadow-md); z-index: 2; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 0.75rem;">
                    <i class="fas fa-certificate"></i>
                </div>
                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 30px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="font-size: 0.85rem; font-weight: 800; color: var(--brand-red); text-transform: uppercase; letter-spacing: 1px;">2020 &bull; Quality &amp; Safety Standardization</span>
                        <span style="background: rgba(198,40,40,0.1); color: var(--brand-red); font-size: 0.75rem; font-weight: 700; padding: 3px 10px; border-radius: 12px;">ISO Integrated</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">Triple ISO Certification (9001, 14001, 45001)</h3>
                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                        Formalized comprehensive Quality, Environmental, and Occupational Health &amp; Safety Management Systems across all corporate departments, heavy machinery depots, and active field sites.
                    </p>
                </div>
            </div>

            <!-- Milestone 4 -->
            <div style="position: relative; padding-left: 80px;" data-reveal>
                <div style="position: absolute; left: 16px; top: 0; width: 32px; height: 32px; border-radius: 50%; background: #0f172a; border: 4px solid #ffffff; box-shadow: var(--shadow-md); z-index: 2; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 0.75rem;">
                    <i class="fas fa-star"></i>
                </div>
                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 28px 30px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="font-size: 0.85rem; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 1px;">Present &amp; Beyond &bull; National Leadership</span>
                        <span style="background: rgba(15,23,42,0.1); color: #0f172a; font-size: 0.75rem; font-weight: 700; padding: 3px 10px; border-radius: 12px;">PEC No-Limit</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px;">500kV Megaprojects &amp; Comprehensive EPC</h3>
                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0;">
                        Operating as a premier Tier-1 contractor executing multi-billion PKR grid interconnections, industrial power plants, civil structural complexes, and smart energy infrastructure across the country.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 70px 0; color: #ffffff;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 30px;" data-reveal>
            <div style="max-width: 650px;">
                <span style="display: inline-block; font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brand-red); margin-bottom: 8px;">Explore More</span>
                <h2 style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); font-weight: 800; color: #ffffff; margin: 0 0 10px;">Discover Our Proven Engineering Deliveries</h2>
                <p style="font-size: 0.95rem; color: #cbd5e1; margin: 0; line-height: 1.6;">Browse completed transmission line projects, substation commissions, and civil constructions.</p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/projects.php" class="btn btn-primary" style="padding: 14px 32px; font-size: 1rem;">
                    <i class="fas fa-th"></i> View Projects Portfolio
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>