<div class="container">
    <?php if(!empty($client_info)) {
    foreach ($client_info as $client) { ?>
        <div class="welcome-back-txt">my account</div>
        <div class="hello-txt">hello</div>
        <div class="cli-name-txt"><?=$client->firstname?></div>
        <ul class="acc-dec job-payment">
              <li><a class="active" href="<?=base_url()?>client/settings">proﬁle <br> information</a></li>
              <li><a href="<?=base_url()?>client/settings/changepass">change <br> password</a></li>
              <li><a href="<?=base_url()?>client/settings/paymentinfo">payment  <br> information</a></li>
              <li><a href="<?=base_url()?>client/settings/disputes">disputes</a></li>
        </ul>
        <div class="jobs">
            <div class="wa16-heading1">proﬁle information</div>
            <div class="wa16-heading"><?=$client->firstname." ".$client->lastname?></div>
            <div class="cli-pos"><?=$client->companyname?></div>
            <div class="wa16-form">
            <?=form_open($this->uri->uri_string())?>
                <input type="hidden" name="user_id" value="<?=$client->user_id?>" >
                <div class="row wa16-form-row">
                    <div class="col-md-4">
                          <label class="label-field">address</label>
                          <input type="text" class="form-control" name="address" value="<?=$client->address?>" required>
                    </div>
                    <div class="col-md-4">
                          <label class="label-field">zip code</label>
                          <input type="text" class="form-control" name="zipcode" value="<?=$client->zipcode?>" required>
                    </div>
                    <div class="col-md-4">
                          <label class="label-field">city</label>
                          <input type="text" class="form-control" name="city" value="<?=$client->city?>" required>
                      </div>
                </div>
                <div class="row wa16-form-row">
                    <div class="col-md-4">
                          <label class="label-field">state</label>
                          <input type="text" class="form-control" name="state" value="<?=$client->state?>" required>
                    </div>
                    <div class="col-md-4">
                          <label class="label-field">phone</label>
                          <input type="text" class="form-control" name="phone" value="<?=$client->phone?>" required>
                    </div>
                    <div class="col-md-4">
                          <label class="label-field">email</label>
                          <input type="hidden" name="old_email" value="<?=$client->email?>">
                          <input type="text" class="form-control" name="email" value="<?=$client->email?>" required>
                    </div>
                </div>
            <form>
            </div>
            <div class="save-btn-main">
                  <input type="submit" value="save changes" name="save" class="save-btn">
            </div>
        </div>
    <?php } } ?>
</div>