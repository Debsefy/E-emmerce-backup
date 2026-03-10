<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     @include('layouts.customer-header')
  

<div class="checkout-container">
    <h1>Checkout</h1>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="receiver_name">Receiver Name</label>
            <input type="text" name="receiver_name" required>
        </div>

        <div class="form-group">
            <label for="sender_mobile">Sender Mobile Number</label>
            <input type="text" name="sender_mobile" required>
        </div>

        <div class="form-group">
            <label for="delivery_address">Delivery Address</label>
            <textarea name="delivery_address" required></textarea>
        </div>

        <div class="form-group">
            <label for="delivery_country">Country</label>
            <select name="delivery_country" id="country" required>
                <option value="">Select Country</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Ghana">Ghana</option>
                <option value="Kenya">Kenya</option>
                <!-- Add more countries -->
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_region">Region</label>
            <select name="delivery_region" id="region" required>
                <!-- Options will be populated dynamically based on country -->
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_city">City</label>
            <select name="delivery_city" id="city" required>
                <!-- Options will be populated dynamically based on region -->
            </select>
        </div>

        <button type="submit" class="btn btn-success">Continue to Payment</button>
    </form>
</div>

<script>
    // Example dynamic dropdown logic
    const regions = {
        'Nigeria': ['Lagos', 'Abuja', 'Kano'],
        'Ghana': ['Accra', 'Kumasi'],
        'Kenya': ['Nairobi', 'Mombasa']
    };

    const cities = {
        'Lagos': ['Ikeja', 'Lekki', 'Surulere'],
        'Abuja': ['Garki', 'Wuse'],
        'Accra': ['Osu', 'Madina'],
        'Nairobi': ['Westlands', 'Karen']
    };

    document.getElementById('country').addEventListener('change', function() {
        const regionSelect = document.getElementById('region');
        regionSelect.innerHTML = '';
        if (regions[this.value]) {
            regions[this.value].forEach(r => {
                regionSelect.innerHTML += `<option value="${r}">${r}</option>`;
            });
        }
    });

    document.getElementById('region').addEventListener('change', function() {
        const citySelect = document.getElementById('city');
        citySelect.innerHTML = '';
        if (cities[this.value]) {
            cities[this.value].forEach(c => {
                citySelect.innerHTML += `<option value="${c}">${c}</option>`;
            });
        }
    });
</script>


</body>
</html>