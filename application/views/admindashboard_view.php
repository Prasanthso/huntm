<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSA Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --sidebar-bg: #0A517F;
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
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: var(--content-bg);
            color: #333;
            min-height: 100vh;
            margin: 0;;
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
            color: #0A517F;
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
            width: var(--sidebar-collapsed-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: #2c3e50;
            color: var(--sidebar-color);
            transition: var(--transition);
            z-index: 1020;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            overflow-x: hidden;
        }

        .app-sidebar.expanded {
            width: var(--sidebar-width);
        }

        .sidebar-header h4,
        .nav-link span,
        .logout-btn span {
            display: none;
        }

        .app-sidebar.expanded .sidebar-header h4,
        .app-sidebar.expanded .nav-link span,
        .app-sidebar.expanded .logout-btn span {
            display: inline;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .app-sidebar.expanded .sidebar-header {
            padding: 1.5rem;
            background: #0A517F;
        }

        .sidebar-header h4 {
            margin-bottom: 0;
            color: white;
            font-weight: 500;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
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
            padding: 0.8rem;
            font-weight: 400;
            transition: var(--transition);
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .app-sidebar.expanded .nav-link {
            justify-content: flex-start;
            padding: 0.8rem 1.5rem;
        }

        .nav-link i {
            margin-right: 0;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .app-sidebar.expanded .nav-link i {
            margin-right: 12px;
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

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-color);
            text-decoration: none;
            padding: 0.7rem;
            border-radius: 4px;
            transition: var(--transition);
            font-weight: 400;
            font-size: 0.95rem;
        }

        .app-sidebar.expanded .logout-btn {
            justify-content: flex-start;
            padding: 0.7rem 1.5rem;
        }

        .logout-btn i {
            margin-right: 0;
            font-size: 1rem;
        }

        .app-sidebar.expanded .logout-btn i {
            margin-right: 10px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* Main Content Styles */
        .app-main {
            margin-left: var(--sidebar-collapsed-width);
            margin-top: var(--header-height);
            padding: 2.5rem;
            transition: var(--transition);
            min-height: calc(100vh - var(--header-height));
            background-color: var(--content-bg);
        }

        .app-main.expanded {
            margin-left: var(--sidebar-width);
        }

        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 20px;
            border: none;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
            height: 100%;
            border-left: 4px solid #0A517F;
            border-right: 4px solid #0A517F;
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
            color: #0A517F;
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
            color: #6c757d;
            font-size: 0.9rem;
            min-width: 20px;
        }

        .dashboard-card .detail-item span {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .badge-custom {
            background-color: #0A517F;
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
            border-radius: 8px;
            font-size: 0.85rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .quick-actions .btn i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        /* Form Styling */
        .form-container {
            background: white;
            padding: 2.5rem;
            border-radius: 6px;
            box-shadow: var(--card-shadow);
            border-top: 3px solid #0A517F;
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
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #0A517F;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-primary {
            border-color: var(--sidebar-bg);
            color: var(--sidebar-bg);
        }

        .btn-outline-primary:hover {
            background-color: var(--sidebar-bg);
            color: white;
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
            border-left-color: #28a745;
        }

        .alert-danger {
            border-left-color: #dc3545;
        }

        /* Table Styling */
        /* .table {
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
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.03);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
            font-size: 0.95rem;
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
            background-color: 	#cfecf7;

        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .app-sidebar {
                width: 0;
                overflow: hidden;
            }

            .app-sidebar.expanded {
                width: var(--sidebar-width);
                box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            }

            .app-main {
                margin-left: 0;
            }

            .app-main.expanded {
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

        @media (min-width: 993px) {
            .app-sidebar {
                width: var(--sidebar-collapsed-width);
            }

            .app-sidebar.expanded {
                width: var(--sidebar-width);
            }

            .app-main {
                margin-left: var(--sidebar-collapsed-width);
            }

            .app-main.expanded {
                margin-left: var(--sidebar-width);
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
            background: var(--primary-dark);
        } */
        .header-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-gray);
            margin: 0;
            font-size: 1.5rem;
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

            .form-group-custom {
                position: relative;
                margin-bottom: 1.5rem;
            }

            .form-group-custom label {
                position: absolute;
                top: -12px; 
                left: 12px;
                background: #fff;
                padding: 0 6px;
                font-size: 14px;
                color: #0A517F;
                font-weight: 600;
                pointer-events: none;
            }

            .form-group-custom input,
            .form-group-custom select,
            .form-group-custom textarea {
                width: 100%;
                padding: 14px 15px 8px;
                border: 2px solid #0A517F;
                border-radius: 12px;
                font-size: 16px;
                color: rgba(10, 81, 127, 0.8);
                outline: none;
                background-color: #fff;
                resize: none;
            }

            .form-group-custom input::placeholder,
            .form-group-custom textarea::placeholder,
            .form-group-custom select:invalid {
                color: rgba(10, 81, 127, 0.6);
                font-size: 13px;
            }

            .form-group-custom input[readonly] {
                /* background-color: #edf5ff; */
                /* font-weight: bold; */
                color: #0A517F;
            }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <div class="d-flex align-items-center">
            <button class="toggle-btn text-dark " type="button" id="sidebarToggle">
                <i class="fas fa-bars me-2"></i>  
            </button>
            <h1 class="header-title">LSA Admin Portal</h1>
        </div>
        <!-- <a href="<?php echo base_url('admin-dashboard'); ?>" class="header-brand">
            <img src="<?php echo base_url(); ?>Image/Huntm-logo.svg" alt="Huntm Logo">
            <span>LSA Admin</span>
        </a> -->
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span class="user-name d-none d-md-inline"><?php echo htmlspecialchars($admin_name->full_name ?? 'Admin'); ?></span>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header" style="background-color: #2c3e50;">
            <h4>Menu</h4>
        </div>
        <div class="sidebar-menu" style="background-color: #2c3e50;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?php echo base_url('admin-dashboard'); ?>" 
                       class="nav-link <?php echo ($method == 'admindashboard') ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('admin-profile'); ?>" 
                       class="nav-link <?php echo ($method == 'profile')? 'active' : ''; ?>">
                        <i class="fas fa-user-cog"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('create-distributor'); ?>" 
                       class="nav-link <?php echo ($method == 'create_distributor') ? 'active' : ''; ?>">
                        <i class="fas fa-user-plus"></i>
                        <span>Create Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('get-distributor-data'); ?>" 
                       class="nav-link <?php echo ($method == 'get_distributor_data') ? 'active' : ''; ?>">
                        <i class="fas fa-users-cog"></i>
                        <span>Manage Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('assign-same-pages-to-all-staff'); ?>" 
                       class="nav-link <?php echo ($method == 'assign_same_pages_to_all_staff') ? 'active' : ''; ?>">
                        <i class="fas fa-tasks"></i>
                        <span>Manage Pages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('get-staff-limits'); ?>" 
                       class="nav-link <?php echo ($method == 'get_staff_limits') ? 'active' : ''; ?>">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span>Update Staff Limits</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <a class="logout-btn" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

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
                    <a href="<?= base_url('admin-logout'); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="app-main" id="main-content">
        <div class="container-fluid animate-fade-in">
            <!-- Breadcrumb Navigation -->
            <!-- <nav aria-label="breadcrumb" class="mb-4">
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
                    <?php elseif ($method == "get_staff_limits") : ?>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Distributor Limits</li>
                    <?php endif; ?>
                </ol>
            </nav> -->

            <!-- Page Title -->
            <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="page-title mb-0">
                    <?php if ($method == "admindashboard") : ?>
                        <i class="fas fa-tachometer-alt text-dark me-2"></i>Dashboard Overview
                    <?php elseif ($method == "profile") : ?>
                        <i class="fas fa-user-cog text-dark me-2"></i>Profile Management
                    <?php elseif ($method == "create_distributor") : ?>
                        <i class="fas fa-user-plus text-dark me-2"></i>Create New Distributor
                    <?php elseif ($method == "assign_same_pages_to_all_staff") : ?>
                        <i class="fas fa-tasks text-dark me-2"></i>Page Management
                    <?php endif; ?>
                </h2>
            </div> -->

            <!-- Dashboard Content -->
            <?php if ($method == "admindashboard") : ?>
                <div class="row fade-in">
                    <?php if (!empty($admin_data)) : ?>
                        <!-- Admin Profile -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header">
                                    <i class="fas fa-user-shield me-2"></i>
                                    <span class="card-title">Admin Profile</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($admin_data->full_name ?? 'N/A'); ?></h5>
                                    <div class="detail-item">
                                        <i class="fas fa-envelope"></i>
                                        <span><?php echo htmlspecialchars($admin_data->email ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-phone"></i>
                                        <span><?php echo htmlspecialchars($admin_data->phone ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?php echo htmlspecialchars($admin_data->city ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="mt-3">
                                        <span class="badge-custom"><?php echo htmlspecialchars($admin_data->role ?? 'N/A'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header">
                                    <i class="fas fa-building"></i>
                                    <span>Bank Details</span>
                                </div>
                                <div class="card-body">
                                    <div class="detail-item">
                                        <i class="fas fa-barcode"></i>
                                        <span>SAP Code: <?php echo htmlspecialchars($admin_data->sap_code ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-university"></i>
                                        <span>Bank: <?php echo htmlspecialchars($admin_data->bank_name ?? 'N/A'); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Account: ••••<?php echo !empty($admin_data->account_number) ? substr($admin_data->account_number, -4) : 'N/A'; ?></span>
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
                                    <a href="<?php echo base_url('Admindashboard/profile'); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-user-edit"></i> Update Profile
                                    </a>
                                    <a href="<?php echo base_url('Admindashboard/create_distributor'); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-user-plus"></i> Add Distributor
                                    </a>
                                    <a href="<?php echo base_url('get-template'); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-file-invoice"></i> Create New Template
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
                <section>
                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                    </div>
                    <div class="col-lg-8 w-100">
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-user-cog me-2 text-dark"></i>Profile Management</h2>
                        </div>
                        <div class="form-container">
                            <form id="profileForm" method="post" action="<?php echo base_url('submit-data'); ?>">

                                <!-- Basic Information -->
                                <h5 class="mb-4"><i class="fas fa-user me-2 text-dark"></i>Basic Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" id="full_name" name="full_name" 
                                                value="<?php echo htmlspecialchars($admin_data->full_name ?? ''); ?>" 
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="email">Email Id <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" 
                                                value="<?php echo htmlspecialchars($admin_data->email ?? ''); ?>" 
                                                class="form-control" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" 
                                                value="<?php echo htmlspecialchars($admin_data->phone ?? ''); ?>" 
                                                class="form-control" oninput="validatePhone(this)" />
                                            <div class="error-message text-danger small mt-1" id="phone_error"><?php echo form_error('phone'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="sap_code">SAP Code <span class="text-danger">*</span></label>
                                            <input type="text" id="sap_code" name="sap_code" 
                                                value="<?php echo htmlspecialchars($admin_data->sap_code ?? ''); ?>" 
                                                class="form-control" oninput="validateSapCode(this)" />
                                            <div class="error-message text-danger small mt-1" id="sap_code_error"><?php echo form_error('sap_code'); ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details -->
                                <hr class="section-divider" style="border: 1px solid #0A517F;">
                                <h5 class="mb-4"><i class="fas fa-university me-2 text-dark"></i>Bank Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="account_holder_name">Account Holder Name <span class="text-danger">*</span></label>
                                            <input type="text" id="account_holder_name" name="account_holder_name" 
                                                value="<?php echo htmlspecialchars($admin_data->account_holder_name ?? ''); ?>" 
                                                class="form-control" oninput="validateAccountHolderName(this)" />
                                            <div class="error-message text-danger small mt-1" id="account_holder_name_error"><?php echo form_error('account_holder_name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                            <input type="text" id="account_number" name="account_number" 
                                                value="<?php echo htmlspecialchars($admin_data->account_number ?? ''); ?>" 
                                                class="form-control" oninput="validateAccountNumber(this)" />
                                            <div class="error-message text-danger small mt-1" id="account_number_error"><?php echo form_error('account_number'); ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="ifsc_code">IFSC Code <span class="text-danger">*</span></label>
                                            <input type="text" id="ifsc_code" name="ifsc_code" 
                                                value="<?php echo htmlspecialchars($admin_data->ifsc_code ?? ''); ?>" 
                                                class="form-control" oninput="validateIfscCode(this)" />
                                            <div class="error-message text-danger small mt-1" id="ifsc_code_error"><?php echo form_error('ifsc_code'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                            <input type="text" id="bank_name" name="bank_name" 
                                                value="<?php echo htmlspecialchars($admin_data->bank_name ?? ''); ?>" 
                                                class="form-control" oninput="validateBankName(this)" />
                                            <div class="error-message text-danger small mt-1" id="bank_name_error"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Details -->
                                <hr class="section-divider" style="border: 1px solid #0A517F;">
                                <h5 class="mb-4"><i class="fas fa-map-marker-alt me-2 text-dark"></i>Address Details</h5>
                                <div class="form-group-custom">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea id="address" name="address" rows="3" 
                                        class="form-control" oninput="validateAddress(this)"><?php echo htmlspecialchars($admin_data->address ?? ''); ?></textarea>
                                    <div class="error-message text-danger small mt-1" id="address_error"><?php echo form_error('address'); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group-custom">
                                            <label for="pin_code">Pin Code <span class="text-danger">*</span></label>
                                            <input type="text" id="pin_code" name="pin_code" 
                                                value="<?php echo htmlspecialchars($admin_data->pin_code ?? ''); ?>" 
                                                class="form-control" oninput="validatePinCode(this)" />
                                            <div class="error-message text-danger small mt-1" id="pin_code_error"><?php echo form_error('pin_code'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-custom">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <input type="text" id="city" name="city" 
                                                value="<?php echo htmlspecialchars($admin_data->city ?? ''); ?>" 
                                                class="form-control" oninput="validateCity(this)" />
                                            <div class="error-message text-danger small mt-1" id="city_error"><?php echo form_error('city'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-custom">
                                            <label for="office_mobile">Office Mobile <span class="text-danger">*</span></label>
                                            <input type="text" id="office_mobile" name="office_mobile" 
                                                value="<?php echo htmlspecialchars($admin_data->office_mobile ?? ''); ?>" 
                                                class="form-control" oninput="validateOfficeMobile(this)" />
                                            <div class="error-message text-danger small mt-1" id="office_mobile_error"><?php echo form_error('office_mobile'); ?></div>
                                        </div>
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
                </section>

                <script>
                    // Validation functions for each field
                    function validatePhone(input) {
                        const errorElement = document.getElementById('phone_error');
                        const phonePattern = /^[0-9]{10}$/;
                        
                        if (!phonePattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid 10-digit phone number';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateSapCode(input) {
                        const errorElement = document.getElementById('sap_code_error');
                        
                        if (input.value.trim() === '') {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'SAP Code is required';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateAccountHolderName(input) {
                        const errorElement = document.getElementById('account_holder_name_error');
                        const namePattern = /^[a-zA-Z\s]+$/;
                        
                        if (!namePattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid account holder name (letters and spaces only)';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateAccountNumber(input) {
                        const errorElement = document.getElementById('account_number_error');
                        const accountPattern = /^[0-9]{9,18}$/;
                        
                        if (!accountPattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid account number (9-18 digits)';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateIfscCode(input) {
                        const errorElement = document.getElementById('ifsc_code_error');
                        const ifscPattern = /^[A-Z]{4}0[A-Z0-9]{6}$/;
                        
                        if (!ifscPattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid IFSC code (e.g., ABCD0123456)';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateBankName(input) {
                        const errorElement = document.getElementById('bank_name_error');
                        
                        if (input.value.trim() === '') {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Bank name is required';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateAddress(input) {
                        const errorElement = document.getElementById('address_error');
                        
                        if (input.value.trim() === '') {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Address is required';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validatePinCode(input) {
                        const errorElement = document.getElementById('pin_code_error');
                        const pincodePattern = /^[1-9][0-9]{5}$/;
                        
                        if (!pincodePattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid 6-digit pin code';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateCity(input) {
                        const errorElement = document.getElementById('city_error');
                        
                        if (input.value.trim() === '') {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'City is required';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    function validateOfficeMobile(input) {
                        const errorElement = document.getElementById('office_mobile_error');
                        const phonePattern = /^[0-9]{10}$/;
                        
                        if (!phonePattern.test(input.value)) {
                            input.classList.add('is-invalid');
                            errorElement.textContent = 'Please enter a valid 10-digit office mobile number';
                        } else {
                            input.classList.remove('is-invalid');
                            errorElement.textContent = '';
                        }
                    }

                    // Form submission validation
                    document.getElementById('profileForm').addEventListener('submit', function(e) {
                        let isValid = true;
                        
                        // Validate all fields before submission
                        const phone = document.getElementById('phone');
                        if (!/^[0-9]{10}$/.test(phone.value)) {
                            phone.classList.add('is-invalid');
                            document.getElementById('phone_error').textContent = 'Please enter a valid 10-digit phone number';
                            isValid = false;
                        }
                        
                        const sapCode = document.getElementById('sap_code');
                        if (sapCode.value.trim() === '') {
                            sapCode.classList.add('is-invalid');
                            document.getElementById('sap_code_error').textContent = 'SAP Code is required';
                            isValid = false;
                        }
                        
                        // Add validation for all other fields
                        
                        if (!isValid) {
                            e.preventDefault();
                            // Scroll to the first error
                            const firstError = document.querySelector('.is-invalid');
                            if (firstError) {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                    });

                    // Initialize validation on page load for any existing values
                    document.addEventListener('DOMContentLoaded', function() {
                        validatePhone(document.getElementById('phone'));
                        validateSapCode(document.getElementById('sap_code'));
                        validateAccountHolderName(document.getElementById('account_holder_name'));
                        validateAccountNumber(document.getElementById('account_number'));
                        validateIfscCode(document.getElementById('ifsc_code'));
                        validateBankName(document.getElementById('bank_name'));
                        validateAddress(document.getElementById('address'));
                        validatePinCode(document.getElementById('pin_code'));
                        validateCity(document.getElementById('city'));
                        validateOfficeMobile(document.getElementById('office_mobile'));
                    });
                </script>

                <style>
                    .is-invalid {
                        border-color: #dc3545 !important;
                    }

                    .error-message {
                        display: block;
                        min-height: 20px;
                        font-size: 0.875rem;
                    }
                </style>

            <?php elseif ($method == "create_distributor") : ?>
                <section class="fade-in">
                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                    </div>
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container">
                            <h2><i class="fas fa-user-plus me-2 text-dark"></i> New Distributor Account</h2>
                            <p class="text-muted">Create a new distributor member account</p>

                            <!-- Distributor Limit Indicator -->
                            <?php if (isset($distributor_limit) && isset($current_distributor_count)): ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    You have created <?php echo $current_distributor_count; ?> out of <?php echo $distributor_limit; ?> allowed distributor accounts.
                                </div>
                            <?php endif; ?>

                            <?php echo form_open('create-distributor'); ?>

                                <section class="form-section" style="padding-top: 10px;">
                                    <div class="form-group-custom">
                                        <label for="full_name"><i class="fas fa-user me-1 text-muted"></i> Full Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>"
                                            id="full_name"
                                            name="full_name"
                                            value="<?php echo set_value('full_name'); ?>"
                                            required>
                                        <?php echo form_error('full_name', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                </section>

                                <section class="form-section">
                                    <div class="form-group-custom">
                                        <label for="email"><i class="fas fa-envelope me-1 text-muted"></i> Email <span class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>"
                                            id="email"
                                            name="email"
                                            value="<?php echo set_value('email'); ?>"
                                            required>
                                        <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                </section>

                                <section class="form-section" style="background-color: none;">
                                    <div class="form-group-custom position-relative">
                                        <label for="password" class="floating-label">
                                            <i class="fas fa-lock me-1 text-muted"></i> Password <span class="text-danger">*</span>
                                        </label>
                                        
                                        <div class="input-group custom-input-group">
                                            <input type="password"
                                                class="form-control border-0 <?php echo form_error('password') ? 'is-invalid' : ''; ?>"
                                                id="password"
                                                name="password"
                                                required>
                                            <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>

                                        <?php echo form_error('password', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        <small class="text-muted">Password must be at least 8 characters long</small>
                                    </div>

                                </section>

                                <section class="form-section">
                                    <div class="form-group-custom">
                                        <label for="staff_limit"><i class="fas fa-users me-1 text-muted"></i> Staff Limit <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control <?php echo form_error('staff_limit') ? 'is-invalid' : ''; ?>"
                                            id="staff_limit"
                                            name="staff_limit"
                                            value="<?php echo set_value('staff_limit', 5); ?>"
                                            min="1"
                                            required>
                                        <?php echo form_error('staff_limit', '<div class="invalid-feedback">', '</div>'); ?>
                                        <small class="text-muted">Maximum number of staff this distributor can create</small>
                                    </div>
                                </section>

                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary" style="background-color: #0A517F;">
                                        <i class="fas fa-user-plus me-2"></i> Create Distributor
                                    </button>
                                </div>

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </section>
                
                <style>
                    .form-group-custom {
                        position: relative;
                        margin-bottom: 1.5rem;
                    }

                    .floating-label {
                        position: absolute;
                        top: -18px;
                        left: 12px;
                        background: #fff;
                        padding: 0 6px;
                        font-size: 14px;
                        color: #0A517F;
                        font-weight: 500;
                        pointer-events: none;
                        z-index: 2;
                    }

                    .custom-input-group {
                        border: 2px solid #0A517F;
                        border-radius: 12px;
                        overflow: hidden;
                        background-color: #f5faff;
                    }

                    .custom-input-group .form-control {
                        border: none;
                        border-radius: 0;
                        padding: 14px 15px;
                        background-color: #f5faff;
                        font-size: 16px;
                        color: rgba(10, 81, 127, 0.6);
                        outline: none;
                        box-shadow: none;
                    }
                </style>

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

            <?php elseif ($method == "get_distributor_data") : ?>
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-4 fw-bold text-dark">
                            <i class="fas fa-users me-2 text-dark"></i> Distributor Details
                        </h4>

                        <!-- Flash messages -->
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= $this->session->flashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php elseif ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= $this->session->flashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-bordered align-middle text-center mb-0">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $serialNo = 1; ?>
                                            <?php foreach ($distributor_data as $distributor): ?>
                                                <tr>
                                                    <td><?= $serialNo++; ?></td>
                                                    <td><?= htmlspecialchars($distributor->full_name); ?></td>
                                                    <td><?= htmlspecialchars($distributor->email); ?></td>
                                                    <td class="text-capitalize"><?= htmlspecialchars($distributor->role); ?></td>
                                                    <td>
                                                        <a href="<?= base_url('showing-distributor-remaining-data/' . $distributor->id); ?>"
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
                        const deleteUrl = "<?= base_url('delete-distributors/') ?>" + distributorId;
                        confirmBtn.setAttribute('href', deleteUrl);
                    });
                </script>

                
            <?php elseif ($method == "showing_distributor_remaining_data") : ?>
                <div class="col-12 mb-2">
                    <button class="btn btn-primary" ><a href="<?php echo base_url('get-distributor-data'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Distributor List</a></button>
                </div>

                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Distributor Full Details</h2>

                            <form>
                                <?php foreach ($distributor_data as $distributor): ?>

                                    <!-- Full Name & Email -->
                                    <section class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="full_name">Full Name</label>
                                                <input type="text" id="full_name" name="full_name"
                                                    value="<?php echo htmlspecialchars($distributor->full_name ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email"
                                                    value="<?php echo htmlspecialchars($distributor->email ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Phone & SAP Code -->
                                    <section class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="phone">Phone</label>
                                                <input type="text" id="phone" name="phone"
                                                    value="<?php echo htmlspecialchars($distributor->phone ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="sap_code">SAP Code</label>
                                                <input type="text" id="sap_code" name="sap_code"
                                                    value="<?php echo htmlspecialchars($distributor->sap_code ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Bank Details -->
                                    <h5 class="section-header mb-4"><i class="fas fa-university me-2"></i>Bank Details</h5>
                                    <section class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="account_holder_name">Account Holder Name</label>
                                                <input type="text" id="account_holder_name" name="account_holder_name"
                                                    value="<?php echo htmlspecialchars($distributor->account_holder_name ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="account_number">Account Number</label>
                                                <input type="text" id="account_number" name="account_number"
                                                    value="<?php echo htmlspecialchars($distributor->account_number ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="ifsc_code">IFSC Code</label>
                                                <input type="text" id="ifsc_code" name="ifsc_code"
                                                    value="<?php echo htmlspecialchars($distributor->ifsc_code ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" id="bank_name" name="bank_name"
                                                    value="<?php echo htmlspecialchars($distributor->bank_name ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Address -->
                                    <h5 class="section-header mb-4"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h5>
                                    <div class="form-group-custom">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($distributor->address ?? ''); ?></textarea>
                                    </div>

                                    <!-- Pin Code, City, Office Mobile -->
                                    <section class="row">
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label for="pin_code">Pin Code</label>
                                                <input type="text" id="pin_code" name="pin_code"
                                                    value="<?php echo htmlspecialchars($distributor->pin_code ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label for="city">City</label>
                                                <input type="text" id="city" name="city"
                                                    value="<?php echo htmlspecialchars($distributor->city ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label for="office_mobile">Office Mobile</label>
                                                <input type="text" id="office_mobile" name="office_mobile"
                                                    value="<?php echo htmlspecialchars($distributor->office_mobile ?? ''); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </section>

                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php elseif ($method == "get_staff_limits") : ?>
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-4 fw-bold text-dark">
                            <i class="bi bi-arrow-clockwise me-2 text-dark"></i> Update Staff Limit
                        </h4>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-bordered mb-0 align-middle text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Staff Limit</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $serialNo = 1; ?>
                                            <?php foreach ($get_staff_limits as $get_staff_limit): ?>
                                                <tr>
                                                    <td><?= $serialNo++; ?></td>
                                                    <td><?= htmlspecialchars($get_staff_limit->full_name); ?></td>
                                                    <td><?= htmlspecialchars($get_staff_limit->email); ?></td>
                                                    <td class="text-capitalize"><?= htmlspecialchars($get_staff_limit->role); ?></td>
                                                    <td><?= htmlspecialchars($get_staff_limit->staff_limit); ?></td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-primary btn-sm update-staff-limit-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateStaffLimitModal"
                                                            data-id="<?= $get_staff_limit->id; ?>"
                                                            data-name="<?= htmlspecialchars($get_staff_limit->full_name); ?>"
                                                            data-email="<?= htmlspecialchars($get_staff_limit->email); ?>"
                                                            data-role="<?= htmlspecialchars($get_staff_limit->role); ?>"
                                                            data-limit="<?= htmlspecialchars($get_staff_limit->staff_limit); ?>">
                                                            <i class="fas fa-edit me-1"></i> Update Limit
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Staff Limit Modal -->
                <div class="modal fade" id="updateStaffLimitModal" tabindex="-1" aria-labelledby="updateStaffLimitModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateStaffLimitModalLabel">
                                    <i class="fas fa-users-cog me-2 text-dark"></i>Update Staff Limit
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo base_url('update-staff-limits'); ?>">
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
                                        <label for="modal_staff_limit" class="form-label">Staff Limit</label>
                                        <input type="number" class="form-control <?php echo form_error('staff_limit') ? 'is-invalid' : ''; ?>"
                                            id="modal_staff_limit" name="staff_limit" min="1" required>
                                        <?php echo form_error('staff_limit', '<div class="invalid-feedback">', '</div>'); ?>
                                        <small class="text-muted">Maximum number of staff this distributor can create</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php elseif ($method == "get_template_content") : ?>
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-dark mb-0">
                                <i class="bi bi-arrow-clockwise me-2 text-dark"></i> Update Template Content
                            </h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTemplateModal">
                                <i class="bi bi-plus-circle me-1"></i> Add Template
                            </button>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-bordered mb-0 align-middle text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Template Name</th>
                                                <th scope="col">Template Content</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $serialNo = 1; ?>
                                            <?php foreach ($templates as $template): ?>
                                                <tr>
                                                    <td><?= $serialNo++; ?></td>
                                                    <td><?= htmlspecialchars($template->template_name); ?></td>
                                                    <td><?= htmlspecialchars($template->template_content); ?></td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-primary btn-sm edit-template-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editTemplateModal"
                                                            data-id="<?= $template->id; ?>"
                                                            data-name="<?= htmlspecialchars($template->template_name); ?>"
                                                            data-content="<?= htmlspecialchars($template->template_content); ?>">
                                                            <i class="fas fa-edit me-1"></i> Edit Content
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Template Modal -->
                <div class="modal fade" id="addTemplateModal" tabindex="-1" aria-labelledby="addTemplateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTemplateModalLabel">Add New Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addTemplateForm" action="<?= base_url('AdminDashboard/add_template'); ?>" method="post">
                            <div class="mb-3">
                                <label for="new_template_name" class="form-label">Template Name</label>
                                <input type="text" class="form-control" id="new_template_name" name="template_name" required>
                                <small class="text-danger">Note: Template Name that should be match with meta approval template</small>
                            </div>
                            <div class="mb-3">
                                <label for="new_template_content" class="form-label">Template Content</label>
                                <textarea class="form-control" id="new_template_content" name="template_content" rows="4" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Add Template</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Updated Template Content Modal -->
                <div class="modal fade" id="editTemplateModal" tabindex="-1" aria-labelledby="editTemplateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTemplateModalLabel">Edit Template Content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editTemplateForm" action="<?= base_url('AdminDashboard/update_template_content'); ?>" method="post">
                                    <input type="hidden" name="template_id" id="template_id">
                                    <div class="mb-3">
                                        <label for="template_name" class="form-label">Template Name</label>
                                        <input type="text" class="form-control" id="template_name" name="template_name" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="template_content" class="form-label">Template Content</label>
                                        <textarea class="form-control" id="template_content" name="template_content" rows="4" required></textarea>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Update Template</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // JavaScript to populate modal with data
                    document.addEventListener('DOMContentLoaded', function() {
                        const editButtons = document.querySelectorAll('.edit-template-btn');
                        const templateIdInput = document.getElementById('template_id');
                        const templateNameInput = document.getElementById('template_name');
                        const templateContentInput = document.getElementById('template_content');
                        
                        editButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                const name = this.getAttribute('data-name');
                                const content = this.getAttribute('data-content');
                                
                                templateIdInput.value = id;
                                templateNameInput.value = name;
                                templateContentInput.value = content;
                            });
                        });
                    });
                </script>
            <?php elseif ($method == "assign_same_pages_to_all_staff") : ?>
                <div class="col-12 mb-2">
                    <button class="btn btn-primary" ><a href="<?php echo base_url('admin-dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                </div>
                <h4 class="mb-4 fw-bold text-dark">
                            <i class="bi bi-file-earmark-text me-2 text-dark"></i> Page Management
                        </h4>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container">
                            <h3 class="mb-4"><i class="fas fa-file-alt me-2 text-dark"></i>Available Pages</h3>
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
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('sidebarToggle');

            // Initialize sidebar state
            if (localStorage.getItem('sidebarExpanded') === 'true') {
                sidebar.classList.add('expanded');
                mainContent.classList.add('expanded');
            }

            // Toggle sidebar
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                mainContent.classList.toggle('expanded');
                localStorage.setItem('sidebarExpanded', sidebar.classList.contains('expanded'));
            });

            // Handle responsive behavior
            function handleResponsive() {
                const isMobile = window.innerWidth <= 992;
                if (isMobile && sidebar.classList.contains('expanded')) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    localStorage.setItem('sidebarExpanded', false);
                }
            }

            // Initial responsive check
            handleResponsive();

            // Add resize listener
            window.addEventListener('resize', handleResponsive);

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 992 && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    localStorage.setItem('sidebarExpanded', false);
                }
            });

            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const password = document.querySelector('#password');
                    const icon = this.querySelector('i');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            }

            // Populate update staff limit modal
            document.querySelectorAll('.update-staff-limit-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.getElementById('modal_distributor_id').value = this.getAttribute('data-id');
                    document.getElementById('modal_full_name').value = this.getAttribute('data-name');
                    document.getElementById('modal_email').value = this.getAttribute('data-email');
                    document.getElementById('modal_role').value = this.getAttribute('data-role');
                    document.getElementById('modal_staff_limit').value = this.getAttribute('data-limit');
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

            // Show limit reached modal
            <?php if (isset($limit_reached) && $limit_reached): ?>
                var myModal = new bootstrap.Modal(document.getElementById('limitReachedModal'));
                myModal.show();
            <?php endif; ?>

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

            // Form validation
            document.getElementById('profileForm')?.addEventListener('submit', function(event) {
                let isValid = true;
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

                if (!isValid) {
                    event.preventDefault();
                    const firstInvalid = document.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        });
    </script>
</body>
</html>