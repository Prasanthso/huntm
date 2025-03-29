<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
</head>
<body>
    <h2>Upload Excel File</h2>
    <form action="<?= base_url('ExcelController/upload') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel_file" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
