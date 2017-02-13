<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends MX_Controller {

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
	$user_id = $this->tank_auth->get_user_id();
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Client - '.config_item('company_name'));
	$data['page'] = 'Home';
	$data['client_info']=$this->client_model->client_info($user_id);
	$data['active_staffs']=$this->client_model->active_staffs();
	$data['realTimeJobCount']=$this->client_model->realTimeJobCount($user_id);
	$data['standby_staffs']=$this->client_model->standby_staffs();
	$this->template->set_layout('users')->build('client',isset($data) ? $data : NULL);
	}

	function profile()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Client Profile - '.config_item('company_name'));
	$data['page'] = 'Profile';
	$data['client_info']=$this->client_model->client_info($this->tank_auth->get_user_id());
	$this->template->set_layout('users')->build('profile',isset($data) ? $data : NULL);
	}

	function changeavatar()
	{		
		if ($this->input->post()) 
		{
			$user_id=$this->input->post('user_id');
			if(file_exists($_FILES['userfile']['tmp_name']) || is_uploaded_file($_FILES['userfile']['tmp_name'])) 
			{
				$config['upload_path'] = './resource/avatar/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['file_name'] = strtoupper('USER-'.$user_id).'-AVATAR';
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message','Avatar Upload Error');
					redirect('client/profile');
				}
				else
				{
					$data = $this->upload->data();
					$file_name = $this->client_model->update_avatar($data['file_name'],$user_id);

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message','Avatar Uploaded Successfully');
					redirect('client/profile');
				}
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Select a Avatar File');
				redirect('client/profile');
			}
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/change_avatar',isset($data) ? $data : NULL);
		}
	}
	
}

/* End of file client.php */