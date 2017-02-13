<?php if (!empty($staff_info)) {
foreach ($staff_info as $staff) { ?>
    <div class="standmode">standby mode: <span><?=$staff->standby==0? 'on' : 'off'?></span></div>
    <div class="container">
        <div class="welcome-back-txt">reports</div>
        <ul class="acc-dec job-payment">
            <li><a  href="<?=base_url()?>staff/reports">jobs</a></li>
            <li><a class="active" href="<?=base_url()?>staff/reports/payment">payments</a></li>
        </ul>
        <div class="jobs">
            <div class="jobs-heading">payments</div>
            <ul class="apply-filter">
                <li>
                    <select class="form-control selectpic">
                          <option> weekly</option>
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
                        <th>date worked</th>
                        <th>hours</th>
                        <th>rate</th>
                        <th>total</th>
                        <th>payment sent</th>
                        <th>employer</th>
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
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u> JANE SARRATT </u> </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>8</td>
                        <td>$15</td>
                        <td>$120</td>
                        <td>9/26/15</td>
                        <td> <a data-target=".bs-example-modal-lg" data-toggle="modal" href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
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
                            <div class="rating-txt">employer</div>
                            <div class="submit-dispute">
                                  <p> Job ID: 10012931</p>
                                  <p>Date Worked: 9/26/15</p>
                                  <p>JANE SARRAT</p>
                                  <p>Stafﬁng Solutions</p>
                            </div>
                            <div class="member-pic">
                                    <img src="<?=base_url()?>resource/images/memberpic.jpg" alt="">
                            </div>
                            <ul class="member-seen">
                                    <li>member since</li>
                                    <li><strong>8/11/15</strong></li>
                            </ul>
                            <ul class="yes-no-select clearfix">
                                  <li class="no-select"> <a href="javascript:void(0)">close</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>