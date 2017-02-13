<?php if (!empty($staff_info)) { 
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
            <div class="welcome-back-txt">my account</div>
            <div class="hello-txt">hello</div>
            <div class="cli-name-txt"><?=$staff->firstname?></div>
            <ul class="acc-dec job-payment wa32-wap">
                  <li><a href="<?=base_url()?>staff/settings">proﬁle <br> information</a></li>
                  <li><a class="active" href="<?=base_url()?>staff/settings/captain">become a<br> captain</a></li>
                  <li><a href="<?=base_url()?>staff/settings/changepass">change <br> password</a></li>
                  <li><a href="<?=base_url()?>staff/settings/paymentinfo">payment  <br> information</a></li>
                  <li><a href="<?=base_url()?>staff/settings/disputes">disputes</a></li>
            </ul>
            <div class="jobs">
                <div class="wa16-heading1">become a captain</div>
                <div class="wa16-heading"><?=$staff->firstname." ".$staff->lastname?></div>
                <?php if($staff->captain=='' && $staff->crequest=='No') { ?>
                    <div class="cli-pos">you want to become a captain please click on below link</div>
                    <div class="save-btn-main">
                        <a href="<?=base_url()?>staff/settings/bcaptain" class="upload-doc" style="height:40px; line-height:40px; font-size:22px;">apply</a>
                    </div>
                <?php } if($staff->captain=='' && $staff->crequest=='Yes') { ?>
                    <div class="cli-pos">your captain request sent successfully</div>
                    <div class="cli-pos" style="color:#2abce3">please wait for admin approval</div>
                <?php } if($staff->captain=='No' && $staff->crequest=='Yes') { ?>
                    <div class="cli-pos" style="color:#2abce3">your request decline by admin</div>
                    <div class="cli-pos">you can't worked as a captain for any event</div>
                <?php } if($staff->captain=='Yes' && $staff->crequest=='Yes') { ?>
                    <div class="cli-pos" style="color:#2abce3">your request approved by admin</div>
                    <div class="cli-pos">you worked as a captain for any event</div>
                <?php } ?>
            </div>
    </div>
<?php } } ?>