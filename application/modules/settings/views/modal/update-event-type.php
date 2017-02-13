<div class="modal-dialog">
    <div class="modal-content">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button>
        <?=form_open($this->uri->uri_string())?>
            <div class="wa10-pop">
                <?php foreach ($eventtype as $event) {  ?>
                    <div class="billing-history-txt"> Update Event Type</div>
                    <div class="deactive-acc">
                        <input type="hidden" value="<?=$event->eventtypeid?>" name="eventtypeid">
                        <div class="row wa16-form-row">
                            <div class="col-md-6 col-md-offset-3">
                                <label class="label-field">event type</label>
                                <input type="text" class="form-control" placeholder="event type" name="eventtype" value="<?=$event->eventtype?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top:30px;margin-bottom:30px;">
                        <input class="submit-btn" type="submit" value="Update" name="update">
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>