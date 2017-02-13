<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));
		$this->form_validation-> set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->load->model('settings_model');


		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('message',lang('login_required'));
			redirect('login');
		}
		if ($this->tank_auth->get_user_type() !='Admin') {
			$this->session->set_flashdata('message', lang('access_denied'));
			redirect('');
		}
		
	}

	function index()
	{
		if($this->input->post('save'))
		{
			$user_id=$this->input->post('user_id');
			$email=$this->input->post('email');
			$old_email=$this->input->post('old_email');

			$user=array(
					'email'=>$email
					);

			$admin_info=array(
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),
				'phone'=>$this->input->post('phone'),
				'position'=>$this->input->post('position')
				);

			$this->db->where('user_id',$user_id)->update('user_info', $admin_info); 

			if($email==$old_email)
				{ 
					$this->db->where('id',$user_id)->update('users', $user);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "Admin Information Update Successfully");
					redirect('settings');
				} 
				else
				{ 
					if (!$this->tank_auth->is_email_available($email)) {
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', 'Email Already Exists Please Choose Another Email Address');
						redirect('settings');
					}
					else
					{
						$this->db->where('id',$user_id)->update('users', $user);
						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', "Admin Information Update Successfully");
						redirect('settings');
					}
				}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Settings - '.config_item('company_name'));
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('settings',isset($data) ? $data : NULL);
		}
	}



	function changepass()
	{
		if ($this->input->post('save')) 
		{
			$old_password=$this->input->post('old_password');
			$new_password=$this->input->post('new_password');
			$confirm_new_password=$this->input->post('confirm_new_password');
			if($new_password==$confirm_new_password)
			{
				if ($this->tank_auth->change_password($old_password,$new_password)) 			// success
				{	
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message','password has been updated!');
				    redirect('settings/changepass');
				} 
				else 
				{														// fail
					$errors = $this->tank_auth->get_error_message();
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message',$errors['old_password']);
				    redirect('settings/changepass');
				}
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Confirm Your New Password');
			    redirect('settings/changepass');
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Change Password - '.config_item('company_name'));
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('change-pass',isset($data) ? $data : NULL);
		}

	}
}

/* End of file settings.php */