<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand"><img alt="logo" src="<?=base_url()?>resource/images/logo.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
        <!-- <form role="search" class="navbar-form navbar-right" method="post" action="<?=base_url()?>search">
            <div class="form-group">
                <input type="text" name="search" placeholder="search anything" class="form-control">
            </div>
        </form> -->
        <ul class="nav navbar-nav navbar-right">
            <?php $this->load->library('tank_auth');
            if($this->tank_auth->checkPermission('dashboard')) { ?>
            <li class="<?php if($page == 'Home'){echo  "active"; }?>"><a href="<?=base_url()?>">Dashboard</a></li>
            <?php } if($this->tank_auth->checkPermission('clients')) { ?>
               <li class="<?php if($page == 'Clients'){echo  "active"; }?>"><a href="<?=base_url()?>clients">Clients</a></li>
            <?php } if($this->tank_auth->checkPermission('staffs')) { ?>
                <li class="<?php if($page == 'Staffs'){echo  "active"; }?>"><a href="<?=base_url()?>staffs">Staff</a></li>   
            <?php } if($this->tank_auth->checkPermission('jobs')) { ?>
                <li class="<?php if($page == 'Jobs'){echo  "active"; }?>"><a href="<?=base_url()?>jobs">Jobs</a></li>
            <?php } /*if($this->tank_auth->checkPermission('reports')) { ?>
                <li class="<?php if($page == 'Reports'){echo  "active"; }?>"><a href="<?=base_url()?>reports">Reports</a></li>
            <?php }*/ ?>
            <li><a href="<?=base_url()?>auth/logout">Logout</a></li>
            <li class="setting-icon <?php if($page == 'Settings'){echo  "active"; }?>">
                <a href="<?=base_url()?>settings">
                <?=$page=='Settings' ? '<img alt="" src="'.base_url().'resource/images/settings-a.png">' : '<img alt="" src="'.base_url().'resource/images/settings.png">' ?>
                </a>
            </li> 
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>