const fs = require('fs');
const html = fs.readFileSync('team.php', 'utf8');

// Find headings or sections
const hMatches = [...html.matchAll(/<h[1-5][^>]*>(.*?)<\/h[1-5]>/gi)];
hMatches.forEach(m => console.log('H:', m[1].replace(/<[^>]+>/g, '').trim()));
