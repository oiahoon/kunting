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

	function newFeedback(){
		$this->load->library('session');
		$result['status'] = 0;
		$result['msg'] = "反馈失败";
		//间隔大于300秒以上才可以
		if(time() - $this->session->userdata('feedback_at') > 3){
			$one = array(
				'username' => 'feedback',
				'email' => '',
				'phone' => '',
				'contact' => $this->input->post('contact'),
				'content' => $this->input->post('content'),
				'version' => '',
				'created_at' => date("Y-m-d H:i:s"),
			);
			if($this->feedback->insert($one)){
				//发邮件
				$this->load->Model('emailsend_model','emailsend');
				$config = $this->emailsend->getEmailConfig();
				$to = $config['emailusername'];
		 		$title = '用户反馈('.$one['username'].')';
		 		$body = implode('<br/>',$one);
		 		$this->emailsend->sendEmail($config, $to, '', $title,  $body);

				$result['status'] = 1;
				$result['msg'] = "谢谢反馈";
				$sessiondata = array(
	                   'username'  => $this->input->post('name'),
	                   'feedback_at' => time(),
	               );
				$this->session->set_userdata($sessiondata);
			}
		}
		else{
			$result['msg'] = "提交的太频繁,请稍候";
		}
		yaoprint($result,$this->input->post('format'));
	}
	/* 为反馈列表提供数据 */
	function feedbacks_dataTable(){	
		$result  = $this->feedback->getfeedbacks();
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][0] = $value['id'];
			//$result['aaData'][$key][1] = $value['username'];
			//$result['aaData'][$key][2] = $value['email'];
			//$result['aaData'][$key][3] = $value['phone'];
			$result['aaData'][$key][1] = $value['contact'];
			$result['aaData'][$key][2] = $value['content'];
			//$result['aaData'][$key][5] = $value['version'];
			$result['aaData'][$key][3] = $value['created_at'];
		}
		unset($result["aaaData"]);
		echo json_encode($result);
	}
}