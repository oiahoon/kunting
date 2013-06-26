<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model {
	
	var $dbtable = "settings";

    function __construct(){
        parent::__construct();
    }
	
	/* 存储系统配置 */
	function save($param)
	{
		$info = $this->getByKey($param['key']);
		if($info)
		{
			return $this->update($param);
		}
		else
		{
			return $this->add($param);
		}
	}

	/* 插入一条系统配置 */
	function add($param)
	{
		return $this->db->insert($this->dbtable, $param);
	}

	/* 更新配置 $param array('key', 'value') */
	function update($param)
	{
		$this->db->where('key', $param['key']);unset($param['key']);
		return $this->db->update($this->dbtable, $param); 
	}

	/* 查询一条配置 */
	function getByKey($key = '')
	{
		if($key == '')
		{
			$query = $this->db->get($this->dbtable);
			$results = $query->result();
		}
		else
		{
			$query = $this->db->get_where($this->dbtable, array('key' => $key));
			$result = array_shift($query->result());
		}
		return $result;
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

	/* 获取setting的值  */
	function getsetting($key = ''){
		if ($key) {	
			$query = $this->db->get_where($this->dbtable, array('key' => $key));
			if($result = array_shift($query->result())){
				return $result->value;
			}
		}
		else{
			$query = $this->db->get($this->dbtable);
			if($results = $query->result()){
				foreach ($results as $row) {
					$result[$row->key] = $row->value;
				}
				return $result;
			}
		}
	}

}