const fs = require('fs');
const headerHtml = fs.readFileSync('includes/header.php', 'utf8');

const ulStart = headerHtml.indexOf('<ul id="menu-1-174e841"');
const navEnd = headerHtml.indexOf('</nav>', ulStart);

const menuUl = headerHtml.substring(ulStart, navEnd);
console.log(menuUl);
