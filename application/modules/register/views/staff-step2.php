<div class="container">
    <div class="wa2">
        <div class="wa2-pic"> <img src="<?=base_url()?>resource/images/wa3pic1.png" alt=""> </div>
        <div class="wa2-pic-welcome">
            <div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logo"> </div>
           <div class="great-txt">great!</div>
            <div class="great-para">
                  <p>every waitron is screened prior to acceptance into the program </p>
                  <p>please ﬁll out the information below and someone will be in touch with you shortly</p>
            </div>
        </div>
        <?php //=form_open($this->uri->uri_string())?>
         <form enctype="multipart/form-data" class="bs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url().'register/staff'?>"> 
        <input type="hidden" name="user_type" value="<?=$login['user_type']?>">
        <input type="hidden" name="firstname" value="<?=$login['firstname']?>">
        <input type="hidden" name="lastname" value="<?=$login['lastname']?>">
        <input type="hidden" name="email" value="<?=$login['email']?>">
        <input type="hidden" name="password" value="<?=$login['password']?>">
            <div class="wa3-form">
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">zip code</label>
                        <input type="text" name="zipcode" class="form-control" placeholder="zip code" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">city</label>
                        <input type="text" name="city" class="form-control" placeholder="city" required>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">state</label>
                        <input type="text" name="state" class="form-control" placeholder="state" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">phone number</label>
                        <input type="text" name="phone" class="form-control" placeholder="phone number" required>
                    </div>
                </div>
                
                
                <div class="row wa3-form-row">
                    <div class="col-md-6">
                        <label class="label-txt">address</label>
                        <input type="text" name="address" class="form-control" placeholder="address" required>
                    </div>
                    <div class="col-md-6">
                        <label class="label-txt">apartment</label>
                        <input type="text" name="apartment" class="form-control" placeholder="apartment" required>
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
                        <label class="label-txt">select preferred method(s) of contact</label>
                        
                        <div class="select-skill">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    email <input type="checkbox" name="moc_email" value="Yes" checked=""> 
                                </label>
                                <label class="btn btn-primary active">
                                  call  <input type="checkbox" name="moc_call" value="Yes" checked=""> 
                                </label>
                                <label class="btn btn-primary active">
                                  text  <input type="checkbox" name="moc_text" value="Yes" checked=""> 
                                </label>
                            </div>
                        
                        </div>
                    </div>
                </div>
                
                
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">copy/paste resume</label>
                        <textarea name="anycomments" placeholder="copy/paste resume" class="form-control txt-fieldarea" required></textarea>
                    </div>
                </div>
                <!-- <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <label class="label-txt">upload resume</label>
                        <input type="file" name="userfile" data-classinput="form-control inline input-s" data-classbutton="btn btn-default" data-icon="false" data-buttontext="Choose File" class="filestyle hidden" id="filestyle-0" style="position: fixed; left: -500px;">
                        <div style="display: inline;" class="bootstrap-filestyle"> <label class="btn btn-default" for="filestyle-0"><span>Choose File</span></label></div>
                    </div>
                </div> -->

                <div class="row wa3-form-row">
                    <div class="col-md-12">
                        <div class="terms_cndtn" data-toggle="buttons">
                            <label class="btn btn-primary" >
                                <input type="checkbox" value="Yes" name="tos" required> 
                                By Submitting Your Application You Agree To The Waitron
                                <a href="#" data-toggle="modal" data-target=".terms-of-services">Terms Of Service</a> 
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="row wa3-form-row">
                    <div class="col-md-12">
                      <input type="submit" name="step2" class="btn-nxt" value="submit">
                    </div>
                </div>
            </div>
            <ul class="step-progress">
                <li> </li>
                <li class="current"> </li>
            </ul>
            <div class="back-link"> <a href="javascript: window.history.back()">back</a> </div> 
        </form>
    </div>
</div>

<script type="text/javascript">
    /*document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value; };*/
</script>


<!-- Button trigger modal -->
<div class="popup1">
    <div class="modal fade terms-of-services" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <h4 class="modal-title" id="myModalLabel">WAITRON INC. TERMS AND CONDITIONS</h4>
                <div class="popup_container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                    <p style="text-align: center;">PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY AS THEY CONTAIN IMPORTANT INFORMATION REGARDING YOUR LEGAL RIGHTS, REMEDIES AND OBLIGATIONS. THEE INCLUDE VARIOUS LIMITATIONS AND EXCLUSIONS, AND A CLAUSE THAT GOVERNS THE PROCEDURE, JURISDICTION AND VENUE OF DISPUTES </p>
                    
                    <h2>1. WELCOME</h2>
                    <p>Welcome to Waitron, a service owned and operated by Waitron Inc., a Delaware corporation ("<b>Waitron</b>", "<b>we</b>", "<b>us</b>" or "<b>our</b>"). These Terms and Conditions (the "<b>Terms</b>") govern your ("<b>you</b>" or "<b>your</b>") access to and use of the website, located at 115 W 18th St, 2nd Fl New York, NY 10011 and any other Waitron branded websites, web pages, mobile applications and mobile websites operated by Waitron (the "<b>Site</b>") and all services (the "<b>Services</b>") provided by Waitron via the Site. </p>
                    <p>These Terms incorporate our Privacy Policy by reference, which contains information and notices concerning Waitron's collection and use of your personal and non-personal information and data. Please carefully read these Terms and our Privacy Policy before using the Site or Service.</p>
                    <h2>Definitions</h2>
                    <p><b>"Client"</b> means a user of the Site and Service interested in booking Limited Employees for Events. <b>"Event"</b> means an event that Client requires Limited Employee Service.</p>
                    <p><b>"Limited Employee"</b> means a registered user who has a LE Account and is interested in providing services at Events.</p>
                    <p><b>“Web Portal"</b> means the Waitron website located at http://waitron.com </p>
                    <p><b>"You"</b> or <b>"User"</b> refers to both of Client and Limited Employee.</p>
                    <p><b>"Waitron Representative"</b> means an individual who communicates with both of Client and Limited Employee on behalf of Waitron.</p>
                    <p><b>"Opportunity"</b> means a prospective Event for a Limited Employee.</p>
                </div>
                <h2> for more information <a href="<?=base_url()?>resource/tos/WAITRON-TOS.pdf" target="_blank">click here..</a></h2>
                <ul class="yes-no-select clearfix">
                    <li class="no-select"> <a href="#" data-dismiss="modal" aria-label="Close">OK</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
