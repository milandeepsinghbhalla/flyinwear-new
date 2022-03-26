<template>
    <!-- <div class="card col-lg-3 rounded  shadow-lg mb-4 lg-margin-card">
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
  </div> -->

  <div class="card equal-card col-lg-4 col-10 col-sm-8 m-4 col-md-5 p-0 shadow-lg rounded">
      <div class="equal-img d-flex" v-on:click="open_pro_det(product)">
      <img :src="product.card_img" class="card-img-top" alt="...">
      </div>
      <div class="card-body bg-light text-center">
        <p class="card-text" v-on:click="open_pro_det(product)">{{product.title.substring(0,60)+'...'}}</p>
        <div class="d-flex justify-content-center">
        <button data-toggle="modal" v-on:click="quick_view(product)" class="btn btn-dark btn-sm mb-2"><i class="fas fa-eye"></i> Quick View</button>
        <i class="fas fa-heart align-self-start wishicon  text-danger" v-if="in_wishlist" v-on:click="toggle_wishlist(product.id)"></i> 
        <i class="fas fa-heart align-self-start wishicon text-grey" v-else v-on:click="toggle_wishlist(product.id)"></i> 
        </div>
        <div class="text-left d-flex"><span class="font-lg">&#8377;{{product.actual_price}}</span><span class="font-small ml-1 align-self-center" v-if="product.discount!=0 && product.discount!=null"> &#8377;{{product.price}}</span><span class="" style="color:#d00000;" v-if="product.discount!=0 && product.discount!=null"> <span style="font-size:1.4em; font-weight:bold;">&#8595;</span>{{product.discount}}%</span><span class="ml-auto align-self-end"><i class="fas fa-star"></i>4.5</span></div>
      </div>

      <div class="modal fade" v-bind:id="product.id" tabindex="-1" v-bind:aria-labelledby="product.label_id" aria-hidden="true">
  	   		 <div class="modal-dialog  modal-dialog-centered ">
  	   		 	<div class="modal-content">
  	   		 		<div class="modal-header">
					      	   <h5 class="modal-title" v-bind:id="product.label_id">{{product.title.substring(0,15)+'...'}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					</div>
					<div class="modal-body">
					      	   <div class="container-fluid">
					      	   		<div class="row">
					      	   			 <div class="col-12">
									      		<div :id="product.control" class="carousel slide" data-ride="carousel">
												  <div class="carousel-inner">
												    <div class="carousel-item active">
												      <img v-bind:src="product.card_img" class="modal-img d-block w-100" >
												    </div>
												    <div v-for="image in product.images" :key="image" class="carousel-item">
												      <img v-bind:src="image" class="modal-img d-block w-100" >
												    </div>
												  </div>
												  <a class="carousel-control-prev" :href="product.control_link" role="button" data-slide="prev">
												    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
												    <span class="sr-only">Previous</span>
												  </a>
												  <a class="carousel-control-next" :href="product.control_link" role="button" data-slide="next">
												    <span class="carousel-control-next-icon" aria-hidden="true"></span>
												    <span class="sr-only">Next</span>
												  </a>
												</div>
									      </div>
					      	   		</div>
					      	   </div>
					</div>
					 <div class="modal-footer text-left">
					 	<div style="width: 100%;">
					 		<span class="font-weight-bolder">price : <span class="font-lg">&#8377;{{product.actual_price}}</span><span class="font-small ml-1 align-self-center" v-if="product.discount!=0 && product.discount!=null"> &#8377;{{product.price}}</span><span class="" style="color:#d00000;" v-if="product.discount!=0 && product.discount!=null"> <span style="font-size:1.4em; font-weight:bold;">&#8595;</span>{{product.discount}}%</span></span> <span class="font-weight-bolder ml-2" v-if="product.fabric"> fabric : {{product.fabric}}</span>
					 	</div>
					 </div>
           <div class="modal-footer text-left">
            <div style="width: 100%;">
                <span class="font-weight-bolder">Description</span>
                <pre>{{product.description}}</pre>
            </div>
           </div>
					 <div class="modal-footer">
					 	<div class="form-inline" style="width: 100%;">
                             
					 		<label class="my-1 mr-2" v-if="this.category=='clothing'" for="inlineFormCustomSelectPref">Size : </label>
							  <select v-model="product.size" @change="change" v-if="this.category=='clothing'" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
							    	<option disabled value="">Size</option>
									<option v-for="size in sizes" :key="size" v-show="check(product,size)">{{size}}</option>
							  </select>
                            

							  <label class="my-1 mr-2 ml-2" for="inlineFormCustomSelectPref">color : </label>
							  <select v-model="product.color" @change="change" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
							    	<option disabled value="">color</option>
									<option v-for="color in product.colors" :key="color">{{color}}</option>
							  </select>

							
										<button class="btn mt-2 mt-md-0 btn-dark ml-2 btn-sm in-mob-text-card" v-if="init_add.chk" v-on:click="add_to_cart(product.id);" >Add to cart</button>
										
								
									
								<button v-else class="btn btn-danger mt-2 mt-md-0 ml-2 btn-sm disabled in-mob-text-card" >{{init_add.msg}}</button>
									
					 		
					 	</div>
					 </div>
  	   		 	</div>
  	   		 </div>
  	   </div>
    </div>
</template>

<script> 
export default{
    props: ["product","wishlist","all_products","cart","items_in_cart"],

    data: function(){
        return {
            init_add: {
                chk: true,
                msg: "Add to cart"
            },
            category: "",
            sizes:["s","m","l","xl","2xl","3xl","4xl","5xl"],
        }
    },
    methods: {
        quick_view(product){
            console.log("in quick view...!!");
            console.log(product.modal_id);
			$(product.modal_id).modal('show')
            },
        add_to_cart: function(bat_id){
        if(this.category=="clothing"){
          if(this.product.size!==undefined && this.product.color!==undefined){
            
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
                      let selected_size = "stock_" + this.product.size;


                  }
                  let update_cart={
                      cart: JSON.stringify(this.cart),
                      id: this.$current_user.id
                  }
                  if(this.$current_user.id!=-1){
                      this.$http.post("/api/update-cart",update_cart).then(res=>{
                          console.log(res.body);
                      })
                  }
                  localStorage.setItem('cb_cart',JSON.stringify(this.cart));
            
          }
          else
            swal("color or size not selectd !!!"," ","error");

         }
         else{
          if(this.product.color!== undefined){
           
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
                  let update_cart={
                      cart: JSON.stringify(this.cart),
                      id: this.$current_user.id
                  }
                  if(this.$current_user.id!=-1){
                      this.$http.post("/api/update-cart",update_cart).then(res=>{
                          console.log(res.body);
                      })
                  }
                  localStorage.setItem('cb_cart',JSON.stringify(this.cart));
             
          }
         }
         },
        check(product,size){
      let str = 'stock_' + size.toLowerCase();
      if(product[str]>0)
        return true;
      else
        return false;
    },
        change(){
            if(this.category=="clothing"){
                if(this.product.size!==undefined && this.product.color!==undefined){
                    let selected_size = "stock_" + this.product.size;
                    let cart_id = this.product.id + '_'+ this.product.size+ '_' + this.product.color
                    let item = this.items_in_cart.find(el=>el.cart_id == cart_id);
                    if(item){
                        if(this.product[selected_size]>(item.no_in_cart-1)){
                            let obj =  {
                                chk: true,
                                msg: "Add to cart"
                            }
                            this.init_add = obj;
                            
                            
                        }
                        else{
                            let obj =  {
                                chk: false,
                                msg: "size out of stock"
                            }
                            this.init_add = obj;
                        }
                    }
                    else{
                        this.init_add.chk = true
                    }
                }
            }
            else{
                if(this.product.color!==undefined){
                    let cart_id = this.product.id + '_'+ this.product.color
                    let item = this.items_in_cart.find(el=>el.cart_id == cart_id);
                    if(item){
                        if(this.product.stock>(item.no_in_cart-1)){
                            let obj =  {
                                chk: true,
                                msg: "Add to cart"
                            }
                            this.init_add = obj;
                        }
                        
                        else{
                            let obj =  {
                                chk: false,
                                msg: "out of stock"
                            }
                            this.init_add = obj;
                        }
                        
                    }
                    else{
                        this.init_add.chk =true;
                    }
                }
            }
        },
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
    created(){
        this.product.control = "carouselExampleControls" + this.product.id;
        this.product.control_link = "#carouselExampleControls" + this.product.id;
        this.product.label_id = "exampleModalLabel" + this.product.id;
        this.product.modal_id = "#"+ this.product.id;
        // this.product.actual_price = this.product.price - (this.product.price * this.product.discount)/100
        // this.product.description = "Classic capery\nWith Casual Look\n#MADE IN INDIA\n#Handmade\nSlide to view size chart"
         let arr = this.product.key.split("-");
         this.category = arr[0];
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
