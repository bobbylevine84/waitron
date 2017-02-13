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
              <li><a href="<?=base_url()?>staff/settings/paymentinfo">payment  <br> information</a></li>
              <li><a class="active" href="<?=base_url()?>staff/settings/disputes">disputes</a></li>
        </ul>
        <div class="jobs">
            <!-- <div class="wa16-heading1">work documents</div>
            <p>&nbsp;</p>
            <div class="wa16-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="wa16-sec1">W-9</div>
                        <div class="file-pic">
                            <div class="file-pic-img"><img src="<?=base_url()?>resource/images/page1.png" alt=""> </div>
                            <h3>on ﬁle</h3>
                            <a href="javascript:void(0)" class="upload-doc">upload document</a>
                        </div>
                        <div class="view-doc">
                            <p><a href="javascript:void(0)">view document</a></p>
                            <p><a href="javascript:void(0)">download document</a></p>
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="wa16-sec1">1099</div>
                        <div class="file-pic">
                            <div class="file-pic-img"><img src="<?=base_url()?>resource/images/page1.png" alt=""> </div>
                            <h3>on ﬁle</h3>
                            <a href="javascript:void(0)" class="upload-doc">upload document</a>
                        </div>
                        <div class="view-doc">
                            <p><a href="javascript:void(0)">view document</a></p>
                            <p><a href="javascript:void(0)">download document</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="wa16-sec1">pay stubs</div>
                        <div class="file-pic">
                            <div class="file-pic-img"><img src="<?=base_url()?>resource/images/page1.png" alt=""> </div>      
                        </div>
                        <div class="view-doc">
                            <p><a href="javascript:void(0)">view document</a></p>
                            <p><a href="javascript:void(0)">download document</a></p>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="wa16-heading1">disputes</div>
            <div class="no-dispatch">there are no disputes at this time</div>
        </div>
    </div>
<?php } } ?>