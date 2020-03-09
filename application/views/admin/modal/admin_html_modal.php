
<div class="content-wrapper">
<link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>css/style.css">


          <div class="col-md-12">
              <div class="col-md-9" id="post_image_modal">
                  <div class="form-group col-md-2" v-for="(val,col) in images" v-if="exception.indexOf(col)==-1">
                     <label :for="col"><img v-bind:title="val.image_original_name" v-bind:src="val.image_url+'/'+val.image_name" class="post_image" v-on:click="getPostImage(val);"/></label>
                  </div>
              </div>
              <div class="col-md-3">
                 <form v-if="!image.image_id">
                  </form>
                 <form v-else>
                    <div class="form-group">
                      <div>
                        <img v-bind:title="image.image_original_name" v-bind:src="image.image_url+'/'+image.image_name" class="img img-thumbnail" v-on:click="getPostImage(image);" style="width: 100%;height: 200px;    object-fit: contain;border: 1px solid gray;"/>
                      </div>
                      <label>Choose Image Size</label>
                        <select class="form-control">
                            <option>800*800</option>
                            <option>600*600</option>
                            <option>400*400</option>
                            <option>200*200</option>
                        </select>
                      <label>Image URL</label>
                      <input type="text" class="form-control" v-model="image.image_url+'/main/'+image.image_name">
                    </div>
                    <button type="button" class="btn btn-info" v-on:click="setImage(image);">SELECT</button>
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

<?php 
  get_post_image(true);
?>