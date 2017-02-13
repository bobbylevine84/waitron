<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package	Freelancer Office
 */
class Staffs_model extends CI_Model
{
	
	function add_staff($users, $user_info, $billing_info, $activated = TRUE)
	{
		/////// Staff Login Informaion////////////
		$users['created'] = date('Y-m-d H:i:s');
		$users['activated'] = $activated ? 1 : 0;

		if ($this->db->insert('users', $users)) {
			/////// Staff Informaion///////////
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

	function all_staffs($sortby,$order,$type)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where(array('user_type'=>'Staff'));
		$this->db->where('banned','0');
		$this->db->where('pstatus','2');
		if($type=='sort')
        {
        	$this->db->order_by($sortby,$order);
        } else {
        	$this->db->like($sortby,$order);
        	$this->db->order_by('user_id','asc');
        }
		return $this->db->get('users')->result();
	}

	public function fetch_staffs($limit, $start,$sortby,$order,$type) 
	{
        $this->db->join('user_info','user_info.user_id = users.id');
        $this->db->where('user_type','Staff');
        $this->db->where('banned','0');
        $this->db->where('pstatus','2');
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

	public function staffs_record_count($sortby,$order,$type) 
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where(array('user_type'=>'Staff'));
		$this->db->where('banned','0');
		if($type!='sort')
		{
			$this->db->like($sortby,$order);
		}
        return $this->db->get('users')->num_rows();
    }

	function staff_info($id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->join('billing_info','billing_info.user_id = users.id');
		return $this->db->where(array('users.id'=>$id))->get('users')->result(); 
	}

	function update_avatar($filename,$user_id)
	{
		$data = array(
			'avatar'	=> $filename,
		);
		$this->db->where('user_id',$user_id)->update('user_info', $data);
		return TRUE;
	}

	function pending_staffs_count()
	{
		$query = $this->db->where('pstatus','0')->where('user_type','Staff')->get('users');
		if ($query->num_rows() > 0){
			return $query->num_rows();
		}
		else
		{
			return $query->num_rows();
		}
	}

	function staffs_captain_request()
	{
		$this->db->where('pstatus','2');
		$this->db->where('user_type','Staff');
		$this->db->where('crequest','Yes');
		return $this->db->get('users')->num_rows();
	}

	function pending_staffs($sortby,$order,$type)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where('user_type','Staff');
		$this->db->where('pstatus','0');
		if($type=='sort')
        {
        	$this->db->order_by($sortby,$order);
        } else {
        	$this->db->like($sortby,$order);
        	$this->db->order_by('user_id','asc');
        }
		return $this->db->get('users')->result();
	}

	function pending_staff_info($id)
	{
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->join('billing_info','billing_info.user_id = users.id');
		$this->db->where(array('users.id'=>$id));
		return $this->db->get('users')->result(); 
	}


	//Delete one item
	public function delete($table_name, $where)
	{
		return $this->db->where($where)->delete($table_name);
	}

	function trash_staffs(){
		$this->db->join('user_info','user_info.user_id = users.id');
		$this->db->where('user_type','Staff');
		$this->db->where('pstatus','1');
		return $this->db->get('users')->result();
	}
	
	function get_trash_records(){
		$query=$this->db->where('pstatus','1')->get('users')->result();
		$id_arr = array();
		$array = json_decode( json_encode($query), true);
		foreach($array as $row)
		{
		    $id_arr[] = $row['id'];
		}
		return $id_arr;
	}
}

/* End of file model.php */