<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MX_Controller {

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
	}

	function index()
	{
	$this->load->model('client_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Client Messages - '.config_item('company_name'));
	$data['page'] = 'Messages';
	$this->template->set_layout('users')->build('messages',isset($data) ? $data : NULL);
	}
}

/* End of file jobs.php */