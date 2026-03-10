<!-- resources/views/auth/admin-login.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
     @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
</head>
<body>
<div class="form-box admin-login">
    <h2>Admin Login</h2>
    <form method="POST" action="/login/admin">
        @csrf
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
