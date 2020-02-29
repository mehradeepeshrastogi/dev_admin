
<?php //dd($categoryList);?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ol class="breadcrumb">
             <li><a href="#" class="catName"></i><?php echo $categoryName; ?></a></li>
          </ol>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url($this->controllerName);?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active catName"><?php echo $categoryName; ?></li>
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
              
               <div class="col-sm-2">
                    <h3 class="box-title">Product List</h3>
                </div>

                 <div class="col-sm-8">
                    <div class="col-sm-6">
                         <select class="form-control" id="id_category" name="id_category">
                          <?php 
                          foreach ($categoryList as $key => $category) {
                          ?>
                            <option value="<?php echo $category['id_category']; ?>"><?php echo $category['name']; ?></option>
                          <?php
                          }
                          ?>
                         </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control searchData"  placeholder="Search">
                        <button type="submit" class="btn btn-info" @click="getRecords()"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="col-sm-2" style="padding:0px;">
                        <select v-model="pagination.per_page" class="form-control">
                          <option value="10">10 Records</option>
                          <option value="20">20 Records</option>
                          <option value="50">50 Records</option>
                          <option value="100">100 Records</option>
                          <option value="200">200 Records</option>
                        </select>
                     </div>
                    
                </div>

          
                
               <div class="col-sm-2">
               <p>
                    <a class="btn btn-success" href="#" @click="addProduct()" >
                        <span class="fa fa-plus"></span> ADD PRODUCT
                    </a></p> 
                </div>
            </div>


                
                  
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered  table-fixed table-striped">
                  <thead>
                    <tr>
                        <th class="text-left" scope="row" v-for="(head,ihead) in headers" v-if="exception.indexOf(head)==-1">{{head}} </th>
                        <th>EDIT</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <tr v-for="product in products">
                        <td class="text-left" v-for="(val,col) in product" v-if="exception.indexOf(col)==-1">{{val}}</td>
                        <td>
                          <span @click="editRecord(product)" class="btn btn-info"><i class="fa fa-pencil-square-o"></i>Edit</span>
                        </td>
                    </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li v-if="pagination.current_page > 1">
                  <a href="#" @click.prevent="changePage(pagination.current_page - 1)">&laquo;</a>
                </li>
                <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">  <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
                </li>
               
                <li v-if="pagination.current_page < pagination.last_page">
                  <a href="#" @click.prevent="changePage(pagination.current_page + 1)">&raquo;</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.box -->      
      </div>
    
    </section>
    <!-- /.content -->


  <?php require_once "productModel.php"; ?>

  </div>
  <!-- /.content-wrapper -->