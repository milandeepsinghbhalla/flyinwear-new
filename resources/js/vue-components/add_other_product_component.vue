<template>
    <div class="col-12">
        <div class="row justify-content-center mb-5 mx-auto" style = "width: 100%">
            <div class="col-10">
                        <img :src="img_link.link" style="hieght: 200px;width: 250px;margin: 2em;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" @change="main_img_changed">
                            <label class="custom-file-label" for="customFile">add image</label>
                        </div>



                        <div class="form-group">
                            <label for="price">price</label>
                            <input type="number" v-model="cont_add_p.price" class="form-control" id="price" placeholder="price">
                        </div>
                        <div class="form-group">
                            <label for="height">height</label>
                            <input type="number" v-model="cont_add_p.height" class="form-control" id="height" placeholder="height">
                        </div>
                        <div class="form-group">
                            <label for="breadth">breadth</label>
                            <input type="number" v-model="cont_add_p.breadth" class="form-control" id="breadth" placeholder="breadth">
                        </div>
                         <div class="form-group">
                            <label for="depth">depth</label>
                            <input type="number" v-model="cont_add_p.depth" class="form-control" id="depth" placeholder="depth">
                        </div>
                        <div class="form-group">
                            <label for="weight">weight</label>
                            <input type="number" v-model="cont_add_p.weight" class="form-control" id="weight" placeholder="weight">
                        </div>
                        <div class="form-group">
                            <label for="discount">discount</label>
                            <input type="number" v-model="cont_add_p.discount" class="form-control" id="discount" placeholder="discount">
                        </div>

                        <!-- <div class="form-group">
                            <label for="fabric">Fabric</label>
                            <input type="text" v-model="cont_add_p.fabric" class="form-control" id="fabric" placeholder="fabric">
                        </div> -->

                        
                        <button class="btn btn-dark text-left" @click="add_other_img_clicked()">add other images</button>
                        <add-other-images :img_no="img_no" :cont_add_p="cont_add_p" v-if="add_other==1" :EventBus="EventBus" :form_data="form_data"></add-other-images>
                        
                        <br>
                        <div class="form-group">
                            <label for="bid">color</label>
                            <input type="text" @change="color_chng" class="form-control" id="color" placeholder="add color">
                        </div>
                         <div class="mt-4">
                            <label for="description">Description:-</label>
                            <textarea class="bio-prof-input-note text-left p-3" maxlength = "5000" v-model="cont_add_p.description" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  style="overflow:auto; resize:none; line-height: 1.23em; white-space: pre-line;" placeholder="Add product description!!!"></textarea>
                        </div>
                        <br><h3 class="mt-4">enter features:-</h3><br><br>
                            <div class="form-group" v-for="(item, prop) in cont_add_p.features" :key="prop">
                            
                              <label  v-if="props[prop].type=='text'"  class="text-peach" >{{prop}}:-</label>
                              <input  v-if="props[prop].type=='text'" type="text" class="form-control" v-model="cont_add_p.features[prop]" aria-describedby="pstock">
                              
                               <span v-if="props[prop].type=='number'">
                              <label class="text-peach" >{{prop}}:-</label>
                              <input type="number" class="form-control" v-model="cont_add_p.features[prop]" aria-describedby="pstock">
                              </span>
                               <span v-if="props[prop].type=='select'">
                                  <label class="text-peach" >{{prop}}:-</label>
                                <select v-model="cont_add_p.features[prop]" id="inlineFormCustomSelectPref">
                                    <option disabled value="">{{prop}}</option>
                                  <option v-for="option in props[prop].options" :key="option">{{option}}</option>
                                </select>
                              </span>
                              <span v-if="props[prop].type=='textbox'">
                              <label class="text-peach" >{{prop}}:-</label>
                              <textarea class="form-control" v-model="cont_add_p.features[prop]" aria-describedby="pstock"></textarea>
                              </span>
                          </div>
                          <div class="mt-4">
                            <label for="keywords">keywords:-</label>
                            <textarea class="bio-prof-input-note text-left p-3" maxlength = "5000" v-model="cont_add_p.keywords" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  style="overflow:auto; resize:none; line-height: 1.23em; white-space: pre-line;" placeholder="Add product description!!!"></textarea>
                        </div>
                          <!-- <div class="form-group">
                              <label class="text-peach" >stock_s</label>
                              <input type="number" class="form-control" v-model="cont_add_p.stock_s" aria-describedby="pstock" :placeholder="cont_add_p.stock_s">
                          </div>
                          <div class="form-group">
                            <label class="text-peach" >stock_m</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_m" aria-describedby="pstock" :placeholder="cont_add_p.stock_m">
                          </div>
                          <div class="form-group">
                            <label class="text-peach" >stock_l</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_l" aria-describedby="pstock" :placeholder="cont_add_p.stock_l">
                          </div>
                          <div class="form-group">
                            <label class="text-peach" >stock_xl</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_xl" aria-describedby="pstock" :placeholder="cont_add_p.stock_xl">
                          </div>
                          <div class="form-group">
                            <label class="text-peach" >stock_2xl</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_2xl" aria-describedby="pstock" :placeholder="cont_add_p.stock_2xl">
                          </div>
                          <div class="form-group">
                            <label class="text-peach" >stock_3xl</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_3xl" aria-describedby="pstock" :placeholder="cont_add_p.stock_3xl">
                          </div><div class="form-group">
                          <label class="text-peach" >stock_4xl</label>
                          <input type="number" class="form-control" v-model="cont_add_p.stock_4xl" aria-describedby="pstock" :placeholder="cont_add_p.stock_4xl">
                        </div>
                        <div class="form-group">
                            <label class="text-peach" >stock_5xl</label>
                            <input type="number" class="form-control" v-model="cont_add_p.stock_5xl" aria-describedby="pstock" :placeholder="cont_add_p.stock_5xl">
                        </div> -->
              
                        <!-- <div class="mt-4">
                            <label foabel>
                            <textarea class="bio-prof-input-note text-left p-3" maxlength = "5000" v-model="cont_addocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  style="overflow:auto; resize:none; line-height: 1.23em; white-space: pre-line;" placeholder="Add produ</textarea>
                        </div> -->
                    
                        <div class="text-center mb-5">
                          <button class="btn btn-dark btn-lg mt-5 text-center" @click="upload">upload product</button>
                        </div>

                        

            </div>
        </div>
              </div>
</template>

<script>
    import Vue from "vue";

    import add_other_images from "./add_other_images.vue"
    export default{
        data: function(){
    return {
      main_add_data: {},
      cont_add_p: {
        price: '',
        colors: [],
        vid:"",
        features:{},
        weight: 0.8,
        description: "",
        height:"",
        breadth:"",
        discount:"",
        depth:"",
        keywords: ''
      },
      img_no: 1,
      add_other: 0,
      img_link: {
        link: ''
      },
      EventBus: new Vue(),
      form_data: new FormData(),
      props:{
      clock_speed:{
        type: "number",
        unit: "GHz"
      },
      processor_company:{
        type: "select",
        options: ["Intel","AMD","others"]
      },
      processor_base:{
        type: "select",
        options: ["Intel Celeron","Intel Pentium","Intel Core i3","Intel Core i5","Intel Core i7","Intel Core i9","AMD Ryzen 3","AMD Ryzen 5","AMD Ryzen 7","others"]
      },
      processor: {
        type: "text"
      },
      generation:{
        type: "select",
        options: ["1st gen","2nd gen","3rd gen","4th gen","5th gen","6th gen","7th gen","8th gen","9th gen","10th gen","11th gen","12th gen"]
      },
      os_type:{
        type: "select",
        options: ["Microsoft Windows","Mac OS","Linux","others"],
      },
      os_parent:{
        type: "select",
        options: ["Windows 7","windows 8","windows 10","windows 11","mac os","Ubuntu","Fedora","Debian","Kali","others"]
      },
      os_name:{
        type: "text",
      },
      ms_office:{
        type: "select",
        options: ["yes","no"]
      },
      ms_office_version:{
        type: "text"
      },
      ram:{
        type: "number",
        units: "gb"
      },
      ram_type:{
        type: "select",
        options: ["DDR2","DDR3","DDR4","others"]
      },
      hardisk:{
        type: "text"
      },
      hardisk_size:{
        type: "number",
        units: "gb"
      },
      hardisk_type:{
        type: "select",
        options: ["HDD","SSD","Hybrid"]
      },
      graphic_card:{
        type: "text"
      },
      graphic_card_size:{
        type: "number",
        units: "gb"
      },
      graphic_card_type:{
        type: "select",
        options: ["integrated","dedicated"]
      },
      monitor: {
        type: "text",

      },
      monitor_size:{
        type: "number",
        unit: "inches"
      },
      mouse: {
        type: "select",
        options: ["yes","no"],

      },
      keybord:{
        type: "select",
        options: ["yes","no"]
      },
      webcam:{
        type: "select",
        options: ["yes","no"]
      },
      sound:{
        
        type: "text"
      },
      dvd_drive:{
         type: "select",
        options: ["yes","no"]
      },
      network: {
        type: "text"
      },
      warranty:{
        type: "text"
      },
      ports: {
        type: "text"
      },
      additional_info: {
        type: "textbox"
      },
      company:{
        type: "select",
        options: ["Dell","HP","Acer","Lenovo","Apple","others"]
      },
      product_name: {
        type: "text",
      },
      contains: {
        type: "textbox"
      }
      }
      
    };
  },
  props: ["controls"],
  components:{
    'add-other-images': add_other_images
  },
  methods:{
    color_chng(event){
      if(this.cont_add_p.colors.length==0){
        this.cont_add_p.colors.push(event.target.value);
      }
      else{
        this.cont_add_p.colors.pop();
        this.cont_add_p.colors.push(event.target.value);
      }
    },
    // add_col(event){
    //   if(this.cont_add_p.colors.includes(event.target.value)){
    //     let i= this.cont_add_p.colors.indexOf(event.target.value);
    //     this.cont_add_p.colors.splice(i,1);
    //   }
    //   else{
    //     this.cont_add_p.colors.push(event.target.value);
    //   }
    // },
    add_other_img_clicked(){
      
      let i = 0;
          for (var pair of this.form_data.entries()) {
            i++
          }
          if(this.img_no ==i){
            this.add_other=1;
            this.img_no++;
          }
          else{
            swal("add previous images first"," ","error");
          }
    },
    main_img_changed(event){
      function my_func(result,img_link) {
        img_link.link = result;
    }
    

    function read(callback,img_link) {
      var file = event.target.files[0];
      var reader = new FileReader();

      reader.onload = function() {
        console.log(reader);
        console.log(img_link);
        callback(reader.result,img_link);
      }

      reader.readAsDataURL(file);
      
    }
    read(my_func,this.img_link)
    
    let filename = event.target.value;
    console.log(event);
    let label = event.target.nextElementSibling;
    label.innerHTML = filename;
    this.form_data.set('img_1',event.target.files[0]);
    },
  
    upload(){
        this.cont_add_p.vid = this.$current_user.id;
        var chk = 0;
        var err_prop=""
        for(const prop in this.cont_add_p){
          if(prop!="colors" && prop!="features" && prop!="keywords"){  
            if(this.cont_add_p[prop].length==0){
              err_prop = prop;
              chk = 1
              break;
            }
          }
        }
        for (const prop in this.cont_add_p.features){
          if(this.cont_add_p.features[prop].length==0){
            err_prop = prop;
            chk = 1
            break;
          }
        }
        if(chk==0){
          let i = 0;
          for (var pair of this.form_data.entries()) {
            i++
          }
          let img_chkr = false;
          let img_str = 'img_'+this.img_no;
          if(this.form_data.has(img_str)){
            img_chkr = true;
          }
          if(img_chkr){
            if(this.cont_add_p.keywords!=''){
                let words = [];
                words = this.cont_add_p.keywords.split(",");
                words.forEach(element => {
                  element = element.trim();
                });
                words = JSON.stringify(words);
                this.form_data.set('keywords',words);
            }
            this.form_data.set('title',this.main_add_data.title);
            this.form_data.set('stock',this.main_add_data.stock);
            this.form_data.set('t_name',this.main_add_data.t_name);
            this.form_data.set('price',this.cont_add_p.price);
          
              this.form_data.set('vid',this.cont_add_p.vid);
            this.form_data.set('weight',this.cont_add_p.weight);
            this.form_data.set('description',this.cont_add_p.description);
            this.form_data.set('height',this.cont_add_p.height);
            this.form_data.set('breadth',this.cont_add_p.breadth);
            this.form_data.set('depth',this.cont_add_p.depth);
            this.form_data.set('discount',this.cont_add_p.discount);
            this.form_data.set('colors',JSON.stringify(this.cont_add_p.colors));
            this.form_data.set('features',JSON.stringify(this.cont_add_p.features));

            this.form_data.set('img_no',this.img_no);



            for (var pair of this.form_data.entries()) {
              console.log(pair[0]+ ', ' + pair[1]); 
            }
            this.$http.post("/api/add-product-other",this.form_data).then(res=>{
              console.log(res.body);
              if(res.body.status==1){
                swal("product added"," ","success");
                localStorage.removeItem('main_add_data');
                location.reload();
              }
              else if(res.body.status==0){
                swal(res.body.message," ","error");
              }
              else if(res.body.status==-1){
                swal(res.body.message," ","error");
              }
            })

            
          }
          else{
            swal("add all images"," ","error");
          }
        }
        else{
          swal(err_prop + " not filled"," ","error");
        }
  
    }
  },
  created(){
    
    this.EventBus.$on('imgnoupdated',img_no=>{this.img_no=img_no});
    this.EventBus.$on('form_data_updated',form_data=>{this.form_data=form_data});
    console.log(this.form_data);
    if(localStorage.getItem('main_add_data')){
      this.main_add_data = JSON.parse(localStorage.getItem('main_add_data'));
    }
    if(this.main_add_data.t_name == 'laptops'){
      let props = {
        max_clock_speed: {
          type: "number"
        },
        clock_speed:{
        type: "number",
        unit: "GHz"
      },
      processor_company:{
        type: "select",
        options: ["Intel","AMD","others"]
      },
      processor_base:{
        type: "select",
        options: ["Intel Celeron","Intel Pentium","Intel Core i3","Intel Core i5","Intel Core i7","Intel Core i9","AMD Ryzen 3","AMD Ryzen 5","AMD Ryzen 7","others"]
      },
      processor: {
        type: "text"
      },
      generation:{
        type: "select",
        options: ["1st gen","2nd gen","3rd gen","4th gen","5th gen","6th gen","7th gen","8th gen","9th gen","10th gen","11th gen","12th gen"]
      },
      os_type:{
        type: "select",
        options: ["Microsoft Windows","Mac OS","Linux","others"],
      },
      os_parent:{
        type: "select",
        options: ["Windows 7","windows 8","windows 10","windows 11","mac os","Ubuntu","Fedora","Debian","Kali","others"]
      },
      os_name:{
        type: "text",
      },
      ms_office:{
        type: "select",
        options: ["yes","no"]
      },
      ms_office_version:{
        type: "text"
      },
      ram:{
        type: "number",
        units: "gb"
      },
      ram_range:{
        type: "select",
        options: ["1gb","2gb - 4gb","4.1gb - 6gb","6.1gb - 8gb","8.1gb - 10gb","10.1gb - 12gb","12.1gb - 16gb","16gb +"]
      },
      ram_type:{
        type: "select",
        options: ["DDR2","DDR3","DDR4","others"]
      },
      hardisk:{
        type: "text"
      },
      hardisk_size_range:{
        type: "select",
        options: ["<= 256gb","257gb - 512gb","513gb-1tb","1.1tb-1256gb","1257gb-1512gb","1513gb-2tb","2.1tb-2512gb","2512gb +"]
      },
       hardisk_type:{
        type: "select",
        options: ["HDD","SSD","Hybrid"]
      },
      graphic_card:{
        type: "text"
      },
      graphic_card_size:{
        type: "select",
        options: ["1gb","2gb","4gb","6gb","8gb","8gb +"],
      },
      graphic_card_type:{
        type: "select",
        options: ["integrated","dedicated"]
      },
      screen: {
        type: "text",

      },
      screen_size_range: {
        type: "select",
        options: ["11-13 inches","13.1 - 14 inches","14.1 - 15 inches","15.1 - 16 inches","16.1 - 17 inches","17 + inches"]
      },
      battery: {
        type: "text"
      },
      battery_backup_range:{
        type: "select",
        options: ["3 - 5 hrs","5.1 - 7 hrs","7.1 - 9 hrs","9.1 - 12 hrs","12 + hrs"]
      },
      company:{
        type: "select",
        options: ["Dell","HP","Acer","Lenovo","Apple","others"]
      },
      webcam:{
        type: "select",
        options: ["yes","no"]
      },
      sound:{
        
        type: "text"
      },
      dvd_drive:{
         type: "select",
        options: ["yes","no"]
      },
      network: {
        type: "text"
      },
      warranty:{
        type: "text"
      },
      ports: {
        type: "text"
      },
      additional_info: {
        type: "textbox"
      },
      contains: {
        type: "textbox"
      }
    }
    this.props = props
    }
    if(this.main_add_data.t_name == 'mobiles'){
      let props = {
        company:{
          type: "select",
          options: ["Xiaomi","Samsung","Vivo","Oppo","Apple","Realme","OnePlus","Poco","Nokia","others"]
        },
        ram:{
          type: "select",
          options: ["1gb","2gb","3gb","4gb","6gb","8gb","10gb","12gb","16gb","16gb +"]
        },
        color: {
          type: "select",
          options: ["black","grey","gold","pink gold","green","red","orange","white","blue","yellow","pink","silver","purple","brown","other"]
        },
        rom: {
          type: "select",
          options: ["16gb","32gb","64gb","128gb","256gb","512gb","512gb +"]
        },
        camera_mp_highest: {
          type: "select",
          options: ["8mp","12mp","16mp","32mp","48mp","64mp","72mp","128mp","128mp +"]
        },
        display: {
          type: "select",
          options: ["FHD","Amoled","Super Amoled","others"]
        },
        size: {
          type: "text"
        },
        warranty: {
          type: "text"
        },
        charger_watt: {
          type: "text"
        },
        battery: {
          type: "textbox"
        },
        sound: {
          type: "textbox"
        },
        network: {
          type: "textbox"
        },
        processor: {
          type: "textbox"
        },
        additional_info: {
          type: "textbox"
        },
        contains: {
          type: "textbox"
        }
      }
      this.props = props
    }
    switch(this.main_add_data.t_name){
        case "desktops":
            this.cont_add_p.features={
                company: "",
                product_name: "",
                contains: "",
                processor_company:"",
                processor_base:"",
                processor: "",
                generation: "",
                clock_speed: "",
                os_type: "",
                os_parent:"",
                os_name: "",
                ms_office: "",
                ms_office_version: "",
                ram: "",
                ram_type: "",
                hardisk: "",
                hardisk_size:"",
                hardisk_type: "",
                graphic_card: "",
                graphic_card_size:"",
                graphic_card_type: "",
                monitor: "",
                monitor_size: "",
                mouse: "",
                keybord: "",
                sound: "",
                webcam: "",
                dvd_drive: "",
                network: "",
                
                warranty:"",
              
                ports:"",
                additional_info: ""
                
            }
            break;
        
    }
    for(let prop in this.props){
      this.cont_add_p.features[prop] = ""
    }

  }
  
    
  }
    
    
</script>