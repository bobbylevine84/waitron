<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffs extends MX_Controller {

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
		if ($this->tank_auth->checkPermission('staffs') != TRUE) {
			$this->session->set_flashdata('response_status', 'error');
			$this->session->set_flashdata('message',"You don't have permission to access this page.");
			redirect('settings');
		}
		$this->load->library(array('tank_auth','form_validation','pagination'));
		$this->form_validation-> set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->load->model('staffs_model');
		$this->load->helper("url");
	}

	function index($sortby='user_id',$order='desc',$type='sort',$page=0)
	{ 
		$config = array();
        $config["base_url"] = base_url() . "staffs/index/".$sortby."/".$order."/".$type;
	    $config["total_rows"] = $this->staffs_model->staffs_record_count($sortby,$order,$type);
	    $config["per_page"] = 10;
	    $config["uri_segment"] = 6;
	    $choice = $config["total_rows"] / $config["per_page"];
	    $config["num_links"] = round($choice);
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
	    $this->pagination->initialize($config);

	    //$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

	    $data["staffs"] = $this->staffs_model->fetch_staffs($config["per_page"], $page,$sortby,$order,$type);
	    $data["links"] = $this->pagination->create_links();


		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Staffs - '.config_item('company_name'));
		$data['page'] = 'Staffs';
		$data['pending_staffs_count']=$this->staffs_model->pending_staffs_count();
		$data['staffs_captain_request']=$this->staffs_model->staffs_captain_request();
		$data['servicetype']=$this->db->get('servicetype')->result();
		$this->template->set_layout('users')->build('staffs',isset($data) ? $data : NULL);
	}

	function all($sortby='user_id',$order='desc',$type='sort')
	{ 
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Staffs - '.config_item('company_name'));
		$data['page'] = 'Staffs';
		$data['pending_staffs_count']=$this->staffs_model->pending_staffs_count();
		$data['staffs_captain_request']=$this->staffs_model->staffs_captain_request();
		$data["staffs"] = $this->staffs_model->all_staffs($sortby,$order,$type);
		$data['servicetype']=$this->db->get('servicetype')->result();
		$this->template->set_layout('users')->build('all',isset($data) ? $data : NULL);
	}

	function welcome_email($email,$data)
	{
			$message = $this->applib->get_any_field('email_templates',array('email_group' => 'registration'), 'template_body');
			
			$site_url = str_replace("{SITE_URL}",base_url().'login',$message);
			$username = str_replace("{USERNAME}",$data['email'],$site_url);
			$user_email =  str_replace("{EMAIL}",$data['email'],$username);
			$user_password =  str_replace("{PASSWORD}",$data['password'],$user_email);
			$message = str_replace("{SITE_NAME}",config_item('company_name'),$user_password);
			
			$params['recipient'] = $email;
			$params['subject'] = 'Welcome to '.config_item('company_name');
			$params['message'] = $message;		

			$params['attached_file'] = '';

			modules::run('fomailer/send_email',$params);
	}

	function add()
	{
		if($this->input->post('add'))
			{
				$email=$this->input->post('email');
				
				$password=rand(50000000,99999999);
				$skill=$this->input->post('skills');
				$skills=implode(', ', $skill);

				$this->input->post('moc_email')!='' ? $moc_email='Yes' : $moc_email='No';
				$this->input->post('moc_call')!='' ? $moc_call='Yes' : $moc_call='No';
				$this->input->post('moc_text')!='' ? $moc_text='Yes' : $moc_text='No';

				// Hash password using phpass
				$hashed_password = $this->tank_auth->hashed_pass($password);

				$edata=array(
					'username'=>$email,
					'password'=>$password,
					'email'=>$email,
					);

				$user=array(
					'username'=>$email,
					'password'=>$hashed_password,
					'email'=>$email,
					'user_type'=>$this->input->post('user_type'),
					'pstatus'=>'2'
					);

				$user_info=array(
					'firstname'=>$this->input->post('firstname'),
					'lastname'=>$this->input->post('lastname'),
					'zipcode'=>$this->input->post('zipcode'),
					'city'=>$this->input->post('city'),
					'state'=>$this->input->post('state'),
					'phone'=>$this->input->post('phone'),
					'address'=>$this->input->post('address'),
					'skills'=>$skills,
					'moc_email'=>$moc_email,
					'moc_call'=>$moc_call,
					'moc_text'=>$moc_text,
					);
				//print_r($user_info);

				$billing_info=array(
					'cardtype'=>'',
					'nameoncard'=>'',
					'cardnumber'=>'',
					'ccvnumber'=>'',
					'czipcode'=>'',
					'routingnumber'=>$this->input->post('routingnumber'),
					'accountnumber'=>$this->input->post('accountnumber')
					);

				$total=$this->db->from('users')->where(array('email'=>$email))->get()->num_rows();
				if ($total>=1) {
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message', 'User Email Address Already Exists Please Choose Another Email Address');
					$page='staffs/add';
					redirect($page);
				}
				else
				{
					if($user_id = $this->staffs_model->add_staff($user,$user_info,$billing_info,TRUE))
					{
						$this->welcome_email($edata['email'],$edata);
						$this->db->insert('staff_schedule',array('staffid'=>$user_id,'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
						$this->db->insert('default_schedule',array('staffid'=>$user_id,'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
						
						
						
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
							}
							else
							{
								
								$data = $this->upload->data();
								$file_name = $this->staffs_model->update_avatar($data['file_name'],$user_id);

								$this->session->set_flashdata('response_status', 'success');
								$this->session->set_flashdata('message', "Staff Add Successfully ");
							}
						}
						else
						{
							$this->session->set_flashdata('response_status', 'success');
							$this->session->set_flashdata('message', "Staff Add Successfully Without Avatar Image ");
						}
						redirect('staffs');
					}
				}
			}
			else
			{
				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title('Add Staff - '.config_item('company_name'));
				$data['form'] = TRUE;
				$data['page'] = 'Staffs';
				$data['servicetype']=$this->db->get('servicetype')->result();
				$this->template->set_layout('users')->build('add',isset($data) ? $data : NULL);
			}
	}

	function view()
	{
		if($this->input->post('update'))
			{
				$user_id=$this->input->post('user_id');
				$email=$this->input->post('email');
				$old_email=$this->input->post('old_email');
				$skill=$this->input->post('skills');
				$skills=implode(', ', $skill);

				$this->input->post('moc_email')!='' ? $moc_email='Yes' : $moc_email='No';
				$this->input->post('moc_call')!='' ? $moc_call='Yes' : $moc_call='No';
				$this->input->post('moc_text')!='' ? $moc_text='Yes' : $moc_text='No';

				$user=array(
					'username'=>$email,
					'email'=>$email
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
					'skills'=>$skills,
					'moc_email'=>$moc_email,
					'moc_call'=>$moc_call,
					'moc_text'=>$moc_text,
					);
				//print_r($user_info);

				$billing_info=array(
					'cardtype'=>'',
					'nameoncard'=>'',
					'cardnumber'=>'',
					'ccvnumber'=>'',
					'czipcode'=>'',
					'routingnumber'=>$this->input->post('routingnumber'),
					'accountnumber'=>$this->input->post('accountnumber')
					);
				//print_r($billing_info);

				$this->db->where('user_id',$user_id)->update('user_info', $user_info); 
				$this->db->where('user_id',$user_id)->update('billing_info', $billing_info);

				if($email==$old_email)
				{ 
					$this->db->where('id',$user_id)->update('users', $user);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "User Information Update Successfully");
					$page='staffs/view/'.$user_id;
					redirect($page);
				} 
				else
				{ 
					$total=$this->db->from('users')->where(array('email'=>$email))->get()->num_rows();
					if ($total>=1) {
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', 'Email Already Exists Please Choose Another Email Address');
						$page='staffs/view/'.$user_id;
						redirect($page);
					}
					else
					{
						$this->db->where('id',$user_id)->update('users', $user);
						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', "User Email Update Successfully");
						$page='staffs/view/'.$user_id;
						redirect($page);
					}
				}
			}
			else
			{
				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title('Update Staff - '.config_item('company_name'));
				$data['form'] = TRUE;
				$data['page'] = 'Staffs';
				$data['staffs']=$this->staffs_model->staff_info($this->uri->segment(3));
				$data['servicetype']=$this->db->get('servicetype')->result();
				$this->template->set_layout('users')->build('view',isset($data) ? $data : NULL);
			}
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
					$url='staffs/view/'.$user_id;
					redirect($url);
				}
				else
				{
					$data = $this->upload->data();
					$file_name = $this->staffs_model->update_avatar($data['file_name'],$user_id);

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message','Avatar Uploaded Successfully');
					$url='staffs/view/'.$user_id;
					redirect($url);
				}
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Select a Avatar File');
				$url='staffs/view/'.$user_id;
				redirect($url);
			}
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/change-avatar',isset($data) ? $data : NULL);
		}
	}

	function staffrating()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/staff-rating',isset($data) ? $data : NULL);
	}

	function jobhistory()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/job-history',isset($data) ? $data : NULL);
	}

	function paymenthistory()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/payment-history',isset($data) ? $data : NULL);
	}

	function workdocuments()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/work-documents',isset($data) ? $data : NULL);
	}

	function manualpayment()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/manual-payment',isset($data) ? $data : NULL);
	}

	public function deactivateaccount()
	{
		if($this->uri->segment(4)=='deactivate')
		{
			$user_id=$this->uri->segment(3);
			$profile_data = array('activated' => 0);
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Account Deactivate Successfully");
			$page='staffs/view/'.$user_id;
			redirect($page);
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/deactivate-account',isset($data) ? $data : NULL);
		}
	}

	public function activateaccount()
	{
		if($this->uri->segment(4)=='activate')
		{
			$user_id=$this->uri->segment(3);
			$profile_data = array('activated' => 1);
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Account Activate Successfully");
			$page='staffs/view/'.$user_id;
			redirect($page);
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/activate-account',isset($data) ? $data : NULL);
		}
	}

	public function deleteaccount()
	{
		if($this->uri->segment(4)=='delete')
		{
			$user_id=$this->uri->segment(3);
			$profile_data = array('banned' => 1,'deletedate'=>date('Y-m-d H:i:s'));
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Staff Account Delete Successfully");
			redirect('staffs');
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/delete-account',isset($data) ? $data : NULL);			
		}

	}	
}

/* End of file contacts.php */