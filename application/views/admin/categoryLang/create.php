 <!-- Content Wrapper. Contains category content -->
 <div class="content-wrapper">
    <!-- Content Header _category header) -->
    <section class="content-header">
      <h1><?php echo trans('add_category');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('add_category');?></a></li>
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
                      <h3 class="box-title"><?php echo trans('add_page');?></h3>
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

                  
            


                  
                        
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="<?php echo trans('category_name');?>"><?php echo trans('category_name');?></label>
                       
                            <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" placeholder="<?php echo trans('category_name');?>">

                      </div>
                  </div>

                
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="<?php echo trans('status');?>"><?php echo trans('status');?></label>
                        <select class="form-control" name="lang_id">
                            <option value="1" <?php echo (set_value('lang_id')==1)?'selected':'';?> >
                              <?php echo trans('active');?>
                            </option>
                            <option value="0" <?php echo (set_value('lang_id')==0)?'selected':'';?>><?php echo trans('inactive');?></option> 
                        </select>
                      </div>
                  </div>
                  
            


                      
                 
                    <div class="col-md-12">
                        <label for="<?php echo trans('description');?>"><?php echo trans('description');?></label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="<?php echo trans('category_description');?>"><?php echo set_value('description'); ?></textarea>
                    </div>
                 
                    </div>
              <!-- /.box-body --> 
                  
                 

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="float:right"><?php echo trans('submit');?></button>
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
