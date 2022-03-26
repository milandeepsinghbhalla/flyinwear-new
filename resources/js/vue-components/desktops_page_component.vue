<template>
    <div style="margin-top:7.5em;">
        <filters :filter_data="desktop_filters"></filters>
    <div class="container" >
        <h3 class="text-center mb-4">All desktops...!!</h3>
        <div class="row justify-content-center">
            
            <product-card-component v-for="desktop in desktops" :all_products="all_products" :items_in_cart="items_in_cart" :cart="cart" :wishlist="wishlist" v-bind:key="desktop.key" v-bind:product="desktop"></product-card-component>
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
            desktop_filters: {
                companies: ["Dell","HP","Acer","Lenovo","Apple","Any"],
                processor_company: ["intel","AMD","Any"],
                processor_base: ["intel core i3","intel core i5","intel core i7","intel core i9","Amd ryzen 3","Amd ryzen 5","AMD ryzen 7","Any"],
                processor_generation: ["1st gen","2nd gen","3rd gen","4th gen","5th gen","6th gen","7th gen","8th gen","9th gen","10th gen","11th gen","12th gen","Any"],
                operating_system: ["Windows","Linux","Mac os","Any"],
                ram_size: ["2gb","4gb","6gb","8gb","12gb","16gb","16gb +","Any"],
                ram_type: ["DDR2","DDR3","DDR4","Any"],
                hardisk_type:["HDD","SSD","Hybrid","Any"],
                hardisk_size: ["256gb","256gb - 512gb","512gb-1tb","1tb-1256gb","1256gb-1512gb","1512gb-2tb","2tb-2512gb","2512gb +","Any"],
                graphics_type: ["integrated","dedicated","Any"],
                graphics_size: ["1gb","2gb","4gb","6gb","8gb","8gb +","Any"],
                Monitor_size: ["12 inches","12 - 14 inches","14 - 16 inches","16 - 20 inches","20 - 24 inches","24 - 28 inches","28 - 32 inches","32 inches +","Any"]

            }
        }
    },
    components:{
        'product-card-component': product_card_component,
        'filters': filters
    },
    props: ["desktops","wishlist","all_products","cart","items_in_cart"]
}
</script>