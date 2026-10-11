const fs = require('fs');
const path = require('path');

const rawDir = path.join(__dirname, 'raw_html');
const files = fs.readdirSync(rawDir).filter(f => f.endsWith('.html'));

for (const f of files) {
  const content = fs.readFileSync(path.join(rawDir, f), 'utf8');
  const navMatch = content.match(/<nav class="hfe-nav-menu__layout-horizontal[\s\S]*?<\/nav>/i);
  if (navMatch) {
    console.log(`${f}: nav found, len=${navMatch[0].length}`);
  } else {
    console.log(`${f}: NO nav found!`);
  }
}
