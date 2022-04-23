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
        <button class="btn btn-dark btn-lg" v-if="cart_total>0" v-on:click="proceed_clicked()">Total = {{cart_total}} proceed <i class="fas fa-thumbs-up"></i></button>
        <button v-else class="btn btn-dark btn-lg"><i class="fas fa-frown-open"></i> Cart is empty...!!</button>
    </div>
    <login-to-continue-component v-if="show_login_to_continue==1"></login-to-continue-component>
    </div>
</template>

<script>
    import cart_card_component from "./cart_card_component.vue"
import login_to_continue_component from './login_to_continue_component.vue'
    export default{
        data:function (){
            return {
                show_login_to_continue: 0
            }
        },
        props: ['items_in_cart','can_add_to_cart','cart','all_products','current_user',"cart_total"],
        methods: {
            proceed_clicked(){
                if(this.$current_user.id!=-1){
                    this.$router.push('/checkout-step-1');
                }
                else{
                    this.show_login_to_continue = 1;
                }
            }
        },
        components: {
            "cart-card-component": cart_card_component,
              "login-to-continue-component"  : login_to_continue_component
        }
    }
</script>
