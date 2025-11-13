document.addEventListener('alpine:init', () => {
    Alpine.data('viewRoom', () => ({
        data: {
            room_number: '',
            category_id: '',
            price: '',
            guest_type_id: '',
            max_guest: '',
            room_images: {},
        },

        feature: {
            bedroom_count: '',
            toilet_count: '',
            has_kitchen: false,
            has_balcony: false,
            has_living_room: false,
        },

        errors: {},
        success: '',
        serverErrors: '',
        categories: [],
        guestType: [],
        serviceShow: false,
        roomShow: true,
        featureShow: false,
        services: [], // all services from backend
        selectedServices: [], // ids that are checked

        init() {
            this.fetchData();
        },

        serviceShowButton() {
            this.serviceShow = true;
            this.roomShow = false;
            this.featureShow = false;
        },

        RoomShowButton() {
            this.serviceShow = false;
            this.roomShow = true;
            this.featureShow = false;
        },

        featureShowButton() {
            this.serviceShow = false;
            this.roomShow = false;
            this.featureShow = true;
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.categories = response[0];
                this.guestType = response[1]
                Object.assign(this.data, response[2]);
                this.feature = {
                    ...response[2].room_feature,
                    has_kitchen: !!response[2].room_feature.has_kitchen,
                    has_balcony: !!response[2].room_feature.has_balcony,
                    has_living_room: !!response[2].room_feature.has_living_room,
                };
                this.services = response[3];
                this.selectedServices = response[4]; // already checked ones
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


            if (!this.data.guest_type_id) {
                this.errors.guest_type_id = "guest type is required";
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
            this.$wire.updateRoom(this.data, this.feature, this.selectedServices).then((response) => {
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
                    this.timeoutFunc();
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong client " + error;
            })

        },
    }))
})