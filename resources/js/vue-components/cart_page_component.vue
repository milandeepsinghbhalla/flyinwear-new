<template>
    <div class="container" style="margin-top:7.5em">
    <div class="row" v-for="product in items_in_cart" v-bind:key="product.cart_id + 'c'" style="text-align: left;margin: 0 auto;width:100%">
						<div class="col-lg-8 p-0" style="text-align: left;margin: 0 auto">
                            <cart-card-component :cart_total="cart_total" 
                                                v-bind:product="product"
											  v-bind:can_add_to_cart="can_add_to_cart"
											  v-bind:cart="cart"
											  v-bind:items_in_cart="items_in_cart"
											  v-bind:all_products="all_products"
                                              v-bind:current_user="current_user"></cart-card-component>
                        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <button class="btn btn-dark btn-lg">Total = {{cart_total}} proceed <i class="fas fa-thumbs-up"></i></button>
    </div>
    </div>
</template>

<script>
    import cart_card_component from "./cart_card_component.vue"
    export default{
        props: ['items_in_cart','can_add_to_cart','cart','all_products','current_user',"cart_total"],
        components: {
            "cart-card-component": cart_card_component
        }
    }
</script>
