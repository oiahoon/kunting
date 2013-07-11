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
		bach create shorten url of posts
	 */
		function shorten_all_posts()
		{
			$this->load->Model('post_model');
			$articles = $this->post_model->getAllPost();
			//print_r($articles);die;
			foreach ($articles as $row) {
				$short_link = $this->short_url(base_url('v/'.$row->id));
				$this->post_model->putShortLinkById($row->id,$short_link);
				//sleep(2);
			}
			
		}
	/**
	 *  短链
	 *  用户后台生成
	 *
	 */
	 function short_url($long_url){
	 	if(empty($long_url)) die;
 		$api_ = "http://api.weibo.com/2/short_url/shorten.json";
		$api_full_url = $api_.'?source=2855687947&url_long='.urlencode($long_url);
		$result = json_decode($this->vpost($api_full_url),true);
		return $result['urls'][0]['url_short'];
	 }
	 /* shorten a url ,get the short one 老版本 */
	 function url_to_short($long_url)
	 {
	 	$api_ = 'http://jucelin.com/lab/short.php?type=1&url='.$long_url;
	 	return file_get_contents($api_);
	 }
	 /* shorten by own api of weibo 用于接口测试 */
	 function shorten(){
	 	if($this->input->get_post('url')) {
	 		$url = $this->input->get_post('url');
	 		$api_ = "http://api.weibo.com/2/short_url/shorten.json";
			$api_full_url = $api_.'?source=2855687947&url_long='.urlencode($url);

			$result = json_decode($this->vpost($api_full_url),true);
			//$result['data']  = json_decode('{"urls":[{"result":true,"url_short":"http://t.cn/h5mwx","url_long":"http://www.baidu.com","type":25}]}',true);
	 	}
	 	yaoprint($result,$this->input->get_post('format'));
	 }
	
	//
	function vpost($url){ // 模拟提交数据函数
    	$curl = curl_init(); // 启动一个CURL会话
	    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($curl, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
	    $tmpInfo = curl_exec($curl); // 执行操作
	    if (curl_errno($curl)) {
	       echo 'Errno'.curl_error($curl);//捕抓异常
	    }
	    curl_close($curl); // 关闭CURL会话
	    return $tmpInfo; // 返回数据
	}

	 /* 发邮件测试 */
	 function emailtest(){
	 	$result['status'] = 0;
	 	$this->load->Model('emailsend_model','emailsend');
	 	$config = $this->emailsend->getEmailConfig();
	 	if(count($config) == 4){
	 		$to = $this->input->post('emailto');
	 		$title = $this->input->post('title');
	 		$body = $this->input->post('content');
	 		$email_result = $this->emailsend->sendEmail($config, $to, '', $title,  $body);
	 		if($email_result == 'true'){
	 			$result['status'] = 1;
	 		}
	 		else{
	 			$result['msg'] = $email_result;
	 			}
	 	}
	 	else{
	 		$result['msg'] = '参数配置不够,请查看后台配置';
	 	}
	 	yaoprint($result,$this->input->post('format'));
	 }
}
