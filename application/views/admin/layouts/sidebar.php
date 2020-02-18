
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
   
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?php echo empty($uri)?'active':''; ?>">
          <a href="<?php echo base_url($this->controllerName); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo trans('dashboard');?></span>
           </a>
        </li>
<?php 
/*      
          <li class="header"><?php echo trans('category_management'); ?></li>
          <li class="treeview <?php echo ($uri == 'category')?'active':''; ?>">
              <a href="#">
                  <i class="fa fa-list-alt"></i>
                  <span><?php echo trans('categories'); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo base_url($this->controllerFor.'/category'); ?>"><i class="fa fa-list-ol"></i> <?php echo trans('categories'); ?> </a></li>
                  <li><a href="<?php echo base_url($this->controllerFor.'/category/create'); ?>"><i class="fa fa-plus"></i> <?php echo trans('add_category'); ?> </a></li>
              </ul>
          </li>
*/
?>

          <li class="header"><?php echo trans('post_category_management'); ?></li>
          <li class="treeview <?php echo ($uri == 'post')?'active':''; ?>">
              <a href="#">
                  <i class="fa fa-book"></i>
                  <span><?php echo trans('posts'); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo base_url($this->controllerFor.'/post'); ?>"><i class="fa fa-book"></i> <?php echo trans('posts'); ?> </a></li>
                  <li><a href="<?php echo base_url($this->controllerFor.'/post/create'); ?>"><i class="fa fa-plus"></i> <?php echo trans('add_post'); ?> </a></li>
                   <li><a href="<?php echo base_url($this->controllerFor.'/category'); ?>"><i class="fa fa-list-ol"></i> <?php echo trans('categories'); ?> </a></li>
              </ul>
          </li>



          <li class="header"><?php echo trans('page_management'); ?></li>
          <li class="treeview <?php echo ($uri == 'page')?'active':''; ?>">
              <a href="#">
                  <i class="fa fa-book"></i>
                  <span><?php echo trans('pages'); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo base_url($this->controllerFor.'/page'); ?>"><i class="fa fa-book"></i> <?php echo trans('pages'); ?> </a></li>
                  <li><a href="<?php echo base_url($this->controllerFor.'/page/create'); ?>"><i class="fa fa-plus"></i> <?php echo trans('add_page'); ?> </a></li>
              </ul>
          </li>


          <li class="header"><?php echo trans('menu_management'); ?></li>
          <li class="treeview <?php echo ($uri == 'menu')?'active':''; ?>">
              <a href="#">
                  <i class="fa fa-book"></i>
                  <span><?php echo trans('menus'); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo base_url($this->controllerFor.'/menu'); ?>"><i class="fa fa-book"></i> <?php echo trans('menus'); ?> </a></li>
                  <li><a href="<?php echo base_url($this->controllerFor.'/menu/create'); ?>"><i class="fa fa-plus"></i> <?php echo trans('add_menu'); ?> </a></li>
              </ul>
          </li>




          <li class="header"><?php echo trans('user_management'); ?></li>
          <li class="treeview <?php echo ($uri == 'user')?'active':''; ?>">
              <a href="#">
                  <i class="fa fa-users"></i>
                  <span><?php echo trans('users'); ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo base_url($this->controllerFor.'/user'); ?>"><i class="fa fa-users"></i> <?php echo trans('users'); ?> </a></li>
                  <li><a href="<?php echo base_url($this->controllerFor.'/user/create'); ?>"><i class="fa fa-user-plus"></i> <?php echo trans('add_user'); ?> </a></li>
              </ul>
          </li>


          
            
          <li>
            <a href="<?php echo base_url($this->controllerName.'/logout'); ?>">
              <i class="fa fa-sign-out"></i> <span><?php echo trans('logout');?></span>
            </a>
          </li>

        </ul>

       
    </section>
    <!-- /.sidebar -->

