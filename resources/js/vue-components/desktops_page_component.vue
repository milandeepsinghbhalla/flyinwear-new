<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">All desktops...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="desktop in desktops" :all_products="all_products" :items_in_cart="items_in_cart" :cart="cart" :wishlist="wishlist" v-bind:key="desktop.key" v-bind:product="desktop"></product-card-component>
        </div>
    </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
export default{
    components:{
        'product-card-component': product_card_component
    },
    props: ["desktops","wishlist","all_products","cart","items_in_cart"]
}
</script>