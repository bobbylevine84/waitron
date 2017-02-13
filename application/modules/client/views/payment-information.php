<div class="container">
    <?php if(!empty($client_info)) {
    foreach ($client_info as $client) { ?>
    <div class="welcome-back-txt">my account</div>
    <div class="hello-txt">hello </div>
    <div class="cli-name-txt"><?=$client->firstname?></div>
    <ul class="acc-dec job-payment">
          <li><a href="<?=base_url()?>client/settings">proﬁle <br> information</a></li>
          <li><a href="<?=base_url()?>client/settings/changepass">change <br> password</a></li>
          <li><a class="active" href="<?=base_url()?>client/settings/paymentinfo">payment  <br> information</a></li>
          <li><a href="<?=base_url()?>client/settings/disputes">disputes</a></li>
    </ul>
    <div class="jobs">
        <div class="wa16-heading1">credit card on ﬁle</div>
        <p>&nbsp;</p>
        
        <div class="wa16-form wa16-form-more-padd">
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <label class="label-field">card on ﬁle</label>
                    </div>
              </div>
              
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <div class="amex-pic"> <img src="<?=base_url()?>resource/images/amex.png" alt=""> </div>
                          <div class="amex-txt1">
                              <p>AMEX: 0001</p>
                              <p>10/20</p>
                          </div>
                          <div class="amex-txt2">
                              <a href="javascript:void(0)">edit</a> | <a href="javascript:void(0)">remove</a>
                          </div>
                    </div>
              </div>
              
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <label class="label-field">billing information</label>
                          <select class="form-control select-form">
                              <option>  card type</option>
                          </select>
                    </div>
                    <div class="col-md-6">
                          <label class="label-field">&nbsp;</label>
                          <input type="text" class="form-control" value="name on card">
                    </div>
              </div>
              
              
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <input type="text" class="form-control" value="card number">
                    </div>
                    <div class="col-md-6">
                          <input type="text" class="form-control" value="CCV">
                    </div>
              </div>
              
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <input type="text" class="form-control" value="zip code">
                    </div>
              </div>
              
              
              
              <div class="row wa16-form-row">
                    <div class="col-md-6">
                          <label class="label-field">banking information</label>
                          <input type="text" class="form-control" value="routing number">
                    </div>
                    <div class="col-md-6">
                          <label class="label-field">&nbsp;</label>
                          <input type="text" class="form-control" value="account number">
                    </div>
              </div>
              
              
        </div>
            
        <div class="save-btn-main">
                <input type="button" value="save" class="save-btn">
        </div>
    </div>
    <?php } } ?>
</div>