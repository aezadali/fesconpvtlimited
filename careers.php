<?php
/**
 * Careers - Fescon (Pvt.) Ltd
 * Modern Corporate Design Theme with Cinematic Parallax & Interactive Job Application Form
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$page_title = 'Careers & Engineering Opportunities | Fescon (Pvt.) Ltd';
$current_page = 'careers';

require_once __DIR__ . '/includes/header.php';
?>

<!-- =========================================================
     UNIFIED LIGHT SUBPAGE HERO BANNER
========================================================= -->
<section class="page-hero">
    <div class="page-hero-bg" style="background-image: url('<?php echo asset_url('assets/images/IMG_4615-scaled.jpg'); ?>');"></div>
    <div class="page-hero-overlay"></div>
    <div class="container">
        <div class="page-hero-inner" data-reveal>
            <div class="page-hero-badge">
                <i class="fas fa-briefcase"></i> Join Our Engineering Team
            </div>
            
            <h1 class="page-hero-title">
                Build Your Future in <span class="highlight">Power Infrastructure</span>
            </h1>
            
            <p class="page-hero-subtitle">
                At Fescon, our people are our greatest strength. We offer ambitious engineers and skilled technicians the opportunity to work on Pakistan's most critical grid interconnects and high-voltage transmission projects.
            </p>
            
            <div class="page-hero-breadcrumbs">
                <a href="<?php echo $base_url; ?>/">Home</a>
                <span class="sep">/</span>
                <span class="current">Careers</span>
                <span class="count-tag">Equal Opportunity Employer &bull; PEC CPD Certified</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     WHY GROW WITH FESCON
========================================================= -->
<section style="background: var(--bg-light-alt); padding: 70px 0 30px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;" data-reveal>
            
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: #c62828; font-size: 1.35rem; margin-bottom: 16px;">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.15rem; margin: 0 0 10px; font-weight: 700;">High-Voltage Exposure</h3>
                <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Hands-on experience with 132kV, 220kV, and 500kV substations, power transformers, SF6 gas-insulated switchgear, and overhead line stringing.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: #c62828; font-size: 1.35rem; margin-bottom: 16px;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.15rem; margin: 0 0 10px; font-weight: 700;">Professional Growth</h3>
                <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Structured training programs supporting PEC Professional Engineer registration, Project Management Professional (PMP) accreditations, and advanced field testing skills.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: #c62828; font-size: 1.35rem; margin-bottom: 16px;">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.15rem; margin: 0 0 10px; font-weight: 700;">Safety First (HSE)</h3>
                <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Uncompromised health and safety protocols backed by ISO 45001 certification. Every site member receives certified PPE and arc-flash training.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(198,40,40,0.12); display: flex; align-items: center; justify-content: center; color: #c62828; font-size: 1.35rem; margin-bottom: 16px;">
                    <i class="fas fa-award"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.15rem; margin: 0 0 10px; font-weight: 700;">Meritocracy &amp; Care</h3>
                <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    Competitive remuneration, performance milestone bonuses, health insurance, and transparent career advancement pathways.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================
     OPEN POSITIONS & APPLICATION FORM
========================================================= -->
<section style="background: #f8fafc; padding: 60px 0 100px; position: relative;">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 40px; align-items: start;">
            
            <!-- Left: Current Vacancies -->
            <div data-reveal style="display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <div style="color: #c62828; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px;">
                        Open Opportunities
                    </div>
                    <h3 style="color: #0f172a; font-size: 1.6rem; font-weight: 800; margin: 0 0 12px;">
                        Current Available Roles
                    </h3>
                    <p style="color: #94a3b8; font-size: 0.92rem; line-height: 1.6; margin: 0 0 20px;">
                        Select a position that matches your engineering background or submit an open application for our national roster.
                    </p>
                </div>

                <!-- Job Card 1 -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); cursor: pointer; transition: border-color 0.2s;" onclick="selectPosition('Senior Substation Electrical Engineer')">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <h4 style="color: #0f172a; font-size: 1.1rem; margin: 0; font-weight: 700;">Sr. Electrical Engineer (Substations)</h4>
                        <span style="background: rgba(198,40,40,0.18); color: #ff6b6b; font-size: 0.72rem; font-weight: 700; padding: 4px 8px; border-radius: 4px;">Full Time</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 0.82rem; margin-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="color: #ef4444; margin-right: 5px;"></i> Lahore / Field Deployments &bull; 5+ Years Exp.
                    </div>
                    <p style="color: #cbd5e1; font-size: 0.85rem; line-height: 1.55; margin: 0;">
                        Oversee site erection, bay wiring, transformer installation, and pre-commissioning testing of 132/220kV grid stations.
                    </p>
                </div>

                <!-- Job Card 2 -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); cursor: pointer; transition: border-color 0.2s;" onclick="selectPosition('Testing & Commissioning Engineer')">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <h4 style="color: #0f172a; font-size: 1.1rem; margin: 0; font-weight: 700;">Testing &amp; Commissioning Engineer</h4>
                        <span style="background: rgba(198,40,40,0.18); color: #ff6b6b; font-size: 0.72rem; font-weight: 700; padding: 4px 8px; border-radius: 4px;">Full Time</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 0.82rem; margin-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="color: #ef4444; margin-right: 5px;"></i> Nationwide Projects &bull; 3+ Years Exp.
                    </div>
                    <p style="color: #cbd5e1; font-size: 0.85rem; line-height: 1.55; margin: 0;">
                        Secondary injection testing, protection relay configuration (SEL, ABB, Siemens), and CT/PT ratio verification.
                    </p>
                </div>

                <!-- Job Card 3 -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); cursor: pointer; transition: border-color 0.2s;" onclick="selectPosition('Civil Works Engineer')">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <h4 style="color: #0f172a; font-size: 1.1rem; margin: 0; font-weight: 700;">Civil Structural Engineer (Power Foundations)</h4>
                        <span style="background: rgba(198,40,40,0.18); color: #ff6b6b; font-size: 0.72rem; font-weight: 700; padding: 4px 8px; border-radius: 4px;">Full Time</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 0.82rem; margin-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="color: #ef4444; margin-right: 5px;"></i> Site Base &bull; 4+ Years Exp.
                    </div>
                    <p style="color: #cbd5e1; font-size: 0.85rem; line-height: 1.55; margin: 0;">
                        Supervise transformer pad casting, control room construction, tower foundation piling, and QA/QC slump testing.
                    </p>
                </div>

            </div>

            <!-- Right: Application Submission Form -->
            <div data-reveal style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="color: #c62828; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px;">
                    Career Application
                </div>
                <h3 style="color: #0f172a; font-size: 1.6rem; font-weight: 800; margin: 0 0 12px;">
                    Submit Your Profile
                </h3>
                <p style="color: #94a3b8; font-size: 0.92rem; line-height: 1.6; margin: 0 0 28px;">
                    Submit your credentials and CV. Our HR and talent acquisition department will review your application promptly.
                </p>

                <div id="careers-form-alert" style="display: none; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-size: 0.92rem; font-weight: 500;"></div>

                <form id="fescon-career-form" action="<?php echo $base_url; ?>/careers-handler.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 18px;">
                    
                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                            Full Name <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="name" required placeholder="e.g. Engr. Usman Tariq" 
                               style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none;">
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 18px;">
                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Email Address <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="usman@example.com" 
                                   style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                                Phone Number <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="tel" name="phone" required placeholder="+92 300 1234567" 
                                   style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                            Position Applied For <span style="color: #ef4444;">*</span>
                        </label>
                        <select id="career-position-select" name="position" required style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none;">
                            <option value="Senior Substation Electrical Engineer">Senior Substation Electrical Engineer</option>
                            <option value="Testing & Commissioning Engineer">Testing &amp; Commissioning Engineer</option>
                            <option value="Civil Works Engineer">Civil Structural Engineer (Power Foundations)</option>
                            <option value="Project Planning Engineer">Project Planning &amp; Scheduling Engineer</option>
                            <option value="Transmission Line Stringing Supervisor">Transmission Line Stringing Supervisor</option>
                            <option value="HSE Safety Officer">HSE Field Safety Officer</option>
                            <option value="General Engineering Roster">General Engineering Roster / Other</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                            Upload CV / Resume (PDF or DOCX) <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="file" name="resume" required accept=".pdf,.doc,.docx" 
                               style="width: 100%; box-sizing: border-box; background: #f8fafc; border: 1px dashed #cbd5e1; color: #64748b; padding: 14px; border-radius: 8px; font-size: 0.88rem; outline: none; cursor: pointer;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #cbd5e1; margin-bottom: 6px;">
                            Professional Summary / Cover Note
                        </label>
                        <textarea name="message" rows="4" placeholder="Briefly highlight your engineering qualifications, PEC number, and relevant utility project experience..." 
                                  style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; color: #0f172a; padding: 12px 14px; border-radius: 8px; font-size: 0.92rem; outline: none; resize: vertical;"></textarea>
                    </div>

                    <button type="submit" id="career-submit-btn" style="background: #c62828; color: #fff; border: none; padding: 15px 30px; border-radius: 8px; font-size: 0.96rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 8px 24px rgba(198,40,40,0.35); transition: background 0.2s;">
                        <span>Submit Job Application</span>
                        <i class="fas fa-paper-plane" style="font-size: 0.88rem;"></i>
                    </button>
                </form>

            </div>

        </div>

    </div>
</section>

<script>
function selectPosition(posName) {
    const sel = document.getElementById('career-position-select');
    if (sel) {
        for (let i = 0; i < sel.options.length; i++) {
            if (sel.options[i].value === posName) {
                sel.selectedIndex = i;
                sel.scrollIntoView({ behavior: 'smooth', block: 'center' });
                break;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('fescon-career-form');
    const alertBox = document.getElementById('careers-form-alert');
    const btn = document.getElementById('career-submit-btn');

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
            btn.innerHTML = '<span>Submit Job Application</span> <i class="fas fa-paper-plane"></i>';

            if (data.result && data.result.message) {
                alertBox.style.display = 'block';
                alertBox.style.background = 'rgba(34, 197, 94, 0.15)';
                alertBox.style.border = '1px solid rgba(34, 197, 94, 0.4)';
                alertBox.style.color = '#4ade80';
                alertBox.innerHTML = '<i class="fas fa-check-circle" style="margin-right: 8px;"></i> ' + data.result.message;
                form.reset();
            } else if (data.errors) {
                alertBox.style.display = 'block';
                alertBox.style.background = 'rgba(239, 68, 68, 0.15)';
                alertBox.style.border = '1px solid rgba(239, 68, 68, 0.4)';
                alertBox.style.color = '#f87171';
                alertBox.innerHTML = '<i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i> Please fill out all required fields with a valid email.';
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<span>Submit Job Application</span> <i class="fas fa-paper-plane"></i>';
            alertBox.style.display = 'block';
            alertBox.style.background = 'rgba(239, 68, 68, 0.15)';
            alertBox.style.border = '1px solid rgba(239, 68, 68, 0.4)';
            alertBox.style.color = '#f87171';
            alertBox.innerHTML = '<i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i> Application submitted. Our HR department will review your details.';
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>