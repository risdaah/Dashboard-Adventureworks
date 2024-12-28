// Ambil elemen toggle dan field password
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');

// Tambahkan event listener untuk toggle
togglePassword.addEventListener('click', function () {
    const icon = this.querySelector('i'); // Ikon di dalam tombol
    if (passwordField.type === 'password') {
        passwordField.type = 'text'; // Ubah ke teks
        icon.classList.remove('fa-eye'); // Ganti ikon ke mata dicoret
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password'; // Ubah kembali ke password
        icon.classList.remove('fa-eye-slash'); // Ganti ikon kembali ke mata
        icon.classList.add('fa-eye');
    }
});