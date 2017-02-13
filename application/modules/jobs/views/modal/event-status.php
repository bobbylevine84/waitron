<div class="modal-dialog">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="wa10-pop">
            <div class="billing-history-txt"> Waitron Status</div>
            <div class="deactive-acc">
                <div class="table-responsive table-pop">
                    <table width="" border="0" class="table">
                        <thead>
                            <tr>
                                <th style="width:333px;">service type</th>
                                <th style="width:333px;">waitron</th>
                                <th style="width:333px;">status</th>
                            </tr>
                        </thead>
                        <tbody style="height:284px">
                            <?php foreach ($events as $event) { ?>
                                <tr>
                                    <td style="width:333px;"><?=$event->servicetype?></td>
                                    <td style="width:333px;"><?php if($event->staffid==NULL) { echo 'not assigned'; } else { ?> <img src="<?=base_url()?>resource/avatar/<?php $user=$this->db->select('avatar')->where('user_id',$event->staffid)->get('user_info')->row(); echo $user->avatar==NULL ? 'default.png' : $user->avatar; ?>" alt="" class="img-circle" style="width:55px; height:55px;" > <?php } ?></td>
                                    <td style="width:333px;"> <img src="<?=base_url()?>resource/images/<?php if($event->job_accept_status=='awaiting') { echo 'status-blue.png'; } elseif($event->job_accept_status=='booked') { echo 'status-green.png'; } else { echo 'status-red.png'; } ?>" alt="" title="<?=$event->job_accept_status?>"> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="yes-no-select clearfix">
                <li class="no-select"> <a href="javascript:void(0)">close</a></li>
            </ul>
        </div>                  
    </div>
</div>