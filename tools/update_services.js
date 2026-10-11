const fs = require('fs');
const path = require('path');

const srvPath = path.join(__dirname, '..', 'services.php');
let content = fs.readFileSync(srvPath, 'utf8');

if (!content.includes("require_once __DIR__ . '/includes/db.php';")) {
  content = content.replace(
    "require_once __DIR__ . '/includes/config.php';",
    "require_once __DIR__ . '/includes/config.php';\nrequire_once __DIR__ . '/includes/db.php';"
  );
}

const serviceMappings = [
  { oldPath: '/planning-and-designing/', slug: 'planning-and-designing' },
  { oldPath: '/epc-projects/', slug: 'epc-projects' },
  { oldPath: '/energy-transmission-distribution/', slug: 'energy-transmission-distribution' },
  { oldPath: '/operation-maintenance/', slug: 'operation-maintenance' },
  { oldPath: '/mep-solutions/', slug: 'mep-solutions' },
  { oldPath: '/civil-works/', slug: 'civil-works' }
];

serviceMappings.forEach(s => {
  const target = `href="<?php echo $base_url; ?>${s.oldPath}"`;
  const replacement = `href="<?php echo $base_url; ?>/service-detail.php?service=${s.slug}"`;
  content = content.split(target).join(replacement);
});

fs.writeFileSync(srvPath, content);
console.log('services.php updated successfully!');
