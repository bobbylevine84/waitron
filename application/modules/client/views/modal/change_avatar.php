<div class="modal-dialog">
    <div class="modal-content">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button>
        <form enctype="multipart/form-data" class="bs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url().'client/changeavatar'?>"> 
            <div class="wa10-pop">
                <div class="billing-history-txt"> Update Avatar </div>
                <div class="deactive-acc">
                    <input type="hidden" value="<?=$user_id?>" name="user_id">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <label class="label-txt">Change Avatar : </label>
                        </div>
                        <div class="col-sm-6 text-left">
                            <input type="file" name="userfile" data-classinput="form-control inline input-s" data-classbutton="btn btn-default" data-icon="false" data-buttontext="Choose File" class="filestyle hidden" id="filestyle-0" style="position: fixed; left: -500px;">
                            <div style="display: inline;" class="bootstrap-filestyle"> <label class="btn btn-default" for="filestyle-0"><span>Choose File</span></label></div>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top:20px;margin-bottom:20px;">
                    <input class="submit-btn" type="submit" value="Change Avatar" name="update">
                </div>
            </div>
        </form>
    </div>
</div>