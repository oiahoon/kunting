<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adonice extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->Model('admin_model');
		$this->load->Model('settings_model');
	}
	public function index()
	{	
		$data['admin_group'] = $this->admin_model->get_admin_group();
		$data['side_current_id'] = 1;
		session_start();
		if(!$this->session->userdata('login')){
			$data['title']['top'] = "后台登陆";
			$data['title']['small'] = "(此页暂时为空)";
			$this->load->view('login_button',$data);
			//redirect("/admin/login");
		}else{
			$this->load->Model("post_model");
			$data['top_article'] = $this->post_model->gettopbytype(1);
			$data['settings'] = $this->settings_model->getsetting();
			$data['title']['top'] = "后台首页";
			$data['title']['small'] = "(此页暂时为空)";
			$this->load->view('empty',$data);
			//$this->load->view('admin/product_list',$data);
		}
	}
	
	/* 系统设置 */
	function systemsetting(){
		$viewdata = array(
			'title' => array('top' => "系统配置",
							'small' => "(系统的一些配置信息)"),
			'systemsetting' => $this->settings_model->getsetting(),
			);
		if($this->input->post()){
			$params = $this->input->post();
			foreach ($params as $key => $value) {
				$this->settings_model->save(array('key'=>$key,'value'=>$value));
			}
			redirect("adonice/systemsetting", "refresh");
		}
		$viewdata['side_current_id'] = 6;
		$this->load->view('systemsetting', $viewdata);
	}

	/*
		bach create shorten url of posts
	 */
		function shorten_all_posts()
		{
			$this->load->Model('post_model');
			$articles = $this->post_model->getAllPost();
			//print_r($articles);die;
			foreach ($articles as $row) {
				$short_link = $this->url_to_short(base_url('v/'.$row->id));
				$this->post_model->putShortLinkById($row->id,$short_link);
				sleep(2);
			}
			
		}
	/**
	 *  短链
	 *
	 *
	 */
	 function short_url($long_url = ''){
	 	$result['status'] = 1;
		if($this->input->get_post("url")) $url = $this->input->get_post('url');
		/*
		$api_ = "http://open.t.qq.com/api/short_url/shorten";
		$params = array(
			"format" => "json",	//返回格式
			"appid" => "801378227",	//appid
			"openid" => "A697394BC7D6D84D3E92BF3BBF3DCBA0",	//
			"openkey" => "4A98F802B453D6E06E6E08A68615BB8F",
			//"clientip" => "125.69.143.247",
			"reqtime" => time(),
			"wbversion" => "1",
			//"pf" => "php-sdk2.0beta",
			"sig" => "mwOsYxY27uo3lIUE/5k0qHbZ/Nw="
		);
		*/
		$api_ = "http://jucelin.com/lab/short.php";
		$params['type'] = $this->input->get_post('type');
		$result['origin_url'] = $params['url'] = $url;
		$temp = array();
		foreach($params as $key => $value){
			$temp[] = $key."=".$value;
		}
		$query_string = '?'.implode("&",$temp);
		$api_full_url = $api_.$query_string;

		$result['data'] = file_get_contents($api_full_url);
		yaoprint($result,$this->input->get_post('format'));die;
	 }
	 /* shorten a url ,get the short one */
	 function url_to_short($long_url)
	 {
	 	$api_ = 'http://jucelin.com/lab/short.php?type=1&url='.$long_url;
	 	return file_get_contents($api_);
	 }
	 /* shorten by own api of weibo */
	 function shorten(){
		$this->load->library('Snoopy');
	 	if($this->input->get_post('url')) {
	 		$url = $this->input->get_post('url');
	 		$api_ = "http://api.weibo.com/2/short_url/shorten.json";
			$params = array(
				"source" => "3366000357",	//appid
				'url_long' => $url
			);
			$api_full_url = $api_.'?source=3366000357&url_long='.$url;
			$this->snoopy->fetch($api_full_url);
			$result['data'] = json_decode($this->snoopy->results,true);
			$result['data']  = json_decode('{"urls":[{"result":true,"url_short":"http://t.cn/h5mwx","url_long":"http://www.baidu.com","type":25}]}',true);
	 	}
	 	yaoprint($result,$this->input->get_post('format'));
	 }
	

}
