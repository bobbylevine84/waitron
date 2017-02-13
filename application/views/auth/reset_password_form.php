<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'placeholder' => 'New Password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control input-lg'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'placeholder' => 'Confirm New Password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'class' => 'form-control input-lg'
);
?>


<style type="text/css"> span p { color: red;}</style>
<div class="container">
	<div class="wa2">
		<div class="wa1-top-space">  </div>
		<div class="wa2-pic-welcome">
			<div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logodasd"> </div>
			<h2>Change Password <?=$this->config->item('company_name')?></h2>
		</div>
		<?=form_open($this->uri->uri_string())?>
			<ul class="wa2-form">
				<?php  echo modules::run('sidebar/flash_msg');?>  
				<li> 
					<?php echo form_password($new_password); ?>
					<span style="color: red;">
					<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
					</span>
				</li>
				<li> 
					<?php echo form_password($confirm_new_password); ?>
					<span style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
					</span>
				</li>
				<li> <input type="submit" value="Change Password" class="btn-nxt"> </li>
			</ul>
		<?=form_close()?>
	</div>
</div>
