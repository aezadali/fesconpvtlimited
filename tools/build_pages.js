const fs = require('fs');
const path = require('path');

const manifest = JSON.parse(fs.readFileSync(path.join(__dirname, 'assets', 'manifest.json'), 'utf8'));

const pages = [
  'index',
  'about-us',
  'our-story',
  'our-values',
  'management-team',
  'the-founder',
  'certifications',
  'collaborations',
  'blogs',
  'services',
  'planning-and-designing',
  'epc-projects',
  'energy-transmission-distribution',
  'operation-maintenance',
  'mep-solutions',
  'civil-works',
  'projects',
  'hse-policy',
  'welfare-policy',
  'csr-policy',
  'team',
  'contact-us',
  'careers'
];

function transformHtml(html, slug) {
  let phpHeader = `<?php
require_once __DIR__ . '/includes/config.php';
$current_page = '${slug}';
`;

  if (slug === 'contact-us') {
    phpHeader += `
$contact_sent = false;
$contact_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['your-name'])) {
    $name = htmlspecialchars(trim($_POST['your-name'] ?? ''));
    $email = filter_var(trim($_POST['your-email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['your-subject'] ?? 'Inquiry'));
    $message = htmlspecialchars(trim($_POST['your-message'] ?? ''));
    
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = $admin_email ?? 'info@fescon.com.pk';
        $email_subject = "Contact Form: " . $subject;
        $body = "Name: $name\\nEmail: $email\\nSubject: $subject\\n\\nMessage:\\n$message\\n";
        $headers = "From: webmaster@" . ($_SERVER['SERVER_NAME'] ?? 'fescon.com.pk') . "\\r\\n" .
                   "Reply-To: $email\\r\\n" .
                   "X-Mailer: PHP/" . phpversion();
        @mail($to, $email_subject, $body, $headers);
        $contact_sent = true;
    } else {
        $contact_error = 'Please fill out all required fields with a valid email address.';
    }
}
`;
  }

  phpHeader += `?>\n`;

  let out = html;

  // Replace CSS links using manifest
  for (const [remoteUrl, localPath] of Object.entries(manifest.css)) {
    const escaped = remoteUrl.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const regex = new RegExp(escaped, 'g');
    out = out.replace(regex, `<?php echo $base_url; ?>/${localPath}`);
  }

  // Replace JS links using manifest
  for (const [remoteUrl, localPath] of Object.entries(manifest.js)) {
    const escaped = remoteUrl.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const regex = new RegExp(escaped, 'g');
    out = out.replace(regex, `<?php echo $base_url; ?>/${localPath}`);
  }

  // Replace internal navigation links:
  out = out.replace(/href=["']https:\/\/fescon\.com\.pk\/?["']/g, 'href="<?php echo $base_url; ?>/"');
  out = out.replace(/href=["']https:\/\/fescon\.com\.pk\/feed\/?["']/g, 'href="<?php echo $base_url; ?>/feed/"');

  for (const p of pages) {
    if (p === 'index') continue;
    const re = new RegExp(`href=["']https:\\/\\/fescon\\.com\\.pk\\/${p}\\/?["']`, 'g');
    out = out.replace(re, `href="<?php echo $base_url; ?>/${p}/"`);
  }

  // Replace AJAX endpoints in inline scripts
  out = out.replace(/https:\\\/\\\/fescon\.com\.pk\\\/wp-admin\\\/admin-ajax\.php/g, `<?php echo $base_url; ?>/contact-handler.php`);
  out = out.replace(/https:\/\/fescon\.com\.pk\/wp-admin\/admin-ajax.php/g, `<?php echo $base_url; ?>/contact-handler.php`);
  out = out.replace(/https:\\\/\\\/fescon\.com\.pk\\\/wp-json\\\//g, `<?php echo $base_url; ?>/contact-handler.php?api=`);
  out = out.replace(/https:\/\/fescon\.com\.pk\/wp-json\//g, `<?php echo $base_url; ?>/contact-handler.php?api=`);

  // Sticky elements form AJAX endpoint
  out = out.replace(/name="stickyelements-page-link" value="[^"]*"/g, `name="stickyelements-page-link" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? ''); ?>"`);
  out = out.replace(/id="stickyelements-form" class="stickyelements-form" action=""/g, `id="stickyelements-form" class="stickyelements-form" action="<?php echo $base_url; ?>/sticky-handler.php"`);

  // Contact form action
  if (slug === 'contact-us') {
    out = out.replace(/action="\/contact-us\/#wpcf7-f6-p175-o1"/g, `action="<?php echo $base_url; ?>/contact-us/#wpcf7-f6-p175-o1"`);
    const successHtml = `<?php if (!empty($contact_sent)): ?>
<div class="wpcf7-response-output" aria-hidden="false" style="display:block; border: 2px solid #46b450; padding: 12px 16px; margin: 15px 0; background: #eaf8ea; color: #2e6930; border-radius: 4px;">Thank you for your message. It has been sent.</div>
<?php elseif (!empty($contact_error)): ?>
<div class="wpcf7-response-output" aria-hidden="false" style="display:block; border: 2px solid #dc3232; padding: 12px 16px; margin: 15px 0; background: #fdf2f2; color: #a92020; border-radius: 4px;"><?php echo htmlspecialchars($contact_error); ?></div>
<?php endif; ?>`;
    out = out.replace('<div class="wpcf7-response-output" aria-hidden="true"></div>', successHtml);
  }

  // Careers form action
  if (slug === 'careers') {
    out = out.replace(/id="fluentform_3" class="([^"]*)"([^>]*)method="POST"/g, `id="fluentform_3" class="$1"$2action="<?php echo $base_url; ?>/careers-handler.php" method="POST" enctype="multipart/form-data"`);
  }

  // Inject custom stylesheet links before </head>
  const customStyles = `
<link rel="stylesheet" id="fescon-core-style-css" href="<?php echo $base_url; ?>/assets/css/style.css" media="all" />
<link rel="stylesheet" id="fescon-animations-css" href="<?php echo $base_url; ?>/assets/css/animations.css" media="all" />
</head>`;
  out = out.replace('</head>', customStyles);

  // Inject custom script controller before </body>
  const customScripts = `
<script src="<?php echo $base_url; ?>/assets/js/main.js"></script>
</body>`;
  out = out.replace('</body>', customScripts);

  return phpHeader + out;
}

function run() {
  const rawDir = path.join(__dirname, 'raw_html');

  for (const slug of pages) {
    const rawFile = path.join(rawDir, `${slug}.html`);
    if (!fs.existsSync(rawFile)) {
      console.warn(`File not found: ${rawFile}`);
      continue;
    }
    const html = fs.readFileSync(rawFile, 'utf8');
    const phpContent = transformHtml(html, slug);
    const destPhp = path.join(__dirname, `${slug}.php`);
    fs.writeFileSync(destPhp, phpContent);
    console.log(`Generated ${slug}.php (${phpContent.length} bytes)`);

    if (slug !== 'index') {
      const dir = path.join(__dirname, slug);
      fs.mkdirSync(dir, { recursive: true });
      const wrapperContent = `<?php
/**
 * Directory index wrapper for ${slug}
 */
require_once __DIR__ . '/../${slug}.php';
`;
      fs.writeFileSync(path.join(dir, 'index.php'), wrapperContent);
    }
  }

  console.log('All 23 PHP pages and directory wrappers re-generated with custom styles and scripts!');
}

run();
