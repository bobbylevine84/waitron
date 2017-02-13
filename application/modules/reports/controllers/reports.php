<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

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
		$this->load->model('reports_model');
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Reports - '.config_item('company_name'));
	$data['page'] = 'Reports';
	$data['datatables'] = TRUE;
	$this->template->set_layout('users')->build('reports',isset($data) ? $data : NULL);
	}

	
	function profit()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Profit Reports - '.config_item('company_name'));
		$data['page'] = 'Reports';
		$data['datatables'] = TRUE;
		$this->template->set_layout('users')->build('profit',isset($data) ? $data : NULL);
	}

	function invoices()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Invoices Reports - '.config_item('company_name'));
	$data['page'] = 'Reports';
	$data['datatables'] = TRUE;
	$this->template->set_layout('users')->build('invoices',isset($data) ? $data : NULL);
	}

	function payments()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Payments Reports - '.config_item('company_name'));
	$data['page'] = 'Reports';
	$data['datatables'] = TRUE;
	$this->template->set_layout('users')->build('payments',isset($data) ? $data : NULL);
	}

	function waitronactivity()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Waitron Activity Reports - '.config_item('company_name'));
	$data['page'] = 'Reports';
	$data['datatables'] = TRUE;
	$this->template->set_layout('users')->build('waitron-activity',isset($data) ? $data : NULL);
	}
	
	
	
}

/* End of file contacts.php */