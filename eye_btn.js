function togglePasswordVisibility() {
    var passwordElement = document.getElementById('suggested_password');
    var buttonElement = document.getElementById('toggle-password-btn');

    // Set the initial state to hide the password
    passwordElement.style.display = 'none';

    // Toggle the password visibility
    buttonElement.onclick = function() {
        if (passwordElement.style.display === 'none' || passwordElement.style.display === '') {
            passwordElement.style.display = 'block';
            buttonElement.innerHTML = '<span class="material-symbols-outlined">visibility</span>';
        } else {
            passwordElement.style.display = 'none';
            buttonElement.innerHTML = '<span class="material-symbols-outlined">visibility_off</span>';
        }
    };
}
