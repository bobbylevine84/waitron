<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('login');
		}
		if ($this->tank_auth->get_user_type() == 'Admin') {
			redirect('');
		}
		if ($this->tank_auth->get_user_type() == 'Staff') {
			redirect('staff');
		}
		$this->load->model('client_model');

	}

	function index()
	{
		$user_id=$this->tank_auth->get_user_id();
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Client - '.config_item('company_name'));
		$data['page'] = 'Jobs';
		$data['liveclock'] = TRUE;
		$data['rtjcount'] = $this->client_model->realTimeJobCount($user_id);
		$data['wstandby'] = $this->client_model->activeStaffCount();
		$data['ujcount'] = $this->client_model->upcomingJobCount($user_id);
		$data['ajobs'] = $this->client_model->getActiveJobs($user_id);
		$data['ujobs'] = $this->client_model->getUpcomingJobs($user_id);
		$this->template->set_layout('users')->build('jobs',isset($data) ? $data : NULL);
	}

	function status($jobid)
	{
		$data['events'] = $this->db->where('jobid',$jobid)->get('job_assign')->result();
		$this->load->view('modal/event-status',isset($data) ? $data : NULL);
	}

	function cancel($jobid,$confirm)
	{
		if($confirm=='yes')
		{
			$user_id=$this->tank_auth->get_user_id();
			$cancel_info=array(
				'cancel_status'=> 'yes',
				'cancelby' => $user_id,
				'canceldate' => date('Y-m-d H:i:s')
				);

			$job=$this->db->where('jobid',$jobid)->update('job', $cancel_info);
			$assignjob=$this->db->where('jobid',$jobid)->update('job_assign', $cancel_info);

			if($job && $assignjob)
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Job/Event Canceled Successfully");
				$url='client/jobs/';
				redirect($url);
			}
		}
		else
		{
			$data['jobid']=$jobid;
			$this->load->view('modal/cancel',isset($data) ? $data : NULL);
		}
	}


	/////////////////////// This Function Using For Add Services on Add Event Page ////////////////
	function addservice($service)
	{
		$data['getservice'] = $service;
		$data['servicetype']=$this->db->get('servicetype')->result();
		$this->load->view('modal/add-service',isset($data) ? $data : NULL);
	}

	/////////////////////// This Function Using For Add Service Captain on Add Event Page //////////
	function addcaptain($quantity,$id,$time)
	{
		$data['quantity'] = $quantity;
		$data['id'] = $id;
		$data['time'] = $time;
		$this->load->view('modal/add-captain',isset($data) ? $data : NULL);
	}

	/////////////////////// This Function Using For Adding a Event Captain on Add Event Page /////
	function addecaptain($quantity,$time)
	{
		$data['quantity'] = $quantity;
		$data['time'] = $time;
		$data['scount']=$this->db->get('servicetype')->num_rows();
		$this->load->view('modal/add-event-captain',isset($data) ? $data : NULL);
	}

	function jobAssign($jobid)
	{
		modules::run('jobs/assign/index',$jobid);
	}

	//////////////////////////////// Function For Add/Update/View a Job //////////////////////////
	function addjob()
	{
		if($this->input->post('addjob'))
		{
			if(date('Y-m-d',strtotime($this->input->post('date')))==date('Y-m-d'))
			{
				$to_time = strtotime($this->input->post('starttime'));
				$from_time = strtotime(date('H:i:s'));
				$minutes = round(abs($to_time - $from_time)/60 , 2);
				($minutes>=120) ? $rushjob='no' : $rushjob='yes';
			}
			else
			{
				$rushjob='no';
			}

			$job_info=array(
				'jobtype'=>'Job',
				'eventtype'=>$this->input->post('eventtype'),
				'projectname'=>$this->input->post('projectname'),
				'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
				'starttime'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
				'endtime'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
				'zipcode'=>$this->input->post('zipcode'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'contactperson'=>$this->input->post('contactperson'),
				'phonenumber'=>$this->input->post('phonenumber'),
				'note'=>$this->input->post('note'),
				'totalstaff'=> '1',
				'timediff'=>$this->input->post('timediff'),
				'hrate'=>$this->input->post('hrate'),
				'estimatedcost'=>$this->input->post('estimatedcost'),
				'rushjob'=>$rushjob,
				'createdby'=>$this->input->post('createdby'),
				'cdate'=>date('Y-m-d H:i:s'),
				'udate'=>NULL
				);

			if($this->db->insert('job',$job_info))
			{
				$jobid=$this->db->insert_id();

				$service_info=array(
					'jobid'=>$jobid,
					'servicetype'=>$this->input->post('servicetype'),
					'quantity'=>'1',
					'hourlyrate'=>$this->input->post('hrate'),
					'uniform'=>$this->input->post('uniform'),
					'secost'=>$this->input->post('estimatedcost')
					);
				$service=$this->db->insert('job_services',$service_info);
				
				$job_assign_info=array(
					'jobid'=>$jobid,
					'clientid'=>$this->input->post('createdby'),
					'servicetype'=>$this->input->post('servicetype'),
					'hourlyrate'=>$this->input->post('hrate'),
					'jobtime'=>$this->input->post('timediff'),
					'estimatedcost'=>$this->input->post('estimatedcost'),
					'captain'=>'no',
					'jobdate'=>date('Y-m-d',strtotime($this->input->post('date'))),
					'job_accept_status'=>'not assign',
					'job_start_time'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
					'job_end_time'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
					'rushjob'=>$rushjob,
					'created'=>date('Y-m-d H:i:s')
					);
				$assignjob=$this->db->insert('job_assign',$job_assign_info);

				/////////// For Job Assign ////////////////
				$this->jobAssign($jobid);
                 
				if($service && $assignjob)
				{ 
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "Job Added Successfully ");
					redirect('client/jobs');
				}   
			}     
		}
		else   
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Client Jobs - '.config_item('company_name'));
			$data['datepicker']=TRUE;
			$data['timepicker']=TRUE;
			$data['page'] = 'Jobs';
			$data['user_id']=$this->tank_auth->get_user_id();
			$hrate = $this->db->select('hourlyrate')->where('user_id',$this->tank_auth->get_user_id())->get('user_info')->row();
			$data['hourlyrate'] = $hrate->hourlyrate;
			$data['eventtype']=$this->db->get('eventtype')->result();
			$data['servicetype']=$this->db->get('servicetype')->result();
			$this->template->set_layout('users')->build('add-job',isset($data) ? $data : NULL);
		}
	}

	function updatejob()
	{
		if($this->input->post('updatejob'))
		{
			$jobid=$this->input->post('jobid');
			$serviceid=$this->input->post('serviceid');
			$job_info=array(
				'jobtype'=>'Job',
				'eventtype'=>$this->input->post('eventtype'),
				'projectname'=>$this->input->post('projectname'),
				'zipcode'=>$this->input->post('zipcode'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'contactperson'=>$this->input->post('contactperson'),
				'phonenumber'=>$this->input->post('phonenumber'),
				'note'=>$this->input->post('note'),
				'updatedby'=>$this->tank_auth->get_user_id(),
				'udate'=>date('Y-m-d H:i:s')
				);

			$service_info=array(
				'jobid'=>$jobid,
				'uniform'=>$this->input->post('uniform'),
				);

			$job=$this->db->where('jobid',$jobid)->update('job', $job_info);
			$service=$this->db->where('serviceid',$serviceid)->update('job_services', $service_info);


			if($job && $service)
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Job Update Successfully ");
				$url='client/jobs/updatejob/'.$jobid;
				redirect($url);
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Client Jobs - '.config_item('company_name'));
			$data['datepicker']=TRUE;
			$data['timepicker']=TRUE;
			$data['page'] = 'Jobs';
			$data['user_id']=$this->tank_auth->get_user_id();
			$data['eventtype']=$this->db->get('eventtype')->result();
			$data['servicetype']=$this->db->get('servicetype')->result();
			$data['getjob']=$this->client_model->getjob($this->uri->segment(4));
			$this->template->set_layout('users')->build('update-job',isset($data) ? $data : NULL);
		}
	}

	function viewjob($jobid)
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Client Jobs - '.config_item('company_name'));
		$data['page'] = 'Jobs';
		$data['eventtype']=$this->db->get('eventtype')->result();
		$data['servicetype']=$this->db->get('servicetype')->result();
		$data['getjob']=$this->client_model->getjob($jobid);
		$this->template->set_layout('users')->build('view-job',isset($data) ? $data : NULL);
	}

	//////////////////////////////// Function For Add/Update/View a Event ////////////////////////
	function addevent()
	{
		if($this->input->post('addevent'))
		{
			if(date('Y-m-d',strtotime($this->input->post('date')))==date('Y-m-d'))
			{
				$to_time = strtotime($this->input->post('starttime'));
				$from_time = strtotime(date('H:i:s'));
				$minutes = round(abs($to_time - $from_time)/60 , 2);
				($minutes>=120) ? $rushjob='no' : $rushjob='yes';
			}
			else
			{
				$rushjob='no';
			}

			$this->input->post('ecaptain')=='Yes' ? $ecaptain='yes' : $ecaptain='no';

			$event_info=array(
				'jobtype'=>'Event',
				'eventtype'=>$this->input->post('eventtype'),
				'projectname'=>$this->input->post('projectname'),
				'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
				'starttime'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
				'endtime'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
				'zipcode'=>$this->input->post('zipcode'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'contactperson'=>$this->input->post('contactperson'),
				'phonenumber'=>$this->input->post('phonenumber'),
				'note'=>$this->input->post('note'),
				'totalstaff'=> $this->input->post('quantity'),
				'timediff'=>$this->input->post('timediff'),
				'hrate'=>$this->input->post('hrate'),
				'estimatedcost'=>$this->input->post('estimatedcost'),
				'rushjob'=>$rushjob,
				'ecaptain'=>$ecaptain,
				'createdby'=>$this->input->post('createdby'),
				'cdate'=>date('Y-m-d H:i:s'),
				'udate'=>NULL
				);

			if($this->db->insert('job',$event_info))
			{
				$jobid=$this->db->insert_id();
				$services=$this->input->post('services');
				$servicetype=$this->db->get('servicetype')->result();
				$j=1;
				$k=1;
				foreach ($servicetype as $service) 
				{
					if(strval(array_search($service->servicetype,$services))!='')
					{
						$this->input->post('captain'.$j)=='Yes' ? $captain='yes' : $captain='no';
						$quantity=$this->input->post('quantity'.$j);

						$service_info=array(
							'jobid'=>$jobid,
							'servicetype'=>$service->servicetype,
							'quantity'=>$quantity,
							'hourlyrate'=>$this->input->post('hrate'),
							'uniform'=>$this->input->post('uniform'.$j),
							'secost'=>$this->input->post('estimatedcost'.$j),
							'scaptain'=>$captain
							);
						$this->db->insert('job_services',$service_info);

						$perusercost=$this->input->post('hrate')*$this->input->post('timediff');
						$captainhrate= $this->input->post('hrate')+10;
						$captaincost=$perusercost+($this->input->post('timediff')*10);

						for ($i=1; $i<=$quantity; $i++) 
						{ 
							if($captain=='yes' && $i==1)
							{
								$job_assign_info=array(
									'jobid'=>$jobid,
									'clientid'=>$this->input->post('createdby'),
									'servicetype'=>$service->servicetype,
									'hourlyrate'=>$captainhrate,
									'jobtime'=>$this->input->post('timediff'),
									'estimatedcost'=>$captaincost,
									'jobdate'=>date('Y-m-d',strtotime($this->input->post('date'))),
									'job_accept_status'=>'not assign',
									'captain'=>$captain,
									'captaintype'=>'service captain',
									'job_start_time'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
									'job_end_time'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
									'rushjob'=>$rushjob,
									'created'=>date('Y-m-d H:i:s')
									);
								$servicetype=$service->servicetype;
							}
							elseif($ecaptain=='yes' && $i==1 && $k==1 && $servicetype!=$service->servicetype)
							{
								$job_assign_info=array(
									'jobid'=>$jobid,
									'clientid'=>$this->input->post('createdby'),
									'servicetype'=>$service->servicetype,
									'hourlyrate'=>$captainhrate,
									'jobtime'=>$this->input->post('timediff'),
									'estimatedcost'=>$captaincost,
									'jobdate'=>date('Y-m-d',strtotime($this->input->post('date'))),
									'job_accept_status'=>'not assign',
									'captain'=>$ecaptain,
									'captaintype'=>'event captain',
									'job_start_time'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
									'job_end_time'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
									'rushjob'=>$rushjob,
									'created'=>date('Y-m-d H:i:s')
									);
								$k++;
							}
							else
							{
								$job_assign_info=array(
								'jobid'=>$jobid,
								'clientid'=>$this->input->post('createdby'),
								'servicetype'=>$service->servicetype,
								'hourlyrate'=>$this->input->post('hrate'),
								'jobtime'=>$this->input->post('timediff'),
								'estimatedcost'=>$perusercost,
								'jobdate'=>date('Y-m-d',strtotime($this->input->post('date'))),
								'job_accept_status'=>'not assign',
								'captain'=>'no',
								'job_start_time'=>date('H:i:s.u',strtotime($this->input->post('starttime'))),
								'job_end_time'=>date('H:i:s.u',strtotime($this->input->post('endtime'))),
								'rushjob'=>$rushjob,
								'created'=>date('Y-m-d H:i:s')
								);
							}
							$assignjob=$this->db->insert('job_assign',$job_assign_info);
						}
					}
					$j++;
				}

				/////////// For Job Assign ////////////////
				$this->jobAssign($jobid);

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Event Added Successfully ");
				redirect('client/jobs');
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Client Jobs - '.config_item('company_name'));
			$data['datepicker']=TRUE;
			$data['timepicker']=TRUE;
			$data['page'] = 'Jobs';
			$data['user_id']=$this->tank_auth->get_user_id();
			$data['eventtype']=$this->db->get('eventtype')->result();
			$data['servicetype']=$this->db->get('servicetype')->result();
			$data['scount']=$this->db->get('servicetype')->num_rows();
			$this->template->set_layout('users')->build('add-event',isset($data) ? $data : NULL);
		}
	}
	
	function updateevent($jobid)
	{
		if($this->input->post('updateevent'))
		{
			$event_info=array(
				'eventtype'=>$this->input->post('eventtype'),
				'projectname'=>$this->input->post('projectname'),
				'zipcode'=>$this->input->post('zipcode'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'address'=>$this->input->post('address'),
				'contactperson'=>$this->input->post('contactperson'),
				'phonenumber'=>$this->input->post('phonenumber'),
				'note'=>$this->input->post('note'),
				'updatedby'=>$this->tank_auth->get_user_id(),
				'udate'=>date('Y-m-d H:i:s')
				);

			$event=$this->db->where('jobid',$jobid)->update('job', $event_info);

			if($event)
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Event Update Successfully ");
				$url='client/jobs/updateevent/'.$jobid;
				redirect($url);
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Client Jobs - '.config_item('company_name'));
			$data['datepicker']=TRUE;
			$data['timepicker']=TRUE;
			$data['page'] = 'Jobs';
			$data['eventtype']=$this->db->get('eventtype')->result();
			$data['servicetype']=$this->db->get('servicetype')->result();
			$data['getevent']=$this->db->where('jobid',$this->uri->segment(4))->get('job')->result();
			$data['getservices']=$this->db->where('jobid',$this->uri->segment(4))->get('job_services')->result();
			$this->template->set_layout('users')->build('update-event',isset($data) ? $data : NULL);
		}
	}

	function viewevent($jobid)
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Client Jobs - '.config_item('company_name'));
		$data['datepicker']=TRUE;
		$data['timepicker']=TRUE;
		$data['page'] = 'Jobs';
		$data['eventtype']=$this->db->get('eventtype')->result();
		$data['servicetype']=$this->db->get('servicetype')->result();
		$data['getevent']=$this->db->where('jobid',$jobid)->get('job')->result();
		$data['getservices']=$this->db->where('jobid',$jobid)->get('job_services')->result();
		$this->template->set_layout('users')->build('update-event',isset($data) ? $data : NULL);
	}

	///////////////////// For Check Day wise Staff time Availability ////////////////////////////// 
	function checkAvailability($day,$time,$availability)
    {
        date_default_timezone_set("Asia/Kolkata");
        // default status
        $status = 'closed';
        // get current time object
        $newdate=new DateTime();
        $currentTime = $newdate->setTimestamp(strtotime($time));
        if($availability[$day]!='')
        {
            // loop through time ranges for current day
            foreach ($availability[$day] as $startTime => $endTime) {
                // create time objects from start/end times
                $startTime = DateTime::createFromFormat('h:i A', $startTime);
                $endTime   = DateTime::createFromFormat('h:i A', $endTime);
                // check if current time is within a range
                if (($startTime <= $currentTime) && ($currentTime < $endTime)) {
                    $status = 'open';
                    break;
                }
            }
        }
        return $status;
    }
}

/* End of file jobs.php */