<?php 
//  dd($category);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('category_view');?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('category_view');?></a></li>
      </ol>
      <span style="float:right;margin: 3px 0px 6px 0px;">
        <a href="<?php echo base_url('admin/category');?>" class="btn btn-sm btn-info">
          <span class="fa fa-arrow-left"></span> <?php echo trans('back'); ?> 
        </a>
        <a title="<?php echo trans('edit'); ?> " href="<?php echo base_url('admin/category/edit/'.$id);?>" class="btn btn-sm btn-warning">
            <span class="fa fa-edit"></span>
        </a> 
      </span>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
           
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Category" data-toggle="tab"><?php echo trans('category');?></a></li>
                    <li><a href="#category_image" data-toggle="tab"><?php echo trans('category_image');?></a></li>
                </ul>
            
            <div class="tab-content">
           
                <div class="active tab-pane" id="Category">
                    <div class="row">     
                        <!-- <div class="col-md-6">
                            <img src="<?php //echo $defaultImage;?>" class="img img-thumbnail" width="250" height="250">
                        </div> -->

                        <hr class="hr">
                        <div class="col-md-12">
                              <table class="table table-striped">
                                    <tr>
                                        <th>
                                          <?php echo trans('language');?>
                                        </th>
                                        <th>
                                          <?php echo trans('category');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo $category[$k]->name; ?></td>
                                      </tr>
                                <?php } ?>
                                    </p>
                              </table>
                          </div>

                          <hr class="hr">
                          
                          <div class="col-md-12">
                            <table class="table table-striped">
                               <tr>
                                    <th>Status</th>
                                    <td> 
                                    <?php if($category[0]->active == '1'): ?>
                                        <label class="label label-success"> <?php echo trans('active');?></label>
                                    <?php else: ?>
                                        <label class="label label-danger"> <?php echo trans('inactive');?></label>
                                    <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <hr class="hr">

                       
                            
                          <div class="col-md-12">
                              <table class="table table-striped">
                                    <tr>
                                        <th>
                                          <?php echo trans('language');?>
                                        </th>
                                        <th>
                                          <?php echo trans('category_short_description');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo $category[$k]->description_short; ?></td>
                                      </tr>
                                <?php } ?>
                                    </p>
                              </table>
                          </div>
                      
                        <hr class="hr">

                          <div class="col-md-12">
                              <table class="table table-striped">
                                    <tr>
                                        <th>
                                          <?php echo trans('language');?>
                                        </th>
                                        <th>
                                          <?php echo trans('category_description');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo $category[$k]->description; ?></td>
                                      </tr>
                                <?php } ?>
                                    </p>
                              </table>
                          </div>


                    </div>

                </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="category_image">
              <div class="row">
              
              <?php  /* foreach($languages as $k=>$language){ ?>
                    <tr>
                        <th><?php echo $language->name; ?></th>
                        <td><?php echo $category[$k]->description_short; ?></td>
                    </tr>
              <?php } */ ?>


              <?php foreach($category[0]->categoryImage as $ci){ ?>
                        <div class="col-md-3">
                        <?php if($ci->cover == 1) { ?>
                        <a title="<?php echo trans('cover_image');?>" href="JavaScript:Void(0)" class="btn btn-success deleteImage"><i class="fa fa-star"></i></a>
                        <?php } ?>
                            <img src="<?php echo base_url('uploads/category/'.$ci->image_name);?>" class="img img-thumbnail defaultImage" width="250" height="250">
                            
                        </div>
              <?php }  ?>
                    
              <table class="table table-striped">
              <?php 
                  foreach($languages as $k=>$language){
                    ?>
                    <tr>
                        <td colspan="4">
                          <label><h4><?php echo trans($language->name).' ('.trans('image_caption').')';?></h4></label>
                        </td>
                    </tr>
                    <tr>
                   <?php 
                      for($i=0; $i<count($category[$k]->categoryImage); $i++){
                          if($i%4 == 0){
                              echo "</tr><tr>";
                          }
                       ?>
                        <td class="text-center">
                            <span class=""><?php echo $category[$k]->categoryImage[$i]->categoryImage_name[$k]->name;?></span>
                        </td>
                  <?php } ?>

                  </tr>
                  <?php    
                  } 
               ?>
               </table>
                    </div>
              </div>
              <!-- /.tab-pane -->

              <!-- <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div> -->

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->