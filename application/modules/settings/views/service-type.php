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
        <li><a href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
        <?php } if($this->tank_auth->checkPermission('setting_st')) { ?>
        <li><a class="active" href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
        <?php } ?>
    </ul>
    
    <div class="jobs">
        <div class="wa16-heading1">manage service type</div>
        <p>&nbsp;</p>
        
        <ul class="wa39-link">
            <li><a data-toggle="ajaxModal" href="<?=base_url()?>settings/servicetype/add">add service<br>type</a> </li>
        </ul>
        
        
        <div class="we6-table-main wa39-box">
            <h4>service types</h4>  
            <table width="100%" border="0">
                <thead>
                    <tr>
                        <th>service type name</th>
                        <th>image</th>
                        <th>manage</th>
                    </tr>
                </thead>
                <?php foreach ($servicetype as $service) {  ?>
                <tr>
                    <td style="text-align:center"><?=$service->servicetype?> </td>
                    <td style="text-align:center"><img src="<?=base_url()?>resource/service/<?=$service->serviceicon?>" alt="" style="width:50px; height:50px" ></td>
                    <td style="text-align:center"> 
                    <a data-toggle="ajaxModal" href="<?=base_url()?>settings/servicetype/update/<?=$service->servicetypeid?>"> <strong class="text-success">update</strong> </a> / 
                    <a href="<?=base_url()?>settings/servicetype/delete/<?=$service->servicetypeid?>"> <strong class="text-danger">delete</strong> </a> 
                    </td>
                </tr>
                <?php } ?>
            </table>            
        </div>
    </div>
    <?php } } ?>
</div>
