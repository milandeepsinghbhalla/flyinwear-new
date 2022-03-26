<template>
    <div class="container" style="margin-top:7.5em;">
        <div class="row">
            <icc :card_img="product.card_img" :images="product.images"></icc>
            <div class="col-lg-6 ">
                <div class="row " style="margin-right: 1rem;">
                    <div class="card col-12 p-0 text-dark bg-creame lg-margin-card">
                        <div class="card-header display-5 text-light bg-dark">
                            {{product.title}}
                        </div>
                        <div class="card-body">
                            <p class="d-flex">
                            <span class="card-title display-4 flex-grow-1">&#8377;{{product.price}}</span>
                            <span class="align-self-center ml-3">
                            <span v-if="this.category=='clothing'">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Size : </label>
                                <select v-model="product.size" @change="change"  class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        <option disabled value="">Size</option>
                                        <option v-for="size in sizes" :key="size" v-show="check(product,size)">{{size}}</option>
                                </select>
                            </span>

							  <label class="my-1 mr-2 ml-2" for="inlineFormCustomSelectPref">Select color : </label>
							  <select v-model="product.color" @change="change" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
							    	<option disabled value="">color</option>
									<option v-for="color in product.colors" :key="color">{{color}}</option>
							  </select>
                            </span>
                            </p>
                              <button class="btn btn-md btn-dark" v-if="init_add.chk" v-on:click="add_to_cart(product.id); change();">Add to cart</button>
                              <button class="btn btn-md btn-dark" v-else >{{init_add.msg}}</button>

                            <!-- <cart-controlls-component class="align-self-center"></cart-controlls-component> -->
                            
                            <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-11 bg-creame text-dark p-4 text-center circle-img shadow-lg m-4">
                <h3 class="text-center">Description...!!</h3>
                <pre>{{product.description}}</pre>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-11 bg-creame text-dark  p-0 card shadow-lg m-4">
                 <div class="card-header display-5 text-light text-center bg-dark"><h3>Features...!!</h3></div>
                  <div class="card-body p-4">
                <span v-for="(item, prop) in product.features" :key="prop" ><span style="width: 115px;display: inline-block;">{{prop}} :</span> {{item}}<br></span>
                  </div>
            </div>
        </div>
    </div>
            

    

</template>

<script>
import cart_controlls_component from "./cart_controlls_component.vue"
import icc from './icc.vue';
export default{
    data: function(){
        return {
            category: "",
            t_name: "",
            id: "",
            product:{},
            desktops:{},
            joggers:{},
            sizes:["s","m","l","xl","2xl","3xl","4xl","5xl"],
            init_add: {
                chk: true,
                msg: "Add to cart"
            },
        }
    },
    props:["current_user","all_products","cart","can_add_to_cart","items_in_cart"],
    components:{
        "cart-controlls-component": cart_controlls_component,
        "icc" : icc
    },
    // updated(){
        
    //     if(this.category=="clothing"){
    //             if(this.product.size!==undefined && this.product.color!==undefined){
    //                 let selected_size = "stock_" + this.product.size;
    //                 let cart_id = this.product.id + '_'+ this.product.size+ '_' + this.product.color
    //                 let item = this.items_in_cart.find(el=>el.cart_id == cart_id);
    //                 if(item){
    //                     if(this.product[selected_size]>item.no_in_cart){
    //                         let obj =  {
    //                             chk: true,
    //                             msg: "Add to cart"
    //                         }
    //                         this.init_add.chk = true;
    //                         this.init_add.msg = "Add to cart"
    //                         // return this.init_add;
                            
    //                     }
    //                     else{
    //                         let obj =  {
    //                             chk: false,
    //                             msg: "size out of stock"
    //                         }
    //                         this.init_add.chk = false;
    //                         this.init_add.msg = "size out of stock"
    //                         // return this.init_add;
    //                     }
    //                 }
    //                 else{
    //                     this.init_add.chk = true
    //                 }
    //             }
    //         }
    //         else{
    //             if(this.product.color!==undefined){
    //                 let cart_id = this.product.id + '_'+ this.product.color
    //                 let item = this.items_in_cart.find(el=>el.cart_id == cart_id);
    //                 if(item){
    //                     if(this.product.stock>item.no_in_cart){
    //                         let obj =  {
    //                             chk: true,
    //                             msg: "Add to cart"
    //                         }
    //                         this.init_add = obj;
    //                     }
                        
    //                     else{
    //                         let obj =  {
    //                             chk: false,
    //                             msg: "size out of stock"
    //                         }
    //                         this.init_add = obj;
    //                     }
                        
    //                 }
    //                 else{
    //                     this.init_add.chk =true;
    //                 }
    //             }
    //         }
        
        
    // },
    methods:{
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
        }
        
        ,
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
         }

                
                

        }
    },
    async created(){
        let key = this.$route.params.key;
        let arr = key.split("-");
        this.category = arr[0]
        this.t_name = arr[1]
        this.id = arr[2]
        console.log(this.desktops);
        await this.$http.post('/api/get-products',{t_name: this.t_name}).then(res=>{
            res.body.forEach(el=>{
                el.colors = JSON.parse(el.colors)
                el.images = JSON.parse(el.images)
                el.weight = Number(el.weight)
            })
            this[this.t_name] = res.body
        })
        this.product = this[this.t_name].find(element=>element.id==this.id);
        this.product.description = "Classic capery\nWith Casual Look\n#MADE IN INDIA\n#Handmade\nSlide to view size chart"
        this.product.features = JSON.parse(this.product.features)
    }
}
</script>
