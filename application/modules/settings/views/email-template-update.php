<?php if (!empty($templates)) {
foreach ($templates as $template) { ?>
          
<div class="container">
    <div class="welcome-back-txt">update email template</div>
    <div class="jobs">
        <div class="we6-table-main wa39-box">
            <?=form_open($this->uri->uri_string())?>
            <input type="hidden" name="template_id" value="<?=$template->template_id?>">
                <div class="col-lg-12">
                    <label class="label-txt">email group</label>
                    <input class="form-control" name="email_group" value="<?=$template->email_group?>">
                </div>
                <div class="col-lg-12">
                    <label class="label-txt">name</label>
                    <input class="form-control" name="name" value="<?=$template->name?>">
                </div>
                <div class="col-lg-12">
                    <label class="label-txt">subject</label>
                    <input class="form-control" name="subject" value="<?=$template->subject?>">
                </div>
                <div class="col-lg-12" style="margin-top:20px;">
                    <label class="label-txt">template body/message</label>
                    <textarea class="form-control foeditor" name="template_body" style="display: none;" rows="10"><?=$template->template_body?></textarea>
                </div>
      
                <div class="col-md-12" style="margin-top:20px;">
                    <div class="text-center"> <input type="submit" class="submit-btn" name="update" value="Save Changes"> </div>
                </div>
            </form>
        </div>
    </div>        
</div>

<?php } } ?>
                    
                  
