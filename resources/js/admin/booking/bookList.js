document.addEventListener('alpine:init', () => {
    Alpine.data('bookingList', () => ({
        bookings:{},
        init(){
            this.fetchData();
        },
        fetchData(){
            this.$wire.allBook().then((response) => {
                this.bookings = response
                console.log(this.bookings)
            }).catch((error) => {
                console.log(error);
            })
        },
    }))
})