<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="<?php echo base_url('assets/css/user.css'); ?>" rel="stylesheet" />
    <style>

        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
			left:0;
        }

        h1 {
            text-align: center; 
            margin: 20px 250px; 
            padding-left: 10px;
        }

        h3{
            padding: 10px 20px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #2C3E50;
            padding: 10px 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
        }
        
        .huntmlogo {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }
        
        a {
            text-decoration: none;
        }
        
        .navbar-brand {
            color: white;
            font-size: 25px;
            margin: 0;
        }
        
        .main-container {
            display: flex;
            margin-top: 80px;
        }
        
        #sidebar {
            width: 250px;
            height: calc(100vh - 80px);
            background-color: #2C3E50;
            padding-top: 20px;
            position: fixed;
            top: 80px;
            left: 0;
        }
        
        .list-group-item {
            border: none;
            background-color: #2C3E50;
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease; 
        }
        
        /* .list-group-item a:hover {
            background-color: #f1f1f1;
            color: black;
        } */

        .list-group-item:hover {
            background-color: #f1f1f1; 
            color: black; 
            font-weight: bold;
        }
        
        .form-check{
            padding-top: 10px;
            margin-left: 10px;
        }

        .form-check a{
            color: white;
        }

        /* .form-check:hover {
            background-color: #f1f1f1;
            color: black;
        } */
        
        .dropdown-toggle {
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease; 
        }

        .dropdown-toggle:hover {
            /* background-color: white;  */
            transition: background-color 0.3s ease, color 0.3s ease;
            color: black;
            font-weight: bold;
        }

        /* .dropdown-menu {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            width: 100% !important;
        } */
        .dropdown-menu {

        }
        .dropdown-item {
            color: black; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1; 
            color: #2C3E50;
            font-weight: bold;
        }
        .dropdown-item {
            display: block;
            width: 100%; 
            padding: 10px 15px;
            transition: background-color 0.3s ease-in-out;
            white-space: nowrap; 
        }
       
        .navbar .nav-item .nav-link {
            color: #fff; 
            padding: 10px 15px;
            transition: background 0.3s ease-in-out;
        }

        .navbar .nav-item .nav-link:hover,
        .navbar .nav-item .nav-link:focus {
            background: #007bff; 
            color: #fff;
            border-radius: 5px;
        }

    
        .dropdown-menu {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #333;
            padding: 10px 15px;
            transition: background 0.3s ease-in-out;
        }

        .dropdown-item:hover {
            background: #007bff;
            color: #fff;
        }


        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .dropdown-item:hover {
            background-color: rgba(200, 200, 200, 0.4);
            color: black;
        }

        .dropdown:hover {
            background-color: rgba(200, 200, 200, 0.4);
            color: black;
            font-weight: bold;
        }

        .backlogDropdown:hover{
            color: black; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .suggest-form {
            margin-left: 430px;
            margin-top: 50px;
            width: 70%;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .image-section { 
            position: relative; 
            width: 100%; 
            height: 170px; 
            margin-bottom: 15px; 
        } 

        .image-section img { 
            width: 100%; 
            height: 100%; 
            border-radius: 8px; 
            object-fit: cover; 
        } 

        .image-text { 
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            color: white; 
            font-size: 20px; 
            font-weight: bold; 
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); 
        } 

        input, select, textarea { 
            width: 100%; 
            padding: 10px; 
            margin-top: 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            font-size: 14px; 
        } 

        textarea { 
            height: 80px; 
            resize: none; 
        } 

        .buttons { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 10px; 
        } 

        .recording-btn { 
            background: green; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer;
            transition: 0.3s; 
            margin-top: 10px;
        } 

        .recording-btn1 { 
            background: red; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer;
            transition: 0.3s; 
            margin-top: 10px;
        } 

        .submit-btn { 
            width: 100%; 
            background: #28a745; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
            margin-top: 15px; 
            transition: 0.3s; 
        } 

        .submit-btn:hover { 
            background: #218838; 
        } 

        audio { 
            display: block; 
            margin-top: 10px; 
        }

        #timer {
            color: red;
            font-size: 16px;
            font-weight: bold;
            display: none;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .back-btn {
        background: none;
        border: none;
        color: black;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .back-btn i {
        margin-right: 5px;
        font-size: 15px;
    }

    .form-container {
        width: 100%;
        background: white;
        margin-left: 450px;
        margin-top: 50px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    
    .form-container:hover {
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0px 0px 5px rgba(106, 17, 203, 0.5);
    }

    .input-group-text {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: black;
    }

    .btn-primary {
        background: #6a11cb;
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #2575fc;
    }

    .text-danger {
        font-size: 0.875rem;
        margin-top: 5px;
        padding-left: 50px;
    }

    .container {
        width: 100%;
        background: white;
        /* padding: 20px;
        border-radius: 10px; */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin-left: 300px;
        margin-top: 50px;
    }

    .container1 {
        width: 100%;
        background: white;
        /* padding: 20px;
        border-radius: 10px; */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        margin-left: 300px;
        margin-top: 50px;
    }
    
    h2 {
        text-align: center;
        color: #333;
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
    }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .password-hidden {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 5px;
            color: #555;
        }
        .truncate-url {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            vertical-align: middle;
        }
        .btn-copy {
            background: none;
            border: none;
            cursor: pointer;
            color: #007bff;
            font-size: 14px;
        }
        .btn-copy:hover {
            text-decoration: underline;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

	/* for dashboard styles */
         .content {
            margin-left: 260px; /* Push content to the right */
            padding: 20px;
        }
		card{widht:100%;}
		.dashboard-card {
		
            padding: 20px;
			width: 200px;
			height: 100px;
            border-radius: 20px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card-1 { background:rgb(200, 208, 216); color: #333; }
        .card-2 { background: #e3f2fd; color: #01579b; }
        .card-3 { background: #e8f5e9; color: #1b5e20; }
        .card-4 { background: #fff3e0; color: #e65100; }
        .card-5 { background: #fce4ec; color: #880e4f; }
        .card-6 { background: #ede7f6; color: #4527a0; }
        .card-7 { background: #ffebee; color: #b71c1c; }
        .card-8 { background: #e0f7fa; color: #006064; }
        .card-9 { background: #fff8e1; color: #ff8f00; }
        .card-10 { background: #f1f8e9; color: #33691e; }
        .card-11 { background: #ede7f6; color: #4a148c; }
        .card-12 { background: #d7ccc8; color: #5d4037; }
        .card-13 { background: #fbe9e7; color: #bf360c; }
        .card-14 { background: #d1c4e9; color: #311b92; }
        .card-15 { background:rgb(176, 229, 162); color: #283593; }
        .card-16 { background: #b2dfdb; color: #004d40; }
       
        /* Responsive Styles */
        /* Hide hamburger menu on large screens */
        .hamburger {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        position: absolute; 
        right: 20px;
        top: 50%; 
        transform: translateY(-50%); 
    }

        /* Show hamburger menu on small screens */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            #sidebar {
                left: -250px;
                width: 250px;
                height: 100%;
                z-index: 2000;
                transition: left 0.3s ease-in-out;
            }

            #sidebar.active {
                left: 0;
            }

            .main-container {
                margin-top: 60px;
            }

            .suggest-form {
                margin-left: 20px;
                margin-right: 20px;
                width: calc(100% - 40px);
                padding: 15px;
            }

            .form-container{
                margin-left: 20px;
                width: calc(100% - 40px);
            }

            .container{
                margin-left: 20px;
                width: calc(100% - 40px);
            }
            header {
                padding: 10px;
            }

            h1 {
                margin: 20px 0;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .huntmlogo {
                width: 40px;
                height: 40px;
            }

            .navbar-brand {
                font-size: 20px;
            }

            .suggest-form {
                margin-left: 15px;
                width: calc(100% - 20px);
            }

            .form-container{
                margin-left: 20px;
                width: calc(100% - 20px);
            }

            .container {
                margin-left: 10px;
                margin-right: 10px;
                width: calc(100% - 20px);
                padding: 15px; 
                overflow-x: auto; 
            }

            h2 {
                font-size: 20px;
            }

            table {
                width: 100%; 
                font-size: 14px;
                min-width: 600px; 
            }

            th, td {
                padding: 8px;
                white-space: nowrap; 
            }

            .truncate-url {
                max-width: none; 
            }

            .btn-copy {
                font-size: 12px;
            }

            button {
                font-size: 14px; 
                padding: 6px 10px; 
            }
        }

            .image-section {
                height: 120px;
            }

            .image-text {
                font-size: 16px;
            }
        
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo">
            <span class="navbar-brand">Huntm</span>
        </a>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </header>
    
    <div class="main-container">
        <!-- Sidebar -->
        <div id="sidebar" class="border-end">
            <div class="list-group list-group-flush">
                <a href="<?php echo base_url('dashboard'); ?>" class="list-group-item list-group-item-action">Dashboard</a>
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle text-decoration-none d-block px-3 py-2" 
                        href="#" 
                        role="button" 
                        id="websiteDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            File Upload
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="websiteDropdown">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="backlogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Backlog
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                                    <li><a class="dropdown-item" href="<?php echo base_url('WebScrapping'); ?>">Invoice File Upload</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Process File Upload</a></li>
                                </ul>
                            </li>

                            <li><a class="dropdown-item w-100" href="<?php echo base_url('FundBalance/upload_excel'); ?>">Fund Balance</a></li>
                        </ul>
                    </div>
                </div>
                <a href="<?php echo base_url('submitsuggetions'); ?>" class="list-group-item list-group-item-action">Suggestion</a>
                
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle text-decoration-none d-block px-3 py-2" 
                        href="#" 
                        role="button" 
                        id="websiteDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            Website
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="websiteDropdown">
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('addwebsite'); ?>">Add Website</a></li>
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('storewebsite'); ?>">Store Website</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <?php if (isset($method)) { ?>
				
                <!-- Dashboard Section -->
                <?php if ($method == 'dashboard') { ?>
				<!-- <h1>Welcome to Dashboard</h1> -->
				 
<div class="content">
<div class="container-sm mt-3">
<div class="row row-cols-3 g-4 mr-0 pr-0">
    
        <div class="col-md-4">
            <div class="card text-center dashboard-card card-1"  onclick="showDetails('backlog')">
                <h6>👥 Backlog</h6>
                <p class="fs-5">Areas:150</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-2" onclick="showDetails('fundbalance')">
                <h6>📦 Fund Balance</h6>
                <p class="fs-5">Rs:320</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-3"  onclick="showDetails('customers')">
                <h6>💰 Customer Strength</h6>
                <p class="fs-5">12,500</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-4"  onclick="showDetails('sbc')">
                <h6>🛍️ SBC</h6>
                <p class="fs-5">Qty:50</p>
            </div>
        </div>

        <!-- <div class="col">
            <div class="card text-center dashboard-card card-5"  onclick="showDetails('employees')">
                <h6>👨‍💼 Employees</h6>
                <p class="fs-5">30</p>
            </div>
        </div> -->
        <div class="col">
            <div class="card text-center dashboard-card card-6" onclick="showDetails('nilrefill')">
                <h6>📝 Nil Refill</h6>
                <p class="fs-5">85</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-7"  onclick="showDetails('kyc')">
                <h6>🔄  KYC</h6>
                <p class="fs-5">20</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-8"  onclick="showDetails('mi-due')">
                <h6>📈 MI Due</h6>
                <p class="fs-5">$8,000</p>
            </div>
        </div>

        <div class="col">
            <div class="card text-center dashboard-card card-9"  onclick="showDetails('hose-due')">
                <h6>🏭 Hose Due</h6>
                <p class="fs-5">10</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-10"  onclick="showDetails('mobileno')">
                <h6>🆕 Mobile No</h6>
                <p class="fs-5">120</p>
            </div>
        </div>
        <!-- <div class="col-3">
            <div class="card text-center dashboard-card card-11" onclick="showDetails('deliveries')">
                <h6>🚚 Deliveries</h6>
                <p class="fs-5">200</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-12"  onclick="showDetails('pending')">
                <h6>⏳ Pending</h6>
                <p class="fs-5">25</p>
            </div>
        </div>

        <!-- <div class="col-3">
            <div class="card text-center dashboard-card card-13"  onclick="showDetails('shipped')">
                <h6>📦 Shipped</h6>
                <p class="fs-5">180</p>
            </div>
        </div> -
        <div class="col-3">
            <div class="card text-center dashboard-card card-14" onclick="showDetails('canceled')">
                <h6>❌ Canceled</h6>
                <p class="fs-5">15</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-15" onclick="showDetails('reviews')">
                <h6>⭐ Reviews</h6>
                <p class="fs-5">300</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-16" onclick="showDetails('support')">
                <h6>💬 Support Requests</h6>
                <p class="fs-5">40</p>
            </div>
        </div> -->
    </div>
	<!-- 🔽 Details Section Below the Cards -->
    <div id="details" class="mt-4" style="display: none;">
        <h4 id="details-title"></h4>
        <ul id="details-list" class="list-group"></ul>
    </div>
</div>
</div>
                <!-- Invoice Order sevice area -->
                <?php } elseif ($method == 'invoice_order') { ?>
                    <div class="container1">
                        <div class="card shadow p-4">
                            <h2 class="text-center mb-4">Upload Invoice Order Data</h2>

                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php endif; ?>

                            <form action="<?php echo site_url('uploadfile'); ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Choose an Excel file:</label>
                                    <input type="file" name="excel_file" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>

                     <!-- Open Order sevice area -->
                <?php } elseif ($method == 'open_order') { ?>
                    <div class="container">
                        <div class="card shadow-lg p-4">
                            <h2 class="text-center mb-4">Upload Open Order Data</h2>
                            
                            <!-- Display success or error messages -->
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('error'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <p class="text-muted text-center"> <?php echo $message; ?> </p>
                            
                            <form action="<?php echo base_url('uploadfile_openorder'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="excel_file" class="form-label">Select Excel File</label>
                                    <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                                    <div class="invalid-feedback">Please select a valid Excel file.</div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <!-- Fund Balance section -->
                <?php } elseif ($method == 'fund_balance') { ?>
                    <div class="container ">
                        <div class="card shadow p-4">
                            <h2 class="text-center mb-4">Upload Fund Balance Data</h2>
                            
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('error'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <p class="text-muted text-center"> <?php echo $message; ?> </p>
                            
                            <form action="<?php echo site_url('FundBalance/upload_excel'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="excel_file" class="form-label">Select Excel File</label>
                                    <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xls,.xlsx,.csv" required>
                                    <div class="invalid-feedback">Please select a valid Excel file.</div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Upload File</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Suggestion Section -->
                <?php } elseif ($method == 'suggestion') { ?>
                    <div class="suggest-form">
                        <div class="image-section"> 
                            <img src="/Huntm/Image/Suggestion-image.jpg" alt="Suggestion"> 
                        </div>
                        <form id="suggestionForm" method="post" action="<?= base_url('suggestionform'); ?>">
                            
                            <div class="form-group">
                                <input class="form-check-input me-2" type="checkbox" id="anonymous" name="anonymous">
                                <label class="form-check-label" for="anonymous">Submit Anonymously</label>
                            </div>

                            <?php if ($this->session->flashdata('success')): ?>
                                <script>
                                    window.onload = function() {
                                        showAlert("<?php echo $this->session->flashdata('success'); ?>", "success");
                                    };
                                </script>
                            <?php elseif ($this->session->flashdata('error')): ?>
                                <script>
                                    window.onload = function() {
                                        showAlert("<?php echo $this->session->flashdata('error'); ?>", "error");
                                    };
                                </script>
                            <?php endif; ?>
                            <div class="form-group">
                                <select name="application" class="form-control validate" id="application">
                                    <option value="">Application</option>
                                    <option value="SDMS">SDMS</option>
                                    <option value="BI Report">BI Report</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error"><?php echo isset($errors['application']) ? $errors['application'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <select name="suggestion_type" class="form-control validate" id="suggestion_type">
                                    <option value="">Suggestion Type</option>
                                    <option value="Change">Change</option>
                                    <option value="Suggestion">Suggestion</option>
                                </select>
                                <span class="error"><?php echo isset($errors['suggestion_type']) ? $errors['suggestion_type'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-control validate" id="message" placeholder="Enter your message"></textarea>
                                <span class="error"><?php echo isset($errors['message']) ? $errors['message'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="startRecording()" class="recording-btn">Start Recording</button>
                                <button type="button" onclick="stopRecording()" class="recording-btn1">Stop Recording</button>
                                <span id="status"></span>
                                <div id="timer"></div>
                                <audio id="audioPlayback" controls style="display:none;"></audio>
                                <span class="error"><?php echo isset($errors['voice_message']) ? $errors['voice_message'] : ''; ?></span>
                            </div>

                            <?php if (isset($errors['general'])): ?>
                                <div class="alert alert-danger"><?php echo $errors['general']; ?></div>
                            <?php endif; ?>

                            <button type="submit" class="submit-btn">Save</button>
                            <button type="button" class="back-btn" onclick="goBack()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </form>
                    </div>

                    <?php } elseif ($method == 'add_website') { ?>
                        <div class="form-container">
                        <h3 class="text-center mb-4"><i class="fas fa-globe"></i> Add Website</h3>
                        <form action="<?= base_url('submitaddwebite'); ?>" method="POST">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" name="url" class="form-control" placeholder="Website URL" value="<?= set_value('url') ?>">
                                </div>
                                <?php if (!empty($errors['url'])): ?>
                                    <small class="text-danger"><?= $errors['url']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="userId" class="form-control" placeholder="UserId" value="<?= set_value('userId') ?>"> 
                                </div>
                                <?php if (!empty($errors['userId'])): ?>
                                    <small class="text-danger"><?= $errors['userId']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <?php if (!empty($errors['password'])): ?>
                                    <small class="text-danger"><?= $errors['password']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <select name="user_id" class="form-select">
                                        <option value="">Select a user</option>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if (!empty($errors['user_id'])): ?>
                                    <small class="text-danger"><?= $errors['user_id']; ?></small>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>
                    </div>
                    <!-- Display and store website -->
                <?php } elseif ($method == 'store_website') { ?>
                    <div class="container">
                        <h2>Stored Websites</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table">
                            <tr>
                                <th>Website URL</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Login</th>
                            </tr>
                            <?php foreach ($websites as $website): ?>
                                <tr>
                                    <td>
                                        <span class="truncate-url"><?php echo htmlspecialchars($website['website_url']); ?></span>
                                        <button class="btn-copy" onclick="copyToClipboard('<?php echo htmlspecialchars($website['website_url']); ?>')">📋</button>
                                    </td>
                                    <td><?php echo htmlspecialchars($website['website_userId']); ?></td>
                                    <td class="password-hidden">******</td>
                                    <td>
                                        <form action="<?php echo site_url('User/auto_login'); ?>" method="POST">
                                            <input type="hidden" name="url" value="<?php echo htmlspecialchars($website['website_url']); ?>">
                                            <input type="hidden" name="userId" value="<?php echo htmlspecialchars($website['website_userId']); ?>">
                                            <input type="hidden" name="password" value="<?php echo htmlspecialchars($website['website_password']); ?>">
                                            <button type="submit">Auto-Login</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php } else { ?>
                    <h1>Invalid Request</h1>
                <?php } ?>
            <?php } else { ?>
                <h1>Invalid Request</h1>
            <?php } ?>
        </main>
    </div>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.getElementById("hamburger");
            const sidebar = document.getElementById("sidebar");

            hamburger.addEventListener("click", function () {
                sidebar.classList.toggle("active");
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener("click", function (event) {
                if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !hamburger.contains(event.target)) {
                    sidebar.classList.remove("active");
                }
            });
        });
        // Suggetion script
        
        let mediaRecorder;
        let audioChunks = [];
        let audioBase64 = "";
        let timerInterval;
        let startTime;

        function startRecording() {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then((stream) => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();

                    audioChunks = [];
                    mediaRecorder.ondataavailable = (event) => {
                        audioChunks.push(event.data);
                    };

                    document.getElementById('status').innerText = "Recording...";
                    startTimer();
                })
                .catch(() => {
                    alert("Could not access your microphone. Please check permissions.");
                });
        }

        function stopRecording() {
            if (mediaRecorder) {
                mediaRecorder.stop();
                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                    const reader = new FileReader();

                    reader.readAsDataURL(audioBlob);
                    reader.onloadend = () => {
                        audioBase64 = reader.result.split(",")[1]; 
                        document.getElementById('status').innerText = "Recording Stopped.";
                        const audioURL = URL.createObjectURL(audioBlob);
                        const audioPlayer = document.getElementById("audioPlayback");
                        audioPlayer.src = audioURL;
                        audioPlayer.style.display = "block";
                    };
                };
            }
            stopTimer();
        }

        function startTimer() {
            document.getElementById('timer').style.display = "block";
            startTime = Date.now();
            timerInterval = setInterval(() => {
                let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                document.getElementById('timer').innerText = `Recording: ${elapsedTime}s`;
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            document.getElementById('timer').innerText = "Recording Stopped.";
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("suggestionForm");

            form.addEventListener("submit", (e) => {
                if (!validateForm()) {
                    e.preventDefault();
                } else {
                    const audioInput = document.createElement("input");
                    audioInput.type = "hidden";
                    audioInput.name = "voice_message";
                    audioInput.value = audioBase64;
                    form.appendChild(audioInput);
                }
            });

            function validateForm() {
                let isValid = true;
                let fields = document.querySelectorAll('.validate');

                fields.forEach(field => {
                    let errorSpan = field.nextElementSibling;
                    if (field.value.trim() === '') {
                        let fieldName = field.getAttribute("name");
                        let errorMessage = getErrorMessage(fieldName);
                        errorSpan.textContent = errorMessage;
                        isValid = false;
                    } else {
                        errorSpan.textContent = '';
                    }
                });

                return isValid;
            }

            function getErrorMessage(fieldName) {
                switch (fieldName) {
                    case "application":
                        return "Please select an Application.";
                    case "suggestion_type":
                        return "Please choose a Suggestion Type.";
                    case "message":
                        return "Please enter your Message.";
                    default:
                        return "This field is required.";
                }
            }

            document.querySelectorAll(".validate").forEach(input => {
                input.addEventListener("input", () => {
                    const error = input.nextElementSibling;
                    error.textContent = "";
                });
            });
        });

        document.getElementById("anonymous").addEventListener("change", function() {
            let nameField = document.getElementById("name");
            if (this.checked) {
                nameField.value = "";
                nameField.disabled = true;
            } else {
                nameField.disabled = false;
            }
        });

        function goBack() {
            window.location.href = "<?= base_url('user/login_user'); ?>"; // Adjust this to your login route
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Copied to clipboard!");
            });
        }

		function showDetails(type) {
    let title = document.getElementById('details-title');
    let list = document.getElementById('details-list');
    let detailsSection = document.getElementById('details');

    list.innerHTML = ''; // Clear previous data

    if (type === 'backlog') {
        title.innerText = '👥 Backlog';
        list.innerHTML = `
            <li class="list-group-item"> No of.Area : 50</li>
            <li class="list-group-item"> 🕒 Pending Qty: 2</li>
            <li class="list-group-item"> ✅ Open Qty: 50</li>
			<li class="list-group-item">  Total : 52</li>`;
    } 
    else if (type === 'fundbalance') {
        title.innerText = '📦 fundbalance Details';
        list.innerHTML = `
            <li class="list-group-item">Balance 💲123 </li>`;
    } 
    else if (type === 'revenue') {
        title.innerText = '💰 Revenue Breakdown';
        list.innerHTML = `
            <li class="list-group-item">January: 💲3,500</li>
            <li class="list-group-item">February: 💲4,200</li>`;
    } 
    else if (type === 'sbc') {
        title.innerText = '🛍️ SBC Customers';
        list.innerHTML = `
            <li class="list-group-item"> Qty : 100 </li>
            <li class="list-group-item"> Percentage: 10%</li>`;
    } 
    else if (type === 'customers') {
        title.innerText = '👨‍💼 Customers Strength';
        list.innerHTML = `
            <li class="list-group-item"> Active: 450 </li>
            <li class="list-group-item"> Suspended : 5</li>
			<li class="list-group-item"> Deactived: 40 </li>`;
    } 
	
    else if (type === 'nilrefill') {
        title.innerText = '🚛 Nilrefill List';
        list.innerHTML = `
            <li class="list-group-item"> Less than 6 months.</li>
			<ul>
			<li class="list-group-item"> Qty:</li>
			<li class="list-group-item"> Percentage:</li>
			</ul>
            <li class="list-group-item"> Less than 1 Year.</li>
			<ul>
			<li class="list-group-item"> Qty:</li>
			<li class="list-group-item"> Percentage:</li>
			</ul>
			`;
    } 
	else if (type === 'kyc') {
        title.innerText = '📉 KYC Pending';
        list.innerHTML = `
            <li class="list-group-item">PMUY </li>
			<ul>
			<li>Qty</li>
			<li>Percentage</li>
			</ul>
            <li class="list-group-item">Utilities: 💲800</li>`;
    } 
    // else if (type === 'kyc') {
    //     title.innerText = '📉 Expense Report';
    //     list.innerHTML = `
    //         <li class="list-group-item">Rent: 💲1,500</li>
    //         <li class="list-group-item">Utilities: 💲800</li>`;
    // } 
    else if (type === 'profits') {
        title.innerText = '📈 Profit Summary';
        list.innerHTML = `
            <li class="list-group-item">January: 💲3,000</li>
            <li class="list-group-item">February: 💲3,900</li>`;
    }

    detailsSection.style.display = 'block';
}

    </script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
	
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    title: "Success!",
                    text: "<?php echo $this->session->flashdata('success'); ?>",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            <?php elseif ($this->session->flashdata('error')): ?>
                Swal.fire({
                    title: "Error!",
                    text: "<?php echo $this->session->flashdata('error'); ?>",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            <?php endif; ?>
        });

	
        // Add expand/collapse effect to icons into dashboard
        document.querySelectorAll(".dashboard-card").forEach(card => {
            card.addEventListener("click", function() {
                let icon = this.querySelector(".expand-icon");
                icon.classList.toggle("expand");
            });
        });
  
    </script>
</body>
</html>
