<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	/**
	 * 用户反馈controller
	 *
	 */
	function __construct(){
		parent::__construct();
		$this->load->Model('feedback_model','feedback');
	}

	function index(){
		$viewdata = array( 
			'title' => array('top' => '用户反馈','small' => ''),
			);
		$viewdata['side_current_id'] = 5;
		$this->load->view('feedbacks',$viewdata);
	}

	function feedback(){
		$result['status'] = 0;
		$result['msg'] = "反馈失败";
		$one = array(
			'username' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'content' => $this->input->post('content'),
			'version' => $this->input->post('version'),
			'created_at' => date("Y-m-d H:i:s"),
		);
		if($this->feedback->insert($one)){
			$result['status'] = 1;
			$result['msg'] = "谢谢反馈";
		}
		yaoprint($result,$this->input->post('format'));
	}
	/* 为反馈列表提供数据 */
	function feedbacks_dataTable(){	
		$result  = $this->feedback->getfeedbacks();
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][0] = $value['id'];
			$result['aaData'][$key][1] = $value['username'];
			$result['aaData'][$key][2] = $value['email'];
			$result['aaData'][$key][3] = $value['phone'];
			$result['aaData'][$key][4] = $value['content'];
			$result['aaData'][$key][5] = $value['version'];
			$result['aaData'][$key][6] = $value['created_at'];
		}
		unset($result["aaaData"]);
		echo json_encode($result);
	}
}