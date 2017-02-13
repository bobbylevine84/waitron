 <div class="modal-dialog" id="delete">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> delete account </div>
            <div class="deactive-acc">
                    <p>deleting an account will completely remove the account and proﬁle data. </p>
                    <p>this action cannot be undone. </p>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a onclick="document.getElementById('delete').style.display = 'none';
document.getElementById('cdelete').style.display = 'block';" style="cursor:pointer;">delete account</a></li>
            </ul>
        </div>                  
    </div>
</div>

<div class="modal-dialog" id="cdelete" style="display:none;">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> delete account </div>
            <div class="deactive-acc">
                    <p>are you really really sure you want to delete this account?</p>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a href="<?=base_url()?>clients/deleteaccount/<?=$user_id?>/delete">yes</a></li>
            </ul>
        </div>                  
    </div>
</div>