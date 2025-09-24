<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: rgba(44, 62, 80, 0.95);
      padding: 1rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .huntmlogo {
      height: 40px;
      width: auto;
      filter: brightness(0) invert(1);
    }
    
    .navbar-brand {
      font-weight: 700;
      color: #ffffff !important;
    }
    
    .password-container {
      max-width: 450px;
      width: 100%;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
      margin: 2rem auto;
    }
    
    .password-icon {
      font-size: 3rem;
      color: #0d6efd;
      margin-bottom: 20px;
    }
    
    .form-control:focus {
      border-color: #86b7fe;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .password-toggle {
      cursor: pointer;
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      border-left: none;
      display: flex;
      align-items: center;
      padding: 0 10px;
    }
    
    .input-group-text {
      background-color: #f8f9fa;
    }
    
    .error-message {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: none;
    }
    
    .was-validated input:invalid {
      border-color: #dc3545;
    }
    
    .was-validated input:valid {
      border-color: #198754;
    }
    
    .password-requirements {
      font-size: 0.875rem;
      color: #6c757d;
      margin-top: 0.5rem;
    }
    
    .requirement {
      display: flex;
      align-items: center;
      margin-bottom: 0.25rem;
    }
    
    .requirement i {
      margin-right: 0.5rem;
      font-size: 0.75rem;
    }
    
    .requirement.valid {
      color: #198754;
    }
    
    .requirement.invalid {
      color: #6c757d;
    }
    
    footer {
      background-color: rgba(44, 62, 80, 0.95);
      color: white;
      padding: 1.5rem 0;
      margin-top: auto;
    }
    
    .footer-content {
      font-size: 0.9rem;
      text-align: center;
    }
    
    .footer-link {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.2s;
    }
    
    .footer-link:hover {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a href="#" class="navbar-brand text-white d-flex align-items-center">
        <!-- Logo placeholder - replace with your actual logo path -->
        <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo me-2">
        <span class="h4 m-0">Huntm</span>
      </a>
    </div>
  </nav>
  
  <div class="container flex-grow-1">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="password-container">
          <div class="text-center">
            <i class="bi bi-shield-lock password-icon"></i>
            <h2 class="mb-4">Reset Your Password</h2>
          </div>

          <!-- Flash Messages -->
          <?php if ($this->session->flashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $this->session->flashdata('errors'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?php echo $this->session->flashdata('success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form id="resetPasswordForm" action="<?php echo base_url('user_profile/reset_password'); ?>" method="post" novalidate>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Enter new password" required minlength="8">
                <span class="password-toggle" onclick="togglePassword('newPassword')">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              
              <div class="password-requirements">
                <div class="requirement invalid" id="lengthReq">
                  <i class="bi bi-circle"></i>
                  <span>At least 8 characters</span>
                </div>
                <div class="requirement invalid" id="specialCharReq">
                  <i class="bi bi-circle"></i>
                  <span>Contains at least one special character (!@#$%^&* etc.)</span>
                </div>
              </div>
              
              <div class="error-message" id="newPasswordError"></div>
            </div>

            <div class="mb-4">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm your password" required>
                <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <div class="error-message" id="confirmPasswordError"></div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-arrow-repeat me-2"></i>Reset Password</button>
            </div>
          </form>

          <div class="text-center mt-4">
            <a href="<?php echo base_url(); ?>" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="footer-content">
        <p class="mb-2">&copy; 2023 Huntm Customer Engagement Platform. All rights reserved.</p>
        <div>
          <a href="#" class="footer-link me-3">Terms of Use</a>
          <a href="#" class="footer-link me-3">Terms &amp; Conditions</a>
          <a href="#" class="footer-link">Privacy Policy</a>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Bootstrap JS with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    function togglePassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      const toggleIcon = passwordInput.nextElementSibling.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
      }
    }
    
    // Check if password contains special characters
    function hasSpecialCharacter(password) {
      const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
      return specialChars.test(password);
    }
    
    // Update requirement indicators
    function updateRequirements(password) {
      const lengthReq = document.getElementById('lengthReq');
      const specialCharReq = document.getElementById('specialCharReq');
      
      // Check length requirement
      if (password.length >= 8) {
        lengthReq.classList.remove('invalid');
        lengthReq.classList.add('valid');
        lengthReq.querySelector('i').classList.remove('bi-circle');
        lengthReq.querySelector('i').classList.add('bi-check-circle');
      } else {
        lengthReq.classList.remove('valid');
        lengthReq.classList.add('invalid');
        lengthReq.querySelector('i').classList.remove('bi-check-circle');
        lengthReq.querySelector('i').classList.add('bi-circle');
      }
      
      // Check special character requirement
      if (hasSpecialCharacter(password)) {
        specialCharReq.classList.remove('invalid');
        specialCharReq.classList.add('valid');
        specialCharReq.querySelector('i').classList.remove('bi-circle');
        specialCharReq.querySelector('i').classList.add('bi-check-circle');
      } else {
        specialCharReq.classList.remove('valid');
        specialCharReq.classList.add('invalid');
        specialCharReq.querySelector('i').classList.remove('bi-check-circle');
        specialCharReq.querySelector('i').classList.add('bi-circle');
      }
    }
    
    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('resetPasswordForm');
      const newPassword = document.getElementById('newPassword');
      const confirmPassword = document.getElementById('confirmPassword');
      const newPasswordError = document.getElementById('newPasswordError');
      const confirmPasswordError = document.getElementById('confirmPasswordError');
      
      // Validate new password on input
      newPassword.addEventListener('input', function() {
        updateRequirements(newPassword.value);
        validateNewPassword();
        validateConfirmPassword(); // Also validate confirm password when new password changes
      });
      
      // Validate confirm password on input
      confirmPassword.addEventListener('input', validateConfirmPassword);
      
      // Form submission handler
      form.addEventListener('submit', function(event) {
        // Validate all fields before submission
        const isNewPasswordValid = validateNewPassword();
        const isConfirmPasswordValid = validateConfirmPassword();
        
        // If any field is invalid, prevent form submission
        if (!isNewPasswordValid || !isConfirmPasswordValid) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      });
      
      // Function to validate new password
      function validateNewPassword() {
        let isValid = true;
        newPasswordError.style.display = 'none';
        
        if (newPassword.validity.valueMissing) {
          newPasswordError.textContent = 'Password is required';
          newPasswordError.style.display = 'block';
          isValid = false;
        } else if (newPassword.validity.tooShort) {
          newPasswordError.textContent = 'Password must be at least 8 characters long';
          newPasswordError.style.display = 'block';
          isValid = false;
        } else if (!hasSpecialCharacter(newPassword.value)) {
          newPasswordError.textContent = 'Password must contain at least one special character';
          newPasswordError.style.display = 'block';
          isValid = false;
        }
        
        return isValid;
      }
      
      // Function to validate confirm password
      function validateConfirmPassword() {
        let isValid = true;
        confirmPasswordError.style.display = 'none';
        
        if (confirmPassword.validity.valueMissing) {
          confirmPasswordError.textContent = 'Please confirm your password';
          confirmPasswordError.style.display = 'block';
          isValid = false;
        } else if (confirmPassword.value !== newPassword.value) {
          confirmPasswordError.textContent = 'Passwords do not match';
          confirmPasswordError.style.display = 'block';
          isValid = false;
        }
        
        return isValid;
      }
    });
  </script>
</body>
</html>