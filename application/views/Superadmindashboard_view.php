<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
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
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: var(--content-bg);
            color: #333;
        }
        
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
            transition: all 0.3s;
        }
        
        #sidebar {
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s;
            z-index: 999;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 25px;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .list-group-item {
            color: var(--sidebar-color);
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
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
        
        .list-group-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .logout-container {
            margin-top: auto;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            color: var(--sidebar-color);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .logout-btn i {
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            transition: all 0.3s;
            min-height: calc(100vh - var(--header-height));
        }
        
        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--secondary-color);
            cursor: pointer;
            transition: all 0.2s;
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

        .form-group-custom input {
        width: 100%;
        padding: 14px 15px 8px;
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

        .form-group-custom select {
        border: 1px solid #0A517F;
        border-radius: 10px;
        padding: 14px 45px 14px 15px;
        }
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
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
            cursor: pointer;
            height: 100%;
            border-left: 4px solid var(--primary-color);
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .dashboard-card .card-body {
            padding: 20px;
        }
        
        .dashboard-card h6 {
            color: var(--primary-color);
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
        
        /* Form styling */
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
            transition: all 0.2s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
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
        
        /* Table styling */
        .table {
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
            transition: all 0.2s;
        }
        
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #eee;
        }
        
        .btn-sm {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        
        /* Back button */
        .back-btn {
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
        }
        
        .back-btn i {
            margin-right: 8px;
        }
        
        /* Section headers */
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
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        
        /* Responsive adjustments */
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
        }
    </style>
</head>
<body>
    <header class="shadow-sm">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="d-flex align-items-center">
            <div class="user-greeting">
                <i class="fas fa-user-shield"></i>
                Welcome! Super Admin
            </div>
        </div>
    </header>

    <div id="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
        </div>
        <div class="list-group list-group-flush flex-grow-1">
            <a href="<?php echo base_url('Superadmindashboard/dashboard'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/dashboard')) ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/create_admin'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/create_admin')) ? 'active' : ''; ?>">
                <i class="fas fa-user-plus"></i>
                <span>Create Admin</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/get_admin_data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/get_admin_data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Admins</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/get_distributor_data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/get_distributor_data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Distributor</span>
            </a>
            <a href="<?php echo base_url('Superadmindashboard/get_staff_data'); ?>" 
               class="list-group-item list-group-item-action <?php echo (current_url() == base_url('Superadmindashboard/get_staff_data')) ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i>
                <span>Manage Staff</span>
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
        <div class="container-fluid fade-in">
            <?php if (isset($method)) : ?>
                <?php if ($method == 'superadmindashboard') : ?>
                        <div class="container-fluid">
                            <h1 class="mb-4">Dashboard Overview</h1>
                            <div class="row g-4">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('Superadmindashboard/get_admin_data'); ?>'">
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
                                    <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('Superadmindashboard/create_admin'); ?>'">
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
                                    <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('Superadmindashboard/get_distributor_data'); ?>'">
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
                                    <div class="card dashboard-card" onclick="window.location.href='<?php echo base_url('Superadmindashboard/get_staff_data'); ?>'">
                                        <div class="card-body">
                                            <h6><i class="fas fa-users-cog me-2"></i> Staff Details</h6>
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
                            </div>
                        </div>
                <?php elseif($method == 'get_admin_data') : ?>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Admin Details</h2>
                            <div class="card border-0 shadow-sm">
                                <!-- <div class="card-body"> -->
                                    <div class="table-responsive">
                                        <table class="table  mb-0 table-bordered table-hover">
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
                                                            <a href="<?php echo base_url('Superadmindashboard/showing_admin_remaining_data/' . $admin->id); ?>" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye me-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $serialNo++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>                
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
                                        
                                        <h5 class="section-header"><i class="fas fa-university me-2"></i>Bank Details</h5>
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
                                        
                                        <h5 class="section-header"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h5>
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
                                <!-- <div class="card-body"> -->
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
                                                            <a href="<?php echo base_url('Superadmindashboard/showing_distributor_remaining_data/'. $distributor->id); ?>" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye me-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $serialNo++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
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
                
                <?php elseif($method == 'get_staff_data'): ?>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Staff Details</h2>
                            <div class="card border-0 shadow-sm">
                                <!-- <div class="card-body"> -->
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
                                                            <a href="<?php echo base_url('Superadmindashboard/showing_staff_remaining_data/'. $staff->id); ?>" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye me-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $serialNo++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
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
                                            <div class="row">
                                                <div class="col-md-6 mb-3 ">
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
                                            
                                            <h5 class="section-header"><i class="fas fa-university me-2"></i>Bank Details</h5>
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
                                            
                                            <h5 class="section-header"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h5>
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
                <?php elseif($method == 'create_admin') : ?>
                    <div class="row fade-in">
                        <div class="col-12 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="h3 mb-0 text-gray-800">Admin Management</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('Superadmindashboard/dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-plus"></i> Create Admin</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row fade-in">
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <div class="text-center mb-4">
                                    <h2><i class="fas fa-user-plus"></i> New Admin Account</h2>
                                    <p class="text-muted">Create a new administrator account</p>
                                </div>
                                
                                <?php echo form_open('Superadmindashboard/create_admin'); ?>
                                    <div class="mb-3 ">
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

                    <!-- Distributor Limit Reached Modal (Will be shown automatically if limit is reached) -->
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

                    <script>
                        // Password toggle functionality
                        document.addEventListener('DOMContentLoaded', function() {
                        const togglePassword = document.getElementById('togglePassword');
                        const passwordInput = document.getElementById('password');
                        const toggleIcon = document.getElementById('toggleIcon');
                        
                        togglePassword.addEventListener('click', function() {
                            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordInput.setAttribute('type', type);
                            
                            // Toggle the eye icon
                            if (type === 'password') {
                                toggleIcon.classList.remove('fa-eye-slash');
                                toggleIcon.classList.add('fa-eye');
                            } else {
                                toggleIcon.classList.remove('fa-eye');
                                toggleIcon.classList.add('fa-eye-slash');
                            }
                        });
                        });

                        // Show modal if limit reached
                        <?php if (isset($show_limit_modal) && $show_limit_modal): ?>
                            window.onload = function() {
                                var limitModal = new bootstrap.Modal(document.getElementById('limitModal'));
                                limitModal.show();
                            };
                        <?php endif; ?>
                    </script>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        }
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
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
        
        // Show SweetAlert notifications
        window.onload = function(){
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
        };
    </script>
</body>
</html>