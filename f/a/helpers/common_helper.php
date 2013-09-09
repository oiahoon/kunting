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
      if(!isset($_SERVER['HTTP_REFERER']) || !preg_match('/\/test/is', $_SERVER['HTTP_REFERER']))
        header('Content-type:application/json; charset=utf-8');
      echo json_encode($data);
      break;
    }
}

/* 推送 */
function pushit($content, $msgType = 1, $clientPlatform = 'android,ios', $custom = NULL){
  include_once dirname(__FILE__)."/../libraries/Snoopy.php";
  $snoopy                       = new Snoopy;
  $snoopy->agent                = $_SERVER['HTTP_USER_AGENT'];
  $snoopy->rawheaders["Pragma"] = "no-cache";
  
  $pushUrl = ($clientPlatform == 'ios') ? 
                "http://dev.zypush.com/push/api/sendmsg_ios" : 
                "http://dev.zypush.com/push/api/v2/sendmsg_ver02";

  $pushVar['offLine_time']   = 99*60*60;
  $pushVar["userName"]       = "joesupper";
  $pushVar["appKey"]         = '617729b1dd2ed59157696a5670a823ec';
  $pushVar["receiveType"]    = 1;
  $pushVar["receiveUsers"]   = 1;
  $pushVar["msgType"]        = $msgType;
  $pushVar["clientPlatform"] = $clientPlatform;
  $pushVar["msgContent"]     = $content;

  //推送的类型 titlecontent 标题加内容 titleonly 只有标题 article 文章

  if(!empty($custom)) $pushVar["custom_content"] = json_encode($custom);//'{"id":333,"name":"nimei","pwd":"nimeimei"}';
  // print_r($pushVar);die;
  if($snoopy->submit($pushUrl,$pushVar)){
    return $snoopy->results;
  }
  return false;
}

/**
 *  短链
 *  新浪接口短链生成
 *
 */
 function short_url($long_url){
   if(empty($long_url)) die;
  $api_         = "http://api.weibo.com/2/short_url/shorten.json";
  $api_full_url = $api_.'?source=2855687947&url_long='.urlencode($long_url);
  $result       = json_decode(vpost($api_full_url),true);
  return $result['urls'][0]['url_short'];
 }
 /* shorten a url ,get the short one 老版本 */
 function url_to_short($long_url){
   $api_ = 'http://jucelin.com/lab/short.php?type=1&url='.$long_url;
   return file_get_contents($api_);
 }


// curl获取url的内容
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
    $to           = $this->input->post('emailto');
    $title        = $this->input->post('title');
    $body         = $this->input->post('content');
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

// 中文字符串截取
function strcut($str,$len, $start=0){  
  if($start < 0)  
    $start = strlen($str)+$start;  

  $retstart = $start+getOfFirstIndex($str,$start);  
  echo $retstart;  
  $retend = $start + $len -1 + getOfFirstIndex($str,$start + $len);  
  echo $retend;  
  return substr($str,$retstart,$retend-$retstart+1);  
}  
//判断字符开始的位置  
function getOfFirstIndex($str,$start){  
  $char_aci = ord(substr($str,$start-1,1));  
  if(223<$char_aci && $char_aci<240)  
    return -1;  
  $char_aci = ord(substr($str,$start-2,1));  
  if(223<$char_aci && $char_aci<240)  
    return -2;  
  return 0;  
}  

