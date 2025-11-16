document.addEventListener('alpine:init', () => {
    Alpine.data('roomDatail', () => ({
        errors: {},
        dateError: '',
        success: '',
        serverErrors: '',
        room: {},
        data: {
            room_id: '',
            check_in: '',
            check_out: '',
            total_nights: 0,
            total_price: 0,
            payment_status: '',
            booking_status: '',
            guest_name: '',
            guest_phone: '',
            email: '',
        },
        showModal: false,
        loaded: false,
        activeImage: 0,

        init() {
            this.fetchData();
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.room = response;
                console.log(this.room)
                this.loaded = true;
            }).catch((error) => {

            })
        },

        showBookModal() {
            this.showModal = true;
        },

        closeModel() {
            this.showModal = false;
        },

        validation() {
            this.errors = {};

            if (!this.data.check_in) {
                this.errors.check_in = "Please fill the checkin"
            }

            if (!this.data.check_out) {
                this.errors.check_out = "Please fill the checkout";
            }
            if (!this.data.guest_name) {
                this.errors.guest_name = "Name is required";
            }

            else if (this.data.guest_name.length < 3) {
                this.errors.guest_name = "Name should be atleast 3 character long";
            }

            else if (this.data.guest_name.length > 30) {
                this.errors.guest_name = "Name mustn't exceed 30 character";
            }

            if (!this.data.guest_phone) {
                this.errors.guest_phone = "Phone Number is required"
            }
            else if (this.data.guest_phone.length != 10) {
                this.errors.guest_phone = "Invalid Phone number";
            }

            if (!this.data.email) {
                this.errors.email = "Email is required.";
            }
            else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.data.email)) {
                this.errors.email = "Please enter a valid email address.";
            }

            return Object.keys(this.errors).length === 0;
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

            if (this.dateError) {
                setTimeout(() => {
                    this.dateError = '';
                }, 3000);
            }
        },

        verify() {
            this.dateError = '';

            if (!this.data.check_in || !this.data.check_out) return false;

            const newCheckin = new Date(this.data.check_in);
            const newCheckout = new Date(this.data.check_out);

            for (let r of this.room.reservations) {
                const existingCheckin = new Date(r.check_in);
                const existingCheckout = new Date(r.check_out);

                // Check if the new booking overlaps with existing reservation
                if (newCheckin <= existingCheckout && newCheckout >= existingCheckin) {
                    this.dateError = "The selected dates are unavailable. Kindly choose different check-in and check-out dates.";
                    this.timeoutFunc();
                    return false;
                }
            }

            return true; // No conflicts
        },


        reserve() {
            if (!this.validation()) {
                this.timeoutFunc();
                return
            }

            if (!this.verify()) { // <- call the function and check its return
                this.timeoutFunc();
                return;
            }

            let payload = {
                room_id: this.room.id,
                check_in: this.data.check_in,
                check_out: this.data.check_out,
                total_nights: this.days,
                total_price: this.price,
                payment_status: 'pending',
                booking_status: 'booked',
                guest_name: this.data.guest_name,
                guest_phone: this.data.guest_phone,
                email: this.data.email
            };

            this.$wire.reserve(payload).then((response) => {
                this.serverErrors = '';
                this.errors = {};
                this.success = '';
                console.log(response)
                if (response.original.errors) {
                    Object.entries(response.original.errors).forEach(([key, message]) => {
                        this.errors[key] = message[0];
                        this.timeoutFunc()
                    })
                }

                else if (response.original.error) {
                    this.serverErrors = response.original.error;
                    this.timeoutFunc()
                }

                else if (response.original.success) {
                    this.success = response.original.success;
                    this.timeoutFunc();
                    this.fetchData()
                    this.showModal = false;
                }
            }).catch((error) => {
                console.log(error);
            })

            // console.log(payload);
        },

        get days() {
            if (!this.data.check_in || !this.data.check_out) {
                return 0;
            }

            const checkInDate = new Date(this.data.check_in);
            const checkOutDate = new Date(this.data.check_out);
            const diffTime = checkOutDate - checkInDate;
            const diffDays = diffTime / (1000 * 60 * 60 * 24);
            return diffDays > 0 ? diffDays : 0;
        },

        get price() {
            if (this.days === 0) {
                return 0
            }

            if (this.days === 1) {
                return this.room.price;
            }

            else {
                return this.days * this.room.price;
            }
        },

    }))
})