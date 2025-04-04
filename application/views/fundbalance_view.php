<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Balance Data Upload</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .message { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
        .form-group { margin-bottom: 15px; }
        .form-control { padding: 8px; width: 100%; max-width: 400px; }
        .btn { padding: 8px 15px; background-color: #337ab7; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #286090; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Fund Balance Data</h2>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="message success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('error')): ?>
            <div class="message error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <p><?php echo $message; ?></p>
        
        <form action="<?php echo site_url('fundbalance_uploadfile'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="excel_file" class="form-control" accept=".xls,.xlsx,.csv">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Upload File</button>
            </div>
        </form>
    </div>
</body>
</html>