<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huntm | User Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a4f76;
            --secondary-color: #f8f9fa;
            --accent-color: #2c3e50;
            --text-color: #495057;
            --light-gray: #e9ecef;
            --border-color: #dee2e6;
            --error-color: #dc3545;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }
        
        .auth-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .auth-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
        }
        
        .auth-header {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .auth-header h2 {
            font-weight: 600;
            margin-bottom: 0;
            font-size: 1.5rem;
        }
        
        .auth-body {
            padding: 2.5rem;
            background-color: white;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(58, 79, 118, 0.15);
        }
        
        .btn-auth {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            width: 100%;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .btn-auth:hover {
            background-color: var(--accent-color);
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-color);
            opacity: 0.6;
        }
        
        .password-container {
            position: relative;
        }
        
        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .is-invalid {
            border-color: var(--error-color) !important;
        }
        
        .is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: var(--text-color);
        }
        
        .form-group {
            margin-bottom: 1.75rem;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: -0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .forgot-password a {
            color: var(--text-color);
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .features-container {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            padding: 3rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-image: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        }
        
        .features-container h1 {
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 1.75rem;
            line-height: 1.3;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
        }
        
        .features-list li {
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
        }
        
        .features-list i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            margin-top: 3px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .brand-logo {
            height: 32px;
            margin-right: 10px;
        }
        
        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem 0;
            margin-top: auto;
        }
        
        .footer-content {
            font-size: 0.9rem;
            text-align: center;
        }
        
        @media (max-width: 992px) {
            .features-container {
                margin-bottom: 2rem;
                padding: 2rem;
            }
            
            .auth-body {
                padding: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .auth-header {
                padding: 1.5rem;
            }
            
            .auth-body {
                padding: 1.75rem;
            }
            
            .features-container h1 {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .features-list li {
                margin-bottom: 1rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="brand-logo">
                <span>Huntm</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-5">
        <div class="container auth-container py-4">
            <div class="row g-4 justify-content-center">
                <!-- Features Column -->
                <div class="col-lg-6">
                    <div class="features-container">
                        <h1>Streamline Your Customer Engagement</h1>
                        <ul class="features-list">
                            <li>
                                <i class="fas fa-paper-plane"></i>
                                <span>Create and send targeted campaigns to your customer base</span>
                            </li>
                            <li>
                                <i class="fas fa-chart-line"></i>
                                <span>Monitor campaign performance with real-time analytics</span>
                            </li>
                            <li>
                                <i class="fas fa-users"></i>
                                <span>Efficiently manage customer segments and profiles</span>
                            </li>
                            <li>
                                <i class="fas fa-lightbulb"></i>
                                <span>Gain valuable insights to optimize your marketing strategy</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Login Form Column -->
                <div class="col-lg-6">
                    <div class="auth-card">
                        <div class="auth-header">
                            <h2><i class="fas fa-sign-in-alt me-2"></i>Account Login</h2>
                        </div>
                        <div class="auth-body">
                            <form id="loginForm" action="<?php echo site_url('user_profile_login_submit'); ?>" method="post">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                    <div class="invalid-feedback" id="emailError">Please enter a valid email address.</div>
                                </div>
                                
                                <div class="form-group password-container">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                    <div class="invalid-feedback" id="passwordError">Password is required.</div>
                                </div>
                                
                                <div class="forgot-password">
                                    <a href="#">Forgot your password?</a>
                                </div>
                                
                                <button type="submit" class="btn btn-auth mt-2">Login to Dashboard</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> Huntm Customer Engagement Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Form validation
            const form = document.getElementById('loginForm');
            
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validate Email
                const email = document.getElementById('email');
                const emailError = document.getElementById('emailError');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!emailRegex.test(email.value)) {
                    email.classList.add('is-invalid');
                    emailError.style.display = 'block';
                    isValid = false;
                } else {
                    email.classList.remove('is-invalid');
                    emailError.style.display = 'none';
                }
                
                // Validate Password
                const password = document.getElementById('password');
                const passwordError = document.getElementById('passwordError');
                
                if (password.value.trim() === '') {
                    password.classList.add('is-invalid');
                    passwordError.style.display = 'block';
                    isValid = false;
                } else {
                    password.classList.remove('is-invalid');
                    passwordError.style.display = 'none';
                }
                
                // Validate Role
                const role = document.getElementById('role');
                const roleError = document.getElementById('roleError');
                
                if (role.value === null || role.value === '') {
                    role.classList.add('is-invalid');
                    roleError.style.display = 'block';
                    isValid = false;
                } else {
                    role.classList.remove('is-invalid');
                    roleError.style.display = 'none';
                }
                
                if (!isValid) {
                    event.preventDefault();
                }
            });
            
            // Real-time validation for better UX
            document.getElementById('email').addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    document.getElementById('emailError').style.display = 'none';
                }
            });
            
            document.getElementById('password').addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                    document.getElementById('passwordError').style.display = 'none';
                }
            });
            
            document.getElementById('role').addEventListener('change', function() {
                if (this.value !== null && this.value !== '') {
                    this.classList.remove('is-invalid');
                    document.getElementById('roleError').style.display = 'none';
                }
            });
        });
    </script>
    <?php if($this->session->flashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $this->session->flashdata("success"); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?php echo $this->session->flashdata("error"); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    <?php endif; ?>
</body>
</html>