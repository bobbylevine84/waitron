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
            
		    <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
		        <ul class="nav navbar-nav navbar-right">
		        <?php if(basename($_SERVER['REQUEST_URI'])=='login') { ?>
		            <li class=""><a href="<?=base_url()?>register">Registration</a></li>
		        <?php } else { ?>
					<li class=""><a href="<?=base_url()?>login">Login</a></li>
		        <?php } ?>                                                              
		        </ul>
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
	<?php 
	if(isset($autoredirect))
	{ ?>
	<script type="text/javascript">
	    $(document).ready(function(){
	        setTimeout(function() {get_login() }, 5000);
	      });
		  function get_login()
		  {
		    /*$.ajax({
		      type: "POST",
		      url: '<?=base_url()?>login',
		      data: {login:"<?=$login?>", password:"<?=$password?>"},
		        success: function(){
		        	window.location.href = "<?=base_url().$page?>";
		        }
		      });*/
		      window.location.href = "http://my.waitron.loc/";
		  }
	</script>
	<?php } ?>
  </body>
</html>