  <section id="content"> <section class="vbox">
  <header class="header bg-white b-b b-light">
  <p>Add New Worker </p> </header>
  <section class="scrollable wrapper">

    <div class="row">
      <div class="col-lg-6">
         <!-- Profile Form -->
        <section class="panel panel-default">
      <header class="panel-heading font-bold"><?=lang('profile_details')?></header>
      <div class="panel-body">
        <?php
        $attributes = array('class' => 'bs-example form-horizontal');
         echo form_open(uri_string(),$attributes); ?>
         <?php echo validation_errors(); ?>

         <div class="form-group">
          <label><?=lang('old_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="old_password" placeholder="<?=lang('old_password')?>" required>
        </div>
        <div class="form-group">
          <label><?=lang('new_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="new_password" placeholder="<?=lang('new_password')?>" required>
        </div>
         <div class="form-group">
          <label><?=lang('confirm_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="confirm_new_password" placeholder="<?=lang('confirm_password')?>" required>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">First Name<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="fname" value="<?//=$p->fullname?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Last Name<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="lname" value="<?//=$p->city?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Zip Code<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="zipcode" value="<?//=$p->city?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">City<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="city" value="<?//=$p->city?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Address<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="address" value="<?//=$p->city?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Phone<span class="text-danger">*</span></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="phone" value="<?//=$p->city?>" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Email</label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="email" value="<?//=$p->city?>" required>
          </div>
        </div>


       <button type="submit" class="btn btn-sm btn-dark"><?=lang('update_profile')?></button>
      </form>

    </div>
  </section>
  <!-- /profile form -->
</div>
<div class="col-lg-6">
      
        <!-- Account Form -->
        <section class="panel panel-default">
      <header class="panel-heading font-bold"><?=lang('account_details')?></header>
      <div class="panel-body">
        <?php
        echo form_open(base_url().'auth/change_password'); ?>
        <input type="hidden" name="r_url" value="<?=uri_string()?>">
        <div class="form-group">
          <label><?=lang('old_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="old_password" placeholder="<?=lang('old_password')?>" required>
        </div>
        <div class="form-group">
          <label><?=lang('new_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="new_password" placeholder="<?=lang('new_password')?>" required>
        </div>
         <div class="form-group">
          <label><?=lang('confirm_password')?> <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="confirm_new_password" placeholder="<?=lang('confirm_password')?>" required>
        </div>
        
        <button type="submit" class="btn btn-sm btn-dark"><?=lang('change_password')?></button>
      </form>

      <h4 class="page-header"><?=lang('avatar_image')?></h4>

       <?php
       $attributes = array('class' => 'bs-example form-horizontal');
        echo form_open_multipart(base_url().'profile/changeavatar',$attributes); ?>
        <input type="hidden" name="r_url" value="<?=uri_string()?>">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?=lang('use_gravatar')?></label>
            <div class="col-lg-8">
              <label class="switch">
                <input type="checkbox" <?php if($this -> applib -> get_any_field('account_details',array('user_id'=>$this->tank_auth -> get_user_id()),'use_gravatar') == 'Y'){ echo "checked=\"checked\""; } ?> name="use_gravatar">
                <span></span>
              </label>
            </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label"><?=lang('avatar_image')?></label>
          <div class="col-lg-9">
            <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s" name="userfile">
          </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success"><?=lang('change_avatar')?></button>
      </form>

      <h4 class="page-header"><?=lang('change_username')?></h4>

       <?php
       $attributes = array('class' => 'bs-example form-horizontal');
        echo form_open(base_url().'auth/change_username',$attributes); ?>
        <input type="hidden" name="r_url" value="<?=uri_string()?>">
     
        <div class="form-group">
          <label class="col-lg-3 control-label"><?=lang('new_username')?></label>
          <div class="col-lg-7">
          <input type="text" class="form-control" name="username" placeholder="<?=lang('new_username')?>" required>
          </div>
        </div>
        
        <button type="submit" class="btn btn-sm btn-danger"><?=lang('change_username')?></button>
      </form>


    </div>
  </section>
  <!-- /Account form -->
  
    </div>
  </div> </section> </section> <a href="widgets.html#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>