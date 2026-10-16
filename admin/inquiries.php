<?php
/**
 * Manage Inquiries - Fescon Admin
 */
require_once __DIR__ . '/auth.php';
require_admin_login();

$db = get_db();

// Handle Actions (mark read, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    verify_csrf();
    $inq_id = intval($_POST['id'] ?? 0);
    if ($inq_id > 0) {
        if ($_POST['action'] === 'delete') {
            $stmt = $db->prepare("DELETE FROM inquiries WHERE id = ?");
            $stmt->execute([$inq_id]);
            set_flash_message('success', 'Inquiry deleted.');
        } elseif ($_POST['action'] === 'mark_read') {
            $stmt = $db->prepare("UPDATE inquiries SET is_read = 1 WHERE id = ?");
            $stmt->execute([$inq_id]);
            set_flash_message('success', 'Inquiry marked as read.');
        } elseif ($_POST['action'] === 'mark_unread') {
            $stmt = $db->prepare("UPDATE inquiries SET is_read = 0 WHERE id = ?");
            $stmt->execute([$inq_id]);
            set_flash_message('success', 'Inquiry marked as unread.');
        }
        header("Location: " . $base_url . "/admin/inquiries.php");
        exit;
    }
}

$admin_page_title = 'Inquiries & Contact Submissions';
$active_tab = 'inquiries';
require_once __DIR__ . '/includes/header.php';

$status_filter = trim($_GET['status'] ?? '');
$sql = "SELECT * FROM inquiries WHERE 1=1 ";
$params = [];

if ($status_filter === 'unread') {
    $sql .= "AND is_read = 0 ";
} elseif ($status_filter === 'read') {
    $sql .= "AND is_read = 1 ";
}

$sql .= "ORDER BY id DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$inquiries = $stmt->fetchAll();
?>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Received Website Inquiries (<?php echo count($inquiries); ?>)</h3>
        <div style="display: flex; gap: 8px;">
            <a href="<?php echo $base_url; ?>/admin/inquiries.php" class="btn-admin btn-admin-secondary btn-admin-sm <?php echo empty($status_filter) ? 'active' : ''; ?>">All</a>
            <a href="<?php echo $base_url; ?>/admin/inquiries.php?status=unread" class="btn-admin btn-admin-secondary btn-admin-sm <?php echo $status_filter === 'unread' ? 'active' : ''; ?>">Unread</a>
            <a href="<?php echo $base_url; ?>/admin/inquiries.php?status=read" class="btn-admin btn-admin-secondary btn-admin-sm <?php echo $status_filter === 'read' ? 'active' : ''; ?>">Read</a>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">Status</th>
                    <th>Sender Name</th>
                    <th>Contact Info</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date Received</th>
                    <th style="text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($inquiries)): ?>
                    <?php foreach ($inquiries as $i): ?>
                        <tr style="<?php echo $i['is_read'] ? 'opacity: 0.85;' : 'background: #fff8f8; font-weight: 500;'; ?>">
                            <td>
                                <?php if ($i['is_read']): ?>
                                    <span class="badge-status-pill read">Read</span>
                                <?php else: ?>
                                    <span class="badge-status-pill unread">New</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($i['name'] ?: 'Anonymous'); ?></strong>
                                <div style="font-size: 11.5px; color: #64748b;">Source: <?php echo htmlspecialchars($i['page_source'] ?: $i['type']); ?></div>
                            </td>
                            <td>
                                <?php if (!empty($i['email'])): ?>
                                    <div><i class="fas fa-envelope" style="font-size: 11px; color:#64748b;"></i> <?php echo htmlspecialchars($i['email']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($i['phone'])): ?>
                                    <div><i class="fas fa-phone" style="font-size: 11px; color:#64748b;"></i> <?php echo htmlspecialchars($i['phone']); ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span><?php echo htmlspecialchars($i['subject'] ?: 'Quick Message'); ?></span>
                            </td>
                            <td>
                                <div style="max-width: 300px; line-height: 1.5; font-size: 13.5px; color: #333;">
                                    <?php echo nl2br(htmlspecialchars($i['message'])); ?>
                                </div>
                            </td>
                            <td style="font-size: 12.5px; color: #64748b; white-space: nowrap;">
                                <?php echo date('M d, Y H:i', strtotime($i['created_at'])); ?>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 6px;">
                                    <?php if (!$i['is_read']): ?>
                                        <form method="POST" action="" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                            <input type="hidden" name="action" value="mark_read">
                                            <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
                                            <button type="submit" class="btn-admin btn-admin-secondary btn-admin-sm" title="Mark as Read">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form method="POST" action="" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                            <input type="hidden" name="action" value="mark_unread">
                                            <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
                                            <button type="submit" class="btn-admin btn-admin-secondary btn-admin-sm" title="Mark as Unread">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <form method="POST" action="" onsubmit="return confirmDelete('Delete this inquiry record?');" style="display:inline;">
                                        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
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
                        <td colspan="7" style="text-align: center; color: #64748b; padding: 40px;">No inquiry messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
