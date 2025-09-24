<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Area Messaging</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table th {
            border-top: none;
        }
        .thead-success {
            background: linear-gradient(45deg, #128C7E, #25D366);
        }
        .btn-success {
            background-color: #128C7E;
            border-color: #128C7E;
        }
        .btn-success:hover {
            background-color: #0C6B58;
            border-color: #0C6B58;
        }
        .modal-header { 
            background: linear-gradient(45deg, #128C7E, #25D366);
            color: white;
        }
        .modal-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #25D366;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h3 class="mb-4"><i class="fab fa-whatsapp text-success"></i> Customer Distribution by Area</h3>

        <!-- Success/Error Messages -->
        <div id="alert-container">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Areas Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-success">
                        <tr>
                            <th>Area Name</th>
                            <th>Total Customers</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($areas as $area): ?>
                            <tr>
                                <td><?= htmlspecialchars($area['area']) ?></td>
                                <td><?= $area['total'] ?></td>
                                <td>
                                    <button class="btn btn-success send-message-btn" 
                                            data-area="<?= htmlspecialchars($area['area']) ?>" 
                                            data-total="<?= $area['total'] ?>">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">
                        <i class="fab fa-whatsapp"></i> Confirm Message Sending
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to send WhatsApp messages to all customers in this area?</p>
                    <div class="alert alert-info">
                        <strong>Area:</strong> <span id="modal-area-name"></span><br>
                        <strong>Number of customers:</strong> <span id="modal-customer-count"></span>
                    </div>
                    <p class="text-muted">This action will send a message to all customers in the selected area.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a id="confirm-send-btn" href="#" class="btn btn-success">
                        <i class="fab fa-whatsapp"></i> Send Messages
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Handle click on WhatsApp buttons
            $('.send-message-btn').click(function() {
                // Get area data from button attributes
                var area = $(this).data('area');
                var total = $(this).data('total');
                
                // Update modal content
                $('#modal-area-name').text(area);
                $('#modal-customer-count').text(total + ' customers');
                
                // Set the href for the confirmation button
                var url = "<?= base_url('whatsapp/sending_message?area=') ?>" + encodeURIComponent(area);
                $('#confirm-send-btn').attr('href', url);
                
                // Show the modal
                $('#confirmationModal').modal('show');
            });
            
            // Auto-close alerts after 5 seconds
            // setTimeout(function() {
            //     $('.alert').alert('close');
            // }, 5000);
        });
    </script>
</body>
</html>