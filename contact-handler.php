<?php
/**
 * Contact Form Handler for Fescon (Pvt.) Ltd
 * Handles both AJAX requests and standard POST form submissions
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || isset($_POST['_wpcf7']);

$name = trim($_POST['your-name'] ?? $_POST['name'] ?? '');
$email = filter_var(trim($_POST['your-email'] ?? $_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$subject = trim($_POST['your-subject'] ?? $_POST['subject'] ?? 'Website Inquiry');
$message = trim($_POST['your-message'] ?? $_POST['message'] ?? '');

$phone = trim($_POST['your-phone'] ?? $_POST['phone'] ?? '');

if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'validation_failed',
        'message' => 'Please fill out all required fields with a valid email address.',
        'invalid_fields' => []
    ]);
    exit;
}

$to = $admin_email ?? 'info@fescon.com.pk';
$email_subject = "New Contact Form Inquiry: " . $subject;
$email_body = "You have received a new inquiry from the Fescon website:\n\n" .
              "Name: " . $name . "\n" .
              "Email: " . $email . "\n" .
              "Phone: " . $phone . "\n" .
              "Subject: " . $subject . "\n" .
              "Date: " . date('Y-m-d H:i:s') . "\n\n" .
              "Message:\n" . $message . "\n";

$headers = "From: webmaster@" . ($_SERVER['SERVER_NAME'] ?? 'fescon.com.pk') . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

// Send email (suppress warning if sendmail not configured locally)
@mail($to, $email_subject, $email_body, $headers);

// Save to Database
try {
    $db = get_db();
    $stmt = $db->prepare("INSERT INTO inquiries (type, name, email, phone, subject, message, page_source) VALUES ('contact', ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $subject, $message, $_SERVER['HTTP_REFERER'] ?? 'contact-us']);
} catch (Exception $e) {
    // Silently continue if database logging encounters an issue
}

// Also log message to file for backup
$log_dir = __DIR__ . '/storage/inquiries';
if (!is_dir($log_dir)) {
    @mkdir($log_dir, 0755, true);
}
@file_put_contents(
    $log_dir . '/contacts_' . date('Y-m') . '.log',
    "[" . date('Y-m-d H:i:s') . "] Name: $name | Email: $email | Subject: $subject | Message: $message\n",
    FILE_APPEND
);

echo json_encode([
    'status' => 'mail_sent',
    'message' => 'Thank you for your message. It has been sent.',
    'into' => $_POST['_wpcf7_unit_tag'] ?? '#wpcf7-f6-p175-o1'
]);
exit;
