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
    </style>
</head>
<body>
    <div class="container">
        <h2>KYC Data Table</h2>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="areaFilter" class="fw-bold">Area Name:</label>
                    <select id="areaFilter" class="form-select select2" multiple="multiple"></select>
                </div>
                <div class="col-md-4">
                    <label for="kycStatusFilter" class="fw-bold">KYC Status:</label>
                    <select id="kycStatusFilter" class="form-select">
                        <option value="">All</option>
                        <option value="complete">Complete</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="schemeFilter" class="fw-bold">Scheme:</label>
                    <select id="schemeFilter" class="form-select">
                        <option value="">All</option>
                        <option value="PMUY">PMUY</option>
                        <option value="Non PMUY">Non PMUY</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Summary Table -->
        <table class="custom-table">
            <thead>
                <tr class="head-row">
                    <th rowspan="2">KYC Data</th>
                    <th colspan="3">KYC Pending</th>
                </tr>
                <tr class="sub-header">
                    <th>PMUY</th>
                    <th>Non PMUY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kyc_data)) : ?>
                    <?php foreach ($kyc_data as $row) : ?>
                        <tr>
                            <td>Qty</td>
                            <td><?= htmlspecialchars($row["PMUY"] ?? 0) ?></td>
                            <td><?= htmlspecialchars($row["Non_PMUY"] ?? 0) ?></td>
                            <td><?= htmlspecialchars($row["Total"] ?? 0) ?></td>
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

        <!-- Detailed Table -->
        <table class="custom-table mt-3">
            <thead>
                <tr>
                    <th>Area Name</th>
                    <th>Consumer ID</th>
                    <th>Consumer Name</th>
                    <th>Scheme Selected</th>
                    <th>KYC Number</th>
                    <th>KYC Status</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
                <?php if (!empty($kycdata)) : ?>
                    <?php foreach ($kycdata as $kyc_data) : ?>
                        <?php $kycStatus = !empty($kyc_data['kyc_number']) && $kyc_data['kyc_number'] !== '' ? 'complete' : 'pending'; ?>
                        <tr data-kyc-status="<?= $kycStatus ?>" data-scheme="<?= htmlspecialchars($kyc_data['scheme_selected'] ?? '') ?>">
                            <td><?= htmlspecialchars($kyc_data['area_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($kyc_data['consumer_id'] ?? '') ?></td>
                            <td><?= htmlspecialchars($kyc_data['consumer_name'] ?? '') ?></td>
                            <td>
                                <span class="badge <?= ($kyc_data['scheme_selected'] === 'PMUY') ? 'badge-pmuy' : 'badge-non-pmuy' ?>">
                                    <?= htmlspecialchars($kyc_data['scheme_selected'] ?? '') ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($kyc_data['kyc_number'] ?? 'Not Available') ?></td>
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

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center mt-3">
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

                $("#areaFilter").empty().append('<option></option>');
                areas.forEach(area => {
                    $("#areaFilter").append(new Option(area, area));
                });
            }

            // Filter table based on selected area, KYC status, and scheme
            function filterTable() {
                const selectedAreas = $("#areaFilter").val() || [];
                const selectedStatus = $("#kycStatusFilter").val();
                const selectedScheme = $("#schemeFilter").val();

                filteredRows = originalRows.filter(row => {
                    const area = row.cells[0]?.textContent.trim();
                    const kycStatus = row.getAttribute('data-kyc-status');
                    const scheme = row.getAttribute('data-scheme');
                    
                    const areaMatch = selectedAreas.length === 0 || selectedAreas.includes(area);
                    const statusMatch = !selectedStatus || kycStatus === selectedStatus;
                    const schemeMatch = !selectedScheme || scheme === selectedScheme;

                    return areaMatch && statusMatch && schemeMatch;
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
                    tableBody.innerHTML = '<tr><td colspan="6" class="no-data">No matching data found</td></tr>';
                } else {
                    pageRows.forEach(row => tableBody.appendChild(row.cloneNode(true)));
                }

                $("#currentPage").text(currentPage);
                $("#prevPage").toggleClass("disabled", currentPage === 1);
                $("#nextPage").toggleClass("disabled", (currentPage * recordsPerPage) >= filteredRows.length);
            }

            // Pagination controls
            $("#prevPage").on("click", function (e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });

            $("#nextPage").on("click", function (e) {
                e.preventDefault();
                if ((currentPage * recordsPerPage) < filteredRows.length) {
                    currentPage++;
                    updateTable();
                }
            });

            // Filter change events
            $("#areaFilter").on("change", filterTable);
            $("#kycStatusFilter").on("change", filterTable);
            $("#schemeFilter").on("change", filterTable);

            // Initial setup
            populateAreaFilter();
            filterTable();
        });
    </script>
</body>
</html>