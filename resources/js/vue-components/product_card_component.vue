<template>
    <div class="card col-lg-3 rounded  shadow-lg mb-4 lg-margin-card">
    <img :src="product.card_img" style="height:18em;" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{product.title}}</h5>
      <p class="d-flex"><span class="flex-grow-1">&#8377;{{product.price}}</span> 
          <span class="text-success" v-if="product.stock>0">in stock</span>
          <span class="ml-5" v-else>Out of stock</span>
          </p>
    </div>
  </div>
</template>

<script>
export default{
    data: function(){
        return {
            product:{
                card_img: "storage/jogger.jpeg",
                title: "black jogger with great fabric..(long lasting)",
                price:"750",
                stock: 30
            }
        }
    }
}
</script>
