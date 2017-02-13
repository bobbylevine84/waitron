<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Clients_model extends CI_Model
{
	
	function add_client($users, $user_info, $billing_info, $activated = TRUE)
	{
		/////// Worker Login Informaion////////////
		$users['created'] = date('Y-m-d H:i:s');
		$users['activated'] = $activated ? 1 : 0;

		if ($this->db->insert('users', $users)) {
			/////// Worker Informaion///////////
			$user_id = $this->db->insert_id();
			$user_info['cdate'] = $billing_info['cdate'] = date('Y-m-d H:i:s');
			$user_info['user_id'] = $billing_info['user_id'] = $user_id;
			if ($this->db->insert('user_info', $user_info) && $this->db->insert('billing_info', $billing_info) )
			{
			return $user_id;
			}
		}
		return NULL;
	}

	function all_clients($sortby,$order,$type)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where('user_type','Client');
        $this->db->where('banned','0');
		if($type=='sort')
        {
        	$this->db->order_by($sortby,$order);
        } else {
        	$this->db->like($sortby,$order);
        	$this->db->order_by('user_id','asc');
        }
		return $this->db->get('users')->result();
	}

	function clients()
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		return $this->db->where('user_type','Client')->where('banned','0')->order_by('user_id','desc')->get('users')->result();
	}

	function fetch_clients($limit, $start,$sortby,$order,$type) 
	{
        $this->db->join('user_info','user_info.user_id = users.id');
        $this->db->where('user_type','Client');
        $this->db->where('banned','0');
        if($type=='sort')
        {
        	$this->db->order_by($sortby,$order);
        } else {
        	$this->db->like($sortby,$order);
        	$this->db->order_by('user_id','asc');
        }
        $query = $this->db->limit($limit, $start)->get('users');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   	}

	public function fetch_clients_count($sortby,$order,$type) 
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where('user_type','Client');
        $this->db->where('banned','0');
		if($type!='sort')
		{
			$this->db->like($sortby,$order);
		}
        return $this->db->get('users')->num_rows();
    }

	
	function client_info($id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->join('billing_info','billing_info.user_id = users.id');
		return $this->db->where(array('users.id'=>$id))->get('users')->result(); 
	}

	function active_clients()
	{
		$query = $this->db->where('activated','1')->where('user_type','Client')->where('banned','0')->get('users');
		if ($query->num_rows() > 0){
			return $query->num_rows();
		}
		else
		{
			return $query->num_rows();
		}
	}

	function total_clients()
	{
		$query = $this->db->where('user_type','Client')->where('banned','0')->get('users');
		if ($query->num_rows() > 0){
			return $query->num_rows();
		}
		else
		{
			return $query->num_rows();
		}
	}

	function update_avatar($filename,$user_id)
	{
		$data = array(
			'avatar'	=> $filename,
		);
		$this->db->where('user_id',$user_id)->update('user_info', $data);
		return TRUE;
	}

	//Delete one item
	public function delete($table_name, $where)
	{
		return $this->db->where($where)->delete($table_name);
	}
}

/* End of file model.php */