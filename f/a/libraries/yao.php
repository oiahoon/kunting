<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Yao {
	
	/**
	 *  短链
	 *
	 *
	 */
	 function short_url($long_url){
		//$long_url = "http://www.qq.com";
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

		return "http://url.cn/".$result->data->short_url;
	 }
}

/* End of file yap.php */