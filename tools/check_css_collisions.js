const fs = require('fs');
const path = require('path');

const manifest = JSON.parse(fs.readFileSync('assets/manifest.json', 'utf8'));

const nameToUrls = {};
for (const [url, localPath] of Object.entries(manifest.css)) {
  const base = path.basename(localPath);
  if (!nameToUrls[base]) nameToUrls[base] = new Set();
  nameToUrls[base].add(url.split('?')[0]);
}

for (const [base, urls] of Object.entries(nameToUrls)) {
  if (urls.size > 1) {
    console.log(`Collision for ${base}:`, Array.from(urls));
  }
}
