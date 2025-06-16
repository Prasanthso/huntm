<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Signup Form</title>
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
            margin: 0 20px;
        }


        .reg-content {
            padding: 20px;
            color: white;
        }


        .reg-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }


        .reg-content p {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
        }


        .reg-content i {
            font-size: 1.2rem;
            padding-right: 10px;
            color: #0000FF;
        }


        .reg-container {
            background: #fff;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin: 2rem auto;
            max-width: 450px;
        }


        .reg-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }


        .form-group {
            margin-bottom: 1rem;
        }


        .error {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }


        .invalid {
            border-color: red !important;
        }


        .btn-primary {
            width: 100%;
            padding: 10px;
        }


        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }


        .toast {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }


        .toast-success .toast-header {
            background-color: #28a745;
            color: white;
        }


        .toast-error .toast-header {
            background-color: #dc3545;
            color: white;
        }


        @media (max-width: 992px) {
            .row.min-vh-100 {
                flex-direction: column;
            }


            .reg-content,
            .reg-container {
                width: 100%;
                max-width: 100%;
                padding: 1rem;
            }


            .reg-content {
                padding-top: 5rem;
                text-align: left;
            }


            .reg-content h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>


<body>
    <header class="d-flex align-items-center">
        <a href="#" class="d-flex align-items-center text-decoration-none">
            <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo">
            <h1 style="font-size:25px; color:white;">Huntm</h1>
        </a>
    </header>


    <!-- Toast Notification Container -->
    <div class="toast-container">
        <div id="toastNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>


    <div class="container-fluid mt-5 pt-5">
        <div class="row min-vh-100">
            <!-- Left Content -->
            <div class="col-lg-6">
                <div class="reg-content">
                    <h1>Keep your customers engaged with your business</h1>
                    <p><i class="fas fa-chevron-right"></i>Send campaigns to your customers</p>
                    <p><i class="fas fa-chevron-right"></i>Track the results</p>
                    <p><i class="fas fa-chevron-right"></i>Manage your customers</p>
                    <p><i class="fas fa-chevron-right"></i>Get insights</p>
                </div>
            </div>


            <!-- Right Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="reg-container">
                    <h2>CREATE ACCOUNT</h2>
                    <form method="POST" action="<?= base_url('signupsubmit') ?>">
                        <?php
                        $errors = $this->session->flashdata('errors') ?? [];
                        $old_data = $this->session->flashdata('old_data') ?? [];
                        ?>


                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email"
                                class="form-control <?= isset($errors['email']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['email'] ?? '') ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="firstname" placeholder="First Name"
                                    class="form-control <?= isset($errors['firstname']) ? 'invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old_data['firstname'] ?? '') ?>">
                                <?php if (isset($errors['firstname'])): ?>
                                    <div class="error"><?= htmlspecialchars($errors['firstname']) ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="lastname" placeholder="Last Name"
                                    class="form-control <?= isset($errors['lastname']) ? 'invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old_data['lastname'] ?? '') ?>">
                                <?php if (isset($errors['lastname'])): ?>
                                    <div class="error"><?= htmlspecialchars($errors['lastname']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Mobile Number"
                                class="form-control <?= isset($errors['phone']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['phone'] ?? '') ?>">
                            <?php if (isset($errors['phone'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['phone']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="sap_code" placeholder="Sap Code"
                                class="form-control <?= isset($error['sap_code'])? 'invliad' : ''?>"
                                value="<?= htmlspecialchars($old_data['sap_code'] ?? '') ?>">
                            <?php if(isset($error['sap_code'])): ?>
                                <div class="error"><?= htmlspecialchars($error['sap_code']) ?></div>
                             <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="text" name="bank_details" placeholder="Bank Details"
                                class="form-control <?= isset($error['bank_details'])? 'invliad' : ''?>"
                                value="<?= htmlspecialchars($old_data['bank_details'] ?? '') ?>">
                            <?php if(isset($error['bank_details'])): ?>
                                <div class="error"><?= htmlspecialchars($error['bank_details']) ?></div>
                             <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="text" name="userID" placeholder="UserID"
                                class="form-control <?= isset($errors['userID']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['userID'] ?? '') ?>">
                            <?php if (isset($errors['userID'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['userID']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password"
                                class="form-control <?= isset($errors['password']) ? 'invalid' : '' ?>">
                            <?php if (isset($errors['password'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['password']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group">
                            <select name="role" title="User Role" class="form-control">
                                <option value="">User Role</option>
                                <option value="distributor" <?= isset($old_data['role']) && $old_data['role'] == 'distributor' ? 'selected' : '' ?>>Distributor</option>
                                <option value="manager" <?= isset($old_data['role']) && $old_data['role'] == 'manager' ? 'selected' : '' ?>>Manager</option>
                                <option value="staff" <?= isset($old_data['role']) && $old_data['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                                <option value="fieldofficer" <?= isset($old_data['role']) && $old_data['role'] == 'fieldofficer' ? 'selected' : '' ?>>Field Officer</option>
                            </select>
                            <?php if (isset($errors['role'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['role']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group">
                            <input type="text" name="address" placeholder="Address"
                                class="form-control <?= isset($errors['address']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['address'] ?? '') ?>">
                            <?php if (isset($errors['address'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['address']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="pincode" placeholder="Pincode"
                                    class="form-control <?= isset($errors['pincode']) ? 'invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old_data['pincode'] ?? '') ?>">
                                <?php if (isset($errors['pincode'])): ?>
                                    <div class="error"><?= htmlspecialchars($errors['pincode']) ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="city" placeholder="City"
                                    class="form-control <?= isset($errors['city']) ? 'invalid' : '' ?>"
                                    value="<?= htmlspecialchars($old_data['city'] ?? '') ?>">
                                <?php if (isset($errors['city'])): ?>
                                    <div class="error"><?= htmlspecialchars($errors['city']) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="text" name="officemaplink" placeholder="Office Map Link"
                                class="form-control <?= isset($errors['officemaplink']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['officemaplink'] ?? '') ?>">
                            <?php if (isset($errors['officemaplink'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['officemaplink']) ?></div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group">
                            <input type="text" name="officenumber" placeholder="Office Number"
                                class="form-control <?= isset($errors['officenumber']) ? 'invalid' : '' ?>"
                                value="<?= htmlspecialchars($old_data['officenumber'] ?? '') ?>">
                            <?php if (isset($errors['officenumber'])): ?>
                                <div class="error"><?= htmlspecialchars($errors['officenumber']) ?></div>
                            <?php endif; ?>
                        </div>


                        <button type="submit" class="btn btn-primary mt-3">Sign Up</button>


                        <p class="text-center mt-3">Already have an account? <a
                                href="<?php echo base_url('loginform'); ?>">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Clear invalid classes on input
            let inputs = document.querySelectorAll("input, select, textarea");
            inputs.forEach(input => {
                input.addEventListener("input", function () {
                    if (this.classList.contains("invalid")) {
                        this.classList.remove("invalid");
                        let errorDiv = this.nextElementSibling;
                        if (errorDiv && errorDiv.classList.contains("error")) {
                            errorDiv.remove();
                        }
                    }
                });
            });


            // Toast notification handling
            const toastEl = document.getElementById('toastNotification');
            const toastBody = toastEl.querySelector('.toast-body');
            const toast = new bootstrap.Toast(toastEl);


            <?php if ($this->session->flashdata('success')): ?>
                toastEl.classList.add('toast-success');
                toastBody.textContent = '<?php echo addslashes($this->session->flashdata("success")); ?>';
                toast.show();
            <?php endif; ?>


            <?php if ($this->session->flashdata('error')): ?>
                toastEl.classList.add('toast-error');
                toastBody.textContent = '<?php echo addslashes($this->session->flashdata("error")); ?>';
                toast.show();
            <?php endif; ?>


            // Remove toast classes after hide
            toastEl.addEventListener('hidden.bs.toast', function () {
                toastEl.classList.remove('toast-success', 'toast-error');
            });
        });
    </script>
</body>


</html>
