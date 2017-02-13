<div class="container">
      <div class="top-heading">
          <a href="<?=base_url()?>staffs" class="back-link-right">back</a>
      </div>
      <?=form_open($this->uri->uri_string(),array("enctype"=>"multipart/form-data"))?>
      <input type="hidden" name="user_type" value="Staff">
          <div class="wa3-form">
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">ﬁrst name</label>
                        <input type="text" name="firstname" placeholder="first name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">last name</label>
                        <input type="text" name="lastname" placeholder="last name" class="form-control" required>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">zip code</label>
                        <input type="text" name="zipcode" placeholder="zip code" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">city</label>
                        <input type="text" name="city" placeholder="city" class="form-control" required>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">state</label>
                        <input type="text" name="state" placeholder="state" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">address</label>
                        <input type="text" name="address" placeholder="address" class="form-control">
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">phone</label>
                        <input type="text" name="phone" placeholder="phone number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">email</label>
                        <input type="email" name="email" placeholder="email address" class="form-control" required>
                    </div>
                </div>
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">select avatar image</label>
                        <input type="file" name="userfile" data-classinput="form-control inline input-s" data-classbutton="btn btn-default" data-icon="false" data-buttontext="Choose File" class="filestyle hidden" id="filestyle-0" style="position: fixed; left: -500px;">
                            <div style="display: inline;" class="bootstrap-filestyle"> <label class="btn btn-default" for="filestyle-0"><span>Choose File</span></label></div>
                    </div>
                    
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">preferred method(s) of contact</label>                             
                        <div class="select-skill">
                              <div data-toggle="buttons" class="btn-group">
                                  <label class="btn btn-primary ">
                                      email <input type="checkbox" name="moc_email" value="Yes" autocomplete="off"> 
                                  </label>
                                  <label class="btn btn-primary ">
                                    call  <input type="checkbox" name="moc_call" value="Yes" autocomplete="off"> 
                                  </label>
                                  <label class="btn btn-primary ">
                                    text  <input type="checkbox" name="moc_text" value="Yes" autocomplete="off"> 
                                  </label>
                              </div>
                        
                        </div>
                    </div>
                </div>
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">banking information</label>
                        <input type="text" name="routingnumber" placeholder="routing number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">&nbsp;</label>
                        <input type="text" name="accountnumber" placeholder="account number" class="form-control">
                    </div>
                </div>

                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">select your skills</label>
                        <div class="skill-sec clearfix">
                            <div data-toggle="buttons" class="btn-group">
                                <?php foreach ($servicetype as $service) {  ?>
                                    <label class="btn btn-primary ">
                                        <div class="skill-select-pic">
                                            <img style="width:162px; height:162px" src="<?=base_url()?>resource/service/<?=$service->serviceicon?>">
                                        </div>
                                        <span><?=$service->servicetype?> </span> <input type="checkbox" name="skills[]" value="<?=$service->servicetype?>"> 
                                    </label>
                                <?php } ?>
                              </div>
                        </div>    
                    </div>
                </div>               

                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="text-center"> <input type="submit" class="submit-btn" name="add" value="Save Changes"> </div>
                    </div>
                </div>
          </div>        
      </form>
</div>
