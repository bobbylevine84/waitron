 <script type="text/javascript">
    function gethr(id) 
    {
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>jobs/gethr/'+id,
            success: function(data)
            {
              $('#hourlyrate').val(data);
              $('#hrate').val(data);
            }
        });
    }
    function ecost()
    {
        var timeDiffer= datepair.refresh();
        var timeDiffer= datepair.getTimeDiff();
        var time=timeDiffer/3600000;
        document.getElementById("timediff").value=time;
        var hrate=document.getElementById("hourlyrate").value;
        var ecost=time*hrate;
        document.getElementById("estimatedcost").value=ecost.format(2);
        document.getElementById("ecost").textContent='$ ' + ecost.format(2);
    }
</script>
 <div class="container">
    <div class="top-heading">
        add job
        <a href="<?=base_url()?>jobs" class="back-link-right">back</a>
    </div>

    <div class="user-pic">
    <img src="<?=base_url()?>resource/images/wa3pic1.png" alt="">
    </div>

     <?=form_open($this->uri->uri_string())?>
        <div class="wa3-form">
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">client</label>
                    <select name="createdby" class="form-control select-form" required onchange="if(this.value!='')gethr(this.value);">
                        <option value="">---- Select Client ----</option>
                        <?php foreach ($clients as $client) {
                           echo '<option value="'.$client->user_id.'">'.$client->firstname.' '.$client->lastname.'</option>';
                        } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">service type</label>
                    <select name="servicetype" class="form-control select-form" required>
                        <option value="">---- Select Service Type ----</option>
                        <?php foreach ($servicetype as $service) {
                           echo '<option value="'.$service->servicetype.'">'.$service->servicetype.'</option>';
                        } ?>
                    </select>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">event type</label>
                    <select name="eventtype" class="form-control select-form" required>
                    <option value="">---- Select Event Type ----</option>
                       <?php foreach ($eventtype as $event) {
                           echo '<option value="'.$event->eventtype.'">'.$event->eventtype.'</option>';
                        } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">date</label>
                    <input type="text" name="date" placeholder="date" class="form-control datepicker-input" required>
                </div>
            </div>
            
            
            <div class="row wa3-form-row" id="timepick">
                <div class="col-md-6">
                    <label class="label-txt">start time</label>
                    <input type="text" id="starttime" name="starttime" placeholder="start time" class="form-control time start" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">end time</label>
                    <input type="text" id="endtime" name="endtime" placeholder="end time" class="form-control time end" onchange="ecost();" required>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">hourly rate</label>
                    <input type="hidden" name="hrate" id="hrate" value="">
                    <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input type="text" class="form-control" name="hourlyrate" id="hourlyrate" placeholder="hourly rate" value="" disabled>
                    <div class="input-group-addon">.00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="hidden" id="timediff" name="timediff" value="">
                    <input type="hidden" id="estimatedcost" name="estimatedcost" value="">
                    <div class="esti-mate">estimated cost*: <span id="ecost"> $0.00 </span> </div>
                    <div class="sm-txt">*before fees and taxes</div>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">contact person</label>
                    <input type="text" name="contactperson" placeholder="contact person" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">phone number</label>
                    <input type="text" name="phonenumber" placeholder="phone number" class="form-control" required>
                </div>
            </div>
            
            <div class="form-heading">uniform</div>
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="skill-sec clearfix">
                        <div data-toggle="buttons" class="btn-group">
                            <label class="btn btn-primary">
                                <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa31.png">
                                </div>
                                <span class="txt-cha1">barista </span> <input type="radio" name="uniform" value="Barista" checked="" autocomplete="off"> 
                            </label>
                            <label class="btn btn-primary">
                                <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa32.png">
                                </div>
                                <span> waiter white </span> <input type="radio" name="uniform" value="Waiter White" autocomplete="off"> 
                            </label>
                            <label class="btn btn-primary">
                               <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa33.png">
                                </div>
                                <span class="txt-cha2"> all black </span> <input type="radio" value="All Black" name="uniform" autocomplete="off"> 
                            </label>
                        </div>
                    </div>        
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">zip code</label>
                    <input type="text" name="zipcode" placeholder="zip code" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">city</label>
                    <input type="text" name="city" placeholder="city" class="form-control" required>
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">state</label>
                    <input type="text" name="state" placeholder="state" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">address</label>
                    <input type="text" name="address" placeholder="address" class="form-control" required>
                </div>
            </div>
            
            <!--<div class="row wa3-form-row">
                <div class="col-md-12 map-mm">
                    <img src="<?=base_url()?>resource/images/map3.jpg" alt="">
                </div>
            </div>-->                      
            
            
            <!-- div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="blu-box">
                        <div class="blu-box1">we’ve matched</div>
                        <div class="blu-box2">0</div>
                        <div class="blu-box1">possible waitrons for this job</div>
                    </div>
                </div>
            </div> -->
            
            <?php if($this->tank_auth->checkPermission('job_add_submit')){ ?>
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="text-center"> <input type="submit" name="addjob" value="submit" class="submit-btn"> </div>
                </div>
            </div>
            <?php } ?>    
        </div>              
    </form>
</div>