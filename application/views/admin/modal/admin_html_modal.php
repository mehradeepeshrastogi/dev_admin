
<div class="content-wrapper">
<link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>css/style.css">


          <div class="col-md-12">
               <div class="col-md-9 post_image_modal_popup">
                  <div class="form-group col-md-2" v-for="(val,col) in images" v-if="exception.indexOf(col)==-1">
                      <label :for="col"><img v-bind:title="val.image_original_name" v-bind:src="val.image_url+'/'+val.image_name" class="post_image" v-on:click="getPostImage(val);"/></label>
                  </div>
               </div>

              <div class="col-md-3">
                 <form v-if="!post_images_form.image_id"></form>
                 <form v-else v-on:submit.prevent="setPostImage">
                      <div class="form-group">
                        <div>
                          <img v-bind:title="post_images_form.image_original_name" v-bind:src="post_images_form.image_full_url" class="img img-thumbnail img-preview" v-on:click="getPostImage(post_images_form);"/>
                        </div>
                        <label>Choose Image Size</label>
                          <select class="form-control" v-modal="post_images_form.image" @change="changeImageSize($event);" >
                              <option v-for="(img_size, index) in image_sizes" :key="index" :value="img_size.image"> {{img_size.size}}</option>   
                          </select>
                        <label>Image URL</label>
                        <input type="text" class="form-control" v-model="post_images_form.image_full_url">
                      </div>
                      <button type="submit" class="btn btn-info">SELECT</button>
                      <button type="button" class="btn btn-danger" v-on:click="deletePostImage(post_images_form);">DELETE PERMANENT</button>
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

<?php 
  get_post_image(true);
?>