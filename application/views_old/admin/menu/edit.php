 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('edit_menu');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('edit_menu');?></a></li>
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
                      <h3 class="box-title"><?php echo trans('edit_menu');?></h3>
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
            <div class="col-md-3">    
                <form  id="create_menu" role="form" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
                      <?php 
                      $menu_name = "";
                      if(!empty($menu->name) || !empty(set_value('name'))){
                        $menu_name = !empty(set_value('name'))?set_value('name'):$menu->name;
                      }
                      ?>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('category');?>"><?php echo trans('name');?></label>
                            <input type="text" class="form-control" name="name" value="<?php echo $menu_name;?>" placeholder="<?php echo trans('name');?>">
                            </div>
                      </div>


                   
                      <?php if(!empty($category_data)){ ?>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label for="<?php echo trans('category');?>"><?php echo trans('category');?></label>
                            <select class="form-control multi_select_option" name="post_ids[]" multiple placeholder="Select Category">
                              <?php foreach($category_data as $category){ 
                                $select = "";
                                $post_ids = $post_ids;
                                if(!empty($post_ids) && in_array($category['post_id'], $post_ids)){
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
                                 $post_ids = $post_ids;
                                if(!empty($post_ids) && in_array($page['post_id'], $post_ids)){
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
                                     $post_ids = $post_ids;
                                    if(!empty($post_ids) && in_array($post['post_id'], $post_ids)){
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
                    <button type="submit" class="btn btn-primary">Create Menu<?php //echo trans('submit');?></button>
                  </div>
          
                </form>
            </div> <!-- / col-md-4 -->
              <?php 
              if(!empty($menu_data)){
              ?>
               <div class="col-md-9">    
              
                    <!--  Start menu row  -->
                    <div class="row">
                        <div class="col-md-8">
                          <div class="card mb-3">
                            <div class="card-header"><h5 class="float-left">Menu</h5>
                              <div class="float-right">
                                  <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                      <i class="fa fa-play"></i> Load Data</button>
                              </div>
                            </div>
                            <div class="card-body">
                              <ul id="myEditor" class="sortableLists list-group">
                              </ul>
                            </div>
                          </div>

                            <form id="menu_form_data" action="<?php echo $menu_form_action;?>" method="POST">
                              <label for="Menu Name">Menu Name</label>
                              <input class="form-control" type="text" value="<?php echo $menu_name;?>" name="name">
                              <br>
                              <input type="hidden" value="<?php echo !empty($menu->lang_id)?$menu->lang_id:$this->lang_id;?>" name="lang_id">
                              <textarea style="display: none;" id="out" name="menu_description" class="form-control" cols="50" rows="10"><?php echo !empty($menu->menu_description)?$menu->menu_description:'';?></textarea>
                              <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Save menu</button>
                            </form>

                        </div>

                          <div class="col-md-4">
                              <div class="panel panel-default mb-3">
                              <div class="panel-head">Edit item</div>
                              <div class="panel-body">
                              <form id="frmEdit" class="form-horizontal">
                            
                                  <div class="form-group">
                                      <label for="text">Text</label>
                                      <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                  </div>

                                  <div class="form-group">
                                      <label for="href">URL</label>
                                      <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                  </div>
                                  <div class="form-group">
                                      <label for="target">Target</label>
                                      <select name="target" id="target" class="form-control item-menu">
                                          <option value="_self">Self</option>
                                          <option value="_blank">Blank</option>
                                          <option value="_top">Top</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="title">Tooltip</label>
                                      <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                  </div>
                              </form>
                              </div>
                              <div class="card-footer">
                              <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                              <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              </div>

                          </div>

                    </div>

                  <!-- end menu row -->
              </div> <!-- / col-md-9 -->

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
