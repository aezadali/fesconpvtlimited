<?php
/**
 * Sticky Elements Floating Form Handler for Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$name = trim($_POST['contact-form-name'] ?? '');
$phone = trim($_POST['contact-form-phone'] ?? '');
$email = filter_var(trim($_POST['contact-form-email'] ?? ''), FILTER_SANITIZE_EMAIL);
$message = trim($_POST['contact-form-message'] ?? '');
$page = trim($_POST['stickyelements-page-link'] ?? '');

if (empty($phone) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 0,
        'message' => 'Please provide a valid phone number and email address.'
    ]);
    exit;
}

$to = $admin_email ?? 'info@fescon.com.pk';
$email_subject = "Quick Inquiry from Sticky Widget: " . ($name ?: $phone);
$email_body = "New inquiry via Fescon Sticky Elements widget:\n\n" .
              "Name: " . $name . "\n" .
              "Phone: " . $phone . "\n" .
              "Email: " . $email . "\n" .
              "Page: " . $page . "\n" .
              "Date: " . date('Y-m-d H:i:s') . "\n\n" .
              "Message:\n" . $message . "\n";

$headers = "From: webmaster@" . ($_SERVER['SERVER_NAME'] ?? 'fescon.com.pk') . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

@mail($to, $email_subject, $email_body, $headers);

// Save to Database
try {
    $db = get_db();
    $stmt = $db->prepare("INSERT INTO inquiries (type, name, phone, email, message, page_source) VALUES ('sticky', ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $email, $message, $page ?: ($_SERVER['HTTP_REFERER'] ?? 'home')]);
} catch (Exception $e) {
    // Continue
}

$log_dir = __DIR__ . '/storage/inquiries';
if (!is_dir($log_dir)) {
    @mkdir($log_dir, 0755, true);
}
@file_put_contents(
    $log_dir . '/sticky_' . date('Y-m') . '.log',
    "[" . date('Y-m-d H:i:s') . "] Name: $name | Phone: $phone | Email: $email | Msg: $message\n",
    FILE_APPEND
);

echo json_encode([
    'status' => 1,
    'message' => 'Your message was sent successfully. Thanks!'
]);
exit;
