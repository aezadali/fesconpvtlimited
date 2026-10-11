const fs = require('fs');
const path = require('path');

const collabPath = path.join(__dirname, '..', 'collaborations.php');
let content = fs.readFileSync(collabPath, 'utf8');

// Ensure db.php is required
if (!content.includes("require_once __DIR__ . '/includes/db.php';")) {
  content = content.replace(
    "require_once __DIR__ . '/includes/config.php';",
    "require_once __DIR__ . '/includes/config.php';\nrequire_once __DIR__ . '/includes/db.php';"
  );
}

// Logo mappings to client slugs
const logoToSlug = {
  'logo-1.png': 'wapda',
  'logo-3.png': 'ntdc',
  'logo-2.png': 'iesco',
  'logo-5.png': 'fesco',
  'logo-5-copy.png': 'fesco',
  'logo-4.png': 'gepco',
  'logo-6.png': 'lesco',
  'logo-6-copy.png': 'lesco',
  'logo-7.png': 'k-electric'
};

// Wrap image tags matching logos with links
for (const [logo, slug] of Object.entries(logoToSlug)) {
  const regex = new RegExp(`(<img[^>]+src=["'][^"']*${logo}["'][^>]*>)`, 'gi');
  content = content.replace(regex, (match) => {
    // Only wrap if not already in <a>
    return `<a href="<?php echo $base_url; ?>/client-projects.php?client=${slug}" title="View Projects" style="display:inline-block; transition:transform 0.3s ease;">${match}</a>`;
  });
}

fs.writeFileSync(collabPath, content);
console.log('collaborations.php updated with clickable client links!');
