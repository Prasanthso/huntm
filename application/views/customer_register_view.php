<!DOCTYPE html>
<html>
<head>
    <title>Customer Register - File Upload</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 3px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .upload-form {
            margin-top: 20px;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Register - Upload Excel File</h2>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="message success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="message error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="upload-form">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('customerregister'); ?>">
                <input type="file" name="excel_file" accept=".xls,.xlsx,.csv" required>
                <br>
                <input type="submit" value="Upload Excel">
            </form>
        </div>
    </div>
</body>
</html>