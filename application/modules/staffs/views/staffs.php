<div class="container">
    <div class="top-heading">
          staff
    </div>
    
    <div class="we12-main">
        <ul class="we5-main we6-main-top clearfix"> 
            <?php if($this->tank_auth->checkPermission('staff_pending')) { ?>
            <li class="we5-bg1">  
                <a href="<?=base_url()?>staffs/pending" class="we5-bg1">
                    <span class="we5-main-txt1">pending application(s)</span>
                    <span class="we5-main-txt2"><?=$pending_staffs_count?></span>                               
                </a>
            </li>
            <?php } if($this->tank_auth->checkPermission('staff_captain')) { ?>
            <li class="we5-bg1">  
                <a href="<?=base_url()?>staffs/captain" class="we5-bg1">
                    <span class="we5-main-txt1">captain request(s)</span>
                    <span class="we5-main-txt2"><?=$staffs_captain_request?></span>                               
                </a>
            </li>
            <?php } if($this->tank_auth->checkPermission('staff_add')) { ?>
            <li class="we5-bg2">  
                <a href="<?=base_url()?>staffs/add" class="we5-bg1">
                    <span class="we5-main-txt3">add staff</span>                             
                </a>
            </li>
            <?php } ?>
        </ul>                   
    </div>
    <?php                 
      $this->uri->segment(6)!='' ? $page=$this->uri->segment(6) : $page='0';
      //$order=$this->uri->segment(5,"asc");
      //$order == "asc" ? $order="asc" : $order='desc';
      ?> 
    <?php //print_r($staffs); ?>
    
    <ul class="short-filter clearfix">
        <?php if($this->tank_auth->checkPermission('staff_sort')){ ?>
        <li>
            <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                  <option value="">sort by</option>
                  <option value="<?=base_url()?>staffs/index/firstname/asc/sort/<?=$page?>">Name A-Z</option>
                  <option value="<?=base_url()?>staffs/index/firstname/desc/sort/<?=$page?>">Name Z-A</option>
                  <option value="">jobs worked</option>
                  <option value="<?=base_url()?>staffs/index/state/asc/sort/<?=$page?>">location</option>
                  <option value="<?=base_url()?>staffs/index/activated/desc/sort/<?=$page?>">status</option>
                  <option value="">rating</option>
            </select>
        </li>
        <?php } if($this->tank_auth->checkPermission('staff_view')) { ?>
        <li>
              <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                    <option> view only</option>
                    <?php foreach ($servicetype as $service) {  ?>
                    <option value="<?=base_url()?>staffs/index/skills/<?=$service->servicetype?>/where/<?=$page?>"><?=$service->servicetype?></option>
                    <?php } ?>
                    <option value="<?=base_url()?>staffs/index/activated/1/where/<?=$page?>">Status is Active</option>
                    <option value="<?=base_url()?>staffs/index/activated/0/where/<?=$page?>">Status is Inactive</option>
                    <option value="">Rating is higher than 4.0</option>
                    <option value="">Rating is less than 4.0</option>
              </select>
        </li> 
        <?php } ?>
    </ul>
    <?php //print_r($staffs); ?>
    
    <!--<div class="we6-table-main">
    <table class="table table-striped m-b-none AppendDataTables">
        -->
    <div class=" we6-table-main">
        <table width="100%" border="0"> 
            <thead>
                <tr>
                    <th>name</th>
                    <th>skills</th>
                    <th>jobs worked</th>
                    <th>location</th>
                    <th>stand by</th>
                    <th>status</th>
                    <th>rating</th>
                    <th>image</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (!empty($staffs)) {
                foreach ($staffs as $staff) { ?>
                    <tr>
                        <td><?=ucfirst($staff->firstname)." ".ucfirst($staff->lastname)?></td>
                        <td><?=$staff->skills?></td>
                        <td><?php $jworked = $this->db->where('staffid',$staff->user_id)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->result(); echo count($jworked); ?><?php //=$staff->user_id?></td>
                        <td><?=$staff->state?></td>
                        <td><?=$staff->standby==0? '<span class="red-txt">On</span> ' : 'Off'?></td>
                        <td><?=$staff->activated==0? '<span class="red-txt">INACTIVE</span> ' : 'ACTIVE'?></td>
                        <td> 0.0 </td>
                        <td> <img class="img-circle" width="38" height="38" alt="" src="<?=$staff->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$staff->avatar ?>">  </td>
                        <td>  <?php if($this->tank_auth->checkPermission('staff_manage')){ ?> <a href="<?=base_url()?>staffs/view/<?=$staff->user_id?>">manage</a> <?php } ?> </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
    
    <div class="wa5-bottom row">
        <div class="col-md-1 pull-right" style="margin-top:26px"><a href="<?=base_url().'staffs/all'?>">view all</a></div>
        <div class="col-md-4 pull-right"><?php echo $links; ?></div>
    </div>
</div>
