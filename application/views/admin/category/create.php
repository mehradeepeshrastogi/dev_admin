 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('add_category');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $title;?></a></li>
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
                      <h3 class="box-title"><?php echo $title;?></h3>
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


            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Category" data-toggle="tab"><?php echo trans('category');?></a></li>
                </ul>
            </div>

            <!-- form start -->
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <!-- box body start -->

              <div class="box-body">
                  
                  <!-- start tab content-->
                <div class="tab-content">

                  <!-- start category tab section -->
                  <div class="active tab-pane" id="Category">

                    <!-- category name section -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                              <?php foreach($languages as $language): ?>
                                <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly >
                              <?php endforeach; ?>
                            </div>
                      </div>
                            
                      <div class="col-md-10">
                        <div class="form-group">
                            <label for="<?php echo trans('category_name');?>"><?php echo trans('category_name');?></label>
                            <?php foreach($languages as $k=>$language): ?>
                                <input type="text" class="form-control" name="name[<?php echo $language->lang_id;?>]" value="<?php echo set_value('name['.$language->lang_id.']'); ?>" placeholder="<?php echo trans('category_name');?>">
                            <?php endforeach; ?>

                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="<?php echo trans('slug');?>"><?php echo trans('slug');?>:</label>
                               <?php foreach($languages as $k=>$language): ?>
                              <span style="display: block;"><?php echo base_url();?><input type="text" class="form-control" name="slug[<?php echo $language->lang_id;?>]" value="<?php echo set_value('slug['.$language->lang_id.']'); ?>" placeholder="<?php echo trans('slug');?>" style="width: 77.7%;display: inline-block;">
                              </span>
                               <?php endforeach; ?>

                          </div>
                      </div>


                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="<?php echo trans('short_order');?>"><?php echo trans('short_order');?></label>
                              <input type="number" min="0" class="form-control" name="short_order" value="<?php echo (!empty(set_value('short_order')))?set_value('short_order'):'0';?>" placeholder="<?php echo trans('short_order');?>">

                          </div>
                      </div>

                   <!-- end category name section -->

                     <!-- start category status section -->

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

                      <!-- end category status section -->

                       <!-- start category_short_description section -->

                        <div class="col-md-2">
                            <div class="form-group">
                              <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                                <?php foreach($languages as $language): ?>
                                  <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly style="height:55px;">
                                <?php endforeach; ?>
                            </div>
                        </div>
                          
                        <div class="col-md-10">
                            <div class="form-group">
                                  <label for="<?php echo trans('category_short_description');?>"><?php echo trans('category_short_description');?></label>
                                  <?php foreach($languages as $language): ?>
                                      <textarea type="text" class="form-control" name="description_short[<?php echo $language->lang_id;?>]" placeholder="<?php echo trans('category_short_description');?>"><?php echo set_value('description_short['.$language->lang_id.']'); ?></textarea>
                                  <?php endforeach; ?>
                            </div>
                        </div>
                      
                        <!-- end category_short_description section -->

                    </div>  
                    <!-- end category tab section -->

               
                    <!-- start category_short_description tab -->

                  </div>  <!-- end tab-content-->  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary float-right"><?php echo trans('submit');?></button>
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
