const fs = require('fs');
const html = fs.readFileSync('services.php', 'utf8');

const headStart = html.indexOf('<head>');
const headEnd = html.indexOf('</head>');
console.log('head length:', headEnd - headStart);

const headContent = html.substring(headStart + 6, headEnd);

// Find all css links in head
const cssLinks = [...headContent.matchAll(/<link[^>]+rel=['"]stylesheet['"][^>]*>/gi)].map(m => m[0]);
console.log('CSS links in head:', cssLinks.length);
cssLinks.forEach(l => console.log('  ' + l));
