<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #ecf0f1;
            --sidebar-active-bg: #3498db;
            --content-bg: #f5f7fa;
            --primary-color: #0A517F;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --info-color: #1abc9c;
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: var(--content-bg);
            color: #333;
            min-height: 100vh;
            margin: 0;
        }
        
        /* Header Styles */
        header {
            height: var(--header-height);
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        }
        
        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--secondary-color);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .toggle-btn:hover {
            color: var(--primary-color);
        }
        
        .user-greeting {
            font-weight: 500;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
        }
        
        .user-greeting i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-collapsed-width);
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
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        #sidebar.expanded {
            width: var(--sidebar-width);
        }
        
        .sidebar-header h4,
        .list-group-item span,
        .logout-btn span {
            display: none;
        }
        
        #sidebar.expanded .sidebar-header h4,
        #sidebar.expanded .list-group-item span,
        #sidebar.expanded .logout-btn span {
            display: inline;
        }
        
        .sidebar-header {
            padding: 25px;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        #sidebar.expanded .sidebar-header {
            padding: 25px;
        }
        
        .sidebar-header h4 {
            margin-bottom: 0;
            color: white;
            font-weight: 500;
            font-size: 1.2rem;
        }
        
        .list-group-item {
            color: var(--sidebar-color);
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            /* font-weight: 500; */
            transition: var(--transition);
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #sidebar.expanded .list-group-item {
            justify-content: flex-start;
            padding: 15px 25px;
        }
        
        .list-group-item i {
            margin-right: 0;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        #sidebar.expanded .list-group-item i {
            margin-right: 12px;
        }
        
        .list-group-item:hover,
        .list-group-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--sidebar-active-bg);
        }
        
        .list-group-item.active {
            background: var(--sidebar-active-bg);
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
            border-radius: 6px;
            transition: var(--transition);
        }
        
        #sidebar.expanded .logout-btn {
            justify-content: flex-start;
        }
        
        .logout-btn i {
            margin-right: 0;
            font-size: 1.1rem;
        }
        
        #sidebar.expanded .logout-btn i {
            margin-right: 10px;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-collapsed-width);
            margin-top: var(--header-height);
            padding: 30px;
            transition: var(--transition);
            min-height: calc(100vh - var(--header-height));
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-width);
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: var(--transition);
            cursor: pointer;
            height: 100%;
            border-left: 4px solid #0A517F;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .dashboard-card .card-body {
            padding: 20px;
        }
        
        .dashboard-card h6 {
            color: #0A517F;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .dashboard-card h6 i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .dashboard-card p {
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Form Styling */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }
        
        .form-container h2 {
            margin-bottom: 25px;
            color: var(--secondary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .form-container h2 i {
            margin-right: 15px;
            color: var(--primary-color);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        /* Custom Form Styling */
        .form-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-group-custom label {
            position: absolute;
            top: -24px;
            left: 12px;
            background: #fff;
            padding: 0 6px;
            font-size: 16px;
            color: #0A517F;
            font-weight: 500;
            pointer-events: none;
        }
        
        .form-group-custom input,
        .form-group-custom select {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #0A517F;
            border-radius: 12px;
            font-size: 16px;
            color: rgba(10, 81, 127, 0.6);
            outline: none;
        }
        
        .form-group-custom input::placeholder {
            color: rgba(10, 81, 127, 0.6);
            font-size: 13px;
        }
        
        .form-group-custom .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            /* padding: 12px 20px; */
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-color);
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }
        
        .btn-sm {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        
        /* Table Styling */
        /* .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
        }
        
        .table tbody tr {
            transition: var(--transition);
        }
        
        .table-hover tbody tr:hover {
            background-color: #3498db !important;
            color: white; /* Optional: makes text visible on blue *
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #eee;
        } */
        
        /* Table style */
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table th {
            background-color: #28a745;
            color: white;
            font-weight: 500;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tr:hover td {
            background-color: #e2f1ff;
        }
        
        /* Back Button */
        .back-btn {
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
        }
        
        .back-btn i {
            margin-right: 8px;
        }
        
        /* Section Headers */
        .section-header {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 25px 0 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .section-header i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            text-decoration: none;
            color: var(--primary-color);
        }
        
        .breadcrumb-item.active {
            color: #666;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        
        /* Mobile Overlay */
        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            #sidebar {
                width: 0;
                /* overflow: hidden; */
                transition: width 0.3s ease-in-out;
                z-index: 999;
                height: 100vh;
            }
            .logout-container {
                margin-bottom: 50px;
            }
            #sidebar.expanded {
                width: 100%;
                box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .main-content.expanded {
                margin-left: 0;
            }
            
            .user-greeting span {
                display: none;
            }
            
            /* Mobile specific styles */
            .mobile-overlay.active {
                display: block;
            }
            
            /* Improve card layout on mobile */
            .card-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            /* Improve form layout on mobile */
            .form-row-mobile {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            
            /* Improve table layout on mobile */
            .table-mobile {
                font-size: 0.8rem;
            }
            
            .table-mobile th,
            .table-mobile td {
                padding: 8px 5px;
            }
            
            /* Improve button sizing on mobile */
            .btn-mobile {
                /* width: 100%; */
                margin-top: 10px;
                margin-bottom: 5px;
            }
            
            /* Header adjustments for mobile */
            header {
                padding: 0 15px;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
            
            /* Dashboard card adjustments */
            .dashboard-card .card-body {
                padding: 15px;
            }
            
            .dashboard-card h6 {
                font-size: 0.9rem;
            }
            
            .dashboard-card p {
                font-size: 0.8rem;
            }
            
            /* Form container adjustments */
            .form-container {
                padding: 20px;
            }
            
            .form-container h2 {
                font-size: 1.3rem;
            }
            
            /* Table responsive adjustments */
            .table-responsive {
                border-radius: 8px;
            }
            
            /* Section header adjustments */
            .section-header {
                font-size: 1.1rem;
            }
            
            /* Modal adjustments */
            .modal-dialog {
                max-width: 95%;
                margin: 10px auto;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            /* Tablet specific adjustments */
            .dashboard-card {
                margin-bottom: 20px;
            }
            
            .form-container {
                padding: 25px;
            }
            
            .main-content {
                padding: 25px;
            }
        }
        
        @media (min-width: 1025px) {
            #sidebar {
                width: var(--sidebar-collapsed-width);
            }
            
            #sidebar.expanded {
                width: var(--sidebar-width);
            }
            
            .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }
            
            .main-content.expanded {
                margin-left: var(--sidebar-width);
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--content-bg);
        }
        
        /* ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        } */

        .header-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
            font-size: 1.5rem;
        }
        
        /* Mobile specific improvements */
        @media (max-width: 576px) {
            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .main-content {
                padding: 10px;
            }
            
            .dashboard-card .card-body {
                padding: 12px;
            }
            
            .dashboard-card h6 {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dashboard-card h6 i {
                margin-bottom: 5px;
            }
            
            .form-container {
                padding: 15px;
            }
            
            .form-container h2 {
                font-size: 1.2rem;
            }
            
            .section-header {
                font-size: 1rem;
            }
            
            .table th, .table td {
                padding: 8px 5px !important;
                font-size: 0.75rem;
            }
            
            .btn {
                font-size: 0.8rem;
                padding: 8px 12px;
            }
            
            /* Action buttons in tables */
            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }
            
            .action-buttons .btn {
                width: 100%;
            }
            
            /* Search and filter sections */
            .search-filter-section {
                flex-direction: column;
            }
            
            .search-filter-section .col-md-4 {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    
    <!-- Header -->
    <header class="shadow-sm">
        <div class="d-flex align-items-center">
            <button class="toggle-btn" id="sidebarToggle">
                <i class="fas fa-bars me-2"></i>
            </button>
            <h1 class="header-title">Super Admin Portal</h1>
        </div>
        <div class="d-flex align-items-center">
            <div class="user-greeting">
                <i class="fas fa-user-shield"></i>
                <span>Welcome, <?php echo htmlspecialchars($superadmin_data->full_name ?? 'Super Admin'); ?></span>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
        </div>
        <div class="list-group list-group-flush flex-grow-1">
            <a href="<?php echo base_url('super-admin-dashboard'); ?>" 
               class="list-group-item list-group-item-action <?php echo ($method == 'superadmindashboard') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('super-admin-create-admin'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('super-admin-create-admin')) ? 'active' : ''; ?>">
                <i class="fas fa-user-plus"></i>
                <span>Create Admin</span>
            </a>
            <a href="<?php echo base_url('get-admin-data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('get-admin-data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Admins</span>
            </a>
            <a href="<?php echo base_url('get-distributors-data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('get-distributors-data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Distributor</span>
            </a>
            <a href="<?php echo base_url('get-staff-data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('get-staff-data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Staff</span>
            </a>
            <a href="<?php echo base_url('get-distributor-limits'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('get-distributor-limits')) ? 'active' : ''; ?>">
                <i class="bi bi-arrow-clockwise"></i>
                <span>Update Distributor Limits</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/get_all_transactions'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/get_all_transactions')) ? 'active' : ''; ?>">
                <i class="fas fa-money-bill-wave"></i>
                <span>Client Amounts</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/prices_details'); ?>" class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/prices_details')) ? 'active' : ''; ?>">
                <i class="fas fa-tags"></i>
                <span>Product Prices</span>
            </a>
        </div>
        <div class="logout-container">
            <a href="#" class="logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('logout'); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="container-fluid fade-in">
            <?php if (isset($method)) : ?>
                <?php if ($method == 'superadmindashboard') : ?>
                    <div class="container-fluid">
                        <h1 class="mb-4">Dashboard Overview</h1>
                        <div class="row g-4">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('get-admin-data'); ?>'">
                                    <div class="card-body">
                                        <h6><i class="fas fa-users me-2"></i> Admin Details</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>Name: <?php echo htmlspecialchars($admin->full_name); ?></p>
                                                <p>Role: <?php echo htmlspecialchars($admin->role); ?></p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('super-admin-create-admin'); ?>'">
                                    <div class="card-body">
                                        <h6><i class="fas fa-user-plus me-2"></i> Create Admin</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>Add new admin</p>
                                                <p>users to system</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('get-distributors-data'); ?>'">
                                    <div class="card-body">
                                        <h6><i class="fas fa-users-cog me-2"></i> Distributors Details</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>View and manage</p>
                                                <p>all distributor accounts</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('get-staff-data'); ?>'">
                                    <div class="card-body">
                                        <h6><i class="fas fa-users-cog me-2"></i> Staff Details</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>View and manage</p>
                                                <p>all staff accounts</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif($method == 'get_admin_data') : ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Admin Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-bordered table-mobile">
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
                                                <?php if (!empty($admin_data)): ?>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($admin_data as $admin): ?>
                                                        <tr>
                                                            <td><?= $serialNo++; ?></td>
                                                            <td><?= htmlspecialchars($admin->full_name); ?></td>
                                                            <td><?= htmlspecialchars($admin->email); ?></td>
                                                            <td><?= htmlspecialchars($admin->role); ?></td>
                                                            <td class="action-buttons">
                                                                <a href="<?= base_url('showing-admin-remaining-data/' . $admin->id); ?>" 
                                                                class="btn btn-sm btn-outline-primary p-1 px-2 me-1">
                                                                    <i class="fas fa-eye me-1"></i>
                                                                </a>
                                                                <button class="btn btn-sm btn-outline-danger p-1 px-2" 
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal" 
                                                                        data-id="<?= $admin->id ?>">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-danger py-3">
                                                            <i class="fas fa-exclamation-triangle me-2"></i>No admin found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this admin?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>   
                <!-- JavaScript to set delete link dynamically -->
                <script>
                    const deleteModal = document.getElementById('deleteModal');
                    const confirmBtn = document.getElementById('confirmDeleteBtn');

                    deleteModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const adminId = button.getAttribute('data-id');
                        const deleteUrl = "<?= base_url('delete-admin/') ?>" + adminId;
                        confirmBtn.setAttribute('href', deleteUrl);
                    });
                </script>        
                <?php elseif($method == 'showing_admin_remaining_data') : ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('get-admin-data'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Admin List</a></button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Admin Full Details</h2>
                                    <form>
                                        <?php foreach ($admin_data as $admin): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($admin->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($admin->email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($admin->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($admin->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($admin->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($admin->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($admin->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                        value="<?php echo htmlspecialchars($admin->bank_name ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2" style="color: #0A517F;"></i>Address Details</h5>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($admin->address ?? ''); ?></textarea>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($admin->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($admin->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="office_mobile" class="form-label">Office Mobile</label>
                                                    <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                                        value="<?php echo htmlspecialchars($admin->office_mobile ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif($method == 'get_distributor_data'): ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Distributor Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-mobile mb-0">
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
                                                <?php if (!empty($distributor_data)): ?>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($distributor_data as $distributor): ?>
                                                        <tr>
                                                            <td><?= $serialNo++; ?></td>
                                                            <td><?= htmlspecialchars($distributor->full_name); ?></td>
                                                            <td><?= htmlspecialchars($distributor->email); ?></td>
                                                            <td><?= htmlspecialchars($distributor->role); ?></td>
                                                            <td class="action-buttons">
                                                                <a href="<?= base_url('showing-distributors-remaining-data/' . $distributor->id); ?>"
                                                                class="btn btn-sm btn-outline-primary p-1 px-2 me-1">
                                                                    <i class="fas fa-eye me-1"></i>
                                                                </a>
                                                                <!-- Trigger Delete Modal -->
                                                                <button class="btn btn-sm btn-outline-danger p-1 px-2" 
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal" 
                                                                        data-id="<?= $distributor->id ?>">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-danger py-3">
                                                           <i class="fas fa-exclamation-triangle me-2"></i> No distributor found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this distributor?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- JavaScript to set delete link dynamically -->
                <script>
                    const deleteModal = document.getElementById('deleteModal');
                    const confirmBtn = document.getElementById('confirmDeleteBtn');

                    deleteModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const distributorId = button.getAttribute('data-id');
                        const deleteUrl = "<?= base_url('delete-distributor/') ?>" + distributorId;
                        confirmBtn.setAttribute('href', deleteUrl);
                    });
                </script>
                <?php elseif($method == 'showing_distributor_remaining_data') : ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('get-distributors-data'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Distributor List</a></button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Distributor Admin Full Details</h2>
                                    <form>
                                        <?php foreach ($distributor_data as $distributor): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($distributor->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($distributor->email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($distributor->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($distributor->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($distributor->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($distributor->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($distributor->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                        value="<?php echo htmlspecialchars($distributor->bank_name ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2" style="color: #0A517F;"></i>Address Details</h5>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($distributor->address ?? ''); ?></textarea>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($distributor->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($distributor->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
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
                <?php elseif($method == 'get_staff_data'): ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Staff Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-bordered table-mobile">
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
                                                <?php if (!empty($staff_data)): ?>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($staff_data as $staff): ?>
                                                        <tr>
                                                            <td><?= $serialNo++; ?></td>
                                                            <td><?= htmlspecialchars($staff->full_name); ?></td>
                                                            <td><?= htmlspecialchars($staff->Email); ?></td>
                                                            <td><?= htmlspecialchars($staff->role); ?></td>
                                                            <td class="action-buttons">
                                                                <a href="<?= base_url('showing-staff-remaining-data/' . $staff->id); ?>"
                                                                class="btn btn-sm btn-outline-primary p-1 px-2 me-1">
                                                                    <i class="fas fa-eye me-1"></i>
                                                                </a>
                                                                <!-- Trigger Delete Modal -->
                                                                <button class="btn btn-sm btn-outline-danger p-1 px-2" 
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal" 
                                                                        data-id="<?= $staff->id ?>">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-danger py-3">
                                                           <i class="fas fa-exclamation-triangle me-2"></i> No staff found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                     <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this staff?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- JavaScript to set delete link dynamically -->
                    <script>
                        const deleteModal = document.getElementById('deleteModal');
                        const confirmBtn = document.getElementById('confirmDeleteBtn');

                        deleteModal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const distributorId = button.getAttribute('data-id');
                            const deleteUrl = "<?= base_url('delete-staff/') ?>" + distributorId;
                            confirmBtn.setAttribute('href', deleteUrl);
                        });
                    </script>
                <?php elseif($method == 'showing_staff_remaining_data'): ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('get-staff-data'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Staff List</a></button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Staff Full Details</h2>
                                    <form>
                                        <?php foreach ($staff_data as $staff): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($staff->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($staff->Email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($staff->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($staff->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($staff->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($staff->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($staff->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                        value="<?php echo htmlspecialchars($staff->bank_name ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2" style="color: #0A517F;"></i>Address Details</h5>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($staff->address ?? ''); ?></textarea>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($staff->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($staff->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-12 col-md-4 mb-3">
                                                    <label for="office_mobile" class="form-label">Office Mobile</label>
                                                    <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                                        value="<?php echo htmlspecialchars($staff->office_mobile ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif($method == 'get_distributor_limits'): ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-12">
                            <h2 class="mb-4"><i class="bi bi-arrow-clockwise me-2"></i>Update Distributor Limit</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-mobile">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Distributor Limit</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($get_distributor_limits)): ?>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($get_distributor_limits as $d): ?>
                                                        <tr>
                                                            <td><?= $serialNo++; ?></td>
                                                            <td><?= htmlspecialchars($d->full_name); ?></td>
                                                            <td><?= htmlspecialchars($d->email); ?></td>
                                                            <td><?= htmlspecialchars($d->role); ?></td>
                                                            <td><?= htmlspecialchars($d->distributor_limit); ?></td>
                                                            <td class="action-buttons">
                                                                <button type="button"
                                                                    class="btn btn-primary update-distributor-limit-btn btn-mobile"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateDistributorLimitModal"
                                                                    data-id="<?= $d->id ?>"
                                                                    data-name="<?= htmlspecialchars($d->full_name) ?>"
                                                                    data-email="<?= htmlspecialchars($d->email) ?>"
                                                                    data-role="<?= htmlspecialchars($d->role) ?>"
                                                                    data-limit="<?= htmlspecialchars($d->distributor_limit) ?>">
                                                                    <i class="fas fa-edit me-1"></i> Update Limit
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-danger py-3">
                                                           <i class="fas fa-exclamation-triangle me-2"></i> No distributor found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Distributor Limit Modal -->
                    <div class="modal fade" id="updateDistributorLimitModal" tabindex="-1" aria-labelledby="updateDistributorLimitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="<?= base_url('update-distributor-limits'); ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fas fa-users-cog me-2 text-dark"></i>Update Distributor Limit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="distributor_id" id="modal_distributor_id">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" id="modal_full_name" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="modal_email" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <input type="text" class="form-control" id="modal_role" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modal_distributor_limit" class="form-label">Distributor Limit</label>
                                            <input type="number" class="form-control" name="distributor_limit" id="modal_distributor_limit" min="1" required>
                                            <small class="text-muted">Maximum number of staff this distributor can create</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php elseif($method == 'get_all_transactions'): ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary"><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-12">
                            <div class="col-12 d-flex justify-content-between align-items-center mb-3 search-filter-section">
                                <h2 class="mb-0"><i class="fas fa-tags me-2"></i>Transaction Details</h2>
                                <button class="btn btn-success btn-mobile" data-bs-toggle="modal" data-bs-target="#addAmountModal">
                                    <i class="fas fa-plus-circle me-2"></i>Add Amount
                                </button>
                            </div>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <!-- Search input with clear button -->
                                    <div class="mb-3 position-relative col-md-4 col-sm-6">
                                        <input type="text" id="searchInput" class="form-control pe-5" placeholder="Search by Name and Phone Number">
                                        <button id="clearSearch" class="btn position-absolute end-0 top-50 translate-middle-y" style="display: none; background: none; border: none;">
                                            <i class="fas fa-times text-danger"></i>
                                        </button>
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <table class="table table-bordered align-middle table-mobile" id="transactionsTable">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date</th>
                                                    <th>Distributor Name</th>
                                                    <th>Phone</th>
                                                    <th>Mode of Payment</th>
                                                    <th>Payment Details</th>
                                                    <th>Credited Amount (₹)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($get_all_transactions)) { 
                                                    $i = 1;
                                                    foreach ($get_all_transactions as $row) { 
                                                        $details = json_decode($row['payment_details'], true);
                                                ?>
                                                    <tr data-distributor-name="<?php echo htmlspecialchars(strtolower($row['client_name'])); ?>">
                                                        <td class="text-center"><?php echo $i++; ?></td>
                                                        <td><?= date("d-m-Y", strtotime($row['credited_at'])); ?></td>
                                                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['client_phone']); ?></td>
                                                        <td class="text-center text-capitalize"><?php echo $row['mode_of_payment']; ?></td>
                                                        <td>
                                                            <?php 
                                                            if ($row['mode_of_payment'] == 'neft') {
                                                                echo "IFSC: " . htmlspecialchars($details['ifsc_code']) . "<br>Account: " . htmlspecialchars($details['account_number']);
                                                            } elseif ($row['mode_of_payment'] == 'upi') {
                                                                echo "Transaction ID: " . htmlspecialchars($details['transaction_id']);
                                                            } elseif ($row['mode_of_payment'] == 'cash') {
                                                                echo "Receipt No: " . htmlspecialchars($details['receipt_number']);
                                                            } else {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-end"><?php echo number_format($row['amount'], 2); ?></td>
                                                    </tr>
                                                <?php } } else { ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted">No transactions found.</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Pagination controls -->
                                    <nav aria-label="Pagination" id="paginationNav" class="d-flex justify-content-center mt-3" style="display: none;">
                                        <ul class="pagination">
                                            <!-- Pagination links will be dynamically generated here -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <!-- JS for Search and Pagination -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const table = document.getElementById('transactionsTable');
                            const tbody = table.querySelector('tbody');
                            const rows = Array.from(tbody.querySelectorAll('tr:not(.no-results)'));
                            const searchInput = document.getElementById('searchInput');
                            const clearSearch = document.getElementById('clearSearch');
                            const paginationNav = document.getElementById('paginationNav');
                            const paginationUl = paginationNav.querySelector('.pagination');
                            const recordsPerPage = 5;
                            let currentPage = 1;
                            let filteredRows = rows;

                            // Function to display rows for the current page
                            function displayPage(page) {
                                const start = (page - 1) * recordsPerPage;
                                const end = start + recordsPerPage;
                                rows.forEach(row => row.style.display = 'none');
                                filteredRows.slice(start, end).forEach(row => row.style.display = '');
                            }

                            // Function to generate pagination links
                            function generatePagination() {
                                paginationUl.innerHTML = '';
                                const totalPages = Math.ceil(filteredRows.length / recordsPerPage);

                                // Previous button
                                const prevLi = document.createElement('li');
                                prevLi.classList.add('page-item');
                                if (currentPage === 1) prevLi.classList.add('disabled');
                                prevLi.innerHTML = `<a class="page-link" href="#">Previous</a>`;
                                prevLi.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (currentPage > 1) {
                                        currentPage--;
                                        displayPage(currentPage);
                                        generatePagination();
                                    }
                                });
                                paginationUl.appendChild(prevLi);

                                // Page numbers
                                for (let i = 1; i <= totalPages; i++) {
                                    const li = document.createElement('li');
                                    li.classList.add('page-item');
                                    if (i === currentPage) li.classList.add('active');
                                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                                    li.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        currentPage = i;
                                        displayPage(currentPage);
                                        generatePagination();
                                    });
                                    paginationUl.appendChild(li);
                                }

                                // Next button
                                const nextLi = document.createElement('li');
                                nextLi.classList.add('page-item');
                                if (currentPage === totalPages) nextLi.classList.add('disabled');
                                nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
                                nextLi.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    if (currentPage < totalPages) {
                                        currentPage++;
                                        displayPage(currentPage);
                                        generatePagination();
                                    }
                                });
                                paginationUl.appendChild(nextLi);

                                // Show pagination if there are pages
                                if (totalPages > 1) {
                                    paginationNav.style.display = 'flex';
                                } else {
                                    paginationNav.style.display = 'none';
                                }
                            }

                            // Function to filter rows based on search
                            function filterRows() {
                                const searchTerm = searchInput.value.toLowerCase();
                                filteredRows = rows.filter(row => {
                                    const distributorName = row.getAttribute('data-distributor-name');
                                    const phone = row.children[3]?.textContent.toLowerCase(); 
                                    return (
                                        distributorName.includes(searchTerm) ||
                                        phone.includes(searchTerm)
                                    );
                                });

                                // Show/hide clear button
                                clearSearch.style.display = searchInput.value ? 'block' : 'none';

                                // Handle no results
                                const noResultsRow = tbody.querySelector('tr td[colspan="8"]');
                                if (noResultsRow) {
                                    noResultsRow.parentElement.style.display = filteredRows.length === 0 ? '' : 'none';
                                }

                                currentPage = 1;
                                displayPage(currentPage);
                                generatePagination();
                            }

                            // Clear search input
                            clearSearch.addEventListener('click', function() {
                                searchInput.value = '';
                                clearSearch.style.display = 'none';
                                filterRows();
                            });

                            // Search event listener
                            searchInput.addEventListener('input', filterRows);

                            // Initial setup
                            if (rows.length > 0) {
                                displayPage(currentPage);
                                generatePagination();
                            }
                        });
                    </script>

                    <!-- 💰 Add Amount Modal -->
                    <div class="modal fade" id="addAmountModal" tabindex="-1" aria-labelledby="addAmountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?= base_url('Superadmindashboard/add_amount'); ?>" method="post">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="addAmountModalLabel"><i class="fas fa-plus-circle me-2"></i>Add Amount</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Distributor Dropdown -->
                                        <div class="mb-3">
                                            <label for="client_name" class="form-label">Distributor Name</label>
                                            <select name="client_name" id="client_name" class="form-control" required>
                                                <option value="">-- Select Distributor --</option>
                                                <?php if (!empty($distributors)): ?>
                                                    <?php foreach ($distributors as $dist): ?>
                                                        <option 
                                                            value="<?= htmlspecialchars($dist->full_name); ?>"
                                                            data-email="<?= htmlspecialchars($dist->email); ?>"
                                                            data-phone="<?= htmlspecialchars($dist->phone); ?>"
                                                        >
                                                            <?= htmlspecialchars($dist->full_name); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="">No distributors found</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- Read-only email -->
                                        <div class="mb-3">
                                            <label for="client_email" class="form-label">Distributor Email</label>
                                            <input type="email" name="client_email" id="client_email" class="form-control" readonly required>
                                        </div>

                                        <!-- Read-only phone -->
                                        <div class="mb-3">
                                            <label for="client_phone" class="form-label">Distributor Phone</label>
                                            <input type="text" name="client_phone" id="client_phone" class="form-control" readonly required>
                                        </div>

                                        <!-- Mode of Payment -->
                                        <div class="mb-3">
                                            <label for="mode_of_payment" class="form-label">Mode of Payment</label>
                                            <select name="mode_of_payment" id="mode_of_payment" class="form-control" required>
                                                <option value="">-- Select Mode of Payment --</option>
                                                <option value="neft">NEFT</option>
                                                <option value="upi">UPI</option>
                                                <option value="cash">Cash</option>
                                            </select>
                                        </div>

                                        <!-- NEFT Fields -->
                                        <div id="neftFields" class="mb-3" style="display: none;">
                                            <label for="ifsc_code" class="form-label">IFSC Code</label>
                                            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control mb-2">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control">
                                        </div>

                                        <!-- UPI Fields -->
                                        <div id="upiFields" class="mb-3" style="display: none;">
                                            <label for="transaction_id" class="form-label">Transaction ID</label>
                                            <input type="text" name="transaction_id" id="transaction_id" class="form-control">
                                        </div>

                                        <!-- Cash Fields -->
                                        <div id="cashFields" class="mb-3" style="display: none;">
                                            <label for="receipt_number" class="form-label">Receipt Number</label>
                                            <input type="text" name="receipt_number" id="receipt_number" class="form-control">
                                        </div>

                                        <!-- Amount -->
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Enter Amount (₹)</label>
                                            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Credit Amount</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- JS to Show/Hide Payment Fields -->
                    <script>
                        document.getElementById('mode_of_payment').addEventListener('change', function () {
                            const selected = this.value;

                            // Hide all first
                            document.getElementById('neftFields').style.display = 'none';
                            document.getElementById('upiFields').style.display = 'none';
                            document.getElementById('cashFields').style.display = 'none';

                            // Clear all input values when hiding
                            document.querySelectorAll('#neftFields input, #upiFields input, #cashFields input').forEach(input => {
                            input.value = '';
                            });

                            // Show fields based on selection
                            if (selected === 'neft') {
                            document.getElementById('neftFields').style.display = 'block';
                            } else if (selected === 'upi') {
                            document.getElementById('upiFields').style.display = 'block';
                            } else if (selected === 'cash') {
                            document.getElementById('cashFields').style.display = 'block';
                            }
                        });
                    </script>
                        
                    <!-- JS to Auto-fill Email and Phone -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const distributorSelect = document.getElementById('client_name');
                            const emailField = document.getElementById('client_email');
                            const phoneField = document.getElementById('client_phone');

                            distributorSelect.addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];
                                const email = selectedOption.getAttribute('data-email');
                                const phone = selectedOption.getAttribute('data-phone');

                                emailField.value = email || '';
                                phoneField.value = phone || '';
                            });
                        });
                    </script>

                <?php elseif($method == 'prices_details') : ?>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary">
                                <a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration:none;color:white;">
                                    <i class="fas fa-arrow-left me-2"></i>Back To Dashboard
                                </a>
                            </button>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center mb-3 search-filter-section">
                            <h2 class="mb-0"><i class="fas fa-tags me-2"></i>Message Prices Details</h2>
                        </div>

                        <!-- Date Filter -->
                        <div class="col-12 mb-3 search-filter-section">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="startDate" class="form-label">From Date:</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="endDate" class="form-label">To Date:</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                                <div class="col-md-4 mt-5">
                                    <button id="filterBtn" class="btn btn-primary btn-mobile"><i class="fas fa-filter me-2"></i>Apply Filter</button>
                                    <button id="resetBtn" class="btn btn-secondary ms-2">Reset</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">                                    
                                     <!-- Price per Message Display -->
                                    <div class="mb-3 d-flex align-items-center">
                                        <h6 class="me-2">
                                            Price per Message: 
                                            <span class="text-primary">
                                                ₹<?= number_format($superadmin_data->price_per_message, 3); ?>
                                            </span>
                                        </h6>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updatePriceModal">
                                            Edit
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-mobile" id="pricesTable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date</th>
                                                    <th>Total Messages</th>
                                                    <th>Debited Amount (₹)</th>
                                                    <th>Available Balance (₹)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pricesBody">
                                                <?php if (!empty($prices_details)): ?>
                                                    <?php $serial = 1; ?>
                                                    <?php foreach ($prices_details as $row): ?>
                                                        <?php
                                                            $balanceColor = $row->available_balance >= 0 ? 'text-success fw-bold' : 'text-danger fw-bold';
                                                            $creditDisplay = $row->credited_amount > 0 
                                                                ? '<span class="text-success fw-bold">+' . number_format($row->credited_amount, 2) . '</span><br><small>(' . $row->credited_note . ')</small>'
                                                                : '-';
                                                            $debitDisplay = $row->total_cost > 0
                                                                ? '<span class="text-danger fw-bold">-' . number_format($row->total_cost, 2) . '</span>'
                                                                : '-';
                                                        ?>
                                                        <tr>
                                                            <td><?= $serial++; ?></td>
                                                            <td><?= date("d-m-Y", strtotime($row->date)); ?></td>
                                                            <td><?= number_format($row->total_messages); ?></td>
                                                            <td><?= $debitDisplay; ?></td>
                                                            <td class="<?= $balanceColor; ?>"><?= number_format($row->available_balance, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center text-danger py-4">
                                                            <i class="fas fa-info-circle me-2"></i>No messages sent yet.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="mt-3 d-flex justify-content-center">
                                        <nav>
                                            <ul class="pagination" id="pagination"></ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Update Price Modal -->
                    <div class="modal fade" id="updatePriceModal" tabindex="-1" aria-labelledby="updatePriceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?= base_url('superadmindashboard/update_price_per_message'); ?>" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updatePriceModalLabel">Update Price per Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="price_per_message" class="form-label">Price (₹)</label>
                                            <input type="number" step="0.001" min="0" name="price_per_message" id="price_per_message" class="form-control" value="<?= $superadmin_data->price_per_message; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Price</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- ✅ JS for Date Filter + Pagination -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const rows = Array.from(document.querySelectorAll('#pricesBody tr'));
                            const rowsPerPage = 5;
                            let currentPage = 1;

                            const pagination = document.getElementById('pagination');
                            const startDateInput = document.getElementById('startDate');
                            const endDateInput = document.getElementById('endDate');
                            const filterBtn = document.getElementById('filterBtn');
                            const resetBtn = document.getElementById('resetBtn');

                            // ✅ Display Rows
                            function displayRows(page, filteredRows = rows) {
                                const start = (page - 1) * rowsPerPage;
                                const end = start + rowsPerPage;
                                rows.forEach(r => r.style.display = 'none');
                                filteredRows.slice(start, end).forEach(r => r.style.display = '');
                                renderPagination(filteredRows.length, page, filteredRows);
                            }

                            // ✅ Pagination UI
                            function renderPagination(totalRows, current, filteredRows) {
                                const pageCount = Math.ceil(totalRows / rowsPerPage);
                                pagination.innerHTML = '';

                                if (pageCount <= 1) return;

                                // Previous Button
                                const prevLi = document.createElement('li');
                                prevLi.className = 'page-item' + (current === 1 ? ' disabled' : '');
                                prevLi.innerHTML = `<a class="page-link" href="#">Prev</a>`;
                                prevLi.addEventListener('click', e => {
                                    e.preventDefault();
                                    if (current > 1) {
                                        currentPage--;
                                        displayRows(currentPage, filteredRows);
                                    }
                                });
                                pagination.appendChild(prevLi);

                                // Page Numbers
                                for (let i = 1; i <= pageCount; i++) {
                                    const li = document.createElement('li');
                                    li.className = 'page-item' + (i === current ? ' active' : '');
                                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                                    li.addEventListener('click', e => {
                                        e.preventDefault();
                                        currentPage = i;
                                        displayRows(currentPage, filteredRows);
                                    });
                                    pagination.appendChild(li);
                                }

                                // Next Button
                                const nextLi = document.createElement('li');
                                nextLi.className = 'page-item' + (current === pageCount ? ' disabled' : '');
                                nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
                                nextLi.addEventListener('click', e => {
                                    e.preventDefault();
                                    if (current < pageCount) {
                                        currentPage++;
                                        displayRows(currentPage, filteredRows);
                                    }
                                });
                                pagination.appendChild(nextLi);
                            }

                            // ✅ Date Filter Logic
                            function getFilteredRows() {
                                const startDate = startDateInput.value ? new Date(startDateInput.value) : null;
                                const endDate = endDateInput.value ? new Date(endDateInput.value) : null;

                                // Swap if start > end
                                if (startDate && endDate && startDate > endDate) {
                                    const temp = startDateInput.value;
                                    startDateInput.value = endDateInput.value;
                                    endDateInput.value = temp;
                                    return getFilteredRows(); // re-run after swap
                                }

                                return rows.filter(row => {
                                    const rowDateStr = row.children[1].textContent.trim();
                                    const rowDate = new Date(rowDateStr);

                                    // inclusive range check
                                    if (startDate && rowDate < startDate) return false;
                                    if (endDate && rowDate > endDate) return false;
                                    return true;
                                });
                            }

                            // ✅ Event Listeners
                            filterBtn.addEventListener('click', () => {
                                const filtered = getFilteredRows();
                                currentPage = 1;
                                displayRows(currentPage, filtered);

                                // If no records found
                                if (filtered.length === 0) {
                                    const tbody = document.getElementById('pricesBody');
                                    tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-3">No records found for selected date range.</td></tr>`;
                                    pagination.innerHTML = '';
                                }
                            });

                            resetBtn.addEventListener('click', () => {
                                startDateInput.value = '';
                                endDateInput.value = '';
                                currentPage = 1;
                                displayRows(currentPage);
                            });

                            // ✅ Initial Display
                            displayRows(currentPage);
                        });
                    </script>
                <?php elseif($method == 'create_admin') : ?>
                    <!-- <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('Superadmindashboard/dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-plus"></i> Create Admin</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div> -->
                    <div class="row fade-in">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('super-admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <div class="text-center mb-4">
                                    <h2><i class="fas fa-user-plus text-dark"></i> New Admin Account</h2>
                                    <p class="text-muted">Create a new administrator account</p>
                                </div>
                                <?php echo form_open('super-admin-create-admin'); ?>
                                    <div class="mb-3 ">
                                        <label for="full_name" class="form-label"><i class="fas fa-user me-1 text-gray-500"></i> Full Name</label>
                                        <input type="text" class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" 
                                            id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" required>
                                        <?php echo form_error('full_name', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    <div class="mb-3 ">
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
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye" id="toggleIcon"></i>
                                            </button>
                                            <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                        <div class="form-text text-muted small">Password must be at least 8 characters long</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="distributor_limit" class="form-label"><i class="fas fa-users-cog me-1 text-gray-500"></i> Distributor Limit</label>
                                        <input type="number" class="form-control <?php echo form_error('distributor_limit') ? 'is-invalid' : ''; ?>" 
                                            id="distributor_limit" name="distributor_limit" value="<?php echo set_value('distributor_limit', 5); ?>" min="1" required>
                                        <?php echo form_error('distributor_limit', '<div class="invalid-feedback">', '</div>'); ?>
                                        <div class="form-text text-muted small">Maximum number of distributors this admin can create</div>
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary py-2 btn-mobile">
                                            <i class="fas fa-user-plus me-2"></i> Create Admin Account
                                        </button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Distributor Limit Reached Modal -->
                    <div class="modal fade" id="limitModal" tabindex="-1" aria-labelledby="limitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="limitModalLabel">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Distributor Limit Reached
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You have reached your maximum limit of <?php echo isset($distributor_limit) ? $distributor_limit : ''; ?> distributors.</p>
                                    <p>Please contact your super administrator to request an increase in your distributor limit.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="<?php echo base_url('Admindashboard/contact_superadmin'); ?>" class="btn btn-warning">
                                        <i class="fas fa-paper-plane me-2"></i> Contact Super Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('sidebarToggle');
            const mobileOverlay = document.getElementById('mobileOverlay');

            // Initialize sidebar state
            if (localStorage.getItem('sidebarExpanded') === 'true') {
                sidebar.classList.add('expanded');
                mainContent.classList.add('expanded');
                if (window.innerWidth <= 768) {
                    mobileOverlay.classList.add('active');
                }
            }

            // Toggle sidebar
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                mainContent.classList.toggle('expanded');
                localStorage.setItem('sidebarExpanded', sidebar.classList.contains('expanded'));
                
                // Show/hide mobile overlay
                if (window.innerWidth <= 768) {
                    if (sidebar.classList.contains('expanded')) {
                        mobileOverlay.classList.add('active');
                    } else {
                        mobileOverlay.classList.remove('active');
                    }
                }
            });

            // Close sidebar on overlay click
            mobileOverlay.addEventListener('click', function() {
                sidebar.classList.remove('expanded');
                mainContent.classList.remove('expanded');
                mobileOverlay.classList.remove('active');
                localStorage.setItem('sidebarExpanded', false);
            });

            // Handle responsive behavior
            function handleResponsive() {
                const isMobile = window.innerWidth <= 768;
                if (isMobile && sidebar.classList.contains('expanded')) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    mobileOverlay.classList.remove('active');
                    localStorage.setItem('sidebarExpanded', false);
                }
            }

            // Initial responsive check
            handleResponsive();

            // Add resize listener
            window.addEventListener('resize', handleResponsive);

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    mobileOverlay.classList.remove('active');
                    localStorage.setItem('sidebarExpanded', false);
                }
            });

            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const password = document.getElementById('password');
                    const icon = document.getElementById('toggleIcon');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }

            // Populate update distributor limit modal
            document.querySelectorAll('.update-distributor-limit-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.getElementById('modal_distributor_id').value = this.getAttribute('data-id');
                    document.getElementById('modal_full_name').value = this.getAttribute('data-name');
                    document.getElementById('modal_email').value = this.getAttribute('data-email');
                    document.getElementById('modal_role').value = this.getAttribute('data-role');
                    document.getElementById('modal_distributor_limit').value = this.getAttribute('data-limit');
                });
            });

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
                    background: 'white',
                    iconColor: 'var(--success-color)',
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
                    background: 'white',
                    iconColor: 'var(--danger-color)',
                });
            <?php endif; ?>

            // Show limit reached modal
            <?php if (isset($show_limit_modal) && $show_limit_modal): ?>
                var myModal = new bootstrap.Modal(document.getElementById('limitModal'));
                myModal.show();
            <?php endif; ?>
        });
    </script>
</body>
</html>