<div class="container">
    <?php if (!empty($admin_info)) {
    foreach ($admin_info as $admin) { ?>

    <div class="welcome-back-txt">email templates</div>
    <!-- <div class="hello-txt">welcome back  </div>
    <div class="cli-name-txt"><?=$admin->firstname." ".$admin->lastname?></div> -->
        
    <!-- <ul class="acc-dec job-payment wa32-wap">
    <li><a href="<?=base_url()?>settings">proﬁle <br> information</a></li>
    <li><a href="<?=base_url()?>settings/changepass">change <br> password</a></li>
    <li><a href="<?=base_url()?>settings/manageaccounts">manage <br> accounts</a></li>
    <li><a class="active" href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
    <li><a href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
        </ul> -->
    
    <div class="jobs">
        <!-- <div class="wa16-heading1">manage event types</div> -->
        <!-- <p>&nbsp;</p> -->
        
        <!-- <ul class="wa39-link">
            <li><a data-toggle="ajaxModal" href="<?=base_url()?>settings/eventtype/add">add event <br> type</a> </li>
        </ul> -->
        <div class="we6-table-main wa39-box">
            <!-- <h4>event types</h4>  --> 
            <table width="100%" border="0">
                <thead>
                    <tr>
                        <th>template name</th>
                        <th>subject</th>
                        <th>manage</th>
                    </tr>
                </thead>
                <?php foreach ($templates as $template) {  ?>
                <tr>
                    <td style="text-align:center"> <?=$template->name?> </td>
                    <td style="text-align:center"> <?=$template->subject?> </td>
                    <td style="text-align:center"> 
                        <a href="<?=base_url()?>settings/etemplates/update/<?=$template->template_id?>"> <strong class="text-success">update</strong> </a> / 
                        <a href="<?=base_url()?>settings/etemplates/delete/<?=$template->template_id?>"> <strong class="text-danger">delete</strong> </a> 
                    </td>
                </tr>
               <?php } ?>
            </table>            
        </div>
    </div>
    <?php } } ?>
</div>
