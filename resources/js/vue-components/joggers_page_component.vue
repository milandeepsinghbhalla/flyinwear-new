<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">All joggers...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="i in 5" v-bind:key="i"></product-card-component>
        </div>
    </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
export default{
    components:{
        'product-card-component': product_card_component
    }
}
</script>
