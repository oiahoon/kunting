<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simplepush extends CI_Controller {
	
	var $side_current_id = 6;

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(site_url());
		}
		$this->load->Model('push_model','push');	
	}
	
	function index(){
		$viewdata = array( 
			'title' => array('top' => '推送列表','small' => ''),
			'ctl' =>  strtolower( __CLASS__),
			);
		$viewdata['side_current_id'] = $this->side_current_id;
		$this->load->view('pushs',$viewdata);
	}
	
	/* 新增push */
	function new_push() {
		#...
	}
	

	/* 删除一条 */
	function delete(){

	}
	//提供表格ajax数据
	function pushList_dataTable()
	{
		$where = ''; //查询条件
		$result = $this->push->getpushs();
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][] = $value['id'];
			$result['aaData'][$key][] = '<a onclick="ajax_push('.$value['id'].')" title="推送"><button class="orange tiny has_text img_icon"><img src="images/icons/small/white/magic_mouse.png"><span>推送</span></button></a>&nbsp;' . "&lt;".$value['title']."&gt;";
			//$result['aaData'][$key][] = $value['title_2nd'];
			$result['aaData'][$key][] = '推了<em>'.$value['count'].'</em>次';
			$result['aaData'][$key][] = $value['content'];
			$result['aaData'][$key][] = "<font color='red'">$value['last_push_at']."</font></br>".$value['created_at'];
		}
		
		unset($result["aaaData"]);
		echo json_encode($result);
	}

	
}
