document.addEventListener('alpine:init', () => {
    Alpine.data('room', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        rooms:{},

        init(){
            this.fetchData();
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.rooms = response;
                // console.log(response)
                // console.log(response[0].room_images[0])
                
            }).catch((error) => {
                this.serverErrors = "Something went wrong" + error;
            })
        },
    }))
})