<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Reports_model extends CI_Model
{
	
	function workers()
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where(array('user_type'=>'Worker'))->order_by('created','desc')->get('users')->result();
	}

	
	function workersinfo($id)
	{
		$query = $this->db->where('id',$id)->get('bank');
		if ($query->num_rows() > 0){
			return $query->result();
		} 
	}

	//Delete one item
	public function delete($table_name, $where)
	{
		return $this->db->where($where)->delete($table_name);
	}
}

/* End of file model.php */