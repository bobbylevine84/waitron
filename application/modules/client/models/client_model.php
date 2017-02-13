<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model
{
	
	function client_info($user_id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where(array('user_type'=>'Client','user_id'=>$user_id));
		return $this->db->get('users')->result();
	}

	function update_avatar($filename,$user_id)
	{
		$data = array(
			'avatar'	=> $filename,
		);
		$this->db->where('user_id',$user_id)->update('user_info', $data);
		return TRUE;
	}

	//////////////////////////// For Dashboard ////////////////////////////////
	function active_staffs()
	{
		$this->db->where('pstatus','2');
		$this->db->where('banned','0');
		$this->db->where('user_type','Staff');
		return$this->db->get('users')->num_rows();;
	}

	function standby_staffs()
	{
		$this->db->where('standby','0');
		$this->db->where('pstatus','2');
		$this->db->where('banned','0');
		$this->db->where('user_type','Staff');
		return$this->db->get('users')->num_rows();;
	}

	////////// Jobs ///////////////////
	function getjob($jobid)
	{
		$this->db->join('job_services','job_services.jobid = job.jobid');
		$this->db->where('job.jobid',$jobid);
		return $this->db->get('job')->result();
	}

	function realTimeJobCount($user_id)
	{
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('jobstatus','running');
		$this->db->where('createdby',$user_id);
		return $this->db->get('job')->num_rows();
	}

	function activeStaffCount()
	{
		$this->db->where('user_type','Staff');
		$this->db->where('activated','1');
		$this->db->where('pstatus','2');
		$this->db->where('banned','0');
		return $this->db->get('users')->num_rows();
	}

	function upcomingJobCount($user_id)
	{
		$this->db->where('jobstatus','upcoming');
		$this->db->where('date >=',date('Y-m-d'));
		$this->db->where('createdby',$user_id);
		return $this->db->get('job')->num_rows();
	}

	function getActiveJobs($user_id)
	{
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('jobstatus','running');
		$this->db->order_by('date','ASC');
		$this->db->where('createdby',$user_id);
		return $this->db->get('job')->result();
	}

	function getUpcomingJobs($user_id)
	{
		$this->db->where('jobstatus','upcoming');
		$this->db->where('date >=',date('Y-m-d'));
		$this->db->order_by('date','ASC');
		$this->db->where('createdby',$user_id);
		return $this->db->get('job')->result();

	}

	
}

/* End of file model.php */