<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captain extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('login');
		}
		if ($this->tank_auth->get_user_type() !='Admin') {
			$this->session->set_flashdata('message', lang('access_denied'));
			redirect('');
		}
		$this->load->library(array('tank_auth','form_validation'));
		$this->form_validation-> set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->load->model('staffs_model');
		$this->load->helper("url");
	}


	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Captain Request Staff - '.config_item('company_name'));
		$data['page'] = 'Staffs';
		$data['staffs']=$this->db->join('user_info','user_info.user_id = users.id')->where('pstatus','2')->where('user_type','Staff')->where('captain',NULL)->where('crequest','Yes')->get('users')->result();
		$this->template->set_layout('users')->build('captain',isset($data) ? $data : NULL);
	}

	function approve()
	{
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$this->db->where('id',$user_id)->update('users', array('captain'=>'Yes'));
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', 'Captain Request Approve Successfully');
			redirect('staffs/captain');	
		}
	}



	function decline()
	{
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$this->db->where('id',$user_id)->update('users', array('captain'=>'No'));
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Captain Request Decline Successfully");
			redirect('staffs/captain');	
		}
	}
}

 ?>