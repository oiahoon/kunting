<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apns_model extends CI_Model {
  
  var $this_table  = "ios_devices";
  var $primaryKey  = "device_id";
  var $tokenField  = "device_token";
  var $dateField   = "date_created";
  var $testField   = "is_test_device";
  var $noteField   = "device_notes";
  var $countField  = 'push_count';
  var $lcountField = "launch_count";
  
  function __construct(){
    parent::__construct();
  }
  //435c4ee00e7c3ccd3ea4fa28818acfc623928f56aba05714c170f5cb306ef712
  
  /**
   * 返回device的信息,如果指定了条件的话.
   * @param  [array] $options [需要的条件,不传入则返回所有的]
   * @param  int     $limit
   * @param  int     $offset
   * @return [array] 设备信息
   */
  public function getDevices($options = NULL,$limit = NULL, $offset = 0)
  {
    if (empty($options)) {
      $query = $this->db->get($this->this_table);
    }
    else{
      if (empty($limit)) {
        $query = $this->db->get_where($this->this_table, $options);
      }
      else{
        $query = $this->db->get_where($this->this_table, $options, $limit, $offset);
      }
    }
    return $query->result_array();
  }

  public function saveDevice($device_token)
  {
    $query = $this->db->get_where($this->this_table, array('device_token' => $device_token), 1);
    $device = $query->row_array();
    if(empty($device)){
      $data = array(
           'device_token' => str_replace(' ', '', $device_token) ,
           'launch_count' => 1
            );
      $this->db->insert($this->this_table, $data); 
      $result = 'new device';
    }else{
      $data = array('launch_count' => $device['launch_count'] + 1);
      $this->db->where('device_id', $device['device_id']);
      $this->db->update($this->this_table, $data); 
      $result = 'launch '. ($device['launch_count'] + 1).'times'; 
    }
    return $result;
  }
  /**
   * 统计设备总数
   * @return [type] [description]
   */
  public function countDevices()
  {
    #code
  }
}