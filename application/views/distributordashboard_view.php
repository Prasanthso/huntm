<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --sidebar-bg: #0A517F;
            --sidebar-color: #e9ecef;
            --sidebar-active-bg: #495057;
            --content-bg: #f8f9fa;
            --primary-color: #6c757d;
            --secondary-color: #5a6268;
            --accent-color: white;
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
            margin: 0;
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
            padding: 0 20px;
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
            width: var(--sidebar-collapsed-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: #2c3e50;
            color: var(--sidebar-color);
            transition: var(--transition);
            z-index: 999;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            border-right: 1px solid rgba(255,255,255,0.1);
            overflow-x: hidden;
            overflow-y: auto;
        }

        #sidebar.expanded {
            width: var(--sidebar-width);
        }

        #sidebar .sidebar-header h4,
        #sidebar .list-group-item span,
        #sidebar .logout-btn span {
            display: none;
        }

        #sidebar.expanded .sidebar-header h4,
        #sidebar.expanded .list-group-item span,
        #sidebar.expanded .logout-btn span {
            display: inline;
        }

        #sidebar .sidebar-header {
            padding: 20px 10px;
            text-align: center;
        }

        #sidebar.expanded .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 500;
            margin: 0;
            color: white;
            font-size: 1.3rem;
            white-space: nowrap;
        }

        #sidebar .list-group-item {
            text-align: center;
            padding: 12px 10px;
            border-left: none;
            color: var(--sidebar-color);
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            font-weight: 400;
            transition: var(--transition);
            font-size: 0.95rem;
            margin: 2px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #sidebar.expanded .list-group-item {
            text-align: left;
            padding: 12px 25px;
            border-left: 4px solid transparent;
            justify-content: flex-start;
        }

        #sidebar .list-group-item i {
            margin-right: 0;
            font-size: 1.2rem;
            color: var(--accent-color);
        }

        #sidebar.expanded .list-group-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        #sidebar .list-group-item.active {
            background: #b1d3e933;
            color: white;
            border-left-color: var(--primary-color);
            font-weight: 500;
        }

        #sidebar .list-group-item.active {
            background: #b1d3e933;
            font-weight: 500;
            color: white;
            border-left-color: #3498db;
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
            color: var(--accent-color);
            text-decoration: none;
            padding: 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background: rgba(255,255,255,0.1);
            font-size: 0.9rem;
        }

        #sidebar.expanded .logout-btn {
            justify-content: flex-start;
            padding: 10px 15px;
        }

        .logout-btn i {
            margin-right: 0;
            color: white;
        }

        #sidebar.expanded .logout-btn i {
            margin-right: 10px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
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
            border-radius: 20px;
            border: none;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
            height: 100%;
            border-left: 4px solid var(--sidebar-bg);
            border-right: 4px solid var(--sidebar-bg);
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
            color: var(--sidebar-bg);
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
            background-color: var(--sidebar-bg);
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
        .form-group-custom textarea {
            width: 100%;
            padding: 14px 15px 8px;
            border: 1px solid #0A517F;
            border-radius: 12px;
            font-size: 16px;
            color: rgba(10, 81, 127, 0.6);
            outline: none;
        }

        .form-group-custom input::placeholder,
        .form-group-custom textarea::placeholder {
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

        .form-group-custom select {
            border: 1px solid #0A517F;
            border-radius: 10px;
            padding: 14px 45px 14px 15px;
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
            color: var(--sidebar-bg);
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
            color: var(--sidebar-bg);
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
            background-color: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
            padding: 12px 25px;
            border-radius: var(--border-radius);
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
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tr:hover td {
            background-color: #e2f1ff;
        }

        /* Password Toggle */
        .password-toggle {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
        }

        .password-toggle:hover {
            background-color: var(--light-gray);
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

        /* Back Button */
        .back-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .back-btn:hover {
            background-color: var(--dark-gray);
            color: white;
        }

        /* Section Header */
        .section-header {
            color: var(--dark-gray);
            font-weight: 500;
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--light-gray);
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 10px;
            color: var(--accent-color);
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
                overflow: hidden;
                transition: width 0.3s ease-in-out;
                z-index: 999;
            }

            #sidebar.expanded {
                width: 100%;
                box-shadow: 2px 0 10px rgba(0,0,0,0.2);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
                transition: margin-left 0.3s ease-in-out;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .header-title {
                font-size: 1.1rem;
            }

            .user-greeting {
                font-size: 0.75rem;
                padding: 5px 8px;
            }

            .user-greeting i {
                font-size: 0.8rem;
            }

            .dashboard-card {
                margin-bottom: 20px;
                padding: 10px;
            }

            .dashboard-card .card-header {
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .dashboard-card .card-body {
                padding: 12px;
            }

            .dashboard-card h5 {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .dashboard-card .detail-item {
                font-size: 0.8rem;
                margin-bottom: 8px;
            }

            .dashboard-card .detail-item i {
                font-size: 0.8rem;
                min-width: 18px;
            }

            .quick-actions .btn {
                font-size: 0.8rem;
                padding: 8px 10px;
            }

            .quick-actions .btn i {
                font-size: 0.8rem;
            }

            .form-container {
                padding: 15px;
                max-width: 100%;
            }

            .form-container h2 {
                font-size: 1.2rem;
            }

            .form-section-title {
                font-size: 1rem;
            }

            .form-group-custom {
                margin-bottom: 1.2rem;
            }

            .form-group-custom label {
                font-size: 0.75rem;
                top: -10px;
                left: 10px;
                padding: 0 4px;
            }

            .form-group-custom input,
            .form-group-custom select,
            .form-group-custom textarea {
                font-size: 0.85rem;
                padding: 10px 12px;
            }

            .form-group-custom input::placeholder,
            .form-group-custom textarea::placeholder,
            .form-group-custom select:invalid {
                font-size: 0.75rem;
            }

            .form-group-custom .toggle-password {
                font-size: 0.8rem;
                right: 10px;
            }

            .btn-primary,
            .btn-outline-primary {
                font-size: 0.85rem;
                padding: 8px 15px;
            }

            .error-message {
                font-size: 0.75rem;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table th, .table td {
                font-size: 0.8rem;
                padding: 10px !important;
            }

            .alert {
                font-size: 0.8rem;
                padding: 10px;
            }

            .modal-dialog {
                max-width: 90%;
                margin: 1.75rem auto;
            }
            
            /* Mobile specific styles */
            .mobile-overlay.active {
                display: block;
            }
            
            .mobile-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                background-color: white;
                border-bottom: 1px solid var(--light-gray);
            }
            
            .mobile-menu-btn {
                background: none;
                border: none;
                font-size: 1.5rem;
                color: var(--dark-gray);
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
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
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
            
            /* Tablet specific adjustments */
            .dashboard-card {
                margin-bottom: 20px;
            }
            
            .form-container {
                padding: 20px;
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

        /* Modal Backdrop */
        .modal-backdrop {
            opacity: 0.5;
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
                top: -12px; /* Try -10 to -14 for perfect balance */
                left: 12px;
                background: #fff;
                padding: 0 6px;
                font-size: 14px; /* Slightly smaller */
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
            
        /* Mobile specific improvements */
        @media (max-width: 576px) {
            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .main-content {
                padding: 10px;
            }
            
            .dashboard-card .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dashboard-card .card-header i {
                margin-bottom: 5px;
            }
            
            .quick-actions .btn {
                text-align: center;
                justify-content: center;
            }
            
            .form-container {
                padding: 10px;
            }
            
            .form-section-title {
                font-size: 1rem;
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
        }
    </style>
</head>
<body>
    <div class="mobile-overlay" id="mobileOverlay"></div>
    
    <header class="shadow-sm d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <button class="btn toggle-btn me-2" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">Distributor Admin Portal</h1>
    </div>
    <div class="d-flex align-items-center user-greeting">
        <i class="fas fa-user-circle me-2"></i>
        <span class="text-nowrap">Welcome, <?php echo htmlspecialchars($distributor_data->full_name ?? 'Distributor'); ?></span>
    </div>
</header>

    <div id="sidebar">
        <div class="sidebar-header">
            <h4>Menu</h4>
        </div>
        <div class="list-group list-group-flush flex-grow-1">
            <a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" 
               class="list-group-item list-group-item-action <?php echo ($method == 'distributordashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('Distributordashboard/profile'); ?>" 
               class="list-group-item list-group-item-action <?php echo ($method == 'profile') ? 'active' : ''; ?>">
                <i class="fas fa-user-cog"></i>
                <span>Profile Settings</span>o
            </a>
            <a href="<?php echo base_url('Distributordashboard/create_staff'); ?>" 
               class="list-group-item list-group-item-action <?php echo ($method == 'create_staff') ? 'active' : ''; ?>">
                <i class="fas fa-user-plus"></i>
                <span>Create Staff</span>
            </a>
            <a href="<?php echo base_url('Distributordashboard/get_staff_data'); ?>" 
               class="list-group-item list-group-item-action <?php echo ($method == 'get_staff_data') ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Staff</span>
            </a>
        </div>
        <div class="logout-container">
            <a class="logout-btn" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
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
                    <a href="<?= base_url('Distributordashboard/logout'); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content" id="main-content">
        <div class="container-fluid">
            <?php if (isset($method) && in_array($method, ['distributordashboard', 'profile', 'create_staff','get_staff_data' , 'showing_staff_remaining_data'])) : ?>
                <?php if ($method == "distributordashboard") : ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt me-2" style="color: #0A517F;"></i>Dashboard Overview</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row fade-in g-4">
                        <?php if (!empty($distributor_data)): ?>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-user-shield"></i>
                                        <span>Distributor Profile</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($distributor_data->full_name ?? 'N/A'); ?></h5>
                                        <div class="detail-item">
                                            <i class="fas fa-envelope"></i>
                                            <span><?php echo htmlspecialchars($distributor_data->email ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-phone"></i>
                                            <span><?php echo htmlspecialchars($distributor_data->phone ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span><?php echo htmlspecialchars($distributor_data->city ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge-custom"><?php echo htmlspecialchars($distributor_data->role ?? 'Distributor Admin'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-building"></i>
                                        <span>Bank Details</span>
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

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="dashboard-card h-100">
                                    <div class="card-header">
                                        <i class="fas fa-bolt"></i>
                                        <span>Quick Actions</span>
                                    </div>
                                    <div class="card-body quick-actions">
                                        <a href="<?php echo base_url('Distributordashboard/profile'); ?>" class="btn btn-outline-primary btn-mobile">
                                            <i class="fas fa-user-edit"></i> Update Profile
                                        </a>
                                        <a href="<?php echo base_url('Distributordashboard/create_staff'); ?>" class="btn btn-outline-primary btn-mobile">
                                            <i class="fas fa-user-plus"></i> Add Staff
                                        </a>
                                        <a href="<?php echo base_url('Distributordashboard/get_staff_data'); ?>" class="btn btn-outline-primary btn-mobile">
                                            <i class="fas fa-file-invoice"></i> Manage Staff
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
                    <div class="row">
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-container w-100">
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

                                    <section class="row g-3">
                                        <h5 class="form-section-title"><i class="fas fa-user"></i> Basic Information</h5>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" id="full_name" name="full_name"
                                                    value="<?php echo htmlspecialchars($distributor_data->full_name ?? ''); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" id="email" name="email"
                                                    value="<?php echo htmlspecialchars($distributor_data->email ?? ''); ?>" readonly>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                                <input type="text" id="phone" name="phone" class="<?php echo form_error('phone') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('phone', htmlspecialchars($distributor_data->phone ?? '')); ?>" oninput="validatePhone(this)">
                                                <div class="error-message" id="phone-error"><?php echo form_error('phone'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="sap_code">SAP Code <span class="text-danger">*</span></label>
                                                <input type="text" id="sap_code" name="sap_code" class="<?php echo form_error('sap_code') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('sap_code', htmlspecialchars($distributor_data->sap_code ?? '')); ?>" oninput="validateSapCode(this)">
                                                <div class="error-message" id="sap_code-error"><?php echo form_error('sap_code'); ?></div>
                                            </div>
                                        </div>
                                    </section>

                                    <h5 class="form-section-title"><i class="fas fa-university"></i> Bank Details</h5>

                                    <section class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="account_holder_name">Account Holder Name <span class="text-danger">*</span></label>
                                                <input type="text" id="account_holder_name" name="account_holder_name" class="<?php echo form_error('account_holder_name') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('account_holder_name', htmlspecialchars($distributor_data->account_holder_name ?? '')); ?>" oninput="validateAccountHolderName(this)">
                                                <div class="error-message" id="account_holder_name-error"><?php echo form_error('account_holder_name'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                                <input type="text" id="account_number" name="account_number" class="<?php echo form_error('account_number') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('account_number', htmlspecialchars($distributor_data->account_number ?? '')); ?>" oninput="validateAccountNumber(this)">
                                                <div class="error-message" id="account_number-error"><?php echo form_error('account_number'); ?></div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="ifsc_code">IFSC Code <span class="text-danger">*</span></label>
                                                <input type="text" id="ifsc_code" name="ifsc_code" class="<?php echo form_error('ifsc_code') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('ifsc_code', htmlspecialchars($distributor_data->ifsc_code ?? '')); ?>" oninput="validateIfscCode(this)">
                                                <div class="error-message" id="ifsc_code-error"><?php echo form_error('ifsc_code'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group-custom">
                                                <label for="bank_name">Bank  <span class="text-danger">*</span></label>
                                                <input type="text" id="bank_name" name="bank_name" class="<?php echo form_error('bank_name') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('bank_name', htmlspecialchars($distributor_data->bank_name ?? '')); ?>" oninput="validateBankName(this)">
                                                <div class="error-message" id="bank_name-error"><?php echo form_error('bank_name'); ?></div>
                                            </div>
                                        </div>
                                    </section>

                                    <h5 class="form-section-title"><i class="fas fa-map-marker-alt"></i> Address Details</h5>

                                    <div class="form-group-custom mb-3">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <textarea id="address" name="address" rows="3" class="<?php echo form_error('address') ? 'is-invalid' : ''; ?>" oninput="validateAddress(this)"><?php echo set_value('address', htmlspecialchars($distributor_data->address ?? '')); ?></textarea>
                                        <div class="error-message" id="address-error"><?php echo form_error('address'); ?></div>
                                    </div>

                                    <section class="row g-3">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group-custom">
                                                <label for="pin_code">Pin Code <span class="text-danger">*</span></label>
                                                <input type="text" id="pin_code" name="pin_code" class="<?php echo form_error('pin_code') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('pin_code', htmlspecialchars($distributor_data->pin_code ?? '')); ?>" oninput="validatePinCode(this)">
                                                <div class="error-message" id="pin_code-error"><?php echo form_error('pin_code'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group-custom">
                                                <label for="city">City <span class="text-danger">*</span></label>
                                                <input type="text" id="city" name="city" class="<?php echo form_error('city') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('city', htmlspecialchars($distributor_data->city ?? '')); ?>" oninput="validateCity(this)">
                                                <div class="error-message" id="city-error"><?php echo form_error('city'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group-custom">
                                                <label for="office_mobile">Office Number 1 <span class="text-danger">*</span></label>
                                                <input type="text" id="office_mobile" name="office_mobile" class="<?php echo form_error('office_mobile') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('office_mobile', htmlspecialchars($distributor_data->office_mobile ?? '')); ?>" oninput="validateOfficeMobile(this)">
                                                <div class="error-message" id="office_mobile-error"><?php echo form_error('office_mobile'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group-custom">
                                                <label for="office_mobile2">Office Number 2 <span class="text-danger">*</span></label>
                                                <input type="text" id="office_mobile2" name="office_mobile2" class="<?php echo form_error('office_mobile2') ? 'is-invalid' : ''; ?>"
                                                    value="<?php echo set_value('office_mobile2', htmlspecialchars($distributor_data->office_mobile2 ?? '')); ?>" oninput="validateOfficeMobile2(this)">
                                                <div class="error-message" id="office_mobile2-error"><?php echo form_error('office_mobile2'); ?></div>
                                            </div>
                                        </div>
                                    </section>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4 btn-mobile">
                                            <i class="fas fa-save me-1"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Function to validate phone number
                        function validatePhone(input) {
                            const errorElement = document.getElementById('phone-error');
                            const phonePattern = /^[0-9]{10}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Phone number is required';
                                return false;
                            } else if (!phonePattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid 10-digit phone number';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate SAP code
                        function validateSapCode(input) {
                            const errorElement = document.getElementById('sap_code-error');
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'SAP code is required';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate account holder name
                        function validateAccountHolderName(input) {
                            const errorElement = document.getElementById('account_holder_name-error');
                            const namePattern = /^[a-zA-Z\s]+$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Account holder name is required';
                                return false;
                            } else if (!namePattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Name can only contain letters and spaces';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate account number
                        function validateAccountNumber(input) {
                            const errorElement = document.getElementById('account_number-error');
                            const accountPattern = /^[0-9]{9,18}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Account number is required';
                                return false;
                            } else if (!accountPattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid account number (9-18 digits)';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate IFSC code
                        function validateIfscCode(input) {
                            const errorElement = document.getElementById('ifsc_code-error');
                            const ifscPattern = /^[A-Z]{4}0[A-Z0-9]{6}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'IFSC code is required';
                                return false;
                            } else if (!ifscPattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid IFSC code (e.g., ABCD0123456)';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate bank name
                        function validateBankName(input) {
                            const errorElement = document.getElementById('bank_name-error');
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Bank name is required';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate address
                        // function validateAddress(input) {
                        //     const errorElement = document.getElementById('address-error');
                            
                        //     if (input.value.trim() === '') {
                        //         input.classList.add('is-invalid');
                        //         errorElement.textContent = 'Address is required';
                        //         return false;
                        //     } else if (input.value.trim().length < 10) {
                        //         input.classList.add('is-invalid');
                        //         errorElement.textContent = 'Address should be at least 10 characters long';
                        //         return false;
                        //     } else {
                        //         input.classList.remove('is-invalid');
                        //         errorElement.textContent = '';
                        //         return true;
                        //     }
                        // }

                        // Function to validate pin code
                        function validatePinCode(input) {
                            const errorElement = document.getElementById('pin_code-error');
                            const pincodePattern = /^[0-9]{6}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Pin code is required';
                                return false;
                            } else if (!pincodePattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid 6-digit pin code';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate city
                        function validateCity(input) {
                            const errorElement = document.getElementById('city-error');
                            const cityPattern = /^[a-zA-Z\s]+$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'City is required';
                                return false;
                            } else if (!cityPattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'City name can only contain letters and spaces';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate office mobile
                        function validateOfficeMobile(input) {
                            const errorElement = document.getElementById('office_mobile-error');
                            const phonePattern = /^[0-9]{10}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Office number is required';
                                return false;
                            } else if (!phonePattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid 10-digit office number';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Function to validate office mobile 2
                        function validateOfficeMobile2(input) {
                            const errorElement = document.getElementById('office_mobile2-error');
                            const phonePattern = /^[0-9]{10}$/;
                            
                            if (input.value.trim() === '') {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Office number 2 is required';
                                return false;
                            } else if (!phonePattern.test(input.value)) {
                                input.classList.add('is-invalid');
                                errorElement.textContent = 'Please enter a valid 10-digit office number';
                                return false;
                            } else {
                                input.classList.remove('is-invalid');
                                errorElement.textContent = '';
                                return true;
                            }
                        }

                        // Add event listeners to all input fields to validate on input
                        document.addEventListener('DOMContentLoaded', function() {
                            const phoneInput = document.getElementById('phone');
                            const sapCodeInput = document.getElementById('sap_code');
                            const accountHolderInput = document.getElementById('account_holder_name');
                            const accountNumberInput = document.getElementById('account_number');
                            const ifscInput = document.getElementById('ifsc_code');
                            const bankNameInput = document.getElementById('bank_name');
                            const addressInput = document.getElementById('address');
                            const pinCodeInput = document.getElementById('pin_code');
                            const cityInput = document.getElementById('city');
                            const officeMobileInput = document.getElementById('office_mobile');
                            const officeMobile2Input = document.getElementById('office_mobile2');
                            
                            // Add input event listeners
                            if (phoneInput) phoneInput.addEventListener('input', function() { validatePhone(this); });
                            if (sapCodeInput) sapCodeInput.addEventListener('input', function() { validateSapCode(this); });
                            if (accountHolderInput) accountHolderInput.addEventListener('input', function() { validateAccountHolderName(this); });
                            if (accountNumberInput) accountNumberInput.addEventListener('input', function() { validateAccountNumber(this); });
                            if (ifscInput) ifscInput.addEventListener('input', function() { validateIfscCode(this); });
                            if (bankNameInput) bankNameInput.addEventListener('input', function() { validateBankName(this); });
                            if (addressInput) addressInput.addEventListener('input', function() { validateAddress(this); });
                            if (pinCodeInput) pinCodeInput.addEventListener('input', function() { validatePinCode(this); });
                            if (cityInput) cityInput.addEventListener('input', function() { validateCity(this); });
                            if (officeMobileInput) officeMobileInput.addEventListener('input', function() { validateOfficeMobile(this); });
                            if (officeMobile2Input) officeMobile2Input.addEventListener('input', function() { validateOfficeMobile2(this); });
                            
                            // Add form submission validation
                            const form = document.getElementById('profileForm');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    let isValid = true;
                                    
                                    if (phoneInput) isValid = validatePhone(phoneInput) && isValid;
                                    if (sapCodeInput) isValid = validateSapCode(sapCodeInput) && isValid;
                                    if (accountHolderInput) isValid = validateAccountHolderName(accountHolderInput) && isValid;
                                    if (accountNumberInput) isValid = validateAccountNumber(accountNumberInput) && isValid;
                                    if (ifscInput) isValid = validateIfscCode(ifscInput) && isValid;
                                    if (bankNameInput) isValid = validateBankName(bankNameInput) && isValid;
                                    if (addressInput) isValid = validateAddress(addressInput) && isValid;
                                    if (pinCodeInput) isValid = validatePinCode(pinCodeInput) && isValid;
                                    if (cityInput) isValid = validateCity(cityInput) && isValid;
                                    if (officeMobileInput) isValid = validateOfficeMobile(officeMobileInput) && isValid;
                                    if (officeMobile2Input) isValid = validateOfficeMobile2(officeMobile2Input) && isValid;
                                    
                                    if (!isValid) {
                                        e.preventDefault();
                                        // Scroll to the first error
                                        const firstError = document.querySelector('.is-invalid');
                                        if (firstError) {
                                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        }
                                    }
                                });
                            }
                        });
                    </script>

                    <style>
                        .error-message {
                            color: #dc3545;
                            font-size: 0.875rem;
                            margin-top: 0.25rem;
                            display: block;
                        }

                        .is-invalid {
                            border-color: #dc3545 !important;
                        }

                    </style>

                <?php elseif ($method == "create_staff") : ?>
                    <section class="row">
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <div class="text-center mb-4">
                                    <h2><i class="fas fa-user-plus"></i> New Staff Account</h2>
                                    <p class="text-muted">Create a new staff member account</p>

                                    <!-- Staff Limit Indicator -->
                                    <?php if (isset($staff_limit) && isset($current_staff_count)): ?>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            You have created <?php echo $current_staff_count; ?> out of <?php echo $staff_limit; ?> allowed staff accounts.
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php echo form_open('Distributordashboard/create_staff'); ?>

                                    <div class="mb-3">
                                        <div class="form-group-custom">
                                            <label for="full_name"><i class="fas fa-user me-1 text-gray-500"></i> Full Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                class="<?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" 
                                                id="full_name" name="full_name" 
                                                value="<?php echo set_value('full_name'); ?>" 
                                                required>
                                        </div>
                                        <?php echo form_error('full_name', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group-custom">
                                            <label for="email"><i class="fas fa-envelope me-1 text-gray-500"></i> Email <span class="text-danger">*</span></label>
                                            <input type="email" 
                                                class="<?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                                                id="email" name="email" 
                                                value="<?php echo set_value('email'); ?>" 
                                                required>
                                        </div>
                                        <?php echo form_error('email', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group-custom position-relative">
                                            <label for="password"><i class="fas fa-lock me-1 text-gray-500"></i> Password <span class="text-danger">*</span></label>
                                            <input type="password"
                                                class="<?php echo form_error('password') ? 'is-invalid' : ''; ?>"
                                                id="password"
                                                name="password"
                                                value="<?php echo set_value('password'); ?>"
                                                required
                                                style="padding-right: 50px;"> <!-- extra padding for eye icon -->

                                            <!-- Toggle button placed inside the input field (absolute) -->
                                            <button type="button" class="btn btn-sm btn-link position-absolute end-0 top-0 mt-2 me-2 p-0">
                                                <i class="fas fa-eye text-dark mt-2" id="togglePassword" style="color: black;"></i>
                                            </button>

                                            <?php echo form_error('password', '<div class="invalid-feedback d-block">', '</div>'); ?>
                                        </div>
                                        <div class="form-text text-muted small">Password must be at least 8 characters long</div>

                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary py-2 btn-mobile">
                                            <i class="fas fa-user-plus me-2"></i> Create Staff Account
                                        </button>
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </section>

                    <!-- Limit Reached Modal -->
                    <?php if (isset($staff_limit) && isset($current_staff_count) && $current_staff_count >= $staff_limit): ?>
                    <div class="modal fade show" id="limitModal" tabindex="-1" aria-labelledby="limitModalLabel" aria-modal="true" style="display: block; padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="limitModalLabel">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Staff Limit Reached
                                    </h5>
                                    <!-- <button type="button" class="btn-close" onclick="closeModal()"></button> -->
                                </div>
                                <div class="modal-body">
                                    <p>You have reached your maximum limit of <?php echo $staff_limit; ?> staff accounts.</p>
                                    <p>Please contact your administrator to request an increase in your staff limit.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <?php endif; ?>

                <?php elseif($method == 'get_staff_data'): ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('Distributordashboard/dashboard'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Dashboard</a></button>
                        </div>
                    </div>
                    
                    <div class="row fade-in">
                        <div class="col-12">
                            <h2><i class="fas fa-users me-2"></i>Staff Management</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
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

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-mobile">
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
                                                <?php if (!empty($staff_data) && count($staff_data) > 0): ?>
                                                    <?php $serialNo = 1; ?>
                                                    <?php foreach ($staff_data as $staff): ?>
                                                        <tr>
                                                            <td><?= $serialNo++ ?></td>
                                                            <td><?= htmlspecialchars($staff->full_name) ?></td>
                                                            <td><?= htmlspecialchars($staff->Email) ?></td>
                                                            <td><?= htmlspecialchars($staff->role) ?></td>
                                                            <td class="d-flex justify-content-center align-items-center gap-2">
                                                                <a href="<?= base_url('Distributordashboard/showing_staff_remaining_data/' . $staff->id) ?>" 
                                                                class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal" data-id="<?= $staff->id ?>">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-danger py-3">
                                                            <i class="fas fa-exclamation-circle me-2 text-danger"></i>
                                                            No staff found
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
                                    Are you sure you want to delete this staff member?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- JavaScript for setting delete URL -->
                    <script>
                        const deleteModal = document.getElementById('deleteModal');
                        const confirmBtn = document.getElementById('confirmDeleteBtn');

                        deleteModal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const staffId = button.getAttribute('data-id');
                            const deleteUrl = "<?= base_url('Distributordashboard/delete_staff/') ?>" + staffId;
                            confirmBtn.setAttribute('href', deleteUrl);
                        });
                    </script>

                <?php elseif($method == 'showing_staff_remaining_data'): ?>
                    <section class="fade-in">
                        <div class="col-12 mb-4">
                            <button class="btn btn-primary" ><a href="<?php echo base_url('Distributordashboard/get_staff_data'); ?>" style="text-decoration: none; color: white; padding: 0;"><i class="fas fa-arrow-left me-2"></i>Back To Staff List</a></button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2 text-dark"></i>Staff Full Details</h2>
                                    <form>
                                        <?php foreach ($staff_data as $staff): ?>

                                            <section class="form-section">
                                                <div class="row g-3">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="full_name">Full Name</label>
                                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                                value="<?php echo htmlspecialchars($staff->full_name ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email"
                                                                value="<?php echo htmlspecialchars($staff->Email ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="form-section">
                                                <div class="row g-3">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone" name="phone"
                                                                value="<?php echo htmlspecialchars($staff->phone ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="sap_code">SAP Code</label>
                                                            <input type="text" class="form-control" id="sap_code" name="sap_code"
                                                                value="<?php echo htmlspecialchars($staff->sap_code ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <h5 class="section-header"><i class="fas fa-university text-dark me-2"></i>Bank Details</h5>

                                            <section class="form-section">
                                                <div class="row g-3">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="account_holder_name">Account Holder Name</label>
                                                            <input type="text" class="form-control" id="account_holder_name" name="account_holder_name"
                                                                value="<?php echo htmlspecialchars($staff->account_holder_name ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="account_number">Account Number</label>
                                                            <input type="text" class="form-control" id="account_number" name="account_number"
                                                                value="<?php echo htmlspecialchars($staff->account_number ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="form-section">
                                                <div class="row g-3">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="ifsc_code">IFSC Code</label>
                                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code"
                                                                value="<?php echo htmlspecialchars($staff->ifsc_code ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="bank_name">Bank Name</label>
                                                            <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                                value="<?php echo htmlspecialchars($staff->bank_name ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2 text-dark"></i>Address Details</h5>

                                            <section class="form-section">
                                                <div class="mb-3">
                                                    <div class="form-group-custom">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3" readonly><?php echo htmlspecialchars($staff->address ?? ''); ?></textarea>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="form-section">
                                                <div class="row g-3">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="pin_code">Pin Code</label>
                                                            <input type="text" class="form-control" id="pin_code" name="pin_code"
                                                                value="<?php echo htmlspecialchars($staff->pin_code ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="city">City</label>
                                                            <input type="text" class="form-control" id="city" name="city"
                                                                value="<?php echo htmlspecialchars($staff->city ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group-custom">
                                                            <label for="office_mobile">Office Mobile</label>
                                                            <input type="text" class="form-control" id="office_mobile" name="office_mobile"
                                                                value="<?php echo htmlspecialchars($staff->office_mobile ?? ''); ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

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
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('sidebarToggle');
            const body = document.body;
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

            // Close sidebar on outside click on mobile
            body.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('expanded') && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('expanded');
                    mainContent.classList.remove('expanded');
                    mobileOverlay.classList.remove('active');
                    localStorage.setItem('sidebarExpanded', false);
                }
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

            // Close modal function
            if (document.getElementById('limitModal')) {
                function closeModal() {
                    document.getElementById('limitModal').style.display = 'none';
                    document.querySelector('.modal-backdrop').style.display = 'none';
                }
                window.closeModal = closeModal;
            }

            // Validation functions
            function validatePhone(input) {
                const error = document.getElementById('phone-error');
                if (input.value && !/^\d{10}$/.test(input.value)) {
                    error.textContent = 'Phone must be 10 digits.';
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
                if (input.value && !/^\d{10}$/.test(input.value)) {
                    error.textContent = 'Office Mobile must be exactly 10 digits.';     
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
                    { id: 'phone', errorId: 'phone-error', regex: /^\d{10}$/, message: 'Phone must be 10 digits.', optional: true },
                    { id: 'sap_code', errorId: 'sap_code-error', regex: /^[a-zA-Z0-9]+$/, message: 'SAP Code must be alphanumeric.', optional: true },
                    { id: 'account_holder_name', errorId: 'account_holder_name-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'Account Holder Name must be alphanumeric with spaces.', optional: true },
                    { id: 'account_number', errorId: 'account_number-error', regex: /^\d+$/, message: 'Account Number must be numeric.', optional: true },
                    { id: 'ifsc_code', errorId: 'ifsc_code-error', regex: /^[a-zA-Z0-9]+$/, message: 'IFSC Code must be alphanumeric.', optional: true },
                    { id: 'bank_name', errorId: 'bank_name-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'Bank Name must be alphanumeric with spaces.', optional: true },
                    { id: 'pin_code', errorId: 'pin_code-error', regex: /^\d{6}$/, message: 'Pin Code must be exactly 6 digits.', optional: true },
                    { id: 'city', errorId: 'city-error', regex: /^[a-zA-Z0-9\s]+$/, message: 'City must be alphanumeric with spaces.', optional: true },
                    { id: 'office_mobile', errorId: 'office_mobile-error', regex: /^\d{10}$/, message: 'Office Mobile must be exactly 10 digits.', optional: true },
                    { id: 'office_mobile2', errorId: 'office_mobile2-error', regex: /^\d{10}$/, message: 'Office Mobile 2 must be exactly 10 digits.', optional: true }

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
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        });
    </script>
</body>
</html>