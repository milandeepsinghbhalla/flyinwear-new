<template>
    <div  class="card col-lg-12 col-11 p-0 mb-4">
        <div class="card-header bg-dark text-light">
                     order id: {{order.order_id}}
                 </div>
                 <div class="card-body bg-creame">
                     <display-order-items-component v-for="item in order.order_contents" :key="item.id" :product="item" :status="current_status"></display-order-items-component>
                     <h5 class="mt-2">Payment Method: {{order.payment_method}}</h5>
                     <h5 class="mt-2">Total: {{order.sub_order_total}}</h5>
                     <h5 class="mt-2">Ordered on: {{compute_date_time(order.order_id)}}</h5>
                     <!-- <button class="btn btn-danger btn-sm" v-if="current_status!='delivered'">Cancel</button> -->
                     <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"  v-if="$route.path=='/vendor-orders' && current_status!='delivered'">Change Status</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" v-if="current_status!='delivered'">
                            <button class="dropdown-item" type="button"  v-on:click="change_status(next_status)">{{next_status}}</button>
                        </div>
                                            
                                         <button class="btn btn-dark btn-sm" v-if="current_status=='delivered'">Order Delivered</button>

                     <button class="btn btn-dark btn-sm" v-on:click="track_clicked(order.order_status)" v-if="$route.path=='/orders'">Status</button>
                     <button class="btn orange btn-sm" v-on:click="deliver_to_clicked(order.order_id)">Deliver To</button>
                     <div class="modal fade" :id="order.order_id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Delivery Address</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row justify-content-center">
                                    <div class="card col-11 p-0 my-4">
                                                                <div class="card-body bg-dark text-light">
                                                                    <h5 class="card-title text-center" style="color: #c77dff;">{{order.user_details.address.holder_name}}</h5>
                                                                    <p class="card-text" v-for="(value,prop) in order.user_details.address" :key="prop">
                                                                        <span v-if="prop != 'holder_name' && prop!= 'id'">
                                                                            <span style="color: #c77dff;">{{prop.replace('_'," ")}}</span><br>
                                                                            {{value}}
                                                                        </span>
                                                                    </p>
                                                                    <p class="card-text">
                                                                        <span style="color: #c77dff;">Number: </span>{{order.user_details.number}}
                                                                    </p>
                                                                    <p class="card-text">
                                                                        <span style="color: #c77dff;">Alternate Number: </span>{{order.user_details.alternate_number}}
                                                                    </p>
                                                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
</template>
<script> 
import display_order_items_component from "./display_order_items_component.vue";
    export default{
        data: function(){
            return {
                current_user: {},
                statuses: ["accepted","picked from vendor (out for delivery)","delivered"],
                next_status: "",
                current_status: "",
                review_data: {}
            }
        },
        props: ["order"],
        components: {
            "display-order-items-component": display_order_items_component
        },
        created(){
            this.current_user = this.$current_user;
            this.current_status =this.order.order_status
            if(this.statuses.includes(this.current_status)){
                let next = this.statuses.indexOf(this.current_status) + 1;
                this.next_status = this.statuses[next];
            }
            else{
                this.next_status = "accepted";
            }
        },
        methods: {
         change_status(status){
             if(status!='delivered'){
                let next = this.statuses.indexOf(status) + 1;
                this.current_status = status;
                this.order.order_status = this.current_status;
                this.next_status = this.statuses[next];
             }
             else{
                 this.current_status = status;
                 this.order.order_status = this.current_status;

             }
             let obj = {
                 id: this.$current_user.id,
                 order_id: this.order.order_id,
                 order_status: this.order.order_status
             }
             this.$http.post("/api/update-vendor-order-status",obj).then(res=>{
                 if(res.body.status==1){
                     swal(res.body.msg," ","success");
                 }
                 else{
                     swal("some error occurred"," ","error");
                 }
             })
         },   
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