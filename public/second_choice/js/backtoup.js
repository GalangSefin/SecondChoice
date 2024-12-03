// Ambil elemen tombol
const backToTopButton = document.getElementById("backToTop");

// Fungsi untuk menampilkan atau menyembunyikan tombol
function toggleBackToTopButton() {
    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollPosition > 200) {
        backToTopButton.classList.add("show"); // Tambahkan kelas untuk menampilkan tombol
    } else {
        backToTopButton.classList.remove("show"); // Hapus kelas untuk menyembunyikan tombol
    }
}

// Event listener saat halaman di-scroll
window.addEventListener("scroll", toggleBackToTopButton);

// Fungsi untuk menggulir ke atas
backToTopButton.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
});
