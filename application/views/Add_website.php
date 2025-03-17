<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            width: 50%;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .form-container:hover {
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0px 0px 5px rgba(106, 17, 203, 0.5);
        }
        .input-group-text {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: black;
        }
        .btn-primary {
            background: #6a11cb;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #2575fc;
        }
        .text-danger {
            font-size: 0.875rem;
            margin-top: 5px;
            padding-left: 50px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Remove error messages dynamically
            document.querySelectorAll("input, select").forEach(input => {
                input.addEventListener("input", function() {
                    const errorElement = this.parentElement.nextElementSibling;
                    if (errorElement && errorElement.classList.contains("text-danger")) {
                        errorElement.style.display = "none"; 
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="form-container">
        <h3 class="text-center mb-4"><i class="fas fa-globe"></i> Add Website</h3>

        <form action="<?= base_url('User/store'); ?>" method="POST">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                    <input type="text" name="url" class="form-control" placeholder="Website URL" value="<?= set_value('url') ?>">
                </div>
                <?php if (!empty($errors['url'])): ?>
                    <small class="text-danger"><?= $errors['url']; ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="userId" class="form-control" placeholder="UserId" value="<?= set_value('userId') ?>"> 
                </div>
                <?php if (!empty($errors['userId'])): ?>
                    <small class="text-danger"><?= $errors['userId']; ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <small class="text-danger"><?= $errors['password']; ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    <select name="user_id" class="form-select">
                        <option value="">Select a user</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if (!empty($errors['user_id'])): ?>
                    <small class="text-danger"><?= $errors['user_id']; ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>

    </div>
</body>
</html>
