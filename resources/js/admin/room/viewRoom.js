document.addEventListener('alpine:init', () => {
    Alpine.data('viewRoom', () => ({
        data: {
            room_number: '',
            category_id: '',
            price: '',
            max_guest: '',
            room_images: {},
        },
        errors: {},
        success: '',
        serverErrors: '',
        categories: [],
        rooms: [],

        init() {
            this.fetchData();
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.categories = response[0];
                Object.assign(this.data, response[1]);
            }).catch((error) => {
                this.serverErrors = "Something went worng " + error;
            })
        },

        validation() {
            this.errors = {};

            if (!this.data.room_number) {
                this.errors.room_number = "room number is required.";
            }

            else if (this.data.room_number.length > 20) {
                this.errors.room_number = "room number must not exceed 30 characters.";
            }


            if (!this.data.price) {
                this.errors.price = "Price is required.";
            }
            else if (isNaN(this.data.price) || this.data.price < 0) {
                this.errors.price = "Price must be a valid non-negative number.";
            }

            if (!this.data.max_guest) {
                this.errors.max_guest = "max guest is required.";
            }
            else if (isNaN(this.data.max_guest) || this.data.max_guest < 0) {
                this.errors.max_guest = "Price must be a valid non-negative number.";
            }

            if (!this.data.category_id) {
                this.errors.category_id = "Categroy is required";
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

        updateRoom() {
            if (!this.validation()) {
                this.timeoutFunc();
                return;
            }
            this.$wire.updateRoom(this.data).then((response) => {
                this.errors = {};
                this.success = '';
                this.serverErrors = '';
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

                else if(response.original.success){
                    this.success = response.original.success;
                    this.timeoutFunc();
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong client " + error;
            })
        },
    }))
})