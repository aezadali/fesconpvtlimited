const fs = require('fs');
const path = require('path');

const indexHtml = fs.readFileSync(path.join(__dirname, 'raw_html', 'index.html'), 'utf8');

// Find top-level sections in the elementor div
const topSections = [...indexHtml.matchAll(/<(?:section|div)[^>]+class=['"][^'"]*elementor-top-section[^'"]*['"][^>]*data-id=['"]([^'"]+)['"]/g)];
console.log('Top sections count:', topSections.length);
topSections.forEach(m => console.log('Top section id:', m[1]));

// Also check flex containers if modern elementor flexbox container is used
const topContainers = [...indexHtml.matchAll(/<div[^>]+class=['"][^'"]*e-parent[^'"]*['"][^>]*data-id=['"]([^'"]+)['"]/g)];
console.log('Top containers count:', topContainers.length);
topContainers.forEach(m => console.log('Top container id:', m[1]));
