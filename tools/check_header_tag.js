const fs = require('fs');

const files = ['index.html', 'about-us.html', 'contact-us.html'];
for (const f of files) {
  const content = fs.readFileSync('raw_html/' + f, 'utf8');
  const navIdx = content.indexOf('hfe-nav-menu__layout-horizontal');
  const secStart = content.lastIndexOf('<section class="elementor-section elementor-top-section', navIdx);
  const secTag = content.substring(secStart, content.indexOf('>', secStart) + 1);
  console.log(f + ' header top-section: ' + secTag);
}
