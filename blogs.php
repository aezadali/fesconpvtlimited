<?php
/**
 * Blogs & Engineering Insights - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Editorial Grid & Article Viewer
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Blogs & Engineering Insights | Fescon (Pvt.) Ltd';
$current_page = 'blogs';

// Curated Engineering Insights & Technical Articles
$articles = [
    [
        'id' => 1,
        'slug' => 'building-the-future-quality-construction-work',
        'title' => 'Building the Future: The Importance of Quality Construction Work',
        'category' => 'Engineering Excellence',
        'category_badge' => 'Infrastructure',
        'date' => 'October 10, 2026',
        'read_time' => '5 min read',
        'author' => 'FESCON Technical Board',
        'author_role' => 'Engineering Division',
        'image' => 'assets/images/shutterstock_1712804041.jpg.webp',
        'summary' => 'Quality construction work is the cornerstone of durable modern infrastructure. Discover why precision engineering, certified materials, and technological adoption define successful megaprojects.',
        'sections' => [
            [
                'title' => 'The Backbone of Modern Infrastructure',
                'icon' => 'fas fa-city',
                'content' => 'The construction industry is the backbone of modern infrastructure, shaping cities, communities, and businesses. Whether it is residential buildings, commercial spaces, or large-scale civil infrastructure projects, quality construction work is vital for structural safety, environmental resilience, and multi-decade functionality.'
            ],
            [
                'title' => 'The Role of Skilled Professionals',
                'icon' => 'fas fa-user-cog',
                'content' => 'The cornerstone of successful construction lies in experienced and multidisciplinary teams. Fescon mobilizes chartered civil, electrical, and mechanical engineers alongside certified safety officers and technicians. Each discipline collaborates seamlessly to ensure that milestones are executed on schedule, within budgeted tolerances, and in rigorous compliance with statutory building codes and client specifications.'
            ],
            [
                'title' => 'The Imperative of High-Grade Certified Materials',
                'icon' => 'fas fa-cubes',
                'content' => 'Substandard materials compromise structural integrity, leading to premature deterioration, escalating maintenance liabilities, and catastrophic risks. Investing in tested, traceable high-performance materials—from high-strength reinforced steel to sulfate-resistant concrete mixes—ensures buildings and industrial foundations endure extreme climatic stressors for generations.'
            ],
            [
                'title' => 'Impact of Modern Analytical & Computational Tools',
                'icon' => 'fas fa-laptop-code',
                'content' => 'Engineering technology continues to transform modern project workflows. The adoption of computer-aided drafting (AutoCAD, Civil 3D), Oracle Primavera project scheduling, and high-precision laser surveying instruments has elevated accuracy while compressing cycle times. Real-time data integration minimizes site discrepancies, optimizes resource allocation, and delivers superior operational transparency.'
            ],
            [
                'title' => 'Sustainable Construction & Environmental Stewardship',
                'icon' => 'fas fa-leaf',
                'content' => 'Sustainability is an indispensable metric in modern construction. Incorporating energy-efficient designs, low-carbon concrete formulations, and sustainable waste reduction techniques reduces environmental footprints. Green construction practices safeguard the surrounding ecology while significantly lowering long-term lifecycle utility costs for asset owners.'
            ],
            [
                'title' => 'Uncompromising Health, Safety & Environmental (HSE) Compliance',
                'icon' => 'fas fa-shield-alt',
                'content' => 'At Fescon, safety is an absolute core value. Adhering to certified ISO 45001 occupational health and safety benchmarks prevents accidents and fosters high-trust work environments. Daily toolbox talks, mandatory certified PPE protocols, hazard identification matrices, and regular site audits guarantee zero-harm field execution across all active project sites.'
            ]
        ],
        'tags' => ['Civil Works', 'Infrastructure', 'Quality Engineering', 'HSE Compliance', 'Technology']
    ],
    [
        'id' => 2,
        'slug' => 'advancements-in-high-voltage-substation-engineering',
        'title' => 'Advancements in High-Voltage Substation Engineering (132kV - 500kV)',
        'category' => 'Power Transmission',
        'category_badge' => 'Grid Networks',
        'date' => 'October 04, 2026',
        'read_time' => '6 min read',
        'author' => 'High-Voltage EPC Team',
        'author_role' => 'Power Division',
        'image' => 'assets/images/transformer.webp',
        'summary' => 'Modernizing national grid stations with SF6 gas-insulated switchgear, digital protection relays, and smart monitoring systems for continuous grid reliability.',
        'sections' => [
            [
                'title' => 'Transitioning to High-Performance Power Grids',
                'icon' => 'fas fa-bolt',
                'content' => 'Modern energy demands necessitate high-availability transmission backbones. Grid stations operating at 132kV, 220kV, and 500kV form the critical nodes that transport base-load power across national grids. Upgrading legacy air-insulated equipment to compact, highly reliable switchgear has proven decisive in reducing outage frequencies and containment footprints.'
            ],
            [
                'title' => 'Gas-Insulated Switchgear (GIS) vs. AIS Systems',
                'icon' => 'fas fa-industry',
                'content' => 'In urban and space-constrained industrial zones, GIS technology offers up to an 80% reduction in land footprint compared to conventional AIS installations. Enclosed SF6 gas compartments protect energized conductors against dust, airborne salinity, and atmospheric pollution, drastically minimizing maintenance overheads.'
            ],
            [
                'title' => 'Digital Protection Relays & Substation Automation',
                'icon' => 'fas fa-microchip',
                'content' => 'The deployment of IEC 61850 protocol-enabled protection relays (SEL, ABB, Siemens) enables instantaneous fault isolation within milliseconds. Advanced numerical relays provide real-time waveform capture, remote disturbance monitoring, and synchronized phasor measurements for grid stability analysts.'
            ]
        ],
        'tags' => ['Substations', 'Power Transformers', 'IEC 61850', 'GIS', 'Grid Stability']
    ],
    [
        'id' => 3,
        'slug' => 'energy-efficiency-mep-integration-commercial-buildings',
        'title' => 'Integrated MEP Engineering for High-Performance Industrial Facilities',
        'category' => 'MEP Systems',
        'category_badge' => 'Building Systems',
        'date' => 'September 28, 2026',
        'read_time' => '4 min read',
        'author' => 'MEP Systems Department',
        'author_role' => 'Mechanical & Electrical',
        'image' => 'assets/images/IMG_4615-scaled.jpg',
        'summary' => 'How harmonized mechanical HVAC, fire suppression, low-voltage distribution, and intelligent building automation drive industrial energy efficiency.',
        'sections' => [
            [
                'title' => 'Harmonizing Mechanical, Electrical & Plumbing Systems',
                'icon' => 'fas fa-cogs',
                'content' => 'Complex industrial and commercial facilities rely on tightly integrated mechanical, electrical, and plumbing engineering. When MEP design is coordinated early through Building Information Modeling (BIM), clashing utilities, thermal bridge inefficiencies, and costly retrofit modifications are eliminated prior to groundbreaking.'
            ],
            [
                'title' => 'Optimizing HVAC Thermal Efficiency',
                'icon' => 'fas fa-fan',
                'content' => 'HVAC systems represent the largest single energy consumer in commercial complexes. By leveraging variable refrigerant flow (VRF) units, demand-controlled ventilation (DCV), and high-efficiency chillers, building operators achieve up to 35% reductions in lifecycle energy consumption.'
            ],
            [
                'title' => 'Life Safety & NFPA Compliant Fire Suppression',
                'icon' => 'fas fa-fire-extinguisher',
                'content' => 'Industrial facilities require NFPA-standard fire detection and suppression networks. Automated addressable smoke detection paired with diesel backup fire pumps and zoned pre-action sprinkler systems guarantees occupant safety and safeguards multimillion-dollar industrial equipment.'
            ]
        ],
        'tags' => ['MEP', 'HVAC', 'Building Automation', 'Energy Efficiency', 'NFPA']
    ]
];

// Active article selection (supports ?article=slug or defaults to first)
$selected_slug = $_GET['article'] ?? null;
$active_article = null;
if ($selected_slug) {
    foreach ($articles as $a) {
        if ($a['slug'] === $selected_slug) {
            $active_article = $a;
            break;
        }
    }
}

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/transformer.webp'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-newspaper"></i> Technical Knowledge &amp; Insights
            </div>
            
            <h1 class="page-hero-title">
                Engineering <span class="highlight">Insights &amp; Articles</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Blogs &amp; Insights</span>
                <span class="count-tag"><?php echo count($articles); ?> Published Articles</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     FEATURED ARTICLE SPOTLIGHT (If Viewing a Specific Post)
========================================================= -->
<?php if ($active_article): ?>
<section style="background: #ffffff; padding: 60px 0 30px; border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;" data-reveal>
            <a href="<?php echo $base_url; ?>/blogs/" class="btn btn-outline-dark" style="margin-bottom: 24px; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fas fa-arrow-left"></i> Back to All Articles
            </a>
            
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-bottom: 16px;">
                <span style="background: rgba(198,40,40,0.12); color: var(--brand-red); font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase;">
                    <?php echo htmlspecialchars($active_article['category_badge']); ?>
                </span>
                <span style="color: #64748b; font-size: 0.88rem;">
                    <i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($active_article['date']); ?>
                </span>
                <span style="color: #64748b; font-size: 0.88rem;">
                    <i class="far fa-clock"></i> <?php echo htmlspecialchars($active_article['read_time']); ?>
                </span>
            </div>

            <h1 style="color: #0f172a; font-size: clamp(2rem, 3.5vw, 2.7rem); font-weight: 800; line-height: 1.25; margin: 0 0 20px;">
                <?php echo htmlspecialchars($active_article['title']); ?>
            </h1>

            <div style="display: flex; align-items: center; gap: 14px; padding: 14px 0; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light); margin-bottom: 30px;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;"><?php echo htmlspecialchars($active_article['author']); ?></div>
                    <div style="font-size: 0.82rem; color: #64748b;"><?php echo htmlspecialchars($active_article['author_role']); ?></div>
                </div>
            </div>

            <!-- Featured Image -->
            <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 35px; box-shadow: var(--shadow-card); border: 1px solid var(--border-light);">
                <img src="<?php echo asset_url($active_article['image']); ?>" alt="<?php echo htmlspecialchars($active_article['title']); ?>" style="width: 100%; height: auto; max-height: 480px; object-fit: cover; display: block;">
            </div>

            <!-- Article Body Sections -->
            <div class="article-content-body" style="font-size: 1.05rem; line-height: 1.85; color: #334155;">
                <p style="font-size: 1.15rem; color: #1e293b; font-weight: 500; line-height: 1.75; margin-bottom: 30px; padding-left: 18px; border-left: 4px solid var(--brand-red);">
                    <?php echo htmlspecialchars($active_article['summary']); ?>
                </p>

                <?php foreach ($active_article['sections'] as $sec): ?>
                <div style="margin-bottom: 32px; background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 28px 24px;">
                    <h3 style="color: #0f172a; font-size: 1.35rem; font-weight: 700; margin: 0 0 14px; display: flex; align-items: center; gap: 12px;">
                        <span style="color: var(--brand-red); font-size: 1.2rem;"><i class="<?php echo htmlspecialchars($sec['icon']); ?>"></i></span>
                        <?php echo htmlspecialchars($sec['title']); ?>
                    </h3>
                    <p style="color: #475569; font-size: 1rem; line-height: 1.8; margin: 0;">
                        <?php echo htmlspecialchars($sec['content']); ?>
                    </p>
                </div>
                <?php endforeach; ?>

                <!-- Tags & Share -->
                <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                        <span style="color: #64748b; font-size: 0.88rem; font-weight: 600;"><i class="fas fa-tags text-red"></i> Tags:</span>
                        <?php foreach ($active_article['tags'] as $t): ?>
                        <span style="background: #ffffff; border: 1px solid var(--border-light); padding: 4px 12px; border-radius: 14px; font-size: 0.82rem; color: #334155; font-weight: 600;">
                            #<?php echo htmlspecialchars($t); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary" style="padding: 10px 20px;">
                            <i class="fas fa-envelope"></i> Discuss Engineering Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================
     ALL ARTICLES EDITORIAL GRID (Clean Light Theme)
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px; position: relative;">
    <div class="container">
        
        <div style="text-align: center; max-width: 760px; margin: 0 auto 50px;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Industry Publications
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #0f172a; margin: 0 0 16px; line-height: 1.25;">
                Latest Engineering &amp; <span class="highlight">Construction Insights</span>
            </h2>
            <p style="font-size: 1rem; color: #475569; line-height: 1.65; margin: 0;">
                Read our engineering board's analysis on infrastructure developments, high-voltage substation protocols, and modern turnkey construction benchmarks.
            </p>
        </div>

        <!-- Articles Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 32px;">
            <?php foreach ($articles as $art): ?>
            <article class="blog-card" data-reveal style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); display: flex; flex-direction: column; transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.3s ease;">
                
                <!-- Media Thumbnail -->
                <div style="position: relative; height: 230px; overflow: hidden; background: #e2e8f0;">
                    <img src="<?php echo asset_url($art['image']); ?>" 
                         alt="<?php echo htmlspecialchars($art['title']); ?>" 
                         loading="lazy"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'">
                    
                    <div style="position: absolute; top: 16px; left: 16px; background: rgba(198,40,40,0.92); color: #ffffff; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(4px);">
                        <?php echo htmlspecialchars($art['category_badge']); ?>
                    </div>

                    <div style="position: absolute; bottom: 12px; right: 12px; background: rgba(15,23,42,0.85); color: #ffffff; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; backdrop-filter: blur(4px);">
                        <i class="far fa-clock"></i> <?php echo htmlspecialchars($art['read_time']); ?>
                    </div>
                </div>

                <!-- Content Body -->
                <div style="padding: 26px 24px; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="display: flex; gap: 12px; align-items: center; font-size: 0.82rem; color: #64748b; margin-bottom: 12px;">
                        <span><i class="far fa-calendar-alt text-red"></i> <?php echo htmlspecialchars($art['date']); ?></span>
                        <span>&bull;</span>
                        <span><i class="fas fa-layer-group text-red"></i> <?php echo htmlspecialchars($art['category']); ?></span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 12px; line-height: 1.4;">
                        <a href="<?php echo $base_url; ?>/blogs/?article=<?php echo urlencode($art['slug']); ?>" style="color: inherit; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--brand-red)'" onmouseout="this.style.color='#0f172a'">
                            <?php echo htmlspecialchars($art['title']); ?>
                        </a>
                    </h3>

                    <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0 0 20px; flex-grow: 1;">
                        <?php echo htmlspecialchars($art['summary']); ?>
                    </p>

                    <div style="border-top: 1px solid var(--border-light); padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 0.82rem; color: #64748b; font-weight: 600;">
                            By <strong style="color: #0f172a;"><?php echo htmlspecialchars($art['author']); ?></strong>
                        </div>
                        <a href="<?php echo $base_url; ?>/blogs/?article=<?php echo urlencode($art['slug']); ?>" style="color: var(--brand-red); font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- =========================================================
     CORPORATE CTA BANNER
========================================================= -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 70px 0; color: #ffffff; text-align: center;">
    <div class="container">
        <div style="max-width: 760px; margin: 0 auto;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Partner With Us
            </div>
            <h2 style="font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0 0 16px; line-height: 1.25;">
                Looking for Accredited EPC &amp; Engineering Contractors?
            </h2>
            <p style="color: #94a3b8; font-size: 1rem; line-height: 1.7; margin: 0 0 28px;">
                From preliminary design to commissioning of grid substations, power distribution networks, and heavy civil structures, Fescon delivers proven engineering excellence.
            </p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Request Technical Consultation
                </a>
                <a href="<?php echo $base_url; ?>/services.php" class="btn btn-outline-white">
                    <i class="fas fa-th-list"></i> Explore All Services
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>