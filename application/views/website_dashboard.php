<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/css/report_page.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/css/dashboard.css">
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
        a:hover{
            color: black;
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
        
        .list-group-item a:hover {
            background-color: #f1f1f1;
            color: black;
        }

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

        .dropdown-toggle a:hover {
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
            color: black; 
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

        .dropdown-item a:hover {
            background-color: rgba(200, 200, 200, 0.4);
            color: black;
        }

        .dropdown-toggle a:hover {
            background-color: white; 
            color: black; 
            font-weight: bold; 
            transition: background-color 0.3s ease, color 0.3s ease; 
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
        margin-left: 370px;
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

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 100%;
            left: 0;
            margin-top: -1px;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        .list-group-item.active {
            background-color: #007bff;
            color: white;
        }

        .list-group-item:hover {
            background-color: #f8f9fa; 
            color: black; 
        }

        .fileupload{
            color: white;
            background-color: #2C3E50; 
        }

        .fileupload:hover{
            background-color: white; 
            color: black; 
            font-weight: bold; 
            transition: background-color 0.3s ease, color 0.3s ease; 
        }
	/* for dashboard styles */
         .content {
            margin-left: 260px; /* Push content to the right */
            padding: 20px;
        }
		/* card{width:100%;} */
		.dashboard-card {
		
            padding: 20px;
			width: 200px;
			height: 150px;
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

			/* .table{
				width: 50%;
			
			}  */
			/* .table th{font-size: 12px;width:10%;} */
			 .btnautologin {
			font-size: 10px;
			padding: 8px;
		} 
			body{margin:0;}
            .hamburger {
                display: block;
            }

            #sidebar{
				top: 70px;
                left: -250px;
                width: 250px;
                height: 100%;
                z-index: 2000;
                transition: left 0.3s ease-in-out;
            }
			.content{ margin-left: 0px;}
			.dashboard-card{width: 100px; height: 110px;}
            #sidebar.active {
                left: 0;
            }

            .main-container {
                margin-top: 60px;
            }

            .suggest-form {
                margin-left: 40px;
                margin-right: 20px;
				width: calc(100% - 30px);
                padding: 20px;
            }

            .form-container{
                margin : 40px;
				padding :10px;
                width: calc(100% - 30px);
            }

            .container{
                margin-left : 20px;
				margin-right : -242px;
				/* padding: 20px; */
                width: calc(100% - 40px);
				
			}
            header {
                padding: 10px;
            }

            h1 {
                margin: 20px 0;
                text-align: center;
            }

			p{margin: top 2px;font-size:14px;}
		
        }

		@media (max-width: 576px) {
		.huntmlogo {
			width: 50px;
			height: 50px;
		}

		h1 {
			font-size: 20px;
			margin: 5px;
		}

		.list-group-item {
			font-size: 14px;
		}

		.dropdown-item {
			font-size: 14px;
		}

		.btn {
			font-size: 14px;
			padding: 8px;
		}

		input, select, textarea {
			font-size: 14px;
			padding: 8px;
		}

		.image-text {
			font-size: 16px;
		}

		.submit-btn {
			font-size: 14px;
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
<?php 
$userid = $this->session->userdata('id');
?>
<!-- <header>
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo">
            <span class="navbar-brand">Huntm</span>
			<span class="text-end mt-2">Welcome, <?php echo $this->session->userdata('name'); ?></span>
        </a>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </header> -->

    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center px-5 py-2 bg-dark text-white">
    <div class="d-flex align-items-center">
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white text-decoration-none">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo me-2">
            <span class="navbar-brand mb-0">Huntm</span>
        </a>
    </div>

    <div class="text-end">
        <span>Welcome! <?php echo $this->session->userdata('username'); ?></span>
    </div>
	
    <button class="hamburger btn btn-link text-white ms-3" id="hamburger">
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
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                            href="#" 
                            role="button" 
                            id="fileUploadDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                                File Upload
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="fileUploadDropdown">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" id="backlogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Backlog
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                                    <li><a class="dropdown-item" href="<?php echo base_url('WebScrapping'); ?>">Invoice File Upload</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Process File Upload</a></li>
                                </ul>
                            </li>

                            <li><a class="dropdown-item w-100" href="<?php echo base_url('fundbalance'); ?>">Fund Balance</a></li>
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('customerregister'); ?>">Customer Strength</a></li>
                        </ul>
                    </div>
                </div>

                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                            href="#" 
                            role="button" 
                            id="fileUploadDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false" 
                            aria-haspopup="true">
                            Backlog
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="fileUploadDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('invoiceorder'); ?>">Invoice Order Service Area </a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('open-process-order'); ?>">Process Order Service Area</a></li>
                        </ul>  
                    </div>
                </div>

                <a class="dropdown-item fileupload list-group-item list-group-item-action w-100" href="<?php echo base_url('fundbalance_data'); ?>">Fund Balance</a>
                    

                <a href="<?php echo base_url('submitsuggetions'); ?>" class="list-group-item list-group-item-action">Suggestion</a>
                
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                        href="#" 
                        role="button" 
                        id="websiteDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            User Website
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="websiteDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('addwebsite'); ?>">Add Website</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('storewebsite'); ?>">Store Website</a></li>
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
	<div class="row cols-4 row-2 g-3 mr-0 pr-0">
    
        <div class="col">
            <div class="card text-center dashboard-card card-1"  onclick="showDetails('backlog')">
			<h6 class="fs-6 fs-md-5 fs-lg-4">👥 Backlog</h6>
			<p>Areas: 150</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-2" onclick="showDetails('fundbalance')">
                <h6>📦 Fund Balance</h6>
                <p class="fs-6">Rs:760,461.17</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-3" onclick="window.location.href='customer_strength'">
                <h6 class="fs-5">💰 Customer Strength</h6>
                <?php if(isset($data['customer_data'])): ?>
                    <p class="fs-6">Qty : <?= number_format($customer_data['total']['total']) ?></p>
                    <p class="fs-6">Active : <?= round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100) ?>%</p>
                <?php else: ?>
                    <p class="fs-6">Data not available</p>
                <?php endif; ?>
            </div>
        </div>

<div class="col">
    <div class="card text-center dashboard-card card-3" onclick="window.location.href='SBC_data'">
        <h6 class="fs-5">🛍️ SBC</h6>
        <?php if(isset($counts)): ?>
            <p class="fs-6">Qty: <?= number_format($counts['total']['total']) ?></p>
        <?php else: ?>
            <p class="fs-6">Data not available</p>
        <?php endif; ?>
    </div>
</div>

        <div class="col">
        <div class="card text-center dashboard-card card-3" onclick="window.location.href='nillfill'">
                <h6 class = "fs-5">📝 Nil Refill</h6>
                <?php if(isset($stats)): ?>
            <p class="fs-6">Qty: <?= number_format($stats['total']['total']) ?></p>
        <?php else: ?>
            <p class="fs-6">Data not available</p>
        <?php endif; ?>
            </div>
        </div>
        <div class="col">
        <div class="card text-center dashboard-card card-3" onclick="window.location.href='kycdata'">
                <h6 class = "fs-5">🔄  KYC</h6>
                <p class="fs-6">Qty : 1,196</p>
                <p class="fs-6">Percent : 100%</p>
        </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-8"  onclick="window.location.href='midue'">
                <h6 class = "fs-5">📈 MI Due</h6>
                <p class="fs-6">Qty : 4,222</p>
                <p class="fs-6">Percent : 100%</p>
            </div>
        </div>

        <div class="col">
            <div class="card text-center dashboard-card card-9"  onclick="window.location.href='hosedue'">
                <h6 class = "fs-5">🏭 Hose Due</h6>
                <p class="fs-6">Qty : 6,826</p>
                <p class="fs-6">Percent : 100%</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-10"  onclick="window.location.href='phonenumber'">
                <h6 class = "fs-5">🆕 Mobile No</h6>
                <p class="fs-6">Qty : 408</p>
                <p class="fs-6">Percent : 100%</p>
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
      

    </div>
	<!--' 🔽 Details Section Below the Cards -->
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
                    <div class="container2">
                        <div class="card shadow-lg p-4 ">
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
                    <div class="container">
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
                            
                            <form action="<?php echo site_url('fundbalance_uploadfile'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                
                <?php } elseif ($method == 'customer_register') { ?>
                    <div class="container1">
                        <h2>Customer Register Upload Data</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="message success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="message error"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <?php if (isset($message)): ?>
                            <div class="message"><?php echo $message; ?></div>
                        <?php endif; ?>

                        <div class="upload-form">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('customerregister_uploadfile'); ?>">
        <input type="file" name="excel_file" accept=".xls,.xlsx,.csv" required>
        <br>
        <input type="submit" value="Upload Excel">
    </form>
</div>
                    </div>

                <!-- display open process data in website -->
                <?php } elseif ($method == 'display_invoice_data') { ?>
                    <div class="container">
                        <h2>Invoice Order Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Area Name</th>
                                    <th>Cashmemo Generated</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php $serial_no = 1; ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?php echo $serial_no++; ?></td>
                                            <td><?php echo $order['area_name']; ?></td>
                                            <td><?php echo $order['cashmemo_generated']; ?></td>
                                            <td><?php echo $order['status']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php } elseif ($method == 'display_open_data') {?>
                        <div class="container">
                        <h2>Open Process Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Area Name</th>
                                    <th>Open Refill Orders</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($excel_orders)): ?>
                                    <?php $serial_no = 1;  ?>
                                    <?php foreach ($excel_orders as $excel_order): ?>
                                        <tr>
                                            <td><?php echo $serial_no++; ?></td> 
                                            <td><?php echo $excel_order['area_name']; ?></td>
                                            <td><?php echo $excel_order['open_refill_orders']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No records found.</td> <!-- Adjust colspan to 3 due to new column -->
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php } elseif ($method == 'display_fundbalance') { ?>
                        <div class="container">
                        <h2>Fund Balance</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>CCA</th>
                                    <th>Balance</th>
                                    <th>Risk Category Code</th>
                                    <th>Risk Category Description</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($fundbalances)): ?>
                                    <?php $serial_no = 1;  ?>
                                    <?php foreach ($fundbalances as $fundbalance): ?>
                                        <tr>
                                            <td><?php echo $serial_no++; ?></td> 
                                            <td><?php echo $fundbalance['cca']; ?></td>
                                            <td><?php echo $fundbalance['balance']; ?></td>
                                            <td><?php echo $fundbalance['risk_category_code']; ?></td>
                                            <td><?php echo $fundbalance['risk_category_description']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No records found.</td> 
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                   
                    <!-- Suggestion Section -->
                <?php } elseif ($method == 'suggestion') { ?>
                    <div class="suggest-form">
                        <div class="image-section"> 
                            <img src="/Huntm/Image/Suggestion-image.jpg" alt="Suggestion"> 
                        </div>
                        <form id="suggestionForm" method="post" action="<?= base_url('submitsuggetions'); ?>">
                            
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
                                    <input type="text" name="url" class="form-control" placeholder="Website URL" value="<?= set_value('url') ?>" required>
                                </div>
                                <?php if (!empty($errors['url'])): ?>
                                    <small class="text-danger"><?= $errors['url']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="userId" class="form-control" placeholder="UserId" value="<?= set_value('userId') ?>" required> 
                                </div>
                                <?php if (!empty($errors['userId'])): ?>
                                    <small class="text-danger"><?= $errors['userId']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <?php if (!empty($errors['password'])): ?>
                                    <small class="text-danger"><?= $errors['password']; ?></small>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>
                    </div>
                    <!-- Display and store website -->
                <?php } elseif ($method == 'store_website') { ?>
                    <div class="container">
                        <h2 class="text-center">Stored Websites</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>
						<!-- <div class="d-flex justify-content-center"> -->
						<div class="table-responsive">
                        <table class="table">
						<thead class="table-primary">
                            <tr>
                                <th>Website URL</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Login</th>
                            </tr>
						</thead>
                            <?php foreach ($websites as $website): ?>
                                <tr>
                                    <td>
                                        <span class="truncate-url"><?php echo htmlspecialchars($website['website_url']); ?></span>
                                        <button class="btn-copy" onclick="copyToClipboard('<?php echo htmlspecialchars($website['website_url']); ?>')">📋</button>
                                    </td>
                                    <td><?php echo htmlspecialchars($website['website_userId']); ?></td>
                                    <td class="password-hidden">******</td>
                                    <td>
                                        <form action="<?php echo site_url('auto-login'); ?>" method="POST">
                                            <input type="hidden" name="url" value="<?php echo htmlspecialchars($website['website_url']); ?>">
                                            <input type="hidden" name="userId" value="<?php echo htmlspecialchars($website['website_userId']); ?>">
                                            <input type="hidden" name="password" value="<?php echo htmlspecialchars($website['website_password']); ?>">
                                            <button class="btnautologin" type="submit">Auto-Login</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
						</div>
						<!-- </div> -->
                    </div>
                    
                    <!-- Display customer strength -->
                    <?php } elseif($method == 'customer_strength') { ?>
                   <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>      
        <div class="customerstrength-summary">
        <h2 class="text-center text-primary mb-4">Customer Strength Data</h2>

        <!-- Fixed Summary Table -->
        <div class="fixed-summary">
            <div class="navigation-controls">
                <button id="backButton" class="btn btn-outline-primary btn-sm" style="display: none;">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>
            <div class="table-responsive">
                <table class="summary-table-customer">
                    <thead>
                        <tr class="header-row">
                            <th rowspan="2">Quantity/Percent</th>
                            <th colspan="3">ACTIVE</th>
                            <th colspan="3">SUSPENDED</th>
                            <th colspan="3">DEACTIVATED</th>
                            <th colspan="3">TOTAL</th>
                        </tr>
                        <tr>
                            <th>PMUY</th>
                            <th>NON PMUY</th>
                            <th>Total</th>
                            <th>PMUY</th>
                            <th>NON PMUY</th>
                            <th>Total</th>
                            <th>PMUY</th>
                            <th>NON PMUY</th>
                            <th>Total</th>
                            <th>PMUY</th>
                            <th>NON PMUY</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Qty</td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?></td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?></td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?></td>
                        </tr>
                        <tr>
                            <td>Percent</td>
                            
                            <td><?= $customer_data['active']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['active']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['active']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['non_pmuy']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['active']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>


                            <td><?= $customer_data['suspended']['total'] ? round(($customer_data['suspended']['pmuy']/$customer_data['total']['pmuy'])*100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['suspended']['total'] ? round(($customer_data['suspended']['non_pmuy']/$customer_data['suspended']['non_pmuy'])*100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['suspended']['total'] ? round(($customer_data['suspended']['total']/$customer_data['total']['total'])*100, 2) : 0 ?>%</td>

                            <td><?= $customer_data['deactivated']['total'] ? round(($customer_data['deactivated']['pmuy']/$customer_data['total']['pmuy'])*100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['deactivated']['total'] ? round(($customer_data['deactivated']['non_pmuy']/$customer_data['deactivated']['non_pmuy'])*100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['deactivated']['total'] ? round(($customer_data['deactivated']['total']/$customer_data['total']['total'])*100, 2) : 0 ?>%</td>

                           
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['total']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Main Content Area -->
        <div id="mainContent" class="main-content">
            <h4 class="view-title">Customer Distribution by Area</h4>
            <div class="table-responsive">
            <!-- <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a> -->
                <table class="custom-table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Area Name</th>
                            <th>Total Customers</th>
                        </tr>
                    </thead>
                    <tbody id="initialAreaBreakdown">
                        <?php if (empty($customers)): ?>
                            <tr>
                                <td colspan="2" class="no-data">No customer data available</td>
                            </tr>
                        <?php else: ?>
                            <?php 
                            $area_counts = array();
                            foreach ($customers as $customer) {
                                $area = $customer['area_name'] ?? 'Unknown Area';
                                $area_counts[$area] = ($area_counts[$area] ?? 0) + 1;
                            }
                            $display_areas = array_slice($area_counts, 0, 10, true);
                            ?>
                            <?php foreach ($display_areas as $area => $count): ?>
                                <tr>
                                    <td class="clickabled initial-area-click" data-area="<?= html_escape($area) ?>">
                                        <?= html_escape($area) ?>
                                    </td>
                                    <td><?= $count ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (!empty($customers) && count($area_counts) > 10): ?>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
    $(document).ready(function () {
        let currentPage = 1;
        const recordsPerPage = 10;
        let allAreas = [];
        let filteredCustomers = [];
        let currentStatus = null;
        let currentScheme = null;
        let currentArea = null;
        let viewHistory = [];
        
        // Initialize with all customer data from PHP
        let allCustomers = <?= json_encode($customers) ?>;
        let customerData = <?= json_encode($customer_data) ?>;
        
        // If no customers, show message
        if (!allCustomers || allCustomers.length === 0) {
            $('#initialAreaBreakdown').html('<tr><td colspan="2" class="no-data">No customer data available</td></tr>');
        }

        // Load initial area breakdown
        function loadInitialAreaBreakdown() {
            viewHistory = ['initial'];
            $('#backButton').hide();
            
            // Group customers by area
            const areaCounts = {};
            allCustomers.forEach(customer => {
                const area = customer.area_name || 'Unknown Area';
                if (!areaCounts[area]) {
                    areaCounts[area] = 0;
                }
                areaCounts[area]++;
            });
            
            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            
            // Update table with current page
            updateAreaTable();
        }

        function updateAreaTable() {
            const start = (currentPage - 1) * recordsPerPage;
            const end = start + recordsPerPage;
            const pageAreas = allAreas.slice(start, end);
            
            let areaRows = '';
            
            if (pageAreas.length === 0) {
                areaRows = '<tr><td colspan="2" class="no-data">No areas found</td></tr>';
            } else {
                pageAreas.forEach(({area, count}) => {
                    areaRows += `
                        <tr>
                            <td class="clickabled initial-area-click" data-area="${area}">${area}</td>
                            <td>${count}</td>
                        </tr>
                    `;
                });
            }
            
            $('#initialAreaBreakdown').html(areaRows);
            $('#currentPage').text(currentPage);
            
            // Update pagination buttons
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= allAreas.length);
            
            // Add click handlers for area rows
            $('.initial-area-click').off('click').on('click', function() {
                const area = $(this).data('area');
                currentArea = area;
                filteredCustomers = allCustomers.filter(customer => {
                    const customerArea = customer.area_name || 'Unknown Area';
                    return customerArea === area;
                });
                loadCustomerDetailsView(null, null, area);
            });
        }
        
        function loadAreaBreakdownView(status, scheme) {
            viewHistory.push('areaBreakdown');
            $('#backButton').show();
            
            currentStatus = status;
            currentScheme = scheme;
            const title = `${status === 'ALL' ? 'ALL STATUSES' : status} - ${scheme === 'ALL' ? 'ALL SCHEMES' : scheme.replace('_', ' ')} Customers by Area`;
            
            // Filter customers by status and scheme
            filteredCustomers = allCustomers.filter(customer => {
                const statusMatch = status === 'ALL' ? true : customer.consumer_sub_status === status;
                const schemeMatch = scheme === 'ALL' ? true : 
                                    (scheme === 'PMUY' ? customer.scheme_selected === 'PMUY' : customer.scheme_selected !== 'PMUY');
                return statusMatch && schemeMatch;
            });
            
            // Group by area
            const areaCounts = {};
            filteredCustomers.forEach(customer => {
                const area = customer.area_name || 'Unknown Area';
                if (!areaCounts[area]) {
                    areaCounts[area] = 0;
                }
                areaCounts[area]++;
            });
            
            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            currentPage = 1;
            
            const areaBreakdownHTML = `
                <h4 class="view-title">${title}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            `;
            
            $('#mainContent').html(areaBreakdownHTML);
            updateAreaBreakdownTable();
        }
        
        function updateAreaBreakdownTable() {
            const start = (currentPage - 1) * recordsPerPage;
            const end = start + recordsPerPage;
            const pageAreas = allAreas.slice(start, end);
            
            let areaRows = '';
            
            if (pageAreas.length === 0) {
                areaRows = '<tr><td colspan="2" class="no-data">No data available</td></tr>';
            } else {
                pageAreas.forEach(({area, count}) => {
                    areaRows += `
                        <tr>
                            <td class="clickabled area-click" data-area="${area}">${area || 'N/A'}</td>
                            <td>${count}</td>
                        </tr>
                    `;
                });
            }
            
            $('#areaBreakdownBody').html(areaRows);
            $('#currentPage').text(currentPage);
            
            // Update pagination buttons
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= allAreas.length);
            
            // Add click handlers for area rows
            $('.area-click').off('click').on('click', function() {
                const area = $(this).data('area');
                currentArea = area;
                const areaCustomers = filteredCustomers.filter(customer => {
                    const customerArea = customer.area_name || 'Unknown Area';
                    return customerArea === area;
                });
                loadCustomerDetailsView(currentStatus, currentScheme, area);
            });
        }
        
        function loadCustomerDetailsView(status, scheme, area) {
            viewHistory.push('customerDetails');
            $('#backButton').show();
            
            let title = '';
            let customersToShow = [];
            
            if (status && scheme) {
                title = `${status === 'ALL' ? 'ALL STATUSES' : status} - ${scheme === 'ALL' ? 'ALL SCHEMES' : scheme.replace('_', ' ')} Customers in ${area || 'N/A'}`;
                customersToShow = allCustomers.filter(customer => {
                    const statusMatch = status === 'ALL' ? true : customer.consumer_sub_status === status;
                    const schemeMatch = scheme === 'ALL' ? true : 
                                      (scheme === 'PMUY' ? customer.scheme_selected === 'PMUY' : customer.scheme_selected !== 'PMUY');
                    const areaMatch = (customer.area_name || 'Unknown Area') === area;
                    return statusMatch && schemeMatch && areaMatch;
                });
            } else {
                title = `All Customers in ${area || 'N/A'}`;
                customersToShow = allCustomers.filter(customer => {
                    return (customer.area_name || 'Unknown Area') === area;
                });
            }
            
            filteredCustomers = customersToShow;
            currentPage = 1;
            
            const customerDetailsHTML = `
                <h4 class="view-title">${title}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Consumer Number</th>
                                <th>Consumer Name</th>
                                <th>Phone Number</th>
                                <th>Scheme Selected</th>
                                <th>Consumer Sub Status</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody"></tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            `;
            
            $('#mainContent').html(customerDetailsHTML);
            updateCustomerTable();
        }
        
        function updateCustomerTable() {
            const start = (currentPage - 1) * recordsPerPage;
            const end = start + recordsPerPage;
            const pageRows = filteredCustomers.slice(start, end);
            const tableBody = document.getElementById("customerTableBody");
            
            tableBody.innerHTML = "";
            
            if (pageRows.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6" class="no-data">No data available</td></tr>';
            } else {
                pageRows.forEach(customer => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${customer.area_name || 'N/A'}</td>
                        <td>${customer.consumer_number || 'N/A'}</td>
                        <td>${customer.consumer_name || 'N/A'}</td>
                        <td>${customer.phone_number || 'N/A'}</td>
                        <td>
                            <span class="badge ${customer.scheme_selected == 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${customer.scheme_selected || 'N/A'}
                            </span>
                        </td>
                        <td>${customer.consumer_sub_status || 'N/A'}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            $('#currentPage').text(currentPage);
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= filteredCustomers.length);
        }

        // Event listeners
        $('.summary-table-customer .clickabled').on('click', function() {
            loadAreaBreakdownView($(this).data('status'), $(this).data('scheme'));
        });
        
        $('#backButton').on('click', function() {
            if (viewHistory.length <= 1) return;
            
            viewHistory.pop(); // Remove current view
            const previousView = viewHistory[viewHistory.length - 1];
            
            if (previousView === 'initial') {
                loadInitialAreaBreakdown();
            } else if (previousView === 'areaBreakdown') {
                loadAreaBreakdownView(currentStatus, currentScheme);
            }
            
            if (viewHistory.length <= 1) {
                $('#backButton').hide();
            }
        });

        // Pagination handlers
        $(document).on('click', '#prevPage:not(.disabled)', () => {
            if (currentPage > 1) {
                currentPage--;
                if ($('#areaBreakdownBody').length) {
                    updateAreaBreakdownTable();
                } else if ($('#customerTableBody').length) {
                    updateCustomerTable();
                } else {
                    updateAreaTable();
                }
            }
        });
        
        $(document).on('click', '#nextPage:not(.disabled)', () => {
            const end = currentPage * recordsPerPage;
            if ($('#areaBreakdownBody').length && end < allAreas.length) {
                currentPage++;
                updateAreaBreakdownTable();
            } else if ($('#customerTableBody').length && end < filteredCustomers.length) {
                currentPage++;
                updateCustomerTable();
            } else if ($('#initialAreaBreakdown').length && end < allAreas.length) {
                currentPage++;
                updateAreaTable();
            }
        });

        $("#backToSummary").on("click", function(e) {
        e.preventDefault();
        $('#areaView').hide();
        $('#customerDetailsView').hide();
    });
    
    $("#backToAreas").on("click", function(e) {
        e.preventDefault();
        showAreaBreakdown(currentScheme);
    });

        // Initialize the view
        loadInitialAreaBreakdown();
    });
    </script>

                        
                    <?php } elseif($method == 'sbc_data_display') { ?>
                         <!-- Back to Dashboard Button (Always visible) -->
          <div class="dashboard-back-btn">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div class="container5">
        <!-- Fixed Summary Section -->
        <div class="sbc_summary">
            <table class="custom-table table_bi_report summary-table" id="summaryTable">
                <h2>SBC Data Report</h2>
                <thead>
                    <tr>
                        <th>SBC</th>
                        <th>PMUY</th>
                        <th>Non PMUY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="summaryTableBody">
                    <tr>
                        <td>Quantity</td>
                        <td class="clickabled" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                        <td class="clickabled" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                        <td class="clickabled" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        <td><?= $table_data['rows']['%'][0] ?>%</td>
                        <td><?= $table_data['rows']['%'][1] ?>%</td>
                        <td><?= $table_data['rows']['%'][2] ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
                    
        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;" class="sbc_area_details">
            <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                
                <table class="custom-table area-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Connection Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details Table -->
            <div id="customerDetailsView" style="display: none;" class="sbc_customer_details">
            <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table table_area">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer Number</th>
                            <th>Consumer Name</th>
                            <th>Phone Number</th>
                            <th>Scheme</th>
                            <th>Consumer Type</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Pagination variables
            let currentPage = 1;
            let currentAreaPage = 1;
            const recordsPerPage = 10;
            
            // Data variables
            let allCustomers = <?= json_encode($sbc_data ?? []) ?>;
            let filteredCustomers = [];
            let areaBreakdownData = [];
            let currentScheme = null;
            let currentArea = null;

            // Initialize the view
            initView();

            function initView() {
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').hide();
                
                if (allCustomers && allCustomers.length > 0) {
                    processData();
                }
            }

            function processData() {
                allCustomers.forEach(customer => {
                    if (customer.scheme_selected === 'Ujjwala') {
                        customer.scheme_selected = 'PMUY';
                    } else if (!customer.scheme_selected || customer.scheme_selected !== 'PMUY') {
                        customer.scheme_selected = 'Non PMUY';
                    }
                });
            }

            function showAreaBreakdown(scheme) {
                currentScheme = scheme;
                
                filteredCustomers = allCustomers.filter(customer => {
                    let schemeMatch = true;
                    if (scheme === 'PMUY') {
                        schemeMatch = customer.scheme_selected === 'PMUY';
                    } else if (scheme === 'Non PMUY') {
                        schemeMatch = customer.scheme_selected !== 'PMUY';
                    }
                    return schemeMatch;
                });
                
                const areaStats = {};
                filteredCustomers.forEach(customer => {
                    const area = customer.area_name || 'Unknown';
                    if (!areaStats[area]) {
                        areaStats[area] = { total: 0 };
                    }
                    areaStats[area].total++;
                });
                
                areaBreakdownData = Object.entries(areaStats).map(([area, stats]) => ({
                    area,
                    total: stats.total
                })).sort((a, b) => b.total - a.total);
                
                $('#areaBreakdownTitle').text(`SBC Connections (${scheme}) by Area`);
                currentAreaPage = 1;
                updateAreaBreakdownTable();
                
                $('#areaBreakdownView').show();
                $('#customerDetailsView').hide();
                $('.content-section').scrollTop(0);
            }

            function updateAreaBreakdownTable() {
                const start = (currentAreaPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const pageAreas = areaBreakdownData.slice(start, end);
                const tableBody = $("#areaBreakdownBody");
                
                tableBody.empty();
                
                if (pageAreas.length === 0) {
                    tableBody.html('<tr><td colspan="2" class="no-data">No data available</td></tr>');
                } else {
                    pageAreas.forEach(({area, total}) => {
                        tableBody.append(`
                            <tr>
                                <td class="clickabled area-click" data-area="${area}">${area || 'N/A'}</td>
                                <td>${total}</td>
                            </tr>
                        `);
                    });
                }
                
                $("#currentAreaPage").text(currentAreaPage);
                $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
            }

            function showCustomerDetails(area) {
                currentArea = area;
                
                filteredCustomers = allCustomers.filter(customer => {
                    const areaMatch = (customer.area_name || 'Unknown') === area;
                    let schemeMatch = true;
                    if (currentScheme === 'PMUY') {
                        schemeMatch = customer.scheme_selected === 'PMUY';
                    } else if (currentScheme === 'Non PMUY') {
                        schemeMatch = customer.scheme_selected !== 'PMUY';
                    }
                    return areaMatch && schemeMatch;
                });
                
                currentPage = 1;
                $('#customerDetailsTitle').text(`SBC Connections (${currentScheme}) in ${area}`);
                updateCustomerTable();
                
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').show();
                $('.content-section').scrollTop(0);
            }

            function updateCustomerTable() {
                const start = (currentPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const pageRows = filteredCustomers.slice(start, end);
                const tableBody = $("#customerTableBody");
                
                tableBody.empty();
                
                if (pageRows.length === 0) {
                    tableBody.html('<tr><td colspan="6" class="no-data">No data available</td></tr>');
                } else {
                    pageRows.forEach(customer => {
                        const consumerType = customer.consumer_type || 'domestic';
                        const typeBadgeClass = consumerType === 'domestic' ? 'badge-domestic' : 'badge-commercial';
                        
                        tableBody.append(`
                            <tr>
                                <td>${customer.area_name || 'N/A'}</td>
                                <td>${customer.consumer_number || 'N/A'}</td>
                                <td>${customer.consumer_name || 'N/A'}</td>
                                <td>${customer.phone_number || 'N/A'}</td>
                                <td>
                                    <span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                        ${customer.scheme_selected || 'N/A'}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge ${typeBadgeClass}">
                                        ${customer.consumer_type}
                                    </span>
                                </td>
                            </tr>
                        `);
                    });
                }
                
                $("#currentPage").text(currentPage);
                $("#prevPage").toggleClass("disabled", currentPage === 1);
                $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
            }

            // Event listeners
            $(document).on('click', '.clickabled[data-scheme]', function() {
                const scheme = $(this).data('scheme');
                showAreaBreakdown(scheme);
            });
            
            $(document).on('click', '.area-click', function() {
                const area = $(this).data('area');
                showCustomerDetails(area);
            });
            
            $("#prevPage").on("click", function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateCustomerTable();
                }
            });
            
            $("#nextPage").on("click", function(e) {
                e.preventDefault();
                if ((currentPage * recordsPerPage) < filteredCustomers.length) {
                    currentPage++;
                    updateCustomerTable();
                }
            });
            
            $("#prevAreaPage").on("click", function(e) {
                e.preventDefault();
                if (currentAreaPage > 1) {
                    currentAreaPage--;
                    updateAreaBreakdownTable();
                }
            });
            
            $("#nextAreaPage").on("click", function(e) {
                e.preventDefault();
                if ((currentAreaPage * recordsPerPage) < areaBreakdownData.length) {
                    currentAreaPage++;
                    updateAreaBreakdownTable();
                }
            });
            
            $("#backToSummary").on("click", function(e) {
            e.preventDefault();
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').hide();
        });
        
        $("#backToAreas").on("click", function(e) {
            e.preventDefault();
            showAreaBreakdown(currentScheme);
        });
        });
    </script>
                    <?php } elseif ($method == 'nil_refill_report') { ?>
                        <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        
        <div class="container5">
    <!-- Fixed Summary Table -->
    <div class="nerefil-summary">
        <table class="custom-table table-bordered nilrefil_summary_table" id="summaryTable">
            <h2>Nil Refill Report</h2>
            <thead>
                <tr class="table-primary">
                    <th rowspan="2">Time Since Last Refill</th>
                    <th colspan="3"> 3 Months</th>
                    <th colspan="3"> 6 Months</th>
                    <th colspan="3"> 1 Year</th>
                </tr>
                <tr class="table-secondary">
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Count</td>
                    <td class="clickabled" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo $stats['greater_than_3_months']['pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo $stats['greater_than_3_months']['non_pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_3_months" data-scheme="total"><?php echo $stats['greater_than_3_months']['total']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo $stats['greater_than_6_months']['pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo $stats['greater_than_6_months']['non_pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_6_months" data-scheme="total"><?php echo $stats['greater_than_6_months']['total']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo $stats['greater_than_1_year']['pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo $stats['greater_than_1_year']['non_pmuy']['qty']; ?></td>
                    <td class="clickabled" data-period="greater_than_1_year" data-scheme="total"><?php echo $stats['greater_than_1_year']['total']['qty']; ?></td>
                </tr>
                <tr>
                    <td>Percentage</td>
                    <td><?php echo $stats['greater_than_3_months']['pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_3_months']['non_pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_3_months']['total']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_6_months']['pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_6_months']['non_pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_6_months']['total']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_1_year']['pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_1_year']['non_pmuy']['percent']; ?>%</td>
                    <td><?php echo $stats['greater_than_1_year']['total']['percent']; ?>%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Details Sections -->
    <div class="content-section">
        <!-- Area Breakdown View -->
        <div id="areaBreakdownView" style="display: none;" class="nilrefil_area_details">
        <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
            <h4 class="view-title" id="areaBreakdownTitle"></h4>
            <table class="custom-table table-bordered area-table">
                <thead class="table-success">
                    <tr>
                        <th>Area Name</th>
                        <th>Customer Count</th>
                    </tr>
                </thead>
                <tbody id="areaBreakdownBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><span class="page-link" id="currentAreaPage">1</span></li>
                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

        <!-- Customer Details View -->
        <div id="customerDetailsView" style="display: none;" class="nilrefil_customer_details">
        <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
            <h4 class="view-title" id="customerDetailsTitle"></h4>
            <table class="custom-table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Area Name</th>
                        <th>Consumer Number</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Scheme</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>
            <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevCustomerPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentCustomerPage">1</a></li>
                        <li class="page-item" id="nextCustomerPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const recordsPerPage = 10;
    let currentView = 'summary';
    let viewStack = [];
    const allCustomers = <?php echo json_encode($all_customers); ?>;
    let filteredCustomers = [];
    let areaBreakdownData = [];
    let currentPeriod = '';
    let currentScheme = '';
    let currentArea = '';
    let currentAreaPage = 1;
    let currentCustomerPage = 1;

    // Debugging: Log initial data
    console.log('Initial All Customers:', allCustomers);

    // Initialize view
    initView();

    function initView() {
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
        $('#backButton').hide();
        currentView = 'summary';
        viewStack = [];
        console.log('Initialized to Summary View');
    }

    // Show area breakdown
    function showAreaBreakdown(period, scheme) {
        currentPeriod = period;
        currentScheme = scheme;

        console.log('Showing Area Breakdown for:', { period, scheme });

        // Filter customers
        filteredCustomers = allCustomers.filter(customer => {
            if (!customer.days_since_refill || isNaN(parseInt(customer.days_since_refill))) {
                console.log('Skipping customer due to invalid days_since_refill:', customer);
                return false;
            }
            const days = parseInt(customer.days_since_refill, 10);
            let periodMatch = false;
            if (period === 'greater_than_3_months') periodMatch = days > 90;
            else if (period === 'greater_than_6_months') periodMatch = days > 180;
            else if (period === 'greater_than_1_year') periodMatch = days > 365;

            if (scheme === 'total') return periodMatch;
            const schemeMatch = (scheme === 'pmuy' && customer.scheme_selected === 'PMUY') || 
                               (scheme === 'non_pmuy' && customer.scheme_selected === 'Non PMUY');
            return schemeMatch && periodMatch;
        });

        console.log('Filtered Customers:', filteredCustomers);

        // Group by area
        const areaCounts = {};
        filteredCustomers.forEach(customer => {
            const area = customer.area_name || 'Unknown';
            areaCounts[area] = (areaCounts[area] || 0) + 1;
        });

        areaBreakdownData = Object.entries(areaCounts)
            .map(([area, count]) => ({ area, count }))
            .sort((a, b) => b.count - a.count);

        console.log('Area Breakdown Data:', areaBreakdownData);

        // Update title
        const periodText = getPeriodText(period);
        const schemeText = scheme === 'pmuy' ? 'PMUY' : scheme === 'non_pmuy' ? 'Non-PMUY' : 'Total';
        $('#areaBreakdownTitle').text(`Areas (${periodText}, ${schemeText})`);

        // Reset to first page and update
        currentAreaPage = 1;
        updateAreaBreakdownView();

        // Update view state
        $('#areaBreakdownView').show();
        $('#customerDetailsView').hide();
        $('#backButton').show();
        viewStack.push(currentView);
        currentView = 'area';
        console.log('Switched to Area View');
    }

    // Update area breakdown table
    function updateAreaBreakdownView() {
        const totalRecords = areaBreakdownData.length;
        const totalPages = Math.ceil(totalRecords / recordsPerPage);
        const startIdx = (currentAreaPage - 1) * recordsPerPage;
        const endIdx = Math.min(startIdx + recordsPerPage, totalRecords);
        const pageData = areaBreakdownData.slice(startIdx, endIdx);

        console.log(`Updating Area Breakdown - Page ${currentAreaPage}:`, { totalRecords, totalPages, startIdx, endIdx, pageData });

        const $tbody = $('#areaBreakdownBody');
        $tbody.empty();

        if (totalRecords === 0) {
            $tbody.append('<tr><td colspan="2" class="no-data">No areas found</td></tr>');
            console.log('No areas to display');
        } else if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="2" class="no-data">No more areas on this page</td></tr>');
            console.log('Page data empty for current page');
        } else {
            pageData.forEach(item => {
                $tbody.append(`
                    <tr>
                        <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">${escapeHtml(item.area)}</td>
                        <td>${item.count}</td>
                    </tr>
                `);
            });
            console.log('Rendered area breakdown rows:', pageData.length);

            // Reattach click handlers
            $('.area-link').off('click').on('click', function() {
                const area = $(this).data('area');
                console.log('Area clicked:', area);
                showCustomerDetails(area);
            });
        }

        $('#currentAreaPage').text(currentAreaPage);
        $('#prevAreaPage').toggleClass('disabled', currentAreaPage === 1);
        $('#nextAreaPage').toggleClass('disabled', currentAreaPage >= totalPages);
    }

    // Show customer details
    function showCustomerDetails(area) {
        currentArea = area;
        console.log('Filtering customers for area:', area);

        const areaCustomers = filteredCustomers.filter(customer => {
            const match = customer.area_name === area;
            if (!match) console.log('Customer skipped (area mismatch):', customer);
            return match;
        });

        console.log('Area Customers:', areaCustomers);

        const periodText = getPeriodText(currentPeriod);
        const schemeText = currentScheme === 'pmuy' ? 'PMUY' : currentScheme === 'non_pmuy' ? 'Non-PMUY' : 'Total';
        $('#customerDetailsTitle').text(`${escapeHtml(area)} - ${periodText}, ${schemeText}`);

        currentCustomerPage = 1;
        updateCustomerDetailsView(areaCustomers);

        $('#areaBreakdownView').hide();
        $('#customerDetailsView').show();
        $('#backButton').show();
        viewStack.push(currentView);
        currentView = 'customer';
        console.log('Switched to Customer View');
    }

    // Update customer details table
    function updateCustomerDetailsView(customers) {
        const totalRecords = customers.length;
        const totalPages = Math.ceil(totalRecords / recordsPerPage);
        const startIdx = (currentCustomerPage - 1) * recordsPerPage;
        const endIdx = Math.min(startIdx + recordsPerPage, totalRecords);
        const pageData = customers.slice(startIdx, endIdx);

        console.log(`Updating Customer Details - Page ${currentCustomerPage}:`, { totalRecords, totalPages, startIdx, endIdx, pageData });

        const $tbody = $('#customerTableBody');
        $tbody.empty();

        if (totalRecords === 0) {
            $tbody.append('<tr><td colspan="6" class="no-data">No customers found</td></tr>');
            console.log('No customers to display');
        } else if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="6" class="no-data">No more customers on this page</td></tr>');
            console.log('Page data empty for current page');
        } else {
            pageData.forEach(customer => {
                const lastRefill = customer.last_refill_date 
                    ? new Date(customer.last_refill_date).toLocaleDateString() 
                    : 'Never';
                const monthsSince = customer.months_since_refill 
                    ? `${customer.months_since_refill} months` 
                    : 'N/A';
                
                $tbody.append(`
                    <tr>
                        <td>${escapeHtml(customer.area_name)}</td>
                        <td>${escapeHtml(customer.consumer_number)}</td>
                        <td>${escapeHtml(customer.consumer_name)}</td>
                        <td>${escapeHtml(customer.phone_number)}</td>
                        <td><span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">${customer.scheme_selected}</span></td>
                    </tr>
                `);
            });
            console.log('Rendered customer detail rows:', pageData.length);
        }

        $('#currentCustomerPage').text(currentCustomerPage);
        $('#prevCustomerPage').prop('disabled', currentCustomerPage === 1);
        $('#nextCustomerPage').prop('disabled', currentCustomerPage >= totalPages);
    }

    // Helper functions
    function getPeriodText(period) {
        switch(period) {
            case 'greater_than_3_months': return '3+ Months';
            case 'greater_than_6_months': return '6+ Months';
            case 'greater_than_1_year': return '1+ Year';
            default: return '';
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Event handlers
    $('.clickabled[data-period][data-scheme]').on('click', function() {
        const period = $(this).data('period');
        const scheme = $(this).data('scheme');
        showAreaBreakdown(period, scheme);
    });

    $('#backButton').on('click', function() {
        if (viewStack.length === 0) {
            initView();
            return;
        }
        const previousView = viewStack.pop();
        if (previousView === 'summary') {
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').hide();
            $('#backButton').hide();
            currentView = 'summary';
            console.log('Back to Summary View');
        } else if (previousView === 'area') {
            $('#areaBreakdownView').show();
            $('#customerDetailsView').hide();
            currentView = 'area';
            updateAreaBreakdownView();
            console.log('Back to Area View');
        }
    });

    $('#prevAreaPage').on('click', function(e) {
        e.preventDefault();
        if (currentAreaPage > 1) {
            currentAreaPage--;
            updateAreaBreakdownView();
            console.log('Previous Area Page');
        }
    });

    $('#nextAreaPage').on('click', function(e) {
        e.preventDefault();
        const totalPages = Math.ceil(areaBreakdownData.length / recordsPerPage);
        if (currentAreaPage < totalPages) {
            currentAreaPage++;
            updateAreaBreakdownView();
            console.log('Next Area Page');
        }
    });

    $('#prevCustomerPage').on('click', function() {
        if (currentCustomerPage > 1) {
            currentCustomerPage--;
            const customers = filteredCustomers.filter(c => c.area_name === currentArea);
            updateCustomerDetailsView(customers);
            console.log('Previous Customer Page');
        }
    });

    $('#nextCustomerPage').on('click', function() {
        const customers = filteredCustomers.filter(c => c.area_name === currentArea);
        const totalPages = Math.ceil(customers.length / recordsPerPage);
        if (currentCustomerPage < totalPages) {
            currentCustomerPage++;
            updateCustomerDetailsView(customers);
            console.log('Next Customer Page');
        }
    });

    $("#backToSummary").on("click", function(e) {
        e.preventDefault();
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
    });
    
    $("#backToAreas").on("click", function(e) {
        e.preventDefault();
        showAreaBreakdown(currentScheme);
    });
});
</script>
                    <?php } elseif($method == 'kyc_data') { ?>
                         <!-- Back to Dashboard Button (Always visible) -->
       <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div class="container5">
    <!-- Fixed Summary Table -->
    <div class="kyc-summary" id="summaryTableContainer">
        <table class="custom-table table_summary_kyc" id="summaryTable">
            <h2>KYC Data Table</h2>
            <thead>
                <tr class="head-row">
                    <th rowspan="2">KYC Data</th>
                    <th colspan="3">KYC Pending</th>
                </tr>
                <tr class="sub-header">
                    <th class="clickabled" data-scheme="PMUY">PMUY</th>
                    <th class="clickabled" data-scheme="Non PMUY">Non PMUY</th>
                    <th class="clickabled" data-scheme="Total">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Qty</td>
                    <td class="clickabled" data-scheme="PMUY"><?= $kyc_stats['PMUY_Pending'] ?? 0 ?></td>
                    <td class="clickabled" data-scheme="Non PMUY"><?= $kyc_stats['Non_PMUY_Pending'] ?? 0 ?></td>
                    <td class="clickabled" data-scheme="Total"><?= $kyc_stats['Total_Pending'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td>%</td>
                    <td><?= $kyc_stats['PMUY_Pending_Percent'] ?? 0 ?>%</td>
                    <td><?= $kyc_stats['Non_PMUY_Pending_Percent'] ?? 0 ?>%</td>
                    <td><?= $kyc_stats['Total_Pending_Percent'] ?? 0 ?>%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- <button id="backButton" class="btn btn-outline-primary btn-sm" style="display: none;">Back</button> -->
    
    <!-- Main Content Area -->
    <div id="mainContent">
        <!-- Area Breakdown View -->
        <div id="areaBreakdownView" style="display: none;" class="kyc-area-details">
        <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
            <h4 class="view-title" id="areaBreakdownTitle"></h4>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Pending KYC Count</th>
                    </tr>
                </thead>
                <tbody id="areaBreakdownBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

        <!-- Customer Details View -->
        <div id="customerDetailsView" style="display: none;" class="kyc_customer_details">
        <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
            <h4 class="view-title" id="customerDetailsTitle"></h4>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Consumer Number</th>
                        <th>Consumer Name</th>
                        <th>Phone Number</th>
                        <th>Scheme</th>
                        <th>KYC Status</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody">
                    <!-- Initial data loaded from server -->
                    <?php foreach ($kyc_data as $customer): ?>
                        <?php if (empty($customer['kyc_number'])): ?>
                            <tr data-area="<?= htmlspecialchars($customer['area_name'] ?? 'Unknown') ?>" 
                                data-scheme="<?= htmlspecialchars($customer['scheme_selected']) ?>">
                                <td><?= htmlspecialchars($customer['area_name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($customer['consumer_number']) ?></td>
                                <td><?= htmlspecialchars($customer['consumer_name']) ?></td>
                                <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                                <td>
                                    <span class="badge <?= ($customer['scheme_selected'] === 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy' ?>">
                                        <?= htmlspecialchars($customer['scheme_selected']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-non-pmuy">Pending</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Configuration
    const recordsPerPage = 10;
    let currentView = 'summary';
    let viewHistory = [];
    let currentPage = 1;
    let currentAreaPage = 1;
    let currentScheme = null;
    let currentArea = null;
    
    // Data from server
    let allCustomers = <?= json_encode($kyc_data) ?>;
    let filteredCustomers = [];
    let areaBreakdownData = [];

    // Initialize view
    initView();

    function initView() {
        // Filter to only pending KYC customers
        filteredCustomers = allCustomers.filter(customer => !customer.kyc_number || customer.kyc_number === '');
        
        // Set up initial customer table
        updateCustomerTable();
        
        // Hide views that should not be visible initially
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
        $('#backButton').hide();
    }

    // Show area breakdown for selected scheme
    function showAreaBreakdown(scheme) {
        currentScheme = scheme;
        
        // Filter customers based on scheme
        filteredCustomers = allCustomers.filter(customer => {
            if (customer.kyc_number && customer.kyc_number !== '') return false; // Skip completed KYC
            return scheme === 'Total' || customer.scheme_selected === scheme;
        });
        
        // Group by area
        const areaCounts = {};
        filteredCustomers.forEach(customer => {
            const area = customer.area_name || 'Unknown';
            areaCounts[area] = (areaCounts[area] || 0) + 1;
        });
        
        // Convert to array and sort
        areaBreakdownData = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
        areaBreakdownData.sort((a, b) => b.count - a.count);
        
        // Update view
        $('#areaBreakdownTitle').text(
            `Pending KYC Customers (${scheme === 'Total' ? 'All Schemes' : scheme}) by Area`
        );
        currentAreaPage = 1;
        updateAreaBreakdownTable();
        
        // Show the area breakdown view
        $('#areaBreakdownView').show();
        $('#customerDetailsView').hide();
        $('#backButton').show();
        
        // Update navigation history
        viewHistory.push(currentView);
        currentView = 'area';
    }

    function updateAreaBreakdownTable() {
        const startIdx = (currentAreaPage - 1) * recordsPerPage;
        const pageData = areaBreakdownData.slice(startIdx, startIdx + recordsPerPage);
        const $tbody = $('#areaBreakdownBody');
        
        $tbody.empty();
        
        if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="2" class="no-data">No data available</td></tr>');
        } else {
            pageData.forEach(item => {
                $tbody.append(`
                    <tr>
                        <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                            ${escapeHtml(item.area)}
                        </td>
                        <td>${item.count}</td>
                    </tr>
                `);
            });
            
            // Add click handlers for area links
            $('.area-link').off('click').on('click', function() {
                const area = $(this).data('area');
                showCustomerDetails(area);
            });
        }
        
        // Update pagination controls
        $('#currentAreaPage').text(currentAreaPage);
        $('#prevAreaPage').toggleClass('disabled', currentAreaPage === 1);
        $('#nextAreaPage').toggleClass('disabled', 
            currentAreaPage * recordsPerPage >= areaBreakdownData.length
        );
    }

    function showCustomerDetails(area) {
        currentArea = area;
        
        // Filter customers for this area
        filteredCustomers = allCustomers.filter(customer => {
            if (customer.kyc_number && customer.kyc_number !== '') return false;
            const customerArea = customer.area_name || 'Unknown';
            return customerArea === area && 
                  (currentScheme === 'Total' || customer.scheme_selected === currentScheme);
        });
        
        // Update view
        $('#customerDetailsTitle').text(
            `Pending KYC Customers in ${escapeHtml(area)} (${currentScheme === 'Total' ? 'All Schemes' : currentScheme})`
        );
        currentPage = 1;
        updateCustomerTable();
        
        // Show the customer details view
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').show();
        
        // Update navigation history
        viewHistory.push(currentView);
        currentView = 'customer';
    }

    function updateCustomerTable() {
        const startIdx = (currentPage - 1) * recordsPerPage;
        const pageData = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
        const $tbody = $('#customerTableBody');
        
        $tbody.empty();
        
        if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="6" class="no-data">No data available</td></tr>');
        } else {
            pageData.forEach(customer => {
                $tbody.append(`
                    <tr>
                        <td>${escapeHtml(customer.area_name || 'Unknown')}</td>
                        <td>${escapeHtml(customer.consumer_number || '')}</td>
                        <td>${escapeHtml(customer.consumer_name || '')}</td>
                        <td>${escapeHtml(customer.phone_number || '')}</td>
                        <td>
                            <span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${escapeHtml(customer.scheme_selected)}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-non-pmuy">Pending</span>
                        </td>
                    </tr>
                `);
            });
        }
        
        // Update pagination controls
        $('#currentPage').text(currentPage);
        $('#prevPage').toggleClass('disabled', currentPage === 1);
        $('#nextPage').toggleClass('disabled', 
            currentPage * recordsPerPage >= filteredCustomers.length
        );
    }

    function goBack() {
        if (viewHistory.length === 0) return;
        
        const previousView = viewHistory.pop();
        
        if (previousView === 'summary') {
            // Return to summary view
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').hide();
            $('#backButton').hide();
            currentView = 'summary';
        } else if (previousView === 'area') {
            // Return to area breakdown view
            $('#areaBreakdownView').show();
            $('#customerDetailsView').hide();
            currentView = 'area';
        }
        
        if (viewHistory.length === 0) {
            $('#backButton').hide();
        }
    }

    function escapeHtml(text) {
        if (text == null) return '';
        return text.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Event listeners
    $('.clickabled[data-scheme]').on('click', function() {
        showAreaBreakdown($(this).data('scheme'));
    });
    
    $('#backButton').on('click', goBack);
    
    // Pagination controls
    $('#prevPage').on('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateCustomerTable();
        }
    });
    
    $('#nextPage').on('click', function(e) {
        e.preventDefault();
        if (currentPage * recordsPerPage < filteredCustomers.length) {
            currentPage++;
            updateCustomerTable();
        }
    });
    
    $('#prevAreaPage').on('click', function(e) {
        e.preventDefault();
        if (currentAreaPage > 1) {
            currentAreaPage--;
            updateAreaBreakdownTable();
        }
    });
    
    $('#nextAreaPage').on('click', function(e) {
        e.preventDefault();
        if (currentAreaPage * recordsPerPage < areaBreakdownData.length) {
            currentAreaPage++;
            updateAreaBreakdownTable();
        }
    });

    $("#backToSummary").on("click", function(e) {
        e.preventDefault();
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
    });
    
    $("#backToAreas").on("click", function(e) {
        e.preventDefault();
        showAreaBreakdown(currentScheme);
    });
});
</script>


                    <?php } elseif ($method == 'midue') { ?>
                                      <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div class="container mt-4">
    <!-- Fixed Summary Section -->
    <div class="fixed-summary midue-summary">
        <table class="custom-table table-bordered" id="summaryTable">
            <h2>MI Due Data Table</h2>
            <thead>
                <tr class="table-primary">
                    <th>MI Due</th>
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="summaryTableBody">
                <tr>
                    <td>Quantity</td>
                    <td class="clickabled" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                    <td class="clickabled" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                    <td class="clickabled" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                </tr>
                <tr>
                    <td>Percentage</td>
                    <td><?= $table_data['rows']['%'][0] ?></td>
                    <td><?= $table_data['rows']['%'][1] ?></td>
                    <td><?= $table_data['rows']['%'][2] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Scrollable Content Section -->
    <div class="content-section">
        <!-- Area Breakdown Table -->
        <div id="areaBreakdownView" style="display: none;" class="midue-area-details">
            <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
            <h4 class="view-title" id="areaBreakdownTitle"></h4>
            <table class="custom-table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Area Name</th>
                        <th>Due Count</th>
                    </tr>
                </thead>
                <tbody id="areaBreakdownBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><span class="page-link" id="currentAreaPage">1</span></li>
                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

        <!-- Customer Details Table -->
        <div id="customerDetailsView" style="display: none;" class="midue_customer_details">
            <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
            <h4 class="view-title" id="customerDetailsTitle"></h4>
            <table class="custom-table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Area Name</th>
                        <th>Consumer Number</th>
                        <th>Consumer Name</th>
                        <th>Phone Number</th>
                        <th>Scheme</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><span class="page-link" id="currentPage">1</span></li>
                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Configuration
    const recordsPerPage = 10;
    let currentView = 'summary';
    let viewHistory = [];
    
    // Data from server
    const allCustomers = <?= json_encode($mi_due ?? []) ?>;
    let filteredCustomers = [];
    let areaBreakdownData = [];
    let currentScheme = null;
    let currentArea = null;
    let currentPage = 1;
    let currentAreaPage = 1;

    console.log('Initial data loaded:', {
        allCustomers: allCustomers,
        count: allCustomers.length
    });

    // Initialize the view
    initView();

    function initView() {
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
        currentView = 'summary';
        viewHistory = [];
    }

    function showAreaBreakdown(scheme) {
        currentScheme = scheme;
        console.log('Showing area breakdown for scheme:', scheme);
        
        // Filter customers based on scheme
        filteredCustomers = allCustomers.filter(customer => {
            if (scheme === 'Total') return true;
            return customer.scheme_type === scheme;
        });
        
        console.log('Filtered customers count:', filteredCustomers.length, 'for scheme:', scheme);
        
        // Group by area
        const areaCounts = {};
        filteredCustomers.forEach(customer => {
            const area = customer.area_name || 'Unknown';
            areaCounts[area] = (areaCounts[area] || 0) + 1;
        });
        
        // Convert to array and sort
        areaBreakdownData = Object.entries(areaCounts)
            .map(([area, count]) => ({ area, count }))
            .sort((a, b) => b.count - a.count);
        
        console.log('Area breakdown data:', areaBreakdownData);
        
        // Update view
        const title = scheme === 'Total' ? 'Due MI Customers (All Schemes) by Area' : `Due MI Customers (${scheme}) by Area`;
        $('#areaBreakdownTitle').text(title);
        
        currentAreaPage = 1;
        updateAreaBreakdownTable();
        
        // Show the correct view
        $('#areaBreakdownView').show();
        $('#customerDetailsView').hide();
        
        // Update navigation
        viewHistory.push(currentView);
        currentView = 'area';
    }

    function updateAreaBreakdownTable() {
        const startIdx = (currentAreaPage - 1) * recordsPerPage;
        const pageData = areaBreakdownData.slice(startIdx, startIdx + recordsPerPage);
        const $tbody = $('#areaBreakdownBody');
        
        $tbody.empty();
        
        if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="2" class="no-data">No data available</td></tr>');
        } else {
            pageData.forEach(item => {
                $tbody.append(`
                    <tr>
                        <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                            ${escapeHtml(item.area)}
                        </td>
                        <td>${item.count}</td>
                    </tr>
                `);
            });
            
            // Add click handlers for area links
            $('.area-link').off('click').on('click', function() {
                const area = $(this).data('area');
                showCustomerDetails(area);
            });
        }
        
        // Update pagination controls
        const totalPages = Math.ceil(areaBreakdownData.length / recordsPerPage);
        $('#currentAreaPage').text(currentAreaPage);
        $('#prevAreaPage').toggleClass('disabled', currentAreaPage === 1);
        $('#nextAreaPage').toggleClass('disabled', currentAreaPage >= totalPages);
    }

    function showCustomerDetails(area) {
        currentArea = area;
        console.log('Showing customer details for area:', area);
        
        // Filter customers for this area and scheme
        filteredCustomers = allCustomers.filter(customer => {
            const customerArea = customer.area_name || 'Unknown';
            return customerArea === area && 
                  (currentScheme === 'Total' || customer.scheme_type === currentScheme);
        });
        
        console.log('Filtered customers for area:', filteredCustomers.length);
        
        // Update view
        const schemeText = currentScheme === 'Total' ? 'All Schemes' : currentScheme;
        $('#customerDetailsTitle').text(`Due MI Customers (${schemeText}) in ${escapeHtml(area)}`);
        
        currentPage = 1;
        updateCustomerTable();
        
        // Show the correct view
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').show();
        
        // Update navigation
        viewHistory.push(currentView);
        currentView = 'customer';
    }

    function updateCustomerTable() {
        const startIdx = (currentPage - 1) * recordsPerPage;
        const pageData = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
        const $tbody = $('#customerTableBody');
        
        $tbody.empty();
        
        if (pageData.length === 0) {
            $tbody.append('<tr><td colspan="6" class="no-data">No data available</td></tr>');
        } else {
            pageData.forEach(customer => {
                $tbody.append(`
                    <tr>
                        <td>${escapeHtml(customer.area_name || 'Unknown')}</td>
                        <td>${escapeHtml(customer.consumer_number || 'N/A')}</td>
                        <td>${escapeHtml(customer.consumer_name || 'N/A')}</td>
                        <td>${escapeHtml(customer.phone_number || 'N/A')}</td>
                        <td>
                            <span class="badge ${customer.scheme_type === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${escapeHtml(customer.scheme_type || 'N/A')}
                            </span>
                        </td>
                        <td><span class="badge badge-due">Due</span></td>
                    </tr>
                `);
            });
        }
        
        // Update pagination controls
        const totalPages = Math.ceil(filteredCustomers.length / recordsPerPage);
        $('#currentPage').text(currentPage);
        $('#prevPage').toggleClass('disabled', currentPage === 1);
        $('#nextPage').toggleClass('disabled', currentPage >= totalPages);
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function goBack() {
        if (viewHistory.length === 0) {
            initView();
            return;
        }
        
        const previousView = viewHistory.pop();
        
        if (previousView === 'summary') {
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').hide();
            currentView = 'summary';
        } else if (previousView === 'area') {
            $('#areaBreakdownView').show();
            $('#customerDetailsView').hide();
            currentView = 'area';
        }
    }

    // Event listeners
    $('.clickabled[data-scheme]').on('click', function() {
        const scheme = $(this).data('scheme');
        showAreaBreakdown(scheme);
    });
    
    $('#backToSummary').on('click', function(e) {
        e.preventDefault();
        goBack();
    });
    
    $('#backToAreas').on('click', function(e) {
        e.preventDefault();
        goBack();
    });
    
    // Pagination controls
    $('#prevAreaPage').on('click', function(e) {
        e.preventDefault();
        if (currentAreaPage > 1) {
            currentAreaPage--;
            updateAreaBreakdownTable();
        }
    });
    
    $('#nextAreaPage').on('click', function(e) {
        e.preventDefault();
        if (currentAreaPage * recordsPerPage < areaBreakdownData.length) {
            currentAreaPage++;
            updateAreaBreakdownTable();
        }
    });
    
    $('#prevPage').on('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateCustomerTable();
        }
    });
    
    $('#nextPage').on('click', function(e) {
        e.preventDefault();
        if (currentPage * recordsPerPage < filteredCustomers.length) {
            currentPage++;
            updateCustomerTable();
        }
    });
});
</script>
                    <?php } elseif ($method == 'hosedue') { ?>
                                        <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div class="container4">
    <div class="hosedue_summary">
        <h2>Hose Due Report</h2>
        <table class="custom-table" id="summaryTable">
            <thead>
                <tr>
                    <th>Hose Status</th>
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="summaryTableBody">
                <tr>
                    <td>Due Count</td>
                    <td class="clickabled" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                    <td class="clickabled" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                    <td class="clickabled" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                </tr>
                <tr>
                    <td>Percentage</td>
                    <td><?= $table_data['rows']['%'][0] ?></td>
                    <td><?= $table_data['rows']['%'][1] ?></td>
                    <td><?= $table_data['rows']['%'][2] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <div class="content-section">
        <!-- Area View -->
        <div id="areaView" style="display: none;" class="hosedue-area-details">
            <h4 class="view-title" id="areaViewTitle"></h4>
            <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Due Count</th>
                    </tr>
                </thead>
                <tbody id="areaTableBody"></tbody>
            </table>
        </div>

        <!-- Customer Details View -->
        <div id="customerDetailsView" style="display: none;" class="hosedue_customer_details">
        <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
            <h4 class="view-title" id="customerDetailsTitle"></h4>
            
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Consumer Number</th>
                        <th>Consumer Name</th>
                        <th>Phone Number</th>
                        <th>Scheme</th>
                        <th>Hose Due</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>
            <nav class="pagination">
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Configuration
    const recordsPerPage = 10;
    let currentPage = 1;
    let currentScheme = null;
    let currentArea = null;
    
    // Data from server
    let allCustomers = <?= json_encode($hose_due ?? []) ?>;
    let filteredCustomers = [];
    let areaBreakdownData = [];

    // Initialize view
    initView();

    function initView() {
        $('#areaView').hide();
        $('#customerDetailsView').hide();
        
        // Process the data from the controller
        if (allCustomers && allCustomers.length > 0) {
            processData();
        }
    }

    function processData() {
        // Group data by area and scheme type for quick access
        const areaSchemeData = {};
        
        allCustomers.forEach(customer => {
            const area = customer.area_name || 'Unknown';
            const scheme = customer.scheme_selected;
            
            if (!areaSchemeData[area]) {
                areaSchemeData[area] = { PMUY: [], NonPMUY: [] };
            }
            
            if (scheme === 'PMUY') {
                areaSchemeData[area].PMUY.push(customer);
            } else {
                areaSchemeData[area].NonPMUY.push(customer);
            }
        });
        
        // Store the processed data
        allCustomers = areaSchemeData;
    }

    // Show area breakdown for selected scheme
    function showAreaBreakdown(scheme) {
        currentScheme = scheme;
        
        // Prepare area breakdown data
        areaBreakdownData = [];
        
        for (const area in allCustomers) {
            const customers = allCustomers[area][scheme === 'PMUY' ? 'PMUY' : 'NonPMUY'];
            if (customers.length > 0) {
                areaBreakdownData.push({
                    area: area,
                    count: customers.length,
                    customers: customers
                });
            }
        }
        
        // Sort by count descending
        areaBreakdownData.sort((a, b) => b.count - a.count);
        
        $('#areaViewTitle').text(`Due Hose Customers (${scheme}) by Area`);
        
        updateAreaBreakdownTable();
        
        $('#areaView').show();
        $('#customerDetailsView').hide();
    }

    function updateAreaBreakdownTable() {
        const tableBody = $("#areaTableBody");
        tableBody.empty();
        
        if (areaBreakdownData.length === 0) {
            tableBody.html('<tr><td colspan="2" class="no-data">No data available</td></tr>');
        } else {
            areaBreakdownData.forEach(areaData => {
                tableBody.append(`
                    <tr>
                        <td class="clickabled area-click" data-area="${escapeHtml(areaData.area)}">
                            ${escapeHtml(areaData.area)}
                        </td>
                        <td>${areaData.count}</td>
                    </tr>
                `);
            });
        }
    }

    function showCustomerDetails(area) {
        currentArea = area;
        
        // Find the selected area data
        const areaData = areaBreakdownData.find(item => item.area === area);
        
        if (areaData) {
            filteredCustomers = areaData.customers;
            currentPage = 1;
            
            $('#customerDetailsTitle').text(`Due Hose Customers (${currentScheme}) in ${escapeHtml(area)}`);
            
            updateCustomerTable();
            
            $('#areaView').hide();
            $('#customerDetailsView').show();
        }
    }

    function updateCustomerTable() {
        const start = (currentPage - 1) * recordsPerPage;
        const end = start + recordsPerPage;
        const pageRows = filteredCustomers.slice(start, end);
        const tableBody = $("#customerTableBody");
        
        tableBody.empty();
        
        if (pageRows.length === 0) {
            tableBody.html('<tr><td colspan="6" class="no-data">No data available</td></tr>');
        } else {
            pageRows.forEach(customer => {
                tableBody.append(`
                    <tr>
                        <td>${escapeHtml(customer.area_name || 'N/A')}</td>
                        <td>${escapeHtml(customer.consumer_number || 'N/A')}</td>
                        <td>${escapeHtml(customer.consumer_name || 'N/A')}</td>
                        <td>${escapeHtml(customer.phone_number || 'N/A')}</td>
                        <td>
                            <span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${escapeHtml(customer.scheme_selected || 'N/A')}
                            </span>
                        </td>
                    
                        <td><span class="badge badge-due">Due</span></td>
                    </tr>
                `);
            });
        }
        
        $("#currentPage").text(currentPage);
        $("#prevPage").toggleClass("disabled", currentPage === 1);
        $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
    }

    function escapeHtml(text) {
        if (text == null) return '';
        return text.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Event listeners
    $(document).on('click', '.clickabled[data-scheme]', function() {
        showAreaBreakdown($(this).data('scheme'));
    });
    
    $(document).on('click', '.area-click', function() {
        showCustomerDetails($(this).data('area'));
    });
    
    $("#prevPage").on("click", function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateCustomerTable();
        }
    });
    
    $("#nextPage").on("click", function(e) {
        e.preventDefault();
        if ((currentPage * recordsPerPage) < filteredCustomers.length) {
            currentPage++;
            updateCustomerTable();
        }
    });
    
    $("#backToSummary").on("click", function(e) {
        e.preventDefault();
        $('#areaView').hide();
        $('#customerDetailsView').hide();
    });
    
    $("#backToAreas").on("click", function(e) {
        e.preventDefault();
        showAreaBreakdown(currentScheme);
    });
});
</script>

                    <?php } elseif ($method == 'phonenumber') { ?>
                                    <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div class="container">
    <h2>Phone Number Missing Data</h2>
    
    <!-- Fixed Summary Section -->
    <div class="summary-section">
        <table class="custom-table" id="summaryTable">
            <thead>
                <tr>
                    <th>Phone Missing</th>
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="summaryTableBody">
                <tr>
                    <td>Quantity</td>
                    <td class="clickabled" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                    <td class="clickabled" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                    <td class="clickabled" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                </tr>
                <tr>
                    <td>Percentage</td>
                    <td><?= $table_data['rows']['%'][0] ?></td>
                    <td><?= $table_data['rows']['%'][1] ?></td>
                    <td><?= $table_data['rows']['%'][2] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Scrollable Content Section -->
    <div class="content-section">
        <div id="areaBreakdownView" style="display: none;">
        <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
            <h4 class="view-title" id="areaBreakdownTitle"></h4>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Missing Phone Count</th>
                    </tr>
                </thead>
                <tbody id="areaBreakdownBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

        <div id="customerDetailsView" style="display: none;">
        <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
            <h4 class="view-title" id="customerDetailsTitle"></h4>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Consumer Number</th>
                        <th>Consumer Name</th>
                        <th>Phone Status</th>
                        <th>Scheme</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let currentPage = 1;
    let currentAreaPage = 1;
    const recordsPerPage = 10;
    
    let allCustomers = <?= json_encode($phone_missing_data ?? []) ?>;
    let filteredCustomers = [];
    let areaBreakdownData = [];
    let currentScheme = null;
    let currentArea = null;

    initView();

    function initView() {
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
        
        if (allCustomers && allCustomers.length > 0) {
            processData();
        } else {
            console.log('No customer data received');
        }
    }

    function processData() {
        areaBreakdownData = [];
        const areaCounts = {};

        allCustomers.forEach(customer => {
            const area = customer.area_name || 'Unknown';
            const scheme = customer.scheme_selected;

            if (!areaCounts[area]) {
                areaCounts[area] = { 
                    PMUY: [], 
                    'Non PMUY': [], 
                    customers: []
                };
            }
            
            areaCounts[area].customers.push(customer);
            areaCounts[area][scheme].push(customer);
        });

        for (const area in areaCounts) {
            areaBreakdownData.push({
                area: area,
                pmuCount: areaCounts[area].PMUY.length,
                nonPmuCount: areaCounts[area]['Non PMUY'].length,
                totalCount: areaCounts[area].customers.length,
                customers: areaCounts[area].customers
            });
        }
    }

    function showAreaBreakdown(scheme) {
        currentScheme = scheme;
        
        $('#areaBreakdownTitle').text(`Customers Missing Phone (${scheme}) by Area`);
        currentAreaPage = 1;
        updateAreaBreakdownTable();
        
        $('#areaBreakdownView').show();
        $('#customerDetailsView').hide();
        
        $('.content-section').scrollTop(0);
    }

    function updateAreaBreakdownTable() {
        const start = (currentAreaPage - 1) * recordsPerPage;
        const end = start + recordsPerPage;
        const tableBody = $("#areaBreakdownBody");
        
        tableBody.empty();
        
        const filteredAreas = areaBreakdownData.filter(area => 
            currentScheme === 'Total' ? area.totalCount > 0 :
            currentScheme === 'PMUY' ? area.pmuCount > 0 :
            area.nonPmuCount > 0
        );

        const pageAreas = filteredAreas.slice(start, end);
        
        if (pageAreas.length === 0) {
            tableBody.html('<tr><td colspan="2" class="no-data">No data available</td></tr>');
        } else {
            pageAreas.forEach(areaData => {
                const count = currentScheme === 'Total' ? areaData.totalCount :
                            currentScheme === 'PMUY' ? areaData.pmuCount :
                            areaData.nonPmuCount;
                tableBody.append(`
                    <tr>
                        <td class="clickabled area-click" data-area="${escapeHtml(areaData.area)}">
                            ${escapeHtml(areaData.area)}
                        </td>
                        <td>${count}</td>
                    </tr>
                `);
            });
        }
        
        $("#currentAreaPage").text(currentAreaPage);
        $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
        $("#nextAreaPage").toggleClass("disabled", end >= filteredAreas.length);
    }

    function showCustomerDetails(area) {
        currentArea = area;
        
        const areaData = areaBreakdownData.find(item => item.area === area);
        
        if (areaData) {
            filteredCustomers = currentScheme === 'Total' ? areaData.customers :
                              currentScheme === 'PMUY' ? areaData.customers.filter(c => c.scheme_selected === 'PMUY') :
                              areaData.customers.filter(c => c.scheme_selected === 'Non PMUY');
            
            currentPage = 1;
            
            $('#customerDetailsTitle').text(`Customers Missing Phone (${currentScheme}) in ${escapeHtml(area)}`);
            updateCustomerTable();
            
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').show();
            
            $('.content-section').scrollTop(0);
        }
    }

    function updateCustomerTable() {
        const start = (currentPage - 1) * recordsPerPage;
        const end = start + recordsPerPage;
        const pageRows = filteredCustomers.slice(start, end);
        const tableBody = $("#customerTableBody");
        
        tableBody.empty();
        
        if (pageRows.length === 0) {
            tableBody.html('<tr><td colspan="5" class="no-data">No data available</td></tr>');
        } else {
            pageRows.forEach(customer => {
                tableBody.append(`
                    <tr>
                        <td>${escapeHtml(customer.area_name || 'N/A')}</td>
                        <td>${escapeHtml(customer.consumer_number || 'N/A')}</td>
                        <td>${escapeHtml(customer.consumer_name || 'N/A')}</td>
                        <td><span class="badge badge-missing">Missing</span></td>
                        <td>
                            <span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${escapeHtml(customer.scheme_selected || 'N/A')}
                            </span>
                        </td>
                    </tr>
                `);
            });
        }
        
        $("#currentPage").text(currentPage);
        $("#prevPage").toggleClass("disabled", currentPage === 1);
        $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
    }

    function escapeHtml(text) {
        if (!text) return 'N/A';
        return text.toString()
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    $(document).on('click', '.clickabled[data-scheme]', function() {
        const scheme = $(this).data('scheme');
        showAreaBreakdown(scheme);
    });
    
    $(document).on('click', '.area-click', function() {
        const area = $(this).data('area');
        showCustomerDetails(area);
    });
    
    $("#prevPage").on("click", function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            updateCustomerTable();
        }
    });
    
    $("#nextPage").on("click", function(e) {
        e.preventDefault();
        if ((currentPage * recordsPerPage) < filteredCustomers.length) {
            currentPage++;
            updateCustomerTable();
        }
    });
    
    $("#prevAreaPage").on("click", function(e) {
        e.preventDefault();
        if (currentAreaPage > 1) {
            currentAreaPage--;
            updateAreaBreakdownTable();
        }
    });
    
    $("#nextAreaPage").on("click", function(e) {
        e.preventDefault();
        if ((currentAreaPage * recordsPerPage) < areaBreakdownData.length) {
            currentAreaPage++;
            updateAreaBreakdownTable();
        }
    });
    
    $("#backToAreaView").on("click", function(e) {
        e.preventDefault();
        $('#customerDetailsView').hide();
        $('#areaBreakdownView').show();
    });

    $("#backToSummary").on("click", function(e) {
        e.preventDefault();
        $('#areaBreakdownView').hide();
        $('#customerDetailsView').hide();
    });
    
    $("#backToAreas").on("click", function(e) {
        e.preventDefault();
        showAreaBreakdown(currentScheme);
    });
});
</script>


                    <?php } else { ?>
                    <h1>Invalid Request</h1>
                <?php } ?>
            <?php } else { ?>
                <h1>Invalid Request</h1>
            <?php } ?>
        </main>
    </div>
    <script src= "<?php echo base_url(); ?>application/views/javascript /dashboard.js"></script>
    
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
  
        document.addEventListener('DOMContentLoaded', function () {
            const fileUploadDropdown = document.getElementById('fileUploadDropdown');
            const backlogDropdown = document.getElementById('backlogDropdown');
            const fundBalanceLink = document.querySelector('a[href*=fundbalance_uploadfile"]');

            fileUploadDropdown.addEventListener('click', function () {
                this.classList.add('active');
            });

            backlogDropdown.addEventListener('click', function () {
                fileUploadDropdown.classList.add('active');
            });

            fundBalanceLink.addEventListener('click', function () {
                fileUploadDropdown.classList.add('active');
            });
        });
        
    </script>
    
</body>
</html>
