document.addEventListener('alpine:init', () => {
    Alpine.data('roomCategoryList', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        roomCategories: [],

        init() {
            this.fetchRoomCategories();
        },

        fetchRoomCategories() {
            this.$wire.fetchRoomCategories().then((data) => {
                this.roomCategories = data;
            }).catch((error) => {
                this.serverErrors = 'Failed to fetch room categories.';
            });
        }
    }))
})