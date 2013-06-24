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


	/* 团购开关 & return current groupbuy status */
	function groupbuy_s(){
		$result = array('status'=>1);
		$thispost = $this->input->post();
		if(isset($thispost['groupbuy_s'])){
			if(!$this->setting->groupbuyswitch()){
				$result = array('status'=>0);
			}
		}else{
			$result['groupbuy_s'] = $this->setting->getsetting("groupbuy_s");
		}
		yaoprint($result,$this->input->post('format'));die;
	}

	/* get the Settings status by key , if no key ,then return all settings assoc_array*/
	function getSettingByKey($key = ''){
		return $this->setting->getSetting($key);
	}
}