<template>
    <div class="row justify-content-center my-4">
        <div class="col-11 bg-dark media-margin col-lg-8">
            <form  class="text-peach py-4">
                <div>
                    <h5 class="text-center mb-3">Vendor registration...!!</h5>
                </div>

                <div class="form-group col-lg-9 mx-auto  justify-content-center">
                    <label for="name">Name</label>
                    <input type="text" v-model="vendor_registration_data.name" class="form-control" id="name" aria-describedby="name" >
                </div>
                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="number">Number</label>
                    <input type="text" v-model="vendor_registration_data.number" class="form-control" id="number" aria-describedby="number" >
                </div>
                <div class="form-group col-lg-9 mx-auto  justify-content-center">
                    <label for="alt_number">Alternate number</label>
                    <input type="text" v-model="vendor_registration_data.alternate_number" class="form-control" id="alt_number" aria-describedby="alt_number" >
                </div>
                <div class="form-group col-lg-9 mx-auto">
                    <label for="vendor_email">Vendor Email </label>
                    <input type="email" v-model="vendor_registration_data.vendor_email" class="form-control" id="vendor_email" aria-describedby="vendor_email">
                    <small id="emailHelp" class="form-text ">You will recieve all the notifications regarding your online shop like order placement or cancellation
                        or return etc. on this email </small>
                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="shop_name">Shop Name</label>
                    <input type="text" v-model="vendor_registration_data.shop_name" class="form-control" id="shop_name" aria-describedby="shop_name" >
                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">

                    <label>Shop Location</label>
                </div>
                <div class="form-group col-lg-9 mx-auto justify-content-center">

                    <label for="address_line_1">Address Line 1</label>

                    <textarea v-model="vendor_registration_data.address_line_1" class="form-control" id="address_line_1" aria-describedby="line 1" ></textarea>


                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">

                    <label for="address_line_2">Address Line 2</label>

                    <textarea v-model="vendor_registration_data.address_line_2" class="form-control" id="address_line_1" aria-describedby="line 2" ></textarea>


                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="city">City</label>
                    <input type="text" v-model="vendor_registration_data.city" class="form-control" id="city" aria-describedby="city" >
                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="state">State</label>
                    <input type="text" v-model="vendor_registration_data.state" class="form-control" id="state" aria-describedby="state" >
                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="landmark">Landmark</label>
                    <input type="text" v-model="vendor_registration_data.landmark" class="form-control" id="landmark" aria-describedby="landmark" >
                </div>

                <div class="form-group col-lg-9 mx-auto justify-content-center">
                    <label for="pincode">Pincode</label>
                    <input type="text" v-model="vendor_registration_data.pincode" class="form-control" id="pincode" aria-describedby="pincode" >
                </div>
                <div class="text-center">
                 <button class="btn btn-lg px-lg-5 mt-4 orange" v-on:click="register_vendor">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default{
    data: function(){
        return {
            user: {},
            vendor_registration_data: {
                name: "",
                number: "",
                alternate_number: "",
                vendor_email: "",
                shop_name: "",
                address_line_1: "",
                address_line_2: "",
                city: "",
                state: "",
                landmark: "",
                pincode: "",
            }
        }
    },
    created(){
        this.user = this.$current_user
        this.vendor_registration_data.name = this.user.name
        this.vendor_registration_data.number = this.user.number
    },
    methods: {
        register_vendor(e){
            e.preventDefault();
            let check = 1
            for(let prop in this.vendor_registration_data){
                    if(this.vendor_registration_data[prop].length==0){
                        check = 0;
                        swal(prop.replace('_'," ") + " is empty"," ","warning");
                        break;
                    }
            }
            if(check==1){
                let address= {
                    address_line_1: this.vendor_registration_data.address_line_1,
                    address_line_2: this.vendor_registration_data.address_line_2,
                    city: this.vendor_registration_data.city,
                    state: this.vendor_registration_data.state,
                    landmark: this.vendor_registration_data.landmark,
                    pincode: this.vendor_registration_data.pincode
                }
                let vendor_address_book = [address]
                let vendor_data = {
                vid: this.user.id,
                name: this.vendor_registration_data.name,
                vendor_email: this.vendor_registration_data.vendor_email,
                shop_name: this.vendor_registration_data.shop_name,
                vendor_phn_no: this.vendor_registration_data.number,
                vendor_alternate_phn_no: this.vendor_registration_data.alternate_number,
                vendor_address_book: JSON.stringify(vendor_address_book)
                }
                console.log("vendor data = ",vendor_data);
                this.$http.post("/api/register-vendor",vendor_data).then(res=>{
                    console.log("user = ",res.body.user);
                    console.log("vendor = ",res.body.vendor)
                    if(res.body.status == 1){
                        swal(res.body.msg," ","success")
                    }
                    else{
                        swal(res.body.msg," ","error");
                    }
                })
            }
        }
    }

}
</script>
