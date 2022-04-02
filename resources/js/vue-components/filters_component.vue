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
                <span v-for="item in data" :key="item + '_' + Math.random()"  v-show="prop!= 'hardisk_size' && prop!='monitor_size' &&prop!='clothing_price'">
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
                <span v-for="(item,n) in (data)" :key="item + '_' + Math.random()" v-show="prop == 'clothing_price'">
                <input  v-on:change="toogle_data(prop,'cp_'+n)" class="form-check-input" type="checkbox" :value="'cp_'+n">
                <label class="form-check-label" >
                    {{item}}
                </label>
                <br>
                </span>
                
            </div>
            <div class="text-center">
                <button class="btn btn-dark btn-md mr-3">close</button>
                <button class="btn orange btn-md" v-on:click="filter_out">Apply</button>
            </div>
        </div>
    </div>    
</template>
<script>
import Vue from "vue";

export default{
        
        data: function(){
            return {
                selected_data: {},
                filter_result: [],
                json_chk: 0,
                clothing_products: ["joggers","shirts"]
            }
        },
        props: ["filter_data","parent_data","t_name"],
        
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

            },
            filter_out(){
                if(this.json_chk==0){
                    console.log(this.parent_data)
                    this.parent_data.forEach(el=>{
                        let type = typeof el.features
                        if(type=="string"){
                            if(el.features!="")
                            el.features = JSON.parse(el.features)
                        }
                    })
                    this.json_chk = 1;
                }
                console.log("working")
                let filter  = [];
                if(this.t_name == "desktops"){
                    let data = this.parent_data;
                    let current_filter = []
                    
                        if(this.selected_data.ram){
                            var ram_selection = [];
                            let x = 0
                            this.selected_data.ram.forEach(el=>{
                                ram_selection[x] = el;
                                x++;
                            });
                                if(ram_selection.includes('16gb +')){
                                    current_filter = [];
                                    for(let i=0;i<data.length;i++){
                                    if(data[i].features.ram>16){
                                        if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                    }
                                }
                                
                                filter = current_filter;
                                data = filter
                                }
                                    let i=0;
                                    ram_selection.forEach(el=>{
                                        console.log("element", el)
                                        let index = el.indexOf('gb');
                                        if(index!=-1)
                                        el = el.substr(0,index);
                                        console.log("ele:- ",el);
                                        ram_selection[i] = el;
                                        i++
                                    })

                    
                        }
                    
                   
                    //if(filter.length>0){
                        //data = filter;
                   // }
                    
                        if(this.selected_data.graphic_card_size){
                            var graphic_selection = []
                            let x = 0 
                            this.selected_data.graphic_card_size.forEach(el=>{
                                graphic_selection[x] = el;
                                x++;
                            });
                            if(graphic_selection.includes('8gb +')){
                                current_filter = [];
                                for(let i=0;i<data.length;i++){
                                    if(data[i].features.graphic_card_size>8){
                                        if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                    }
                                }
                                 filter = current_filter
                            }
                                let i=0;
                                    graphic_selection.forEach(el=>{
                                        let index = el.indexOf('gb');
                                        if(index!=-1)
                                        el = el.substr(0,index);
                                        graphic_selection[i] = el;
                                        i++;
                                    })
                                    

                        
                    }
                   
                       
                    //if(filter.length>0){
                        //data = filter;
                   // }
                    
                        if(this.selected_data.hardisk_size){
                            current_filter = []
                            for(let i=0;i<data.length;i++){
                            this.selected_data.hardisk_size.forEach(el=>{
                                switch(el){
                                    case 'hard_0':
                                      if(data[i].features.hardisk_size<=256){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_1':
                                      if(data[i].features.hardisk_size<=512&&data[i].features.hardisk_size>=256){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_2':
                                      if(data[i].features.hardisk_size>=512&&data[i].features.hardisk_size<=1000){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_3':
                                      if(data[i].features.hardisk_size>=1000&&data[i].features.hardisk_size<=1256){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_4':
                                      if(data[i].features.hardisk_size>=1256&&data[i].features.hardisk_size<=1512){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_5':
                                      if(data[i].features.hardisk_size>=1512&&data[i].features.hardisk_size<=2000){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_6':
                                      if(data[i].features.hardisk_size<=2512&&data[i].features.hardisk_size>=2000){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;
                                    case 'hard_7':
                                      if(data[i].features.hardisk_size>=2512){
                                          if(!current_filter.includes(data[i]))
                                            current_filter.push(data[i]);
                                      }
                                      break;      
                                }
                            })
                            
                        }
                        filter = current_filter;
                        data = filter
                    }
                    
                    //if(filter.length>0){
                        //data = filter;
                   // }
                    
                    
                        if(this.selected_data.monitor_size){
                            current_filter = []
                            console.log("data = ",data);
                            for(let i=0;i<data.length;i++){
                            this.selected_data.monitor_size.forEach(el=>{
                                switch(el){
                                    case "monitor_0":
                                        if(data[i].features.monitor_size<= 12){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;
                                    case "monitor_1":
                                        if(data[i].features.monitor_size>= 12 && data[i].features.monitor_size<=14 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;
                                    case "monitor_2":
                                        if(data[i].features.monitor_size>= 14 && data[i].features.monitor_size<=16 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break; 
                                    case "monitor_3":
                                        if(data[i].features.monitor_size>= 16 && data[i].features.monitor_size<=20 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;
                                    case "monitor_4":
                                        if(data[i].features.monitor_size>= 20 && data[i].features.monitor_size<=24 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break; 
                                    case "monitor_5":
                                        if(data[i].features.monitor_size>= 24 && data[i].features.monitor_size<=28 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;
                                    case "monitor_6":
                                        console.log(data[i].features.monitor_size)
                                        if(data[i].features.monitor_size>= 28 && data[i].features.monitor_size<=32 ){
                                            
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;
                                    case "monitor_7":
                                        if(data[i].features.monitor_size>= 32 ){
                                            if(!current_filter.includes(data[i]))
                                                current_filter.push(data[i]);
                                        }
                                        break;             
                                }
                            })
                            
                        }
                        filter = current_filter;
                        data = filter
                    }
                    
                    //if(filter.length>0){
                        //data = filter;
                   // }
                    
                        for(let feature_key in this.selected_data){
                            current_filter = [];
                            console.log(feature_key);
                            console.log("data :-",data);
                            if(feature_key=='ram'){
                            for(let i=0;i<data.length;i++){
                                console.log("seleceted data",ram_selection)
                            if(ram_selection){
                                
                                console.log("find data :- ",data[i].features)
                                if(ram_selection.includes(data[i].features[feature_key])){
                                    if(!current_filter.includes(data[i])){
                                        current_filter.push(data[i])
                                    }
                                }
                                
                            }
                            }
                            filter = current_filter;
                            data = filter
                            }
                            else if(feature_key == "graphic_card_size"){
                                for(let i=0;i<data.length;i++){
                                console.log("seleceted data",graphic_selection)
                            if(graphic_selection){
                                
                                console.log("find data :- ",data[i].features)
                                if(graphic_selection.includes(data[i].features[feature_key])){
                                    if(!current_filter.includes(data[i])){
                                        current_filter.push(data[i])
                                    }
                                }
                                
                            }
                            }
                            filter = current_filter;
                            data = filter
                            }
                            else if(feature_key!='hardisk_size' && feature_key!='monitor_size'){
                               for(let i=0;i<data.length;i++){
                                console.log("seleceted data",this.selected_data[feature_key])
                            if(this.selected_data[feature_key]){
                                
                                console.log("find data :- ",data[i].features)
                                if(this.selected_data[feature_key].includes(data[i].features[feature_key])){
                                    if(!current_filter.includes(data[i])){
                                        current_filter.push(data[i])
                                    }
                                }
                                
                            }
                            }
                            filter = current_filter;
                            data = filter 
                            }
                            
                            //if(filter.length>0){
                                //data = filter;
                            //} 
                        };
                        console.log(filter)
                        let filter_data = JSON.stringify(filter);
                        localStorage.setItem('filter_data',filter_data)
                        this.$router.push({name:'filter-result'});
                }
                if(this.clothing_products.includes(this.t_name)){
                    this.parent_data.forEach(el=>{
                        el.color = el.colors[0];
                        if(el.features.brand)
                        el.brand = el.features.brand
                    })
                    let data = this.parent_data;
                    let current_filter = [];
                    for(let feature_key in this.selected_data){
                        if(feature_key!='clothing_price'&&feature_key!='size'){
                            if(this.selected_data[feature_key]){
                                current_filter = [];
                                this.selected_data[feature_key].forEach(value =>{
                                    for(let i = 0;i<data.length;i++){
                                        if(data[i][feature_key]){
                                            if(data[i][feature_key].toLowerCase() == value.toLowerCase()){
                                                if(!current_filter.includes(data[i])){
                                                    current_filter.push(data[i])
                                                }
                                            }
                                        }

                                    }
                                })
                               data = current_filter; 
                            }
                            
                        }
                        if(feature_key=='size'){
                            if(this.selected_data[feature_key]){
                                current_filter = []
                                this.selected_data.size.forEach(size=>{
                                    let str = "stock_" + size.toLowerCase();
                                    for(let i = 0;i<data.length;i++){
                                        
                                        if(data[i][str]>0){
                                            if(!current_filter.includes(data[i])){
                                                current_filter.push(data[i]);
                                            }
                                        }
                                    }
                                })
                                data = current_filter
                            }
                        }
                        if(feature_key=='clothing_price'){
                            if(this.selected_data[feature_key]){
                                current_filter = []
                                this.selected_data.clothing_price.forEach(el=>{
                                    switch(el){
                                        case "cp_0":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price<=100){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_1":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>100 && data[i].actual_price<=200){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_2":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>200 && data[i].actual_price<=300){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_3":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>300 && data[i].actual_price<=400){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_4":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>400 && data[i].actual_price<=500){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_5":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>500 && data[i].actual_price<=700){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_6":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>700 && data[i].actual_price<=900){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_7":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>900 && data[i].actual_price<=1100){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_8":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>1100 && data[i].actual_price<=1500){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_9":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>1500 && data[i].actual_price<=1900){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_10":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>1900 && data[i].actual_price<=2300){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                        case "cp_11":
                                            for(let i = 0;i<data.length;i++){
                                                if(data[i].actual_price>=2300){
                                                    if(!current_filter.includes(data[i])){
                                                        current_filter.push(data[i])
                                                    }
                                                }
                                            }
                                            break;
                                    }
                                })
                                data = current_filter
                            }
                            
                        }
                    }
                        let filter_data = JSON.stringify(data);
                        localStorage.setItem('filter_data',filter_data)
                        this.$router.push({name:'filter-result'});
                   
                }
            }
        }
    }
</script>
