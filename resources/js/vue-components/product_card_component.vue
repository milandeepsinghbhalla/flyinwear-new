<template>
    <div class="card col-lg-3 rounded  shadow-lg mb-4 lg-margin-card">
    <img v-on:click="open_pro_det(product)" :src="product.card_img" style="height:18em;" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title" v-on:click="open_pro_det(product)">{{product.title}}</h5>
      <p class="d-flex"><span class="flex-grow-1">&#8377;{{product.price}}</span>
          <i class="fas fa-heart my-1 mx-2 text-danger" v-if="in_wishlist" v-on:click="toggle_wishlist(product.id)"></i> 

          <i class="fas fa-heart my-1 mx-2 text-grey" v-else v-on:click="toggle_wishlist(product.id)"></i> 
          <span class="text-success" v-if="product.stock>0">in stock</span>
          <span class="ml-5" v-else>Out of stock</span>
          </p>
    </div>
  </div>
</template>

<script>
export default{
    props: ["product","wishlist"],
    methods: {
        open_pro_det(product){
            location.assign("/#/product-details/"+product.key);
        },
        toggle_wishlist(id){
            if(this.$current_user.id!=-1){
                if(this.wishlist.includes(id)){
                    let index = this.wishlist.indexOf(id);
                    this.wishlist.splice(index,1);
                }
                else{
                    this.wishlist.push(id);
                }
                let wishlist_data = {
                    id: this.$current_user.id,
                    wishlist: JSON.stringify(this.wishlist)
                }
                this.$http.post("/api/update-wishlist",wishlist_data).then(res=>{
                    console.log(res.body);
                })

            }
            else{
                swal("plz login first..!!"," ","warning");
            }
        }
    },
    computed:{
        in_wishlist(){
            if(this.wishlist.includes(this.product.id))
                return true;
            else
                return false;
        }
    }


}
</script>
