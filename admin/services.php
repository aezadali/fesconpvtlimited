<?php
/**
 * Manage Services - Fescon Admin
 */
$admin_page_title = 'Manage Engineering Services';
$active_tab = 'services';
require_once __DIR__ . '/includes/header.php';

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Service discipline deleted successfully.');
        header("Location: " . $base_url . "/admin/services.php");
        exit;
    }
}

$services = get_all_services(false);
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Engineering Services (<?php echo count($services); ?>)</h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">These represent the core business disciplines on the homepage and services page. Each service automatically aggregates all related projects.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/service-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Service
        </a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Icon</th>
                    <th>Service Name</th>
                    <th>Slug</th>
                    <th>Projects Linked</th>
                    <th>Short Description</th>
                    <th style="text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $s): ?>
                        <tr>
                            <td>
                                <div style="width: 44px; height: 44px; border-radius: 8px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                                    <i class="<?php echo htmlspecialchars($s['icon_class'] ?: 'fas fa-cogs'); ?>"></i>
                                </div>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($s['name']); ?></strong>
                            </td>
                            <td>
                                <code><?php echo htmlspecialchars($s['slug']); ?></code>
                            </td>
                            <td>
                                <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($s['slug']); ?>" target="_blank" style="font-weight: 600; color: var(--admin-primary); text-decoration: none;">
                                    <i class="fas fa-folder-open"></i> <?php echo $s['project_count']; ?> Projects
                                </a>
                            </td>
                            <td>
                                <div style="font-size: 13px; color: #64748b; max-width: 320px;">
                                    <?php echo htmlspecialchars(substr($s['short_description'], 0, 95) . (strlen($s['short_description']) > 95 ? '...' : '')); ?>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 6px;">
                                    <a href="<?php echo $base_url; ?>/service-detail.php?service=<?php echo urlencode($s['slug']); ?>" target="_blank" class="btn-admin btn-admin-secondary btn-admin-sm" title="View Public Page">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo $base_url; ?>/admin/service-form.php?id=<?php echo $s['id']; ?>" class="btn-admin btn-admin-secondary btn-admin-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn-admin btn-admin-danger btn-admin-sm" title="Delete" onclick="if(confirmDelete('Delete this service? Associated projects will be unlinked.')) { document.getElementById('del-srv-<?php echo $s['id']; ?>').submit(); }">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #64748b; padding: 40px;">No services registered yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Hidden Delete Forms -->
<?php foreach ($services as $s): ?>
    <form id="del-srv-<?php echo $s['id']; ?>" method="POST" action="" style="display:none;">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
    </form>
<?php endforeach; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
