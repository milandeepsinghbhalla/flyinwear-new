<template>
    <div class="text-center">
        <button class="btn btn-dark btn-lg m-3" v-on:click="add_admin">Add admin</button>
        <button class="btn btn-dark btn-lg m-3" v-on:click="add_vendor">Add vendor</button>
        <button class="btn btn-dark btn-lg m-3" v-on:click="remove_admin">remove admin</button>
        <button class="btn btn-dark btn-lg m-3" v-on:click="remove_vendor">remove vendor</button>

    </div>
</template>

<script>
    export default{
        data: function(){
            return{
                email: ""
            }
        },
        methods: {
            add_admin(){

                this.$http.post("/api/add-admin",{email: this.email}).then(res=>{
                    console.log(res.body);
                })
            },
            add_vendor(){

                this.$http.post("/api/add-vendor",{email: this.email}).then(res=>{
                    console.log(res.body);
                })
            },
            remove_admin(){

                this.$http.post("/api/remove-admin",{email: this.email}).then(res=>{
                    console.log(res.body);
                })
            },
            remove_vendor(){

                this.$http.post("/api/remove-vendor",{email: this.email}).then(res=>{
                    console.log(res.body);
                })
            }

        }
    }
</script>
