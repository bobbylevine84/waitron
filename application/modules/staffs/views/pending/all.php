<div class="container">
    <div class="top-heading">
        pending applications
        <a class="back-link-right" href="<?=base_url()?>staffs/pending">back</a>
    </div>

    <ul class="short-filter clearfix">
        <li>
            <select class="form-control selectpic">
                 <option> sort by</option>
            </select>
        </li>
        <li>
            <select class="form-control selectpic">
                <option> view only</option>
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
                        <td><?=date('d/m/y',strtotime($staff->created))?></td>
                        <td><?=ucfirst($staff->firstname)." ".ucfirst($staff->lastname)?></td>
                        <td><?=$staff->skills?></td>
                        <td><?=$staff->phone?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->city?></td>
                        <td> <a href="<?=base_url()?>staffs/pending/view/<?=$staff->user_id?>"> view application </a> </td>
                        <td> <a href="<?=base_url()?>staffs/pending/approve/<?=$staff->user_id?>" class="approve-link">approve</a> </td>
                        <td> <a href="<?=base_url()?>staffs/pending/decline/<?=$staff->user_id?>" class="decline-link">decline</a> </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
                                    
            
