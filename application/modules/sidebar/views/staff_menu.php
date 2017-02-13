<nav class="navbar navbar-default">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><img src="<?=base_url()?>resource/images/logo.png" alt="logo"></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<!-- <form class="navbar-form navbar-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="search anything">
			</div>
		</form> -->
		<ul class="nav navbar-nav navbar-right">
			<li class="<?php if($page == 'Home'){echo  "active"; }?>"><a href="<?=base_url()?>staff">schedule</a></li>
			<li class="<?php if($page == 'Profile'){echo  "active"; }?>"><a href="<?=base_url()?>staff/profile">proﬁle</a></li>
			<li class="<?php if($page == 'Reports'){echo  "active"; }?>"><a href="<?=base_url()?>staff/reports">reports</a></li>
			<li><a href="<?=base_url()?>auth/logout">Logout</a></li>
			<li class="setting-icon <?php if($page == 'Settings'){echo  "active"; }?>"><a href="<?=base_url()?>staff/settings"> <?=$page=='Settings' ? '<img alt="" src="'.base_url().'resource/images/settings-a.png">' : '<img alt="" src="'.base_url().'resource/images/settings.png">' ?> </a></li>		
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>