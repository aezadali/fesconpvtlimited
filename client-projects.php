<?php
/**
 * Client Projects Showcase - Fescon (Pvt.) Ltd
 * Displays projects accomplished for specific clients/partners clicked from Logo Slider
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$client_slug = trim($_GET['client'] ?? '');
$client = null;
if (!empty($client_slug)) {
    $client = get_client_by_slug($client_slug);
}

$all_clients = get_all_clients();

if ($client) {
    $page_title = htmlspecialchars($client['name']) . " - Projects & Collaborations | Fescon (Pvt.) Ltd";
    $projects = get_projects(['client_id' => $client['id']]);
} else {
    $page_title = "Our Partner Clients & Executed Projects | Fescon (Pvt.) Ltd";
    $projects = get_projects();
}

$current_page = 'projects';
require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Client Projects Page Styles */
.client-hero-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    color: #0f172a;
    padding: 135px 20px 55px;
    position: relative;
    border-bottom: 1px solid var(--border-light);
}

.client-hero-container {
    max-width: 1240px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 35px;
}

.client-logo-box {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 200px;
    max-width: 240px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
}

.client-logo-box img {
    max-width: 100%;
    max-height: 110px;
    object-fit: contain;
}

.client-hero-content {
    flex: 1;
    min-width: 300px;
}

.client-badge-tag {
    display: inline-block;
    background: rgba(211, 47, 47, 0.12);
    color: #c62828;
    border: 1px solid rgba(211, 47, 47, 0.3);
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.client-hero-title {
    font-family: var(--font-heading, 'Cardo', serif);
    font-size: clamp(2rem, 3.2vw, 2.8rem);
    color: #0f172a;
    margin: 0 0 14px;
    line-height: 1.2;
}

.client-hero-desc {
    font-family: var(--font-sans, 'Inter', sans-serif);
    font-size: 15.5px;
    color: #475569;
    line-height: 1.65;
    max-width: 780px;
    margin-bottom: 20px;
}

.client-meta-strip {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    font-size: 14px;
}

.client-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #475569;
}

.client-meta-item i {
    color: var(--brand-red, #c62828);
}

.client-meta-item a {
    color: #0f172a;
    text-decoration: underline;
}

.client-meta-item a:hover {
    color: var(--brand-red, #c62828);
}

/* Partner Selection Tabs / Filter Strip */
.partners-filter-section {
    background: #ffffff;
    border-bottom: 1px solid #e5e5e5;
    padding: 18px 20px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}

.partners-filter-container {
    max-width: 1240px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 12px;
    overflow-x: auto;
    padding-bottom: 4px;
}

.filter-label {
    font-size: 13.5px;
    font-weight: 700;
    color: #222;
    white-space: nowrap;
    margin-right: 6px;
}

.partner-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 16px;
    border-radius: 20px;
    background: #f1f1f1;
    color: #333333;
    font-size: 13.5px;
    font-weight: 500;
    white-space: nowrap;
    transition: all 0.2s ease;
    text-decoration: none;
    border: 1px solid transparent;
}

.partner-pill:hover {
    background: var(--brand-red-light, #fef2f2);
    color: var(--brand-red, #d32f2f);
    border-color: rgba(211, 47, 47, 0.2);
}

.partner-pill.active {
    background: var(--brand-red, #d32f2f);
    color: #ffffff;
    font-weight: 600;
}

/* Projects Grid Section */
.projects-showcase-section {
    padding: 60px 20px 90px;
    max-width: 1240px;
    margin: 0 auto;
}

.section-intro-head {
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    flex-wrap: wrap;
    gap: 15px;
}

.section-intro-head h2 {
    font-family: var(--font-heading, 'Cardo', serif);
    font-size: 2.2rem;
    color: #111111;
    margin: 0 0 6px;
}

.section-intro-head p {
    color: #666666;
    margin: 0;
    font-size: 15px;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.project-card {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    border: 1px solid #eaeaea;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
}

.project-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(0,0,0,0.12);
    border-color: rgba(211, 47, 47, 0.3);
}

.project-card-image {
    position: relative;
    height: 230px;
    overflow: hidden;
    background: #e2e8f0;
}

.project-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-card-image img {
    transform: scale(1.06);
}

.project-status-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    background: #0f172a;
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.project-status-badge.completed {
    background: #16a34a;
}

.project-service-badge {
    position: absolute;
    bottom: 14px;
    left: 14px;
    background: rgba(15, 23, 42, 0.88);
    backdrop-filter: blur(4px);
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.project-card-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.project-card-title {
    font-family: var(--font-sans, 'Inter', sans-serif);
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 10px;
    line-height: 1.35;
}

.project-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.project-card-title a:hover {
    color: var(--brand-red, #d32f2f);
}

.project-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    font-size: 13px;
    color: #64748b;
    margin-bottom: 14px;
}

.project-card-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.project-card-summary {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin: 0 0 20px;
    flex: 1;
}

.project-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid #f0f0f0;
}

.client-mini-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    color: #64748b;
    font-weight: 500;
}

.client-mini-badge img {
    height: 22px;
    max-width: 65px;
    object-fit: contain;
}

.btn-view-project {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    background: var(--brand-red, #c62828);
    color: #ffffff !important;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-view-project:hover {
    background: var(--brand-red-dark, #b71c1c);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
}

/* Empty State */
.empty-projects-state {
    text-align: center;
    padding: 70px 20px;
    background: #fcfcfc;
    border-radius: 8px;
    border: 2px dashed #e0e0e0;
}

.empty-projects-state i {
    font-size: 45px;
    color: #ccc;
    margin-bottom: 16px;
}

.empty-projects-state h3 {
    font-size: 20px;
    color: #333;
    margin-bottom: 8px;
}

.empty-projects-state p {
    color: #777;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .client-hero-container {
        flex-direction: column;
        text-align: center;
    }
    .client-logo-box {
        margin: 0 auto;
    }
    .client-meta-strip {
        justify-content: center;
    }
    .projects-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Hero Section -->
<div class="client-hero-section">
    <div class="client-hero-container">
        <?php if ($client): ?>
            <div class="client-logo-box">
                <img src="<?php echo asset_url($client['logo_url']); ?>" alt="<?php echo htmlspecialchars($client['name']); ?>">
            </div>
            <div class="client-hero-content">
                <span class="client-badge-tag"><i class="fas fa-handshake"></i> Partner &amp; Client</span>
                <h1 class="client-hero-title"><?php echo htmlspecialchars($client['name']); ?></h1>
                <p class="client-hero-desc"><?php echo nl2br(htmlspecialchars($client['description'] ?: "Fescon (Pvt.) Ltd has executed vital electrical, high-voltage transmission, substations, and civil works in partnership with this organization.")); ?></p>
                <div class="client-meta-strip">
                    <div class="client-meta-item">
                        <i class="fas fa-tasks"></i>
                        <span><strong><?php echo count($projects); ?></strong> Projects Executed</span>
                    </div>
                    <?php if (!empty($client['website_url'])): ?>
                    <div class="client-meta-item">
                        <i class="fas fa-external-link-alt"></i>
                        <a href="<?php echo htmlspecialchars($client['website_url']); ?>" target="_blank" rel="noopener noreferrer">Official Website</a>
                    </div>
                    <?php endif; ?>
                    <div class="client-meta-item">
                        <i class="fas fa-certificate"></i>
                        <span>PEC &amp; ISO Compliant Standards</span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="client-hero-content" style="text-align: center; max-width: 900px; margin: 0 auto;">
                <span class="client-badge-tag"><i class="fas fa-briefcase"></i> Engineering Portfolio</span>
                <h1 class="client-hero-title">Partner Collaborations &amp; Projects</h1>
                <p class="client-hero-desc" style="margin: 0 auto 20px;">Explore engineering, transmission, EPC, and MEP projects accomplished by Fescon (Pvt.) Ltd across Pakistan's leading power authorities, utilities, and industrial sectors.</p>
                <div class="client-meta-strip" style="justify-content: center;">
                    <div class="client-meta-item">
                        <i class="fas fa-check-circle"></i>
                        <span><strong><?php echo count($all_clients); ?></strong> Strategic Partners</span>
                    </div>
                    <div class="client-meta-item">
                        <i class="fas fa-project-diagram"></i>
                        <span><strong><?php echo count($projects); ?></strong> Flagship Projects</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Partner Filter Tabs Strip -->
<div class="partners-filter-section">
    <div class="partners-filter-container">
        <span class="filter-label"><i class="fas fa-filter"></i> Partners:</span>
        <a href="<?php echo $base_url; ?>/client-projects.php" class="partner-pill <?php echo empty($client_slug) ? 'active' : ''; ?>">
            All Partners (<?php echo count(get_projects()); ?>)
        </a>
        <?php foreach ($all_clients as $c): ?>
            <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($c['slug']); ?>" 
               class="partner-pill <?php echo ($client && $client['slug'] === $c['slug']) ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($c['name']); ?> (<?php echo $c['project_count']; ?>)
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Projects Grid Section -->
<div class="projects-showcase-section">
    <div class="section-intro-head">
        <div>
            <h2><?php echo $client ? "Projects Completed for " . htmlspecialchars($client['name']) : "All Completed Projects"; ?></h2>
            <p>Showing <?php echo count($projects); ?> project<?php echo count($projects) === 1 ? '' : 's'; ?> delivered with precision engineering.</p>
        </div>
        <div>
            <a href="<?php echo $base_url; ?>/contact-us/" class="elementor-button" style="font-size: 13px; padding: 10px 22px;">
                <i class="fas fa-envelope"></i> Inquire About a Project
            </a>
        </div>
    </div>

    <?php if (!empty($projects)): ?>
        <div class="projects-grid">
            <?php foreach ($projects as $prj): ?>
                <div class="project-card">
                    <div class="project-card-image">
                        <a href="<?php echo $base_url; ?>/project-detail.php?project=<?php echo urlencode($prj['slug']); ?>">
                            <img src="<?php echo asset_url($prj['image_url']); ?>" alt="<?php echo htmlspecialchars($prj['title']); ?>" loading="lazy">
                        </a>
                        <span class="project-status-badge <?php echo strtolower($prj['status']) === 'completed' ? 'completed' : ''; ?>">
                            <?php echo htmlspecialchars($prj['status'] ?: 'Completed'); ?>
                        </span>
                        <?php if (!empty($prj['service_name'])): ?>
                            <span class="project-service-badge">
                                <i class="<?php echo htmlspecialchars($prj['service_icon'] ?: 'fas fa-bolt'); ?>"></i>
                                <?php echo htmlspecialchars($prj['service_name']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="project-card-body">
                        <h3 class="project-card-title">
                            <a href="<?php echo $base_url; ?>/project-detail.php?project=<?php echo urlencode($prj['slug']); ?>">
                                <?php echo htmlspecialchars($prj['title']); ?>
                            </a>
                        </h3>
                        <div class="project-card-meta">
                            <?php if (!empty($prj['location'])): ?>
                                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($prj['location']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($prj['completion_year'])): ?>
                                <span><i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($prj['completion_year']); ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="project-card-summary">
                            <?php echo htmlspecialchars($prj['summary'] ?: substr(strip_tags($prj['description'] ?? ''), 0, 140) . '...'); ?>
                        </p>
                        <div class="project-card-footer">
                            <?php if (!empty($prj['client_logo'])): ?>
                                <div class="client-mini-badge" title="<?php echo htmlspecialchars($prj['client_name'] ?? ''); ?>">
                                    <img src="<?php echo asset_url($prj['client_logo']); ?>" alt="">
                                </div>
                            <?php else: ?>
                                <span></span>
                            <?php endif; ?>
                            <a href="<?php echo $base_url; ?>/project-detail.php?project=<?php echo urlencode($prj['slug']); ?>" class="btn-view-project">
                                Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-projects-state">
            <i class="fas fa-folder-open"></i>
            <h3>No Projects Registered Yet</h3>
            <p>New projects for this partner are currently being cataloged. Check back soon or view all projects.</p>
            <a href="<?php echo $base_url; ?>/client-projects.php" class="elementor-button">View All Projects</a>
        </div>
    <?php endif; ?>
</div>

<!-- Wrapper for directory routing -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
