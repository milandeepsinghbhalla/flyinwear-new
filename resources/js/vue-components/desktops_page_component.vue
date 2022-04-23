<template>
    <div style="margin-top:7.5em;">
        <filters :filter_data="desktop_filters" :parent_data="desktops" :t_name="'desktops'"></filters>
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
                company: ["Dell","HP","Acer","Lenovo","Apple","others"],
                processor_company: ["Intel","AMD","others"],
                processor_base: ["Intel Celeron","Intel Pentium","Intel Core i3","Intel Core i5","Intel Core i7","Intel Core i9","AMD Ryzen 3","AMD Ryzen 5","AMD Ryzen 7","others"],
                generation: ["1st gen","2nd gen","3rd gen","4th gen","5th gen","6th gen","7th gen","8th gen","9th gen","10th gen","11th gen","12th gen"],
                os_type: ["Microsoft Windows","Mac OS","Linux","others"],
                os_parent: ["Windows 7","windows 8","windows 10","windows 11","mac os","Ubuntu","Fedora","Debian","Kali","others"],
                ms_office: ["yes","no"],
                ram: ["2gb","4gb","6gb","8gb","12gb","16gb","16gb +"],
                ram_type: ["DDR2","DDR3","DDR4","others"],
                hardisk_type:["HDD","SSD","Hybrid"],
                hardisk_size: ["<= 256gb","256gb - 512gb","512gb-1tb","1tb-1256gb","1256gb-1512gb","1512gb-2tb","2tb-2512gb","2512gb +"],
                graphic_card_type: ["integrated","dedicated"],
                graphic_card_size: ["1gb","2gb","4gb","6gb","8gb","8gb +"],
                monitor_size: ["<= 12 inches","12 - 14 inches","14 - 16 inches","16 - 20 inches","20 - 24 inches","24 - 28 inches","28 - 32 inches","32 inches +"]

            }
        }
    },
    components:{
        'product-card-component': product_card_component,
        'filters': filters
    },
    props: ["desktops","wishlist","all_products","cart","items_in_cart"],
    

}
</script>