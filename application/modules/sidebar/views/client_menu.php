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
        <!-- <form role="search" class="navbar-form navbar-right">
            <div class="form-group">
                <input type="text" placeholder="search anything" class="form-control">
            </div>
        </form> -->
        <ul class="nav navbar-nav navbar-right">
            <li class="<?php if($page == 'Home'){echo  "active"; }?>"><a href="<?=base_url()?>client">Dashboard</a></li>
            <li class="<?php if($page == 'Jobs'){echo  "active"; }?>"><a href="<?=base_url()?>client/jobs">Jobs</a></li>
            <!-- <li class="<?php if($page == 'Messages'){echo  "active"; }?>"><a href="<?=base_url()?>client/messages">Messages</a></li> -->
            <li class="<?php if($page == 'Profile'){echo  "active"; }?>"><a href="<?=base_url()?>client/profile">Profile</a></li>
            <li class="<?php if($page == 'Reports'){echo  "active"; }?>"><a href="<?=base_url()?>client/reports">Reports</a></li>
            <li><a href="<?=base_url()?>auth/logout">Logout</a></li>
            <li class="setting-icon <?php if($page == 'Settings'){echo  "active"; }?>"><a href="<?=base_url()?>client/settings"> <?=$page=='Settings' ? '<img alt="" src="'.base_url().'resource/images/settings-a.png">' : '<img alt="" src="'.base_url().'resource/images/settings.png">' ?> </a></li>    
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>