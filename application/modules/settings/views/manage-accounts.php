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
            <li><a class="active" href="<?=base_url()?>settings/manageaccounts">manage <br> accounts</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_et')) { ?>
            <li><a href="<?=base_url()?>settings/eventtype">event <br> type</a></li>
            <?php } if($this->tank_auth->checkPermission('setting_st')) { ?>
            <li><a href="<?=base_url()?>settings/servicetype">service <br> type</a></li>
            <?php } ?>
        </ul>

        <script>
        function doconfirm()
        {
            job=confirm("Are you sure to delete permanently?");
            if(job!=true)
            {
                return false;
            }
        }
        </script> 
        
        <div class="jobs">
            <div class="wa16-heading1">manage accounts</div>
            <p>&nbsp;</p>
            
            <ul class="wa39-link">
                <li><a href="<?=base_url()?>settings/manageaccounts/addrole">add role</a> </li>
                <li><a href="<?=base_url()?>settings/manageaccounts/adduser" class="active">add user</a> </li>
            </ul>
            
           <div class="we6-table-main wa39-box">
                <h4>roles</h4>  
                <table width="100%" border="0">
                    <?php foreach($roles_arr as $role){ ?>
                        <tr>
                            <td width="750"><?php echo $role->role; ?></td>
                            <td width="150"> <a href="<?=base_url()?>settings/manageaccounts/viewRole/<?php echo $role->r_id; ?>"> manage </a> </td>
                            <td width="100"> <a onclick="return doconfirm();" href="<?=base_url()?>settings/manageaccounts/deleteRole/<?php echo $role->r_id; ?>"> <strong>delete</strong> </a> </td>
                        </tr>
                    <?php } ?>
                </table>            
            </div>
            
            
            <div class="we6-table-main wa39-box">
                <h4>users</h4>  
                <table width="100%" border="0">
                    <?php foreach($users_arr as $user){ ?>
                        <tr>
                            <td width="400"><?php echo $user->firstname.' '.$user->lastname; ?></td>
                            <td><?=$this->tank_auth->get_role_name($user->role_id)?></td>
                            <td> <?php echo $user->email; ?> </td> 
                            <td width="150"> <a href="<?=base_url()?>settings/manageaccounts/viewUser/<?php echo $user->user_id; ?>"> manage </a> </td>
                            <td width="100"><a onclick="return doconfirm();" href="<?=base_url()?>settings/manageaccounts/deleteUser/<?php echo $user->user_id; ?>"> <strong>delete </strong></a></td>
                        </tr>
                    <?php } ?>
                </table>            
            </div>
        </div>

    <?php } } ?>
</div>
