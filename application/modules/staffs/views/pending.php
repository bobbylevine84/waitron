<div class="container">
    <div class="top-heading">
        pending applications
        <a class="back-link-right" href="<?=base_url()?>staffs">back</a>
    </div>
    <div class="we12-main">
        <ul class="we5-main we6-main-top clearfix"> 
             <li class="we5-bg1">  
                <a href="<?=base_url()?>staffs/pending/trash" class="we5-bg1">
                    <span class="we5-main-txt3">trash can</span>                             
                </a>
            </li>
        </ul>                   
    </div>
    <ul class="short-filter clearfix">
        <li>
            <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                  <option value="">sort by</option>
                  <option value="<?=base_url()?>staffs/pending/index/created/desc/sort">Date Applied</option>
                  <option value="<?=base_url()?>staffs/pending/index/firstname/asc/sort">Name A-Z</option>
                  <option value="<?=base_url()?>staffs/pending/index/firstname/desc/sort">Name Z-A</option>
                  <option value="<?=base_url()?>staffs/pending/index/skills/asc/sort">Skills</option>
                  <option value="<?=base_url()?>staffs/pending/index/state/asc/sort">Location</option>
            </select>
        </li>
        <li>
              <select class="form-control selectpic" onchange="if(this.value!='')javascript:location.href = this.value;">
                    <option value=""> view only</option>
                    <option value="<?=base_url()?>staffs/pending/attachment/NULL/where">Application With Attachments</option>
                    <option value="<?=base_url()?>staffs/pending/anycomments/0/where">Application With Comments</option>
                    <option value="<?=base_url()?>staffs/pending/created/15/where">Application Older Than 15 Days</option>
              </select>
        </li> 
    </ul>

    <div class="we6-table-main">
        <table width="100%" border="0">
            <thead>
                <tr>
                    <th>date applied</th>
                    <th>name</th>
                    <th>skills</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>location</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($staffs)) {
                    foreach ($staffs as $staff) { ?>
                    <tr>
                        <td><?=date('m/d/y',strtotime($staff->created))?></td>
                        <td><?=ucfirst($staff->firstname)." ".ucfirst($staff->lastname)?></td>
                        <td><?=$staff->skills?></td>
                        <td><?=$staff->phone?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->city?></td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_notes')) { ?>  <a href="<?=base_url()?>staffs/pending/view/<?=$staff->user_id?>"> view application </a> <?php } ?> </td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_accept')) { ?> <a href="<?=base_url()?>staffs/pending/approve/<?=$staff->user_id?>" class="approve-link">approve</a> <?php } ?></td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_decline')) { ?> <a href="<?=base_url()?>staffs/pending/decline/<?=$staff->user_id?>" class="decline-link">decline</a> <?php } ?> </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
                                    
            
