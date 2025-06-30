<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSG Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .list-group-itemed {
            color: black;
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .list-group-itemed:hover, 
        .list-group-itemed.active {
            background: rgba(255, 255, 255, 0.1);
            color: black;
            border-left-color: var(--sidebar-active-bg);
        }
        
        .list-group-itemed.active {
            background: var(--sidebar-active-bg);
        }
        
        .list-group-itemed i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
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
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span class="d-none d-md-inline">Welcome, <?php echo htmlspecialchars($admin_name->full_name ?? 'Admin'); ?></span>
            </div>
        </div>
    </header>

    <div id="sidebar">
        <div class="sidebar-header">
            <h4>LSG Admin</h4>
        </div>
        <div class="sidebar-menu">
            <div class="list-group list-group-flush">
                <a href="<?php echo base_url('AdminDashboard/dashboard'); ?>" 
                   class="list-group-item list-group-item-action <?php echo (current_url() == base_url('AdminDashboard/dashboard')) ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo base_url('AdminDashboard/profile'); ?>" 
                   class="list-group-item list-group-item-action <?php echo (current_url() == base_url('AdminDashboard/profile')) ? 'active' : ''; ?>">
                    <i class="fas fa-user-cog"></i>
                    <span>Profile</span>
                </a>
                <a href="<?php echo base_url('AdminDashboard/create_distributor'); ?>" 
                   class="list-group-item list-group-item-action <?php echo (current_url() == base_url('AdminDashboard/create_distributor')) ? 'active' : ''; ?>">
                    <i class="fas fa-user-plus"></i>
                    <span>Create Distributor</span>
                </a>
                <a href="<?php echo base_url('AdminDashboard/assign_distributor_pages'); ?>" 
                   class="list-group-item list-group-item-action <?php echo (current_url() == base_url('AdminDashboard/assign_distributor_pages')) ? 'active' : ''; ?>">
                    <i class="fas fa-tasks"></i>
                    <span>Assign Pages</span>
                </a>
            </div>
        </div>
        <div class="logout-container">
            <a href="<?php echo base_url('login'); ?>" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-content" id="main-content">
        <div class="container-fluid animate-fade-in">
            <?php if (isset($method) && in_array($method, ['admindashboard', 'profile', 'enrollment', 'create_distributor', 'assign_distributor_pages'])) : ?>
                <?php if ($method == "admindashboard") : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="page-title">Dashboard Overview</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home me-1"></i> Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="row">
                        <?php if (!empty($admin_data)) : ?>
                            <?php foreach ($admin_data as $admin) : ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="dashboard-card h-100">
                                        <div class="card-header d-flex align-items-center">
                                            <i class="fas fa-user-shield me-2"></i>
                                            <span>Admin Profile</span>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($admin->full_name ?? 'N/A'); ?></h5>
                                            <div class="mb-2">
                                                <i class="fas fa-envelope me-2 text-muted"></i>
                                                <span><?php echo htmlspecialchars($admin->email ?? 'N/A'); ?></span>
                                            </div>
                                            <div class="mb-3">
                                                <i class="fas fa-user-tag me-2 text-muted"></i>
                                                <span class="badge bg-primary"><?php echo htmlspecialchars($admin->role ?? 'N/A'); ?></span>
                                            </div>
                                            <a href="<?php echo base_url('AdminDashboard/profile'); ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit me-1"></i> Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No admin data available.
                                </div>
                            </div>
                        <?php endif; ?>
                       
                        <!-- Additional Dashboard Cards --
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header d-flex align-items-center" style="background-color: var(--success-color);">
                                    <i class="fas fa-users me-2"></i>
                                    <span>Active Distributors</span>
                                </div>
                                <div class="card-body text-center">
                                    <h2 class="mb-3">24</h2>
                                    <p class="text-success mb-0">5 new this month</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header d-flex align-items-center" style="background-color: var(--info-color);">
                                    <i class="fas fa-file-alt me-2"></i>
                                    <span>Total Pages</span>
                                </div>
                                <div class="card-body text-center">
                                    <h2 class="mb-3">48</h2>
                                    <p class="text-info mb-0">Manage content pages</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                <?php elseif ($method == "profile") : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="page-title">Profile Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="profile-form">
                                <h4 class="mb-4 text-primary"><i class="fas fa-user"></i> Profile Information</h4>
                                
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
                                            <div class="error-message" id="phone-error"><?php echo form_error('phone'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="sap_code" class="form-label">SAP Code</label>
                                            <input type="text" class="form-control" id="sap_code" name="sap_code" 
                                                value="<?php echo htmlspecialchars($admin_data->sap_code ?? ''); ?>" oninput="validateSapCode(this)">
                                            <div class="error-message" id="sap_code-error"><?php echo form_error('sap_code'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="mt-4 mb-3 border-bottom pb-2 text-primary"> <i class="fas fa-university me-2"></i>Bank Details</h5>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" 
                                                value="<?php echo htmlspecialchars($admin_data->account_holder_name ?? ''); ?>" oninput="validateAccountHolderName(this)">
                                            <div class="error-message" id="account_holder_name-error"><?php echo form_error('account_holder_name'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" class="form-control" id="account_number" name="account_number" 
                                                value="<?php echo htmlspecialchars($admin_data->account_number ?? ''); ?>" oninput="validateAccountNumber(this)">
                                            <div class="error-message" id="account_number-error"><?php echo form_error('account_number'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="ifsc_code" class="form-label">IFSC Code</label>
                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" 
                                                value="<?php echo htmlspecialchars($admin_data->ifsc_code ?? ''); ?>" oninput="validateIfscCode(this)">
                                            <div class="error-message" id="ifsc_code-error"><?php echo form_error('ifsc_code'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" 
                                                value="<?php echo htmlspecialchars($admin_data->bank_name ?? ''); ?>" oninput="validateBankName(this)">
                                            <div class="error-message" id="bank_name-error"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="mt-4 mb-3 border-bottom pb-2 text-primary"><i class="fas fa-map-marker-alt me-2"></i>Address Details</h5>
                                    
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" oninput="validateAddress(this)"><?php echo htmlspecialchars($admin_data->address ?? ''); ?></textarea>
                                        <div class="error-message" id="address-error"><?php echo form_error('address'); ?></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input type="text" class="form-control" id="pin_code" name="pin_code" 
                                                value="<?php echo htmlspecialchars($admin_data->pin_code ?? ''); ?>" oninput="validatePinCode(this)">
                                            <div class="error-message" id="pin_code-error"><?php echo form_error('pin_code'); ?></div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                value="<?php echo htmlspecialchars($admin_data->city ?? ''); ?>" oninput="validateCity(this)">
                                            <div class="error-message" id="city-error"><?php echo form_error('city'); ?></div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="office_mobile" class="form-label">Office Mobile</label>
                                            <input type="text" class="form-control" id="office_mobile" name="office_mobile" 
                                                value="<?php echo htmlspecialchars($admin_data->office_mobile ?? ''); ?>" oninput="validateOfficeMobile(this)">
                                            <div class="error-message" id="office_mobile-error"><?php echo form_error('office_mobile'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <!-- <button type="button" class="btn btn-outline-secondary me-md-2" onclick="resetForm()">
                                            <i class="fas fa-undo me-1"></i> Reset
                                        </button> -->
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($method == "create_distributor") : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="page-title">Create New Distributor</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Distributor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <h2><i class="fas fa-user-plus me-2 text-primary"></i>New Distributor Account</h2>
                                
                                <?php echo form_open('Admindashboard/create_distributor'); ?>
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label"><i class="fas fa-user me-1"></i>Full Name</label>
                                        <input type="text" class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" 
                                            id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" required>
                                        <?php echo form_error('full_name', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email</label>
                                        <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                                            id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                                        <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                                                id="password" name="password" required>
                                            <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                        <div class="form-text">Password must be at least 8 characters long</div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>Create Distributor
                                        </button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($method == "assign_distributor_pages") : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="page-title">Assign Distributor Pages</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('AdminDashboard/dashboard'); ?>"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Assign Pages</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="form-container">
                                <h3 class="mb-4 text-primary"><i class="fas fa-file-alt me-2"></i>Available Pages</h3>
                                
                                <form method="post">
                                    <div class="list-group mb-4">
                                        <?php foreach ($all_pages as $page) : ?>
                                            <div class="list-group-itemed">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="page_ids[]" 
                                                        value="<?php echo $page->id; ?>" 
                                                        id="page_<?php echo $page->id; ?>"
                                                        <?php echo in_array($page->id, $selected_pages) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="page_<?php echo $page->id; ?>">
                                                        <?php echo htmlspecialchars($page->name); ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
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
            <?php else : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            No method specified. Please contact support.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', document.body.classList.contains('sidebar-collapsed'));
        }

        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            // Set sidebar state from localStorage
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                document.body.classList.add('sidebar-collapsed');
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.toggle-btn');
                if (window.innerWidth <= 768 && !sidebar.contains(event.target) && event.target !== toggleBtn && !toggleBtn.contains(event.target)) {
                    document.body.classList.remove('sidebar-collapsed');
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

        function resetForm() {
            const form = document.getElementById('profileForm');
            if (form) {
                form.reset();
                const errorMessages = document.querySelectorAll('.error-message');
                const inputs = document.querySelectorAll('.form-control');
                
                errorMessages.forEach(error => error.style.display = 'none');
                inputs.forEach(input => input.classList.remove('is-invalid'));
                
                Swal.fire({
                    icon: 'success',
                    title: 'Form Reset',
                    text: 'All fields have been reset',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            }
        }
    </script>
</body>
</html>