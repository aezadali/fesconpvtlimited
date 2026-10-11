const fs = require('fs');
const path = require('path');

const indexPath = path.join(__dirname, '..', 'index.php');
let content = fs.readFileSync(indexPath, 'utf8');

// Ensure db.php is required at the top of index.php
if (!content.includes("require_once __DIR__ . '/includes/db.php';")) {
  content = content.replace(
    "require_once __DIR__ . '/includes/config.php';",
    "require_once __DIR__ . '/includes/config.php';\nrequire_once __DIR__ . '/includes/db.php';"
  );
}

// Find logo-slider and replace with dynamic clickable links
const sliderStart = content.indexOf('<div class="logo-slider">');
if (sliderStart !== -1) {
  // Find matching closing </div></div>
  const trackIdx = content.indexOf('<div class="track">', sliderStart);
  const endTrack = content.indexOf('</div>', trackIdx);
  const endSlider = content.indexOf('</div>', endTrack + 1) + 6;

  const dynamicSlider = `<?php
$slider_clients = get_all_clients();
?>
<div class="logo-slider">
  <div class="track">
    <?php for ($rep = 0; $rep < 2; $rep++): ?>
      <?php foreach ($slider_clients as $sc): ?>
        <a href="<?php echo $base_url; ?>/client-projects.php?client=<?php echo urlencode($sc['slug']); ?>" title="View projects completed with <?php echo htmlspecialchars($sc['name']); ?>" class="logo-slide-link">
          <img decoding="async" src="<?php echo htmlspecialchars($sc['logo_url']); ?>" alt="<?php echo htmlspecialchars($sc['name']); ?>">
        </a>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>`;

  content = content.substring(0, sliderStart) + dynamicSlider + content.substring(endSlider);
  console.log('Successfully updated logo-slider to dynamic clickable links in index.php');
} else {
  console.log('logo-slider not found');
}

// Update the 6 services buttons/links to point to service-detail.php?service=...
const serviceMappings = [
  { oldPath: '/planning-and-designing/', slug: 'planning-and-designing' },
  { oldPath: '/epc-projects/', slug: 'epc-projects' },
  { oldPath: '/energy-transmission-distribution/', slug: 'energy-transmission-distribution' },
  { oldPath: '/operation-maintenance/', slug: 'operation-maintenance' },
  { oldPath: '/mep-solutions/', slug: 'mep-solutions' },
  { oldPath: '/civil-works/', slug: 'civil-works' }
];

serviceMappings.forEach(s => {
  // Replace in homepage buttons and links
  const target = `href="<?php echo $base_url; ?>${s.oldPath}"`;
  const replacement = `href="<?php echo $base_url; ?>/service-detail.php?service=${s.slug}"`;
  // We can keep nav links pointing to the subpage (which we will redirect or show), but let's update homepage occurrences
  content = content.split(target).join(replacement);
});

fs.writeFileSync(indexPath, content);
console.log('index.php updated successfully!');
