<div class="popup1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            <h4 class="modal-title" id="myModalLabel">standby mode</h4>
            <div class="watch">
                  <img src="<?=base_url()?>resource/images/watch.png" alt="">
            </div>
            
            <h2>would you like to go into standby mode?</h2>
            <p>going into standby mode means you are ready to work <span>now</span></p>
            <p>and will put you as a priority in the matching algorithm.* </p>
            
            <ul class="yes-no-select clearfix">
                  <li class="yes-select"> <a href="<?=base_url()?>staff/standby/<?=$user_id?>/1">yes! I’m ready to work</a></li>
                  <li class="no-select"> <a href="<?=base_url()?>staff/standby/<?=$user_id?>/0">no. I need some time</a></li>
            </ul>
            
            <div class="going-txt">*going into standby mode does not guarantee work</div>
        </div>
    </div>
</div>