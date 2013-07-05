<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展公共函数
 * 在 config/autoload.php 里面添加
 * $autoload['helper'] = array(common');
 */

/* 自定义输出函数,主要用户api接口 */
function yaoprint($data, $format = 'json')
{
	switch (strtolower($format)) {
			case 'array':
				print_r($data);
				break;
			
			default:
				/* 如果不是从test接口来的  就作为json格式输出 */
				if(!isset($_SERVER['HTTP_REFERER']) || !preg_match('/\/test/is', $_SERVER['HTTP_REFERER'])) header('Content-type:application/json; charset=utf-8');
				echo json_encode($data);
				break;
		}
}

/* 推送 */
function pushit($content, $msgType = 1, $clientPlatform = 'android,ios'){
	include_once dirname(__FILE__)."/../libraries/Snoopy.php";
	$snoopy = new Snoopy;
	$snoopy->agent = $_SERVER['HTTP_USER_AGENT'];   
	$snoopy->rawheaders["Pragma"] = "no-cache";

	$pushUrl					= "http://dev.zypush.com/push/api/sendmsg_ver01";
	$pushVar["userName"]		= "joesupper";
	$pushVar["appKey"]			= '617729b1dd2ed59157696a5670a823ec';
	$pushVar["receiveType"]		= 1;
	$pushVar["receiveUsers"]	= 1;
	$pushVar["msgType"]			= $msgType;
	$pushVar["clientPlatform"]	= $clientPlatform;
	$pushVar["msgContent"]		= $content;
	//print_r($pushVar);exit;
	if($snoopy->submit($pushUrl,$pushVar)){
		return $snoopy->results;
	}
	return false;
}

