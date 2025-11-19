document.addEventListener('alpine:init', () => {
    Alpine.data('reservation', () => ({
        bookings: {},
        showModal: false,
        errors: {},
        serverErrors: '',
        success: '',

        data: {
            reservation_id: '',
            method: '',
            amount: '',
            total_amount: '',
        },

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
        },

        payment(id) {
            const booking = this.bookings.find(b => b.id === id);
            const payment = booking.payments[booking.payments.length - 1];
            this.data.reservation_id = id;
            this.data.amount = payment.amount_left
            this.data.total_amount = payment.amount_left;
            this.showModal = true;
        },

        validation() {
            this.errors = {};

            if (!this.data.method) {
                this.errors.method = "payment method is required";
            }

            if (!this.data.amount) {
                this.errors.amount = "Amount is required";
            }

            else if (this.data.amount > this.data.total_amount) {
                this.errors.amount = `Input ${this.data.amount} is greater than ${this.data.total_amount}`;
            }

            return Object.keys(this.errors).length === 0;
        },

        confirmPayment() {
            if (!this.validation()) {
                this.timeoutFunc();
                return;
            }
            this.$wire.savePayment(this.data).then((response) => {
                this.errors = {};
                this.serverErrors = '';
                this.success = '';
                console.log(response);
                if (response.original.errors) {
                    Object.entries(response.original.errors).forEach(([key, message]) => {
                        this.errors[key] = message[0];
                        this.timeoutFunc();
                    })
                }

                else if (response.original.error) {
                    this.serverErrors = response.original.error;
                    this.timeoutFunc();
                }

                else if (response.original.success) {
                    this.success = response.original.success;
                    this.timeoutFunc();
                    this.fetchData();
                    this.showModal = false;
                    this.data = {};

                 }

            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },

        timeoutFunc() {
            if (this.success) {
                setTimeout(() => {
                    this.success = '';
                }, 3000);
            }

            if (this.errors) {
                setTimeout(() => {
                    this.errors = {};
                }, 3000);
            }

            if (this.serverErrors) {
                setTimeout(() => {
                    this.serverErrors = '';
                }, 3000);
            }
        },


        closeModel() {
            this.showModal = false;
            this.data = {};
        },
    }))
})