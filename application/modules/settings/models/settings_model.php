<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Settings_model extends CI_Model
{
	
	function admin_info($user_id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where(array('user_type'=>'Admin','user_id'=>$user_id))->get('users')->result();
	}
	
	//insert new role
	function insert_role($newrole){
		$this-> db->insert('roles', $newrole);
		return $this->db->insert_id();
	}
	
	//insert permissions corresponding to role
	function insert_role_permission($roleinfo){
		$this-> db->insert('role_permissions', $roleinfo);
	}
	
	//fetch all permissions name
	function get_permissions(){
		$query = $this->db->get('permissions');
		return $query->result();
	}
	
	// get all roles added by admin
	function get_admin_roles(){
		$query = $this->db->where('r_id !=',1)->get('roles');
		return $query->result();
	}
	
	//insert user created by admin
	function insert_admin_user($newuser){
		$this-> db->insert('users', $newuser);
		return $this->db->insert_id();
	}
	//insert user info created by admin
	function insert_admin_userinfo($userinfo){
		$this-> db->insert('user_info', $userinfo);
	}
	
	// get all users created by admin
	function get_admin_users(){
		$this->db->join('user_info','user_info.user_id = users.id');
		$query = $this->db->where(array('user_type'=>'Admin', 'role_id !='=> 1))->get('users');
		return $query->result();
	}
	
	//get single role data by role id
	function get_role_data($role_id){
		$query = $this->db->where('role_id',$role_id)->get('role_permissions');
		return $query->result();
	}
	
	//delete role data at updation time
	function delete_role_data($role_id){
		$this->db->where('role_id',$role_id);
		$this->db->delete('role_permissions');
	}
	
	//update role permissions
	function check_role_permission($roleid,$permission,$roleinfo){
		//update role name
		$this->db->set('role',$roleinfo['role'] );
		$this->db->set('udate',date('Y-m-d H:i:s'));
		$this->db->where('r_id', $roleid);
		$this->db->update('roles');
		//insert role permission if not exist
		$query= $this->db->where(array('role_id'=>$roleid,'permission_id'=>$permission))->get('role_permissions');
		if ($query->num_rows() == 0){
			$this->db->insert('role_permissions', $roleinfo);
		}
	}
	
	//delete role by id
	function delete_role($roleid){
		$this->db->where('r_id', $roleid);
		$this->db->delete('roles');
		$this->db->where('role_id', $roleid);
		$this->db->delete('role_permissions');
	}
	
	//delete user by id
	function delete_user($userid){
		$this->db->where('id', $userid);
		$this->db->delete('users');
		$this->db->where('user_id', $userid);
		$this->db->delete('user_info');
	}
	
	// get admin user data by user id
	function get_user_data($user_id){
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where('user_id', $user_id)->get('users')->result();
	}
	
	//update user data by user id
	function update_userinfo($updateuser,$updateuserinfo,$user_id){
		$this->db->where('id',$user_id)->update('users', $updateuser);
		$this->db->where('user_id',$user_id)->update('user_info', $updateuserinfo);
		return TRUE;
	}
}

/* End of file model.php */