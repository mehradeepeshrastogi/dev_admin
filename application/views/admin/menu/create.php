 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('add_menu');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('add_menu');?></a></li>
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
                  <div class="col-sm-6">
                      <h3 class="box-title"><?php echo trans('add_menu');?></h3>
                  </div>

                  <div class="col-sm-4">
                  </div>
                  
                  <div class="col-sm-2">
                      <a class="btn btn-primary" href="<?php echo $back_action;?>">
                          <span class="fa fa-arrow-left"> <?php echo trans('back');?></span>
                      </a> 
                  </div>
              </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
            <div class="col-md-4">    
                <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
               <?php /* <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
               */
               ?>

                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('category');?>"><?php echo trans('name');?></label>
                            <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="<?php echo trans('name');?>">
                            </div>
                      </div>


                   
                      <?php if(!empty($category_data)){ ?>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('category');?>"><?php echo trans('category');?></label>
                            <select class="form-control multi_select_option" name="post_ids[]" multiple placeholder="Select Category">
                              <?php foreach($category_data as $category){ 
                                $select = "";
                                $post_ids = set_value("post_ids");
                                if(in_array($category['post_id'], $post_ids)){
                                   $select = "selected";
                                }
                              ?>
                                <option <?php echo $select;?> value="<?php echo $category['post_id'];?>"> <?php echo $category['name'];?></option>
                              <?php } ?>
                            </select>
                            </div>
                      </div>
                      <?php } ?>


                      <?php if(!empty($page_data)){ ?>
                       <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('page');?>"><?php echo trans('page');?></label>
                             <select class="form-control multi_select_option" name="post_ids[]" multiple placeholder="Select page">
                              <?php foreach($page_data as $page){ 
                                $select = "";
                                $post_ids = set_value("post_ids");
                                if(in_array($page['post_id'], $post_ids)){
                                   $select = "selected";
                                }
                                ?>
                                <option <?php echo $select;?>  value="<?php echo $page['post_id'];?>"> <?php echo $page['name'];?></option>
                              <?php } ?>
                           </select>
                            </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($post_data)){ ?>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('post');?>"><?php echo trans('post');?></label>
                              <select class="form-control multi_select_option" name="post_ids[]" multiple placeholder="Select post">
                                <?php foreach($post_data as $post){ 
                                    $select = "";
                                    $post_ids = set_value("post_ids");
                                    if(in_array($post['post_id'], $post_ids)){
                                       $select = "selected";
                                    }
                                ?>
                                  <option <?php echo $select;?> value="<?php echo $post['post_id'];?>"> <?php echo $post['name'];?></option>
                                <?php } ?>
                            </select>
                            </div>
                      </div>
                    <?php } ?>
          

                
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><?php echo trans('submit');?></button>
                  </div>
    			
                </form>
              </div> <!-- / col-md-4 -->
              <?php 
              if(!empty($menu_data)){
              ?>
               <div class="col-md-8">    
                <form role="form" action="<?php echo $menu_form_action; ?>" method="POST" enctype="multipart/form-data">
                  <?php /*
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    */
                    ?>

                      <div class="col-md-6">
                          <div class="form-group">
                            <ul class="list-group">
                              <?php 
                              foreach($menu_data as $menu){
                              ?>
                                <li class="list-group-item" id="<?php echo $menu["post_id"];?>"><?php echo $menu["name"];?></li>
                              <?php 
                              }
                              ?>
                            </ul>  
                          </div>
                      </div>
                </form>
              </div> <!-- / col-md-8 -->

              <?php 
              }
              ?>



                    
                      
              </div> <!-- /box-body -->

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
