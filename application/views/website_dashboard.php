<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 70px;
            --primary-color: #2C3E50;
            --secondary-color: #1a252f;
            --accent-color: #3498db;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding-top: var(--header-height);
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--header-height);
            background-color: var(--primary-color);
            z-index: 1030;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 0 20px;
        }

        .navbar-brand {
            font-weight: 500;
            font-size: 1.5rem;
        }

        .huntmlogo {
            width: 40px;
            height: 40px;
        }

        /* Sidebar Styles */
        #sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background-color: var(--primary-color);
            transition: all 0.3s;
            z-index: 1020;
            overflow-y: auto;
        }

        #sidebar.collapsed {
            left: calc(-1 * var(--sidebar-width));
        }

        .list-group-item {
            border: none;
            border-radius: 0;
            background-color: transparent;
            color: white;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .list-group-item:hover, 
        .list-group-item:focus {
            background-color: rgba(255,255,255,0.1);
            border-left-color: var(--accent-color);
            color: white;
        }

        .list-group-item.active {
            background-color: rgba(255,255,255,0.2);
            border-left-color: var(--accent-color);
            font-weight: 500;
        }

        .dropdown-menu {
            background-color: var(--secondary-color);
            border: none;
            border-radius: 0;
        }

        .dropdown-item {
            color: white;
            padding: 8px 20px;
        }

        .dropdown-item:hover, 
        .dropdown-item:focus {
            background-color: var(--accent-color);
            color: white;
        }

        .dropdown-toggle::after {
            float: right;
            margin-top: 8px;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Dashboard Cards */
        .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .dashboard-card .card-body {
            padding: 1.5rem;
        }

        .dashboard-card h6 {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .dashboard-card p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }

        .form-container h2, 
        .form-container h3 {
            color: var( --success-color);
            margin-bottom: 20px;
        }

        /* Table Styles */
        .table-responsive {
            margin-bottom: 20px;
        }

        .table th {
            background-color: var( --success-color);
            color: white;
            font-weight: 500;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tr:hover td {
            background-color: #e2f1ff;
        }

        /* Badges */
        .badge-pmuy {
            background-color: #28a745;
            color: white;
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 12px;
        }

        .badge-non-pmuy {
            background-color: #6c757d;
            color: white;
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 12px;
        }

        .badge-due {
            background-color: var(--danger-color);
            color: white;
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 12px;
        }

        .badge-missing {
            background-color: var(--warning-color);
            color: var(--dark-color);
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 12px;
        }

        .badge_sbc{
            background-color: #6c757d;
            color: white;
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 12px;
        }

        /* Back button */
        .back-btn {
            margin-top: 20px;
        }

        .clickabled{
            cursor: pointer;
            color: black;
        }

        .clickabled:hover{
            color: #0056b3;
        }

        /* Logout button */
        .logout-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            color: #ff6b6b;
        }

        /* Hamburger menu */
        .hamburger-btn {
            color: white;
            font-size: 1.5rem;
            background: none;
            border: none;
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-width));
            }

            #sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .hamburger-btn {
                display: block;
            }

            .dashboard-card {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-card h6 {
                font-size: 0.9rem;
            }

            .dashboard-card p {
                font-size: 0.8rem;
            }
        }

        /* Animation for sidebar */
        @keyframes slideIn {
            from { left: calc(-1 * var(--sidebar-width))); }
            to { left: 0; }
        }

        @keyframes slideOut {
            from { left: 0; }
            to { left: calc(-1 * var(--sidebar-width))); }
        }
    </style>
</head>
<body>
    <?php 
    $userid = $this->session->userdata('id');
    ?>

    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="hamburger-btn me-3" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white text-decoration-none">
                <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo me-2">
                <span class="navbar-brand">Huntm</span>
            </a>
        </div>

        <div class="text-end text-white">
            Welcome! <?php echo $this->session->userdata('username'); ?>
        </div>
    </header>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="list-group list-group-flush">
            <a href="<?php echo base_url('dashboard'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            
            <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="fileUploadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-upload me-2"></i>File Upload
                </a>
                <ul class="dropdown-menu" aria-labelledby="fileUploadDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" id="backlogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-layer-group me-2"></i>Backlog
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('WebScrapping'); ?>">Invoice File Upload</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Process File Upload</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url('fundbalance'); ?>"><i class="fas fa-wallet me-2"></i>Fund Balance</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customerregister'); ?>"><i class="fas fa-users me-2"></i>Customer Register</a></li>
                </ul>
            </div>

            <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="backlogDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-layer-group me-2"></i>Backlog
                </a>
                <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('invoiceorder'); ?>">Invoice Order Service Area</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('open-process-order'); ?>">Process Order Service Area</a></li>
                </ul>
            </div>

            <a href="<?php echo base_url('submitsuggetions'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'suggestion') ? 'active' : ''; ?>">
                <i class="fas fa-lightbulb me-2"></i>Suggestion
            </a>
            
            <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="websiteDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe me-2"></i>User Website
                </a>
                <ul class="dropdown-menu" aria-labelledby="websiteDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('addwebsite'); ?>">Add Website</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('storewebsite'); ?>">Store Website</a></li>
                </ul>
            </div>
            
            <div class="logout-container mt-auto p-3">
                <a href="<?php echo base_url('loginform'); ?>" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <?php if (isset($method)) { ?>
            <!-- Dashboard Section -->
            <?php if ($method == 'dashboard') { ?>
                <div class="container-fluid">
                    <h1 class="mb-4">Dashboard Overview</h1>
                    
                    <div class="row g-4">
                        <!-- Backlog Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-light" onclick="window.location.href='invoiceorder'">
                                <div class="card-body">
                                    <h6><i class="fas fa-users me-2"></i> Backlog</h6>
                                    <p>Areas: 150</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fund Balance Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-info bg-opacity-10" onclick="window.location.href='fundbalance_data'">
                                <div class="card-body">
                                    <h6><i class="fas fa-wallet me-2"></i> Fund Balance</h6>
                                    <p>Rs:760,461.17</p>
                                    <p>IOCL</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Customer Strength Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-success bg-opacity-10" onclick="window.location.href='customer_strength'">
                                <div class="card-body">
                                    <h6><i class="fas fa-chart-line me-2"></i> Customer Strength</h6>
                                    <?php
                                    if (isset($customer_data) && is_array($customer_data)) {
                                        $totalCustomers = $customer_data['total']['total'] ?? 0;
                                        $percent = $customer_data['total']['percent'] ?? 0; 

                                        if ($totalCustomers > 0):
                                    ?>
                                            <p>Total: <?= number_format($totalCustomers) ?></p>
                                            <p>Percent: <?= round($percent, 2) ?>%</p> 
                                    <?php
                                        else:
                                            echo '<p>No customers found</p>';
                                        endif;
                                    } else {
                                        echo '<p>Data not available</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SBC Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-warning bg-opacity-10" onclick="window.location.href='SBC_data'">
                                <div class="card-body">
                                    <h6><i class="fas fa-gas-pump me-2"></i> SBC</h6>
                                    <?php
                                    if (isset($sbc_counts) && isset($customer_data)) {
                                        $sbc_total = $sbc_counts['total'] ?? 0;
                                        $customer_total = $customer_data['total']['total'] ?? 0;

                                        if ($sbc_total > 0 && $customer_total > 0):
                                            $sbc_percent = round(($sbc_total / $customer_total) * 100);
                                    ?>
                                            <p>Total: <?= number_format($sbc_total) ?></p>
                                            <p>Percent: <?= $sbc_percent ?>%</p>
                                    <?php
                                        else:
                                            echo '<p>No SBC data found</p>';
                                        endif;
                                    } else {
                                        echo '<p>Data not available</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Nil Refill Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-danger bg-opacity-10" onclick="window.location.href='nillfill'">
                                <div class="card-body">
                                    <h6><i class="fas fa-calendar-times me-2"></i> Nil Refill</h6>
                                    <?php if (!empty($stats)): ?>
                                        <p>3 Months</p>
                                        <p>Total: <?= number_format($stats['greater_than_3_months']['total']['qty']) ?></p>
                                        <p>Percent: <?=round ($stats['greater_than_3_months']['total']['percent'])?>% </p>
                                    <?php else: ?>
                                        <p>Data not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- KYC Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-primary bg-opacity-10" onclick="window.location.href='kycdata'">
                                <div class="card-body">
                                    <h6><i class="fas fa-id-card me-2"></i> KYC</h6>
                                    <?php
                                    if (isset($kyc_stats)) {
                                        $kyc_completed = $kyc_stats['Total_Pending'];
                                        $total_customers = $kyc_stats['Total'];

                                        if ($kyc_completed > 0 && $total_customers > 0):
                                            $kyc_percent = round(($kyc_completed / $total_customers) * 100);
                                    ?>
                                            <p>Total: <?= number_format($kyc_completed) ?></p>
                                            <p>Percent: <?= $kyc_percent ?>%</p>
                                    <?php
                                        else:
                                            echo '<p>No KYC data found</p>';
                                        endif;
                                    } else {
                                        echo '<p>Data not available</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- MI Due Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-secondary bg-opacity-10" onclick="window.location.href='midue'">
                                <div class="card-body">
                                    <h6><i class="fas fa-calendar-check me-2"></i> MI Due</h6>
                                    <?php if (!empty($mi_stats) && isset($mi_stats['total']['qty']) && isset($mi_stats['total']['percent'])): ?>
                                    <p>Total: <?php echo number_format($mi_stats['total']['qty']); ?></p>
                                    <p>Percent: <?php echo round($mi_stats['total']['percent']); ?>%</p>
                                    <?php else: ?>
                                        <p>Data not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hose Due Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-purple bg-opacity-10" onclick="window.location.href='hosedue'">
                                <div class="card-body">
                                    <h6><i class="fas fa-fire-extinguisher me-2"></i> Hose Due</h6>
                                    <?php if (!empty($hose_stats) && isset($hose_stats['total']['qty']) && isset($hose_stats['total']['percent'])): ?>
                                        <p>Total: <?= number_format($hose_stats['total']['qty']) ?></p>
                                        <p>Percent: <?= round($hose_stats['total']['percent']) ?>%</p>
                                    <?php else: ?>
                                        <p>Data not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Phone Number Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-teal bg-opacity-10" onclick="window.location.href='phonenumber'">
                                <div class="card-body">
                                    <h6><i class="fas fa-phone me-2"></i> Mobile No</h6>
                                    <?php if (!empty($phone_stats) && isset($phone_stats['total']['qty']) && isset($phone_stats['total']['percent'])): ?>
                                        <p>Total: <?= number_format($phone_stats['total']['qty']) ?></p>
                                        <p>Percent: <?= round($phone_stats['total']['percent']) ?>%</p>
                                    <?php else: ?>
                                        <p>Data not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Other sections would follow the same responsive pattern -->
            <?php } elseif ($method == 'invoice_order') { ?>
                <div class="container">
                    <div class="form-container">
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

            <?php } elseif ($method == 'open_order') { ?>
                <div class="container">
                    <div class="form-container">
                        <h2 class="text-center mb-4">Upload Open Order Data</h2>
                        
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
                    <!-- <div class="container1">
                        <h2 class="text-center mb-4">Customer Register Upload Data</h2>

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
</div> --
                    </div> -->
                    <div class="container">
                        <div class="card shadow p-4">
                            <h2 class="text-center mb-4">Customer Register Upload Data</h2>
                            
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
                            
                            <form action="<?php echo site_url('customerregister_uploadfile'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
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

                <!-- display open process data in website -->
                <?php } elseif ($method == 'display_invoice_data') { ?>
                    <div class="container">
                        <h2 class="text-center mb-4">Invoice Order Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>
                        <div class="table-responsive">
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
                    </div>

                    <?php } elseif ($method == 'display_open_data') {?>
                        <div class="container">
                        <h2 class="text-center mb-4">Open Process Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>
                        <div class="table-responsive">
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
                        <h2 class="text-center mb-3"><i class="fas fa-globe"></i> Add Website</h>
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
                        <h2 class="text-center mb-4">Stored Websites</h2>

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
        <div class="container4">
        

        <!-- Fixed Summary Table -->
        <div class="summary-section">
        <h2 class="text-center mb-4">Customer Strength Data</h2>
            <div class="table-responsive">
                <table class="table table table-bordered">
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
                            <td>Quantity</td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                            <td class="clickabled" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                        </tr>
                        <tr>
                            <td>Percent</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                            <td>97.36%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Main Content Area -->
        <div id="mainContent" class="customer_area_details">
            <h4 class="text-center mb-4">Customer Distribution by Area</h4>
            <div class="table-responsive">
                <table class="table table table-bordered">
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
                            $area_counts = [];
                            foreach ($customers as $customer) {
                                $area = $customer['area_name'] ?? 'Unknown Area';
                                $area_counts[$area] = ($area_counts[$area] ?? 0) + 1;
                            }
                            $display_areas = array_slice($area_counts, 0, 10, true);
                            ?>
                            <?php foreach ($display_areas as $area => $count): ?>
                                <tr>
                                    <td class="clickabled initial-area-click" data-area="<?= htmlspecialchars($area, ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($area, ENT_QUOTES, 'UTF-8') ?>
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
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <!-- Back Button -->
    <button id="backButton" title="Back to Summary">↑</button>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        let currentPage = 1;
        const recordsPerPage = 10;
        let allAreas = [];
        let filteredCustomers = [];
        let currentStatus = null;
        let currentScheme = null;
        let currentArea = null;
        let viewHistory = ['initial'];

        // Initialize with all customer data from PHP
        const allCustomers = <?= json_encode($customers) ?>;
        const customerData = <?= json_encode($customer_data) ?>;

        // Load initial area breakdown
        function loadInitialAreaBreakdown() {
            viewHistory = ['initial'];
            $('#backButton').hide();
            currentStatus = null;
            currentScheme = null;
            currentArea = null;

            // Group customers by area
            const areaCounts = {};
            allCustomers.forEach(customer => {
                const area = customer.area_name || 'Unknown Area';
                areaCounts[area] = (areaCounts[area] || 0) + 1;
            });

            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            currentPage = 1;
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
                pageAreas.forEach(({ area, count }) => {
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
            $('#prevPage').toggleClass('disabled', currentPage === 1);
            $('#nextPage').toggleClass('disabled', end >= allAreas.length);

            // Add click handlers for area rows
            $('.initial-area-click').off('click').on('click', function () {
                currentArea = $(this).data('area');
                filteredCustomers = allCustomers.filter(customer => 
                    (customer.area_name || 'Unknown Area') === currentArea
                );
                loadCustomerDetailsView(null, null, currentArea);
            });
        }

        function loadAreaBreakdownView(status, scheme) {
            viewHistory.push('areaBreakdown');
            $('#backButton').show();
            currentStatus = status;
            currentScheme = scheme;

            const title = `${status === 'ALL' ? 'All Statuses' : status} - ${scheme === 'ALL' ? 'All Schemes' : scheme.replace('_', ' ')} Customers by Area`;

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
                areaCounts[area] = (areaCounts[area] || 0) + 1;
            });

            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            currentPage = 1;

            const areaBreakdownHTML = `
                <h4 class="text-center mb-4">${title}</h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
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
                    <ul class="pagination justify-content-center mt-3">
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
                pageAreas.forEach(({ area, count }) => {
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
            $('#prevPage').toggleClass('disabled', currentPage === 1);
            $('#nextPage').toggleClass('disabled', end >= allAreas.length);

            // Add click handlers for area rows
            $('.area-click').off('click').on('click', function () {
                currentArea = $(this).data('area');
                const areaCustomers = filteredCustomers.filter(customer => 
                    (customer.area_name || 'Unknown Area') === currentArea
                );
                loadCustomerDetailsView(currentStatus, currentScheme, currentArea);
            });
        }

        function loadCustomerDetailsView(status, scheme, area) {
            viewHistory.push('customerDetails');
            $('#backButton').show();

            let title = status && scheme 
                ? `${status === 'ALL' ? 'All Statuses' : status} - ${scheme === 'ALL' ? 'All Schemes' : scheme.replace('_', ' ')} Customers in ${area || 'N/A'}`
                : `All Customers in ${area || 'N/A'}`;

            filteredCustomers = allCustomers.filter(customer => {
                const statusMatch = status === 'ALL' ? true : customer.consumer_sub_status === status;
                const schemeMatch = scheme === 'ALL' ? true : 
                    (scheme === 'PMUY' ? customer.scheme_selected === 'PMUY' : customer.scheme_selected !== 'PMUY');
                const areaMatch = (customer.area_name || 'Unknown Area') === area;
                return (!status || statusMatch) && (!scheme || schemeMatch) && areaMatch;
            });

            currentPage = 1;

            const customerDetailsHTML = `
                <h4 class="text-center mb-4">${title}</h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
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
                    <ul class="pagination justify-content-center mt-3">
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

            let tableBody = '';
            if (pageRows.length === 0) {
                tableBody = '<tr><td colspan="6" class="no-data">No data available</td></tr>';
            } else {
                pageRows.forEach(customer => {
                    const schemeClass = customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy';
                    tableBody += `
                        <tr>
                            <td>${customer.area_name || 'N/A'}</td>
                            <td>${customer.consumer_number || 'N/A'}</td>
                            <td>${customer.consumer_name || 'N/A'}</td>
                            <td>${customer.phone_number || 'N/A'}</td>
                            <td><span class="badge ${schemeClass}">${customer.scheme_selected || 'N/A'}</span></td>
                            <td>${customer.consumer_sub_status || 'N/A'}</td>
                        </tr>
                    `;
                });
            }

            $('#customerTableBody').html(tableBody);
            $('#currentPage').text(currentPage);
            $('#prevPage').toggleClass('disabled', currentPage === 1);
            $('#nextPage').toggleClass('disabled', end >= filteredCustomers.length);
        }

        // Event listeners
        $('.table .clickabled').on('click', function () {
            const status = $(this).data('status');
            const scheme = $(this).data('scheme');
            if (status && scheme) {
                loadAreaBreakdownView(status, scheme);
            }
        });

        $('#backButton').on('click', function () {
            if (viewHistory.length <= 1) return;

            viewHistory.pop();
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
        $(document).on('click', '#prevPage:not(.disabled)', function () {
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

        $(document).on('click', '#nextPage:not(.disabled)', function () {
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
        <div class="container4">
        <!-- Fixed Summary Section -->
        <div class="sbc_summary">
            <h2 class="text-center mb-4">SBC Data Report</h2>
            <div class="table-responsive">
                <table class="table table table-bordered summary-table" id="summaryTable">
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
                            <td class="clickabled" data-scheme="PMUY"><?php echo $table_data['rows']['Qty'][0] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Non PMUY"><?php echo $table_data['rows']['Qty'][1] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Total"><?php echo $table_data['rows']['Qty'][2] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $table_data['rows']['%'][0] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][1] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][2] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
                    
        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;" class="sbc_area_details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered area-table">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Connection Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
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
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered table_area">
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
                </div>
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
                                    <span class="badge_sbc ${typeBadgeClass}">
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
        
        <div class="container4">
        <!-- Fixed Summary Table -->
        <div class="nerefil-summary">
            <h2 class="text-center mb-4">Nil Refill Report</h2>
            <div class="table-responsive">
                <table class="table table table-bordered nilrefil_summary_table" id="summaryTable">
                    <thead>
                        <tr class="table-primary">
                            <th rowspan="2">Time Since Last Refill</th>
                            <th colspan="3">3 Months</th>
                            <th colspan="3">6 Months</th>
                            <th colspan="3">1 Year</th>
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
                            <td>Quantity</td>
                            <td class="clickabled" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo $stats['greater_than_3_months']['pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo $stats['greater_than_3_months']['non_pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_3_months" data-scheme="total"><?php echo $stats['greater_than_3_months']['total']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo $stats['greater_than_6_months']['pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo $stats['greater_than_6_months']['non_pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_6_months" data-scheme="total"><?php echo $stats['greater_than_6_months']['total']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo $stats['greater_than_1_year']['pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo $stats['greater_than_1_year']['non_pmuy']['qty'] ?? 0; ?></td>
                            <td class="clickabled" data-period="greater_than_1_year" data-scheme="total"><?php echo $stats['greater_than_1_year']['total']['qty'] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $stats['greater_than_3_months']['pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_3_months']['non_pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_3_months']['total']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_6_months']['pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_6_months']['non_pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_6_months']['total']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_1_year']['pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_1_year']['non_pmuy']['percent'] ?? 0; ?>%</td>
                            <td><?php echo $stats['greater_than_1_year']['total']['percent'] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Details Sections -->
        <div class="content-section">
            <!-- Area Breakdown View -->
            <div id="areaBreakdownView" style="display: none;" class="nilrefil_area_details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered area-table">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Customer Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
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
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Consumer Number</th>
                                <th>Consumer Name</th>
                                <th>Phone Number</th>
                                <th>Scheme</th>
                                <th>Nil Refill Status</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody"></tbody>
                    </table>
                </div>
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
                        <td>${escapeHtml(customer.phone_number) || 'N\A'}</td>
                        <td><span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">${customer.scheme_selected}</span></td>
                        <td><span class="badge badge-due">Due</span></td>
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
            <h2 class="text-center mb-4">KYC Data Table</h2>
            <div class="table-responsive">
                <table class="table table table-bordered table_summary_kyc" id="summaryTable">
                    <thead>
                        <tr class="head-row">
                            <th rowspan="2">KYC Data</th>
                            <th colspan="3">KYC Pending</th>
                        </tr>
                        <tr class="sub-header">
                            <th>PMUY</th>
                            <th>Non PMUY</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Quantity</td>
                            <td class="clickabled" data-scheme="PMUY"><?php echo $kyc_stats['PMUY_Pending'] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Non PMUY"><?php echo $kyc_stats['Non_PMUY_Pending'] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Total"><?php echo $kyc_stats['Total_Pending'] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $kyc_stats['PMUY_Pending_Percent'] ?? 0; ?>%</td>
                            <td><?php echo $kyc_stats['Non_PMUY_Pending_Percent'] ?? 0; ?>%</td>
                            <td><?php echo $kyc_stats['Total_Pending_Percent'] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- Main Content Area -->
        <div id="mainContent">
            <!-- Area Breakdown View -->
            <div id="areaBreakdownView" style="display: none;" class="kyc-area-details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Pending KYC Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
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
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
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
                            <?php foreach ($kyc_data as $customer): ?>
                                <?php if (empty($customer['kyc_number'])): ?>
                                    <tr data-area="<?php echo htmlspecialchars($customer['area_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8'); ?>" 
                                        data-scheme="<?php echo htmlspecialchars($customer['scheme_selected'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <td><?php echo htmlspecialchars($customer['area_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($customer['consumer_number'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($customer['consumer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($customer['phone_number'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <span class="badge <?php echo ($customer['scheme_selected'] === 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy'; ?>">
                                                <?php echo htmlspecialchars($customer['scheme_selected'], ENT_QUOTES, 'UTF-8'); ?>
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
                </div>
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
        <div class="container4">
        <!-- Fixed Summary Section -->
        <div class="midue-summary">
            <h2 class="text-center mb-4">MI Due Data Table</h2>
            <div class="table-responsive">
                <table class="table table table-bordered" id="summaryTable">
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
                            <td class="clickabled" data-scheme="PMUY"><?php echo $table_data['rows']['Qty'][0] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Non PMUY"><?php echo $table_data['rows']['Qty'][1] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Total"><?php echo $table_data['rows']['Qty'][2] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $table_data['rows']['%'][0] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][1] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][2] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;" class="midue-area-details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Due Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
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
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
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
                </div>
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

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                $('.fixed-summary').show();
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
                console.log('Sample filtered customers:', filteredCustomers.slice(0, 5));
                
                // Group by area
                const areaCounts = {};
                filteredCustomers.forEach(customer => {
                    const area = customer.area_name;
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
                // Keep fixed-summary visible
                
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
                    const customerArea = customer.area_name;
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
                // Keep fixed-summary visible
                
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
                                <td>${escapeHtml(customer.area_name)}</td>
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
                    initView();
                } else if (previousView === 'area') {
                    $('#areaBreakdownView').show();
                    $('#customerDetailsView').hide();
                    $('.fixed-summary').show();
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
            <h2 class="text-center mb-4">Hose Due Report</h2>
            <div class="table-responsive">
                <table class="table table table-bordered" id="summaryTable">
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
                            <td>Quantity</td>
                            <td class="clickabled" data-scheme="PMUY"><?php echo $table_data['rows']['Qty'][0] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Non PMUY"><?php echo $table_data['rows']['Qty'][1] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Total"><?php echo $table_data['rows']['Qty'][2] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $table_data['rows']['%'][0] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][1] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][2] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
                </div>
        </div>
    </div>

    <div class="container">
        <div class="content-section">
            <!-- Area View -->
            <div id="areaView" style="display: none;" class="hosedue-area-details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaViewTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Due Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaTableBody"></tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details View -->
            <div id="customerDetailsView" style="display: none;" class="hosedue_customer_details">
                <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
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
                </div>
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
        <div class="container4">
        
        
        <!-- Fixed Summary Section -->
        <div class="summary-section">
        <h2 class="text-center mb-4">Phone Number Missing Data</h2>
            <div class="table-responsive">
                <table class="table table table-bordered" id="summaryTable">
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
                            <td class="clickabled" data-scheme="PMUY"><?php echo $table_data['rows']['Qty'][0] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Non PMUY"><?php echo $table_data['rows']['Qty'][1] ?? 0; ?></td>
                            <td class="clickabled" data-scheme="Total"><?php echo $table_data['rows']['Qty'][2] ?? 0; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $table_data['rows']['%'][0] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][1] ?? 0; ?>%</td>
                            <td><?php echo $table_data['rows']['%'][2] ?? 0; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown View -->
            <div id="areaBreakdownView" style="display: none;" class="phone_missing_area_details">
                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Missing Phone Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details View -->
            <div id="customerDetailsView" style="display: none;" class="phone_missing_customer_details">
                <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                <div class="table-responsive">
                    <table class="table table table-bordered">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Consumer Number</th>
                                <th>Consumer Name</th>
                                <th>Phone Number Status</th>
                                <th>Scheme</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody"></tbody>
                    </table>
                </div>
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


            <!-- Other sections would follow similar responsive patterns -->
            <?php } else { ?>
                <div class="container">
                    <div class="alert alert-warning">
                        <h1>Invalid Request</h1>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="container">
                <div class="alert alert-warning">
                    <h1>Invalid Request</h1>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
        });

        // Initialize dropdown submenus
        document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const submenu = this.nextElementSibling;
                const isShowing = submenu.classList.contains('show');
                
                // Close all other open submenus
                document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(function(menu) {
                    if (menu !== submenu) {
                        menu.classList.remove('show');
                    }
                });
                
                // Toggle this submenu
                if (!isShowing) {
                    submenu.classList.add('show');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.classList.remove('show');
                });
            }
        });

        // Show alerts if any flash messages exist
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

        // Function to handle dashboard card clicks
        function showDetails(section) {
            // You can implement navigation logic here
            console.log('Navigating to:', section);
        }
    </script>
</body>
</html>