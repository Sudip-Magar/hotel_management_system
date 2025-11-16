document.addEventListener('alpine:init', () => {
    Alpine.data('room', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        rooms:{},
        loaded: false,

        init(){
            this.fetchData();
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.rooms = response;
                this.loaded =true;
                console.log(this.rooms)
                
            }).catch((error) => {
                this.serverErrors = "Something went wrong" + error;
            })
        },
    }))
})