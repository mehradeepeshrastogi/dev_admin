
<?php //dd($categoryList);?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ol class="breadcrumb">
             <li><a href="#" class="catName"></i>Users</a></li>
          </ol>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url($this->controllerName);?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active catName"> Users</li>
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
                    <h3 class="box-title">customer List</h3>
                </div>

                 <div class="col-sm-8">
                   
                    <div class="col-sm-9">
                        <input type="text" class="form-control searchData"  placeholder="Search">
                        <button type="submit" class="btn btn-info" @click="getRecords()"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="col-sm-3" style="padding:0px;">
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
                    <a class="btn btn-success" href="#" @click="addCustomer()" >
                        <span class="fa fa-plus"></span> ADD customer
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
                    <tr v-for="customer in customers">
                        <td class="text-left" v-for="(val,col) in customer" v-if="exception.indexOf(col)==-1">{{val}}</td>
                        <td>
                          <span @click="editCustomer(customer)" class="btn btn-info"><i class="fa fa-pencil-square-o"></i>Edit</span>
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


  <?php require_once "customerModel.php"; ?>

  </div>
  <!-- /.content-wrapper -->