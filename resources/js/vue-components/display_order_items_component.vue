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
                                    
                                        

                                            <button data-toggle="modal"  v-on:click="details_clicked(product.key)" class="btn orange btn-sm mr-1 in-mob-text-card">Details</button>
                                            <!-- <button class="btn  btn-light btn-md">Track</button>
                                            <button class=" btn btn-danger btn-md">Cancel</button> -->
                                            <button class="btn btn-light btn-sm" v-if="$route.path=='/orders' && review_status==1">Reviewed</button>
                                            <button class="btn btn-danger btn-sm" v-if="status=='delivered'&& $route.path=='/orders' && review_status == 0" v-on:click="show_review_modal('reviewModal'+id)">Review</button>
                                                <div v-if="status=='delivered'&& $route.path=='/orders' && review_status == 0" class="modal fade" :id="'reviewModal'+id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Add Review..!!</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12 bg-dark" >
                                                                <form  class="text-peach py-4">
                                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">
                                                                        <label for="rating">Select Rating</label>
                                                                        <select class="form-control" id="rating" v-model="review_data.rating">
                                                                            <option value="1">1 <i class="fas fa-star"></i></option>
                                                                            <option value="2">2 <i class="fas fa-star"></i></option>
                                                                            <option value="3">3 <i class="fas fa-star"></i></option>
                                                                            <option value="4">4 <i class="fas fa-star"></i></option>
                                                                            <option value="5">5 <i class="fas fa-star"></i></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-lg-11 mx-auto justify-content-center">

                                                                        <label for="review_text">Enter Review</label>

                                                                        <textarea v-model="review_data.review_text" class="form-control" id="review_text" aria-describedby="review" placeholder="Type your review here...!!"></textarea>


                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn orange" v-on:click="post_review">Post Review</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                    
                                    
                                            
                                    

                                        
                                        
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
                review_data: {},
                review_status: 0
            }
        },
        props:["product","status"],
        created(){
            let arr= [];
            arr = this.product.key.split('-');
            this.category = arr[0];
            this.t_name = arr[1];
            this.id = arr[2];
            if(this.$current_user.id!=-1 && this.status=="delivered"){
                let obj = {
                    pid: this.id,
                    uid: this.$current_user.id
                }
                this.$http.post("/api/check-review",obj).then(res=>{
                    console.log("review status = ", res.body.status);
                    this.review_status = res.body.status;
                })
            }
        },
        methods: {
            details_clicked(key){
            location.assign("/#/product-details/"+key)
            },
            post_review(){
                if(this.review_data.rating.length>0&&this.review_data.review_text.length>0){
                    let review_data = {};
                    let date = new Date();
                    let posted_on = date.getTime();
                    review_data.email = this.$current_user.email;
                    review_data.posted_on = posted_on;
                    review_data.rating = this.review_data.rating;
                    review_data.review_text = this.review_data.review_text;
                    let obj = {
                        uid: this.$current_user.id,
                        pid: this.id,
                        review_data: JSON.stringify(review_data)

                    }
                    console.log(obj);
                    console.log("id = ",this.id)
                    let link = '#reviewModal'+this.id;
                    $(link).modal('hide');
                    this.$http.post('/api/post-review',obj).then(res=>{
                        if(res.body.status==1){
                            swal(res.body.msg," ","success");
                            this.review_status = res.body.status;
                        }
                        else
                            swal("some erro occured"," ","error");
                    })
                    
                }
            },
            show_review_modal(id){
                id = '#' + id;
                $(id).modal('show');
            }
        }
    }
</script>

