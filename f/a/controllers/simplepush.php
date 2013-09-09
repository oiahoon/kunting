<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simplepush extends CI_Controller {
  
  var $side_current_id = 6;

  function __construct(){
    parent::__construct();
    if(!$this->session->userdata("login")){
      redirect(site_url());
    }
    $this->load->Model('push_model','push');  
  }
  
  function index(){
    $viewdata = array( 
      'title' => array('top' => '推送列表','small' => ''),
      'ctl' =>  strtolower( __CLASS__),
      );
    $viewdata['side_current_id'] = $this->side_current_id;
    $this->load->view('pushs',$viewdata);
  }
  
  /* 新增push */
  function new_push() {
    $viewdata = array( 
      'title' => array('top' => '新建推送','small' => ''),
      'ctl' =>  strtolower( __CLASS__),
      );
    if($_POST){
      //至少要填写标题
      if($this->input->post('title')){
        if($this->push->insert()){
          $push_id = $this->db->insert_id();
          $push_data = $this->create_push_data($push_id);
          $custom['type'] = 'titleonly';
          if (strlen($push_data['content']) > 200) {
            $custom['type'] = 'titlecontent';
            $custom['url'] = base_url('p/'.$push_id.".json");
            $push_data['content'] = strcut($push_data['content'],200);
          }
          $result['ios'] = pushit($push_data['content'], 2, 'ios', $custom);

          $push_data['pName'] = "com.nervenets.kuntingandroid";
          $push_data['cName'] = "com.nervenets.kuntingandroid.Main";

          $push_data = json_encode($push_data);
          
          $result['android'] = pushit($push_data, 1, 'android');

          $this->push->pushcount($push_id);
          redirect ('simplepush','location');
          
        }
      }
    }
    $viewdata['side_current_id'] = $this->side_current_id;
    $this->load->view('pusheditor',$viewdata);
  }
  /* 按钮推送 */
  function push_it(){
    $id = $this->uri->segment(3);
    if($id){
      $push_data = $this->create_push_data($id);
      $custom['type'] = 'titleonly';
      if (strlen($push_data['content']) > 200) {
        $custom['type'] = 'titlecontent';
        $custom['url'] = base_url('p/'.$id.".json");
        $push_data['content'] = strcut($push_data['content'],200)."..";
      }
      $result['ios'] = pushit($push_data['content'], 2, 'ios', $custom);

      //android推送还需要的参数
      $push_data['pName'] = "com.nervenets.kuntingandroid";
      $push_data['cName'] = "com.nervenets.kuntingandroid.Main";
      
      // $push_data = str_replace('\u','\\\u',json_encode($push_data));
      $push_data = json_encode($push_data);
      $result['android'] = pushit($push_data, 1, 'android');

      $result['count'] = $this->push->pushcount($id);
    }
    echo json_encode($result);    
  }
  /* 通过id获得并处理push的内容 */
  function create_push_data($id) {
    $data = $this->push->getbyid($id);
    $push_data['title'] = $data->title;
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
    foreach($result['aaaData'] as $key => $value){
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

}
