<template>
    <div class="container" style="margin-top:7.5em;">
        <div class="row">
            <div class="col-lg-6">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img :src="joggers[0].card_img" class="d-block w-100" alt="..." style="height: 450px; border: 1px solid grey;">
                        </div>
                        <div class="carousel-item" v-for="img in product.images" v-bind:key="img + '' + Math.random()">
                        <img :src="joggers[0].card_img" class="d-block w-100" alt="...">
                        </div>
                       
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="row " style="margin-right: 1rem;">
                    <div class="card col-12 p-0 text-dark bg-light lg-margin-card">
                        <div class="card-header display-5 text-light bg-dark">
                            {{product.title}}
                        </div>
                        <div class="card-body">
                            <p class="d-flex">
                            <span class="card-title display-4 flex-grow-1">&#8377;{{product.price}}</span>
                            <span class="align-self-center ml-3">
                            <span v-if="this.category=='clothing'">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Size : </label>
                                <select v-model="product.size"  class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        <option disabled value="">Size</option>
                                        <option v-for="size in sizes" :key="size" v-if="check(product,size)">{{size}}</option>
                                </select>
                            </span>

							  <label class="my-1 mr-2 ml-2" for="inlineFormCustomSelectPref">Select color : </label>
							  <select v-model="product.color"  class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
							    	<option disabled value="">color</option>
									<option v-for="color in product.colors" :key="color">{{color}}</option>
							  </select>
                            </span>
                            </p>
                              <button class="btn btn-md btn-dark" v-if="can_add_to_cart[product.id-1]" v-on:click="add_to_cart(product.id)">Add to cart</button>
                            <!-- <cart-controlls-component class="align-self-center"></cart-controlls-component> -->
                            
                            <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                    
                </div>
                    </div>
            </div>
        </div>
            

    </div>
    </div>

</template>

<script>
import cart_controlls_component from "./cart_controlls_component.vue"
export default{
    data: function(){
        return {
            category: "",
            t_name: "",
            id: "",
            product:{},
            sizes:["s","m","l","xl","2xl","3xl","4xl","5xl"]
        }
    },
    props:["joggers","current_user","all_products","cart","can_add_to_cart","desktops"],
    components:{
        "cart-controlls-component": cart_controlls_component
    },
    methods:{
        check(product,size){
      let str = 'stock_' + size.toLowerCase();
      if(product[str]>0)
        return true;
      else
        return false;
    },
         add_to_cart: function(bat_id){
        if(this.category=="clothing"){
          if(this.product.size!==undefined && this.product.color!==undefined){
           if(this.current_user.uid!==-1){ 
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
            if(this.current_user.uid!==-1){ 
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

                
                

        }
    },
    created(){
        let key = this.$route.params.key;
        let arr = key.split("-");
        this.category = arr[0]
        this.t_name = arr[1]
        this.id = arr[2]
        this.product = this[this.t_name].find(element=>element.id==this.id);
    }
}
</script>
