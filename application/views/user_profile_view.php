<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .registration-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        .form-control {
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            font-weight: 500;
            background-color: #0d6efd;
            border: none;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .password-container {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registration-container">
            <h2 class="form-title">Create Your Account</h2>
            <form method="post" id="registrationForm" action="<?php echo site_url('user_profile_signup_submit'); ?>">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" required>
                    <div class="invalid-feedback" id="nameError">Please enter your full name (at least 3 characters).</div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    <div class="invalid-feedback" id="emailError">Please enter a valid email address.</div>
                </div>
                
                <div class="mb-3 password-container">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    <div class="invalid-feedback" id="passwordError">
                        Password must be at least 8 characters long and contain at least one number and one special character.
                    </div>
                </div>
                
                <div class="mb-3 password-container">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                    <div class="invalid-feedback" id="confirmPasswordError">Passwords do not match.</div>
                </div>
                
                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="distributor">Distributor</option>
                    </select>
                    <div class="invalid-feedback" id="roleError">Please select a role.</div>
                </div>
                
                <button type="submit" class="btn btn-primary">Register</button>
                
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="<?php echo base_url('user_profile_login'); ?>">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const togglePassword = document.querySelector('#togglePassword');
            const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
            const password = document.querySelector('#password');
            const confirmPassword = document.querySelector('#confirm_password');
            
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            if (toggleConfirmPassword) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPassword.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Form validation
            const form = document.getElementById('registrationForm');
            
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validate Full Name
                const fullName = document.getElementById('full_name');
                const nameError = document.getElementById('nameError');
                if (fullName.value.trim().length < 3) {
                    fullName.classList.add('is-invalid');
                    nameError.style.display = 'block';
                    isValid = false;
                } else {
                    fullName.classList.remove('is-invalid');
                    nameError.style.display = 'none';
                }
                
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
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                if (!passwordRegex.test(password.value)) {
                    password.classList.add('is-invalid');
                    passwordError.style.display = 'block';
                    isValid = false;
                } else {
                    password.classList.remove('is-invalid');
                    passwordError.style.display = 'none';
                }
                
                // Validate Confirm Password
                const confirmPassword = document.getElementById('confirm_password');
                const confirmPasswordError = document.getElementById('confirmPasswordError');
                if (confirmPassword.value !== password.value) {
                    confirmPassword.classList.add('is-invalid');
                    confirmPasswordError.style.display = 'block';
                    isValid = false;
                } else {
                    confirmPassword.classList.remove('is-invalid');
                    confirmPasswordError.style.display = 'none';
                }
                
                // Validate Role
                const role = document.getElementById('role');
                const roleError = document.getElementById('roleError');
                if (role.value === '') {
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
            document.getElementById('full_name').addEventListener('input', function() {
                if (this.value.trim().length >= 3) {
                    this.classList.remove('is-invalid');
                    document.getElementById('nameError').style.display = 'none';
                }
            });
            
            document.getElementById('email').addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    document.getElementById('emailError').style.display = 'none';
                }
            });
            
            document.getElementById('password').addEventListener('input', function() {
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                if (passwordRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    document.getElementById('passwordError').style.display = 'none';
                    
                    // Also check confirm password if it has value
                    const confirmPassword = document.getElementById('confirm_password');
                    if (confirmPassword.value && confirmPassword.value === this.value) {
                        confirmPassword.classList.remove('is-invalid');
                        document.getElementById('confirmPasswordError').style.display = 'none';
                    }
                }
            });
            
            document.getElementById('confirm_password').addEventListener('input', function() {
                const password = document.getElementById('password').value;
                if (this.value === password) {
                    this.classList.remove('is-invalid');
                    document.getElementById('confirmPasswordError').style.display = 'none';
                }
            });
            
            document.getElementById('role').addEventListener('change', function() {
                if (this.value !== '') {
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
