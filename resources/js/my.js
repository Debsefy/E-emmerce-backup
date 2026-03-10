  document.getElementById("menuToggle").addEventListener("click", function () {
    const menu = document.getElementById("headerLinks");
    menu.classList.toggle("active");

    // Change icon
    this.textContent = menu.classList.contains("active") ? "✖" : "☰";
});

  
  
  let slides = document.querySelectorAll('.hero-slider .slide');
  let index = 0;

  function showSlide() {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      if (i === index) slide.classList.add('active');
    });
    index = (index + 1) % slides.length;
  }

  setInterval(showSlide, 4000); // change every 4 seconds





// document.querySelectorAll('.add-to-cart').forEach(button => {
//     button.addEventListener('click', function() {
//         let productId = this.dataset.id;

//         fetch(`/cart/add/${productId}`, {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ quantity: 1 })
//         })
//         .then(response => response.json())
//         .then(data => {

//             document.getElementById('cart-count').textContent = data.count;
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });


document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // stop page refresh

        const productId = this.dataset.id;
        const formData = new FormData(this);

        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            // ✅ update header cart count dynamically
            document.querySelector('.cart-count').textContent = data.cartCount;
        });
    });
});
