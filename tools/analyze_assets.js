const fs = require('fs');
const path = require('path');

const rawDir = path.join(__dirname, 'raw_html');
const files = fs.readdirSync(rawDir).filter(f => f.endsWith('.html'));

const cssUrls = new Set();
const jsUrls = new Set();
const fonts = new Set();

for (const file of files) {
  const content = fs.readFileSync(path.join(rawDir, file), 'utf8');
  
  // Find stylesheets
  const linkMatches = [...content.matchAll(/<link[^>]+rel=['"]stylesheet['"][^>]+href=['"]([^'"]+)['"]/gi)];
  for (const m of linkMatches) {
    cssUrls.add(m[1]);
  }
  const linkMatches2 = [...content.matchAll(/<link[^>]+href=['"]([^'"]+)['"][^>]+rel=['"]stylesheet['"]/gi)];
  for (const m of linkMatches2) {
    cssUrls.add(m[1]);
  }

  // Find scripts
  const scriptMatches = [...content.matchAll(/<script[^>]+src=['"]([^'"]+)['"]/gi)];
  for (const m of scriptMatches) {
    jsUrls.add(m[1]);
  }
}

console.log('CSS URLs (' + cssUrls.size + '):');
Array.from(cssUrls).forEach(u => console.log('  ' + u));

console.log('\nJS URLs (' + jsUrls.size + '):');
Array.from(jsUrls).forEach(u => console.log('  ' + u));
