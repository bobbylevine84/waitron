<?php if (!empty($client_info)) {
foreach ($client_info as $client) { ?>
<div class="container">
    <div class="welcome-back-txt">welcome back</div>
    <div class="cli-name"><?=$client->firstname?></div>
    <div class="cli-pic">
        <div class="cli-pic-main"> 
            <a data-toggle="ajaxModal" href="<?=base_url()?>client/changeavatar/<?=$client->user_id?>" class="edit-pic"> </a>  
            <img style="width:350px; height:350px" src="<?=$client->avatar=='' ? base_url().'resource/avatar/default.jpg' : base_url().'resource/avatar/'.$client->avatar ?>" alt=""> 
        </div>
    </div>
    <div class="full-name"><?=$client->firstname.' '.$client->lastname?></div>
    <div class="waitron-heading"><?=$client->companyname?></div>
    
    
    <div class="statistics-txt">statistics</div>
    <div class="stati-table">
        <table width="380px" border="0">
            <tr>
              <td>jobs posted</td>
              <td><strong>0</strong></td>
            </tr>
            <tr>
              <td>waitrons hired</td>
              <td><strong>0</strong></td>
            </tr>
            <!-- <tr>
              <td>average post cost</td>
              <td><strong>$0</strong></td>
            </tr>
            <tr>
              <td>paid out</td>
              <td><strong>$0</strong></td>
            </tr> -->
            <tr>
              <td>member since</td>
              <td><strong><?=date('d/m/y',strtotime($client->created))?></strong></td>
            </tr>
          </table>
    </div>
    <div class="waitron-heading more-txt">more</div>
    <ul class="acc-dec acc-dec-no">
        <li class="acc-dec-dec"><a href="<?=base_url()?>client/reports">view reports</a></li>
        <li class="acc-dec-accept"><a href="<?=base_url()?>client/settings">edit account info</a></li>
    </ul>
</div>
<?php } } ?>