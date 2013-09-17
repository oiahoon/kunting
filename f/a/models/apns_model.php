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
   * 返回num格device的信息
   * @param  [int] $options [需要的条件,不传入则返回所有的]
   * @return [type]      [description]
   */
  public function getDevices($options = NULL,$limit = NULL, $offset = 0)
  {
    if (empty($num)) {
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
    return $query->row_array();
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