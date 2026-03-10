<!-- resources/views/auth/customer-register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .form-box { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; background: #333; color: #fff; border: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Customer Registration</h2>
        <form method="POST" action="/register/customer">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
