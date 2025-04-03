<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBC Customers Dashboard</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .data-table th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            color: #333;
        }
        .action-btn {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            display: block;
            width: 100%;
        }
        .action-btn:hover {
            background-color: #0056b3;
        }
        .nested-th {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">SBC Customers Data</h2>
        
        <?php if (isset($sbc_customers) && !empty($sbc_customers)): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th rowspan="2">SBC Customers</th>
                        <th colspan="6">Customer Data</th>
                        <th rowspan="2">Options</th>
                    </tr>
                    <tr>
                        <th class="nested-th">PMUY Qty</th>
                        <th class="nested-th">Non PMUY Qty</th>
                        <th class="nested-th">Total Qty</th>
                        <th class="nested-th">PMUY %</th>
                        <th class="nested-th">Non PMUY %</th>
                        <th class="nested-th">Total %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sbc_customers as $status => $data): ?>
                        <tr>
                            <td><?php echo ucfirst($status); ?></td>
                            <td><?php echo $data['pmuy']; ?></td>
                            <td><?php echo $data['non_pmuy']; ?></td>
                            <td><?php echo $data['total']; ?></td>
                            <td><?php echo $data['pmuy_percentage']; ?></td>
                            <td><?php echo $data['non_pmuy_percentage']; ?></td>
                            <td><?php echo $data['total_percentage']; ?></td>
                            <?php if ($status === 'active'): ?>
                                <td rowspan="<?php echo count($sbc_customers); ?>">
                                    <button class="action-btn" onclick="sendAction('sms')">SMS</button>
                                    <button class="action-btn" onclick="sendAction('whatsapp')">Whatsapp</button>
                                    <button class="action-btn" onclick="sendAction('voice')">Voice Call</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No data available to display.</p>
        <?php endif; ?>
    </div>

    <script>
        function sendAction(type) {
            let url;
            const customerName = 'SBC'; // You might want to make this dynamic
            
            switch(type) {
                case 'sms':
                    url = '<?php echo base_url("SBC_data/send_sms/"); ?>' + customerName;
                    break;
                case 'whatsapp':
                    url = '<?php echo base_url("SBC_data/send_whatsapp/"); ?>' + customerName;
                    break;
                case 'voice':
                    url = '<?php echo base_url("SBC_data/send_voice/"); ?>' + customerName;
                    break;
                default:
                    return;
            }
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your request');
                });
        }
    </script>
</body>
</html>