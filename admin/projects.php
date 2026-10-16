<?php
/**
 * Manage Projects - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Project deleted successfully.');
        header("Location: " . $base_url . "/admin/projects.php");
        exit;
    }
}

$admin_page_title = 'Manage Projects';
$active_tab = 'projects';
require_once __DIR__ . '/includes/header.php';

// Filters
$service_filter = trim($_GET['service'] ?? '');
$client_filter = trim($_GET['client'] ?? '');
$status_filter = trim($_GET['status'] ?? '');
$search_query = trim($_GET['q'] ?? '');

$sql = "SELECT p.*, c.name AS client_name, c.logo_url AS client_logo, s.name AS service_name
        FROM projects p
        LEFT JOIN clients c ON p.client_id = c.id
        LEFT JOIN services s ON p.service_id = s.id
        WHERE 1=1 ";
$params = [];

if (!empty($service_filter)) {
    $sql .= "AND p.service_id = ? ";
    $params[] = $service_filter;
}
if (!empty($client_filter)) {
    $sql .= "AND p.client_id = ? ";
    $params[] = $client_filter;
}
if (!empty($status_filter)) {
    $sql .= "AND p.status = ? ";
    $params[] = $status_filter;
}
if (!empty($search_query)) {
    $sql .= "AND (p.title LIKE ? OR p.location LIKE ? OR p.summary LIKE ?) ";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
}

$sql .= "ORDER BY p.id DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();

$all_services = get_all_services();
$all_clients = get_all_clients();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">All Registered Projects (<?php echo count($projects); ?>)</h3>
        <a href="<?php echo $base_url; ?>/admin/project-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Project
        </a>
    </div>

    <!-- Filter Bar -->
    <div style="padding: 16px 24px; background: #fafafa; border-bottom: 1px solid var(--admin-border);">
        <form method="GET" action="" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <input type="text" name="q" class="form-control" placeholder="Search by title, location..." value="<?php echo htmlspecialchars($search_query); ?>" style="max-width: 240px; padding: 8px 12px; font-size: 13px;">

            <select name="service" class="form-control" style="max-width: 220px; padding: 8px 12px; font-size: 13px;">
                <option value="">All Services</option>
                <?php foreach ($all_services as $s): ?>
                    <option value="<?php echo $s['id']; ?>" <?php echo $service_filter == $s['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($s['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="client" class="form-control" style="max-width: 220px; padding: 8px 12px; font-size: 13px;">
                <option value="">All Partner Clients</option>
                <?php foreach ($all_clients as $c): ?>
                    <option value="<?php echo $c['id']; ?>" <?php echo $client_filter == $c['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($c['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="status" class="form-control" style="max-width: 150px; padding: 8px 12px; font-size: 13px;">
                <option value="">All Statuses</option>
                <option value="Completed" <?php echo $status_filter === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="Ongoing" <?php echo $status_filter === 'Ongoing' ? 'selected' : ''; ?>>Ongoing</option>
            </select>

            <button type="submit" class="btn-admin btn-admin-secondary" style="padding: 8px 16px;">
                <i class="fas fa-filter"></i> Filter
            </button>
            <?php if (!empty($search_query) || !empty($service_filter) || !empty($client_filter) || !empty($status_filter)): ?>
                <a href="<?php echo $base_url; ?>/admin/projects.php" class="btn-admin btn-admin-secondary" style="padding: 8px 14px;" title="Reset Filters">
                    <i class="fas fa-times"></i> Clear
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Table -->
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Image</th>
                    <th>Project Title</th>
                    <th>Service Category</th>
                    <th>Client / Partner</th>
                    <th>Year / Location</th>
                    <th>Status</th>
                    <th style="text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $p): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($p['image_url']); ?>" alt="" class="table-thumbnail">
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($p['title']); ?></strong>
                                <?php if ($p['featured']): ?>
                                    <span style="background: #fef08a; color: #854d0e; font-size: 10.5px; padding: 2px 6px; border-radius: 4px; font-weight: 700; margin-left: 6px;">Featured</span>
                                <?php endif; ?>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                    Slug: <code><?php echo htmlspecialchars($p['slug']); ?></code>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 13px; font-weight: 500;"><?php echo htmlspecialchars($p['service_name'] ?: 'None'); ?></span>
                            </td>
                            <td>
                                <?php if (!empty($p['client_name'])): ?>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <?php if (!empty($p['client_logo'])): ?>
                                            <img src="<?php echo htmlspecialchars($p['client_logo']); ?>" alt="" style="height: 18px; max-width: 50px; object-fit: contain;">
                                        <?php endif; ?>
                                        <span style="font-size: 12.5px; font-weight: 600;"><?php echo htmlspecialchars($p['client_name']); ?></span>
                                    </div>
                                <?php else: ?>
                                    <span style="color: #94a3b8;">None</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="font-size: 13px; font-weight: 500;"><?php echo htmlspecialchars($p['completion_year'] ?: '-'); ?></div>
                                <div style="font-size: 12px; color: #64748b;"><?php echo htmlspecialchars($p['location'] ?: 'Pakistan'); ?></div>
                            </td>
                            <td>
                                <span class="badge-status-pill <?php echo strtolower($p['status']) === 'completed' ? 'completed' : 'ongoing'; ?>">
                                    <?php echo htmlspecialchars($p['status'] ?: 'Completed'); ?>
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 6px;">
                                    <a href="<?php echo $base_url; ?>/project-detail.php?id=<?php echo $p['id']; ?>" target="_blank" class="btn-admin btn-admin-secondary btn-admin-sm" title="View on Site">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo $base_url; ?>/admin/project-form.php?id=<?php echo $p['id']; ?>" class="btn-admin btn-admin-secondary btn-admin-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="" onsubmit="return confirmDelete('Are you sure you want to delete this project?');" style="display:inline;">
                                        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                        <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #64748b; padding: 40px;">
                            No projects match the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
