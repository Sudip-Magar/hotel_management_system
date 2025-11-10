document.addEventListener('alpine:init', () => {
    Alpine.data('createRoomCategory', () => ({
        data: {
            name: '',
            description: '',
            base_price: '',
            capacity: '',
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
                this.errors.name = "Password must be at least 3 characters.";
            }
            else if (this.data.name.length > 30) {
                this.errors.name = "Name must not exceed 30 characters.";
            }



            if (!this.data.description.length > 100) {
                this.errors.description = "Name must not exceed 100 characters.";
            }

            if (!this.data.base_price) {
                this.errors.base_price = "Price is required.";
            }
            else if (isNaN(this.data.base_price) || this.data.base_price < 0) {
                this.errors.base_price = "Price must be a valid non-negative number.";
            }

             if (!this.data.capacity) {
                this.errors.capacity = "Price is required.";
            }
            else if (isNaN(this.data.capacity) || this.data.ca < 0) {
                this.errors.capacity = "Price must be a valid non-negative number.";
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


        registerCategory() {
            if (!this.validation()) {
                this.timeoutFunc();
                return;
            }

            this.$wire.registerCategory(this.data).then((response) => {
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