application/views/dashboard.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="/application/views/user.css"> -
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        
        .list-group-item:hover {
            background-color: #f1f1f1;
        }
        
        .dropdown-toggle {
            color: white;
            font-weight: bold;
        }
        
        .dropdown-menu {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
        }
        
        .dropdown-item:hover {
            background-color: #dcdcdc;
            color: black;
        }
        
        .content {
            margin-left: 270px;
            padding: 20px;
            flex-grow: 1;
            width: calc(100% - 250px);
        }
    </style>
</head>
<body>
    <!-- Header --
    <header>
        <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center text-white">
            <img src="<?php echo base_url('/Image/Huntm-logo.svg'); ?>" alt="Huntm Logo" class="huntmlogo">
            <span class="navbar-brand">Huntm</span>
        </a>
    </header>
    
    <div class="main-container">
        <!-- Sidebar --
        <div id="sidebar" class="border-end">
            <div class="list-group list-group-flush">
                <a href="<?php echo base_url('user/dashboardview'); ?>" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="<?php echo base_url('user/submit_suggestion'); ?>" class="list-group-item list-group-item-action">Suggestion</a>
                
                <div class="list-group-item">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-decoration-none" href="#" role="button" id="websiteDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Website
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="websiteDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('website/add'); ?>">Add Website</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('website/store'); ?>">Store Website</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <?php if (isset($method)) { ?>
                <!-- Dashboard Section -->
                <?php if ($method == 'dashboard') { ?>
                    <h1>Welcome to Dashboard</h1>

                    <!-- Suggestion section --
                <?php } elseif ($method == 'suggestion') { ?>
                    <div class="suggest-form">
                        <div class="image-section"> 
                            <img src="/Huntm/Image/Suggestion-image.jpg" alt="Suggestion"> 
                        </div>
                        <form id="suggestionForm" method="post" action="<?= base_url('user/submit_suggestion'); ?>">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="anonymous" name="anonymous"> Submit Anonymously
                            </label>
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

                            <!-- <div class="form-group">
                                <input type="text" name="name" placeholder="Enter your name" id="name" class="form-control validate">
                                <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                            </div> -->

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
                <?php } else { ?>
                    <h1>Page Not Found</h1>
                <?php } ?>
            <?php } else { ?>
                <h1>Invalid Request</h1>
            <?php } ?>
        </main>

    </div>
    <script>
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
                    };
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
                    case "name":
                        return "Please enter your Name.";
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