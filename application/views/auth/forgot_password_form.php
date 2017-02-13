<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'class'	=> 'form-control',
	'placeholder' => 'email address',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
?>

<style type="text/css"> span p { color: red;}</style>
<div class="container">
	<div class="wa2">
		<div class="wa1-top-space">  </div>
		<div class="wa2-pic-welcome">
				<div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logo"> </div>
				<h2>Service Stafﬁng in an Instant</h2>
		</div>
		
		<?=form_open($this->uri->uri_string())?>
			<ul class="wa2-form">
				<li> <div class="forgot-link"><a href="<?=base_url()?>login">Remember Password</a> </div> </li>
				<li> 
					<?php echo form_input($login); ?>
					<span style="color: red;">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
					</span>
				</li>
				<li> <input type="submit" value="Send Recovery Email" class="btn-nxt"> </li>
			</ul>
		<?=form_close()?>
	</div>
</div>
