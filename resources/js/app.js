alert('app.js LOADED');

console.log('app.js loaded');

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/**
 * 🔥 MUST be attached to window
 */
window.addToCart = function (productId) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
        },
        body: JSON.stringify({ product_id: productId }),
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cart-count')?.innerText = data.count;
                showToast(data.message);
            }
        })
        .catch(() => alert('Error adding to cart'));
};

function showToast(message) {
    const toast = document.createElement('div');
    toast.innerText = message;
    toast.className =
        'fixed bottom-6 right-6 bg-green-600 text-white px-4 py-3 rounded shadow z-50';
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2000);
}
