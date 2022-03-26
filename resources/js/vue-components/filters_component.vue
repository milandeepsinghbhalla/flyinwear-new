<template>
    <div>
        <div class="my-fixed-right p-2 text-white" v-on:click="open_side_filter"><i class="fas fa-filter"></i></div>
        <div id="myfilterSidenav" class="filter_sidenav text-white" style="padding-top:6.5em;">
        <a href="javascript:void(0)" class="closebtn" v-on:click="close_side_filter()">&times;</a>
        <div class="text-white text-center"><h3>Filters..!!</h3></div>
        <!-- <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a> -->
            <div v-for="(data,prop) in filter_data" :key="prop" class="ml-5 mb-3" style="font-size:1.4em">
                <span style="font-size:1em;margin-left:-1.7em" >{{prop}}:-</span><br>
                <span v-for="item in data" :key="item + '_' + Math.random()"  v-show="prop!= 'hardisk_size' && 'monitor_size'">
                <input v-on:change="toogle_data(prop,item)"  class="form-check-input" type="checkbox" :value="item">
                <label class="form-check-label" >
                    {{item}}
                </label>
                <br>
                </span>
                <span v-for="(item,n) in (data)" :key="item + '_' + Math.random()" v-show="prop == 'hardisk_size'">
                <input v-on:change="toogle_data(prop,'hard_'+n)"  class="form-check-input" type="checkbox" :value="'hard_'+n">
                <label class="form-check-label" >
                    {{item}}
                </label>
                <br>
                </span>
                <br>
                 <span v-for="(item,n) in (data)" :key="item + '_' + Math.random()" v-show="prop == 'monitor_size'">
                <input  v-on:change="toogle_data(prop,'monitor_'+n)" class="form-check-input" type="checkbox" :value="'monitor_'+n">
                <label class="form-check-label" >
                    {{item}}
                </label>
                <br>
                </span>
                
            </div>
        </div>
    </div>    
</template>
<script>
    export default{
        data: function(){
            return {
                selected_data: {}
            }
        },
        props: ["filter_data"],
        methods: {
            open_side_filter(){
                document.getElementById("myfilterSidenav").style.width = "305px";
            },
            close_side_filter(){
                  document.getElementById("myfilterSidenav").style.width = "0";

            },
            toogle_data(prop,value){
                console.log(prop)
                console.log(value)
                if(!this.selected_data[prop]){
                    this.selected_data[prop] = []
                    
                }
                if(this.selected_data[prop].includes(value)){
                        let index = this.selected_data[prop].indexOf(value)
                        this.selected_data[prop].splice(index,1);
                        console.log(this.selected_data[prop])
                    }
                    else{
                        this.selected_data[prop].push(value)
                        console.log(this.selected_data[prop])
                    }

            }
        }
    }
</script>
