<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {
	
	/**
	  *	用户的添加
	  *	无需登录的 用户团购参团 活动报名 等方式
	  */
	function __construct(){
		parent::__construct();
		$this->load->Model('members_model');	
	}
	
	//固件管理首页
	function index(){
	$this->load->helper('form');
		$this->load->view('addmember');
	}

	
	
	//用户添加
	function memberAdd(){
		$result['status'] = 0;
		if (!$this->memberUnique()) {
			if($this->input->post()){
				if($this->members_model->insertOne()){
					$result['status'] = 1; 
					$result['msg'] = "恭喜你,报名成功.";
				}
			}
		}
		else{
			$result['msg'] = "用户已经参加过本活动";
		}
		$format = ($this->input->post("format")) ? $this->input->post("format") : 'json';
		switch (strtolower($format)){
				case 'array':
					print_r($result);
				break;
				default:
					echo json_encode($result);
			}
		die;
	}
	/*
	 * 用户重复判断
	 * email - objectid
	 * phone - objectid
	 * 为不重复索引
	 */
	function memberUnique(){
		$member = array(
			'phone' => $this->input->post('phone'),
			'objectid' => $this->input->post('objectid'),
		);
		if($this->members_model->getByPhoneAndObj($member))return true;
		else return false;
		
	}
	//用户编辑
	function memberEdit(){}


	//用户删除 
	function membereDel(){}

	
}// end fo class

?>
