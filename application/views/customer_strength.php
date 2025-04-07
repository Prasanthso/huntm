<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Strength Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .fixed-summary {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .main-content {
            margin-top: 20px;
        }
        .summary-table-customer {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table-customer th, .summary-table-customer td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        .summary-table-customer th {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .header-row th {
            background-color: #d1e7dd;
        }
        .clickable {
            cursor: pointer;
            color: #0d6efd;
        }
        .clickable:hover {
            text-decoration: underline;
            background-color: #f8f9fa;
        }
        .badge-pmuy {
            background-color: #198754;
            color: white;
        }
        .badge-non-pmuy {
            background-color: #6c757d;
            color: white;
        }
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
        .view-title {
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .navigation-controls {
            margin-bottom: 15px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Strength Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .fixed-summary {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .main-content {
            margin-top: 20px;
        }
        .summary-table-customer {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table-customer th, .summary-table-customer td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        .summary-table-customer th {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .header-row th {
            background-color: #d1e7dd;
        }
        .clickable {
            cursor: pointer;
            color: #0d6efd;
        }
        .clickable:hover {
            text-decoration: underline;
            background-color: #f8f9fa;
        }
        .badge-pmuy {
            background-color: #198754;
            color: white;
        }
        .badge-non-pmuy {
            background-color: #6c757d;
            color: white;
        }
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
        .view-title {
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .navigation-controls {
            margin-bottom: 15px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary mb-4">Customer Strength Data</h2>

        <!-- Fixed Summary Table -->
        <div class="fixed-summary">
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
        <div id="mainContent" class="main-content">
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
</body>
</html>