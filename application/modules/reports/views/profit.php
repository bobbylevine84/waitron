<div class="container">
    <div class="welcome-back-txt">reports</div>
    <ul class="acc-dec job-payment wa32-wap">
        <?php if($this->tank_auth->checkPermission('report_ca')) { ?>
        <li><a href="<?=base_url()?>reports">company <br>activity</a></li>
        <?php } if($this->tank_auth->checkPermission('report_profit')){ ?>
        <li><a class="active" href="<?=base_url()?>reports/profit">proﬁt</a></li>
        <?php } if($this->tank_auth->checkPermission('report_invoice')){ ?>
        <li><a href="<?=base_url()?>reports/invoices">invoices</a></li>
        <?php } if($this->tank_auth->checkPermission('report_payment')){ ?>
        <li><a href="<?=base_url()?>reports/payments">payments</a></li>
        <?php } if($this->tank_auth->checkPermission('report_wa')){ ?>
        <li><a href="<?=base_url()?>reports/waitronactivity">waitron activity</a></li>
        <?php } ?>
    </ul>

    <div class="jobs">
        <div class="jobs-heading">proﬁt</div>
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
            <?php if($this->tank_auth->checkPermission('report_profit_download')) { ?>                     
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
                        <th>activity</th>
                        <th>week of <br> 9/01/15 </th>
                        <th>week of <br> 9/08/15 </th>
                        <th>week of <br> 9/15/15 </th>
                        <th>week of <br> 9/23/15 </th>
                        <th>total</th>
                        <th> average </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>  Payments received from employers </td>
                        <td>$14,609</td>
                        <td>$18,322</td>
                        <td>$17,441</td>
                        <td>$17,021</td>
                        <td><strong>$67,393</strong></td>
                        <td> $16,848.25 </td>
                    </tr>
                    <tr>
                        <td> Payouts to wrokers </td>
                        <td>$11,687.2</td>
                        <td>$14,657.6</td>
                        <td>$13,952.8</td>
                        <td>$13,616.8</td>
                        <td><strong>$53,914.4</strong></td>
                        <td> $13,478.6 </td>
                    </tr>
                    <tr>
                        <td> Refunded </td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td><strong>0</strong></td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td> Proﬁt </td>
                        <td>$2,921.8</td>
                        <td>$3,664.4</td>
                        <td>$3,488.2</td>
                        <td>$3,404.2</td>
                        <td><strong>$13,478.6</strong></td>
                        <td> $3,369.65 </td>
                    </tr>
                </tbody>        
            </table>
        </div>
    </div>
</div>
