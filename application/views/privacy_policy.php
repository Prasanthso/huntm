<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
        }
        
        body {
            color: #333;
            line-height: 1.6;
        }
        
        .brand-logo {
            height: 30px;
            margin-right: 10px;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
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
        
        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        
        .content-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .last-updated {
            font-style: italic;
            color: #6C6C6C;
            margin-bottom: 30px;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 1000;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links {
                margin-top: 15px;
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

    <div class="container py-5 content-container">
        <h1 class="text-center mb-3">Privacy Policy</h1>
        <p class="text-center last-updated">Last updated March 15, 2024</p>
        
        <p class="lead">This privacy notice for Koovi ("Company", "we", "us", or "our"), describes how and why we might collect, store, use, and/or share ("process") your information when you use our services ("Services"), such as when you:</p>
        
        <ul>
            <li>Download and use our mobile application (Koovi), or any other application of ours that links to this privacy notice</li>
            <li>Engage with us in other related ways, including any sales, marketing, or events</li>
        </ul>
        
        <p><strong>Questions or concerns?</strong> Reading this privacy notice will help you understand your privacy rights and choices. If you do not agree with our policies and practices, please do not use our Services. If you still have any questions or concerns, please contact us at <a href="mailto:info@koovi.in">info@koovi.in</a></p>
        
        <div class="alert alert-info mt-4">
            <h5>SUMMARY OF KEY POINTS</h5>
            <p class="mb-0">This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for.</p>
        </div>
        
        <h2 class="section-title">TABLE OF CONTENTS</h2>
        <ol>
            <li><a href="#section1" class="text-decoration-none">WHAT INFORMATION DO WE COLLECT?</a></li>
            <li><a href="#section2" class="text-decoration-none">HOW DO WE PROCESS YOUR INFORMATION?</a></li>
            <li><a href="#section3" class="text-decoration-none">WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?</a></li>
            <li><a href="#section4" class="text-decoration-none">HOW DO WE HANDLE YOUR SOCIAL LOGINS?</a></li>
            <li><a href="#section5" class="text-decoration-none">HOW LONG DO WE KEEP YOUR INFORMATION?</a></li>
            <li><a href="#section6" class="text-decoration-none">HOW DO WE KEEP YOUR INFORMATION SAFE?</a></li>
            <li><a href="#section7" class="text-decoration-none">DO WE COLLECT INFORMATION FROM MINORS?</a></li>
            <li><a href="#section8" class="text-decoration-none">WHAT ARE YOUR PRIVACY RIGHTS?</a></li>
            <li><a href="#section9" class="text-decoration-none">CONTROLS FOR DO-NOT-TRACK FEATURES</a></li>
            <li><a href="#section10" class="text-decoration-none">DO CALIFORNIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</a></li>
            <li><a href="#section11" class="text-decoration-none">DO WE MAKE UPDATES TO THIS NOTICE?</a></li>
            <!-- <li><a href="#section12" class="text-decoration-none">HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</a></li> -->
            <!-- <li><a href="#section13" class="text-decoration-none">HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?</a></li> -->
        </ol>
        
        <h3 id="section1" class="section-title">1. WHAT INFORMATION DO WE COLLECT?</h3>
        <p><strong>In Short:</strong> We collect personal information that you provide to us.</p>
        <p>We collect personal information that you voluntarily provide to us when you register on the Services, express an interest in obtaining information about us or our products and Services, when you participate in activities on the Services, or otherwise when you contact us.</p>
        
        <h5>Personal Information Provided by You.</h5>
        <p>The personal information that we collect depends on the context of your interactions with us and the Services, the choices you make, and the products and features you use. The personal information we collect may include the following:</p>
        <ul>
            <li>names</li>
            <li>phone numbers</li>
            <li>email addresses</li>
            <li>usernames</li>
            <li>passwords</li>
            <li>billing addresses</li>
            <li>debit/credit card numbers</li>
        </ul>
        
        <h5>Sensitive Information.</h5>
        <p>When necessary, with your consent or as otherwise permitted by applicable law, we process the following categories of sensitive information:</p>
        <ul>
            <li>financial data</li>
        </ul>
        
        <h5>Payment Data.</h5>
        <p>We may collect data necessary to process your payment if you make purchases, such as your payment instrument number, and the security code associated with your payment instrument. All payment data is stored by PhonePe. You may find their privacy notice link(s) here: <a href="https://www.phonepe.com/privacy-policy/" target="_blank">https://www.phonepe.com/privacy-policy/</a>.</p>
        
        <h5>Social Media Login Data.</h5>
        <p>We may provide you with the option to register with us using your existing social media account details, like your Facebook, Twitter, or other social media account. If you choose to register in this way, we will collect the information described in the section called "HOW DO WE HANDLE YOUR SOCIAL LOGINS?" below.</p>
        
        <h5>Application Data.</h5>
        <p>If you use our application(s), we also may collect the following information if you choose to provide us with access or permission:</p>
        
        <h5>Push Notifications.</h5>
        <p>We may request to send you push notifications regarding your account or certain features of the application(s). If you wish to opt out from receiving these types of communications, you may turn them off in your device's settings.</p>
        <p>This information is primarily needed to maintain the security and operation of our application(s), for troubleshooting, and for our internal analytics and reporting purposes.</p>
        <p>All personal information that you provide to us must be true, complete, and accurate, and you must notify us of any changes to such personal information.</p>
        
        <h3 id="section2" class="section-title">2. HOW DO WE PROCESS YOUR INFORMATION?</h3>
        <p><strong>In Short:</strong> We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law. We may also process your information for other purposes with your consent.</p>
        <p>We process your personal information for a variety of reasons, depending on how you interact with our Services, including:</p>
        <ul>
            <li>To facilitate account creation and authentication and otherwise manage user accounts. We may process your information so you can create and log in to your account, as well as keep your account in working order.</li>
            <li>To fulfil and manage your orders. We may process your information to fulfil and manage your orders, payments, returns, and exchanges made through the Services.</li>
        </ul>
        
        <h3 id="section3" class="section-title">3. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?</h3>
        <p><strong>In Short:</strong> We may share information in specific situations described in this section and/or with the following third parties.</p>
        <p>We may need to share your personal information in the following situations:</p>
        
        <h5>Business Transfers.</h5>
        <p>We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</p>
        
        <h3 id="section4" class="section-title">4. HOW DO WE HANDLE YOUR SOCIAL LOGINS?</h3>
        <p><strong>In Short:</strong> If you choose to register or log in to our Services using a social media account, we may have access to certain information about you.</p>
        <p>Our Services offer you the ability to register and log in using your third-party social media account details (like your Facebook or Twitter logins). Where you choose to do this, we will receive certain profile information about you from your social media provider. The profile information we receive may vary depending on the social media provider concerned, but will often include your name, email address, friends list, and profile picture, as well as other information you choose to make public on such a social media platform.</p>
        <p>We will use the information we receive only for the purposes that are described in this privacy notice or that are otherwise made clear to you on the relevant Services. Please note that we do not control, and are not responsible for, other uses of your personal information by your third-party social media provider. We recommend that you review their privacy notice to understand how they collect, use, and share your personal information, and how you can set your privacy preferences on their sites and apps.</p>
        
        <h3 id="section5" class="section-title">5. HOW LONG DO WE KEEP YOUR INFORMATION?</h3>
        <p><strong>In Short:</strong> We keep your information for as long as necessary to fulfil the purposes outlined in this privacy notice unless otherwise required by law.</p>
        <p>We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy notice, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements). No purpose in this notice will require us keeping your personal information for longer than the period of time in which users have an account with us.</p>
        <p>When we have no ongoing legitimate business need to process your personal information, we will either delete or anonymize such information, or, if this is not possible (for example, because your personal information has been stored in backup archives), then we will securely store your personal information and isolate it from any further processing until deletion is possible.</p>
        
        <h3 id="section6" class="section-title">6. HOW DO WE KEEP YOUR INFORMATION SAFE?</h3>
        <p><strong>In Short:</strong> We aim to protect your personal information through a system of organizational and technical security measures.</p>
        <p>We have implemented appropriate and reasonable technical and organizational security measures designed to protect the security of any personal information we process. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other unauthorized third parties will not be able to defeat our security and improperly collect, access, steal, or modify your information. Although we will do our best to protect your personal information, transmission of personal information to and from our Services is at your own risk. You should only access the Services within a secure environment.</p>
        
        <h3 id="section7" class="section-title">7. DO WE COLLECT INFORMATION FROM MINORS?</h3>
        <p><strong>In Short:</strong> We do not knowingly collect data from or market to children under 18 years of age.</p>
        <p>We do not knowingly solicit data from or market to children under 18 years of age. By using the Services, you represent that you are at least 18 or that you are the parent or guardian of such a minor and consent to such minor dependent's use of the Services. If we learn that personal information from users less than 18 years of age has been collected, we will deactivate the account and take reasonable measures to promptly delete such data from our records. If you become aware of any data we may have collected from children under age 18, please contact us at <a href="mailto:contact@mobevatrip.com">contact@mobevatrip.com</a></p>
        
        <h3 id="section8" class="section-title">8. WHAT ARE YOUR PRIVACY RIGHTS?</h3>
        <p><strong>In Short:</strong> You may review, change, or terminate your account at any time.</p>
        <p>If you are located in the EEA or UK and you believe we are unlawfully processing your personal information, you also have the right to complain to your Member State data protection authority or UK data protection authority.</p>
        <p>If you are located in Switzerland, you may contact the Federal Data Protection and Information Commissioner.</p>
        
        <h5>Withdrawing your consent:</h5>
        <p>If we are relying on your consent to process your personal information, which may be express and/or implied consent depending on the applicable law, you have the right to withdraw your consent at any time. You can withdraw your consent at any time by contacting us by using the contact details provided in the section "HOW CAN YOU CONTACT US ABOUT THIS NOTICE?" below.</p>
        <p>However, please note that this will not affect the lawfulness of the processing before its withdrawal nor, when applicable law allows, will it affect the processing of your personal information conducted in reliance on lawful processing grounds other than consent.</p>
        
        <h5>Account Information</h5>
        <p>If you would at any time like to review or change the information in your account or terminate your account, you can:</p>
        <ul>
            <li>Log in to your account settings and update your user account.</li>
        </ul>
        <p>Upon your request to terminate your account, we will deactivate or delete your account and information from our active databases. However, we may retain some information in our files to prevent fraud, troubleshoot problems, assist with any investigations, enforce our legal terms and/or comply with applicable legal requirements.</p>
        <p>If you have questions or comments about your privacy rights, you may email us at <a href="mailto:contact@nephronstudies.in">contact@nephronstudies.in</a>.</p>
        
        <h3 id="section9" class="section-title">9. CONTROLS FOR DO-NOT-TRACK FEATURES</h3>
        <p>Most web browsers and some mobile operating systems and mobile applications include a Do-Not-Track ("DNT") feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. At this stage no uniform technology standard for recognizing and implementing DNT signals has been finalized. As such, we do not currently respond to DNT browser signals or any other mechanism that automatically communicates your choice not to be tracked online. If a standard for online tracking is adopted that we must follow in the future, we will inform you about that practice in a revised version of this privacy notice.</p>
        
        <h3 id="section10" class="section-title">10. DO CALIFORNIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</h3>
        <p><strong>In Short:</strong> Yes, if you are a resident of California, you are granted specific rights regarding access to your personal information.</p>
        <p>California Civil Code Section 1798.83, also known as the "Shine The Light" law, permits our users who are California residents to request and obtain from us, once a year and free of charge, information about categories of personal information (if any) we disclosed to third parties for direct marketing purposes and the names and addresses of all third parties with which we shared personal information in the immediately preceding calendar year. If you are a California resident and would like to make such a request, please submit your request in writing to us using the contact information provided below.</p>
        <p>If you are under 18 years of age, reside in California, and have a registered account with Services, you have the right to request removal of unwanted data that you publicly post on the Services. To request removal of such data, please contact us using the contact information provided below and include the email address associated with your account and a statement that you reside in California. We will make sure the data is not publicly displayed on the Services, but please be aware that the data may not be completely or comprehensively removed from all our systems (e.g. backups, etc.).</p>
        
        <h3 id="section11" class="section-title">11. DO WE MAKE UPDATES TO THIS NOTICE?</h3>
        <p><strong>In Short:</strong> Yes, we will update this notice as necessary to stay compliant with relevant laws.</p>
        <p>We may update this privacy notice from time to time. The updated version will be indicated by an updated "Revised" date and the updated version will be effective as soon as it is accessible. If we make material changes to this privacy notice, we may notify you either by prominently posting a notice of such changes or by directly sending you a notification. We encourage you to review this privacy notice frequently to be informed of how we are protecting your information.</p>
        
        <!-- <h3 id="section12" class="section-title">12. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</h3>
        <p>If you have questions or comments about this notice, you may email us at <a href="https://shop.koovi.in/contact">https://shop.koovi.in/contact</a> or contact us by post at:</p>
        <address>
            NR AUTO CLUB<br>
            123/B, Route 66, Downtown<br>
            Washington, DC 20004, US
        </address>
        
        <h3 id="section13" class="section-title">13. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?</h3>
        <p>You have the right to request access to the personal information we collect from you, change that information, or delete it. To request to review, update, or delete your personal information, please visit: <a href="https://shop.koovi.in/contact">https://shop.koovi.in/contact</a></p> -->
    </div>

    <!-- <a href="#" class="btn btn-primary back-to-top" id="backToTop">↑ Top</a> -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <p class="mb-2">&copy; <?php echo date('Y'); ?> Huntm Customer Engagement Platform. All rights reserved.</p>
                <div class="footer-links">
                    <a href="<?php echo base_url('terms-of-use'); ?>" class="text-white text-decoration-none me-3">Terms of Use</a>
                    <a href="<?php echo base_url('terms-and-conditions'); ?>" class="text-white text-decoration-none me-3">Terms &amp; Conditions</a>
                    <a href="<?php echo base_url('privacy-policy'); ?>" class="text-white text-decoration-none">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js (required for tooltips) -->
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
            
            // Back to top button functionality
            var backToTopButton = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.style.display = 'block';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });
            
            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({top: 0, behavior: 'smooth'});
            });
            
            // Smooth scrolling for table of contents links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 20,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>