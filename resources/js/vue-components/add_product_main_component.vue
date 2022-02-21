<template>
     <div class="col-8" style="margin-top: 8.5em">
        <div class="row justify-content-center mb-5 mx-auto" style = "width: 100%">
          <div class="col-lg-6 px-0 d-flex justify-content-center bg-dark media-margin text-center">
            <form action="" method="post">
               <div class="form-group">
                  <label class="text-light" for="title">title</label>
                  <input type="text" class="form-control" id="title" v-model="main_add_data.title" aria-describedby="title">
               </div>
               <div class="form-group">
                  <label class="text-light" for="stock">stock</label>
                  <input type="number" class="form-control" id="stock" v-model="main_add_data.stock" aria-describedby="stock">
               </div>
               <div class="col-12">
                  <strong class="text-light">t_name:</strong>
                  <select v-model="main_add_data.t_name" class="form-control" style="width:100%;">
                    <option disabled value="">t_name</option>
                    <option v-for="t_name in t_names" :key="t_name">{{t_name}}</option>
                  </select>
                  
               </div>
              <div class="button-parent">
                <button type="button" class="btn btn-light button mt-2 mb-3" v-on:click="continue_clicked">continue</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</template>

<script>
    export default{
        data: function(){
            return {
                main_add_data: {
                    title: "",
                    t_name: "",
                    stock: ""
                },
                t_names: ['shirts','round_necks','polos','sweat_shirts','kurtas','jeans','joggers','caperies','shorts',"desktops"],
                others: ["desktops"]
                

            }
           
            
        },
        props: ["controls"],
        methods: {        
            continue_clicked(){
                console.log(this.main_add_data);
                if(this.main_add_data.title!==''&&this.main_add_data.pstock!==''&&this.main_add_data.t_name!==''){
        
                    console.log(this.main_add_data.title)
                    localStorage.setItem('main_add_data',JSON.stringify(this.main_add_data));
                    var chk = 0
                    for(let i=0;i<this.others.length;i++){
                      if(this.main_add_data.t_name==this.others[i]){
                        this.controls.show_apmc = 0;
                        this.controls.show_aopc = 1;
                        chk = 1
                        break;
                      }

                    }
                    if(chk==0){
                      this.controls.show_apmc = 0;
                    this.controls.show_acpc = 1;
                    }
                    
                }
            }
        }
    }
</script>
