<script>
    export default {
        data(){
            return{

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
        Em desenvolvimento...
    </div>
</template>