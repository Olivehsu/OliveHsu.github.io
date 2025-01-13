/*register client side form validation*/

// Default messages
let defaultMsg = "";

// Email validation
let emailErrorMsg = "x Email address should be non-empty with the format xyz@xyz.xyz.";
let emailInput = document.querySelector("#email");
let emailError = document.createElement('p');
emailError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[0].append(emailError);

let isEmailValid = false;
function validateEmail() {
    let email = emailInput.value;
    let regexp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (regexp.test(email)) {
        emailError.textContent = defaultMsg;
        isEmailValid = true;
        emailInput.classList.remove("error-border");
    } else {
        emailError.textContent = emailErrorMsg;
        isEmailValid = false;
        emailInput.classList.add("error-border");
    }
    return emailError.textContent;
}
emailInput.addEventListener("input", validateEmail);

// Username validation
let usernameErrorMsg = "x Username should be non-empty and within 30 characters long.";
let usernameInput = document.querySelector("#username");
let usernameError = document.createElement('p');
usernameError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[1].append(usernameError);

let isUsernameValid = false;
function validateUsername() {
    let username = usernameInput.value.trim();
    usernameInput.value = username.toLowerCase();
    if (username === "" || username.length > 30) {
        usernameError.textContent = usernameErrorMsg;
        isUsernameValid = false;
        usernameInput.classList.add("error-border");
    } else {
        usernameError.textContent = defaultMsg;
        isUsernameValid = true;
        usernameInput.classList.remove("error-border");
    }
    return usernameError.textContent;
}
usernameInput.addEventListener("input", validateUsername);

// Password validation
let passwordErrorMsg = "x Password should be at least 8 characters long.";
let passwordInput = document.querySelector("#password");
let passwordError = document.createElement('p');
passwordError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[2].append(passwordError);

let isPasswordValid = false;
function validatePassword() {
    if (passwordInput.value.length < 8) {
        passwordError.textContent = passwordErrorMsg;
        isPasswordValid = false;
        passwordInput.classList.add("error-border");
    } else {
        passwordError.textContent = defaultMsg;
        isPasswordValid = true;
        passwordInput.classList.remove("error-border");
    }
    validatePassword2(); // Re-validate password confirmation when password changes
    return passwordError.textContent;
}
passwordInput.addEventListener("input", validatePassword);

// Confirm password validation
let password2ErrorMsg = "x Passwords do not match";
let password2Input = document.querySelector("#password2");
let password2Error = document.createElement('p');
password2Error.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[3].append(password2Error);

let isPassword2Valid = false;
function validatePassword2() {
    if (password2Input.value !== passwordInput.value || password2Input.value === "") {
        password2Error.textContent = password2ErrorMsg;
        isPassword2Valid = false;
        password2Input.classList.add("error-border");
    } else {
        password2Error.textContent = defaultMsg;
        isPassword2Valid = true;
        password2Input.classList.remove("error-border");
    }
    return password2Error.textContent;
}
password2Input.addEventListener("input", validatePassword2);

// Terms and conditions validation
let termsErrorMsg = "x Please accept the terms and conditions";
let termsCheckbox = document.querySelector("#terms");
let termsError = document.createElement('p');
termsError.setAttribute("class", "warning");
document.querySelector(".checkbox").append(termsError);

let isTermsAccepted = false;
function validateTerms() {
    if (!termsCheckbox.checked) {
        termsError.textContent = termsErrorMsg;
        isTermsAccepted = false;
    } else {
        termsError.textContent = defaultMsg;
        isTermsAccepted = true;
    }
    return termsError.textContent;
}
termsCheckbox.addEventListener("change", validateTerms);

// Form submission validation
function validateForm(event) {
    // Validate all fields
    validateEmail();
    validateUsername();
    validatePassword();
    validatePassword2();
    validateTerms();

    // Check if all validations pass
    if (isEmailValid && isUsernameValid && isPasswordValid && isPassword2Valid && isTermsAccepted) {
        return true; // Allow form submission
    } else {
        event.preventDefault(); // Prevent form submission
        return false;
    }
}

// Reset form error messages
function resetFormErrors() {
    // Reset all error messages
    emailError.textContent = defaultMsg;
    usernameError.textContent = defaultMsg;
    passwordError.textContent = defaultMsg;
    password2Error.textContent = defaultMsg;
    termsError.textContent = defaultMsg;

    // Reset validation states
    isEmailValid = false;
    isUsernameValid = false;
    isPasswordValid = false;
    isPassword2Valid = false;
    isTermsAccepted = false;

    // Remove error borders
    emailInput.classList.remove("error-border");
    usernameInput.classList.remove("error-border");
    passwordInput.classList.remove("error-border");
    password2Input.classList.remove("error-border");
}

// Add form event listeners
let form = document.querySelector("form");
form.addEventListener("submit", validateForm);
form.addEventListener("reset", resetFormErrors);