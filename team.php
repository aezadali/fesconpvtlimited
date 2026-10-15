<?php
/**
 * Team & Executive Leadership Page - Fescon (Pvt.) Ltd
 * Precision Engineering, Turnkey EPC, Transmission, Substations & Infrastructure
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = "Executive Leadership & Engineering Teams | Fescon (Pvt.) Ltd";
$current_page = 'team';

// Fetch all active team members from database
$all_members = get_all_team_members(true);
$departments = get_team_departments();

require_once __DIR__ . '/includes/modern-header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-team.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-users-cog"></i> Multidisciplinary Talent
            </div>
            
            <h1 class="page-hero-title">
                Executive Leadership &amp; <span class="highlight">Engineering Teams</span>
            </h1>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo $base_url; ?>/about-us/">Company</a>
                <span class="sep">/</span>
                <span class="current">Team</span>
                <span class="count-tag"><?php echo count($all_members); ?> Key Personnel</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     TEAM DIRECTORY & DEPARTMENT FILTER SECTION
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 70px 0 100px; position: relative;">
    <div class="container">
        <!-- Filter Tabs -->
        <div class="projects-filter-bar" style="margin-top: 0; margin-bottom: 45px;" data-reveal>
            <button class="filter-btn active" data-team-filter="all">All Members</button>
            <?php foreach ($departments as $dept): ?>
                <button class="filter-btn" data-team-filter="<?php echo htmlspecialchars(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $dept))); ?>">
                    <?php echo htmlspecialchars($dept); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Team Grid -->
        <div class="team-grid">
            <?php foreach ($all_members as $idx => $m): 
                $dept_slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $m['department'] ?? 'general'));
                $avatar_src = !empty($m['image_url']) ? asset_url($m['image_url']) : asset_url('assets/images/placeholder.svg');
            ?>
                <div class="team-profile-card" 
                     data-department="<?php echo htmlspecialchars($dept_slug); ?>"
                     data-reveal data-reveal-delay="<?php echo ($idx % 3) * 120; ?>">
                    
                    <div class="team-card-banner">
                        <div class="team-card-avatar">
                            <img src="<?php echo htmlspecialchars($avatar_src); ?>" 
                                 alt="<?php echo htmlspecialchars($m['name']); ?>" 
                                 loading="lazy">
                        </div>
                        <?php if (!empty($m['department'])): ?>
                            <span class="team-card-department-pill">
                                <?php echo htmlspecialchars($m['department']); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="team-card-body">
                        <h3 class="team-card-name"><?php echo htmlspecialchars($m['name']); ?></h3>
                        <div class="team-card-role"><?php echo htmlspecialchars($m['designation']); ?></div>

                        <?php if (!empty($m['education'])): ?>
                            <div class="team-card-education">
                                <i class="fas fa-graduation-cap"></i>
                                <span><?php echo htmlspecialchars($m['education']); ?></span>
                            </div>
                        <?php endif; ?>

                        <p class="team-card-bio">
                            <?php echo htmlspecialchars($m['bio'] ?? ''); ?>
                        </p>

                        <div class="team-card-contacts">
                            <?php if (!empty($m['email'])): ?>
                                <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>" class="team-card-contact-item">
                                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($m['email']); ?>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($m['phone'])): ?>
                                <a href="tel:<?php echo htmlspecialchars($m['phone']); ?>" class="team-card-contact-item">
                                    <i class="fas fa-phone-alt"></i> <?php echo htmlspecialchars($m['phone']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="no-team-found" style="display: none; text-align: center; padding: 60px 20px; background: #ffffff; border-radius: 16px; border: 1px dashed #cbd5e1; margin-top: 30px;">
            <i class="fas fa-user-slash" style="font-size: 2.5rem; color: #94a3b8; margin-bottom: 14px;"></i>
            <h3 style="color: #0f172a; margin-bottom: 8px;">No team members found in this department.</h3>
            <p style="color: #64748b; margin-bottom: 20px;">Please select "All Members" to view our complete engineering directory.</p>
            <button class="btn btn-primary" onclick="document.querySelector('[data-team-filter=\'all\']').click();">Show All Members</button>
        </div>
    </div>
</section>

<!-- =========================================================
     JOIN OUR TEAM / CAREERS CALLOUT
========================================================= -->
<section style="background: #ffffff; padding: 80px 0; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="background: var(--bg-light-alt); border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 48px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 30px;" data-reveal>
            <div style="max-width: 680px;">
                <span class="section-tag"><i class="fas fa-briefcase"></i> Careers at Fescon</span>
                <h3 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin-bottom: 10px;">
                    Want to Build National-Scale Infrastructure with Us?
                </h3>
                <p style="font-size: 1rem; color: #475569; margin: 0; line-height: 1.6;">
                    We are always seeking passionate electrical engineers, civil designers, project estimators, and HSE professionals to deliver excellence across Pakistan.
                </p>
            </div>
            <div>
                <a href="<?php echo $base_url; ?>/careers.php" class="btn btn-primary">
                    <i class="fas fa-arrow-right"></i> View Career Openings
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-team-filter]');
    const teamCards = document.querySelectorAll('.team-profile-card');
    const noTeamMsg = document.getElementById('no-team-found');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const selectedFilter = this.getAttribute('data-team-filter');
            let visibleCount = 0;

            teamCards.forEach(card => {
                const cardDept = card.getAttribute('data-department');
                if (selectedFilter === 'all' || cardDept === selectedFilter) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noTeamMsg) {
                noTeamMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
});
</script>

<?php
require_once __DIR__ . '/includes/modern-footer.php';
?>