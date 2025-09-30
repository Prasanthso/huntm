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
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        /* h2{
            color: var(--secondary-color)
        } */
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
        
        .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        }
        .badge-pmuy {
            background-color: #4CAF50;
            color: white;
        }
        .bade-due{
            background-color: #F44336;
            color: white;
        }
        .badge-non-pmuy {
            background-color: #2196F3;
            color: white;
        }
        .badge-missing {
            background-color: #f6c23e;
            color: #000;
        }
        .badge-active {
            background-color: #8BC34A;
            color: white;
        }
        .badge-suspended {
            background-color: #FFC107;
            color: black;
        }
        .badge-deactived {
            background-color: #F44336;
            color: white;
        }

        /* Back button */
        .back-btn {
            margin-top: 20px;
        }
        .save_btn{
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .save_btn:hover {
            background-color: #218838;
        }
        .save_btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(40,167,69,0.5);
        }
        .save_btn:active {
            transform: scale(0.98);
        }
        .save_btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
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

        /* Suggestion Form Styles */
        .suggest-form {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .image-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .image-section img {
            max-width: 50%;
            height: auto;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
            display: block;
        }

        .submit-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
            margin-left: 10px;
        }

        .back-btn:hover {
            background-color: #5c636a;
            transform: translateY(-2px);
        }

        .recording-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 0.9em;
        }

        .recording-btn1 {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        #timer {
            font-size: 0.9em;
            color: #6c757d;
            margin-top: 5px;
        }

        #status {
            font-size: 0.9em;
            margin-left: 10px;
        }

        
        /* Store Website style */
        
        .password-visible {
            font-size: 1.2rem;
            
            
            color: #28a745;
        }
        .password-icon {
            cursor: pointer;
            font-size: 1.2rem;
            color: #555;
        }
        .password-icon:hover {
            color: #28a745;
        }
        .password-icon:active {
            transform: scale(0.9);
        }   
        .password-icon:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(40,167,69,0.5);
        }

        .truncate-url {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
        }
        .btnautologin{
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btnautologin:hover {
            background-color: #218838;
        }

        .btn-details, .btn-edit, .btn-delete {
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-right: 5px;
        }
        .btn-details {
            background-color: #00f7ff;
            color: #000;
            box-shadow: 0 0 15px #00f7ff, 0 0 30px #00f7ff;
        }
        .btn-details:hover {
            background-color: #00d4ff;
            box-shadow: 0 0 20px #00f7ff, 0 0 40px #00f7ff;
        }
        .btn-edit {
            background-color: #ff9500;
            color: #000;
            box-shadow: 0 0 15px #ff9500, 0 0 30px #ff9500;
        }
        .btn-edit:hover {
            background-color: #ff8000;
            box-shadow: 0 0 20px #ff9500, 0 0 40px #ff9500;
        }
        .btn-delete {
            background-color: #ff0055;
            color: #fff;
            box-shadow: 0 0 15px #ff0055, 0 0 30px #ff0055;
        }
        .btn-delete:hover {
            background-color: #e6004c;
            box-shadow: 0 0 20px #ff0055, 0 0 40px #ff0055;
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

            .recording-controls{
                display: grid;
                grid-template-rows: repeat(2, 1fr);
                /* justify-content: center;
                align-items: center; */
                margin-top: 20px;
                gap: 10px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-card h6 {
                font-size: 0.9rem;
            }

            .dashboard-card p {
                font-size: 0.8rem;
            }
            .recording-controls{
                display: grid;
                grid-template-rows: repeat(2, 1fr);
                /* justify-content: center;
                align-items: center; */
                margin-top: 20px;
                gap: 10px;
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

        /* Whatsapp Icon Style */
        .whatsapp_icon {
            width: 40px;
            height: 40px;
            margin-right: 5px;
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
    </style>
</head>
<body>
    <?php 
    $userid = $this->session->userdata('user_id');
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
            Welcome! <?php echo $this->session->userdata('full_name'); ?>
        </div>
    </header>

    <!-- Sidebar -->
     
    <div id="sidebar" class="mt-0">
        <div class="list-group list-group-flush mt-2">
            <a href="<?php echo base_url('dashboard'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="<?php echo base_url('User/profile'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'profile') ? 'active' : ''; ?>">
                <i class="bi bi-pencil-square me-2"></i>Profile
            </a>
             <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="fileUploadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-upload me-2"></i>File Upload
                </a>
                <ul class="dropdown-menu" aria-labelledby="fileUploadDropdown">
                    <!-- <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#" id="backlogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-layer-group me-2"></i>Backlog
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('WebScrapping'); ?>">Invoice File Upload</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Process File Upload</a></li>
                        </ul>
                    </li> -->
                    <!-- <li><a class="dropdown-item" href="<?php echo base_url('fundbalance'); ?>"><i class="fas fa-wallet me-2"></i>Fund Balance</a></li> -->
                    <li><a class="dropdown-item" href="<?php echo base_url('customerregister'); ?>"><i class="fas fa-users me-2"></i>Customer Register</a></li>
                </ul>
            </div>

             <!-- <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="backlogDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-layer-group me-2"></i>Backlog
                </a>
                <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('invoiceorder'); ?>">Invoice Order Service Area</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('open-process-order'); ?>">Process Order Service Area</a></li>
                </ul>
            </div>  -->

            <a href="<?php echo base_url('submitsuggetions'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'suggestion') ? 'active' : ''; ?>">
                <i class="fas fa-lightbulb me-2"></i>Suggestion
            </a>
            <a href="<?php echo base_url('storewebsite'); ?>" class="list-group-item list-group-item-action <?php echo ($method == 'store_website') ? 'active' : ''; ?>">
                <i class="bi bi-key-fill me-2"></i>Website credentials
            </a>
            <!-- <div class="list-group-item p-0 dropdown">
                <a class="dropdown-toggle list-group-item list-group-item-action" href="#" role="button" id="websiteDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe me-2"></i>User Website
                </a>
                <ul class="dropdown-menu" aria-labelledby="websiteDropdown">
                    -- <li><a class="dropdown-item" href="<?php echo base_url('addwebsite'); ?>">Add Website</a></li> --
                    <li><a class="dropdown-item" href="<?php echo base_url('storewebsite'); ?>">Store Website</a></li>
                </ul>
            </div> -->
            
            <div class="logout-container mt-auto p-3">
                <a class="logout-btn" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
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
          <a href="<?= base_url('user/logout'); ?>" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
    <!-- Main Content -->
    <div class="main-content" id="mainContent">

        <?php if (isset($method)) { ?>
            <!-- Dashboard Section -->
            <?php if ($method == 'dashboard') { ?>
                <div class="container mt-1">
                    <div class="row">
                        <!-- BI Report Button Column -->
                        <div class="col-md-6">
                            <?php if (!empty($websites)): ?>
                                <?php $bi_website = reset($websites); ?>
                                <div class="mb-4 p-3 d-flex justify-content-end">
                                    <form class="scrape-form" action="<?php echo site_url('upload_bireport_file'); ?>" method="POST">
                                        <input type="hidden" name="url" value="<?php echo htmlspecialchars($bi_website['website_url']); ?>">
                                        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($bi_website['website_userId']); ?>">
                                        <input type="hidden" name="password" value="<?php echo htmlspecialchars($bi_website['website_password']); ?>">
                                        <button class="btn btn-primary" type="submit">BI Report</button>
                                        <div class="last-refresh text-muted small mt-2" style="display: none;">Last refreshed: <span class="refresh-time"></span></div>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- SDMS Report Button Column -->
                        <div class="col-md-6">
                            <?php if (!empty($websites)): ?>
                                <?php $sdms_website = reset($websites); ?>
                                <div class="mb-4 p-3 d-flex justify-content-end">
                                    <form class="scrape-form" action="<?php echo site_url('auto-login'); ?>" method="POST">
                                        <input type="hidden" name="url" value="<?php echo htmlspecialchars($sdms_website['website_url']); ?>">
                                        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($sdms_website['website_userId']); ?>">
                                        <input type="hidden" name="password" value="<?php echo htmlspecialchars($sdms_website['website_password']); ?>">
                                        <button class="btn btn-primary" type="submit">SDMS Report</button>
                                        <div class="last-refresh text-muted small mt-2" style="display: none;">Last refreshed: <span class="refresh-time"></span></div>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <!-- Include SweetAlert2 CSS and JS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    function getFormattedDateTime() {
                        const now = new Date();
                        return now.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: true
                        });
                    }

                    document.querySelectorAll('.scrape-form').forEach(form => {
                        // Determine which form this is (BI or SDMS)
                        const isBiReport = form.action.includes('upload_bireport_file');
                        const storageKey = isBiReport ? 'lastRefreshTimeBI' : 'lastRefreshTimeSDMS';
                        
                        form.addEventListener('submit', async (e) => {
                            e.preventDefault();

                            const wrapper = form.closest('.mb-4');
                            const refreshDiv = wrapper.querySelector('.last-refresh');
                            const refreshTimeSpan = wrapper.querySelector('.refresh-time');

                            // Show loading popup
                            Swal.fire({
                                title: 'Processing',
                                text: 'Scraping data, please wait...',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            const formData = new FormData(form);

                            try {
                                const response = await fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                const contentType = response.headers.get("content-type") || "";
                                if (!contentType.includes("application/json")) {
                                    const text = await response.text();
                                    throw new Error("Invalid response format (not JSON): " + text.slice(0, 100));
                                }

                                const result = await response.json();
                                console.log(result);

                                Swal.close(); // Close loading popup

                                console.log(result.status);

                                if (result.status === 'success') {
                                    const now = getFormattedDateTime();
                                    refreshTimeSpan.textContent = now;
                                    refreshDiv.style.display = 'block';
                                    localStorage.setItem(storageKey, now);
                                    
                                    // Show success popup
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: result.message,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        showConfirmButton: false
                                    });
                                } else {
                                    // Show error popup
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.message
                                    });
                                }
                            } catch (error) {
                                Swal.close(); // Close loading popup
                                // Show error popup
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: error.message
                                });
                            }
                        });

                        // Load last refresh time if available
                        const wrapper = form.closest('.mb-4');
                        const refreshDiv = wrapper.querySelector('.last-refresh');
                        const refreshTimeSpan = wrapper.querySelector('.refresh-time');
                        const lastRefresh = localStorage.getItem(storageKey);
                        if(lastRefresh) {
                            refreshTimeSpan.textContent = lastRefresh;
                            refreshDiv.style.display = 'block';
                        }
                    });
                </script>
                                        
                <div class="container-fluid">
                    <h1 class="mb-4">Dashboard Overview</h1>

                    <div class="row g-4">
                        <!-- Backlog Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-light" onclick="window.location.href='invoiceorder'">
                                <div class="card-body">
                                    <h6><i class="fas fa-users me-2"></i> Backlog</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p>Total Area : <?php echo $sdsms_stats['total'] ?? 0; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fund Balance Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-info bg-opacity-10">
                                <div class="card-body">
                                    <h6><i class="fas fa-wallet me-2"></i> Fund Balance</h6>
                                    <p>Rs:(363,010.10)</p>
                                    <p>Remark : Risk category-IOCL</p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-info bg-opacity-10">
                                <div class="card-body">
                                    <h6><i class="bi bi-pencil-square me-2"></i> Remark</h6>
                                    <p>IOCL</p>
                                </div>
                            </div>
                        </div> -->
                        
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
                                    // Safely access the data with proper null checks
                                    $sbc_total = $sbc_counts['total']['total'] ?? 0;
                                    $customer_total = $customer_data['total']['total'] ?? 0;
                                    
                                    // Ensure both values are numeric before calculations
                                    $sbc_total = is_numeric($sbc_total) ? $sbc_total : 0;
                                    $customer_total = is_numeric($customer_total) ? $customer_total : 0;

                                    if ($sbc_total > 0 && $customer_total > 0) {
                                        $sbc_percent = round(($sbc_total / $customer_total) * 100);
                                        echo '<p>Total: ' . number_format($sbc_total) . '</p>';
                                        echo '<p>Percent: ' . $sbc_percent . '%</p>';
                                    } else {
                                        echo '<p>No SBC data found</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Nil Refill Card -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card dashboard-card bg-danger bg-opacity-10" onclick="window.location.href='<?php echo base_url('nillfill'); ?>'">
                                <div class="card-body">
                                    <h6><i class="fas fa-calendar-times me-2"></i> Nil Refill</h6>
                                    <!-- <pre><?php print_r($stats); ?></pre> -->
                                    <?php
                                    // Safely access the data with proper null checks
                                    $gt3 = $stats['data']['overall_total']['greater_than_3_months']['total']['qty'] ?? 0;
                                    $gt6 = $stats['data']['overall_total']['greater_than_6_months']['total']['qty'] ?? 0;
                                    $gt1 = $stats['data']['overall_total']['greater_than_1_year']['total']['qty'] ?? 0;
                                    $nil_total = $gt3 + $gt6 + $gt1;
                                    $customer_total = $customer_data['total']['total'] ?? 0;
                                    // echo "abcdefghijklmnopqrstuvwxyzabcdefgh ".$stats['overall_total']['greater_than_3_months']['total'];
                                    // Ensure both values are numeric before calculations
                                    $nil_total = is_numeric($nil_total) ? $nil_total : 0;
                                    $customer_total = is_numeric($customer_total) ? $customer_total : 0;

                                    if ($nil_total > 0 && $customer_total > 0) {
                                        $nil_percent = round(($nil_total / $customer_total) * 100);
                                        echo '<p>Total: ' . number_format($nil_total) . '</p>';
                                        echo '<p>Percent: ' . $nil_percent . '%</p>';
                                    } else {
                                        echo '<p>No NIL REFILL data found</p>';
                                    }
                                    ?>
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
                                <?php if (!empty($hose_stats) && is_array($hose_stats) && isset($hose_stats['total']['qty']) && isset($hose_stats['total']['percent'])): ?>
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
                <?php } elseif($method == 'profile') { ?>
                <section class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h2 class="h4 mb-0"><i class="fas fa-user-cog text-dark me-2"></i>Profile Management</h2>
                        </div>
                    </div>
                </section>

                <section class="row">
    <div class="col-lg-8" style="max-width: 100%; width:100%;">
        <div class="card shadow-sm">
            <div class="card-body">

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('info')): ?>
                    <div class="alert alert-info alert-dismissible fade show mb-4">
                        <?php echo $this->session->flashdata('info'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form id="profileForm" method="post" action="<?php echo base_url('user/add'); ?>">

                    <div class="mb-4">
                        <h5 class="mb-3 border-bottom pb-2">
                            <i class="fas fa-user me-2 text-dark" style="color: rgba(10, 81, 127, 1);"></i>
                            Personal Information
                        </h5>

                        <section class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" id="full_name" name="full_name" 
                                        value="<?php echo htmlspecialchars($distributor_data->full_name ?? ''); ?>" 
                                        placeholder="Full Name" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" 
                                        value="<?php echo htmlspecialchars($distributor_data->Email ?? ''); ?>" 
                                        placeholder="Email" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="phone">Whatsapp Number <span class="text-danger">*</span></label>
                                    <input type="tel" id="phone" name="phone" maxlength="10"
                                        class="<?php echo form_error('phone') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('phone', htmlspecialchars($distributor_data->phone ?? '')); ?>"
                                        placeholder="10 digits only" required
                                        oninput="validatePhone(this)">
                                    <div class="invalid-feedback" id="phone-error"><?php echo form_error('phone'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="sap_code">SAP Code <span class="text-danger">*</span> </label>
                                    <input type="text" id="sap_code" name="sap_code"
                                        class="<?php echo form_error('sap_code') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('sap_code', htmlspecialchars($distributor_data->sap_code ?? '')); ?>"
                                        placeholder="SAP Code"
                                        oninput="validateSapCode(this)">
                                    <div class="invalid-feedback" id="sap_code-error"><?php echo form_error('sap_code'); ?></div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3 border-bottom pb-2">
                            <i class="fas fa-university me-2 text-dark"></i>Bank Details
                        </h5>

                        <section class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="account_holder_name">Account Holder Name <span class="text-danger">*</span></label>
                                    <input type="text" id="account_holder_name" name="account_holder_name"
                                        class="<?php echo form_error('account_holder_name') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('account_holder_name', htmlspecialchars($distributor_data->account_holder_name ?? '')); ?>"
                                        placeholder="Account Holder Name"
                                        oninput="validateAccountHolderName(this)">
                                    <div class="invalid-feedback" id="account_holder_name-error"><?php echo form_error('account_holder_name'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                    <input type="text" id="account_number" name="account_number" maxlength="18"
                                        class="<?php echo form_error('account_number') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('account_number', htmlspecialchars($distributor_data->account_number ?? '')); ?>"
                                        placeholder="Maximum 18 digits"
                                        oninput="validateAccountNumber(this)">
                                    <div class="invalid-feedback" id="account_number-error"><?php echo form_error('account_number'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="ifsc_code">IFSC Code <span class="text-danger">*</span></label>
                                    <input type="text" id="ifsc_code" name="ifsc_code"
                                        class="<?php echo form_error('ifsc_code') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('ifsc_code', htmlspecialchars($distributor_data->ifsc_code ?? '')); ?>"
                                        placeholder="IFSC Code"
                                        oninput="validateIfscCode(this)">
                                    <div class="invalid-feedback" id="ifsc_code-error"><?php echo form_error('ifsc_code'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" id="bank_name" name="bank_name"
                                        class="<?php echo form_error('bank_name') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('bank_name', htmlspecialchars($distributor_data->bank_name ?? '')); ?>"
                                        placeholder="Bank Name"
                                        oninput="validateBankName(this)">
                                    <div class="invalid-feedback" id="bank_name-error"><?php echo form_error('bank_name'); ?></div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3 border-bottom pb-2">
                            <i class="fas fa-map-marker-alt me-2 text-dark"></i>Address Details
                        </h5>

                        <div class="form-group-custom mb-3">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea id="address" name="address" rows="3" required
                                class="<?php echo form_error('address') ? 'is-invalid' : ''; ?>"
                                placeholder="Enter your address"
                                oninput="validateAddress(this)"><?php echo set_value('address', htmlspecialchars($distributor_data->address ?? '')); ?></textarea>
                            <div class="invalid-feedback" id="address-error"><?php echo form_error('address'); ?></div>
                        </div>

                        <section class="row">
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label for="pin_code">Pin Code <span class="text-danger">*</span></label>
                                    <input type="text" id="pin_code" name="pin_code" maxlength="6"
                                        class="<?php echo form_error('pin_code') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('pin_code', htmlspecialchars($distributor_data->pin_code ?? '')); ?>"
                                        placeholder="6 digits only" required
                                        oninput="validatePinCode(this)">
                                    <div class="invalid-feedback" id="pin_code-error"><?php echo form_error('pin_code'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label for="city">City <span class="text-danger">*</span></label>
                                    <input type="text" id="city" name="city"
                                        class="<?php echo form_error('city') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('city', htmlspecialchars($distributor_data->city ?? '')); ?>"
                                        placeholder="City" required
                                        oninput="validateCity(this)">
                                    <div class="invalid-feedback" id="city-error"><?php echo form_error('city'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label for="office_mobile">Office Mobile <span class="text-danger">*</span></label>
                                    <input type="text" id="office_mobile" name="office_mobile" maxlength="10"
                                        class="<?php echo form_error('office_mobile') ? 'is-invalid' : ''; ?>"
                                        value="<?php echo set_value('office_mobile', htmlspecialchars($distributor_data->office_mobile ?? '')); ?>"
                                        placeholder="10 digits only"
                                        oninput="validateOfficeMobile(this)">
                                    <div class="invalid-feedback" id="office_mobile-error"><?php echo form_error('office_mobile'); ?></div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<script>
// Function to validate phone number
function validatePhone(input) {
    const errorElement = document.getElementById('phone-error');
    const phonePattern = /^[0-9]{10}$/;
    
    if (input.value.trim() === '') {
        input.classList.add('is-invalid');
        errorElement.textContent = 'Whatsapp number is required';
        return false;
    } else if (!phonePattern.test(input.value)) {
        input.classList.add('is-invalid');
        errorElement.textContent = 'Please enter a valid 10-digit number';
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
        errorElement.textContent = 'Office mobile number is required';
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
.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.is-invalid {
    border-color: #dc3545 !important;
}


</style>

            <!-- Other sections would follow the same responsive pattern -->
            <?php } elseif ($method == 'invoice_order') { ?>
                <div class="container">
                    <div class="form-container">
                        <h2 class="text-center text-dark mb-4">Upload Invoice Order Data</h2>

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
                            <button type="submit" class="btn btn-primary save_btn">Upload</button>
                        </form>
                    </div>
                </div>

                <?php } elseif ($method == 'open_order') { ?>
                    <div class="container">
                        <div class="form-container">
                            <h2 class="text-center text-dark mb-4">Upload Open Order Data</h2>
                            
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
                                <!-- <div class="d-grid">
                                    <button type="submit" class="btn btn-primary save_btn w-20">Upload</button>
                                </div> -->
                                <button type="submit" class="btn btn-primary save_btn">Upload</button>
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
                                    <!-- <div class="d-grid">
                                        <button type="submit" class="btn btn-primary save_btn">Upload File</button>
                                    </div> -->
                                    <button type="submit" class="btn btn-primary save_btn">Upload</button>
                                </form>
                            </div>
                        </div>
                    
                        <?php } elseif ($method == 'customer_register') { ?>
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
                                    <button type="submit" class="btn btn-primary save_btn">Upload</button>
                                </form>
                            </div>
                        </div>

                <!-- display open process data in website -->
                <?php } elseif ($method == 'sdms_report') { ?>
                    <div class="container">
                        <div class="dashboard-back-btn">
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                        <h2 class="text-center mb-4">Invoice Order Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table id="invoiceTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Area Name</th>
                                        <th>Cashmemo Generated</th>
                                        <th>Status</th>
                                        <th>Open Refill Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($orders)): ?>
                                        <?php foreach ($orders as $index => $order): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($order['area_name']); ?></td>
                                                <td><?php echo htmlspecialchars($order['cashmemo_generated']); ?></td>
                                                <td><?php echo htmlspecialchars($order['status']); ?></td>
                                                <td><?php echo htmlspecialchars($order['open_refill_orders'] ?? 'N/A'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No records found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination - Exactly as you requested -->
                        <nav>
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item" id="prevPage"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                <li class="page-item"><a class="page-link" id="currentPage">1-10</a></li>
                                <li class="page-item" id="nextPage"><a class="page-link" href="javascript:void(0)">Next</a></li>
                            </ul>
                        </nav>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const table = document.getElementById('invoiceTable');
                            const rows = Array.from(table.querySelectorAll('tbody tr'));
                            const rowsPerPage = 10;
                            let currentPage = 1;
                            const totalPages = Math.max(1, Math.ceil(rows.length / rowsPerPage));
                            
                            // Pagination elements
                            const currentPageElement = document.getElementById('currentPage');
                            const prevButton = document.getElementById('prevPage');
                            const nextButton = document.getElementById('nextPage');
                            
                            function updatePagination() {
                                // Calculate range to show
                                const start = (currentPage - 1) * rowsPerPage + 1;
                                const end = Math.min(start + rowsPerPage - 1, rows.length);
                                
                                // Update current page display with range (e.g., "1-10")
                                currentPageElement.textContent = rows.length > 0 ? `${start}-${end}` : '0-0';
                                
                                // Toggle disabled state
                                if (currentPage === 1) {
                                    prevButton.classList.add('disabled');
                                } else {
                                    prevButton.classList.remove('disabled');
                                }
                                
                                if (currentPage === totalPages || rows.length === 0) {
                                    nextButton.classList.add('disabled');
                                } else {
                                    nextButton.classList.remove('disabled');
                                }
                                
                                // Show/hide rows
                                rows.forEach((row, index) => {
                                    row.style.display = (index >= start - 1 && index < end) ? '' : 'none';
                                });
                            }
                            
                            // Event listeners
                            prevButton.addEventListener('click', function() {
                                if (currentPage > 1) {
                                    currentPage--;
                                    updatePagination();
                                }
                            });
                            
                            nextButton.addEventListener('click', function() {
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    updatePagination();
                                }
                            });
                            
                            // Initialize
                            updatePagination();
                        });
                    </script>

                <!-- display open process data in website -->
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
                                        <td colspan="3" class="text-center">No records found.</td> <!-- Adjust colspan to 3 due to new column -->
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                                </div>
                    </div>
                   
                    <!-- Suggestion Section -->
                <?php } elseif ($method == 'suggestion') { ?>
                    <div class="container">
                        <div class="suggest-form">
                            <div class="image-section"> 
                                <img src="<?php echo base_url(); ?>Image/suggestion-image.jpg" alt="Suggestion" class="img-fluid">
                                <!-- <img src="Image/suggestion-image.jpg" alt="Suggestion" class="img-fluid">  -->
                            </div>
                            <form id="suggestionForm" method="post" action="<?= base_url('submitsuggetions'); ?>">
                                <h2 class="text-center mb-4">Submit Your Suggestion</h2>
                                
                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" id="anonymous" name="anonymous">
                                    <label class="form-check-label" for="anonymous">Submit Anonymously</label>
                                </div>

                                <div id="alertContainer"></div>
                                
                                <div class="form-group">
                                    <select name="application" class="form-control validate" id="application" required>
                                        <option value="">Application</option>
                                        <option value="SDMS">SDMS</option>
                                        <option value="BI Report">BI Report</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <span class="error" id="applicationError"></span>
                                </div>

                                <div class="form-group">
                                    <select name="suggestion_type" class="form-control validate" id="suggestion_type" required>
                                        <option value="">Suggestion Type</option>
                                        <option value="Change">Change</option>
                                        <option value="Suggestion">Suggestion</option>
                                    </select>
                                    <span class="error" id="suggestionTypeError"></span>
                                </div>

                                <div class="form-group">
                                    <textarea name="message" class="form-control validate" id="message" rows="5" placeholder="Enter your message" required></textarea>
                                    <span class="error" id="messageError"></span>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex flex-wrap align-items-center mb-2 recording-controls">
                                        <button type="button" onclick="startRecording()" class="recording-btn">
                                            <i class="fas fa-microphone"></i> Start Recording
                                        </button>
                                        <button type="button" onclick="stopRecording()" class="recording-btn1">
                                            <i class="fas fa-stop"></i> Stop Recording
                                        </button>
                                        <span id="status" class="ms-2">Ready to record</span>
                                    </div>
                                    <div id="timer">00:00</div>
                                    <audio id="audioPlayback" controls style="display:none; width: 100%; margin-top: 10px;"></audio>
                                    <input type="hidden" id="audioData" name="audioData">
                                    <span class="error" id="voiceMessageError"></span>
                                </div>

                                <div id="generalError" class="alert alert-danger" style="display: none;"></div>

                                <div class="d-flex flex-wrap">
                                    <button type="submit" class="submit-btn">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- <?php } elseif ($method == 'add_website') { ?>
                        <div class="form-container">
                        <h2 class="text-center text-dark mb-3"><i class="fas fa-globe"></i> Add Website</h>
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
                            <button type="submit" class="btn btn-primary save_btn">Save</button>
                        </form>
                    </div> -->
                    <!-- Display and store website -->
                <?php } elseif ($method == 'store_website') { ?>
                <div class="container">
                    <h2 class="text-center mb-4"><i class="bi bi-shop me-2"></i>Stored Websites</h2>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($this->session->flashdata('errors') as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="container">
                        <div class="d-flex justify-content-start mb-3">
                            <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addWebsiteModal">
                                <i class="bi bi-plus-circle me-2"></i>Add Website
                            </button>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th>Website URL</th>
                                    <th>Website Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($websites)): ?>
                                    <?php foreach ($websites as $website): ?>
                                        <tr>
                                            <td>
                                                <span class="truncate-url"><?php echo htmlspecialchars($website['website_url']); ?></span>
                                                <button class="btn-copy" onclick="copyToClipboard('<?php echo htmlspecialchars($website['website_url']); ?>')">📋</button>
                                            </td>
                                            <td><?php echo htmlspecialchars($website['selectwebsitename']); ?></td>
                                            <td><?php echo htmlspecialchars($website['website_userId']); ?></td>
                                            <td class="password-hidden"><?php echo htmlspecialchars($website['website_password']); ?></td>
                                            
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editWebsiteModal" 
                                                    onclick="populateEditModal('<?php echo $website['website_id']; ?>', '<?php echo htmlspecialchars($website['website_userId']); ?>', '')">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteWebsiteModal"
                                                    onclick="setDeleteWebsiteId('<?php echo $website['website_id']; ?>')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Website Modal -->
                    <div class="modal fade" id="addWebsiteModal" tabindex="-1" aria-labelledby="addWebsiteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addWebsiteModalLabel">Add New Website</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo site_url('addwebsite'); ?>" method="POST">
                                    <div class="modal-body">
                                        <?php if ($this->session->flashdata('errors')): ?>
                                            <div class="alert alert-danger">
                                                <?php foreach ($this->session->flashdata('errors') as $error): ?>
                                                    <p><?php echo $error; ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label for="addWebsiteUrl" class="form-label">Website URL</label>
                                            <input type="url" class="form-control" id="addWebsiteUrl" name="url" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addWebsiteUserId" class="form-label">UserID</label>
                                            <input type="text" class="form-control" id="addWebsiteUserId" name="userId" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addWebsitePassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="addWebsitePassword" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="selectWebsiteName" class="form-label">Select Website</label>
                                            <select name="selectwebsitename" id="selectWebsiteName" class="form-control" required>
                                                <option value="" disabled selected>Select a website</option>
                                                <option value="SDSM">SDSM</option>
                                                <option value="BI">BI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Website</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Website Modal -->
                    <div class="modal fade" id="editWebsiteModal" tabindex="-1" aria-labelledby="editWebsiteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editWebsiteModalLabel">Edit Website</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo site_url('edit-website'); ?>" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" id="editWebsiteId" name="website_id">
                                        
                                        <div class="mb-3">
                                            <label for="editWebsiteUrl" class="form-label">Website URL</label>
                                            <input type="text" class="form-control" id="editWebsiteUrl" name="url" value="<?php echo htmlspecialchars($website['website_url']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="editWebsiteUserId" class="form-label">UserID</label>
                                            <input type="text" class="form-control" id="editWebsiteUserId" name="userId" value="<?php echo htmlspecialchars($website['website_userId']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="editWebsitePassword1" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="editWebsitePassword1" name="password" value="<?php echo $website['website_password']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="editwebsitename" class="form-label">Website Name</label>
                                            <input type="text" class="form-control" id="editwebsitename" name="selectwebsitename" value="<?php echo htmlspecialchars($website['selectwebsitename']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Website Modal -->
                    <div class="modal fade" id="deleteWebsiteModal" tabindex="-1" aria-labelledby="deleteWebsiteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteWebsiteModalLabel">Delete Website</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?php echo site_url('delete-website'); ?>" method="POST">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this website?</p>
                                        <input type="hidden" id="deleteWebsiteId" name="website_id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    function populateEditModal(websiteId, userId, password) {
                        document.getElementById('editWebsiteId').value = websiteId;
                        document.getElementById('editWebsiteUserId').value = userId;
                        document.getElementById('editWebsitePassword').value = password;
                    }

                    function setDeleteWebsiteId(websiteId) {
                        document.getElementById('deleteWebsiteId').value = websiteId;
                    }

                    function copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(() => {
                            alert('URL copied to clipboard!');
                        });
                    }

                    function copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(function() {
                            alert('URL copied to clipboard!');
                        }, function(err) {
                            console.error('Could not copy text: ', err);
                        });
                    }

                    function checkScrapeStatus(jobId) {
                        $.getJSON('<?php echo site_url("WebsiteDetails/check_scrape_status"); ?>?job_id=' + jobId, function(response) {
                            if (response.status === 'completed') {
                                displayScrapeResults(response.result);
                            } else if (response.status === 'error') {
                                alert('Scraping failed: ' + response.error);
                            } else if (response.status === 'not_found') {
                                alert('Scraping job not found.');
                            } else {
                                setTimeout(function() { checkScrapeStatus(jobId); }, 5000);
                            }
                        }).fail(function() {
                            alert('Failed to check scraping status. Please try again later.');
                        });
                    }

                    function displayScrapeResults(result) {
                        $('#invoiced-orders-table thead').empty();
                        $('#invoiced-orders-table tbody').empty();
                        $('#open-orders-table thead').empty();
                        $('#open-orders-table tbody').empty();

                        if (result.invoiced_orders && result.invoiced_orders.length > 0) {
                            const invoicedOrders = result.invoiced_orders;
                            const headers = Object.keys(invoicedOrders[0]);

                            let headerRow = '<tr>';
                            headers.forEach(header => {
                                headerRow += `<th>${header}</th>`;
                            });
                            headerRow += '</tr>';
                            $('#invoiced-orders-table thead').append(headerRow);

                            invoicedOrders.forEach(order => {
                                let row = '<tr>';
                                headers.forEach(header => {
                                    row += `<td>${order[header] || 'N/A'}</td>`;
                                });
                                row += '</tr>';
                                $('#invoiced-orders-table tbody').append(row);
                            });

                            $('#invoiced-orders').show();
                        } else {
                            $('#invoiced-orders-table tbody').append('<tr><td colspan="3">No invoice orders found.</td></tr>');
                            $('#invoiced-orders').show();
                        }

                        if (result.open_orders && result.open_orders.length > 0) {
                            const openOrders = result.open_orders;
                            const headers = Object.keys(openOrders[0]);

                            let headerRow = '<tr>';
                            headers.forEach(header => {
                                headerRow += `<th>${header}</th>`;
                            });
                            headerRow += '</tr>';
                            $('#open-orders-table thead').append(headerRow);

                            openOrders.forEach(order => {
                                let row = '<tr>';
                                headers.forEach(header => {
                                    row += `<td>${order[header] || 'N/A'}</td>`;
                                });
                                row += '</tr>';
                                $('#open-orders-table tbody').append(row);
                            });

                            $('#open-orders').show();
                        } else {
                            $('#open-orders-table tbody').append('<tr><td colspan="2">No open orders found.</td></tr>');
                            $('#open-orders').show();
                        }

                        $('#scraped-data').show();
                    }

                    $(document).ready(function() {
                        $('#scraped-data').hide();
                        $('#invoiced-orders').hide();
                        $('#open-orders').hide();

                        var jobId = '<?php echo $this->session->flashdata("job_id"); ?>';
                        if (jobId) {
                            checkScrapeStatus(jobId);
                        }
                    });
                </script>
                    
                <!---------------------------- Customer Strenght Data  -------------------------------------------------------- -->
                <?php } elseif($method == 'customer_strength') { ?>
                <div class="dashboard-back-btn">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
                <div class="container4">
                    <!-- Fixed Summary Section -->
                    <div class="sbc_summary">
                        <h2 class="text-center mb-4">Customer Strength Data</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered summary-table" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="summaryTableBody">
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
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
                                <table class="table table-bordered area-table">
                                    <thead>
                                        <tr>
                                            <th>Area Name</th>
                                            <th>Total Customers</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Customer Details Table -->
                        <div id="customerDetailsView" style="display: none;" class="sbc_customer_details">
                            <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                            <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table_area">
                                    <thead>
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
                                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        // Pagination variables
                        let currentPage = 1;
                        let currentAreaPage = 1;
                        const recordsPerPage = 10;
                        
                        // Data variables
                        let allCustomers = <?= json_encode($customers ?? []) ?>;
                        let filteredCustomers = [];
                        let areaBreakdownData = [];
                        let currentScheme = null;
                        let currentStatus = null;
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
                            // Ensure allCustomers is an array
                            if (!Array.isArray(allCustomers)) {
                                allCustomers = [];
                                return;
                            }
                            
                            allCustomers.forEach(customer => {
                                // Normalize status to uppercase, default to 'ACTIVE'
                                customer.Consumer_Sub_Status = (customer.Consumer_Sub_Status || 'ACTIVE').toUpperCase();
                                
                                // Normalize scheme based on model logic
                                if (customer.Scheme_Selected === 'PMUY' || customer.Scheme_Selected === 'Ujjwala' || customer.Scheme_Selected === 'Ujjwala - Extended') {
                                    customer.Scheme_Selected = 'PMUY';
                                } else {
                                    customer.Scheme_Selected = 'NON_PMUY';
                                }
                                
                                // Default Area_Name to 'Unknown'
                                customer.Area_Name = customer.Area_Name || 'Unknown';
                            });
                        }

                        function showAreaBreakdown(status, scheme) {
                            currentStatus = status;
                            currentScheme = scheme;
                            
                            // Filter customers based on status and scheme
                            filteredCustomers = allCustomers.filter(customer => {
                                const statusMatch = (status === 'ALL') ? true : customer.Consumer_Sub_Status === status;
                                const schemeMatch = (scheme === 'ALL') ? true : customer.Scheme_Selected === scheme;
                                return statusMatch && schemeMatch;
                            });
                            
                            // Calculate area breakdown
                            const areaStats = {};
                            filteredCustomers.forEach(customer => {
                                const area = customer.Area_Name;
                                if (!areaStats[area]) {
                                    areaStats[area] = 0;
                                }
                                areaStats[area]++;
                            });
                            
                            // Convert to array and sort
                            areaBreakdownData = Object.keys(areaStats).map(area => ({
                                area: area,
                                total: areaStats[area]
                            })).sort((a, b) => b.total - a.total);
                            
                            // Update UI
                            $('#areaBreakdownTitle').text(`Customer Distribution (${status} - ${scheme}) by Area`);
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();
                            
                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                            $('.content-section').scrollTop(0);
                        }

                         // Not show an tooltip this below code

                        // function updateAreaBreakdownTable() {
                        //     const start = (currentAreaPage - 1) * recordsPerPage;
                        //     const end = Math.min(start + recordsPerPage, areaBreakdownData.length);
                        //     const pageAreas = areaBreakdownData.slice(start, end);
                        //     const tableBody = $("#areaBreakdownBody");
                            
                        //     tableBody.empty();
                            
                        //     if (pageAreas.length === 0) {
                        //         tableBody.html('<tr><td colspan="2" class="text-center">No data available</td></tr>');
                        //     } else {
                        //         pageAreas.forEach(item => {
                        //             tableBody.append(`
                        //                 <tr>
                        //                     <td class="clickabled area-click" data-area="${item.area}">${item.area}</td>
                        //                     <td>${item.total}</td>
                        //                     <td>
                        //                         <a href="#" class="clickabled" style="text-decoration: none;">
                        //                         <img src="<?= base_url('Image/w1.png') ?>" alt="WhatsApp" class="whatsapp_icon" style=" width: 40px; height: 40px;">
                        //                         Whatsapp
                        //                         </a>
                        //                     </td>
                        //                 </tr>
                        //             `);
                        //         });
                        //     }
                            
                        //     // Update pagination info
                        //     $("#areaPageInfo").text(`${start + 1} - ${end} of ${areaBreakdownData.length}`);
                        //     $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                        //     $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
                        // }

                        function updateAreaBreakdownTable() {
                            const start = (currentAreaPage - 1) * recordsPerPage;
                            const end = Math.min(start + recordsPerPage, areaBreakdownData.length);
                            const pageAreas = areaBreakdownData.slice(start, end);
                            const tableBody = $("#areaBreakdownBody");
                            
                            tableBody.empty();
                            
                            if (pageAreas.length === 0) {
                                tableBody.html('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageAreas.forEach(item => {
                                    tableBody.append(`
                                        <tr>
                                            <td class="clickabled area-click" data-area="${item.area}">${item.area}</td>
                                            <td>${item.total}</td>
                                            
                                        </tr>
                                    `);
                                });
                            }
                            
                            // Update pagination info
                            $("#areaPageInfo").text(`${start + 1} - ${end} of ${areaBreakdownData.length}`);
                            $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                            $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
                        }

                        // Tooltip logic
                        document.addEventListener("mouseover", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltipText = e.target.getAttribute("data-tooltip");
                                const tooltip = document.createElement("div");
                                tooltip.className = "custom-tooltip";
                                tooltip.innerText = tooltipText;
                                document.body.appendChild(tooltip);

                                tooltip.style.position = "absolute";
                                tooltip.style.background = "#333";
                                tooltip.style.color = "#fff";
                                tooltip.style.padding = "5px 8px";
                                tooltip.style.borderRadius = "4px";
                                tooltip.style.fontSize = "12px";
                                tooltip.style.pointerEvents = "none";
                                tooltip.style.zIndex = "9999";

                                const rect = e.target.getBoundingClientRect();
                                tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 8}px`;
                                tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
                            }
                        });

                        document.addEventListener("mouseout", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltip = document.querySelector(".custom-tooltip");
                                if (tooltip) tooltip.remove();
                            }
                        });


                        function showCustomerDetails(area) {
                            currentArea = area;
                            
                            // Filter customers by area, status, and scheme
                            filteredCustomers = allCustomers.filter(customer => {
                                const areaMatch = customer.Area_Name === area;
                                const statusMatch = (currentStatus === 'ALL') ? true : customer.Consumer_Sub_Status === currentStatus;
                                const schemeMatch = (currentScheme === 'ALL') ? true : customer.Scheme_Selected === currentScheme;
                                return areaMatch && statusMatch && schemeMatch;
                            });
                            
                            currentPage = 1;
                            $('#customerDetailsTitle').text(`Customers (${currentStatus} - ${currentScheme}) in ${area}`);
                            updateCustomerTable();
                            
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').show();
                            $('.content-section').scrollTop(0);
                        }

                        function updateCustomerTable() {
                            const start = (currentPage - 1) * recordsPerPage;
                            const end = Math.min(start + recordsPerPage, filteredCustomers.length);
                            const pageRows = filteredCustomers.slice(start, end);
                            const tableBody = $("#customerTableBody");
                            
                            tableBody.empty();
                            
                            if (pageRows.length === 0) {
                                tableBody.html('<tr><td colspan="6" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageRows.forEach(customer => {
                                    const schemeClass = customer.Scheme_Selected === 'PMUY' ? 'badge bg-success' : 'badge bg-primary';
                                    const statusClass = customer.Consumer_Sub_Status === 'ACTIVE' ? 'badge-active' : 
                                                    customer.Consumer_Sub_Status === 'SUSPENDED' ? 'badge-suspended' : 'badge-deactived';
                                    
                                    tableBody.append(`
                                        <tr>
                                            <td>${customer.Area_Name || 'N/A'}</td>
                                            <td>${customer.Consumer_Number || 'N/A'}</td>
                                            <td>${customer.Consumer_Name || 'N/A'}</td>
                                            <td>${customer.Phone_Number || 'N/A'}</td>
                                            <td><span class="badge ${schemeClass}">${customer.Scheme_Selected || 'N/A'}</span></td>
                                            <td><span class="badge ${statusClass}">${customer.Consumer_Sub_Status || 'N/A'}</span></td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            // Update pagination info
                            $("#customerPageInfo").text(`${start + 1} - ${end} of ${filteredCustomers.length}`);
                            $("#prevPage").toggleClass("disabled", currentPage === 1);
                            $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
                        }

                        // Event handlers
                        $(document).on('click', '.clickabled[data-status][data-scheme]', function() {
                            const status = $(this).data('status');
                            const scheme = $(this).data('scheme');
                            showAreaBreakdown(status, scheme);
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
                            showAreaBreakdown(currentStatus, currentScheme);
                        });
                    });
                </script>
                <!---------------------------- SBC Data  -------------------------------------------------------- -->
                <?php } elseif($method == 'sbc_data_display') { ?>
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
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="summaryTableBody">
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
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
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerTableBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        let currentStatus = null;
                        let currentArea = null;

                        // WhatsApp sending variables for large volumes
                        let isSending = false;
                        let currentBatch = 0;
                        let totalBatches = 0;
                        let totalCustomers = 0;
                        let successCount = 0;
                        let failCount = 0;
                        let startTime = null;
                        let pauseSending = false;

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
                                customer.consumer_status = (customer.Consumer_Sub_Status || 'ACTIVE').toUpperCase();
                                const scheme = (customer.Scheme_Selected || '').toUpperCase().trim();
                                customer.Scheme_Selected = scheme == 'NON_PMUY' ? 'NON_PMUY' : 'PMUY';
                                customer.Area_Name = customer.Area_Name || 'Unknown';
                            });
                        }

                        function showAreaBreakdown(status, scheme) {
                            currentStatus = status;
                            currentScheme = scheme;
                            
                            filteredCustomers = allCustomers.filter(customer => {
                                const statusMatch = (status === 'ALL') ? true : customer.consumer_status === status;
                                const schemeMatch = (scheme === 'ALL') ? true :
                                                (scheme === 'PMUY') ? customer.Scheme_Selected === 'PMUY' :
                                                customer.Scheme_Selected === 'NON_PMUY';
                                
                                return statusMatch && schemeMatch;
                            });
                            
                            const areaStats = {};
                            filteredCustomers.forEach(customer => {
                                const area = customer.Area_Name;
                                areaStats[area] = (areaStats[area] || 0) + 1;
                            });
                            
                            areaBreakdownData = Object.entries(areaStats)
                                .map(([area, count]) => ({ area, total: count }))
                                .sort((a, b) => b.total - a.total);
                            
                            $('#areaBreakdownTitle').text(`SBC Connections (${status} - ${scheme}) by Area`);
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();
                            
                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                            $('.content-section').scrollTop(0);
                        }

                        function updateAreaBreakdownTable() {
                            const start = (currentAreaPage - 1) * recordsPerPage;
                            const end = Math.min(start + recordsPerPage, areaBreakdownData.length);
                            const pageAreas = areaBreakdownData.slice(start, end);
                            const tableBody = $("#areaBreakdownBody");
                            
                            tableBody.empty();
                            
                            if (pageAreas.length === 0) {
                                tableBody.html('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageAreas.forEach(({ area, total }) => {
                                    tableBody.append(`
                                        <tr>
                                            <td class="clickabled area-click" data-area="${area}">${area}</td>
                                            <td>${total}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm send-whatsapp-batch" 
                                                    data-status="${currentStatus}" 
                                                    data-scheme="${currentScheme}" 
                                                    data-area="${area}"
                                                    style="background: #25D366; border-color: #25D366;">
                                                    <i class="fas fa-paper-plane"></i> Send WhatsApp
                                                </button>
                                                <div class="progress mt-2" style="display: none; height: 10px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                        role="progressbar" style="width: 0%"></div>
                                                </div>
                                                <div class="batch-status mt-1" style="font-size: 12px; display: none;"></div>
                                            </td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            $("#areaPageInfo").text(`${start + 1} - ${end} of ${areaBreakdownData.length}`);
                            $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                            $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
                        }

                        // WhatsApp Batch Sending Function for Large Volumes
                        function sendWhatsAppBatch(status, scheme, area, button) {
                            if (isSending) {
                                if (pauseSending) {
                                    // Resume sending
                                    pauseSending = false;
                                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                                    sendNextBatch(status, scheme, area, button);
                                } else {
                                    // Pause sending
                                    pauseSending = true;
                                    button.innerHTML = '<i class="fas fa-play"></i> Resume';
                                    updateStatus('⏸️ Sending paused. Click Resume to continue.');
                                }
                                return;
                            }

                            const progressBar = button.nextElementSibling;
                            const statusDiv = progressBar.nextElementSibling;
                            const batchSize = 2; // Very small batches for large volumes

                            if (!confirm(`Send WhatsApp to ${area} (${status} - ${scheme})?\n\n• Large volume: ${batchSize} messages per batch\n• Estimated time: Several hours for 9000+ customers\n• You can pause/resume anytime`)) {
                                return;
                            }

                            isSending = true;
                            pauseSending = false;
                            currentBatch = 0;
                            successCount = 0;
                            failCount = 0;
                            totalCustomers = 0;
                            startTime = new Date();

                            // Disable other buttons
                            $('.send-whatsapp-batch').not(button).prop('disabled', true);
                            
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                            progressBar.style.display = 'block';
                            statusDiv.style.display = 'block';
                            statusDiv.innerHTML = 'Counting customers...';

                            // Get total count first
                            $.ajax({
                                url: '<?php echo base_url('SBC_data/get_customers_for_messaging'); ?>',
                                type: 'GET',
                                data: { status: status, scheme: scheme, area: area },
                                success: function(response) {
                                    if (response.success) {
                                        totalCustomers = response.total_customers;
                                        totalBatches = Math.ceil(totalCustomers / batchSize);
                                        
                                        if (totalCustomers === 0) {
                                            statusDiv.innerHTML = '<span class="text-danger">No customers found.</span>';
                                            resetButton(button, progressBar, statusDiv);
                                            return;
                                        }

                                        const estimatedTime = calculateTotalTime(totalCustomers, batchSize);
                                        statusDiv.innerHTML = `
                                            <div style="text-align: left;">
                                                <strong>Large Volume Detected: ${totalCustomers.toLocaleString()} customers</strong><br>
                                                • Batches: ${totalBatches} batches of ${batchSize}<br>
                                                • Estimated time: ${estimatedTime}<br>
                                                • You can PAUSE anytime<br>
                                                <small>Starting in 3 seconds...</small>
                                            </div>
                                        `;
                                        
                                        setTimeout(() => {
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }, 3000);
                                    } else {
                                        statusDiv.innerHTML = '<span class="text-danger">Error counting customers.</span>';
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = '<span class="text-danger">Error: ' + error + '</span>';
                                    resetButton(button, progressBar, statusDiv);
                                }
                            });
                        }

                        function sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize) {
                            if (pauseSending) {
                                return; // Don't send if paused
                            }

                            $.ajax({
                                url: '<?php echo base_url('SBC_data/send_batch_messages'); ?>',
                                type: 'POST',
                                data: {
                                    status: status,
                                    scheme: scheme,
                                    area: area,
                                    batch_size: batchSize,
                                    current_batch: currentBatch,
                                    total_customers: totalCustomers
                                },
                                timeout: 300000, // 5 minute timeout for large batches
                                success: function(response) {
                                    if (response.success) {
                                        currentBatch++;
                                        successCount += response.success_count;
                                        failCount += response.fail_count;

                                        // Update progress
                                        const progress = response.completion_percentage || (response.total_processed / totalCustomers) * 100;
                                        progressBar.querySelector('.progress-bar').style.width = progress + '%';
                                        
                                        const elapsed = Math.round((new Date() - startTime) / 1000);
                                        const elapsedFormatted = formatTime(elapsed);
                                        const remaining = response.estimated_time_remaining || 'Calculating...';
                                        
                                        let statusHTML = `
                                            <div style="text-align: left; font-size: 14px;">
                                                <strong>Progress: ${progress.toFixed(1)}%</strong><br>
                                                • Batch ${currentBatch}/${totalBatches} completed<br>
                                                • Success: ${successCount.toLocaleString()} | Failed: ${failCount.toLocaleString()}<br>
                                                • Total: ${response.total_processed.toLocaleString()}/${totalCustomers.toLocaleString()}<br>
                                                • Elapsed: ${elapsedFormatted} | Remaining: ${remaining}<br>
                                                <small>${response.batch_info || ''}</small>
                                        `;
                                        
                                        if (response.rate_limit_hit) {
                                            statusHTML += `<br><span class="text-warning">⚠️ Rate limit approaching</span>`;
                                        }
                                        
                                        statusHTML += `</div>`;
                                        statusDiv.innerHTML = statusHTML;

                                        if (response.completed) {
                                            // Completion
                                            const totalTime = Math.round((new Date() - startTime) / 1000);
                                            statusDiv.innerHTML = `
                                                <div class="text-success" style="text-align: left;">
                                                    <strong>✅ COMPLETED!</strong><br>
                                                    • Success: ${successCount.toLocaleString()}<br>
                                                    • Failed: ${failCount.toLocaleString()}<br>
                                                    • Total: ${totalCustomers.toLocaleString()}<br>
                                                    • Time: ${formatTime(totalTime)}<br>
                                                    • Success Rate: ${((successCount/totalCustomers)*100).toFixed(1)}%
                                                </div>
                                            `;
                                            progressBar.querySelector('.progress-bar').classList.remove('progress-bar-animated');
                                            resetButton(button, progressBar, statusDiv, true);
                                            
                                            // Show completion alert
                                            setTimeout(() => {
                                                alert(`BULK SENDING COMPLETED!\n\n✅ ${successCount.toLocaleString()} sent\n❌ ${failCount.toLocaleString()} failed\n📊 ${totalCustomers.toLocaleString()} total\n⏱️ ${formatTime(totalTime)}`);
                                            }, 1000);
                                        } else {
                                            // Continue with next batch
                                            const delay = response.rate_limit_hit ? 10000 : 3000; // 10s if rate limited, else 3s
                                            setTimeout(() => {
                                                if (!pauseSending) {
                                                    sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                                }
                                            }, delay);
                                        }
                                    } else {
                                        statusDiv.innerHTML = `<span class="text-danger">Error: ${response.error}</span>`;
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = `<span class="text-danger">Network error: ${error}</span>`;
                                    // Auto-retry after 10 seconds
                                    setTimeout(() => {
                                        if (!pauseSending) {
                                            statusDiv.innerHTML += '<br>Retrying...';
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }
                                    }, 10000);
                                }
                            });
                        }

                        function calculateTotalTime(totalCustomers, batchSize) {
                            const batches = Math.ceil(totalCustomers / batchSize);
                            const totalSeconds = batches * 5; // 5 seconds per batch
                            
                            if (totalSeconds < 3600) {
                                return Math.ceil(totalSeconds / 60) + ' minutes';
                            } else {
                                const hours = Math.floor(totalSeconds / 3600);
                                const minutes = Math.ceil((totalSeconds % 3600) / 60);
                                return hours + ' hours ' + minutes + ' minutes';
                            }
                        }

                        function formatTime(seconds) {
                            if (seconds < 60) return seconds + 's';
                            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ' + (seconds % 60) + 's';
                            
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            return hours + 'h ' + minutes + 'm';
                        }

                        function updateStatus(message) {
                            // Find the active status div and update it
                            $('.batch-status:visible').html(message);
                        }

                        function resetButton(button, progressBar, statusDiv, completed = false) {
                            isSending = false;
                            pauseSending = false;
                            
                            // Re-enable all buttons
                            $('.send-whatsapp-batch').prop('disabled', false);
                            
                            if (completed) {
                                button.innerHTML = '<i class="fas fa-check"></i> Completed';
                                button.classList.add('btn-success');
                                button.classList.remove('btn-warning');
                            } else {
                                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send WhatsApp';
                                button.classList.remove('btn-success', 'btn-warning');
                            }
                            
                            // Keep progress visible for a while
                            setTimeout(() => {
                                if (!isSending) {
                                    progressBar.style.display = 'none';
                                    progressBar.querySelector('.progress-bar').style.width = '0%';
                                    statusDiv.style.display = 'none';
                                }
                            }, completed ? 30000 : 10000);
                        }

                        // Event handlers
                        $(document).on('click', '.clickabled:not(.area-click):not(.whatsapp-link)', function() {
                            const status = $(this).data('status') || 'ALL';
                            const scheme = $(this).data('scheme') || 'ALL';
                            showAreaBreakdown(status, scheme);
                        });
                        
                        $(document).on('click', '.area-click', function() {
                            const area = $(this).data('area');
                            showCustomerDetails(area);
                        });

                        $(document).on('click', '.send-whatsapp-batch', function() {
                            const status = $(this).data('status');
                            const scheme = $(this).data('scheme');
                            const area = $(this).data('area');
                            sendWhatsAppBatch(status, scheme, area, this);
                        });
                        
                        // Pagination event handlers
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
                            showAreaBreakdown(currentStatus, currentScheme);
                        });

                        function showCustomerDetails(area) {
                            currentArea = area;
                            
                            filteredCustomers = allCustomers.filter(customer => {
                                const areaMatch = customer.Area_Name === area;
                                const statusMatch = (currentStatus === 'ALL') ? true : customer.consumer_status === currentStatus;
                                const schemeMatch = (currentScheme === 'ALL') ? true :
                                                (currentScheme === 'PMUY') ? customer.Scheme_Selected === 'PMUY' :
                                                customer.Scheme_Selected === 'NON_PMUY';
                                
                                return areaMatch && statusMatch && schemeMatch;
                            });
                            
                            currentPage = 1;
                            $('#customerDetailsTitle').text(`SBC Customers (${currentStatus} - ${currentScheme}) in ${area}`);
                            updateCustomerTable();
                            
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').show();
                            $('.content-section').scrollTop(0);
                        }

                        function updateCustomerTable() {
                            const start = (currentPage - 1) * recordsPerPage;
                            const end = Math.min(start + recordsPerPage, filteredCustomers.length);
                            const pageRows = filteredCustomers.slice(start, end);
                            const tableBody = $("#customerTableBody");
                            
                            tableBody.empty();
                            
                            if (pageRows.length === 0) {
                                tableBody.html('<tr><td colspan="7" class="text-center">No data available</td></tr>');
                            } else {
                                pageRows.forEach(customer => {
                                    const typeClass = customer.Consumer_Type === 'Commercial' ? 'badge-commercial' : 'badge-domestic';
                                    const schemeClass = customer.Scheme_Selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy';
                                    const statusClass = customer.consumer_status === 'ACTIVE' ? 'badge-active' : 
                                                    (customer.consumer_status === 'SUSPENDED' ? 'badge-suspended' : 'badge-deactived');
                                    
                                    tableBody.append(`
                                        <tr>
                                            <td>${customer.Area_Name}</td>
                                            <td>${customer.Consumer_Number || 'N/A'}</td>
                                            <td>${customer.Consumer_Name || 'N/A'}</td>
                                            <td>${customer.Phone_Number || 'N/A'}</td>
                                            <td><span class="badge ${schemeClass}">${customer.Scheme_Selected}</span></td>
                                            <td><span class="badge_sbc ${typeClass}">${customer.Consumer_Type || 'N/A'}</span></td>
                                            <td><span class="badge ${statusClass}">${customer.consumer_status}</span></td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            $("#customerPageInfo").text(`${start + 1} - ${end} of ${filteredCustomers.length}`);
                            $("#prevPage").toggleClass("disabled", currentPage === 1);
                            $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
                        }
                    });
                </script>

                <style>
                    .progress-bar-animated {
                        animation: progress-bar-stripes 1s linear infinite;
                    }

                    @keyframes progress-bar-stripes {
                        0% { background-position: 1rem 0; }
                        100% { background-position: 0 0; }
                    }

                    .batch-status {
                        font-size: 12px;
                        color: #666;
                        background: #f8f9fa;
                        padding: 8px;
                        border-radius: 4px;
                        border-left: 3px solid #007bff;
                    }

                    .btn-success {
                        background: #25D366;
                        border-color: #25D366;
                    }

                    .btn-success:hover:not(:disabled) {
                        background: #1da851;
                        border-color: #1da851;
                    }

                    .btn-success:disabled {
                        background: #a0d4b2;
                        border-color: #a0d4b2;
                        opacity: 0.6;
                    }

                    .btn-warning {
                        background: #ffc107;
                        border-color: #ffc107;
                    }

                    .progress {
                        height: 12px;
                        margin: 8px 0;
                    }

                    /* Responsive design */
                    @media (max-width: 768px) {
                        .batch-status {
                            font-size: 11px;
                        }
                        
                        .table-responsive {
                            font-size: 12px;
                        }
                    }
                </style>

                <style>
                    .progress-bar-animated {
                        animation: progress-bar-stripes 1s linear infinite;
                    }

                    @keyframes progress-bar-stripes {
                        0% { background-position: 1rem 0; }
                        100% { background-position: 0 0; }
                    }

                    .batch-status {
                        font-size: 12px;
                        color: #666;
                    }

                    .btn-success {
                        background: #25D366;
                        border-color: #25D366;
                    }

                    .btn-success:hover {
                        background: #1da851;
                        border-color: #1da851;
                    }

                    .btn-success:disabled {
                        background: #a0d4b2;
                        border-color: #a0d4b2;
                    }
                </style>

                <!---------------------------- NIll Refill Data  -------------------------------------------------------- -->
                <?php } elseif ($method == 'nil_refill_report') { ?>
                <div class="container4">
                    <div class="dashboard-back-btn back_dashborad">
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                    <div class="nerefil-summary">
                        <h2 class="text-center mb-4">Nill Refill Report</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered nilrefil_summary_table" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="9" class="text-center">Active</th>
                                        <th colspan="9" class="text-center">Suspended</th>
                                        <th colspan="9" class="text-center">Deactivated</th>
                                        <th colspan="9" class="text-center">Overall Total</th>
                                    </tr>
                                    <tr class="table-primary">
                                        <th colspan="3" class="text-center">3+ Months</th>
                                        <th colspan="3" class="text-center">6+ Months</th>
                                        <th colspan="3" class="text-center">1+ Year</th>
                                        <th colspan="3" class="text-center">3+ Months</th>
                                        <th colspan="3" class="text-center">6+ Months</th>
                                        <th colspan="3" class="text-center">1+ Year</th>
                                        <th colspan="3" class="text-center">3+ Months</th>
                                        <th colspan="3" class="text-center">6+ Months</th>
                                        <th colspan="3" class="text-center">1+ Year</th>
                                        <th colspan="3" class="text-center">3+ Months</th>
                                        <th colspan="3" class="text-center">6+ Months</th>
                                        <th colspan="3" class="text-center">1+ Year</th>
                                    </tr>
                                    <tr class="table-secondary">
                                        <th class="text-center"></th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo isset($stats['active']['greater_than_3_months']['pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_3_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo isset($stats['active']['greater_than_3_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_3_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_3_months" data-scheme="total"><?php echo isset($stats['active']['greater_than_3_months']['total']['qty']) ? htmlspecialchars($stats['active']['greater_than_3_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo isset($stats['active']['greater_than_6_months']['pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_6_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo isset($stats['active']['greater_than_6_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_6_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_6_months" data-scheme="total"><?php echo isset($stats['active']['greater_than_6_months']['total']['qty']) ? htmlspecialchars($stats['active']['greater_than_6_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo isset($stats['active']['greater_than_1_year']['pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_1_year']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo isset($stats['active']['greater_than_1_year']['non_pmuy']['qty']) ? htmlspecialchars($stats['active']['greater_than_1_year']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="active" data-period="greater_than_1_year" data-scheme="total"><?php echo isset($stats['active']['greater_than_1_year']['total']['qty']) ? htmlspecialchars($stats['active']['greater_than_1_year']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo isset($stats['suspended']['greater_than_3_months']['pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_3_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo isset($stats['suspended']['greater_than_3_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_3_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_3_months" data-scheme="total"><?php echo isset($stats['suspended']['greater_than_3_months']['total']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_3_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo isset($stats['suspended']['greater_than_6_months']['pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_6_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo isset($stats['suspended']['greater_than_6_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_6_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_6_months" data-scheme="total"><?php echo isset($stats['suspended']['greater_than_6_months']['total']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_6_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo isset($stats['suspended']['greater_than_1_year']['pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_1_year']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo isset($stats['suspended']['greater_than_1_year']['non_pmuy']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_1_year']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="suspended" data-period="greater_than_1_year" data-scheme="total"><?php echo isset($stats['suspended']['greater_than_1_year']['total']['qty']) ? htmlspecialchars($stats['suspended']['greater_than_1_year']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo isset($stats['deactivated']['greater_than_3_months']['pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_3_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo isset($stats['deactivated']['greater_than_3_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_3_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_3_months" data-scheme="total"><?php echo isset($stats['deactivated']['greater_than_3_months']['total']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_3_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo isset($stats['deactivated']['greater_than_6_months']['pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_6_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo isset($stats['deactivated']['greater_than_6_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_6_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_6_months" data-scheme="total"><?php echo isset($stats['deactivated']['greater_than_6_months']['total']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_6_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo isset($stats['deactivated']['greater_than_1_year']['pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_1_year']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo isset($stats['deactivated']['greater_than_1_year']['non_pmuy']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_1_year']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="deactivated" data-period="greater_than_1_year" data-scheme="total"><?php echo isset($stats['deactivated']['greater_than_1_year']['total']['qty']) ? htmlspecialchars($stats['deactivated']['greater_than_1_year']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_3_months" data-scheme="pmuy"><?php echo isset($stats['overall_total']['greater_than_3_months']['pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_3_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_3_months" data-scheme="non_pmuy"><?php echo isset($stats['overall_total']['greater_than_3_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_3_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_3_months" data-scheme="total"><?php echo isset($stats['overall_total']['greater_than_3_months']['total']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_3_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_6_months" data-scheme="pmuy"><?php echo isset($stats['overall_total']['greater_than_6_months']['pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_6_months']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_6_months" data-scheme="non_pmuy"><?php echo isset($stats['overall_total']['greater_than_6_months']['non_pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_6_months']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_6_months" data-scheme="total"><?php echo isset($stats['overall_total']['greater_than_6_months']['total']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_6_months']['total']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_1_year" data-scheme="pmuy"><?php echo isset($stats['overall_total']['greater_than_1_year']['pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_1_year']['pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_1_year" data-scheme="non_pmuy"><?php echo isset($stats['overall_total']['greater_than_1_year']['non_pmuy']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_1_year']['non_pmuy']['qty']) : 0; ?></td>
                                        <td class="clickabled text-center" data-status="overall_total" data-period="greater_than_1_year" data-scheme="total"><?php echo isset($stats['overall_total']['greater_than_1_year']['total']['qty']) ? htmlspecialchars($stats['overall_total']['greater_than_1_year']['total']['qty']) : 0; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percentage</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_3_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_3_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_3_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_3_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_3_months']['total']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_3_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_6_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_6_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_6_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_6_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_6_months']['total']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_6_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_1_year']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_1_year']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_1_year']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_1_year']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['active']['greater_than_1_year']['total']['percent']) ? htmlspecialchars(number_format($stats['active']['greater_than_1_year']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_3_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_3_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_3_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_3_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_3_months']['total']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_3_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_6_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_6_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_6_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_6_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_6_months']['total']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_6_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_1_year']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_1_year']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_1_year']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_1_year']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['suspended']['greater_than_1_year']['total']['percent']) ? htmlspecialchars(number_format($stats['suspended']['greater_than_1_year']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_3_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_3_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_3_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_3_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_3_months']['total']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_3_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_6_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_6_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_6_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_6_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_6_months']['total']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_6_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_1_year']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_1_year']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_1_year']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_1_year']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['deactivated']['greater_than_1_year']['total']['percent']) ? htmlspecialchars(number_format($stats['deactivated']['greater_than_1_year']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_3_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_3_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_3_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_3_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_3_months']['total']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_3_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_6_months']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_6_months']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_6_months']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_6_months']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_6_months']['total']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_6_months']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_1_year']['pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_1_year']['pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_1_year']['non_pmuy']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_1_year']['non_pmuy']['percent'], 2)) : '0.00'; ?>%</td>
                                        <td class="text-center"><?php echo isset($stats['overall_total']['greater_than_1_year']['total']['percent']) ? htmlspecialchars(number_format($stats['overall_total']['greater_than_1_year']['total']['percent'], 2)) : '0.00'; ?>%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content-section">
                        <div id="areaBreakdownView" style="display: none;" class="nilrefil_area_details">
                            <a href="#" class="back-bttn" id="backToSummary" aria-label="Back to Summary">Back to Summary</a>
                            <h4 class="text-center mb-4" id="areaBreakdownTitle"></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered area-table">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Area Name</th>
                                            <th>Customer Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav aria-label="Area Breakdown Pagination">
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#" aria-label="Previous Area Page">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageRange">1-10 of 0</span></li>
                                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#" aria-label="Next Area Page">Next</a></li>
                                </ul>
                            </nav>
                        </div>

                        <div id="customerDetailsView" style="display: none;" class="nilrefil_customer_details">
                            <a href="#" class="back-bttn" id="backToAreas" aria-label="Back to Areas">Back to Areas</a>
                            <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Area Name</th>
                                            <th>Consumer Number</th>
                                            <th>Consumer Name</th>
                                            <th>Phone Number</th>
                                            <th>Scheme</th>
                                            <th>Nil Refill Status</th>
                                            <th>Consumer Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerTableBody"></tbody>
                                </table>
                            </div>
                            <nav aria-label="Customer Details Pagination">
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevCustomerPage"><a class="page-link" href="#" aria-label="Previous Customer Page">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageRange">1-10 of 0</span></li>
                                    <li class="page-item" id="nextCustomerPage"><a class="page-link" href="#" aria-label="Next Customer Page">Next</a></li>
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
                        const allCustomers = <?php echo json_encode($all_customers ?? []); ?>;
                        let filteredCustomers = [];
                        let areaBreakdownData = [];
                        let currentStatus = '';
                        let currentPeriod = '';
                        let currentScheme = '';
                        let currentArea = '';
                        let currentAreaPage = 1;
                        let currentCustomerPage = 1;

                        // Initialize view
                        initView();

                        function initView() {
                            $('#summaryTable').show();
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').hide();
                            currentView = 'summary';
                            viewStack = [];
                        }

                        // Show area breakdown
                        function showAreaBreakdown(status, period, scheme) {
                            console.log('Showing area breakdown for:', status, period, scheme);
                            currentStatus = status || '';
                            currentPeriod = period || '';
                            currentScheme = scheme || '';

                            filteredCustomers = allCustomers.filter(customer => {
                                if (!customer) return false;
                                
                                // Check days since refill
                                const days = parseInt(customer.days_since_refill, 10);
                                if (isNaN(days)) return false;

                                // Check period condition
                                let periodMatch = false;
                                if (period === 'greater_than_3_months') periodMatch = days > 90 && days <= 180;
                                else if (period === 'greater_than_6_months') periodMatch = days > 180 && days <= 365;
                                else if (period === 'greater_than_1_year') periodMatch = days > 365;

                                // Check status condition
                                const customerStatus = (customer.Consumer_Sub_Status || '').toLowerCase();
                                const statusMatch = status === 'overall_total' || 
                                                status === '' || 
                                                customerStatus === status.toLowerCase();

                                // Check scheme condition
                                const customerScheme = customer.Scheme_Selected || '';
                                // console.log('Customer Scheme:', customerScheme);
                                const schemeMatch = scheme === 'total' || 
                                                (scheme === 'pmuy' && customerScheme === 'PMUY') || 
                                                (scheme === 'non_pmuy' && customerScheme === 'NON_PMUY');

                                return periodMatch && statusMatch && schemeMatch;
                            });

                            // Group by area name
                            const areaCounts = {};
                            filteredCustomers.forEach(customer => {
                                const area = customer.Area_Name || 'Unknown Area';
                                areaCounts[area] = (areaCounts[area] || 0) + 1;
                            });

                            // Convert to array and sort
                            areaBreakdownData = Object.entries(areaCounts).map(([area, count]) => ({
                                area: area,
                                count: count
                            })).sort((a, b) => b.count - a.count);

                            // Update the title
                            const statusText = status === 'overall_total' ? 'All Statuses' : 
                                status ? status.charAt(0).toUpperCase() + status.slice(1) : 'All Statuses';
                            const periodText = getPeriodText(period);
                            const schemeText = scheme === 'pmuy' ? 'PMUY' : 
                                            scheme === 'non_pmuy' ? 'Non-PMUY' : 'All Schemes';
                            $('#areaBreakdownTitle').text(`Areas (${statusText}, ${periodText}, ${schemeText}) - ${filteredCustomers.length} customers`);

                            // Reset pagination and update view
                            currentAreaPage = 1;
                            updateAreaBreakdownView();

                            // Show the view
                            // $('#summaryTable').hide();
                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                            $('#backButton').show();
                            viewStack.push(currentView);
                            currentView = 'area';
                        }
                         // Not show an tooltip this below code

                        // function updateAreaBreakdownView() {
                        //     const totalRecords = areaBreakdownData.length;
                        //     const totalPages = Math.ceil(totalRecords / recordsPerPage);
                        //     const startIdx = (currentAreaPage - 1) * recordsPerPage;
                        //     const endIdx = Math.min(startIdx + recordsPerPage, totalRecords);
                        //     const pageData = areaBreakdownData.slice(startIdx, endIdx);

                        //     const $tbody = $('#areaBreakdownBody');
                        //     $tbody.empty();

                        //     if (pageData.length === 0) {
                        //         $tbody.append('<tr><td colspan="2" class="text-center">No areas found</td></tr>');
                        //     } else {
                        //         pageData.forEach(item => {
                        //             $tbody.append(`
                        //                 <tr>
                        //                     <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                        //                         ${escapeHtml(item.area)}
                        //                     </td>
                        //                     <td>${item.count}</td>
                        //                     <td>
                        //                         <a href="#" class="clickabled" style="text-decoration: none;">
                        //                         <img src="<?= base_url('Image/w1.png') ?>" alt="WhatsApp" class="whatsapp_icon" style=" width: 40px; height: 40px;">
                        //                         Whatsapp
                        //                         </a>
                        //                     </td>
                        //                 </tr>
                        //             `);
                        //         });

                        //         // Rebind click events
                        //         $('.area-link').off('click').on('click', function() {
                        //             const area = $(this).data('area');
                        //             showCustomerDetails(area);
                        //         });
                        //     }

                        //     // Update pagination controls
                        //     const startRecord = startIdx + 1;
                        //     const endRecord = endIdx;
                        //     $('#areaPageRange').text(`${startRecord}-${endRecord} of ${totalRecords}`);

                        //     // Update pagination controls
                        //     $('#prevAreaPage').toggleClass('disabled', currentAreaPage <= 1);
                        //     $('#nextAreaPage').toggleClass('disabled', currentAreaPage >= totalPages);
                        // }

                        function updateAreaBreakdownView() {
                            const totalRecords = areaBreakdownData.length;
                            const totalPages = Math.ceil(totalRecords / recordsPerPage);
                            const startIdx = (currentAreaPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, totalRecords);
                            const pageData = areaBreakdownData.slice(startIdx, endIdx);

                            const $tbody = $('#areaBreakdownBody');
                            $tbody.empty();

                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(item => {
                                    // Create WhatsApp URL with filter parameters for Nil Refill
                                    const whatsappUrl = `<?php echo base_url('NilRefill/sending_messaging'); ?>?status=${currentStatus}&period=${currentPeriod}&scheme=${currentScheme}&area=${encodeURIComponent(item.area)}`;
                                    
                                    $tbody.append(`
                                        <tr>
                                            <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                                                ${escapeHtml(item.area)}
                                            </td>
                                            <td>${item.count}</td>
                                            <td>
                                                <a href="${whatsappUrl}" class="clickabled whatsapp-link" style="text-decoration: none;" 
                                                data-status="${currentStatus}" data-period="${currentPeriod}" data-scheme="${currentScheme}" data-area="${item.area}">
                                                    <img src="<?= base_url('Image/w1.png') ?>" 
                                                        alt="WhatsApp" 
                                                        class="whatsapp_icon" 
                                                        style="width: 40px; height: 40px; cursor: pointer;" 
                                                        data-tooltip="Send WhatsApp message to ${item.area} (${currentStatus} - ${getPeriodText(currentPeriod)} - ${currentScheme === 'pmuy' ? 'PMUY' : 'Non-PMUY'})">
                                                    Whatsapp
                                                </a>
                                            </td>
                                        </tr>
                                    `);
                                });

                                // Rebind click events
                                $('.area-link').off('click').on('click', function() {
                                    const area = $(this).data('area');
                                    showCustomerDetails(area);
                                });
                            }

                            // Update pagination controls
                            const startRecord = startIdx + 1;
                            const endRecord = endIdx;
                            $('#areaPageRange').text(`${startRecord}-${endRecord} of ${totalRecords}`);
                            $('#prevAreaPage').toggleClass('disabled', currentAreaPage <= 1);
                            $('#nextAreaPage').toggleClass('disabled', currentAreaPage >= totalPages);
                        }

                        // ====================
                        // Tooltip logic (pure JS)
                        // ====================
                        document.addEventListener("mouseover", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltipText = e.target.getAttribute("data-tooltip");
                                const tooltip = document.createElement("div");
                                tooltip.className = "custom-tooltip";
                                tooltip.innerText = tooltipText;
                                document.body.appendChild(tooltip);

                                const rect = e.target.getBoundingClientRect();
                                tooltip.style.position = "absolute";
                                tooltip.style.background = "#333";
                                tooltip.style.color = "#fff";
                                tooltip.style.padding = "5px 8px";
                                tooltip.style.borderRadius = "4px";
                                tooltip.style.fontSize = "12px";
                                tooltip.style.pointerEvents = "none";
                                tooltip.style.zIndex = "9999";

                                tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 8}px`;
                                tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
                            }
                        });

                        document.addEventListener("mouseout", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltip = document.querySelector(".custom-tooltip");
                                if (tooltip) tooltip.remove();
                            }
                        });

                        function showCustomerDetails(area) {
                            currentArea = area;
                            const areaCustomers = filteredCustomers.filter(customer => 
                                (customer.Area_Name || 'Unknown Area') === area
                            );

                            const statusText = currentStatus === 'overall_total' ? 'All Statuses' : 
                                currentStatus ? currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1) : 'All Statuses';
                            const periodText = getPeriodText(currentPeriod);
                            const schemeText = currentScheme === 'pmuy' ? 'PMUY' : 
                                            currentScheme === 'non_pmuy' ? 'Non-PMUY' : 'All Schemes';
                            $('#customerDetailsTitle').text(`${escapeHtml(area)} - ${statusText}, ${periodText}, ${schemeText}`);

                            currentCustomerPage = 1;
                            updateCustomerDetailsView(areaCustomers);

                            // Show the customer details view
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').show();
                            $('#backButton').show();
                            viewStack.push(currentView);
                            currentView = 'customer';
                            console.log('Switched to Customer View');
                        }

                        function updateCustomerDetailsView(customers) {
                            const totalRecords = customers.length;
                            const totalPages = Math.ceil(totalRecords / recordsPerPage);
                            const startIdx = (currentCustomerPage - 1) * recordsPerPage;
                            const endIdx = Math.min(totalRecords, startIdx + recordsPerPage);
                            const pageData = customers.slice(startIdx, endIdx);

                            const $tbody = $('#customerTableBody');
                            $tbody.empty();

                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="7" class="text-center">No customers found</td></tr>');
                            } else {
                                pageData.forEach(customer => {
                                    const lastRefill = customer.Last_Refill_Date 
                                        ? new Date(customer.Last_Refill_Date).toLocaleDateString('en-GB') 
                                        : 'Never';
                                    const monthsSince = customer.months_since_refill !== null 
                                        ? `${customer.months_since_refill} months` 
                                        : 'N/A';
                                    
                                    const statusClass = getStatusBadgeClass(customer.Consumer_Sub_Status);
                                    
                                    $tbody.append(`
                                        <tr>
                                            <td>${escapeHtml(customer.Area_Name || 'Unknown Area')}</td>
                                            <td>${escapeHtml(customer.Consumer_Number)}</td>
                                            <td>${escapeHtml(customer.Consumer_Name)}</td>
                                            <td>${escapeHtml(customer.Phone_Number) || 'N/A'}</td>
                                            <td><span class="badge ${customer.Scheme_Selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">${escapeHtml(customer.Scheme_Selected)}</span></td>
                                            <td><span class="badge badge-due">Due</span></td>
                                            <td class = "text-center">${statusClass}</td>
                                        </tr>
                                    `);
                                });
                            }

                            const startRecord = startIdx + 1;
                            const endRecord = endIdx;
                            $('#customerPageRange').text(`${startRecord}-${endRecord} of ${totalRecords}`);

                            // Update pagination controls
                            $('#prevCustomerPage').toggleClass('disabled', currentCustomerPage === 1);
                            $('#nextCustomerPage').toggleClass('disabled', currentCustomerPage >= totalPages);
                        }

                        function getPeriodText(period) {
                            switch (period) {
                                case 'greater_than_3_months': return '3+ Months';
                                case 'greater_than_6_months': return '6+ Months';
                                case 'greater_than_1_year': return '1+ Year';
                                default: return '';
                            }
                        }

                        function getStatusBadgeClass(status) {
                            switch(status) {
                                case 'ACTIVE':
                                    return '<span class="badge badge-active">ACTIVE</span>';
                                case 'SUSPENDED':
                                    return '<span class="badge badge-suspended">SUSPENDED</span>';
                                case 'DEACTIVATED':
                                    return '<span class="badge badge-deactived">DEACTIVATED</span>';
                                default:
                                    return '<span class="badge badge-secondary">' + (status || 'N/A') + '</span>';
                            }
                        }

                        function escapeHtml(text) {
                            if (text === null || text === undefined) return '';
                            const map = {
                                '&': '&amp;',
                                '<': '&lt;',
                                '>': '&gt;',
                                '"': '&quot;',
                                "'": '&#39;'
                            };
                            return text.toString().replace(/[&<>"']/g, m => map[m]);
                        }

                        // Click handler for summary table cells
                        // Click handler for summary table cells - exclude whatsapp links
                        $('.clickabled[data-status][data-period][data-scheme]:not(.whatsapp-link)').on('click', function() {
                            const status = $(this).data('status');
                            const period = $(this).data('period');
                            const scheme = $(this).data('scheme');
                            showAreaBreakdown(status, period, scheme);
                        });

                        $('#backToSummary').on('click', function(e) {
                            e.preventDefault();
                            $('#summaryTable').show();
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').hide();
                            currentView = 'summary';
                            viewStack = [];
                        });

                        $('#backToAreas').on('click', function(e) {
                            e.preventDefault();
                            // $('#summaryTable').hide();
                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                            currentView = 'area';
                        });

                        $('#prevAreaPage').on('click', function(e) {
                            e.preventDefault();
                            if (currentAreaPage > 1) {
                                currentAreaPage--;
                                updateAreaBreakdownView();
                            }
                        });

                        $('#nextAreaPage').on('click', function(e) {
                            e.preventDefault();
                            const totalRecords = areaBreakdownData.length;
                            const totalPages = Math.ceil(totalRecords / recordsPerPage);
                            if (currentAreaPage < totalPages) {
                                currentAreaPage++;
                                updateAreaBreakdownView();
                            }
                        });

                        $('#prevCustomerPage').on('click', function(e) {
                            e.preventDefault();
                            if (currentCustomerPage > 1) {
                                currentCustomerPage--;
                                const customers = filteredCustomers.filter(c => 
                                    (c.Area_Name || 'Unknown Area') === currentArea
                                );
                                updateCustomerDetailsView(customers);
                            }
                        });

                        $('#nextCustomerPage').on('click', function(e) {
                            e.preventDefault();
                            const customers = filteredCustomers.filter(c => 
                                (c.Area_Name || 'Unknown Area') === currentArea
                            );
                            const totalPages = Math.ceil(customers.length / recordsPerPage);
                            if (currentCustomerPage < totalPages) {
                                currentCustomerPage++;
                                updateCustomerDetailsView(customers);
                            }
                        });
                    });
                </script>
                <!---------------------------- KYC Data  -------------------------------------------------------- -->
                <?php } elseif($method == 'kyc_data') { ?>
                <div class="container5">
                    <div class="dashboard-back-btn back_dashborad">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                    <!-- Fixed Summary Table -->
                    <div class="kyc-summary" id="summaryTableContainer">
                        <h2 class="text-center mb-4">KYC Data Table</h2>
                        <div class="table-responsive">
                            <table class="table table table-bordered table_summary_kyc" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
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
                                            <th class="text-center">Area Name</th>
                                            <th class="text-center">Consumer Number</th>
                                            <th class="text-center">Consumer Name</th>
                                            <th class="text-center">Phone Number</th>
                                            <th class="text-center">Scheme</th>
                                            <th class="text-center">KYC Status</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerTableBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
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
                        let currentPage = 1;
                        let currentAreaPage = 1;
                        let currentScheme = null;
                        let currentStatus = null;
                        let currentArea = null;
                        
                        // Data from server
                        let allCustomers = <?= json_encode($kyc_data) ?>;
                        let filteredCustomers = [];
                        let areaBreakdownData = [];

                        // WhatsApp sending variables for large volumes
                        let isSending = false;
                        let currentBatch = 0;
                        let totalBatches = 0;
                        let totalCustomers = 0;
                        let successCount = 0;
                        let failCount = 0;
                        let startTime = null;
                        let pauseSending = false;

                        // Initialize view
                        initView();

                        function initView() {
                            // Filter to only pending KYC customers
                            filteredCustomers = allCustomers.filter(customer => !customer.KYC_Number || customer.KYC_Number === '');
                            
                            // Set up initial customer table
                            updateCustomerTable();
                            
                            // Hide views that should not be visible initially
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').hide();
                        }

                        function processData() {
                            allCustomers.forEach(customer => {
                                // Normalize status to uppercase, default to 'ACTIVE'
                                customer.consumer_status = (customer.Consumer_Sub_Status || 'ACTIVE').toUpperCase();
                                // Normalize scheme to 'PMUY' or 'NON PMUY'
                                const scheme = (customer.Scheme_Selected || '').toUpperCase().trim();
                                customer.Scheme_Selected = scheme == 'NON_PMUY' ? 'NON_PMUY' : 'PMUY';
                                // Default Area_Name to 'Unknown'
                                customer.Area_Name = customer.Area_Name || 'Unknown';
                            });
                        }
                        
                        function showAreaBreakdown(status, scheme) {
                            currentStatus = status;
                            currentScheme = scheme;
                            
                            // Filter customers based on status and scheme
                            filteredCustomers = allCustomers.filter(customer => {
                                // Skip completed KYC
                                if (customer.KYC_Number && customer.KYC_Number !== '') return false;
                                
                                // Status filter
                                let statusMatch = (status === 'ALL') ? true : customer.Consumer_Sub_Status === status;
                                
                                // Scheme filter
                                let schemeMatch = true;
                                if (scheme === 'PMUY') {
                                    schemeMatch = customer.Scheme_Selected === 'PMUY';
                                } else if (scheme === 'NON_PMUY') {
                                    schemeMatch = customer.Scheme_Selected === 'Non PMUY';
                                }
                                
                                return statusMatch && schemeMatch;
                            });
                            
                            // Group by area
                            const areaCounts = {};
                            filteredCustomers.forEach(customer => {
                                const area = customer.Area_Name || 'Unknown';
                                areaCounts[area] = (areaCounts[area] || 0) + 1;
                            });
                            
                            // Convert to array and sort
                            areaBreakdownData = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
                            areaBreakdownData.sort((a, b) => b.count - a.count);
                            
                            // Update view
                            $('#areaBreakdownTitle').text(
                                `Pending KYC Customers (${status} - ${scheme}) by Area`
                            );
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();
                            
                            // Show the area breakdown view
                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                        }

                        function updateAreaBreakdownTable() {
                            const startIdx = (currentAreaPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, areaBreakdownData.length);
                            const pageData = areaBreakdownData.slice(startIdx, startIdx + recordsPerPage);
                            const $tbody = $('#areaBreakdownBody');

                            $tbody.empty();

                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(item => {
                                    $tbody.append(`
                                        <tr>
                                            <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                                                ${escapeHtml(item.area)}
                                            </td>
                                            <td>${item.count}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm send-whatsapp-batch" 
                                                    data-status="${currentStatus}" 
                                                    data-scheme="${currentScheme}" 
                                                    data-area="${item.area}"
                                                    style="background: #25D366; border-color: #25D366;">
                                                    <i class="fas fa-paper-plane"></i> Send WhatsApp
                                                </button>
                                                <div class="progress mt-2" style="display: none; height: 10px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                        role="progressbar" style="width: 0%"></div>
                                                </div>
                                                <div class="batch-status mt-1" style="font-size: 12px; display: none;"></div>
                                            </td>
                                        </tr>
                                    `);
                                });
                            }

                            // Update pagination controls
                            $('#areaPageInfo').text(`${startIdx + 1} - ${endIdx} of ${areaBreakdownData.length}`);
                            $('#prevAreaPage').toggleClass('disabled', currentAreaPage === 1);
                            $('#nextAreaPage').toggleClass('disabled', endIdx >= areaBreakdownData.length);
                        }

                        // WhatsApp Batch Sending Function for Large Volumes
                        function sendWhatsAppBatch(status, scheme, area, button) {
                            if (isSending) {
                                if (pauseSending) {
                                    // Resume sending
                                    pauseSending = false;
                                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                                    sendNextBatch(status, scheme, area, button);
                                } else {
                                    // Pause sending
                                    pauseSending = true;
                                    button.innerHTML = '<i class="fas fa-play"></i> Resume';
                                    updateStatus('⏸️ Sending paused. Click Resume to continue.');
                                }
                                return;
                            }

                            const progressBar = button.nextElementSibling;
                            const statusDiv = progressBar.nextElementSibling;
                            const batchSize = 2; // Very small batches for large volumes

                            if (!confirm(`Send WhatsApp to ${area} (${status} - ${scheme})?\n\n• Large volume: ${batchSize} messages per batch\n• Estimated time: Several hours for 9000+ customers\n• You can pause/resume anytime`)) {
                                return;
                            }

                            isSending = true;
                            pauseSending = false;
                            currentBatch = 0;
                            successCount = 0;
                            failCount = 0;
                            totalCustomers = 0;
                            startTime = new Date();

                            // Disable other buttons
                            $('.send-whatsapp-batch').not(button).prop('disabled', true);
                            
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                            progressBar.style.display = 'block';
                            statusDiv.style.display = 'block';
                            statusDiv.innerHTML = 'Counting customers...';

                            // Get total count first
                            $.ajax({
                                url: '<?php echo base_url('KYC_data/get_customers_for_messaging'); ?>',
                                type: 'GET',
                                data: { status: status, scheme: scheme, area: area },
                                success: function(response) {
                                    if (response.success) {
                                        totalCustomers = response.total_customers;
                                        totalBatches = Math.ceil(totalCustomers / batchSize);
                                        
                                        if (totalCustomers === 0) {
                                            statusDiv.innerHTML = '<span class="text-danger">No customers found.</span>';
                                            resetButton(button, progressBar, statusDiv);
                                            return;
                                        }

                                        const estimatedTime = calculateTotalTime(totalCustomers, batchSize);
                                        statusDiv.innerHTML = `
                                            <div style="text-align: left;">
                                                <strong>Large Volume Detected: ${totalCustomers.toLocaleString()} customers</strong><br>
                                                • Batches: ${totalBatches} batches of ${batchSize}<br>
                                                • Estimated time: ${estimatedTime}<br>
                                                • You can PAUSE anytime<br>
                                                <small>Starting in 3 seconds...</small>
                                            </div>
                                        `;
                                        
                                        setTimeout(() => {
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }, 3000);
                                    } else {
                                        statusDiv.innerHTML = '<span class="text-danger">Error counting customers.</span>';
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = '<span class="text-danger">Error: ' + error + '</span>';
                                    resetButton(button, progressBar, statusDiv);
                                }
                            });
                        }

                        function sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize) {
                            if (pauseSending) {
                                return; // Don't send if paused
                            }

                            $.ajax({
                                url: '<?php echo base_url('KYC_data/send_batch_messages'); ?>',
                                type: 'POST',
                                data: {
                                    status: status,
                                    scheme: scheme,
                                    area: area,
                                    batch_size: batchSize,
                                    current_batch: currentBatch,
                                    total_customers: totalCustomers
                                },
                                timeout: 300000, // 5 minute timeout for large batches
                                success: function(response) {
                                    if (response.success) {
                                        currentBatch++;
                                        successCount += response.success_count;
                                        failCount += response.fail_count;

                                        // Update progress
                                        const progress = response.completion_percentage || (response.total_processed / totalCustomers) * 100;
                                        progressBar.querySelector('.progress-bar').style.width = progress + '%';
                                        
                                        const elapsed = Math.round((new Date() - startTime) / 1000);
                                        const elapsedFormatted = formatTime(elapsed);
                                        const remaining = response.estimated_time_remaining || 'Calculating...';
                                        
                                        let statusHTML = `
                                            <div style="text-align: left; font-size: 14px;">
                                                <strong>Progress: ${progress.toFixed(1)}%</strong><br>
                                                • Batch ${currentBatch}/${totalBatches} completed<br>
                                                • Success: ${successCount.toLocaleString()} | Failed: ${failCount.toLocaleString()}<br>
                                                • Total: ${response.total_processed.toLocaleString()}/${totalCustomers.toLocaleString()}<br>
                                                • Elapsed: ${elapsedFormatted} | Remaining: ${remaining}<br>
                                                <small>${response.batch_info || ''}</small>
                                        `;
                                        
                                        if (response.rate_limit_hit) {
                                            statusHTML += `<br><span class="text-warning">⚠️ Rate limit approaching</span>`;
                                        }
                                        
                                        statusHTML += `</div>`;
                                        statusDiv.innerHTML = statusHTML;

                                        if (response.completed) {
                                            // Completion
                                            const totalTime = Math.round((new Date() - startTime) / 1000);
                                            statusDiv.innerHTML = `
                                                <div class="text-success" style="text-align: left;">
                                                    <strong>✅ COMPLETED!</strong><br>
                                                    • Success: ${successCount.toLocaleString()}<br>
                                                    • Failed: ${failCount.toLocaleString()}<br>
                                                    • Total: ${totalCustomers.toLocaleString()}<br>
                                                    • Time: ${formatTime(totalTime)}<br>
                                                    • Success Rate: ${((successCount/totalCustomers)*100).toFixed(1)}%
                                                </div>
                                            `;
                                            progressBar.querySelector('.progress-bar').classList.remove('progress-bar-animated');
                                            resetButton(button, progressBar, statusDiv, true);
                                            
                                            // Show completion alert
                                            setTimeout(() => {
                                                alert(`BULK SENDING COMPLETED!\n\n✅ ${successCount.toLocaleString()} sent\n❌ ${failCount.toLocaleString()} failed\n📊 ${totalCustomers.toLocaleString()} total\n⏱️ ${formatTime(totalTime)}`);
                                            }, 1000);
                                        } else {
                                            // Continue with next batch
                                            const delay = response.rate_limit_hit ? 10000 : 3000; // 10s if rate limited, else 3s
                                            setTimeout(() => {
                                                if (!pauseSending) {
                                                    sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                                }
                                            }, delay);
                                        }
                                    } else {
                                        statusDiv.innerHTML = `<span class="text-danger">Error: ${response.error}</span>`;
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = `<span class="text-danger">Network error: ${error}</span>`;
                                    // Auto-retry after 10 seconds
                                    setTimeout(() => {
                                        if (!pauseSending) {
                                            statusDiv.innerHTML += '<br>Retrying...';
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }
                                    }, 10000);
                                }
                            });
                        }

                        function calculateTotalTime(totalCustomers, batchSize) {
                            const batches = Math.ceil(totalCustomers / batchSize);
                            const totalSeconds = batches * 5; // 5 seconds per batch
                            
                            if (totalSeconds < 3600) {
                                return Math.ceil(totalSeconds / 60) + ' minutes';
                            } else {
                                const hours = Math.floor(totalSeconds / 3600);
                                const minutes = Math.ceil((totalSeconds % 3600) / 60);
                                return hours + ' hours ' + minutes + ' minutes';
                            }
                        }

                        function formatTime(seconds) {
                            if (seconds < 60) return seconds + 's';
                            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ' + (seconds % 60) + 's';
                            
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            return hours + 'h ' + minutes + 'm';
                        }

                        function updateStatus(message) {
                            // Find the active status div and update it
                            $('.batch-status:visible').html(message);
                        }

                        function resetButton(button, progressBar, statusDiv, completed = false) {
                            isSending = false;
                            pauseSending = false;
                            
                            // Re-enable all buttons
                            $('.send-whatsapp-batch').prop('disabled', false);
                            
                            if (completed) {
                                button.innerHTML = '<i class="fas fa-check"></i> Completed';
                                button.classList.add('btn-success');
                                button.classList.remove('btn-warning');
                            } else {
                                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send WhatsApp';
                                button.classList.remove('btn-success', 'btn-warning');
                            }
                            
                            // Keep progress visible for a while
                            setTimeout(() => {
                                if (!isSending) {
                                    progressBar.style.display = 'none';
                                    progressBar.querySelector('.progress-bar').style.width = '0%';
                                    statusDiv.style.display = 'none';
                                }
                            }, completed ? 30000 : 10000);
                        }

                        function showCustomerDetails(area) {
                            currentArea = area;
                            
                            // Filter customers for this area
                            filteredCustomers = allCustomers.filter(customer => {
                                // Skip completed KYC
                                if (customer.KYC_Number && customer.KYC_Number !== '') return false;
                                
                                const customerArea = customer.Area_Name || 'Unknown';
                                let statusMatch = (currentStatus === 'ALL') ? true : customer.Consumer_Sub_Status === currentStatus;
                                let schemeMatch = true;
                                
                                if (currentScheme === 'PMUY') {
                                    schemeMatch = customer.Scheme_Selected === 'PMUY';
                                } else if (currentScheme === 'NON_PMUY') {
                                    schemeMatch = customer.Scheme_Selected === 'Non PMUY';
                                }
                                
                                return customerArea === area && statusMatch && schemeMatch;
                            });
                            
                            // Update view
                            $('#customerDetailsTitle').text(
                                `Pending KYC Customers in ${escapeHtml(area)} (${currentStatus} - ${currentScheme})`
                            );
                            currentPage = 1;
                            updateCustomerTable();
                            
                            // Show the customer details view
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').show();
                        }

                        function updateCustomerTable() {
                            const startIdx = (currentPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, filteredCustomers.length);
                            const pageData = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
                            const $tbody = $('#customerTableBody');
                            
                            $tbody.empty();
                            
                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="7" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(customer => {
                                    const statusBadge = getStatusBadge(customer.Consumer_Sub_Status);
                                    const schemeBadge = customer.Scheme_Selected.toUpperCase() === 'PMUY' ?
                                        '<span class="badge badge-pmuy">PMUY</span>' :
                                        '<span class="badge badge-non-pmuy">Non PMUY</span>';
                                    $tbody.append(`
                                        <tr>
                                            <td>${escapeHtml(customer.Area_Name || 'Unknown')}</td>
                                            <td>${escapeHtml(customer.Consumer_Number || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Consumer_Name || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Phone_Number || 'N/A')}</td>
                                            <td>${schemeBadge}</td>
                                            <td><span class="badge badge-due">Pending</span></td>
                                            <td>${statusBadge}</td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            // Update pagination controls
                            $('#customerPageInfo').text(`${startIdx + 1} - ${endIdx} of ${filteredCustomers.length}`);
                            $('#prevPage').toggleClass('disabled', currentPage === 1);
                            $('#nextPage').toggleClass('disabled', endIdx >= filteredCustomers.length);
                        }

                        function getStatusBadge(status) {
                            status = (status || '').toUpperCase();
                            switch(status) {
                                case 'ACTIVE':
                                    return '<span class="badge badge-active">ACTIVE</span>';
                                case 'SUSPENDED':
                                    return '<span class="badge badge-suspended">SUSPENDED</span>';
                                case 'DEACTIVATED':
                                    return '<span class="badge badge-deactived">DEACTIVATED</span>';
                                default:
                                    return '<span class="badge badge-suspended">' + (status || 'N/A') + '</span>';
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
                        $('.clickabled').on('click', function() {
                            const status = $(this).data('status') || 'ALL';
                            const scheme = $(this).data('scheme') || 'ALL';
                            showAreaBreakdown(status, scheme);
                        });
                        
                        $(document).on('click', '.area-link', function() {
                            const area = $(this).data('area');
                            showCustomerDetails(area);
                        });

                        $(document).on('click', '.send-whatsapp-batch', function() {
                            const status = $(this).data('status');
                            const scheme = $(this).data('scheme');
                            const area = $(this).data('area');
                            sendWhatsAppBatch(status, scheme, area, this);
                        });
                        
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
                            showAreaBreakdown(currentStatus, currentScheme);
                        });
                    });
                </script>

                <style>
                    .progress-bar-animated {
                        animation: progress-bar-stripes 1s linear infinite;
                    }

                    @keyframes progress-bar-stripes {
                        0% { background-position: 1rem 0; }
                        100% { background-position: 0 0; }
                    }

                    .batch-status {
                        font-size: 12px;
                        color: #666;
                        background: #f8f9fa;
                        padding: 8px;
                        border-radius: 4px;
                        border-left: 3px solid #007bff;
                    }

                    .btn-success {
                        background: #25D366;
                        border-color: #25D366;
                    }

                    .btn-success:hover:not(:disabled) {
                        background: #1da851;
                        border-color: #1da851;
                    }

                    .btn-success:disabled {
                        background: #a0d4b2;
                        border-color: #a0d4b2;
                        opacity: 0.6;
                    }

                    .btn-warning {
                        background: #ffc107;
                        border-color: #ffc107;
                    }

                    .progress {
                        height: 12px;
                        margin: 8px 0;
                    }

                    /* Responsive design */
                    @media (max-width: 768px) {
                        .batch-status {
                            font-size: 11px;
                        }
                        
                        .table-responsive {
                            font-size: 12px;
                        }
                    }
                </style>

                <!---------------------------- MI Due Data  -------------------------------------------------------- -->
                <?php } elseif ($method == 'midue') { ?>
                <div class="container4">
                    <div class="dashboard-back-btn back_dashborad">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                    <!-- Fixed Summary Section -->
                    <div class="midue-summary">
                        <h2 class="text-center mb-4">MI Due Data Table</h2>
                        <div class="table-responsive">
                            <table class="table table table-bordered" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">NON PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="summaryTableBody">
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['non_pmuy'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total'] ? round(($customer_data['total']['total'] / $customer_data['total']['total']) * 100, 2) : 0 ?>%</td>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
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
                                            <th class="text-center">Area Name</th>
                                            <th class="text-center">Consumer Number</th>
                                            <th class="text-center">Consumer Name</th>
                                            <th class="text-center">Phone Number</th>
                                            <th class="text-center">Scheme</th>
                                            <th class="text-center">MI Status</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerTableBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

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
                        let currentStatus = null;
                        let currentArea = null;
                        let currentPage = 1;
                        let currentAreaPage = 1;

                        // WhatsApp sending variables for large volumes
                        let isSending = false;
                        let currentBatch = 0;
                        let totalBatches = 0;
                        let totalCustomers = 0;
                        let successCount = 0;
                        let failCount = 0;
                        let startTime = null;
                        let pauseSending = false;

                        // Initialize the view
                        initView();

                        function initView() {
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').hide();
                            currentView = 'summary';
                            viewHistory = [];
                        }

                        function showAreaBreakdown(status, scheme) {
                            currentStatus = status;
                            currentScheme = scheme;
                            
                            // Filter customers based on status and scheme
                            filteredCustomers = allCustomers.filter(customer => {
                                let statusMatch = (status === 'ALL') ? true : customer.status === status;
                                let schemeMatch = true;
                                if (scheme === 'PMUY') {
                                    schemeMatch = customer.scheme_type === 'PMUY';
                                } else if (scheme === 'NON_PMUY') {
                                    schemeMatch = customer.scheme_type === 'Non PMUY';
                                }
                                return statusMatch && schemeMatch;
                            });
                            
                            // Group by area
                            const areaCounts = {};
                            filteredCustomers.forEach(customer => {
                                const area = customer.Area_Name || 'Unknown';
                                areaCounts[area] = (areaCounts[area] || 0) + 1;
                            });
                            
                            // Convert to array and sort
                            areaBreakdownData = Object.entries(areaCounts)
                                .map(([area, count]) => ({ area, count }))
                                .sort((a, b) => b.count - a.count);
                            
                            // Update view
                            const title = `Due MI Customers (${status} - ${scheme}) by Area`;
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
                            const totalRecords = areaBreakdownData.length;
                            const totalPages = Math.ceil(totalRecords / recordsPerPage);
                            const startIdx = (currentAreaPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, totalRecords);
                            const pageData = areaBreakdownData.slice(startIdx, endIdx);

                            const $tbody = $('#areaBreakdownBody');
                            $tbody.empty();

                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(item => {
                                    $tbody.append(`
                                        <tr>
                                            <td class="clickabled area-link" data-area="${escapeHtml(item.area)}">
                                                ${escapeHtml(item.area)}
                                            </td>
                                            <td>${item.count}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm send-whatsapp-batch" 
                                                    data-status="${currentStatus}" 
                                                    data-scheme="${currentScheme}" 
                                                    data-area="${item.area}"
                                                    style="background: #25D366; border-color: #25D366;">
                                                    <i class="fas fa-paper-plane"></i> Send WhatsApp
                                                </button>
                                                <div class="progress mt-2" style="display: none; height: 10px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                        role="progressbar" style="width: 0%"></div>
                                                </div>
                                                <div class="batch-status mt-1" style="font-size: 12px; display: none;"></div>
                                            </td>
                                        </tr>
                                    `);
                                });

                                // Rebind click events
                                $('.area-link').off('click').on('click', function() {
                                    const area = $(this).data('area');
                                    showCustomerDetails(area);
                                });
                            }

                            // Update pagination controls
                            $('#areaPageInfo').text(`${startIdx + 1} - ${endIdx} of ${totalRecords}`);
                            $('#prevAreaPage').toggleClass('disabled', currentAreaPage === 1);
                            $('#nextAreaPage').toggleClass('disabled', endIdx >= totalRecords);
                        }

                        // WhatsApp Batch Sending Function for Large Volumes
                        function sendWhatsAppBatch(status, scheme, area, button) {
                            if (isSending) {
                                if (pauseSending) {
                                    // Resume sending
                                    pauseSending = false;
                                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                                    sendNextBatch(status, scheme, area, button);
                                } else {
                                    // Pause sending
                                    pauseSending = true;
                                    button.innerHTML = '<i class="fas fa-play"></i> Resume';
                                    updateStatus('⏸️ Sending paused. Click Resume to continue.');
                                }
                                return;
                            }

                            const progressBar = button.nextElementSibling;
                            const statusDiv = progressBar.nextElementSibling;
                            const batchSize = 2; // Very small batches for large volumes

                            if (!confirm(`Send WhatsApp to ${area} (${status} - ${scheme})?\n\n• Large volume: ${batchSize} messages per batch\n• Estimated time: Several hours for 9000+ customers\n• You can pause/resume anytime`)) {
                                return;
                            }

                            isSending = true;
                            pauseSending = false;
                            currentBatch = 0;
                            successCount = 0;
                            failCount = 0;
                            totalCustomers = 0;
                            startTime = new Date();

                            // Disable other buttons
                            $('.send-whatsapp-batch').not(button).prop('disabled', true);
                            
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                            progressBar.style.display = 'block';
                            statusDiv.style.display = 'block';
                            statusDiv.innerHTML = 'Counting customers...';

                            // Get total count first
                            $.ajax({
                                url: '<?php echo base_url('MI_due_data/get_customers_for_messaging'); ?>',
                                type: 'GET',
                                data: { status: status, scheme: scheme, area: area },
                                success: function(response) {
                                    if (response.success) {
                                        totalCustomers = response.total_customers;
                                        totalBatches = Math.ceil(totalCustomers / batchSize);
                                        
                                        if (totalCustomers === 0) {
                                            statusDiv.innerHTML = '<span class="text-danger">No customers found.</span>';
                                            resetButton(button, progressBar, statusDiv);
                                            return;
                                        }

                                        const estimatedTime = calculateTotalTime(totalCustomers, batchSize);
                                        statusDiv.innerHTML = `
                                            <div style="text-align: left;">
                                                <strong>Large Volume Detected: ${totalCustomers.toLocaleString()} customers</strong><br>
                                                • Batches: ${totalBatches} batches of ${batchSize}<br>
                                                • Estimated time: ${estimatedTime}<br>
                                                • You can PAUSE anytime<br>
                                                <small>Starting in 3 seconds...</small>
                                            </div>
                                        `;
                                        
                                        setTimeout(() => {
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }, 3000);
                                    } else {
                                        statusDiv.innerHTML = '<span class="text-danger">Error counting customers.</span>';
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = '<span class="text-danger">Error: ' + error + '</span>';
                                    resetButton(button, progressBar, statusDiv);
                                }
                            });
                        }

                        function sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize) {
                            if (pauseSending) {
                                return; // Don't send if paused
                            }

                            $.ajax({
                                url: '<?php echo base_url('MI_due_data/send_batch_messages'); ?>',
                                type: 'POST',
                                data: {
                                    status: status,
                                    scheme: scheme,
                                    area: area,
                                    batch_size: batchSize,
                                    current_batch: currentBatch,
                                    total_customers: totalCustomers
                                },
                                timeout: 300000, // 5 minute timeout for large batches
                                success: function(response) {
                                    if (response.success) {
                                        currentBatch++;
                                        successCount += response.success_count;
                                        failCount += response.fail_count;

                                        // Update progress
                                        const progress = response.completion_percentage || (response.total_processed / totalCustomers) * 100;
                                        progressBar.querySelector('.progress-bar').style.width = progress + '%';
                                        
                                        const elapsed = Math.round((new Date() - startTime) / 1000);
                                        const elapsedFormatted = formatTime(elapsed);
                                        const remaining = response.estimated_time_remaining || 'Calculating...';
                                        
                                        let statusHTML = `
                                            <div style="text-align: left; font-size: 14px;">
                                                <strong>Progress: ${progress.toFixed(1)}%</strong><br>
                                                • Batch ${currentBatch}/${totalBatches} completed<br>
                                                • Success: ${successCount.toLocaleString()} | Failed: ${failCount.toLocaleString()}<br>
                                                • Total: ${response.total_processed.toLocaleString()}/${totalCustomers.toLocaleString()}<br>
                                                • Elapsed: ${elapsedFormatted} | Remaining: ${remaining}<br>
                                                <small>${response.batch_info || ''}</small>
                                        `;
                                        
                                        if (response.rate_limit_hit) {
                                            statusHTML += `<br><span class="text-warning">⚠️ Rate limit approaching</span>`;
                                        }
                                        
                                        statusHTML += `</div>`;
                                        statusDiv.innerHTML = statusHTML;

                                        if (response.completed) {
                                            // Completion
                                            const totalTime = Math.round((new Date() - startTime) / 1000);
                                            statusDiv.innerHTML = `
                                                <div class="text-success" style="text-align: left;">
                                                    <strong>✅ COMPLETED!</strong><br>
                                                    • Success: ${successCount.toLocaleString()}<br>
                                                    • Failed: ${failCount.toLocaleString()}<br>
                                                    • Total: ${totalCustomers.toLocaleString()}<br>
                                                    • Time: ${formatTime(totalTime)}<br>
                                                    • Success Rate: ${((successCount/totalCustomers)*100).toFixed(1)}%
                                                </div>
                                            `;
                                            progressBar.querySelector('.progress-bar').classList.remove('progress-bar-animated');
                                            resetButton(button, progressBar, statusDiv, true);
                                            
                                            // Show completion alert
                                            setTimeout(() => {
                                                alert(`BULK SENDING COMPLETED!\n\n✅ ${successCount.toLocaleString()} sent\n❌ ${failCount.toLocaleString()} failed\n📊 ${totalCustomers.toLocaleString()} total\n⏱️ ${formatTime(totalTime)}`);
                                            }, 1000);
                                        } else {
                                            // Continue with next batch
                                            const delay = response.rate_limit_hit ? 10000 : 3000; // 10s if rate limited, else 3s
                                            setTimeout(() => {
                                                if (!pauseSending) {
                                                    sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                                }
                                            }, delay);
                                        }
                                    } else {
                                        statusDiv.innerHTML = `<span class="text-danger">Error: ${response.error}</span>`;
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = `<span class="text-danger">Network error: ${error}</span>`;
                                    // Auto-retry after 10 seconds
                                    setTimeout(() => {
                                        if (!pauseSending) {
                                            statusDiv.innerHTML += '<br>Retrying...';
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }
                                    }, 10000);
                                }
                            });
                        }

                        function calculateTotalTime(totalCustomers, batchSize) {
                            const batches = Math.ceil(totalCustomers / batchSize);
                            const totalSeconds = batches * 5; // 5 seconds per batch
                            
                            if (totalSeconds < 3600) {
                                return Math.ceil(totalSeconds / 60) + ' minutes';
                            } else {
                                const hours = Math.floor(totalSeconds / 3600);
                                const minutes = Math.ceil((totalSeconds % 3600) / 60);
                                return hours + ' hours ' + minutes + ' minutes';
                            }
                        }

                        function formatTime(seconds) {
                            if (seconds < 60) return seconds + 's';
                            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ' + (seconds % 60) + 's';
                            
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            return hours + 'h ' + minutes + 'm';
                        }

                        function updateStatus(message) {
                            // Find the active status div and update it
                            $('.batch-status:visible').html(message);
                        }

                        function resetButton(button, progressBar, statusDiv, completed = false) {
                            isSending = false;
                            pauseSending = false;
                            
                            // Re-enable all buttons
                            $('.send-whatsapp-batch').prop('disabled', false);
                            
                            if (completed) {
                                button.innerHTML = '<i class="fas fa-check"></i> Completed';
                                button.classList.add('btn-success');
                                button.classList.remove('btn-warning');
                            } else {
                                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send WhatsApp';
                                button.classList.remove('btn-success', 'btn-warning');
                            }
                            
                            // Keep progress visible for a while
                            setTimeout(() => {
                                if (!isSending) {
                                    progressBar.style.display = 'none';
                                    progressBar.querySelector('.progress-bar').style.width = '0%';
                                    statusDiv.style.display = 'none';
                                }
                            }, completed ? 30000 : 10000);
                        }

                        function showCustomerDetails(area) {
                            currentArea = area;
                            
                            // Filter customers for this area and scheme/status
                            filteredCustomers = allCustomers.filter(customer => {
                                const customerArea = customer.Area_Name || 'Unknown';
                                let statusMatch = (currentStatus === 'ALL') ? true : customer.status === currentStatus;
                                let schemeMatch = true;
                                
                                if (currentScheme === 'PMUY') {
                                    schemeMatch = customer.scheme_type === 'PMUY';
                                } else if (currentScheme === 'NON_PMUY') {
                                    schemeMatch = customer.scheme_type === 'Non PMUY';
                                }
                                
                                return customerArea === area && statusMatch && schemeMatch;
                            });
                            
                            // Update view
                            const schemeText = currentScheme === 'ALL' ? 'All Schemes' : currentScheme;
                            const statusText = currentStatus === 'ALL' ? 'All Statuses' : currentStatus;
                            $('#customerDetailsTitle').text(`Due MI Customers (${schemeText} - ${statusText}) in ${escapeHtml(area)}`);
                            
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
                            const endIdx = Math.min(startIdx + recordsPerPage, filteredCustomers.length);
                            const pageData = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
                            const $tbody = $('#customerTableBody');
                            
                            $tbody.empty();
                            
                            if (pageData.length === 0) {
                                $tbody.append('<tr><td colspan="7" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(customer => {
                                    // Use status property to match filtering logic
                                    const status = customer.status || 'N/A';
                                    
                                    // Determine badge class based on status
                                    let statusClass;
                                    switch (status) {
                                        case 'ACTIVE':
                                            statusClass = 'badge-active';
                                            break;
                                        case 'SUSPENDED':
                                            statusClass = 'badge-suspended';
                                            break;
                                        case 'DEACTIVATED':
                                            statusClass = 'badge-deactived';
                                            break;
                                        default:
                                            statusClass = 'badge-secondary'; // For 'N/A' or invalid status
                                    }
                                    
                                    $tbody.append(`
                                        <tr>
                                            <td>${escapeHtml(customer.Area_Name || 'Unknown')}</td>
                                            <td>${escapeHtml(customer.Consumer_Number || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Consumer_Name || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Phone_Number || 'N/A')}</td>
                                            <td>
                                                <span class="badge ${customer.scheme_type === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                                    ${escapeHtml(customer.scheme_type || 'N/A')}
                                                </span>
                                            </td>
                                            <td><span class="badge badge-due">Due</span></td>
                                            <td><span class="badge ${statusClass}">${escapeHtml(status)}</span></td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            // Update pagination controls
                            $('#customerPageInfo').text(`${startIdx + 1} - ${endIdx} of ${filteredCustomers.length}`);
                            $('#prevPage').toggleClass('disabled', currentPage === 1);
                            $('#nextPage').toggleClass('disabled', endIdx >= filteredCustomers.length);
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
                                currentView = 'area';
                            }
                        }

                        // Event listeners - exclude whatsapp links
                        $('.clickabled:not(.whatsapp-link)').on('click', function() {
                            const status = $(this).data('status') || 'ALL';
                            const scheme = $(this).data('scheme') || 'ALL';
                            showAreaBreakdown(status, scheme);
                        });
                        
                        $(document).on('click', '.area-link', function() {
                            const area = $(this).data('area');
                            showCustomerDetails(area);
                        });

                        $(document).on('click', '.send-whatsapp-batch', function() {
                            const status = $(this).data('status');
                            const scheme = $(this).data('scheme');
                            const area = $(this).data('area');
                            sendWhatsAppBatch(status, scheme, area, this);
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

                <style>
                    .progress-bar-animated {
                        animation: progress-bar-stripes 1s linear infinite;
                    }

                    @keyframes progress-bar-stripes {
                        0% { background-position: 1rem 0; }
                        100% { background-position: 0 0; }
                    }

                    .batch-status {
                        font-size: 12px;
                        color: #666;
                        background: #f8f9fa;
                        padding: 8px;
                        border-radius: 4px;
                        border-left: 3px solid #007bff;
                    }

                    .btn-success {
                        background: #25D366;
                        border-color: #25D366;
                    }

                    .btn-success:hover:not(:disabled) {
                        background: #1da851;
                        border-color: #1da851;
                    }

                    .btn-success:disabled {
                        background: #a0d4b2;
                        border-color: #a0d4b2;
                        opacity: 0.6;
                    }

                    .btn-warning {
                        background: #ffc107;
                        border-color: #ffc107;
                    }

                    .progress {
                        height: 12px;
                        margin: 8px 0;
                    }

                    /* Responsive design */
                    @media (max-width: 768px) {
                        .batch-status {
                            font-size: 11px;
                        }
                        
                        .table-responsive {
                            font-size: 12px;
                        }
                    }
                </style>
                <!---------------------------- Hose Due Data  -------------------------------------------------------- -->
                <?php } elseif ($method == 'hosedue') { ?>
                <div class="container4">
                    <div class="dashboard-back-btn back_dashborad mb-3">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                    <div class="hosedue_summary">
                        <h2 class="text-center">Hose Due Report</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="summaryTableBody">
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['active']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['active']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['active']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total_percent'] ?? 0 ?>%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="container">
                        <div class="content-section">
                            <!-- Area View -->
                            <div id="areaView" style="display: none;" class="hosedue-area-details">
                                <a href="#" class="back-bttn" id="backToSummary">Back to Summary</a>
                                <h4 class="text-center mb-4" id="areaViewTitle"></h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Area Name</th>
                                                <th>Due Count</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="areaTableBody"></tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination justify-content-center mt-3">
                                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
                                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Customer Details View -->
                            <div id="customerDetailsView" style="display: none;" class="hosedue_customer_details">
                                <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                                <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Area Name</th>
                                                <th class="text-center">Consumer Number</th>
                                                <th class="text-center">Consumer Name</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Scheme</th>
                                                <th class="text-center">Hose Due</th>
                                                <th class="text-center">Account Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="customerTableBody"></tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination justify-content-center mt-3">
                                        <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
                                        <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Configuration
                        const recordsPerPage = 10;
                        let currentPage = 1;
                        let currentAreaPage = 1;
                        let currentScheme = null;
                        let currentArea = null;
                        let currentStatus = null;
                        
                        // Data from server
                        let allCustomers = <?= json_encode($hose_due ?? []) ?>;
                        let filteredCustomers = [];
                        let areaBreakdownData = [];

                        // WhatsApp sending variables for large volumes
                        let isSending = false;
                        let currentBatch = 0;
                        let totalBatches = 0;
                        let totalCustomers = 0;
                        let successCount = 0;
                        let failCount = 0;
                        let startTime = null;
                        let pauseSending = false;

                        // Initialize view
                        initView();

                        function initView() {
                            $('#areaView').hide();
                            $('#customerDetailsView').hide();
                            
                            if (allCustomers && allCustomers.length > 0) {
                                processData();
                            }
                        }

                        function processData() {
                            const areaSchemeData = {};
                            
                            allCustomers.forEach(customer => {
                                const area = customer.Area_Name || 'Unknown';
                                const scheme = customer.Scheme_Selected || 'NON_PMUY';
                                const status = customer.status || 'ACTIVE';
                                
                                if (!areaSchemeData[area]) {
                                    areaSchemeData[area] = {
                                        PMUY: { ACTIVE: [], SUSPENDED: [], DEACTIVATED: [], ALL: [] },
                                        NON_PMUY: { ACTIVE: [], SUSPENDED: [], DEACTIVATED: [], ALL: [] },
                                        ALL: { ACTIVE: [], SUSPENDED: [], DEACTIVATED: [], ALL: [] }
                                    };
                                }
                                
                                if (scheme === 'PMUY') {
                                    areaSchemeData[area].PMUY[status].push(customer);
                                    areaSchemeData[area].PMUY.ALL.push(customer);
                                } else {
                                    areaSchemeData[area].NON_PMUY[status].push(customer);
                                    areaSchemeData[area].NON_PMUY.ALL.push(customer);
                                }
                                
                                areaSchemeData[area].ALL[status].push(customer);
                                areaSchemeData[area].ALL.ALL.push(customer);
                            });
                            
                            allCustomers = areaSchemeData;
                        }

                        function showAreaBreakdown(scheme, status) {
                            currentScheme = scheme;
                            currentStatus = status;
                            
                            areaBreakdownData = [];
                            
                            for (const area in allCustomers) {
                                if (allCustomers[area][scheme] && allCustomers[area][scheme][status]) {
                                    const customers = allCustomers[area][scheme][status];
                                    if (customers.length > 0) {
                                        areaBreakdownData.push({
                                            area: area,
                                            count: customers.length,
                                            customers: customers
                                        });
                                    }
                                }
                            }
                            
                            areaBreakdownData.sort((a, b) => b.count - a.count);
                            
                            $('#areaViewTitle').text(`Due Hose Customers (${scheme} - ${status}) by Area`);
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();
                            
                            $('#areaView').show();
                            $('#customerDetailsView').hide();
                        }

                        function updateAreaBreakdownTable() {
                            const startIdx = (currentAreaPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, areaBreakdownData.length);
                            const pageData = areaBreakdownData.slice(startIdx, startIdx + recordsPerPage);
                            const tableBody = $("#areaTableBody");

                            tableBody.empty();

                            if (pageData.length === 0) {
                                tableBody.html('<tr><td colspan="3" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageData.forEach(areaData => {
                                    tableBody.append(`
                                        <tr>
                                            <td class="clickabled area-click" data-area="${escapeHtml(areaData.area)}">
                                                ${escapeHtml(areaData.area)}
                                            </td>
                                            <td>${areaData.count}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm send-whatsapp-batch" 
                                                    data-status="${currentStatus}" 
                                                    data-scheme="${currentScheme}" 
                                                    data-area="${areaData.area}"
                                                    style="background: #25D366; border-color: #25D366;">
                                                    <i class="fas fa-paper-plane"></i> Send WhatsApp
                                                </button>
                                                <div class="progress mt-2" style="display: none; height: 10px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                        role="progressbar" style="width: 0%"></div>
                                                </div>
                                                <div class="batch-status mt-1" style="font-size: 12px; display: none;"></div>
                                            </td>
                                        </tr>
                                    `);
                                });

                                $('.area-click').off('click').on('click', function() {
                                    showCustomerDetails($(this).data('area'));
                                });
                            }

                            const startRecord = startIdx + 1;
                            const endRecord = endIdx;
                            $('#areaPageInfo').text(`${startRecord}-${endRecord} of ${areaBreakdownData.length}`);
                            $('#prevAreaPage').toggleClass('disabled', currentAreaPage <= 1);
                            $('#nextAreaPage').toggleClass('disabled', currentAreaPage >= Math.ceil(areaBreakdownData.length / recordsPerPage));
                        }

                        // WhatsApp Batch Sending Function for Large Volumes
                        function sendWhatsAppBatch(status, scheme, area, button) {
                            if (isSending) {
                                if (pauseSending) {
                                    // Resume sending
                                    pauseSending = false;
                                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                                    sendNextBatch(status, scheme, area, button);
                                } else {
                                    // Pause sending
                                    pauseSending = true;
                                    button.innerHTML = '<i class="fas fa-play"></i> Resume';
                                    updateStatus('⏸️ Sending paused. Click Resume to continue.');
                                }
                                return;
                            }

                            const progressBar = button.nextElementSibling;
                            const statusDiv = progressBar.nextElementSibling;
                            const batchSize = 2;

                            if (!confirm(`Send WhatsApp to ${area} (${status} - ${scheme})?\n\n• Large volume: ${batchSize} messages per batch\n• Estimated time: Several hours for 9000+ customers\n• You can pause/resume anytime`)) {
                                return;
                            }

                            isSending = true;
                            pauseSending = false;
                            currentBatch = 0;
                            successCount = 0;
                            failCount = 0;
                            totalCustomers = 0;
                            startTime = new Date();

                            $('.send-whatsapp-batch').not(button).prop('disabled', true);
                            
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                            progressBar.style.display = 'block';
                            statusDiv.style.display = 'block';
                            statusDiv.innerHTML = 'Counting customers...';

                            $.ajax({
                                url: '<?php echo base_url('Hosedue_data/get_customers_for_messaging'); ?>',
                                type: 'GET',
                                data: { status: status, scheme: scheme, area: area },
                                success: function(response) {
                                    if (response.success) {
                                        totalCustomers = response.total_customers;
                                        totalBatches = Math.ceil(totalCustomers / batchSize);
                                        
                                        if (totalCustomers === 0) {
                                            statusDiv.innerHTML = '<span class="text-danger">No customers found.</span>';
                                            resetButton(button, progressBar, statusDiv);
                                            return;
                                        }

                                        const estimatedTime = calculateTotalTime(totalCustomers, batchSize);
                                        statusDiv.innerHTML = `
                                            <div style="text-align: left;">
                                                <strong>Large Volume Detected: ${totalCustomers.toLocaleString()} customers</strong><br>
                                                • Batches: ${totalBatches} batches of ${batchSize}<br>
                                                • Estimated time: ${estimatedTime}<br>
                                                • You can PAUSE anytime<br>
                                                <small>Starting in 3 seconds...</small>
                                            </div>
                                        `;
                                        
                                        setTimeout(() => {
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }, 3000);
                                    } else {
                                        statusDiv.innerHTML = '<span class="text-danger">Error counting customers.</span>';
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = '<span class="text-danger">Error: ' + error + '</span>';
                                    resetButton(button, progressBar, statusDiv);
                                }
                            });
                        }

                        function sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize) {
                            if (pauseSending) {
                                return;
                            }

                            $.ajax({
                                url: '<?php echo base_url('Hosedue_data/send_batch_messages'); ?>',
                                type: 'POST',
                                data: {
                                    status: status,
                                    scheme: scheme,
                                    area: area,
                                    batch_size: batchSize,
                                    current_batch: currentBatch,
                                    total_customers: totalCustomers
                                },
                                timeout: 300000,
                                success: function(response) {
                                    if (response.success) {
                                        currentBatch++;
                                        successCount += response.success_count;
                                        failCount += response.fail_count;

                                        const progress = response.completion_percentage || (response.total_processed / totalCustomers) * 100;
                                        progressBar.querySelector('.progress-bar').style.width = progress + '%';
                                        
                                        const elapsed = Math.round((new Date() - startTime) / 1000);
                                        const elapsedFormatted = formatTime(elapsed);
                                        const remaining = response.estimated_time_remaining || 'Calculating...';
                                        
                                        let statusHTML = `
                                            <div style="text-align: left; font-size: 14px;">
                                                <strong>Progress: ${progress.toFixed(1)}%</strong><br>
                                                • Batch ${currentBatch}/${totalBatches} completed<br>
                                                • Success: ${successCount.toLocaleString()} | Failed: ${failCount.toLocaleString()}<br>
                                                • Total: ${response.total_processed.toLocaleString()}/${totalCustomers.toLocaleString()}<br>
                                                • Elapsed: ${elapsedFormatted} | Remaining: ${remaining}<br>
                                                <small>${response.batch_info || ''}</small>
                                        `;
                                        
                                        if (response.rate_limit_hit) {
                                            statusHTML += `<br><span class="text-warning">⚠️ Rate limit approaching</span>`;
                                        }
                                        
                                        statusHTML += `</div>`;
                                        statusDiv.innerHTML = statusHTML;

                                        if (response.completed) {
                                            const totalTime = Math.round((new Date() - startTime) / 1000);
                                            statusDiv.innerHTML = `
                                                <div class="text-success" style="text-align: left;">
                                                    <strong>✅ COMPLETED!</strong><br>
                                                    • Success: ${successCount.toLocaleString()}<br>
                                                    • Failed: ${failCount.toLocaleString()}<br>
                                                    • Total: ${totalCustomers.toLocaleString()}<br>
                                                    • Time: ${formatTime(totalTime)}<br>
                                                    • Success Rate: ${((successCount/totalCustomers)*100).toFixed(1)}%
                                                </div>
                                            `;
                                            progressBar.querySelector('.progress-bar').classList.remove('progress-bar-animated');
                                            resetButton(button, progressBar, statusDiv, true);
                                            
                                            setTimeout(() => {
                                                alert(`BULK SENDING COMPLETED!\n\n✅ ${successCount.toLocaleString()} sent\n❌ ${failCount.toLocaleString()} failed\n📊 ${totalCustomers.toLocaleString()} total\n⏱️ ${formatTime(totalTime)}`);
                                            }, 1000);
                                        } else {
                                            const delay = response.rate_limit_hit ? 10000 : 3000;
                                            setTimeout(() => {
                                                if (!pauseSending) {
                                                    sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                                }
                                            }, delay);
                                        }
                                    } else {
                                        statusDiv.innerHTML = `<span class="text-danger">Error: ${response.error}</span>`;
                                        resetButton(button, progressBar, statusDiv);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    statusDiv.innerHTML = `<span class="text-danger">Network error: ${error}</span>`;
                                    setTimeout(() => {
                                        if (!pauseSending) {
                                            statusDiv.innerHTML += '<br>Retrying...';
                                            sendNextBatch(status, scheme, area, button, progressBar, statusDiv, batchSize);
                                        }
                                    }, 10000);
                                }
                            });
                        }

                        function calculateTotalTime(totalCustomers, batchSize) {
                            const batches = Math.ceil(totalCustomers / batchSize);
                            const totalSeconds = batches * 5;
                            
                            if (totalSeconds < 3600) {
                                return Math.ceil(totalSeconds / 60) + ' minutes';
                            } else {
                                const hours = Math.floor(totalSeconds / 3600);
                                const minutes = Math.ceil((totalSeconds % 3600) / 60);
                                return hours + ' hours ' + minutes + ' minutes';
                            }
                        }

                        function formatTime(seconds) {
                            if (seconds < 60) return seconds + 's';
                            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ' + (seconds % 60) + 's';
                            
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            return hours + 'h ' + minutes + 'm';
                        }

                        function updateStatus(message) {
                            $('.batch-status:visible').html(message);
                        }

                        function resetButton(button, progressBar, statusDiv, completed = false) {
                            isSending = false;
                            pauseSending = false;
                            
                            $('.send-whatsapp-batch').prop('disabled', false);
                            
                            if (completed) {
                                button.innerHTML = '<i class="fas fa-check"></i> Completed';
                                button.classList.add('btn-success');
                                button.classList.remove('btn-warning');
                            } else {
                                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send WhatsApp';
                                button.classList.remove('btn-success', 'btn-warning');
                            }
                            
                            setTimeout(() => {
                                if (!isSending) {
                                    progressBar.style.display = 'none';
                                    progressBar.querySelector('.progress-bar').style.width = '0%';
                                    statusDiv.style.display = 'none';
                                }
                            }, completed ? 30000 : 10000);
                        }

                        function showCustomerDetails(area) {
                            currentArea = area;
                            
                            const areaData = areaBreakdownData.find(item => item.area === area);
                            
                            if (areaData) {
                                filteredCustomers = areaData.customers;
                                currentPage = 1;
                                
                                $('#customerDetailsTitle').text(
                                    `Due Hose Customers (${currentScheme} - ${currentStatus}) in ${escapeHtml(area)}`
                                );
                                
                                updateCustomerTable();
                                
                                $('#areaView').hide();
                                $('#customerDetailsView').show();
                            }
                        }

                        function updateCustomerTable() {
                            const startIdx = (currentPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, filteredCustomers.length);
                            const pageRows = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
                            const tableBody = $("#customerTableBody");
                            
                            tableBody.empty();
                            
                            if (pageRows.length === 0) {
                                tableBody.html('<tr><td colspan="7" class="text-center text-danger">No data available</td></tr>');
                            } else {
                                pageRows.forEach(customer => {
                                    const statusBadge = getStatusBadge(customer.status);
                                    const schemeBadge = customer.Scheme_Selected === 'PMUY' ?
                                        '<span class="badge badge-pmuy">PMUY</span>' : 
                                        '<span class="badge badge-non-pmuy">Non PMUY</span>';
                                        
                                    tableBody.append(`
                                        <tr>
                                            <td class="text-center">${escapeHtml(customer.Area_Name || 'N/A')}</td>
                                            <td class="text-center">${escapeHtml(customer.Consumer_Number || 'N/A')}</td>
                                            <td class="text-center">${escapeHtml(customer.Consumer_Name || 'N/A')}</td>
                                            <td class="text-center">${escapeHtml(customer.Phone_Number || 'N/A')}</td>
                                            <td class="text-center">${schemeBadge}</td>
                                            <td class="text-center"><span class="badge badge-due">Due</span></td>
                                            <td class="text-center">${statusBadge}</td>
                                        </tr>
                                    `);
                                });
                            }
                            
                            $("#customerPageInfo").text(`${startIdx + 1} - ${endIdx} of ${filteredCustomers.length}`);
                            $("#prevPage").toggleClass("disabled", currentPage === 1);
                            $("#nextPage").toggleClass("disabled", endIdx >= filteredCustomers.length);
                        }

                        function getStatusBadge(status) {
                            switch(status) {
                                case 'ACTIVE':
                                    return '<span class="badge badge-active">ACTIVE</span>';
                                case 'SUSPENDED':
                                    return '<span class="badge badge-suspended">SUSPENDED</span>';
                                case 'DEACTIVATED':
                                    return '<span class="badge badge-deactived">DEACTIVATED</span>';
                                default:
                                    return '<span class="badge badge-secondary">' + (status || 'N/A') + '</span>';
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
                        $('.clickabled[data-scheme][data-status]:not(.whatsapp-link)').on('click', function() {
                            const scheme = $(this).data('scheme');
                            const status = $(this).data('status');
                            
                            if (scheme === 'ALL') {
                                showCombinedAreaBreakdown(status);
                            } else {
                                showAreaBreakdown(scheme, status);
                            }
                        });
                        
                        function showCombinedAreaBreakdown(status) {
                            currentScheme = 'ALL';
                            currentStatus = status;
                            
                            areaBreakdownData = [];
                            const areaMap = {};
                            
                            for (const area in allCustomers) {
                                const pmuyCustomers = allCustomers[area].PMUY[status] || [];
                                const nonPmuyCustomers = allCustomers[area].NON_PMUY[status] || [];
                                const allCustomersForStatus = [...pmuyCustomers, ...nonPmuyCustomers];
                                
                                if (allCustomersForStatus.length > 0) {
                                    areaMap[area] = {
                                        area: area,
                                        count: allCustomersForStatus.length,
                                        customers: allCustomersForStatus
                                    };
                                }
                            }
                            
                            areaBreakdownData = Object.values(areaMap).sort((a, b) => b.count - a.count);
                            
                            $('#areaViewTitle').text(`Due Hose Customers (ALL Schemes - ${status}) by Area`);
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();
                            
                            $('#areaView').show();
                            $('#customerDetailsView').hide();
                        }
                        
                        $(document).on('click', '.area-click', function() {
                            showCustomerDetails($(this).data('area'));
                        });

                        $(document).on('click', '.send-whatsapp-batch', function() {
                            const status = $(this).data('status');
                            const scheme = $(this).data('scheme');
                            const area = $(this).data('area');
                            sendWhatsAppBatch(status, scheme, area, this);
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
                            if (currentPage * recordsPerPage < filteredCustomers.length) {
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
                            if (currentAreaPage * recordsPerPage < areaBreakdownData.length) {
                                currentAreaPage++;
                                updateAreaBreakdownTable();
                            }
                        });
                        
                        $("#backToSummary").on("click", function(e) {
                            e.preventDefault();
                            $('#areaView').hide();
                            $('#customerDetailsView').hide();
                        });
                        
                        $("#backToAreas").on("click", function(e) {
                            e.preventDefault();
                            if (currentScheme === 'ALL') {
                                showCombinedAreaBreakdown(currentStatus);
                            } else {
                                showAreaBreakdown(currentScheme, currentStatus);
                            }
                        });
                    });
                </script>

                <style>
                    .progress-bar-animated {
                        animation: progress-bar-stripes 1s linear infinite;
                    }

                    @keyframes progress-bar-stripes {
                        0% { background-position: 1rem 0; }
                        100% { background-position: 0 0; }
                    }

                    .batch-status {
                        font-size: 12px;
                        color: #666;
                        background: #f8f9fa;
                        padding: 8px;
                        border-radius: 4px;
                        border-left: 3px solid #007bff;
                    }

                    .btn-success {
                        background: #25D366;
                        border-color: #25D366;
                    }

                    .btn-success:hover:not(:disabled) {
                        background: #1da851;
                        border-color: #1da851;
                    }

                    .btn-success:disabled {
                        background: #a0d4b2;
                        border-color: #a0d4b2;
                        opacity: 0.6;
                    }

                    .btn-warning {
                        background: #ffc107;
                        border-color: #ffc107;
                    }

                    .progress {
                        height: 12px;
                        margin: 8px 0;
                    }

                    /* Responsive design */
                    @media (max-width: 768px) {
                        .batch-status {
                            font-size: 11px;
                        }
                        
                        .table-responsive {
                            font-size: 12px;
                        }
                    }
                </style>
                <!---------------------------- Phone Number Missing Data  -------------------------------------------------------- -->
                <?php } elseif ($method == 'phonenumber') { ?>
                <div class="container4">            
                    <div class="dashboard-back-btn back_dashborad">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                    <!-- Fixed Summary Section -->
                    <div class="summary-section">
                        <h2 class="text-center mb-4">Phone Number Missing Data</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="summaryTable">
                                <thead>
                                    <tr class="header-row">
                                        <th rowspan="2" class="text-center">Quantity/Percent</th>
                                        <th colspan="3" class="text-center">ACTIVE</th>
                                        <th colspan="3" class="text-center">SUSPENDED</th>
                                        <th colspan="3" class="text-center">DEACTIVATED</th>
                                        <th colspan="3" class="text-center">TOTAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">PMUY</th>
                                        <th class="text-center">Non PMUY</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="summaryTableBody">
                                    <tr>
                                        <td class="text-center">Quantity</td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="Non PMUY"><?= $customer_data['active']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="Non PMUY"><?= $customer_data['suspended']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="Non PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="Non PMUY"><?= $customer_data['total']['non_pmuy'] ?? 0 ?></td>
                                        <td class="clickabled text-center" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?? 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Percent</td>
                                        <td class="text-center"><?= $customer_data['active']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['active']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['active']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['suspended']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['deactivated']['total_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['non_pmuy_percent'] ?? 0 ?>%</td>
                                        <td class="text-center"><?= $customer_data['total']['total_percent'] ?? 0 ?>%</td>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Area Name</th>
                                            <th class="text-center">Missing Phone Count</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="areaBreakdownBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="areaPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Customer Details View -->
                        <div id="customerDetailsView" style="display: none;" class="phone_missing_customer_details">
                            <a href="#" class="back-bttn" id="backToAreas">Back to Areas</a>
                            <h4 class="text-center mb-4" id="customerDetailsTitle"></h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Area Name</th>
                                            <th class="text-center">Consumer Number</th>
                                            <th class="text-center">Consumer Name</th>
                                            <th class="text-center">Phone Number Status</th>
                                            <th class="text-center">Scheme</th>
                                            <th class="text-center">Account Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerTableBody"></tbody>
                                </table>
                            </div>
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><span class="page-link" id="customerPageInfo">1 - 10 of total page</span></li>
                                    <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                    
                <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <!-- Bootstrap JS -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function () {
                        let currentPage = 1;
                        let currentAreaPage = 1;
                        const recordsPerPage = 10;

                        let allCustomers = <?= json_encode($phone_missing_data ?? []) ?>;
                        let filteredCustomers = [];
                        let filteredAreas = [];
                        let currentScheme = null;
                        let currentStatus = 'ALL';
                        let currentArea = null;

                        initView();

                        function initView() {
                            $('#areaBreakdownView').hide();
                            $('#customerDetailsView').hide();

                            if (allCustomers && allCustomers.length > 0) {
                                processData();
                                updateClickableCells();
                            } else {
                                console.log('No customer data received');
                                $('#summaryTableBody tr:first td.clickabled').addClass('disabled');
                            }
                        }

                        function updateClickableCells() {
                            $('#summaryTableBody tr:first td.clickabled').each(function() {
                                const count = parseInt($(this).text());
                                if (count === 0) {
                                    $(this).addClass('disabled').css('cursor', 'not-allowed');
                                }
                            });
                        }

                        function processData() {
                            areaBreakdownData = [];
                            const areaCounts = {};

                            allCustomers.forEach(customer => {
                                const area = customer.Area_Name || 'Unknown';
                                const scheme = (customer.Scheme_Selected || 'Unknown').toUpperCase();
                                const status = (customer.Consumer_Sub_Status || 'ACTIVE').toUpperCase();

                                // Validate and log warnings for invalid data
                                if (!['PMUY', 'NON_PMUY', 'Non PMUY'].includes(scheme)) {
                                    console.warn(`Invalid scheme for customer ${customer.Consumer_Number || 'unknown'}: ${customer.Scheme_Selected}`);
                                }
                                if (!['ACTIVE', 'SUSPENDED', 'DEACTIVATED'].includes(status)) {
                                    console.warn(`Invalid status for customer ${customer.Consumer_Number || 'unknown'}: ${customer.Consumer_Sub_Status}`);
                                }

                                // Initialize area if not exists
                                if (!areaCounts[area]) {
                                    areaCounts[area] = {
                                        PMUY: 0,
                                        'Non PMUY': 0,
                                        activeCount: 0,
                                        suspendedCount: 0,
                                        deactivatedCount: 0,
                                        customers: []
                                    };
                                }

                                // Normalize scheme for counting
                                const normalizedScheme = scheme === 'PMUY' ? 'PMUY' : 'Non PMUY';
                                if (normalizedScheme === 'PMUY') {
                                    areaCounts[area].PMUY++;
                                } else if (normalizedScheme === 'Non PMUY') {
                                    areaCounts[area]['Non PMUY']++;
                                }

                                // Count by status
                                if (status === 'ACTIVE') {
                                    areaCounts[area].activeCount++;
                                } else if (status === 'SUSPENDED') {
                                    areaCounts[area].suspendedCount++;
                                } else if (status === 'DEACTIVATED') {
                                    areaCounts[area].deactivatedCount++;
                                }

                                // Store customer with normalized values
                                areaCounts[area].customers.push({
                                    ...customer,
                                    Scheme_Selected: normalizedScheme,
                                    Consumer_Sub_Status: status
                                });
                            });

                            // Convert counts to areaBreakdownData
                            for (const area in areaCounts) {
                                areaBreakdownData.push({
                                    area: area,
                                    pmuyCount: areaCounts[area].PMUY,
                                    nonPmuCount: areaCounts[area]['Non PMUY'],
                                    activeCount: areaCounts[area].activeCount,
                                    suspendedCount: areaCounts[area].suspendedCount,
                                    deactivatedCount: areaCounts[area].deactivatedCount,
                                    totalCount: areaCounts[area].customers.length,
                                    customers: areaCounts[area].customers
                                });
                            }

                            console.log(`Processed ${areaBreakdownData.length} areas`);
                        }

                        function showAreaBreakdown(scheme, status = 'ALL') {
                            currentScheme = scheme;
                            currentStatus = status;

                            $('#areaBreakdownTitle').text(`Customers Missing Phone (${scheme}${status !== 'ALL' ? ' - ' + status : ''}) by Area`);
                            currentAreaPage = 1;
                            updateAreaBreakdownTable();

                            $('#areaBreakdownView').show();
                            $('#customerDetailsView').hide();
                            $('.content-section').scrollTop(0);
                        }

                         // Not show an tooltip this below code

                        // function updateAreaBreakdownTable() {
                        //     const startIdx = (currentAreaPage - 1) * recordsPerPage;
                        //     const endIdx = Math.min(startIdx + recordsPerPage, filteredAreas.length);
                        //     const tableBody = $("#areaBreakdownBody");

                        //     tableBody.empty();

                        //     // Filter areas based on current scheme and status
                        //     filteredAreas = areaBreakdownData.filter(area => {
                        //         let count;
                        //         if (currentStatus !== 'ALL') {
                        //             count = area[currentStatus.toLowerCase() + 'Count'];
                        //             if (count <= 0) return false;

                        //             if (currentScheme !== 'ALL') {
                        //                 return currentScheme === 'PMUY' ? area.pmuyCount > 0 : area.nonPmuCount > 0;
                        //             }
                        //             return true;
                        //         }

                        //         if (currentScheme !== 'ALL') {
                        //             count = currentScheme === 'PMUY' ? area.pmuyCount : area.nonPmuCount;
                        //             return count > 0;
                        //         }

                        //         return area.totalCount > 0;
                        //     });

                        //     console.log(`Filtered ${filteredAreas.length} areas for scheme: ${currentScheme}, status: ${currentStatus}`);

                        //     const pageAreas = filteredAreas.slice(startIdx, startIdx + recordsPerPage);

                        //     if (pageAreas.length === 0) {
                        //         tableBody.html('<tr><td colspan="2" class="no-data">No data available</td></tr>');
                        //     } else {
                        //         pageAreas.forEach(areaData => {
                        //             let count;
                        //             if (currentStatus !== 'ALL') {
                        //                 count = areaData[currentStatus.toLowerCase() + 'Count'];
                        //             } else {
                        //                 count = currentScheme === 'PMUY' ? areaData.pmuyCount :
                        //                     currentScheme === 'Non PMUY' ? areaData.nonPmuCount :
                        //                     areaData.totalCount;
                        //             }

                        //             tableBody.append(`
                        //                 <tr>
                        //                     <td class="clickabled area-click" data-area="${escapeHtml(areaData.area)}">
                        //                         ${escapeHtml(areaData.area)}
                        //                     </td>
                        //                     <td class="text-center">${count}</td>
                        //                     <td>
                        //                         <a href="#" class="clickabled" style="text-decoration: none;">
                        //                         <img src="<?= base_url('Image/w1.png') ?>" alt="WhatsApp" class="whatsapp_icon" style=" width: 40px; height: 40px;">
                        //                         Whatsapp
                        //                         </a>
                        //                     </td>
                        //                 </tr>
                        //             `);
                        //         });
                        //     }

                        //     // Update pagination
                        //     $("#areaPageInfo").text(`${startIdx + 1} - ${endIdx} of ${filteredAreas.length}`);
                        //     $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                        //     $("#nextAreaPage").toggleClass("disabled", endIdx >= filteredAreas.length);
                        // }

                        function updateAreaBreakdownTable() {
                            const startIdx = (currentAreaPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, filteredAreas.length);
                            const tableBody = $("#areaBreakdownBody");

                            tableBody.empty();

                            // Filter areas based on current scheme and status
                            filteredAreas = areaBreakdownData.filter(area => {
                                let count;
                                if (currentStatus !== 'ALL') {
                                    count = area[currentStatus.toLowerCase() + 'Count'];
                                    if (count <= 0) return false;

                                    if (currentScheme !== 'ALL') {
                                        return currentScheme === 'PMUY' ? area.pmuyCount > 0 : area.nonPmuCount > 0;
                                    }
                                    return true;
                                }

                                if (currentScheme !== 'ALL') {
                                    count = currentScheme === 'PMUY' ? area.pmuyCount : area.nonPmuCount;
                                    return count > 0;
                                }

                                return area.totalCount > 0;
                            });

                            console.log(`Filtered ${filteredAreas.length} areas for scheme: ${currentScheme}, status: ${currentStatus}`);

                            const pageAreas = filteredAreas.slice(startIdx, startIdx + recordsPerPage);

                            if (pageAreas.length === 0) {
                                tableBody.html('<tr><td colspan="3" class="no-data text-danger">No data available</td></tr>');
                            } else {
                                pageAreas.forEach(areaData => {
                                    let count;
                                    if (currentStatus !== 'ALL') {
                                        count = areaData[currentStatus.toLowerCase() + 'Count'];
                                    } else {
                                        count = currentScheme === 'PMUY' ? areaData.pmuyCount :
                                            currentScheme === 'Non PMUY' ? areaData.nonPmuCount :
                                            areaData.totalCount;
                                    }

                                    tableBody.append(`
                                        <tr>
                                            <td class="clickabled area-click" data-area="${escapeHtml(areaData.area)}">
                                                ${escapeHtml(areaData.area)}
                                            </td>
                                            <td class="text-center">${count}</td>
                                            
                                        </tr>
                                    `);
                                });
                            }

                            // Update pagination
                            $("#areaPageInfo").text(`${startIdx + 1} - ${endIdx} of ${filteredAreas.length}`);
                            $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                            $("#nextAreaPage").toggleClass("disabled", endIdx >= filteredAreas.length);
                        }

                        // ====================
                        // Tooltip logic (pure JS)
                        // ====================
                        
                        document.addEventListener("mouseover", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltipText = e.target.getAttribute("data-tooltip");
                                const tooltip = document.createElement("div");
                                tooltip.className = "custom-tooltip";
                                tooltip.innerText = tooltipText;
                                document.body.appendChild(tooltip);

                                const rect = e.target.getBoundingClientRect();
                                tooltip.style.position = "absolute";
                                tooltip.style.background = "#333";
                                tooltip.style.color = "#fff";
                                tooltip.style.padding = "5px 8px";
                                tooltip.style.borderRadius = "4px";
                                tooltip.style.fontSize = "12px";
                                tooltip.style.pointerEvents = "none";
                                tooltip.style.zIndex = "9999";

                                tooltip.style.top = `${rect.top + window.scrollY - tooltip.offsetHeight - 8}px`;
                                tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;

                                e.target.dataset.tooltipElement = tooltip;
                            }
                        });

                        document.addEventListener("mouseout", function (e) {
                            if (e.target.classList.contains("whatsapp_icon")) {
                                const tooltip = document.querySelector(".custom-tooltip");
                                if (tooltip) tooltip.remove();
                            }
                        });


                        function showCustomerDetails(area) {
                            currentArea = area;

                            // Case-insensitive area lookup
                            const areaData = areaBreakdownData.find(item => item.area.toLowerCase() === area.toLowerCase());

                            if (areaData) {
                                // Filter customers based on currentScheme and currentStatus
                                filteredCustomers = areaData.customers.filter(customer => {
                                    const customerScheme = (customer.Scheme_Selected || '').toUpperCase();
                                    const customerStatus = (customer.Consumer_Sub_Status || '').toUpperCase();
                                    const matchesScheme = currentScheme === 'ALL' || customerScheme === currentScheme.toUpperCase();
                                    const matchesStatus = currentStatus === 'ALL' || customerStatus === currentStatus.toUpperCase();
                                    return matchesScheme && matchesStatus;
                                });

                                console.log(`Filtered ${filteredCustomers.length} customers for area: ${area}, scheme: ${currentScheme}, status: ${currentStatus}`);
                                if (filteredCustomers.length === 0) {
                                    console.log('Filtered customers:', filteredCustomers);
                                    console.log('Area customers:', areaData.customers);
                                }

                                currentPage = 1;

                                // Set the title for the customer details view
                                $('#customerDetailsTitle').text(
                                    `Customers Missing Phone (${currentScheme}${currentStatus !== 'ALL' ? ' - ' + currentStatus : ''}) in ${escapeHtml(area)}`
                                );

                                // Update the customer table
                                updateCustomerTable();

                                // Show the customer details view and hide the area breakdown view
                                $('#areaBreakdownView').hide();
                                $('#customerDetailsView').show();
                                $('.content-section').scrollTop(0);
                            } else {
                                console.error(`No data found for area: ${area}`);
                                $('#customerTableBody').html('<tr><td colspan="6" class="no-data text-danger">No data available for this area</td></tr>');
                            }
                        }

                        function updateCustomerTable() {
                            const startIdx = (currentPage - 1) * recordsPerPage;
                            const endIdx = Math.min(startIdx + recordsPerPage, filteredCustomers.length);
                            const pageRows = filteredCustomers.slice(startIdx, startIdx + recordsPerPage);
                            const tableBody = $("#customerTableBody");

                            tableBody.empty();

                            if (pageRows.length === 0) {
                                tableBody.html('<tr><td colspan="6" class="no-data text-danger">No data available</td></tr>');
                            } else {
                                pageRows.forEach(customer => {
                                    const statusBadge = getStatusBadge(customer.Consumer_Sub_Status);
                                    const schemeBadge = customer.Scheme_Selected.toUpperCase() === 'PMUY' ?
                                        '<span class="badge badge-pmuy">PMUY</span>' :
                                        '<span class="badge badge-non-pmuy">Non PMUY</span>';

                                    tableBody.append(`
                                        <tr>
                                            <td>${escapeHtml(customer.Area_Name || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Consumer_Number || 'N/A')}</td>
                                            <td>${escapeHtml(customer.Consumer_Name || 'N/A')}</td>
                                            <td><span class="badge badge-missing">Missing</span></td>
                                            <td>${schemeBadge}</td>
                                            <td>${statusBadge}</td>
                                        </tr>
                                    `);
                                });
                            }

                            // Update pagination
                            $("#customerPageInfo").text(`${startIdx + 1} - ${endIdx} of ${filteredCustomers.length}`);
                            $("#prevPage").toggleClass("disabled", currentPage === 1);
                            $("#nextPage").toggleClass("disabled", endIdx >= filteredCustomers.length);
                        }

                        function getStatusBadge(status) {
                            status = (status || '').toUpperCase();
                            switch(status) {
                                case 'ACTIVE':
                                    return '<span class="badge badge-active">ACTIVE</span>';
                                case 'SUSPENDED':
                                    return '<span class="badge badge-suspended">SUSPENDED</span>';
                                case 'DEACTIVATED':
                                    return '<span class="badge badge-deactived">DEACTIVATED</span>';
                                default:
                                    return '<span class="badge badge-secondary">' + (status || 'N/A') + '</span>';
                            }
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

                        // Event Handlers
                        $(document).on('click', '.clickabled[data-scheme]', function() {
                            if ($(this).hasClass('disabled')) return;

                            const scheme = $(this).data('scheme');
                            const status = $(this).data('status') || 'ALL';
                            const count = parseInt($(this).text());

                            if (count > 0) {
                                showAreaBreakdown(scheme, status);
                            }
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
                            if (currentPage * recordsPerPage < filteredCustomers.length) {
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
                            if (currentAreaPage * recordsPerPage < filteredAreas.length) {
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
                            showAreaBreakdown(currentScheme, currentStatus);
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

    <!-- Form validation script -->
    <script src= "<?php echo base_url(); ?>application/views/javascript/dashboard.js"></script>
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

        // Function to format the current date and time
        function formatDateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            return now.toLocaleString('en-US', options);
        }

        // Function to update the refresh time display
        function updateRefreshTime() {
            const refreshTimeElement = document.getElementById('refreshTime');
            const lastRefreshElement = document.getElementById('lastRefresh');
            
            if (refreshTimeElement && lastRefreshElement) {
                refreshTimeElement.textContent = formatDateTime();
                lastRefreshElement.style.display = 'block'; // Show the refresh time
            }
        }

        // Event listener for the download button
        document.getElementById('downloadBtn').addEventListener('click', function(event) {
            // Update the refresh time when the button is clicked
            updateRefreshTime();
          
            console.log('SDMS Report button clicked');
        });

        // Initialize the refresh time when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateRefreshTime();
        });

        // // Function to handle dashboard card clicks
        // function showDetails(section) {
        //     // You can implement navigation logic here
        //     console.log('Navigating to:', section);
        // }
    </script>
    <!-- Access Denied Modal -->
    <div class="modal fade" id="accessDeniedModal" tabindex="-1" aria-labelledby="accessDeniedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="accessDeniedModalLabel"><i class="fas fa-exclamation-triangle me-2"></i> Access Denied</h5>
                    <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body text-center">
                    You do not have permission to access this page. Please contact your admin for assistance.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($access_denied) && $access_denied): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modalElement = document.getElementById('accessDeniedModal');
                var accessDeniedModal = new bootstrap.Modal(modalElement);

                // Show the modal
                accessDeniedModal.show();

                // Redirect to dashboard when modal is closed
                modalElement.addEventListener('hidden.bs.modal', function () {
                    window.location.href = "<?= base_url('dashboard') ?>";
                });
            });
        </script>
    <?php endif; ?>



</body>
</html>

<!-- <td>
        <a href="#" class="clickabled" style="text-decoration: none;">
            <img src="<?= base_url('Image/w1.png') ?>" 
            alt="WhatsApp" 
            class="whatsapp_icon" 
            style="width:40px;height:40px;cursor:pointer;" 
            data-tooltip="Send message WhatsApp">
            Whatsapp
        </a>
    </td> -->
