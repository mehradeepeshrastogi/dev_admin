 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Category
        <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Add Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
				<?php
				if(!empty($error)){
					echo "<div class=' alert alert-danger'><ul>".$error."</ul></div>";
				}else if(!empty($success)){
					echo "<div class=' alert alert-success'>".$success."</div>";
				}
				?>
				</div>

        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
			
            <div class="box-body">
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputEmail1">Parent Category</label>
											<select class="form-control" name="id_parent">
												<option value="0">No Parent</option>
												<?php
												foreach($categories as $category){
													?>
													<option value="<?php echo $category->id_category; ?>"><?php echo $category->name; ?></option>
												<?php
												} 
												?>
											</select>
										</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label for="categoryName">Category Name</label>
										<input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name">
										
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputEmail1">Active</label>
										<select class="form-control" id="" name="active">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select> 
									</div>
								</div>
							

								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputFile" style="display:block;">Image</label>
										
									<img src="<?php echo $defaultImage; ?>" class="img img-thumbnail" id="previewImage" style="width: 285px;height:175px;object-fit:contain;cursor:pointer;"/>
									<input type="file" id="selectImage" name="image" style="cursor: pointer;width: 100%;height: 174px;margin-top: -174px;z-index: 99999999999999; opacity: 0;height:height: 174px;">

									</div>
								</div>
				
							
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputFile">Description</label>
										<textarea class="description"  name="description" id="description" rows="10" cols="80" placeholder="Description"><?php ?></textarea>
									</div>
								</div>   
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Meta Title</label>
										<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Slug</label>
										<input type="text" name="slug" class="form-control" id="" placeholder="Slug">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Meta Keyword</label>
										<input type="text" class="form-control" name="meta_keyword" id="exampleInputEmail1" placeholder="Meta Keyword">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputPassword1">Meta Description</label>
											<textarea name="meta_description" class="form-control" placeholder="Meta Description" rows="5"></textarea>
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
