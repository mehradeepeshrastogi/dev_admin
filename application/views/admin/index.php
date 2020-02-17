
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo trans('dashboard');?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo trans('dashboard');?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <!-- Info boxes -->
      <div class="row">
          <!--- Start Category Section -->


           <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                  <div class="inner">
                    <h3><?php echo $post; ?></h3>
                    <p><?php echo trans('posts'); ?></p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-list-alt" style="color:#fff;"></i>
                  </div>
                  <a href="<?php echo base_url($this->controllerFor.'/'.'post');?>" class="small-box-footer"><?php echo trans('moreinfo');?> <i
                      class="fa fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>


          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-mygreen">
                  <div class="inner">
                    <h3><?php echo $category; ?></h3>
                    <p><?php echo trans('categories'); ?></p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-list-alt" style="color:#fff;"></i>
                  </div>
                  <a href="<?php echo base_url($this->controllerFor.'/'.'category');?>" class="small-box-footer"><?php echo trans('moreinfo');?> <i
                      class="fa fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

           <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $page; ?></h3>
                    <p><?php echo trans('pages'); ?></p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-book" style="color:#fff;"></i>
                  </div>
                  <a href="<?php echo base_url($this->controllerFor.'/'.'page');?>" class="small-box-footer"><?php echo trans('moreinfo');?><i
                      class="fa fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          

          <!-- End Category Section -->

          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                  <div class="inner">
                    <h3><?php echo $user; ?></h3>
                    <p><?php echo trans('users'); ?></p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-users" style="color:#fff;"></i>
                  </div>
                  <a href="<?php echo base_url($this->controllerFor.'/'.'user');?>" class="small-box-footer"><?php echo trans('moreinfo');?> <i
                      class="fa fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

         



          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
                  <div class="inner">
                    <h3>{ order }</h3>
                    <p>{{ trans('admin.orders') }}  </p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-first-order" style="color:#fff;"></i>
                  </div>
                  <a href="" class="small-box-footer"><?php echo trans('moreinfo');?><i
                      class="fa fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
       
      </div>
      <!-- /.row -->
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

