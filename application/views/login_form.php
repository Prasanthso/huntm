<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            background-color: #2C3E50; 
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
        .login-page {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding-top: 80px;
        }

        .reg_content {
            padding-left: 5%;
        }

        .reg_content h1 {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }

        .reg_content p {
            font-size: 20px;
            color: white;
            padding: 5px 0;
        }

        .reg_content i {
            font-size: 20px;
            padding-right: 10px;
            color: #0000FF; /* Blue color for Bootstrap Icons */
        }

        .reg_container {
            max-width: 700px;
            margin: 40px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
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
        
        .btn-primary {
            background: #510AC9;
            border: none;
        }
        .btn-primary:hover {
            background: #3A0C91;
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

        .error {
            color: red;
            font-size: 14px;
        }

        @media (min-width: 768px) {
            .reg_container {
                max-width: 600px;
            }
        }

        @media (min-width: 1024px) {
            .reg_container {
                max-width: 700px;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="text-white text-decoration-none d-flex align-items-center">
            <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo me-2"> 
            <h1 class="h4 m-0">Huntm</h1>
        </a>
    </header>

    <div class="login-page container">
        <div class="reg_content">
            <h1>Keep your customers engaged</h1>
            <p><i class="bi bi-chevron-right"></i>Send campaigns to customers</p>
            <p><i class="bi bi-chevron-right"></i>Track the results</p>
            <p><i class="bi bi-chevron-right"></i>Manage customers</p>
            <p><i class="bi bi-chevron-right"></i>Get insights</p>
        </div>

        <div class="reg_container shadow">
            <h2 class="fw-bold text-dark">LOG IN</h2>
            <form method="post" action="<?= base_url('loginuser') ?>">
                <?php $errors = $this->session->flashdata('errors') ?? []; ?>

                <div class="mb-3">
                    <input type="text" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           placeholder="Mobile Number or Email Id"
                           value="<?= htmlspecialchars($this->session->flashdata('email') ?? '') ?>">
                    <div class="invalid-feedback"><?= $errors['email'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                           placeholder="Password">
                    <div class="invalid-feedback"><?= $errors['password'] ?? ''; ?></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <a href="<?php echo base_url('forgot-password'); ?>" class="d-block mt-2 text-primary">Forgot Password?</a>
                <p class="mt-2">New to amudhu.in? <a href = "<?php echo base_url('signup'); ?>" class="text-primary fw-bold">Register</a></p>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($this->session->flashdata('login_success')): ?>
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                setTimeout(() => {
                    window.location.href = "<?= base_url('suggestionform') ?>";
                }, 2000);
            <?php endif; ?>
        });
    </script>
</body>
</html>