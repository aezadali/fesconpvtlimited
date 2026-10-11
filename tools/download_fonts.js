const fs = require('fs');
const path = require('path');
const https = require('https');

function download(url, dest) {
  return new Promise((resolve) => {
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
  const fontsDir = path.join(__dirname, 'assets', 'fonts');
  fs.mkdirSync(fontsDir, { recursive: true });

  const fontUrls = new Set([
    'https://fescon.com.pk/wp-content/themes/twentytwentyfour/assets/fonts/inter/Inter-VariableFont_slnt,wght.woff2',
    'https://fescon.com.pk/wp-content/themes/twentytwentyfour/assets/fonts/cardo/cardo_normal_400.woff2',
    'https://fescon.com.pk/wp-content/themes/twentytwentyfour/assets/fonts/cardo/cardo_italic_400.woff2',
    'https://fescon.com.pk/wp-content/themes/twentytwentyfour/assets/fonts/cardo/cardo_normal_700.woff2',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff2?5.34.0',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff?5.34.0',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.ttf?5.34.0',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-solid-900.woff2',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-solid-900.woff',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-solid-900.ttf',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-brands-400.woff2',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-brands-400.woff',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-brands-400.ttf',
    'https://fescon.com.pk/wp-content/plugins/elementor/assets/lib/font-awesome/webfonts/fa-regular-400.woff2',
    'https://fescon.com.pk/wp-content/plugins/mystickyelements/fonts/fontawesome-webfont.woff2?v=4.7.0',
    'https://fescon.com.pk/wp-content/plugins/mystickyelements/fonts/fontawesome-webfont.woff?v=4.7.0',
    'https://fescon.com.pk/wp-content/plugins/mystickyelements/fonts/fontawesome-webfont.ttf?v=4.7.0'
  ]);

  // Scan all CSS files in assets/css for url(...) pointing to fonts
  const cssDir = path.join(__dirname, 'assets', 'css');
  const cssFiles = fs.readdirSync(cssDir).filter(f => f.endsWith('.css'));
  for (const f of cssFiles) {
    const content = fs.readFileSync(path.join(cssDir, f), 'utf8');
    const matches = [...content.matchAll(/url\((['"]?)([^'"\)]+\.(?:woff2|woff|ttf|eot|svg)(?:\?[^'"\)]*)?)\1\)/gi)];
    for (const m of matches) {
      let u = m[2];
      if (u.startsWith('//')) u = 'https:' + u;
      else if (u.startsWith('http://fescon.com.pk')) u = u.replace('http://', 'https://');
      else if (!u.startsWith('http') && !u.startsWith('data:')) {
        u = 'https://fescon.com.pk/wp-content/plugins/' + u.replace(/^\.\.\//, '');
      }
      if (u.startsWith('http')) fontUrls.add(u);
    }
  }

  console.log(`Downloading ${fontUrls.size} font files...`);
  let count = 0;
  for (const rawUrl of fontUrls) {
    const cleanUrl = rawUrl.split('?')[0];
    const filename = path.basename(new URL(cleanUrl).pathname);
    const dest = path.join(fontsDir, filename);
    const res = await download(rawUrl, dest);
    if (res.ok) count++;
  }
  console.log(`Downloaded ${count} fonts successfully.`);
}

run();
