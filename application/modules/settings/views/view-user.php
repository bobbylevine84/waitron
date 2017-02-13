<div class="container">
    <div class="welcome-back-txt">my account</div>
    <div class="hello-txt">welcome back  </div>
    <div class="cli-name-txt"><?=$admin_info[0]->firstname." ".$admin_info[0]->lastname?></div>
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
    
    <div class="jobs">
        <div class="wa16-heading1">manage accounts <a class="back-link-right" href="<?=base_url()?>settings/manageaccounts">back</a> </div>
        <p>&nbsp;</p>

        <div class="add-user-txt">Update User</div>                
        <form method="post">
            <div class="wa16-form  wa16-form-more-padd">
                
                    <div class="row wa16-form-row">
                        <div class="col-md-6">
                            <label class="label-field">first name</label>
                            <input type="text" name="firstname" value="<?php echo $user_data[0]->firstname; ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="label-field">last name</label>
                            <input type="text" name="lastname" value="<?php echo $user_data[0]->lastname; ?>" class="form-control">
                        </div>
                    </div>
        
        
                    <div class="row wa16-form-row">
                        <div class="col-md-6">
                            <label class="label-field">email</label>
                            <input type="email" name="email" value="<?php echo $user_data[0]->email; ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="label-field">role</label>
                            <select class="form-control select-form" name="select_role">
                                <option value="">---- select role ----</option>
                                <?php foreach($roles_arr as $role) {?>
                                <option value="<?php echo $role->r_id; ?>" <?php if($role->r_id==$user_data[0]->role_id){ echo "selected"; } ?>><?php echo $role->role; ?></option>
                                <?php } ?>
                            </select>
                        </div>              
                    </div>
        
                    <div class="row wa16-form-row">
                        <div class="col-md-6">
                            <label class="label-field">position</label>
                            <input type="text" name="position" value="<?php echo $user_data[0]->position; ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="label-field">phone</label>
                            <input type="text" name="phone" value="<?php echo $user_data[0]->phone; ?>" class="form-control">
                        </div>
                    </div>
            </div>
    
            <div class="save-btn-main">
                <input type="submit" value="Update User" class="save-btn">
             </div>
        </form>
    </div>

</div>
