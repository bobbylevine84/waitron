<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('cron_model');

	}

	function index()
	{
		redirect(base_url());
	}

	function mail()
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'subject');
		
		$eventtype = str_replace("{EVENTTYPE}",'Corporate Event',$message);
		$name = str_replace("{NAME}",'Daniel',$eventtype);
		$date = str_replace("{DATE}",'25/02/16',$name);
		$time =  str_replace("{TIME}",'7:00pm to 11:00pm',$date);
		$hrate =  str_replace("{HRATE}",'35',$time);
		$location =  str_replace("{LOCATION}",'45722',$hrate);
		$attire =  str_replace("{ATTIRE}",'All Black',$location);
		$accept_url = str_replace("{ACCEPT_URL}",'my.waitron.loc/settings/etemplates',$attire);
		$decline_url = str_replace("{DECLINE_URL}",'my.waitron.loc/settings/etemplates',$accept_url);
		$message = str_replace("{EVENTNAME}",'Corporate Event',$decline_url);
				
		$params['recipient'] = 'testko@mailinator.com';
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function jobAssign($jobid)
	{
		modules::run('jobs/assign/index',$jobid);
	}

	///////////////// Job Re-Assign Functionality //////////////
	function jobReassign()
	{
		//$this->mail();
		$awaiting_list=$this->db->where('job_accept_status','awaiting')->get('job_assign')->result();
		foreach ($awaiting_list as $awaiting) 
		{
			if($awaiting->rushjob=='yes')
			{
				$currentTime=strtotime(date('Y-m-d H:i:s'));
				$jobassigTime=strtotime($awaiting->assign_date);
				$minutes = round(abs($jobassigTime - $currentTime)/60 , 2);
				if($minutes>=10)
				{
					$cajob_info=array(
						'jobid'=>$awaiting->jobid,
						'clientid'=>$awaiting->clientid,
						'servicetype'=>$awaiting->servicetype,
						'hourlyrate'=>$awaiting->hourlyrate,
						'jobtime'=>$awaiting->jobtime,
						'estimatedcost'=>$awaiting->estimatedcost,
						'jobdate'=>$awaiting->jobdate,
						'job_accept_status'=>'not assign',
						'captain'=>$awaiting->captain,
						'captaintype'=>$awaiting->captaintype,
						'job_start_time'=>$awaiting->job_start_time,
						'job_end_time'=>$awaiting->job_end_time,
						'rushjob'=>$awaiting->rushjob,
						'created'=>date('Y-m-d H:i:s')
						);
					$cajob=$this->db->insert('job_assign',$cajob_info);

					$uajob_info=array(
						'job_accept_status'=>'new waitron',
						'job_missed'=>'yes'
						);
					$uajob=$this->db->where('id',$awaiting->id)->update('job_assign', $uajob_info);

					$assigninfo=$this->db->select('jobid,staffid')->where('id',$awaiting->id)->get('job_assign')->row();
					$jobinfo=$this->db->where('jobid',$assigninfo->jobid)->get('job')->row();
					$user=$this->db->select('email')->where('id',$assigninfo->staffid)->get('users')->row();
					$userinfo=$this->db->where('id',$assigninfo->staffid)->get('user_info')->row();
					$edata=array(
						"name"=>$userinfo->firstname,
						"date"=>$jobinfo->date,
						"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
						"eventtype"=>$jobinfo->eventtype,
						'email'=> $user->email
						);
					$this->jobMissed($edata);

					if($cajob && $uajob)
					{
						$this->jobAssign($awaiting->jobid);
					}
				}
			}
			else
			{
				$currentTime=strtotime(date('Y-m-d H:i:s'));
				$jobassigTime=strtotime($awaiting->assign_date);
				$minutes = round(abs($jobassigTime - $currentTime)/60 , 2);
				if($minutes>=30)
				{
					$cajob_info=array(
						'jobid'=>$awaiting->jobid,
						'clientid'=>$awaiting->clientid,
						'servicetype'=>$awaiting->servicetype,
						'hourlyrate'=>$awaiting->hourlyrate,
						'jobtime'=>$awaiting->jobtime,
						'estimatedcost'=>$awaiting->estimatedcost,
						'jobdate'=>$awaiting->jobdate,
						'job_accept_status'=>'not assign',
						'captain'=>$awaiting->captain,
						'captaintype'=>$awaiting->captaintype,
						'job_start_time'=>$awaiting->job_start_time,
						'job_end_time'=>$awaiting->job_end_time,
						'rushjob'=>$awaiting->rushjob,
						'created'=>date('Y-m-d H:i:s')
						);

					$cajob=$this->db->insert('job_assign',$cajob_info);

					$uajob_info=array(
						'job_accept_status'=>'new waitron',
						'job_missed'=>'yes'
						);
					$uajob=$this->db->where('id',$awaiting->id)->update('job_assign', $uajob_info);

					$assigninfo=$this->db->select('jobid,staffid')->where('id',$awaiting->id)->get('job_assign')->row();
					$jobinfo=$this->db->where('jobid',$assigninfo->jobid)->get('job')->row();
					$user=$this->db->select('email')->where('id',$assigninfo->staffid)->get('users')->row();
					$userinfo=$this->db->where('id',$assigninfo->staffid)->get('user_info')->row();
					$edata=array(
						"name"=>$userinfo->firstname,
						"date"=>$jobinfo->date,
						"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
						"eventtype"=>$jobinfo->eventtype,
						'email'=> $user->email
						);
					$this->jobMissed($edata);
					if($cajob && $uajob)
					{
						$this->jobAssign($awaiting->jobid);
					}
				}
			}
		}
	}

	///////////////// Job Missed Mail //////////////////////////
	function jobMissed($data)
	{

		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'jobMissed'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'jobMissed'), 'subject');

		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$message);
		$name = str_replace("{NAME}",$data['name'],$eventtype);
		$date = str_replace("{DATE}",$data['date'],$name);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$message = str_replace("{SITE_NAME}",config_item('company_name'),$time);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	///////////////// Update Staff Default Schedule in Current Schedule Table /////////////////////////
	function updateDefaultSchedule()
	{
		$schedules=$this->db->get('default_schedule')->result();
		foreach ($schedules as $schedule) 
		{
			$staff_schedule=array(
				'staffid'=>$schedule->staffid,
				'availability'=>$schedule->availability,
				'block'=>$schedule->block,
				'blocktime'=>$schedule->blocktime,
				'cdate'=>date('Y-m-d H:i:s'),
				);
			$this->db->insert('staff_schedule',$staff_schedule);
		}
	}

	function jobStatus()
	{
		$jobinfo = $this->cron_model->jobList();
		foreach ($jobinfo as $job) {
			$startTime=strtotime($job->starttime);
			$endTime=strtotime($job->endtime);
			$currentTime=strtotime(date('H:i:s.u'));

			if($startTime<=$currentTime && $endTime>=$currentTime)
			{
				$this->db->where('jobid',$job->jobid)->update('job', array("jobstatus"=>"running"));
				$this->db->where('jobid',$job->jobid)->where('job_accept_status','booked')->where('confirm_status','yes')->update('job_assign', array("jobstatus"=>"running","job_in_time"=>$job->starttime));
			}
			elseif($currentTime==$endTime || $currentTime>$endTime)
			{
				$this->db->where('jobid',$job->jobid)->update('job', array("jobstatus"=>"complete"));
				$this->db->where('jobid',$job->jobid)->where('job_accept_status','booked')->where('confirm_status','yes')->update('job_assign', array("jobstatus"=>"running","job_out_time"=>$job->endtime));
			}
		}
	}

	function jobCompleteEmailStaff()
	{
		$jobinfo = $this->db->where('jobdate',date('Y-m-d'))->where('job_accept_status','booked')->where('confirm_status','yes')->where('jobstatus','complete')->where('smailsend','no')->get('job_assign')->result();
		foreach ($jobinfo as $job) 
		{
			$staff = $this->db->select('firstname')->where('user_id',$job->staffid)->get('user_info')->row();
			$semail = $this->db->select('email')->where('id',$job->staffid)->get('users')->row();


			$message = $this->applib->get_any_field('email_templates',array('email_group' => 'jobPaymentInformationStaff'), 'template_body');
			$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'jobPaymentInformationStaff'), 'subject');
			
			$name = str_replace("{NAME}",$staff->firstname,$message);
			$clockin = str_replace("{CLOCKIN}",$job->job_start_time,$name);
			$clockout =  str_replace("{CLOCKOUT}",$job->job_end_time,$clockin);
			$message = str_replace("{TOTAL}",$job->estimatedcost,$clockout);
					
			$params['recipient'] = $semail->email;
			$params['subject'] = $subject;
			$params['message'] = $message;		

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);

			$this->db->where('id',$job->id)->update('job_assign', array("smailsend"=>"yes"));
		}
	}

	/*function jobCompleteEmailClient()
	{ 
		$jobinfo = $this->db->where('jobdate',date('Y-m-d'))->where('jobstatus','complete')->get('job')->result();
		foreach ($jobinfo as $job) 
		{
			$client = $this->db->select('firstname')->where('user_id',$job->staffid)->get('user_info')->row();
			$cemail = $this->db->select('email')->where('id',$job->staffid)->get('users')->row();
			$services 
			?>
				<tr>
			    	<td style="padding:30px 30px 0 30px" align="center"><p style="font-size:20px; color:#2bbde4; font-family:Helvetica, 'Open Sans', Arial; margin-top:0; font-weight:bold; margin-bottom:0"><span style="color:#ff7265; font-weight:normal">bartenders:</span> 2</p>
			      	<p style="font-size:20px; color:#2bbde4; font-family:Helvetica, 'Open Sans', Arial; margin-top:0; font-weight:bold; margin-bottom:0"><span style="color:#ff7265; font-weight:normal">total:</span> $210</p></td>
			  	</tr>
			<?php

			$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'template_body');
			$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'subject');
			
			$name = str_replace("{NAME}",$client->firstname,$message);
			$jobid = str_replace("{JOBID}",$job->jobid,$name);
			$date = str_replace("{DATE}",date('F j, Y',strtotime($job->date)),$jobid);
			$starttime =  str_replace("{STARTTIME}",date('g:ia',strtotime($job->starttime)),$date);
			$endtime =  str_replace("{ENDTIME}",date('g:ia',strtotime($job->endtime)),$starttime);
			$hrate =  str_replace("{HRATE}",'35',$time);
			$location =  str_replace("{LOCATION}",'45722',$hrate);
			$attire =  str_replace("{ATTIRE}",'All Black',$location);
			$accept_url = str_replace("{ACCEPT_URL}",'my.waitron.loc/settings/etemplates',$attire);
			$decline_url = str_replace("{DECLINE_URL}",'my.waitron.loc/settings/etemplates',$accept_url);
			$message = str_replace("{EVENTNAME}",'Corporate Event',$decline_url);
					
			$params['recipient'] = $cemail->email;
			$params['subject'] = $subject;
			$params['message'] = $message;		

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
		} 
	} */



}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */