const fs = require('fs');
const path = require('path');

const indexHtml = fs.readFileSync(path.join(__dirname, 'raw_html', 'index.html'), 'utf8');

const id = '72b6f989';
const pos = indexHtml.indexOf(id);
if (pos !== -1) {
  console.log(indexHtml.substring(pos - 100, pos + 800));
}
