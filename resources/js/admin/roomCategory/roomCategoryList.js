// const Alpine = require("alpinejs");

document.addEventListener('alpine:init', () => {
    Alpine.data('roomCategoryList', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        roomCategories: [],
        showModal: false,
        data: {
            id: '',
            name: '',

        },

        init() {
            Alpine.nextTick(() => {
                this.fetchRoomCategories();
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

        fetchRoomCategories() {
            this.$wire.fetchRoomCategories().then((data) => {
                this.roomCategories = data;
            }).catch((error) => {
                this.serverErrors = 'Failed to fetch room categories.';
            });

        },

        deleteModal(id) {
            const category = this.roomCategories.find(cat => cat.id === id);
            this.data.id = category.id;
            this.data.name = category.name;
            this.showModal = true;
        },

        confirmDelete() {
            this.$wire.deleteRoomCategory(this.data.id).then((response) => {
                this.showModal = false;
                this.fetchRoomCategories();
                if (response.original.success) {
                    this.success = response.original.success;
                    this.timeoutFunc();
                }
                else if (response.original.error) {
                    this.serverErrors = response.original.error;
                    this.timeoutFunc();
                }
            }).catch((error) => {
                this.serverErrors = "Something went wrong " + error;
            })
        },
    }))
})