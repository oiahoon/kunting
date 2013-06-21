<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 一些系统配置 
 * 
 */
class Settings extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->Model('settings_model',"setting");
	}

	/* 团购开关 */
	function groupbuy_s(){
		$result = array('status'=>1);
		if($this->input->post()){
			if(!$this->setting->groupbuyswitch()){
				$result = array('status'=>0);
			}
		}else{
			$result['groupbuy_s'] = $this->setting->getsetting("groupbuy_s");
		}
		echo json_encode($result);die;
	}
}