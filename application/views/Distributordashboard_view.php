<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --sidebar-bg: #343a40;
            --sidebar-color: #e9ecef;
            --sidebar-active-bg: #495057;
            --content-bg: #f8f9fa;
            --primary-color: #6c757d;
            --secondary-color: #5a6268;
            --accent-color: #d4b483;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --text-color: #212529;
            --light-gray: #e9ecef;
            --dark-gray: #343a40;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* Header Styles */
        header {
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            transition: var(--transition);
            border-bottom: 1px solid var(--light-gray);
        }
        
        .header-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-gray);
            margin: 0;
            font-size: 1.5rem;
        }
        
        .user-greeting {
            font-weight: 500;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            background-color: var(--light-gray);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
        }
        
        .user-greeting i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: var(--transition);
            z-index: 999;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .sidebar-header h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 500;
            margin: 0;
            color: white;
            font-size: 1.3rem;
        }
        
        .list-group-item {
            color: var(--sidebar-color);
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            padding: 12px 25px;
            font-weight: 400;
            transition: var(--transition);
            border-left: 4px solid transparent;
            font-size: 0.95rem;
            margin: 2px 0;
        }
        
        .list-group-item:hover, 
        .list-group-item.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left-color: var(--accent-color);
        }
        
        .list-group-item.active {
            background: var(--sidebar-active-bg);
            font-weight: 500;
        }
        
        .list-group-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1rem;
            color: var(--accent-color);
        }
        
        .logout-container {
            margin-top: auto;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-color);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background: rgba(255,255,255,0.1);
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .logout-btn i {
            margin-right: 10px;
            color: var(--danger-color);
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            transition: var(--transition);
            min-height: calc(100vh - var(--header-height));
        }
        
        /* Toggle Button */
        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-gray);
            cursor: pointer;
            transition: var(--transition);
            padding: 5px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .toggle-btn:hover {
            background-color: var(--light-gray);
            color: var(--primary-color);
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
            height: 100%;
            border-left: 4px solid var(--accent-color);
            background-color: white;
            overflow: hidden;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .dashboard-card .card-header {
            background-color: white;
            border-bottom: 1px solid var(--light-gray);
            padding: 15px 20px;
            font-weight: 500;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
        }
        
        .dashboard-card .card-header i {
            color: var(--accent-color);
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        .dashboard-card .card-body {
            padding: 20px;
        }
        
        .dashboard-card h5 {
            color: var(--dark-gray);
            font-weight: 600;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
        }
        
        .dashboard-card .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .dashboard-card .detail-item i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 0.9rem;
            min-width: 20px;
        }
        
        .dashboard-card .detail-item span {
            font-size: 0.9rem;
            color: var(--text-color);
        }
        
        .badge-custom {
            background-color: var(--accent-color);
            color: white;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
        }
        
        /* Quick Actions */
        .quick-actions .btn {
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            font-size: 0.85rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }
        
        .quick-actions .btn i {
            margin-right: 8px;
            font-size: 0.9rem;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            font-size: 0.85rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--secondary-color);
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--primary-color);
        }
        
        /* Form Styling */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: 1px solid var(--light-gray);
        }
        
        .form-container h2 {
            margin-bottom: 25px;
            color: var(--dark-gray);
            font-weight: 600;
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
        }
        
        .form-container h2 i {
            margin-right: 15px;
            color: var(--accent-color);
        }
        
        .form-section-title {
            color: var(--dark-gray);
            font-weight: 500;
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--light-gray);
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }
        
        .form-section-title i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: var(--border-radius);
            border: 1px solid var(--light-gray);
            transition: var(--transition);
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(212, 180, 131, 0.25);
        }
        
        .form-control[readonly] {
            background-color: var(--light-gray);
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #c9a66b;
            border-color: #c9a66b;
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-outline-primary {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            color: white;
        }
        
        /* Alerts */
        .alert {
            border-radius: var(--border-radius);
            padding: 15px;
            font-size: 0.9rem;
        }
        
        .alert i {
            margin-right: 10px;
        }
        
        /* Table Styling */
        .table {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: var(--dark-gray);
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: var(--transition);
        }
        
        .table tbody tr:hover {
            background-color: rgba(212, 180, 131, 0.1);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: var(--light-gray);
            font-size: 0.9rem;
        }
        
        /* Password Toggle */
        .password-toggle {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
        }
        
        .password-toggle:hover {
            background-color: light green;
        }
        
        /* Error Messages */
        .error-message {
            color: var(--danger-color);
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
        
        .is-invalid {
            border-color: var(--danger-color);
        }
        
        .invalid-feedback {
            font-size: 0.8rem;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            
            #sidebar.active {
                left: 0;
                box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.active {
                margin-left: var(--sidebar-width);
            }
            
            .form-container {
                padding: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
            
            .user-greeting {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
            
            .user-greeting i {
                font-size: 0.9rem;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--light-gray);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <header class="shadow-sm">
        <div class="d-flex align-items-center">
            <button class="toggle-btn me-3" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="header-title">Distributor Portal</h1>
        </div>
        <div class="user-greeting">
            <i class="fas fa-user-circle me-2"></i>
            <span>Welcome, <?php echo htmlspecialchars($distributor_data->full_name ?? 'Distributor'); ?></span>
        </div>
    </header>

    <div id="sidebar">
        <div class="sidebar-header">
            <h4>Menu</h4>
        </div>
        <div class="list-group list-group-flush flex-grow-1">
            <a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" 
            class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Distributordashboard/dashboard')) ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('Distributordashboard/profile'); ?>" 
            class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Distributordashboard/profile')) ? 'active' : ''; ?>">
                <i class="fas fa-user-cog"></i>
                <span>Profile Settings</span>
            </a>
            <a href="<?php echo base_url('Distributordashboard/create_staff'); ?>" 
            class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Distributordashboard/create_staff')) ? 'active' : ''; ?>">
                <i class="fas fa-user-plus"></i>
                <span>Create Staff</span>
            </a>
        </div>
        <div class="logout-container">
            <a href="<?php echo base_url('login'); ?>" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-content" id="main-content">
        <div class="container-fluid">
            <?php if (isset($method) && in_array($method, ['distributordashboard', 'profile', 'create_staff'])) : ?>
                <?php if ($method == "distributordashboard") : ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="h3 mb-0 text-gray-800">Dashboard Overview</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"></i> Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row fade-in">
                        <?php if (!empty($distributor_data)): ?>
                            <?php foreach ($distributor_data as $distributor) : ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-user-shield"></i>
                                        <span>Admin Profile</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($distributor->full_name ?? 'N/A'); ?></h5>
                                        <div class="detail-item">
                                            <i class="fas fa-envelope"></i>
                                            <span><?php echo htmlspecialchars($distributor->email ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-phone"></i>
                                            <span><?php echo htmlspecialchars($distributor->phone ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span><?php echo htmlspecialchars($distributor->city ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge-custom"><?php echo htmlspecialchars($distributor->role ?? 'Distributor Admin'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-building"></i>
                                        <span>Business Details</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="detail-item">
                                            <i class="fas fa-barcode"></i>
                                            <span>SAP Code: <?php echo htmlspecialchars($distributor_data->sap_code ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-university"></i>
                                            <span>Bank: <?php echo htmlspecialchars($distributor_data->bank_name ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-credit-card"></i>
                                            <span>Account: ••••<?php echo !empty($distributor_data->account_number) ? substr($distributor_data->account_number, -4) : 'N/A'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-bolt"></i>
                                        <span>Quick Actions</span>
                                    </div>
                                    <div class="card-body quick-actions">
                                        <a href="<?php echo base_url('Distributordashboard/profile'); ?>" class="btn btn-outline-primary">
                                            <i class="fas fa-user-edit"></i> Update Profile
                                        </a>
                                        <a href="<?php echo base_url('Distributordashboard/create_staff'); ?>" class="btn btn-outline-primary">
                                            <i class="fas fa-user-plus"></i> Add Staff
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fas fa-file-invoice"></i> View Reports
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No distributor data available.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                <?php elseif ($method == "profile") : ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="h3 mb-0 text-gray-800">Profile Management</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('distributordashboard/dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-cog"></i> Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row fade-in">
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <div class="text-center mb-4">
                                    <h2><i class="fas fa-user-circle"></i> Profile Information</h2>
                                    <p class="text-muted">Update your personal and business details</p>
                                </div>
                                
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php echo $this->session->flashdata('error'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <?php echo $this->session->flashdata('success'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                
                                <form id="profileForm" method="post" action="<?php echo base_url('distributordashboard/add'); ?>">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" 
                                                value="<?php echo htmlspecialchars($distributor_data->full_name ?? ''); ?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                value="<?php echo htmlspecialchars($distributor_data->email ?? ''); ?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" 
                                                value="<?php echo htmlspecialchars($distributor_data->phone ?? ''); ?>" oninput="validatePhone(this)">
                                            <div class="error-message" id="phone-error"><?php echo form_error('phone'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="sap_code" class="form-label">SAP Code</label>
                                            <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                value="<?php echo htmlspecialchars($distributor_data->sap_code ?? ''); ?>" oninput="validateSapCode(this)">
                                            <div class="error-message" id="sap_code-error"><?php echo form_error('sap_code'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="form-section-title"><i class="fas fa-university"></i> Bank Details</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                value="<?php echo htmlspecialchars($distributor_data->account_holder_name ?? ''); ?>" oninput="validateAccountHolderName(this)">
                                            <div class="error-message" id="account_holder_name-error"><?php echo form_error('account_holder_name'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" class="form-control" id="account_number" name="account_number" 
                                                value="<?php echo htmlspecialchars($distributor_data->account_number ?? ''); ?>" oninput="validateAccountNumber(this)">
                                            <div class="error-message" id="account_number-error"><?php echo form_error('account_number'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="ifsc_code" class="form-label">IFSC Code</label>
                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                value="<?php echo htmlspecialchars($distributor_data->ifsc_code ?? ''); ?>" oninput="validateIfscCode(this)">
                                            <div class="error-message" id="ifsc_code-error"><?php echo form_error('ifsc_code'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                value="<?php echo htmlspecialchars($distributor_data->bank_name ?? ''); ?>" oninput="validateBankName(this)">
                                            <div class="error-message" id="bank_name-error"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="form-section-title"><i class="fas fa-map-marker-alt"></i> Address Details</h5>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" oninput="validateAddress(this)"><?php echo htmlspecialchars($distributor_data->address ?? ''); ?></textarea>
                                        <div class="error-message" id="address-error"><?php echo form_error('address'); ?></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                value="<?php echo htmlspecialchars($distributor_data->pin_code ?? ''); ?>" oninput="validatePinCode(this)">
                                            <div class="error-message" id="pin_code-error"><?php echo form_error('pin_code'); ?></div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                value="<?php echo htmlspecialchars($distributor_data->city ?? ''); ?>" oninput="validateCity(this)">
                                            <div class="error-message" id="city-error"><?php echo form_error('city'); ?></div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="office_mobile" class="form-label">Office Mobile</label>
                                            <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                                value="<?php echo htmlspecialchars($distributor_data->office_mobile ?? ''); ?>" oninput="validateOfficeMobile(this)">
                                            <div class="error-message" id="office_mobile-error"><?php echo form_error('office_mobile'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-save me-1"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($method == "create_staff") : ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="h3 mb-0 text-gray-800">Staff Management</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('Distributordashboard/dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-plus"></i> Create Staff</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row fade-in">
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <div class="text-center mb-4">
                                    <h2><i class="fas fa-user-plus"></i> New Staff Account</h2>
                                    <p class="text-muted">Create a new staff member account</p>
                                </div>
                                
                                <?php echo form_open('Distributordashboard/create_staff'); ?>
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label"><i class="fas fa-user me-1 text-gray-500"></i> Full Name</label>
                                        <input type="text" class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" 
                                            id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" required>
                                        <?php echo form_error('full_name', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label"><i class="fas fa-envelope me-1 text-gray-500"></i> Email</label>
                                        <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                                            id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                                        <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label"><i class="fas fa-lock me-1 text-gray-500"></i> Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                                                id="password" name="password" required>
                                            <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                        <div class="form-text text-muted small">Password must be at least 8 characters long</div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary py-2">
                                            <i class="fas fa-user-plus me-2"></i> Create Staff Account
                                        </button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    
                <?php else: ?>
                    <div class="row fade-in">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Invalid method specified. Please contact support.
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="row fade-in">
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Page not properly configured. Please try navigating to the <a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" class="alert-link">Dashboard</a>.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
            
            // Save state in localStorage
            localStorage.setItem('sidebarActive', sidebar.classList.contains('active'));
        }
        
        // Check for saved sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('sidebarActive') === 'true') {
                document.getElementById('sidebar').classList.add('active');
                document.getElementById('main-content').classList.add('active');
            }
            
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const passwordInput = document.getElementById('password');
                    const icon = this.querySelector('i');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
        });
        
        // Validation functions
        function validatePhone(input) {
            const error = document.getElementById('phone-error');
            if (input.value && !/^\d{10,15}$/.test(input.value)) {
                error.textContent = 'Phone must be 10-15 digits.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateSapCode(input) {
            const error = document.getElementById('sap_code-error');
            if (input.value && !/^[a-zA-Z0-9]+$/.test(input.value)) {
                error.textContent = 'SAP Code must be alphanumeric.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateAccountHolderName(input) {
            const error = document.getElementById('account_holder_name-error');
            if (input.value && !/^[a-zA-Z0-9\s]+$/.test(input.value)) {
                error.textContent = 'Account Holder Name must be alphanumeric with spaces.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateAccountNumber(input) {
            const error = document.getElementById('account_number-error');
            if (input.value && !/^\d+$/.test(input.value)) {
                error.textContent = 'Account Number must be numeric.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateIfscCode(input) {
            const error = document.getElementById('ifsc_code-error');
            if (input.value && !/^[a-zA-Z0-9]+$/.test(input.value)) {
                error.textContent = 'IFSC Code must be alphanumeric.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateBankName(input) {
            const error = document.getElementById('bank_name-error');
            if (input.value && !/^[a-zA-Z0-9\s]+$/.test(input.value)) {
                error.textContent = 'Bank Name must be alphanumeric with spaces.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateAddress(input) {
            const error = document.getElementById('address-error');
            error.style.display = 'none';
            input.classList.remove('is-invalid');
        }
        
        function validatePinCode(input) {
            const error = document.getElementById('pin_code-error');
            if (input.value && !/^\d{6}$/.test(input.value)) {
                error.textContent = 'Pin Code must be exactly 6 digits.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateCity(input) {
            const error = document.getElementById('city-error');
            if (input.value && !/^[a-zA-Z0-9\s]+$/.test(input.value)) {
                error.textContent = 'City must be alphanumeric with spaces.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        function validateOfficeMobile(input) {
            const error = document.getElementById('office_mobile-error');
            if (input.value && !/^\d{10,15}$/.test(input.value)) {
                error.textContent = 'Office Mobile must be 10-15 digits.';
                error.style.display = 'block';
                input.classList.add('is-invalid');
            } else {
                error.textContent = '';
                error.style.display = 'none';
                input.classList.remove('is-invalid');
            }
        }
        
        // Form validation
        document.getElementById('profileForm')?.addEventListener('submit', function(event) {
            let isValid = true;
            const fields = [
                { id: 'phone', errorId: 'phone-error', regex: /^\d{10,15}$/, message: 'Phone must be 10-15 digits.', optional: true },
                { id: 'sap_code', errorId: 'sap_code-error', regex: /^[a-zA-Z0-9]+$/, message: 'SAP Code must be alphanumeric.', optional: true },
                { id: 'account_holder_name', errorId: 'account_holder_name-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'Account Holder Name must be alphanumeric with spaces.', optional: true },
                { id: 'account_number', errorId: 'account_number-error', regex: /^\d+$/, message: 'Account Number must be numeric.', optional: true },
                { id: 'ifsc_code', errorId: 'ifsc_code-error', regex: /^[a-zA-Z0-9]+$/, message: 'IFSC Code must be alphanumeric.', optional: true },
                { id: 'bank_name', errorId: 'bank_name-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'Bank Name must be alphanumeric with spaces.', optional: true },
                { id: 'pin_code', errorId: 'pin_code-error', regex: /^\d{6}$/, message: 'Pin Code must be exactly 6 digits.', optional: true },
                { id: 'city', errorId: 'city-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'City must be alphanumeric with spaces.', optional: true },
                { id: 'office_mobile', errorId: 'office_mobile-error', regex: /^\d{10,15}$/, message: 'Office Mobile must be 10-15 digits.', optional: true }
            ];

            fields.forEach(field => {
                const input = document.getElementById(field.id);
                const value = input.value;
                const errorElement = document.getElementById(field.errorId);
                
                if (value && field.regex && !field.regex.test(value)) {
                    errorElement.textContent = field.message;
                    errorElement.style.display = 'block';
                    input.classList.add('is-invalid');
                    isValid = false;
                } else if (!value && !field.optional) {
                    errorElement.textContent = 'This field is required';
                    errorElement.style.display = 'block';
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                event.preventDefault();
                // Scroll to the first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    </script>
</body>
</html>