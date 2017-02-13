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
        <div class="jobs">
            <div class="wa16-heading1">manage accounts <a href="<?=base_url()?>settings/manageaccounts" class="back-link-right">back</a> </div>
            <div class="manage-roll">manage role resources</div>
            <div class="wa16-form">
                <form method="post">
                    <div class="row wa16-form-row">
                        <div class="col-md-4">
                            <label class="label-field">role name</label>
                            <input type="text" value="" class="form-control" name="rolename">
                        </div>
                    </div>
                    
                    <div class="row wa16-form-row tree-top">
                        <div class="col-md-4">
                            <label class="label-field">resources</label>
                        </div>
                    </div>
                    
                    <div class="row wa16-form-row">
                        <div class="col-md-12">
                            <div class="tree-menu-main">
                                <?php
                                    function has_children($rows,$id) 
                                    {
                                      foreach ($rows as $row) {
                                        if ($row->parent == $id)
                                          return true;
                                      }
                                      return false;
                                    }
                                    function build_list($rows,$parent=0)
                                    {  
                                      $result = "<ul id='tree'>";
                                      foreach ($rows as $row)
                                      {
                                        if ($row->parent == $parent){
                                          $result.= '<li><a><input id="id-'.$row->parent.'" type="checkbox" name="permissions[]" class="menu-round" value="'.$row->permission_id.'"/>'.$row->name.'</a>';
                                          
                                          if (has_children($rows,$row->permission_id))
                                            $result.= build_list($rows,$row->permission_id);
                                          $result.= "</li>";
                                        }
                                      }
                                      $result.= "</ul>";
                                      return $result;
                                    }
                                    echo build_list($permission_arr);
                                ?>
                            </div>
                            <div class="save-btn-main">
                                <input type="submit" class="save-btn" value="save resources">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } } ?>
</div>
