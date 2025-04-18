<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url('/Huntm/assets/css/registrationform.css'); ?>"> -->

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
            background-color:#2C3E50; 
            padding: 10px 20px;
            z-index: 1000;
        }

        a {
            text-decoration: none;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap:20px;
            margin-top: 50px;
        }

        .reg_container{
            background: #fff;
            padding: 20px;
            width: 450px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-left: 30%;
            margin-top: 10%;
        }
        
        .reg_content {
            padding-top: 1%;
            position: relative;
            right: 15%;
        }

        .reg_content h1 {
            font-size: 50px;
            font-weight: bold;
            padding-top: 50px;
            color: white;
        }

        .reg_content p {
            text-align: left;
            display: flex;
            align-items: center;
            font-size: 20px;
            color: white;
            padding:5px 0;
        }

        .reg_content i {
            font-size: 20px;
            padding-right: 10px;
            color:#0000FF;
        }

        .huntmlogo {
            width:60px;
            height:60px;
            padding: 10px 0; 
            margin: 0 20px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .invalid {
            border-color: red;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .icon-box {
            display: inline-block;
            width: 100px;
            height: 30px;
            margin: 5px;
            text-align: center;
            vertical-align: middle;
            line-height: 35px;
            border: 1px solid;
            border-radius: 5px;
            position:relative;
            left:30px; 
        }

        .icon-box i {
            color: black;
            font-size: 20px;
        }

    </style>
    
</head>
<body>
<header>
        <a href="#"><h1 style="font-size:25px; color:white;"><img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo">Huntm</h1></a>
</header>
<div class="container">
    

    <div class="reg_content">
        <h1>Keep your customers <br> engaged with your <br> business</h1>
        <p><i class="fas fa-chevron-right"></i>Send campaigns to your customers</p>
        <p><i class="fas fa-chevron-right"></i>Track the results</p>
        <p><i class="fas fa-chevron-right"></i>Manage your customers</p>
        <p><i class="fas fa-chevron-right"></i>Get insights</p>
    </div>

    <div class="reg_container">
        <h2>CREATE ACCOUNT</h2>
        <form method="POST" action="">  <!--"<?= base_url('signupsubmit') ?>" id="singupform">-->
            <?php 
                $errors = $this->session->flashdata('errors') ?? [];
                $old_data = $this->session->flashdata('old_data') ?? [];
            ?>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="<?= isset($errors['email']) ? 'invalid' : '' ?>" value="<?= $old_data['email'] ?? '' ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="firstname" placeholder="First Name" 
                            class="form-control <?= isset($errors['firstname']) ? 'invalid' : '' ?>" 
                            value="<?= $old_data['firstname'] ?? '' ?>">
                        <?php if (isset($errors['firstname'])): ?>
                            <div class="error"><?= $errors['firstname'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lastname" placeholder="Last Name" 
                            class="form-control <?= isset($errors['lastname']) ? 'invalid' : '' ?>" 
                            value="<?= $old_data['lastname'] ?? '' ?>">
                        <?php if (isset($errors['lastname'])): ?>
                            <div class="error"><?= $errors['lastname'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="phone" placeholder="Mobile Number" class="<?= isset($errors['phone']) ? 'invalid' : '' ?>" value="<?= $old_data['phone'] ?? '' ?>">
                <?php if (isset($errors['phone'])): ?>
                    <div class="error"><?= $errors['phone'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="<?= isset($errors['username']) ? 'invalid' : '' ?>" value="<?= $old_data['username'] ?? '' ?>">
                <?php if (isset($errors['username'])): ?>
                    <div class="error"><?= $errors['username'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="<?= isset($errors['password']) ? 'invalid' : '' ?>">
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <select name="role" placeholder="Role" class="<?= isset($errors['role']) ? 'invalid' : '' ?>">
                    <option value="">User Role</option>
                    <option value="distributor">Distributor</option>
                    <option value="manager">Manager</option>
                    <option value="staff">Staff</option>
                    <option value="fieldofficer">Field Officer</option>
                </select>

                <?php if (isset($errors['role'])): ?>
                    <div class="error"><?= $errors['role'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="text" name="address" placeholder="Address" class="<?= isset($errors['address']) ? 'invalid' : '' ?>">
                <?php if (isset($errors['address'])): ?>
                    <div class="error"><?= $errors['address'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="pincode" placeholder="Pincode" 
                            class="form-control <?= isset($errors['pincode']) ? 'invalid' : '' ?>" 
                            value="<?= $old_data['pincode'] ?? '' ?>">
                        <?php if (isset($errors['pincode'])): ?>
                            <div class="error"><?= $errors['pincode'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="city" placeholder="City" 
                            class="form-control <?= isset($errors['city']) ? 'invalid' : '' ?>" 
                            value="<?= $old_data['city'] ?? '' ?>">
                        <?php if (isset($errors['city'])): ?>
                            <div class="error"><?= $errors['city'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="officemaplink" placeholder="Officemaplink" class="<?= isset($errors['officemaplink']) ? 'invalid' : '' ?>">
                <?php if (isset($errors['officemaplink'])): ?>
                    <div class="error"><?= $errors['officemaplink'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <input type="text" name="officenumber" placeholder="Officenumber" class="<?= isset($errors['officenumber']) ? 'invalid' : '' ?>">
                <?php if (isset($errors['officenumber'])): ?>
                    <div class="error"><?= $errors['officenumber'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Sign Up</button>
            <p style="text-align:center; padding-top: 10px;">Already have an account? <a href="<?php echo base_url('loginform');?>">Login</a></p>

        </form>
        <!-- <div class="icon-box">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
            <div class="icon-box">
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="icon-box">
                <a href="#"><i class="fab fa-github"></i></a>
            </div> -->

    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
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
    });
</script>
<!-- <script src="application/views/javascript/user.js"></script> -->
</body>
</html>
