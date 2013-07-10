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
			'title' => array('top' => '','small' => $data['title']),
			'ctl' => "sharepage",
			'share' => $data,
			);
		$this->load->view('sharepage',$viewdata);
	}

	/* 文章查看页面 */
	function view(){
		$viewdata['title'] = array('top' => "",'small' => "没有找到该文章");
		$id = $this->uri->segment(2) ? $this->uri->segment(2) : $this->uri->segment(4);
		if(is_numeric($id)){
			$data = $this->articles->getById($id);
			$viewdata = array( 
				'title' => array('top' => '','small' => $data['title']),
				'post' => $data,
				);
		}
		$this->load->view('viewpost',$viewdata);
	}

	function post2json()
	{
		$data['status'] = 0;
		$id_ext = $this->uri->segment(2);
		list($id, $ext) = explode(".",$id_ext);
		if($id){
			$data['content'] = $this->articles->getById($id, true);
			if($data['content']){
				$data['status'] = 1;
				$data['type'] = $this->articles->getTypeAlias($data['content']->category_id);
			};
		}
		switch ($ext) {
			case 'json':
				echo json_encode($data);
				break;
			
			default:
				# code...
				break;
		}
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
				$result = pushit(str_replace('\u','\\\u',json_encode($data)));
			}
			else $result['status'] = 0 ;
		}
		echo $result['status'] ;
	}

	/**
		推送，ios推送字数限制，改成推url，然后从url取json 	
	*/
	public function push_new()
	{
		$id = $this->uri->segment(3);
		if($id){
			// ios
			$result['ios'] = $this->push_ios($id);
			//android
			//$result['android'] = $this->push_android($id);
		}
		echo json_encode($result);
	}

	private function push_ios($id)
	{
		$path = 'v';
		$ios['title'] = 'posts';
		$ios['content'] = base_url($path.'/'.$id.".json");
		$ios['pName'] = "com.nervenets.kuntingandroid";
		$ios['cName'] = "com.nervenets.kuntingandroid.Main";
		$result['ios'] = pushit(json_encode($ios), 2, 'ios');
		$result['android'] = pushit(json_encode($ios), 1, 'android');
		return $result;
	}
	private function push_android($id)
	{
		$android['content'] = $this->articles->getById($id, true);
		if($android['content']){
			$android['type'] = $this->articles->getTypeAlias($android['content']->category_id);
			return pushit(str_replace('\u','\\\u',json_encode($android)), 1, 'android' );
		}
	}
}
