<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    @vite(['resources/css/style.css', 'resources/js/my.js'])
</head>
<body>
    <h1>Edit Profile</h1>

    <form method="POST" action="{{ route('customer.profile.update') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
        <br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
        <br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
