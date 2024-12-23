document.addEventListener("DOMContentLoaded", () => {
    // Utility Functions
    const showError = (element, message) => {
        const errorDiv = document.getElementById(`${element.id}Error`);
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
            element.classList.add('error');
        }
    };

    const hideError = (element) => {
        const errorDiv = document.getElementById(`${element.id}Error`);
        if (errorDiv) {
            errorDiv.classList.remove('show');
            element.classList.remove('error');
        }
    };

    const validateEmail = (email) => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    };

    const validatePassword = (password) => {
        return password.length >= 8;
    };

    // Form Validation
    const validateForm = (form) => {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            hideError(input);

            if (!input.value.trim()) {
                showError(input, `${input.previousElementSibling.textContent} is required.`);
                isValid = false;
            } else {
                // Email validation
                if (input.type === 'email' && !validateEmail(input.value.trim())) {
                    showError(input, 'Please enter a valid email address.');
                    isValid = false;
                }
                
                // Password validation
                if (input.type === 'password') {
                    if (!validatePassword(input.value)) {
                        showError(input, 'Password must be at least 8 characters long.');
                        isValid = false;
                    }
                    
                    // Password confirmation validation
                    if (input.id === 'confirm_password') {
                        const password = form.querySelector('#password');
                        if (password && input.value !== password.value) {
                            showError(input, 'Passwords do not match.');
                            isValid = false;
                        }
                    }
                }
            }
        });

        return isValid;
    };

    // Handle Login Form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            if (!validateForm(loginForm)) {
                e.preventDefault();
            }
        });

        // Real-time validation
        loginForm.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                hideError(input);
                if (input.value.trim()) {
                    if (input.type === 'email' && !validateEmail(input.value.trim())) {
                        showError(input, 'Please enter a valid email address.');
                    }
                    if (input.type === 'password' && !validatePassword(input.value)) {
                        showError(input, 'Password must be at least 8 characters long.');
                    }
                }
            });
        });
    }

    // Handle Register Form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            if (!validateForm(registerForm)) {
                e.preventDefault();
            }
        });

        // Real-time validation
        registerForm.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                hideError(input);
                if (input.value.trim()) {
                    if (input.type === 'email' && !validateEmail(input.value.trim())) {
                        showError(input, 'Please enter a valid email address.');
                    }
                    if (input.type === 'password') {
                        if (!validatePassword(input.value)) {
                            showError(input, 'Password must be at least 8 characters long.');
                        }
                        if (input.id === 'confirm_password') {
                            const password = registerForm.querySelector('#password');
                            if (password && input.value !== password.value) {
                                showError(input, 'Passwords do not match.');
                            }
                        }
                    }
                }
            });
        });
    }
});