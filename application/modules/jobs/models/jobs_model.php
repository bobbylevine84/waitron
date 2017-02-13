<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Jobs_model extends CI_Model
{
	
	function workers()
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where(array('user_type'=>'Worker'))->order_by('created','desc')->get('users')->result();
	}

	function clients()
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where(array('user_type'=>'Client'))->order_by('firstname','asc')->get('users')->result();
	}

	
	function workersinfo($id)
	{
		$query = $this->db->where('id',$id)->get('bank');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

	function active_staffs()
	{
		$query = $this->db->where('standby','1')->where('user_type','Staff')->get('users');
		if ($query->num_rows() > 0){
			return $query->num_rows();
		}
		else
		{
			return $query->num_rows();
		}
	}

	//Delete one item
	public function delete($table_name, $where)
	{
		return $this->db->where($where)->delete($table_name);
	}

	function getjob($jobid)
	{
		$this->db->join('job_services','job_services.jobid = job.jobid');
		$this->db->where('job.jobid',$jobid);
		return $this->db->get('job')->result();
	}

	function realTimeJobCount()
	{
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('jobstatus','running');
		return $this->db->get('job')->num_rows();
	}

	function staffStandByCount()
	{
		$this->db->where('user_type','Staff');
		$this->db->where('standby','0');
		$this->db->where('activated','1');
		$this->db->where('banned','0');
		return $this->db->get('users')->num_rows();
	}

	function upcomingJobCount()
	{
		$this->db->where('jobstatus','upcoming');
		$this->db->where('date >=',date('Y-m-d'));
		return $this->db->get('job')->num_rows();
	}

	function getActiveJobAddress()
	{
		$this->db->where('jobstatus','running');
		$this->db->where('date',date('Y-m-d'));
		$this->db->order_by('date','ASC');
		return $this->db->get('job')->result();
	}
	
	function getActiveJobs()
	{
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('jobstatus','running');
		$this->db->order_by('date','ASC');
		return $this->db->get('job')->result();
	}

	function getUpcomingJobs()
	{
		$this->db->where('jobstatus','upcoming');
		$this->db->where('date >=',date('Y-m-d'));
		$this->db->order_by('date','ASC');
		return $this->db->get('job')->result();
	}
}

/* End of file model.php */