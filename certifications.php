<?php
/**
 * Certifications & Enlistments - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Cinematic Parallax & Interactive Gallery
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Certifications & Enlistments | Fescon (Pvt.) Ltd';
$current_page = 'certifications';

$certificates = [
    [
        'title' => 'Pakistan Engineering Council (PEC) License',
        'category' => 'PEC Category C-A (No-Limit)',
        'image' => 'assets/images/cer.png',
        'desc' => 'Premier statutory category authorizing turnkey execution of unlimited value electrical, civil, mechanical, and power infrastructure works across Pakistan.'
    ],
    [
        'title' => 'ISO 9001:2015 Quality Management System',
        'category' => 'Quality Standards',
        'image' => 'assets/images/img-1.png',
        'desc' => 'Certified compliance for end-to-end engineering, procurement, construction management, and rigorous quality assurance.'
    ],
    [
        'title' => 'ISO 14001:2015 Environmental Management',
        'category' => 'Environmental HSE',
        'image' => 'assets/images/img-2.png',
        'desc' => 'International certification recognizing systematic environmental management, carbon footprint mitigation, and eco-friendly site procedures.'
    ],
    [
        'title' => 'ISO 45001:2018 Occupational Health & Safety',
        'category' => 'Workplace Safety',
        'image' => 'assets/images/img-3.png',
        'desc' => 'Gold-standard occupational safety framework safeguarding high-voltage electrical field technicians and construction personnel.'
    ],
    [
        'title' => 'Power Utility Enlistments & Pre-Qualifications',
        'category' => 'National Enlistment',
        'image' => 'assets/images/img-4.png',
        'desc' => 'Approved and pre-qualified contractor for NTDC, WAPDA, IESCO, FESCO, GEPCO, LESCO, and K-Electric.'
    ],
];

require_once __DIR__ . '/includes/header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-awards.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-stamp"></i> Accreditations &amp; Compliance
            </div>
            
            <h1 class="page-hero-title">
                Official Registrations &amp; <span class="highlight">Certifications</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Certifications</span>
                <span class="count-tag">5 Regulatory Credentials</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     CERTIFICATES GRID SHOWCASE
========================================================= -->
<section style="background: #f8fafc; padding: 80px 0 100px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 32px;">
            <?php foreach ($certificates as $cert): ?>
            <div class="cert-card" data-reveal style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); display: flex; flex-direction: column; transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.3s ease;">
                
                <!-- Certificate Preview Image with Click-to-Enlarge -->
                <div style="position: relative; height: 320px; overflow: hidden; background: #fff; padding: 14px; display: flex; align-items: center; justify-content: center; cursor: pointer;" onclick="openCertModal('<?php echo asset_url($cert['image']); ?>', '<?php echo htmlspecialchars($cert['title'], ENT_QUOTES); ?>')">
                    <img src="<?php echo asset_url($cert['image']); ?>" 
                         alt="<?php echo htmlspecialchars($cert['title']); ?>" 
                         loading="lazy"
                         style="max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.4s ease;"
                         onmouseover="this.style.transform='scale(1.04)'" 
                         onmouseout="this.style.transform='scale(1)'">
                    
                    <div style="position: absolute; bottom: 12px; right: 12px; background: rgba(11,15,23,0.85); color: #0f172a; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-search-plus" style="color: #ef4444;"></i>
                        <span>Click to View</span>
                    </div>
                </div>

                <!-- Info -->
                <div style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="color: #ff6b6b; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                        <?php echo htmlspecialchars($cert['category']); ?>
                    </div>
                    <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 700; margin: 0 0 10px; line-height: 1.35;">
                        <?php echo htmlspecialchars($cert['title']); ?>
                    </h3>
                    <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                        <?php echo htmlspecialchars($cert['desc']); ?>
                    </p>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- =========================================================
     LIGHTBOX MODAL FOR CERTIFICATES
========================================================= -->
<div id="cert-lightbox" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.92); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 24px;" onclick="closeCertModal()">
    <div style="position: relative; max-width: 900px; max-height: 90vh; text-align: center;" onclick="event.stopPropagation()">
        <button onclick="closeCertModal()" style="position: absolute; top: -45px; right: 0; background: none; border: none; color: #0f172a; font-size: 1.8rem; cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
        <img id="cert-lightbox-img" src="" alt="Certificate Preview" style="max-width: 100%; max-height: 80vh; border-radius: 8px; box-shadow: 0 20px 50px rgba(0,0,0,0.8); background: #fff;">
        <h4 id="cert-lightbox-title" style="color: #fff; margin-top: 14px; font-size: 1.1rem; font-weight: 600;"></h4>
    </div>
</div>

<script>
function openCertModal(src, title) {
    const modal = document.getElementById('cert-lightbox');
    const img = document.getElementById('cert-lightbox-img');
    const titleEl = document.getElementById('cert-lightbox-title');
    img.src = src;
    titleEl.textContent = title;
    modal.style.display = 'flex';
}
function closeCertModal() {
    document.getElementById('cert-lightbox').style.display = 'none';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCertModal();
});
</script>

<!-- =========================================================
     CINEMATIC PARALLAX CTA BANNER
========================================================= -->
<section class="parallax-section" style="position: relative; overflow: hidden; padding: 90px 0; background: #f8fafc; color: #0f172a; text-align: center;">
    <div class="parallax-bg" data-parallax-speed="0.25" style="position: absolute; top: -20%; left: 0; width: 100%; height: 140%; background: url('<?php echo asset_url('assets/images/DJI_0400-scaled.jpg'); ?>') center/cover no-repeat; filter: brightness(0.22) contrast(1.15); pointer-events: none;"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(11,15,23,0.92) 0%, rgba(198,40,40,0.18) 50%, rgba(11,15,23,0.95) 100%);"></div>

    <div class="container" style="position: relative; z-index: 2; max-width: 860px; margin: 0 auto; padding: 0 24px;" data-reveal>
        <span style="display: inline-block; background: rgba(198,40,40,0.2); border: 1px solid rgba(198,40,40,0.5); color: #ff6b6b; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; padding: 6px 16px; border-radius: 999px; margin-bottom: 20px;">
            Audited &amp; Compliant
        </span>
        <h2 style="font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 800; line-height: 1.25; margin: 0 0 18px; color: #ffffff;">
            Require Official Compliance Documents for Pre-Qualification?
        </h2>
        <p style="font-size: 1.05rem; color: #cbd5e1; line-height: 1.65; margin: 0 auto 32px; max-width: 680px;">
            Our tender administration desk can provide verified copies of PEC licenses, tax certificates, and ISO audits upon formal request.
        </p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo $base_url; ?>/contact-us/" style="background: #c62828; color: #ffffff; padding: 14px 34px; border-radius: 8px; font-weight: 700; font-size: 0.95rem; text-decoration: none; box-shadow: 0 8px 24px rgba(198,40,40,0.4);">
                Contact Tenders Office
            </a>
            <a href="<?php echo $base_url; ?>/projects/" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; padding: 14px 28px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                View Project History
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>