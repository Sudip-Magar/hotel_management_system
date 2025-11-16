<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="bg-gray-100 p-6 font-sans">

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-gray-800">Reservation Confirmation</h2>

        <p class="mt-2 text-gray-700">
            Dear <strong>{{ $details['name'] }}</strong>,
        </p>

        <p class="mt-2 text-gray-700 leading-relaxed">
            Thank you for choosing our hotel. Your reservation has been successfully confirmed.
            Below is the complete summary of your booking, which serves as your official booking proof.
        </p>

        <div class="my-5 border-t border-gray-300"></div>

        <!-- Guest Details -->
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Guest Information</h3>
        <table class="w-full text-gray-700 text-sm">
            <tr>
                <td class="py-1 font-semibold w-40">Name:</td>
                <td>{{ $details['name'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Email:</td>
                <td>{{ $details['email'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Phone:</td>
                <td>{{ $details['phone'] }}</td>
            </tr>
        </table>

        <div class="my-5 border-t border-gray-300"></div>

        <!-- Booking Details -->
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Booking Details</h3>
        <table class="w-full text-gray-700 text-sm">
            <tr>
                <td class="py-1 font-semibold w-40">Room Number:</td>
                <td>{{ $details['room'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Room Category:</td>
                <td>{{ $details['category'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Guest Type:</td>
                <td>{{ $details['guest_type'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Check-in Date:</td>
                <td>{{ $details['checkin'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Check-out Date:</td>
                <td>{{ $details['checkout'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Total Nights:</td>
                <td>{{ $details['total_nights'] }}</td>
            </tr>
        </table>

        <div class="my-5 border-t border-gray-300"></div>

        <!-- Financial Details -->
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Payment Information</h3>
        <table class="w-full text-gray-700 text-sm">
            <tr>
                <td class="py-1 font-semibold w-40">Total Price:</td>
                <td>Rs. {{ number_format($details['total_price']) }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Payment Status:</td>
                <td>{{ ucfirst($details['payment']) }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Booking Status:</td>
                <td>{{ ucfirst($details['status']) }}</td>
            </tr>
        </table>

        <div class="my-5 border-t border-gray-300"></div>

        <!-- Room Services -->
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Included Services</h3>
        <ul class="list-disc pl-5 text-gray-700 text-sm">
            @foreach ($details['services'] as $service)
                <li>{{ $service }}</li>
            @endforeach
        </ul>

        <div class="my-5 border-t border-gray-300"></div>

        <!-- Room Features -->
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Room Features</h3>
        <ul class="list-disc pl-5 text-gray-700 text-sm">
            <li>Bedrooms: {{ $details['features']->bedroom_count }}</li>
            <li>Toilets: {{ $details['features']->toilet_count }}</li>
            <li>Kitchen: {{ $details['features']->has_kitchen ? 'Available' : 'Not Available' }}</li>
            <li>Balcony: {{ $details['features']->has_balcony ? 'Available' : 'Not Available' }}</li>
            <li>Living Room: {{ $details['features']->has_living_room ? 'Available' : 'Not Available' }}</li>
        </ul>

        <div class="my-5 border-t border-gray-300"></div>

        <p class="text-gray-700 text-sm leading-relaxed">
            Please keep this email as your official reservation proof.
            For any changes or inquiries, feel free to contact our support team anytime.
        </p>

        <p class="mt-4 text-gray-700">We look forward to welcoming you!</p>

        <p class="mt-1 text-gray-800 font-semibold">
            Warm regards,<br>
            <span class="font-bold">Hotel Reservation Team</span>
        </p>

    </div>

</body>

</html>
