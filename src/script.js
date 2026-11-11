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

// Show / hide password (eye icon)
(function () {
    var EYE = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
    var EYE_OFF = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';

    function addEyes() {
        document.querySelectorAll('input[type="password"]').forEach(function (input) {
            if (input.dataset.eye) return;
            input.dataset.eye = "1";

            var wrap = document.createElement("div");
            wrap.className = "password-wrap";
            input.parentNode.insertBefore(wrap, input);
            wrap.appendChild(input);

            var btn = document.createElement("button");
            btn.type = "button";
            btn.className = "eye-btn";
            btn.setAttribute("aria-label", "Show password");
            btn.innerHTML = EYE;

            btn.addEventListener("click", function () {
                var show = input.type === "password";
                input.type = show ? "text" : "password";
                btn.innerHTML = show ? EYE_OFF : EYE;
                btn.setAttribute("aria-label", show ? "Hide password" : "Show password");
            });

            wrap.appendChild(btn);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", addEyes);
    } else {
        addEyes();
    }
})();