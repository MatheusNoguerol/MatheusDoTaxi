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
            },
        },
        mounted() {
            console.log('Component mounted.'+ this.user)
        },
    }
</script>

<template>  
    <div>
        <span class="text-center">
            <h1>Seja bem-vindo(a) {{ user }}</h1><br>
            <h1>ao DASHBOARD!</h1>
        </span>
    </div>
</template>