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
            joggers: [],
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