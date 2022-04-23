<template>
  <div style="margin-top:7.5em;">      
    <filters :filter_data="jogger_filters" :parent_data="clothing_products" :t_name="t_name"></filters>

    <div class="container">
        <h3 class="text-center mb-4">All {{p_name}}...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="product in clothing_products" :all_products="all_products" :cart="cart" :items_in_cart="items_in_cart" :wishlist="wishlist" v-bind:key="product.key" v-bind:product="product"></product-card-component>
        </div>
    </div>
  </div>
</template>

<script>
import product_card_component from "./product_card_component.vue";
import filters from "./filters_component.vue"

export default{
    data: function (){
        return {
            jogger_filters:{
                color: ["Blue","red","green","brown","black","grey","pink","yellow","crimson","orange","purple","white","chocolate","multi-color"],
                size: ["S","M","L","XL","2XL","3XL","4XL","5XL"],
                clothing_price: ["0 - 100","101 - 200","201 - 300","301 - 400","401 - 500","501 - 700","701 - 900","901 - 1100","1100 - 1500","1500 - 1900","1900 - 2300","2300+"],
                brand: ["ZARA" , "Urbano", "nike","puma","adidas","others"]

            },
            t_name: "",
            p_name: "",
            clothing_products: []
        }
    },
    created(){
        
        this.t_name = this.$route.params.t_name
        this.p_name =  this.t_name.replace('_'," ");
        this.$http.post('api/get-products',{t_name: this.t_name}).then( res=>{
            console.log("req_products:-  ",res.body);
            
            res.body.forEach(product=>{
                product.colors = JSON.parse(product.colors)
                product.images = JSON.parse(product.images)
                product.weight = Number(product.weight)
                product.actual_price = product.price - (product.price*product.discount)/100
            })
             this.clothing_products = res.body
        })
    },
    components:{
        'product-card-component': product_card_component,
        'filters': filters
    },
    props: ["wishlist","all_products","cart","items_in_cart"]
}
</script>
