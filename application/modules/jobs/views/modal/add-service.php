<!-- /////// For Ajax call for Add Servces -->
<?php $j=1; foreach ($servicetype as $service) { ?>
    <?php if($service->servicetype==$getservice){ ?>
        <div class="we9-heading"><?=$service->servicetype?>s</div>
        <div class="row wa3-form-row">
          <div class="col-md-6">
              <label class="label-txt">quantity</label>
              <select name="quantity<?=$j?>" id="quantity<?=$j?>" class="form-control select-form" onchange="ecost<?=$j?>(this)" required>
                  <option value="0"> ---- Select Quantity ---- </option>
                  <?php for ($i=1; $i<=20 ; $i++) { 
                   echo '<option value="'.$i.'">'.$i.'</option>';
                  } ?>
              </select>
          </div>
        </div>
        <div class="row wa3-form-row">
          <div class="col-md-6">
              <input type="text" value="$<?=$hourlyrate?>.00" class="form-control" disabled>
          </div>
          <div class="col-md-6">
              <input type="hidden" id="estimatedcost<?=$j?>" name="estimatedcost<?=$j?>" value="0">
              <div class="esti-mate">estimated cost*: <span id="ecost<?=$j?>">  $0.00  </span> </div>
              <div class="sm-txt">*before fees and taxes</div>
          </div>
        </div>                          
        <div class="form-heading">uniform</div>                       
        <div class="row wa3-form-row">
          <div class="col-md-12">
              <div class="skill-sec clearfix">
                  <div data-toggle="buttons" class="btn-group">
                      <label class="btn btn-primary">
                          <div class="skill-select-pic">
                              <img alt="" src="<?=base_url()?>resource/images/wa31.png">
                          </div>
                          <span class="txt-cha1">barista </span> <input type="radio" name="uniform<?=$j?>" value="Barista" required> 
                      </label>
                      <label class="btn btn-primary">
                          <div class="skill-select-pic">
                              <img alt="" src="<?=base_url()?>resource/images/wa32.png">
                          </div>
                          <span> waiter white </span> <input type="radio" name="uniform<?=$j?>" value="Waiter White" required> 
                      </label>
                      <label class="btn btn-primary">
                         <div class="skill-select-pic">
                              <img alt="" src="<?=base_url()?>resource/images/wa33.png">
                          </div>
                          <span class="txt-cha2"> all black </span> <input type="radio" name="uniform<?=$j?>" value="All Black" required> 
                      </label>
                  </div>
              </div>        
          </div>
        </div>
        <div id="captain<?=$j?>"></div> 
    <?php } $j++; ?>
<?php } ?>