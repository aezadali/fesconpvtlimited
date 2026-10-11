const fs = require('fs');
const path = require('path');

const indexHtml = fs.readFileSync(path.join(__dirname, 'raw_html', 'index.html'), 'utf8');

// Check the body tag and child sections
const bodyStart = indexHtml.indexOf('<body');
const bodyContent = indexHtml.substring(bodyStart);

console.log('Body tag line:', indexHtml.substring(bodyStart, bodyStart + 300));

// Find sections in body
const sectionMatches = [...indexHtml.matchAll(/<(section|div)[^>]+class=['"][^'"]*elementor-(?:section|top-section|element)[^'"]*['"][^>]*data-id=['"]([^'"]+)['"]/g)];
console.log('Found elementor sections:', sectionMatches.length);
sectionMatches.slice(0, 10).forEach(m => console.log('  tag:', m[1], 'id:', m[2]));
