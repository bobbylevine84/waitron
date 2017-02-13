<!DOCTYPE html>
<html lang="en" class="app">
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">
    <meta name="description" content="">
    <meta name="author" content="<?=$this->config->item('site_author')?>">
    <meta name="keyword" content="<?=$this->config->item('site_desc')?>">
    <title><?php  echo $template['title'];?></title>
    <!-- Bootstrap core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link href="<?=base_url()?>resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>resource/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>resource/js/toastr/toastr.css" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>resource/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>resource/css/responsive.css">
    
    <?php if (isset($datepicker)) { ?>
    <link rel="stylesheet" href="<?=base_url()?>resource/js/slider/slider.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="<?=base_url()?>resource/js/datepicker/datepicker.css" type="text/css" cache="false" />
    <?php } ?>
    
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false">
    </script>
    <script src="js/ie/respond.min.js" cache="false">
    </script>
    <script src="js/ie/excanvas.js" cache="false">
    </script> <![endif]-->
  </head>
  <body>
      <!--header start-->
      <header>
          <?php
              if ($this->tank_auth->get_user_type()=='Admin') {
              echo modules::run('sidebar/admin_menu');
              }elseif ($this->tank_auth->get_user_type() =='Client') {
              echo modules::run('sidebar/client_menu');
              }elseif ($this->tank_auth->get_user_type() =='Staff') {
              echo modules::run('sidebar/staff_menu');
              }else{
              redirect('');
              }
          ?>
      </header>
      <!--header end-->

      <section>
          <!--main content start-->
          <?php  echo $template['body'];?>
          <!--main content end-->
      </section>
      <footer>
        &copy; <?=date('Y')?> Waitron Inc. All Rights Reserved
      </footer>

      <script src="<?=base_url()?>resource/js/jquery.min.js"></script>
      <script src="<?=base_url()?>resource/js/bootstrap.min.js"></script>
      <!-- <script src="<?=base_url()?>resource/js/ajax.js"></script> -->
      <script src="<?=base_url()?>resource/js/jquery.treeview.js"></script>
      <script src="<?=base_url()?>resource/js/custom.js"></script>
      <script src="<?=base_url()?>resource/js/toastr/toastr.js"></script>
      <?php  echo modules::run('sidebar/scripts');?>
    </body>
  </html>