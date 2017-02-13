<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageaccounts extends MX_Controller {

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
		$this->template->title('Manage Accounts - '.config_item('company_name'));
		$data['page'] = 'Settings';
		$data['form'] = TRUE;
		$data['roles_arr']=$this->settings_model->get_admin_roles();
		$data['users_arr']=$this->settings_model->get_admin_users();
		$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
		$this->template->set_layout('users')->build('manage-accounts',isset($data) ? $data : NULL);
	}
	
	function addrole()
	{
		if ($this->input->post()) {
			$this->session->flashdata('message');
			$this->form_validation->set_rules('rolename', 'Role', 'required');
			$this->form_validation->set_rules('permissions', 'Permissions', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', "Please fill required fields.");
				redirect('settings/addrole');
			}else{		
				$newrole=array(
					'role'=>$this->input->post('rolename'),
					'cdate'=>date('Y-m-d H:i:s')
					);
				$roleid=$this->settings_model->insert_role($newrole);
				$permissions=$this->input->post('permissions');
				foreach($permissions as $permission){
					$roleinfo=array('role_id'=>$roleid,
						'permission_id'=>$permission,
						'role'=>$this->input->post('rolename')
						);
					$this->settings_model->insert_role_permission($roleinfo);
				}
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Role submitted successfully.");
				redirect('settings/manageaccounts');
			}
		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Add Admin Role - '.config_item('company_name'));
			$data['permission_arr']=$this->settings_model->get_permissions();
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['treeview'] = TRUE;
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('add-role',isset($data) ? $data : NULL);
		}
	}
	
	function viewRole(){
		if ($this->input->post()) {
			$this->session->flashdata('message');
			$this->form_validation->set_rules('rolename', 'Role', 'required');
			$this->form_validation->set_rules('permissions', 'Permissions', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', "Please fill required fields.");
				redirect('settings/viewRole');
			}else{
				$roleid=$this->uri->segment(4);
				$permissions=$this->input->post('permissions');
				if($permissions){
					//if new permissions added for user role first delete all old set permisiions
					$this->settings_model->delete_role_data($roleid);
					
					// insert new permissions selected on role updation time
					foreach($permissions as $permission){
						$roleinfo=array('role_id'=>$roleid,
							'permission_id'=>$permission,
							'role'=>$this->input->post('rolename')
							);
						$this->settings_model->check_role_permission($roleid,$permission,$roleinfo);
					}
				}
				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message', "Role updated successfully.");
				redirect('settings/manageaccounts');
			}
		}
		else{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Update Admin Role - '.config_item('company_name'));
			// get all permissions array
			$data['permission_arr']=$this->settings_model->get_permissions();
			//get current user role permission data by role id
			$data['role_data']=$this->settings_model->get_role_data($this->uri->segment(4));
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['treeview'] = TRUE;
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('view-role',isset($data) ? $data : NULL);
		}
	}

	function adduser()
	{
		if ($this->input->post()) 
		{
			$this->session->flashdata('message');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('select_role', 'Role', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', "Please fill all blank fields.");
				redirect('settings/manageaccounts/adduser');
			}
			else
			{
				if (!$this->tank_auth->is_email_available($this->input->post('email'))) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Email Address Already Exists Please Choose Another Email Address');
					redirect('settings/manageaccounts/adduser');
				}
				else
				{
					$pass=$this->input->post('password');
					$password=$this->tank_auth->hashed_pass($pass);
					$newuser=array('username'=>$this->input->post('email'),
						'password'=>$password,     
						'email'=>$this->input->post('email'),
						'role_id'=>$this->input->post('select_role'),
						'user_type'=>'Admin'
					);
					$userid=$this->settings_model->insert_admin_user($newuser);
					$userinfo=array('user_id'=>$userid,
						'firstname'=>$this->input->post('firstname'),
						'lastname'=>$this->input->post('lastname'),
						'position'=>$this->input->post('position'),
						'phone'=>$this->input->post('phone')
					);
					$this->settings_model->insert_admin_userinfo($userinfo);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "User created successfully.");
					redirect('settings/manageaccounts');
				}
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Add Admin User - '.config_item('company_name'));
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['roles_arr']=$this->settings_model->get_admin_roles();
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('add-user',isset($data) ? $data : NULL);
		}
	}

	
	function viewUser(){
		if ($this->input->post()) {
			$this->session->flashdata('message');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('select_role', 'Role', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', "Please fill all blank fields.");
				redirect('settings/viewUser');
			}
			else
			{
				$userid=$this->uri->segment(4);
				$url='settings/manageaccounts/viewUser/'.$userid;
				if(!$this->tank_auth->is_email_available($this->input->post('email'))) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Email Address Already Exists Please Choose Another Email Address');
					redirect($url);
				}
				else
				{
					$updateuser=array('username'=>$this->input->post('email'),
						'role_id'=>$this->input->post('select_role'),
						'email'=>$this->input->post('email'),
					);
					$updateuserinfo=array(
						'firstname'=>$this->input->post('firstname'),
						'lastname'=>$this->input->post('lastname'),
						'position'=>$this->input->post('position'),
						'phone'=>$this->input->post('phone')
					);
					$this->settings_model->update_userinfo($updateuser,$updateuserinfo,$userid);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "User updated successfully.");
					redirect($url);
				}
			}
		}
		else{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Update Admin User - '.config_item('company_name'));
			$data['user_data']=$this->settings_model->get_user_data($this->uri->segment(4));
			$data['roles_arr']=$this->settings_model->get_admin_roles();
			$data['page'] = 'Settings';
			$data['form'] = TRUE;
			$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
			$this->template->set_layout('users')->build('view-user',isset($data) ? $data : NULL);
		}
	}
	
	function deleteRole(){
		$roleid=$this->uri->segment(4);
		if($this->settings_model->delete_role($roleid)){
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Role deleted successfully.");
		}
		redirect('settings/manageaccounts');
	}
	
	function deleteUser(){
		$userid=$this->uri->segment(4);
		if($this->settings_model->delete_user($userid)){
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "User deleted successfully.");
		}
		redirect('settings/manageaccounts');
	}

}

/* End of file view.php */