<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <?php if ($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
    <?php if ($this->session->flashdata('error')) echo $this->session->flashdata('error'); ?>

    <form action="<?= base_url('forgotpassword/update_password'); ?>" method="POST">
        <input type="hidden" name="token" value="<?= $token; ?>">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
