<template>
    <nav id="my_nav" class="navbar navbar-expand-lg navbar-dark bg-dark py-0 fixed-top" >
        <all-products-offcanvas-component></all-products-offcanvas-component>
		 <a class="navbar-brand" href="#"><img src="storage/logo.png" id="logo"></a>
		 <ul class="navbar-nav ml-auto cart-ul-mobile">
		  	<li class="nav-item">
		        <router-link class="nav-link" to="/cart"><i class="fas fa-shopping-cart"><sup class="sup-no">{{cart.length}}</sup></i></router-link>
		    </li>
		 </ul>

		 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	 	 </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto">
                <li class="nav-item">
			      <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarSupportedContent">Hi {{current_user.name.split(' ')[0]}}</a>
		   	 	</li>
                <li class="nav-item">
			      <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarSupportedContent" v-on:click="openNav">All</a>
		   	 	</li>
                <li class="nav-item">
			      <router-link class="nav-link" to="/" data-toggle="collapse" data-target="#navbarSupportedContent">Home</router-link>
		   	 	</li>
                <li class="nav-item cart-ul-laptop">
			       <router-link class="nav-link" to="/cart"><i class="fas fa-shopping-cart"><sup class="sup-no">{{cart.length}}</sup></i></router-link>
			    </li>
                <li class="nav-item dropdown" v-if="current_user.uid===-1">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          login / sign up
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <router-link to="/login" class="dropdown-item" href="#" data-toggle="collapse" data-target="#navbarSupportedContent" >login</router-link>
			          <router-link to="/sign-up" class="dropdown-item" href="#" data-toggle="collapse" data-target="#navbarSupportedContent" >sign up</router-link>
			      </div>
			      
			    </li>
			    <li v-else class="nav-item">
			    	<a href="#" v-on:click="logout()" class="nav-link" data-toggle="collapse" data-target="#navbarSupportedContent">Logout</a>
			    </li>
             </ul>
         </div>
    </nav>
</template>
<script>
import all_products_offcanvas_component from "./all_products_offcanvas_component.vue";
    export default{
       
        props:['cart','current_user'],
        methods: {
             logout(){
                 console.log('logout clicked')
             },
             openNav(){
                  document.getElementById("mySidenav").style.width = "305px";
             }
        },
        components:{
            "all-products-offcanvas-component": all_products_offcanvas_component
        }
    
    
    }
</script>
