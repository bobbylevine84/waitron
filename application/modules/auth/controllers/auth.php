<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('login');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in			
			redirect('');
		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {								// success
					redirect($this->session->userdata('requested_page'));
				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {
						//$this->session->set_flashdata('message',$errors['banned']);	// banned user
						$this->session->set_flashdata('message',"This account has been deleted. If you would like to re-join the waitron community, please return to the <a href='".base_url()."register'>register</a>  section of our website.");
						redirect('login');

					} elseif (isset($errors['not_activated'])) {				// not activated user
						$this->tank_auth->logout();
						$this->session->set_flashdata('message',"Oh no! It looks like this account has been deactivated. If you feel you are receiving the message in error, please contact us at <a href='mailto:support@waitron.com'>support@waitron.com</a>");
						redirect('login');
					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}			
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('welcome_to').' '.$this->config->item('company_name'));
	$data['ref_item'] = $this->input->get('r_url', TRUE) ? $this->input->get('r_url', TRUE) : NULL;
	$login_form = 'login_form';
	if(config_item('show_login_image') == 'TRUE'){
		$login_form = 'login_with_bg';
	}
	$this->template
	->set_layout('login')
	->build('auth/'.$login_form,isset($data) ? $data : NULL);
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();
		redirect('login');

		//$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or Username', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('company_name');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);
					$this->session->set_flashdata('message',$this->lang->line('auth_message_new_password_sent'));
					//$this->_show_message($this->lang->line('auth_message_new_password_sent'));
					redirect('auth/login');

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Forgot Password - '.$this->config->item('company_name'));
		$this->template->set_layout('login')->build('auth/forgot_password_form',isset($data) ? $data : NULL);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('company_name');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);
				$this->session->set_flashdata('message',$this->lang->line('auth_message_new_password_activated'));
					redirect('auth/login');

			} else {	
																// fail
				$this->session->set_flashdata('message',$this->lang->line('auth_message_new_password_failed'));
					redirect('auth/login');
			}
		} else {
			// Try to activate user by password key (if not activated yet)

			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
				
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->session->set_flashdata('message',$this->lang->line('auth_message_new_password_failed'));
					redirect('auth/login');
			}
		}
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title('Forgot Password - '.$this->config->item('company_name'));
	$this->template
	->set_layout('login')
	->build('auth/reset_password_form',isset($data) ? $data : NULL);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			if ($this->config->item('demo_mode') == 'TRUE') {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message', lang('demo_warning'));
			redirect($this->input->post('r_url', TRUE));
			}

			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
					$this->form_validation->set_value('old_password'),
					$this->form_validation->set_value('new_password'))) {	// success

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message',lang('auth_message_password_changed'));
				    redirect('settings/changepass');
					//$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
		
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',lang('password_or_field_error'));
		    redirect('settings/changepass');
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		switch ($type)
			        {
			            case 'forgot_password':
			                return $this->_email_forgot_password($email,$data);
			                break;
			            case 'reset_password':
			                return $this->_email_reset_password($email,$data);
			                break;
			        }
	}

	function _email_reset_password($email,$data){

			$message = $this -> applib ->get_any_field('email_templates',array('email_group' => 'reset_password'),'template_body');

			
			$username = str_replace("{USERNAME}",$data['username'],$message);
			$user_email =  str_replace("{EMAIL}",$data['email'],$username);
			$user_password =  str_replace("{NEW_PASSWORD}",$data['new_password'],$user_email);
			$message = str_replace("{SITE_NAME}",config_item('company_name'),$user_password);
			
			$params['recipient'] = $email;

			$params['subject'] = 'Reset Password -- [ '.config_item('company_name').' ]';
			$params['message'] = $message;		

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);

	}

	function _email_forgot_password($email,$data){


			$message = $this->applib->get_any_field('email_templates',array('email_group'=>'forgot_password'),'template_body');

			$site_url = str_replace("{SITE_URL}",base_url().'auth/login',$message);
			$key_url = str_replace("{PASS_KEY_URL}",base_url().'auth/reset_password/'.$data['user_id'].'/'.$data['new_pass_key'],$site_url);
			$message = str_replace("{SITE_NAME}",config_item('company_name'),$key_url);
			
			$params['recipient'] = $email;

			$params['subject'] = 'Forgot Password -- [ '.config_item('company_name').' ]';
			$params['message'] = $message;		

			$params['attached_file'] = '';

			Modules::run('fomailer/send_email',$params);

	}


}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */