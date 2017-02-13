
<?php
$login = array(
	'name'	=> 'login',
	'class'	=> 'form-control',
	'placeholder' => lang('username'),
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'placeholder' => lang('password'),
	'id'	=> 'inputPassword',
	'size'	=> 30,
	'class' => 'form-control'
);
?>

<style type="text/css"> span p { color: red;}</style>
<div class="container">
	<div class="wa2">
		<div class="wa1-top-space">  </div>
		<div class="wa2-pic-welcome">
			<div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logo"> </div>
			<h2>service stafﬁng in an instant</h2>
		</div>
		<?=form_open($this->uri->uri_string())?>
			<ul class="wa2-form">
				<?php  echo modules::run('sidebar/flash_msg');?>  
				<li> 
					<?php echo form_input($login); ?>
					<span style="color: red;">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
					</span>
				</li>
				<li> 
					<?php echo form_password($password); ?>
					<span style="color: red;">
					<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
					</span>
				</li>
				<li> <div class="forgot-link"><a href="<?=base_url()?>auth/forgot_password">Forget Your Password?</a> </div> </li>
				<li> <input type="submit" value="login" class="btn-nxt"> </li>
			</ul>
		<?=form_close()?>
	</div>
</div>

