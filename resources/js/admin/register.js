document.addEventListener('alpine:init', () => {
    Alpine.data('register', () => ({
        data: {
            name: '',
            email: '',
            phone: '',
            password: '',
            password_confirmation: '',
        },
        errors: {},
        success: '',
        serverErrors: '',

        validation() {
            this.errors = {};
            if (!this.data.name) {
                this.errors.name = "Name is required.";
            }
            else if (this.data.name.length < 3) {
                this.errors.name = "Name must be at least 3 characters.";
            }
            else if (this.data.name.length > 30) {
                this.errors.name = "Name must not exceed 30 characters.";
            }


            if (!this.data.email) {
                this.errors.email = "Email is required.";
            }
            else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.data.email)) {
                this.errors.email = "Please enter a valid email address.";
            }


            if (!this.data.phone) {
                this.errors.phone = "Phone is required.";
            }
            else if (!/^\d{10}$/.test(this.data.phone)) {
                this.errors.phone = "Phone number must be exactly 10 digits.";
            }



            if (!this.data.password) {
                this.errors.password = "Password is required.";
            }
            else if (this.data.password.length < 6) {
                this.errors.password = "Password must be at least 6 characters.";
            }


            if (this.data.password !== this.data.password_confirmation) {
                this.errors.password_confirmation = "Password confirmation does not match.";
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
        },


        register() {
            if (!this.validation()) {
                this.timeoutFunc();
                return;
            }

            this.$wire.register(this.data).then((response) => {
                this.errors = {};
                this.success = '';
                this.serverErrors = '';
                console.log(response)
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
            }).catch((error) => {
                console.log(error)
            });
        },
    }))
})