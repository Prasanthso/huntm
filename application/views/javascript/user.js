document.addEventListener("DOMContentLoaded", function () {
    let inputs = document.querySelectorAll("input, select, textarea");

    inputs.forEach(input => {
        input.addEventListener("input", function () {
            if (this.classList.contains("invalid")) {
                this.classList.remove("invalid"); 
                let errorDiv = this.nextElementSibling;
                if (errorDiv && errorDiv.classList.contains("error")) {
                    errorDiv.remove(); 
                }
            }
        });
    });
});