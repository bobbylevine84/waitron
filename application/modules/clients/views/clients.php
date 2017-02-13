<div class="container">
    <div class="top-heading">
        clients
    </div>
    <div class="we12-main">
        <ul class="we5-main we6-main-top clearfix"> 
            <li class="we5-bg1">    
                <a href="javascript:void(0)" class="we5-bg1">
                    <span class="we5-main-txt1">active clients</span>
                    <span class="we5-main-txt2"><?=$active_clients?></span>                                                               
                </a>
            </li>
            <li class="we5-bg2">    
                <a href="javascript:void(0)" class="we5-bg1">
                    <span class="we5-main-txt1">total client accounts</span>
                    <span class="we5-main-txt2"><?=$total_clients?></span>                                                               
                </a>
            </li>
            <?php if($this->tank_auth->checkPermission('client_add')){ ?>
            <li class="we5-bg1">    
                <a href="<?=base_url()?>clients/add" class="we5-bg1">
                    <span class="we5-main-txt3">add client</span>                                                         
                </a>
            </li>
            <?php } ?>
        </ul>                                       
    </div>
    <?php $this->uri->segment(6)!='' ? $page=$this->uri->segment(6) : $page='0'; ?> 
    <ul class="short-filter clearfix">
        <?php if($this->tank_auth->checkPermission('client_sort')){ ?>
        <li>
            <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                  <option value="">sort by</option>
                  <option value="<?=base_url()?>clients/index/companyname/asc/sort/<?=$page?>">Company</option>
                  <option value="<?=base_url()?>clients/index/firstname/desc/sort/<?=$page?>">Job Posted</option>
                  <option value="">Jobs Filled</option>
                  <option value="<?=base_url()?>clients/index/state/asc/sort/<?=$page?>">Location</option>
                  <option value="">Account Status</option>
                  <option value="<?=base_url()?>clients/index/activated/desc/sort/<?=$page?>">Status</option>
                  <option value="">rating</option>
            </select>
        </li>
        <?php } if($this->tank_auth->checkPermission('client_view')) { ?>
        <li>
            <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                <option> view only</option>
                <option value="<?=base_url()?>clients/index/activated/1/where/<?=$page?>">Active Accounts</option>
                <option value="<?=base_url()?>clients/index/activated/0/where/<?=$page?>">Inactive Accounts</option>
                <option value="">Rating is higher than 4.0</option>
                <option value="">Rating is less than 4.0</option>
            </select>
        </li>
        <?php } ?>
    </ul>
    
    <div class="we6-table-main">
        <table width="100%" border="0">
            <thead>
                <tr>
                    <th>name</th>
                    <th>company</th>
                    <th>jobs posted</th>
                    <th>jobs ﬁlled</th>
                    <th>location</th>
                    <th>account status</th>
                    <th>status</th>
                    <th>rating</th>
                    <th>image</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($clients)) {
            foreach ($clients as $client) { ?>
                <tr>
                    <td><?=ucfirst($client->firstname)." ".ucfirst($client->lastname)?></td>
                    <td><?=$client->companyname?></td>
                    <td><?php $jworked = $this->db->where('createdby',$client->user_id)->get('job')->result(); echo count($jworked); ?></td>
                    <td><?php $i=0; $jobpost = $this->db->where('createdby',$client->user_id)->get('job')->result(); 
                        foreach ($jobpost as $job) {
                           //echo $i;
                           $jobworked = $this->db->where('jobid',$job->jobid)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->result();  
                           $jwcount = count($jobworked);
                           if($job->totalstaff==$jwcount)
                           {
                             $i++;
                           }
                        }
                    echo $i; ?></td>
                    <td><?=$client->city?></td>
                    <td> GOOD STANDING </td>
                    <td><?=$client->activated==0? '<span class="red-txt">INACTIVE</span> ' : 'ACTIVE'?></td>
                    <td> 0.0 </td>
                    <td> <img class="img-circle" style="width:33px; height:33px" alt="" src="<?=$client->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$client->avatar ?>">  </td>
                    <td> <?php if($this->tank_auth->checkPermission('client_manage')) { ?> <a href="<?=base_url()?>clients/view/<?=$client->user_id?>">manage</a> <?php } ?> </td>
                </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
    
    <div class="wa5-bottom row">
        <div class="col-md-1 pull-right" style="margin-top:26px"><a href="<?=base_url().'clients/all'?>">view all</a></div>
        <div class="col-md-4 pull-right"><?php echo $links; ?></div>
    </div>
</div>
