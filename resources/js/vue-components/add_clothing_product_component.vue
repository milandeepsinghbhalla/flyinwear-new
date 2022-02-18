<template>
    <div class="container">
        <div class="row justify-content-center mb-5 mx-auto" style = "width: 100%">
            <div class="col-8">
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
                            <label for="fabric">Fabric</label>
                            <input type="text" v-model="cont_add_p.fabric" class="form-control" id="fabric" placeholder="fabric">
                        </div>

                        <div class="form-group">
                            <label for="bid">bid</label>
                            <input type="text" v-model="cont_add_p.bid" class="form-control" id="bid" placeholder="back id">
                        </div>
                        <button class="btn btn-dark text-left" @click="add_other_img_clicked()">add other images</button>
                        <add-other-images :img_no="img_no" :cont_add_p="cont_add_p" v-if="add_other==1" :EventBus="EventBus" :form_data="form_data"></add-other-images>
                        
                        <br>
                        <div class="form-group">
                            <label for="bid">color</label>
                            <input type="text" @change="color_chng" class="form-control" id="color" placeholder="add color">
                        </div>
                        <br><h3 class="mt-4">select sizes stock:-</h3><br><br>
                          <div class="form-group">
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
                        </div>
              
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
        fabric: '',
        colors: [],
        bid:"same",
        stock_s: 0,
        stock_l: 0,
        stock_m: 0,
        stock_xl: 0,
        stock_2xl: 0,
        stock_3xl: 0,
        stock_4xl: 0,
        stock_5xl: 0,
        weight: 0.8
      },
      img_no: 1,
      add_other: 0,
      img_link: {
        link: ''
      },
      EventBus: new Vue(),
      form_data: new FormData()
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
        
        if(this.cont_add_p.price!=''&& this.cont_add_p.fabric!='' && this.cont_add_p && (this.cont_add_p.colors.length!==0)  ){
          let i = 0;
          for (var pair of this.form_data.entries()) {
            i++
          }
          if(this.img_no ==i){
            this.form_data.set('title',this.main_add_data.title);
            this.form_data.set('stock',this.main_add_data.stock);
            this.form_data.set('t_name',this.main_add_data.t_name);
            this.form_data.set('price',this.cont_add_p.price);
            if(this.cont_add_p.bid!='')
              this.form_data.set('bid',this.cont_add_p.bid);
            this.form_data.set('weight',this.cont_add_p.weight);

            this.form_data.set('colors',JSON.stringify(this.cont_add_p.colors));
            this.form_data.set('stock_s',this.cont_add_p.stock_s);
            this.form_data.set('stock_m',this.cont_add_p.stock_m);
            this.form_data.set('stock_l',this.cont_add_p.stock_l);
            this.form_data.set('stock_xl',this.cont_add_p.stock_xl);
            this.form_data.set('stock_2xl',this.cont_add_p.stock_2xl);
            this.form_data.set('stock_3xl',this.cont_add_p.stock_3xl);
            this.form_data.set('stock_4xl',this.cont_add_p.stock_4xl);
            this.form_data.set('stock_5xl',this.cont_add_p.stock_5xl);
            this.form_data.set('img_no',this.img_no);
            this.form_data.set('fabric',this.cont_add_p.fabric);



            for (var pair of this.form_data.entries()) {
              console.log(pair[0]+ ', ' + pair[1]); 
            }
            this.$http.post("/api/add-product-clothing",this.form_data).then(res=>{
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
          swal("fill minimum required fields"," ","error");
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

  }
  
    
  }
    
</script>
