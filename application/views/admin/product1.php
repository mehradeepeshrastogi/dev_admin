
<?php //dd($categoryList);?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simple Tables
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Category List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12"> 
				<?php
				if(!empty($error)){
					echo "<div class=' alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><ul>".$error."</ul></div>";
				}else if(!empty($success)){
					echo "<div class=' alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$success."</div>";
				}
				?>
				</div>
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              
               <div class="col-sm-6">
                    <h3 class="box-title">Category List</h3>
                </div>

                <div class="col-sm-4">
                    <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                    
                    <div class="col-sm-3" style="padding:0px;">
                        <button type="button" class="btn btn-info">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                </div>
                
               <div class="col-sm-2">
                    <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/addcategory');?>">
                        <span class="fa fa-plus"></span>
                    </a> 
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered  table-fixed">
                  <thead>
                <tr>
                    <th style="width: 50px;">
                    S.No.
                    </th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php 
                  foreach($categoryList as $key=>$category){ 
                ?>
                <tr>
                  <td><?php echo $key+1;?></td>
                 
                  <td><?php echo $category->name; ?></td>
                  <td>
                    <a href="<?php echo base_url($this->controllerName.'/product/'.$category->id_category);?>" class="btn btn-primary"><span class="fa fa-eye"></span></a>
                    <a href="" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->      
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
