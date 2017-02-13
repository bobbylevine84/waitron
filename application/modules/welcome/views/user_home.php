<div class="container">
	<div class="top-heading">
		Admin Dashboard
	</div>
	
	<div class="we12-main">
		<ul class="we5-main we5-main-wa4 clearfix">	
			<?php if($this->tank_auth->checkPermission('active_staffs')){ ?>
			<li class="we5-bg2">	
				<a class="we5-bg1" href="<?=base_url()?>staffs">
					<span class="we5-main-txt1">total active staff</span>
					<span class="we5-main-txt2"><?=$active_staffs?></span>																
				</a>
			</li>
			<?php } if($this->tank_auth->checkPermission('active_clients')){ ?>
			<li class="we5-bg1">	
				<a class="we5-bg1" href="<?=base_url()?>clients">
					<span class="we5-main-txt1">total active clients</span>
					<span class="we5-main-txt2"><?=$active_clients?></span>																
				</a>
			</li>
			<?php } if($this->tank_auth->checkPermission('staff_pending')){ ?>
			<li class="we5-bg2">	
				<a class="we5-bg1" href="<?=base_url()?>staffs/pending">
					<span class="we5-main-txt1">pending staff applications</span>
					<span class="we5-main-txt2"><?=$pending_staffs?></span>																
				</a>
			</li>
			<?php } if($this->tank_auth->checkPermission('real_time_jobs')){ ?>
			<li class="we5-bg1">	
				<a class="we5-bg1" href="<?=base_url()?>jobs">
					<span class="we5-main-txt1">real-time active jobs</span>
					<span class="we5-main-txt2"><?=$real_time_active_jobs?></span>																
				</a>
			</li>
			<?php } if($this->tank_auth->checkPermission('completed_jobs')){ ?>
			<li class="we5-bg2">	
				<a class="we5-bg1" href="<?=base_url()?>jobs">
					<span class="we5-main-txt1">total jobs completed</span>
					<span class="we5-main-txt2"><?=$total_jobs_completed?></span>																
				</a>
			</li>
			<?php } if($this->tank_auth->checkPermission('revenue')){ ?>
			<li class="we5-bg1">	
				<a class="we5-bg1" href="javascript:void(0)">
					<span class="we5-main-txt1">gross revenue</span>
					<span class="we5-main-txt2">$<?=$gross_revenue?></span>																
				</a>
			</li>
			<?php } ?>
		</ul>										
	</div>
</div>