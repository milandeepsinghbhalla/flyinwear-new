<template>
     <div class="row justify-content-center mb-5" style="width:100%; margin: 0 auto;">
      
      
        <div class="col-sm-6 p-3 bg-dark media-margin">
          <form>
            <div>
              <h3 class="text-center text-peach mb-3">Sign Up</h3>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-user"></i></div>
                </div>
                  <input type="text" class="form-control required" v-model.trim="sign_up_data.name" placeholder="Your Full Name">
                </div>

            </div>
            <div class="form-group">
              <div class="input-group">
                <!-- <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-plus"></i></div>
                </div>
                <input type="text" class="form-control col-3 required" v-model.trim="sign_up_data.code" placeholder="code" > -->
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-phone-alt"></i></div>
                </div>
                <input type="text" class="form-control col-12 required" v-model.trim="sign_up_data.number" placeholder="Mobile No.">
            </div>

            </div>
             <!-- <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-plus"></i></div>
                </div>
                <input type="text" class="form-control col-3 required" v-model.trim="sign_up_data.wcode" placeholder="code" >
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-phone-alt"></i></div>
                </div>
                <input type="text" class="form-control col-9 required" v-model.trim="sign_up_data.wnumber" placeholder="What's App No.">
            </div> -->

            <!-- </div> -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-envelope"></i></div>
                </div>
               <input type="email" class="form-control" v-model.trim="sign_up_data.email" aria-describedby="emailHelp" placeholder="Email" autocomplete>
              </div>
                 <small id="emailHelp" class="form-text  text-peach">We'll never share your data with anyone else.</small>

            </div>
            
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-lock"></i></div>
                </div>
                <input id="mainpass" type="password" class="form-control" v-model.trim="sign_up_data.password" placeholder="Password">
                <div class="input-group-append bg-img-yellow" v-on:click="show_pass">
                  <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-eye"></i></div>
                </div>
            </div>
            </div>
            

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-lock"></i></div>
                </div>
                <input id="conp" type="password" class="form-control" v-model.trim="sign_up_data.confirm_password" placeholder="Confirm Password">
                <div class="input-group-append bg-img-yellow" v-on:click="show_pass_con">
                  <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-eye"></i></div>
                </div>
            </div>
            </div>
            <div class="button-parent">
            <button type="button" class="btn btn-md orange button mt-2" v-on:click="sign_up">Create Account</button>
            </div>

    <div><p class="text-center text-peach pt-2">Already have an account ? <router-link class="text-info hover-white" to="/login">login</router-link></p></div>
          </form>
        </div>
      </div>
      
</template>

<script>

    export default{
        data: function(){
            return {
                sign_up_data: {
                    name: "",
                    email: "",
                    password: "",
                    number: "",
                    role: "user",
                    cart: "",
                    confirm_password: "",
                },
                mp_clicked:0,
                cp_clicked:0
            }
        },
        props:["cart"],
        methods: {
           show_pass_con(){
            let inp =  document.getElementById('conp');
            if(this.cp_clicked == 0){
              this.cp_clicked=1;
              inp.type = 'text';
            }
            else if(this.cp_clicked>0){
              this.cp_clicked=0;
              inp.type = 'password'
            }
          },
          show_pass(e){
            let inp =  document.getElementById('mainpass');
            if(this.mp_clicked == 0){
              this.mp_clicked=1;
              inp.type = 'text';
            }
            else if(this.mp_clicked>0){
              this.mp_clicked=0;
              inp.type = 'password'
            }
          },
            sign_up(){
              let chk = 0;
              let chk_email = 0;
              let chk_number =0;
              for(let prop in this.sign_up_data){
                if(prop !='cart'){
                  if(this.sign_up_data[prop].length>0){
                    chk = 1;
                    if(prop=='email'){
                       chk_email = 0;
                      const validateEmail = (email) => {
                          return String(email)
                              .toLowerCase()
                              .match(
                              /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                              );
                      };
                      if(validateEmail(this.sign_up_data.email)){
                        chk_email =1
                      }
                      else{
                        swal("email format wrong..!!"," ","warning");
                        break;
                      }
                    }
                    if(prop =='number'){
                      chk_number = 0;
                      if(this.sign_up_data.number.length==10){
                        chk_number = 1;
                      }
                      else{
                        swal("number must be of 10 digits"," ","warning");
                        break;
                      }
                    }
                  }
                  else{
                    chk =0;
                    swal(prop+' not filled..!!'," ","warning");
                    break;
                  }
                }
              }
              let chk_pass = 0
              if(chk==1){
                if(this.sign_up_data.password == this.sign_up_data.confirm_password){
                  chk_pass =1;
                }
                else{
                  swal("password and confirm password doesn't matched"," ","error");
                }
              }
              if(chk==1&&chk_email==1&&chk_number==1&&chk_pass==1){
                  console.log("sign up data --- ",this.sign_up_data);
                  this.sign_up_data.cart = JSON.stringify(this.cart);
                  this.$http.post("/api/add-user",this.sign_up_data).then(res=>{
                      console.log(res.body);
                      if(res.body.check_status==1){
                        this.$router.push("/login");
                      }
                      else if(res.body.check_status==0)
                        swal(res.body.result," ","error");
                      else 
                        swal("some error occurred...!!"," ","error");
                  })
              }
            }
        }
    }
</script>
