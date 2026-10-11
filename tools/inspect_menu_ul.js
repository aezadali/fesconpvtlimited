const fs = require('fs');
const headerHtml = fs.readFileSync('includes/header.php', 'utf8');

const ulStart = headerHtml.indexOf('<ul id="menu-1-174e841"');
const ulEnd = headerHtml.indexOf('</ul>', ulStart) + 5;

const menuUl = headerHtml.substring(ulStart, ulEnd);
console.log('Menu block:');
console.log(menuUl);
