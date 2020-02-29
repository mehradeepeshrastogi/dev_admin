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
          <div class="col-md-12">
              <div class="col-md-9">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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