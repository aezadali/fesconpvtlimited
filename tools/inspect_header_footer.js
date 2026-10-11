const fs = require('fs');
const html = fs.readFileSync('services.php', 'utf8');

const sHeaderStart = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-a059c72');
const sHeaderEnd = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-4d1d875');

console.log('Header length:', sHeaderEnd - sHeaderStart);

const sFooterStart = html.indexOf('<section class="elementor-section elementor-top-section elementor-element elementor-element-90e2bd6');
console.log('Footer starts at:', sFooterStart);
console.log(html.substring(sFooterStart, sFooterStart + 1000));
