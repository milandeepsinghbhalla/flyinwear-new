import Vue from "vue";
import VueRouter from 'vue-router'
import VueResource  from 'vue-resource'
import VueScrollTo from 'vue-scrollto'
Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueScrollTo);

import navbar_component from './vue-components/navbar_component.vue';
import all_products_offcanvas_component from "./vue-components/all_products_offcanvas_component.vue";
import clothing_products_page_component from "./vue-components/clothing_products_page_component.vue"
import desktops_page_component from "./vue-components/desktops_page_component.vue"
import wishlist_page_component from "./vue-components/wishlist_page_component.vue"

import product_details_component from "./vue-components/product_details_component.vue"
import cart_page_component from "./vue-components/cart_page_component.vue"
import sign_up_page_component from "./vue-components/sign_up_page_component.vue"
import admin_page_component from "./vue-components/admin_page_component.vue"
import vendor_page_component from "./vue-components/vendor_page_component.vue"
import login_page_component from "./vue-components/login_page_component.vue"
import checkout_page_component from "./vue-components/checkout_page_component.vue"
import filter_page_component from "./vue-components/filter_page_component.vue"
import be_a_vendor_page_component from "./vue-components/be_a_vendor_page_component.vue"
import checkout_step_1_component from "./vue-components/checkout_step_1_component.vue"
import checkout_step_2_component from "./vue-components/checkout_step_2_component.vue"
import user_orders_page_component from "./vue-components/user_orders_page_component.vue";
import { forEach } from "lodash";


const router = new VueRouter({
	routes: [
        {
            path:'/filter-result',
            name: "filter-result",
            components:{
                'filter-page-component': filter_page_component
            },
            props: true
            
        },
        {
            path:'/vendor',
            components:{
                'vendor-page-component': vendor_page_component
            }
            
        },
        {
            path:'/vendor-orders',
            components:{
                'vendor-page-component': vendor_page_component
            }
            
        },
        {
            path:'/login',
            components:{
                "login-page-component": login_page_component
            }
        },
        {
            path:'/sign-up',
            components:{
                'sign-up-page-component': sign_up_page_component
            }
            
        },
        {
            path:'/admin',
            components:{
                'admin-page-component': admin_page_component
            }
            
        },
        {
            path:'/joggers',
            components:{
                "clothing-products-page-component": clothing_products_page_component
            }
            
        },{
            path:'/shirts',
            components:{
                "clothing-products-page-component": clothing_products_page_component
            }
            
        },
        {
            path:'/clothing-products/:t_name',
            components:{
                "clothing-products-page-component": clothing_products_page_component
            }
            
        },
        {
            path:'/desktops',
            components:{
                "desktops-page-component": desktops_page_component
            }
            
        },
        {
            path:'/product-details/:key',
            components:{
                "product_details_component": product_details_component
            }
            
        },
        {
            path:'/cart',
            components:{
                "cart-page-component": cart_page_component
            }
            
        },
        {
            path:'/vendor-registration',
            components:{
                "be-a-vendor-page-component": be_a_vendor_page_component
            }
            
        },
        {
            path:'/wishlist',
            components:{
                "wishlist-page-component": wishlist_page_component
            }
            
        },
        {
            path:'/checkout/:sub-route',
            components:{
                "checkout-page-component": checkout_page_component
            }
            
        },
        {
            path:'/checkout-step-1',
            components:{
                "checkout-step-1-component": checkout_step_1_component
            }
            
        },
        {
            path:'/checkout-step-2',
            components:{
                "checkout-step-2-component": checkout_step_2_component
            }
            
        },
        {
            path:'/orders',
            components:{
                "user-orders-page-component": user_orders_page_component
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
               
            },
            clothing_products:["joggers","shirts","round_necks",'polos','sweat_shirts','kurtas','jeans','caperies','shorts'],
            shirts: [],
            round_necks:[],
            polos: [],
            sweat_shirts: [],
            kurtas: [],
            jeans: [],
            joggers : [],
            // joggers: [{
            //     id: 1,
            //     title: "black jogger with great fabric..(long lasting)",
            //     card_img: "storage/jogger.jpeg",
            //     sizes: "M L XL 2xl",
            //     price: 750,
            //     weight: 8.34,
            //     stock: 40,
            //     colors: ["black"],
            //     fabric: "cotton",
            //     images: [],
            //     stock_s: 10,
            //     stock_l: 10,
            //     stock_xl: 0,
            //     stock_2xl: 0,
            //     stock_3xl: 0,
            //     stock_4xl: 0,
            //     stock_5xl: 0,
            //     key: "clothing-joggers-1"
            // },
            // {
            //     id: 2,
            //     title: "black jogger with great fabric..(long lasting)",
            //     card_img: "storage/jogger.jpeg",
            //     sizes: "M L XL 2xl",
            //     price: 750,
            //     weight: 8.34,
            //     stock: 40,
            //     colors: ["black"],
            //     fabric: "cotton",
            //     images: [],
            //     stock_s: 10,
            //     stock_l: 10,
            //     stock_xl: 0,
            //     stock_2xl: 0,
            //     stock_3xl: 0,
            //     stock_4xl: 0,
            //     stock_5xl: 0,
            //     key: "clothing-joggers-2"
            // },
            // {
            //     id: 3,
            //     title: "black jogger with great fabric..(long lasting)",
            //     card_img: "storage/jogger.jpeg",
            //     sizes: "M L XL 2xl",
            //     price: 750,
            //     weight: 8.34,
            //     stock: 40,
            //     colors: ["black"],
            //     fabric: "cotton",
            //     images: [],
            //     stock_s: 10,
            //     stock_l: 10,
            //     stock_xl: 0,
            //     stock_2xl: 0,
            //     stock_3xl: 0,
            //     stock_4xl: 0,
            //     stock_5xl: 0,
            //     key: "clothing-joggers-3"
            // }
            // ],
            caperies: [],
            shorts: [],
            cart: [],
            desktops: [],
            all_products:[],
            wishlist: [],
        //     desktops: [{
        //         id: 4,
        //         title: "Dell companion 15 i5 6th gen 8gb ram 1tb Hdd + 512gb ssd",
        //         stock: 40,
        //         features: [],
        //         card_img: "storage/jogger.jpeg",
        //         price: 45000,
        //         wieght: "5kg",
        //         images: [],
        //         key: "electronincs-desktops-4",
        //         keywords: "",
        //         colors: ["grey"] 
        //     },
        //     {
        //         id: 5,
        //         title: "Dell companion 15 i5 6th gen 8gb ram 1tb Hdd + 512gb ssd",
        //         stock: 40,
        //         features: [],
        //         card_img: "storage/jogger.jpeg",
        //         price: 45000,
        //         wieght: "5kg",
        //         images: [],
        //         key: "electronincs-desktops-5",
        //         keywords: "", 
        //         colors: ["black"]
        //     },
        // ],
        //     all_products:[{
        //         id: 1,
        //         title: "black jogger with great fabric..(long lasting)",
        //         t_name: "joggers",
        //         stock: 40
        //     },
        //     {
        //         id: 2,
        //         title: "black jogger with great fabric..(long lasting)",
               
        //         stock: 40,
        //         t_name: "joggers"
        //     },
        //     {
        //         id: 3,
        //         title: "black jogger with great fabric..(long lasting)",
        //         stock: 40,
        //         t_name: "joggers"
        //     },
        //     {
        //         id: 4,
        //         title: "Dell companion 15 i5 6th gen 8gb ram 1tb Hdd + 512gb ssd",
        //         stock: 40,
        //         t_name: "desktops"
        //     },
        //     {
        //         id: 5,
        //         title: "Dell companion 15 i5 6th gen 8gb ram 1tb Hdd + 512gb ssd",
        //         stock: 40,
        //         t_name: "desktops"
        //     }
        //     ],
        }
    },
    computed:{
        can_add_to_cart: function(){
			let cart_checker=[];
			let i;
			for(i=0;i<this.all_products.length;i++){
				let j,no_of_curr_item=0;
				for(j=0;j<this.cart.length;j++){
					if(this.cart[j].id===this.all_products[i].id){
						no_of_curr_item++;
					}

				}
				if(this.all_products[i].stock>no_of_curr_item){
					cart_checker[this.all_products[i].id-1]=true;
          console.log("in true");
        }
				else{
					cart_checker[this.all_products[i].id-1]=false;
          console.log("in false");
        }
			}
			return cart_checker;
        },
        items_in_cart(){
			let i,j,no_of_items=1;
        
            
             let counts = {};
             let final = [];
             
             for(let i =0; i < this.cart.length; i++){ 
                 if (counts[this.cart[i].cart_id]){
                 counts[this.cart[i].cart_id] += 1
                 } else {
                 counts[this.cart[i].cart_id] = 1
                 }
                }
                
              for (let prop in counts){
                let o={} 
                o.cart_id = prop;
                o.no_in_cart = counts[prop];
                let pro = this.cart.find(element=>element.cart_id==prop);
                console.log("pro - ",pro)
                o.id = pro.id;
                let selected_size = null
                if(pro.size){
                    o.size = pro.size;
                    selected_size = "stock_" + pro.size;
                }
                o.color = pro.color;
                 
                console.log(pro.id);
                console.log(this.all_products);
                let pro_main = this.all_products.find(element=>element.id==pro.id);
                console.log(pro_main);
                if(pro_main){
                  let the_product = this[pro_main.t_name].find(element=>element.id==pro_main.id);
                    if(the_product){
                          o.title= the_product.title
                          o.card_img= the_product.card_img
                          if(the_product.sizes)
                          o.sizes= the_product.sizes
                          o.price= the_product.price
                          o.weight= the_product.weight
                          o.stock= the_product.stock
                          if(selected_size)
                          o[selected_size] = the_product[selected_size]
                          o.colors= the_product.colors
                          if(the_product.fabric)
                          o.fabric= the_product.fabric
                          o.images= the_product.images
                          o.key = the_product.key
                          o.actual_price = the_product.actual_price
                          o.vid = the_product.vid
                         
                  final.push(o);
                    }
              } 
            }
            
			
			return final;
		},
        items_in_wishlist(){
            let arr = [];
            this.all_products.forEach(product=>{
                this.wishlist.forEach(el=>{
                    if(product.id==el){
                        let wish_item = this[product.t_name].find(pro=>pro.id==product.id);
                        arr.push(wish_item);
                    }
                })
            })
            return arr;
        },
        cart_total(){
            let total = 0;
            this.items_in_cart.forEach(item=>{
                total += (item.no_in_cart * item.actual_price);
            })
            return total;
        },
        cart_weight(){
            let weight = 0;
            this.items_in_cart.forEach(item=>{
                weight += (item.weight * item.no_in_cart)
            })
            return weight;
        },
        sub_orders(){
            let sub_orders = {}
            this.items_in_cart.forEach(item=>{
                let prop = "sub_order_" + item.vid
                sub_orders[prop] = []
            })
            this.items_in_cart.forEach(item=>{
                let prop  = "sub_order_" + item.vid;
                sub_orders[prop].push(item);
            })
            return sub_orders;
        }
    },
    components:{
        'navbar-component': navbar_component,
        "all-products-offcanvas-component": all_products_offcanvas_component
    },
    async created(){
        if(localStorage.getItem("cb_cart")){
            this.cart = JSON.parse(localStorage.getItem("cb_cart"));
        }
        
        Vue.prototype.$current_user = {
            id: -1,
            name: 'guest',
            number: "",
            role: "guest",
            cart: [],
            wishlist: [],
            orders: []
        }
        
        if(localStorage.getItem("current_user")){
            Vue.prototype.$current_user = JSON.parse(localStorage.getItem("current_user"));
        }
        if(this.$current_user.id!=-1){
            await this.$http.post("api/get-wishlist",{id: this.$current_user.id}).then(res=>{
                console.log("wish  ",res.body);
                this.wishlist = JSON.parse(res.body.wishlist);
            })
        }
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
                desktop.actual_price = desktop.price - (desktop.price*desktop.discount)/100
            })
             this.desktops = res.body
        })
       await this.clothing_products.forEach(products=>{
             this.$http.post('api/get-products',{t_name: products}).then( res=>{
                console.log("products:-  ",res.body);
                
                res.body.forEach(product=>{
                    product.colors = JSON.parse(product.colors)
                    product.images = JSON.parse(product.images)
                    product.weight = Number(product.weight)
                    product.actual_price = product.price - (product.price*product.discount)/100
                })
                 this[products] = res.body
            })
        })
    //    await this.$http.post('api/get-products',{t_name: "joggers"}).then( res=>{
    //         console.log("joggers:-  ",res.body);
            
    //         res.body.forEach(jogger=>{
    //             jogger.colors = JSON.parse(jogger.colors)
    //             jogger.images = JSON.parse(jogger.images)
    //             jogger.weight = Number(jogger.weight)
    //             jogger.actual_price = jogger.price - (jogger.price*jogger.discount)/100
    //         })
    //          this.joggers = res.body
    //     })
    }

})