<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');

		if ($this->tank_auth->get_user_type() == 'Admin') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',"You can't register because you already logged in");
			redirect('');
		}
		if ($this->tank_auth->get_user_type() == 'Staff') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',"You can't register because you already logged in");
			redirect('staff');
		}
		if ($this->tank_auth->get_user_type() == 'Client') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',"You can't register because you already logged in");
			redirect('client');
		}

		$this->load->model('register_model');
	}

	function index()
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Register - '.config_item('company_name'));
		$data['page'] = 'Clients';
		$data['form'] = TRUE;
		$this->template->set_layout('login')->build('register',isset($data) ? $data : NULL);
	}

	function welcome_email($email,$data){

			$message = $this->applib->get_any_field('email_templates',array('email_group' => 'registration'), 'template_body');

			
			$site_url = str_replace("{SITE_URL}",base_url().'login',$message);
			$username = str_replace("{USERNAME}",$data['email'],$site_url);
			$user_email =  str_replace("{EMAIL}",$data['email'],$username);
			$user_password =  str_replace("{PASSWORD}",$data['password'],$user_email);
			$message = str_replace("{SITE_NAME}",config_item('company_name'),$user_password);
			
			$params['recipient'] = $email;

			$params['subject'] = 'Registration successful -- '.config_item('company_name');
			$params['message'] = $message;		

			$params['attached_file'] = '';
			

			modules::run('fomailer/send_email',$params);
	}

	
	function staff()
	{
		if($this->input->post('step1') || $this->input->post('step2'))
		{
			if($this->input->post('step2'))
			{
				$password=$this->input->post('password');
				$skill=$this->input->post('skills');
				$skills=implode(',', $skill);

				// Hash password using phpass
				$hashed_password = $this->tank_auth->hashed_pass($password);

				$edata=array(
					'username'=>$this->input->post('email'),
					'password'=>$password,
					'email'=>$this->input->post('email')
					);
			
				$user=array(
					'username'=>$this->input->post('email'),
					'password'=>$hashed_password,
					'email'=>$this->input->post('email'),
					'user_type'=>$this->input->post('user_type')
					);

				//print_r($user);
				$user_info=array(
					'firstname'=>$this->input->post('firstname'),
					'lastname'=>$this->input->post('lastname'),
					'zipcode'=>$this->input->post('zipcode'),
					'city'=>$this->input->post('city'),
					'state'=>$this->input->post('state'),
					'phone'=>$this->input->post('phone'),
					'address'=>$this->input->post('address'),
					'apartment'=>$this->input->post('apartment'),
					'skills'=>$skills,
					'moc_email'=>$this->input->post('moc_email'),
					'moc_call'=>$this->input->post('moc_call'),
					'moc_text'=>$this->input->post('moc_text'),
					'anycomments'=>$this->input->post('anycomments')
					);
				//print_r($user_info);

				$billing_info=array(
					'cardtype'=>'',
					'nameoncard'=>'',
					'cardnumber'=>'',
					'ccvnumber'=>'',
					'czipcode'=>'',
					'routingnumber'=>'',
					'accountnumber'=>''
					);
				//print_r($billing_info);

				if($this->register_model->create_staff($user,$user_info,$billing_info,TRUE))
				{
					$this->welcome_email($edata['email'],$edata);
					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Staff Registration - '.config_item('company_name'));
					$data['page'] = 'staff';
					$data['login'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
					$data['autoredirect'] = 'set';
					$data['name'] = $this->input->post('firstname')." ".$this->input->post('lastname');
					$this->template->set_layout('login')->build('staff-step3',isset($data) ? $data : NULL);
				}

			}
			else
			{
				$email=$this->input->post('email');
				$password=$this->input->post('password');
				$cpassword=$this->input->post('cpassword');
				if (!$this->tank_auth->is_email_available($email)) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Email Address Already Exists Please Choose Another Email Address');
					redirect('register/client');
				}
				elseif ($password!=$cpassword) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Please Confirm Your Password');
					redirect('register/client');
				}
				else
				{
					$login_info=array(
						'user_type'=>$this->input->post('user_type'),
						'firstname'=> $this->input->post('firstname'),
						'lastname'=> $this->input->post('lastname'),
						'email'=> $this->input->post('email'),
						'password'=> $this->input->post('password'),
						);
					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Staff Registration - '.config_item('company_name'));
					$data['form'] = TRUE;
					$data['page'] = 'Staff';
					$data['login'] = $login_info;
					$data['servicetype']=$this->db->get('servicetype')->result();
					$this->template->set_layout('login')->build('staff-step2',isset($data) ? $data : NULL);
				}
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Staff Registration - '.config_item('company_name'));
			$data['form'] = TRUE;
			$data['page'] = 'Staff';
			if (isset($login_info)) {
				$data['login'] = $login_info;
			}
			$this->template->set_layout('login')->build('staff-step1',isset($data) ? $data : NULL);
		}
	}

	function client()
	{
		if($this->input->post('step1') || $this->input->post('step2'))
		{
			if($this->input->post('step2'))
			{
				$password=$this->input->post('password');

				// Hash password using phpass
				$hashed_password = $this->tank_auth->hashed_pass($password);

				$edata=array(
					'username'=>$this->input->post('email'),
					'password'=>$password,
					'email'=>$this->input->post('email')
					);
			
				$user=array(
					'username'=>$this->input->post('email'),
					'password'=>$hashed_password,
					'email'=>$this->input->post('email'),
					'user_type'=>$this->input->post('user_type')
					);

				//print_r($user);
				$user_info=array(
					'firstname'=>$this->input->post('firstname'),
					'lastname'=>$this->input->post('lastname'),
					'zipcode'=>$this->input->post('zipcode'),
					'city'=>$this->input->post('city'),
					'state'=>$this->input->post('state'),
					'phone'=>$this->input->post('phone'),
					'address'=>$this->input->post('address'),
					'companyname'=>$this->input->post('companyname'),
					'suite'=>$this->input->post('suite'),
					'moc_email'=>$this->input->post('moc_email'),
					'moc_call'=>$this->input->post('moc_call'),
					'moc_text'=>$this->input->post('moc_text')
					);
				//print_r($user_info);

				$billing_info=array(
					'cardtype'=>'',
					'nameoncard'=>'',
					'cardnumber'=>'',
					'ccvnumber'=>'',
					'czipcode'=>'',
					'routingnumber'=>'',
					'accountnumber'=>''
					);
				//print_r($billing_info);

				if($this->register_model->create_client($user,$user_info,$billing_info,TRUE))
				{
					// send "welcome" email
					$this->welcome_email($edata['email'],$edata);
					
					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Client Registration - '.config_item('company_name'));
					$data['page'] = 'client';
					$data['login'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
					$data['autoredirect'] = 'set';
					$data['name'] = $this->input->post('firstname')." ".$this->input->post('lastname');
					$this->template->set_layout('login')->build('client-step3',isset($data) ? $data : NULL);
				}
			}
			else
			{
				$email=$this->input->post('email');
				$password=$this->input->post('password');
				$cpassword=$this->input->post('cpassword');
				if (!$this->tank_auth->is_email_available($email)) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Email Address Already Exists Please Choose Another Email Address');
					redirect('register/client');
				}
				elseif ($password!=$cpassword) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'Please Confirm Your Password');
					redirect('register/client');
				}
				else
				{
					$login_info=array(
					'user_type'=>$this->input->post('user_type'),
					'firstname'=> $this->input->post('firstname'),
					'lastname'=> $this->input->post('lastname'),
					'email'=> $email,
					'password'=> $this->input->post('password')
						);
					$this->load->module('layouts');
					$this->load->library('template');
					$this->template->title('Client Registration - '.config_item('company_name'));
					$data['form'] = TRUE;
					$data['page'] = 'Client';
					$data['login'] = $login_info;
					$this->template->set_layout('login')->build('client-step2',isset($data) ? $data : NULL);
				}
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Client Registration - '.config_item('company_name'));
			$data['form'] = TRUE;
			$data['page'] = 'Client';
			if (isset($login_info)) {
				$data['login'] = $login_info;
			}
			$this->template->set_layout('login')->build('client-step1',isset($data) ? $data : NULL);
		}
	}
}

/* End of file contacts.php */