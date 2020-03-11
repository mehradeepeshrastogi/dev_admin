 <!-- Modal -->
  <div class="modal" id="post_images" role="dialog">
    <div class="modal-dialog modal-xlg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <!-- <div class="col-md-2">
              <div id="clbk" class="demo"></div>
          </div> -->
          <div class="col-md-12">

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#AllImages" data-toggle="tab"><?php echo trans('images');?></a></li>
                    <li><a href="#uploadImages" data-toggle="tab"><?php echo trans('upload_images');?></a></li>
                </ul>
              </div>

          <div class="col-md-12">
            <div class="box-body">
                <!-- start tab content-->
                  <div class="tab-content">
                      <!-- start category tab section -->
                      <div class="active tab-pane" id="AllImages" >

                            <div class="col-md-9 post_image_modal_popup">
                                <div class="form-group col-md-2" v-for="(val,col) in images" v-if="exception.indexOf(col)==-1">
                                    <label :for="col"><img v-bind:title="val.image_original_name" v-bind:src="val.image_url+'/'+val.image_name" class="post_image" v-on:click="getPostImage(val);"/></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <form v-if="!post_images_form.image_id">
                                </form>
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

                        <div class="tab-pane" id="uploadImages">
                          <form id="upload_images"  method="POST" enctype="multipart/form-data">
                           <div class="col-md-9 post_image_modal_popup">
                             <div class="form-group">
                                <label>Image URL</label>
                                <input type="hidden" name="width" value="800">
                                <input type="hidden" name="height" value="800">
                                <input type="file" class="post_file" name="image[]" multiple="" required="">
                              </div>
                               <button type="submit" class="btn btn-info">UPLOAD</button>
                            </div>
                          </form>
                        </div> 

                    </div> <!-- tab-content -->
              </div> <!-- end box body -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </div> <!-- col-md-9-->
      </div>
      
    </div>
  </div>


<!-- Modal -->
<!-- <div class="modal" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Create Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height:auto;overflow: hidden;">
        <div class="form-group col-md-6" v-for="(val,col) in selected_customer" v-if="exception.indexOf(col)==-1">
          <label :for="val">{{col}}</label>
          <input type="text" class="form-control" v-model="selected_customer[col]">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="createCustomer()">Save</button>
      </div>
    </div>
  </div>
</div> -->
<!-- Modal -->