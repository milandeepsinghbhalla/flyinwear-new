<template>
    <div class="container" style="margin-top:7.5em;">
        <h3 class="text-center">Your orders...!!</h3>
        
        <login-to-continue-component v-if="current_user.id==-1"></login-to-continue-component>
        <div class="row" v-if="current_user.id!=-1&&orders.length==0">
            <div class="col-12 text-center">
                <button class="btn btn-dark btn-lg">No Orders Yet</button>
            </div>
        </div>
       
        <div class="row justify-content-center">
            <show-orders-component v-for="order in orders" :order="order" :key="order.order_id" ></show-orders-component>
                 
        </div>
    </div>
</template>
<script>
import display_order_items_component from './display_order_items_component.vue';
import login_to_continue_component from './login_to_continue_component.vue';
import show_orders_component from './show_orders_component.vue';
 

 export default{
     
     data: function(){
         return {
             current_user: {},
             orders: [],
             dates: {
                 from: "",
                 to: ""
             }
         }
     },
     created(){
                 this.$scrollTo("#my_nav");

         this.current_user = this.$current_user;
         let user_data = {
             id: this.current_user.id
         }
         this.$http.post("/api/get-user-orders",user_data).then(res=>{
             this.orders = JSON.parse(res.body.orders);
             this.orders.reverse();
         })
     },
     components:{
         "login-to-continue-component": login_to_continue_component,
          "display-order-items-component": display_order_items_component,
          "show-orders-component": show_orders_component
     },
     methods: {
         compute_date_time(oid){
             let arr = [];
             arr = oid.split('_')
             let time = arr[2];
             console.log("time = ",time);
             time =  parseInt(time);
             let date = new Date(time)
             let str = date.toDateString();
             return str;
         },
         track_clicked(str){
             swal(str," ","info")
         },
         deliver_to_clicked(id){
             let str = '#' + id; 
             $(str).modal('show');
         }
     }
 }
</script>
