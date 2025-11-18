document.addEventListener('alpine:init', () => {
    Alpine.data('bookingView', () => ({
        booking: {},
        loaded: false,

        init() {
            this.fetchData();
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.booking = response
                this.loaded = true;
                console.log(this.booking)
            }).catch((error) => {
                console.log(error)
            })
        },

        get checkIn() {
            const target = new Date(this.booking.check_in);
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

    }))
})