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
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
           
            <!-- start left -->

              <div class="col-md-6">    

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="<?php echo trans('category');?>"><?php echo trans('name');?></label>
                        <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="<?php echo trans('name');?>">
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
                  <?php if(!empty($category_data)){ ?>
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="<?php echo trans('category');?>"><?php echo trans('category');?></label>
                        <?php foreach($category_data as $category){ ?>
                          <br>
                          <input type="checkbox" value="<?php echo $category['category_id'];?>" name="category_id"> <?php echo $category['name'];?>
                        <?php } ?>
                        </div>
                  </div>
                  <?php } ?>


                  <?php if(!empty($page_data)){ ?>
                   <div class="col-md-12">
                      <div class="form-group">
                        <label for="<?php echo trans('page');?>"><?php echo trans('page');?></label>
                        <?php foreach($page_data as $page){ ?>
                          <br>
                          <input type="checkbox" value="<?php echo $page['page_id'];?>" name="page_id"> <?php echo $page['name'];?>
                        <?php } ?>
                        </div>
                  </div>
                  <?php } ?>

                  <?php if(!empty($post_data)){ ?>
                  <div class="col-md-12">
                      <div class="form-group">
                        <label for="<?php echo trans('post');?>"><?php echo trans('post');?></label>
                        <?php foreach($post_data as $post){ ?>
                          <br>
                          <input type="checkbox" value="<?php echo $post['post_id'];?>" name="post_id"> <?php echo $post['name'];?>
                        <?php } ?>
                        </div>
                  </div>
                <?php } ?>
      

              </div> 
                
                  
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
