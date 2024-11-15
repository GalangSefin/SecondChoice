document.querySelectorAll('.button-shipped').forEach(button => {
    if (button.textContent.trim() !== "Pesanan Diterima") {
      button.disabled = true;  // Menonaktifkan tombol
      button.style.cursor = 'not-allowed';  // Mengubah kursor menjadi not-allowed
      button.style.opacity = '0.6';  // Mengubah tampilan tombol agar terlihat tidak aktif
    }
  });
  