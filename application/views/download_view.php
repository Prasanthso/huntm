<!-- application/views/download_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Selection</title>
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .report-list {
            list-style: none;
            padding: 0;
        }
        .report-item {
            margin: 10px 0;
        }
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
        h1 {
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Select Report to Download</h1>
        
        <ul class="report-list">
            <!-- Example reports - modify these based on your actual report names -->
            <li class="report-item">
                <a href="<?php echo site_url('report_selection/fetch_report/' . urlencode('Distributor_Sales')); ?>" 
                   class="download-btn">Download Distributor Sales Report</a>
            </li>
            <li class="report-item">
                <a href="<?php echo site_url('report_selection/fetch_report/' . urlencode('Inventory_Status')); ?>" 
                   class="download-btn">Download Inventory Status Report</a>
            </li>
            <li class="report-item">
                <a href="<?php echo site_url('report_selection/fetch_report/' . urlencode('Delivery_Schedule')); ?>" 
                   class="download-btn">Download Delivery Schedule Report</a>
            </li>
        </ul>
    </div>
</body>
</html>