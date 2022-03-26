<template>
    <div class="col-lg-10 col-12">
        <div class="row my-3 justify-content-center">
            <button class="btn btn-md orange" v-on:click="add_products">Add Product +</button>
        </div>
        <div class="row ml-2" v-if="this.controls.show_others==1">

            <div class="card col-lg-4 col-md-4 col-6 text-purple bg-dark mb-3">
                <div class="card-header">Total Products</div>
                <div class="card-body">
                    <h5 class="card-title">{{all_products.length}}</h5>
                </div>
            </div>
        </div>
        <add-product-main-component v-if="controls.add_product==1" :controls="controls"></add-product-main-component>
        <add-other-product-component v-if="controls.show_aopc==1" :controls="controls"></add-other-product-component>
        <add-clothing-product-component v-if="controls.show_acpc==1" :conrols="controls"></add-clothing-product-component>
    </div>    
</template>

<script>
import add_product_main_component from "./add_product_main_component.vue";
import add_clothing_product_component from "./add_clothing_product_component.vue"
import add_other_product_component from "./add_other_product_component.vue"

 export default{
     data: function(){
         return {
             all_products: [],
             joggers: [],
             desktops: [],
            
         }
     },
     async created(){
         await this.$http.get('/api/get-all-products').then( res=>{
            console.log(res.body);
             this.all_products = res.body;
        })
        await this.$http.post('api/get-products',{t_name: "desktops"}).then( res=>{
            console.log("desktops:-  ",res.body);
            
            res.body.forEach(desktop=>{
                desktop.colors = JSON.parse(desktop.colors)
                desktop.images = JSON.parse(desktop.images)
                desktop.weight = Number(desktop.weight)
            })
             this.desktops = res.body
        })
       await this.$http.post('api/get-products',{t_name: "joggers"}).then( res=>{
            console.log("joggers:-  ",res.body);
            
            res.body.forEach(jogger=>{
                jogger.colors = JSON.parse(jogger.colors)
                jogger.images = JSON.parse(jogger.images)
                jogger.weight = Number(jogger.weight)
            })
                 this.joggers = res.body
        })
     },
     components:{
         "add-product-main-component": add_product_main_component,
         "add-clothing-product-component": add_clothing_product_component,
         "add-other-product-component": add_other_product_component
     },
     props: ["controls"],
     methods:{
         add_products(){
             console.log("helloo");
             this.controls.add_product=1;
             this.controls.show_others = 0;
             this.controls.show_acpc = 0;
             this.controls.show_aopc = 0;
         }
     }
 }
</script>
