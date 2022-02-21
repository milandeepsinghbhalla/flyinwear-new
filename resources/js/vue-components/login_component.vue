<template>
    <div class="text-center">
         <div class="row justify-content-center mb-5 mx-auto" style = "width: 100%">
      <div class="col-lg-6 px-0 d-flex justify-content-center bg-dark media-margin text-center rounded">


        
          <form action="sign_up.php" method="post">
            <i class="fas fa-user display-1 text-peach pt-4 pb-2"></i>
            <div>
              <h3 class="text-center text-peach mb-3">Log in</h3>
            </div>
            
            <div class="form-group px-2">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-envelope"></i></div>
                </div>
               <input type="email" class="form-control" v-model="login_data.email" aria-describedby="emailHelp" placeholder="Email" autocomplete>
              </div>
                 <small id="emailHelp" class="form-text text-peach">We'll never share your email with anyone else.</small>

            </div>
            
            <div class="form-group px-2">
              <div class="input-group">
                <div class="input-group-prepend bg-img-yellow">
                    <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-lock"></i></div>
                </div>
                <input id="mp" type="password" class="form-control" v-model="login_data.password" placeholder="Password">
                <div class="input-group-append bg-img-yellow" v-on:click="show_pass('mp')">
                  <div class="input-group-text bg-img-yellow font-weight-bolder"><i class="fas fa-eye"></i></div>
                </div>
            </div>
            </div>
            

            <div class="button-parent">
            <button type="button" class="btn orange button mt-2 mb-3" v-on:click="login">Log in</button>
            </div>

            <div><p class="text-left text-peach px-2">Don't have an account ? <router-link class="text-info hover-white" to="/sign-up">Sign up</router-link></p></div>
            <!-- <div v-on:click="forgot_pw_clicked"><p class="text-left text-peach px-2">Did you forgot your password ? Forgot Password</p></div> -->
          </form>
        
      </div>
         </div>
    </div>
</template>


<script>

    export default{
        data: function(){
            return {
                login_data: {
                    email: "",
                    password: "",
                    cart: ""
                }
            }
        },
        props: ["cart","wishlist"],
        methods:{
            login(){
                this.login_data.cart = JSON.stringify(this.cart);
                this.$http.post("/api/login-user",this.login_data).then(res=>{
                    console.log(res.body);
                    if(res.body.status == 1){
                        this.$current_user = res.body.current_user;
                        this.cart = JSON.parse(this.$current_user.cart);
                        if(JSON.parse(this.$current_user.wishlist))
                        this.wishlist = JSON.parse(this.$current_user.wishlist);
                        localStorage.setItem("cb_cart",JSON.stringify(this.cart));
                        localStorage.setItem("current_user",JSON.stringify(this.$current_user));
                        
                        location.replace("/#/")
                        location.reload();
                    }
                    else{
                        swal(res.body.msg," ","error");
                    }
                })
            }
        }
    }

</script>
