<?php if (!empty($clients)) {
foreach ($clients as $client) { ?>
<style type="text/css">
.wa6-profile-left {
margin-left: 90px;
width: 143px;
}
.wa6-profile-right table td {
padding-left: 15px;
}
</style>
<div class="container">
    <div class="top-heading">
          <?=$client->firstname." ".$client->lastname?>
          <div class="staff-sol">stafﬁng solutions inc</div>
          <a class="back-link-right" href="<?=base_url()?>clients">back</a>
    </div>
    <div class="wa6-profile clearfix">
        <div class="wa6-profile-left">
            <img alt="" style="width:122px;height:122px;" src="<?=$client->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$client->avatar ?>">
            <a class="edit-pic1" data-toggle="ajaxModal" href="<?=base_url()?>clients/changeavatar/<?=$client->user_id?>"></a>
        </div>
        <div class="wa6-profile-right">
            <div class="statistics-txt">statistics</div>
            <table width="100%" border="0">
                <tbody>
                    <tr>
                        <td>jobs posted</td>
                        <td><strong>0</strong></td>
                    </tr>
                    <tr>
                        <td>jobs placed</td>
                        <td><strong>0</strong></td>
                    </tr>
                    <!-- <tr>
                        <td>placement %</td>
                        <td><strong>0%</strong></td>
                    </tr> -->
                    <tr>
                        <td>invoiced</td>
                        <td><strong>$0</strong></td>
                    </tr>
                    <!-- <tr>
                        <td>paid out</td>
                        <td><strong>$0</strong></td>
                    </tr>
                    <tr>
                        <td>fees</td>
                        <td><strong>$0</strong></td>
                    </tr> -->
                    <tr>
                        <td>member since</td>
                        <td><strong><?=date('d/m/y',strtotime($client->created))?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <?=form_open($this->uri->uri_string())?>
    <input type="hidden" name="user_id" value="<?=$client->user_id?>">
        <div class="wa3-form">
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">ﬁrst name</label>
                    <input type="text" name="firstname" value="<?=$client->firstname?>" class="form-control" placeholder="Jane" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">last name</label>
                    <input type="text" name="lastname" value="<?=$client->lastname?>" class="form-control" placeholder="Sarratt" required>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">city</label>
                    <input type="text" name="city" value="<?=$client->city?>" class="form-control" placeholder="New York" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">phone</label>
                    <input type="text" name="phone" value="<?=$client->phone?>" class="form-control" placeholder="917-901-1234" required>
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">address</label>
                    <input type="text" name="address" value="<?=$client->address?>" class="form-control" placeholder="123 West 14th Street, 3 FL" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">zip code</label>
                    <input type="text" name="zipcode" value="<?=$client->zipcode?>" class="form-control" placeholder="10011" required>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">email</label>
                    <input type="hidden" name="old_email" value="<?=$client->email?>">
                    <input type="text" name="email" value="<?=$client->email?>" class="form-control" placeholder="jane@stafﬁngsolutons.com" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">company</label>
                    <input type="text" name="companyname" value="<?=$client->companyname?>" class="form-control" placeholder="Stafﬁng Solutions Inc" required>
                </div>
            </div>

            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">hourly rate</label>
                    <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input type="text" name="hourlyrate" class="form-control" placeholder="hourly rate" required required data-bv-notempty-message="hourly rate cannot be empty"  data-bv-numeric="true" required data-bv-numeric-message="Please enter a valid hourly rate" value="<?=$client->hourlyrate?>">
                    <div class="input-group-addon">.00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">job post per month</label>
                    <select class="form-control select-form" name="jobsppm" required data-bv-notempty-message="Please  cannot be empty">
                        <option value="">---- select a range ----</option>
                        <option <?=$client->jobsppm=='1-10' ? 'selected' : ''?> value="1-10">1-10</option>
                        <option <?=$client->jobsppm=='11-50' ? 'selected' : ''?> value="11-50">11-50</option>
                        <option <?=$client->jobsppm=='51-100' ? 'selected' : ''?> value="51-100">51-100</option>
                        <option <?=$client->jobsppm=='100+' ? 'selected' : ''?> value="100+">100+</option>
                    </select>
                </div>
            </div>


            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <label class="label-txt">preferred method(s) of contact</label>
                    
                    <div class="select-skill">
                          <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary <?=$client->moc_email=='Yes' ? 'active' : '' ?>">
                                email <input name="moc_email" type="checkbox" value="Yes" <?=$client->moc_email=='Yes' ? 'checked' : '' ?> autocomplete="off" > 
                              </label>
                              <label class="btn btn-primary <?=$client->moc_call=='Yes' ? 'active' : '' ?>">
                                call  <input name="moc_call" type="checkbox" value="Yes" <?=$client->moc_call=='Yes' ? 'checked' : '' ?> autocomplete="off" > 
                              </label>
                              <label class="btn btn-primary <?=$client->moc_text=='Yes' ? 'active' : '' ?>">
                                text  <input name="moc_text" type="checkbox" value="Yes" <?=$client->moc_text=='Yes' ? 'checked' : '' ?> autocomplete="off" > 
                              </label>
                          </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">billing information</label>
                    <select class="form-control select-form" name="cardtype" required>
                        <option value="">---- select card type ----</option>
                        <option <?=$client->cardtype=='Visa'? 'selected' : ''?> value="Visa">Visa</option>
                        <option <?=$client->cardtype=='MasterCard'? 'selected' : ''?> value="MasterCard">Master Card</option>
                        <option <?=$client->cardtype=='AmericanExpress'? 'selected' : ''?> value="AmericanExpress">American Express</option>
                        <option <?=$client->cardtype=='Discover'? 'selected' : ''?> value="Discover">Discover</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">&nbsp;</label>
                    <input type="text" name="nameoncard" value="<?=$client->nameoncard?>" class="form-control" placeholder="name on card" >
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <input type="text" name="cardnumber" value="<?=$client->cardnumber?>" class="form-control" placeholder="card number" >
                </div>
                <div class="col-md-6">
                    <input type="text" name="ccvnumber" value="<?=$client->ccvnumber?>" class="form-control" placeholder="CCV" >
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <input type="text" name="czipcode" value="<?=$client->czipcode?>" class="form-control" placeholder="zip code" >
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">banking information</label>
                    <input type="text" name="routingnumber" value="<?=$client->routingnumber?>" class="form-control" placeholder="routing number" >
                </div>
                <div class="col-md-6">
                    <label class="label-txt">&nbsp;</label>
                    <input type="text" name="accountnumber" value="<?=$client->accountnumber?>" class="form-control" placeholder="account number" >
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="text-center"> <input type="submit" name="update" value="Save" class="submit-btn"></div>
                </div>
            </div>

            <!-- <div class="wa10-table">
                <table width="" border="0">
                    <thead>
                        <tr>
                            <th>feedback</th>
                            <th>rating</th>
                            <th>waitron</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>“Jane was there to greet me when I <br> 
                                arrived. She was very cool and helpful if I <br>
                                and each time she is on time and <br>
                                had any questions.”</p>
                            </td>
                            <td> <img src="<?=base_url()?>resource/images/rate5.png" style="height: 43px; width: auto;" alt=""> </td>
                            <td>
                                <div class="rate-pic"><img style="height:77px; width:77px;" src="<?=base_url()?>resource/images/ratepic3.jpg" alt=""> </div>
                                <h2>Christine Miller</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>“Jane was nice and very helpful. About <br> halfway into the event, she became <br> stressed though. It happens.”</p>
                            </td>
                            <td> <img src="<?=base_url()?>resource/images/rate5.png" style="height: 43px; width: auto;" alt=""> </td>
                            <td>
                                <div class="rate-pic"><img style="height:77px; width:77px;" src="<?=base_url()?>resource/images/ratepic4.jpg" alt=""> </div>
                                <h2>Jason Etter</h2>
                            </td>
                        </tr>
                    </tbody>            
                </table>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="text-center"> <a data-toggle="ajaxModal" href="<?=base_url()?>clients/clientrating/<?=$client->user_id?>"> <input type="button" class="submit-btn" value="view more"> </a></div>
                </div>
            </div> -->

            <ul class="category-view clearfix">
                <?php if($this->tank_auth->checkPermission('client_bh')) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/billinghistory/<?=$client->user_id?>">billing history</a></li>
                <?php } if($this->tank_auth->checkPermission('client_jph')) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/jobposthistory/<?=$client->user_id?>">job post history</a></li>
                <?php } if($this->tank_auth->checkPermission('client_hh')) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/hiredhistory/<?=$client->user_id?>">hired history</a></li>
                <?php } if($this->tank_auth->checkPermission('client_mi')) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/manualinvoice/<?=$client->user_id?>">create manual invoice</a></li>
                <?php } if($this->tank_auth->checkPermission('client_daa')) { ?>
                <?php if($client->activated==1) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/deactivateaccount/<?=$client->user_id?>">deactivate account</a></li>
                <?php } else { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/activateaccount/<?=$client->user_id?>">activate account</a></li>
                <?php } ?>
                <?php } if($this->tank_auth->checkPermission('client_da')) { ?>
                <li><a data-toggle="ajaxModal" href="<?=base_url()?>clients/deleteaccount/<?=$client->user_id?>">delete account</a></li>
                <?php } ?>
            </ul>
        </div>          
    </form>
</div>

<?php } } ?>

<div class="loading modal-backdrop in" style="display:none;">
    <img style="position:fixed;top:50%;left:50%;border-radius:32px;" src="<?=base_url()?>resource/images/loading.gif">
</div>