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

        /* Filter Section */
        .filter-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-section label {
            font-weight: 500;
            margin-right: 10px;
        }

        .filter-section select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            min-width: 150px;
        }

        /* No data message */
        .no-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }
        .badge-pmuy {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
        }
        .badge-non-pmuy {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
        }
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-primary">Customer Strength Data</h2>

        <!-- Filter Section -->
        <div class="filter-section d-flex flex-wrap gap-3 p-3 bg-light rounded">
            <div>
                <label for="areaFilter" class="fw-bold">Area Name:</label>
                <select id="areaFilter" class="form-select select2" multiple></select>
            </div>
            <div>
                <label for="statusFilter" class="fw-bold">Status:</label>
                <select id="statusFilter" class="form-select select2" multiple>
                    <option value="ACTIVE">Active</option>
                    <option value="SUSPENDED">Suspended</option>
                    <option value="DEACTIVATED">Deactivated</option>
                </select>
            </div>
        </div>
         <!-- Customer Summary Table -->
         <table class="summary-table">
            <thead>
                <tr>
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
                    <td><?= $customer_data['active']['pmuy']; ?></td>
                    <td><?= $customer_data['active']['non_pmuy']; ?></td>
                    <td><?= $customer_data['active']['total']; ?></td>
                    <td><?= $customer_data['suspended']['pmuy']; ?></td>
                    <td><?= $customer_data['suspended']['non_pmuy']; ?></td>
                    <td><?= $customer_data['suspended']['total']; ?></td>
                    <td><?= $customer_data['deactivated']['pmuy']; ?></td>
                    <td><?= $customer_data['deactivated']['non_pmuy']; ?></td>
                    <td><?= $customer_data['deactivated']['total']; ?></td>
                    <td><?= $customer_data['total']['pmuy']; ?></td>
                    <td><?= $customer_data['total']['non_pmuy']; ?></td>
                    <td><?= $customer_data['total']['total']; ?></td>
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
                    <th>Consumer Sub Status</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
                <?php if (!empty($customers)) { ?>
                    <?php foreach ($customers as $customer) { ?>
                        <tr>
                            <td><?= htmlspecialchars($customer['area_name']); ?></td>
                            <td><?= htmlspecialchars($customer['consumer_id']); ?></td>
                            <td><?= htmlspecialchars($customer['consumer_name']); ?></td>
                            <td>
                                <span class="badge <?= ($customer['scheme_selected'] == 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy'; ?>">
                                    <?= htmlspecialchars($customer['scheme_selected']); ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($customer['consumer_sub_status']); ?></td>
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
            <ul class="pagination">
                <li class="page-item disabled" id="prevPage"><a class="page-link">Previous</a></li>
                <li class="page-item"><a class="page-link" id="currentPage">1</a></li>
                <li class="page-item" id="nextPage"><a class="page-link">Next</a></li>
            </ul>
        </nav>
    </div>

    <script>
        $(document).ready(function () {
            $(".select2").select2({ width: '200px' });

            let currentPage = 1;
            const recordsPerPage = 10;
            let filteredRows = [];
            const tableBody = document.getElementById("customerTableBody");
            const originalRows = Array.from(tableBody.getElementsByTagName("tr"));

            function populateAreaFilter() {
                const areaFilter = document.getElementById("areaFilter");
                const areas = new Set(originalRows.map(row => row.cells[0]?.textContent.trim()));
                areas.forEach(area => {
                    if (area) {
                        const option = document.createElement("option");
                        option.value = area;
                        option.textContent = area;
                        areaFilter.appendChild(option);
                    }
                });
            }

            function filterTable() {
                const selectedAreas = $("#areaFilter").val();
                const selectedStatuses = $("#statusFilter").val();

                filteredRows = originalRows.filter(row => {
                    const area = row.cells[0]?.textContent.trim();
                    const status = row.cells[4]?.textContent.trim();
                    const areaMatch = selectedAreas.length === 0 || selectedAreas.includes(area);
                    const statusMatch = selectedStatuses.length === 0 || selectedStatuses.includes(status);
                    return areaMatch && statusMatch;
                });

                if (filteredRows.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="5" class="no-data">No matching data found</td></tr>';
                } else {
                    currentPage = 1;
                    updateTable();
                }
            }

            function updateTable() {
                tableBody.innerHTML = "";
                const start = (currentPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const pageRows = filteredRows.slice(start, end);

                if (pageRows.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="5" class="no-data">No data available</td></tr>';
                } else {
                    pageRows.forEach(row => tableBody.appendChild(row.cloneNode(true)));
                }

                document.getElementById("currentPage").textContent = currentPage;
                document.getElementById("prevPage").classList.toggle("disabled", currentPage === 1);
                document.getElementById("nextPage").classList.toggle("disabled", end >= filteredRows.length);
            }

            document.getElementById("prevPage").addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });

            document.getElementById("nextPage").addEventListener("click", () => {
                if ((currentPage * recordsPerPage) < filteredRows.length) {
                    currentPage++;
                    updateTable();
                }
            });

            $("#areaFilter, #statusFilter").on("change", filterTable);

            populateAreaFilter();
            filterTable();
        });
    </script>
</body>
</html>
