<template>
    <div class="text-center">
        <button class="btn btn-large btn-dark" v-on:click="sign_up">Sign up</button>
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
                    role: "user"
                }
            }
        },
        methods: {
            sign_up(){
                console.log("sign up data --- ",this.sign_up_data);
                this.$http.post("/api/add-user",this.sign_up_data).then(res=>{
                    console.log(res.body);
                })
            }
        }
    }
</script>
