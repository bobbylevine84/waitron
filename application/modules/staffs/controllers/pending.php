<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending extends MX_Controller {

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
		$this->load->model('staffs_model');
		$this->load->helper("url");
	}


	function index($sortby='user_id',$order='desc',$type='sort')
	{
		//echo $sortby.$order.$type;
		//die();
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Pending Application Workers - '.config_item('company_name'));
		$data['page'] = 'Staffs';
		$data['datatables'] = TRUE;
		$data['staffs']=$this->staffs_model->pending_staffs($sortby,$order,$type);
		$this->template->set_layout('users')->build('pending',isset($data) ? $data : NULL);
	}


	function view()
	{
		if($this->input->post('update'))
		{
			$user_id=$this->input->post('user_id');
			$user_info=array(
					'notes'=>$this->input->post('notes')
					);
			$this->db->where('user_id',$user_id)->update('user_info', $user_info); 
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Notes Information Update Successfully");
			$page='staffs/pending/view/'.$user_id;
			redirect($page);
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Pending Application View - '.config_item('company_name'));
			$data['page'] = 'Staffs';
			$data['datatables'] = TRUE;
			$data['staffs']=$this->staffs_model->pending_staff_info($this->uri->segment(4));
			$data['servicetype']=$this->db->get('servicetype')->result();
			$this->template->set_layout('users')->build('pending-view',isset($data) ? $data : NULL);			
		}


	}

	function approve()
	{
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$profile_data = array(
								'pstatus' 	=> 2,
				                'activated' 	=> 1,
				                'banned' 	=> 0,
				             );
			$this->db->where('id',$user_id)->update('users', $profile_data);

			////// Staff Application Accept Email //////
			$user=$this->db->join('user_info','user_info.user_id = users.id')->where('users.id',$user_id)->get('users')->row(); 
			$data['email']=$user->email;
			$data['name']=$user->firstname;

			$this->staffApplicationAccepted($data);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', 'Staff Approve Successfully');
			redirect('staffs/pending');	
		}
	}



	function decline()
	{
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$profile_data = array(
								'pstatus' 	=> 1,
				                'activated' 	=> 0,
				                'banned' 	=> 1,
				             );
			$this->db->where('id',$user_id)->update('users', $profile_data);

			////// Staff Application Accept Email //////
			$user=$this->db->join('user_info','user_info.user_id = users.id')->where('users.id',$user_id)->get('users')->row(); 
			$data['email']=$user->email;
			$data['name']=$user->firstname;
			
			$this->staffApplicationDeclined($data);

			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Decline Successfully");
			redirect('staffs/pending');	
		}
	}

	function trash(){
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Trashed Application View - '.config_item('company_name'));
		$data['page'] = 'Staffs';
		$data['datatables'] = TRUE;
		$data['trash_staffs']=$this->staffs_model->trash_staffs();
		$this->template->set_layout('users')->build('trash',isset($data) ? $data : NULL);
	}
	
	function delete(){
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$profile_data = array(
						'pstatus' 	=> 3,
		                'activated' 	=> 0,
		                'banned' 	=> 0
				         );
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', 'Staff deleted permanantly');
			redirect('staffs/pending/trash');	
		}
	}
	
	function accept(){
		if($this->uri->segment(4))
		{
			$user_id=$this->uri->segment(4);
			$profile_data = array(
						'pstatus' 	=> 0,
		                'activated' 	=> 1,
		                'banned' 	=> 0
				         );
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', 'Staff moved to pending applications.');
			redirect('staffs/pending/trash');	
		}
	}
	
	
	function deleteallrecords(){
		$ids=$this->staffs_model->get_trash_records();
		$profile_data = array(
					'pstatus' 	=> 3,
			        'activated' 	=> 0,
			        'banned' 	=> 0,
				);
		$this->db->where_in( 'id', $ids )->update('users', $profile_data);
		$this->session->set_flashdata('response_status', 'success');
		$this->session->set_flashdata('message', 'Staff deleted permanantly');
		redirect('staffs/pending/trash');
	}

	function staffApplicationAccepted($data)
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffApplicationAccepted'), 'template_body');
			
		$message = str_replace("{NAME}",$data['name'],$message);
		$params['recipient'] = $data['email'];
		$params['subject'] = 'Staff Application Accepted';
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}

	function staffApplicationDeclined($data)
	{
		$message = $this->applib->get_any_field('email_templates',array('email_group' => 'staffApplicationDeclined'), 'template_body');
			
		$message = str_replace("{NAME}",$data['name'],$message);
		$params['recipient'] = $data['email'];
		$params['subject'] = 'Staff Application Accepted';
		$params['message'] = $message;		

		$params['attached_file'] = '';

		modules::run('fomailer/send_email',$params);
	}
	
}