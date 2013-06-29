<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 不需要权限的一些文章函数
 */
class Posts extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->Model('post_model','articles');	
	}

	/* 文章列表 */
	public function articlelists()
	{
		$result['status'] = 0;
		$category = $this->input->post("type") ? $this->input->post("type") : ''; 
		$perpage = $this->input->post('perpage') ? $this->input->post('perpage') : 20; 
		$page = $this->input->post('page') ? $this->input->post('page') : 0;
		$result['data'] = $this->articles->getArticlesList($category, $perpage , $page);
		if($result['data']) $result['status'] = 1;
		yaoprint($result, $this->input->post("format"));
	}

	/* 文章内容 */
	public function articledetail()
	{
		$result['status'] = 0;
		$id = $this->input->post("id") ? $this->input->post("id") : ''; 
		if ($id != '') {
			$result['data'] = $this->articles->getById($id);
			if($result['data']) $result['status'] = 1;
		}
		yaoprint($result, $this->input->post("format"));
	}

	/* 分享页面 */
	function viewpost(){
		$id = $this->uri->segment(2) ? $this->uri->segment(2) : $this->uri->segment(4);
		if($id){
			$data = $this->articles->getById($id);
		}
		//保证取到的是分享
		//if($data['category_id'] != $this->config->item('category')['sharepage']['id']) 
		//	die(json_encode(array('status'=>'0')));
		$viewdata = array( 
			'title' => array('top' => '分享页面','small' => $data['title']),
			'ctl' => "sharepage",
			'share' => $data,
			);
		$this->load->view('sharepage',$viewdata);
	}

	/* 推送 */
	public function push()
	{
		$result['status'] = 0;
		$data = array();
		$id = $this->uri->segment(3);
		if($id){
			$data['content'] = $this->articles->getById($id, true);
			if($data['content']){
				$data['type'] = $this->articles->getTypeAlias($data['content']->category_id);
				$result = pushit(json_encode($data));
			}
			else $result['status'] = 0 ;
		}
		echo $result['status'] ;
	}
}
