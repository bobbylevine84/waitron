<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assign extends MX_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Jobs_model');
	}

		//////////////// For Get distance between Job Address & Staff Address //////////////////////// 
	function getdistance($origins,$destinations)
	{	
		$url='https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$origins.'&destinations='.$destinations;
		$this->load->library('curl');
		$this->curl->create($url);
		$data = $this->curl->execute();
		$data=(array)json_decode($data,true);

		if($data['rows'][0]['elements'][0]['status']=='NOT_FOUND')
		{
			return 0;
		}
		elseif($data['rows'][0]['elements'][0]['status']=='ZERO_RESULTS')
		{
			return 0;
		}
		elseif($data['rows'][0]['elements'][0]['status']=='OK')
		{
			return $data['rows'][0]['elements'][0]['duration']['value'];
		}	
	}

	//////////////////// For Job Assign to Staff Related Function ////////////////////////////////
	function index($jobid)
	{
		$not_assign_count=$this->db->where('jobid',$jobid)->where('job_accept_status','not assign')->get('job_assign')->num_rows();
		if($not_assign_count>=1)
		{
			$not_assign_list=$this->db->where('jobid',$jobid)->where('job_accept_status','not assign')->get('job_assign')->result();
			//print_r($not_assign_list);
			foreach ($not_assign_list as $not_assign) 
			{
				/////For Ge Job Information /////////////////////////////
				$jobinfo=$this->db->where('jobid',$jobid)->get('job')->row_object();

				if($jobinfo->jobtype=='Event')
				{
					/////////////// If Job Require a Event/Service Caption ///////
					if($not_assign->captain=='yes')
					{
						/////////////// Get User Infomation //////////////////////
						$getusers=$this->db->select('users.id,skills')->join('user_info','user_info.user_id = users.id')->where('users.activated','1')->where('users.user_type','Staff')->where('users.standby','1')->where('users.banned','0')->where('users.captain','Yes')->where('users.crequest','Yes')->like('user_info.skills',$not_assign->servicetype)->get('users')->result();

						foreach ($getusers as $users) 
						{
							$getuserinfo=$this->db->where('user_id',$users->id)->get('user_info')->row();
							$jobaddress=$jobinfo->address.'+'.$jobinfo->city.'+'.$jobinfo->state.','.$jobinfo->zipcode;
							$useraddress=$getuserinfo->address.'+'.$getuserinfo->city.'+'.$getuserinfo->state.','.$getuserinfo->zipcode;
							$distance=$this->getdistance($jobaddress,$useraddress);

							if($distance<='3600' && $distance!='')
							{
								////////////////// Get User Schedule Information ///////////////////////
								$sschedule=$this->db->where('staffid',$users->id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->row();
								$availability=(array)json_decode($sschedule->availability,true);
								$day=date('D',strtotime($jobinfo->date));
								$starttime=strtotime($jobinfo->starttime);
								$endtime=strtotime($jobinfo->endtime);


								///////////////// Check User Already booked or not for this time slots //////////////////////
								$where="job_start_time <='".$jobinfo->starttime."' AND job_end_time <='".$jobinfo->endtime."' AND (job_accept_status='booked' OR job_accept_status='awaiting' OR job_accept_status='new waitron' OR job_accept_status='canceled')";
								$count=$this->db->where('jobdate',$jobinfo->date)->where('staffid',$users->id)->where($where)->get('job_assign')->num_rows();

								if($count==0)
								{
									if($availability[$day]!='')
									{
										//// Check User Available for specific with time slots ////
										$availability=$availability[$day];
										foreach ($availability as $key => $value) 
										{
											$time1 = strtotime($key);
											$time2 = strtotime($value);
											if ($starttime >= $time1 && $time2 >= $endtime)
											{
											   $assign_info=array(
													'staffid'=>$users->id,
													'assign_date'=>date('Y-m-d H:i:s'),
													'job_accept_status'=>'awaiting',
													'captain_assign_date'=>date('Y-m-d H:i:s'),
													'captain_accept_status'=>'awaiting'
													);
												$assign=$this->db->where('id',$job->id)->update('job_assign', $assign_info);
												if($assign)
												{
													$user_email=$this->db->select('email')->where('id',$users->id)->get('users')->row();
													$attire=$this->db->select('uniform')->where('jobid',$not_assign->jobid)->where('servicetype',$not_assign->servicetype)->get('job_services')->row();
													$edata=array(
														"accept_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/Yes',
														"decline_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/No',
														"name"=>$getuserinfo->firstname,
														"date"=>$jobinfo->date,
														"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
														"hourlyrate"=>$jobinfo->hrate,
														"location"=>$jobinfo->zipcode,
														"eventtype"=>$jobinfo->eventtype,
														"attire"=>$attire->uniform,
														'email'=> $user_email->email
														);
													$this->captainMatechedForJob($edata);
												}
											}
										}
									}
								}
							}
						}
					}
					else
					{
						/////////////// Get User Infomation //////////////////////
						$getusers=$this->db->select('users.id,skills')->join('user_info','user_info.user_id = users.id')->where('users.activated','1')->where('users.user_type','Staff')->where('users.banned','0')->where('users.standby','1')->like('user_info.skills',$not_assign->servicetype)->get('users')->result();
						//print_r($getusers);
						
						foreach ($getusers as $users) 
						{
							$getuserinfo=$this->db->where('user_id',$users->id)->get('user_info')->row();
							$jobaddress=$jobinfo->address.'+'.$jobinfo->city.'+'.$jobinfo->state.','.$jobinfo->zipcode;
							$useraddress=$getuserinfo->address.'+'.$getuserinfo->city.'+'.$getuserinfo->state.','.$getuserinfo->zipcode;
							$distance=$this->getdistance($jobaddress,$useraddress);
							
							if($distance<='3600' && $distance!='')
							{
								////////////////// Get User Schedule Information ///////////////////////
								$sschedule=$this->db->where('staffid',$users->id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->row();
								$availability=(array)json_decode($sschedule->availability,true);
								$day=date('D',strtotime($jobinfo->date));
								$starttime=strtotime($jobinfo->starttime);
								$endtime=strtotime($jobinfo->endtime);

								///////////////// Check User Already booked or not for this time slots //////////////////////
								$where="job_start_time <='".$jobinfo->starttime."' AND job_end_time <='".$jobinfo->endtime."' AND (job_accept_status='booked' OR job_accept_status='awaiting' OR job_accept_status='new waitron' OR job_accept_status='canceled')";
								$count=$this->db->where('jobdate',$jobinfo->date)->where('staffid',$users->id)->where($where)->get('job_assign')->num_rows();
								

								if($count==0)
								{
									if($availability[$day]!='')
									{
										///////////////// Check User Available for specific with time slots ///////////////////
										$availability=$availability[$day];
										foreach ($availability as $key => $value) 
										{
											$time1 = strtotime($key);
											$time2 = strtotime($value);
											if ($starttime >= $time1 && $time2 >= $endtime)
											{
											   $assign_info=array(
													'staffid'=>$users->id,
													'assign_date'=>date('Y-m-d H:i:s'),
													'job_accept_status'=>'awaiting'
													);
												$assign=$this->db->where('id',$job->id)->update('job_assign', $assign_info);
												if($assign)
												{
													$user_email=$this->db->select('email')->where('id',$users->id)->get('users')->row();
													$attire=$this->db->select('uniform')->where('jobid',$not_assign->jobid)->where('servicetype',$not_assign->servicetype)->get('job_services')->row();
													$edata=array(
														"accept_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/Yes',
														"decline_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/No',
														"name"=>$getuserinfo->firstname,
														"date"=>$jobinfo->date,
														"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
														"hourlyrate"=>$jobinfo->hrate,
														"location"=>$jobinfo->zipcode,
														"eventtype"=>$jobinfo->eventtype,
														"attire"=>$attire->uniform,
														'email'=> $user_email->email
														);
													if($not_assign->rushjob=='yes')
													{
														$this->staffMatchedForRushJob($edata);
													}
													else
													{
														$this->staffMatchedForJob($edata);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				else
				{
					/////////////// Get User Infomation //////////////////////
					$getusers=$this->db->select('users.id,user_info.skills')->join('user_info','user_info.user_id = users.id')->where('users.activated','1')->where('users.user_type','Staff')->where('users.banned','0')->where('users.standby','1')->like('user_info.skills',$not_assign->servicetype)->get('users')->result();

					foreach ($getusers as $users) 
					{
						//print_r($users);
						$getuserinfo=$this->db->where('user_id',$users->id)->get('user_info')->row();
						$jobaddress=str_replace(" ","+",$jobinfo->address).'+'.str_replace(" ","+",$jobinfo->city).'+'.str_replace(" ","+",$jobinfo->state).','.$jobinfo->zipcode;
						$useraddress=str_replace(" ","+",$getuserinfo->address).'+'.str_replace(" ","+",$getuserinfo->city).'+'.str_replace(" ","+",$getuserinfo->state).','.$getuserinfo->zipcode;
						$distance=$this->getdistance($jobaddress,$useraddress)."<br>";

						if($distance<='3600' && $distance!='')
						{
							////////////////// Get User Schedule Information ///////////////////////
							$sschedule=$this->db->where('staffid',$users->id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->row();
							$availability=(array)json_decode($sschedule->availability,true);
							$day=date('D',strtotime($jobinfo->date));
							$starttime=strtotime($jobinfo->starttime);
							$endtime=strtotime($jobinfo->endtime);
							//print_r($availability[$day]);

							///////////////// Check User Already booked or not for this time slots //////////////////////
							$where="job_start_time <='".$jobinfo->starttime."' AND job_end_time <='".$jobinfo->endtime."' AND (job_accept_status='booked' OR job_accept_status='awaiting' OR job_accept_status='new waitron' OR job_accept_status='canceled')";
							echo $count=$this->db->where('jobdate',$jobinfo->date)->where('staffid',$users->id)->where($where)->get('job_assign')->num_rows();

							if($count==0)
							{
								if($availability[$day]!='')
								{
									///////////////// Check User Available for specific with time slots ///////////////////
									$availability=$availability[$day];
									foreach ($availability as $key => $value) 
									{
										$time1 = strtotime($key);
										$time2 = strtotime($value);
										if ($starttime >= $time1 && $time2 >= $endtime)
										{
											$assign_info=array(
												'staffid'=>$users->id,
												'assign_date'=>date('Y-m-d H:i:s'),
												'job_accept_status'=>'awaiting'
												);
											$assign=$this->db->where('id',$not_assign->id)->update('job_assign', $assign_info);
											if($assign)
											{
												$user_email=$this->db->select('email')->where('id',$users->id)->get('users')->row();
												$attire=$this->db->select('uniform')->where('jobid',$not_assign->jobid)->where('servicetype',$not_assign->servicetype)->get('job_services')->row();
												$edata=array(
													"accept_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/Yes',
													"decline_url"=>base_url().'jobs/assign/accept/'.$not_assign->id.'/'.$users->id.'/No',
													"name"=>$getuserinfo->firstname,
													"date"=>$jobinfo->date,
													"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
													"hourlyrate"=>$jobinfo->hrate,
													"location"=>$jobinfo->zipcode,
													"eventtype"=>$jobinfo->eventtype,
													"attire"=>$attire->uniform,
													'email'=> $user_email->email
													);
												if($not_assign->rushjob=='yes')
												{
													$this->staffMatchedForRushJob($edata);
												}
												else
												{
													$this->staffMatchedForJob($edata);
												}
											}
										}
									}
								}
							}
						}
						
					}
				}
			}
		}
	}

	function accept($assignid,$staffid,$confirm)
	{
		$job=$this->db->where('id',$assignid)->where('staffid',$staffid)->get('job_assign')->row();
		if($job->job_missed=='no' || $job->job_missed=='')
		{
			if($confirm=='Yes')
			{
				$accept_info=array(
				'job_accept_status'=>'booked',
				'accept_date'=>date('Y-m-d H:i:s'),
				'job_missed'=>'no'
				);
				$accept=$this->db->where('id',$job->id)->update('job_assign', $accept_info);
				if($accept)
				{
					////////////////Send Confirmation Mail///////////////////////
					$this->confirmMail($assignid,$staffid);

					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Job Request Response - '.config_item('company_name'));
					$data['autoRedirect'] = TRUE;
					$data['confirm']='Booked';
					$this->template->set_layout('default')->build('accept-screen',isset($data) ? $data : NULL);
				}
			}
			else
			{
				$accept_info=array(
				'job_accept_status'=>'canceled',
				'accept_date'=>date('Y-m-d H:i:s'),
				'job_missed'=>'yes'
				);
				$accept=$this->db->where('id',$job->id)->update('job_assign', $accept_info);
				if($accept)
				{
					$cajob_info=array(
						'jobid'=>$job->jobid,
						'clientid'=>$job->clientid,
						'servicetype'=>$job->servicetype,
						'hourlyrate'=>$job->hourlyrate,
						'jobtime'=>$job->jobtime,
						'estimatedcost'=>$job->estimatedcost,
						'jobdate'=>$job->jobdate,
						'job_accept_status'=>'not assign',
						'captain'=>$job->captain,
						'captaintype'=>$job->captaintype,
						'job_start_time'=>$job->job_start_time,
						'job_end_time'=>$job->job_end_time,
						'rushjob'=>$job->rushjob,
						'created'=>date('Y-m-d H:i:s')
						);
					$cajob=$this->db->insert('job_assign',$cajob_info);
					if($cajob)
					{
						$this->index($job->jobid);

						$this->load->module('layouts');
						$this->load->library('template');
						$this->template->title('Job Request Response - '.config_item('company_name'));
						$data['autoRedirect'] = TRUE;
						$data['confirm']='Canceled';
						$this->template->set_layout('default')->build('accept-screen',isset($data) ? $data : NULL);
					}
				}
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Job Request Response - '.config_item('company_name'));
			$data['autoRedirect'] = TRUE;
			$data['confirm']='Job Missed';
			$this->template->set_layout('default')->build('accept-screen',isset($data) ? $data : NULL);
		}
	}

	function confirmMail($assignid,$staffid)
	{
		$job=$this->db->where('id',$assignid)->where('staffid',$staffid)->get('job_assign')->row();
		$jobinfo=$this->db->where('jobid',$job->jobid)->get('job')->row();
		$user=$this->db->select('email')->where('id',$staffid)->get('users')->row();
		$userinfo=$this->db->where('id',$staffid)->get('user_info')->row();
		$attire=$this->db->select('uniform')->where('jobid',$job->jobid)->where('servicetype',$job->servicetype)->get('job_services')->row();
		$edata=array(
			"confirm_url"=>base_url().'jobs/assign/confirm/'.$job->id.'/'.$staffid.'/Yes',
			"decline_url"=>base_url().'jobs/assign/confirm/'.$job->id.'/'.$staffid.'/No',
			"name"=>$userinfo->firstname,
			"date"=>$jobinfo->date,
			"time"=>date('h:i A',strtotime($jobinfo->starttime))." to ".date('h:i A',strtotime($jobinfo->endtime)),
			"hourlyrate"=>$jobinfo->hrate,
			"location"=>$jobinfo->zipcode,
			"eventtype"=>$jobinfo->eventtype,
			"attire"=>$attire->uniform,
			'email'=> $user->email,
			'captain'=> $job->captain,
			'contactperson'=> $jobinfo->contactperson,
			'contactnumber'=> $jobinfo->phonenumber
			);
		if($job->captain=="yes")
		{
			$this->captainJobDetail($edata);
		}
		else
		{
			if($job->rushjob=="yes")
			{
				$this->staffRushJobDetail($edata);
			}
			else
			{
				$this->staffJobDetails($edata);
			}
		}
	}

	function confirm($assignid,$staffid,$confirm)
	{
		$job=$this->db->where('id',$assignid)->where('staffid',$staffid)->get('job_assign')->row();
		if($job->job_missed=='no' || $job->job_missed=='')
		{
			if($confirm=='Yes')
			{
				$accept_info=array(
				'confirm_status'=>'yes',
				'confirm_date'=>date('Y-m-d H:i:s')
				);
				$accept=$this->db->where('id',$job->id)->update('job_assign', $accept_info);
				if($accept)
				{
					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Job Request Response - '.config_item('company_name'));
					$data['autoRedirect'] = TRUE;
					$data['confirm']='Booked';
					$this->template->set_layout('default')->build('confirm-screen',isset($data) ? $data : NULL);
				}
			}
			else
			{
				$accept_info=array(
				'confirm_status'=>'no',
				'confirm_date'=>date('Y-m-d H:i:s')
				);
				$accept=$this->db->where('id',$job->id)->update('job_assign', $accept_info);
				if($accept)
				{
					$cajob_info=array(
						'jobid'=>$job->jobid,
						'clientid'=>$job->clientid,
						'servicetype'=>$job->servicetype,
						'hourlyrate'=>$job->hourlyrate,
						'jobtime'=>$job->jobtime,
						'estimatedcost'=>$job->estimatedcost,
						'jobdate'=>$job->jobdate,
						'job_accept_status'=>'not assign',
						'captain'=>$job->captain,
						'captaintype'=>$job->captaintype,
						'job_start_time'=>$job->job_start_time,
						'job_end_time'=>$job->job_end_time,
						'rushjob'=>$job->rushjob,
						'created'=>date('Y-m-d H:i:s')
						);
					//print_r($cajob_info);
					$cajob=$this->db->insert('job_assign',$cajob_info);
					if($cajob)
					{
						$this->index($job->jobid);

						$this->load->module('layouts');
						$this->load->library('template');
						$this->template->title('Job Request Response - '.config_item('company_name'));
						$data['autoRedirect'] = TRUE;
						$data['confirm']='Canceled';
						$this->template->set_layout('default')->build('confirm-screen',isset($data) ? $data : NULL);
					}
				}
			}

			
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Job Request Response - '.config_item('company_name'));
			$data['autoRedirect'] = TRUE;
			$data['confirm']='Job Missed';
			$this->template->set_layout('default')->build('accept-screen',isset($data) ? $data : NULL);
		}
	}

	
	///////////////////// Job Assign Emails /////////////////// 
	function staffMatchedForJob($data)
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForJob'), 'subject');

		$name = str_replace("{NAME}",$data['name'],$message);
		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$name);
		$date = str_replace("{DATE}",$data['date'],$eventtype);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{ACCEPT_URL}",$data['accept_url'],$attire);
		$message = str_replace("{DECLINE_URL}",$data['decline_url'],$accept_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function staffJobDetails($data)
	{

		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffJobDetails'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffJobDetails'), 'subject');

		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$message);
		$captain = str_replace("{CAPTAIN}",$data['captain'],$eventtype);
		$contactperson = str_replace("{CONTACTPERSON}",$data['contactperson'],$captain);
		$contactnumber = str_replace("{CONTACTNUMBER}",$data['contactnumber'],$contactperson);
		$name = str_replace("{NAME}",$data['name'],$contactnumber);
		$date = str_replace("{DATE}",$data['date'],$name);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{CONFIRM_URL}",$data['confirm_url'],$attire);
		$decline_url = str_replace("{URL}",$data['decline_url'],$accept_url);
		$message = str_replace("{SITE_NAME}",config_item('company_name'),$decline_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function staffMatchedForRushJob($data)
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForRushJob'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffMatchedForRushJob'), 'subject');

		$name = str_replace("{NAME}",$data['name'],$message);
		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$name);
		$date = str_replace("{DATE}",$data['date'],$eventtype);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{ACCEPT_URL}",$data['accept_url'],$attire);
		$message = str_replace("{DECLINE_URL}",$data['decline_url'],$accept_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function staffRushJobDetail($data)
	{

		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffRushJobDetail'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'staffRushJobDetail'), 'subject');

		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$message);
		$captain = str_replace("{CAPTAIN}",$data['captain'],$eventtype);
		$contactperson = str_replace("{CONTACTPERSON}",$data['contactperson'],$captain);
		$contactnumber = str_replace("{CONTACTNUMBER}",$data['contactnumber'],$contactperson);
		$name = str_replace("{NAME}",$data['name'],$contactnumber);
		$date = str_replace("{DATE}",$data['date'],$name);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{CONFIRM_URL}",$data['confirm_url'],$attire);
		$decline_url = str_replace("{URL}",$data['decline_url'],$accept_url);
		$message = str_replace("{SITE_NAME}",config_item('company_name'),$decline_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function captainMatechedForJob($email,$data)
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'captainMatechedForJob'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'captainMatechedForJob'), 'subject');

		$name = str_replace("{NAME}",$data['name'],$message);
		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$name);
		$date = str_replace("{DATE}",$data['date'],$eventtype);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{ACCEPT_URL}",$data['accept_url'],$attire);
		$message = str_replace("{DECLINE_URL}",$data['decline_url'],$accept_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function captainJobDetail($data)
	{

		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'captainMatechedForJob'), 'template_body');
		$subject = $this->applib->get_any_field('email_templates',array('email_group' => 'captainMatechedForJob'), 'subject');

		$eventtype = str_replace("{EVENTTYPE}",$data['eventtype'],$message);
		$captain = str_replace("{CAPTAIN}",$data['captain'],$eventtype);
		$contactperson = str_replace("{CONTACTPERSON}",$data['contactperson'],$captain);
		$contactnumber = str_replace("{CONTACTNUMBER}",$data['contactnumber'],$contactperson);
		$name = str_replace("{NAME}",$data['name'],$contactnumber);
		$date = str_replace("{DATE}",$data['date'],$name);
		$time =  str_replace("{TIME}",$data['time'],$date);
		$hrate =  str_replace("{HRATE}",$data['hourlyrate'],$time);
		$location =  str_replace("{LOCATION}",$data['location'],$hrate);
		$attire =  str_replace("{ATTIRE}",$data['attire'],$location);
		$accept_url = str_replace("{CONFIRM_URL}",$data['confirm_url'],$attire);
		$decline_url = str_replace("{URL}",$data['decline_url'],$accept_url);
		$message = str_replace("{SITE_NAME}",config_item('company_name'),$decline_url);
		
		$params['recipient'] = $data['email'];
		$params['subject'] = $subject;
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

}

/* End of file fomailer.php */