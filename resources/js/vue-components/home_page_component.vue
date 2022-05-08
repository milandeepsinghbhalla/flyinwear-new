<template>
    <div class="container-fluid" style="margin-top: 4em;">
        <div class="row">
            <div class="col-12 p-4 bg-creame text-dark">
                <p class="text-justify" style="font-size:1.5em;">
                    <strong>Civicstore</strong> is a web app where you can buy as well as sell 
                    your products...!! 
                    i.e. You can be a vendor and sell your products or as a customer you 
                    can buy products sold by other vendors at best price...!!!
                </p>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-7 bg-dark text-white text-center p-4" style="font-size:1.2em;border-radius:75px;">
                Below are some niches we sell...!!!
            </div>
        </div>
        <div class="row orange mt-5 text-white" style="font-size:2em;">
            <div class="col-lg-4 mb-lg-4 text-center p-3">
                <i class="fas fa-desktop" style="font-size:2em;"></i><br>Desktops
            </div>
            <div class="col-lg-4 text-center p-3">
                <i class="fas fa-laptop" style="font-size:2em;"></i><br>Laptops
            </div>
            <div class="col-lg-4 text-center p-3">
                <i class="fas fa-mobile" style="font-size:2em;"></i><br>Mobiles
            </div>
            <div class="col-lg-6 text-center p-3">
               <i class="fas fa-male" style="font-size:2em;"></i><br>Men's Clothes
            </div>
             <div class="col-lg-6 text-center p-3">
               <i class="fas fa-female" style="font-size:2em;"></i><br>Women's Clothes
            </div>
        </div>

    </div>
</template>
<script>
export default{
    props: ["t_name"],
    created(){
        this.$scrollTo("#my_nav");
    }
}
</script>
