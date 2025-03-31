<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
		 .content {
            margin-left: 260px; /* Push content to the right */
            padding: 20px;
        }
		
        .dashboard-card {
            color: white;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
            padding: 15px;
            font-size: 14px;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
        }
        .card-1 { background: linear-gradient(45deg, #FF5733, #C70039); }
        .card-2 { background: linear-gradient(45deg, #FFC300, #FF5733); }
        .card-3 { background: linear-gradient(45deg, #28A745, #1E7E34); }
        .card-4 { background: linear-gradient(45deg, #17A2B8, #117A8B); }
        .details-section {
            display: none;
        }
    </style>
</head>
<body>

<div class="content">
    <div class="container mt-4">
        <h3 class="text-center mb-3">📊 <b>Dashboard</b></h3>

        <div class="row g-2">
            <!-- Row 1 -->
            <div class="col-3">
                <div class="card text-center dashboard-card card-1" onclick="showDetails('customers')">
                    <h6>👥 Customers</h6>
                    <p class="fs-5">150</p>
                </div>
            </div>
            
            <!-- Row 2 -->
            <div class="col-3">
                <div class="card text-center dashboard-card card-2" onclick="showDetails('orders')">
                    <h6>📦 Orders</h6>
                    <p class="fs-5">320</p>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="col-3">
                <div class="card text-center dashboard-card card-3" onclick="showDetails('revenue')">
                    <h6>💰 Revenue</h6>
                    <p class="fs-5">$12,500</p>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="col-3">
                <div class="card text-center dashboard-card card-4" onclick="showDetails('products')">
                    <h6>🛍️ Products</h6>
                    <p class="fs-5">50</p>
                </div>
            </div>
        </div>

        <!-- Dynamic Details Section (Below Row 4) -->
        <div class="details-section mt-3 p-3 border rounded bg-light" id="details">
            <h5 id="details-title" class="text-center">Details</h5>
            <ul class="list-group" id="details-list">
                <li class="list-group-item">Click on a card to see details.</li>
            </ul>
        </div>
    </div>
</div>

    <script>
        function showDetails(type) {
            let title = document.getElementById('details-title');
            let list = document.getElementById('details-list');
            let detailsSection = document.getElementById('details');

            list.innerHTML = ''; // Clear previous data

            if (type === 'customers') {
                title.innerText = '👥 Customer List';
                list.innerHTML = '<li class="list-group-item">John Doe</li><li class="list-group-item">Jane Smith</li><li class="list-group-item">David Johnson</li>';
            } else if (type === 'orders') {
                title.innerText = '📦 Order Details';
                list.innerHTML = '<li class="list-group-item">Order #123 - ✅ Completed</li><li class="list-group-item">Order #124 - 🕒 Pending</li>';
            } else if (type === 'revenue') {
                title.innerText = '💰 Revenue Breakdown';
                list.innerHTML = '<li class="list-group-item">January: 💲3,500</li><li class="list-group-item">February: 💲4,200</li>';
            } else if (type === 'products') {
                title.innerText = '🛍️ Product List';
                list.innerHTML = '<li class="list-group-item">Laptop</li><li class="list-group-item">Smartphone</li>';
            }

            detailsSection.style.display = 'block';
        }
    </script>

</body>
</html>
