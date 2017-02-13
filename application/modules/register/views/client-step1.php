<div class="container">
    <div class="wa2">
        <div class="wa2-pic"> <img src="<?=base_url()?>resource/images/wa2pic1.png" alt=""> </div>
        <div class="wa2-pic-welcome">
            <h2>welcome to</h2>
            <div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logo"> </div>
            <h2>to get started please ﬁll out the info below</h2>
        </div>
        
        <?=form_open($this->uri->uri_string())?>
              <ul class="wa2-form">
              <?php  echo modules::run('sidebar/flash_msg');?>  
                  <input type="hidden" name="user_type" value="Client">
                  <li> <input type="text" name="firstname" value="" class="form-control" placeholder="ﬁrst name" required> </li>
                  <li> <input type="text" name="lastname" value="" class="form-control" placeholder="last name" required> </li>
                  <li> <input type="email" name="email" value="" class="form-control" placeholder="email" required> </li>
                  <li> <input type="password" name="password" value="" class="form-control" placeholder="create a password" required> </li>
                  <li> <input type="password" name="cpassword" value="" class="form-control" placeholder="conﬁrm password" required> </li>
                  <li> <input type="submit" name="step1" value="next" class="btn-nxt"> </li>
              </ul>
              
              <ul class="step-progress">
                  <li class="current"> </li>
                  <li> </li>
                  <li> </li>
              </ul>
              
              <div class="back-link"> <a href="javascript: window.history.back()" >back</a> </div> 
        </form>
    </div>
</div>
