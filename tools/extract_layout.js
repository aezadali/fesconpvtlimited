const fs = require('fs');
const html = fs.readFileSync('services.php', 'utf8');

// Find all top-level sections
const sections = [...html.matchAll(/<section class="elementor-section elementor-top-section[^"]*" data-id="([^"]+)"/g)];
console.log('Top sections found:', sections.map(s => s[1]));

// Let's print info for each top section
sections.forEach(s => {
  const id = s[1];
  const pos = html.indexOf(`data-id="${id}"`);
  console.log(`Section ${id} at ${pos}:`);
  const snippet = html.substring(pos, pos + 400).replace(/\s+/g, ' ');
  console.log('  ' + snippet);
});
