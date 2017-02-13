<div class="container">
    <div class="top-heading">
        captain request(s)
        <a class="back-link-right" href="<?=base_url()?>staffs">back</a>
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
                    if (!empty($staffs)) { 
                    foreach ($staffs as $staff) { ?>
                    <tr>
                        <td><?=date('d/m/Y',strtotime($staff->crdate))?></td>
                        <td><?=ucfirst($staff->firstname)." ".ucfirst($staff->lastname)?></td>
                        <td><?=$staff->skills?></td>
                        <td><?=$staff->phone?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->city?></td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_notes')) { ?>  <a href="<?=base_url()?>staffs/view/<?=$staff->user_id?>"> view application </a> <?php } ?> </td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_accept')) { ?> <a href="<?=base_url()?>staffs/captain/approve/<?=$staff->user_id?>" class="approve-link">approve</a> <?php } ?></td>
                        <td> <?php if($this->tank_auth->checkPermission('staff_decline')) { ?> <a href="<?=base_url()?>staffs/captain/decline/<?=$staff->user_id?>" class="decline-link">decline</a> <?php } ?> </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
                                    
            
