<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> deactivate account </div>
            <div class="deactive-acc">
                <p>deactivating an account will suspend all activity for 90 days. </p>
                <p>after 90 days the account will be deleted. </p>
                <p>if you wish to re-activate the account, you can do so by visiting the </p>
                <p>account proﬁle and clicking <a href="javascript:void(0)">activate</a>. </p>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a href="<?=base_url()?>clients/deactivateaccount/<?=$user_id?>/deactivate">deactivate account</a></li>
            </ul>
        </div>                  
    </div>
</div>