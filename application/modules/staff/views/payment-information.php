<?php if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
        <div class="welcome-back-txt">my account</div>
        <div class="hello-txt">hello </div>
        <div class="cli-name-txt"><?=$staff->firstname?></div>
        <ul class="acc-dec job-payment wa32-wap">
              <li><a href="<?=base_url()?>staff/settings">proﬁle <br> information</a></li>
              <li><a href="<?=base_url()?>staff/settings/captain">become a  <br> captain</a></li>
              <li><a href="<?=base_url()?>staff/settings/changepass">change <br> password</a></li>
              <li><a class="active" href="<?=base_url()?>staff/settings/paymentinfo">payment  <br> information</a></li>
              <li><a href="<?=base_url()?>staff/settings/disputes">disputes</a></li>
        </ul>
        <div class="jobs">
            <div class="wa16-heading1">bank information</div>
            <p>&nbsp;</p>
            <div class="wa16-form wa16-form-more-padd">
                <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <label class="label-field">no account on ﬁle</label>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="row wa16-form-row">
                    <div class="col-md-6">
                        <label class="label-field">account number</label>
                        <input type="text" class="form-control" value="**************">
                    </div>
                    <div class="col-md-6">
                        <label class="label-field">routing number</label>
                        <input type="text" class="form-control" value="**************">
                    </div>
                </div>
            </div>
            <div class="save-btn-main">
                <input type="button" value="save" class="save-btn">
            </div>
        </div>
    </div>
<?php } } ?>