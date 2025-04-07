document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");

    hamburger.addEventListener("click", function () {
        sidebar.classList.toggle("active");
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", function (event) {
        if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !hamburger.contains(event.target)) {
            sidebar.classList.remove("active");
        }
    });
});
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

function showDetails(type) {
let title = document.getElementById('details-title');
let list = document.getElementById('details-list');
let detailsSection = document.getElementById('details');

list.innerHTML = ''; // Clear previous data

if (type === 'backlog') {
title.innerText = '👥 Backlog';
list.innerHTML = `
    <li class="list-group-item"> No of.Area : 50</li>
    <li class="list-group-item"> 🕒 Pending Qty: 2</li>
    <li class="list-group-item"> ✅ Open Qty: 50</li>
    <li class="list-group-item">  Total : 52</li>`;
} 
else if (type === 'fundbalance') {
title.innerText = '📦 fundbalance Details';
list.innerHTML = `
    <li class="list-group-item">Balance 💲123 </li>`;
} 
else if (type === 'revenue') {
title.innerText = '💰 Revenue Breakdown';
list.innerHTML = `
    <li class="list-group-item">January: 💲3,500</li>
    <li class="list-group-item">February: 💲4,200</li>`;
} 
else if (type === 'sbc') {
title.innerText = '🛍️ SBC Customers';
list.innerHTML = `
    <li class="list-group-item"> Qty : 100 </li>
    <li class="list-group-item"> Percentage: 10%</li>`;
} 
else if (type === 'customers') {
title.innerText = '👨‍💼 Customers Strength';
list.innerHTML = `
    <li class="list-group-item"> Active: 450 </li>
    <li class="list-group-item"> Suspended : 5</li>
    <li class="list-group-item"> Deactived: 40 </li>`;
} 

else if (type === 'nilrefill') {
title.innerText = '🚛 Nilrefill List';
list.innerHTML = `
    <li class="list-group-item"> Less than 6 months.</li>
    <ul>
    <li class="list-group-item"> Qty:</li>
    <li class="list-group-item"> Percentage:</li>
    </ul>
    <li class="list-group-item"> Less than 1 Year.</li>
    <ul>
    <li class="list-group-item"> Qty:</li>
    <li class="list-group-item"> Percentage:</li>
    </ul>
    `;
} 
else if (type === 'kyc') {
title.innerText = '📉 KYC Pending';
list.innerHTML = `
    <li class="list-group-item">PMUY </li>
    <ul>
    <li>Qty</li>
    <li>Percentage</li>
    </ul>
    <li class="list-group-item">Utilities: 💲800</li>`;
} 
// else if (type === 'kyc') {
//     title.innerText = '📉 Expense Report';
//     list.innerHTML = `
//         <li class="list-group-item">Rent: 💲1,500</li>
//         <li class="list-group-item">Utilities: 💲800</li>`;
// } 
else if (type === 'profits') {
title.innerText = '📈 Profit Summary';
list.innerHTML = `
    <li class="list-group-item">January: 💲3,000</li>
    <li class="list-group-item">February: 💲3,900</li>`;
}

detailsSection.style.display = 'block';
}