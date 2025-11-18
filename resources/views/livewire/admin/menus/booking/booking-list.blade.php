<div class="max-w-[90%] mx-auto mt-10 p-6 bg-white rounded-lg shadow-md" x-data="bookingList">
    <div class="flex my-5 justify-end mx-5">
        <div class="w-5 h-5 bg-green-600 rounded-l-sm cursor-pointer" title="Future Check_in"></div>
        <div class="w-5 h-5 bg-blue-600  cursor-pointer" title="Today Check_in"></div>
        <div class="w-5 h-5 bg-red-600 rounded-r-sm cursor-pointer" title="Past Check_in"></div>
    </div>
    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th>Booking ID</th>
                <th>Guest Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Room Number</th>
                <th>Check-in</th>
                <th>Check-in day</th>
                <th>Total Nights</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="booking in bookings" :key="booking.id">
                <tr :class="checkInColor(checkIn(booking.check_in))" class="hover:bg-gray-100 text-center">
                    <td class="px-4 py-2 border-b" x-text="booking.id"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.guest_name"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.email"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.guest_phone"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.room.room_number"></td>
                    <td class="px-4 py-2 border-b" x-text="new Date(booking.check_in).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })"></td>
                    <td class="px-4 py-2 border-b" :class="checkInColor(checkIn(booking.check_in))" x-text="checkIn(booking.check_in)"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.total_nights"></td>
                    <td class="px-4 py-2 border-b" x-text="booking.total_price"></td>
                    <td class="px-4 py-2 border-b space-x-2">
                        <a :href="'/admin/booking/view/'+ booking.id" class="cursor-pointer bg-blue-300 text-blue-700 hover:bg-blue-400 px-3 py-1 rounded" :title="`view ${booking.guest_name} detail`">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
            </template>

            <tr x-show="bookings.length === 0" class="text-center">
                <td class="py-20 text-2xl font-semibold text-gray-400" colspan="12">
                    Currently there are no bookings. Try creating one.
                </td>
            </tr>
        </tbody>

    </table>
</div>
