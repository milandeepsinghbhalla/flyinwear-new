<template>
    <div> 
         <img :src="img_link.link" style="hieght: 200px;width: 250px;margin: 2em;">
         <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" @change="main_img_changed">
            <label class="custom-file-label" for="customFile">add image</label>
         </div>
         <button class="btn btn-dark" @click="add_another_clicked()">add another img</button>
         <aoi :cont_add_p="cont_add_p" :img_no="img_no"  v-if="add_another==1" :EventBus="EventBus" :form_data="form_data"></aoi>
  </div>
</template>

<script>
    export default{
        name:'aoi',
        data: function(){
            return {
            add_another: 0,
            img_link: {
                link: ""
            }
            }
        },
        props: ['cont_add_p','img_no','EventBus','form_data'],
        created(){
            console.log(this.add_another);
            this.add_another=0;
        },
        methods:{
            add_another_clicked(){
            
            let i = 0;
                for (var pair of this.form_data.entries()) {
                    i++
                }
                if(this.img_no ==i){
                    this.add_another= 1;
                    this.img_no++;
                    this.EventBus.$emit('imgnoupdated',this.img_no);
                    this.EventBus.$emit('form_data_updated',this.form_data);
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
            console.log(this.img_no);
            console.log(event.target.files[0]);
            this.form_data.set('img_'+this.img_no,event.target.files[0]);
            for (var pair of this.form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            }
        }
    }
</script>
