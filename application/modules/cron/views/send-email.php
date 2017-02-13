<script src="http://localhost/project/dan/dev/resource/js/jquery.min.js"></script>
<script src="http://localhost/project/dan/dev/resource/js/bootstrap.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css" rel="stylesheet"  type="text/css">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js"></script>
<script type="text/javascript">
$('.foeditor').summernote({
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  });
$('.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table').remove();
</script>

<div class="container">
    <div class="welcome-back-txt">Send email Using template</div>
    <?php  echo modules::run('sidebar/flash_msg');?>  
    <div class="jobs">
        <div class="we6-table-main wa39-box">
            <?=form_open($this->uri->uri_string())?>
                <div class="col-lg-12">
                    <label class="label-txt">email</label>
                    <input class="form-control" name="email" value="">
                </div>
                <div class="col-lg-12">
                    <label class="label-txt">subject</label>
                    <input class="form-control" name="subject" value="">
                </div>
                <div class="col-lg-12" style="margin-top:20px;">
                    <label class="label-txt">template body/message</label>
                    <textarea class="form-control foeditor" name="template_body" style="display: none;" rows="10">lhsdlfhsdf
                    sdf</br>
                    sdf</br>
                    sd</br>
                    fsd</br>
                     sdf</br>
                    sdf</br>
                    sd</br>
                    fsd</br>
                    f</textarea>
                </div>
      
                <div class="col-md-12" style="margin-top:20px;">
                    <div class="text-center"> <input type="submit" class="submit-btn" name="send" value="Save Changes"> </div>
                </div>
            </form>
        </div>
    </div>        
</div>

                    
                  
