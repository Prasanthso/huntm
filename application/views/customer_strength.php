<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Strength</title>
    
    <!-- Bootstrap & Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        h2 {
            text-align: center;
            margin: 40px 0;
            color: #007BFF;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #28a745;
            color: #fff;
            font-weight: 500;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #e2f1ff;
        }

        /* Badge styling */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            border-radius: 12px;
        }

        .badge-pmuy {
            background-color: #28a745;
            color: white;
        }

        .badge-non-pmuy {
            background-color: #dc3545;
            color: white;
        }

        /* Summary Table */
        .summary-table th,
        .summary-table td {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .summary-table th {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .summary-table td {
            text-align: center;
        }

        /* No data message */
        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }

        .pagination {
            justify-content: center;
        }

        .page-link {
            cursor: pointer;
        }

        .clickable {
            cursor: pointer;
            text-decoration: underline;
            color: #007bff;
        }

        .clickable:hover {
            color: #0056b3;
        }

        .view-title {
            text-align: center;
            margin-bottom: 20px;
            color: #28a745;
        }

        .summary-controls {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .fixed-summary {
            position: relative;
            top: 0;
            background-color: white;
            z-index: 100;
            padding-top: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        #mainContent {
            margin-top: 20px;
        }

        #backButton {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary">Customer Strength Data</h2>

        <!-- Fixed Summary Table -->
        <div class="fixed-summary">
            <div class="summary-controls">
                <button id="backButton" class="btn btn-outline-primary btn-sm">Back</button>
            </div>
            <table class="summary-table">
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
                        <td><?= $customer_data['active']['total'] ?></td>
                        <td class="clickable" data-status="SUSPENDED" data-scheme="PMUY"><?= $customer_data['suspended']['pmuy'] ?></td>
                        <td class="clickable" data-status="SUSPENDED" data-scheme="NON_PMUY"><?= $customer_data['suspended']['non_pmuy'] ?></td>
                        <td><?= $customer_data['suspended']['total'] ?></td>
                        <td class="clickable" data-status="DEACTIVATED" data-scheme="PMUY"><?= $customer_data['deactivated']['pmuy'] ?></td>
                        <td class="clickable" data-status="DEACTIVATED" data-scheme="NON_PMUY"><?= $customer_data['deactivated']['non_pmuy'] ?></td>
                        <td><?= $customer_data['deactivated']['total'] ?></td>
                        <td><?= $customer_data['total']['pmuy'] ?></td>
                        <td><?= $customer_data['total']['non_pmuy'] ?></td>
                        <td><?= $customer_data['total']['total'] ?></td>
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

        <!-- Main Content Area -->
        <div id="mainContent">
            <!-- Initial view - Area Breakdown -->
            <h4 class="view-title">Customer Distribution by Area</h4>
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Area Name</th>
                        <th>Total Customers</th>
                    </tr>
                </thead>
                <tbody id="initialAreaBreakdown">
                    <!-- Will be populated by JavaScript -->
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                    <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                    <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

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
            
            // Initialize with all customer data
            let allCustomers = <?= json_encode($customers) ?>;
            let customerData = <?= json_encode($customer_data) ?>;
            
            // Load initial area breakdown
            loadInitialAreaBreakdown();

            function loadInitialAreaBreakdown() {
                viewHistory = ['initial'];
                $('#backButton').hide();
                
                // Group customers by area
                const areaCounts = {};
                allCustomers.forEach(customer => {
                    if (!areaCounts[customer.area_name]) {
                        areaCounts[customer.area_name] = 0;
                    }
                    areaCounts[customer.area_name]++;
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
                    areaRows = '<tr><td colspan="2" class="no-data">No data available</td></tr>';
                } else {
                    pageAreas.forEach(({area, count}) => {
                        areaRows += `
                            <tr>
                                <td class="clickable initial-area-click" data-area="${area}">${area || 'N/A'}</td>
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
                    filteredCustomers = allCustomers.filter(customer => customer.area_name === area);
                    loadCustomerDetailsView(null, null, area);
                });
            }
            
            function loadAreaBreakdownView(status, scheme) {
                viewHistory.push('areaBreakdown');
                $('#backButton').show();
                
                currentStatus = status;
                currentScheme = scheme;
                const title = `${status} - ${scheme.replace('_', ' ')} Customers by Area`;
                
                // Filter customers by status and scheme
                filteredCustomers = allCustomers.filter(customer => {
                    return customer.consumer_sub_status === status && 
                          ((scheme === 'PMUY' && customer.scheme_selected === 'PMUY') || 
                           (scheme === 'NON_PMUY' && customer.scheme_selected !== 'PMUY'));
                });
                
                // Group by area
                const areaCounts = {};
                filteredCustomers.forEach(customer => {
                    if (!areaCounts[customer.area_name]) {
                        areaCounts[customer.area_name] = 0;
                    }
                    areaCounts[customer.area_name]++;
                });
                
                // Convert to array for pagination
                allAreas = Object.entries(areaCounts).map(([area, count]) => ({ area, count }));
                currentPage = 1;
                
                const areaBreakdownHTML = `
                    <h4 class="view-title">${title}</h4>
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Area Name</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody id="areaBreakdownBody"></tbody>
                    </table>
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
                    const areaCustomers = filteredCustomers.filter(customer => customer.area_name === area);
                    loadCustomerDetailsView(currentStatus, currentScheme, area);
                });
            }
            
            function loadCustomerDetailsView(status, scheme, area) {
                viewHistory.push('customerDetails');
                $('#backButton').show();
                
                let title = '';
                let customersToShow = [];
                
                if (status && scheme) {
                    title = `${status} - ${scheme.replace('_', ' ')} Customers in ${area || 'N/A'}`;
                    customersToShow = allCustomers.filter(customer => {
                        const statusMatch = customer.consumer_sub_status === status;
                        const schemeMatch = (scheme === 'PMUY' && customer.scheme_selected === 'PMUY') || 
                                          (scheme === 'NON_PMUY' && customer.scheme_selected !== 'PMUY');
                        const areaMatch = customer.area_name === area;
                        return statusMatch && schemeMatch && areaMatch;
                    });
                } else {
                    title = `All Customers in ${area || 'N/A'}`;
                    customersToShow = allCustomers.filter(customer => {
                        return customer.area_name === area;
                    });
                }
                
                filteredCustomers = customersToShow;
                currentPage = 1;
                
                const customerDetailsHTML = `
                    <h4 class="view-title">${title}</h4>
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
                    tableBody.innerHTML = '<tr><td colspan="5" class="no-data">No data available</td></tr>';
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
            $('.summary-table .clickable').on('click', function() {
                loadAreaBreakdownView($(this).data('status'), $(this).data('scheme'));
            });
            
            $('#backButton').on('click', function() {
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
        });
    </script>
</body>
</html>