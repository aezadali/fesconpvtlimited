<?php
/**
 * Manage Picture Gallery & Events - Fescon Admin
 * Full CRUD: List, Reorder, Delete
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    verify_csrf();
    $delete_id = intval($_POST['id'] ?? 0);
    if ($delete_id > 0) {
        $stmt = $db->prepare("DELETE FROM gallery_events WHERE id = ?");
        $stmt->execute([$delete_id]);
        set_flash_message('success', 'Gallery event and associated photos removed successfully.');
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

// Handle Status Toggle (active/inactive)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_status') {
    verify_csrf();
    $toggle_id = intval($_POST['id'] ?? 0);
    if ($toggle_id > 0) {
        $stmt = $db->prepare("UPDATE gallery_events SET is_active = CASE WHEN is_active = 1 THEN 0 ELSE 1 END WHERE id = ?");
        $stmt->execute([$toggle_id]);
        set_flash_message('success', 'Event status updated.');
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

// Handle Reorder
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reorder') {
    verify_csrf();
    if (!empty($_POST['sort_orders']) && is_array($_POST['sort_orders'])) {
        $stmt = $db->prepare("UPDATE gallery_events SET sort_order = ? WHERE id = ?");
        foreach ($_POST['sort_orders'] as $eid => $ord) {
            $stmt->execute([intval($ord), intval($eid)]);
        }
        set_flash_message('success', 'Events display order updated successfully.');
        header("Location: " . $base_url . "/admin/gallery.php");
        exit;
    }
}

$admin_page_title = 'Gallery & Events Management';
$active_tab = 'gallery';
require_once __DIR__ . '/includes/header.php';

$events = get_all_gallery_events(false);
?>

<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h3 class="admin-card-title">Gallery Events &amp; Photo Sets (<?php echo count($events); ?>)</h3>
            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">Manage public events, photo collections, locations, and descriptions displayed on the Gallery &amp; Events page.</p>
        </div>
        <a href="<?php echo $base_url; ?>/admin/gallery-form.php" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Event / Photo Set
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
                        <th style="width: 120px;">Cover</th>
                        <th>Event Title &amp; Details</th>
                        <th>Category</th>
                        <th>Date &amp; Location</th>
                        <th style="width: 90px; text-align: center;">Photos</th>
                        <th style="width: 90px; text-align: center;">Status</th>
                        <th style="text-align: right; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($events)): ?>
                        <?php foreach ($events as $e): 
                            $photos = !empty($e['images']) ? json_decode($e['images'], true) : [];
                            $photo_count = is_array($photos) ? count($photos) : 0;
                            $cover = !empty($e['cover_image']) ? $e['cover_image'] : (!empty($photos[0]) ? $photos[0] : 'assets/images/placeholder.svg');
                        ?>
                            <tr>
                                <td>
                                    <input type="number" name="sort_orders[<?php echo $e['id']; ?>]" value="<?php echo $e['sort_order']; ?>" class="form-control" style="width: 60px; padding: 4px 8px; font-size: 13px;">
                                </td>
                                <td>
                                    <div style="width: 90px; height: 60px; border-radius: 6px; overflow: hidden; background: #f1f5f9; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                        <img src="<?php echo asset_url($cover); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </td>
                                <td>
                                    <strong style="color: #0f172a; font-size: 14px;"><?php echo htmlspecialchars($e['title']); ?></strong>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 3px; max-width: 360px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo htmlspecialchars($e['description'] ?? ''); ?>
                                    </div>
                                </td>
                                <td>
                                    <span style="background: rgba(198,40,40,0.12); color: #c62828; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        <?php echo htmlspecialchars($e['category']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 13px; color: #334155; font-weight: 500;">
                                        <i class="far fa-calendar-alt text-red" style="margin-right: 4px;"></i> <?php echo htmlspecialchars($e['event_date'] ?: 'N/A'); ?>
                                    </div>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                        <i class="fas fa-map-marker-alt" style="margin-right: 4px; color: #94a3b8;"></i> <?php echo htmlspecialchars($e['location'] ?: 'N/A'); ?>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <span style="background: #f1f5f9; color: #0f172a; font-weight: 700; padding: 3px 10px; border-radius: 10px; font-size: 12px;">
                                        <i class="fas fa-images"></i> <?php echo $photo_count; ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ($e['is_active']): ?>
                                        <span class="badge" style="background: #16a34a;">Active</span>
                                    <?php else: ?>
                                        <span class="badge" style="background: #94a3b8;">Hidden</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 6px;">
                                        <a href="<?php echo $base_url; ?>/admin/gallery-form.php?id=<?php echo $e['id']; ?>" class="btn-admin btn-admin-secondary" style="padding: 5px 10px; font-size: 12px;" title="Edit Event">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-admin btn-admin-danger btn-delete-gallery-event" style="padding: 5px 10px; font-size: 12px;" data-id="<?php echo $e['id']; ?>" data-title="<?php echo htmlspecialchars($e['title'], ENT_QUOTES, 'UTF-8'); ?>" onclick="triggerDeleteEvent(<?php echo $e['id']; ?>, '<?php echo htmlspecialchars(addslashes($e['title']), ENT_QUOTES); ?>')" title="Delete Event">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class="fas fa-images" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                No gallery events added yet. Click <strong>Add New Event / Photo Set</strong> to create one.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($events)): ?>
            <div style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                <button type="submit" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-sort-numeric-down"></i> Save Display Order
                </button>
                <a href="<?php echo $base_url; ?>/gallery/" target="_blank" class="btn-admin btn-admin-secondary">
                    <i class="fas fa-external-link-alt"></i> View Public Gallery
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
function triggerDeleteEvent(id, title) {
    if (confirm('Are you sure you want to delete "' + (title || 'this event') + '" and all its photos? This action cannot be undone.')) {
        var input = document.getElementById('deleteId');
        var form = document.getElementById('deleteForm');
        if (input && form) {
            input.value = id;
            form.submit();
        }
    }
}
window.deleteGalleryEvent = triggerDeleteEvent;

document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.btn-delete-gallery-event');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var id = this.getAttribute('data-id');
            var title = this.getAttribute('data-title');
            triggerDeleteEvent(id, title);
        });
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
