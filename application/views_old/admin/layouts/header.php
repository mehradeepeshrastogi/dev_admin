<?php $uri = $this->uri->segment(2); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <?php /*
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/font-awesome/css/font-awesome.min.css">
  */ ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"/>
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

 <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>/css/jquery.multiselect.css">
  <?php 
  /*
       <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>dist/css/skins/_all-skins.min.css">
  */
  ?>
    <link rel="stylesheet" href="<?php echo ADMIN_URL_FILE; ?>css/style.css">
    
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url($this->controllerName);?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" title="<?php echo trans('app_name'); ?>"><?php echo trans('app_nick_name'); ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo trans('app_name'); ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <select style="float:right;margin-top: 14px;margin-right: 18px;" class="switchLang">
        <?php 
          if(!empty($languages)){
            foreach($languages as $language){
        ?>
              <option value="<?php echo $language->lang_id;?>" <?php echo ($this->lang_id == $language->lang_id)?'selected':'';?> ><?php echo trans($language->name);?></option>
        <?php 
            }
          }
        ?>
      </select>
      <!-- Navbar Right Menu -->
  
     

    </nav>
  </header>

  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php include_once('sidebar.php'); ?>
  </aside>
