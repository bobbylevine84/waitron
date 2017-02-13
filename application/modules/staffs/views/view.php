<?php if (!empty($staffs)) {
foreach ($staffs as $staff) { ?>
          
<div class="container">
      <div class="top-heading">
      <?=$staff->firstname." ".$staff->lastname?>
          <div class="staff-sol">waitron</div>
          <a href="<?=base_url()?>staffs" class="back-link-right">back</a>
      </div>
      <div class="wa6-profile clearfix">
          <div class="wa6-profile-left">
                <img alt="" style="width:200px;height:200px;" src="<?=$staff->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$staff->avatar ?>">
                <a data-toggle="ajaxModal" href="<?=base_url()?>staffs/changeavatar/<?=$staff->user_id?>" class="edit-pic1"></a>
          </div>
          
          <div class="wa6-profile-right">
              <div class="statistics-txt">statistics</div>
              <table width="100%" border="0">
                  <tbody>
                      <tr>
                            <td>jobs worked</td>
                            <td><strong><?php $jworked = $this->db->where('staffid',$staff->user_id)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->result(); echo count($jworked); ?></strong></td>
                      </tr>
                      <tr>
                            <td>hours worked</td>
                            <td><strong><?php $jworked = $this->db->select_sum('jobtime')->where('staffid',$staff->user_id)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->row(); echo $totalHours=round($jworked->jobtime,1); ?></strong></td>
                      </tr>
                      <tr>
                            <td>average hourly rate</td>
                            <td><strong>$<?php $jworked = $this->db->select_avg('hourlyrate')->where('staffid',$staff->user_id)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->row(); echo $avgHRate=round($jworked->hourlyrate,2); ?></strong></td>
                      </tr>
                      <tr>
                            <td>paid out</td>
                            <td><strong>$<?=$totalHours*$avgHRate?></strong></td>
                      </tr>
                      <tr>
                            <td>rating</td>
                            <td><strong>0.0</strong></td>
                      </tr>
                      <tr>
                            <td>waitron since</td>
                            <td><strong><?=date('d/m/y',strtotime($staff->created))?></strong></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <?=form_open($this->uri->uri_string())?>
      <input type="hidden" name="user_id" value="<?=$staff->user_id?>">
          <div class="wa3-form">
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">ﬁrst name</label>
                        <input type="text" name="firstname" placeholder="first name" class="form-control" value="<?=$staff->firstname?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">last name</label>
                        <input type="text" name="lastname" placeholder="last name" class="form-control" value="<?=$staff->lastname?>" required>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">zip code</label>
                        <input type="text" name="zipcode" placeholder="zip code" class="form-control" value="<?=$staff->zipcode?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">city</label>
                        <input type="text" name="city" placeholder="city" class="form-control" value="<?=$staff->city?>" required>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">state</label>
                        <input type="text" name="state" placeholder="state" class="form-control" value="<?=$staff->state?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">address</label>
                        <input type="text" name="address" placeholder="address" value="<?=$staff->address?>" class="form-control">
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">phone</label>
                        <input type="text" name="phone" placeholder="phone number" class="form-control" value="<?=$staff->phone?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">email</label>
                        <input type="hidden" name="old_email" value="<?=$staff->email?>">
                        <input type="email" name="email" placeholder="email address" value="<?=$staff->email?>" class="form-control" required>
                    </div>
                  
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">preferred method(s) of contact</label>                             
                        <div class="select-skill">
                              <div data-toggle="buttons" class="btn-group">
                                  <label class="btn btn-primary <?=$staff->moc_email=='Yes' ? 'active' : '' ?> ">
                                      email <input type="checkbox" name="moc_email" value="Yes" <?=$staff->moc_email=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                                  </label>
                                  <label class="btn btn-primary <?=$staff->moc_call=='Yes' ? 'active' : '' ?> ">
                                    call  <input type="checkbox" name="moc_call" value="Yes" <?=$staff->moc_call=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                                  </label>
                                  <label class="btn btn-primary <?=$staff->moc_text=='Yes' ? 'active' : '' ?> ">
                                    text  <input type="checkbox" name="moc_text" value="Yes" <?=$staff->moc_text=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                                  </label>
                              </div>
                        
                        </div>
                    </div>
                </div>
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">banking information</label>
                        <input type="text" name="routingnumber" placeholder="routing number" value="<?=$staff->routingnumber?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">&nbsp;</label>
                        <input type="text" name="accountnumber" placeholder="account number" value="<?=$staff->accountnumber?>" class="form-control">
                    </div>
                </div>
                <?php $skills_array=explode(", ",$staff->skills); 
                function active($value, $skills_array)
                {
                  $test=array_search($value, $skills_array);
                  echo strval($test)!='' ? 'active' : '';
                }
                function checked($value, $skills_array)
                {
                  $test=array_search($value, $skills_array);
                  echo strval($test)!='' ? 'checked' : '';
                }
                ?>
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">select your skills</label>
                        <div class="skill-sec clearfix">
                            <div data-toggle="buttons" class="btn-group">
                                <?php foreach ($servicetype as $service) {  ?>
                                    <label class="btn btn-primary <?=active($service->servicetype,$skills_array);?> ">
                                        <div class="skill-select-pic">
                                            <img style="width:162px; height:162px" src="<?=base_url()?>resource/service/<?=$service->serviceicon?>">
                                        </div>
                                        <span><?=$service->servicetype?> </span> <input type="checkbox" name="skills[]" value="<?=$service->servicetype?>" <?=checked($service->servicetype,$skills_array);?> > 
                                    </label>
                                <?php } ?>
                              </div>
                        </div>    
                    </div>
                </div>

                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="text-center"> <input type="submit" class="submit-btn" name="update" value="Save Changes"> </div>
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
                                    <p>Christine is a fantastic waitron! I’ve had the opportunity to hire her multiple times and each time she is on time and extremely professional! </p>
                                </td>
                                <td> <img alt="" src="<?=base_url()?>resource/images/rate5.png" style="height: 43px; width: auto;"> </td>
                                <td>
                                      <div class="rate-pic"><img alt="" style="height:77px; width:77px;" src="<?=$staff->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$staff->avatar ?>"> </div>
                                      <h2>Jane Sarratt</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Christine saved me from a last-minute call-out. She is skilled, smart and professional. I can’t say enough good things about her.</p>
                                </td>
                                <td> <img alt="" src="<?=base_url()?>resource/images/rate4.png" style="height: 43px; width: auto;"> </td>
                                <td>
                                      <div class="rate-pic"><img alt="" style="height:77px; width:77px;" src="<?=$staff->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$staff->avatar ?>"></div>
                                      <h2>Tony Digrego</h2>
                                </td>
                            </tr>
                        </tbody>      
                    </table>
                </div>
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="text-center"> <a data-toggle="ajaxModal" href="<?=base_url()?>staffs/staffrating/<?=$staff->user_id?>"> <input type="button" class="submit-btn" value="view more"> </a></div>
                    </div>
                </div> -->
                
                <ul class="category-view clearfix">
                    <?php if($this->tank_auth->checkPermission('staff_jh')) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/jobhistory/<?=$staff->user_id?>">job history</a></li>
                    <?php } if($this->tank_auth->checkPermission('staff_ph')) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/paymenthistory/<?=$staff->user_id?>">payment history</a></li>
                    <?php } if($this->tank_auth->checkPermission('staff_wd')) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/workdocuments/<?=$staff->user_id?>">work documents</a></li>
                    <?php } if($this->tank_auth->checkPermission('staff_cmp')) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/manualpayment/<?=$staff->user_id?>">create manual payment</a></li>
                    <?php } if($this->tank_auth->checkPermission('staff_daa')) { ?>
                    <?php if($staff->activated==1) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/deactivateaccount/<?=$staff->user_id?>">deactivate account</a></li>
                    <?php } else { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/activateaccount/<?=$staff->user_id?>">activate account</a></li>
                    <?php } ?>
                    <?php } if($this->tank_auth->checkPermission('staff_da')) { ?>
                    <li><a data-toggle="ajaxModal" href="<?=base_url()?>staffs/deleteaccount/<?=$staff->user_id?>">delete account</a></li>
                    <?php } ?>
                </ul>
          </div>        
      </form>
</div>

<?php } } ?>

<div class="loading modal-backdrop in" style="display:none;">
    <img style="position:fixed;top:50%;left:50%;border-radius:32px;" src="<?=base_url()?>resource/images/loading.gif">
</div>
                    
                  
