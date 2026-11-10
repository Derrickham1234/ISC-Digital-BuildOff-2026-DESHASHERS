// ======================================
// UEAB SMART NOTICEBOARD
// JavaScript Functionality
// ======================================

// Display a welcome message in the browser console
console.log("UEAB Smart Noticeboard is running!");

// Validate forms before submission
document.addEventListener("DOMContentLoaded", function () {

    const forms = document.querySelectorAll("form");

    forms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            const inputs = form.querySelectorAll(
                "input[required], textarea[required], select[required]"
            );

            let valid = true;

            inputs.forEach(function (input) {

                if (input.value.trim() === "") {
                    valid = false;
                    input.style.border = "2px solid red";
                } else {
                    input.style.border = "1px solid #cbd5e1";
                }

            });

            if (!valid) {
                event.preventDefault();
                alert("Please complete all required fields.");
            }

        });

    });

});

// Confirm important actions
function confirmAction(message) {
    return confirm(message);
}

// Display current year in console
const currentYear = new Date().getFullYear();

console.log("Current Year: " + currentYear);