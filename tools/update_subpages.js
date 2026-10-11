const fs = require('fs');
const path = require('path');

const services = [
  'planning-and-designing',
  'epc-projects',
  'energy-transmission-distribution',
  'operation-maintenance',
  'mep-solutions',
  'civil-works'
];

services.forEach(slug => {
  const filePath = path.join(__dirname, '..', `${slug}.php`);
  const redirectCode = `<?php
require_once __DIR__ . '/includes/config.php';
header("Location: " . $base_url . "/service-detail.php?service=${slug}");
exit;
`;
  fs.writeFileSync(filePath, redirectCode);
  console.log(`Updated ${slug}.php to redirect to service-detail`);
});
