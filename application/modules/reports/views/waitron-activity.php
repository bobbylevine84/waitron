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
        <li><a href="<?=base_url()?>reports/payments">payments</a></li>
        <?php } if($this->tank_auth->checkPermission('report_wa')){ ?>
        <li><a class="active" href="<?=base_url()?>reports/waitronactivity">waitron activity</a></li>
        <?php } ?>
    </ul>

    <div class="jobs">
        <div class="jobs-heading">waitron activity</div>
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
            <?php if($this->tank_auth->checkPermission('report_wa_download')) { ?>                     
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>   Active Users </td>
                        <td> 680 </td>
                        <td> 701 </td>
                        <td> 711 </td>
                        <td> 732 </td>
                    </tr>
                    <tr>
                        <td>   Inactive Users </td>
                        <td> 30 </td>
                        <td> 32 </td>
                        <td> 30 </td>
                        <td> 35 </td>
                    </tr>
                    <tr>
                        <td>    Jobs Missed </td>
                        <td> 0 </td>
                        <td> 1 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>   Average Job Acceptance Time </td>
                        <td> 1:20 </td>
                        <td> 1:15 </td>
                        <td> 0:45 </td>
                        <td> 1:01 </td>
                    </tr>
                    <tr>
                        <td>  Average Service Rating </td>
                        <td> 4.5 </td>
                        <td> 4.6 </td>
                        <td> 4.6 </td>
                        <td> 4.5 </td>
                    </tr>
                </tbody>         
            </table>
        </div>
    </div>
</div>
