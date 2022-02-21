<template>
    <nav id="my_nav" class="navbar navbar-expand-lg navbar-dark bg-dark py-0 fixed-top"  >
        <all-products-offcanvas-component></all-products-offcanvas-component>
		 <a class="navbar-brand m-0" href="#"><img src="storage/logo.png" id="logo"></a>
		 <ul class="navbar-nav m-0 cart-ul-mobile">
				 <li class="nav-item">
		        <router-link class="nav-link" to="/wishlist"><i class="fas fa-heart"><sup class="sup-no">{{wishlist.length}}</sup></i></router-link>
				</li>	 
		
		</ul>

		 <ul class="navbar-nav m-0 cart-ul-mobile"> 
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
			      <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarSupportedContent">Hi {{this.$current_user.name.split(' ')[0]}}</a>
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
                <li class="nav-item dropdown" v-if="this.$current_user.id===-1">
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
				<li class="nav-item" v-if="(this.$current_user.role=='admin' || this.$current_user.role=='admin_vendor')">
			       <router-link class="nav-link" to="/admin">Admin</router-link>
			    </li>
				<li class="nav-item" v-if="(this.$current_user.role=='vendor' || this.$current_user.role=='admin_vendor')">
			       <router-link class="nav-link" to="/vendor">vendor</router-link>
			    </li>
             </ul>
         </div>
    </nav>
</template>
<script>
import all_products_offcanvas_component from "./all_products_offcanvas_component.vue";
    export default{
       
        props:['cart','current_user',"wishlist"],
        methods: {
             logout(){
                 this.$current_user = {
					 name: "guest",
					 id: -1,
					 role: "guest",
					 number: "",
					 cart: [],
					 orders: [],
					 wishlist: []
				 }
				 localStorage.removeItem("current_user");
				 localStorage.removeItem("cb_cart");
				 location.reload();
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
