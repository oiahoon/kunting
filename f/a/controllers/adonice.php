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
	{	//pushit("xxxxxxxxx");
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
		batch create shorten url of posts
	 */
	function shorten_all_posts(){
		$this->load->Model('post_model');
		$articles = $this->post_model->getAllPost();
		foreach ($articles as $row) {
			$short_link = short_url(base_url('v/'.$row->id));
			$this->post_model->putShortLinkById($row->id,$short_link);
			//sleep(2);
		}
		
	}

	 /* shorten by own api of weibo 用于接口测试 */
	 function shorten(){
	 	if($this->input->get_post('url')) {
	 		$url = $this->input->get_post('url');
	 		$api_ = "http://api.weibo.com/2/short_url/shorten.json";
			$api_full_url = $api_.'?source=2855687947&url_long='.urlencode($url);

			$result = json_decode(vpost($api_full_url),true);
			//$result['data']  = json_decode('{"urls":[{"result":true,"url_short":"http://t.cn/h5mwx","url_long":"http://www.baidu.com","type":25}]}',true);
	 	}
	 	yaoprint($result,$this->input->get_post('format'));
	 }
	
}
