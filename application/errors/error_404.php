<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="" />
  <meta name="author" content="<?=config_item('site_author')?>">
  <meta name="keyword" content="<?=config_item('site_desc')?>">
  <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">
  <title><?=config_item('company_name')?></title>
  <!-- Bootstrap core CSS -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="stylesheet" href="<?=base_url()?>resource/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>resource/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>resource/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url()?>resource/js/toastr/toastr.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url()?>resource/css/font-awesome.min.css">
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>


 <body>
      <!--header start-->
      <header>

      </header>
      <!--header end-->

      <section>
      <div class="container">
        <div class="wa2">
          <div class="wa1-top-space">  </div>
          <div class="wa2-pic-welcome">
          <div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logo"> </div>
        </div>
          <div class="row m-n">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="text-center m-b-lg">
                <h1 class="h text-white animated fadeInDownBig">404 Error</h1>
              </div>
              <div class="list-group m-b-sm bg-white m-b-lg">
                <a href="<?=base_url()?>" class="list-group-item">
                  <i class="fa fa-chevron-right icon-muted pull-right"></i>
                  <i class="fa fa-fw fa-home icon-muted"></i> Back to Homepage
                </a>
                <a href="#" class="list-group-item">
                  <i class="fa fa-chevron-right icon-muted pull-right"></i>
                  <span class="badge bg-success"><?=config_item('company_phone')?></span>
                  <i class="fa fa-fw fa-phone icon-muted"></i> Call us
                </a>
                <a href="#" class="list-group-item">
                  <i class="fa fa-chevron-right icon-muted pull-right"></i>
                  <span class="badge bg-primary"><?=config_item('company_domain')?></span>
                  <i class="fa fa-fw fa-phone icon-muted"></i> Main Website
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
      <footer>
        &copy; 2015 Waitron Inc. All Rights Reserved
      </footer>
</body>
</html>