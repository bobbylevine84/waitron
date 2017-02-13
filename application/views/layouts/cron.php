<!DOCTYPE html>
<html lang="en" class="bg-dark">
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?=base_url()?>resource/images/favicon.ico">

    <title><?php  echo $template['title'];?></title>
    <meta name="description" content="<?=$this->config->item('site_desc')?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="<?=base_url()?>resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>resource/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>resource/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false">
    </script>
    <script src="js/ie/respond.min.js" cache="false">
    </script>
    <script src="js/ie/excanvas.js" cache="false">
    </script> <![endif]-->
  </head>
  <body> 
    <header>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"><img alt="logo" src="<?=base_url()?>resource/images/logo.png"></a>
            </div>
        </nav>
    </header>

    <!--main content start-->
    <section>
      <?php  echo $template['body'];?>
      </section>
    <!--main content end-->

    <footer>
      &copy; <?=date('Y')?> Waitron Inc. All Rights Reserved
    </footer>

    <script src="<?=base_url()?>resource/js/jquery.min.js"></script>
    <script src="<?=base_url()?>resource/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>resource/js/custom.js"></script>
  <script src="<?=base_url()?>resource/js/toastr/toastr.js"></script>

  <?php if (isset($editor)) { ?>
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css" rel="stylesheet"  type="text/css">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js"></script>
<script type="text/javascript">
$('.foeditor').summernote({
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  });
$('.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table').remove();
</script>
<?php } ?> 

  <?php 
  if(isset($autoRedirect))
  { ?>
  <script type="text/javascript">
      $(document).ready(function(){
          setTimeout(function() {window.location.href = "<?=base_url()?>login"; }, 10000);
        });
  </script>
  <?php } ?>

  <?php
  if($this->session->flashdata('message')){ 
  $message = $this->session->flashdata('message');
  $alert = $this->session->flashdata('response_status');
    ?>
      <script type="text/javascript">
        $(document).ready(function(){
          toastr.<?=$alert?>("<?=$message?>", "Response Status: <?=ucfirst($alert)?>");
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        });
      </script>
  <?php } ?>
  </body>
</html>