<div class="container">
    <?php if (!empty($admin_info)) {
    foreach ($admin_info as $admin) { ?>
        <div class="welcome-back-txt">my account</div>
        <div class="hello-txt">welcome back  </div>
        <div class="cli-name-txt"><?=$admin->firstname." ".$admin->lastname?></div>
        
        <ul class="acc-dec job-payment wa32-wap">
            <li><a class="active" href="<?=base_url()?>settings">proﬁle <br> information</a></li>
            <li><a href="<?=base_url()?>settings/changepass">change <br> password</a></li>
            <?php if($this->tank_auth->checkPermission('setting_ma')) { ?>
            <li><a href="<?=base_url()?>settings/manageaccounts">manage <br> accounts</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_et')) { ?>
            <li><a href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_st')) { ?>
            <li><a href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
            <?php } ?>
        </ul>

        <div class="jobs">
            <div class="wa16-heading">proﬁle information</div>
            <div class="cli-pos">account type: <?=$admin->user_type?></div>
            <p>&nbsp;</p>

            <?=form_open($this->uri->uri_string())?>
                <input type="hidden" name="user_id" value="<?=$admin->user_id?>" >
                <div class="wa16-form">
                    <div class="row wa16-form-row">
                        <div class="col-md-4">
                            <label class="label-field">ﬁrst name</label>
                            <input type="text" class="form-control" name="firstname" value="<?=$admin->firstname?>">
                        </div>
                        <div class="col-md-4">
                            <label class="label-field">last name</label>
                            <input type="text" class="form-control" name="lastname" value="<?=$admin->lastname?>">
                        </div>
                        <div class="col-md-4">
                            <label class="label-field">email</label>
                            <input type="hidden" name="old_email" value="<?=$admin->email?>">
                            <input type="text" class="form-control" name="email" value="<?=$admin->email?>">
                        </div>
                    </div>
                    <div class="row wa16-form-row">
                        <div class="col-md-4">
                            <label class="label-field">position</label>
                            <input type="text" class="form-control" name="position" value="<?=$admin->position?>">
                        </div>
                        <div class="col-md-4">
                            <label class="label-field">phone</label>
                            <input type="text" class="form-control" name="phone" value="<?=$admin->phone?>">
                        </div>              
                    </div>
                </div>
                
                
                <div class="save-btn-main">
                    <input type="submit" value="save changes" name="save" class="save-btn">
                </div>
            </form>
        </div>
    <?php } } ?>
</div>
