 <div class="modal-dialog" id="delete">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> cancel job/event</div>
            <div class="deactive-acc">
                    <p>cancelling job/event will completely remove the job/event and related services data. </p>
                    <p>this action cannot be undone. </p>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a onclick="document.getElementById('delete').style.display = 'none';
document.getElementById('cdelete').style.display = 'block';" style="cursor:pointer;">cancel job/event</a></li>
            </ul>
        </div>                  
    </div>
</div>

<div class="modal-dialog" id="cdelete" style="display:none;">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> cancel job/event </div>
            <div class="deactive-acc">
                    <p>are you really really sure you want to cancel this job/event?</p>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a href="<?=base_url()?>client/jobs/cancel/<?=$jobid?>/yes">yes</a></li>
            </ul>
        </div>                  
    </div>
</div>