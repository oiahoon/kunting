<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	var $online_gap = 300;//在线间隔 5分钟
	/**
	 * 产品管理
	 *
	 */
	function __construct(){
		parent::__construct();
		$this->load->Model('product_model');	
		$this->load->Model('admin_model');
	}
	
	//产品后台首页
	function index(){
		
	}
	
	/**
		产品列表
		$online 为是否按照在线状态
			'on'在线 'off'离线 'all'全部（默认）
	 */
	function productList($online = "all"){
		$products = $this->product_model->getAll($online);
		foreach($products as $key => $value){
			$products[$key]["type"] = (1==$value["status"])?"正常":"禁用";
			//在线状态转换
			if((time()-$value["online"]) <= $this->online_gap){
				$products[$key]["online"] = "在线";
			}else{
				$products[$key]["online"] = "离线";
			}
			//总在线时长格式转换
			$products[$key]["sum_time"] = $this->rel_time($value["onlinetime"],0);
		}
		switch ($online){
			case "all":$title="所有";break;
			case "on":$title="在线";break;
			case "off":$title="离线";break;
		}
		$viewdata = array(
			'title' => $title."用户列表",
			'products' => $products,
		);
		$viewdata['admin_group'] = $this->admin_model->get_admin_group();
		$this->load->view('admin/product_list', $viewdata);
	}
	
	/**
		产品列表 为jquery dataTable 提供数据
	 */
	function productList_dataTable($online = "all"){
		switch ($online){
			case "all":$where="";break;
			case "on":$where="online >=".time()-$this->online_gap;break;
			case "off":$where="online <".time()-$this->online_gap;break;
		}
		$result = $this->product_model->getProducts2($where,"id");
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][0] = $value['id'];
			$result['aaData'][$key][1] = $value['android_id'];
			$result['aaData'][$key][2] = (1==$value["status"])?"正常":"禁用";
			$result['aaData'][$key][3] = $value['login_time'];
			//在线状态转换
			if((time()-$value["online"]) <= $this->online_gap){
				$result['aaData'][$key][4] = "在线";
			}else{
				$result['aaData'][$key][4] = "离线";
			}
			
			//总在线时长格式转换
			$result['aaData'][$key][5] = $this->rel_time($value["onlinetime"],0);
			if($value['status']==1){
				$result['aaData'][$key][6] = '<a href="index.php/product/product/kickUser/'.$value['id'].'"><font color="red">禁用</font></a>';
			}else{
				$result['aaData'][$key][6] = '<a href="index.php/product/product/recoverUser/'.$value['id'].'"><font color="green">恢复</font></a>';
			}
		}
		
		unset($result["aaaData"]);
		//print_r($result);exit;
		echo json_encode($result);
	}

	//用户认证
	function authenticate(){
		$product['android_id'] = $this->uri->segment(4);
		//$product['last_online_time'] = $this->uri->segment(4); //上次在线时长
		$product['login_time'] = date("Y-m-d H:m:s");
		$product['online'] = time();
		if(''!=$product['android_id'] && ''!=$product['login_time']){
			$temp = $this->product_model->getByAID($product['android_id']);
			$sort = $this->sortUser($temp);
			switch ($sort){
				case 'new':
					$this->newUser($product);
					$result['status'] = 1; 
					$result['exist'] = 0; 
					break;
				case 'old':
					$this->oldUser($product,$temp['id']);
					$result['status'] = 1;
					$result['exist'] = 1; 
					break;
				case 'forbid':
					$result['status'] = 0; 
					$result['msg'] = 'forbidden';
					break;
					}

		}else{
			$result['status'] = 0;
			}
		echo json_encode($result);
	}

	//心跳 + 更新总在线时长
	function heartbeat(){
		$android_id = $this->uri->segment(4);
		$beat = $this->uri->segment(5);
		//查询已在线时间
		$temp = $this->product_model->getByAID($android_id);
		$result['status'] = $temp['status']; 
		//累计在线时间
		$product['onlinetime'] = $temp['onlinetime']+$beat;
		//更新最后在线时间
		$product['online'] = time();
		$this->product_model->updateOneProductByAID($product,$android_id);
		echo json_encode($result);
	}

	//踢用户下线 单个
	function kickUser(){
		$id = $this->uri->segment(4);
		$product['status'] = 0;
		$this->product_model->updateOneProduct($product,$id);
		redirect('/product/product/productList', 'refresh');
	}

	//恢复用户 单个
	function recoverUser(){
		$id = $this->uri->segment(4);
		$product['status'] = 1;
		$this->product_model->updateOneProduct($product,$id);
		redirect('/product/product/productList', 'refresh');
	}
	

	//判断用户状态 认证的时候判断是新/老/禁止用户
	function sortUser($product){
		//检查新老用户 通过mac地址记录
		if(empty($product)){return 'new';}
		else{
			if($this->isForbidden($product['status'])){return 'forbid';}
			$this->oldUser($product,$product['id']);
			return 'old';
		}
	}
	
	//判断用户是被禁止 禁止返回true
	function isForbidden($status){
		return ($status == 0);
	}

	//新增用户信息
	function newUser($product){
		$product['status'] = 1;
		$product['onlinetime'] = 0; //$this->online_gap;
		return ($this->product_model->insertOneProduct($product));
	}

	//更新用户信息 
	function oldUser($product,$id){
		//$product['onlinetime'] = $product['onlinetime'] + $this->online_gap;
		return $this->product_model->updateOneProduct($product,$id);
	}

	//计算两个时间戳之间的时间间隔 默认的到当前时间
	function rel_time($from, $to = null) {
	  $to = (($to === null) ? (time()) : ($to));
	  $to = ((is_int($to)) ? ($to) : (strtotime($to)));
	  //$from = ((is_int($from)) ? ($from) : (strtotime($from)));

	  $units = array(
		"年"   => 29030400, // seconds in a year   (12 months)
		"月"  => 2419200,  // seconds in a month  (4 weeks)
		"周"   => 604800,   // seconds in a week   (7 days)
		"天"    => 86400,    // seconds in a day    (24 hours)
		"时"   => 3600,     // seconds in an hour  (60 minutes)
		"分" => 60,       // seconds in a minute (60 seconds)
		"秒" => 1,         // 1 second
	  );

	  $diff = abs($from - $to);
	  $suffix = (($from > $to) ? ("from now") : ("ago"));
		$output = '';
	  foreach($units as $unit => $mult){//echo "{".$output."} [".$diff."] [".$unit."]/".$mult." <br>";
		if($diff >= $mult) {
			//$and = (($mult != 1) ? ("") : ("and "));
			//$output .= ", ".$and.intval($diff / $mult)." ".$unit.((intval($diff / $mult) == 1) ? ("") : ("s"));
			$output .= ", ".intval($diff / $mult)."".$unit;
			$diff -= intval($diff / $mult) * $mult;
		}
	  }
	  //$output .= " ".$suffix;
	  $output = substr($output, strlen(", "));

	  return $output;
	}



}// end fo class

?>
