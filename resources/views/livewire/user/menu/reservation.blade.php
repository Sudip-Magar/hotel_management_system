<div class="max-w-6xl mx-auto p-6" x-data="reservation">
    @include('livewire.common.message')
    <!-- Page Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Reservations</h1>

    <!-- Reservation Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <template x-for="booking in bookings" :key="booking.id">
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col justify-between hover:bg-gray-100  duration-200 transition hover:scale-105 hover:fill-gray-300 hover:drop-shadow-xl/50">

                <!-- Room & Guest Info -->
                <div class="mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-1" x-text="booking.room.category.name"></h2>
                    <p class="text-gray-500 mb-1" x-text="booking.room.guest_type.name"></p>
                    <p class="text-gray-600"><span class="font-medium">Guest:</span> <span
                            x-text="booking.guest_name"></span></p>
                    <p class="text-gray-600"><span class="font-medium">Email:</span> <span
                            x-text="booking.email"></span></p>
                </div>

                <!-- Dates & Nights -->
                <div class="mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-700"><span class="font-medium">Check-in:</span> <span
                                x-text="formatDate(booking.check_in)"></span></p>
                        <p class="text-gray-700"><span class="font-medium">Check-out:</span> <span
                                x-text="formatDate(booking.check_out)"></span></p>
                        <p class="text-gray-600"><span class="font-medium">Nights:</span> <span
                                x-text="booking.total_nights"></span></p>
                        <p class="text-gray-600"><span class="font-medium">Paid:</span> <span
                                x-text="booking.payments.reduce((t,p) => t + Number(p.amount),0)"></span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-700 font-medium">Check-in Countdown:</p>
                        <p class="mt-1 font-semibold text-lg" x-text="checkInStatus(booking.check_in)"
                            :class="checkInColor(checkInStatus(booking.check_in))"></p>
                    </div>
                </div>

                <!-- Status & Payment Badges -->
                <div class="flex flex-wrap justify-between items-center gap-3">
                    <!-- Reservation Status -->
                    <span class="px-3 py-1 rounded-full font-semibold text-white"
                        :class="{
                            'bg-yellow-500': booking.booking_status==='booked',
                            'bg-blue-500': booking.booking_status==='checked_in',
                            'bg-green-500': booking.booking_status==='checked_out',
                            'bg-red-500': booking.booking_status==='cancelled'
                        }"
                        x-text="booking.booking_status"></span>

                    <button @click.prevent="payment(booking.id)"
                        class="bg-green-300 text-green-700 py-1 px-5 rounded-full cursor-pointer hover:bg-green-800 hover:text-white duration-200 transition hover:scale-105 hover:fill-green-400 hover:drop-shadow-xl/50">Make payment</button>
                </div>

            </div>
        </template>

    </div>

    <!-- payment form -->
    <div x-show="showModal" x-transition.opacity x-cloak
        class="fixed inset-0 flex items-center justify-center bg-gray-900/80 z-75">
        <div @click.outside = 'closeModel' class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <span class="absolute top-5 right-5 cursor-pointer" @click.prevent="closeModel"><i
                    class="fa-solid fa-xmark"></i></span>

            <div class="mx-auto bg-white p-6 rounded-xl shadow-md my-10">
                <div class="mb-4">
                    <label for="method" class="block text-gray-700 font-medium mb-2">Enter Payment
                        Method</label>
                    <select x-model="data.method"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="">-- Select Method --</option>
                        <option value="esewa">E-sewa</option>
                        <option value="Khalti">Kalti</option>
                        <option value="debit card">Debit Card</option>
                        <option value="Ime Pay">Ime Pay</option>
                    </select>
                    <template x-if="errors.method">
                        <small class="text-red-500" x-text="errors.method"></small>
                    </template>
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
                    Pay
                </button>
            </div>
        </div>
    </div>
</div>
