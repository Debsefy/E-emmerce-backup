<!-- resources/views/auth/customer-register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
  @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>

<body>
    <!-- <div class="form-box">
        <h2>Customer Registration</h2>
        <form method="POST" action="/register/customer">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
    </div> -->
<div class="register-box">
    <h2>Customer Registration</h2>
    <form method="POST" action="{{ route('register.customer') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name*" required>
        <input type="email" name="email" placeholder="Email Address*" required>
        <input type="text" name="phone" placeholder="Mobile Number*" required>
        <input type="password" name="password" placeholder="Password*" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password*" required>

        <button type="submit" class="btn-register">Register</button>
    </form>

    <p class="terms">
        By registering you agree to our 
        <a href="{{ route('terms') }}">Terms & Conditions</a> and 
        <a href="{{ route('privacy') }}">Privacy Policy</a>.
    </p>

    <p class="help">
        Already have an account? <a href="{{ route('login.customer') }}">Login here</a>.
    </p>
</div>

</body>
</html>
