<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSTRUCTION22 | Customer Affairs Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Industrial Color Palette */
            --industrial-dark: #1a2a3a;
            --industrial-darker: #0e1a24;
            --industrial-steel: #4a5d70;
            --industrial-metal: #6d8299;
            --industrial-highlight: #a9c9e5;
            --industrial-light: #e8ecef;
            --industrial-primary: #1a5276;
            --industrial-secondary: #7f8c8d;
            --industrial-success: #2e7d32;
            --industrial-warning: #f4a261;
            --industrial-danger: #d32f2f;
        }

        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--industrial-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .industrial-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .industrial-header {
            background: linear-gradient(135deg, var(--industrial-dark), var(--industrial-darker));
            color: white;
            padding: 15px 0;
            border-bottom: 3px solid var(--industrial-highlight);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .industrial-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .industrial-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .industrial-logo i {
            margin-right: 10px;
            color: var(--industrial-highlight);
        }

        .industrial-nav-links {
            display: flex;
            gap: 25px;
        }

        .industrial-nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: color 0.3s;
            position: relative;
        }

        .industrial-nav-link:hover {
            color: var(--industrial-highlight);
        }

        .industrial-nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--industrial-highlight);
            transition: width 0.3s;
        }

        .industrial-nav-link:hover::after {
            width: 100%;
        }

        .industrial-auth-buttons .btn {
            margin-left: 15px;
        }

        /* Hero Section */
        .industrial-hero {
            background: linear-gradient(rgba(26, 42, 58, 0.9), rgba(26, 42, 58, 0.9)), 
                        url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .industrial-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .industrial-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }

        /* Features Section */
        .industrial-features {
            padding: 80px 0;
            background-color: white;
        }

        .industrial-section-title {
            text-align: center;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--industrial-dark);
            position: relative;
        }

        .industrial-section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background-color: var(--industrial-highlight);
            margin: 15px auto 0;
        }

        .industrial-features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .industrial-feature-card {
            background-color: var(--industrial-light);
            border-radius: 5px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid var(--industrial-highlight);
        }

        .industrial-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .industrial-feature-icon {
            font-size: 2.5rem;
            color: var(--industrial-primary);
            margin-bottom: 20px;
        }

        .industrial-feature-card h3 {
            margin-bottom: 15px;
            color: var(--industrial-dark);
        }

        /* Stats Section */
        .industrial-stats {
            background: linear-gradient(135deg, var(--industrial-steel), var(--industrial-dark));
            color: white;
            padding: 60px 0;
        }

        .industrial-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }

        .industrial-stat-item {
            padding: 20px;
        }

        .industrial-stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--industrial-highlight);
        }

        .industrial-stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* CTA Section */
        .industrial-cta {
            background-color: var(--industrial-light);
            padding: 80px 0;
            text-align: center;
        }

        .industrial-cta h2 {
            margin-bottom: 30px;
            color: var(--industrial-dark);
        }

        /* Footer */
        .industrial-footer {
            background-color: var(--industrial-dark);
            color: white;
            padding: 50px 0 20px;
        }

        .industrial-footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .industrial-footer-column h3 {
            color: var(--industrial-highlight);
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .industrial-footer-links {
            list-style: none;
            padding: 0;
        }

        .industrial-footer-links li {
            margin-bottom: 10px;
        }

        .industrial-footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .industrial-footer-links a:hover {
            color: var(--industrial-highlight);
        }

        .industrial-footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid var(--industrial-steel);
            font-size: 0.8rem;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 3px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-industrial-primary {
            background-color: var(--industrial-primary);
            color: white;
            border: none;
        }

        .btn-industrial-primary:hover {
            background-color: #154360;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-industrial-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-industrial-secondary:hover {
            background-color: white;
            color: var(--industrial-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .industrial-nav {
                flex-direction: column;
                gap: 20px;
            }

            .industrial-nav-links {
                flex-direction: column;
                gap: 15px;
                align-items: center;
            }

            .industrial-auth-buttons {
                margin-top: 20px;
            }

            .industrial-hero h1 {
                font-size: 2.2rem;
            }

            .industrial-hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="industrial-header">
        <div class="industrial-container">
            <nav class="industrial-nav">
                <div class="industrial-logo">
                    <i class="fas fa-cogs"></i>
                    <span>CONSTRUCTION22</span>
                </div>
                <div class="industrial-nav-links">
                    <a href="#" class="industrial-nav-link">Dashboard</a>
                    <a href="#" class="industrial-nav-link">Cases</a>
                    <a href="#" class="industrial-nav-link">Customers</a>
                    <a href="#" class="industrial-nav-link">Reports</a>
                    <a href="#" class="industrial-nav-link">Settings</a>
                </div>
                <div class="industrial-auth-buttons">
                    <a href="#" class="btn btn-industrial-secondary">Login</a>
                    <a href="#" class="btn btn-industrial-primary">Register</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="industrial-hero">
        <div class="industrial-container">
            <h1>Customer Affairs Management System</h1>
            <p>Streamline your customer service operations with our industrial-grade solution designed for efficiency, reliability, and superior customer experience.</p>
            <a href="#" class="btn btn-industrial-primary">Get Started</a>
            <a href="#" class="btn btn-industrial-secondary">Learn More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="industrial-features">
        <div class="industrial-container">
            <h2 class="industrial-section-title">Key Features</h2>
            <div class="industrial-features-grid">
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Case Management</h3>
                    <p>Track, prioritize, and resolve customer issues efficiently with our robust case management system.</p>
                </div>
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Real-time Analytics</h3>
                    <p>Gain actionable insights with comprehensive dashboards and reporting tools.</p>
                </div>
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>AI Automation</h3>
                    <p>Leverage artificial intelligence to automate routine tasks and improve response times.</p>
                </div>
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Omnichannel Support</h3>
                    <p>Manage customer interactions across multiple channels from a single platform.</p>
                </div>
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Enterprise Security</h3>
                    <p>Military-grade encryption and compliance with industry security standards.</p>
                </div>
                <div class="industrial-feature-card">
                    <div class="industrial-feature-icon">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3>API Integrations</h3>
                    <p>Seamlessly connect with your existing business systems and applications.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="industrial-stats">
        <div class="industrial-container">
            <div class="industrial-stats-grid">
                <div class="industrial-stat-item">
                    <div class="industrial-stat-number">10,000+</div>
                    <div class="industrial-stat-label">Happy Customers</div>
                </div>
                <div class="industrial-stat-item">
                    <div class="industrial-stat-number">24/7</div>
                    <div class="industrial-stat-label">Support Availability</div>
                </div>
                <div class="industrial-stat-item">
                    <div class="industrial-stat-number">99.9%</div>
                    <div class="industrial-stat-label">Uptime Guarantee</div>
                </div>
                <div class="industrial-stat-item">
                    <div class="industrial-stat-number">45+</div>
                    <div class="industrial-stat-label">Countries Served</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="industrial-cta">
        <div class="industrial-container">
            <h2>Ready to Transform Your Customer Service Operations?</h2>
            <a href="#" class="btn btn-industrial-primary">Request Demo</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="industrial-footer">
        <div class="industrial-container">
            <div class="industrial-footer-grid">
                <div class="industrial-footer-column">
                    <h3>Product</h3>
                    <ul class="industrial-footer-links">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Integrations</a></li>
                        <li><a href="#">Roadmap</a></li>
                    </ul>
                </div>
                <div class="industrial-footer-column">
                    <h3>Resources</h3>
                    <ul class="industrial-footer-links">
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">API Reference</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
                <div class="industrial-footer-column">
                    <h3>Company</h3>
                    <ul class="industrial-footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="industrial-footer-column">
                    <h3>Connect</h3>
                    <ul class="industrial-footer-links">
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-github"></i> GitHub</a></li>
                    </ul>
                </div>
            </div>
            <div class="industrial-footer-bottom">
                <p>&copy; 2023 INDUSTRIAL CAS. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>
</body>
</html>