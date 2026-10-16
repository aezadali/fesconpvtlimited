<?php
/**
 * Manage Awards & Appreciation Certificates - Fescon Admin
 * Full CRUD: List, Reorder, Delete, Status Toggle
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM awards WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Award credential removed successfully.');
        header("Location: " . $base_url . "/admin/awards.php");
        exit;
    }
}

// Handle Status Toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_status') {
    verify_csrf();
    $toggle_id = intval($_POST['id'] ?? 0);
    if ($toggle_id > 0) {
        $stmt = $db->prepare("UPDATE awards SET is_active = CASE WHEN is_active = 1 THEN 0 ELSE 1 END WHERE id = ?");
        $stmt->execute([$toggle_id]);
        set_flash_message('success', 'Award visibility toggled.');
        header("Location: " . $base_url . "/admin/awards.php");
        exit;
    }
}

// Handle Reorder
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder') {
    verify_csrf();
    if (!empty($_POST['sort_orders']) && is_array($_POST['sort_orders'])) {
        $stmt = $db->prepare("UPDATE awards SET sort_order = ? WHERE id = ?");
        foreach ($_POST['sort_orders'] as $aid => $ord) {
            $stmt->execute([intval($ord), intval($aid)]);
        }
        set_flash_message('success', 'Certificates display order updated successfully.');
        header("Location: " . $base_url . "/admin/awards.php");
        exit;
    }
}

$admin_page_title = 'Awards & Certificates Management';
$active_tab = 'awards';
require_once __DIR__ . '/includes/header.php';

$awards = get_all_awards(false);
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Awards &amp; Certificates (<?php echo count($awards); ?>)</h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">Manage statutory licensing, ISO accreditations, utility enlistments, and appreciation letters shown on the Awards page.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/award-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Award / Certificate
        </a>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="reorder">

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Order</th>
                        <th style="width: 110px;">Preview</th>
                        <th>Award / Certificate Title</th>
                        <th>Category</th>
                        <th>Issuing Body</th>
                        <th style="width: 90px; text-align: center;">Year/Status</th>
                        <th style="width: 90px; text-align: center;">Status</th>
                        <th style="text-align: right; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($awards)): ?>
                        <?php foreach ($awards as $a): ?>
                            <tr>
                                <td>
                                    <input type="number" name="sort_orders[<?php echo $a['id']; ?>]" value="<?php echo $a['sort_order']; ?>" class="form-control" style="width: 60px; padding: 4px 8px; font-size: 13px;">
                                </td>
                                <td>
                                    <div style="width: 80px; height: 60px; border-radius: 6px; overflow: hidden; background: #ffffff; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; padding: 4px;">
                                        <img src="<?php echo asset_url($a['image_url'] ?: 'assets/images/placeholder.svg'); ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-size: 14px;"><?php echo htmlspecialchars($a['title']); ?></strong>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 3px; max-width: 380px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo htmlspecialchars($a['description'] ?? ''); ?>
                                    </div>
                                </td>
                                <td>
                                    <span style="background: rgba(198,40,40,0.12); color: #c62828; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        <?php echo htmlspecialchars($a['category']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; color: #475569;">
                                        <i class="fas fa-university text-red" style="margin-right: 4px;"></i> <?php echo htmlspecialchars($a['issuer'] ?: 'Official Authority'); ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="background: #f1f5f9; color: #0f172a; font-weight: 600; padding: 3px 8px; border-radius: 6px; font-size: 12px;">
                                        <?php echo htmlspecialchars($a['year'] ?: 'Active'); ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ($a['is_active']): ?>
                                        <span class="badge" style="background: #16a34a;">Active</span>
                                    <?php else: ?>
                                        <span class="badge" style="background: #94a3b8;">Hidden</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="<?php echo $base_url; ?>/admin/award-form.php?id=<?php echo $a['id']; ?>" class="btn-admin btn-admin-secondary" style="padding: 5px 10px; font-size: 12px;" title="Edit Certificate">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-admin btn-admin-danger" style="padding: 5px 10px; font-size: 12px;" onclick="deleteAward(<?php echo $a['id']; ?>, '<?php echo htmlspecialchars(addslashes($a['title']), ENT_QUOTES); ?>')" title="Delete Certificate">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class="fas fa-trophy" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                No awards or certificates added yet. Click <strong>Add New Award / Certificate</strong> to upload one.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($awards)): ?>
            <div style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                <button type="submit" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-sort-numeric-down"></i> Save Display Order
                </button>
                <a href="<?php echo $base_url; ?>/awards/" target="_blank" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-external-link-alt"></i> View Public Awards Page
                </a>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Delete Form Modal / Form -->
<form id="deleteForm" method="POST" action="" style="display: none;">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id" id="deleteId" value="">
</form>

<script>
window.deleteAward = function(id, title) {
    if (confirm('Are you sure you want to delete "' + title + '"? This action cannot be undone.')) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteForm').submit();
    }
};
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
