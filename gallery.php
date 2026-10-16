<?php
/**
 * Picture Gallery & Events - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Masonry Photo Grid & Event Showcases
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Picture Gallery & Events | Fescon (Pvt.) Ltd';
$current_page = 'gallery';

// Fetch active events dynamically from DB
$db_events = get_all_gallery_events(true);

$events = [];
$all_photos = [];

foreach ($db_events as $row) {
    $imgs = !empty($row['images']) ? json_decode($row['images'], true) : [];
    if (!is_array($imgs)) $imgs = [];
    if (empty($imgs) && !empty($row['cover_image'])) {
        $imgs[] = $row['cover_image'];
    }

    $evt_data = [
        'id' => $row['id'],
        'title' => $row['title'],
        'date' => $row['event_date'],
        'location' => $row['location'],
        'description' => $row['description'],
        'category' => $row['category'],
        'images' => $imgs
    ];
    $events[] = $evt_data;

    foreach ($imgs as $img) {
        $all_photos[] = ['image' => $img, 'event' => $row['title'], 'category' => $row['category']];
    }
}

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-gallery.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-images"></i> Visual Documentation
            </div>
            
            <h1 class="page-hero-title">
                Picture Gallery &amp; <span class="highlight">Events</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Gallery &amp; Events</span>
                <span class="count-tag"><?php echo count($all_photos); ?> Photos &bull; <?php echo count($events); ?> Events</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     EVENTS & PHOTO GALLERY SECTIONS
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 80px 0 100px;">
    <div class="container">

        <div style="text-align: center; max-width: 760px; margin: 0 auto 50px;" data-reveal>
            <div style="color: var(--brand-red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
                Project Documentation
            </div>
            <h2 style="font-size: clamp(2rem, 3.2vw, 2.6rem); font-weight: 800; color: #0f172a; margin: 0; line-height: 1.25;">
                Events &amp; <span class="highlight">Photo Gallery</span>
            </h2>
        </div>

        <!-- Event Cards -->
        <?php foreach ($events as $idx => $event): ?>
        <div style="margin-bottom: 60px;" data-reveal>
            <!-- Event Header -->
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid var(--brand-red);">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(198,40,40,0.12); color: var(--brand-red); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                    <?php
                    $icons = ['fas fa-bolt', 'fas fa-project-diagram', 'fas fa-search-location', 'fas fa-hard-hat', 'fas fa-plug', 'fas fa-shield-alt'];
                    echo '<i class="' . ($icons[$idx] ?? 'fas fa-camera') . '"></i>';
                    ?>
                </div>
                <div style="flex-grow: 1;">
                    <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0 0 4px;">
                        <?php echo htmlspecialchars($event['title']); ?>
                    </h3>
                    <div style="display: flex; gap: 16px; flex-wrap: wrap; font-size: 0.85rem; color: #64748b;">
                        <span><i class="far fa-calendar-alt text-red"></i> <?php echo htmlspecialchars($event['date']); ?></span>
                        <span><i class="fas fa-map-marker-alt text-red"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                        <span style="background: rgba(198,40,40,0.12); color: var(--brand-red); padding: 2px 10px; border-radius: 12px; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">
                            <?php echo htmlspecialchars($event['category']); ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Event Description -->
            <p style="color: #475569; font-size: 0.95rem; line-height: 1.7; margin: 0 0 20px; max-width: 900px;">
                <?php echo htmlspecialchars($event['description']); ?>
            </p>

            <!-- Photo Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px;">
                <?php foreach ($event['images'] as $photo): ?>
                <div class="gallery-item" style="position: relative; border-radius: var(--radius-md); overflow: hidden; aspect-ratio: 3/2; background: #e2e8f0; box-shadow: var(--shadow-card); border: 1px solid var(--border-light); cursor: pointer;" onclick="openGalleryModal('<?php echo asset_url($photo); ?>', '<?php echo htmlspecialchars($event['title'], ENT_QUOTES); ?>')">
                    <img src="<?php echo asset_url($photo); ?>" 
                         alt="<?php echo htmlspecialchars($event['title']); ?>" 
                         loading="lazy"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                         onmouseover="this.style.transform='scale(1.08)'"
                         onmouseout="this.style.transform='scale(1)'">
                    <div style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.45) 0%, transparent 50%); opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                        <div style="position: absolute; bottom: 14px; left: 14px; right: 14px; color: #ffffff;">
                            <div style="font-size: 0.82rem; font-weight: 600;"><?php echo htmlspecialchars($event['title']); ?></div>
                        </div>
                        <div style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.9); color: #0f172a; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<!-- =========================================================
     LIGHTBOX MODAL FOR GALLERY PHOTOS
========================================================= -->
<div id="gallery-lightbox" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.92); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 24px;" onclick="closeGalleryModal()">
    <div style="position: relative; max-width: 1100px; max-height: 90vh; text-align: center;" onclick="event.stopPropagation()">
        <button onclick="closeGalleryModal()" style="position: absolute; top: -50px; right: 0; background: none; border: none; color: #ffffff; font-size: 2rem; cursor: pointer; z-index: 10;">
            <i class="fas fa-times"></i>
        </button>
        <img id="gallery-lightbox-img" src="" alt="Gallery Preview" style="max-width: 100%; max-height: 82vh; border-radius: 10px; box-shadow: 0 20px 50px rgba(0,0,0,0.8);">
        <h4 id="gallery-lightbox-title" style="color: #ffffff; margin-top: 16px; font-size: 1.1rem; font-weight: 600;"></h4>
    </div>
</div>

<script>
function openGalleryModal(src, title) {
    const modal = document.getElementById('gallery-lightbox');
    document.getElementById('gallery-lightbox-img').src = src;
    document.getElementById('gallery-lightbox-title').textContent = title;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeGalleryModal() {
    document.getElementById('gallery-lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeGalleryModal();
});
</script>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 70px 0; color: #ffffff; text-align: center;">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;" data-reveal>
            <h2 style="font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0 0 14px;">
                Want to See Our Work in Action?
            </h2>
            <p style="color: #94a3b8; font-size: 1rem; line-height: 1.7; margin: 0 0 28px;">
                Visit our completed and ongoing project portfolio or get in touch for a technical consultation.
            </p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo $base_url; ?>/projects.php" class="btn btn-primary">
                    <i class="fas fa-project-diagram"></i> View Projects
                </a>
                <a href="<?php echo $base_url; ?>/contact-us.php" class="btn btn-outline-white">
                    <i class="fas fa-paper-plane"></i> Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/modern-footer.php'; ?>
