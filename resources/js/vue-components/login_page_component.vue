<template>
    <div class="container" style="margin-top:8.5em">
        <login-component :cart="cart"></login-component>
    </div>
</template>

<script>
import login_component from './login_component.vue'

    export default{
        components:{
            "login-component": login_component
        },
        props: ["cart"]
    }

</script>
