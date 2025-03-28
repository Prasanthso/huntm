<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestion Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            font-size: 16px; 
            font-weight: 400; 
            color: #333; 
            line-height: 1.6; 
            background-color:rgb(3, 89, 116); 
        } 

        header { 
            position: fixed; 
            top: 0; left: 0; 
            width: 100%; 
            background-color:#2C3E50; 
            padding: 10px 20px; 
            z-index: 1000; 
        } 

        .huntmlogo{ 
            width:50px; 
            height:50px; 
        } 

        a{ 
            text-decoration: none; 
        } 

        .container{ 
            display: grid; 
            grid-template-columns: repeat(2, 1fr); 
            gap:20px; 
            margin-top:10%; 
            padding: 20px; 
        } 

        .suggest-form { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            width: 100%; 
            text-align: center; 
            position: relative;
            right: -18%; 
            border: 1px solid;
        } 

        .suggest-content{ 
            position: relative;
            left: -18%; 
        } 

        .suggest-content h1{ 
            font-size: 50px; 
            font-weight: bold; 
            color: white; 
        } 

        .suggest-content p{ 
            text-align: left; 
            display: flex; 
            align-items: center; 
            font-size: 20px; 
            color: white; 
            padding:5px 0; 
        } 

        .suggest-content i{ 
            font-size: 20px; 
            padding-right: 10px; 
            color:#0000FF; 
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
    </style>
</head>
<body>

<header>
    <a href="#"><h1 style="font-size:25px; color:white;"><img src="/Image/Huntm-logo.svg" alt="Huntm Logo" class="huntmlogo">Huntm</h1></a>
</header>
<div class="container">
    <div class="suggest-content"> 
        <h1>Keep your customers engaged with your business</h1> 
        <p><i class="fas fa-chevron-right"></i> Send campaigns to your customers</p> 
        <p><i class="fas fa-chevron-right"></i> Track the results</p> 
        <p><i class="fas fa-chevron-right"></i> Manage your customers</p> 
        <p><i class="fas fa-chevron-right"></i> Get insights</p> 
    </div>
    <div class="suggest-form">
        <div class="image-section"> 
            <img src="/Image/Suggestion-image.jpg" alt="Suggestion"> 
        </div>
        <form id="suggestionForm" method="post" action="<?= base_url('submitsuggetions'); ?>">
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
