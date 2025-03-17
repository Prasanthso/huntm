<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="<?php echo base_url('assets/css/user.css'); ?>" rel="stylesheet" />
    <style>

        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center; 
            margin: 20px 250px; 
            padding-left: 10px;
        }

        h3{
            padding: 10px 20px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #2C3E50;
            padding: 10px 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
        }
        
        .huntmlogo {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }
        
        a {
            text-decoration: none;
        }
        
        .navbar-brand {
            color: white;
            font-size: 25px;
            margin: 0;
        }
        
        .main-container {
            display: flex;
            margin-top: 80px;
        }
        
        #sidebar {
            width: 250px;
            height: calc(100vh - 80px);
            background-color: #2C3E50;
            padding-top: 20px;
            position: fixed;
            top: 80px;
            left: 0;
        }
        
        .list-group-item {
            border: none;
            background-color: #2C3E50;
            color: white;
        }
        
        .list-group-item a:hover {
            background-color: #f1f1f1;
            color: black;
        }
        
        .form-check{
            padding-top: 10px;
            margin-left: 10px;
        }

        .form-check a{
            color: white;
        }

        /* .form-check:hover {
            background-color: #f1f1f1;
            color: black;
        } */
        
        .dropdown-toggle {
            color: white;
        }

        .dropdown-menu {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            width: 100% !important;
        }

        .dropdown-item {
            display: block;
            width: 100%; 
            padding: 10px 15px;
            transition: background-color 0.3s ease-in-out;
            white-space: nowrap; 
        }

        .dropdown-item:hover {
            background-color: rgba(200, 200, 200, 0.4);
            color: black;
        }

        .suggest-form {
            margin-left: 430px;
            margin-top: 50px;
            width: 70%;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .image-section { 
            position: relative; 
            width: 100%; 
            height: 170px; 
            margin-bottom: 15px; 
        } 

        .image-section img { 
            width: 100%; 
            height: 100%; 
            border-radius: 8px; 
            object-fit: cover; 
        } 

        .image-text { 
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            color: white; 
            font-size: 20px; 
            font-weight: bold; 
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); 
        } 

        input, select, textarea { 
            width: 100%; 
            padding: 10px; 
            margin-top: 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            font-size: 14px; 
        } 

        textarea { 
            height: 80px; 
            resize: none; 
        } 

        .buttons { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 10px; 
        } 

        .recording-btn { 
            background: green; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer;
            transition: 0.3s; 
            margin-top: 10px;
        } 

        .recording-btn1 { 
            background: red; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer;
            transition: 0.3s; 
            margin-top: 10px;
        } 

        .submit-btn { 
            width: 100%; 
            background: #28a745; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
            margin-top: 15px; 
            transition: 0.3s; 
        } 

        .submit-btn:hover { 
            background: #218838; 
        } 

        audio { 
            display: block; 
            margin-top: 10px; 
        }

        #timer {
            color: red;
            font-size: 16px;
            font-weight: bold;
            display: none;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .back-btn {
        background: none;
        border: none;
        color: black;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .back-btn i {
        margin-right: 5px;
        font-size: 15px;
    }

    .form-container {
        width: 100%;
        background: white;
        margin-left: 450px;
        margin-top: 50px;
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

    .container {
        width: 100%;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin-left: 300px;
        margin-top: 50px;
    }
    h2 {
        text-align: center;
        color: #333;
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
    }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .password-hidden {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 5px;
            color: #555;
        }
        .truncate-url {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            vertical-align: middle;
        }
        .btn-copy {
            background: none;
            border: none;
            cursor: pointer;
            color: #007bff;
            font-size: 14px;
        }
        .btn-copy:hover {
            text-decoration: underline;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }
       
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo">
            <span class="navbar-brand">Huntm</span>
        </a>
    </header>
    
    <div class="main-container">
        <!-- Sidebar -->
        <div id="sidebar" class="border-end">
            <div class="list-group list-group-flush">
                <a href="<?php echo base_url('user/dashboardview'); ?>" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="<?php echo base_url('user/submit_suggestion'); ?>" class="list-group-item list-group-item-action">Suggestion</a>
                
                <div class="list-group-item p-0"> 
                    <div class="dropdown w-100"> 
                        <a class="dropdown-toggle text-decoration-none d-block px-3 py-2" 
                        href="#" 
                        role="button" 
                        id="websiteDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            Website
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="websiteDropdown">
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('User/index'); ?>">Add Website</a></li>
                            <li><a class="dropdown-item w-100" href="<?php echo base_url('User/dashboard'); ?>">Store Website</a></li>
                        </ul>
                    </div>
                </div>


                
                 <div class="form-check">
                    <input class="form-check-input me-2" type="checkbox" id="operationCheck">
                    <label class="form-check-label" for="operationCheck">
                        <a href="<?php echo base_url('user/operation'); ?>" class="text-decoration-none">Operation</a>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input me-2" type="checkbox" id="customerReportCheck">
                    <label class="form-check-label" for="customerReportCheck">
                        <a href="<?php echo base_url('user/customer_report'); ?>" class="text-decoration-none">Customer Report</a>
                    </label>
                </div>

            </div>
        </div>
        
        <main>
            <?php if (isset($method)) { ?>
                <!-- Dashboard Section -->
                <?php if ($method == 'dashboard') { ?>
                    <h1>Welcome to Dashboard</h1>

                    <!-- Suggestion Section -->
                <?php } elseif ($method == 'suggestion') { ?>
                    <div class="suggest-form">
                        <div class="image-section"> 
                            <img src="/Huntm/Image/Suggestion-image.jpg" alt="Suggestion"> 
                        </div>
                        <form id="suggestionForm" method="post" action="<?= base_url('user/submit_suggestion'); ?>">
                            
                            <div class="form-group">
                                <input class="form-check-input me-2" type="checkbox" id="anonymous" name="anonymous">
                                <label class="form-check-label" for="anonymous">Submit Anonymously</label>
                            </div>

                            <?php if ($this->session->flashdata('success')): ?>
                                <script>
                                    window.onload = function() {
                                        showAlert("<?php echo $this->session->flashdata('success'); ?>", "success");
                                    };
                                </script>
                            <?php elseif ($this->session->flashdata('error')): ?>
                                <script>
                                    window.onload = function() {
                                        showAlert("<?php echo $this->session->flashdata('error'); ?>", "error");
                                    };
                                </script>
                            <?php endif; ?>
                            <div class="form-group">
                                <select name="application" class="form-control validate" id="application">
                                    <option value="">Application</option>
                                    <option value="SDMS">SDMS</option>
                                    <option value="BI Report">BI Report</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error"><?php echo isset($errors['application']) ? $errors['application'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <select name="suggestion_type" class="form-control validate" id="suggestion_type">
                                    <option value="">Suggestion Type</option>
                                    <option value="Change">Change</option>
                                    <option value="Suggestion">Suggestion</option>
                                </select>
                                <span class="error"><?php echo isset($errors['suggestion_type']) ? $errors['suggestion_type'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-control validate" id="message" placeholder="Enter your message"></textarea>
                                <span class="error"><?php echo isset($errors['message']) ? $errors['message'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="startRecording()" class="recording-btn">Start Recording</button>
                                <button type="button" onclick="stopRecording()" class="recording-btn1">Stop Recording</button>
                                <span id="status"></span>
                                <div id="timer"></div>
                                <audio id="audioPlayback" controls style="display:none;"></audio>
                                <span class="error"><?php echo isset($errors['voice_message']) ? $errors['voice_message'] : ''; ?></span>
                            </div>

                            <?php if (isset($errors['general'])): ?>
                                <div class="alert alert-danger"><?php echo $errors['general']; ?></div>
                            <?php endif; ?>

                            <button type="submit" class="submit-btn">Save</button>
                            <button type="button" class="back-btn" onclick="goBack()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        </form>
                    </div>
                
                        <!-- Add website -->
                    <?php } elseif ($method == 'add_website') { ?>
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

                    <!-- Display and store website -->
                <?php } elseif ($method == 'display_website') { ?>
                    <div class="container">
                        <h2>Stored Websites</h2>

                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <table class="table">
                            <tr>
                                <th>Website URL</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Login</th>
                            </tr>
                            <?php foreach ($websites as $website): ?>
                                <tr>
                                    <td>
                                        <span class="truncate-url"><?php echo htmlspecialchars($website['website_url']); ?></span>
                                        <button class="btn-copy" onclick="copyToClipboard('<?php echo htmlspecialchars($website['website_url']); ?>')">📋</button>
                                    </td>
                                    <td><?php echo htmlspecialchars($website['website_userId']); ?></td>
                                    <td class="password-hidden">******</td>
                                    <td>
                                        <form action="<?php echo site_url('User/auto_login'); ?>" method="POST">
                                            <input type="hidden" name="url" value="<?php echo htmlspecialchars($website['website_url']); ?>">
                                            <input type="hidden" name="userId" value="<?php echo htmlspecialchars($website['website_userId']); ?>">
                                            <input type="hidden" name="password" value="<?php echo htmlspecialchars($website['website_password']); ?>">
                                            <button type="submit">Auto-Login</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php } else { ?>
                    <h1>Invalid Request</h1>
                <?php } ?>
            <?php } else { ?>
                <h1>Invalid Request</h1>
            <?php } ?>
        </main>
    </div>
    <script>
        // Suggetion script
        
        let mediaRecorder;
        let audioChunks = [];
        let audioBase64 = "";
        let timerInterval;
        let startTime;

        function startRecording() {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then((stream) => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();

                    audioChunks = [];
                    mediaRecorder.ondataavailable = (event) => {
                        audioChunks.push(event.data);
                    };

                    document.getElementById('status').innerText = "Recording...";
                    startTimer();
                })
                .catch(() => {
                    alert("Could not access your microphone. Please check permissions.");
                });
        }

        function stopRecording() {
            if (mediaRecorder) {
                mediaRecorder.stop();
                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                    const reader = new FileReader();

                    reader.readAsDataURL(audioBlob);
                    reader.onloadend = () => {
                        audioBase64 = reader.result.split(",")[1]; 
                        document.getElementById('status').innerText = "Recording Stopped.";
                        const audioURL = URL.createObjectURL(audioBlob);
                        const audioPlayer = document.getElementById("audioPlayback");
                        audioPlayer.src = audioURL;
                        audioPlayer.style.display = "block";
                    };
                };
            }
            stopTimer();
        }

        function startTimer() {
            document.getElementById('timer').style.display = "block";
            startTime = Date.now();
            timerInterval = setInterval(() => {
                let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                document.getElementById('timer').innerText = `Recording: ${elapsedTime}s`;
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            document.getElementById('timer').innerText = "Recording Stopped.";
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("suggestionForm");

            form.addEventListener("submit", (e) => {
                if (!validateForm()) {
                    e.preventDefault();
                } else {
                    const audioInput = document.createElement("input");
                    audioInput.type = "hidden";
                    audioInput.name = "voice_message";
                    audioInput.value = audioBase64;
                    form.appendChild(audioInput);
                }
            });

            function validateForm() {
                let isValid = true;
                let fields = document.querySelectorAll('.validate');

                fields.forEach(field => {
                    let errorSpan = field.nextElementSibling;
                    if (field.value.trim() === '') {
                        let fieldName = field.getAttribute("name");
                        let errorMessage = getErrorMessage(fieldName);
                        errorSpan.textContent = errorMessage;
                        isValid = false;
                    } else {
                        errorSpan.textContent = '';
                    }
                });

                return isValid;
            }

            function getErrorMessage(fieldName) {
                switch (fieldName) {
                    case "application":
                        return "Please select an Application.";
                    case "suggestion_type":
                        return "Please choose a Suggestion Type.";
                    case "message":
                        return "Please enter your Message.";
                    default:
                        return "This field is required.";
                }
            }

            document.querySelectorAll(".validate").forEach(input => {
                input.addEventListener("input", () => {
                    const error = input.nextElementSibling;
                    error.textContent = "";
                });
            });
        });

        document.getElementById("anonymous").addEventListener("change", function() {
            let nameField = document.getElementById("name");
            if (this.checked) {
                nameField.value = "";
                nameField.disabled = true;
            } else {
                nameField.disabled = false;
            }
        });

        function goBack() {
            window.location.href = "<?= base_url('user/login_user'); ?>"; // Adjust this to your login route
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Copied to clipboard!");
            });
        }
    </script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    title: "Success!",
                    text: "<?php echo $this->session->flashdata('success'); ?>",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            <?php elseif ($this->session->flashdata('error')): ?>
                Swal.fire({
                    title: "Error!",
                    text: "<?php echo $this->session->flashdata('error'); ?>",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>