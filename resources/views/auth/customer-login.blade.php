<!-- resources/views/auth/customer-login.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
 
</head>
<body>


    <!-- <div class="form-box">
        <h2>Customer Login</h2>
        <form method="POST" action="/login/customer">
            @csrf
            <input type="email" name="email" placeholder="Customer Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div> -->
<div class="login-box">
    <h2>Customer Login</h2>
    <form method="POST" action="{{ route('login.customer') }}">
        @csrf
        <input type="text" name="email" placeholder="Email or Mobile Number*" required>
        
        <input type="password" class="passw" name="password" placeholder="Password*" required>
        
        <button type="submit" class="btn-login">Continue</button>
    </form>

    <div class="login-links">
        <a href="{{ route('password.request') }}">Forgot Password?</a>
        <p>Don't have an account? <a href="{{ route('register.customer') }}">Sign Up</a></p>
    </div>

    <p class="terms">
        By continuing you agree to our 
        <a href="{{ route('terms') }}">Terms & Conditions</a> and 
        <a href="{{ route('privacy') }}">Privacy Policy</a>.
    </p>

    <p class="help">
        Need help? Visit our <a href="{{ route('help') }}">Help Center</a> 
        or contact us at <strong>+234 801 234 5678</strong>.
    </p>
</div>

</body>
</html>
