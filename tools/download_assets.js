const fs = require('fs');
const path = require('path');
const https = require('https');

function download(url, dest) {
  return new Promise((resolve, reject) => {
    const file = fs.createWriteStream(dest);
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0' } }, (res) => {
      if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
        let redirect = res.headers.location;
        if (!redirect.startsWith('http')) {
          redirect = new URL(redirect, url).toString();
        }
        return resolve(download(redirect, dest));
      }
      if (res.statusCode !== 200) {
        file.close();
        fs.unlink(dest, () => {});
        return resolve({ url, status: res.statusCode, ok: false });
      }
      res.pipe(file);
      file.on('finish', () => {
        file.close(() => resolve({ url, status: 200, ok: true }));
      });
    }).on('error', (err) => {
      file.close();
      fs.unlink(dest, () => {});
      resolve({ url, error: err.message, ok: false });
    });
  });
}

async function run() {
  const rawDir = path.join(__dirname, 'raw_html');
  const files = fs.readdirSync(rawDir).filter(f => f.endsWith('.html'));

  const cssUrls = new Set();
  const jsUrls = new Set();

  for (const file of files) {
    const content = fs.readFileSync(path.join(rawDir, file), 'utf8');
    const linkMatches = [...content.matchAll(/<link[^>]+(?:href=['"]([^'"]+)['"][^>]+rel=['"]stylesheet['"]|rel=['"]stylesheet['"][^>]+href=['"]([^'"]+)['"])/gi)];
    for (const m of linkMatches) {
      const u = m[1] || m[2];
      if (u && !u.includes('fonts.googleapis.com')) {
        cssUrls.add(u);
      }
    }
    const scriptMatches = [...content.matchAll(/<script[^>]+src=['"]([^'"]+)['"]/gi)];
    for (const m of scriptMatches) {
      if (m[1]) jsUrls.add(m[1]);
    }
  }

  const cssDir = path.join(__dirname, 'assets', 'css');
  const jsDir = path.join(__dirname, 'assets', 'js');
  fs.mkdirSync(cssDir, { recursive: true });
  fs.mkdirSync(jsDir, { recursive: true });

  const manifest = { css: {}, js: {} };

  console.log(`Downloading ${cssUrls.size} CSS files...`);
  let cssCount = 0;
  for (const rawUrl of cssUrls) {
    const cleanUrl = rawUrl.split('?')[0];
    const urlObj = new URL(cleanUrl);
    const filename = path.basename(urlObj.pathname);
    const dest = path.join(cssDir, filename);
    const res = await download(rawUrl, dest);
    if (res.ok) {
      manifest.css[rawUrl] = 'assets/css/' + filename;
      manifest.css[cleanUrl] = 'assets/css/' + filename;
      cssCount++;
    }
  }
  console.log(`Successfully downloaded ${cssCount} CSS files.`);

  console.log(`Downloading ${jsUrls.size} JS files...`);
  let jsCount = 0;
  for (const rawUrl of jsUrls) {
    const cleanUrl = rawUrl.split('?')[0];
    const urlObj = new URL(cleanUrl);
    const filename = path.basename(urlObj.pathname);
    const dest = path.join(jsDir, filename);
    const res = await download(rawUrl, dest);
    if (res.ok) {
      manifest.js[rawUrl] = 'assets/js/' + filename;
      manifest.js[cleanUrl] = 'assets/js/' + filename;
      jsCount++;
    }
  }
  console.log(`Successfully downloaded ${jsCount} JS files.`);

  fs.writeFileSync(path.join(__dirname, 'assets', 'manifest.json'), JSON.stringify(manifest, null, 2));
}

run();
