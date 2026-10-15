<?php
/**
 * Collaborations & Strategic Partners - Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Our Collaborations & Utility Partners | Fescon (Pvt.) Ltd';
$current_page = 'collaborations';

require_once __DIR__ . '/includes/modern-header.php';

$collaborations = [
    [
        'slug' => 'wapda',
        'name' => 'WAPDA',
        'title' => 'Water and Power Development Authority',
        'logo' => 'assets/images/logo-1.png',
        'desc' => 'Hydropower infrastructure, generation interconnection, and grid engineering partnerships.',
        'badge' => 'Federal Utility'
    ],
    [
        'slug' => 'ntdc',
        'name' => 'NTDC',
        'title' => 'National Transmission & Despatch Company',
        'logo' => 'assets/images/logo-3.png',
        'desc' => '500kV / 220kV primary grid stations, transmission line stringing, and national grid dispatch.',
        'badge' => 'National Grid'
    ],
    [
        'slug' => 'lesco',
        'name' => 'LESCO',
        'title' => 'Lahore Electric Supply Company',
        'logo' => 'assets/images/logo-6-copy.png',
        'desc' => '132kV grid substation expansion, urban underground cabling, and distribution modernization.',
        'badge' => 'Power DISCO'
    ],
    [
        'slug' => 'iesco',
        'name' => 'IESCO',
        'title' => 'Islamabad Electric Supply Company',
        'logo' => 'assets/images/logo-2.png',
        'desc' => 'Capital territory power distribution, substation civil infrastructure, and switchgear commissioning.',
        'badge' => 'Power DISCO'
    ],
    [
        'slug' => 'gepco',
        'name' => 'GEPCO',
        'title' => 'Gujranwala Electric Power Company',
        'logo' => 'assets/images/logo-4.png',
        'desc' => 'Industrial belt transmission networks, 132kV transmission towers, and high-load substation construction.',
        'badge' => 'Power DISCO'
    ],
    [
        'slug' => 'fesco',
        'name' => 'FESCO',
        'title' => 'Faisalabad Electric Supply Company',
        'logo' => 'assets/images/logo-5-copy.png',
        'desc' => 'Textile hub power infrastructure, grid augmentation, and transmission line civil foundations.',
        'badge' => 'Power DISCO'
    ],
    [
        'slug' => 'k-electric',
        'name' => 'K-Electric',
        'title' => 'K-Electric Karachi',
        'logo' => 'assets/images/logo-7.png',
        'desc' => 'Karachi megacity grid transmission, high-capacity substation commissioning, and industrial ties.',
        'badge' => 'Integrated Utility'
    ],
];
?>

<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/glowing-push-pin-illuminates-world-map-global-connections-digital-art-dark-theme-aerial-view-impactful-visualization-glowing-push-350841315.webp'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-handshake"></i> Strategic Alliances
            </div>
            
            <h1 class="page-hero-title">
                Collaborations &amp; <span class="highlight">Partners</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Collaborations</span>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section style="background: #ffffff; padding: 90px 0;">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 50px;" data-reveal>
            <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); margin-bottom: 10px;">
                <i class="fas fa-network-wired"></i> Public &amp; Private Utilities
            </div>
            <h2 style="font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 800; color: #0f172a; margin: 0 0 12px;">
                Key Collaborating Entities
            </h2>
            <p style="font-size: 0.95rem; color: #64748b; margin: 0;">
                Click any partner organization to inspect projects successfully executed and handed over by FESCON.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            <?php foreach ($collaborations as $partner): ?>
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 34px 28px; box-shadow: var(--shadow-card); display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.25s ease, box-shadow 0.25s ease;" data-reveal>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: 12px; padding: 12px 20px; display: inline-flex; align-items: center; justify-content: center; height: 75px; min-width: 150px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <img src="<?php echo asset_url($partner['logo']); ?>" alt="<?php echo htmlspecialchars($partner['name']); ?>" style="max-height: 52px; max-width: 130px; object-fit: contain; display: block;">
                        </div>
                        <span style="background: rgba(198,40,40,0.1); color: var(--brand-red); font-size: 0.75rem; font-weight: 700; padding: 5px 12px; border-radius: 16px;">
                            <?php echo htmlspecialchars($partner['badge']); ?>
                        </span>
                    </div>

                    <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 0 0 6px;">
                        <?php echo htmlspecialchars($partner['name']); ?>
                    </h3>
                    <p style="font-size: 0.85rem; font-weight: 600; color: var(--brand-red); margin: 0 0 12px;">
                        <?php echo htmlspecialchars($partner['title']); ?>
                    </p>
                    <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin: 0 0 24px;">
                        <?php echo htmlspecialchars($partner['desc']); ?>
                    </p>
                </div>

                <div>
                    <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($partner['slug']); ?>" class="btn btn-outline" style="width: 100%; text-align: center; justify-content: center; padding: 10px 18px; font-size: 0.88rem;">
                        <span>View <?php echo htmlspecialchars($partner['name']); ?> Projects</span>
                        <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Partnership Philosophy -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; align-items: center;">
            <div data-reveal>
                <span style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--brand-red); display: block; margin-bottom: 10px;">Why Partners Trust FESCON</span>
                <h2 style="font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 800; color: #0f172a; line-height: 1.25; margin: 0 0 20px;">
                    Built on Technical Integrity &amp; Guaranteed Performance
                </h2>
                <p style="font-size: 0.98rem; color: #475569; line-height: 1.75; margin: 0 0 18px;">
                    Over 15 years of public utility contracting, FESCON has maintained an unblemished record of adherence to tender specifications, transparent billing, and rigorous factory acceptance testing (FAT) alongside client inspectors.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 24px;">
                    <div style="background: #ffffff; padding: 18px; border-radius: var(--radius-md); border: 1px solid var(--border-light);">
                        <div style="font-size: 1.6rem; font-weight: 800; color: var(--brand-red);">100%</div>
                        <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Prequalification Compliance</div>
                    </div>
                    <div style="background: #ffffff; padding: 18px; border-radius: var(--radius-md); border: 1px solid var(--border-light);">
                        <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">Zero</div>
                        <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Contractual Penalties</div>
                    </div>
                </div>
            </div>

            <div style="display: grid; gap: 20px;" data-reveal>
                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 26px 24px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; gap: 18px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 6px;">Joint EPC Ventures</h4>
                            <p style="font-size: 0.88rem; color: #475569; line-height: 1.6; margin: 0;">Collaborating with multinational equipment manufacturers for GIS switchgear, power transformers, and SCADA automation.</p>
                        </div>
                    </div>
                </div>

                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 26px 24px; box-shadow: var(--shadow-card);">
                    <div style="display: flex; gap: 18px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 6px;">PEC "No Limit" Enlistment</h4>
                            <p style="font-size: 0.88rem; color: #475569; line-height: 1.6; margin: 0;">Authorized to bid and execute mega infrastructure works without financial or technical ceiling limitations.</p>
                        </div>
                    </div>
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
                <span style="display: inline-block; font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brand-red); margin-bottom: 8px;">Explore Tendering &amp; Partnerships</span>
                <h2 style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); font-weight: 800; color: #ffffff; margin: 0 0 10px;">Propose a Collaboration or Subcontracting Venture</h2>
                <p style="font-size: 0.95rem; color: #cbd5e1; margin: 0; line-height: 1.6;">Contact our business development department to submit JV proposals or subcontracting inquiries.</p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/contact-us/" class="btn btn-primary" style="padding: 14px 32px; font-size: 1rem;">
                    <i class="fas fa-handshake"></i> Inquire About Partnership
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>