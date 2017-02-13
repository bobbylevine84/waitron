<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AppLib {

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->invoice_table = 'invoices';
		$this->payments_table = 'payments';
		$this->estimates_table = 'estimates';
		$this->milestones_table = 'milestones';
		$this->projects_table = 'projects';
		$this->profile_table = 'account_details';
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

	public function validate_api_key($username,$api_key)
   	 {
   	 	$user_id = $this -> get_any_field('users',array(
														'username'=>$username
														),'id');
		$user_api_key = $this -> get_any_field(config_item('rest_keys_table'),array(
														'user'=>$user_id
														),'api_key');
  		if ($user_api_key == $api_key) {
  			return TRUE;
  		}else{
  			return FALSE;
  		}
	}

	function check_installation(){
		if (is_dir('./install/')) {
			rename('./install','./install.'.rand(5, 1000));
		}
		if (is_dir('./UPDATES/')) {
				rmdir('./UPDATES/');
			 }
	}

	function redirect_to($redirect_url,$response,$message){
			$this -> ci -> session -> set_flashdata('response_status', $response);
			$this -> ci -> session -> set_flashdata('message', $message);
			redirect($redirect_url);
	}

	function allowed_module($module,$username)
   	 {
   	 	$user_id = $this -> get_any_field('users',array('username'=>$username),'id');
   	 	$allowed_modules_json = $this -> get_any_field('account_details',array('user_id'=>$user_id),'allowed_modules');
   	 	if ($allowed_modules_json == NULL) {
   	 		$allowed_modules_json = '{"settings":"permissions"}';
   	 	}
   	 	$allowed_modules = json_decode($allowed_modules_json);
   	 	if ( array_key_exists($module, $allowed_modules) ) {
                     return TRUE;
        }else{
  					return FALSE;
  		}
	}

	function get_gravatar($email){
		$this -> ci-> load -> library('gravatar');
		$gravatar_url = $this -> ci-> gravatar -> get($email);
		return $gravatar_url;
	}

	function project_setting($setting,$project)
   	 {
   	 	$project_settings_json = $this -> get_any_field($this->projects_table,array('project_id'=>$project),'settings');
   	 	if ($project_settings_json == NULL) {
   	 		$project_settings_json = '{"settings":"on"}';
   	 	}
   	 	$project_settings = json_decode($project_settings_json);
   	 	if ( array_key_exists($setting, $project_settings) ) {
                     return TRUE;
        }else{
  					return FALSE;
  		}
	}

	public function invoice_perc($invoice)
   	 {
   	 $invoice_payment = $this->invoice_payment($invoice);
   	 $invoice_payable = $this->invoice_payable($invoice);
   	 if ($invoice_payable < 1 OR $invoice_payment < 1) {
   	 	$perc_paid = 0;
   	 }else{
   	 	$perc_paid = ($invoice_payment/$invoice_payable)*100;
   	 }
		return round($perc_paid);
	}
	public function invoice_payment($invoice)
   	 {
	$this->ci->db->where('invoice',$invoice);
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
  		}
	}

	function calculate($invoice_value,$invoice){
		switch ($invoice_value)
			        {
			            case 'invoice_cost':	
			            	return $this->_invoice_cost($invoice);
			                break;
			            case 'tax':
			                return $this->_invoice_tax_amount($invoice);
			                break;
			            case 'discount':
			                return $this->_invoice_discount($invoice);
			                break;
			            case 'paid_amount':
			                return $this->_invoice_paid_amount($invoice);
			                break;
			            case 'invoice_due':
			                return $this->_invoice_due_amount($invoice);
			                break;
			        }
	}

	function _invoice_cost($invoice){
		$row = $this -> ci -> db -> select_sum('total_cost') -> where('invoice_id',$invoice) -> get('items') -> row();
  		 return $row->total_cost;
	}

	function _invoice_tax_amount($invoice){
		$invoice_cost = $this -> _invoice_cost($invoice);
		$tax = $this -> get_any_field($this->invoice_table, array('inv_id'=>$invoice), 'tax');
		return ($tax/100) * $invoice_cost;
	}
	function _invoice_discount($invoice){
		$invoice_cost = $this -> _invoice_cost($invoice);
		$discount = $this -> get_any_field($this->invoice_table, array('inv_id'=>$invoice), 'discount');
		return ($discount/100) * $invoice_cost;
	}
	function _invoice_paid_amount($invoice){
		$row = $this -> ci -> db -> select_sum('amount') -> where('invoice',$invoice) -> get($this->payments_table) -> row();	
  		 return $row->amount;
	}
	function _invoice_due_amount($invoice){

		$tax = $this -> _invoice_tax_amount($invoice);
		$discount = $this -> _invoice_discount($invoice);
		$invoice_cost = $this -> _invoice_cost($invoice);
		$payment_made = $this -> _invoice_paid_amount($invoice);
		$due_amount =  (($invoice_cost - $discount) + $tax) - $payment_made;
		if($due_amount <= 0){ $due_amount = 0; }
		return $due_amount;
	}

	function est_calculate($estimate_value,$estimate){
		switch ($estimate_value)
			        {
			            case 'estimate_cost':	
			            	return $this->_estimate_cost($estimate);
			                break;
			            case 'tax':
			                return $this->_estimate_tax_amount($estimate);
			                break;
			            case 'discount':
			                return $this->_estimate_discount($estimate);
			                break;
			            case 'estimate_amount':
			                return $this->_estimate_amount($estimate);
			                break;
			        }
	}

	function _estimate_cost($estimate){
		$row = $this -> ci -> db -> select_sum('total_cost') -> where('estimate_id',$estimate) -> get('estimate_items') -> row();
  		 return $row->total_cost;
	}

	function _estimate_tax_amount($estimate){
		$estimate_cost = $this -> _estimate_cost($estimate);
		$tax = $this -> get_any_field($this->estimates_table, array('est_id'=>$estimate), 'tax');
		return ($tax/100) * $estimate_cost;
	}
	function _estimate_discount($estimate){
		$estimate_cost = $this -> _estimate_cost($estimate);
		$discount = $this -> get_any_field($this->estimates_table, array('est_id'=>$estimate), 'discount');
		return ($discount/100) * $estimate_cost;
	}
	function _estimate_amount($estimate){

		$tax = $this -> _estimate_tax_amount($estimate);
		$discount = $this -> _estimate_discount($estimate);
		$estimate_cost = $this -> _estimate_cost($estimate);
		return (($estimate_cost - $discount) + $tax);

	}

	function pro_calculate($project_value,$project){
		switch ($project_value)
			        {
			            case 'project_cost':	
			            	return $this->_project_cost($project);
			                break;
			            case 'project_hours':	
			            	return $this->_project_hours($project);
			                break;
			        }
	}
	function _project_cost($project){
		$project_hours = $this->_project_hours($project);
		$fix_rate = $this -> get_any_field('projects', array('project_id'=>$project), 'fixed_rate' ); 
		$hourly_rate = $this -> get_any_field('projects', array('project_id'=>$project), 'hourly_rate' ); 
			if ($fix_rate == 'No') {
				return $project_hours * $hourly_rate;
			}else{
				return $this -> get_any_field('projects', array('project_id'=>$project), 'fixed_price' ); 
			}
	}
	function _project_hours($project){		
		$task_time = $this->_calculate_task_time($project);
		$project_time = $this->_calculate_project_time($project);		
		$logged_time = ($task_time + $project_time)/3600;
		return round($logged_time,2);
	}

	function _calculate_task_time($project){
		$total_time = "SELECT start_time,end_time,pro_id,
		end_time - start_time time_spent FROM fx_tasks_timer WHERE pro_id = '$project'";
		$res = $this -> ci -> db -> query($total_time)->result();
		$a = array();
		foreach ($res as $key => $t) {
			$a[] = $t->time_spent;
		}
		if(is_array($a)){
			return array_sum($a);
		}else{
			return 0;
		}
		
	}

	function all_outstanding(){
		$invoices = $this -> ci -> db -> get($this->invoice_table) -> result();
		$due[] = array();
		foreach ($invoices as $key => $invoice) {
			$due[] = $this->_invoice_due_amount($invoice->inv_id);
		}
		if(is_array($due)){
			return round(array_sum($due),2);
		}else{
			return 0;
		}
		
	}

	function client_outstanding($user){
		$user_company = $this -> get_any_field($this->profile_table,array('user_id'=>$user),'company');
		$due[] = array();

		$invoices = $this -> ci -> db -> where('client',$user_company) -> get($this->invoice_table) -> result();
		foreach ($invoices as $key => $invoice) {
			$due[] = $this->_invoice_due_amount($invoice->inv_id);
		}
		if(is_array($due)){
			return round(array_sum($due),2);
		}else{
			return 0;
		}
		
	}

	function all_invoice_amount(){
		$invoices = $this -> ci -> db -> get($this->invoice_table) -> result();
		$cost[] = array();
		foreach ($invoices as $key => $invoice) {
		$tax = round($this -> _invoice_tax_amount($invoice->inv_id));
		$discount = round($this -> _invoice_discount($invoice->inv_id));
		$invoice_cost = round($this -> _invoice_cost($invoice->inv_id));

			$cost[] = ($invoice_cost + $tax) - $discount;
		}
		if(is_array($cost)){
			return round(array_sum($cost),2);
		}else{
			return 0;
		}
		
	}


	function task_time_spent($task){
		$total_time = "SELECT start_time,end_time,pro_id,end_time - start_time time_spent 
						FROM fx_tasks_timer WHERE task = '$task'";
		$res = $this -> ci -> db -> query($total_time)->result();
		$a = array();
		foreach ($res as $key => $t) {
			$a[] = $t->time_spent;
		}
		if(is_array($a)){
			return array_sum($a);
		}else{
			return 0;
		}
	}
	function _calculate_project_time($project){
		$total_time = "SELECT start_time,end_time,project,
		end_time - start_time time_spent FROM fx_project_timer WHERE project = '$project'";
		$res = $this -> ci -> db -> query($total_time)->result();
		$a = array();
		foreach ($res as $key => $t) {
			$a[] = $t->time_spent;
		}
		if(is_array($a)){
			return array_sum($a);
		}else{
			return 0;
		}
		
	}

	function cal_milestone_progress($milestone){
		$all_milestone_tasks = $this -> ci -> db -> where('milestone',$milestone) -> get('tasks') -> num_rows();
		$complete_milestone_tasks = $this -> ci -> db -> where(
		                                                       array('task_progress'=>'100',
		                                                             'milestone'=>$milestone
		                                                             )) -> get('tasks') -> num_rows();
		if ($all_milestone_tasks > 0) {
			return round(($complete_milestone_tasks/$all_milestone_tasks) * 100);
		}else{
			return 0;
		}
		
	}
	
	public function total_tax($client = NULL)
   	 {
   	 	$avg_tax = $this->average_tax($client);
		$invoice_amount = $this->get_sum('items','total_cost',array('total_cost >'=>0));
		$tax = ($avg_tax/100) * $invoice_amount;
		return $tax;
	}
	function client_tax($client)
   	 {
   	 	$avg_tax = $this->average_tax($client);
		$invoice_amount = $this->client_payable($client);
		$tax = ($avg_tax/100) * $invoice_amount;
		return $tax;
	}
	function average_tax($client)
   	 {
   	 	$this->ci->db->select_avg('tax');
   	 	if($client != NULL){ $this->ci->db->where('client',$client); }   	 	
		$query = $this->ci->db->get('invoices')->row();
		return $query->tax;
	}
	public function client_paid($client)
   	 {
		$query = $this->ci->db->where('paid_by',$client)->select_sum('amount')->get('payments')->row();
		return $query->amount;
	}
	public function invoice_payable($invoice)
   	 {
	$this->ci->db->select_sum('total_cost');
	$query = $this->ci->db->where('invoice_id',$invoice)->get('items');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->total_cost;
  		}
	}

	public function client_invoices($client)
   	 {
	return $this->ci->db->get_where('invoices',array('client' => $client))->result_array();
	}

	function get_any_field($table, $where_criteria, $table_field) {
	$query = $this -> ci -> db -> select($table_field) -> where($where_criteria) -> get($table);
		if ($query->num_rows() > 0)
			{
  		 		$row = $query -> row();
  		 		return $row -> $table_field;
  			}
	}

	function payment_status($invoice) {
		$tax = $this -> _invoice_tax_amount($invoice);		
		$discount = $this -> _invoice_discount($invoice);
		$invoice_cost = $this -> _invoice_cost($invoice);
		$payment_made = round($this->_invoice_paid_amount($invoice),2);
		$due = round(((($invoice_cost - $discount) + $tax) - $payment_made));

		if($payment_made < 1){
			return lang('not_paid');
		}elseif ($due <= 0) {
			return lang('fully_paid');
		}else{
			return lang('partially_paid');
		}
	}

	function get_time_spent($seconds){
		$minutes = $seconds/60;
		$hours = $minutes/60;
		if ($minutes >= 60) {
			return round($hours,2).' '.lang('hours');
		}elseif($seconds > 60){
			return round($minutes,2).' '.lang('minutes');
		}else{
			return $seconds.' '.lang('seconds');
		}
	}

	public function client_payable($client)
   	 {
   	 	$this->ci->db->join('invoices','invoices.inv_id = items.invoice_id');
		$this->ci->db->select_sum('total_cost');
		$this->ci->db->where('client', $client);
		$query = $this->ci->db->get('items');
		if ($query->num_rows() > 0)
			{
  		 	$row = $query->row();
  		 	$sum_total = $row->total_cost;
  		 	return $sum_total;
  		}else{
  			return 0;
  		}
	}

	public function estimate_payable($estimate)
   	 {
	$query = $this->ci->db->where('estimate_id',$estimate)->select_sum('total_cost')->get('estimate_items');
  	$row = $query->row();
  	return $row->total_cost;
	}
	public function average_monthly_paid($month)
   	 {
   	 $month_paid = $this->monthly_payment($month);
   	 $amount_paid = $this->total_payments();
   	 if ($amount_paid == 0 OR $month_paid == 0) {
   	 	$perc_paid = 0;	
  		 return $perc_paid;
   	 }else{
   	 $perc_paid = ($month_paid/$amount_paid)*100;	
  		 return round($perc_paid);
  		}
	}
	public function monthly_payment($month)
   	 {
	$this->ci->db->where('month_paid',$month);
	$this->ci->db->where('year_paid',date('Y'));
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
  		}
	}
	function project_hours($project){
		$task_time = $this->get_sum('tasks','logged_time',array('project'=>$project));
		$project_time = $this->get_sum('projects','time_logged',array('project_id'=>$project));
		$logged_time = ($task_time + $project_time)/3600;
		return $logged_time;
	}
	public function total_payments()
   	 {
	$this->ci->db->select_sum('amount');
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->amount;
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

	function generate_invoice_number() {
	$query = $this -> ci -> db -> select('reference_no') -> get('invoices');
		if ($query->num_rows() > 0)
		{
			$row = $query->last_row();
			$next_number = filter_var($row->reference_no,FILTER_SANITIZE_NUMBER_INT)+1 ;

			if ($next_number < 10000) {
				$next_number = '000'.$next_number;
			}
			return $next_number;
		}else{
			return '0001';
		} 
	}

	function get_project_details($project,$field) {
	$this->ci->db->where('project_id',$project);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('projects');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}

	function estimate_details($estimate,$field) {
	$this->ci->db->where('est_id',$estimate);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('estimates');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}
	function payment_details($pid,$field) {
	$this->ci->db->where('p_id',$pid);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('payments');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
	}
	function company_details($company,$field) {
	$this->ci->db->where('co_id',$company);
	$this->ci->db->select($field);
	$query = $this->ci->db->get('companies');
		if ($query->num_rows() > 0)
			{
  		 $row = $query->row();
  		 return $row->$field;
  		}
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

	public function validate_app()
	{
		$connected = @fsockopen("www.shuleportal.com",80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        $r = $this->remote_get_contents('http://focheck.shuleportal.com/index.php/?code='.config_item('purchase_code').'&iurl='.base_url());
			$details = json_decode($r,true);
        fclose($connected);
        return TRUE;
    }
		return TRUE;
		

			// if(isset($details['buyer'])){
			// 	echo $details['buyer'];
			// }else{
			// 	echo "Not purchased";
			// }
    
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