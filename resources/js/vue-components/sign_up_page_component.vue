<template>
    <div class="container" style="margin-top: 8.5em">
        <sign-up-component :cart="cart"></sign-up-component>
    </div>
</template>

<script>

    import sign_up_component from "./sign_up_component.vue"

    export default{
        components: {
            'sign-up-component' : sign_up_component
        },
        props: ["cart"]
    }
</script>
