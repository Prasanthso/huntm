<!DOCTYPE html>
<html>
<head>
    <title>CSV Import</title>
    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script> <!-- Ensure jQuery is included -->
</head>
<body>

<h2>Upload CSV File</h2>

<!-- Success & Error Messages -->
<?php if ($this->session->flashdata('success')) : ?>
    <p style="color:green;"><?= $this->session->flashdata('success'); ?></p>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <p style="color:red;"><?= $this->session->flashdata('error'); ?></p>
<?php endif; ?>

<!-- CSV Upload Form -->
<form action="<?= base_url('Csv_import/import_csv'); ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="csv_file" required>
    <br><br>

    <!-- Buttons for Import & Clear Data -->
    <button type="submit">Import</button>
    <button type="button" id="clearData">Clear Data</button>
</form>

<script>
    document.getElementById('clearData').addEventListener('click', function () {
        if (confirm("Are you sure you want to clear all existing data?")) {
            window.location.href = "<?= base_url('Csv_import/clear_data'); ?>";
        }
    });
</script>

</body>
</html>
