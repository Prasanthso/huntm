<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBC Data Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
            margin: 20px 0;
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
        .summary-section {
            top: 0;
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 2px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .content-section {
            margin-top: 100px;
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
        .badge-domestic {
            background-color: #17a2b8;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-commercial {
            background-color: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .view-title {
            text-align: center;
            margin: 20px 0;
            color: #28a745;
        }
        .clickable {
            cursor: pointer;
            text-decoration: underline;
            color: #007bff;
        }
        .clickable:hover {
            color: #0056b3;
        }
        .back-button {
            margin: 10px 0;
            display: inline-block;
            cursor: pointer;
            color: #007bff;
            text-decoration: none;
        }
        .back-button:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>SBC Data Report</h2>
        
        <!-- Fixed Summary Section -->
        <div class="summary-section">
            <table class="custom-table" id="summaryTable">
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
            <div id="areaBreakdownView" style="display: none;">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
                <table class="custom-table">
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
                                        ${consumerType}
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
</body>
</html>