<?php
/**
 * Awards & Appreciation Certificates - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Certificate Showcase & Lightbox
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Awards & Appreciation Certificates | Fescon (Pvt.) Ltd';
$current_page = 'awards';

// Fetch active awards dynamically from DB
$awards = get_all_awards(true);

// Summary statistics
$total_awards = count($awards);
$iso_count = 0;
foreach ($awards as $a) {
    if (strpos($a['title'], 'ISO') !== false) $iso_count++;
}

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/DJI_0400-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-trophy"></i> Recognition &amp; Compliance
            </div>
            
            <h1 class="page-hero-title">
                Awards &amp; <span class="highlight">Appreciation Certificates</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Official registrations, international quality certifications, client appreciation letters, and industry recognitions that validate Fescon's engineering excellence and compliance standards.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Awards &amp; Certificates</span>
                <span class="count-tag"><?php echo $total_awards; ?> Credentials &bull; <?php echo $iso_count; ?> ISO Certifications</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     CREDENTIALS SUMMARY COUNTERS
========================================================= -->
<section style="background: #ffffff; padding: 50px 0; border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; text-align: center;" data-reveal>
            <div>
                <div style="font-size: 2.5rem; font-weight: 800; color: var(--brand-red); font-family: 'Cinzel', serif;"><?php echo $total_awards; ?></div>
                <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;">Total Credentials</div>
            </div>
            <div>
                <div style="font-size: 2.5rem; font-weight: 800; color: var(--brand-red); font-family: 'Cinzel', serif;"><?php echo $iso_count; ?></div>
                <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;">ISO Certifications</div>
            </div>
            <div>
                <div style="font-size: 2.5rem; font-weight: 800; color: var(--brand-red); font-family: 'Cinzel', serif;">C-A</div>
                <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;">PEC Category (No Limit)</div>
            </div>
            <div>
                <div style="font-size: 2.5rem; font-weight: 800; color: var(--brand-red); font-family: 'Cinzel', serif;">7+</div>
                <div style="font-size: 0.9rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;">Utility Enlistments</div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     AWARDS & CERTIFICATES GRID
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container">

        <div style="text-align: center; max-width: 760px; margin: 0 auto 55px;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Verified Credentials
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #0f172a; margin: 0 0 16px; line-height: 1.25;">
                Certifications, Awards &amp; <span class="highlight">Appreciation</span>
            </h2>
            <p style="font-size: 1rem; color: #475569; line-height: 1.65; margin: 0;">
                Each credential represents verified engineering competence, regulatory compliance, and industry trust earned through consistent project delivery excellence.
            </p>
        </div>

        <!-- Certificates Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 32px;">
            <?php foreach ($awards as $award): ?>
            <div class="award-card" data-reveal style="background: #ffffff; border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); display: flex; flex-direction: column; transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.3s ease;">
                
                <!-- Certificate Preview Image -->
                <div style="position: relative; height: 320px; overflow: hidden; background: #ffffff; padding: 16px; display: flex; align-items: center; justify-content: center; cursor: pointer; border-bottom: 1px solid var(--border-light);" onclick="openAwardModal('<?php echo asset_url($award['image']); ?>', '<?php echo htmlspecialchars($award['title'], ENT_QUOTES); ?>')">
                    <img src="<?php echo asset_url($award['image']); ?>" 
                         alt="<?php echo htmlspecialchars($award['title']); ?>" 
                         loading="lazy"
                         style="max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.4s ease;"
                         onmouseover="this.style.transform='scale(1.04)'" 
                         onmouseout="this.style.transform='scale(1)'">
                    
                    <div style="position: absolute; top: 14px; left: 14px; background: rgba(198,40,40,0.92); color: #ffffff; padding: 4px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                        <?php echo htmlspecialchars($award['category']); ?>
                    </div>

                    <div style="position: absolute; bottom: 14px; right: 14px; background: rgba(15,23,42,0.85); color: #ffffff; padding: 6px 14px; border-radius: 8px; font-size: 0.78rem; font-weight: 600; display: flex; align-items: center; gap: 6px; backdrop-filter: blur(4px);">
                        <i class="fas fa-search-plus"></i> Click to View
                    </div>
                </div>

                <!-- Certificate Details -->
                <div style="padding: 26px 24px; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="display: flex; gap: 12px; align-items: center; font-size: 0.82rem; color: #64748b; margin-bottom: 10px;">
                        <span><i class="fas fa-check-circle text-red"></i> <?php echo htmlspecialchars($award['year']); ?></span>
                        <span>&bull;</span>
                        <span><i class="fas fa-university text-red"></i> <?php echo htmlspecialchars($award['issuer']); ?></span>
                    </div>

                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 12px; line-height: 1.35;">
                        <?php echo htmlspecialchars($award['title']); ?>
                    </h3>
                    
                    <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0; flex-grow: 1;">
                        <?php echo htmlspecialchars($award['description']); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- =========================================================
     WHY CREDENTIALS MATTER
========================================================= -->
<section style="background: #ffffff; padding: 70px 0; border-top: 1px solid var(--border-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 28px;" data-reveal>
            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-top: 4px solid var(--brand-red); border-radius: var(--radius-lg); padding: 32px 26px;">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 18px;">
                    <i class="fas fa-check-double"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">Verified Competence</h4>
                <p style="color: #475569; font-size: 0.9rem; line-height: 1.65; margin: 0;">
                    Each certification is issued by internationally accredited bodies, confirming that Fescon's engineering processes meet global industry benchmarks.
                </p>
            </div>

            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-top: 4px solid #0f172a; border-radius: var(--radius-lg); padding: 32px 26px;">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(15,23,42,0.08); color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 18px;">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">Client Confidence</h4>
                <p style="color: #475569; font-size: 0.9rem; line-height: 1.65; margin: 0;">
                    Proper licensing and ISO certifications give our clients and partners the assurance that all projects are executed with regulatory compliance and quality guarantees.
                </p>
            </div>

            <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-top: 4px solid var(--brand-red); border-radius: var(--radius-lg); padding: 32px 26px;">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 18px;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin: 0 0 10px;">Safety Assurance</h4>
                <p style="color: #475569; font-size: 0.9rem; line-height: 1.65; margin: 0;">
                    ISO 45001 certification ensures uncompromised health and safety protocols across all active sites, protecting our workforce and communities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     LIGHTBOX MODAL FOR CERTIFICATES
========================================================= -->
<div id="award-lightbox" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.92); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 24px;" onclick="closeAwardModal()">
    <div style="position: relative; max-width: 900px; max-height: 90vh; text-align: center;" onclick="event.stopPropagation()">
        <button onclick="closeAwardModal()" style="position: absolute; top: -50px; right: 0; background: none; border: none; color: #ffffff; font-size: 2rem; cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
        <img id="award-lightbox-img" src="" alt="Certificate Preview" style="max-width: 100%; max-height: 82vh; border-radius: 10px; box-shadow: 0 20px 50px rgba(0,0,0,0.8); background: #ffffff;">
        <h4 id="award-lightbox-title" style="color: #ffffff; margin-top: 16px; font-size: 1.1rem; font-weight: 600;"></h4>
    </div>
</div>

<script>
function openAwardModal(src, title) {
    const modal = document.getElementById('award-lightbox');
    document.getElementById('award-lightbox-img').src = src;
    document.getElementById('award-lightbox-title').textContent = title;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeAwardModal() {
    document.getElementById('award-lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeAwardModal();
});
</script>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 70px 0; color: #ffffff; text-align: center;">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;" data-reveal>
            <h2 style="font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0 0 14px;">
                Partner With a Certified EPC Contractor
            </h2>
            <p style="color: #94a3b8; font-size: 1rem; line-height: 1.7; margin: 0 0 28px;">
                Fescon's certified credentials and proven track record ensure your infrastructure projects are delivered with the highest standards of quality, safety, and compliance.
            </p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Request Consultation
                </a>
                <a href="<?php echo $base_url; ?>/services.php" class="btn btn-outline-white">
                    <i class="fas fa-th-list"></i> View Our Services
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>
