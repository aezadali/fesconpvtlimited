const fs = require('fs');
const path = require('path');

const rawDir = path.join(__dirname, 'raw_html');
const files = fs.readdirSync(rawDir).filter(f => f.endsWith('.html'));

for (const f of files.slice(0, 5)) {
  const content = fs.readFileSync(path.join(rawDir, f), 'utf8');
  console.log(`=== ${f} ===`);
  const bodyIdx = content.indexOf('<body');
  const bodyTag = content.substring(bodyIdx, content.indexOf('>', bodyIdx) + 1);
  console.log('Body class:', bodyTag.match(/class=['"]([^'"]+)['"]/)[1]);

  // First section
  const firstSecMatch = content.match(/<(?:section|div)[^>]+class=['"][^'"]*elementor-(?:top-section|section|parent)[^'"]*['"][^>]*>/i);
  console.log('First section tag:', firstSecMatch ? firstSecMatch[0] : 'none');

  // Check if it has nav menu
  const hasNav = content.includes('hfe-nav-menu');
  console.log('Has hfe-nav-menu:', hasNav);
  const hasSticky = content.includes('mystickyelements');
  console.log('Has mystickyelements:', hasSticky);
}
