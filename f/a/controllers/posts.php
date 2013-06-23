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
		$result['articles'] = $this->articles->getArticlesList($category, $perpage , $page);
		if($result['articles']) $result['status'] = 1;
		yaoprint($result, $this->input->post("format"));
	}

	/* 文章内容 */
	public function articledetail()
	{
		$result['status'] = 0;
		$id = $this->input->post("id") ? $this->input->post("id") : ''; 
		if ($id != '') {
			$result['article'] = $this->articles->getById($id);
			if($result['article']) $result['status'] = 1;
		}
		yaoprint($result, $this->input->post("format"));
	}
}