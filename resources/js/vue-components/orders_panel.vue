<template>
    <div class="col-lg-8 col-11 mx-auto">
        <h3 class="text-center">Your orders...!!</h3>
        <div class="row justify-content-center">
            <show-orders-component v-for="order in orders" :order="order" :key="order.order_id" ></show-orders-component>
                 
        </div>
    </div>
</template>
<script>
import show_orders_component from "./show_orders_component.vue";
export default{

    data:function(){
        return {
            current_user: {},
            orders: []
        }
    },
    components:{
        "show-orders-component": show_orders_component
    },
    created(){
        this.current_user = this.$current_user;
        let vendor_data = {
            id: this.current_user.id
        }
        this.$http.post('/api/get-vendor-orders',vendor_data).then(res=>{
            this.orders = JSON.parse(res.body.orders);
        })
    }
    
}
</script>
