<template>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" v-on:click="closeNav()">&times;</a>
            <ul style="list-style:none;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Men wear</a>
                    <ul class="dropdown-menu box-dropdown float-none" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-submenu ">
				                <a class="dropdown-item dropdown-toggle side-nav-text" href="#">Upper-wear</a>
				                <ul class="dropdown-menu float-none">
				                  <li v-on:click="closeNav" ><router-link to="/clothing-products/shirts"  v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Shirts</router-link></li>
				                  <li class="dropdown-submenu">
				                  	 <a class="dropdown-item dropdown-toggle side-nav-text" href="#">T-Shirts</a>
				                  	 <ul class="dropdown-menu float-none">
				                  		<li v-on:click="closeNav"><router-link to="/clothing-products/round_necks" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text" >Round-neck</router-link></li>
				                  		<li v-on:click="closeNav"><router-link to="/clothing-products/polos" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Polos</router-link></li>
				                  	</ul>
				                  	
				                  </li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/sweat_shirts"  v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Sweat-shirts</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/kurtas" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Kurtas</router-link></li>
				                </ul>
				              </li>
                        <li class="dropdown-submenu ">
				                <a class="dropdown-item dropdown-toggle side-nav-text" href="#">Bottom-wear</a>
				                <ul class="dropdown-menu float-none">
				                  <li v-on:click="closeNav"><router-link to="/clothing-products/jeans"  v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Jeans</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/joggers" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Joggers</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/caperies" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">caperies</router-link></li>
                                    <li v-on:click="closeNav"><router-link to="/clothing-products/shorts" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">shorts</router-link></li>

                                </ul>
				              </li>
                        <li v-on:click="closeNav"><router-link to="/clothing-products/ethinics" v-on:click="closeNav" v-scroll-to="'#my_nav'" data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">ethnics</router-link></li>

                            
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Women wear</a>
                    <ul class="dropdown-menu box-dropdown float-none" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-submenu">
				                <a class="dropdown-item dropdown-toggle side-nav-text" href="#">Upper-wear</a>
				                <ul class="dropdown-menu float-none">
				                  <li v-on:click="closeNav"><router-link to="/clothing-products/w_tops" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">tops</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/w_sweat_shirts" v-on:click="closeNav" v-scroll-to="'#my_nav'" ddata-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Sweat-shirts</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/w_kurtas" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Kurtas</router-link></li>
				                </ul>
				              </li>
                        <li class="dropdown-submenu">
				                <a class="dropdown-item dropdown-toggle side-nav-text" href="#">Bottom-wear</a>
				                <ul class="dropdown-menu">
				                  <li v-on:click="closeNav"><router-link to="/clothing-products/w_jeans" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Jeans</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/w_joggers" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">Joggers</router-link></li>
								  <li v-on:click="closeNav"><router-link to="/clothing-products/w_caperies" v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">caperies</router-link></li>
                                    <li v-on:click="closeNav"><router-link to="/clothing-products/w_shorts"  v-on:click="closeNav" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent" class="dropdown-item side-nav-text">shorts</router-link></li>

                                </ul>
				              </li>
                        <li v-on:click="closeNav"><router-link to="/clothing-products/w_ethinics" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">ethnic</router-link></li>

                            
                    </ul>
                </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Computers &#38; accessories</a>
                      <ul class="dropdown-menu box-dropdown float-none" aria-labelledby="navbarDropdownMenuLink">
                                                  <li v-on:click="closeNav"><router-link to="/desktops" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Desktops</router-link></li>
                                                <!-- <li v-on:click="closeNav"><router-link to="/cpu" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Cpu's</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/keybords" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">keybords</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/ups" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">ups</router-link></li> -->


                      </ul>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laptops &#38; accessories</a>
                      <ul class="dropdown-menu box-dropdown float-none" aria-labelledby="navbarDropdownMenuLink">
                                                  <li v-on:click="closeNav"><router-link to="/other-products/laptops" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Laptops</router-link></li>
                                                <!-- <li v-on:click="closeNav"><router-link to="/mouse" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">mouse's</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/keybords" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">keybords</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/skins" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">skins</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/l-batteries" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">batteries</router-link></li> -->


                      </ul>
                 </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mobile &#38; accessories</a>
                      <ul class="dropdown-menu box-dropdown float-none" aria-labelledby="navbarDropdownMenuLink">
                                                  <li v-on:click="closeNav"><router-link to="/other-products/mobiles" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">Mobiles</router-link></li>
                                                <!-- <li v-on:click="closeNav"><router-link to="/m-screens" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">screens</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/m-covers" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">covers</router-link></li>
                                                <li v-on:click="closeNav"><router-link to="/m-batteries" v-scroll-to="'#my_nav'"  data-target="#navbarSupportedContent"  class="dropdown-item side-nav-text">batteries</router-link></li> -->


                      </ul>
                 </li>
            </ul>
        </div>
</template>
<script>
export default{
    methods:{
        closeNav(){
            document.getElementById("mySidenav").style.width = "0";
            
        }
    }
}
</script>
