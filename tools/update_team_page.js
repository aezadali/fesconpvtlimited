const fs = require('fs');
const path = require('path');

const teamPath = path.join(__dirname, '..', 'team.php');
let content = fs.readFileSync(teamPath, 'utf8');

// Ensure db.php is required
if (!content.includes("require_once __DIR__ . '/includes/db.php';")) {
  content = content.replace(
    "require_once __DIR__ . '/includes/config.php';",
    "require_once __DIR__ . '/includes/config.php';\nrequire_once __DIR__ . '/includes/db.php';"
  );
}

// Team member mappings by name
const members = [
  { name: 'Munir Hashmi', id: 2 },
  { name: 'Engr. Abdul Mutlib', id: 3 },
  { name: 'Engr. M. Taimoor', id: 4 },
  { name: 'Engr. Ghulam Muhammad', id: 5 },
  { name: 'Engr. Rana M. Usman Khan', id: 6 },
  { name: 'Mr. Faisal Hameed Ch.', id: 7 },
  { name: 'Hafiz Shoib Ahmad Farooqi', id: 8 }
];

members.forEach(m => {
  // Wrap heading in link if not already wrapped
  const target = `<h4 class="elementor-heading-title elementor-size-default">${m.name}`;
  const replacement = `<h4 class="elementor-heading-title elementor-size-default"><a href="<?php echo $base_url; ?>/team-detail.php?id=${m.id}" style="color:inherit; text-decoration:none; transition:color 0.2s;" onmouseover="this.style.color='#d32f2f'" onmouseout="this.style.color='inherit'">${m.name}</a>`;
  content = content.split(target).join(replacement);
});

fs.writeFileSync(teamPath, content);
console.log('team.php successfully updated with clickable employee profile links!');
