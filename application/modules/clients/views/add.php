<style type="text/css">
    .help-block{
        color: red !important;
        font-size: 14px;
    }
    :disabled {
        background: #909090;
        cursor: not-allowed !important;
    }
    :disabled:hover {
        background: #909090;
    }
</style>
<div class="container">
    <div class="top-heading">
         <a class="back-link-right" href="<?=base_url()?>clients">back</a>
    </div>
    <form role="form" method="post" id="defaultForm" method="post" action="<?=$this->uri->uri_string()?>" accept-charset="utf-8" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <input type="hidden" name="user_type" value="Client">
        <div class="wa3-form">
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">ﬁrst name</label>
                    <input type="text" name="firstname" class="form-control" placeholder="first name" required data-bv-notempty-message="The first name cannot be empty">
                </div>
                <div class="col-md-6">
                    <label class="label-txt">last name</label>
                    <input type="text" name="lastname" class="form-control" placeholder="last name" required data-bv-notempty-message="The last name cannot be empty">
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">city</label>
                    <input type="text" name="city" class="form-control" placeholder="city" required data-bv-notempty-message="The city cannot be empty">
                </div>
                <div class="col-md-6">
                    <label class="label-txt">phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="phone number" required data-bv-notempty-message="The phone cannot be empty" data-bv-numeric="true" data-bv-numeric-message="Please enter valid phone number">
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">address</label>
                    <input type="text" name="address" class="form-control" placeholder="address" required data-bv-notempty-message="The address cannot be empty">
                </div>
                <div class="col-md-6">
                    <label class="label-txt">zip code</label>
                    <input type="text" name="zipcode" class="form-control" placeholder="zip code" required data-bv-notempty-message="The zipcode cannot be empty" maxlength="5" minlength="5" data-bv-numeric="true" data-bv-numeric-message="Please enter valid numeric zipcode " data-bv-stringlength-message="Please enter valid 5 digit zipcode">
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">email</label>
                    <input type="email" name="email" class="form-control" placeholder="email address" required required data-bv-notempty-message="The email address cannot be empty"  data-bv-email="true" required data-bv-email-message="Please enter a valid email address" >
                </div>
                <div class="col-md-6">
                    <label class="label-txt">company</label>
                    <input type="text" name="companyname" class="form-control" placeholder="company name" required required data-bv-notempty-message="The company name cannot be empty">
                </div>
            </div>

            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">hourly rate</label>
                    <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input type="text" name="hourlyrate" class="form-control" placeholder="hourly rate" required required data-bv-notempty-message="hourly rate cannot be empty"  data-bv-numeric="true" required data-bv-numeric-message="Please enter a valid hourly rate" value="35">
                    <div class="input-group-addon">.00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">job post per month</label>
                    <select class="form-control select-form" name="jobsppm" required data-bv-notempty-message="Please  cannot be empty">
                        <option value="">---- select a range ----</option>
                        <option value="1-10">1-10</option>
                        <option value="11-50">11-50</option>
                        <option value="51-100">51-100</option>
                        <option value="100+">100+</option>
                    </select>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <label class="label-txt">preferred method(s) of contact</label>
                    
                    <div class="select-skill">
                          <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary active">
                                email <input name="moc_email" type="checkbox" value="Yes" checked autocomplete="off" > 
                              </label>
                              <label class="btn btn-primary">
                                call  <input name="moc_call" type="checkbox" value="Yes" autocomplete="off" > 
                              </label>
                              <label class="btn btn-primary active">
                                text  <input name="moc_text" type="checkbox" value="Yes" checked autocomplete="off" > 
                              </label>
                          </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">billing information</label>
                    <select class="form-control select-form" name="cardtype" required data-bv-notempty-message="The card type cannot be empty">
                        <option value="">---- Select Card Type ----</option>
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">Master Card</option>
                        <option value="AmericanExpress">American Express</option>
                        <option value="Discover">Discover</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="label-txt">&nbsp;</label>
                    <input type="text" name="nameoncard" class="form-control" placeholder="name on card" >
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <input type="text" name="cardnumber" class="form-control" placeholder="card number" >
                </div>
                <div class="col-md-6">
                    <input type="text" name="ccvnumber" class="form-control" placeholder="ccv number" >
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <input type="text" name="czipcode" class="form-control" placeholder="zip code" >
                </div>
            </div>
            
            <div class="row wa3-form-row">
                <div class="col-md-6">
                    <label class="label-txt">banking information</label>
                    <input type="text" name="routingnumber" class="form-control" placeholder="routing number" >
                </div>
                <div class="col-md-6">
                    <label class="label-txt">&nbsp;</label>
                    <input type="text" name="accountnumber" class="form-control" placeholder="account number" >
                </div>
            </div>
            
            
            <div class="row wa3-form-row">
                <div class="col-md-12">
                    <div class="text-center"> <input type="submit" name="add" value="Save" class="submit-btn"></div>
                </div>
            </div>
        </div>          
    </form>
</div>