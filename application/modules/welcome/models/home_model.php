<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 * @author	William M
 */
class Home_model extends CI_Model
{
	function recent_activities($limit)
	{
		return $this->db->order_by('activity_date','DESC')->get('activities',$limit)->result();
	}

	function active_staffs()
	{
		$this->db->where('activated','1');
		$this->db->where('pstatus','2');
		$this->db->where('user_type','Staff');
		return $this->db->get('users')->num_rows();
	}

	function pending_staffs()
	{
		$this->db->where('pstatus','0');
		$this->db->where('activated','1');
		$this->db->where('user_type','Staff');
		return $this->db->get('users')->num_rows();
	}

	function active_clients()
	{
		$this->db->where('activated','1');
		$this->db->where('user_type','Client');
		return $this->db->get('users')->num_rows();
	}

	function real_time_active_jobs()
	{
		$this->db->where('date',date("Y-m-d"));
		$this->db->where('jobstatus','running');
		return $this->db->get('job')->num_rows();
	}

	function total_jobs_completed()
	{
		$this->db->where('jobstatus','complete');
		return $this->db->get('job')->num_rows();
	}

	function gross_revenue()
	{
		return 0;
	}
}

/* End of file model.php */