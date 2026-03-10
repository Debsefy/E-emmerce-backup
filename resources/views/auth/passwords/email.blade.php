<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h2>Forgot Your Password?</h2>
    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email Address</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</div>



</body>
</html>