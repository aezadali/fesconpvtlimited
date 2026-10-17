export default async function handler(req, res) {
  res.setHeader('Content-Type', 'application/json; charset=utf-8');

  if (req.method !== 'POST') {
    return res.status(200).json({ status: 'ok', message: 'Contact endpoint ready.' });
  }

  const body = req.body || {};
  const name = (body['your-name'] || body.name || '').trim();
  const email = (body['your-email'] || body.email || '').trim();
  const unitTag = body['_wpcf7_unit_tag'] || '#wpcf7-f6-p175-o1';

  if (!name || !email) {
    return res.status(400).json({
      status: 'validation_failed',
      message: 'Please fill out all required fields with a valid email address.',
      invalid_fields: []
    });
  }

  return res.status(200).json({
    status: 'mail_sent',
    message: 'Thank you for your message. It has been sent.',
    into: unitTag
  });
}
