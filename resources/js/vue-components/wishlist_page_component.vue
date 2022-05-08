<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">Wishlist items...!!</h3>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button class="btn btn-dark btn-lg">{{items_in_wishlist.length}} items in wishlist</button>
            </div>
            <product-card-component v-for="item in items_in_wishlist" :wishlist="wishlist" v-bind:key="item.key" v-bind:product="item" :all_products="all_products" :cart="cart" :items_in_cart="items_in_cart"></product-card-component>
        </div>
    </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
export default{
    components:{
        'product-card-component': product_card_component
    },
    props: ["items_in_wishlist","wishlist","all_products","cart","items_in_cart"],
    created(){
        this.$scrollTo("#my_nav");
    }
    
}
</script>