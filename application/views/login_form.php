<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif; 
            font-size: 16px; 
            font-weight: 400; 
            color: #333; 
            line-height: 1.6;
            background-color: #2C3E50;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color:#2C3E50; 
            padding: 10px 20px;
            z-index: 1000;
        }
        
        .huntmlogo {
            width: 60px;
            height: 60px;
            padding: 10px 0;  
        }
        
        a {
            text-decoration: none;
        }
        
        .login-page{
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap:20px;
            margin-top: 100px;
        }

        .reg_content {
            padding-left: 5%;
        }

        .reg_content h1 {
            font-size: 50px;
            font-weight: bold;
            color: white;
        }

        .reg_content p {
            font-size: 20px;
            color: white;
            padding:5px 0;
        }

        .reg_content i {
            font-size: 20px;
            padding-right: 10px;
            color:#0000FF;
        }

        .reg_container {
            max-width: 700px;
            margin: 40px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px; 
        }

        .reg_container h2 {
            font-weight: bold;
            color: #3a3a3a;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #510AC9;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
        }

        .register-link {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }

        .register-link a {
            color: #510AC9;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <a href="#"><h1 style="font-size:25px; color:white;">
            <img src="/Huntm/Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo"> Huntm
        </h1></a>
    </header>

    <div class="login-page">
        <div class="reg_content">
            <h1>Keep your customers engaged</h1>
            <p><i class="fas fa-chevron-right"></i>Send campaigns to customers</p>
            <p><i class="fas fa-chevron-right"></i>Track the results</p>
            <p><i class="fas fa-chevron-right"></i>Manage customers</p>
            <p><i class="fas fa-chevron-right"></i>Get insights</p>
        </div>

        <div class="reg_container">
            <h2>LOG IN</h2>
            <form method="post" action="<?= base_url('loginuser') ?>">
                <?php $errors = $this->session->flashdata('errors') ?? []; ?>

                <div class="mb-3">
                    <input type="text" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           placeholder="Mobile Number or Email Id" value="<?= $this->session->flashdata('email') ?? '' ?>">
                    <div class="error"><?= $errors['email'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
					    placeholder="Password">
                    <div class="error"><?= $errors['password'] ?? ''; ?></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <a href="#" class="forgot-password">Forgot Password?</a>
                <p class="register-link">New to Huntm.in? <a href = "<?php echo base_url('signup'); ?>" >Register</a></p>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Login Successful</h5>
                </div>
                <div class="modal-body">
                    You have logged in successfully!
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for showing success modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php if ($this->session->flashdata('login_success')): ?>
    <script>
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(() => {
                window.location.href = "<?= base_url('suggestionform') ?>";
            }, 2000);
        };
    </script>
    <?php endif; ?>
</body>
</html>
