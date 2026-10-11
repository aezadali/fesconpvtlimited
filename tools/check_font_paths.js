const fs = require('fs');
const path = require('path');

const cssDir = path.join(__dirname, 'assets', 'css');
const cssFiles = fs.readdirSync(cssDir).filter(f => f.endsWith('.css'));
const relPaths = new Set();

for (const f of cssFiles) {
  const content = fs.readFileSync(path.join(cssDir, f), 'utf8');
  const matches = [...content.matchAll(/url\((['"]?)([^'"\)]+\.(?:woff2|woff|ttf|eot|svg)[^'"\)]*)\1\)/gi)];
  for (const m of matches) {
    if (!m[2].startsWith('http') && !m[2].startsWith('data:')) {
      relPaths.add(m[2]);
    }
  }
}

console.log('Relative font paths referenced in CSS:');
Array.from(relPaths).forEach(p => console.log('  ' + p));
