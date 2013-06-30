<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{	$viewdata = array(
			
		);
		$this->load->view("test/api",$viewdata);
	}
	public function testresult(){
		
		$result = array(
			'status' => 1,
			'msg' => "this is a test.",
			'license' => $_POST['license'],
		);
		yaoprint($result, $_POST['format']);
		die;
		
	}

	public function push()
	{
		$result ['status'] = 0;
		$content = $this->input->post('content');
		$data['data'] = array('content'=>$content);
		print_r($data);
		echo json_encode($data)."\r\n<br/>";
		$result = pushit(str_replace('\u','\\\u',json_encode($data)));
		yaoprint($result,$this->input->get_post('format'));
	}

}