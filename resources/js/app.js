import Vue from "vue";
import VueRouter from 'vue-router'
import VueResource  from 'vue-resource'
import VueScrollTo from 'vue-scrollto'
Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueScrollTo);

import navbar_component from './vue-components/navbar_component.vue';
import all_products_offcanvas_component from "./vue-components/all_products_offcanvas_component.vue";
import joggers_page_component from "./vue-components/joggers_page_component.vue"
import product_details_component from "./vue-components/product_details_component.vue"
const router = new VueRouter({
	routes: [
        {
            path:'/cart',
            
        },
        {
            path:'/login',
            
        },
        {
            path:'/joggers',
            components:{
                "joggers-page-component": joggers_page_component
            }
            
        },
        {
            path:'/product-details/:key',
            components:{
                "product_details_component": product_details_component
            }
            
        },
    ]
    })
const webstore = new Vue({
    el: '#app',
    router: router,
    data: function(){
        return {
            search_result: [],
            form1: {
                t_name: '',
                pstock: '',
                pname:''
            },
            signform: {},
            login: {},
            current_user: {
                uid: -1,
                name: 'guest',
                w_number: null,
                number: null
            },
            shirts: [],
            round_necks:[],
            polos: [],
            sweat_shirts: [],
            kurtas: [],
            jeans: [],
            joggers: [{
                id: 1,
                title: "black jogger with great fabric..(long lasting)",
                card_img: "storage/jogger.jpeg",
                sizes: "M L XL 2xl",
                price: 750,
                weight: 8.34,
                stock: 40,
                colors: ["black"],
                fabric: "cotton",
                images: [],
                stock_s: 10,
                stock_l: 10,
                stock_xl: 0,
                stock_2xl: 0,
                stock_3xl: 0,
                stock_4xl: 0,
                stock_5xl: 0,
                key: "clothing-joggers-1"
            },
            {
                id: 2,
                title: "black jogger with great fabric..(long lasting)",
                card_img: "storage/jogger.jpeg",
                sizes: "M L XL 2xl",
                price: 750,
                weight: 8.34,
                stock: 40,
                colors: ["black"],
                fabric: "cotton",
                images: [],
                stock_s: 10,
                stock_l: 10,
                stock_xl: 0,
                stock_2xl: 0,
                stock_3xl: 0,
                stock_4xl: 0,
                stock_5xl: 0,
                key: "clothing-joggers-2"
            },
            {
                id: 3,
                title: "black jogger with great fabric..(long lasting)",
                card_img: "storage/jogger.jpeg",
                sizes: "M L XL 2xl",
                price: 750,
                weight: 8.34,
                stock: 40,
                colors: ["black"],
                fabric: "cotton",
                images: [],
                stock_s: 10,
                stock_l: 10,
                stock_xl: 0,
                stock_2xl: 0,
                stock_3xl: 0,
                stock_4xl: 0,
                stock_5xl: 0,
                key: "clothing-joggers-3"
            }
            ],
            caperies: [],
            shorts: [],
            cart: [],
            all_products:[],
        }
    },
    components:{
        'navbar-component': navbar_component,
        "all-products-offcanvas-component": all_products_offcanvas_component
    }

})