<?php
/**
 * Contact Us - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Cinematic Parallax & Interactive Consultation Form
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Contact Engineering Office | Fescon (Pvt.) Ltd';
$current_page = 'contact';

require_once __DIR__ . '/includes/header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/heroes/hero-about.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-headset"></i> Direct Technical Channel
            </div>
            
            <h1 class="page-hero-title">
                Connect With Our <span class="highlight">Engineering Office</span>
            </h1>
            
            <p class="page-hero-subtitle">
                Whether you are planning a utility substation interconnect, high-voltage transmission line expansion, or complex industrial MEP infrastructure, our technical estimators and project directors are ready to assist.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Contact Us</span>
                <span class="count-tag">Headquarters in Islamabad, Pakistan</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     CONTACT DETAILS CARDS & INTERACTIVE FORM
========================================================= -->
<section style="background: #f8fafc; padding: 80px 0 100px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; align-items: start;">
            
            <!-- Left Column: Contact Cards & Info -->
            <div data-reveal style="display: flex; flex-direction: column; gap: 24px;">
                
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                    <h3 style="color: #0f172a; font-size: 1.4rem; font-weight: 700; margin: 0 0 20px; display: flex; align-items: center; gap: 12px;">
                        <span style="width: 10px; height: 10px; border-radius: 50%; background: #c62828;"></span>
                        Headquarters Information
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        
                        <!-- Location -->
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 style="color: #0f172a; font-size: 1rem; margin: 0 0 4px; font-weight: 600;">Corporate Office</h4>
                                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                                    Lahore, Punjab, Pakistan
                                </p>
                            </div>
                        </div>

                        <!-- Direct Phone -->
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 style="color: #0f172a; font-size: 1rem; margin: 0 0 4px; font-weight: 600;">Telephone Numbers</h4>
                                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                                    <a href="tel:+923041112766" style="color: #cbd5e1; text-decoration: none;">+92 304 111 2766</a><br>
                                    <a href="tel:+923008815488" style="color: #cbd5e1; text-decoration: none;">+92 300 881 5488</a>
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 style="color: #0f172a; font-size: 1rem; margin: 0 0 4px; font-weight: 600;">Direct Inquiries</h4>
                                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                                    <a href="mailto:info@fescon.com.pk" style="color: #cbd5e1; text-decoration: none;">info@fescon.com.pk</a>
                                </p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(198,40,40,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-business-time"></i>
                            </div>
                            <div>
                                <h4 style="color: #0f172a; font-size: 1rem; margin: 0 0 4px; font-weight: 600;">Office Hours</h4>
                                <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                                    Monday – Saturday: 09:00 AM – 06:00 PM (PKT)<br>
                                    <span style="color: #ef4444; font-size: 0.8rem;">* 24/7 Field Support on Active EPC Outages</span>
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- WhatsApp Quick Action -->
                    <div style="margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 24px;">
                        <a href="https://wa.me/923008815488" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; gap: 10px; background: #25D366; color: #0f172a; padding: 12px 20px; border-radius: 8px; font-weight: 700; font-size: 0.92rem; text-decoration: none; transition: opacity 0.2s;">
                            <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i>
                            <span>Chat on WhatsApp Directly</span>
                        </a>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); height: 260px;">
                    <iframe loading="lazy"
                            src="https://maps.google.com/maps?q=Lahore%2C%20Pakistan&t=m&z=13&output=embed&iwloc=near"
                            title="Lahore, Pakistan Map"
                            style="width: 100%; height: 100%; border: 0;"
                            allowfullscreen=""></iframe>
                </div>

            </div>

            <!-- Right Column: Interactive Consultation & Inquiries Form -->
            <div data-reveal style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="color: #c62828; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px;">
                    Technical Quotations &amp; Tenders
                </div>
                <h3 style="color: #0f172a; font-size: 1.6rem; font-weight: 800; margin: 0 0 12px;">
                    Send Us Your Project Requirements
                </h3>
                <p style="color: #94a3b8; font-size: 0.92rem; line-height: 1.6; margin: 0 0 28px;">
                    Fill out the form below. Our principal engineers will review your project specifications and respond within one business day.
                </p>

                <!-- Feedback Banner -->
                <div id="contact-form-alert" style="display: none; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-size: 0.92rem; font-weight: 500;"></div>

                <form id="fescon-contact-page-form" action="<?php echo $base_url; ?>/contact-handler.php" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px;">
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Your Name <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="e.g. Engr. Ahmad Khan" 
                                   style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none; transition: border-color 0.2s;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Official Email <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="e.g. name@company.com" 
                                   style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none; transition: border-color 0.2s;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px;">
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Phone / WhatsApp
                            </label>
                            <input type="tel" name="phone" placeholder="+92 300 0000000" 
                                   style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none; transition: border-color 0.2s;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Discipline / Subject <span style="color: #ef4444;">*</span>
                            </label>
                            <select name="subject" required style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none;">
                                <option value="EPC Grid Station Inquiry">EPC Grid Station &amp; Substation</option>
                                <option value="Transmission Line Inquiry">Energy Transmission &amp; Distribution</option>
                                <option value="Engineering Planning & Design">Engineering Planning &amp; Design</option>
                                <option value="Operation & Maintenance">Operation &amp; Maintenance</option>
                                <option value="MEP Solutions">MEP Infrastructure Solutions</option>
                                <option value="Civil Works Inquiry">Heavy Civil Works &amp; Foundations</option>
                                <option value="General Corporate Inquiry">General Corporate / Tender Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                            Project Description / Scope of Work <span style="color: #ef4444;">*</span>
                        </label>
                        <textarea name="message" rows="5" required placeholder="Please outline your project location, voltage class (e.g. 132kV / 220kV / 500kV), required timeline, and specific scope..." 
                                  style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none; resize: vertical;"></textarea>
                    </div>

                    <button type="submit" id="contact-submit-btn" style="background: #c62828; color: #fff; border: none; padding: 15px 30px; border-radius: 8px; font-size: 0.96rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 8px 24px rgba(198,40,40,0.35); transition: background 0.2s, transform 0.2s;">
                        <span>Submit Engineering Inquiry</span>
                        <i class="fas fa-paper-plane" style="font-size: 0.88rem;"></i>
                    </button>
                </form>

            </div>

        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('fescon-contact-page-form');
    const alertBox = document.getElementById('contact-form-alert');
    const btn = document.getElementById('contact-submit-btn');

    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
        alertBox.style.display = 'none';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<span>Submit Engineering Inquiry</span> <i class="fas fa-paper-plane"></i>';

            if (data.status === 'mail_sent') {
                alertBox.style.display = 'block';
                alertBox.style.background = 'rgba(34, 197, 94, 0.15)';
                alertBox.style.border = '1px solid rgba(34, 197, 94, 0.4)';
                alertBox.style.color = '#4ade80';
                alertBox.innerHTML = '<i class="fas fa-check-circle" style="margin-right: 8px;"></i> ' + data.message;
                form.reset();
            } else {
                alertBox.style.display = 'block';
                alertBox.style.background = 'rgba(239, 68, 68, 0.15)';
                alertBox.style.border = '1px solid rgba(239, 68, 68, 0.4)';
                alertBox.style.color = '#f87171';
                alertBox.innerHTML = '<i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i> ' + (data.message || 'Submission failed. Please check required fields.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<span>Submit Engineering Inquiry</span> <i class="fas fa-paper-plane"></i>';
            alertBox.style.display = 'block';
            alertBox.style.background = 'rgba(239, 68, 68, 0.15)';
            alertBox.style.border = '1px solid rgba(239, 68, 68, 0.4)';
            alertBox.style.color = '#f87171';
            alertBox.innerHTML = '<i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i> Unable to connect. Please try again or call us directly at +92 304 111 2766.';
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>