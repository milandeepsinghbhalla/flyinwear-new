<template>
    <div class="container" style="margin-top:7.5em;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-11 bg-dark media-margin">
                <form  class="text-peach py-4">
                    <div class="form-group col-lg-9 mx-auto justify-content-center">
                        <!-- <label for="pincode">Your Pincode</label>
                        <input type="text" v-model="customer_data.pincode" class="form-control" id="pincode" aria-describedby="pincode">
                        <button class="btn btn-sm orange my-3" v-on:click="check_delivery_details" >Check Delivery Details</button><br> -->
                         Select Your Address<br>
                        <button class="btn btn-md orange my-3" v-on:click="show_modal" data-toggle="modal">Address Book</button><br>
                        <label for="number">Your number</label>
                        <input type="text" v-model="customer_data.number" class="form-control mb-3" id="number" aria-describedby="number">
                        <label for="alternate_number">Alternate Number</label>
                        <input type="text" v-model="customer_data.alternate_number" class="form-control mb-3" id="alternate_number" aria-describedby="alternate_number">
                        <button class="btn btn-lg orange" v-on:click="continue_clicked">Continue</button>
                    </div>
                </form>
                <div class="modal fade" id="my-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
     .                   <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Select Address...!!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                             <div class="container-fluid">
					      	   		<div class="row">
					      	   			 <div class="col-12" v-if="customer_data.address_book.length>0">
                                                  <div id="address_book_carousel"  class="carousel slide" data-interval="false" data-ride="carousel">
												  <div class="carousel-inner">
												    
												    <div v-for="(address,index) in customer_data.address_book" :key="address.id" :class="(index == 0)?'carousel-item active':'carousel-item'">
												      <div class="row justify-content-center">
                                                        <div class="card col-11 p-0 my-4">
                                                            <div class="card-body bg-dark text-light">
                                                                <h5 class="card-title text-center" style="color: #c77dff;">{{address.holder_name}}</h5>
                                                                <p class="card-text" v-for="(value,prop) in address" :key="prop">
                                                                    <span v-if="prop != 'holder_name' && prop!= 'id'">
                                                                        <span style="color: #c77dff;">{{prop.replace('_'," ")}}</span><br>
                                                                        {{value}}
                                                                    </span>
                                                                </p>
                                                                <p class="text-center">
                                                                    <i class="fas fa-trash text-danger mx-2" v-on:click="delete_address(address)"></i>
                                                                    <span class="mx-2" v-if="selected_address.id!=address.id" v-on:click="toogle_selected_address(address)"><i class="far fa-check-circle"></i> Select</span>
                                                                    <span class="mx-2" style="color: #c77dff;" v-else v-on:click="toogle_selected_address(address)"><i class="fas fa-check-circle"></i> Selected</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                      </div>
												    </div>
												  </div>
												  <a class="carousel-control-prev" href="#address_book_carousel" role="button" data-slide="prev">
												    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
												    <span class="sr-only">Previous</span>
												  </a>
												  <a class="carousel-control-next" href="#address_book_carousel" role="button" data-slide="next">
												    <span class="carousel-control-next-icon" aria-hidden="true"></span>
												    <span class="sr-only">Next</span>
												  </a>
												</div>
                                         </div>
                                         <div class="col-12" v-if="customer_data.address_book.length==0 && show_alt_address_msg==1">
                                             <button class="btn btn-dark btn-lg">You don't have any address saved in your
                                                 address book , so add one  by clickng on add address button below...!!</button>
                                         </div>
                                         <div class="col-12 bg-dark" v-if="show_add_address_div==1">
                                             <form  class="text-peach py-4">
                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                        <label for="holder_name">Holder's Name</label>
                                                        <input type="text" v-model="new_address.holder_name" class="form-control" id="holder_name" aria-describedby="holder_name" placeholder="Eg. Jhon's home or My office...etc." >
                                                    </div>
                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">

                                                        <label for="address_line_1">Address Line 1</label>

                                                        <textarea v-model="new_address.address_line_1" class="form-control" id="address_line_1" aria-describedby="line 1" ></textarea>


                                                    </div>
                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">

                                                        <label for="address_line_2">Address Line 2</label>

                                                        <textarea v-model="new_address.address_line_2" class="form-control" id="address_line_2" aria-describedby="line 2" ></textarea>


                                                    </div>
                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                        <label for="city">City</label>
                                                        <input type="text" v-model="new_address.city" class="form-control" id="city" aria-describedby="city" >
                                                    </div>

                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                        <label for="state">State</label>
                                                        <input type="text" v-model="new_address.state" class="form-control" id="state" aria-describedby="state" >
                                                    </div>

                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                        <label for="landmark">Landmark</label>
                                                        <input type="text" v-model="new_address.landmark" class="form-control" id="landmark" aria-describedby="landmark" >
                                                    </div>

                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                        <label for="pincode">Pincode</label>
                                                        <input type="text" v-model="new_address.pincode" class="form-control" id="pincode" aria-describedby="pincode" >
                                                    </div> 
                                                    <div class="text-center">
                                                        <button class="btn btn-sm btn-light" id="add_address_btn" v-on:click="add_address">Add Address</button>    
                                                    </div>     
                                             </form>
                                         </div>
                                    </div>
                             </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" v-on:click="show_add_address">Add Address</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default{
    data : function(){
        return {
            customer_data: {
                pincode: "",
                address_book: [],
                number: "",
                alternate_number: ""
                
            },
            selected_address: {
                    id: 0
            },
            new_address: {
                id: "",
                holder_name: "",
                address_line_1: "",
                address_line_2: "",
                city: "",
                state: "",
                landmark: "",
                pincode: "",
            },
            show_add_address_div: 0,
            show_alt_address_msg: 1
        }
    },
    props:["sub_orders"],
    created(){
        let obj = {
            id: this.$current_user.id
        }
        this.$http.post('/api/get-address-book',obj).then(res=>{
            console.log(res.body);
            this.customer_data.address_book = JSON.parse(res.body.address_book);
        })
    },
    methods: {
        toogle_selected_address(address){
            if(this.selected_address.id != address.id)
                this.selected_address = address;
            else{
                this.selected_address = {
                    id: 0
                }
            }
        },
        show_modal(e){
            e.preventDefault();
            $('#my-modal').modal('show')
        },
        // check_delivery_details(e){
        //     e.preventDefault();
        //     if(this.customer_data.pincode.length!=0){
        //         let vids = [];
        //         for(let prop in this.sub_orders){
        //             vids.push(this.sub_orders[prop][0].vid);
        //         }
        //         console.log(vids);
        //         let obj = {
        //             pincode: this.customer_data.pincode,
        //             vids: JSON.stringify(vids)
        //         }
        //        // console.log(obj);
        //         this.$http.post("/api/get-distances",obj).then(res=>{
        //             console.log(JSON.parse(res.body.result));
        //         })
        //     }
        // },
        show_add_address(){
            this.show_alt_address_msg = 0;
            this.show_add_address_div = 1;
            function callback(scrollto){scrollto('.modal-footer')}
            setTimeout(callback(this.$scrollTo),10000)
            
        },
        add_address(e){
            e.preventDefault();
            let chk = 0
            for(let prop in this.new_address){
                if(prop !='id'){
                    if(this.new_address[prop].length==0){
                        chk = 1
                        swal(prop.replace('_',' ')+' is empty'," ","warning");
                        break;
                    }
                }
            }
            if(chk==0){
                if(this.customer_data.address_book.length!=0){
                    let last_address = this.customer_data.address_book[this.customer_data.address_book.length-1];
                    let last_id = last_address.id;
                    this.new_address.id = last_id + 1;
                }
                else{
                    this.new_address.id = 1;
                }
                console.log("new address => ",this.new_address);
                
                let new_address_local = {};
                for(let prop in this.new_address){
                    new_address_local[prop] = this.new_address[prop]
                }
                this.customer_data.address_book.push(new_address_local);
                let obj = {
                    id: this.$current_user.id,
                    address_book: JSON.stringify(this.customer_data.address_book)
                }
                this.$http.post('/api/update-address-book',obj).then(res=>{
                    this.show_add_address_div = 0;
                    this.show_alt_address_msg = 1;
                    swal("address added successfully"," ","success");
                })
                
            }
        },
        delete_address(address){
            $('.carousel').carousel('next')
            let index = this.customer_data.address_book.indexOf(address)
            this.customer_data.address_book.splice(index,1);
            let obj = {
                    id: this.$current_user.id,
                    address_book: JSON.stringify(this.customer_data.address_book)
                }
                this.$http.post('/api/update-address-book',obj).then(res=>{})

        },
        continue_clicked(e){
            e.preventDefault();
            let chk = 0;
            if(this.selected_address.id==0){
                chk = 1;
                swal("No address selected...!!"," ","warning");

            }
            if(this.customer_data.number.length==0){
                 chk = 1;
                 swal("Number not filled...!!"," ","warning");
            }
            if(this.customer_data.alternate_number.length==0){
                 chk = 1;
                 swal("Alternate Number not filled...!!"," ","warning");
            }
            if(chk ==0){
                let customer_order_data = {
                    
                    selected_address: this.selected_address,
                    number: this.customer_data.number,
                    alternate_number: this.customer_data.alternate_number
                }
                console.log(customer_order_data);
                localStorage.setItem('customer_delivery_data',JSON.stringify(customer_order_data));
                this.$router.push('/checkout-step-2');
            }

        }
    }
}
</script>
