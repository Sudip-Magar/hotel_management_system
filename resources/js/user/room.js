document.addEventListener('alpine:init', () => {
    Alpine.data('room', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        rooms: {},
        dbRoom: {},
        loaded: false,
        dbCategories: {},
        category: '',
        search: '',

        init() {
            this.fetchData();
            this.$watch('category', () => {
                this.filterRooms();
            });
    
            this.$watch('search', () => {
                this.filterRooms();
            });
        },

        filterRooms() {
            let category = this.category?.toLowerCase() || '';
            let search = this.search?.toLowerCase() || '';

            this.rooms = this.dbRoom.filter(room => {
                let matchCategory = category
                    ? room.category.name.toLowerCase().includes(category)
                    : true;

                let matchSearch = search
                    ? room.room_number.toLowerCase().includes(search)
                    : true;

                return matchCategory && matchSearch;
            });
        },

        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.dbRoom = response[0];
                this.rooms = response[0];
                this.dbCategories = response[1];
                this.loaded = true;

            }).catch((error) => {
                this.serverErrors = "Something went wrong" + error;
            })
        },
    }))
})