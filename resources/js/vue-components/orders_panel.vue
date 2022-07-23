<template>
    <div class="col-lg-8 col-11 mx-auto">
        <h3 class="text-center">Your orders...!!</h3>
         <div class="row justify-content-center text-center my-3">
          <span class="my-2 my-lg-0">  From : <input v-model="dates.from" type="date" width="276" /></span> <span class="ml-lg-3 my-2 my-lg-0">To : <input v-model="dates.to" type="date" width="276" /></span>
          <div class="col-12 my-2">
            <button class="btn btn-dark btn-md" v-on:click="filter_dates">Apply</button>
          </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 my-2 text-center" v-if="orders.length==0">
                <button class="btn btn-lg btn-dark">No orders</button>
            </div>
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
            orders: [],
            original_orders: [],
            dates: {
                from: "",
                to: ""
            }
        }
    },
    components:{
        "show-orders-component": show_orders_component
    },
    async created(){
         
        this.current_user = this.$current_user;
        let vendor_data = {
            id: this.current_user.id
        }
        await this.$http.post('/api/get-vendor-orders',vendor_data).then(res=>{
            this.orders = JSON.parse(res.body.orders);
            this.orders.reverse();
        })
        this.original_orders = this.orders;
    },
    methods:{
        filter_dates(){
            
            if(this.dates.from.length!=0&&this.dates.to.length!=0){
                
                let start = new Date(this.dates.from).getTime();
                let end  = new Date(this.dates.to).getTime();
                console.log("start = ",start);
                console.log("end = ",end);
                if(start<=end){
                    this.orders = this.original_orders;
                    let filtered_orders = [];
                    this.orders.forEach(order=>{
                        let arr = order.order_id.split('_');
                        let time = parseInt(arr[2]);
                        if(time>=start && time<=end)
                            filtered_orders.push(order);
                        
                    })
                    this.orders = filtered_orders;
                    swal("filter applied successfully...!!"," ","success");
                }
                else{
                    swal("from date must be before or same than to date"," ","error");
                }
            }
            else{
                swal("select both from and to dates first"," ","warning");
            }
        }
    }
    
}
</script>
