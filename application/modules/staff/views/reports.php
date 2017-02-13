<?php if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
          <div class="welcome-back-txt">reports</div>
          <ul class="acc-dec job-payment">
              <li><a class="active" href="<?=base_url()?>staff/reports">jobs</a></li>
              <li><a href="<?=base_url()?>staff/reports/payment">payments</a></li>
          </ul>
          <div class="jobs">
              <div class="jobs-heading">jobs</div>
              <ul class="apply-filter">
                    <li>
                        <select class="form-control selectpic">
                              <option> monthly</option>
                        </select>
                    </li>
                    <li>
                          <input class="form-control" type="text" placeholder="start date">
                    </li>
                    <li>
                          <input class="form-control" type="text" placeholder="end date">
                    </li>
                    <li>
                          <input type="button" value="apply ﬁlters" class="apply-ﬁlters-btn">
                    </li>
              </ul>
              <ul class="short-filter clearfix">
                    <li>
                        <select class="form-control selectpic">
                              <option> sort by</option>
                        </select>
                    </li>
                    <li>
                          <select class="form-control selectpic">
                                <option> view only</option>
                          </select>
                    </li>
                    <li>
                          <a href="javascript:void"><img src="<?=base_url()?>resource/images/wa12pic1.png" alt=""> </a>
                    </li>
                    <li>
                          <a href="javascript:void"><img src="<?=base_url()?>resource/images/wa12pic2.png" alt=""> </a>
                    </li>
              </ul>
              <div class="wa12-table table-responsive">
                      
                      <table class="table table-hover" width="100%" border="0">
                        <thead>
                            <tr>
                              <th>job id</th>
                              <th>project name</th>
                              <th>date</th>
                              <th>employer</th>
                              <th>company</th>
                              <th>hours</th>
                              <th>paid</th>
                              <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8">none</td>
                            </tr>
                            <!-- <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012931</td>
                              <td>Apple event</td>
                              <td>9/26/15</td>
                              <td>JANE SARRATT</td>
                              <td>STAFFING SOLUTUONS <br> INC</td>
                              <td>8</td>
                              <td>$180</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr>
                            <tr>
                              <td>10012801</td>
                              <td>samsung event</td>
                              <td>9/25/15</td>
                              <td>TONY DIGREGO</td>
                              <td>APPLE EVENTS</td>
                              <td>7</td>
                              <td>$110</td>
                              <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)">submit dispute</a> </td>
                            </tr> -->
                        </tbody>    
                      </table>
              </div>
          </div>
          <div class="popup1">      
              <div aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" class="modal fade bs-example-modal-lg" style="display: none;">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <button aria-label="Close" data-dismiss="modal" class="close" type="button">x</button>
                          <div class="wa10-pop">
                              <div class="rating-txt">submit a dispute</div>
                              <div class="submit-dispute">
                                    <p>10012788</p>
                                    <p>9/19/15</p>
                                    <p>PHYLLIS DEVAUX</p>
                                    <p>CATERING SOLUTIONS</p>
                              </div>
                              <div class="dispute-txt">type of dispute</div>
                              <div class="select-skill align-center-field">
                                  <div data-toggle="buttons" class="btn-group">
                                      <label class="btn btn-primary active">
                                          incorrect hours <input type="checkbox" checked="" autocomplete="off"> 
                                      </label>
                                      <label class="btn btn-primary">
                                        incorrect pay <input type="checkbox" autocomplete="off"> 
                                      </label>
                                  </div>
                              </div>
                              <div class="comment-box">
                                  <h3>comments</h3>
                                  <textarea class="form-control" placeholder="2000 character limit"></textarea>                 
                              </div>  
                              <ul class="yes-no-select clearfix">
                                    <li class="yes-select"> <a href="javascript:void(0)">submit</a></li>
                                    <li class="no-select"> <a href="javascript:void(0)">cancel</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
<?php } } ?>
