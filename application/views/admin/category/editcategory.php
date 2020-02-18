 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url($this->controllerName); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Update Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
				<?php
				if(!empty($error)){
					echo "<div class=' alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$error."</div>";
				}else if(!empty($success)){
					echo "<div class=' alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$success."</div>";
				}
				?>
		</div>

        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="box-header with-border">
              <!-- <h3 class="box-title">Add Category</h3> -->
                <div class="col-sm-6">
                    <h3 class="box-title">Edit Category</h3>
                </div>

                <div class="col-sm-4">
                   
                </div>
                
               <div class="col-sm-2">
                    <a class="btn btn-primary" href="<?php echo base_url($this->controllerName.'/category');?>">
                        <span class="fa fa-arrow-left"> BACK</span>
                    </a> 
                </div>
            </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
			
            <div class="box-body">
				<div class="col-md-4">
					<div class="form-group">
						<label for="categoryName">Category Name</label>
						<input type="text" class="form-control" name="name" value="<?php echo $category->name; ?>" placeholder="Category Name">
						
					</div>
				</div>
			</div>
              <!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			
            </form>
          </div>
          <!-- /.box -->

          
          </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
