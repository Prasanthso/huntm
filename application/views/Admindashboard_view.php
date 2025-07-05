<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSG Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #e0e0e0;
            --sidebar-active-bg: rgba(52, 152, 219, 0.2);
            --content-bg: #f8f9fa;
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --text-color: #333333;
            --text-muted: #6c757d;
            --border-color: #dee2e6;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header Styles */
        .app-header {
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .header-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--secondary-color);
            letter-spacing: 0.5px;
        }
        
        .header-brand img {
            height: 32px;
            margin-right: 12px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--content-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            font-size: 1rem;
        }
        
        .user-name {
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.95rem;
        }
        
        /* Sidebar Styles */
        .app-sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s ease;
            z-index: 1020;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .sidebar-header h4 {
            margin-bottom: 0;
            color: white;
            font-weight: 500;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        
        .sidebar-menu {
            flex-grow: 1;
            padding: 1rem 0;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            color: var(--sidebar-color);
            padding: 0.8rem 1.5rem;
            font-weight: 400;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }
        
        .nav-link.active {
            background: var(--sidebar-active-bg);
            color: white;
            border-left-color: var(--primary-color);
            font-weight: 500;
        }
        
        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            color: var(--sidebar-color);
            text-decoration: none;
            padding: 0.7rem 1.5rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-weight: 400;
            font-size: 0.95rem;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .logout-btn i {
            margin-right: 10px;
            font-size: 1rem;
        }
        
        /* Main Content Styles */
        .app-main {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2.5rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - var(--header-height));
            background-color: var(--content-bg);
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 6px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            height: 100%;
            background-color: white;
            border-top: 3px solid var(--primary-color);
        }
        
        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .dashboard-card .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem;
            display: flex;
            align-items: center;
        }
        
        .dashboard-card .card-header i {
            margin-right: 0.75rem;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .dashboard-card .card-header .card-title {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0;
            font-size: 1rem;
        }
        
        .dashboard-card .card-body {
            padding: 1.5rem;
        }
        
        /* Form Styling */
        .form-container {
            background: white;
            padding: 2.5rem;
            border-radius: 6px;
            box-shadow: var(--card-shadow);
            border-top: 3px solid var(--primary-color);
        }
        
        .form-container h2 {
            margin-bottom: 1.75rem;
            color: var(--secondary-color);
            font-weight: 500;
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .form-container h2 i {
            margin-right: 15px;
            color: var(--primary-color);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }
        
        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .btn i {
            margin-right: 0.5rem;
            font-size: 0.95rem;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.75rem;
        }
        
        .breadcrumb-item a {
            text-decoration: none;
            color: var(--primary-color);
            font-size: 0.9rem;
        }
        
        .breadcrumb-item.active {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        /* Page Title */
        .page-title {
            color: var(--secondary-color);
            font-weight: 500;
            font-family: 'Playfair Display', serif;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
        }
        
        /* Alerts */
        .alert {
            border-radius: 4px;
            padding: 1rem 1.5rem;
            border-left: 4px solid transparent;
        }
        
        .alert i {
            margin-right: 0.75rem;
        }
        
        .alert-success {
            border-left-color: var(--success-color);
        }
        
        .alert-danger {
            border-left-color: var(--danger-color);
        }
        
        /* Table Styling */
        .table {
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
            padding: 1rem;
            font-size: 0.95rem;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.03);
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
            font-size: 0.95rem;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .app-sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            
            .app-sidebar.active {
                left: 0;
                box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            }
            
            .app-main {
                margin-left: 0;
            }
            
            .app-main.active {
                margin-left: var(--sidebar-width);
            }
        }
        
        @media (max-width: 768px) {
            .app-main {
                padding: 1.5rem;
            }
            
            .form-container {
                padding: 1.75rem;
            }
            
            .user-name {
                display: none;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Custom Utilities */
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .border-primary {
            border-color: var(--primary-color) !important;
        }
        
        .section-divider {
            border: 0;
            height: 1px;
            background-color: var(--border-color);
            margin: 2rem 0;
        }
        
        .badge-primary {
            background-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <button class="btn btn-link text-dark d-lg-none me-2" type="button" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <a href="<?php echo base_url('AdminDashboard/dashboard'); ?>" class="header-brand">
            <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo">
            <span>LSG Admin</span>
        </a>
        
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span class="user-name d-none d-md-inline"><?php echo htmlspecialchars($admin_name->full_name ?? 'Admin'); ?></span>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>Menu</h4>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?php echo base_url('AdminDashboard/dashboard'); ?>" 
                       class="nav-link <?php echo (current_url() == base_url('AdminDashboard/dashboard')) ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('AdminDashboard/profile'); ?>" 
                       class="nav-link <?php echo (current_url() == base_url('AdminDashboard/profile')) ? 'active' : ''; ?>">
                        <i class="fas fa-user-cog"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('AdminDashboard/create_distributor'); ?>" 
                       class="nav-link <?php echo (current_url() == base_url('AdminDashboard/create_distributor')) ? 'active' : ''; ?>">
                        <i class="fas fa-user-plus"></i>
                        <span>Create Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('AdminDashboard/get_distributor_data'); ?>" 
                       class="nav-link <?php echo (current_url() == base_url('AdminDashboard/get_distributor_data')) ? 'active' : ''; ?>">
                         <i class="fas fa-users-cog"></i>
                        <span>Manage Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('AdminDashboard/assign_same_pages_to_all_staff'); ?>" 
                       class="nav-link <?php echo (current_url() == base_url('AdminDashboard/assign_same_pages_to_all_staff')) ? 'active' : ''; ?>">
                        <i class="fas fa-tasks"></i>
                        <span>Manage Pages</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <a href="<?php echo base_url('login'); ?>" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="app-main" id="main-content">
        <div class="container-fluid animate-fade-in">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>"><i class="fas fa-home"></i> Home</a></li>
                    <?php if ($method == "admindashboard") : ?>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    <?php elseif ($method == "profile") : ?>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    <?php elseif ($method == "create_distributor") : ?>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Distributor</li>
                     <?php elseif ($method == "get_distributor_data") : ?>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Distributor</li>
                    <?php elseif ($method == "assign_same_pages_to_all_staff") : ?>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Pages</li>
                    <?php endif; ?>
                </ol>
            </nav>
            
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title mb-0">
                    <?php if ($method == "admindashboard") : ?>
                        <i class="fas fa-tachometer-alt text-primary me-2"></i>Dashboard Overview
                    <?php elseif ($method == "profile") : ?>
                        <i class="fas fa-user-cog text-primary me-2"></i>Profile Management
                    <?php elseif ($method == "create_distributor") : ?>
                        <i class="fas fa-user-plus text-primary me-2"></i>Create New Distributor
                    <?php elseif ($method == "manage_distributor") : ?>
                        <i class="fas fa-users-cog text-primary me-2"></i>Manage Distributor
                    <?php elseif ($method == "assign_same_pages_to_all_staff") : ?>
                        <i class="fas fa-tasks text-primary me-2"></i>Page Management
                    <?php endif; ?>
                </h2>
            </div>
            
            <!-- Dashboard Content -->
            <?php if ($method == "admindashboard") : ?>
                <div class="row">
                    <?php if (!empty($admin_data)) : ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header">
                                    <i class="fas fa-user-shield me-2"></i>
                                    <span class="card-title">Admin Profile</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-primary mb-3"><?php echo htmlspecialchars($admin_data->full_name ?? 'N/A'); ?></h5>
                                    <div class="mb-2">
                                        <i class="fas fa-envelope me-2 text-muted"></i>
                                        <span><?php echo htmlspecialchars($admin_data->email ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="mb-4">
                                        <i class="fas fa-user-tag me-2 text-muted"></i>
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($admin_data->role ?? 'N/A'); ?></span>
                                    </div>
                                    <a href="<?php echo base_url('AdminDashboard/profile'); ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> No admin data available.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
            <?php elseif ($method == "profile") : ?>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger mb-4">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-success mb-4">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <form id="profileForm" method="post" action="<?php echo base_url('AdminDashboard/add'); ?>">
                                <h5 class="mb-4"><i class="fas fa-user me-2 text-primary"></i>Basic Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                            value="<?php echo htmlspecialchars($admin_data->full_name ?? ''); ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                            value="<?php echo htmlspecialchars($admin_data->email ?? ''); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" 
                                            value="<?php echo htmlspecialchars($admin_data->phone ?? ''); ?>" oninput="validatePhone(this)">
                                        <div class="invalid-feedback" id="phone-error"><?php echo form_error('phone'); ?></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sap_code" class="form-label">SAP Code</label>
                                        <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                            value="<?php echo htmlspecialchars($admin_data->sap_code ?? ''); ?>" oninput="validateSapCode(this)">
                                        <div class="invalid-feedback" id="sap_code-error"><?php echo form_error('sap_code'); ?></div>
                                    </div>
                                </div>
                                
                                <hr class="section-divider">
                                
                                <h5 class="mb-4"><i class="fas fa-university me-2 text-primary"></i>Bank Details</h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                            value="<?php echo htmlspecialchars($admin_data->account_holder_name ?? ''); ?>" oninput="validateAccountHolderName(this)">
                                        <div class="invalid-feedback" id="account_holder_name-error"><?php echo form_error('account_holder_name'); ?></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="account_number" class="form-label">Account Number</label>
                                        <input type="text" class="form-control" id="account_number" name="account_number" 
                                            value="<?php echo htmlspecialchars($admin_data->account_number ?? ''); ?>" oninput="validateAccountNumber(this)">
                                        <div class="invalid-feedback" id="account_number-error"><?php echo form_error('account_number'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                            value="<?php echo htmlspecialchars($admin_data->ifsc_code ?? ''); ?>" oninput="validateIfscCode(this)">
                                        <div class="invalid-feedback" id="ifsc_code-error"><?php echo form_error('ifsc_code'); ?></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                            value="<?php echo htmlspecialchars($admin_data->bank_name ?? ''); ?>" oninput="validateBankName(this)">
                                        <div class="invalid-feedback" id="bank_name-error"><?php echo form_error('bank_name'); ?></div>
                                    </div>
                                </div>
                                
                                <hr class="section-divider">
                                
                                <h5 class="mb-4"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Address Details</h5>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" oninput="validateAddress(this)"><?php echo htmlspecialchars($admin_data->address ?? ''); ?></textarea>
                                    <div class="invalid-feedback" id="address-error"><?php echo form_error('address'); ?></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="pin_code" class="form-label">Pin Code</label>
                                        <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                            value="<?php echo htmlspecialchars($admin_data->pin_code ?? ''); ?>" oninput="validatePinCode(this)">
                                        <div class="invalid-feedback" id="pin_code-error"><?php echo form_error('pin_code'); ?></div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" 
                                            value="<?php echo htmlspecialchars($admin_data->city ?? ''); ?>" oninput="validateCity(this)">
                                        <div class="invalid-feedback" id="city-error"><?php echo form_error('city'); ?></div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="office_mobile" class="form-label">Office Mobile</label>
                                        <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                            value="<?php echo htmlspecialchars($admin_data->office_mobile ?? ''); ?>" oninput="validateOfficeMobile(this)">
                                        <div class="invalid-feedback" id="office_mobile-error"><?php echo form_error('office_mobile'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            <?php elseif ($method == "create_distributor") : ?>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container">
                            <h2><i class="fas fa-user-plus me-2 text-primary"></i>New Distributor Account</h2>
                            <p class="text-muted">Create a new distributor member account</p>
                            <!-- Distributor Limit Indicator -->
                                <?php if (isset($distributor_limit) && isset($current_distributor_count)): ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        You have created <?php echo $current_distributor_count; ?> out of <?php echo $distributor_limit; ?> allowed staff accounts.
                                    </div>
                                <?php endif; ?>
                            
                            <?php echo form_open('Admindashboard/create_distributor'); ?>
                                <div class="mb-3">
                                    <label for="full_name" class="form-label"><i class="fas fa-user me-1 text-muted"></i>Full Name</label>
                                    <input type="text" class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" 
                                        id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" required>
                                    <?php echo form_error('full_name', '<div class="invalid-feedback">', '</div>'); ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-1 text-muted"></i>Email</label>
                                    <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                                        id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                                    <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label"><i class="fas fa-lock me-1 text-muted"></i>Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                                            id="password" name="password" required>
                                        <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    <small class="text-muted">Password must be at least 8 characters long</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="staff_limit" class="form-label"><i class="fas fa-users me-1 text-muted"></i>Staff Limit</label>
                                    <input type="number" class="form-control <?php echo form_error('staff_limit') ? 'is-invalid' : ''; ?>" 
                                        id="staff_limit" name="staff_limit" value="<?php echo set_value('staff_limit', 5); ?>" min="1" required>
                                    <?php echo form_error('staff_limit', '<div class="invalid-feedback">', '</div>'); ?>
                                    <small class="text-muted">Maximum number of staff this distributor can create</small>
                                </div>
                                
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-plus me-2"></i>Create Distributor
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <!-- Limit Reached Modal -->
                <div class="modal fade" id="limitReachedModal" tabindex="-1" aria-labelledby="limitReachedModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="limitReachedModalLabel">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Limit Reached
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>You have reached your maximum distributor limit of <span class="fw-bold"><?php echo $current_limit; ?></span>.</p>
                                <p>Please contact your administrator if you need to increase your distributor limit.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Make sure jQuery and Bootstrap JS are loaded before this script -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                $(document).ready(function() {
                    // Password toggle functionality
                    $('#togglePassword').click(function() {
                        const passwordField = $('#password');
                        const icon = $(this).find('i');
                        
                        if (passwordField.attr('type') === 'password') {
                            passwordField.attr('type', 'text');
                            icon.removeClass('fa-eye').addClass('fa-eye-slash');
                        } else {
                            passwordField.attr('type', 'password');
                            icon.removeClass('fa-eye-slash').addClass('fa-eye');
                        }
                    });
                    
                    // Show modal if limit is reached
                    <?php if (isset($limit_reached) && $limit_reached): ?>
                        $(window).on('load', function() {
                            var myModal = new bootstrap.Modal(document.getElementById('limitReachedModal'));
                            myModal.show();
                        });
                    <?php endif; ?>
                });
                </script>
                <?php elseif($method == 'get_distributor_data'): ?>
                        <div class="row">
                            <div class="col-12">
                                <h2 class="mb-4"><i class="fas fa-users me-2"></i>Distributor Admin Details</h2>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($distributor_data as $distributor): ?>
                                                        <tr>
                                                            <td><?php echo $serialNo; ?></td>
                                                            <td><?php echo htmlspecialchars($distributor->full_name); ?></td>
                                                            <td><?php echo htmlspecialchars($distributor->email); ?></td>
                                                            <td><?php echo htmlspecialchars($distributor->role); ?></td>
                                                            <td>
                                                                <a href="<?php echo base_url('Admindashboard/showing_distributor_remaining_data/'. $distributor->id); ?>" class="btn btn-info btn-sm">
                                                                    <i class="fas fa-eye me-1"></i> View
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $serialNo++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php elseif($method == 'showing_distributor_remaining_data'): ?>
                    <div class="row">
                        <div class="col-12 pt-0">
                            <button class="btn btn-secondary back-btn mb-3" onclick="window.history.back();">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Distributor Full Details</h2>
                                    <form>
                                         <?php foreach ($distributor_data as $distributor): ?>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($distributor->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($distributor->email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($distributor->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($distributor->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <h5 class="section-header"><i class="fas fa-university me-2"></i>Bank Details</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($distributor->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($distributor->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($distributor->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                        value="<?php echo htmlspecialchars($distributor->bank_name ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h5>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($distributor->address ?? ''); ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($distributor->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($distributor->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="office_mobile" class="form-label">Office Mobile</label>
                                                    <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                                        value="<?php echo htmlspecialchars($distributor->office_mobile ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php elseif ($method == "assign_same_pages_to_all_staff") : ?>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container">
                            <h3 class="mb-4"><i class="fas fa-file-alt me-2 text-primary"></i>Available Pages</h3>
                            
                            <form method="post">
                                <div class="list-group mb-4">
                                    <?php foreach ($all_pages as $page) : ?>
                                        <div class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="page_ids[]" 
                                                    value="<?php echo $page->id; ?>" 
                                                    id="page_<?php echo $page->id; ?>"
                                                    <?php echo (isset($selected_pages) && in_array($page->id, $selected_pages)) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="page_<?php echo $page->id; ?>">
                                                    <?php echo htmlspecialchars($page->name); ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            <?php else : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Invalid method specified. Please contact support.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        }

        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.toggle-btn');
                if (window.innerWidth <= 992 && !sidebar.contains(event.target) && event.target !== toggleBtn && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                    document.getElementById('main-content').classList.remove('active');
                }
            });
            
            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const password = document.querySelector('#password');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
            
            // Show SweetAlert notifications
            <?php if($this->session->flashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $this->session->flashdata('success'); ?>',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $this->session->flashdata('error'); ?>',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            <?php endif; ?>
        });

        // Validation functions
        function validatePhone(input) {
            const errorElement = document.getElementById('phone-error');
            const value = input.value.trim();
            const phoneRegex = /^\d{10}$/;
            
            if (value && !phoneRegex.test(value)) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Please enter a valid 10-digit phone number';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateSapCode(input) {
            const errorElement = document.getElementById('sap_code-error');
            const value = input.value.trim();
            
            if (value && value.length < 4) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'SAP Code must be at least 4 characters';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateAccountHolderName(input) {
            const errorElement = document.getElementById('account_holder_name-error');
            const value = input.value.trim();
            
            if (value && value.length < 3) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Account Holder Name must be at least 3 characters';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateAccountNumber(input) {
            const errorElement = document.getElementById('account_number-error');
            const value = input.value.trim();
            const accountNumberRegex = /^\d{8,16}$/;
            
            if (value && !accountNumberRegex.test(value)) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Please enter a valid account number (8-16 digits)';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateIfscCode(input) {
            const errorElement = document.getElementById('ifsc_code-error');
            const value = input.value.trim();
            const ifscRegex = /^[A-Z]{4}0[A-Z0-9]{6}$/;
            
            if (value && !ifscRegex.test(value)) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Please enter a valid IFSC code (e.g., SBIN0001234)';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateBankName(input) {
            const errorElement = document.getElementById('bank_name-error');
            const value = input.value.trim();
            
            if (value && value.length < 2) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Bank Name must be at least 2 characters';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateAddress(input) {
            const errorElement = document.getElementById('address-error');
            const value = input.value.trim();
            
            if (value && value.length < 5) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Address must be at least 5 characters';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validatePinCode(input) {
            const errorElement = document.getElementById('pin_code-error');
            const value = input.value.trim();
            const pinCodeRegex = /^\d{6}$/;
            
            if (value && !pinCodeRegex.test(value)) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Please enter a valid 6-digit pin code';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateCity(input) {
            const errorElement = document.getElementById('city-error');
            const value = input.value.trim();
            
            if (value && value.length < 3) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'City must be at least 3 characters';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateOfficeMobile(input) {
            const errorElement = document.getElementById('office_mobile-error');
            const value = input.value.trim();
            const phoneRegex = /^\d{10}$/;
            
            if (value && !phoneRegex.test(value)) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.textContent = 'Please enter a valid 10-digit phone number';
                return false;
            } else {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
                return true;
            }
        }

        function validateForm(event) {
            event.preventDefault();
            let isValid = true;
            
            // Validate all fields
            const inputs = [
                { id: 'phone', validate: validatePhone },
                { id: 'sap_code', validate: validateSapCode },
                { id: 'account_holder_name', validate: validateAccountHolderName },
                { id: 'account_number', validate: validateAccountNumber },
                { id: 'ifsc_code', validate: validateIfscCode },
                { id: 'bank_name', validate: validateBankName },
                { id: 'address', validate: validateAddress },
                { id: 'pin_code', validate: validatePinCode },
                { id: 'city', validate: validateCity },
                { id: 'office_mobile', validate: validateOfficeMobile }
            ];

            inputs.forEach(({ id, validate }) => {
                const input = document.getElementById(id);
                if (!validate(input)) {
                    isValid = false;
                }
            });

            if (isValid) {
                // Submit the form if valid
                document.getElementById('profileForm').submit();
            } else {
                // Scroll to the first invalid field
                const firstInvalid = document.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
            
            return isValid;
        }
    </script>
</body>
</html>