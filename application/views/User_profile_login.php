<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-color: #5a5c69;
            --error-color: #e74a3b;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
        }
        
        .login-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.35rem;
            border: 1px solid #d1d3e2;
        }
        
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
        }
        
        .btn-login:hover {
            background-color: var(--accent-color);
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #b7b9cc;
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
            box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
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
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2><i class="fas fa-user-circle me-2"></i>User Profile Login</h2>
            </div>
            <div class="login-body">
                <form id="loginForm" action="<?php echo site_url('user_profile_login_submit'); ?>" method="post">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback" id="emailError">Please enter a valid email address.</div>
                    </div>
                    
                    <div class="form-group password-container">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        <div class="invalid-feedback" id="passwordError">Password is required.</div>
                    </div>
                    
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" selected disabled>Select your role</option>
                            <!-- <option value="super_admin">Super Admin</option> -->
                            <option value="admin">LSG Admin</option>
                            <option value="distributor">Distributor Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                        <div class="invalid-feedback" id="roleError">Please select your role.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>

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