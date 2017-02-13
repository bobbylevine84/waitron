<div class="container">
    <div class="welcome-back top-padd">
        <h2>welcome back</h2>
        <?php if (!empty($client_info)) {
        foreach ($client_info as $client) { ?>
            <h1><?=$client->firstname?></h1>
        <?php } } ?>
    </div>
    <ul class="we5-main clearfix">
        <li class="we5-bg1">  <a href="<?=base_url()?>client/jobs/addjob">ﬁll job</a>  </li>
        <li class="we5-bg2">  <a href="<?=base_url()?>client/jobs/addevent">ﬁll event</a>  </li>
        <li class="we5-bg1">  <a href="<?=base_url()?>client/reports">reports</a>  </li>
        <li class="we5-bg2">
            <a href="javascript:void(0)" class="we5-bg1">
                <span class="we5-main-txt1">total active staff</span>
                <span class="we5-main-txt2"><?=$active_staffs?></span>                               
            </a>
        </li>
        <li class="we5-bg1">  
            <a href="<?=base_url()?>client/jobs" class="we5-bg1">
                <span class="we5-main-txt1">real-time active jobs</span>
                <span class="we5-main-txt2"><?=$realTimeJobCount?></span>                                
            </a>
        </li>
        <li class="we5-bg2">
          <a href="javascript:void(0)" class="we5-bg1">
                <span class="we5-main-txt1">waitrons on standby</span>
                <span class="we5-main-txt2"><?=$standby_staffs?></span>                               
            </a>
        </li>
    </ul>

</div>