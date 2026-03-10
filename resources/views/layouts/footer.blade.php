<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/homtepage.css', 'resources/js/my.js'])
</head>
<body>
   <footer class="site-footer">
    <div class="footer-container">
        <!-- Company Info -->
        <div class="footer-about">
            <h3>About Us</h3>
            <p>We provide quality products at affordable prices. Shop with confidence and enjoy fast delivery.</p>
        </div>

        <!-- Customer Support -->
        <div class="footer-support">
            <h3>Customer Support</h3>
            <ul>
                <li><a href="{{ route('faq') }}">FAQs</a></li>
                <li><a href="{{ route('returns') }}">Returns & Refunds</a></li>
                <li><a href="{{ route('shipping') }}">Shipping Info</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="footer-social">
            <h3>Follow Us</h3>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} YourStore. All rights reserved.</p>
    </div>
</footer>
 
</body>
</html>