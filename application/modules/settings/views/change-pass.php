<div class="container">
    <?php if (!empty($admin_info)) {
    foreach ($admin_info as $admin) { ?>
        <div class="welcome-back-txt">my account</div>
        <div class="hello-txt">welcome back  </div>
        <div class="cli-name-txt"><?=$admin->firstname." ".$admin->lastname?></div>
        
        <ul class="acc-dec job-payment wa32-wap">
            <li><a href="<?=base_url()?>settings">proﬁle <br> information</a></li>
            <li><a class="active" href="<?=base_url()?>settings/changepass">change <br> password</a></li>
            <?php if($this->tank_auth->checkPermission('setting_ma')) { ?>
            <li><a href="<?=base_url()?>settings/manageaccounts">manage <br> accounts</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_et')) { ?>
            <li><a href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_st')) { ?>
            <li><a href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
            <?php } ?>
        </ul>
        
        <div class="jobs">
            <div class="wa16-heading1">change password</div>
            <p>&nbsp;</p>

            <?=form_open($this->uri->uri_string())?>
                <div class="wa16-form  wa16-form-more-padd">
                    <div class="row wa16-form-row">
                        <div class="col-md-6">
                            <label class="label-field">current password</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="row wa16-form-row">
                        <div class="col-md-6">
                            <label class="label-field">new password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="label-field">conﬁrm new password</label>
                            <input type="password" name="confirm_new_password" class="form-control" required>
                        </div>              
                    </div>
                </div>
                
                
                <div class="save-btn-main">
                    <input type="submit" value="update password" name="save" class="save-btn">
                </div>
            </form>
            
            <!-- <div class="save-btn-main">
                <div class="password-message">password has been updated!</div>
            </div> -->
        </div>
    <?php } } ?>
</div>
