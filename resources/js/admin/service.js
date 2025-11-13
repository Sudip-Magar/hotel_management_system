document.addEventListener('alpine:init', () => {
    Alpine.data('service', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        data: {
            name: '',
        },
        temData: {
            id: '',
            name: '',
        },

        guestTypes: [],
        showModal: false,
        updateModal: false,

        init() {
            this.fetchData();
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.guestTypes = response;
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },

        validation() {
            this.errors = {};

            if (!this.data.name) {
                this.errors.name = "Name is required.";
            }
            else if (this.data.name.length < 2) {
                this.errors.name = "Name must be at least 3 characters.";
            }
            else if (this.data.name.length > 30) {
                this.errors.name = "Name must not exceed 30 characters.";
            }

            return Object.keys(this.errors).length === 0;
        },

         UpdateValidation() {
            this.errors = {};

            if (!this.temData.name) {
                this.errors.tempName = "Name is required.";
            }
            else if (this.temData.name.length < 2) {
                this.errors.tempName = "Name must be at least 3 characters.";
            }
            else if (this.temData.name.length > 30) {
                this.errors.tempName = "Name must not exceed 30 characters.";
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

        registerGuest() {
            if (!this.validation()) {
                this.timeoutFunc();
                return;
            }

            this.$wire.registerGuest(this.data).then((response) => {
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

                else if (response.original.success) {
                    this.success = response.original.success;
                    this.data = {};
                    this.fetchData();
                    this.timeoutFunc()
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },

        deleteModal(id) {
            this.temData = {};
            const type = this.guestTypes.find(a => a.id === id);
            this.temData = {
                id: type.id,
                name: type.name
            };
            this.showModal = true;
        },

        closeModel() {
            this.temData = {};
            this.showModal = false;
            this.updateModal =false;
        },

        confirmDelete() {
            this.$wire.deleteGuestType(this.temData).then((response) => {
                if (response.original.error) {
                    this.serverErrors = response.original.error;
                    this.timeoutFunc();
                }

                else if (response.original.success) {
                    this.success = response.original.success;
                    this.fetchData();
                    this.showModal = false;
                    this.timeoutFunc();
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
                this.timeoutFunc();
            })
        },

        updateModalView(id) {
            this.temData = {};
            const type = this.guestTypes.find(a => a.id === id);
            this.temData = {
                id: type.id,
                name: type.name
            };
            this.updateModal = true
        },

        updateGuest(){
            this.errors= {};
            this.serverErrors = '';
            this.success = '';

            if(!this.UpdateValidation()){
                this.timeoutFunc();
                return;
            }

            this.$wire.updateGuest(this.temData).then((response) => {
                if(response.original.errors){
                    console.log(response)
                    this.errors.tempName = response.original.errors.name;
                }

                else if(response.original.error){
                    this.serverErrors = response.original.error;
                    this.timeoutFunc();
                }

                else if(response.original.success){
                    this.success = response.original.success;
                    this.temData = {};
                    this.timeoutFunc();
                    this.updateModal = false;
                    this.fetchData();
                    
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },
    }))
})