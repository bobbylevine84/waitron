<?php $user=$this->db->where('user_id',$this->tank_auth->get_user_id())->get('user_info')->row();
    $hourlyrate=$user->hourlyrate; ?>
<div class="container">
    <div class="top-heading">
          post event
          <a href="<?=base_url()?>client/jobs" class="back-link-right">back</a>
    </div>
    <div class="user-pic">
        <img src="<?=base_url()?>resource/images/wa3pic1.png" alt="">
    </div>
    <?=form_open($this->uri->uri_string())?>
    <input type="hidden" name="createdby" value="<?=$user_id?>">
    <input type="hidden" name="hrate" value="<?=$hourlyrate?>">
        <div class="wa3-form">
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
                      <label class="label-txt">project name</label>
                      <input type="text" name="projectname" placeholder="project name" class="form-control" required>
                  </div>
              </div>
              
              <div class="row wa3-form-row" id="timepick">
                  <div class="col-md-6">
                      <label class="label-txt">start time</label>
                      <input type="text" id="starttime" name="starttime" placeholder="start time" class="form-control time start" required>
                  </div>
                  <div class="col-md-6">
                      <label class="label-txt">end time</label>
                      <input type="text" id="endtime" name="endtime" placeholder="end time" class="form-control time end" required>
                  </div>
              </div>
              
              <div class="row wa3-form-row">
                  <div class="col-md-6">
                      <label class="label-txt">date</label>
                      <input type="text" name="date" placeholder="date" class="form-control datepicker-input" required>
                  </div>
              </div>
              
              <div class="form-heading">event location</div>
              
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

              <!-- ///////// Java Script For Add Event For Client Panel -->

              <script type="text/javascript">

              function finalcost()
              {
                  <?php $id=1; $count=count($servicetype); $final=''; 
                  foreach ($servicetype as $service) 
                  { 
                      if($id==$count)
                      {
                          $final.='estimatedcost'.$id;
                      }
                      else
                      {
                          $final.= 'estimatedcost'.$id.'+';
                      } ?>
                      var estimatedcost<?=$id?>=parseFloat(document.getElementById('estimatedcost<?=$id?>').value);

                      <?php $id++; 
                  } ?>
                  var eccost=parseFloat(document.getElementById("eccost").value);
                  var finalcost=<?=$final?>+eccost;
                  document.getElementById("estimatedcost").value=finalcost;
                  document.getElementById("finalcost").textContent='$ ' + finalcost.format(2);
              }

              function finalquantity(quant,timediff)
              {
                  <?php $id=1; $count=count($servicetype); $finalq=''; 
                  foreach ($servicetype as $service) 
                  { 
                      if($id==$count)
                      {
                          $finalq.='quantity'.$id;
                      }
                      else
                      {
                          $finalq.= 'quantity'.$id.'+';
                      } ?>
                      var quantity<?=$id?>=parseFloat(document.getElementById('quantity<?=$id?>').value);

                      <?php $id++; 
                  } ?>

                  var finalquantity=<?=$finalq?>;
                  document.getElementById("quantity").value=finalquantity;
                  $('#finalqunt').html(finalquantity);
                  document.getElementById("eccost").value='0';
                  if(finalquantity<=4 && quant<=4)
                  {
                    document.getElementById("ecaptain").innerHTML='';
                  }
                  if(finalquantity>=5 && finalquantity<=9 && quant<=4)
                  {
                    addecaption(finalquantity,timediff);
                  }
                  if(finalquantity>=10 && finalquantity<=<?=$scount*4?> && quant<=4)
                  {
                    addecaption(finalquantity,timediff);
                    var eccost= parseFloat(document.getElementById("eccost").value);
                    finaleccost=+eccost + +(timediff*10);
                    document.getElementById("eccost").value=finaleccost;
                  }
                  if(finalquantity>=18)
                  {
                    addecaption(finalquantity,timediff);
                    var eccost= parseFloat(document.getElementById("eccost").value);
                    finaleccost=+eccost + +(timediff*10);
                    document.getElementById("eccost").value=finaleccost;
                  }
                  else
                  {
                    document.getElementById("ecaptain").innerHTML='';
                  }
              }

                  
              function addservices(services)
              {
                  var service = services.value;
                  var servicecheck = services.checked;
                  if(servicecheck==true)
                  {
                      $.ajax({
                         type: "POST",
                         url: "addservice/" +service, 
                         cache:false,
                         success:function(data)
                            {
                              <?php foreach ($servicetype as $service) {  ?>
                                if(service=='<?=$service->servicetype?>')
                                {
                                  $("#<?=$service->servicetype?>").show();
                                  $("#<?=$service->servicetype?>").html(data);
                                }
                              <?php } ?>
                            }
                        });
                      }
                  else
                  {
                      <?php $k=1; foreach ($servicetype as $service) {  ?>
                      if(service=='<?=$service->servicetype?>')
                        {
                          $("#<?=$service->servicetype?>").html('<input type="hidden" id="estimatedcost<?=$k?>" name="estimatedcost<?=$k?>" value="0"><input type="hidden" id="quantity<?=$k?>" name="quantity<?=$k?>" value="0">');
                        }
                      <?php $k++; }  ?>
                      finalcost();
                  }
              }

              function addcaption(quantity,id,time)
              {
                  $.ajax({
                       type: "POST",
                       url: "addcaptain/"+quantity+"/"+id+"/"+time,
                       cache:false,
                       success:function(data)
                          {
                            $("#captain"+id).html(data);
                          }
                      });
              }

              function addecaption(finalquantity,time)
              {
                  $.ajax({
                       type: "POST",
                       url: "addecaptain/"+finalquantity+"/"+time,
                       cache:false,
                       success:function(data)
                          {
                            $("#ecaptain").html(data);
                          }
                      });
              }

              function updatecost(ecaptain,timediff)
              {
                  var ecaptaincheck = ecaptain.checked;
                  if(ecaptaincheck==true)
                  {
                      var eccost= parseFloat(document.getElementById("eccost").value);
                      finaleccost=+eccost + +(timediff*10);
                      document.getElementById("eccost").value=finaleccost;
                      finalcost();
                  }
                  else
                  {
                      var eccost= parseFloat(document.getElementById("eccost").value);
                      finaleccost=+eccost - +(timediff*10);
                      document.getElementById("eccost").value=finaleccost;
                      finalcost();
                  }
              }
              
              <?php $p=1; foreach ($servicetype as $service) {  ?>

              function ecost<?=$p?>(quant)
              {
                  var starttime=document.getElementById("starttime").value;
                  var endtime=document.getElementById("endtime").value;
                  if(starttime=='' || endtime=='')
                  {
                      alert('please first select start time & end time');
                      $('html, body').animate({
                          scrollTop: $("#starttime").offset().top
                      }, 2000);
                      $( "#starttime" ).focus();
                  }
                  else
                  {
                      var timeDiffer= datepair.refresh();
                      var timeDiffer= datepair.getTimeDiff();
                      var time=timeDiffer/3600000;
                      if(time<3)
                      {
                          alert("less than 3 hours job/event would't be allowed");
                          $('html, body').animate({
                              scrollTop: $("#endtime").offset().top
                          }, 2000);
                          $( "#endtime" ).focus();
                      }
                      else
                      {
                          document.getElementById("timediff").value=time;
                          var hrate='<?=$hourlyrate?>';
                          var quantity=quant.value;
                          var ecost=quantity*hrate*time;
                          document.getElementById("ecost<?=$p?>").textContent='$ ' + ecost.format(2);
                          document.getElementById("estimatedcost<?=$p?>").value=ecost;
                          caption(quantity,<?=$p?>,time,ecost);
                          finalquantity(quantity,time);
                          finalcost();
                      }

                      
                  }
              }

              function updatecost<?=$p?>(captain,time)
              {
                  var captaincheck = captain.checked;
                  if(captaincheck==true)
                  {
                      var estimatedcost=document.getElementById("estimatedcost<?=$p?>").value;
                      var fcost= +estimatedcost + +(time*10);
                      document.getElementById("ecost<?=$p?>").textContent='$ ' + fcost.format(2);
                      document.getElementById("estimatedcost<?=$p?>").value=fcost;
                      finalcost();
                  }
                  else
                  {
                      var estimatedcost=document.getElementById("estimatedcost<?=$p?>").value;
                      var fcost= +estimatedcost - +(time*10);
                      document.getElementById("ecost<?=$p?>").textContent='$ ' + fcost.format(2);
                      document.getElementById("estimatedcost<?=$p?>").value=fcost;
                      finalcost();
                  }
              }

              <?php $p++; } ?>

              function caption(quantity,id,time,ecost)
              {
                  if(quantity<=4)
                  {
                    document.getElementById("captain"+id).innerHTML='';
                  }
                  if(quantity>=5 && quantity<=9)
                  {
                    addcaption(quantity,id,time);
                  }
                  if(quantity>=10)
                  {
                    addcaption(quantity,id,time);
                    ecost=+ecost + +(time*10);
                    document.getElementById("ecost"+id).textContent='$ ' + ecost.format(2);
                    document.getElementById("estimatedcost"+id).value=ecost;
                  }
              }

              </script>

              <!-- //////// For Ajax call on Add Services -->

              <div class="form-heading">add services</div>
              <div class="select-skill">
                  <div class="text-center">
                      <div data-toggle="buttons" class="btn-group">
                          <?php foreach ($servicetype as $service) {  ?>  
                              <label class="btn btn-primary">
                                  <?=$service->servicetype?>s <input type="checkbox" name="services[]" value="<?=$service->servicetype?>" onchange="addservices(this);"> 
                              </label>
                          <?php } ?>
                      </div>
                  </div>
              </div>

              <!-- //////////Ajax Resopnse -->
              <?php $j=1; foreach ($servicetype as $service) { ?>
                  <div id="<?=$service->servicetype?>" >
                      <input type="hidden" id="estimatedcost<?=$j?>" name="estimatedcost<?=$j?>" value="0">
                      <input type="hidden" id="quantity<?=$j?>" name="quantity<?=$j?>" value="0">
                  </div>
              <?php $j++; } ?>
              
              <div id="ecaptain"></div> 

              <div class="row wa3-form-row">
                  <div class="col-md-12">
                      <label class="label-txt">notes</label>
                      <textarea placeholder="2000 character note" name="note" class="form-control txt-fieldarea"></textarea>
                  </div>
              </div>

              <div class="we9-heading">total positions: <span class="txt-clr" id="finalqunt">0</span></div>
              <!-- <div class="row wa3-form-row">
                  <div class="col-md-12">
                      <div class="blu-box">
                            <div class="blu-box1">we’ve matched</div>
                            <div class="blu-box2">0</div>
                            <div class="blu-box1">possible waitrons for this job</div>
                      </div>
                  </div>
              </div> -->
              <div class="we9-heading-esti">estimated total before fees and taxes and additional hours:  </div>
              <input type="hidden" id="timediff" name="timediff" value="">
              <input type="hidden" id="quantity" name="quantity" value="">
              <input type="hidden" id="eccost" name="eccost" value="0">
              <input type="hidden" id="estimatedcost" name="estimatedcost" value="">
              <div class="dollar-txt" id="finalcost">$0.00</div>
              <div class="row wa3-form-row">
                  <div class="col-md-12">
                      <div class="text-center"> <input type="submit" name="addevent" class="submit-btn" value="submit"> </div>
                  </div>
              </div>
        </div>        
    </form>
</div>

<div class="popup1 pop-border">     
  <div aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" class="modal fade captain-info" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button> -->
        <div class="wa10-pop">
          <div class="pop-caption-head">what is a captain?</div>
          <div class="pop-caption-dec">
            <p>a captain is a waitron with a few years of service, management and leadership under their belt. the captain is your single point of contact at your event who will manage, check-in/out and oversee all the waitrons working at your event so all you have to do is relax! </p>

            <p>Their rate is different from other waitrons which is your standard hourly rate per waitron + $10/hour more. a small price to pay for some major barista waiter white all black relief for you!</p>
          </div>
          <ul class="yes-no-select clearfix">
            <li class="no-select"> <a href="javascript:void(0)" aria-label="Close" data-dismiss="modal">got it!</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>