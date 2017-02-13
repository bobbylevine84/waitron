<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends MX_Controller {

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
		$this->load->model('clients_model');
	}

	function index($sortby='user_id',$order='desc',$type='sort',$page=0)
	{
		$config = array();
        $config["base_url"] = base_url() . "clients/index/".$sortby."/".$order."/".$type;
	    $config["total_rows"] = $this->clients_model->fetch_clients_count($sortby,$order,$type);
	    $config["per_page"] = 20;
	    $config["uri_segment"] = 6;
	    $choice = $config["total_rows"] / $config["per_page"];
	    $config["num_links"] = round($choice);
	    $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$this->pagination->initialize($config);

	    //$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
	    $data["clients"] = $this->clients_model->fetch_clients($config["per_page"], $page,$sortby,$order,$type);
	    $data["links"] = $this->pagination->create_links();

		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Clients - '.config_item('company_name'));
		$data['page'] = 'Clients';
		$data['active_clients']=$this->clients_model->active_clients();
		$data['total_clients']=$this->clients_model->total_clients();
		$this->template->set_layout('users')->build('clients',isset($data) ? $data : NULL);
	}

	function all($sortby='user_id',$order='desc',$type='sort')
	{
		$this->load->module('layouts');
		$this->load->library('template');
		$this->template->title('Clients - '.config_item('company_name'));
		$data['page'] = 'Clients';
		$data['clients']=$this->clients_model->all_clients($sortby,$order,$type);
		$data['active_clients']=$this->clients_model->active_clients();
		$data['total_clients']=$this->clients_model->total_clients();
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
			
			$password=rand(50000000,99999999);;

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
				'moc_email'=>$moc_email,
				'moc_call'=>$moc_call,
				'moc_text'=>$moc_text,
				'hourlyrate'=>$this->input->post('hourlyrate'),
				'jobsppm'=>$this->input->post('jobsppm')
				);
			//print_r($user_info);

			$billing_info=array(
				'cardtype'=>$this->input->post('cardtype'),
				'nameoncard'=>$this->input->post('nameoncard'),
				'cardnumber'=>$this->input->post('cardnumber'),
				'ccvnumber'=>$this->input->post('ccvnumber'),
				'czipcode'=>$this->input->post('czipcode'),
				'routingnumber'=>$this->input->post('routingnumber'),
				'accountnumber'=>$this->input->post('accountnumber')
				);
			//print_r($billing_info);
			
			$total=$this->db->from('users')->where(array('email'=>$email,'banned'=>'0'))->get()->num_rows();
			if ($total>=1) {
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', 'Client Email Address Already Exists Please Choose Another Email Address');
				$page='clients/add';
				redirect($page);
			}
			else
			{
				if($user_id = $this->clients_model->add_client($user,$user_info,$billing_info,TRUE))
				{
					$this->welcome_email($edata['email'],$edata);
					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message', "Clients Add Successfully ");
					redirect('clients');
				}
			}
		}
		else
		{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title('Add Client - '.config_item('company_name'));
			$data['form'] = TRUE;
			$data['validator'] = TRUE;
			$data['page'] = 'Clients';
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
					'companyname'=>$this->input->post('companyname'),
					'moc_email'=>$moc_email,
					'moc_call'=>$moc_call,
					'moc_text'=>$moc_text,
					'hourlyrate'=>$this->input->post('hourlyrate'),
					'jobsppm'=>$this->input->post('jobsppm'),
					'udate'=>date('Y-m-d H:i:s')
					);
				//print_r($user_info);

				$billing_info=array(
					'cardtype'=>$this->input->post('cardtype'),
					'nameoncard'=>$this->input->post('nameoncard'),
					'cardnumber'=>$this->input->post('cardnumber'),
					'ccvnumber'=>$this->input->post('ccvnumber'),
					'czipcode'=>$this->input->post('czipcode'),
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
					$this->session->set_flashdata('message', "Client Information Update Successfully");
					$page='clients/view/'.$user_id;
					redirect($page);
				} 
				else
				{ 
					$total=$this->db->from('users')->where(array('email'=>$email))->get()->num_rows();
					if ($total>=1) {
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message', 'Email Already Exists Please Choose Another Email Address');
						$page='clients/view/'.$user_id;
						redirect($page);
					}
					else
					{
						$this->db->where('id',$user_id)->update('users', $user);
						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', "Client Email Update Successfully");
						$page='clients/view/'.$user_id;
						redirect($page);
					}
				}
			}
			else
			{
				$this->load->module('layouts');
				$this->load->library('template');
				$this->template->title('Update Client - '.config_item('company_name'));
				$data['form'] = TRUE;
				$data['page'] = 'Clients';
				$data['clients']=$this->clients_model->client_info($this->uri->segment(3));
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
					$url='clients/view/'.$user_id;
					redirect($url);
				}
				else
				{
					$data = $this->upload->data();
					$file_name = $this->clients_model->update_avatar($data['file_name'],$user_id);

					$this->session->set_flashdata('response_status', 'success');
					$this->session->set_flashdata('message','Avatar Uploaded Successfully');
					$url='clients/view/'.$user_id;
					redirect($url);
				}
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Select a Avatar File');
				$url='clients/view/'.$user_id;
				redirect($url);
			}
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/change_avatar',isset($data) ? $data : NULL);
		}
	}


	public function clientrating()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/client_rating',isset($data) ? $data : NULL);
	}

	public function billinghistory()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/billing_history',isset($data) ? $data : NULL);
	}

	public function jobposthistory()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/job_post_history',isset($data) ? $data : NULL);
	}

	public function hiredhistory()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/hired_history',isset($data) ? $data : NULL);
	}

	public function manualinvoice()
	{
		$data['user_id'] = $this->uri->segment(3);
		$this->load->view('modal/manual_invoice',isset($data) ? $data : NULL);
	}

	public function deactivateaccount()
	{
		if($this->uri->segment(4)=='deactivate')
		{
			$user_id=$this->uri->segment(3);
			$profile_data = array('activated' => 0);
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Client Account Deactivate Successfully");
			$page='clients/view/'.$user_id;
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
			$this->session->set_flashdata('message', "Client Account Activate Successfully");
			$page='clients/view/'.$user_id;
			redirect($page);
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/activate-account',isset($data) ? $data : NULL);
		}
	}

	public function delete()
	{
		if($this->uri->segment(3))
		{
			$user_id=$this->uri->segment(3);
			$profile_data = array('banned' => 1);
			$this->db->where('id',$user_id)->update('users', $profile_data);
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Client Account Delete Successfully");
			redirect('clients');
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
			$this->session->set_flashdata('message', "Client Account Delete Successfully");
			redirect('clients');
		}
		else
		{
			$data['user_id'] = $this->uri->segment(3);
			$this->load->view('modal/delete-account',isset($data) ? $data : NULL);			
		}

	}

}

/* End of file clients.php */