<template>
    <div style="margin-top:7.5em;">
        <filters :filter_data="filters" :parent_data="products" :t_name="t_name"></filters>
    <div class="container" >
        <h3 class="text-center mb-4">All {{p_name}}...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="product in products" :all_products="all_products" :items_in_cart="items_in_cart" :cart="cart" :wishlist="wishlist" v-bind:key="product.key" v-bind:product="product"></product-card-component>
        </div>
    </div>

    </div>
</template>
<script>
import product_card_component from "./product_card_component.vue";
import filters from "./filters_component.vue"
export default{
    data: function(){
        return {
            products:[],
            filters: {},
            t_name: "",
            p_name: ""
        }
    },
     components:{
        'product-card-component': product_card_component,
        'filters': filters
    },
    props: ["wishlist","all_products","cart","items_in_cart"],
   async created(){
               this.$scrollTo("#my_nav");

         this.t_name = this.$route.params.t_name
        this.p_name =  this.t_name.replace('_'," ");
        await this.$http.post('api/get-products',{t_name: this.t_name}).then( res=>{
            console.log("req_products:-  ",res.body);
            
            res.body.forEach(product=>{
                product.colors = JSON.parse(product.colors)
                product.images = JSON.parse(product.images)
                product.weight = Number(product.weight)
                product.actual_price = product.price - (product.price*product.discount)/100
            })
             this.products = res.body
        })
        if(this.t_name=='laptops'){
            this.filters = {
                company: ["Dell","HP","Acer","Lenovo","Apple","others"],
                processor_company: ["Intel","AMD","others"],
                processor_base: ["Intel Celeron","Intel Pentium","Intel Core i3","Intel Core i5","Intel Core i7","Intel Core i9","AMD Ryzen 3","AMD Ryzen 5","AMD Ryzen 7","others"],
                generation: ["1st gen","2nd gen","3rd gen","4th gen","5th gen","6th gen","7th gen","8th gen","9th gen","10th gen","11th gen","12th gen"],
                os_type: ["Microsoft Windows","Mac OS","Linux","others"],
                os_parent: ["Windows 7","windows 8","windows 10","windows 11","mac os","Ubuntu","Fedora","Debian","Kali","others"],
                ms_office: ["yes","no"],
                ram_range: ["1gb","2gb - 4gb","4.1gb - 6gb","6.1gb - 8gb","8.1gb - 10gb","10.1gb - 12gb","12.1gb - 16gb","16gb +"],
                ram_type: ["DDR2","DDR3","DDR4","others"],
                hardisk_type: ["HDD","SSD","Hybrid"],
                graphic_card_size: ["1gb","2gb","4gb","6gb","8gb","8gb +"],
                graphic_card_type: ["integrated","dedicated"],
                screen_size_range: ["11-13 inches","13.1 - 14 inches","14.1 - 15 inches","15.1 - 16 inches","16.1 - 17 inches","17 + inches"],
                battery_backup_range: ["3 - 5 hrs","5.1 - 7 hrs","7.1 - 9 hrs","9.1 - 12 hrs","12 + hrs"],
                webcam: ["yes","no"],
                dvd_drive: ["yes","no"]
            }
        }
        if(this.t_name=='mobiles'){
            this.filters = {
                company: ["Xiaomi","Samsung","Vivo","Oppo","Apple","Realme","OnePlus","Poco","Nokia","others"],
                ram: ["1gb","2gb","3gb","4gb","6gb","8gb","10gb","12gb","16gb","16gb +"],
                color: ["black","grey","gold","pink gold","green","red","orange","white","blue","yellow","pink","silver","purple","brown","other"],
                rom: ["16gb","32gb","64gb","128gb","256gb","512gb","512gb +"],
                camera_mp_highest: ["8mp","12mp","16mp","32mp","48mp","64mp","72mp","128mp","128mp +"],
                display: ["FHD","Amoled","Super Amoled","others"],
            }
        }

    }
}
</script>