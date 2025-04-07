<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hose Due Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin: 20px 0;
            color: #007BFF;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .summary-section {
            /* position: fixed; */
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            /* z-index: 1000; */
            padding: 20px;
            border-bottom: 2px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        /* .content-section {
            margin-top: 100px;
        } */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-pmuy { background-color: #28a745; color: white; }
        .badge-non-pmuy { background-color: #dc3545; color: white; }
        .badge-due { background-color: #ffc107; color: black; }
        .badge-pending { background-color: #fd7e14; color: white; }
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
        .clickable:hover { color: #0056b3; }
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
            padding: 20px;
        }
        .pagination { justify-content: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="summary-section">
        <div class="container">
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
            <div id="areaView" style="display: none;">
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
            <div id="customerDetailsView" style="display: none;">
                <h4 class="view-title" id="customerDetailsTitle"></h4>
                <a href="#" class="back-button" id="backToAreas">Back to Areas</a>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Consumer ID</th>
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
                                <td>${customer.consumer_id || 'N/A'}</td>
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
</body>
</html>