<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7fc;
            color: #333;
        }
        h2 {
            text-align: center;
            margin: 40px 0;
            color: #007BFF;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .custom-table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        .custom-table th, .custom-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        .custom-table th {
            background-color: #28a745;
            color: #fff;
            font-weight: 500;
        }
        .custom-table td {
            background-color: #f9f9f9;
        }
        .custom-table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        .custom-table tr:hover td {
            background-color: #e2f1ff;
        }
        .badge-pmuy {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-non-pmuy {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .filter-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }
        .select2-container {
            min-width: 200px;
            width: 100% !important;
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
        #backButton {
            display: none;
            margin-bottom: 15px;
        }
        #areaBreakdownView, #customerDetailsView {
            margin-top: 30px;
        }
        .fixed-summary {
            /* position: sticky; */
            top: 20px;
            background-color: white;
            /* z-index: 100; */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>KYC Data Table</h2>
        
        <!-- Fixed Summary Table -->
        <div class="fixed-summary" id="summaryTableContainer">
            <table class="custom-table" id="summaryTable">
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
            <div id="areaBreakdownView" style="display: none;">
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
            <div id="customerDetailsView" style="display: none;">
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer ID</th>
                            <th>Consumer Name</th>
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
                                    <td><?= htmlspecialchars($kyc_data['consumer_id'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($kyc_data['consumer_name'] ?? '') ?></td>
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
                                <td>${customer.consumer_id || 'N/A'}</td>
                                <td>${customer.consumer_name || 'N/A'}</td>
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
</body>
</html>