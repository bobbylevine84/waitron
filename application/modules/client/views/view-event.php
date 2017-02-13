<?php $getevent=$getevent[0]; ?>
<div class="container">
    <div class="top-heading">
          post event
          <a href="<?=base_url()?>client/jobs" class="back-link-right">back</a>
    </div>
    <div class="user-pic">
        <img src="<?=base_url()?>resource/images/wa3pic1.png" alt="">
    </div>
    <?=form_open($this->uri->uri_string())?>
        <div class="wa3-form">
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">event type</label>
                      <select name="eventtype" class="form-control select-form" disabled>
                      <option value="">---- Select Event Type ----</option>
                          <?php foreach ($eventtype as $event) { ?>
                              <option value="<?=$event->eventtype?>" <?=$event->eventtype==$getevent->eventtype ? 'selected' : ''?>><?=$event->eventtype?></option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">project name</label>
                      <input type="text" name="projectname" placeholder="project name" class="form-control" value="<?=$getevent->projectname?>" disabled>
                  </div>
              </div>
              
              <div class="row wa3-form-row" id="timepick">
                  <div class="col-md-6">
                      <label class="label-txt">start time</label>
                      <input type="text" id="starttime" name="starttime" placeholder="start time" class="form-control time start" value="<?=$getevent->starttime?>" disabled>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">end time</label>
                      <input type="text" id="endtime" name="endtime" placeholder="end time" class="form-control time end" value="<?=$getevent->endtime?>" disabled>
                  </div>
              </div>
              
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">date</label>
                      <input type="text" name="date" placeholder="date" class="form-control datepicker-input" value="<?=date('m/d/y',strtotime($getevent->date))?>" disabled>
                  </div>
              </div>
              
              <div class="form-heading">event location</div>
              
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">contact person</label>
                      <input type="text" name="contactperson" placeholder="contact person" class="form-control" value="<?=$getevent->contactperson?>" disabled>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">phone number</label>
                      <input type="text" name="phonenumber" placeholder="phone number" class="form-control" value="<?=$getevent->phonenumber?>" disabled>
                  </div>
              </div>
              
              
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">zip code</label>
                      <input type="text" name="zipcode" placeholder="zip code" class="form-control" value="<?=$getevent->zipcode?>" disabled>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">city</label>
                      <input type="text" name="city" placeholder="city" class="form-control" value="<?=$getevent->city?>" disabled>
                  </div>
              </div>
              
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">state</label>
                      <input type="text" name="state" placeholder="state" class="form-control" value="<?=$getevent->state?>" disabled>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">address</label>
                      <input type="text" name="address" placeholder="address" class="form-control" value="<?=$getevent->address?>" disabled>
                  </div>
              </div>
              
              <!--<div class="row wa3-form-row">
                  <div class="col-md-12 map-mm">
                          <img src="<?=base_url()?>resource/images/map3.jpg" alt="">
                  </div>
              </div>-->



              <!-- //////// For Ajax call on Add Services -->
              
              <div class="form-heading">add services</div>
              <div class="select-skill">
                  <div class="text-center">
                      <div data-toggle="buttons" class="btn-group">
                          <?php foreach ($servicetype as $service) {  ?>  
                              <label class="btn btn-primary disabled <?php foreach ($getservices as $services) { if($services->servicetype==$service->servicetype) echo 'active'; } ?> ">
                                  <?=$service->servicetype?>s <input type="checkbox" disabled <?php foreach ($getservices as $services) { if($services->servicetype==$service->servicetype) echo 'checked'; } ?> > 
                              </label>
                          <?php } ?>
                      </div>
                  </div>
              </div>

              <!-- ///////// Java Script For Add Event For Client Panel -->

              <?php $user=$this->db->where('user_id',$this->tank_auth->get_user_id())->get('user_info')->row();
                  $hourlyrate=$user->hourlyrate; ?>
              <?php $j=1; foreach ($getservices as $service) { ?>

                  <div class="we9-heading"><?=$service->servicetype?>s</div>
                  <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">quantity</label>
                        <select name="quantity<?=$j?>" id="quantity<?=$j?>" class="form-control select-form" onchange="ecost<?=$j?>(this)" disabled>
                            <option value="0"> ---- Select Quantity ---- </option>
                            <?php for ($i=1; $i<=20 ; $i++) { 
                              if($i==$service->quantity) {
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                              } else {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } ?>
                        </select>
                    </div>
                  </div>
                  <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <input type="text" value="$<?=$hourlyrate?>.00" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <div class="esti-mate">estimated cost*: <span id="ecost<?=$j?>">  $<?=number_format($service->secost,2,'.','')?>  </span> </div>
                        <div class="sm-txt">*before fees</div>
                    </div>
                  </div>                          
                  <div class="form-heading">uniform</div>                       
                  <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="skill-sec clearfix">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-primary <?=$service->uniform=='Barista' ? 'active' : ''?>">
                                    <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa31.png">
                                    </div>
                                    <span class="txt-cha1">barista </span> <input type="radio" name="uniform<?=$j?>" value="Barista" disabled <?=$service->uniform=='Barista'? 'checked' : ''?> disabled> 
                                </label>
                                <label class="btn btn-primary <?=$service->uniform=='Waiter White'? 'active' : ''?>">
                                    <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa32.png">
                                    </div>
                                    <span> waiter white </span> <input type="radio" name="uniform<?=$j?>" value="Waiter White" disabled <?=$service->uniform=='Waiter White'? 'checked' : ''?> disabled> 
                                </label>
                                <label class="btn btn-primary <?=$service->uniform=='All Black' ? 'active' : ''?>">
                                   <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa33.png">
                                    </div>
                                    <span class="txt-cha2"> all black </span> <input type="radio" name="uniform<?=$j?>" value="All Black" disabled <?=$service->uniform=='All Black' ? 'checked' : ''?> disabled> 
                                </label>
                            </div>
                        </div>        
                    </div>
                  </div>
                  <?php if($service->scaptain=='Yes') { ?>
                  <div class="form-heading"> service captain </div>
                  <div class="insure-txt">
                      <h2>to ensure the best experience for you and your event, we recommend having a captain. </h2>
                      <p><a href="javascript:void(0)" data-toggle="modal" data-target=".captain-info"> to learn more, click here. </a> </p>
                  </div>
                  <div class="piolet-pic">
                        <img src="<?=base_url()?>resource/images/captain.png" alt="">
                  </div>
                  <div class="select-skill">
                      <div class="text-center">
                          <div data-toggle="buttons" class="btn-group">
                              <label class="btn btn-primary active">
                                  yes! add a captain <input type="checkbox" checked="" checked=""  autocomplete="off" disabled>
                              </label>
                          </div>
                      </div>
                  </div>
                  <?php } ?>
              <?php  $j++; } ?>

              <?php if($getevent->ecaptain=='Yes') { ?>
                  <div class="form-heading"> event captain </div>
                  <div class="insure-txt">
                      <h2>to ensure the best experience for you and your event, we recommend having a captain. </h2>
                      <p><a href="javascript:void(0)" data-toggle="modal" data-target=".captain-info"> to learn more, click here. </a> </p>
                  </div>
                  <div class="piolet-pic">
                        <img src="<?=base_url()?>resource/images/captain.png" alt="">
                  </div>
                  <div class="select-skill">
                      <div class="text-center">
                          <div data-toggle="buttons" class="btn-group">
                              <label class="btn btn-primary active">
                                  yes! add a captain <input type="checkbox" checked="" checked=""  autocomplete="off" disabled>
                              </label>
                          </div>
                      </div>
                  </div>
              <?php } ?>

              <div class="row wa3-form-row">
                  <div class="col-md-12">
                      <label class="label-txt">notes</label>
                      <textarea placeholder="2000 character note" name="note" class="form-control txt-fieldarea" disabled><?=$getevent->note?></textarea>
                  </div>
              </div>

              <div class="we9-heading-esti">estimated total before fees and taxes and additional hours:  </div>
              <div class="dollar-txt" id="finalcost">$<?=number_format($getevent->estimatedcost,2,'.','')?></div>
        </div>        
    </form>
</div>