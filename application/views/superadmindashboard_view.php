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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #ecf0f1;
            --sidebar-active-bg: #3498db;
            --content-bg: #f5f7fa;
            --primary-color: #3498db;
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
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
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
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            #sidebar {
                width: 0;
                overflow: hidden;
            }
            
            #sidebar.expanded {
                width: var(--sidebar-width);
                box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.expanded {
                margin-left: var(--sidebar-width);
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .table-responsive {
                border-radius: 8px;
            }
            
            .user-greeting span {
                display: none;
            }
        }
        
        @media (min-width: 993px) {
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
            color: var(--dark-gray);
            margin: 0;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
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
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Admin Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered table-hover">
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
                                            <?php foreach ($admin_data as $admin): ?>
                                                <tr>
                                                    <td><?php echo $serialNo; ?></td>
                                                    <td><?php echo htmlspecialchars($admin->full_name); ?></td>
                                                    <td><?php echo htmlspecialchars($admin->email); ?></td>
                                                    <td><?php echo htmlspecialchars($admin->role); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('showing-admin-remaining-data/' . $admin->id); ?>" class="btn btn-sm btn-outline-primary p-1 px-2 me-1">
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
                                                <?php $serialNo++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                        <div class="col-12">
                            <button class="btn btn-secondary back-btn" onclick="window.history.back();">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Admin Full Details</h2>
                                    <form>
                                        <?php foreach ($admin_data as $admin): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($admin->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($admin->email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($admin->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($admin->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($admin->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($admin->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($admin->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
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
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($admin->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($admin->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
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
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Distributor Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
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
                                                <?php $serialNo++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                        <div class="col-12">
                            <button class="btn btn-secondary back-btn" onclick="window.history.back();">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Distributor Admin Full Details</h2>
                                    <form>
                                        <?php foreach ($distributor_data as $distributor): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
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
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
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
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2" style="color: #0A517F;"></i>Address Details</h5>
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
                <?php elseif($method == 'get_staff_data'): ?>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Staff Details</h2>
                            <div class="card border-0 shadow-sm">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered table-hover">
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
                                            <?php foreach ($staff_data as $staff): ?>
                                                <tr>
                                                    <td><?php echo $serialNo; ?></td>
                                                    <td><?php echo htmlspecialchars($staff->full_name); ?></td>
                                                    <td><?php echo htmlspecialchars($staff->Email); ?></td>
                                                    <td><?php echo htmlspecialchars($staff->role); ?></td>
                                                    <td>
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
                                                <?php $serialNo++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                        <div class="col-12">
                            <button class="btn btn-secondary back-btn" onclick="window.history.back();">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4"><i class="fas fa-user-cog me-2"></i>Staff Full Details</h2>
                                    <form>
                                        <?php foreach ($staff_data as $staff): ?>
                                            <h5 class="section-header"><i class="fas fa-user me-2" style="color: #0A517F;"></i>Basic Information</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="full_name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" 
                                                        value="<?php echo htmlspecialchars($staff->full_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                        value="<?php echo htmlspecialchars($staff->Email ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" 
                                                        value="<?php echo htmlspecialchars($staff->phone ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sap_code" class="form-label">SAP Code</label>
                                                    <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                        value="<?php echo htmlspecialchars($staff->sap_code ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <h5 class="section-header"><i class="fas fa-university me-2" style="color: #0A517F;"></i>Bank Details</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                        value="<?php echo htmlspecialchars($staff->account_holder_name ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="account_number" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="account_number" name="account_number" 
                                                        value="<?php echo htmlspecialchars($staff->account_number ?? ''); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="ifsc_code" class="form-label">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                        value="<?php echo htmlspecialchars($staff->ifsc_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
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
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                        value="<?php echo htmlspecialchars($staff->pin_code ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" 
                                                        value="<?php echo htmlspecialchars($staff->city ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
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
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Update Distributor Limit</h2>
                            <div class="card border-0 shadow-sm">
                                <!-- <div class="card-body"> -->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
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
                                                <?php $serialNo = 1; ?>
                                                <?php foreach ($get_distributor_limits as $d): ?>
                                                    <tr>
                                                        <td><?= $serialNo++; ?></td>
                                                        <td><?= htmlspecialchars($d->full_name); ?></td>
                                                        <td><?= htmlspecialchars($d->email); ?></td>
                                                        <td><?= htmlspecialchars($d->role); ?></td>
                                                        <td><?= htmlspecialchars($d->distributor_limit); ?></td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-primary update-distributor-limit-btn"
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
                                            </tbody>
                                        </table>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Update Distributor Limit Modal -->
                    <div class="modal fade" id="updateDistributorLimitModal" tabindex="-1" aria-labelledby="updateDistributorLimitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="<?= base_url('update-distributor-limits'); ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fas fa-users-cog me-2 text-primary"></i>Update Distributor Limit</h5>
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
                                        <button type="submit" class="btn btn-primary py-2">
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
