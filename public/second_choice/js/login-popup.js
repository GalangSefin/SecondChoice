document.addEventListener('DOMContentLoaded', function() {
    const loginButton = document.querySelector('.auth-buttons .btn:first-child');
    const registerButton = document.querySelector('.auth-buttons .btn:last-child');
    const loginPopup = document.querySelector('.login-popup');
    const registerPopup = document.querySelector('.register-popup');
    const overlay = document.querySelector('.login-popup-overlay');
    const closeButtons = document.querySelectorAll('.close-button');
    const loginTrigger = document.querySelector('.login-trigger');
    const signupTrigger = document.querySelector('.signup-trigger');
    
    // Fungsi untuk menutup semua popup
    function closeAllPopups() {
        loginPopup.style.display = 'none';
        registerPopup.style.display = 'none';
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Fungsi untuk menampilkan popup tertentu
    function showPopup(popup) {
        closeAllPopups();
        popup.style.display = 'block';
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    
    // Event listeners untuk tombol-tombol
    loginButton.addEventListener('click', function(e) {
        e.preventDefault();
        showPopup(loginPopup);
    });
    
    registerButton.addEventListener('click', function(e) {
        e.preventDefault();
        showPopup(registerPopup);
    });
    
    // Switch antara login dan register
    loginTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        showPopup(loginPopup);
    });
    
    signupTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        showPopup(registerPopup);
    });
    
    // Tambahkan event listener untuk tombol login di popup register
    const loginLinkInRegister = document.querySelector('.login-link .login-trigger');
    if (loginLinkInRegister) {
        loginLinkInRegister.addEventListener('click', function(e) {
            e.preventDefault();
            showPopup(loginPopup);
        });
    }

    // Tambahkan event listener untuk tombol signup di popup login
    const signupLinkInLogin = document.querySelector('.signup-link .signup-trigger');
    if (signupLinkInLogin) {
        signupLinkInLogin.addEventListener('click', function(e) {
            e.preventDefault();
            showPopup(registerPopup);
        });
    }
    
    // Tutup popup dengan tombol close atau klik overlay
    closeButtons.forEach(button => {
        button.addEventListener('click', closeAllPopups);
    });
    
    overlay.addEventListener('click', closeAllPopups);
    
    // Mencegah popup tertutup saat mengklik di dalamnya
    [loginPopup, registerPopup].forEach(popup => {
        popup.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const errorDiv = document.querySelector('.login-popup .error-message');
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            try {
                const response = await fetch('/ajax-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: this.email.value,
                        password: this.password.value
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    errorDiv.textContent = data.message;
                    errorDiv.style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                errorDiv.textContent = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                errorDiv.style.display = 'block';
            } finally {
                submitBtn.disabled = false;
            }
        });
    }

    // Register form handling
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const errorDiv = document.querySelector('.register-popup .error-message');
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            try {
                const response = await fetch('/ajax-register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: this.name.value,
                        email: this.email.value,
                        username: this.username.value,
                        password: this.password.value
                    })
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    let errorMessage = '';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('<br>');
                    } else {
                        errorMessage = data.message;
                    }
                    errorDiv.innerHTML = errorMessage;
                    errorDiv.style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                errorDiv.textContent = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                errorDiv.style.display = 'block';
            } finally {
                submitBtn.disabled = false;
            }
        });
    }
}); 