<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
        }
        
        .brand-logo {
            height: 30px;
            margin-right: 10px;
        }
        
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            margin-top: 30px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Improved responsive text sizing */
        .terms-content h5 {
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .terms-content p, .terms-content li {
            font-size: 1.1rem;
            line-height: 2.5;
        }
        
        /* Better spacing for mobile */
        @media (max-width: 768px) {
            .terms-content h5 {
                font-size: 1rem;
            }
            
            .terms-content p, .terms-content li {
                font-size: 0.9rem;
            }
            
            .container.py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
        }
        
        @media (max-width: 576px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links {
                margin-top: 10px;
            }
            
            .footer-links a {
                display: block;
                margin-bottom: 8px;
            }
            
            .footer-links a:last-child {
                margin-bottom: 0;
            }
            
            .brand-logo {
                height: 25px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('user_profile/login_form'); ?>" id="logo-link">
                <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="brand-logo">
                <span>Huntm</span>
            </a>
        </div>
    </nav>
    
    <div class="container py-5 terms-content" style="color:#6C6C6C;">
        <h1 class="text-center mb-4 text-dark">Terms Of Use</h1>
        
        <h5 class="mb-3">Terms and Conditions</h5>
        <p>Welcome to Koovi! These Terms and Conditions ("Terms") govern your access to and use of our platform and services. By using our platform, you agree to comply with these Terms. Please read them carefully before proceeding.</p>

        <h5 class="mt-4">Use of Platform</h5>
        <ul>
            <li>You must be at least 18 years old to use our platform. By using our services, you confirm that you are of legal age to form a binding contract.</li>
            <li>You agree to provide accurate, current, and complete information during registration and to keep your account information updated.</li>
        </ul>

        <h5 class="mt-4">Account Security</h5>
        <ul>
            <li>You are responsible for maintaining the security of your account credentials and for all activities that occur under your account.</li>
            <li>You agree to notify us immediately of any unauthorized access to or use of your account.</li>
        </ul>

        <h5 class="mt-4">Product Listings</h5>
        <ul>
            <li>As a seller on our platform, you are responsible for ensuring the accuracy and legality of the products you list.</li>
            <li>You agree not to list prohibited items or engage in any fraudulent or deceptive practices.</li>
        </ul>

        <h5 class="mt-4">Transactions</h5>
        <ul>
            <li>By purchasing products through our platform, you agree to pay the listed price along with any applicable taxes and shipping fees.</li>
            <li>We reserve the right to cancel or refuse any order for any reason, including but not limited to inventory availability, pricing errors, or suspicion of fraudulent activity.</li>
        </ul>

        <h5 class="mt-4">Intellectual Property</h5>
        <p>All content and materials on our platform, including but not limited to text, images, logos, trademarks, and software, are the property of Koovi or its licensors and are protected by copyright, trademark, and other intellectual property laws. You may not use, reproduce, modify, or distribute any content from our platform without prior written permission.</p>

        <h5 class="mt-4">User Conduct</h5>
        <ul>
            <li>You agree not to use our platform for any unlawful or prohibited purpose, including but not limited to violating applicable laws or infringing upon the rights of others.</li>
            <li>You agree not to engage in any activity that could disrupt or interfere with the proper functioning of our platform.</li>
        </ul>

        <h5 class="mt-4">Limitation of Liability</h5>
        <p>Koovi is not liable for any direct, indirect, incidental, special, or consequential damages arising out of or in any way related to your use of our platform or the products purchased through it. We do not guarantee the accuracy, completeness, or reliability of any content or information provided on our platform.</p>

        <h5 class="mt-4">Governing Law</h5>
        <p>These Terms are governed by and construed in accordance with the laws of [Your Jurisdiction], without regard to its conflict of laws principles. Any dispute arising out of or relating to these Terms or your use of our platform shall be resolved exclusively in the courts of [Your Jurisdiction].</p>

        <h5 class="mt-4">Changes to Terms</h5>
        <p>We reserve the right to update or revise these Terms at any time without prior notice. Any changes will be effective immediately upon posting on our platform. Your continued use of our platform after the posting of any changes constitutes your acceptance of the revised Terms.</p>

        <h5 class="mt-4">Contact Us</h5>
        <p>If you have any questions or concerns regarding these Terms and Conditions, please contact us at <a href="mailto:info@koovi.com">info@koovi.com</a>.</p>

        <p class="mt-4"><strong>These Terms and Conditions constitute the entire agreement between you and Koovi regarding your use of our platform and supersede any prior agreements or understandings.</strong></p>
    </div>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Huntm Customer Engagement Platform. All rights reserved.</p>
                <div class="footer-links">
                    <a href="<?php echo base_url('terms-of-use'); ?>" class="text-white text-decoration-none me-3">Terms of Use</a>
                    <a href="<?php echo base_url('terms-and-conditions'); ?>" class="text-white text-decoration-none me-3">Terms &amp; Conditions</a>
                    <a href="<?php echo base_url('privacy-policy'); ?>" class="text-white text-decoration-none">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var logoLink = document.getElementById('logo-link');
            
            // Create tooltip using Bootstrap's built-in functionality
            var tooltip = new bootstrap.Tooltip(logoLink, {
                title: "Navigate to login form",
                placement: "bottom",
                trigger: "hover"
            });
        });
    </script>
</body>
</html>