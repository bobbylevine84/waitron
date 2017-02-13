<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etemplates extends MX_Controller {

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
		$this->load->library(array('tank_auth','form_validation','pagination'));
		$this->form_validation-> set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->load->model('settings_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Email Templates - Settings - '.config_item('company_name'));
		$data['page'] = 'Settings';
		$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
		$data['templates']=$this->db->where('tstatus','1')->get('email_templates')->result();
		$this->template->set_layout('users')->build('email-template',isset($data) ? $data : NULL);
	}

	/*function add()
	{
		if($this->input->post('add'))
		{
			$eventtype=array(
				'eventtype'=>$this->input->post('eventtype'),
				'createby'=>$this->input->post('createby'),
				'created'=>date('Y-m-d H:i:s')
				);

			if($this->db->insert('eventtype',$eventtype))
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Event Type Added Successfully ");
				redirect('settings/eventtype');
			}
		}
		else
		{
			$data['user_id'] = $this->tank_auth->get_user_id();
			$this->load->view('modal/add-event-type',isset($data) ? $data : NULL);
		}
	}*/

	function update()
	{
		
		if($this->input->post('update'))
		{
			$template_id=$this->input->post('template_id');
			$email_template=array(
				'email_group'=>$this->input->post('email_group'),
				'name'=>$this->input->post('name'),
				'subject'=>$this->input->post('subject'),
				'template_body'=>$this->input->post('template_body'),
				'modified'=>date('Y-m-d H:i:s')
				);

			if($this->db->where('template_id',$template_id)->update('email_templates',$email_template))
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Email Template Update Successfully ");
				redirect('settings/etemplates');
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Email Templates - Settings - '.config_item('company_name'));
			$data['editor']=TRUE;
			$data['page'] = 'Settings';
			$template_id=$this->uri->segment(4);
			$data['templates']=$this->db->where('template_id',$template_id)->get('email_templates')->result();
			$this->template->set_layout('users')->build('email-template-update',isset($data) ? $data : NULL);
		}
	}

}

/* End of file view.php */