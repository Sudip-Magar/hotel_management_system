document.addEventListener('alpine:init', () => {
    Alpine.data('reservation', () => ({
        bookings: {},

        init() {
            this.fetchData();
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.bookings = response
            }).catch((error) => {
            })
        },

        formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
        },


        checkInStatus(date) {
            const target = new Date(date);
            const today = new Date();
            target.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);
            const diff = target - today;
            const days = Math.ceil(diff / (1000 * 60 * 60 * 24));
            if (days > 1) return `${days} days left`;
            if (days === 1) return '1 day left';
            if (days === 0) return 'Today';
            const past = Math.abs(days);
            return past === 1 ? '1 day ago' : `${past} days ago`;
        },

        checkInColor(text) {
            if (text.includes('left')) return 'text-green-600';
            if (text === 'Today') return 'text-blue-600';
            if (text.includes('ago')) return 'text-red-600';
            return 'text-gray-600';
        }
    }))
})