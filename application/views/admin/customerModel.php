<!-- Modal -->
<div class="modal" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div>
<!-- Modal -->


<!-- Modal -->
<div class="modal" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Modify Customer</h4>
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
        <button type="button" class="btn btn-primary" @click="updateRecord()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
