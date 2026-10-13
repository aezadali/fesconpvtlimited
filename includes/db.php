<?php
/**
 * Database Connection & Seeding for Fescon (Pvt.) Ltd
 * Uses SQLite via PDO for portable, zero-configuration persistence.
 */

require_once __DIR__ . '/config.php';

function get_db() {
    static $pdo = null;
    if ($pdo === null) {
        $storageDir = __DIR__ . '/../storage';
        if (!is_dir($storageDir)) {
            @mkdir($storageDir, 0755, true);
        }
        $dbPath = $storageDir . '/database.sqlite';
        $isNew = !file_exists($dbPath);

        try {
            $pdo = new PDO('sqlite:' . $dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            init_database($pdo);
        } catch (PDOException $e) {
            die('Database Connection Error: ' . htmlspecialchars($e->getMessage()));
        }
    }
    return $pdo;
}

function init_database($pdo) {
    // 1. Users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        role TEXT DEFAULT 'admin',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Clients / Partners table (for Logo Slider & Collaborations)
    $pdo->exec("CREATE TABLE IF NOT EXISTS clients (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        slug TEXT UNIQUE NOT NULL,
        logo_url TEXT NOT NULL,
        website_url TEXT,
        description TEXT,
        sort_order INTEGER DEFAULT 0,
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 3. Services table
    $pdo->exec("CREATE TABLE IF NOT EXISTS services (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        slug TEXT UNIQUE NOT NULL,
        icon_class TEXT,
        image_url TEXT,
        short_description TEXT,
        full_description TEXT,
        sort_order INTEGER DEFAULT 0,
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 4. Projects table
    $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        slug TEXT UNIQUE NOT NULL,
        client_id INTEGER,
        service_id INTEGER,
        image_url TEXT NOT NULL,
        gallery_json TEXT,
        location TEXT,
        completion_year TEXT,
        status TEXT DEFAULT 'Completed',
        summary TEXT,
        description TEXT,
        featured INTEGER DEFAULT 0,
        sort_order INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL,
        FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
    )");

    // 5. Inquiries table
    $pdo->exec("CREATE TABLE IF NOT EXISTS inquiries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        type TEXT DEFAULT 'contact',
        name TEXT,
        email TEXT,
        phone TEXT,
        subject TEXT,
        message TEXT,
        page_source TEXT,
        is_read INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 6. Team Members / Employees table
    $pdo->exec("CREATE TABLE IF NOT EXISTS team_members (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        designation TEXT NOT NULL,
        department TEXT DEFAULT 'Engineering',
        image_url TEXT,
        email TEXT,
        phone TEXT,
        linkedin_url TEXT,
        bio TEXT,
        education TEXT,
        sort_order INTEGER DEFAULT 0,
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 7. Gallery Events table (Picture Gallery & Events)
    $pdo->exec("CREATE TABLE IF NOT EXISTS gallery_events (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT DEFAULT 'EPC Projects',
        event_date TEXT,
        location TEXT,
        description TEXT,
        cover_image TEXT,
        images TEXT,
        sort_order INTEGER DEFAULT 0,
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 8. Awards & Certificates table
    $pdo->exec("CREATE TABLE IF NOT EXISTS awards (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT DEFAULT 'Statutory Registration',
        year TEXT DEFAULT 'Active',
        issuer TEXT,
        image_url TEXT,
        description TEXT,
        sort_order INTEGER DEFAULT 0,
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Seed default Gallery Events if empty
    $checkEvents = $pdo->query("SELECT COUNT(*) FROM gallery_events")->fetchColumn();
    if ($checkEvents == 0) {
        $defaultEvents = [
            [
                'title' => 'Grid Station Construction & Commissioning',
                'category' => 'EPC Projects',
                'event_date' => '2025',
                'location' => 'Nationwide Projects',
                'description' => 'High-voltage 132kV and 220kV grid station construction including transformer installation, bay wiring, and pre-commissioning testing across multiple national sites.',
                'cover_image' => 'assets/images/DJI_0319-scaled.jpg',
                'images' => json_encode([
                    'assets/images/DJI_0319-scaled.jpg',
                    'assets/images/DJI_0323-scaled.jpg',
                    'assets/images/DJI_0371-scaled.jpg',
                    'assets/images/DJI_0378-scaled.jpg'
                ]),
                'sort_order' => 1
            ],
            [
                'title' => 'Transmission Line Stringing & Tower Erection',
                'category' => 'Transmission',
                'event_date' => '2025',
                'location' => 'Field Operations',
                'description' => 'Overhead transmission line stringing, lattice tower erection, and conductor sagging operations for high-voltage power distribution networks.',
                'cover_image' => 'assets/images/DJI_0371-1-scaled.jpg',
                'images' => json_encode([
                    'assets/images/DJI_0371-1-scaled.jpg',
                    'assets/images/DJI_0400-scaled.jpg',
                    'assets/images/IMG_4737-scaled.jpg',
                    'assets/images/IMG_4746-scaled.jpg'
                ]),
                'sort_order' => 2
            ],
            [
                'title' => 'Site Survey & Engineering Assessment',
                'category' => 'Planning',
                'event_date' => '2025',
                'location' => 'Project Sites',
                'description' => 'On-ground engineering surveys, topographical mapping, geotechnical assessments, and preliminary design reviews for upcoming infrastructure projects.',
                'cover_image' => 'assets/images/WhatsApp-Image-2025-02-27-at-4.18.58-AM.jpeg',
                'images' => json_encode([
                    'assets/images/WhatsApp-Image-2025-02-27-at-4.18.58-AM.jpeg',
                    'assets/images/WhatsApp-Image-2025-02-27-at-4.19.31-AM.jpeg',
                    'assets/images/WhatsApp-Image-2025-02-27-at-4.20.56-AM.jpeg',
                    'assets/images/WhatsApp-Image-2025-02-27-at-4.22.56-AM.jpeg'
                ]),
                'sort_order' => 3
            ],
            [
                'title' => 'Civil Works & Foundation Construction',
                'category' => 'Civil Works',
                'event_date' => '2025',
                'location' => 'Construction Sites',
                'description' => 'Heavy civil infrastructure including transformer pad casting, control room construction, boundary walls, cable trenching, and reinforced concrete foundations.',
                'cover_image' => 'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM.jpeg',
                'images' => json_encode([
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-1.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-2.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-3.jpeg'
                ]),
                'sort_order' => 4
            ],
            [
                'title' => 'Substation Equipment Installation',
                'category' => 'Electrical',
                'event_date' => '2025',
                'location' => 'Grid Stations',
                'description' => 'Installation and erection of power transformers, circuit breakers, current transformers, potential transformers, isolators, and bus-bar systems at grid substations.',
                'cover_image' => 'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-4.jpeg',
                'images' => json_encode([
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-4.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-6.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-8.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-9.jpeg'
                ]),
                'sort_order' => 5
            ],
            [
                'title' => 'Team Field Operations & Safety Practices',
                'category' => 'HSE',
                'event_date' => '2025',
                'location' => 'Active Sites',
                'description' => 'Engineering crews implementing strict HSE protocols, wearing certified PPE, and performing daily toolbox safety talks before commencing high-voltage field operations.',
                'cover_image' => 'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-11.jpeg',
                'images' => json_encode([
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-11.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-14.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-15.jpeg',
                    'assets/images/WhatsApp-Image-2025-01-23-at-2.20.16-AM-16.jpeg'
                ]),
                'sort_order' => 6
            ]
        ];

        $insEvent = $pdo->prepare("INSERT INTO gallery_events (title, category, event_date, location, description, cover_image, images, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($defaultEvents as $de) {
            $insEvent->execute([$de['title'], $de['category'], $de['event_date'], $de['location'], $de['description'], $de['cover_image'], $de['images'], $de['sort_order']]);
        }
    }

    // Seed default Awards if empty
    $checkAwards = $pdo->query("SELECT COUNT(*) FROM awards")->fetchColumn();
    if ($checkAwards == 0) {
        $defaultAwards = [
            [
                'title' => 'Pakistan Engineering Council (PEC) License',
                'category' => 'Statutory Registration',
                'year' => 'Active',
                'issuer' => 'Pakistan Engineering Council',
                'image_url' => 'assets/images/cer.png',
                'description' => 'Premier statutory category C-A (No-Limit) license authorizing turnkey execution of unlimited value electrical, civil, mechanical, and power infrastructure works across Pakistan.',
                'sort_order' => 1
            ],
            [
                'title' => 'ISO 9001:2015 — Quality Management System',
                'category' => 'International Certification',
                'year' => 'Certified',
                'issuer' => 'International Organization for Standardization',
                'image_url' => 'assets/images/img-1.png',
                'description' => 'Certified compliance for end-to-end engineering, procurement, construction management, and rigorous quality assurance across all project disciplines.',
                'sort_order' => 2
            ],
            [
                'title' => 'ISO 14001:2015 — Environmental Management',
                'category' => 'Environmental Standards',
                'year' => 'Certified',
                'issuer' => 'International Organization for Standardization',
                'image_url' => 'assets/images/img-2.png',
                'description' => 'International certification recognizing systematic environmental management, carbon footprint mitigation, and eco-friendly site procedures on all active projects.',
                'sort_order' => 3
            ],
            [
                'title' => 'ISO 45001:2018 — Occupational Health & Safety',
                'category' => 'Workplace Safety',
                'year' => 'Certified',
                'issuer' => 'International Organization for Standardization',
                'image_url' => 'assets/images/img-3.png',
                'description' => 'Gold-standard occupational safety framework safeguarding high-voltage electrical field technicians and construction personnel through comprehensive HSE protocols.',
                'sort_order' => 4
            ],
            [
                'title' => 'Power Utility Enlistments & Pre-Qualifications',
                'category' => 'National Enlistment',
                'year' => 'Active',
                'issuer' => 'NTDC / WAPDA / Distribution Companies',
                'image_url' => 'assets/images/img-4.png',
                'description' => 'Approved and pre-qualified EPC contractor for NTDC, WAPDA, IESCO, FESCO, GEPCO, LESCO, K-Electric, and other power utility organizations across Pakistan.',
                'sort_order' => 5
            ]
        ];

        $insAward = $pdo->prepare("INSERT INTO awards (title, category, year, issuer, image_url, description, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($defaultAwards as $da) {
            $insAward->execute([$da['title'], $da['category'], $da['year'], $da['issuer'], $da['image_url'], $da['description'], $da['sort_order']]);
        }
    }

    // Seed default admin user (admin / admin123)
    $checkUser = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($checkUser == 0) {
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, name, email, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            'admin',
            password_hash('admin123', PASSWORD_DEFAULT),
            'Fescon Administrator',
            'admin@fescon.com.pk',
            'admin'
        ]);
    }

    // Seed default Clients (the 7 logos in the slider)
    $checkClients = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
    if ($checkClients == 0) {
        $defaultClients = [
            [
                'name' => 'WAPDA (Water & Power Development Authority)',
                'slug' => 'wapda',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-1.png',
                'website_url' => 'http://www.wapda.gov.pk',
                'description' => 'Collaboration on major hydropower grid interconnects, substation engineering, and transmission feasibility studies.',
                'sort_order' => 1
            ],
            [
                'name' => 'NTDC (National Transmission & Despatch Company)',
                'slug' => 'ntdc',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-3.png',
                'website_url' => 'https://ntdc.gov.pk',
                'description' => 'Turnkey EPC grid station upgrades, 220kV/500kV line inspection, protection systems, and high-voltage transmission projects.',
                'sort_order' => 2
            ],
            [
                'name' => 'IESCO (Islamabad Electric Supply Company)',
                'slug' => 'iesco',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-2.png',
                'website_url' => 'https://iesco.com.pk',
                'description' => 'Urban electrical distribution network enhancement, 132kV grid augmentation, and feeder automation projects.',
                'sort_order' => 3
            ],
            [
                'name' => 'FESCO (Faisalabad Electric Supply Company)',
                'slug' => 'fesco',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-5.png',
                'website_url' => 'http://fesco.com.pk',
                'description' => 'Industrial zone power distribution infrastructure, transformer bay expansions, and civil foundation works.',
                'sort_order' => 4
            ],
            [
                'name' => 'GEPCO (Gujranwala Electric Power Company)',
                'slug' => 'gepco',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-4.png',
                'website_url' => 'http://gepco.com.pk',
                'description' => 'Engineering design, testing, commissioning, and preventive maintenance of medium-voltage distribution circuits.',
                'sort_order' => 5
            ],
            [
                'name' => 'LESCO (Lahore Electric Supply Company)',
                'slug' => 'lesco',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-6.png',
                'website_url' => 'https://lesco.gov.pk',
                'description' => 'Metropolitan high-density distribution planning, underground cabling, and MEP infrastructure works.',
                'sort_order' => 6
            ],
            [
                'name' => 'K-Electric (KE)',
                'slug' => 'k-electric',
                'logo_url' => '<?php echo $base_url; ?>/assets/images/logo-7.png',
                'website_url' => 'https://ke.com.pk',
                'description' => 'Specialized substation testing, power quality audits, and high-reliability industrial power distribution systems.',
                'sort_order' => 7
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO clients (name, slug, logo_url, website_url, description, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($defaultClients as $c) {
            $stmt->execute([$c['name'], $c['slug'], $c['logo_url'], $c['website_url'], $c['description'], $c['sort_order']]);
        }
    }

    // Seed Services
    $checkServices = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
    if ($checkServices == 0) {
        $defaultServices = [
            [
                'name' => 'Planning and Designing',
                'slug' => 'planning-and-designing',
                'icon_class' => 'fas fa-drafting-compass',
                'image_url' => '<?php echo $base_url; ?>/assets/images/transformer.webp',
                'short_description' => 'Innovative planning and designing for sustainable project success.',
                'full_description' => 'With years of engineering experience, Fescon offers comprehensive planning and design services covering electrical, structural, civil, and environmental engineering. We develop full turnkey schematics, load calculations, grid integration studies, and architectural blueprints adhering to international IEEE, IEC, and PEC standards.',
                'sort_order' => 1
            ],
            [
                'name' => 'EPC Projects',
                'slug' => 'epc-projects',
                'icon_class' => 'fas fa-hard-hat',
                'image_url' => '<?php echo $base_url; ?>/assets/images/DJI_0400-scaled.jpg',
                'short_description' => 'Turnkey Engineering, Procurement, and Construction delivery.',
                'full_description' => 'Complete end-to-end EPC project management for industrial complexes, grid stations, transmission lines, and civil infrastructure. From material sourcing and procurement to site erection, testing, and commissioning, we deliver on time and within budget.',
                'sort_order' => 2
            ],
            [
                'name' => 'Energy Transmission & Distribution',
                'slug' => 'energy-transmission-distribution',
                'icon_class' => 'fas fa-bolt',
                'image_url' => '<?php echo $base_url; ?>/assets/images/IMG_4737-scaled.jpg',
                'short_description' => 'High-voltage transmission lines, substations, and grid connectivity.',
                'full_description' => 'Design, erection, stringing, and testing of 11kV, 132kV, 220kV, and 500kV transmission lines and substations. We build robust power transmission infrastructure ensuring minimal losses and uninterrupted grid stability.',
                'sort_order' => 3
            ],
            [
                'name' => 'Operation & Maintenance',
                'slug' => 'operation-maintenance',
                'icon_class' => 'fas fa-tools',
                'image_url' => '<?php echo $base_url; ?>/assets/images/IMG_4615-scaled.jpg',
                'short_description' => 'Proactive maintenance, testing, and 24/7 technical facility support.',
                'full_description' => 'Comprehensive operation and lifecycle maintenance services for electrical systems, power transformers, switchgear, and civil assets. We ensure maximum uptime, regulatory compliance, and thermal/dielectric safety audits.',
                'sort_order' => 4
            ],
            [
                'name' => 'MEP Solutions',
                'slug' => 'mep-solutions',
                'icon_class' => 'fas fa-cogs',
                'image_url' => '<?php echo $base_url; ?>/assets/images/MEP-engineering2.jpg',
                'short_description' => 'Mechanical, Electrical, and Plumbing engineering for commercial & industrial facilities.',
                'full_description' => 'Integrated MEP engineering solutions including HVAC, electrical distribution, fire protection, plumbing systems, and smart building management for industrial plants, high-rises, and institutional facilities.',
                'sort_order' => 5
            ],
            [
                'name' => 'Civil Works',
                'slug' => 'civil-works',
                'icon_class' => 'fas fa-building',
                'image_url' => '<?php echo $base_url; ?>/assets/images/civil-construction-work.webp',
                'short_description' => 'Foundation engineering, control buildings, towers, and heavy structural construction.',
                'full_description' => 'Precision civil engineering works including equipment foundations for heavy transformers and turbines, transmission tower piles, control buildings, access roads, and stormwater drainage infrastructure.',
                'sort_order' => 6
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO services (name, slug, icon_class, image_url, short_description, full_description, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($defaultServices as $s) {
            $stmt->execute([$s['name'], $s['slug'], $s['icon_class'], $s['image_url'], $s['short_description'], $s['full_description'], $s['sort_order']]);
        }
    }

    // Seed Default Projects
    $checkProjects = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    if ($checkProjects == 0) {
        $defaultProjects = [
            [
                'title' => '220kV Grid Station Turnkey Augmentation',
                'slug' => '220kv-grid-station-augmentation',
                'client_slug' => 'ntdc',
                'service_slug' => 'energy-transmission-distribution',
                'image_url' => '<?php echo $base_url; ?>/assets/images/DJI_0378-scaled.jpg',
                'location' => 'Rawat, Punjab',
                'completion_year' => '2024',
                'status' => 'Completed',
                'summary' => 'Complete engineering, installation, and commissioning of new 220/132kV power transformer bays and control relays.',
                'description' => 'Fescon successfully executed the turnkey bay augmentation project for NTDC. The scope encompassed civil foundations for 160MVA autotransformers, high-voltage busbar erection, SF6 circuit breakers installation, state-of-the-art numerical protection relay panels, SCADA integration, and high-voltage dielectric testing under strict live grid safety procedures.',
                'featured' => 1
            ],
            [
                'title' => '132kV Double Circuit Transmission Line Stringing',
                'slug' => '132kv-double-circuit-transmission-line',
                'client_slug' => 'iesco',
                'service_slug' => 'epc-projects',
                'image_url' => '<?php echo $base_url; ?>/assets/images/DJI_0400-scaled.jpg',
                'location' => 'Islamabad Capital Territory',
                'completion_year' => '2023',
                'status' => 'Completed',
                'summary' => '32 km double circuit transmission line construction spanning mountainous and urban terrain.',
                'description' => 'Turnkey EPC project involving tower foundation piling in difficult soil conditions, steel lattice tower erection, conductor stringing, optical ground wire (OPGW) installation, and line energization with zero lost-time incidents.',
                'featured' => 1
            ],
            [
                'title' => 'Hydropower Substation Electrical Systems Upgrade',
                'slug' => 'hydropower-substation-upgrade',
                'client_slug' => 'wapda',
                'service_slug' => 'planning-and-designing',
                'image_url' => '<?php echo $base_url; ?>/assets/images/IMG_4737-scaled.jpg',
                'location' => 'Tarbela, KP',
                'completion_year' => '2023',
                'status' => 'Completed',
                'summary' => 'Comprehensive electrical system planning, protection coordination, and relay design.',
                'description' => 'Detailed electrical design and transient stability analysis for switchgear replacement, busbar protection refurbishment, and auxiliary station power systems for WAPDA generation facility.',
                'featured' => 1
            ],
            [
                'title' => 'Industrial Special Economic Zone Power Distribution',
                'slug' => 'sez-power-distribution-system',
                'client_slug' => 'fesco',
                'service_slug' => 'energy-transmission-distribution',
                'image_url' => '<?php echo $base_url; ?>/assets/images/transformer.webp',
                'location' => 'M-3 Industrial City, Faisalabad',
                'completion_year' => '2024',
                'status' => 'Completed',
                'summary' => '11kV underground and overhead feeder network covering 450 industrial manufacturing units.',
                'description' => 'Design, supply, and laying of 11kV cross-linked polyethylene (XLPE) insulated cables, pad-mounted switchgears, compact substations, and automated metering infrastructure (AMI) with remote SCADA telemetry.',
                'featured' => 1
            ],
            [
                'title' => 'Preventive Operation & Maintenance of 132kV Substation',
                'slug' => 'substation-preventive-maintenance',
                'client_slug' => 'gepco',
                'service_slug' => 'operation-maintenance',
                'image_url' => '<?php echo $base_url; ?>/assets/images/IMG_4615-scaled.jpg',
                'location' => 'Gujranwala, Punjab',
                'completion_year' => '2024',
                'status' => 'Ongoing',
                'summary' => '24/7 condition monitoring, dissolved gas analysis (DGA), and preventive servicing of critical high-voltage assets.',
                'description' => 'Comprehensive multi-year maintenance agreement including thermographic imaging, transformer oil filtration, breaker timing tests, contact resistance testing, and rapid emergency restoration services.',
                'featured' => 0
            ],
            [
                'title' => 'Commercial Complex MEP & Power Infrastructure',
                'slug' => 'commercial-complex-mep-infrastructure',
                'client_slug' => 'lesco',
                'service_slug' => 'mep-solutions',
                'image_url' => '<?php echo $base_url; ?>/assets/images/MEP-engineering2.jpg',
                'location' => 'Gulberg, Lahore',
                'completion_year' => '2023',
                'status' => 'Completed',
                'summary' => 'Complete mechanical, electrical, HVAC, and fire life-safety systems installation.',
                'description' => 'Full MEP package for a 16-story commercial center comprising chilled water HVAC plant, 2.5 MVA captive diesel generator backup, low-voltage switchboards, intelligent LED lighting control, and NFPA-compliant wet pipe sprinkler systems.',
                'featured' => 0
            ],
            [
                'title' => 'Heavy Transformer Foundation & Control Building Civil Works',
                'slug' => 'transformer-foundations-control-building',
                'client_slug' => 'k-electric',
                'service_slug' => 'civil-works',
                'image_url' => '<?php echo $base_url; ?>/assets/images/civil-construction-work.webp',
                'location' => 'Korangi Industrial Area, Karachi',
                'completion_year' => '2023',
                'status' => 'Completed',
                'summary' => 'Heavy reinforced concrete equipment pad construction and blast-resistant switchgear building.',
                'description' => 'Excavation, piling, and casting of heavy RCC foundations engineered for 250-ton power transformers with oil-containment sumps, blast-deflection firewall barriers, and earthquake-resistant control room building construction.',
                'featured' => 0
            ],
            [
                'title' => 'Solar Hybrid Microgrid & Battery Storage EPC',
                'slug' => 'solar-hybrid-microgrid-epc',
                'client_slug' => 'wapda',
                'service_slug' => 'epc-projects',
                'image_url' => '<?php echo $base_url; ?>/assets/images/cosumnes.jpg',
                'location' => 'Chitral, KP',
                'completion_year' => '2024',
                'status' => 'Completed',
                'summary' => '2.5 MWp solar photovoltaic plant with 5 MWh battery energy storage for off-grid community reliability.',
                'description' => 'Complete EPC implementation of a rugged high-altitude solar microgrid, including structural steel mounting, inverter stations, lithium iron phosphate battery racks, bidirectional synchronization controllers, and distribution feeders.',
                'featured' => 1
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO projects (title, slug, client_id, service_id, image_url, location, completion_year, status, summary, description, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $clientsMap = [];
        foreach ($pdo->query("SELECT id, slug FROM clients")->fetchAll() as $row) {
            $clientsMap[$row['slug']] = $row['id'];
        }
        $servicesMap = [];
        foreach ($pdo->query("SELECT id, slug FROM services")->fetchAll() as $row) {
            $servicesMap[$row['slug']] = $row['id'];
        }

        foreach ($defaultProjects as $p) {
            $cId = $clientsMap[$p['client_slug']] ?? null;
            $sId = $servicesMap[$p['service_slug']] ?? null;
            $stmt->execute([
                $p['title'],
                $p['slug'],
                $cId,
                $sId,
                $p['image_url'],
                $p['location'],
                $p['completion_year'],
                $p['status'],
                $p['summary'],
                $p['description'],
                $p['featured']
            ]);
        }
    }

    // Seed Default Team Members
    $checkTeam = $pdo->query("SELECT COUNT(*) FROM team_members")->fetchColumn();
    if ($checkTeam == 0) {
        $defaultTeam = [
            [
                'name' => 'Engr. Ehsan Ullah',
                'designation' => 'Chief Executive Officer (CEO)',
                'department' => 'Executive Leadership',
                'image_url' => '<?php echo $base_url; ?>/assets/images/ceo.png',
                'email' => 'ceo@fescon.com.pk',
                'phone' => '+92 51 1234567',
                'education' => 'B.Sc. Electrical Engineering, PEC Registered Professional Engineer',
                'bio' => 'Visionary engineering executive leading Fescon since 2014. Expert in high-voltage transmission, EPC power infrastructure, and multidisciplinary engineering teams.',
                'sort_order' => 1
            ],
            [
                'name' => 'Munir Hashmi',
                'designation' => 'Executive Director (BD & Ops)',
                'department' => 'Business Development',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'munir.hashmi@fescon.com.pk',
                'phone' => '+92 51 1234568',
                'education' => 'M.Sc. Engineering Management',
                'bio' => 'Over 20 years of experience driving large-scale utility collaborations with NTDC, WAPDA, and DISCOs across Pakistan.',
                'sort_order' => 2
            ],
            [
                'name' => 'Engr. Abdul Mutlib',
                'designation' => 'Sr. Engineer – Civil',
                'department' => 'Civil Infrastructure',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'abdul.mutlib@fescon.com.pk',
                'phone' => '+92 51 1234569',
                'education' => 'B.Sc. Civil Engineering, PEC',
                'bio' => 'Specializes in heavy equipment foundations, transmission line tower foundations, and industrial facility structures.',
                'sort_order' => 3
            ],
            [
                'name' => 'Engr. M. Taimoor',
                'designation' => 'Sr. Engineer – Electrical',
                'department' => 'Electrical Engineering',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'm.taimoor@fescon.com.pk',
                'phone' => '+92 51 1234570',
                'education' => 'B.Sc. Electrical Engineering, PEC',
                'bio' => 'Lead engineer for substation bay augmentation, high-voltage switchgear testing, and protection coordination.',
                'sort_order' => 4
            ],
            [
                'name' => 'Engr. Ghulam Muhammad',
                'designation' => 'Project Manager',
                'department' => 'EPC Projects',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'ghulam.muhammad@fescon.com.pk',
                'phone' => '+92 51 1234571',
                'education' => 'M.Sc. Project Management, B.Sc. Engineering, PMP',
                'bio' => 'Oversees turnkey EPC project execution, supply chain logistics, on-site HSE compliance, and on-time commissioning.',
                'sort_order' => 5
            ],
            [
                'name' => 'Engr. Rana M. Usman Khan',
                'designation' => 'Sr. Engineer – Technical',
                'department' => 'Technical & Planning',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'usman.khan@fescon.com.pk',
                'phone' => '+92 51 1234572',
                'education' => 'B.Sc. Electrical Engineering, PEC',
                'bio' => 'Technical design lead handling grid simulations, load-flow studies, relay calculations, and quality assurance audits.',
                'sort_order' => 6
            ],
            [
                'name' => 'Mr. Faisal Hameed Ch.',
                'designation' => 'Manager Commercial',
                'department' => 'Commercial & Contracts',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'faisal.hameed@fescon.com.pk',
                'phone' => '+92 51 1234573',
                'education' => 'MBA Commercial Operations',
                'bio' => 'Manages contract negotiations, vendor procurement, regulatory compliance, and client contractual governance.',
                'sort_order' => 7
            ],
            [
                'name' => 'Hafiz Shoib Ahmad Farooqi',
                'designation' => 'Manager Accounts & Finance',
                'department' => 'Finance & Accounts',
                'image_url' => '<?php echo $base_url; ?>/assets/images/placeholder.svg',
                'email' => 'finance@fescon.com.pk',
                'phone' => '+92 51 1234574',
                'education' => 'Chartered Certified / M.Com Finance',
                'bio' => 'Head of financial operations, fiscal management, project cost accounting, and treasury management at Fescon.',
                'sort_order' => 8
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO team_members (name, designation, department, image_url, email, phone, education, bio, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($defaultTeam as $t) {
            $stmt->execute([
                $t['name'],
                $t['designation'],
                $t['department'],
                $t['image_url'],
                $t['email'],
                $t['phone'],
                $t['education'],
                $t['bio'],
                $t['sort_order']
            ]);
        }
    }
}

// -------------------------------------------------------------
// Helper Query Functions
// -------------------------------------------------------------

function get_all_clients($activeOnly = true) {
    $db = get_db();
    $sql = "SELECT c.*, (SELECT COUNT(*) FROM projects p WHERE p.client_id = c.id) AS project_count 
            FROM clients c ";
    if ($activeOnly) $sql .= "WHERE c.is_active = 1 ";
    $sql .= "ORDER BY c.sort_order ASC, c.id ASC";
    return $db->query($sql)->fetchAll();
}

function get_client_by_slug($slug) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM clients WHERE slug = ? LIMIT 1");
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

function get_client_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM clients WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function get_all_services($activeOnly = true) {
    $db = get_db();
    $sql = "SELECT s.*, (SELECT COUNT(*) FROM projects p WHERE p.service_id = s.id) AS project_count 
            FROM services s ";
    if ($activeOnly) $sql .= "WHERE s.is_active = 1 ";
    $sql .= "ORDER BY s.sort_order ASC, s.id ASC";
    return $db->query($sql)->fetchAll();
}

function get_service_by_slug($slug) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM services WHERE slug = ? LIMIT 1");
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

function get_service_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM services WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function get_service_features($slug) {
    $features_map = [
        'planning-and-designing' => [
            'Structural & Electrical Load Calculations',
            '3D CAD Modeling & Architectural Schematics',
            'Grid Interconnection & Feasibility Studies'
        ],
        'epc-projects' => [
            'End-to-End Procurement & Material Sourcing',
            'Turnkey Substation & Plant Construction',
            'Pre-Commissioning Testing & Full Handover'
        ],
        'energy-transmission-distribution' => [
            '11kV to 500kV High-Voltage Transmission Lines',
            'Grid Station Bay Erection & Transformer Cabling',
            'Conductor Stringing, Tower Piling & Sagging'
        ],
        'operation-maintenance' => [
            '24/7 Facility Monitoring & Emergency Restoration',
            'Thermal Imaging, Dielectric & Protection Audits',
            'Switchgear, Breaker & Transformer Overhauls'
        ],
        'mep-solutions' => [
            'Industrial HVAC & Centralized Climate Systems',
            'Fire Fighting, Hydrant & NFPA Alarm Networks',
            'Heavy Power Distribution & Building Automation'
        ],
        'civil-works' => [
            'Heavy Machine Foundations & Concrete Piling',
            'Substation Control Buildings & Structural Sheds',
            'Drainage Systems, Cable Trenches & Retaining Walls'
        ]
    ];

    return $features_map[$slug] ?? [
        'Turnkey Technical Engineering Execution',
        'International IEEE / IEC Standards Compliance',
        'Rigorous Quality & HSE Certified Protocols'
    ];
}

function get_projects($filters = []) {
    $db = get_db();
    $sql = "SELECT p.*, c.name AS client_name, c.slug AS client_slug, c.logo_url AS client_logo,
                   s.name AS service_name, s.slug AS service_slug, s.icon_class AS service_icon
            FROM projects p
            LEFT JOIN clients c ON p.client_id = c.id
            LEFT JOIN services s ON p.service_id = s.id
            WHERE 1=1 ";
    $params = [];

    if (!empty($filters['client_id'])) {
        $sql .= "AND p.client_id = ? ";
        $params[] = $filters['client_id'];
    }
    if (!empty($filters['client_slug'])) {
        $sql .= "AND c.slug = ? ";
        $params[] = $filters['client_slug'];
    }
    if (!empty($filters['service_id'])) {
        $sql .= "AND p.service_id = ? ";
        $params[] = $filters['service_id'];
    }
    if (!empty($filters['service_slug'])) {
        $sql .= "AND s.slug = ? ";
        $params[] = $filters['service_slug'];
    }
    if (!empty($filters['featured'])) {
        $sql .= "AND p.featured = 1 ";
    }
    if (!empty($filters['status'])) {
        $sql .= "AND p.status = ? ";
        $params[] = $filters['status'];
    }

    $sql .= "ORDER BY p.sort_order ASC, p.id DESC";

    if (!empty($filters['limit'])) {
        $sql .= " LIMIT " . intval($filters['limit']);
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_project_by_slug($slug) {
    $db = get_db();
    $stmt = $db->prepare("SELECT p.*, c.name AS client_name, c.slug AS client_slug, c.logo_url AS client_logo,
                                 s.name AS service_name, s.slug AS service_slug, s.icon_class AS service_icon
                          FROM projects p
                          LEFT JOIN clients c ON p.client_id = c.id
                          LEFT JOIN services s ON p.service_id = s.id
                          WHERE p.slug = ? LIMIT 1");
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

function get_project_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT p.*, c.name AS client_name, c.slug AS client_slug, c.logo_url AS client_logo,
                                 s.name AS service_name, s.slug AS service_slug, s.icon_class AS service_icon
                          FROM projects p
                          LEFT JOIN clients c ON p.client_id = c.id
                          LEFT JOIN services s ON p.service_id = s.id
                          WHERE p.id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

// -------------------------------------------------------------
// Team Members Helpers
// -------------------------------------------------------------

function get_all_team_members($activeOnly = true, $department = null) {
    $db = get_db();
    $sql = "SELECT * FROM team_members WHERE 1=1 ";
    $params = [];
    if ($activeOnly) {
        $sql .= "AND is_active = 1 ";
    }
    if (!empty($department)) {
        $sql .= "AND department = ? ";
        $params[] = $department;
    }
    $sql .= "ORDER BY sort_order ASC, id ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_team_member_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM team_members WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function get_team_departments() {
    $db = get_db();
    return $db->query("SELECT DISTINCT department FROM team_members WHERE department IS NOT NULL AND department != '' ORDER BY department ASC")->fetchAll(PDO::FETCH_COLUMN);
}

// -------------------------------------------------------------
// Gallery Events Helpers
// -------------------------------------------------------------

function get_all_gallery_events($activeOnly = true, $category = null) {
    $db = get_db();
    $sql = "SELECT * FROM gallery_events WHERE 1=1 ";
    $params = [];
    if ($activeOnly) {
        $sql .= "AND is_active = 1 ";
    }
    if (!empty($category)) {
        $sql .= "AND category = ? ";
        $params[] = $category;
    }
    $sql .= "ORDER BY sort_order ASC, id ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_gallery_event_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM gallery_events WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function get_gallery_categories() {
    $db = get_db();
    return $db->query("SELECT DISTINCT category FROM gallery_events WHERE category IS NOT NULL AND category != '' ORDER BY category ASC")->fetchAll(PDO::FETCH_COLUMN);
}

// -------------------------------------------------------------
// Awards & Certificates Helpers
// -------------------------------------------------------------

function get_all_awards($activeOnly = true, $category = null) {
    $db = get_db();
    $sql = "SELECT * FROM awards WHERE 1=1 ";
    $params = [];
    if ($activeOnly) {
        $sql .= "AND is_active = 1 ";
    }
    if (!empty($category)) {
        $sql .= "AND category = ? ";
        $params[] = $category;
    }
    $sql .= "ORDER BY sort_order ASC, id ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_award_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM awards WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function get_award_categories() {
    $db = get_db();
    return $db->query("SELECT DISTINCT category FROM awards WHERE category IS NOT NULL AND category != '' ORDER BY category ASC")->fetchAll(PDO::FETCH_COLUMN);
}
?>
