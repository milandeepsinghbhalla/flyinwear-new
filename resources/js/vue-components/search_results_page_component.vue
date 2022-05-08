<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center mb-4">Search Results...!!</h3>
    
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button class="btn btn-lg btn-dark">{{search_results.length}} results found...!!</button>
            </div>
            <product-card-component v-for="product in search_results" :all_products="all_products" :items_in_cart="items_in_cart" :cart="cart" :wishlist="wishlist" v-bind:key="product.key" v-bind:product="product"></product-card-component>
        </div>
    </div>
</template>
<script>
import product_card_component from "./product_card_component.vue";
export default{
    data : function(){
        return {
            search_text: "",
            w_tables: [
                {
                    keys:["tops","uppers","tshirts","roundnecks"],
                    t_name: "w_tops"
                },
                {
                    keys: ["sweatshirts","hoodies","wintershirts"],
                    t_name: "w_sweat_shirts"
                },
                {
                    keys: ["kurtas","kurti"],
                    t_name: "w_kurtas"
                },
                {
                    keys: ["ethinic","wedding","special","functions"],
                    t_name: "w_ethinics",

                },
                {
                    keys: ["jeans","pants","trousers"],
                    t_name: "w_jeans"
                },
                {
                    keys:["joggers","trackpants","lowers","pyjamas"],
                    t_name:"joggers"
                },
                {
                    keys:["caperies"],
                    t_name:"caperies"
                },
                {
                    keys:["shorts","nickers"],
                    t_name:"shorts"
                },
            ],
            t_names: [
                {
                    keys:["shirts"],
                    t_name: "shirts"
                },
                {
                    keys:["tshirts","t shirts","roundneck"],
                    t_name: "round_necks"
                },
                {
                    keys:["polos"],
                    t_name: "polos"
                },
                {
                    keys:["sweatshirts","hoodies"],
                    t_name:"sweat_shirts"
                },
                {
                    keys:["kurtas"],
                    t_name:"kurtas"
                },
                {
                    keys:["jeans","pants","trousers"],
                    t_name:"jeans"
                },
                {
                    keys:["joggers","trackpants","lowers","pyjamas"],
                    t_name:"joggers"
                },
                {
                    keys:["caperies"],
                    t_name:"caperies"
                },
                {
                    keys:["shorts","nickers"],
                    t_name:"shorts"
                },
                {
                    keys:["ethinic","wedding","functions","official"],
                    t_name:"ethinics"
                },
                {
                    keys:["desktops","pc","computers"],
                    t_name: "desktops"
                },
                {
                    keys:["laptops"],
                    t_name:"laptops"
                },
                {
                    keys:["mobiles","phones"],
                    t_name:"mobiles"
                }
            ],
            genders: ["women","girls","ladies"],
            search_results: [],
            all_tables: ["desktops","laptops","mobiles","joggers","shirts","round_necks",'polos','sweat_shirts','kurtas','jeans','caperies','shorts','w_tops','w_sweat_shirts','w_kurtas','w_joggers','w_jeans','w_caperies','w_shorts','w_ethinics','ethinics']
        }
       
    },
    props: ["all_products","items_in_cart","cart","wishlist"],
    components:{
        "product-card-component": product_card_component
    },
    async created(){
                this.$scrollTo("#my_nav");

        if(localStorage.getItem('search_text').length>0){
            this.search_text = localStorage.getItem('search_text');
            let search_keywords = [];
            search_keywords = this.search_text.split(" ");
            search_keywords.forEach(el=>{
                el = el.trim();
            })
            let t_name = ""
            let selector = "t_names";

            search_keywords.every(keyword=>{
                this.genders.forEach(gender=>{
                    if(gender.toLowerCase().substring(0,3)==keyword.toLowerCase().substring(0,3))
                        selector = "w_tables";
                })
                this[selector].every(obj=>{
                    obj.keys.every(key=>{
                        if(key.toLowerCase().substring(0,4)==keyword.toLowerCase().substring(0,4)){
                            t_name = obj.t_name;
                            return false;
                        }
                        else
                            return true;
                    })
                    if(t_name.length>0)
                        return false;
                    else
                        return true;
                    
                })
                if(t_name.length>0)
                    return false; 
                else 
                    return true;
            })
            console.log("t name = ",t_name);
            if(t_name.length>0){
                let search_products = [];
                await this.$http.post('api/get-products',{t_name: t_name}).then( res=>{
                console.log("desktops:-  ",res.body);
                
                res.body.forEach(desktop=>{
                    desktop.colors = JSON.parse(desktop.colors)
                    desktop.images = JSON.parse(desktop.images)
                    desktop.keywords = JSON.parse(desktop.keywords)
                    desktop.weight = Number(desktop.weight)
                    desktop.actual_price = desktop.price - (desktop.price*desktop.discount)/100
                })
                search_products = res.body; 
                })
                let new_products = [];
                search_products.forEach(sp=>{
                    let count = 0;
                    if(sp.keywords){
                        sp.keywords.forEach(key_product=>{
                            search_keywords.forEach(key_search=>{
                                key_product = key_product.trim();
                                if(key_product.toLowerCase().substring(0,3)==key_search.toLowerCase().substring(0,3)){
                                    count++;
                                }
                            })
                        })
                    }
                    sp.count = count;
                })
                search_products.sort(function(a,b){
                    return b.count - a.count;
                })

                console.log("search results = ",search_products);
                this.search_results = search_products;
            }
            else{
                
                let new_products = [];
                this.all_tables.forEach(async table=>{
                    let search_products = [];
                await this.$http.post('api/get-products',{t_name: table}).then( res=>{
                    console.log("desktops:-  ",res.body);
                    
                    res.body.forEach(desktop=>{
                        desktop.colors = JSON.parse(desktop.colors)
                        desktop.images = JSON.parse(desktop.images)
                        desktop.keywords = JSON.parse(desktop.keywords)
                        desktop.weight = Number(desktop.weight)
                        desktop.actual_price = desktop.price - (desktop.price*desktop.discount)/100
                    })
                    search_products = res.body; 
                })
                
                search_products.forEach(sp=>{
                    let count = 0;
                    if(sp.keywords){
                        sp.keywords.forEach(key_product=>{
                            search_keywords.forEach(key_search=>{
                                key_product = key_product.trim();
                                if(key_product.toLowerCase().substring(0,3)==key_search.toLowerCase().substring(0,3)){
                                    count++;
                                }
                            })
                        })
                    }
                    sp.count = count;
                })
                search_products.sort(function(a,b){
                    return b.count - a.count;
                })
                search_products.forEach(product=>{
                    if(product.count>0){
                        new_products.push(product)
                    }
                })

                
                })
                new_products.sort(function(a,b){
                    return a.count - b.count;
                })
                console.log("search results = ",new_products);
                this.search_results = new_products;
            }
        }        
    }
}
</script>
