<?php
/**
 * Careers / Job Application Form Handler for Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';

header('Content-Type: application/json; charset=utf-8');

$name = trim($_POST['names']['first_name'] ?? $_POST['first_name'] ?? $_POST['name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone = trim($_POST['numeric-input'] ?? $_POST['phone'] ?? '');
$position = trim($_POST['dropdown'] ?? $_POST['position'] ?? 'General Application');
$message = trim($_POST['description'] ?? $_POST['message'] ?? '');

if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'errors' => ['name' => ['Please provide valid name and email address.']]
    ]);
    exit;
}

$uploaded_file_name = '';
if (!empty($_FILES)) {
    $upload_dir = __DIR__ . '/storage/resumes';
    if (!is_dir($upload_dir)) {
        @mkdir($upload_dir, 0755, true);
    }
    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $clean_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
            $dest = $upload_dir . '/' . time() . '_' . $clean_name . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $uploaded_file_name = $dest;
            }
        }
    }
}

$to = $admin_email ?? 'info@fescon.com.pk';
$email_subject = "Job Application: " . $position . " - " . $name;
$email_body = "New job application received on Fescon website:\n\n" .
              "Applicant Name: " . $name . "\n" .
              "Email: " . $email . "\n" .
              "Phone: " . $phone . "\n" .
              "Position Applied: " . $position . "\n" .
              "Date: " . date('Y-m-d H:i:s') . "\n\n" .
              "Cover Letter / Remarks:\n" . $message . "\n" .
              ($uploaded_file_name ? "Resume file saved at: " . $uploaded_file_name . "\n" : "");

$headers = "From: careers@" . ($_SERVER['SERVER_NAME'] ?? 'fescon.com.pk') . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

@mail($to, $email_subject, $email_body, $headers);

echo json_encode([
    'result' => [
        'message' => 'Thank you for your application! Our recruitment team will review your profile and contact you soon.'
    ]
]);
exit;
