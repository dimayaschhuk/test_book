<style>
    a.button27 {
        position: relative;
        display: inline-block;
        width: 2em;
        height: 2em;
        line-height: 2em;
        vertical-align: middle;
        text-align: center;
        text-decoration: none;
        color: #000;
        outline: none;
        border-radius: 5px;
        box-shadow: 0 0 0 1px #ddd inset, 0 1px 1px #fff;
    }
    a.button27:hover {
        background: #dcdcdc linear-gradient(#fff, #dcdcdc);
        box-shadow: 0 0 0 1px #aaa inset, 0 1px 1px #aaa;
    }
    a.button27:active {
        background: none;
        box-shadow: 0 0 0 1px #bbb inset, 0 1px 3px rgba(0,0,0,.5) inset, 0 1px 2px #fff;
    }
    .showw:hover {

        cursor: pointer;
    }
</style>
<template>
   <div>

       <!-- Modal -->
       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle">BOOK</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="row" >
                           <div class="col-lg-5">

                                    <div v-if="show">
                                         <img style="width: 300px" v-bind:src="'/images/max/'+name_img">
                                    </div>
                                    <div v-else="">

                                        <div class="container" v-if="!save_show">
                                            <div class="large-12 medium-12 small-12 cell">
                                                <label>File
                                                    <input class="form-control" type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                                </label>
                                                <button  class="btn btn-primary"  v-on:click="submitFile()">Submit</button>
                                            </div>
                                        </div>
                                        <div v-else=""><p>зображення завантажено на сервер</p></div>
                                    </div>
                           </div>
                           <div class="col-lg-7">
                               <div class="row" >
                                   <div class="col-lg-6"><h5>name</h5></div>
                                   <div class="col-lg-6"> <input type="text" v-bind:disabled="show" class="form-control" v-model="name" ></div>
                                </div>
                               <div class="row" >
                                   <div class="col-lg-6"><h5>author</h5></div>
                                   <div class="col-lg-6"> <input type="text" v-bind:disabled="show" class="form-control" v-model="author" ></div>
                               </div>
                               <div class="row" >
                                   <div class="col-lg-6"><h5>count page</h5></div>
                                   <div class="col-lg-6"> <input type="number" v-bind:disabled="show" class="form-control" v-model="count_page" ></div>
                               </div>
                       </div>
                   </div>
                       <br>    <br>
                       <div class="row" >
                           <div class="col-2 offset-5">  <h4 style="text-align: center"> description</h4></div>

                       </div>
                       <div class="row" >
                           <textarea class="form-control" rows="5" v-model="description"  v-bind:disabled="show"></textarea>
                       </div>
                   </div>
                   <div class="modal-footer" v-show="!show">

                       <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="save">Save changes</button>
                   </div>
               </div>
           </div>
       </div>













       <button class="btn btn-primary btn-lg" v-on:click="tuch('new','new','new','new','new')" data-toggle="modal" data-target="#exampleModalCenter">додати книгу</button>

       <br>  <br>    <br>
       <div class="container" style="background-color: #ffc4e2;border-radius: 5px">
           <br>
           <div class="row">
               <div class="col-lg-2 offset-5" style="border-radius: 5px;background-color: #d46fff;text-align: center"><h1>book</h1></div>
           </div>
           <br>
           <div class="row" style="background-color: #ff4cbe">

               <div class="col-lg-2 offset-3" style="text-align: center"><h4>назва</h4></div>
               <div class="col-lg-2" style="text-align: center"><h4>автор</h4></div>
               <div class="col-lg-1" style="text-align: center"><h4>кіл.сторінок</h4></div>
               <div class="col-lg-4" style="text-align: center"><h4>короткий опис</h4></div>

           </div>

           <div class="row showw" v-for="row in books" style="background-color: #ff97a1;margin:1px 0 1px 0; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" v-on:click="tuch(row.name,row.author,row.description,row.name_img,row.count_page)" data-toggle="modal" data-target="#exampleModalCenter">
               <div class="col-lg-2 offset-1"> <img style="width: 100px"    v-bind:src="'/images/min/'+row.name_img"></div>
               <div class="col-lg-2" style="text-align: center"><p>{{row.name}}</p></div>
               <div class="col-lg-2" style="text-align: center"><p>{{row.author}}</p></div>
               <div class="col-lg-1" style="text-align: center"><p>{{row.count_page}}</p></div>
               <div class="col-lg-4" style="text-align: center"><p>{{row.description}}</p></div>
           </div>

       </div>


<br><br><br>
<div class="row">
    <div class="col-4 offset 4"></div>
    <span v-for="row in count_pages" style="margin-left: 10px" v-on:click="run_next_page(row)"> <a href="#" class="button27" >{{row}}</a></span>
</div>

   </div>
</template>

<script>

    import PictureInput from 'vue-picture-input';

    export default {
        props: ['bookss','number_page','count_pagee'],
        components: {
            PictureInput
        },
        data(){
            return {
                file: '',
                name:'',
                author:'',
                description:'',
                name_img:'',
                count_page:'',
                show:false,
                books:[],
                count_pages:[],
                i:1,
                save_show:false,
            }

        },
        methods: {
            run_next_page:function(row){
                window.location.href = '/'+row;
            },
            submitFile(){
                /*
                 Initialize the form data
                 */
                let formData = new FormData();

                /*
                 Add the form data we need to submit
                 */
                formData.append('file', this.file);

                /*
                 Make the request to the POST /single-file URL
                 */
                axios.post( '/priem',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(qq){

                   alert(qq.data);
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            onChange (image) {
                console.log('New picture selected!')
                if (image) {
                    console.log('Picture loaded.')
                    this.image = image
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            },
            tuch:function (name,author,description,name_img,count_page) {

                if(name=='new'){
                        this.show=false;
                        this.name='';
                        this.author='';
                        this.description='';
                        this.name_img='';
                        this.count_page='';
                }else {
                    this.show=true;
                    this.name=name;
                    this.author=author;
                    this.description=description;
                    this.name_img=name_img;
                    this.count_page=count_page;
                }


            },
            save:function () {
                axios.post(`/save`, {
                    name: this.name,
                    author: this.author,
                    description: this.description,
                    name_img: this.name_img,
                    count_page: this.count_page,
                }).then(response => {
                    if(response.data=='new_page'){
                    window.location.href = '/';
                }else {
                    this.books.push(response.data);
                }




            });
            }

        },
        created: function () {
this.books=this.bookss;
for(this.i;this.i<=this.count_pagee;this.i++){
    this.count_pages.push(this.i)
}

        }


    }




</script>
<!-----загрузка картинки------------------------------------>

