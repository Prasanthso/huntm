<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1000px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            color: #333;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .password-hidden {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 5px;
            color: #555;
        }
        .truncate-url {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            vertical-align: middle;
        }
        .btn-copy {
            background: none;
            border: none;
            cursor: pointer;
            color: #007bff;
            font-size: 14px;
        }
        .btn-copy:hover {
            text-decoration: underline;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Copied to clipboard!");
            });
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Stored Websites</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <table class="table">
        <tr>
            <th>Website URL</th>
            <th>Username</th>
            <th>Password</th>
            <th>Login</th>
        </tr>
        <?php foreach ($websites as $website): ?>
            <tr>
                <td>
                    <span class="truncate-url"><?php echo htmlspecialchars($website['website_url']); ?></span>
                    <button class="btn-copy" onclick="copyToClipboard('<?php echo htmlspecialchars($website['website_url']); ?>')">📋</button>
                </td>
                <td><?php echo htmlspecialchars($website['website_userId']); ?></td>
                <td class="password-hidden">******</td>
                <td>
                    <form action="<?php echo site_url('User/auto_login'); ?>" method="POST">
                        <input type="hidden" name="url" value="<?php echo htmlspecialchars($website['website_url']); ?>">
                        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($website['website_userId']); ?>">
                        <input type="hidden" name="password" value="<?php echo htmlspecialchars($website['website_password']); ?>">
                        <button type="submit">Auto-Login</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
