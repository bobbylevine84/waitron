<div class="modal-dialog">
    <div class="modal-content">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button>
       <!--  <form enctype="multipart/form-data" class="bs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url().'clients/changeavatar'?>">  -->
        <?=form_open($this->uri->uri_string())?>
            <div class="wa10-pop">
                <div class="billing-history-txt"> Add Event Type</div>
                <div class="deactive-acc">
                    <input type="hidden" value="<?=$user_id?>" name="createby">
                    <div class="row wa16-form-row">
                        <div class="col-md-6 col-md-offset-3">
                            <label class="label-field">event type</label>
                            <input type="text" class="form-control" placeholder="event type name" name="eventtype" required>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top:30px;margin-bottom:30px;">
                    <input class="submit-btn" type="submit" value="Save" name="add">
                </div>
            </div>
        </form>
    </div>
</div>