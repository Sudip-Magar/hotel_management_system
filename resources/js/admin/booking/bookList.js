document.addEventListener('alpine:init', () => {
    Alpine.data('bookingList', () => ({
        bookings: {},
        dbBookings: {},
        search: '',
        init() {
            this.fetchData();
            this.$watch('search', (value) => {
                if (!value) {
                    this.bookings = this.dbBookings
                    return
                }
                else {
                    const val = value.toLowerCase();
                    this.bookings = this.dbBookings.filter(booking => {
                        return (
                            booking.guest_name.toLowerCase().includes(val) ||
                            booking.room.room_number.toLowerCase().includes(val) ||
                            booking.guest_phone.toLowerCase().includes(val) ||
                            booking.email.toLowerCase().includes(val)
                        )
                    });

                }
            })
        },
        fetchData() {
            this.$wire.allBook().then((response) => {
                this.bookings = response;
                this.dbBookings = response;
            }).catch((error) => {
            })
        },

        checkIn(date) {
            const target = new Date(date);
            const today = new Date();

            target.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);

            const diff = target - today;
            const days = Math.ceil(diff / (1000 * 60 * 60 * 24));

            if (days > 1) {
                return `${days} days left`;
            }
            else if (days === 1) {
                return "1 day left";
            }
            else if (days === 0) {
                return "Today";
            }
            else {
                // when the date has already passed
                const pastDays = Math.abs(days);
                return pastDays === 1 ? "1 day ago" : `${pastDays} days ago`;
            }
        },

        checkInColor(text) {
            if (text.includes('left')) return 'text-green-600';
            if (text === 'Today') return 'text-blue-600';
            if (text.includes('ago')) return 'text-red-600';
            return 'text-gray-600';
        },

        statusColor(status) {
            switch (status) {
                case 'booked':
                    return 'bg-violet-100 text-violet-700 rounded-full px-4 py-1';
                case 'checked_in':
                    return 'bg-green-100 text-green-700 rounded-full px-4 py-1';
                case 'checked_out':
                    return 'bg-orange-100 text-orange-700 rounded-full px-4 py-1';
                case 'cancelled':
                    return 'bg-red-100 text-red-700 rounded-full px-4 py-1';
                default:
                    return 'bg-gray-100 text-gray-600 rounded-full px-4 py-1';
            }
        }
    }))
})