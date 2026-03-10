<!-- resources/views/auth/customer-login.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .form-box { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; background: #333; color: #fff; border: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Customer Login</h2>
        <form method="POST" action="/login/customer">
            @csrf
            <input type="email" name="email" placeholder="Customer Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
