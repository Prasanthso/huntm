<!DOCTYPE html>
<html>
<head>
    <title>Send WhatsApp Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Send WhatsApp Message</h2>

    <!-- Flash messages -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <!-- Form to select user -->
    <form method="post" action="<?= site_url('whatsapp/send_message'); ?>">
        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select --</option>
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['id']; ?>"><?= $user['name']; ?> (<?= $user['phone']; ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Send WhatsApp</button>
    </form>

</body>
</html>
