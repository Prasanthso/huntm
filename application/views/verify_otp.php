<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Huntm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0A517F;
            --secondary-color: #6c757d;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --gradient-start: #4e73df;
            --gradient-end: #224abe;
        }
        
        body {
            background: #ece9e6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            background-color: #ffffff;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .card-header {
            background: #56ab2f;
            color: white;
            text-align: center;
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .card-header i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .otp-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 30px 0;
        }
        
        .otp-input {
            width: 55px;
            height: 55px;
            border: 2px solid #e3e6f0;
            border-radius: 12px;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            transition: all 0.3s;
            color: var(--dark-color);
            background-color: #f8f9fc;
        }
        
        .otp-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            outline: none;
            background-color: #fff;
            transform: translateY(-2px);
        }
        
        .otp-input.filled {
            border-color: var(--success-color);
            background-color: rgba(28, 200, 138, 0.1);
        }
        
        .btn-verify {
            padding: 12px 30px;
            font-weight: 600;
            background: #0A517F;
            border: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .btn-cancel {
            padding: 12px 30px;
            font-weight: 600;
            background: linear-gradient(120deg, var(--secondary-color), #5a6268);
            border: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-cancel:hover {
            background: linear-gradient(120deg, #5a6268, #545b62);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .resend-link {
            color: var(--primary-color);
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .resend-link:hover {
            color: var(--gradient-end);
            text-decoration: underline;
        }
        
        .countdown {
            color: var(--secondary-color);
            font-weight: 500;
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
        
        @media (max-width: 576px) {
            .otp-input {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            
            .btn-verify, .btn-cancel {
                padding: 10px 20px;
                width: 100%;
                margin-bottom: 10px;
            }
            
            .button-container {
                flex-direction: column;
            }
            
            .card {
                margin: 20px;
            }
        }
        
        .email-display {
            background-color: #f8f9fc;
            border-radius: 8px;
            padding: 12px;
            margin: 15px 0;
            font-weight: 500;
            color: var(--dark-color);
            border-left: 4px solid var(--primary-color);
        }
        
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate__animated {
            animation-duration: 0.5s;
        }
        
        .animate__headShake {
            animation-name: headShake;
        }
        
        @keyframes headShake {
            0% { transform: translateX(0); }
            6.5% { transform: translateX(-6px) rotateY(-9deg); }
            18.5% { transform: translateX(5px) rotateY(7deg); }
            31.5% { transform: translateX(-3px) rotateY(-5deg); }
            43.5% { transform: translateX(2px) rotateY(3deg); }
            50% { transform: translateX(0); }
        }
        
        /* Modal customization */
        .modal-success .modal-header {
            background-color: var(--success-color);
            color: white;
        }
        
        .modal-danger .modal-header {
            background-color: var(--danger-color);
            color: white;
        }
        
        .modal-warning .modal-header {
            background-color: var(--warning-color);
            color: white;
        }
        
        .modal-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="#" class="navbar-brand text-white d-flex align-items-center">
                <!-- Using a placeholder logo since we can't access the original -->
                <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo me-2">
                <span class="h4 m-0">Huntm</span>
            </a>
        </div>
    </nav>
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-shield-check"></i>
                        <h4 class="card-title mb-0">Verify Your Account</h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-center text-muted">We've sent a verification code to your email</p>
                        
                        <div class="email-display text-center">
                            <i class="bi bi-envelope me-2"></i> <?php echo $email_sent_to; ?>
                        </div>
                        
                        <form id="otpForm" action="<?php echo site_url('user_profile/verify_otp'); ?>" method="post">
                            <div class="otp-container">
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" autocomplete="one-time-code" required>
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                            </div>
                            <input type="hidden" name="otp" id="fullOtp">
                            
                            <div class="alert alert-danger text-center d-none" id="errorAlert">
                                Please enter a valid verification code.
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4 button-container">
                                <button type="button" class="btn btn-cancel">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-verify">Verify Code</button>
                            </div>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <p class="text-muted">Didn't receive the code? 
                                <a class="resend-link" id="resendLink">Resend code</a> 
                                <span class="countdown" id="countdown">(02:00)</span>
                            </p>
                        </div>
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

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-success">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="successModalLabel"><i class="bi bi-check-circle-fill me-2"></i> Success</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-check-circle-fill modal-icon text-success"></i>
                    <h4>Verification Successful!</h4>
                    <p>Your OTP has been verified successfully. You will be redirected to reset your password.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invalid OTP Modal -->
    <div class="modal fade" id="invalidOtpModal" tabindex="-1" aria-labelledby="invalidOtpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-danger">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="invalidOtpModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i> Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-x-circle-fill modal-icon text-danger"></i>
                    <h4>Invalid OTP</h4>
                    <p>The OTP you entered is invalid. Please try again.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Expired OTP Modal -->
    <div class="modal fade" id="expiredOtpModal" tabindex="-1" aria-labelledby="expiredOtpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-warning">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="expiredOtpModalLabel"><i class="bi bi-clock-fill me-2"></i> Expired</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-clock-fill modal-icon text-warning"></i>
                    <h4>OTP Expired</h4>
                    <p>Your OTP has expired. Please request a new one.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Request New OTP</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i> OTP has been resent to your email!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.otp-input');
            const form = document.getElementById('otpForm');
            const hiddenInput = document.getElementById('fullOtp');
            const countdownElement = document.getElementById('countdown');
            const resendLink = document.getElementById('resendLink');
            const errorAlert = document.getElementById('errorAlert');
            const successToast = new bootstrap.Toast(document.getElementById('successToast'));
            
            // Modals
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            const invalidOtpModal = new bootstrap.Modal(document.getElementById('invalidOtpModal'));
            const expiredOtpModal = new bootstrap.Modal(document.getElementById('expiredOtpModal'));
            
            // Check for session flash data
            <?php if ($this->session->flashdata('errors')): ?>
                invalidOtpModal.show();
            <?php endif; ?>
            
            // Focus first input on load
            inputs[0].focus();
            
            // Start countdown timer (2 minutes)
            let timeLeft = 120;
            const countdown = setInterval(function() {
                timeLeft--;
                
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    countdownElement.style.display = 'none';
                    // Show expired modal when countdown finishes
                    expiredOtpModal.show();
                } else {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    countdownElement.textContent = `(${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')})`;
                }
            }, 1000);
            
            // Handle OTP input
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    // Allow only numbers
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Add filled class for styling
                    if (this.value !== '') {
                        this.classList.add('filled');
                    } else {
                        this.classList.remove('filled');
                    }
                    
                    // Auto-tab to next input
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    
                    // Update hidden input
                    updateHiddenOtp();
                });
                
                input.addEventListener('keydown', function(e) {
                    // Handle backspace
                    if (e.key === 'Backspace' && this.value === '' && index > 0) {
                        inputs[index - 1].focus();
                        inputs[index - 1].value = '';
                        inputs[index - 1].classList.remove('filled');
                    }
                    
                    // Handle paste
                    if (e.key === 'v' && (e.ctrlKey || e.metaKey)) {
                        setTimeout(() => {
                            const pasteText = this.value;
                            if (pasteText.length === 6) {
                                for (let i = 0; i < 6; i++) {
                                    if (inputs[i]) {
                                        inputs[i].value = pasteText[i];
                                        inputs[i].classList.add('filled');
                                    }
                                }
                                updateHiddenOtp();
                            }
                        }, 0);
                    }
                });
            });
            
            // Update hidden input with full OTP
            function updateHiddenOtp() {
                hiddenInput.value = Array.from(inputs).map(input => input.value).join('');
            }
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                updateHiddenOtp();
                
                // Validate all fields are filled
                const allFilled = Array.from(inputs).every(input => input.value !== '');
                if (!allFilled) {
                    // Show error message
                    errorAlert.classList.remove('d-none');
                    
                    // Add shake animation to empty inputs
                    inputs.forEach(input => {
                        if (input.value === '') {
                            input.classList.add('animate__animated', 'animate__headShake');
                            setTimeout(() => {
                                input.classList.remove('animate__animated', 'animate__headShake');
                            }, 1000);
                        }
                    });
                } else {
                    // In a real application, the form would be submitted to the server
                    // For this demo, we'll simulate different responses
                    simulateVerification();
                }
            });
            
            // Simulate verification response (for demo purposes)
            function simulateVerification() {
                // In a real application, this would be handled by the server
                // For demo, we'll randomly choose a response
                const responses = ['success', 'invalid', 'expired'];
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                
                switch(randomResponse) {
                    case 'success':
                        successModal.show();
                        // Redirect after success
                        document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                            window.location.href = '<?php echo site_url("user_profile/reset_password_form"); ?>';
                        });
                        break;
                    case 'invalid':
                        invalidOtpModal.show();
                        break;
                    case 'expired':
                        expiredOtpModal.show();
                        break;
                }
            }
            
            // Resend code functionality
            resendLink.addEventListener('click', function() {
                if (timeLeft > 0) {
                    alert(`Please wait ${timeLeft} seconds before requesting a new code.`);
                    return;
                }
                
                // Show success toast
                successToast.show();
                
                // Reset inputs
                inputs.forEach(input => {
                    input.value = '';
                    input.classList.remove('filled');
                });
                inputs[0].focus();
                
                // Reset countdown
                timeLeft = 120;
                countdownElement.style.display = 'inline';
                
                // In a real application, you would make an AJAX request here to resend the OTP
                console.log('OTP resent to email');
            });
            
            // Cancel button functionality
            document.querySelector('.btn-cancel').addEventListener('click', function() {
                if (confirm('Are you sure you want to cancel the verification process?')) {
                    window.location.href = '<?php echo site_url("User_profile/login_form"); ?>';
                }
            });
            
            // Expired modal button functionality
            document.querySelector('#expiredOtpModal .btn-warning').addEventListener('click', function() {
                // Reset countdown and inputs
                timeLeft = 120;
                countdownElement.style.display = 'inline';
                inputs.forEach(input => {
                    input.value = '';
                    input.classList.remove('filled');
                });
                inputs[0].focus();
                
                // In a real application, you would make an AJAX request here to resend the OTP
                console.log('New OTP requested after expiration');
            });
        });
    </script>
</body>
</html>