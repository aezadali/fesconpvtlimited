export default async function handler(req, res) {
  res.setHeader('Content-Type', 'application/json; charset=utf-8');

  if (req.method !== 'POST') {
    return res.status(200).json({ status: 'ok', message: 'Careers endpoint ready.' });
  }

  const body = req.body || {};
  const name = (body.first_name || body.name || (body.names && body.names.first_name) || '').trim();
  const email = (body.email || '').trim();

  if (!name || !email) {
    return res.status(400).json({
      errors: { name: ['Please provide valid name and email address.'] }
    });
  }

  return res.status(200).json({
    result: {
      message: 'Thank you for your application! Our recruitment team will review your profile and contact you soon.'
    }
  });
}
