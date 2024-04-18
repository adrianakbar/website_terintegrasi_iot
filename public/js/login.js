window.onload = function() {
    // Validasi email
    document.getElementById('email').oninvalid = function(event) {
        event.target.setCustomValidity('Mohon isi email');
    };
    document.getElementById('email').oninput = function(event) {
        event.target.setCustomValidity('');
    };

    // Validasi password
    document.getElementById('pass').oninvalid = function(event) {
        event.target.setCustomValidity('Mohon isi password');
    };
    document.getElementById('pass').oninput = function(event) {
        event.target.setCustomValidity('');
    };
};
