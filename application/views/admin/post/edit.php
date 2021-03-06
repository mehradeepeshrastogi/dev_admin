 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $title;?></h1>
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
        <div class="col-md-9">
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
                    <li class="active"><a href="#Page" data-toggle="tab"><?php echo trans('page');?></a></li>
                    <li><a href="#DescriptionShort" data-toggle="tab"><?php echo trans('short_description');?></a></li>
                    <li><a href="#Description" data-toggle="tab"><?php echo trans('description');?></a></li>
                    <li><a href="#MetaDescription" data-toggle="tab"><?php echo trans('meta_description');?></a></li>
                </ul>
            </div>


            <!-- form start -->
            <form role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="post_image" id="post_image" value="<?php echo $post[0]->post_image;?>">
          
              <div class="box-body">
                <!-- start tab content-->
                <div class="tab-content">

                <!-- start category tab section -->
                  <div class="active tab-pane" id="Page">

                  
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
                    <label for="<?php echo trans('page_name');?>"><?php echo trans('page_name');?></label>
                    <?php foreach($languages as $k=>$language): ?>
                    <input type="text" class="form-control" name="name[<?php echo $language->lang_id;?>]" value="<?php echo $post[$k]->name; ?>" placeholder="<?php echo trans('page_name');?>">
                    <?php endforeach; ?>

                    </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="<?php echo trans('slug');?>"><?php echo trans('slug');?>:</label>
                      <?php foreach($languages as $k=>$language): ?>
                      <span style="display: block;"><?php echo base_url();?><input type="text" class="form-control slug-form-control" name="slug[<?php echo $language->lang_id;?>]" value="<?php echo $post[$k]->slug; ?>" placeholder="<?php echo trans('slug');?>">
                      </span>
                      <?php endforeach; ?>

                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="<?php echo trans('short_order');?>"><?php echo trans('short_order');?></label>
                    <input type="number" min="0" class="form-control" name="short_order" value="<?php echo $post[0]->short_order;?>" placeholder="<?php echo trans('short_order');?>">

                    </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="<?php echo trans('status');?>"><?php echo trans('status');?></label>
                      <select class="form-control" name="active">
                      <option value="1" <?php echo ($post[0]->active == 1)?'selected':'';?> >
                      <?php echo trans('active');?>
                      </option>
                      <option value="0" <?php echo ($post[0]->active == 0)?'selected':'';?>><?php echo trans('inactive');?></option> 
                      </select>
                    </div>
                    </div>
                </div>

                  <div class="tab-pane" id="DescriptionShort">
                       <div class="col-md-10">
                            <div class="form-group">
                                  <label for="<?php echo trans('category_short_description');?>"><?php echo trans('category_short_description');?></label>
                                  <?php foreach($languages as $k=>$language): ?>
                                      <textarea type="text" class="form-control" name="description_short[<?php echo $language->lang_id;?>]" placeholder="<?php echo trans('category_short_description');?>"><?php echo $post[$k]->description_short; ?></textarea>
                                  <?php endforeach; ?>
                            </div>
                        </div>
                  </div>


                  <div class="tab-pane" id="Description">
                      <?php foreach($languages as $k=>$language): ?>
                    <div class="col-md-12" style="margin-left:-15px;<?php echo ($k>0)?'margin-top:50px':'';?>" >
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly style="height:300px;">
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" id="description_<?php echo $language->lang_id;?>" name="description[<?php echo $language->lang_id;?>]" placeholder="<?php echo trans('page_description');?>"><?php echo $post[$k]->description; ?></textarea>
                        </div>
                    </div>
                  <?php endforeach; ?>

                  </div>


                    <div class="tab-pane" id="MetaDescription">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                          <?php foreach($languages as $k=>$language): ?>
                            <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <div class="col-md-10">
                          <div class="form-group">
                                <label for="<?php echo trans('meta_title');?>"><?php echo trans('meta_title');?></label>
                                <?php foreach($languages as $language): ?>
                                    <input type="text" class="form-control" name="meta_title[<?php echo $language->lang_id;?>]" value="<?php echo $post[$k]->meta_title; ?>" placeholder="<?php echo trans('meta_title');?>">
                                <?php endforeach; ?>
                          </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                          <?php foreach($languages as $k=>$language): ?>
                            <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <div class="col-md-10">
                            <div class="form-group">
                                  <label for="<?php echo trans('meta_keyword');?>"><?php echo trans('meta_keyword');?></label>
                                  <?php foreach($languages as $language): ?>
                                      <input type="text" class="form-control" name="meta_keyword[<?php echo $language->lang_id;?>]" value="<?php echo $post[$k]->meta_keyword; ?>" placeholder="<?php echo trans('meta_keyword');?>">
                                  <?php endforeach; ?>
                            </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                          <?php foreach($languages as $k=>$language): ?>
                            <input type="text" class="form-control" value="<?php echo trans($language->name);?>" readonly style="height:50px;">
                          <?php endforeach; ?>
                        </div>
                      </div>
                       <div class="col-md-10">
                            <div class="form-group">
                                  <label for="<?php echo trans('meta_description');?>"><?php echo trans('meta_description');?></label>
                                  <?php foreach($languages as $language): ?>
                                      <textarea type="text" class="form-control" name="meta_description[<?php echo $language->lang_id;?>]" placeholder="<?php echo trans('meta_description');?>"><?php echo $post[$k]->meta_description; ?></textarea>
                                  <?php endforeach; ?>
                            </div>
                        </div>
                  </div> <!-- end meta description-->


                  
              </div>

                </div>  <!-- end tab-content-->  
              <!-- /.box-body -->


              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo trans('submit');?></button>
              </div>
      
            </form>

          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->

          <!-- right column -->
        <div class="col-md-3">
            <?php feature_image_html();?>
        </div>
        <!--/.col (right) -->
      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
