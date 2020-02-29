<div class="content-wrapper">
<link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>css/style.css">
          <div class="col-md-12">
              <div class="col-md-9" id="post_image_modal">
                  <div class="form-group col-md-2" v-for="(val,col) in images" v-if="exception.indexOf(col)==-1">
                      <label :for="col"><img v-bind:src="val" class="post_image" v-on:click="getPostImage(val);"/></label>
                  </div>
              </div>
              <div class="col-md-3">
                  <form v-if="image!=''">
                      <div class="form-group">
                        <label :for="image_url">Image URL</label>
                        <input type="text" class="form-control" v-model="image">
                      </div>
                      <button type="button" class="btn btn-danger" v-on:click="deletePostImage(image);">DELETE PERMANENT</button>
                  </form>
              </div>
            </div>
</div>
<script>
    var AppConfig = {
        'base_url' : '<?php echo base_url(); ?>',
        'c_name' : '<?php echo $this->class; ?>',
        'm_name' : '<?php echo $this->method; ?>',
        'languages' : '<?php echo json_encode($languages); ?>',
    };
</script>

<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo ADMIN_URL_FILE; ?>js/axios.min.js"></script>
<script src="<?php echo ADMIN_URL_FILE; ?>js/vue.js"></script>

<script type="text/javascript">

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.baseURL = window.location.protocol+"//"+window.location.hostname+'/'+window.location.pathname.split("/")[1]+'/';
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    var app = new Vue({
      el: '.content-wrapper',
      data(){
        return {
          file:'',
          image:'',
          images:[],
          selected_product:'',
          headers:'',
          exception:['id_category','id_product','created_at','updated_at','category','Bestell_Menge']
        }
      },
      mounted: function(){
        this.getPostImages();
      },
      methods:{
        getPostImages:function(){
          var self = this;
          axios.get('admin/post/getPostImages').then(function (response) {
            self.images = response.data;
            console.log(self.images);
            $('#post_images').modal('show');
            // $('.loader').hide();
          }).catch(function (error) {
            console.log(error);
            // $('.loader').hide();
          });
        },
        getPostImage:function(image){
          var self = this;
          self.image = image;
          console.log(self.image);
        },
       
      }
    });
</script>
