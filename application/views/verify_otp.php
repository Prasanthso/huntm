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
      --success-color: #1cc88a;
      --danger-color: #e74a3b;
      --secondary-color: #6c757d;
      --dark-color: #2c3e50;
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
    }
    .huntmlogo {
      height: 40px;
      filter: brightness(0) invert(1);
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.18);
      overflow: hidden;
    }
    .card-header {
      background: #56ab2f;
      color: white;
      text-align: center;
      padding: 1.5rem;
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
      color: var(--dark-color);
      background-color: #f8f9fc;
      transition: all 0.3s;
    }
    .otp-input:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
      outline: none;
    }
    .btn-verify {
      padding: 12px 30px;
      font-weight: 600;
      background: #0A517F;
      border: none;
      border-radius: 8px;
      color: white;
    }
    .btn-cancel {
      padding: 12px 30px;
      font-weight: 600;
      background: #6c757d;
      border: none;
      border-radius: 8px;
      color: white;
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
    footer {
      background-color: rgba(44, 62, 80, 0.95);
      color: white;
      padding: 1rem 0;
      margin-top: auto;
      text-align: center;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container-fluid">
      <a href="#" class="navbar-brand text-white d-flex align-items-center">
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
            <h4 class="mb-0">Verify Your Account</h4>
          </div>
          <div class="card-body p-4">
            <p class="text-center text-muted">We've sent a verification code to your email</p>
            <div class="email-display text-center">
              <i class="bi bi-envelope me-2"></i> <?php echo $email_sent_to; ?>
            </div>

            <form id="otpForm" action="<?php echo site_url('user_profile/verify_otp'); ?>" method="post">
              <div class="otp-container">
                <?php for ($i = 0; $i < 6; $i++): ?>
                  <input type="text" class="otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric" required>
                <?php endfor; ?>
              </div>
              <input type="hidden" name="otp" id="fullOtp">

              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger text-center" id="errorAlert">
                  <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php else: ?>
                <div class="alert alert-danger text-center d-none" id="errorAlert">
                  Please enter a valid verification code.
                </div>
              <?php endif; ?>

              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-cancel" id="cancelBtn">Cancel</button>
                <button type="submit" class="btn btn-verify">Verify Code</button>
              </div>
            </form>

            <div class="mt-4 text-center">
              <p class="text-muted">
                Didn't receive the code?
                <a href="javascript:void(0);" class="resend-link" id="resendLink">Resend code</a>
                <span class="countdown" id="countdown">(02:00)</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Huntm Customer Engagement Platform. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const inputs = document.querySelectorAll('.otp-input');
      const form = document.getElementById('otpForm');
      const hiddenInput = document.getElementById('fullOtp');
      const countdownElement = document.getElementById('countdown');
      const resendLink = document.getElementById('resendLink');
      const errorAlert = document.getElementById('errorAlert');

      // Focus first input
      inputs[0].focus();

      // Countdown 2 minutes
      let timeLeft = 120;
      const countdown = setInterval(() => {
        timeLeft--;
        if (timeLeft <= 0) {
          clearInterval(countdown);
          countdownElement.textContent = '(Expired)';
          resendLink.classList.add('text-danger');
        } else {
          const minutes = Math.floor(timeLeft / 60);
          const seconds = timeLeft % 60;
          countdownElement.textContent = `(${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')})`;
        }
      }, 1000);

      // Handle OTP input
      inputs.forEach((input, index) => {
        input.addEventListener('input', function () {
          this.value = this.value.replace(/[^0-9]/g, '');
          if (this.value && index < inputs.length - 1) inputs[index + 1].focus();
          updateHiddenOtp();
        });

        input.addEventListener('keydown', function (e) {
          if (e.key === 'Backspace' && this.value === '' && index > 0) {
            inputs[index - 1].focus();
          }
        });
      });

      function updateHiddenOtp() {
        hiddenInput.value = Array.from(inputs).map(i => i.value).join('');
      }

      // Submit form
      form.addEventListener('submit', function (e) {
        updateHiddenOtp();
        const allFilled = Array.from(inputs).every(i => i.value !== '');
        if (!allFilled) {
          e.preventDefault();
          errorAlert.classList.remove('d-none');
        }
      });

      // Resend OTP
      resendLink.addEventListener('click', function () {
        if (timeLeft > 0) {
          alert(`Please wait ${timeLeft} seconds before resending OTP.`);
          return;
        }
        // Reset countdown
        timeLeft = 120;
        resendLink.classList.remove('text-danger');
        alert('A new OTP has been sent to your email.');
      });

      // Cancel button
      document.getElementById('cancelBtn').addEventListener('click', function () {
        if (confirm('Are you sure you want to cancel verification?')) {
          window.location.href = '<?php echo site_url("User_profile/login_form"); ?>';
        }
      });
    });
  </script>
</body>
</html>
