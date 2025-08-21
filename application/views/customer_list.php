<!DOCTYPE html>
<html>
<head>
    <title>Send WhatsApp Message</title>
</head>
<body>
    <h2>Customer List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Customer ID</th>
            <th>Phone</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <?php foreach ($customers as $cust): ?>
            <tr>
                <td><?= $cust->name ?></td>
                <td><?= $cust->customer_id ?></td>
                <td><?= $cust->phone ?></td>
                <td>₹<?= number_format($cust->amount, 2) ?></td>
                <td>
                    <a href="<?= base_url('whatsapp/send_message/' . $cust->id) ?>">
                        Send WhatsApp
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
