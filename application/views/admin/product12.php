

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
        <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
			
            <div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
					  <label for="exampleInputEmail1">Category</label>
					  <select class="form-control" id="">
						<option>Home</option>
						<option>About</option>
					 </select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="exampleInputEmail1">Product Name</label>
					  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
					 <label for="exampleInputFile">Images</label>
					  <input type="file" id="exampleInputFile" name="images[]" multiple>
					  <br>
					  <div style="over-flow-x:scroll">
						<table class="table">
							<tr>
								<td><img src="https://auto.ndtvimg.com/bike-images/colors/tvs/apache-rtr-160-4v/tvs-apache-rtr-160-4v-red.png?v=1" class="img img-thumbnail" style="width: 200px;"/></td>
								<td><img src="https://auto.ndtvimg.com/bike-images/colors/tvs/apache-rtr-160-4v/tvs-apache-rtr-160-4v-red.png?v=1" class="img img-thumbnail" style="width: 200px;"/></td>
								<td><img src="https://auto.ndtvimg.com/bike-images/colors/tvs/apache-rtr-160-4v/tvs-apache-rtr-160-4v-red.png?v=1" class="img img-thumbnail" style="width: 200px;"/></td>
								<td><img src="https://auto.ndtvimg.com/bike-images/colors/tvs/apache-rtr-160-4v/tvs-apache-rtr-160-4v-red.png?v=1" class="img img-thumbnail" style="width: 200px;"/></td>
							</tr>
							<tr>
								<td><input type="radio" name="cover_image"> Set as Cover Image</td>
								<td><input type="radio" name="cover_image"> Set as Cover Image</td>
								<td><input type="radio" name="cover_image"> Set as Cover Image</td>
								<td><input type="radio" name="cover_image"> Set as Cover Image</td>
							</tr>
						</table>
						 
						 
					  </div>
					  
					  
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="exampleInputEmail1">Language</label>
						<select class="form-control" id="">
							<option>English</option>
							<option>Hindi</option>
						</select> 
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="exampleInputEmail1">Active</label>
						<select class="form-control" id="">
							<option>Yes</option>
							<option>No</option>
						</select> 
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="exampleInputFile">Description Short</label>
						<textarea id="description_short" name="editor1" rows="10" cols="80" placeholder="Description">
							This is my textarea to be replaced with CKEditor.
						</textarea>
					</div>
				</div>  
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="exampleInputFile">Description</label>
						<textarea id="description" name="editor1" rows="10" cols="80" placeholder="Description">
							This is my textarea to be replaced with CKEditor.
						</textarea>
					</div>
				</div>   
				
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="exampleInputEmail1">Meta Title</label>
					  <input type="text" class="form-control" id="" placeholder="Meta Title">
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="">Slug</label>
					  <input type="text" class="form-control" id="" placeholder="Slug">
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
					  <label for="exampleInputEmail1">Meta Keyword</label>
					  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Meta Keyword">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="exampleInputPassword1">Meta Description</label>
					  <textarea class="form-control" placeholder="Meta Description" rows="5"></textarea>
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
