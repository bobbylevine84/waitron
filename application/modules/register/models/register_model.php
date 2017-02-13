<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Register_model extends CI_Model
{
	
	function create_staff($users, $user_info,$billing_info, $activated = FALSE)
	{
		/////// Worker Login Informaion////////////
		$users['created'] = date('Y-m-d H:i:s');
		$users['activated'] = $activated ? 1 : 0;

		if ($this->db->insert('users', $users)) {
			/////// Worker Informaion///////////
			$user_id = $this->db->insert_id();
			$user_info['cdate'] = $billing_info['cdate'] = date('Y-m-d H:i:s');
			$user_info['user_id'] = $billing_info['user_id'] = $user_id;
			if ($this->db->insert('user_info', $user_info) && $this->db->insert('billing_info', $billing_info))
			{
				$this->db->insert('staff_schedule',array('staffid'=>$user_id,'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
				$this->db->insert('default_schedule',array('staffid'=>$user_id,'cdate'=>date('Y-m-d H:i:s'),'udate'=>date('Y-m-d H:i:s')));
				return array('user_id' => $user_id);
			}
		}
		return NULL;
	}

	function create_client($users, $user_info, $billing_info, $activated = FALSE)
	{
		/////// Worker Login Informaion////////////
		$users['created'] = date('Y-m-d H:i:s');
		$users['activated'] = $activated ? 1 : 0;

		if ($this->db->insert('users', $users)) {
			/////// Worker Informaion////////////
			$user_id = $this->db->insert_id();
			$user_info['cdate'] = date('Y-m-d H:i:s');
			$user_info['cdate'] = $billing_info['cdate'] = date('Y-m-d H:i:s');
			$user_info['user_id'] = $billing_info['user_id'] = $user_id;
			if ($this->db->insert('user_info', $user_info) && $this->db->insert('billing_info', $billing_info))
			{
			return array('user_id' => $user_id);
			}
		}
		return NULL;
	}

}

/* End of file model.php */