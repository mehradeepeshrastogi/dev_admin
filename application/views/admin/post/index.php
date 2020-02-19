
<!-- Content Wrapper. Contains post content -->
<div class="content-wrapper">
    <!-- Content Header (post header) -->
    <section class="content-header">
      <h1><?php echo $title; ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12"> 
				<?php
				if(!empty($error)){
					echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><ul>".$error."</ul></div>";
				}else if(!empty($success)){
					echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$success."</div>";
				}
				?>
				</div>
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              
               <div class="col-sm-6">
                    <h3 class="box-title"><?php echo trans($title.'_list'); ?></h3>
                </div>

                <div class="col-sm-4">
                  <form action="<?php echo $form_action; ?>" method="GET">
                      <div class="col-sm-9">
                          <input type="text" class="form-control" value="<?php echo $search; ?>" name="search" placeholder="<?php echo trans('search'); ?>" required >
                      </div>
                      
                      <div class="col-sm-3" style="padding:0px;">
                          <button type="submit" class="btn btn-info">
                              <span class="fa fa-search"></span>
                          </button>
                          <a href="<?php echo $form_action;?>" style="float:right;"  class="btn btn-success">
                              <span class="fa fa-refresh"></span>
                          </a>
                      </div>
                  </form>
                </div>
                
               <div class="col-sm-2">
                    <a class="btn btn-success" href="<?php echo $add_post; ?>">
                        <span class="fa fa-plus"><?php echo $add_post_title; ?></span>
                    </a> 
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered  table-fixed">
                  <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th><?php echo trans('post_name'); ?></th>
                    <th><?php echo trans('post_slug'); ?></th>
                    <th><?php echo trans('status'); ?></th>
                    <th><?php echo trans('action'); ?></th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php 
                if(!empty($results)){
                  foreach($results as $key=>$post){ 
                ?>
                    <tr>
                      <td><?php echo $post->post_id; ?></td>
                     
                      <td><?php echo $post->name; ?></td>
                      <td><?php //echo $post->slug; ?></td>
                      <td>
                        <form action="<?php echo base_url($this->controllerFor.'/post/updateStatus');?>" method="post">
                            <?php if($post->active == 1){ ?>
                              <input type="hidden" name="active" value="0">
                              <button type="submit" name="id" value="<?php echo $post->post_id;?>" title="<?php trans('disable');?>" class="btn btn-success"><i class="fa fa-thumbs-up"></i></button>
                            
                            <?php  
                            }else{
                              ?>
                              <input type="hidden" name="active" value="1">
                              <button type="submit" name="id" value="<?php echo $post->post_id;?>" title="<?php trans('enable');?>" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></button>
                            <?php 
                            }
                            ?>
                         </form>
                      </td>
                      <td>
                        
                        <a title="<?php echo trans('view');?>" href="<?php echo base_url($this->controllerFor.'/'.$this->post_type.'/view/'.$post->post_id);?>" class="btn btn-primary"><span class="fa fa-eye"></span></a>

                        <a title="<?php echo trans('edit');?>" href="<?php echo base_url($this->controllerFor.'/'.$this->post_type.'/edit/'.$post->post_id);?>" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                     

                        <form action="<?php echo base_url($this->controllerFor.'/'.$this->post_type.'/destroy');?>" method="post" class="inline" >
                        
                          <button onclick="return confirm('<?php echo trans('are_you_sure_to_delete')?>');" type="submit" name="id" value="<?php echo $post->post_id;?>" title="<?php echo trans('delete');?>" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                        </form>

                      </td>
                    </tr>
                    <?php
                    }
                }
                else{
                  ?>
                   <tr><td colspan='5' class="text-center"><strong><?php echo trans('page_not_found'); ?></strong></td></tr>
                <?php 
                } 
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php
                if(!empty($links)){
                  echo $links;
                }
                ?>
            
              </ul>
            </div>
          </div>
          <!-- /.box -->      
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
