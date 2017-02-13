<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('login');
		}
		if ($this->tank_auth->get_user_type() == 'Client') {
			redirect('client');
		}
		if ($this->tank_auth->get_user_type() == 'Staff') {
			redirect('staff');
		}
		if ($this->tank_auth->get_role_id() != '1' && $this->tank_auth->get_user_type() == 'Admin') {
			redirect('settings');
		}

	}

	function index()
	{
	$this->load->model('home_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(config_item('company_name'));
	$data['page'] = 'Home';
	$data['active_staffs']=$this->home_model->active_staffs();
	$data['pending_staffs']=$this->home_model->pending_staffs();
	$data['active_clients']=$this->home_model->active_clients();
	$data['real_time_active_jobs']=$this->home_model->real_time_active_jobs();
	$data['total_jobs_completed']=$this->home_model->total_jobs_completed();
	$data['gross_revenue']=$this->home_model->gross_revenue();
	$this->template->set_layout('users')->build('user_home',isset($data) ? $data : NULL);
	}

}

/* End of file welcome.php */