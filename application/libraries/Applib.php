<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AppLib {

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}

	public function count_table_rows($table)
    {
		$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0)
			{
  		 return $query->num_rows();
  		}else{
  			return 0;
  		}
	}

	function redirect_to($redirect_url,$response,$message){
			$this -> ci -> session -> set_flashdata('response_status', $response);
			$this -> ci -> session -> set_flashdata('message', $message);
			redirect($redirect_url);
	}


	function get_any_field($table, $where_criteria, $table_field) {
	$query = $this -> ci -> db -> select($table_field) -> where($where_criteria) -> get($table);
		if ($query->num_rows() > 0)
			{
  		 		$row = $query -> row();
  		 		return $row -> $table_field;
  			}
	}

	public function generate_string()
   	 {
   	 $this->ci->load->helper('string');
   	 return random_string('nozero', 7);
	}
	function prep_response($response){
		return json_decode($response,TRUE);
	}

	
	function count_rows($table,$where)
	{
		$this->ci->db->where($where);
		$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0){
			return $query->num_rows();
		} else{
			return 0;
		}
	}
	function get_sum($table,$field,$where)
	{
		$this->ci->db->where($where);
		$this->ci->db->select_sum($field);
		$query = $this->ci->db->get($table);
		if ($query->num_rows() > 0){
		$row = $query->row();
  		 return $row->$field;
		} else{
			return 0;
		}
	}

	function get_time_diff($from , $to){
	$diff = abs ( $from - $to );
	$years = $diff/31557600;
	$months = $diff/2635200;
	$weeks = $diff/604800;
	$days = $diff/86400;
	$hours = $diff/3600;
	$minutes = $diff/60;
	if ($years > 1) {
		$duration = round($years) .lang('years');
	}elseif ($months > 1) {
		$duration = round($months) .lang('months');
	}elseif ($weeks > 1) {
		$duration = round($weeks) .lang('weeks');
	}elseif ($days > 1) {
		$duration = round($days).lang('days');
	}elseif ($hours > 1) {
		$duration = round($hours) .lang('hours');
	} else {
		$duration = round($minutes) .lang('minutes');
	}
	
	return $duration;
	}

	function remote_get_contents($url)
	{
        if (function_exists('curl_get_contents') AND function_exists('curl_init'))
        {
                return $this->ci->curl_get_contents($url);
        }
        else
        {
                return file_get_contents($url);
        }
	}

	function curl_get_contents($url)
	{
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HEADER, 0);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        $output = curl_exec($ch);
	        curl_close($ch);
	        return $output;
	}

	function addOrdinalNumberSuffix($num) {
      switch ($num) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    return $num.'th';
  }
  
}

/* End of file User_prof.php */