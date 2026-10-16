<?php
/**
 * Manage Partner Clients & Logo Slider - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Client partner removed successfully.');
        header("Location: " . $base_url . "/admin/clients.php");
        exit;
    }
}

// Handle Sort Order update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder') {
    verify_csrf();
    if (!empty($_POST['sort_orders']) && is_array($_POST['sort_orders'])) {
        $stmt = $db->prepare("UPDATE clients SET sort_order = ? WHERE id = ?");
        foreach ($_POST['sort_orders'] as $cid => $ord) {
            $stmt->execute([intval($ord), intval($cid)]);
        }
        set_flash_message('success', 'Logo slider order updated successfully.');
        header("Location: " . $base_url . "/admin/clients.php");
        exit;
    }
}

$admin_page_title = 'Partner Clients & Logo Slider';
$active_tab = 'clients';
require_once __DIR__ . '/includes/header.php';

$clients = get_all_clients(false);
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Partner Organizations &amp; Slider Logos (<?php echo count($clients); ?>)</h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">These logos appear in the homepage infinite marquee slider and collaborations page. Clicking each logo opens their executed projects.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/client-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Partner Logo
        </a>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="reorder">

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 140px;">Logo Preview</th>
                        <th>Organization Name</th>
                        <th>Projects Associated</th>
                        <th>Website</th>
                        <th style="text-align: right; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clients)): ?>
                        <?php foreach ($clients as $c): ?>
                            <tr>
                                <td>
                                    <input type="number" name="sort_orders[<?php echo $c['id']; ?>]" value="<?php echo $c['sort_order']; ?>" class="form-control" style="width: 65px; padding: 5px 8px; font-size: 13px;">
                                </td>
                                <td>
                                    <div style="background: #f8fafc; padding: 6px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                                        <img src="<?php echo htmlspecialchars($c['logo_url']); ?>" alt="" class="table-logo">
                                    </div>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                                    <div style="font-size: 12px; color: #64748b;">
                                        Slug: <code><?php echo htmlspecialchars($c['slug']); ?></code>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($c['slug']); ?>" target="_blank" style="font-size: 13px; font-weight: 600; color: var(--admin-primary); text-decoration: none;">
                                        <i class="fas fa-folder"></i> <?php echo $c['project_count']; ?> Projects
                                    </a>
                                </td>
                                <td>
                                    <?php if (!empty($c['website_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($c['website_url']); ?>" target="_blank" style="color: #64748b; font-size: 13px;">
                                            <i class="fas fa-external-link-alt"></i> Visit Link
                                        </a>
                                    <?php else: ?>
                                        <span style="color: #cbd5e1;">-</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($c['slug']); ?>" target="_blank" class="btn-admin btn-admin-secondary btn-admin-sm" title="View Public Page">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo $base_url; ?>/admin/client-form.php?id=<?php echo $c['id']; ?>" class="btn-admin btn-admin-secondary btn-admin-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-admin btn-admin-danger btn-admin-sm" title="Delete" onclick="if(confirmDelete('Delete this partner logo? Associated projects will be unlinked.')) { document.getElementById('del-form-<?php echo $c['id']; ?>').submit(); }">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 40px;">
                                No partner logos registered yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($clients)): ?>
            <div style="padding: 16px 24px; background: #fafafa; border-top: 1px solid var(--admin-border); display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-sort-numeric-down"></i> Save Display Order
                </button>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Hidden Delete Forms -->
<?php foreach ($clients as $c): ?>
    <form id="del-form-<?php echo $c['id']; ?>" method="POST" action="" style="display:none;">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
    </form>
<?php endforeach; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
