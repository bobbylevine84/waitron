<div class="container">
    <div class="welcome-back-txt">reports</div>
    <ul class="acc-dec job-payment wa32-wap">
        <?php if($this->tank_auth->checkPermission('report_ca')) { ?>
        <li><a href="<?=base_url()?>reports">company <br>activity</a></li>
        <?php } if($this->tank_auth->checkPermission('report_profit')){ ?>
        <li><a href="<?=base_url()?>reports/profit">proﬁt</a></li>
        <?php } if($this->tank_auth->checkPermission('report_invoice')){ ?>
        <li><a href="<?=base_url()?>reports/invoices">invoices</a></li>
        <?php } if($this->tank_auth->checkPermission('report_payment')){ ?>
        <li><a class="active" href="<?=base_url()?>reports/payments">payments</a></li>
        <?php } if($this->tank_auth->checkPermission('report_wa')){ ?>
        <li><a href="<?=base_url()?>reports/waitronactivity">waitron activity</a></li>
        <?php } ?>
    </ul>

    <div class="jobs">
        <div class="jobs-heading">payments</div>
        <ul class="apply-filter">
            <li>
                <select class="form-control selectpic">
                    <option value="daily">daily</option>
                    <option value="weekly">weekly</option>
                    <option value="monthly">monthly</option>
                    <option value="yearly">yearly</option>
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
            <?php if($this->tank_auth->checkPermission('report_payment_download')) { ?>                     
                <li>
                    <a href="javascript:void"><img src="<?=base_url()?>resource/images/wa12pic1.png" alt=""> </a>
                </li>
                <li>
                    <a href="javascript:void"><img src="<?=base_url()?>resource/images/wa12pic2.png" alt=""> </a>
                </li>
            <?php } ?>
        </ul>
        <div class="wa12-table table-responsive">
            <table class="table table-hover" width="100%" border="0">
                <thead>
                    <tr>
                        <th>job id</th>
                        <th>date worked </th>
                        <th>hours </th>
                        <th>rate </th>
                        <th>total </th>
                        <th>payment sent</th>
                        <th> employer  </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012931 </td>
                        <td>9/26/15</td>
                        <td>8</td>
                        <td>$26</td>
                        <td>$208</td>
                        <td>9/27/15</td>
                        <td> <a href="javascript:void(0)"> <u>JANE SARRATT</u> </a> </td>
                    </tr>
                    <tr>
                        <td>  10012801 </td>
                        <td>9/25/15</td>
                        <td> 8 </td>
                        <td> $15 </td>
                        <td> $120 </td>
                        <td> 9/26/15 </td>
                        <td> <a href="javascript:void(0)"> <u>TONY DIGREGO</u> </a> </td>
                    </tr>
                </tbody>    
            </table>
        </div>
    </div>
</div>
