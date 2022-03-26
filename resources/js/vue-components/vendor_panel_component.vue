<template>
    <div class="bg-my-dark col-2">
    <div class="d-none d-lg-block" style="min-height:100vh">
       <ul style="list-style:none;" class="mt-3 sticky-top">
           <li class="text-light mb-2 sidebar-font" v-on:click="show_product_pannel">Products</li>
           <li class="text-light mb-2 sidebar-font">Users</li>
            <li class="text-light mb-2 sidebar-font">Orders</li>
       </ul>
    </div>
            <i class="fas fa-cogs text-dark ml-4 mt-2 d-block d-lg-none" v-on:click="openside()"></i>
            <div id="sidebar-vendor" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" style="position:static;margin-top:5px;margin-left:80%" v-on:click="closeside()">&times;</a>
                <ul style="list-style:none;" class="sticky-top">
                    <li class="text-light mb-2 sidebar-font" v-on:click="closeside();show_product_pannel();">Products</li>
                    <li class="text-light mb-2 sidebar-font">Users</li>
                        <li class="text-light mb-2 sidebar-font">Orders</li>
                </ul>
            </div>
    </div>
</template>

<script>
    export default{
        props: ["controls"],
        methods: {
            show_product_pannel(){
                this.controls.show_product_pannel = 1;
                this.controls.show_others = 1;
                this.controls.add_product = 0;
                this.controls.show_aopc = 0;
                this.controls.show_acpc = 0;
            },
            openside(){
                 document.getElementById("sidebar-vendor").style.width = "305px";
            },
            closeside(){
                document.getElementById("sidebar-vendor").style.width = "0";
            }
        }
    }
</script>
