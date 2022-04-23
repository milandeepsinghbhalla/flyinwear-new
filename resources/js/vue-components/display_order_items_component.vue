<template>
    <div class="col-lg-12 bg-dark crd-new-hrz mt-4">
        <div class="row">
            <div class="col-5 col-md-4 p-0 mx-0">
                <img v-bind:src="product.card_img" class="img-fill-new cart-height">
            </div>
                
        
            <div class="col-7 col-md-8  pt-3 pt-lg-4 mx-0">
                
                <h3 class="in-mob-text">{{product.title.substring(0,50)+'...'}}</h3>
                <h4 class="in-mob-text price">&#8377;{{product.actual_price}}</h4>
                <h3 class="in-mob-text-sizes"> <span v-if="category=='clothing'">size: {{product.size}}</span><br> color : {{product.color}}</h3>
                <h3 class="in-mob-text-sizes">&#8377;{{(product.actual_price*product.no_in_cart).toFixed(2)}} for {{product.no_in_cart}}</h3>
                
                <span class="in-mob-text card-footer-horizontal">
                                    
                                        

                                            <button data-toggle="modal"  v-on:click="detail_clicked(product.key)" class="btn orange btn-sm mr-1 in-mob-text-card">Details</button>
                                            <!-- <button class="btn  btn-light btn-md">Track</button>
                                            <button class=" btn btn-danger btn-md">Cancel</button> -->
                                          
                                    
                                    
                                            
                                    

                                        
                                        
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
                id: ""
            }
        },
        props:["product"],
        created(){
            let arr= [];
            arr = this.product.key.split('-');
            this.category = arr[0];
            this.t_name = arr[1];
            this.id = arr[2];
        },
        methods: {
            details_clicked(key){
            location.assign("/#/product-details/"+key)
        }
        }
    }
</script>

