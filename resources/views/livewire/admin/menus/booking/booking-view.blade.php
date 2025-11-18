<div wire:ignore class="max-w-5xl mx-auto mt-12 p-6" x-data="bookingView">
    <div x-show="!loaded" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            Loading rooms...
        </div>
    </div>

    <!-- Header -->
    <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center">Reservation Details</h1>

    <!-- Reservation Card -->
    <div class="bg-white shadow-2xl rounded-2xl p-8 space-y-8">

        <!-- Guest and Booking Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Guest Info -->
            <div class="p-6 bg-blue-50 rounded-xl shadow-sm space-y-3">
                <h2 class="text-xl font-semibold text-blue-700 border-b pb-2">Guest Information</h2>
                <p><span class="font-medium text-gray-700">Name:</span> <span x-text="booking.guest_name"></span>
                </p>
                <p><span class="font-medium text-gray-700">Email:</span> <span x-text="booking.email"></span></p>
                <p><span class="font-medium text-gray-700">Phone:</span> <span x-text="booking.guest_phone"></span>
                </p>
            </div>

            <!-- Booking Info -->
            <div class="p-6 bg-yellow-50 rounded-xl shadow-sm space-y-3">
                <h2 class="text-xl font-semibold text-yellow-700 border-b pb-2">Booking Information</h2>
                <p><span class="font-medium text-gray-700">Booking ID:</span> <span x-text="booking.id"></span></p>
                <p><span class="font-medium text-gray-700">Check-in day:</span> <span
                        :class="{
                            'text-green-600': checkIn.includes('left'),
                            'text-blue-600': checkIn === 'Today',
                            'text-red-600': checkIn.includes('ago')
                        }"
                        x-text="checkIn"></span></p>
                <p><span class="font-medium text-gray-700">Check-in:</span> <span
                        x-text="new Date(booking.check_in).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })"></span>
                </p>
                <p><span class="font-medium text-gray-700">Check-out:</span> <span
                        x-text="new Date(booking.check_out).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })"></span>
                </p>
                <p><span class="font-medium text-gray-700">Total Nights:</span> <span
                        x-text="booking.total_nights"></span></p>
                <p><span class="font-medium text-gray-700">Total Price:</span> Rs. <span
                        class="text-green-600 font-semibold"
                        x-text="new Intl.NumberFormat().format(booking.total_price)"></span></p>
                <p><span class="font-medium text-gray-700">Booking Status:</span>
                    <template x-if="booking.booking_status == 'booked'">
                        <span class="text-blue-600 font-semibold" x-text="booking.booking_status"></span>
                    </template>

                    <template x-if="booking.booking_status == 'checked_in'">
                        <span class="text-green-600 font-semibold" x-text="booking.booking_status"></span>
                    </template>

                    <template x-if="booking.booking_status == 'checked_out'">
                        <span class="text-gray-600 font-semibold" x-text="booking.booking_status"></span>
                    </template>

                    <template x-if="booking.booking_status == 'cancelled'">
                        <span class="text-red-600 font-semibold" x-text="booking.booking_status"></span>
                    </template>
                </p>
                <p><span class="font-medium text-gray-700">Payment Status:</span>
                    <template x-if="booking.payment_status == 'pending'">
                        <span class="text-red-500 font-semibold" x-text="booking.payment_status"></span>
                    </template>

                    <template x-if="booking.payment_status == 'paid'">
                        <span class="text-green-500 font-semibold" x-text="booking.payment_status"></span>
                    </template>
                </p>
            </div>

            <!-- Room Info -->
            <div class="p-6 bg-purple-50 rounded-xl shadow-sm space-y-3">
                <h2 class="text-xl font-semibold text-purple-700 border-b pb-2">Room Information</h2>
                <template x-if="booking.room">
                    <div class="space-y-3">
                        <p><span class="font-medium text-gray-700">Room Number:</span> <span
                                x-text="booking.room.room_number"></span></p>
                        <p><span class="font-medium text-gray-700">Category:</span> <span
                                x-text="booking.room.category.name"></span></p>
                        <p><span class="font-medium text-gray-700">Price per Night:</span> Rs. <span
                                x-text="booking.room.price"></span></p>
                        <p><span class="font-medium text-gray-700">Max Guests:</span> <span
                                x-text="booking.room.max_guest"></span></p>
                    </div>
                </template>
            </div>

            <!-- User Info -->
            <div class="p-6 bg-green-50 rounded-xl shadow-sm">
                <h2 class="text-xl font-semibold text-green-700 border-b pb-2">User Information</h2>
                <template x-if="booking.user">
                    <div class="space-y-3">
                        <p><span class="font-medium text-gray-700">User ID:</span> 1</p>
                        <p><span class="font-medium text-gray-700">Name:</span> Sudip Magar</p>
                        <p><span class="font-medium text-gray-700">Email:</span> spsuudeep834@gmail.com</p>
                        <p><span class="font-medium text-gray-700">Phone:</span> 9823205972</p>
                    </div>
                </template>
                <template x-if="!booking.user">
                    <div class="my-3">
                        <p> Guest Booking (No registered user)</p>
                    </div>
                </template>
            </div>

        </div>

        <!-- Payment Details -->
        <div class="p-6 bg-indigo-50 rounded-xl shadow-sm space-y-3">
            <h2 class="text-xl font-semibold text-indigo-700 border-b pb-2">Payment Details</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-indigo-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Method</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Amount</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Transaction ID</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-indigo-200">
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">Khalti</td>
                            <td class="px-4 py-2 text-sm text-gray-700">$3,000</td>
                            <td class="px-4 py-2 text-sm text-green-600 font-semibold">Success</td>
                            <td class="px-4 py-2 text-sm text-gray-700">TX-1763443970-4516</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center md:justify-end gap-4 mt-6">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-xl hover:bg-blue-600 flex items-center gap-2 transition">
                <i class="fas fa-edit"></i> Edit
            </button>
            <button
                class="bg-red-500 text-white px-6 py-2 rounded-xl hover:bg-red-600 flex items-center gap-2 transition">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>

    </div>
    x
</div>
