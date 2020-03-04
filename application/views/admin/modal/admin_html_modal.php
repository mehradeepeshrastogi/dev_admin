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

<?php 
  get_post_image(true);
?>