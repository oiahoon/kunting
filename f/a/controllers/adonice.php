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
	}
	public function index()
	{	
		$data['admin_group'] = $this->admin_model->get_admin_group();
		session_start();
		if(!$this->session->userdata('login')){
			$data['title']['top'] = "后台登陆";
			$data['title']['small'] = "(此页暂时为空)";
			$this->load->view('login_button',$data);
			//redirect("/admin/login");
		}else{
			$this->load->Model("post_model");
			$data['top_article'] = $this->post_model->gettopbytype(1);
			$data['title']['top'] = "后台首页";
			$data['title']['small'] = "(此页暂时为空)";
			$this->load->view('empty',$data);
			//$this->load->view('admin/product_list',$data);
		}
	}
	
	/**
	 *  短链
	 *
	 *
	 */
	 function short_url($long_url = ''){
		if($this->input->get("long_url")) $long_url = $this->input->get("long_url");
		$api_ = "http://open.t.qq.com/api/short_url/shorten";
		$params = array(
			"format" => "json",	//返回格式
			"appid" => "801058005",	//appid
			"openid" => "A697394BC7D6D84D3E92BF3BBF3DCBA0",	//
			"openkey" => "4A98F802B453D6E06E6E08A68615BB8F",
			//"clientip" => "125.69.143.247",
			"reqtime" => time(),
			"wbversion" => "1",
			//"pf" => "php-sdk2.0beta",
			"sig" => "mwOsYxY27uo3lIUE/5k0qHbZ/Nw="
		);

		$params['long_url'] = $long_url;
		$temp = array();
		foreach($params as $key => $value){
			$temp[] = $key."=".$value;
		}
		$query_string = '?'.implode("&",$temp);
		$api_full_url = $api_.$query_string;

		$result = json_decode( file_get_contents($api_full_url));

		echo "http://url.cn/".$result->data->short_url;
	 }
	

}
