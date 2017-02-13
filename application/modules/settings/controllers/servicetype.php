<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicetype extends MX_Controller {

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
		$this->template->title('Service Type - Settings - '.config_item('company_name'));
		$data['page'] = 'Settings';
		$data['admin_info']=$this->settings_model->admin_info($this->tank_auth->get_user_id());
		$data['servicetype']=$this->db->get('servicetype')->result();
		$this->template->set_layout('users')->build('service-type',isset($data) ? $data : NULL);
	}


	function add()
	{
		if($this->input->post('add'))
		{
			if(file_exists($_FILES['userfile']['tmp_name']) || is_uploaded_file($_FILES['userfile']['tmp_name'])) 
			{
				$servicetype=array(
					'servicetype'=>$this->input->post('servicetype'),
					'serviceicon'=>'',
					'createby'=>$this->input->post('createby'),
					'created'=>date('Y-m-d H:i:s')
					);

				if($this->db->insert('servicetype',$servicetype))
				{
					$id=$this->db->insert_id();

					$config['upload_path'] = './resource/service/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['file_name'] = strtoupper('SERVICE-ICON-'.$id);
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload())
					{
						$this->session->set_flashdata('response_status', 'error');
						$this->session->set_flashdata('message','Service Icon Upload Error');
						redirect('settings/servicetype');
					}
					else
					{
						$data = $this->upload->data();
						$servicedata=array('serviceicon'=>$data['file_name']);
						
						if($this->db->where('servicetypeid',$id)->update('servicetype',$servicedata))
						{
							$this->session->set_flashdata('response_status', 'success');
							$this->session->set_flashdata('message', "Service Type Added Successfully");
							redirect('settings/servicetype');
						}
					}
				}
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Select a Service Icon File');
				redirect('settings/servicetype');
			}
		}
		else
		{
			$data['user_id'] = $this->tank_auth->get_user_id();
			$this->load->view('modal/add-service-type',isset($data) ? $data : NULL);
		}
	}

	function update()
	{
		if($this->input->post('update'))
		{
			$id=$this->input->post('servicetypeid');

			if(file_exists($_FILES['userfile']['tmp_name']) || is_uploaded_file($_FILES['userfile']['tmp_name'])) 
			{
				$config['upload_path'] = './resource/service/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['file_name'] = strtoupper('SERVICE-ICON-'.$id);
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$this->session->set_flashdata('response_status', 'error');
					$this->session->set_flashdata('message','Service Icon Upload Error');
					redirect('settings/servicetype');
				}
				else
				{
					$data = $this->upload->data();
					$servicedata=array(
							'servicetype'=>$this->input->post('servicetype'),
							'serviceicon'=>$data['file_name'],
							'modified'=>date('Y-m-d H:i:s')
							);
					
					if($this->db->where('servicetypeid',$id)->update('servicetype',$servicedata))
					{
						$this->session->set_flashdata('response_status', 'success');
						$this->session->set_flashdata('message', "Service Type Update Successfully");
						redirect('settings/servicetype');
					}
				}
				
			}
			else
			{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message','Please Select a Service Icon File');
				redirect('settings/servicetype');
			}
		}
		else
		{
			$servicetypeid=$this->uri->segment(4);
			$data['servicetype']=$this->db->where('servicetypeid',$servicetypeid)->get('servicetype')->result();
			$this->load->view('modal/update-service-type',isset($data) ? $data : NULL);

		}
	}

	function delete($id)
	{
		$deleteUT=$this->db->where('servicetypeid', $id)->delete('servicetype');
		if($deleteUT){
			$this->session->set_flashdata('response_status', 'success');
			$this->session->set_flashdata('message', "Service Type deleted successfully.");
			redirect('settings/servicetype');
		}
	}

}

/* End of file servicetype.php */