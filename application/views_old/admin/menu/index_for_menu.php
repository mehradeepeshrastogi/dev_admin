
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('users'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('users'); ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12"> 
				<?php
				if(!empty($error)){
					echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><ul>".$error."</ul></div>";
				}else if(!empty($success)){
					echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$success."</div>";
				}
				?>
				</div>
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="col-sm-6">
                    <h3 class="box-title"><?php echo trans('user_list'); ?></h3>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!--  Start menu row  -->
                <div class="row">
                    <div class="col-md-6">
                      <div class="card mb-3">
                        <div class="card-header"><h5 class="float-left">Menu</h5>
                          <div class="float-right">
                              <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                  <i class="fa fa-play"></i> Load Data</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <ul id="myEditor" class="sortableLists list-group">
                          </ul>
                        </div>
                      </div>

                        <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Output</button>

                        <textarea id="out" class="form-control" cols="50" rows="10"></textarea>

                    </div>

                      <div class="col-md-6">
                          <div class="panel panel-default mb-3">
                          <div class="panel-head">Edit item</div>
                          <div class="panel-body">
                          <form id="frmEdit" class="form-horizontal">
                        
                              <div class="form-group">
                                  <label for="text">Text</label>
                                  <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                              </div>

                              <div class="form-group">
                                  <label for="href">URL</label>
                                  <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                              </div>
                              <div class="form-group">
                                  <label for="target">Target</label>
                                  <select name="target" id="target" class="form-control item-menu">
                                      <option value="_self">Self</option>
                                      <option value="_blank">Blank</option>
                                      <option value="_top">Top</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="title">Tooltip</label>
                                  <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                              </div>
                          </form>
                          </div>
                          <div class="card-footer">
                          <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                          <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                          </div>
                          </div>

                      </div>

                </div>

              <!-- end menu row -->

           </div>
            <!-- /.box-body -->
          
          </div>
          <!-- /.box -->      
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
