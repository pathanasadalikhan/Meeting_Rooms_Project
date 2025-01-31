const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    // Toggle password visibility
    eyeIcon.addEventListener('click', function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    });