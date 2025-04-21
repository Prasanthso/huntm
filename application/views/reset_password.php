<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #eceff1; /* Soft gray for a professional look */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Roboto Slab', serif; /* Classic, professional font */
        }
        .navbar {
            background-color: #2c3e50; /* Maintain original dark navy */
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        .huntmlogo {
            height: 40px;
            width: auto;
        }
        .navbar-brand {
            font-weight: 700;
            color: #ffffff !important;
        }
        .card {
            border: none;
            border-radius: 8px;
            margin-top: 5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow for elegance */
        }
        .card-header {
            background-color: #007bff; /* Maintain original blue */
            border-radius: 8px 8px 0 0;
            padding: 1.5rem;
            color: #ffffff;
            font-weight: 700;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px); /* Subtle lift effect */
        }
        .form-control {
            border-radius: 5px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .back-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .save_button {
            background-color: #28a745; /* Professional green */
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            color: #ffffff;
            font-weight: 500;
        }
        .save_button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .card-body {
            background-color: #ffffff;
            border-radius: 0 0 8px 8px;
            padding: 2rem;
        }
        .form-label {
            font-weight: 500;
            color: #343a40;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="#" class="navbar-brand text-white d-flex align-items-center">
                <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo me-2">
                <span class="h4 m-0">Huntm</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-key-fill me-2"></i>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('errors')): ?>
                            <div class="alert alert-danger d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $this->session->flashdata('errors'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url('update-password'); ?>" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            <div class="mb-3">
                                <label for="new_password" class="form-label"><i class="bi bi-lock-fill me-2"></i>New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label"><i class="bi bi-lock-fill me-2"></i>Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn save_button w-100">
                                <i class="bi bi-save-fill me-2"></i>Save Password
                            </button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="<?php echo base_url('loginform'); ?>" class="back-link">
                                <i class="bi bi-arrow-left me-2"></i>Back to Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>