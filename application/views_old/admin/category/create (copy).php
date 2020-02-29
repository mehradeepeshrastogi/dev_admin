 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                      <h3 class="box-title"><?php echo trans('add_category');?></h3>
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
			
              <div class="box-body">

                  
                  <div class="col-md-2">
                      <div class="form-group">
                        <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                          <?php foreach($languages as $language): ?>
                            <input type="text" class="form-control" value="<?php echo $language->name;?>" readonly >
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
                        <label for="exampleInputFile">Images</label>
                          <br>
                        <div style="over-flow-x:scroll">
                            <table class="table">
                              <tr>
                              </tr>
                            
                              <tr>
                                  <th></th>
                                  <?php
                                  for($i=1; $i<=16;$i++){
                                   
                                  ?>
                                    <td>
                                      <img src="<?php echo $defaultImage; ?>" class="img img-thumbnail defaultImage" id="previewImage<?php echo $i;?>"/>
                                      <input type="file" id="selectImage<?php echo $i;?>" data-num="<?php echo $i; ?>" name="image[]" class="imageFile">
                                      <?php foreach($languages as $k=>$language): ?>
                                          <input title="<?php echo $language->name;?>" type="text" class="form-control" name="image_name[<?php echo $language->lang_id;?>][<?php echo $i-1;?>]"  value="<?php echo set_value('image_name['.$language->lang_id.']['.$i.']'); ?>" placeholder="<?php echo trans('image_title');?>">
                                      <?php endforeach; ?>
                                    
                                   </td>
                                  
                                  <?php 
                                    if($i%4 == 0){
                                        echo "</tr><tr> <th></th>";
                                    }
                                  }
                                  ?>
                              </tr>
                             
                              <?php 
                              foreach($languages as $k=>$language):
                              ?>
                              <tr>
                                    <th><?php echo trans(strtolower($language->name));?></th>
                                    <?php
                                    for($i=1; $i<=4;$i++){
                                    ?>
                                      <td>
                                          <input type="text" class="form-control" name="image_name[<?php echo $language->lang_id;?>][<?php echo $i-1;?>]"  value="<?php echo set_value('image_name['.$language->lang_id.']['.$i.']'); ?>" placeholder="<?php echo trans('image_title');?>">
                                      </td>
                                    <?php 
                                    }
                                    ?>
                              </tr>
                              <?php 
                              endforeach;
                              ?>
                              
                              <tr>
                                  <td></td>
                                <?php
                                for($i=0; $i<=3;$i++){
                                ?>
                                  <td>
                                      <input type="radio" name="cover_image" <?php echo ((set_value('cover_image')== $i))?'checked':($i==0)?'checked':'';?> value="<?php echo $i;?>"> Set as Cover Image
                                  </td>
                                <?php 
                                }
                                ?>
                              </tr>
                            </table>
                        </div>
                      </div>
                  </div>
              
                  <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-group">
                          <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                          <?php foreach($languages as $language): ?>
                            <input type="text" class="form-control" value="<?php echo $language->name;?>" readonly style="height:55px;">
                          <?php endforeach; ?>
                        </div>
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


                
                  <div class="col-md-12" style="margin-left:-15px;">
                        <div class="col-md-2">
                          <label for="<?php echo trans('language');?>"><?php echo trans('language');?></label>
                        </div>
                        <div class="col-md-10">
                            <label for="<?php echo trans('category_description');?>"><?php echo trans('category_description');?></label>
                        </div>
                  </div>

                      
                  <?php foreach($languages as $k=>$language): ?>
                    <div class="col-md-12" style="margin-left:-15px;<?php echo ($k>0)?'margin-top:50px':'';?>" >
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $language->name;?>" readonly style="height:300px;">
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" id="description_<?php echo $language->lang_id;?>" name="description[<?php echo $language->lang_id;?>]" placeholder="<?php echo trans('category_description');?>"><?php echo set_value('description['.$language->lang_id.']'); ?></textarea>
                        </div>
                    </div>
                  <?php endforeach; ?>
                    
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="<?php echo trans('short_order');?>"><?php echo trans('short_order');?></label>
                          <input type="number" min="0" class="form-control" name="short_order" value="<?php echo (!empty(set_value('short_order')))?set_value('short_order'):'0';?>" placeholder="<?php echo trans('short_order');?>">

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
