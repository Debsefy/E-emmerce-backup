<!-- resources/views/auth/vendor-register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Vendor Registration</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .form-box { width: 500px; margin: 50px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; background: #333; color: #fff; border: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Vendor Registration</h2>
        <form method="POST" action="/register/vendor" enctype="multipart/form-data">
            @csrf
            <input type="text" name="brand_name" placeholder="Brand Name" required>
            <input type="email" name="business_email" placeholder="Business Email" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Business Address" required>

            <label>Brand Image</label>
            <input type="file" name="brand_image" accept="image/*" required>

            <label>Registration License (PDF/Image)</label>
            <input type="file" name="registration_license" accept=".pdf,image/*" required>

            <label>NIN Document (PDF/Image)</label>
            <input type="file" name="nin_document" accept=".pdf,image/*" required>

            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
