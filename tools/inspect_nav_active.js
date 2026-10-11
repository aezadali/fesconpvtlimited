const fs = require('fs');
const headerHtml = fs.readFileSync('includes/header.php', 'utf8');

const regex = /<li[^>]*class=["'][^"']*current[^"']*["'][^>]*>[\s\S]*?<\/li>/gi;
let m;
while ((m = regex.exec(headerHtml)) !== null) {
  console.log('Active LI item:');
  console.log(m[0].substring(0, 300));
}

// Find all menu items
const liRegex = /<li id="menu-item-[^"]*" class="([^"]*)">([\s\S]*?)<\/li>/gi;
while ((m = liRegex.exec(headerHtml)) !== null) {
  if (m[1].includes('current') || m[2].includes('Services') || m[2].includes('Team')) {
    console.log('Class:', m[1]);
    const linkText = m[2].replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim();
    console.log('Text:', linkText.substring(0, 60));
  }
}
