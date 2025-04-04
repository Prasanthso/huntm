<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Layout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        header {
            background-color: #1f2937;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar {
            width: 250px;
            background-color: #1f2937;
            color: white;
            position: fixed;
            height: 100vh;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <button class="toggle-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <div>Huntm</div>
    </header>
    
    <div class="sidebar" id="sidebar">
        <a href="<?php echo base_url('dashboard'); ?>"><img src="/huntm/Image/Huntm-logo.svg" alt="Huntm Logo" style="width: 50px;"><h4>Huntm</h4></a>
        <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        <a href="#">File Upload</a>
        <a href="#">Suggestion</a>
        <a href="#">Website</a>
    </div>
    
	       
    
    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function() {
			if (sidebar.classList.contains("active")) {
				sidebar.classList.remove("active"); // Remove if already active
			} else {
				sidebar.classList.add("active"); // Add if not active
			}
        });
    </script>
</body>
</html>
