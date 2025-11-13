document.addEventListener('alpine:init', () => {
    Alpine.data('roomDatail', () => ({
        errors: {},
        success: '',
        serverErrors: '',
        init(){
            this.fetchData();
        },
        fetchData() {
            this.$wire.fetchData().then((response) => {
                console.log(response)
            }).catch((error) => {

            })
        },
    }))
})