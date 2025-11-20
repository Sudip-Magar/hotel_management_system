document.addEventListener('alpine:init', () => {
    Alpine.data('bookingView', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        booking: {},
        loaded: false,
        showModal: false,
        data: {
            reservation_id: '',
            method: 'cash',
            amount: '',
            total_amount: '',
        },
        lastPayment:{},

        init() {
            this.fetchData();
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.booking = response[0];
                this.lastPayment = response[1];
                this.loaded = true;
            }).catch((error) => {
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

        get checkIn() {
            const target = new Date(this.booking.check_in);
            const today = new Date();

            target.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);

            const diff = target - today;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));

            if (days > 1) return `${days} days left`;
            if (days === 1) return "1 day left";
            if (days === 0) return "Today";

            const pastDays = Math.abs(days);
            return pastDays === 1 ? "1 day ago" : `${pastDays} days ago`;
        },


        get checkOut() {
            const target = new Date(this.booking.check_out);
            const today = new Date();

            target.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);

            const diff = target - today;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));

            if (days > 1) return `${days} days left`;
            if (days === 1) return "1 day left";
            if (days === 0) return "Today";

            const pastDays = Math.abs(days);
            return pastDays === 1 ? "1 day ago" : `${pastDays} days ago`;
        },

        collectPayment() {
            const payment = this.booking.payments[this.booking.payments.length - 1];
            this.data.reservation_id = payment.reservation_id;
            this.data.amount = payment.amount_left
            this.data.total_amount = payment.amount_left;
            this.showModal = true;

        },

        closeModel() {
            this.showModal = false;
            this.data = {};
        },

        validation() {
            this.errors = {};

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
            this.$wire.confirmPayment(this.data).then((response) => {
                this.serverErrors = '';
                this.success = '';
                this.errors = {};
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
                    this.data = {}
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },

        get totalPaid(){
           if(this.booking.payments){
             const payments = this.booking.payments;
             let total = 0;
             for(let payment of payments){
                total += Number(payment.amount);
             }
            return total
           }
        }
    }))
})