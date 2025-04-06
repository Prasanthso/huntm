<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/css/report_page.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/views/css/dashboard.css">
    <style>

    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo">
            <span class="navbar-brand">Huntm</span>
        </a>
        <button class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </header>
    
    <div class="main-container">
        <!-- Sidebar -->
        <div id="sidebar" class="border-end">
            <div class="list-group list-group-flush">
                <a href="<?php echo base_url('dashboard'); ?>" class="list-group-item list-group-item-action">Dashboard</a>
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                            href="#" 
                            role="button" 
                            id="fileUploadDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                                File Upload
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="fileUploadDropdown">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" id="backlogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Backlog
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="backlogDropdown">
                                    <li><a class="dropdown-item" href="<?php echo base_url('WebScrapping'); ?>">Invoice File Upload</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Process File Upload</a></li>
                                </ul>
                            </li>

                            <li><a class="dropdown-item w-100" href="<?php echo base_url('fundbalance'); ?>">Fund Balance</a></li>
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('customerregister'); ?>">Customer Strength</a></li>
                        </ul>
                    </div>
                </div>

                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                            href="#" 
                            role="button" 
                            id="fileUploadDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false" 
                            aria-haspopup="true">
                            Backlog
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="fileUploadDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('invoiceorder'); ?>">Invoice Order Service Area </a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('open-process-order'); ?>">Process Order Service Area</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('OpenOrder'); ?>">Total</a></li>
                        </ul>  
                    </div>
                </div>

                <a class="dropdown-item fileupload list-group-item list-group-item-action w-100" href="<?php echo base_url('fundbalance_data'); ?>">Fund Balance</a>
                        
                  

                <a href="<?php echo base_url('submitsuggetions'); ?>" class="list-group-item list-group-item-action">Suggestion</a>
                
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle fileupload text-decoration-none d-block px-3 py-2" 
                        href="#" 
                        role="button" 
                        id="websiteDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            Website
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="websiteDropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('addwebsite'); ?>">Add Website</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('storewebsite'); ?>">Store Website</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <?php if (isset($method)) { ?>
				
                <!-- Dashboard Section -->
                <?php if ($method == 'dashboard') { ?>
				<!-- <h1>Welcome to Dashboard</h1> -->
				 
<div class="content">
<div class="container-sm mt-3">
<div class="row row-cols-3 g-4 mr-0 pr-0">
    
        <div class="col-md-4">
            <div class="card text-center dashboard-card card-1"  onclick="showDetails('backlog')">
                <h6>👥 Backlog</h6>
                <p class="fs-5">Areas:150</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-2" onclick="showDetails('fundbalance')">
                <h6>📦 Fund Balance</h6>
                <p class="fs-5">Rs:760,461.17</p>
            </div>
        </div>
        <div class="col">
  <div class="card text-center dashboard-card card-3" onclick="window.location.href='customer_strength'">
    <h6>💰 Customer Strength</h6>
    <p class="fs-5">12,500</p>
  </div>
</div>

        <div class="col">
        <div class="card text-center dashboard-card card-3" onclick="window.location.href='SBC_data'">
                <h6>🛍️ SBC</h6>
                <p class="fs-5">Qty:50</p>
            </div>
        </div>

        <!-- <div class="col">
            <div class="card text-center dashboard-card card-5"  onclick="showDetails('employees')">
                <h6>👨‍💼 Employees</h6>
                <p class="fs-5">30</p>
            </div>
        </div> -->
        <div class="col">
        <div class="card text-center dashboard-card card-3" onclick="window.location.href='nillfill'">
                <h6>📝 Nil Refill</h6>
                <p class="fs-5">85</p>
            </div>
        </div>
        <div class="col">
        <div class="card text-center dashboard-card card-3" onclick="window.location.href='kycdata'">
                <h6>🔄  KYC</h6>
                <p class="fs-5">20</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-8"  onclick="window.location.href='midue'">
                <h6>📈 MI Due</h6>
                <p class="fs-5">$8,000</p>
            </div>
        </div>

        <div class="col">
            <div class="card text-center dashboard-card card-9"  onclick="window.location.href='hosedue'">
                <h6>🏭 Hose Due</h6>
                <p class="fs-5">10</p>
            </div>
        </div>
        <div class="col">
            <div class="card text-center dashboard-card card-10"  onclick="window.location.href='phonenumber'">
                <h6>🆕 Mobile No</h6>
                <p class="fs-5">120</p>
            </div>
        </div>
        <!-- <div class="col-3">
            <div class="card text-center dashboard-card card-11" onclick="showDetails('deliveries')">
                <h6>🚚 Deliveries</h6>
                <p class="fs-5">200</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-12"  onclick="showDetails('pending')">
                <h6>⏳ Pending</h6>
                <p class="fs-5">25</p>
            </div>
        </div>

        <!-- <div class="col-3">
            <div class="card text-center dashboard-card card-13"  onclick="showDetails('shipped')">
                <h6>📦 Shipped</h6>
                <p class="fs-5">180</p>
            </div>
        </div> -
        <div class="col-3">
            <div class="card text-center dashboard-card card-14" onclick="showDetails('canceled')">
                <h6>❌ Canceled</h6>
                <p class="fs-5">15</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-15" onclick="showDetails('reviews')">
                <h6>⭐ Reviews</h6>
                <p class="fs-5">300</p>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-center dashboard-card card-16" onclick="showDetails('support')">
                <h6>💬 Support Requests</h6>
                <p class="fs-5">40</p>
            </div>
        </div> -->
    </div>
	<!-- 🔽 Details Section Below the Cards -->
    <div id="details" class="mt-4" style="display: none;">
        <h4 id="details-title"></h4>
        <ul id="details-list" class="list-group"></ul>
    </div>
</div>
</div>
                <!-- Invoice Order sevice area -->
                <?php } elseif ($method == 'invoice_order') { ?>
                    <div class="container1">
                        <div class="card shadow p-4">
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

                     <!-- Open Order sevice area -->
                <?php } elseif ($method == 'open_order') { ?>
                    <div class="container2">
                        <div class="card shadow-lg p-4 ">
                            <h2 class="text-center mb-4">Upload Open Order Data</h2>
                            
                            <!-- Display success or error messages -->
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
                    <div class="container1">
                        <div class="card shadow-lg p-4">
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
                    <div class="container1">
                        <h2>Customer Register Upload Data</h2>

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
                        </div>
                    </div>

                <!-- display open process data in website -->
                <?php } elseif ($method == 'display_invoice_data') { ?>
                    <div class="container3">
                        <h2>Invoice Order Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

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

                    <?php } elseif ($method == 'display_open_data') {?>
                        <div class="container3">
                        <h2>Open Process Service Area</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

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

                    <?php } elseif ($method == 'display_fundbalance') { ?>
                        <div class="container3">
                        <h2>Fund Balance</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>CCA</th>
                                    <th>Balance</th>
                                    <th>Risk Category Code</th>
                                    <th>Risk Category Description</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($fundbalances)): ?>
                                    <?php $serial_no = 1;  ?>
                                    <?php foreach ($fundbalances as $fundbalance): ?>
                                        <tr>
                                            <td><?php echo $serial_no++; ?></td> 
                                            <td><?php echo $fundbalance['cca']; ?></td>
                                            <td><?php echo $fundbalance['balance']; ?></td>
                                            <td><?php echo $fundbalance['risk_category_code']; ?></td>
                                            <td><?php echo $fundbalance['risk_category_description']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No records found.</td> 
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
                        <h3 class="text-center mb-4"><i class="fas fa-globe"></i> Add Website</h3>
                        <form action="<?= base_url('submitaddwebite'); ?>" method="POST">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" name="url" class="form-control" placeholder="Website URL" value="<?= set_value('url') ?>">
                                </div>
                                <?php if (!empty($errors['url'])): ?>
                                    <small class="text-danger"><?= $errors['url']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="userId" class="form-control" placeholder="UserId" value="<?= set_value('userId') ?>"> 
                                </div>
                                <?php if (!empty($errors['userId'])): ?>
                                    <small class="text-danger"><?= $errors['userId']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <?php if (!empty($errors['password'])): ?>
                                    <small class="text-danger"><?= $errors['password']; ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <select name="user_id" class="form-select">
                                        <option value="">Select a user</option>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if (!empty($errors['user_id'])): ?>
                                    <small class="text-danger"><?= $errors['user_id']; ?></small>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>
                    </div>
                    <!-- Display and store website -->
                <?php } elseif ($method == 'store_website') { ?>
                    <div class="container">
                        <h2>Stored Websites</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table">
                            <tr>
                                <th>Website URL</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Login</th>
                            </tr>
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
                                            <button type="submit">Auto-Login</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    
                    <!-- Display customer strength -->
                    <?php } elseif($method == 'customer_strenght') { ?>
                   <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>      
    <div class="container5">
       
        <h2 style="color = #28a745">Customer Strength Data</h2>

        <!-- Fixed Summary Table -->
        <div class="customerstrength-summary">
            <div class="navigation-controls">
                <button id="backButton" class="btn btn-outline-primary btn-sm" style="display: none;">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>
            <div class="table-responsive">
                <table class="summary-table-customer">
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
                            <td>Qty</td>
                            <td class="clickable" data-status="ACTIVE" data-scheme="PMUY"><?= $customer_data['active']['pmuy'] ?></td>
                            <td class="clickable" data-status="ACTIVE" data-scheme="NON_PMUY"><?= $customer_data['active']['non_pmuy'] ?></td>
                            <td class="clickable" data-status="ACTIVE" data-scheme="ALL"><?= $customer_data['active']['total'] ?></td>
                            <td class="clickable" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?></td>
                            <td class="clickable" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?></td>
                            <td class="clickable" data-status="SUSPENDED" data-scheme="ALL"><?= $customer_data['suspended']['total'] ?></td>
                            <td class="clickable" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?></td>
                            <td class="clickable" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?></td>
                            <td class="clickable" data-status="DEACTIVATED" data-scheme="ALL"><?= $customer_data['deactivated']['total'] ?></td>
                            <td class="clickable" data-status="ALL" data-scheme="PMUY"><?= $customer_data['total']['pmuy'] ?></td>
                            <td class="clickable" data-status="ALL" data-scheme="NON_PMUY"><?= $customer_data['total']['non_pmuy'] ?></td>
                            <td class="clickable" data-status="ALL" data-scheme="ALL"><?= $customer_data['total']['total'] ?></td>
                        </tr>
                        <tr>
                            <td>Percent</td>
                            <td><?= round(($customer_data['active']['pmuy'] / $customer_data['total']['pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['active']['non_pmuy'] / $customer_data['total']['non_pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['active']['total'] / $customer_data['total']['total']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['suspended']['pmuy'] / $customer_data['total']['pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['suspended']['non_pmuy'] / $customer_data['total']['non_pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['suspended']['total'] / $customer_data['total']['total']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['deactivated']['pmuy'] / $customer_data['total']['pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['deactivated']['non_pmuy'] / $customer_data['total']['non_pmuy']) * 100, 2) ?>%</td>
                            <td><?= round(($customer_data['deactivated']['total'] / $customer_data['total']['total']) * 100, 2) ?>%</td>
                            <td>100%</td>
                            <td>100%</td>
                            <td>100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Main Content Area -->
        <div id="mainContent" class="customer_area_details">
            <!-- Initial view - Area Breakdown -->
            <h4 class="view-title">Customer Distribution by Area</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
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
                            // Group customers by area for initial display
                            $area_counts = array();
                            foreach ($customers as $customer) {
                                $area = $customer['area_name'] ?? 'Unknown Area';
                                if (!isset($area_counts[$area])) {
                                    $area_counts[$area] = 0;
                                }
                                $area_counts[$area]++;
                            }
                            
                            // Display first 10 areas by default
                            $display_areas = array_slice($area_counts, 0, 10, true);
                            ?>
                            
                            <?php foreach ($display_areas as $area => $count): ?>
                                <tr>
                                    <td class="clickable initial-area-click" data-area="<?= html_escape($area) ?>">
                                        <?= html_escape($area) ?>
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
                    <ul class="pagination">
                        <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                        <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
    $(document).ready(function () {
        let currentPage = 1;
        const recordsPerPage = 10;
        let allAreas = [];
        let filteredCustomers = [];
        let currentStatus = null;
        let currentScheme = null;
        let currentArea = null;
        let viewHistory = [];
        
        // Initialize with all customer data from PHP
        let allCustomers = <?= json_encode($customers) ?>;
        let customerData = <?= json_encode($customer_data) ?>;
        
        // Debug output
        console.log('Loaded customers:', allCustomers);
        console.log('Customer data:', customerData);
        
        // If no customers, show message
        if (!allCustomers || allCustomers.length === 0) {
            $('#initialAreaBreakdown').html('<tr><td colspan="2" class="no-data">No customer data available</td></tr>');
        }

        // Load initial area breakdown
        function loadInitialAreaBreakdown() {
            viewHistory = ['initial'];
            $('#backButton').hide();
            
            // Group customers by area
            const areaCounts = {};
            allCustomers.forEach(customer => {
                const area = customer.area_name || 'Unknown Area';
                if (!areaCounts[area]) {
                    areaCounts[area] = 0;
                }
                areaCounts[area]++;
            });
            
            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            
            // Update table with current page
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
                pageAreas.forEach(({area, count}) => {
                    areaRows += `
                        <tr>
                            <td class="clickable initial-area-click" data-area="${area}">${area}</td>
                            <td>${count}</td>
                        </tr>
                    `;
                });
            }
            
            $('#initialAreaBreakdown').html(areaRows);
            $('#currentPage').text(currentPage);
            
            // Update pagination buttons
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= allAreas.length);
            
            // Add click handlers for area rows
            $('.initial-area-click').off('click').on('click', function() {
                const area = $(this).data('area');
                currentArea = area;
                filteredCustomers = allCustomers.filter(customer => {
                    const customerArea = customer.area_name || 'Unknown Area';
                    return customerArea === area;
                });
                loadCustomerDetailsView(null, null, area);
            });
        }
        
        function loadAreaBreakdownView(status, scheme) {
            viewHistory.push('areaBreakdown');
            $('#backButton').show();
            
            currentStatus = status;
            currentScheme = scheme;
            const title = `${status === 'ALL' ? 'ALL STATUSES' : status} - ${scheme === 'ALL' ? 'ALL SCHEMES' : scheme.replace('_', ' ')} Customers by Area`;
            
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
                if (!areaCounts[area]) {
                    areaCounts[area] = 0;
                }
                areaCounts[area]++;
            });
            
            // Convert to array for pagination
            allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
            currentPage = 1;
            
            const areaBreakdownHTML = `
                <h4 class="view-title">${title}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                    <ul class="pagination">
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
                pageAreas.forEach(({area, count}) => {
                    areaRows += `
                        <tr>
                            <td class="clickable area-click" data-area="${area}">${area || 'N/A'}</td>
                            <td>${count}</td>
                        </tr>
                    `;
                });
            }
            
            $('#areaBreakdownBody').html(areaRows);
            $('#currentPage').text(currentPage);
            
            // Update pagination buttons
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= allAreas.length);
            
            // Add click handlers for area rows
            $('.area-click').off('click').on('click', function() {
                const area = $(this).data('area');
                currentArea = area;
                const areaCustomers = filteredCustomers.filter(customer => {
                    const customerArea = customer.area_name || 'Unknown Area';
                    return customerArea === area;
                });
                loadCustomerDetailsView(currentStatus, currentScheme, area);
            });
        }
        
        function loadCustomerDetailsView(status, scheme, area) {
            viewHistory.push('customerDetails');
            $('#backButton').show();
            
            let title = '';
            let customersToShow = [];
            
            if (status && scheme) {
                title = `${status === 'ALL' ? 'ALL STATUSES' : status} - ${scheme === 'ALL' ? 'ALL SCHEMES' : scheme.replace('_', ' ')} Customers in ${area || 'N/A'}`;
                customersToShow = allCustomers.filter(customer => {
                    const statusMatch = status === 'ALL' ? true : customer.consumer_sub_status === status;
                    const schemeMatch = scheme === 'ALL' ? true : 
                                      (scheme === 'PMUY' ? customer.scheme_selected === 'PMUY' : customer.scheme_selected !== 'PMUY');
                    const areaMatch = (customer.area_name || 'Unknown Area') === area;
                    return statusMatch && schemeMatch && areaMatch;
                });
            } else {
                title = `All Customers in ${area || 'N/A'}`;
                customersToShow = allCustomers.filter(customer => {
                    return (customer.area_name || 'Unknown Area') === area;
                });
            }
            
            filteredCustomers = customersToShow;
            currentPage = 1;
            
            const customerDetailsHTML = `
                <h4 class="view-title">${title}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                    <ul class="pagination">
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
            const tableBody = document.getElementById("customerTableBody");
            
            tableBody.innerHTML = "";
            
            if (pageRows.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6" class="no-data">No data available</td></tr>';
            } else {
                pageRows.forEach(customer => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${customer.area_name || 'N/A'}</td>
                        <td>${customer.consumer_number || 'N/A'}</td>
                        <td>${customer.consumer_name || 'N/A'}</td>
                        <td>${customer.phone_number || 'N/A'}</td>
                        <td>
                            <span class="badge ${customer.scheme_selected == 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                ${customer.scheme_selected || 'N/A'}
                            </span>
                        </td>
                        <td>${customer.consumer_sub_status || 'N/A'}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            $('#currentPage').text(currentPage);
            $('#prevPage').toggleClass("disabled", currentPage === 1);
            $('#nextPage').toggleClass("disabled", end >= filteredCustomers.length);
        }

        // Event listeners
        $('.summary-table-customer .clickable').on('click', function() {
            loadAreaBreakdownView($(this).data('status'), $(this).data('scheme'));
        });
        
        $('#backButton').on('click', function() {
            if (viewHistory.length <= 1) return;
            
            viewHistory.pop(); // Remove current view
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
        $(document).on('click', '#prevPage:not(.disabled)', () => {
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
        
        $(document).on('click', '#nextPage:not(.disabled)', () => {
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
</body>
</html>
                        
                    <?php } elseif($method == 'sbc_data_display') { ?>
                         <!-- Back to Dashboard Button (Always visible) -->
          <div class="dashboard-back-btn">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
                        <div class="container5">
         
        
        <!-- Fixed Summary Section -->
        <div class="sbc_summary">
            <table class="custom-table table_bi_report summary-table" id="summaryTable">
            <h2>SBC Data Report</h2>
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
                        <td class="clickable" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                        <td class="clickable" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                        <td class="clickable" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        <td><?= $table_data['rows']['%'][0] ?>%</td>
                        <td><?= $table_data['rows']['%'][1] ?>%</td>
                        <td><?= $table_data['rows']['%'][2] ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
                    
        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;" class="sbc_area_details">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="custom-table area-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Connection Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
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
                <a class="back-button" id="backToAreaView">← Back to Area Breakdown</a>
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table table_area">
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
                
                // Process the data from the controller
                if (allCustomers && allCustomers.length > 0) {
                    processData();
                }
            }

            function processData() {
                // No special processing needed for SBC data
                // Just ensure all records are properly formatted
                allCustomers.forEach(customer => {
                    // Ensure scheme is properly set (PMUY/Non PMUY)
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
                                <td class="clickable area-click" data-area="${area}">${area || 'N/A'}</td>
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
                                    <span class="badge ${typeBadgeClass}">
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
            $(document).on('click', '.clickable[data-scheme]', function() {
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
        });
    </script>
                    <?php } elseif ($method == 'nillrefil') { ?>
                        <!-- Back to Dashboard Button (Always visible) -->
        <div class="dashboard-back-btn back_dashborad">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        
                        <div class="container5">
        
        <!-- Fixed Summary Table -->
        <div class="nerefil-summary">
            <table id="summaryTable  nilrefil_summary_table">
            <h2>Nil Refill Data</h2>
                <thead>
                    <tr class="header-row">
                        <th rowspan="2">Nil Refill</th>
                        <th colspan="3">6 Months</th>
                        <th colspan="3">1 Year</th>
                    </tr>
                    <tr class="sub-header">
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
                        <td>Qty</td>
                        <td class="clickable" data-period="6_months" data-scheme="pmuy"><?php echo $table_data['greater_than_6_months']['pmuy']['qty'] ?? '0'; ?></td>
                        <td class="clickable" data-period="6_months" data-scheme="non_pmuy"><?php echo $table_data['greater_than_6_months']['non_pmuy']['qty'] ?? '0'; ?></td>
                        <td><?php echo $table_data['greater_than_6_months']['total']['qty'] ?? '0'; ?></td>
                        <td class="clickable" data-period="1_year" data-scheme="pmuy"><?php echo $table_data['greater_than_1_year']['pmuy']['qty'] ?? '0'; ?></td>
                        <td class="clickable" data-period="1_year" data-scheme="non_pmuy"><?php echo $table_data['greater_than_1_year']['non_pmuy']['qty'] ?? '0'; ?></td>
                        <td><?php echo $table_data['greater_than_1_year']['total']['qty'] ?? '0'; ?></td>
                    </tr>
                    <tr>
                        <td>%</td>
                        <td><?php echo $table_data['greater_than_6_months']['pmuy']['percent'] ?? '0'; ?>%</td>
                        <td><?php echo $table_data['greater_than_6_months']['non_pmuy']['percent'] ?? '0'; ?>%</td>
                        <td><?php echo $table_data['greater_than_6_months']['total']['percent'] ?? '0'; ?>%</td>
                        <td><?php echo $table_data['greater_than_1_year']['pmuy']['percent'] ?? '0'; ?>%</td>
                        <td><?php echo $table_data['greater_than_1_year']['non_pmuy']['percent'] ?? '0'; ?>%</td>
                        <td><?php echo $table_data['greater_than_1_year']['total']['percent'] ?? '0'; ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <button id="backButton" class="btn btn-outline-primary btn-sm">Back</button>
        <!-- Main Content Area -->
        <div class="content-section">
            

            <!-- Area Breakdown View -->
            <div id="areaBreakdownView" class="nilrefil_area_details">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="nilrefil_area_count">
                    <thead class="table-success">
                        <tr>
                            <th>Area Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details View -->
            <div id="customerDetailsView" class="nilrefil_customer_details">
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer Number</th>
                            <th>Consumer Name</th>
                            <th>Phone Number</th>
                            <th>Scheme Selected</th>
                            <th>Last Refill Date</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item" id="prevCustomerPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentCustomerPage">1</a></li>
                        <li class="page-item" id="nextCustomerPage"><a class="page-link" href="#">Next</a></li>
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
        // View state management
        let currentView = 'initial'; // 'initial', 'area', 'customer'
        let viewStack = []; // Stack to track navigation history
        
        // Pagination
        const recordsPerPage = 10;
        let currentAreaPage = 1;
        let currentCustomerPage = 1;
        
        // Data
        let allCustomers = <?= json_encode($nillrefill ?? []) ?>;
        let filteredCustomers = [];
        let areaBreakdownData = [];
        let currentPeriod = null;
        let currentScheme = null;
        let currentArea = null;

        // Initialize view
        initView();

        function initView() {
            // Show initial content
            $('#initialContent').show();
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').hide();
            $('#backButton').hide();
            
            // Clear navigation history
            viewStack = [];
            currentView = 'initial';
        }

        function showAreaBreakdown(period, scheme) {
            currentPeriod = period;
            currentScheme = scheme;
            
            // Filter customers based on period and scheme
            const now = new Date();
            filteredCustomers = allCustomers.filter(customer => {
                // Check scheme
                const schemeMatch = (scheme === 'pmuy' && customer.scheme_selected === 'PMUY') || 
                                  (scheme === 'non_pmuy' && customer.scheme_selected !== 'PMUY');
                
                // Check period
                if (!customer.last_refill_date) return false;
                
                const lastRefillDate = new Date(customer.last_refill_date);
                const monthsDiff = (now.getFullYear() - lastRefillDate.getFullYear()) * 12 + 
                                   (now.getMonth() - lastRefillDate.getMonth());
                
                const periodMatch = (period === '6_months' && monthsDiff >= 6) || 
                                  (period === '1_year' && monthsDiff >= 12);
                
                return schemeMatch && periodMatch;
            });
            
            // Group by area
            const areaCounts = {};
            filteredCustomers.forEach(customer => {
                const area = customer.area_name || 'Unknown';
                areaCounts[area] = (areaCounts[area] || 0) + 1;
            });
            
            // Convert to array for display and sort by count descending
            areaBreakdownData = Object.entries(areaCounts)
                .map(([area, count]) => ({ area, count }))
                .sort((a, b) => b.count - a.count);
            
            // Update title
            const periodText = period === '6_months' ? '6 Months' : '1 Year';
            const schemeText = scheme === 'pmuy' ? 'PMUY' : 'Non-PMUY';
            $('#areaBreakdownTitle').text(`Nil Refill Customers (${periodText} - ${schemeText}) by Area`);
            
            // Update view
            currentAreaPage = 1;
            updateAreaBreakdownTable();
            
            // Show area breakdown view
            $('#initialContent').hide();
            $('#areaBreakdownView').show();
            $('#customerDetailsView').hide();
            $('#backButton').show();
            
            // Update navigation stack
            viewStack.push(currentView);
            currentView = 'area';
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
                pageAreas.forEach(({area, count}) => {
                    const row = `<tr>
                        <td class="clickable area-click" data-area="${escapeHtml(area)}">${escapeHtml(area) || 'N/A'}</td>
                        <td>${count}</td>
                    </tr>`;
                    tableBody.append(row);
                });
                
                // Add click handlers for area rows
                $('.area-click').off('click').on('click', function() {
                    const area = $(this).data('area');
                    showCustomerDetails(area);
                });
            }
            
            $("#currentAreaPage").text(currentAreaPage);
            $("#totalAreaPages").text(Math.ceil(areaBreakdownData.length / recordsPerPage));
            $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
            $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
        }

        function showCustomerDetails(area) {
            currentArea = area;
            
            // Filter customers for this area
            const areaCustomers = filteredCustomers.filter(customer => 
                (customer.area_name || 'Unknown') === area
            );
            
            // Update title
            const periodText = currentPeriod === '6_months' ? '6 Months' : '1 Year';
            const schemeText = currentScheme === 'pmuy' ? 'PMUY' : 'Non-PMUY';
            $('#customerDetailsTitle').text(`${escapeHtml(area)} - Nil Refill Customers (${periodText} - ${schemeText})`);
            
            // Update table
            currentCustomerPage = 1;
            updateCustomerDetailsTable(areaCustomers);
            
            // Show customer details view
            $('#areaBreakdownView').hide();
            $('#customerDetailsView').show();
            $('#backButton').show();
            
            // Update navigation stack
            viewStack.push(currentView);
            currentView = 'customer';
        }

        function updateCustomerDetailsTable(customers) {
            const start = (currentCustomerPage - 1) * recordsPerPage;
            const end = start + recordsPerPage;
            const pageRows = customers.slice(start, end);
            const tableBody = $("#customerTableBody");
            
            tableBody.empty();
            
            if (pageRows.length === 0) {
                tableBody.html('<tr><td colspan="6" class="no-data">No data available</td></tr>');
            } else {
                pageRows.forEach(customer => {
                    const lastRefillDate = customer.last_refill_date ? 
                        new Date(customer.last_refill_date).toLocaleDateString() : 'N/A';
                    
                    tableBody.append(`
                        <tr>
                            <td>${escapeHtml(customer.area_name) || 'N/A'}</td>
                            <td>${escapeHtml(customer.consumer_number) || 'N/A'}</td>
                            <td>${escapeHtml(customer.consumer_name) || 'N/A'}</td>
                            <td>${escapeHtml(customer.phone_number) || 'N/A'}</td>
                            <td>
                                <span class="badge ${customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                    ${escapeHtml(customer.scheme_selected) || 'N/A'}
                                </span>
                            </td>
                            <td>${lastRefillDate}</td>
                        </tr>
                    `);
                });
            }
            
            $("#currentCustomerPage").text(currentCustomerPage);
            $("#totalCustomerPages").text(Math.ceil(customers.length / recordsPerPage));
            $("#prevCustomerPage").toggleClass("disabled", currentCustomerPage === 1);
            $("#nextCustomerPage").toggleClass("disabled", end >= customers.length);
        }

        function goBack() {
            if (viewStack.length === 0) {
                initView();
                return;
            }
            
            const previousView = viewStack.pop();
            
            if (previousView === 'initial') {
                // Go back to initial view
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').hide();
                $('#initialContent').show();
                $('#backButton').hide();
                currentView = 'initial';
            } 
            else if (previousView === 'area') {
                // Go back to area breakdown view
                $('#customerDetailsView').hide();
                $('#areaBreakdownView').show();
                $('#backButton').show();
                currentView = 'area';
            }
        }

        // Helper function to escape HTML
        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') return unsafe;
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Event listeners
        $('.clickable[data-period][data-scheme]').on('click', function() {
            showAreaBreakdown($(this).data('period'), $(this).data('scheme'));
        });
        
        $('#backButton').on('click', goBack);
        
        // Pagination controls for area breakdown
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
        
        // Pagination controls for customer details
        $("#prevCustomerPage").on("click", function(e) {
            e.preventDefault();
            if (currentCustomerPage > 1) {
                currentCustomerPage--;
                const customers = filteredCustomers.filter(customer => 
                    (customer.area_name || 'Unknown') === currentArea
                );
                updateCustomerDetailsTable(customers);
            }
        });
        
        $("#nextCustomerPage").on("click", function(e) {
            e.preventDefault();
            const customers = filteredCustomers.filter(customer => 
                (customer.area_name || 'Unknown') === currentArea
            );
            if ((currentCustomerPage * recordsPerPage) < customers.length) {
                currentCustomerPage++;
                updateCustomerDetailsTable(customers);
            }
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
            <table class="custom-table table_summary_kyc" id="summaryTable">
            <h2>KYC Data Table</h2>
                <thead>
                    <tr class="head-row">
                        <th rowspan="2">KYC Data</th>
                        <th colspan="3">KYC Pending</th>
                    </tr>
                    <tr class="sub-header">
                        <th class="clickable" data-scheme="PMUY">PMUY</th>
                        <th class="clickable" data-scheme="Non PMUY">Non PMUY</th>
                        <th class="clickable" data-scheme="Total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kyc_data)) : ?>
                        <?php foreach ($kyc_data as $row) : ?>
                            <tr>
                                <td>Qty</td>
                                <td class="clickable" data-scheme="PMUY"><?= htmlspecialchars($row["PMUY"] ?? 0) ?></td>
                                <td class="clickable" data-scheme="Non PMUY"><?= htmlspecialchars($row["Non_PMUY"] ?? 0) ?></td>
                                <td class="clickable" data-scheme="Total"><?= htmlspecialchars($row["Total"] ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td>%</td>
                                <td><?= htmlspecialchars($row["PMUY_Pending"] ?? '0%') ?></td>
                                <td><?= htmlspecialchars($row["Non_PMUY_Pending"] ?? '0%') ?></td>
                                <td><?= htmlspecialchars($row["Total_Pending"] ?? '0%') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="no-data">No summary data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <button id="backButton" class="btn btn-outline-primary btn-sm">Back</button>
        
        <!-- Main Content Area -->
        <div id="mainContent">
            <!-- Area Breakdown Table (hidden initially) -->
            <div id="areaBreakdownView" style="display: none;" class="kyc-area-details">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details Table -->
            <div id="customerDetailsView" style="display: none;" class="kyc_customer_details">
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer Number</th>
                            <th>Consumer Name</th>
                            <th>Phone Number</th>
                            <th>Scheme Selected</th>
                            <th>KYC Status</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody">
                        <?php if (!empty($kycdata)) : ?>
                            <?php foreach ($kycdata as $kyc_data) : ?>
                                <?php $kycStatus = !empty($kyc_data['kyc_number']) && $kyc_data['kyc_number'] !== '' ? 'complete' : 'pending'; ?>
                                <tr data-area="<?= htmlspecialchars($kyc_data['area_name'] ?? '') ?>" 
                                    data-kyc-status="<?= $kycStatus ?>" 
                                    data-scheme="<?= htmlspecialchars($kyc_data['scheme_selected'] ?? '') ?>">
                                    <td><?= htmlspecialchars($kyc_data['area_name'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($kyc_data['consumer_number'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($kyc_data['consumer_name'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($kyc_data['phone_number'] ?? '') ?></td>
                                    <td>
                                        <span class="badge <?= ($kyc_data['scheme_selected'] === 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy' ?>">
                                            <?= htmlspecialchars($kyc_data['scheme_selected'] ?? '') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $kycStatus === 'complete' ? 'badge-pmuy' : 'badge-non-pmuy' ?>">
                                            <?= ucfirst($kycStatus) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="no-data">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
            // View management variables
            let currentView = 'summary'; // 'summary', 'area', 'customer'
            let viewHistory = [];
            
            // Pagination variables
            let currentPage = 1;
            let currentAreaPage = 1;
            const recordsPerPage = 10;
            
            // Data variables
            let allCustomers = <?= json_encode($kycdata ?? []) ?>;
            let filteredCustomers = [];
            let areaBreakdownData = [];
            let currentScheme = null;
            let currentArea = null;

            // Initialize the view
            initView();

            function initView() {
                // Initialize customer table
                setupCustomerTable();
                
                // Show summary table (always visible)
                $('#summaryTableContainer').show();
                
                // Hide other views initially
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').hide();
                $('#backButton').hide();
            }

            function setupCustomerTable() {
                filteredCustomers = allCustomers;
                currentPage = 1;
                updateCustomerTable();
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
                        const kycStatus = customer.kyc_number && customer.kyc_number !== '' ? 'complete' : 'pending';
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
                                    <span class="badge ${kycStatus === 'complete' ? 'badge-pmuy' : 'badge-non-pmuy'}">
                                        ${kycStatus.charAt(0).toUpperCase() + kycStatus.slice(1)}
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

            function showAreaBreakdown(scheme) {
                currentScheme = scheme;
                
                // Filter customers based on scheme and pending KYC
                filteredCustomers = allCustomers.filter(customer => {
                    const schemeMatch = scheme === 'Total' ? true : customer.scheme_selected === scheme;
                    const kycPending = !customer.kyc_number || customer.kyc_number === '';
                    return schemeMatch && kycPending;
                });
                
                // Group by area
                const areaCounts = {};
                filteredCustomers.forEach(customer => {
                    const area = customer.area_name || 'Unknown';
                    if (!areaCounts[area]) {
                        areaCounts[area] = 0;
                    }
                    areaCounts[area]++;
                });
                
                // Convert to array for display
                areaBreakdownData = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
                
                // Sort by count descending
                areaBreakdownData.sort((a, b) => b.count - a.count);
                
                // Update title
                const title = scheme === 'Total' ? 'Pending KYC Customers (All Schemes) by Area' : `Pending KYC Customers (${scheme}) by Area`;
                $('#areaBreakdownTitle').text(title);
                
                // Update view
                currentAreaPage = 1;
                updateAreaBreakdownTable();
                
                // Show area breakdown view
                $('#areaBreakdownView').show();
                $('#customerDetailsView').hide();
                $('#backButton').show();
                
                // Update view history
                viewHistory.push(currentView);
                currentView = 'area';
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
                    pageAreas.forEach(({area, count}) => {
                        tableBody.append(`
                            <tr>
                                <td class="clickable area-click" data-area="${area}">${area || 'N/A'}</td>
                                <td>${count}</td>
                            </tr>
                        `);
                    });
                    
                    // Add click handlers for area rows
                    $('.area-click').on('click', function() {
                        const area = $(this).data('area');
                        showCustomerDetails(area);
                    });
                }
                
                $("#currentAreaPage").text(currentAreaPage);
                $("#prevAreaPage").toggleClass("disabled", currentAreaPage === 1);
                $("#nextAreaPage").toggleClass("disabled", end >= areaBreakdownData.length);
            }

            function showCustomerDetails(area) {
                currentArea = area;
                
                // Filter customers for this area
                const areaCustomers = filteredCustomers.filter(customer => 
                    (customer.area_name || 'Unknown') === area
                );
                
                filteredCustomers = areaCustomers;
                currentPage = 1;
                
                // Update title
                const schemeText = currentScheme === 'Total' ? 'All Schemes' : currentScheme;
                $('#customerDetailsTitle').text(`Pending KYC Customers (${schemeText}) in ${area}`);
                
                // Update table
                updateCustomerTable();
                
                // Show customer details view
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').show();
                $('#backButton').show();
                
                // Update view history
                viewHistory.push(currentView);
                currentView = 'customer';
            }

            function goBack() {
                if (viewHistory.length === 0) return;
                
                const previousView = viewHistory.pop();
                
                if (previousView === 'summary') {
                    // Hide all views except summary (which is always visible)
                    $('#areaBreakdownView').hide();
                    $('#customerDetailsView').hide();
                    $('#backButton').hide();
                    currentView = 'summary';
                } 
                else if (previousView === 'area') {
                    // Show area breakdown view
                    $('#areaBreakdownView').show();
                    $('#customerDetailsView').hide();
                    currentView = 'area';
                }
                
                if (viewHistory.length === 0) {
                    $('#backButton').hide();
                }
            }

            // Event listeners
            $('.clickable[data-scheme]').on('click', function() {
                showAreaBreakdown($(this).data('scheme'));
            });
            
            $('#backButton').on('click', goBack);
            
            // Pagination controls for customer table
            $("#prevPage").on('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateCustomerTable();
                }
            });
            
            $("#nextPage").on('click', function(e) {
                e.preventDefault();
                if ((currentPage * recordsPerPage) < filteredCustomers.length) {
                    currentPage++;
                    updateCustomerTable();
                }
            });
            
            // Pagination controls for area breakdown
            $("#prevAreaPage").on('click', function(e) {
                e.preventDefault();
                if (currentAreaPage > 1) {
                    currentAreaPage--;
                    updateAreaBreakdownTable();
                }
            });
            
            $("#nextAreaPage").on('click', function(e) {
                e.preventDefault();
                if ((currentAreaPage * recordsPerPage) < areaBreakdownData.length) {
                    currentAreaPage++;
                    updateAreaBreakdownTable();
                }
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
              
        <h2>MI Due Data Table</h2>
        
        <!-- Fixed Summary Section -->
        <div class="midue-summary">
            <table class="custom-table" id="summaryTable">
                <thead>
                    <tr>
                        <th>MI Due</th>
                        <th>PMUY</th>
                        <th>Non PMUY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="summaryTableBody">
                    <tr>
                        <td>Quantity</td>
                        <td class="clickable" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                        <td class="clickable" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                        <td class="clickable" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        <td><?= $table_data['rows']['%'][0] ?>%</td>
                        <td><?= $table_data['rows']['%'][1] ?>%</td>
                        <td><?= $table_data['rows']['%'][2] ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;" class="midue-area-details">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Due Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details Table -->
            <div id="customerDetailsView" style="display: none;" class="midue_customer_details">
                <a class="back-button" id="backToAreaView">← Back to Area Breakdown</a>
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table">
                    <thead>
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
            let allCustomers = <?= json_encode($mi_due ?? []) ?>;
            let filteredCustomers = [];
            let areaBreakdownData = [];
            let currentScheme = null;
            let currentArea = null;

            // Initialize the view
            initView();

            function initView() {
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').hide();
                
                // Process the data from the controller
                if (allCustomers && allCustomers.length > 0) {
                    processData();
                }
            }

            function processData() {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                allCustomers.forEach(customer => {
                    const inspectionDate = customer.mandatory_inspection_date ? new Date(customer.mandatory_inspection_date) : null;
                    
                    if (!inspectionDate) {
                        customer.mi_status = 'pending';
                    } else {
                        inspectionDate.setHours(0, 0, 0, 0);
                        const diffTime = today - inspectionDate;
                        const diffDays = diffTime / (1000 * 60 * 60 * 24);
                        
                        // Only mark as due if inspection is past today's date
                        customer.mi_status = diffDays > 0 ? 'due' : 'scheduled';
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
                    
                    return schemeMatch && customer.mi_status === 'due';
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
                
                $('#areaBreakdownTitle').text(`Due MI Customers (${scheme}) by Area`);
                
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
                                <td class="clickable area-click" data-area="${area}">${area || 'N/A'}</td>
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
                    
                    return areaMatch && schemeMatch && customer.mi_status === 'due';
                });
                
                currentPage = 1;
                
                $('#customerDetailsTitle').text(`Due MI Customers (${currentScheme}) in ${area}`);
                
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
                        let badgeClass = 'badge-due';
                        let statusText = 'Due';
                        
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
                                <td><span class="badge ${badgeClass}">${statusText}</span></td>
                            </tr>
                        `);
                    });
                }
                
                $("#currentPage").text(currentPage);
                $("#prevPage").toggleClass("disabled", currentPage === 1);
                $("#nextPage").toggleClass("disabled", end >= filteredCustomers.length);
            }

            // Event listeners
            $(document).on('click', '.clickable[data-scheme]', function() {
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
            <h2>Hose Due Report</h2>
            <table class="custom-table" id="summaryTable">
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
                        <td>Due Count</td>
                        <td class="clickable" data-scheme="PMUY"><?= isset($table_data['rows']['Qty'][0]) ? $table_data['rows']['Qty'][0] : 0 ?></td>
                        <td class="clickable" data-scheme="Non PMUY"><?= isset($table_data['rows']['Qty'][1]) ? $table_data['rows']['Qty'][1] : 0 ?></td>
                        <td class="clickable" data-scheme="Total"><?= isset($table_data['rows']['Qty'][2]) ? $table_data['rows']['Qty'][2] : 0 ?></td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        <td><?= isset($table_data['rows']['%'][0]) ? $table_data['rows']['%'][0] : 0 ?>%</td>
                        <td><?= isset($table_data['rows']['%'][1]) ? $table_data['rows']['%'][1] : 0 ?>%</td>
                        <td><?= isset($table_data['rows']['%'][2]) ? $table_data['rows']['%'][2] : 0 ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="content-section">
            <!-- Area View -->
            <div id="areaView" style="display: none;" class="hosedue-area-details">
                <h4 class="view-title" id="areaViewTitle"></h4>
                <a href="#" class="back-button" id="backToSummary">Back to Summary</a>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaTableBody"></tbody>
                </table>
            </div>

            <!-- Customer Details View -->
            <div id="customerDetailsView" style="display: none;" class="hosedue_customer_details">
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <a href="#" class="back-button" id="backToAreas">Back to Areas</a>
                <table class="custom-table">
                    <thead>
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
                <nav class="pagination">
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
    <script>
        $(document).ready(function () {
            let currentPage = 1;
            const recordsPerPage = 10;
            let allCustomers = <?= isset($hose_due) ? json_encode($hose_due) : json_encode([]) ?>;
            let filteredCustomers = [];
            let currentScheme = null;
            let currentArea = null;

            initView();

            function initView() {
                $('#areaView').hide();
                $('#customerDetailsView').hide();
                
                if (allCustomers && allCustomers.length > 0) {
                    allCustomers = allCustomers.filter(customer => {
                        return customer.hose_status === 'due' || customer.hose_status === 'pending';
                    });
                }
            }

            $(document).on('click', '.clickable[data-scheme]', function() {
                currentScheme = $(this).data('scheme');
                
                filteredCustomers = allCustomers.filter(customer => {
                    if (currentScheme === 'PMUY') return customer.scheme_selected === 'PMUY';
                    else if (currentScheme === 'Non PMUY') return customer.scheme_selected !== 'PMUY';
                    else return true;
                });
                
                showAreaView();
            });

            function showAreaView() {
                const areaCounts = {};
                filteredCustomers.forEach(customer => {
                    const area = customer.area_name || 'Unknown';
                    areaCounts[area] = (areaCounts[area] || 0) + 1;
                });

                const tableBody = $("#areaTableBody");
                tableBody.empty();
                
                if (Object.keys(areaCounts).length === 0) {
                    tableBody.html('<tr><td colspan="2" class="no-data">No areas found</td></tr>');
                } else {
                    Object.entries(areaCounts).forEach(([area, count]) => {
                        tableBody.append(`
                            <tr>
                                <td class="clickable" data-area="${area}">${area}</td>
                                <td>${count}</td>
                            </tr>
                        `);
                    });
                }

                $('#areaViewTitle').text(`Areas with Due/Pending Hoses (${currentScheme})`);
                $('#areaView').show();
                $('#customerDetailsView').hide();
                $('html, body').animate({scrollTop: $('#areaView').offset().top - 150}, 200);
            }

            $(document).on('click', '.clickable[data-area]', function() {
                currentArea = $(this).data('area');
                currentPage = 1;
                
                const areaCustomers = filteredCustomers.filter(customer => 
                    (customer.area_name || 'Unknown') === currentArea
                );
                
                updateCustomerTable(areaCustomers);
                
                $('#customerDetailsTitle').text(`Due/Pending Hose Replacement (${currentScheme} - ${currentArea})`);
                $('#areaView').hide();
                $('#customerDetailsView').show();
                $('html, body').animate({scrollTop: $('#customerDetailsView').offset().top - 150}, 200);
            });

            function updateCustomerTable(customers) {
                const start = (currentPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const pageRows = customers.slice(start, end);
                const tableBody = $("#customerTableBody");
                
                tableBody.empty();
                
                if (pageRows.length === 0) {
                    tableBody.html('<tr><td colspan="6" class="no-data">No due/pending hoses found</td></tr>');
                } else {
                    pageRows.forEach(customer => {
                        const statusClass = customer.hose_status === 'due' ? 'badge-due' : 'badge-pending';
                        const statusText = customer.hose_status === 'due' ? 'Due' : 'Pending';
                        
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
                                <td><span class="badge ${statusClass}">${statusText}</span></td>
                            </tr>
                        `);
                    });
                }
                
                $("#currentPage").text(currentPage);
                $("#prevPage").toggleClass("disabled", currentPage === 1);
                $("#nextPage").toggleClass("disabled", end >= customers.length);
            }

            $("#prevPage").on("click", function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    const areaCustomers = filteredCustomers.filter(customer => 
                        (customer.area_name || 'Unknown') === currentArea
                    );
                    updateCustomerTable(areaCustomers);
                }
            });
            
            $("#nextPage").on("click", function(e) {
                e.preventDefault();
                const areaCustomers = filteredCustomers.filter(customer => 
                    (customer.area_name || 'Unknown') === currentArea
                );
                if ((currentPage * recordsPerPage) < areaCustomers.length) {
                    currentPage++;
                    updateCustomerTable(areaCustomers);
                }
            });

            $("#backToSummary").on("click", function(e) {
                e.preventDefault();
                $('#areaView').hide();
                $('#customerDetailsView').hide();
            });

            $("#backToAreas").on("click", function(e) {
                e.preventDefault();
                showAreaView();
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
                        <div class="container">
                
        <h2>Phone Number Missing Data</h2>
        
        <!-- Fixed Summary Section -->
        <div class="summary-section">
            <table class="custom-table" id="summaryTable">
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
                        <td class="clickable" data-scheme="PMUY"><?= $table_data['rows']['Qty'][0] ?></td>
                        <td class="clickable" data-scheme="Non PMUY"><?= $table_data['rows']['Qty'][1] ?></td>
                        <td class="clickable" data-scheme="Total"><?= $table_data['rows']['Qty'][2] ?></td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        <td><?= $table_data['rows']['%'][0] ?>%</td>
                        <td><?= $table_data['rows']['%'][1] ?>%</td>
                        <td><?= $table_data['rows']['%'][2] ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Scrollable Content Section -->
        <div class="content-section">
            <!-- Area Breakdown Table -->
            <div id="areaBreakdownView" style="display: none;">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Missing Phone Count</th>
                        </tr>
                    </thead>
                    <tbody id="areaBreakdownBody"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details Table -->
            <div id="customerDetailsView" style="display: none;">
                <a class="back-button" id="backToAreaView">← Back to Area Breakdown</a>
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer Number</th>
                            <th>Consumer Name</th>
                            <th>Phone Number</th>
                            <th>Scheme</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody"></tbody>
                </table>
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
            let allCustomers = <?= json_encode($phone_missing_data ?? []) ?>;
            let filteredCustomers = [];
            let areaBreakdownData = [];
            let currentScheme = null;
            let currentArea = null;

            // Initialize the view
            initView();

            function initView() {
                $('#areaBreakdownView').hide();
                $('#customerDetailsView').hide();
                
                // Process the data from the controller
                if (allCustomers && allCustomers.length > 0) {
                    processData();
                }
            }

            function processData() {
                // No additional processing needed for phone missing data
            }

            function showAreaBreakdown(scheme) {
                currentScheme = scheme;
                
                filteredCustomers = allCustomers.filter(customer => {
                    let schemeMatch = true;
                    if (scheme === 'PMUY') {
                        schemeMatch = customer.scheme_selected === 'PMUY';
                    } else if (scheme === 'Non PMUY') {
                        schemeMatch = customer.scheme_selected !== 'PMUY' && customer.scheme_selected !== '';
                    } else if (scheme === 'Total') {
                        schemeMatch = true; // Show all records for Total
                    }
                    
                    // Only include customers with missing phone numbers
                    return schemeMatch && (!customer.phone_number || customer.phone_number.trim() === '');
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
                
                $('#areaBreakdownTitle').text(`Customers with Missing Phone (${scheme}) by Area`);
                
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
                                <td class="clickable area-click" data-area="${area}">${area || 'N/A'}</td>
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
                        schemeMatch = customer.scheme_selected !== 'PMUY' && customer.scheme_selected !== '';
                    }
                    
                    // Only include customers with missing phone numbers
                    return areaMatch && schemeMatch && (!customer.phone_number || customer.phone_number.trim() === '');
                });
                
                currentPage = 1;
                
                $('#customerDetailsTitle').text(`Customers with Missing Phone (${currentScheme}) in ${area}`);
                
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
                    tableBody.html('<tr><td colspan="5" class="no-data">No data available</td></tr>');
                } else {
                    pageRows.forEach(customer => {
                        let schemeClass = customer.scheme_selected === 'PMUY' ? 'badge-pmuy' : 'badge-non-pmuy';
                        let schemeText = customer.scheme_selected || 'N/A';
                        
                        tableBody.append(`
                            <tr>
                                <td>${customer.area_name || 'N/A'}</td>
                                <td>${customer.consumer_number || 'N/A'}</td>
                                <td>${customer.consumer_name || 'N/A'}</td>
                               <td><span class="badge badge-missing">Missing</span></td>
                                <td>
                                    <span class="badge ${schemeClass}">
                                        ${schemeText}
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
            $(document).on('click', '.clickable[data-scheme]', function() {
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
        });
    </script>
                    <?php } else { ?>
                    <h1>Invalid Request</h1>
                <?php } ?>
            <?php } else { ?>
                <h1>Invalid Request</h1>
            <?php } ?>
        </main>
    </div>
    <script src= "<?php echo base_url(); ?>application/views/javascript /dashboard.js"></script>
    
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
	
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

	
        // Add expand/collapse effect to icons into dashboard
        document.querySelectorAll(".dashboard-card").forEach(card => {
            card.addEventListener("click", function() {
                let icon = this.querySelector(".expand-icon");
                icon.classList.toggle("expand");
            });
        });
  
        document.addEventListener('DOMContentLoaded', function () {
            const fileUploadDropdown = document.getElementById('fileUploadDropdown');
            const backlogDropdown = document.getElementById('backlogDropdown');
            const fundBalanceLink = document.querySelector('a[href*=fundbalance_uploadfile"]');

            fileUploadDropdown.addEventListener('click', function () {
                this.classList.add('active');
            });

            backlogDropdown.addEventListener('click', function () {
                fileUploadDropdown.classList.add('active');
            });

            fundBalanceLink.addEventListener('click', function () {
                fileUploadDropdown.classList.add('active');
            });
        });
        
    </script>
    
</body>
</html>
