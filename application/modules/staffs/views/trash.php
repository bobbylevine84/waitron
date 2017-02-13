<div class="container">
    <div class="top-heading">
        trashed applications
        <a class="back-link-right" href="<?=base_url()?>staffs/pending/">back</a>
    </div>
    <div class="we12-main">
        <ul class="we5-main we6-main-top clearfix"> 
             <li class="we5-bg2">  
                <a href="<?=base_url()?>staffs/pending/deleteallrecords/" class="we5-bg1">
                    <span class="we5-main-txt3">delete all</span>                             
                </a>
            </li>
        </ul>                   
    </div>
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
                    if (!empty($trash_staffs)) {
                    foreach ($trash_staffs as $staff) { ?>
                    <tr>
                        <td><?=date('d/m/y',strtotime($staff->created))?></td>
                        <td><?=ucfirst($staff->firstname)." ".ucfirst($staff->lastname)?></td>
                        <td><?=$staff->skills?></td>
                        <td><?=$staff->phone?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->city?></td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_notes')) { ?>  <a href="<?=base_url()?>staffs/pending/view/<?=$staff->user_id?>"> view application </a> <?php } ?> </td>
                        <td> <a href="<?=base_url()?>staffs/pending/accept/<?=$staff->user_id?>" class="approve-link">Accept</a></td>
                       <!-- <td> <a href="<?=base_url()?>staffs/pending/delete/<?=$staff->user_id?>" class="decline-link">Delete Permanantly</a> </td>-->
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
                                    
            
