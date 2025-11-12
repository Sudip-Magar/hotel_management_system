document.addEventListener('alpine:init', () => {
    Alpine.data('dashboard', () => ({
        
        errors: {},
        success: '',
        serverErrors: '',
    }))
})