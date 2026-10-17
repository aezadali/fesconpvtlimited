export default async function handler(req, res) {
  res.setHeader('Content-Type', 'application/json; charset=utf-8');

  if (req.method !== 'POST') {
    return res.status(200).json({ status: 1, message: 'Sticky endpoint ready.' });
  }

  const body = req.body || {};
  const phone = (body['contact-form-phone'] || body.phone || '').trim();
  const email = (body['contact-form-email'] || body.email || '').trim();

  if (!phone || !email) {
    return res.status(200).json({
      status: 0,
      message: 'Please provide a valid phone number and email address.'
    });
  }

  return res.status(200).json({
    status: 1,
    message: 'Thank you for contacting us! We will get back to you shortly.'
  });
}
