<!-- Modal -->
<div class="modal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Create Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height:auto;overflow: hidden;">
        <div class="form-group col-md-6" v-for="(val,col) in selected_product" v-if="exceptionEdit.indexOf(col)==-1">
          <label :for="val">{{col}}</label>
          <select v-if="col=='category'" class="form-control" v-model="selected_product.category.selected" required>
          <option value="">Select Category</option>
            <option v-for="cat in selected_product.category.option" v-bind:value="cat.id_category">{{cat.name}}</option>
          </select>
          <input  v-if="col!='category'" type="text" class="form-control" v-model="selected_product[col]">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="createProduct()">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<!-- Modal -->
<div class="modal" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Modify Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height:auto;overflow: hidden;">
         <div class="form-group col-md-6" v-for="(val,col) in selected_product" v-if="exceptionEdit.indexOf(col)==-1">
            <label :for="val">{{col}}</label>
            <select v-if="col=='category'" class="form-control" v-model="selected_product.category.selected">
              <option v-for="cat in selected_product.category.option" v-bind:value="cat.id_category">{{cat.name}}</option>
            </select>
            <input  v-if="col!='category'" type="text" class="form-control" v-model="selected_product[col]">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="updateRecord()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


