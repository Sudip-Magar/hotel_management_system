<div class="max-w-6xl mx-auto p-6" x-data="reservation">

    <!-- Page Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Reservations</h1>

    <!-- Reservation Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <template x-for="booking in bookings" :key="booking.id">
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col justify-between">
                
                <!-- Room & Guest Info -->
                <div class="mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-1" x-text="booking.room.category.name"></h2>
                    <p class="text-gray-500 mb-1" x-text="booking.room.guest_type.name"></p>
                    <p class="text-gray-600"><span class="font-medium">Guest:</span> <span x-text="booking.guest_name"></span></p>
                    <p class="text-gray-600"><span class="font-medium">Email:</span> <span x-text="booking.email"></span></p>
                </div>

                <!-- Dates & Nights -->
                <div class="mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-700"><span class="font-medium">Check-in:</span> <span x-text="formatDate(booking.check_in)"></span></p>
                        <p class="text-gray-700"><span class="font-medium">Check-out:</span> <span x-text="formatDate(booking.check_out)"></span></p>
                        <p class="text-gray-600"><span class="font-medium">Nights:</span>  <span x-text="booking.total_nights"></span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-700 font-medium">Check-in Countdown:</p>
                        <p class="mt-1 font-semibold text-lg" 
                           x-text="checkInStatus(booking.check_in)" 
                           :class="checkInColor(checkInStatus(booking.check_in))"></p>
                    </div>
                </div>

                <!-- Status & Payment Badges -->
                <div class="flex flex-wrap justify-between items-center gap-3">
                    <!-- Reservation Status -->
                    <span class="px-3 py-1 rounded-full font-semibold text-white"
                          :class="{
                            'bg-yellow-500': booking.status==='Booked',
                            'bg-blue-500': booking.status==='Checked-in',
                            'bg-green-500': booking.status==='Checked-out',
                            'bg-red-500': booking.status==='Cancelled'
                          }"
                          x-text="booking.status"></span>

                    <!-- Payment Status -->
                    <span class="px-3 py-1 rounded-full font-semibold text-white"
                          :class="booking.amount > 0 ? 'bg-red-600' : 'bg-green-600'"
                          x-text="booking.amount > 0 ? `$${booking.amount} Due` : 'Paid'"></span>
                </div>

            </div>
        </template>

    </div>
</div>


