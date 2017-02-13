<div class="container">
    <?php if(!empty($client_info)) {
    foreach ($client_info as $client) { ?>
    <div class="welcome-back-txt">my account</div>
    <div class="hello-txt">hello </div>
    <div class="cli-name-txt"><?=$client->firstname?></div>
    <ul class="acc-dec job-payment">
          <li><a href="<?=base_url()?>client/settings">proﬁle <br> information</a></li>
          <li><a class="active" href="<?=base_url()?>client/settings/changepass">change <br> password</a></li>
          <li><a href="<?=base_url()?>client/settings/paymentinfo">payment  <br> information</a></li>
          <li><a href="<?=base_url()?>client/settings/disputes">disputes</a></li>
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
    </div>
    <?php } } ?>

    <!-- <div class="jobs">
        <div class="wa16-heading1">change password</div>
        <p>&nbsp;</p>
        
        <div class="wa16-form wa16-form-more-padd">
            <div class="row wa16-form-row">
                <div class="col-md-6">
                    <label class="label-field">current password</label>
                    <input type="text" class="form-control" value="**************">
                </div>
                <div class="col-md-6">
                      
                </div>
            </div>
            <div class="row wa16-form-row">
                <div class="col-md-6">
                    <label class="label-field">new password</label>
                    <input type="text" class="form-control" value="**************">
                </div>
                <div class="col-md-6">
                    <label class="label-field">conﬁrm new password</label>
                    <input type="text" class="form-control" value="**************">
                </div>
            </div>
        </div>
            
        <div class="save-btn-main">
              <input type="button" value="update password" class="save-btn">
        </div>
    </div> -->
</div>