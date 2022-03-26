<template>
    <div class="col-lg-6">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img :src="card_img" class="d-block w-100 circle-img shadow-lg" alt="..." style="height: 450px; border: 1px solid grey;">
                        </div>
                        <div class="carousel-item "  v-for="img in images" v-bind:key="img + '' + Math.random()">
                        <img :src="img" class="d-block w-100 circle-img shadow-lg" style="height: 450px; border: 1px solid grey;" alt="...">
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
</template>

<script>

export default{
    props: ["card_img","images"]
}
</script>
