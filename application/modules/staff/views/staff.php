<?php 
    function checkAvailability($day,$time,$availability)
    {
        date_default_timezone_set("Asia/Kolkata");
        // default status
        $status = 'closed';
        // get current time object
        $newdate=new DateTime();
        $currentTime = $newdate->setTimestamp(strtotime($time));
        if($availability[$day]!='')
        {
            // loop through time ranges for current day
            foreach ($availability[$day] as $startTime => $endTime) {
                // create time objects from start/end times
                $startTime = DateTime::createFromFormat('h:i A', $startTime);
                $endTime   = DateTime::createFromFormat('h:i A', $endTime);
                // check if current time is within a range
                if (($startTime <= $currentTime) && ($currentTime < $endTime)) {
                    $status = 'open';
                    break;
                }
            }
        }
        return $status;
    }

    function checkBooked($day,$time,$booked)
    {
        date_default_timezone_set("Asia/Kolkata");
        // default status
        $status = 'closed';
        // get current time object
        $newdate=new DateTime();
        $currentTime = $newdate->setTimestamp(strtotime($time));
        if($booked[$day]!='')
        {
            // loop through time ranges for current day
            foreach ($booked[$day] as $startTime => $endTime) 
            {
                // create time objects from start/end times
                $startTime = DateTime::createFromFormat('h:i A', $startTime);
                $endTime   = DateTime::createFromFormat('h:i A', $endTime);
                // check if current time is within a range
                if (($startTime <= $currentTime) && ($currentTime < $endTime)) {
                    $status = 'open';
                    break;
                }
            }
        }
        return $status;
    }

    function checkBlocked($day,$time,$blocked)
    {
        date_default_timezone_set("Asia/Kolkata");
        // default status
        $status = 'closed';
        // get current time object
        $newdate=new DateTime();
        $currentTime = $newdate->setTimestamp(strtotime($time));
        if($blocked[$day]=='Blocked')
        {
            $status='blocked';
        }
        elseif($blocked[$day]=='')
        {

        }
        else
        {
            // loop through time ranges for current day
            foreach ($blocked[$day] as $startTime => $endTime) 
            {
                // create time objects from start/end times
                $startTime = DateTime::createFromFormat('h:i A', $startTime);
                $endTime   = DateTime::createFromFormat('h:i A', $endTime);
                // check if current time is within a range
                if (($startTime <= $currentTime) && ($currentTime < $endTime)) {
                    $status = 'open';
                    break;
                }
            }
        }
        return $status;
    }

    function humanTiming($time)
    {
        $time = strtotime($time);
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
?>

<?php
//print_r($staffSchedule);
$staffSchedule=(array)$staffSchedule[0];
$blocktime=$staffSchedule['blocktime'];

// Avilable Timings
$availability=json_decode($staffSchedule['availability'],TRUE);
$availability=(array)$availability;

//Booked Timings
$booked=json_decode($staffSchedule['booked'],TRUE);
$booked=(array)$booked;

//Blocked Timings
$blocked=json_decode($staffSchedule['block'],TRUE);
$blocked=(array)$blocked;
//echo "<pre>";
//print_r($staffSchedule['udate']);


if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
<!-- <a href="<?=base_url()?>staff/defaults" style="text-decoration:none;"><div class="standmode"><input type="submit" value="set default schedule" class="save-btn" ></div></a> -->
<div class="container">
    <div class="welcome-back">
          <h2>welcome back</h2>
          <h1><?=$staff->firstname.' '.$staff->lastname?></h1>
          <h3>schedule</h3>
          <div class="last-update">last updated: <span><?=humanTiming($staffSchedule['udate'])?> ago</span></div>
          <div class="week-update">week of:  <span><?=date('l, F j, Y',strtotime('last Sunday')) ?></span></div> 
          <div class="chek-uncheck">
              <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-primary <?=$staff->standby==0? '' : 'active'?>" title="<?=$staff->standby==0? 'On' : 'Off'?>">
                      <input type="checkbox" autocomplete="off" checked> standby <br> mode
                  </label>
              </div>
          </div>
    </div>
    <script type="text/javascript">
        function changebg(ids) { 
            $("input[name='blocked[]']").each(function () {
               if (this.checked) {
                  var id=$(this).val();
                  $('#bol'+id).val('Blocked');
                  $('.bgc'+id).css('background-color','#8c8f8e');
                  $('.tb'+id).css('border-left','7px solid #2abce3');
                  $('.tb'+id).css('border-right','7px solid #2abce3');
                  $('.tbt'+id).css('border-top','7px solid #2abce3');
                  $('.tbb'+id).css('border-bottom','7px solid #2abce3');
                  $('.bgc'+id).removeAttr('data-toggle');
                  $('.bgc'+id).removeAttr('data-target');
                  $('.textbgc'+id).html('block entire day');
               } else {
                  var id=$(this).val();
                  $('#bol'+id).val('Available');
                  $('.bgc'+id).css('background-color','#c2c6c4');
                  $('.tb'+id).css('border-left','1px solid #2abce3');
                  $('.tb'+id).css('border-right','1px solid #2abce3');
                  $('.tbt'+id).css('border-top','1px solid #2abce3');
                  $('.tbb'+id).css('border-bottom','1px solid #2abce3');
                  $('.textbgc'+id).html('&nbsp;');
               }
            });
        }

        //Add Addition input box for DNS SERVER in the domain Registration
        function addField(i) {

            $("#items"+i).append('<div class="row remove"><div class="col-md-12"><div id="timepick"><ul><li><input name="start'+i+'[]" type="text" class="form-control alltime start" placeholder="Start Time"></li><li><div class="time_to">TO</div></li><li><input type="text" name="end'+i+'[]" class="form-control alltime end" placeholder="End Time"></li><li><button class="deletetimespan delete" id="remove">Delete</button></li></ul></div></div></div>');

            $("body").on("click", ".delete", function () {
                $(this).closest(".remove").remove();
            });

            ///////////////// Evening Block Time For Staff ///////////////////
            $('.alltime').timepicker({
                'timeFormat': 'h:i A'
                <?php if($blocktime!='') { ?>,'disableTimeRanges': <?php echo $blocktime; } ?>
            });
        }

        function savedaydata(day,nextday) {
            var start = new Array();
            var n = $("input[name^='start"+day+"']").length;
            var array = $("input[name^='start"+day+"']");
            for(i=0;i < n;i++) {
                if(array.eq(i).val()=='')
                {
                    $('.'+day).html('Please fill Start Time');
                    $('.'+day).show();
                    return false;
                }
                else
                {
                    start.push(array.eq(i).val());
                }
                
            }
            var end = new Array();
            var n = $("input[name^='end"+day+"']").length;
            var array = $("input[name^='end"+day+"']");
            for(i=0;i < n;i++) {
                if(array.eq(i).val()=='')
                  {
                      $('.'+day).html('Please fill End Time');
                      $('.'+day).show();
                      return false;
                  }
                  else
                  {
                      end.push(array.eq(i).val());
                  }
            }
            var scheduleid= $("#scheduleid").val();
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>staff/savedaydata',
                data: "scheduleid="+scheduleid+"&day="+day+"&start="+start+"&end="+end,
                success: function(data)
                {
                  $('.'+day).html(data);
                  $('.'+day).show(data);
                  if(nextday<=7)
                    {
                        setTimeout( function(){ 
                            $('.item').removeClass('active');
                            $('.pop'+nextday).addClass('active');
                            $('.tiem-slot').modal('show');
                        }  , 2000 );
                    }
                }
            });
        }

        function daywisepop(day) {
            $('.item').removeClass('active');
            $('.pop'+day).addClass('active');
            $('.tiem-slot').modal('show');
        }
    </script>

    <?=form_open($this->uri->uri_string())?>
    <input type="hidden" name="scheduleid" id="scheduleid" value="<?=$staffSchedule['scheduleid']?>">
        <div class="wa5-table">
            <div class="table-responsive">
                <table width="100%" border="0" class="scroll table">
                  <thead>
                      <tr>
                          <th>&nbsp;</th>
                          <?php 
                            $k=-date('w');
                            for ($l=1; $l<=7; $l++) { 
                                echo "<th>".strtolower(date('l', strtotime($k.' day')))."<br>".date('M-j', strtotime($k.' day'))."</th>";
                                $k++;
                          } ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  

                  $timeslot=array("","12:00 AM","12:30 AM","01:00 AM","01:30 AM","02:00 AM","02:30 AM","03:00 AM","03:30 AM","04:00 AM","04:30 AM","05:00 AM","05:30 AM","06:00 AM","06:30 AM","07:00 AM","07:30 AM","08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 PM","12:30 PM","01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM","03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM","06:30 PM","07:00 PM","07:30 PM","08:00 PM","08:30 PM","09:00 PM","09:30 PM","10:00 PM","10:30 PM","11:00 PM","11:30 PM");
                  $days=array("","Sun","Mon","Tue","Wed","Thu","Fri","Sat");
                  
                  $i=1;
                  foreach ($timeslot as $time) 
                  {
                      if($i==1)
                      {
                          echo '<tr class="no-border">';
                      }
                      else
                      {
                          echo '<tr>';
                      }

                      $j=1;
                      foreach ($days as $day) 
                      {
                          if($i==1 && $j==1)
                          {
                              echo'<td>&nbsp;'.$time.'</td>';
                          }
                          elseif($j==1)
                          {
                              //if($i%2==1)
                              //echo'<td class="tb-bg3">&nbsp;</td>';
                              //else
                              echo'<td class="tb-bg3">&nbsp;'.$time.'</td>';
                          }
                          elseif($i==1)
                          {
                              ($j<(date('w')+2)) ? $disabled='disabled': $disabled='';
                              ($j<(date('w')+2)) ? $name='': $name='name="blocked[]" onchange="changebg(this);"';
                              ($blocked[$day]=='Blocked') ? $blk='active' : $blk='';
                              ($blocked[$day]=='Blocked') ? $chk='checked' : $chk='';
                              ($blocked[$day]=='Blocked') ? $bol='Blocked' : $bol='Available';
                              ($blocked[$day]=='Blocked') ? $msg='block entire day' : $msg='';

                              echo '<td>
                                        <div class="text-table textbgc'.$j.'"> &nbsp; '.$msg.'</div>
                                        <input type="hidden" name="'.$day.'" id="bol'.$j.'" value="'.$bol.'">
                                        <div class="table-check">
                                              <div class="btn-group" data-toggle="buttons">
                                                  <label class="btn btn-primary '.$disabled.' '.$blk.'">
                                                      <input type="checkbox" '.$name.' id="bg'.$j.'" value="'.$j.'" '.$disabled.' '.$chk.'> 
                                                  </label>
                                              </div>
                                        </div>';
                              if($j<(date('w')+2)) echo'<span class="closed-txt">closed</span> <span style="top:600px" class="closed-txt">closed</span><span style="top:900px" class="closed-txt">closed</span><span style="top:1200px" class="closed-txt">closed</span><span style="top:1500px" class="closed-txt">closed</span><span style="top:1800px" class="closed-txt">closed</span>';
                              echo '</td>';
                          }
                          else
                          {
                              ($i==2) ? $tbt='tbt'.$j : $tbt='';
                              ($i==49) ? $tbb='tbb'.$j : $tbb='';

                              if(checkAvailability($day,$time,$availability)=='closed')
                              {
                                  if(checkBlocked($day,$time,$blocked)=='blocked')
                                  {
                                      ($j<(date('w')+2)) ? $bgcolor='tb-bg1': $bgcolor='tb-bg1';
                                      echo '<td class="'.$bgcolor.'">&nbsp;</td>';
                                  }
                                  elseif(checkBlocked($day,$time,$blocked)=='closed')
                                  {
                                      ($j<(date('w')+2)) ? $bgcolor='tb-bg1': $bgcolor='tb-bg2';
                                      ($j<(date('w')+2)) ? $pop='': $pop='onclick="daywisepop('.($j-1).');"'; 
                                      echo '<td class="'.$bgcolor.' bgc'.$j.' tb'.$j.' '.$tbt.' '.$tbb.'" '.$pop.'>&nbsp;</td>';
                                  }
                                  else
                                  {
                                    ($j<(date('w')+2)) ? $bgcolor='tb-bg1': $bgcolor='tb-bg9';
                                    echo '<td class="'.$bgcolor.' tb'.$j.' '.$tbt.' '.$tbb.'">&nbsp;</td>';
                                  }
                              }
                              else
                              {
                                  if(checkBooked($day,$time,$booked)=='closed')
                                  {
                                      ($j<(date('w')+2)) ? $abgcolor='tb-bg5': $abgcolor='tb-bg6'; 
                                      echo '<td class="'.$abgcolor.' tb'.$j.' '.$tbt.' '.$tbb.'">&nbsp;</td>';
                                  }
                                  else
                                  {
                                      ($j<(date('w')+2)) ? $abgcolor='tb-bg8': $abgcolor='tb-bg7'; 
                                      echo '<td class="'.$abgcolor.' tb'.$j.' '.$tbt.' '.$tbb.'">&nbsp;</td>';
                                  }
                              }
                          }
                          $j++;
                      }
                      echo "</tr>";
                      $i++;
                  }
                  ?>
                  </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-bottom clearfix tble_bot">
            <table width="100%" border="0">
                <tr>
                <?php /* if($blocktime!='') { $btime=explode("'",$blocktime); ?>
                  <td class="txt1">morning: always block</td>
                  <td><input type="text" name="mtime1" class="form-control bor1 mtime" value="<?=$btime[1]?>" ></td>
                  <td class="txt1">to</td>
                  <td><input type="text" name="mtime2" class="form-control bor1 mtime" value="<?=$btime[3]?>" ></td>
                  <td class="txt2">evening: always block</td>
                  <td><input type="text" name="etime1" class="form-control bor2 etime" value="<?=$btime[5]?>" ></td>
                  <td class="txt2"> to </td>
                  <td><input type="text" name="etime2" class="form-control bor2 etime" value="<?=$btime[7]?>" ></td>
                <?php } else { ?>
                  <td class="txt1">morning: always block</td>
                  <td><input type="text" name="mtime1" class="form-control bor1 mtime" value="" ></td>
                  <td class="txt1">to</td>
                  <td><input type="text" name="mtime2" class="form-control bor1 mtime" value="" ></td>
                  <td class="txt2">evening: always block</td>
                  <td><input type="text" name="etime1" class="form-control bor2 etime" value="" ></td>
                  <td class="txt2"> to </td>
                  <td><input type="text" name="etime2" class="form-control bor2 etime" value="" ></td>
                <?php } */ ?>
                <td>&nbsp;</td>
                <td>
                    <div class="unschedule">&nbsp;</div>
                    <p>unscheduled</p>
                </td>
                <td>
                    <div class="available">&nbsp;</div>
                    <p>available</p>
                </td>
                <td>
                    <div class="booked">&nbsp;</div>
                    <p>booked/ working</p>
                </td>
                <td>
                    <div class="closed">&nbsp;</div>
                    <p>unavailable/ closed</p>
                </td>
                  <td class="txt2">current date and time: <span id="clockbox"></span></td>
                </tr>
          </table>
        </div>
        
        <div class="save-sadule">
              <input type="submit" value="save schedule" class="save-btn" name="save">
              <input type="button" data-toggle="modal" data-target=".stand-by" value="stand by mode" class="save-btn">
              <a href="<?=base_url()?>staff/defaults" style="text-decoration:none;"><input type="button" value="set as default schedule" class="save-btn" ></a>
        </div>
    </from>

    <div class="save-sadule">
         
    </div>

    <div class="we6-table-sorting clearfix">
        <div class="upcomming">my upcoming jobs</div>
        <!-- <ul class="we6-table-sorting-select">
            <li>
                <select class="form-control form-short">
                    <option>sort by</option>
                </select>
            </li>
            <li>
                <select class="form-control form-short">
                    <option>view only</option>
                </select>
            </li>
        </ul> -->
    </div>
                  
                  
    <div class="we6-table-main">
        <table width="100%" border="0">
            <thead>
                <tr>
                    <th>event type</th>
                    <th>project name</th>
                    <th>location</th>
                    <th>date</th>
                    <th>time</th>
                    <th>role</th>
                    <th>contact</th>
                    <th>&nbsp;</th>
                </tr>
           </thead>
            <tbody>
                <!-- <tr>
                    <td>Corporate</td>
                    <td>Product Launch</td>
                    <td>31 wall street</td>
                    <td>3/11/16</td>
                    <td>6:00am-10:00pm</td>
                    <td> server </td>
                    <td>Melissa M</td>
                    <td> <a href="javascript:void(0)">cancel</a> </td>
                </tr> -->
                <tr>
                    <td colspan="8">none</td>
                </tr>
            </tbody>
        </table>
    </div>

    
    <!-- Button trigger modal -->
    <div class="popup1">
        <div class="modal fade stand-by" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                    <h4 class="modal-title" id="myModalLabel">standby mode</h4>
                    <div class="watch">
                          <img src="<?=base_url()?>resource/images/watch.png" alt="">
                    </div>
                    
                    <h2>would you like to go into standby mode?</h2>
                    <p>going into standby mode means you are ready to work <span>now</span></p>
                    <p>and will put you as a priority in the matching algorithm.* </p>
                    
                    <ul class="yes-no-select clearfix">
                          <li class="yes-select"> <a href="<?=base_url()?>staff/standby/1/<?=$user_id?>">yes! I’m ready to work</a></li>
                          <li class="no-select"> <a href="<?=base_url()?>staff/standby/0/<?=$user_id?>">no. I need some time</a></li>
                    </ul>
                    
                    <div class="going-txt">*going into standby mode does not guarantee work</div>
                </div>
            </div>
        </div>
    </div>

    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".tiem-slot">Modal PopUp 2</button> -->
    <!-- Button trigger modal -->
    <div class="popup1">
        <div class="modal fade tiem-slot" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                    <from>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $m=-date('w'); $n=1; 
                            foreach ($availability as $key => $val) {
                                  if($n<(date('w')+1)) { } else { if($blocked[$key]!='Blocked') { ?>
                                      <div class="item <?=$n==date('w')+1 ? 'active':'' ?> pop<?=$n?>">
                                          <h4 class="modal-title" id="myModalLabel">availability</h4>
                                          <div class="wa6-pop-heading">
                                                <div class="day-pop"><?=date('l', strtotime($m.' day'))?></div>
                                                <div class="date-pop"><?=date('m/d/Y', strtotime($m.' day'))?></div>
                                                <div class="pop-content">
                                                    <p>select the time span below to set your availability in 30 minute increments </p>
                                                    <p>to add multiple spans of time, press the + icon </p>
                                                    <p>all time increments that aren’t selected will be displayed as unavailable</p>
                                                </div>
                                          </div>
                                          <div class="wa6-bottom text-center text-danger <?=date('D', strtotime($m.' day'))?>" style="display:none;"></div>
                                          <div id="items<?=date('D', strtotime($m.' day'))?>">
                                          <div class="row">
                                            <?php if($val!='') { $end=end($val); 
                                            foreach ($val as $key => $value) {  ?>
                                              <div class="col-md-12">
                                                <div  id="timepick">
                                                  <ul>
                                                      <li>
                                                          <input type="text" name="start<?=date('D', strtotime($m.' day'))?>[]" id="<?=date('D', strtotime($m.' day'))?>[]" value="<?=$key?>" class="form-control alltime" placeholder="Start Time"></li>
                                                      <li>
                                                          <div class="time_to">TO</div>
                                                      </li>
                                                      <li>
                                                          <input type="text" name="end<?=date('D', strtotime($m.' day'))?>[]" id="<?=date('D', strtotime($m.' day'))?>[]" value="<?=$value?>" class="form-control alltime" placeholder="End Time">
                                                      </li>
                                                      <li>
                                                          <?php if($end==$value){ $dayy=date('D', strtotime($m.' day')); echo'<button type="button" class="addtimespan" onclick="addField('."'".$dayy."'".');">+ add time span</button>'; } ?>
                                                      </li>
                                                  </ul>
                                                </div>
                                            </div>
                                            <?php } } else { ?> 
                                              <div class="col-md-12">
                                                <div  id="timepick">
                                                    <ul>
                                                        <li>
                                                            <input type="text" name="start<?=date('D', strtotime($m.' day'))?>[]" id="<?=date('D', strtotime($m.' day'))?>[]" value="" class="form-control alltime" placeholder="Start Time">
                                                        </li>
                                                        <li>
                                                            <div class="time_to">TO</div>
                                                        </li>
                                                        <li>
                                                            <input type="text" name="end<?=date('D', strtotime($m.' day'))?>[]" id="<?=date('D', strtotime($m.' day'))?>[]" value="" class="form-control alltime" placeholder="End Time">
                                                        </li>
                                                        <li>
                                                            <button type="button" class="addtimespan" onclick="addField('<?=date('D', strtotime($m.' day'))?>');">+ add time span</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                              </div>
                                            <?php } ?>
                                            </div>
                                          </div>
                                          <ul class="yes-no-select clearfix">
                                              <li class="yes-select"> <a href="javascript:void(0)" onclick="savedaydata('<?=date('D', strtotime($m.' day'))?>',<?=$n+1?>);">save</a></li>
                                              <li class="no-select"> <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close">cancel</a></li>
                                          </ul>
                                      </div>
                            <?php } } $n++; $m++; } ?>
                        </div>
                        <a href="#" class="slide-prev"> <img src="<?=base_url()?>resource/images/slide-prev.png" alt=""> </a>
                        <a href="#" class="slide-next"> <img src="<?=base_url()?>resource/images/slide-next.png" alt=""> </a>
                    </div>
                    </from>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>
