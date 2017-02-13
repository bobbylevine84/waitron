<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model
{
	function jobList()
	{
		$this->db->where('date',date("Y-m-d"));
		$this->db->where('jobstatus',"upcoming");
		return $this->db->get('job')->result();
	}
}

/* End of file model.php */