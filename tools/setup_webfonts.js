const fs = require('fs');
const path = require('path');

const fontsDir = path.join(__dirname, 'assets', 'fonts');
const webfontsDir = path.join(__dirname, 'assets', 'webfonts');

fs.mkdirSync(webfontsDir, { recursive: true });

if (fs.existsSync(fontsDir)) {
  const files = fs.readdirSync(fontsDir);
  for (const f of files) {
    fs.copyFileSync(path.join(fontsDir, f), path.join(webfontsDir, f));
  }
}
console.log('Webfonts setup complete!');
