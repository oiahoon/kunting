<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simplepush extends CI_Controller {
  
  var $side_current_id = 6;

  function __construct(){
    parent::__construct();
    if(!$this->session->userdata("login")){
      redirect(site_url());
    }
    $this->load->Model('push_model','push');
    $this->load->Model('apns_model','apns');
    $this->load->library('apn');
    $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
  }
  
  function index(){
    $viewdata = array( 
      'title' => array('top' => '推送列表(根据创建时间逆序)','small' => ''),
      'ctl'   =>  strtolower( __CLASS__),
      );
    $viewdata['side_current_id'] = $this->side_current_id;
    $this->load->view('pushs',$viewdata);
  }
  
  /* 新建的时候保存并推送 push */
  function new_push() {
    $viewdata = array( 
      'title' => array('top' => '新建推送','small' => ''),
      'ctl'   =>  strtolower( __CLASS__),
      );
    if($_POST){
      //至少要填写标题
      if($this->input->post('title')){
        if($this->push->insert()){
          $push_id   = $this->db->insert_id();
          $push_data = $this->create_push_data($push_id);
          /*$push_content_ios = $push_data['content'];
          $custom = '';
          if (strlen($push_content_ios) > 160) {
            $custom = base_url('p/'.$push_id.".json");
            $push_content_ios = strcut($push_content_ios,158)."..";
          }
          $result['ios'] = pushit($push_content_ios, 2, 'ios', $custom);*/
          //ios 用自己寫的推送
          $result['ios']      = $this->apns_push($push_data,$push_id);
          
          $push_data['pName'] = "com.nervenets.kuntingandroid";
          $push_data['cName'] = "com.nervenets.kuntingandroid.Main";

          $push_data = json_encode($push_data);
          //$result['android'] = pushit($push_data, 1, 'android');

          $this->push->pushcount($push_id);
          redirect ('simplepush','location');
          
        }
      }
    }
    $viewdata['side_current_id'] = $this->side_current_id;
    $this->load->view('pusheditor',$viewdata);
  }
  /* 在列表页面按钮推送 */
  function push_it(){
    $id = $this->uri->segment(3);
    if($id){
      $push_data           = $this->create_push_data($id);
      /*$push_content_ios  = $push_data['content'];
      $custom              = '';
      if (strlen($push_content_ios) > 160) {
      $custom              = base_url('p/'.$id.".json");
      $push_content_ios    = strcut($push_content_ios,158)."..";
      }
      $result['ios']       = pushit($push_content_ios, 2, 'ios', $custom);*/
      //ios 用自己寫的推送
      $result['ios']       = $this->apns_push($push_data,$id);
      
      //android推送还需要的参数
      $push_data['pName']  = "com.nervenets.kuntingandroid";
      $push_data['cName']  = "com.nervenets.kuntingandroid.Main";
      
      // $push_data        = str_replace('\u','\\\u',json_encode($push_data));
      $push_data           = json_encode($push_data);
      //$result['android'] = pushit($push_data, 1, 'android');
      
      $result['count']     = $this->push->pushcount($id);
    }
    echo json_encode($result);    
  }
  /* 通过id获得并处理push的内容 */
  function create_push_data($id) {
    $data                 = $this->push->getbyid($id);
    $push_data['title']   = $data->title;
    $push_data['content'] = (trim($data->content) != '') ? $data->title."-".$data->content : $data->title;
    if(trim($data->command) != '') $push_data['command'] = $data->command;
    return $push_data;
  }
  /* 删除一条 */
  function delete(){

  }
  //提供表格ajax数据
  function pushList_dataTable()
  {
    $where = ''; //查询条件
    $result = $this->push->getpushs();
    foreach(array_reverse($result['aaaData']) as $key => $value){
      $result['aaData'][$key][] = $value['id'];
      $result['aaData'][$key][] = '<a onclick="ajax_push('.$value['id'].')" title="推送"><button class="orange tiny has_text img_icon"><img src="images/icons/small/white/magic_mouse.png"><span>推送</span></button></a>&nbsp;' . "&lt;".$value['title']."&gt;";
      //$result['aaData'][$key][] = $value['title_2nd'];
      $result['aaData'][$key][] = '推了<em>'.$value['count'].'</em>次';
      $result['aaData'][$key][] = "<a style='display:block;' title='cmd:".$value['command']."'>".$value['content']."</a>";
      $result['aaData'][$key][] = "<font color='red'>".$value['last_push_at']."</font>&nbsp;/&nbsp;".$value['created_at'];
    }
    unset($result["aaaData"]);
    header('Content-type:application/json; charset=utf-8');
    echo json_encode($result);
  }

  //给苹果推送单独写一个server
  private function apns_push($push_data,$id)
  {
    $options = $result['whofailed'] = array();
    $result  = array();
    //是否只推送给测试设备
    if($this->config->item('OnlyPushTestDevice','apn')){
      $options['is_test_device'] = 1;
    }

    $push_data = $this->deal_iso_push_msg($push_data,$id);
    //根据条件得到设备信息
    $devices   = $this->apns->getDevices();
    // print_r($devices);die;
    
    $result    = $this->apn->apns_push($push_data, $devices);
    
    return $result;
  }

  private function deal_iso_push_msg($push_data,$id)
  {
    $data            = array('content'=>'', 'url'=>'');
    $data['content'] = $push_data['content'];
    $max_length      = $this->config->item('MsgMax','apn');
    if (strlen($data['content']) > $max_length) {
      $data['url']     = base_url('p/'.$id.".json");
      $data['content'] = strcut($data['content'],$max_length - strlen($data['url']) - 2)."..";
    }
    if(empty($data['url'])) unset($data['url']);
    return $data;
  }

}
