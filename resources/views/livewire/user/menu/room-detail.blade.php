<div class="max-w-5xl mx-auto mt-16 bg-white rounded-lg shadow-md overflow-hidden" x-data="roomDatail">
    <!-- Room Image Gallery -->
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="relative">
            <img src="" alt="Room Image" class="w-full h-full object-cover">
            <div class="absolute top-3 left-3 bg-green-500 text-white px-3 py-1 text-sm rounded">Available</div>
        </div>
        <div class="p-6 flex flex-col justify-center">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Deluxe King Room</h2>
            <p class="text-gray-600 mb-4">Experience comfort in our Deluxe King Room featuring modern amenities, a spacious bed, and a stunning city view.</p>

            <div class="space-y-2">
                <p><span class="font-semibold text-gray-700">Room Number:</span> A101</p>
                <p><span class="font-semibold text-gray-700">Category:</span> Deluxe</p>
                <p><span class="font-semibold text-gray-700">Max Guests:</span> 3</p>
                <p><span class="font-semibold text-gray-700">Price per Night:</span> <span class="text-green-600 font-bold">$120</span></p>
            </div>

            <div class="mt-6">
                <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 duration-150">
                    Book Now
                </button>
            </div>
        </div>
    </div>

    <!-- Room Services -->
    <div class="border-t p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Services & Amenities</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 text-gray-700">
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>Free Wi-Fi</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>Air Conditioning</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>Room Service</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>TV</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" class="text-green-600 rounded">
                <span>Mini Bar</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>Hot Shower</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" checked class="text-green-600 rounded">
                <span>Parking</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" class="text-green-600 rounded">
                <span>Laundry</span>
            </label>
        </div>
    </div>

    <!-- Room Images -->
    <div class="border-t p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Gallery</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <img src="" alt="Room Image" class="rounded-lg object-cover w-full h-40">
            <img src="" alt="Room Image" class="rounded-lg object-cover w-full h-40">
            <img src="" alt="Room Image" class="rounded-lg object-cover w-full h-40">
            <img src="" alt="Room Image" class="rounded-lg object-cover w-full h-40">
        </div>
    </div>

    <!-- Check-in / Check-out -->
    <div class="border-t p-6 bg-gray-50">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Booking Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Check-In Date</label>
                <input type="date" class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Check-Out Date</label>
                <input type="date" class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
        </div>

        <div class="mt-6 text-right">
            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 duration-150">
                Calculate Total
            </button>
        </div>
    </div>
</div>
