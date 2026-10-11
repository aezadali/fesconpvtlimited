const fs = require('fs');
const path = require('path');

const rawDir = path.join(__dirname, 'raw_html');
const files = fs.readdirSync(rawDir).filter(f => f.endsWith('.html'));

const imageUrls = new Set();
for (const f of files) {
  const content = fs.readFileSync(path.join(rawDir, f), 'utf8');
  const matches = [...content.matchAll(/(?:src|href|background|data-url|content)=['"](https:\/\/fescon\.com\.pk\/wp-content\/uploads\/[^'"]+\.(?:png|jpg|jpeg|svg|webp|gif))(?:\?[^'"]*)?['"]/gi)];
  for (const m of matches) {
    imageUrls.add(m[1]);
  }
  // srcset matches
  const srcsetMatches = [...content.matchAll(/srcset=['"]([^'"]+)['"]/gi)];
  for (const sm of srcsetMatches) {
    const parts = sm[1].split(',');
    for (const part of parts) {
      const u = part.trim().split(' ')[0];
      if (u.includes('/wp-content/uploads/')) {
        imageUrls.add(u.split('?')[0]);
      }
    }
  }
}

console.log('Total unique images found across all 23 pages:', imageUrls.size);
Array.from(imageUrls).slice(0, 15).forEach(u => console.log('  ' + u));
