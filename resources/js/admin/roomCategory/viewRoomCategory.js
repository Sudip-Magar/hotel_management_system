document.addEventListener('alpine:init', () => {
    Alpine.data('viewRoomCategory', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        data: {},
        init() {
            Alpine.nextTick(() => {
                this.fetchRoomCategory();
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

        fetchRoomCategory() {
            this.$wire.fetchRoomCategory().then((data) => {
                this.data = data;
            }).catch((error) => {
                this.serverErrors = 'Failed to fetch room categories.';
            });

        },

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


            return Object.keys(this.errors).length === 0;
        },

        updateCategory(){
            if(!this.validation()){
                return;
            }
            this.$wire.updateCategory(this.data).then((response) => {
                this.errors = {};
                this.success ='',
                this.serverErrors = '';
                if(response.original.errors){
                    Object.entries(response.orginal.errors).forEach(([key,message]) =>{
                        this.errors[key] =message[0];
                        this.timeoutFunc();
                    })
                }
                else if(response.original.error){
                    this.serverErrors = response.orginal.error;
                    this.timeoutFunc();
                }

                else if(response.original.success){
                    this.success = response.original.success;
                    this.fetchRoomCategory();
                    this.timeoutFunc();
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong" + error;
                this.timeoutFunc();
            })
        },
    }))
})