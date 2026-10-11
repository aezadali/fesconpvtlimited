const fs = require('fs');
const path = require('path');

const p1 = fs.readFileSync('raw_html/index.html', 'utf8');
const p2 = fs.readFileSync('raw_html/about-us.html', 'utf8');
const p3 = fs.readFileSync('raw_html/services.html', 'utf8');
const p4 = fs.readFileSync('raw_html/contact-us.html', 'utf8');

function getHeader(html) {
  const match = html.match(/<section[^>]+data-id=['"]ea1fae3[\s\S]*?<\/section>\s*<\/div>\s*<\/div>\s*<\/div>\s*<\/section>/i);
  return match ? match[0] : null;
}

function getFooter(html) {
  const match = html.match(/<section[^>]+data-id=['"]72b6f989[\s\S]*?<\/section>/i);
  return match ? match[0] : null;
}

console.log('Index has header:', !!getHeader(p1));
console.log('About has header:', !!getHeader(p2));
console.log('Services has header:', !!getHeader(p3));
console.log('Contact has header:', !!getHeader(p4));

console.log('Index has footer:', !!getFooter(p1));
console.log('About has footer:', !!getFooter(p2));
console.log('Services has footer:', !!getFooter(p3));
console.log('Contact has footer:', !!getFooter(p4));
