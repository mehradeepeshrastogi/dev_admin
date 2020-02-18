
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('user_view');?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo trans('user_view');?></a></li>
      </ol>
      <span style="float:right;margin: 3px 0px 6px 0px;">
        <a href="<?php echo base_url('admin/user');?>" class="btn btn-sm btn-info">
          <span class="fa fa-arrow-left"></span> <?php echo trans('back'); ?> 
        </a>
        <a title="<?php echo trans('edit'); ?> " href="<?php echo base_url('admin/user/edit/'.$id);?>" class="btn btn-sm btn-warning">
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
                    <li class="active"><a href="#user" data-toggle="tab"><?php echo trans('user_details');?></a></li>
                </ul>
            
            <div class="tab-content">
           
                <div class="active tab-pane" id="user">
                    <div class="row">     
                     

                        <hr class="hr">
                        <div class="col-md-6">
                              <table class="table table-striped">
                                    <tr>
                                        <th>
                                          <?php echo trans('name');?>
                                        </th>
                                        <td>
                                            <?php echo $user->name; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                          <?php echo trans('user_name');?>
                                        </th>
                                        <td>
                                            <?php echo $user->user_name; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                          <?php echo trans('user_email');?>
                                        </th>
                                        <td>
                                            <?php echo $user->email; ?>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <th>
                                          <?php echo trans('phone');?>
                                        </th>
                                        <td>
                                            <?php echo $user->phone; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                          <?php echo trans('status');?>
                                        </th>
                                        <td>
                                          <?php if($user->active == '1'): ?>
                                            <label class="label label-success"> <?php echo trans('active');?></label>
                                          <?php else: ?>
                                              <label class="label label-danger"> <?php echo trans('inactive');?></label>
                                          <?php endif; ?>
                                        </td>
                                    </tr>



                              </table>
                        </div>

                        <div class="col-md-6">
                             <img src="<?php echo !empty($user->profile_image)?base_url('uploads/user/'.$user->profile_image):$defaultImage;?>" title="<?php echo $user->name;?>" class="img-thumbnail" style="width:250px;height:250px;object-fit:contain;background: #80808014;" />
                        </div>

                    </div>

                </div>
          
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