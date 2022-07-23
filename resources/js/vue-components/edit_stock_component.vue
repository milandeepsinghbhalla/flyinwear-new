<template>
    <div class="col-8 mt-5">
        <div class="form-group">
            <label for="id">id:-</label>
            <input type="text" v-model="edit.id" class="form-control" id="id" placeholder="enter id">
        </div>
        <button class="btn btn-dark btn-lg" v-on:click="continue_clicked">continue</button>
        <div v-if="edit.show_stock==1" class="mt-4">
            <div class="form-group" v-for="(item, prop) in edit.current_stock" :key="prop">
                                <label class="text-peach" >{{prop}}:-</label>
                                <input type="number" class="form-control" v-model="edit.current_stock[prop]" aria-describedby="pstock">
            </div>
            <button class="btn btn-dark btn-lg" v-on:click="edit_clicked">edit</button>
        </div>

    </div>
</template>

<script>

    export default{
        data: function(){
            return {
                edit:{
                id: "",
                current_stock: {},
                show_stock: 0
                }
            }
        },
        methods: {
            async continue_clicked(){
                let obj = {id: this.edit.id, vid: this.$current_user.id}
                console.log("obj  ",obj);
                await this.$http.post("/api/get-stock",obj).then(res=>{
                    console.log(res.body);
                    if(res.body.status==1){
                        this.edit.current_stock = res.body.current_stock;
                        this.edit.show_stock = 1;
                    }
                    else{
                        swal(res.body.msg," ","error");
                    }
                })
            },
            edit_clicked(){
                let obj = {
                    id: this.edit.id,
                    stocks: this.edit.current_stock
                }
                console.log(obj);
                this.$http.post("/api/edit-stock",obj).then(res=>{
                    console.log(res.body);
                    swal(res.body.msg," ","success");
                    this.edit.show_stock = 0;
                })
            }
        }
    }

</script>
