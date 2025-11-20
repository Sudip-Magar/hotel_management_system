<div wire:ignore class="max-w-5xl mx-auto mt-12 p-6" x-data="bookingView">
    @include('livewire.common.message')
    <a href="{{ route('admin.booking-list') }}"
        class="bg-blue-500 inline-block py-1 px-3 text-white rounded-sm hover:bg-blue-600">
        <i class="fa-solid fa-arrow-left"></i> <span>Back</span>
    </a>

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
                <p><span class="font-medium text-gray-700">Check-out day:</span> <span
                        :class="{
                            'text-green-600': checkOut.includes('left'),
                            'text-blue-600': checkOut === 'Today',
                            'text-red-600': checkOut.includes('ago')
                        }"
                        x-text="checkOut"></span></p>
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
            <div class="p-6 bg-green-50 rounded-xl shadow-sm space-y-3">
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
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Due</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-indigo-800">Transaction ID</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-indigo-200">
                        <template x-if="booking.payments || booking.payments > 0">
                            <template x-for="payment in booking.payments">
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700" x-text="payment.method"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700">Rs. <span
                                            x-text="payment.amount"></span></td>
                                    <td class="px-4 py-2 text-sm text-green-600 font-semibold" x-text="payment.status">
                                    </td>
                                    <td class="px-4 py-2 text-sm text-green-600 font-semibold"
                                        x-text="payment.amount_left"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700" x-text="payment.transaction_id"></td>
                                </tr>
                            </template>
                        </template>
                        <tr class="bg-indigo-100">
                            <th colspan="4" class="px-4 py-2 text-sm text-gray-700 text-start">Total Paid</th>
                            <th class="px-4 py-2 text-sm text-gray-700" x-text="totalPaid"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center md:justify-end gap-4 mt-6">
            <button :class="booking.booking_status == 'checked_in' ? 'inline-block' : 'hidden'" @click.prevent="storeCheckOut"
                class="cursor-pointer bg-orange-500 text-white px-6 py-2 rounded-xl hover:bg-orange-600 flex items-center gap-2 transition">
                <i class="fas fa-right-from-bracket"></i> Check Out
            </button>
            <button :class="(checkIn.includes('Today') || checkIn.includes('ago')) && booking.booking_status == 'booked' ? 'inline-block' : 'hidden'" @click.prevent="storeCheckIn"
                class="cursor-pointer bg-blue-500 text-white px-6 py-2 rounded-xl hover:bg-blue-600 flex items-center gap-2 transition">
                <i class="fas fa-right-to-bracket"></i> Check In
            </button>
            <button  :class="lastPayment.amount_left == 0 ? 'hidden' : 'inline-block'" @click.prevent="collectPayment"
                class="cursor-pointer bg-green-500 text-white px-6 py-2 rounded-xl hover:bg-green-600 flex items-center gap-2 transition">
                <i class="fas fa-hand-holding-dollar"></i> Collect Money
            </button>
        </div>

    </div>

    <!-- payment form -->
    <div x-show="showModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div @click.outside = 'closeModel' class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="closeModel"><i
                    class="fa-solid fa-xmark"></i></span>

            <div class="mx-auto bg-white p-6 rounded-xl shadow-md my-10">
                <div class="mb-4">
                    <span for="method" class="block text-gray-700 font-medium mb-2">Payment
                        Method: <span class="font-semibold"> Cash</span></span>
                  
                </div>

                <div class="mb-4">
                    <div class="flex gap-0 lg:gap-2 lg:flex-row flex-col mb-2 items-center">
                        <label for="phone" class="block text-gray-700 font-medium">Enter Amount</label>
                    </div>
                    <input type="number" id="phone" x-model="data.amount"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Enter Amount to pay">
                    <template x-if="errors.amount">
                        <small class="text-red-500" x-text="errors.amount"></small>
                    </template>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button class="cursor-pointer px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                    @click.prevent="closeModel">
                    Cancel
                </button>

                <button class="cursor-pointer px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                    @click.prevent="confirmPayment">
                    Collect Money
                </button>
            </div>
        </div>
    </div>
</div>
