<script>
    export default {
        data(){
            return {
                
            }
        },
        props: {
            user: {
                type: String,
                default: '',
                required: true
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>


<template>  
    <div>
        <h1>foi</h1>
    </div>
</template>