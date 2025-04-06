<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <?php if($method == 'customer_strenght') { ?>
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
   <?php } ?>
  
</body>
</html>