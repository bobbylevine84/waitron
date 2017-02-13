<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('login');
		}
		if ($this->tank_auth->get_user_type() == 'Admin') {
			redirect();
		}
		if ($this->tank_auth->get_user_type() == 'Client') {
			redirect('client');
		}
		$this->load->library(array('tank_auth','form_validation','pagination'));
		$this->load->model('staff_model');
	}

	function index()
	{
		$count=$this->db->where('staffid',$this->tank_auth->get_user_id())->order_by('cdate','DESC')->get('staff_schedule')->num_rows();
		if($count==0) 
		{
			$this->db->insert('staff_schedule',array('staffid'=>$this->tank_auth->get_user_id(),'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
			$this->db->insert('default_schedule',array('staffid'=>$this->tank_auth->get_user_id(),'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
			redirect('staff');
		} 
		else 
		{
			if($this->input->post('save'))
			{
				$days=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
	          	foreach ($days as $day) 
	          	{
	          		if($this->input->post($day)=='Available')
	          		{
	          			$block[$day]=array($this->input->post('mtime1') => $this->input->post('mtime2'),$this->input->post('etime1')=>$this->input->post('etime2'));
	          		}
	          		else
	          		{
	          			$block[$day]=$this->input->post($day);
	          		}
	          	}
	          	$block=json_encode($block);
	          	$blocktime="[['".$this->input->post('mtime1')."','".$this->input->post('mtime2')."'],['".$this->input->post('etime1')."','".$this->input->post('etime2')."']]";
	          	$schedule_info=array(
	          		'staffid'=>$this->tank_auth->get_user_id(),
	          		'block'=> $block,
	          		'blocktime'=> $blocktime,
	          		'udate'=> date('Y-m-d H:i:s')
	          		);

	          	$this->db->where('scheduleid',$this->input->post('scheduleid'))->update('staff_schedule', $schedule_info);
	          	$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Staff Schedule Update Successfully");
				redirect('staff');
			}
			else
			{
				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title('Staff - '.config_item('company_name'));
				$data['page'] = 'Home';
				$data['liveclock'] = TRUE;
				$data['slider']=TRUE;
				$data['timepicker']=TRUE;
				$data['user_id']=$user_id=$this->tank_auth->get_user_id();
				$data['staffSchedule']=$this->db->where('staffid',$user_id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->result();
				$data['staff_info']=$this->staff_model->staff_info($this->tank_auth->get_user_id());
				$this->template->set_layout('users')->build('staff',isset($data) ? $data : NULL);
			}
		}
	}

	function savedaydata()
	{
		$day=$this->input->post('day');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$user_id=$this->tank_auth->get_user_id();
		$staffSchedule=$this->db->where('staffid',$user_id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->result();
		$staffSchedule=(array)$staffSchedule[0];
		$availability=json_decode($staffSchedule['availability'],TRUE);
		$availability=(array)$availability;

		$start=explode(",", $start);
		$end=explode(",", $end);
		$time = array_combine($start, $end);
		$utime=array($day=>$time);
		$newavailable=array_replace($availability,$utime);
		$newavailable=json_encode($newavailable);
		$schedule_info=array('availability'=>$newavailable,'udate'=>date('Y-m-d H:i:s'));
		$this->db->where('scheduleid',$this->input->post('scheduleid'))->update('staff_schedule', $schedule_info);
		print_r('Availability Successfully Update');
		die;
	}

	function profile()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Staff Profile - '.config_item('company_name'));
	$data['page'] = 'Profile';
	$data['staff_info']=$this->staff_model->staff_info($this->tank_auth->get_user_id());
	$this->template->set_layout('users')->build('profile',isset($data) ? $data : NULL);
	}

	
	public function clientrating()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/staff_rating',isset($data) ? $data : NULL);
	}

	public function standby()
	{
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$status=$this->uri->segment(3);
			$profile_data = array('standby' => $status);
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Stand By Mode Update Successfully");
			redirect('staff');
		}
	}

	function defaults()
	{
		if($this->input->post('save'))
		{
			$days=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
          	foreach ($days as $day) 
          	{
          		if($this->input->post($day)=='Available')
          		{
          			$block[$day]=array($this->input->post('mtime1') => $this->input->post('mtime2'),$this->input->post('etime1')=>$this->input->post('etime2'));
          		}
          		else
          		{
          			$block[$day]=$this->input->post($day);
          		}
          	}
          	$block=json_encode($block);
          	$blocktime="[['".$this->input->post('mtime1')."','".$this->input->post('mtime2')."'],['".$this->input->post('etime1')."','".$this->input->post('etime2')."']]";
          	$schedule_info=array(
          		'staffid'=>$this->tank_auth->get_user_id(),
          		'block'=> $block,
          		'blocktime'=> $blocktime,
          		'udate'=> date('Y-m-d H:i:s')
          		);

          	$this->db->where('scheduleid',$this->input->post('scheduleid'))->update('default_schedule', $schedule_info);
          	$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Schedule Update Successfully");
			redirect('staff/defaults');
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Staff Default Schedule - '.config_item('company_name'));
			$data['page'] = 'Home';
			$data['liveclock'] = TRUE;
			$data['slider']=TRUE;
			$data['timepicker']=TRUE;
			$data['user_id']=$user_id=$this->tank_auth->get_user_id();
			$data['staffSchedule']=$this->db->where('staffid',$user_id)->get('default_schedule')->result();
			$data['staff_info']=$this->staff_model->staff_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('default-schedule',isset($data) ? $data : NULL);
		}
	}

	function saveddaydata()
	{
		$day=$this->input->post('day');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$user_id=$this->tank_auth->get_user_id();
		$staffSchedule=$this->db->where('staffid',$user_id)->order_by('cdate','DESC')->limit(1)->get('staff_schedule')->result();
		$staffSchedule=(array)$staffSchedule[0];
		$availability=json_decode($staffSchedule['availability'],TRUE);
		$availability=(array)$availability;

		$start=explode(",", $start);
		$end=explode(",", $end);
		$time = array_combine($start, $end);
		$utime=array($day=>$time);
		$newavailable=array_replace($availability,$utime);
		$newavailable=json_encode($newavailable);
		$schedule_info=array('availability'=>$newavailable,'udate'=>date('Y-m-d H:i:s'));
		$this->db->where('scheduleid',$this->input->post('scheduleid'))->update('default_schedule', $schedule_info);
		print_r('Availability Successfully Update');
		die;
	}

	


	
}

/* End of file contacts.php */