<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventtype extends MX_Controller {

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
		$this->template->title('Event Type - Settings - '.config_item('company_name'));
		$data['page'] = 'Settings';
		$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
		$data['eventtype']=$this->db->get('eventtype')->result();
		$this->template->set_layout('users')->build('event-type',isset($data) ? $data : NULL);
	}

	function add()
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
	}

	function update()
	{
		
		if($this->input->post('update'))
		{
			$eventtypeid=$this->input->post('eventtypeid');
			$eventtype=array(
				'eventtype'=>$this->input->post('eventtype'),
				'modified'=>date('Y-m-d H:i:s')
				);

			if($this->db->where('eventtypeid',$eventtypeid)->update('eventtype',$eventtype))
			{
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Event Type Update Successfully ");
				redirect('settings/eventtype');
			}
		}
		else
		{
			$eventtypeid=$this->uri->segment(4);
			$data['eventtype']=$this->db->where('eventtypeid',$eventtypeid)->get('eventtype')->result();
			$this->load->view('modal/update-event-type',isset($data) ? $data : NULL);

		}
	}

	function delete($id){
		$deleteET=$this->db->where('eventtypeid', $id)->delete('eventtype');
		if($deleteET){
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Event Type deleted successfully.");
			redirect('settings/eventtype');
		}
	}

}

/* End of file view.php */