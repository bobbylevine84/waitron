<div class="container">
    <?php if (!empty($admin_info)) {
    foreach ($admin_info as $admin) { ?>
        <div class="welcome-back-txt">my account</div>
        <div class="hello-txt">welcome back  </div>
        <div class="cli-name-txt"><?=$admin->firstname." ".$admin->lastname?></div>
    
    <ul class="acc-dec job-payment wa32-wap">
        <li><a href="<?=base_url()?>settings">proﬁle <br> information</a></li>
        <li><a href="<?=base_url()?>settings/changepass">change <br> password</a></li>
        <?php if($this->tank_auth->checkPermission('setting_ma')) { ?>
        <li><a href="<?=base_url()?>settings/manageaccounts">manage <br> accounts</a></li>
        <?php } if($this->tank_auth->checkPermission('setting_et')) { ?>
        <li><a class="active" href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
        <?php } if($this->tank_auth->checkPermission('setting_st')) { ?>
        <li><a href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
        <?php } ?>
    </ul>
    
    <div class="jobs">
        <div class="wa16-heading1">manage event types</div>
        <p>&nbsp;</p>
        
        <ul class="wa39-link">
            <li><a data-toggle="ajaxModal" href="<?=base_url()?>settings/eventtype/add">add event <br> type</a> </li>
        </ul>
        
       <div class="we6-table-main wa39-box">
            <h4>event types</h4>  
            <table width="100%" border="0">
                <thead>
                    <tr>
                        <th>event type name</th>
                        <th>manage</th>
                    </tr>
                </thead>
                <?php foreach ($eventtype as $event) {  ?>
                <tr>
                    <td style="text-align:center"> <?=$event->eventtype?> </td>
                    <td style="text-align:center"> 
                        <a data-toggle="ajaxModal" href="<?=base_url()?>settings/eventtype/update/<?=$event->eventtypeid?>"> <strong class="text-success">update</strong> </a> / 
                        <a href="<?=base_url()?>settings/eventtype/delete/<?=$event->eventtypeid?>"> <strong class="text-danger">delete</strong> </a> 
                    </td>
                </tr>
               <?php } ?>
            </table>            
        </div>
    </div>
    <?php } } ?>
</div>
