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
		if(strtolower($_POST['format']) == 'json'){
			echo json_encode($result);
		}
		else{
			print_r($result);
		}
		die;
		
	}

}