<?php
/**
 * Main Admin Dashboard - Fescon (Pvt.) Ltd
 */
$admin_page_title = 'Dashboard Overview';
$active_tab = 'dashboard';
require_once __DIR__ . '/includes/header.php';

$db = get_db();

// Metrics
$total_projects = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$completed_projects = $db->query("SELECT COUNT(*) FROM projects WHERE status = 'Completed'")->fetchColumn();
$total_services = $db->query("SELECT COUNT(*) FROM services")->fetchColumn();
$total_clients = $db->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$total_inquiries = $db->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
$total_team = $db->query("SELECT COUNT(*) FROM team_members")->fetchColumn();

// Recent Projects
$recent_projects = get_projects(['limit' => 5]);

// Recent Inquiries
$recent_inquiries = $db->query("SELECT * FROM inquiries ORDER BY id DESC LIMIT 5")->fetchAll();
?>

<!-- KPI Counters -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-info">
            <h4>Total Projects</h4>
            <div class="kpi-number"><?php echo $total_projects; ?></div>
            <div style="font-size: 12px; color: #16a34a; margin-top: 4px; font-weight: 600;">
                <i class="fas fa-check-circle"></i> <?php echo $completed_projects; ?> Completed
            </div>
        </div>
        <div class="kpi-icon red">
            <i class="fas fa-project-diagram"></i>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-info">
            <h4>Active Services</h4>
            <div class="kpi-number"><?php echo $total_services; ?></div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                Core Disciplines
            </div>
        </div>
        <div class="kpi-icon blue">
            <i class="fas fa-cogs"></i>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-info">
            <h4>Partner Clients</h4>
            <div class="kpi-number"><?php echo $total_clients; ?></div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                Slider Logos
            </div>
        </div>
        <div class="kpi-icon green">
            <i class="fas fa-handshake"></i>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-info">
            <h4>Team &amp; Staff</h4>
            <div class="kpi-number"><?php echo $total_team; ?></div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                Active Employees
            </div>
        </div>
        <div class="kpi-icon red">
            <i class="fas fa-users"></i>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-info">
            <h4>Inquiries Received</h4>
            <div class="kpi-number"><?php echo $total_inquiries; ?></div>
            <div style="font-size: 12px; color: <?php echo $unread_count > 0 ? '#dc2626' : '#64748b'; ?>; margin-top: 4px; font-weight: 600;">
                <?php echo $unread_count; ?> Unread Messages
            </div>
        </div>
        <div class="kpi-icon amber">
            <i class="fas fa-envelope-open-text"></i>
        </div>
    </div>
</div>

<!-- Quick Actions Banner -->
<div class="admin-card" style="background: linear-gradient(135deg, #111111 0%, #1e1e24 100%); color: #ffffff;">
    <div class="admin-card-body" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px;">
        <div>
            <h3 style="font-size: 19px; font-weight: 700; color: #fff; margin-bottom: 6px;">Manage Portfolio &amp; Website Content</h3>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Add new projects, update service engineering scope, customize partner logos, or manage company staff.</p>
        </div>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            <a href="<?php echo $base_url; ?>/admin/project-form.php" class="btn-admin btn-admin-primary">
                <i class="fas fa-plus"></i> Add Project
            </a>
            <a href="<?php echo $base_url; ?>/admin/team-form.php" class="btn-admin btn-admin-secondary">
                <i class="fas fa-user-plus"></i> Add Team Member
            </a>
            <a href="<?php echo $base_url; ?>/admin/client-form.php" class="btn-admin btn-admin-secondary">
                <i class="fas fa-plus"></i> Add Partner Logo
            </a>
            <a href="<?php echo $base_url; ?>/admin/service-form.php" class="btn-admin btn-admin-secondary">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
    </div>
</div>

<!-- Dual Columns: Recent Projects & Recent Inquiries -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(460px, 1fr)); gap: 30px;">
    
    <!-- Recent Projects Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title"><i class="fas fa-project-diagram" style="color: var(--admin-primary); margin-right: 8px;"></i> Recent Projects</h3>
            <a href="<?php echo $base_url; ?>/admin/projects.php" class="btn-admin btn-admin-secondary btn-admin-sm">View All (<?php echo $total_projects; ?>)</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Service</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_projects)): ?>
                        <?php foreach ($recent_projects as $p): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="<?php echo htmlspecialchars($p['image_url']); ?>" alt="" class="table-thumbnail">
                                        <div>
                                            <strong><?php echo htmlspecialchars($p['title']); ?></strong>
                                            <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($p['location'] ?: 'Pakistan'); ?> &bull; <?php echo htmlspecialchars($p['completion_year'] ?: ''); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size: 12.5px;"><?php echo htmlspecialchars($p['service_name'] ?: 'N/A'); ?></span></td>
                                <td>
                                    <?php if (!empty($p['client_name'])): ?>
                                        <span style="font-size: 12.5px; font-weight: 600; color: #334155;"><?php echo htmlspecialchars($p['client_name']); ?></span>
                                    <?php else: ?>
                                        <span style="color: #94a3b8;">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge-status-pill <?php echo strtolower($p['status']) === 'completed' ? 'completed' : 'ongoing'; ?>">
                                        <?php echo htmlspecialchars($p['status'] ?: 'Completed'); ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?php echo $base_url; ?>/admin/project-form.php?id=<?php echo $p['id']; ?>" class="btn-admin btn-admin-secondary btn-admin-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #94a3b8; padding: 30px;">No projects registered yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title"><i class="fas fa-envelope-open-text" style="color: #0284c7; margin-right: 8px;"></i> Recent Inquiries</h3>
            <a href="<?php echo $base_url; ?>/admin/inquiries.php" class="btn-admin btn-admin-secondary btn-admin-sm">View All (<?php echo $total_inquiries; ?>)</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject / Preview</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_inquiries)): ?>
                        <?php foreach ($recent_inquiries as $inq): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($inq['name'] ?: 'Anonymous'); ?></strong>
                                    <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($inq['email'] ?: $inq['phone']); ?></div>
                                </td>
                                <td>
                                    <div style="font-weight: 500; font-size: 13px; color: #1e293b;"><?php echo htmlspecialchars($inq['subject'] ?: 'Quick Inquiry'); ?></div>
                                    <div style="font-size: 12px; color: #64748b; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo htmlspecialchars($inq['message']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-status-pill <?php echo $inq['type'] === 'contact' ? 'completed' : 'ongoing'; ?>" style="font-size: 10px;">
                                        <?php echo htmlspecialchars(strtoupper($inq['type'])); ?>
                                    </span>
                                </td>
                                <td style="font-size: 12px; color: #64748b; white-space: nowrap;">
                                    <?php echo date('M d, H:i', strtotime($inq['created_at'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #94a3b8; padding: 30px;">No inquiries received yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
