<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/img/pciLogoTitle.png" rel="icon" />
    <title>Admin - Santhosham</title>
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
    <!-- Image Cropper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center shadow">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="<?php echo base_url(); ?>" target="blank" class="logo d-flex align-items-center"
                style="font-size:24px">
                <img src="<?php echo base_url(); ?>assets/img/pciIndiaLogo.png" alt="Logo"
                    style="widht:90px; height:45px" class="ps-5">
            </a>
        </div>

        <nav class="header-nav ms-auto me-4">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown d-flex justify-content-evenly">
                    <i class="bi bi-person-circle fs-3 d-none d-md-block"></i>
                    <div class="text-dark ps-3">
                        <p class=" d-block text-dark w-100 my-auto">
                            <!-- <?php echo $_SESSION['adminName']; ?> -->
                            Murugesh
                        </p>
                        <span class="d-block fw-medium" style="font-size:16px;color: #0079AD;">Admin</span>
                        <!-- <?php echo $_SESSION['userRole']; ?> -->
                    </div>

                    <div class="text-dark d-none d-md-block ps-5 pe-2 my-auto">
                        <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                            class=" d-block fw-medium w-100 me-2 my-auto" style="color: #B7321E;">
                            <img src="<?php echo base_url(); ?>assets/img/logoutIcon.png" alt="Logout"> Logout
                        </a>
                    </div>
                    <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#confirmLogout"
                        class="text-danger fw-medium w-100 d-block d-md-none me-2 my-auto ps-3">
                        <img src="<?php echo base_url(); ?>assets/img/logoutIcon.png" alt="Logout">
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <aside id="sidebar" class="sidebar" style="background-color: #0D4978;">
        <ul class="sidebar-nav pt-5 ps-4" id="sidebar-nav">
            <li class="">
                <a href="<?php echo base_url() . "admin/dashboard" ?>" class="text-light"
                    style="font-size: 18px; font-weight: 400;" id="dashboard">
                    <img src="<?php echo base_url(); ?>assets/img/dashboardIcon.svg" alt="icon">
                    <span class="ps-3">Dashboard</span>
                </a>
            </li>
            <li class="pt-4">
                <a href="<?php echo base_url() . "admin/doctors" ?>" class="text-light"
                    style="font-size: 18px; font-weight: 400;" id="doctors">
                    <img src="<?php echo base_url(); ?>assets/img/doctorIcon.svg" alt="icon">
                    <span class="ps-3">Doctors</span>
                </a>
            </li>
            <li class="pt-4">
                <a href="<?php echo base_url() . "admin/nurses" ?>" class="text-light"
                    style="font-size: 18px; font-weight: 400;" id="nurses">
                    <img src="<?php echo base_url(); ?>assets/img/nurseIcon.svg" alt="icon">
                    <span class="ps-3"> Nurses</span>
                </a>
            </li>
            <li class="pt-4">
                <a href="<?php echo base_url() . "admin/patients" ?>" class="text-light"
                    style="font-size: 18px; font-weight: 400;" id="patients">
                    <img src="<?php echo base_url(); ?>assets/img/patientIcon.svg" alt="icon">
                    <span class="ps-3"> Patients</span>
                </a>
            </li>
        </ul>
    </aside>

    <main id="main" class="main">
        <!-- Message display -->
        <?php if ($this->session->flashdata('successMessage')) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color: #d4edda;color: #155724;padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $this->session->flashdata('successMessage'); ?>
            </div>
        <?php } elseif ($this->session->flashdata('errorMessage')) { ?>
            <div id="display_message"
                style="position: absolute;top: 2px;left: 50%;transform: translateX(-50%);background-color:rgb(237, 212, 212);color:rgb(87, 21, 21);padding: 20px 30px;border: 1px solid #c3e6cb;border-radius: 5px;text-align: center;z-index: 9999;">
                <?php echo $this->session->flashdata('errorMessage'); ?>
            </div>
        <?php }
        if ($method == "dashboard") {
            ?>
            <script>
                document.getElementById('dashboard').style.fontWeight = "700";
                document.getElementById('dashboard').style.fontSize = "20px";
            </script>
            <section>
                <div class="card rounded m-2 p-4">
                    <div class="d-flex rounded ms-2 pe-5"
                        style="background-color: #0D4978;height:220px;box-shadow: 0px 4px 4px rgba(13, 73, 120, 0.7);outline: 2px solid white;">
                        <div class="col-9 text-light p-4 pe-md-5">
                            <p id="dashboardGreeting" class="fw-medium"></p>
                            <p class="fw-semibold fs-4"> <!-- <?php echo $_SESSION['adminName']; ?> --> Murugesh </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-3">
                            <img src="<?php echo base_url(); ?>assets/img/dasboardImage.png" alt="Dashboard Image"
                                height="220" widht="220">
                        </div>
                    </div>

                    <div class="mt-5 p-2">
                        <div class="row ">
                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #B7321E; border-radius: 12px;"
                                        onmouseover="this.style.border='3px solid #B7321E';"
                                        onmouseout="this.style.border='1px solid #B7321E';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/doctorsAD.svg" alt="Doctors icon"
                                                width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">005</p>
                                                <p class="mt-0">Doctors</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/doctors" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #B7321E;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #0079AD; border-radius: 12px;"
                                        onmouseover="this.style.border='3px solid #0079AD';"
                                        onmouseout="this.style.border='1px solid #0079AD';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/nursesAD.svg" alt="Nurses icon"
                                                width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">005</p>
                                                <p class="mt-0">Nurses</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/nurses" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #0079AD;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #00AD8E; border-radius: 12px;"
                                        onmouseover="this.style.border='2px solid #00AD8E';"
                                        onmouseout="this.style.border='1px solid #00AD8E';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/patientsAD.svg"
                                                alt="Patients icon" width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">005</p>
                                                <p class="mt-0">Patients</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/patients" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #00AD8E;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="row ">
                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #1FAACD; border-radius: 12px;"
                                        onmouseover="this.style.border='3px solid #1FAACD';"
                                        onmouseout="this.style.border='1px solid #1FAACD';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/hospitalsAD.svg"
                                                alt="Hospitals icon" width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">002</p>
                                                <p class="mt-0">Hospitals</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/dashboard" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #1FAACD;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #BF9ACE; border-radius: 12px;"
                                        onmouseover="this.style.border='3px solid #BF9ACE';"
                                        onmouseout="this.style.border='1px solid #BF9ACE';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/labsAD.svg" alt="Labs icon"
                                                width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">000</p>
                                                <p class="mt-0">Labs</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/dashboard" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #BF9ACE;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div class="card position-relative">
                                    <div class="card-body py-4" style="border: 1px solid #F3797E; border-radius: 12px;"
                                        onmouseover="this.style.border='2px solid #F3797E';"
                                        onmouseout="this.style.border='1px solid #F3797E';">
                                        <div class="d-flex pb-3">
                                            <img src="<?php echo base_url(); ?>assets/img/pharmacysAD.svg"
                                                alt="Pharmacys icon" width="64" height="64">
                                            <div class="ps-3">
                                                <p class="fw-medium mb-0" style="font-size:26px;">000</p>
                                                <p class="mt-0">Pharmacy</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo base_url() . "admin/dashboard" ?>"
                                            class="small position-absolute bottom-0 end-0 m-3" style="color: #F3797E;"
                                            onmouseover="this.style.textDecoration='underline'"
                                            onmouseout="this.style.textDecoration='none'">
                                            View All <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>

        <?php } elseif ($method == "doctors") {
            ?>
            <script>
                document.getElementById('doctors').style.fontWeight = "700";
                document.getElementById('doctors').style.fontSize = "20px";
            </script>
            <section>
                <div class="card rounded m-2 p-4">
                    Doctors List
                </div>
            </section>

        <?php } elseif ($method == "nurses") {
            ?>
            <script>
                document.getElementById('nurses').style.fontWeight = "700";
                document.getElementById('nurses').style.fontSize = "20px";
            </script>
            <section>
                <div class="card rounded m-2 p-4">
                    Nurses List
                </div>
            </section>

        <?php } elseif ($method == "patients") {
            ?>
            <script>
                document.getElementById('patients').style.fontWeight = "700";
                document.getElementById('patients').style.fontSize = "20px";
            </script>
            <section>
                <div class="card rounded m-2 p-4">
                    Patients List
                </div>
            </section>

            <?php
        } ?>

        <!-- Log out confirmation -->
        <div class="modal fade" id="confirmLogout" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium" id="confirmLogoutLabel">Confirm Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to log out?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url() . 'admin/logout'; ?>">
                            <button class="btn text-light" style="background-color: #0D4978;">Logout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Dashboard greeting -->
    <script>
        const hour = new Date().getHours();
        const greeting = hour < 12 ? "Good Morning," :
            hour < 17 ? "Good Afternoon," : "Good Evening,";
        document.getElementById("dashboardGreeting").innerText = greeting;
    </script>
    <!-- Display message for 3 seconds  -->
    <script>
        setTimeout(() => {
            const displayMessage = document.getElementById('display_message');
            if (displayMessage) {
                displayMessage.style.display = 'none';
            }
        }, 3000);
    </script>
    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>