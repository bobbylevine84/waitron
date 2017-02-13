<div class="container">
    <div class="top-heading">
        view job
        <a href="<?=base_url()?>client/jobs" class="back-link-right">back</a>
    </div>

    <div class="user-pic">
      <img src="<?=base_url()?>resource/images/wa3pic1.png" alt="">
    </div>
    <?php if (!empty($getjob)) {
    foreach ($getjob as $job) { ?>
        <?=form_open($this->uri->uri_string())?>
        <input type="hidden" name="jobid" value="<?=$job->jobid?>">
            <div class="wa3-form">
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">service type</label>
                        <select name="servicetype" class="form-control select-form" disabled>
                            <option value="">---- Select Service Type ----</option>
                            <?php foreach ($servicetype as $service) {
                                $job->servicetype==$service->servicetype ? $select='selected' : $select='';
                                echo '<option '.$select.' value="'.$service->servicetype.'">'.$service->servicetype.'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">event type</label>
                        <select name="eventtype" class="form-control select-form" disabled>
                        <option value="">---- Select Event Type ----</option>
                           <?php foreach ($eventtype as $event) {
                                $job->eventtype==$event->eventtype ? $select='selected' : $select='';
                               echo '<option '.$select.' value="'.$event->eventtype.'">'.$event->eventtype.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">project name</label>
                        <input type="text" name="projectname" value="<?=$job->projectname?>" placeholder="project name" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">date</label>
                        <input type="text" name="date" value="<?=date('m/d/Y',strtotime($job->date))?>" placeholder="date" class="form-control datepicker-input" disabled>
                    </div>
                </div>
                
                <div class="row wa3-form-row" id="timepick">
                    <div class="col-md-6">
                        <label class="label-txt">start time</label>
                        <input type="text" id="starttime" name="starttime" value="<?=date('h:i A',strtotime($job->starttime))?>" placeholder="start time" class="form-control time start" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">end time</label>
                        <input type="text" id="endtime" name="endtime" value="<?=date('h:i A',strtotime($job->endtime))?>" placeholder="end time" class="form-control time end" onchange="ecost();" disabled>
                    </div>
                </div>
                
                <div class="form-heading">job location</div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">zip code</label>
                        <input type="text" name="zipcode" value="<?=$job->zipcode?>" placeholder="zip code" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">city</label>
                        <input type="text" name="city" value="<?=$job->city?>" placeholder="city" class="form-control" disabled>
                    </div>
                </div>
                
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">state</label>
                        <input type="text" name="state" value="<?=$job->state?>" placeholder="state" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">address</label>
                        <input type="text" name="address" value="<?=$job->address?>" placeholder="address" class="form-control" disabled>
                    </div>
                </div>
                
                <!--<div class="row wa3-form-row">
                    <div class="col-md-12 map-mm">
                            <img src="<?=base_url()?>resource/images/map3.jpg" alt="">
                    </div>
                </div>-->
                
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">contact person</label>
                        <input type="text" name="contactperson" value="<?=$job->contactperson?>" placeholder="contact person" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">phone number</label>
                        <input type="text" name="phonenumber" value="<?=$job->phonenumber?>" placeholder="phone number" class="form-control" disabled>
                    </div>
                </div>
                
                <input type="hidden" name="serviceid" value="<?=$job->serviceid?>">
                <div class="form-heading">uniform</div>
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="skill-sec clearfix">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-primary <?=$job->uniform=='Barista' ? 'active' : ''?> ">
                                    <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa31.png">
                                    </div>
                                    <span class="txt-cha1">barista </span> <input type="radio" name="uniform" <?=$job->uniform=='Barista' ? 'checked' : ''?> value="Barista" autocomplete="off"> 
                                </label>
                                <label class="btn btn-primary <?=$job->uniform=='Waiter White' ? 'active' : ''?>">
                                    <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa32.png">
                                    </div>
                                    <span> waiter white </span> <input type="radio" name="uniform" <?=$job->uniform=='Waiter White' ? 'checked' : ''?> value="Waiter White" autocomplete="off"> 
                                </label>
                                <label class="btn btn-primary <?=$job->uniform=='All Black' ? 'active' : ''?>">
                                   <div class="skill-select-pic">
                                        <img alt="" src="<?=base_url()?>resource/images/wa33.png">
                                    </div>
                                    <span class="txt-cha2"> all black </span> <input type="radio" name="uniform" <?=$job->uniform=='All Black' ? 'checked' : ''?> value="All Black"  autocomplete="off"> 
                                </label>
                            </div>
                        </div>        
                    </div>
                </div>

                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">hourly rate</label>
                        <input type="hidden" name="hourlyrate" id="hrate" value="<?=$job->hourlyrate?>">
                        <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="text" class="form-control" placeholder="hourly rate" value="<?=$job->hourlyrate?>" disabled>
                        <div class="input-group-addon">.00</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" id="timediff" name="timediff" value="<?=$job->timediff?>">
                        <input type="hidden" id="estimatedcost" name="estimatedcost" value="<?=$job->estimatedcost?>">
                        <div class="esti-mate">estimated cost*: <span id="ecost"> $<?=$job->estimatedcost?> </span> </div>
                        <div class="sm-txt">*before fees and taxes</div>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">notes</label>
                        <textarea placeholder="2000 character note" name="note" class="form-control txt-fieldarea" disabled><?=$job->note?></textarea>
                    </div>
                </div>
            </div>        
    <?php } } ?>
</div>