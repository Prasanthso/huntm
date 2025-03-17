<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to External Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Enter Credentials & Website URL</h2>
        <form action="<?= base_url('LoginIntoAnotherWebsite/login'); ?>" method="POST">
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="login_url" class="form-label">Login URL</label>
                <input type="text" class="form-control" id="login_url" name="login_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Login to Website</button>
        </form>
    </div>
</body>
</html>
