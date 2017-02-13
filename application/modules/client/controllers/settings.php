<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));
		$this->load->model('client_model');

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

		if($this->input->post('save'))
		{
			$user_id=$this->input->post('user_id');
			$email=$this->input->post('email');
			$old_email=$this->input->post('old_email');

			$user=array(
					'email'=>$email,
					'username'=>$email
					);

			$client_info=array(
				'address'=>$this->input->post('address'),
				'zipcode'=>$this->input->post('zipcode'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'phone'=>$this->input->post('phone')
				);

			$this->db->where('user_id',$user_id)->update('user_info', $client_info); 

			if($email==$old_email)
				{ 
					$this->db->where('id',$user_id)->update('users', $user);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "Client Information Update Successfully");
					redirect('client/settings');
				} 
				else
				{ 
					if (!$this->tank_auth->is_email_available($email)) {
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', 'Email Already Exists Please Choose Another Email Address');
						redirect('client/settings');
					}
					else
					{
						$this->db->where('id',$user_id)->update('users', $user);
						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', "Client Information Update Successfully");
						redirect('client/settings');
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
			$data['client_info']=$this->client_model->client_info($this->tank_auth->get_user_id());
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
			$data['client_info']=$this->client_model->client_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('change-password',isset($data) ? $data : NULL);
		}
	}


	function paymentinfo()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Client Settings - '.config_item('company_name'));
	$data['page'] = 'Settings';
	$data['client_info']=$this->client_model->client_info($this->tank_auth->get_user_id());
	$this->template->set_layout('users')->build('payment-information',isset($data) ? $data : NULL);
	}

	function disputes()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Client Jobs - '.config_item('company_name'));
	$data['page'] = 'Settings';
	$data['client_info']=$this->client_model->client_info($this->tank_auth->get_user_id());
	$this->template->set_layout('users')->build('disputes',isset($data) ? $data : NULL);
	}

	
	
}

/* End of file contacts.php */