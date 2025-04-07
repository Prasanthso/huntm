<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nil Refill Report</title>
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
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
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
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
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
        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
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
            margin: 15px auto;
            display: none;
        }
        .fixed-summary {
            /* position: sticky; */
            top: 0;
            background-color: white;
            /* z-index: 100; */
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .content-section {
            margin-top: 20px;
            padding-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nil Refill Data</h2>
        
        <!-- Fixed Summary Table -->
        <div class="fixed-summary">
            <table id="summaryTable">
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
        
        <!-- Main Content Area -->
        <div class="content-section">
            <button id="backButton" class="btn btn-outline-primary btn-sm">Back</button>

            <!-- Area Breakdown View -->
            <div id="areaBreakdownView" class="hidden">
                <h4 class="view-title" id="areaBreakdownTitle"></h4>
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
                    <ul class="pagination justify-content-center">
                        <li class="page-item" id="prevAreaPage"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" id="currentAreaPage">1</a></li>
                        <li class="page-item" id="nextAreaPage"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Customer Details View -->
            <div id="customerDetailsView" class="hidden">
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
</body>
</html>