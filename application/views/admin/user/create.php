 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('add_user');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('add_user');?></a></li>
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
                      <h3 class="box-title"><?php echo trans('add_user');?></h3>
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
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
           
            <!-- start left -->

              <div class="col-md-9">    

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('name');?>"><?php echo trans('name');?></label>
                        <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="<?php echo trans('name');?>">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('user_name');?>"><?php echo trans('user_name');?></label>
                        <input type="text" class="form-control" name="user_name" value="<?php echo set_value('user_name'); ?>" placeholder="<?php echo trans('user_name');?>">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('phone');?>"><?php echo trans('phone');?></label>
                        <input type="text" class="form-control" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="<?php echo trans('phone');?>">
                        </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('email');?>"><?php echo trans('email');?></label>
                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="<?php echo trans('email');?>">
                        </div>
                  </div>


                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('password');?>"><?php echo trans('password');?></label>
                        <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" placeholder="<?php echo trans('password');?>">
                        </div>
                  </div>
      
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="<?php echo trans('status');?>"><?php echo trans('status');?></label>
                        <select class="form-control" name="active">
                            <option value="1" <?php echo (set_value('active')==1)?'selected':'';?> >
                              <?php echo trans('active');?>
                            </option>
                            <option value="0" <?php echo (set_value('active')==0)?'selected':'';?>><?php echo trans('inactive');?></option> 
                        </select>
                      </div>
                  </div>
              </div> 
                <!-- end left col-md-9 -->
                
                <!-- start right col-md-3 -->
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="<?php echo trans('user_profile_image');?>"><?php echo trans('user_profile_image');?></label>
                              <img src="<?php echo $defaultImage; ?>" class="img img-thumbnail defaultImage" id="previewImage"/>
                              <input type="file" id="selectImage" data-num="1" name="image" class="imageFile">
                          </div>
                      </div>
                </div>
                <!-- end right col-md-3 -->
                  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo trans('submit');?></button>
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
