<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Staff_model extends CI_Model
{
	
	function staffs()
	{
		$query = $this->db->get('bank');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

	function staff_info($id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->join('billing_info','billing_info.user_id = users.id');
		return $this->db->where(array('users.id'=>$id))->get('users')->result(); 
	}

	//Delete one item
	public function delete($table_name, $where)
	{
		return $this->db->where($where)->delete($table_name);
	}
}

/* End of file model.php */