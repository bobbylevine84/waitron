<?php if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
            <div class="welcome-back-txt">my account</div>
            <div class="hello-txt">hello</div>
            <div class="cli-name-txt"><?=$staff->firstname?></div>
            <ul class="acc-dec job-payment wa32-wap">
                  <li><a class="active" href="<?=base_url()?>staff/settings">proﬁle <br> information</a></li>
                  <li><a href="<?=base_url()?>staff/settings/captain">become a  <br> captain</a></li>
                  <li><a href="<?=base_url()?>staff/settings/changepass">change <br> password</a></li>
                  <li><a href="<?=base_url()?>staff/settings/paymentinfo">payment  <br> information</a></li>
                  <li><a href="<?=base_url()?>staff/settings/disputes">disputes</a></li>
            </ul>
            <div class="jobs">
                <div class="wa16-heading1">proﬁle information</div>
                <div class="wa16-heading"><?=$staff->firstname." ".$staff->lastname?></div>
                <div class="cli-pos">waitron</div>
                <div class="wa16-form">
                <?=form_open($this->uri->uri_string())?>
                    <input type="hidden" name="user_id" value="<?=$staff->user_id?>" >
                    <div class="row wa16-form-row">
                        <div class="col-md-4">
                              <label class="label-field">address</label>
                              <input type="text" class="form-control" name="address" value="<?=$staff->address?>" required>
                        </div>
                        <div class="col-md-4">
                              <label class="label-field">zip code</label>
                              <input type="text" class="form-control" name="zipcode" value="<?=$staff->zipcode?>" required>
                        </div>
                        <div class="col-md-4">
                              <label class="label-field">city</label>
                              <input type="text" class="form-control" name="city" value="<?=$staff->city?>" required>
                          </div>
                    </div>
                    <div class="row wa16-form-row">
                        <div class="col-md-4">
                              <label class="label-field">state</label>
                              <input type="text" class="form-control" name="state" value="<?=$staff->state?>" required>
                        </div>
                        <div class="col-md-4">
                              <label class="label-field">phone</label>
                              <input type="text" class="form-control" name="phone" value="<?=$staff->phone?>" required>
                        </div>
                        <div class="col-md-4">
                              <label class="label-field">email</label>
                              <input type="hidden" name="old_email" value="<?=$staff->email?>">
                              <input type="text" class="form-control" name="email" value="<?=$staff->email?>" required>
                        </div>
                    </div>
                <form>
                </div>
                <div class="save-btn-main">
                      <input type="submit" value="save changes" name="save" class="save-btn">
                </div>
            </div>
    </div>
<?php } } ?>