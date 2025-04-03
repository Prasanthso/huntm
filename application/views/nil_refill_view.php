<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nil Refill Report</title>
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
        }
        .date-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .date-input {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nil Refill Data</h2>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="areaFilter" class="fw-bold">Area Name:</label>
                    <select id="areaFilter" class="form-select select2" multiple="multiple"></select>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">Last Refill Date Range:</label>
                    <div class="date-filter">
                        <input type="date" id="fromDate" class="form-control date-input">
                        <span>to</span>
                        <input type="date" id="toDate" class="form-control date-input">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button id="resetFilters" class="btn btn-secondary w-100">Reset Filters</button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button id="applyFilters" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </div>

        <!-- Summary Table -->
        <table>
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
                    <td><?php echo $table_data['greater_than_6_months']['pmuy']['qty'] ?? '0'; ?></td>
                    <td><?php echo $table_data['greater_than_6_months']['non_pmuy']['qty'] ?? '0'; ?></td>
                    <td><?php echo $table_data['greater_than_6_months']['total']['qty'] ?? '0'; ?></td>
                    <td><?php echo $table_data['greater_than_1_year']['pmuy']['qty'] ?? '0'; ?></td>
                    <td><?php echo $table_data['greater_than_1_year']['non_pmuy']['qty'] ?? '0'; ?></td>
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

        <!-- Customer Details Table -->
        <table class="table table-bordered mt-3">
            <thead class="table-success">
                <tr>
                    <th>Area Name</th>
                    <th>Consumer ID</th>
                    <th>Consumer Name</th>
                    <th>Scheme Selected</th>
                    <th>Last Refill Date</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
                <?php if (!empty($nillrefill)) { ?>
                    <?php foreach ($nillrefill as $nillrefills) { ?>
                        <tr>
                            <td><?= htmlspecialchars($nillrefills['area_name']); ?></td>
                            <td><?= htmlspecialchars($nillrefills['consumer_id']); ?></td>
                            <td><?= htmlspecialchars($nillrefills['consumer_name']); ?></td>
                            <td>
                                <span class="badge <?= ($nillrefills['scheme_selected'] == 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy'; ?>">
                                    <?= htmlspecialchars($nillrefills['scheme_selected']); ?>
                                </span>
                            </td>
                            <td data-date="<?= date('Y-m-d', strtotime($nillrefills['last_refill_date'])); ?>">
                                <?= htmlspecialchars($nillrefills['last_refill_date']); ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="no-data">No data available</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item" id="prevPage"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                <li class="page-item" id="nextPage"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Select2
            $("#areaFilter").select2({
                placeholder: "Select areas",
                allowClear: true,
                width: '100%'
            });

            // Set default date ranges (last 6 months)
            const today = new Date();
            const sixMonthsAgo = new Date();
            sixMonthsAgo.setMonth(today.getMonth() - 6);
            
            $("#fromDate").val(sixMonthsAgo.toISOString().split('T')[0]);
            $("#toDate").val(today.toISOString().split('T')[0]);

            let currentPage = 1;
            const recordsPerPage = 10;
            let filteredRows = [];
            const tableBody = document.getElementById("customerTableBody");
            const originalRows = Array.from(tableBody.getElementsByTagName("tr"));

            // Populate area filter dropdown
            function populateAreaFilter() {
                const areas = new Set();
                originalRows.forEach(row => {
                    const area = row.cells[0]?.textContent.trim();
                    if (area && area !== "No data available") {
                        areas.add(area);
                    }
                });

                $("#areaFilter").empty();
                areas.forEach(area => {
                    $("#areaFilter").append(new Option(area, area));
                });
            }

            // Filter table based on selected criteria
            function filterTable() {
                const selectedAreas = $("#areaFilter").val() || [];
                const fromDate = $("#fromDate").val();
                const toDate = $("#toDate").val();

                filteredRows = originalRows.filter(row => {
                    // Skip the "no data" row
                    if (row.querySelector('.no-data')) return false;
                    
                    // Area filter
                    const area = row.cells[0]?.textContent.trim();
                    const areaMatch = selectedAreas.length === 0 || selectedAreas.includes(area);
                    
                    // Date filter
                    const dateCell = row.cells[4];
                    const dateStr = dateCell.getAttribute('data-date');
                    if (!dateStr) return areaMatch;
                    
                    const refillDate = new Date(dateStr);
                    const filterFromDate = fromDate ? new Date(fromDate) : null;
                    const filterToDate = toDate ? new Date(toDate) : null;
                    
                    // Check if date is within range
                    let dateMatch = true;
                    if (filterFromDate) dateMatch = dateMatch && (refillDate >= filterFromDate);
                    if (filterToDate) dateMatch = dateMatch && (refillDate <= filterToDate);
                    
                    return areaMatch && dateMatch;
                });

                currentPage = 1;
                updateTable();
            }

            // Update table display with pagination
            function updateTable() {
                tableBody.innerHTML = "";
                const start = (currentPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const pageRows = filteredRows.slice(start, end);

                if (pageRows.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="5" class="no-data">No matching data found</td></tr>';
                } else {
                    pageRows.forEach(row => tableBody.appendChild(row.cloneNode(true)));
                }

                $("#currentPage").text(currentPage);
                $("#prevPage").toggleClass("disabled", currentPage === 1);
                $("#nextPage").toggleClass("disabled", end >= filteredRows.length);
            }

            // Pagination controls
            $("#prevPage").on("click", function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });

            $("#nextPage").on("click", function(e) {
                e.preventDefault();
                if ((currentPage * recordsPerPage) < filteredRows.length) {
                    currentPage++;
                    updateTable();
                }
            });

            // Filter change events
            $("#applyFilters").on("click", filterTable);
            
            // Reset filters
            $("#resetFilters").on("click", function() {
                $("#areaFilter").val(null).trigger('change');
                const sixMonthsAgo = new Date();
                sixMonthsAgo.setMonth(sixMonthsAgo.getMonth() - 6);
                $("#fromDate").val(sixMonthsAgo.toISOString().split('T')[0]);
                $("#toDate").val(new Date().toISOString().split('T')[0]);
                filterTable();
            });

            // Initial setup
            populateAreaFilter();
            filterTable();
        });
    </script>
</body>
</html>