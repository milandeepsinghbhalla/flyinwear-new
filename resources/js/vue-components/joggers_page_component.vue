<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">All joggers...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="jogger in joggers" v-bind:key="jogger.key" v-bind:product="jogger"></product-card-component>
        </div>
    </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
export default{
    components:{
        'product-card-component': product_card_component
    },
    props: ["joggers"]
}
</script>
