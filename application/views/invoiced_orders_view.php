<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoiced Orders by Service Area</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .refresh-btn .bi {
            margin-right: 8px;
        }
        .alert {
            margin-top: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .last-updated {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Invoiced Orders by Service Area</h1>
            <a href="<?php echo site_url('WebScrappingData/auto_login'); ?>" class="btn btn-primary refresh-btn">
                <i class="bi bi-arrow-repeat"></i> Refresh Data
            </a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
                <div class="mt-2">
                    <small>If this persists, please contact support with the exact time this occurred.</small>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Service Area</th>
                            <th class="text-center">CashMemo Count</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['area_name']); ?></td>
                            <td class="text-center"><?php echo $order['cashmemo_generated']; ?></td>
                            <td>
                                <span class="badge bg-<?php echo ($order['status'] == 'Invoiced') ? 'success' : 'warning'; ?>">
                                    <?php echo htmlspecialchars($order['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="last-updated">
                Last updated: <?php echo date('Y-m-d H:i:s'); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <div>
                        No data available. Click "Refresh Data" to fetch from Siebel system.
                        <?php if (file_exists(APPPATH . 'cache/last_response.html')): ?>
                            <div class="mt-2">
                                <small>Technical note: Last response was saved for debugging.</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>