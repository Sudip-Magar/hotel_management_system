    document.addEventListener('alpine:init', () => {
    Alpine.data('room', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        rooms:{},
        dbRoom:{},
        loaded: false,
        dbCategories:{},
        category:'',

        init(){
            this.fetchData();
            this.$watch('category',(value) => {
                if(!value){
                    this.rooms = this.dbRoom;
                }
                else{
                    let val = value.toLowerCase();
                    this.rooms = this.dbRoom.filter(room => {
                        return (
                            room.category.name.toLowerCase().includes(val)
                        )
                    })
                }
            })
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                this.dbRoom = response[0];
                this.rooms = response[0];
                this.dbCategories = response[1];
                this.loaded =true;
                
            }).catch((error) => {
                this.serverErrors = "Something went wrong" + error;
            })
        },
    }))
})