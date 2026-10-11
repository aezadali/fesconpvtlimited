const fs = require('fs');
const cHtml = fs.readFileSync('collaborations.php', 'utf8');
const regex = /<h[1-5][^>]*>(.*?)<\/h[1-5]>/gi;
let m;
while ((m = regex.exec(cHtml)) !== null) {
  console.log('Heading:', m[1].replace(/<[^>]+>/g, '').trim());
}
const imgRegex = /src=["']([^"']+)["']/gi;
while ((m = imgRegex.exec(cHtml)) !== null) {
  if (m[1].includes('uploads')) console.log('Img:', m[1]);
}
