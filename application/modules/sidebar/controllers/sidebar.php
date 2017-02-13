<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
**********************************************************************************
* Copyright: gitbench 2014
* Licence: Please check CodeCanyon.net for licence details. 
* More licence clarification available here: htttp://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
* CodeCanyon User: http://codecanyon.net/user/gitbench
* CodeCanyon Project: http://codecanyon.net/item/freelancer-office/8870728
* Package Date: 2014-09-24 09:33:11 
***********************************************************************************
*/

class Sidebar extends MX_Controller {
function __construct()
	{
		parent::__construct();
	}
	public function admin_menu()
	{
		$this->load->view('admin_menu',isset($data) ? $data : NULL);
	}
	public function client_menu()
	{
		$this->load->view('client_menu',isset($data) ? $data : NULL);
	}
	public function staff_menu()
	{
		$this->load->view('staff_menu',isset($data) ? $data : NULL);
	}
	public function scripts()
	{
		$this->load->view('scripts/uni_scripts',isset($data) ? $data : NULL);
	}
	public function flash_msg()
	{
		$this->load->view('flash_msg',isset($data) ? $data : NULL);
	}
}
/* End of file sidebar.php */