<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 不需要权限的一些文章函数
 */
class Posts extends CI_Controller {
  
  function __construct(){
    parent::__construct();
    $this->load->Model('post_model','articles');
    $this->load->Model('push_model','push');
    $this->load->Model('apns_model','apns');
    $this->load->library('apn');
    $this->apn->payloadMethod = 'enhance';
  }

  /* 文章列表 */
  public function articlelists()
  {
    $result['status'] = 0;
    $category     = $this->input->post("type")  ? $this->input->post("type")  : ''; 
    $perpage    = $this->input->post('perpage') ? $this->input->post('perpage') : 20; 
    $page       = $this->input->post('page')  ? $this->input->post('page')  : 1;
    $dead       = $this->input->post('dead')  ? $this->input->post('dead')  : '';
    $result['data'] = $this->articles->getArticlesList($category, $dead, $perpage, $page);
    if($page == '1') {
      $tops = $this->articles->gettopbytype($category);
      if (!empty($tops)) {
        foreach ($tops as $tk => $tv) {
          foreach ($result['data']['lists'] as $key => $value) {
            if ($tv['id'] == $value['id']) unset($result['data']['lists'][$key]);
          }
          array_unshift($result['data']['lists'], $tv);
        }
      }
    }

    if($result['data']) {
      $result['status'] = 1;
      foreach ($result['data']['lists'] as $key => $row) {
        if ($row['imagecover'])
          $result['data']['lists'][$key]['imagecover'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."/uploads/".$row['imagecover'];
        else
          $result['data']['lists'][$key]['imagecover'] = '';
        if(trim($row['short_link']) == '' || // 没有短链
          !preg_match("/http\:\/\//is", $row['short_link'])) //或者短链不正常
        { 
          $short_link = $result['data']['lists'][$key]['short_link'] = short_url(base_url('v/'.$row['id']));
          $this->articles->putShortLinkById($row['id'],$short_link);

        }
        //活动报名增加返回过期状态
        if ($row['category_id']==2) {
          $current_time = date("Y-m-d");
          if($current_time < $row['begin_date'])
            $result['data']['lists'][$key]['isdead'] = '<';//'notstart';
          if($current_time > $row['begin_date'])
            $result['data']['lists'][$key]['isdead'] = '=';//'ing';
          if($current_time > $row['end_date'])
            $result['data']['lists'][$key]['isdead'] = '>';//'expired';
        }   
      }
    }
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
    //  die(json_encode(array('status'=>'0')));
    $viewdata = array( 
      'title' => array('top' => '','small' => $data['title']),
      'ctl'   => "sharepage",
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
      }
    }
    switch ($ext) {
      case 'json':
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($data);
        break;
      
      default:
        # code...
        break;
    }
  }

  function push2json()
  {
    $data['status'] = 0;
    $id_ext = $this->uri->segment(2);
    list($id, $ext) = explode(".",$id_ext);
    if($id){
      $data['content'] = $this->push->getById($id);
      if($data['content']){
        $data['status'] = 1;
        $data['type'] = 'simplepush';
      }
    }
    switch ($ext) {
      case 'json':
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($data);
        break;
      
      default:
        # code...
        break;
    }
  }
  /* 推送 废弃 *//*
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
  */
  /**
   * 推送，ios推送字数限制，改成推url，然后从url取json   
   */
  public function push_new()
  {
    $id = $this->uri->segment(3);
    if($id){
      $article           = $this->articles->getById($id, true);
      // ios
      $result['ios']     = $this->apns_push($article, $id);
      //android
      //$result['android'] = $this->push_android($article, $id);
    }
    echo json_encode($result['ios']);//.$result['android'];
  }

  private function push_android($article, $id)
  {
    $message              = '';
    $path                 = 'v';
    $push_data['title']   = $article->title;
    $push_data['content'] = $push_data['title'] . "-" .base_url($path.'/'.$id.".json");
    $push_data['pName']   = "com.nervenets.kuntingandroid";
    $push_data['cName']   = "com.nervenets.kuntingandroid.Main";
    
    $result['android']    = pushit(str_replace('\u','\\\u',json_encode($push_data)), 1, 'android');
    $result['android']    = json_decode($result['android'],true);
    
    if($result['android']['result'] == 1){
      $message .= 'android 成功推送至'.$result['android']['receiver_count'].'个用户';
    }else{
      $message .= 'android 推送失败，失败代码：'.$result['android']['result'];
    }
    return $message;
  }

  //使用推送接口
  private function push_ios($article, $id)
  {
    $message       = '';
    $path          = 'v';
    $push_data     = $article->title;
    $custom        = base_url($path.'/'.$id.".json");
    $result['ios'] = pushit($push_data, 2, 'ios', $custom);
    $result['ios'] = json_decode($result['ios'],true);
    
    if($result['ios']['result'] == 1){
      $message .= 'ios 成功推送至'.$result['ios']['receiver_count'].'个用户'."\r\n";
    }else{
      $message .= 'ios 推送失败，失败代码：'.$result['ios']['result']."\r\n";
    }
    return $message;
  }
  
  //给苹果推送单独写一个server
  private function apns_push($article, $id)
  {
    $options = $result['whofailed'] = array();
    $result['success'] = $result['fail'] =  0;
    //是否只推送给测试设备
    if($this->config->item('OnlyPushTestDevice','apn')){
      $options['is_test_device'] = 1;
    }
    
    //根据条件得到设备信息
    $devices = $this->apns->getDevices();
    // print_r($devices);die;
    $max_length = $this->config->item('MsgMax','apn');
    $push_data = $article->title;
    if (strlen($push_data) > $max_length) {
      $push_data = strcut($push_data, $max_length - 2)."..";
    }
    $custom = base_url('v/'.$id.".json");

    $this->apn->connectToPush();

    $this->apn->setData($custom);

    // print_r($push_data);die;
    foreach ($devices as $row) {
      $send_result = $this->apn->sendMessage(str_replace(' ', '', $row['device_token']), $push_data, 1);

      if($send_result){
        $result['success'] ++;
        log_message('debug','Sending successful');
      }
      else{
        $result['fail'] ++;
        array_push($result['whofailed'], $row['device_notes']);
        log_message('error',$this->apn->error);
      }
    }

    $this->apn->disconnectPush();
    return $result;
  }

}
