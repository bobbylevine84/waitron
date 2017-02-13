<div class="container">
    <div class="top-heading">
          staffs
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
    <?php //print_r($staffs); ?>
    
    <ul class="short-filter clearfix">
        <li>
            <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                  <option value="">sort by</option>
                  <option value="<?=base_url()?>staffs/all/firstname/asc/sort">Name A-Z</option>
                  <option value="<?=base_url()?>staffs/all/firstname/desc/sort">Name Z-A</option>
                  <option value="">jobs worked</option>
                  <option value="<?=base_url()?>staffs/all/state/asc/sort">location</option>
                  <option value="<?=base_url()?>staffs/all/standby/asc/sort">status</option>
                  <option value="">rating</option>
            </select>
        </li>
        <li>
              <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                    <option> view only</option>
                    <?php foreach ($servicetype as $service) {  ?>
                    <option value="<?=base_url()?>staffs/all/skills/<?=$service->servicetype?>/where/<?=$page?>"><?=$service->servicetype?></option>
                    <?php } ?>
                    <option value="<?=base_url()?>staffs/all/standby/1/where">Status is Active</option>
                    <option value="<?=base_url()?>staffs/all/standby/0/where">Status is Inactive</option>
                    <option value="">Rating is higher than 4.0</option>
                    <option value="">Rating is less than 4.0</option>
              </select>
        </li> 
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
                        <td><?php $jworked = $this->db->where('staffid',$staff->user_id)->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->get('job_assign')->result(); echo count($jworked); ?></td>
                        <td><?=$staff->state?></td>
                        <td><?=$staff->standby==0? '<span class="red-txt">On</span> ' : 'Off'?></td>
                        <td><?=$staff->activated==0? '<span class="red-txt">INACTIVE</span> ' : 'ACTIVE'?></td>
                        <td> 0.0 </td>
                        <td> <img class="img-circle" width="38" height="38" alt="" src="<?=base_url()?>resource/avatar/<?=$staff->avatar!=''? $staff->avatar :'default.jpg'?> ">  </td>
                        <td> <a href="<?=base_url()?>staffs/view/<?=$staff->user_id?>">manage</a> </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
