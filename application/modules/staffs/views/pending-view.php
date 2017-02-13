<?php if (!empty($staffs)) {
foreach ($staffs as $staff) { ?>
          
<div class="container">
      <div class="top-heading">
      <?=$staff->firstname." ".$staff->lastname?>
          <div class="staff-sol">waitron</div>
          <a href="<?=base_url()?>staffs/pending" class="back-link-right">back</a>
      </div>
      <div class="wa3-form">
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">ﬁrst name</label>
                    <input type="text" disabled name="firstname" placeholder="first name" class="form-control" value="<?=$staff->firstname?>" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">last name</label>
                    <input type="text" disabled name="lastname" placeholder="last name" class="form-control" value="<?=$staff->lastname?>" required>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">zip code</label>
                    <input type="text" disabled name="zipcode" placeholder="zipcode" class="form-control" value="<?=$staff->zipcode?>" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">city</label>
                    <input type="text" disabled name="city" placeholder="city" class="form-control" value="<?=$staff->city?>" required>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">state</label>
                    <input type="text" disabled name="state" placeholder="state" class="form-control" value="<?=$staff->state?>" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">address</label>
                    <input type="text" disabled name="address" placeholder="address" value="<?=$staff->address?>" class="form-control">
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">phone</label>
                    <input type="text" disabled name="phone" placeholder="phone number" class="form-control" value="<?=$staff->phone?>" required>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">email</label>
                    <input type="hidden" name="old_email" value="<?=$staff->email?>">
                    <input type="email" disabled name="email" placeholder="email address" value="<?=$staff->email?>" class="form-control" required>
                </div>
            </div>

            <?php $skills_array=explode(", ",$staff->skills); 
            function active($value, $skills_array)
            {
              $test=array_search($value, $skills_array);
              echo strval($test)!='' ? 'active' : '';
            }
            function checked($value, $skills_array)
            {
              $test=array_search($value, $skills_array);
              echo strval($test)!='' ? 'checked' : '';
            }
            ?>
            <!-- <div class="row wa3-form-row">
                <div class="col-md-12">
                    <label class="label-txt">select your skills</label>
                    <div class="skill-sec clearfix">
                        <div data-toggle="buttons" class="btn-group">
                            <label class="btn btn-primary <?=active('Barista',$skills_array);?>">
                                <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa31.png">
                                </div>
                                <span>barista </span> <input type="checkbox" name="skills[]" value="Barista" <?=checked('Barista',$skills_array);?>> 
                            </label>
                            <label class="btn btn-primary <?=active('Server',$skills_array);?>">
                                <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa32.png">
                                </div>
                                <span> server </span> <input type="checkbox" name="skills[]" value="Server" <?=checked('Server',$skills_array);?>> 
                            </label>
                            <label class="btn btn-primary <?=active('Bartender',$skills_array);?>">
                                <div class="skill-select-pic">
                                    <img alt="" src="<?=base_url()?>resource/images/wa33.png">
                                </div>
                                <span>  bartender </span> <input type="checkbox" name="skills[]" value="Bartender" <?=checked('Bartender',$skills_array);?>> 
                            </label>
                          </div>
                    </div>    
                </div>
            </div> -->

            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <label class="label-txt">select your skills</label>
                    <div class="skill-sec clearfix">
                        <div data-toggle="buttons" class="btn-group">
                            <?php foreach ($servicetype as $service) {  ?>
                                <label class="btn btn-primary <?=active($service->servicetype,$skills_array);?> ">
                                    <div class="skill-select-pic">
                                        <img style="width:162px; height:162px" src="<?=base_url()?>resource/service/<?=$service->serviceicon?>">
                                    </div>
                                    <span><?=$service->servicetype?> </span> <input type="checkbox" name="skills[]" value="<?=$service->servicetype?>" <?=checked($service->servicetype,$skills_array);?> > 
                                </label>
                            <?php } ?>
                          </div>
                    </div>    
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <label class="label-txt">preferred method(s) of contact</label>                             
                    <div class="select-skill">
                          <div data-toggle="buttons" class="btn-group">
                              <label class="btn btn-primary <?=$staff->moc_email=='Yes' ? 'active' : '' ?> ">
                                  email <input type="checkbox" name="moc_email" value="Yes" <?=$staff->moc_email=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                              </label>
                              <label class="btn btn-primary <?=$staff->moc_call=='Yes' ? 'active' : '' ?> ">
                                call  <input type="checkbox" name="moc_call" value="Yes" <?=$staff->moc_call=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                              </label>
                              <label class="btn btn-primary <?=$staff->moc_text=='Yes' ? 'active' : '' ?> ">
                                text  <input type="checkbox" name="moc_text" value="Yes" <?=$staff->moc_text=='Yes' ? 'checked' : '' ?> autocomplete="off"> 
                              </label>
                          </div>
                    
                    </div>
                </div>
            </div>
            <?=form_open($this->uri->uri_string())?>
            <input type="hidden" name="user_id" value="<?=$staff->user_id?>">
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">submitted comments</label>
                        <textarea name="anycomments" disabled  class="form-control txt-fieldarea"><?=$staff->anycomments?></textarea>
                    </div>
                </div>
                <?php if($this->tank_auth->checkPermission('staff_notes')) { ?>
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">notes</label>
                        <textarea name="notes" class="form-control txt-fieldarea"><?=$staff->notes?></textarea>
                    </div>
                </div>

                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="text-center"> <input type="submit" class="submit-btn" name="update" value="Save Changes"> </div>
                    </div>
                </div>
                <?php } ?>
            </form>

            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <ul class="acc-dec-btn">
                        <?php if($this->tank_auth->checkPermission('staff_accept')) { ?> <li><a href="<?=base_url()?>staffs/pending/approve/<?=$staff->user_id?>"><input type="button" class="submit-btn accept-btn-bg" value="accept"></a></li> <?php } if($this->tank_auth->checkPermission('staff_decline')) { ?>
                        <li><a href="<?=base_url()?>staffs/pending/decline/<?=$staff->user_id?>"><input type="button" class="submit-btn" value="decline"></a></li> <?php } ?>
                    </ul> 
                </div>
            </div>
                                                                        
      </div>        
</div>

<?php } } ?>

                    
                  
