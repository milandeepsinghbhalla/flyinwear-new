<template>
    <div class="container" style="margin-top:7.5em;">
        <div class="row justify-content-center my-5">
            <div class="card col-lg-8 col-11 p-0 shadow-lg">
                <div class="card-header text-light bg-dark">
                    Order summary
                </div>
                <div class="card-body bg-creame">
                    <div class="row p-3" v-for="(value,prop) in sub_orders" :key="prop">
                        <h5 class="card-title w-100">Sub order :-</h5>
                        
                            <div class="bg-dark text-light p-3 mb-3 mx-auto rounded col-lg-8 col-11">
                            <div v-for="(item,index) in value" :key="item.id">
                                <p class="card-text">item {{index +1}} {{item.title}}
                                <br>{{item.actual_price * item.no_in_cart}} for {{item.no_in_cart}}</p>
                                <hr class="hr-for-order" />
                            </div>
                    
                        <p class="card-text">sub order total: {{subtotal[prop]}}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark btn-md">Total = {{order_total}}</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center my-5">
            <div class="card col-lg-8 col-11 p-0 shadow-lg">
                <div class="card-header text-light bg-dark">
                     Selected Address
                </div>
                <div class="card-body bg-creame">
                    <div class="p-4 bg-dark text-light">
                        <h5 class="card-title text-center" style="color: #c77dff;">{{this.customer_delivery_data.selected_address.holder_name}}</h5>
                        <p class="card-text" v-for="(value,prop) in this.customer_delivery_data.selected_address" :key="prop">
                                <span v-if="prop != 'holder_name' && prop!= 'id'">
                                <span style="color: #c77dff;">{{prop.replace('_'," ")}}</span><br>
                                {{value}}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-12 mb-2 text-center"><h3>Select payment Method:-</h3></div>
                <div class="form-check form-check-inline mx-3">
                    <input class="form-check-input" v-model="payment_method" type="radio" name="payment_method" id="inlineRadio1" value="cod">
                    <label class="form-check-label" for="inlineRadio1">COD</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" v-model="payment_method" type="radio" name="payment_method" id="inlineRadio2" value="online">
                    <label class="form-check-label" for="inlineRadio2">Online</label>
                </div>
        </div>
        <div class="row justify-content-center mb-5">
            <button v-if="payment_method=='cod'" class="btn btn-md btn-dark" v-on:click="confirm_order">Confirm Order</button>
            <button v-if="payment_method=='online'" class="btn btn-md btn-dark" v-on:click="pay_online">Pay</button>
        </div>
        
    </div>
</template>
<script>
export default{
    data: function(){
        return {
            customer_delivery_data: {},
            payment_method: ""
        } 
    },
    props: ["sub_orders","cart"],
    created(){
                this.$scrollTo("#my_nav");

        this.customer_delivery_data = JSON.parse(localStorage.getItem('customer_delivery_data'));
        if(this.$route.query.cf_id){
            let order_id = this.$route.query.cf_id;
            let obj = {
                order_id: order_id
            }
            this.$http.post('/api/check-payment',obj).then(res=>{
                console.log("payment result = ",res.body);
                if(res.body.order_status == "PAID"){
                    this.payment_method = "online"
                     let user_orders = [];
                        let vendor_orders = {};
                        for(let prop in this.sub_orders){
                            let order = {};
                            order.order_contents = this.sub_orders[prop];
                            order.order_id = this.$current_user.id + "_" + this.sub_orders[prop][0].vid + "_" + new Date().getTime();
                            order.payment_method  = this.payment_method;
                            order.order_status = "order placed by "+ this.$current_user.name;
                            order.user_details = {};
                            order.user_details.address = this.customer_delivery_data.selected_address;
                            order.user_details.number = this.customer_delivery_data.number;
                            order.user_details.alternate_number = this.customer_delivery_data.alternate_number;
                            order.sub_order_total = this.subtotal[prop];
                            user_orders.push(order);
                            vendor_orders[this.sub_orders[prop][0].vid] = [order];
                        }
                        console.log("user_orders => ",user_orders);
                        console.log("vendor_orders => ",vendor_orders);
                        let user_order_data={
                            id: this.$current_user.id,
                            orders: JSON.stringify(user_orders)
                        }
                        let items = [];
                        user_orders.forEach(order=>{
                            order.order_contents.forEach(item=>{
                                let obj = {};
                                obj.id = item.id;
                                if(item.size)
                                obj.size = item.size;
                                obj.no_in_cart = item.no_in_cart;
                                items.push(obj);
                            })
                        })
                        console.log("items = ",items);
                        let edit_stock_data = {
                            items: JSON.stringify(items)
                        }
                        this.$http.post("/api/edit-order-stock",edit_stock_data).then(res=>{});
                        this.$http.post('/api/update-user-order',user_order_data).then(res=>{
                            console.log("user = ",res.body.result);
                        });
                        for(let prop in vendor_orders){
                            let vendor_order_data = {
                                id: prop,
                                orders: JSON.stringify(vendor_orders[prop])
                            }
                            this.$http.post('/api/update-vendor-order',vendor_order_data).then(res=>{

                            })
                            let mail_data = {
                                id:prop
                            }
                            this.$http.post('/api/send-order-mail',mail_data).then(res=>{

                            });
                        }
                        localStorage.removeItem('cb_cart');
                        this.cart.length = 0;
                        let cart_data = {
                            id: this.$current_user.id,
                            cart: JSON.stringify(this.cart)
                        }
                        this.$http.post('/api/update-cart',cart_data).then(res=>{})
                        
                        location.replace('/#/orders');
                        location.reload();
                }
                else{
                    
                    swal("Payment failed"," ","error");
                }
            })
        }
    },
    computed: {
        subtotal(){
            let subtotal = {};
            for(let prop in this.sub_orders){
                let total = 0
                this.sub_orders[prop].forEach(item => {
                    total += item.actual_price * item.no_in_cart;
                });
                subtotal[prop] = total;
            }
            return subtotal;
        },
        order_total(){
            let order_total = 0;
            for(let prop in this.subtotal){
                order_total += this.subtotal[prop];
            }
            return order_total;
        }
    },
    methods: {
        confirm_order(){
            let user_orders = [];
            let vendor_orders = {};
            for(let prop in this.sub_orders){
                let order = {};
                order.order_contents = this.sub_orders[prop];
                order.order_id = this.$current_user.id + "_" + this.sub_orders[prop][0].vid + "_" + new Date().getTime();
                order.payment_method  = this.payment_method;
                order.order_status = "order placed by "+ this.$current_user.name;
                order.user_details = {};
                order.user_details.address = this.customer_delivery_data.selected_address;
                order.user_details.number = this.customer_delivery_data.number;
                order.user_details.alternate_number = this.customer_delivery_data.alternate_number;
                order.sub_order_total = this.subtotal[prop];
                user_orders.push(order);
                vendor_orders[this.sub_orders[prop][0].vid] = [order];
            }
            console.log("user_orders => ",user_orders);
            console.log("vendor_orders => ",vendor_orders);
            let user_order_data={
                id: this.$current_user.id,
                orders: JSON.stringify(user_orders)
            }
            let items = [];
            user_orders.forEach(order=>{
                order.order_contents.forEach(item=>{
                    let obj = {};
                    obj.id = item.id;
                    if(item.size)
                    obj.size = item.size;
                    obj.no_in_cart = item.no_in_cart;
                    items.push(obj);
                })
            })
            console.log("items = ",items);
            let edit_stock_data = {
                items: JSON.stringify(items)
            }
            this.$http.post("/api/edit-order-stock",edit_stock_data).then(res=>{});
            this.$http.post('/api/update-user-order',user_order_data).then(res=>{
                console.log("user = ",res.body.result);
            });
            for(let prop in vendor_orders){
                let vendor_order_data = {
                    id: prop,
                    orders: JSON.stringify(vendor_orders[prop])
                }
                this.$http.post('/api/update-vendor-order',vendor_order_data).then(res=>{

                })
                let mail_data = {
                    id:prop
                }
                this.$http.post('/api/send-order-mail',mail_data).then(res=>{

                });
            }
            localStorage.removeItem('cb_cart');
            this.cart.length = 0;
            let cart_data = {
                id: this.$current_user.id,
                cart: JSON.stringify(this.cart)
            }
            this.$http.post('/api/update-cart',cart_data).then(res=>{})
            
            location.replace('/#/orders');
            location.reload();
        },
        pay_online(){
            let user_orders = [];
            let vendor_orders = {};
            for(let prop in this.sub_orders){
                let order = {};
                order.order_contents = this.sub_orders[prop];
                order.order_id = this.$current_user.id + "_" + this.sub_orders[prop][0].vid + "_" + new Date().getTime();
                order.payment_method  = this.payment_method;
                order.order_status = "order placed by "+ this.$current_user.name;
                order.user_details = {};
                order.user_details.address = this.customer_delivery_data.selected_address;
                order.user_details.number = this.customer_delivery_data.number;
                order.user_details.alternate_number = this.customer_delivery_data.alternate_number;
                order.sub_order_total = this.subtotal[prop];
                user_orders.push(order);
                vendor_orders[this.sub_orders[prop][0].vid] = [order];
            }
            console.log("user_orders => ",user_orders);
            console.log("vendor_orders => ",vendor_orders);
            let index = window.location.href.lastIndexOf('/') - 2;
            let link = window.location.href.substr(0,index);
            
            let id = "";
            user_orders.forEach(order=>{
                id = id + order.order_id + "-";
            })
            id = id.slice((id.length-1),1);
            link = link + "/#/checkout-step-2?cf_id={order_id}&cf_token={order_token}";
            let obj = {
                order_id: id,
                order_amount: this.order_total,
                order_currency: "INR",
                customer_details: {
                customer_id: this.$current_user.id + '',
                customer_email: this.$current_user.email,
                customer_phone: this.customer_delivery_data.number
                },
                order_meta:{
                return_url: link
                }
            }
            this.$http.post("/api/pay-online", obj).then(res =>{
                 console.log("pay online response = ",res.body);
                if(res.body.payment_link){
                   
                    location.assign(res.body.payment_link);
                }
                
                })
        }
    },
    
}
</script>
