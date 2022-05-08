<template>
    <div class="input-group">
        
        <input type="text" class="form-control" v-model="search_text" placeholder="Search Anything...!!" aria-label="search" aria-describedby="search" v-on:keyup.enter="search_clicked">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon1" v-on:click="search_clicked"><i class="fas fa-search"></i></span>
        </div>
    </div>
</template>
<script>
export default{
    data: function(){
        return {
            search_text: "",
            t_names: [
                {
                    keys:["shirts"],
                    t_name: "shirts"
                },
                {
                    keys:["tshirts","t shirts","roundneck"],
                    t_name: "roundnecks"
                },
                {
                    keys:["polos"],
                    t_name: "polos"
                },
                {
                    keys:["sweatshirts","hoodies"],
                    t_name:"sweatshirts"
                },
                {
                    keys:["kurtas"],
                    t_name:"kurtas"
                },
                {
                    keys:["jeans","pants","trousers"],
                    t_name:"jeans"
                },
                {
                    keys:["joggers","trackpants","lowers","pyjamas"],
                    t_name:"joggers"
                },
                {
                    keys:["caperies"],
                    t_name:"caperies"
                },
                {
                    keys:["shorts"],
                    t_name:"shorts"
                },
                {
                    keys:["ethinic","wedding","functions","official"],
                    t_name:"ethinics"
                },
                {
                    keys:["desktops","pc","computers"],
                    t_name: "desktops"
                },
                {
                    keys:["laptops"],
                    t_name:"laptops"
                }
            ],
            genders: ["women","girls","ladies"]
        }
    },
    methods: {
        async search_clicked(){
            // let search_keywords = [];
            // search_keywords = this.search_text.split(" ");
            // let t_name = ""
            // let selector = "t_names";

            // search_keywords.every(keyword=>{
            //     this.genders.forEach(gender=>{
            //         if(gender.toLowerCase().substring(0,3)==keyword.toLowerCase().substring(0,3))
            //             selector = "w_tables";
            //     })
            //     this[selector].every(obj=>{
            //         obj.keys.every(key=>{
            //             if(key.toLowerCase().substring(0,4)==keyword.toLowerCase().substring(0,4)){
            //                 t_name = obj.t_name;
            //                 return false;
            //             }
            //             else
            //                 return true;
            //         })
            //         if(t_name.length>0)
            //             return false;
            //         else
            //             return true;
                    
            //     })
            //     if(t_name.length>0)
            //         return false; 
            //     else 
            //         return true;
            // })
            // console.log("t name = ",t_name);
            // if(t_name.length>0){
            //     let search_products = [];
            //     await this.$http.post('api/get-products',{t_name: t_name}).then( res=>{
            //     console.log("desktops:-  ",res.body);
                
            //     res.body.forEach(desktop=>{
            //         desktop.colors = JSON.parse(desktop.colors)
            //         desktop.images = JSON.parse(desktop.images)
            //         desktop.keywords = JSON.parse(desktop.keywords)
            //         desktop.weight = Number(desktop.weight)
            //         desktop.actual_price = desktop.price - (desktop.price*desktop.discount)/100
            //     })
            //     search_products = res.body; 
            //     })
            //     let new_products = [];
            //     search_products.forEach(sp=>{
            //         let count = 0;
            //         sp.keywords.forEach(key_product=>{
            //             search_keywords.forEach(key_search=>{
            //                 if(key_product.toLowerCase().substring(0,3)==key_search.toLowerCase().substring(0,3)){
            //                     count++;
            //                 }
            //             })
            //         })
            //         sp.count = count;
            //     })
            //     search_products.sort(function(a,b){
            //         return b.count - a.count;
            //     })

            //     console.log("search results = ",search_products);
            this.search_text = this.search_text.trim();
                if(this.search_text.length>0){
                    localStorage.setItem('search_text',this.search_text);
                    if(this.$route.path!='/search-results'){
                        this.$router.push("/search-results");
                        $('.navbar-collapse').collapse("hide")
                    }
                    else{
                        location.reload();
                    }
                }
                else{
                    swal("enter something to search"," ","warning");
                }
            }
        }
    }

</script>
