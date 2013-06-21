<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model {
	
	var $dbtable = "settings";

    function __construct(){
        parent::__construct();
    }
	
	/* 改变团购开关的值 */
	function groupbuyswitch(){
		$key = 'groupbuy_s';
		$data = array(
               'key' => $key,
               'value' => $this->input->post("groupbuy_s"),
            );
		$query = $this->db->get_where($this->dbtable, array('key' => $key));
		if($result = array_shift($query->result())){print_r($result);print_r($data);
			$this->db->where('id', $result->id);
			return $this->db->update($this->dbtable, $data); 
		}
		else{
			return $this->db->insert($this->dbtable, $data);
		}
	}

	/* 获取setting的值 */
	function getsetting($key){
		$query = $this->db->get_where($this->dbtable, array('key' => $key));
		if($result = array_shift($query->result())){
			return $result->value;
		}
	}

}