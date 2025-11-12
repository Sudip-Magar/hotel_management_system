document.addEventListener('alpine:init', () => {
    Alpine.data('roomList', () => ({
        data: {
            id: '',
            room_number: '',
        },
        errors: {},
        success: '',
        serverErrors: '',
        showModal: false,
        rooms: {},

        init() {
            this.fetchData();
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

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.rooms = response
            }).catch((error) => {
                this.serverErrors = "Something wnet wrong " + error;
                this.timeoutFunc();
            })
        },

        deleteModal(id) {
            const room = this.rooms.find(a => a.id === id);
            this.data.id = room.id;
            this.data.room_number = room.room_number;
            this.showModal = true;
        },

        confirmDelete() {
            this.$wire.deleteRoom(this.data.id).then((response) => {
                this.showModal = false;
                this.fetchData();
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