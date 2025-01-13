/**
 * Assessment: Lab4
 * Student Name: Lanfang Xu 
 * Lab Professor Name: Professor Hala Own 
 * Lab Section Number: 322 
 * Due Date: Due on Nov 9, 2024
 * The page was created on Nov 9, 2024 
 * This js code is to validate the form.
 */
/**
 * Event listener for newsletter checkbox
 * Shows a warning message about potential spam when checkbox is checked
 */
document.getElementById('newsletter').addEventListener('change', function() {
    if (this.checked) {
        alert("Please be aware that you may receive spam emails with our newsletter!");
    }
});

/**
 * Validates email format using regular expression
 * @param {string} email - The email address to validate
 * @returns {boolean} - True if email format is valid, false otherwise
 */
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
}

/**
 * Displays error message for a form field
 * @param {string} elementId - ID of the form field
 * @param {string} message - Error message to display
 */
function showError(elementId, message) {
    const element = document.getElementById(elementId);
    element.classList.add('error-field');
    document.getElementById(elementId + 'Error').textContent = message;
}

/**
 * Clears error message and styling for a form field
 * @param {string} elementId - ID of the form field
 */
function clearError(elementId) {
    const element = document.getElementById(elementId);
    element.classList.remove('error-field');
    document.getElementById(elementId + 'Error').textContent = '';
}

/**
 * Resets all form errors when the reset button is clicked
 * Removes error messages and error styling from all fields
 */
function resetFormError() {
    const errorElements = document.querySelectorAll('.error');
    errorElements.forEach(element => {
        element.textContent = '';
    });
    const inputElements = document.querySelectorAll('.form-control');
    inputElements.forEach(element => {
        element.classList.remove('error-field');
    });
}

// Add reset event listener to the form
document.getElementById('registrationForm').addEventListener('reset', resetFormError);

/**
 * Real-time validation event listeners
 * Clears errors as soon as the input becomes valid
 */
document.getElementById('email').addEventListener('input', function() {
    if (validateEmail(this.value)) {
        clearError('email');
    }
});

document.getElementById('username').addEventListener('input', function() {
    if (this.value.length > 0 && this.value.length < 30) {
        clearError('username');
    }
});

document.getElementById('password').addEventListener('input', function() {
    if (this.value.length >= 8) {
        clearError('password');
    }
});

document.getElementById('repassword').addEventListener('input', function() {
    if (this.value === document.getElementById('password').value) {
        clearError('repassword');
    }
});

/**
 * Main form validation function
 * Called when the form is submitted
 * Validates all form fields according to requirements
 * @returns {boolean} - True if all validations pass, false otherwise
 */
function validate() {
    let isValid = true;
    
    // Email validation - must be in valid email format
    const email = document.getElementById('email');
    if (!validateEmail(email.value)) {
        showError('email', 'Please enter a valid email address');
        isValid = false;
    } else {
        clearError('email');
    }

    // Username validation - must be non-empty and less than 30 characters
    const username = document.getElementById('username');
    if (username.value.length === 0 || username.value.length >= 30) {
        showError('username', 'Username must be between 1 and 30 characters');
        isValid = false;
    } else {
        clearError('username');
        // Convert username to lowercase before submission
        username.value = username.value.toLowerCase();
    }

    // Password validation - must be at least 8 characters
    const password = document.getElementById('password');
    if (password.value.length < 8) {
        showError('password', 'Password must be at least 8 characters long');
        isValid = false;
    } else {
        clearError('password');
    }

    // Confirm password validation - must match password and not be empty
    const repassword = document.getElementById('repassword');
    if (password.value !== repassword.value) {
        showError('repassword', 'Passwords do not match');
        isValid = false;
    } else if (repassword.value.length === 0) {
        showError('repassword', 'Please confirm your password');
        isValid = false;
    } else {
        clearError('repassword');
    }

    // Terms validation - must be checked
    const terms = document.getElementById('terms');
    if (!terms.checked) {
        showError('terms', 'You must accept the terms and conditions');
        isValid = false;
    } else {
        clearError('terms');
    }

    // If all validations pass
    if (isValid) {
        // Reset form after successful submission
        // Form will submit with GET parameters in URL
        document.getElementById('registrationForm').reset();
    }

    return isValid;
}