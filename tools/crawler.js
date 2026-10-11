const fs = require('fs');
const path = require('path');
const https = require('https');

function fetchUrl(url) {
  return new Promise((resolve, reject) => {
    https.get(url, { headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' } }, (res) => {
      if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
        let redirectUrl = res.headers.location;
        if (!redirectUrl.startsWith('http')) {
          redirectUrl = new URL(redirectUrl, url).toString();
        }
        return resolve(fetchUrl(redirectUrl));
      }
      if (res.statusCode !== 200) {
        return reject(new Error(`Failed to load ${url}: status code ${res.statusCode}`));
      }
      let chunks = [];
      res.on('data', chunk => chunks.push(chunk));
      res.on('end', () => resolve(Buffer.concat(chunks)));
    }).on('error', reject);
  });
}

const pages = [
  { slug: 'index', url: 'https://fescon.com.pk/' },
  { slug: 'about-us', url: 'https://fescon.com.pk/about-us/' },
  { slug: 'our-story', url: 'https://fescon.com.pk/our-story/' },
  { slug: 'our-values', url: 'https://fescon.com.pk/our-values/' },
  { slug: 'management-team', url: 'https://fescon.com.pk/management-team/' },
  { slug: 'the-founder', url: 'https://fescon.com.pk/the-founder/' },
  { slug: 'certifications', url: 'https://fescon.com.pk/certifications/' },
  { slug: 'collaborations', url: 'https://fescon.com.pk/collaborations/' },
  { slug: 'blogs', url: 'https://fescon.com.pk/blogs/' },
  { slug: 'services', url: 'https://fescon.com.pk/services/' },
  { slug: 'planning-and-designing', url: 'https://fescon.com.pk/planning-and-designing/' },
  { slug: 'epc-projects', url: 'https://fescon.com.pk/epc-projects/' },
  { slug: 'energy-transmission-distribution', url: 'https://fescon.com.pk/energy-transmission-distribution/' },
  { slug: 'operation-maintenance', url: 'https://fescon.com.pk/operation-maintenance/' },
  { slug: 'mep-solutions', url: 'https://fescon.com.pk/mep-solutions/' },
  { slug: 'civil-works', url: 'https://fescon.com.pk/civil-works/' },
  { slug: 'projects', url: 'https://fescon.com.pk/projects/' },
  { slug: 'hse-policy', url: 'https://fescon.com.pk/hse-policy/' },
  { slug: 'welfare-policy', url: 'https://fescon.com.pk/welfare-policy/' },
  { slug: 'csr-policy', url: 'https://fescon.com.pk/csr-policy/' },
  { slug: 'team', url: 'https://fescon.com.pk/team/' },
  { slug: 'contact-us', url: 'https://fescon.com.pk/contact-us/' },
  { slug: 'careers', url: 'https://fescon.com.pk/careers/' }
];

async function main() {
  const rawDir = path.join(__dirname, 'raw_html');
  if (!fs.existsSync(rawDir)) fs.mkdirSync(rawDir, { recursive: true });

  for (const page of pages) {
    console.log(`Fetching ${page.slug} (${page.url})...`);
    try {
      const buf = await fetchUrl(page.url);
      fs.writeFileSync(path.join(rawDir, `${page.slug}.html`), buf);
      console.log(`Saved ${page.slug}.html (${buf.length} bytes)`);
    } catch (err) {
      console.error(`Error fetching ${page.slug}:`, err.message);
    }
  }
}

main();
