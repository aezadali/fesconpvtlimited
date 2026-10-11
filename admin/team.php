<?php
/**
 * Manage Team & Employees - Fescon Admin
 */
$admin_page_title = 'Manage Team & Employees';
$active_tab = 'team';
require_once __DIR__ . '/includes/header.php';

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM team_members WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Employee removed from team roster.');
        header("Location: " . $base_url . "/admin/team.php");
        exit;
    }
}

// Handle Sort Order update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder') {
    verify_csrf();
    if (!empty($_POST['sort_orders']) && is_array($_POST['sort_orders'])) {
        $stmt = $db->prepare("UPDATE team_members SET sort_order = ? WHERE id = ?");
        foreach ($_POST['sort_orders'] as $mid => $ord) {
            $stmt->execute([intval($ord), intval($mid)]);
        }
        set_flash_message('success', 'Team display hierarchy updated successfully.');
        header("Location: " . $base_url . "/admin/team.php");
        exit;
    }
}

// Filters
$dept_filter = trim($_GET['dept'] ?? '');
$search_query = trim($_GET['q'] ?? '');

$sql = "SELECT * FROM team_members WHERE 1=1 ";
$params = [];

if (!empty($dept_filter)) {
    $sql .= "AND department = ? ";
    $params[] = $dept_filter;
}
if (!empty($search_query)) {
    $sql .= "AND (name LIKE ? OR designation LIKE ? OR email LIKE ? OR bio LIKE ?) ";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
}

$sql .= "ORDER BY sort_order ASC, id ASC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$team = $stmt->fetchAll();

$departments = get_team_departments();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Company Team &amp; Employee Roster (<?php echo count($team); ?>)</h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">Manage leadership, engineers, project managers, and operational staff displayed on the website.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/team-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-user-plus"></i> Add New Employee
        </a>
    </div>

    <!-- Filter Bar -->
    <div style="padding: 16px 24px; background: #fafafa; border-bottom: 1px solid var(--admin-border);">
        <form method="GET" action="" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <input type="text" name="q" class="form-control" placeholder="Search by name, designation..." value="<?php echo htmlspecialchars($search_query); ?>" style="max-width: 250px; padding: 8px 12px; font-size: 13px;">

            <select name="dept" class="form-control" style="max-width: 220px; padding: 8px 12px; font-size: 13px;">
                <option value="">All Departments</option>
                <?php foreach ($departments as $d): ?>
                    <option value="<?php echo htmlspecialchars($d); ?>" <?php echo $dept_filter === $d ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($d); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-admin btn-admin-secondary" style="padding: 8px 16px;">
                <i class="fas fa-filter"></i> Filter
            </button>
            <?php if (!empty($search_query) || !empty($dept_filter)): ?>
                <a href="<?php echo $base_url; ?>/admin/team.php" class="btn-admin btn-admin-secondary" style="padding: 8px 14px;" title="Reset Filters">
                    <i class="fas fa-times"></i> Clear
                </a>
            <?php endif; ?>
        </form>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="reorder">

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Order</th>
                        <th style="width: 70px;">Photo</th>
                        <th>Name &amp; Designation</th>
                        <th>Department</th>
                        <th>Contact Info</th>
                        <th>Qualifications</th>
                        <th>Status</th>
                        <th style="text-align: right; width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($team)): ?>
                        <?php foreach ($team as $m): ?>
                            <tr>
                                <td>
                                    <input type="number" name="sort_orders[<?php echo $m['id']; ?>]" value="<?php echo $m['sort_order']; ?>" class="form-control" style="width: 60px; padding: 4px 6px; font-size: 13px;">
                                </td>
                                <td>
                                    <?php if (!empty($m['image_url'])): ?>
                                        <img src="<?php echo htmlspecialchars($m['image_url']); ?>" onerror="this.onerror=null; this.src='<?php echo $base_url; ?>/assets/images/placeholder.svg';" alt="" style="width: 46px; height: 46px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;">
                                    <?php else: ?>
                                        <div style="width: 46px; height: 46px; border-radius: 50%; background: #e2e8f0; color: #475569; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px;">
                                            <?php echo strtoupper(substr($m['name'], 0, 1)); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong style="font-size: 14.5px; color: #111;"><?php echo htmlspecialchars($m['name']); ?></strong>
                                    <div style="font-size: 12.5px; color: var(--admin-primary); font-weight: 600;">
                                        <?php echo htmlspecialchars($m['designation']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; background: #f1f5f9; color: #334155; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        <?php echo htmlspecialchars($m['department'] ?: 'General'); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($m['email'])): ?>
                                        <div style="font-size: 12.5px;"><i class="fas fa-envelope" style="font-size: 11px; color:#64748b;"></i> <?php echo htmlspecialchars($m['email']); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($m['phone'])): ?>
                                        <div style="font-size: 12.5px; color:#64748b;"><i class="fas fa-phone" style="font-size: 11px;"></i> <?php echo htmlspecialchars($m['phone']); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="font-size: 12px; color: #475569; max-width: 220px;">
                                        <?php echo htmlspecialchars($m['education'] ?: '-'); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-status-pill <?php echo $m['is_active'] ? 'completed' : 'ongoing'; ?>">
                                        <?php echo $m['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="<?php echo $base_url; ?>/admin/team-form.php?id=<?php echo $m['id']; ?>" class="btn-admin btn-admin-secondary btn-admin-sm" title="Edit Employee">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-admin btn-admin-danger btn-admin-sm" title="Delete" onclick="if(confirmDelete('Remove this employee from the team roster?')) { document.getElementById('del-team-<?php echo $m['id']; ?>').submit(); }">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: #64748b; padding: 40px;">
                                No team members found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($team)): ?>
            <div style="padding: 16px 24px; background: #fafafa; border-top: 1px solid var(--admin-border); display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-sort-numeric-down"></i> Save Display Hierarchy
                </button>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Hidden Delete Forms -->
<?php foreach ($team as $m): ?>
    <form id="del-team-<?php echo $m['id']; ?>" method="POST" action="" style="display:none;">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
    </form>
<?php endforeach; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
