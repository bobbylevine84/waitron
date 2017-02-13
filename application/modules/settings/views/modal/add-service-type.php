<div class="modal-dialog">
    <div class="modal-content">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button>
        <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?=base_url().'settings/servicetype/add'?>"> 
            <div class="wa10-pop">
                <div class="billing-history-txt"> Add Service Type</div>
                <div class="deactive-acc">
                    <input type="hidden" value="<?=$user_id?>" name="createby">
                    <div class="row wa16-form-row">
                        <div class="col-md-6 col-md-offset-3">
                            <label class="label-field">service type</label>
                            <input type="text" class="form-control" placeholder="service type name" name="servicetype" required>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <label class="label-field">service type icon</label>
                            <input type="file" name="userfile" data-classinput="form-control inline input-s" data-classbutton="btn btn-default" data-icon="false" data-buttontext="Choose File" class="filestyle hidden" id="filestyle-0" style="position: fixed; left: -500px;">
                            <div style="display: inline;" class="bootstrap-filestyle"> <label class="btn btn-default" for="filestyle-0"><span>Choose File</span></label></div>
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