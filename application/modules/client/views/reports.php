<div class="container">
    <div class="welcome-back-txt">reports</div>
    <ul class="acc-dec job-payment">
        <li><a class="active" href="<?=base_url()?>client/reports">jobs</a></li>
        <li><a href="<?=base_url()?>client/reports/invoices">invoices</a></li>
    </ul>
    <div class="jobs">
        <div class="jobs-heading">jobs</div>
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
                        <th>date</th>
                        <th>hours</th>
                        <th>total staff</th>
                        <th>paid</th>
                        <th>&nbsp;  </th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td colspan="7">none</td>
                      </tr>
                      <!-- <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012931</td>
                        <td>Apple event</td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>20</td>
                        <td>$4200</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr>
                      <tr>
                        <td>10012801</td>
                        <td>samsung event</td>
                        <td>9/25/15</td>
                        <td>7</td>
                        <td>10</td>
                        <td>$3400</td>
                        <td> <a href="javascript:void(0)"> view job details </a> </td>
                      </tr> -->
                  </tbody>    
                </table>
        </div>
    </div>
</div>