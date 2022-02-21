<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">Wishlist items...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="item in items_in_wishlist" :wishlist="wishlist" v-bind:key="item.key" v-bind:product="item"></product-card-component>
        </div>
    </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
export default{
    components:{
        'product-card-component': product_card_component
    },
    props: ["items_in_wishlist","wishlist"]
}
</script>
