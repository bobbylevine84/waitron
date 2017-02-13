<?php if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
        <div class="welcome-back-txt">welcome back</div>
        <div class="cli-name"><?=$staff->firstname?></div>
        <div class="cli-pic"> <img style="width:270px; height:270px" src="<?=$staff->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$staff->avatar ?>" alt=""> </div>
        <div class="full-name"><?=$staff->firstname.' '.$staff->lastname?></div>
        <div class="waitron-heading">waitron</div>
        <div class="rating-txt">rating</div>
        <div class="rating-pic"> <img style="height:70px; width:auto;" src="<?=base_url()?>resource/images/rate4.png" alt=""> </div>
        <div class="statistics-txt">statistics</div>
        <div class="stati-table">
            <table width="380px" border="0">
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
                <td>waitron since</td>
                <td><strong>9/02/15</strong></td>
              </tr>
            </table>
        </div>
        
        <div class="waitron-heading">approved skills</div>
        <div class="wa10sec1">
        <?php $skills_array=explode(", ",$staff->skills); 
        foreach ($skills_array as $value) {
          echo '<span> <a href="javascript:void(0)">'.$value.'</a></span>';
        } ?>
        </div>
        
        <!-- <div class="rating-txt">comments</div>
        
        <div class="wa10-table">
                <table width="" border="0">
                    <thead>
                          <tr>
                            <th>feedback</th>
                            <th>rating</th>
                            <th>employer</th>
                          </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td>
                                <p>Christine is a fantastic waitron! I’ve had </p>
                                <p>the opportunity to hire her multiple times </p>
                                <p>and each time she is on time and </p>
                                <p>extremely professional!</p>
                            </td>
                            <td> <img src="<?=base_url()?>resource/images/rate5.png" style="height: 43px; width: auto;" alt=""> </td>
                            <td>
                                  <div class="rate-pic"><img src="<?=base_url()?>resource/images/ratepic1.jpg" style="height:77px; width:77px;" alt=""> </div>
                                  <h2>Jane Sarratt</h2>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <p>Christine saved me from a last-minute </p>
                                <p>call-out. She is skilled, smart and </p>
                                <p>professional. I can’t say enough good </p>
                                <p>things about her.</p>
                            </td>
                            <td> <img src="<?=base_url()?>resource/images/rate4.png" style="height: 43px; width: auto;" alt=""> </td>
                            <td>
                                  <div class="rate-pic"><img src="<?=base_url()?>resource/images/ratepic2.jpg" style="height:77px; width:77px;" alt=""> </div>
                                  <h2>Tony Digrego</h2>
                            </td>
                          </tr>
                     </tbody>     
                  </table>
        </div>
        
        <div class="view-more">
            <a data-toggle="ajaxModal" href="<?=base_url()?>staff/clientrating">view more</a>
        </div> -->
        
        <div class="waitron-heading">more</div>
      
        <ul class="acc-dec acc-dec-no">
            <li class="acc-dec-accept"><a href="<?=base_url()?>staff">update schedule</a></li>
            <li class="acc-dec-dec"><a href="<?=base_url()?>staff/reports">view reports</a></li>
            <li class="acc-dec-accept"><a href="<?=base_url()?>staff/settings">edit account info</a></li>
        </ul>
    </div>
<?php } } ?> 