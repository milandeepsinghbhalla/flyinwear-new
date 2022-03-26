<template>

    <div class="container-fluid back-form">
         <div class="row justify-content-center " style="padding-top: 100px; padding-bottom: 50px">
                <div class="col-lg-8 col-11 above  font-weight-bolder pt-3">
                    <div class="text-justify pl-lg-3">
                                        Choose payment method :-<br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input form-control-this" type="radio" v-model.trim="customer_details.pay_method" id="p_cod" value="1">
                                            <label class="form-check-label" for="p_cod">COD</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input form-control-this" type="radio" v-model.trim="customer_details.pay_method" id="p_online" value="0">
                                            <label class="form-check-label" for="p_online">Online (prepaid)</label>
                                        </div>
                                        <div class="text-danger font-weight-bolder">[Choosing COD will charge extra COD charges on delivery]</div>
                                        <br>
                                        
                                        <div class="form-group">
                                            <label for="delivery-details">Check delivery charges and details :-</label><br>
                                            <input type="text" class="form-control form-control-this col-lg-4 col-6 d-inline" v-model.trim="customer_details.pincode" id="delivery-details" placeholder="Enter pincode">
                                            <button class="btn btn-dark ml-2" v-on:click="check_delivery_details">Check</button>
                                        </div>
                    </div>
                </div>
         </div>
    </div>
</template>

<script>
    export default{
        data: function(){
            return {
                customer_details: {
                    pay_method: "",
                    pincode: ""
                },
                show_annimation: 0,
                tocken: ""
            }
        },
        props: ["weight"],
        methods: {
            async check_delivery_details(){
      if(this.customer_details.pincode == null || this.customer_details.pincode =="" || this.customer_details.pay_method == null || this.customer_details.pay_method ==""){
        swal("enter the pincode and payment method to check delivery details !!!"," ","error");
        
      }
      else{
        this.show_annimation = 1;
        this.$http.get("/api/get-ship-tocken").then(async (res) => {
          if(res.body.status==0){
            console.log(res.body);
            let obj = {
              email:"milansingh7696@gmail.com",
              password:"Milansingh@1"
            }
            let head = {
              'Content-Type': 'application/json'
            }
            // await this.$http.post("https://apiv2.shiprocket.in/v1/external/auth/login",obj,{headers:head}).then(async (res)=>{
            //   let obj2 = {
            //     tocken: res.body.token,
            //     created_time: res.body.created_at
            //   }
            //   this.$http.post("/api/add-ship-tocken", obj2).then(res =>{
            //     console.log(res.body);
            //     console.log("tocken added to database");
            //   })
            //   this.tocken = await res.body.token;
              
            // })
            await this.$http.get("/api/get-tocken-ship").then(async(ship_result)=>{
              let res = JSON.parse(ship_result.body.result);
              let obj2 = {
                    tocken: res.token,
                    created_time: res.created_at
                  }
                  this.$http.post("/api/add-ship-tocken", obj2).then(res =>{
                    console.log(res.body);
                    console.log("tocken added to database");
                  })
                  this.tocken = await res.token;
            })
          
            
          }
          else if(res.body.status==1){
              this.tocken= await res.body.tocken;
          }
          let del_chk_details = {
                pickup_postcode: 140603,
                delivery_postcode: parseInt(this.customer_details.pincode),
                cod: parseInt(this.customer_details.pay_method),
                weight: Number(this.weight)
              }
          
          let headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+ this.tocken
          };
          console.log(del_chk_details);
          console.log(headers);
          await this.$http.get("https://apiv2.shiprocket.in/v1/external/courier/serviceability/", {params: del_chk_details, headers:headers}).then(
            res=>{
              if(res.body.status !==404){
              console.log(res.body);
              console.log(res.body.data.available_courier_companies.length);
              this.is_del_available = res.body.data.available_courier_companies.length;
              if(this.is_del_available){
                this.delivery_date = res.body.data.available_courier_companies[0].etd;
                this.delivery_days = res.body.data.available_courier_companies[0].estimated_delivery_days;
                this.cod_charges  = res.body.data.available_courier_companies[0].cod_charges;
                this.total_delivery_charge = res.body.data.available_courier_companies[0].rate;
                this.courier_company_id = res.body.data.available_courier_companies[0].courier_company_id;
              }
            }
            else{
              this.is_del_available = 0;
            }
            }
          )
          this.show_annimation = 0;
          $('#del_det_modal').modal('show');
          jQuery(document).ready(function($) {

            if (window.history && window.history.pushState) {

              window.history.pushState('forward', null, './#/customer-details');

              $(window).on('popstate', function() {
                if($('#del_det_modal').data('bs.modal')?._isShown)
                $('#del_det_modal').modal('toggle')
              });

            }
          });
        
          
          
        });

      }
        }
        }
    }
</script>
