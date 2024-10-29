document.getElementById('cart-button').addEventListener('click', function () {
    var cartDetails = document.getElementById('cart-details');
    if (cartDetails.classList.contains('cart-hidden')) {
        cartDetails.classList.remove('cart-hidden');
    } else {
        cartDetails.classList.add('cart-hidden');
    }
});

function deleteItem() {
    alert("Item dihapus dari keranjang.");
}
