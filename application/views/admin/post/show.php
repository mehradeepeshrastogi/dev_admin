
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('page_view');?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('page_view');?></a></li>
      </ol>
      <span style="float:right;margin: 3px 0px 6px 0px;">
        <a href="<?php echo $back_action;?>" class="btn btn-sm btn-info">
          <span class="fa fa-arrow-left"></span> <?php echo trans('back'); ?> 
        </a>
        <a title="<?php echo $title; ?> " href="<?php echo $edit_post;?>" class="btn btn-sm btn-warning">
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
                    <li class="active"><a href="#page" data-toggle="tab"><?php echo trans('page');?></a></li>
                </ul>
            
            <div class="tab-content">
           
                <div class="active tab-pane" id="page">
                    <div class="row">     
                    
                        <hr class="hr">
                        <div class="col-md-12">
                              <table class="table table-striped">
                                    <tr>
                                        <th>
                                          <?php echo trans('language');?>
                                        </th>
                                        <th>
                                          <?php echo trans('page');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo @$post[$k]->name; ?></td>
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
                                    <?php if($post[0]->active == '1'): ?>
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
                                          <?php echo trans('page_short_description');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo @$post[$k]->description_short; ?></td>
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
                                          <?php echo trans('page_description');?>
                                        </th>
                                    </tr>
                                <?php foreach($languages as $k=>$language){ ?>
                                      <tr>
                                          <th><?php echo trans($language->name); ?></th>
                                          <td><?php echo @$post[$k]->description; ?></td>
                                      </tr>
                                <?php } ?>
                                    </p>
                              </table>
                          </div>


                    </div>

                </div>
           

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