<?php
/**
 * Careers / Job Application Form Handler for Fescon (Pvt.) Ltd
 */
require_once __DIR__ . '/includes/config.php';

header('Content-Type: application/json; charset=utf-8');

// Strip newlines to prevent header injection
function sanitize_header_val($str) {
    return trim(str_replace(["\r", "\n", "%0a", "%0d"], '', (string)$str));
}

$name = sanitize_header_val($_POST['names']['first_name'] ?? $_POST['first_name'] ?? $_POST['name'] ?? '');
$email = sanitize_header_val(filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL));
$phone = sanitize_header_val($_POST['numeric-input'] ?? $_POST['phone'] ?? '');
$position = sanitize_header_val($_POST['dropdown'] ?? $_POST['position'] ?? 'General Application');
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

    $allowed_extensions = ['pdf', 'doc', 'docx', 'rtf', 'txt'];
    $max_file_size = 5 * 1024 * 1024; // 5 MB

    foreach ($_FILES as $key => $file) {
        if (!empty($file['name']) && $file['error'] === UPLOAD_ERR_OK) {
            // Check file size
            if ($file['size'] > $max_file_size) {
                http_response_code(400);
                echo json_encode([
                    'errors' => ['resume' => ['File size exceeds the 5MB limit.']]
                ]);
                exit;
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // Strictly enforce allowed document extensions
            if (!in_array($ext, $allowed_extensions, true)) {
                http_response_code(400);
                echo json_encode([
                    'errors' => ['resume' => ['Invalid file format. Allowed formats: PDF, DOC, DOCX, RTF, TXT.']]
                ]);
                exit;
            }

            // Verify MIME type if finfo is available
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                $allowed_mimes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/rtf',
                    'text/rtf',
                    'text/plain'
                ];

                if (!in_array($mime, $allowed_mimes, true)) {
                    http_response_code(400);
                    echo json_encode([
                        'errors' => ['resume' => ['Invalid file type detected. Please upload a genuine PDF or Word document.']]
                    ]);
                    exit;
                }
            }

            $clean_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
            $dest = $upload_dir . '/' . time() . '_' . bin2hex(random_bytes(6)) . '_' . $clean_name . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $uploaded_file_name = $dest;
            }
        }
    }
}

$to = sanitize_header_val($admin_email ?? 'info@fescon.com.pk');
$email_subject = "Job Application: " . $position . " - " . $name;
$email_body = "New job application received on Fescon website:\n\n" .
              "Applicant Name: " . $name . "\n" .
              "Email: " . $email . "\n" .
              "Phone: " . $phone . "\n" .
              "Position Applied: " . $position . "\n" .
              "Date: " . date('Y-m-d H:i:s') . "\n\n" .
              "Cover Letter / Remarks:\n" . $message . "\n" .
              ($uploaded_file_name ? "Resume file saved on server at: " . basename($uploaded_file_name) . "\n" : "");

$server_host = sanitize_header_val($_SERVER['SERVER_NAME'] ?? 'fescon.com.pk');
$headers = "From: careers@" . $server_host . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

@mail($to, $email_subject, $email_body, $headers);

echo json_encode([
    'result' => [
        'message' => 'Thank you for your application! Our recruitment team will review your profile and contact you soon.'
    ]
]);
exit;
