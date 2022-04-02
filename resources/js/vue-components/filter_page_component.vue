<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">Filter Results...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="product in filter_data" :all_products="all_products" :items_in_cart="items_in_cart" :cart="cart" :wishlist="wishlist" v-bind:key="product.key" v-bind:product="product"></product-card-component>
        </div>
    </div>
</template>

<script>

import product_card_component from "./product_card_component.vue";
export default {
    
    data: function (){
        return {
            filter_data: {}
        }
    },
    props: ["all_products","items_in_cart","cart","wishlist"],
    created(){
        if(localStorage.getItem('filter_data')){
            this.filter_data = JSON.parse(localStorage.getItem('filter_data'));
        }
          
    },
    components:{
        'product-card-component': product_card_component
    }
}
</script>
