<template>
  <div style="margin-top:7.5em;">      
    <filters :filter_data="jogger_filters" :parent_data="joggers" :t_name="'joggers'"></filters>

    <div class="container">
        <h3 class="text-center mb-4">All joggers...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="jogger in joggers" :all_products="all_products" :cart="cart" :items_in_cart="items_in_cart" :wishlist="wishlist" v-bind:key="jogger.key" v-bind:product="jogger"></product-card-component>
        </div>
    </div>
  </div>
</template>