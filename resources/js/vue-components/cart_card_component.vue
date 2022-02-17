<template>
    <div class="col-lg-12 bg-dark crd-new-hrz">
        <div class="row">
            <div class="col-5 col-md-4 p-0 mx-0">
                <img v-bind:src="product.card_img" class="img-fill-new cart-height">
            </div>
                
        
            <div class="col-7 col-md-8  pt-3 pt-lg-4 mx-0">
                
                <h3 class="in-mob-text">{{product.title}}</h3>
                <h4 class="in-mob-text price">&#8377;{{product.price}}</h4>
                <h3 class="in-mob-text-sizes"> <span v-if="category=='clothing'">size: {{product.size}}</span> color : {{product.color}}</h3>
                <h3 class="in-mob-text-sizes">&#8377;{{(product.price*product.no_in_cart).toFixed(2)}} for {{product.no_in_cart}}</h3>

                <span class="in-mob-text card-footer-horizontal">
                                    
                                        

                                            <button data-toggle="modal"  v-on:click="detail_clicked(product.key)" class="btn orange btn-sm mr-1 in-mob-text-card">Details</button>
                                            <button class="btn btn-danger btn-sm m-0 in-mob-text-card mob-button" v-on:click="remove_from_cart(product.cart_id)"><i class="fas fa-trash-alt in-mob-text-card"></i></button>
                                            <button class="btn  btn-light btn-sm m-0 in-mob-text-card mob-button" v-on:click="remove_one(product.cart_id)" v-show="product.no_in_cart>1">-</button>
                                            <button class="btn btn-light btn-sm in-mob-text-card mob-button">{{product.no_in_cart}}</button>
                                            <span v-show="can_add_to_cart[(product.id)-1]">
                                                <button class="btn  btn-light btn-sm m-0 in-mob-text-card mob-button" v-on:click="add_to_cart(product.id)" >+</button>
                                            </span>
                                          
                                    
                                    
                                            
                                    

                                        
                                        
                </span>
                
                
                
            </div>
       </div>
    </div>
</template>

<script>
export default{
    data: function(){
        return {
            category: "",
            t_name: "",
            id: "",
        }
    },
     props: ['product','items_in_cart','can_add_to_cart','cart','all_products','current_user'],
     methods: {
          add_to_cart: function(bat_id){
        if(this.category=="clothing"){
          if(this.product.size!==undefined && this.product.color!==undefined){
           if(this.current_user.id!==-1){ 
              let i,no_of_items=0;
              for(i=0;i<this.cart.length;i++){
                      if(this.cart[i].id===bat_id)
                          no_of_items++;
              }
                console.log("bat id ",bat_id)
                  const bat= this.all_products.find(element=>element.id==bat_id);
                  
                  // let pro = this.shirts.find(element=>element.id===bat_id);
              
                  if(bat.stock>no_of_items){
                      let o={
                          id: this.product.id,
                          size: this.product.size,
                          color: this.product.color,
                          cart_id: this.product.id + '_' + this.product.size +'_' +this.product.color
                      }
                      this.cart.push(o);

                  }
                  localStorage.setItem('cb_cart',JSON.stringify(this.cart));
            }
            else{
              swal("login first before adding to cart"," ","warning");
            }
          }
          else
            swal("color or size not selectd !!!"," ","error");

         }
         else{
          if(this.product.color!== undefined){
            if(this.current_user.id!==-1){ 
              let i,no_of_items=0;
              for(i=0;i<this.cart.length;i++){
                      if(this.cart[i].id===bat_id)
                          no_of_items++;
              }
                console.log("bat id ",bat_id)
                  const bat= this.all_products.find(element=>element.id==bat_id);
                  
                  // let pro = this.shirts.find(element=>element.id===bat_id);
              
                  if(bat.stock>no_of_items){
                      let o={
                          id: this.product.id,
                          color: this.product.color,
                          cart_id: this.product.id + '_'  +this.product.color
                      }
                      this.cart.push(o);

                  }
                  localStorage.setItem('cb_cart',JSON.stringify(this.cart));
            } 
          }
         }
      },
        remove_from_cart(pro_id){
            let pro=this.items_in_cart.find(element=>element.cart_id==pro_id);
            // this.products_in_cart.splice(this.products_in_cart.indexOf(pro),1);
           
            let i;
            for(i=0;i<pro.no_in_cart;i++)
                this.cart.splice(this.cart.indexOf(this.cart.find(element=>element.cart_id==pro_id)),1);
               localStorage.setItem('cb_cart',JSON.stringify(this.cart));
        },
        remove_one(pro_id){
            
            // let pro= this.items_in_cart.find(element=>element.id===pro_id);
            // let i;
            // for(i=0;i<this.items_in_cart.length;i++){
            //  if(this.items_in_cart[i].id===pro_id)
            //      return
            // }
            this.cart.splice(this.cart.indexOf(this.cart.find(element=>element.cart_id==pro_id)),1);
             localStorage.setItem('cb_cart',JSON.stringify(this.cart));
        },
        details_clicked(key){
            location.assign("/#/product-details/"+key)
        }
     },
     created(){
        let key = this.product.key;
        let arr = key.split("-");
        this.category = arr[0]
        this.t_name = arr[1]
        this.id = arr[2] 
     }
}
</script>
