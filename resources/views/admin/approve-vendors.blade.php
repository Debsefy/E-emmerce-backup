<!DOCTYPE html>
<html>
<head>
    <title>Approve Vendors</title>
    <title>Admin Dashboard</title>
 @vite(['resources/css/style.css', 'resources/js/my.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-vendor-approve">
    <h1>Approve Vendors</h1>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Business Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Brand Image</th>
                    <th>Registration License</th>
                    <th>NIN Document</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->brand_name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->phone }}</td>
                    <td>{{ $vendor->address }}</td>
                    <td>
                        @if($vendor->brand_image)
                            <img src="{{ asset('storage/'.$vendor->brand_image) }}" alt="Brand Image">
                        @endif
                    </td>
                    <td>
                        @if($vendor->registration_license)
                            <a href="{{ asset('storage/'.$vendor->registration_license) }}" target="_blank">View License</a>
                        @endif
                    </td>
                    <td>
                        @if($vendor->nin_document)
                            <a href="{{ asset('storage/'.$vendor->nin_document) }}" target="_blank">View NIN</a>
                        @endif
                    </td>
                    <td>{{ $vendor->status }}</td>
                    <td>
                        @if($vendor->status == 'pending')
                            <a href="/admin/approve-vendor/{{ $vendor->id }}" class="approve-btn">Approve</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
