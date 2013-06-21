<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	var $admin_user_table = "admin_users";
	var $admin_group_table = "admin_group";

    function __construct(){
        parent::__construct();
    }


	//返回用户组数组
	function get_admin_group(){
		$query = $this->db->get($this->admin_group_table);
		foreach( $query -> result_array() as $row){
			$result[$row['id']] = $row['group_name'];
		}
		return $result;
	}
	/**
		根据id返回一个用户组的信息
	 */
	function get_group_by_id($id){
		$query = $this->db->get_where($this->admin_group_table, array('id' => $id));
		return($query->row_array());
	}
	/**
		添加用户组
	 */
	function group_add(){
		$group['group_name'] = $_REQUEST['group_name'];
		return $this->db->insert($this->admin_group_table, $group);
	}
	/**
		更新用户组信息
	 */
	function group_update(){
		$this->db->where('id', $_REQUEST['id']);
		$group['group_name'] = trim($_REQUEST['group_name']);
		return $this->db->update($this->admin_group_table, $group);
	}
	/**
		根据id删除一个用户组
	 */
	function group_del($id){
		if($this->db->delete($this->admin_group_table, array('id' => $id))){
			return true;
		} 
		else{return false;}
		
	}
	/**
		用户注册
		$sendmail 为注册成功时是否发送邮件通知
		当管理员后台添加用户时，不发送通知
	 */
	function admin_add(){
		$p_s = trim($this->config->item('pass_security'));
		$user['username'] = trim($_REQUEST['username']);
		$user['group_id'] = $_REQUEST['admin_group'];
		if($p_s!=''){$user['password']=$p_s(trim($_REQUEST['pass']));}
			else{$user['password']=trim($_REQUEST['pass']);	}
		
		$res = $this->db->insert($this->admin_user_table,$user);
		//成功
		if($res){
			return array('status'=>'1','message'=>'注册成功');
		}
		//失败
		else{return array('status'=>'0','message'=>'注册失败');}
	}
	//用户列表
	function admin_list($url,$uri,$start_row,$where,$order){
		if($where!=""){
			$this->db->get_where($where);
		}
		if(!is_numeric($start_row)){
			$start_row=0;
		}
		$query = $this->db->get($this->admin_user_table);
		$num = $query->num_rows();

		$conf['per_page']=20;//每页显示数
		$conf['total_rows']=$num;//总共多少行
		$conf['base_url']=$url;
		$conf['uri_segment']=$uri;	
		$conf['prev_link']="上一页";
		$conf['next_link']="下一页";
		$conf['first_link']="首页";
		$conf['last_link']="尾页";
		$conf['num_links']=5;
		$this->load->library('pagination',$conf);
		$links=$this->pagination->create_links();
		$perpage=20;//
		//$start=$start_row;
		$sqla="select * from ".$this->admin_user_table."  order by ".$order."  desc limit ".$start_row.",".$perpage;
		//$sqla="select * from $table  order by $order ";
		$resa = $this->db->query($sqla);
		$res=$resa->result_array();		
		return array('res'=>$res,'total_rows'=>$conf['total_rows'],'links'=>$links,'per_page'=>$conf['per_page']);
	}
	
	//列出所有用户
	function admin_list_all($where = '',$order = 'username'){
		if($where!=""){
			$this->db->get_where($where);
		}
		$this->db->order_by($order, "asc"); 
		$query = $this->db->get($this->admin_user_table);
		$ressult = $query->result_array();		
	}

	/**
		根据id查询一个用户的信息
	 */
	function get_user_by_id($id){
		if($query = $this->db->get_where($this->admin_user_table,array('id'=>$id))){
			return $query->row_array();
		}
		else{
			return false;
		}
	}
	/**
		用户信息更新
	 */
	function admin_update(){
		$p_s = trim($this->config->item('pass_security'));
		$user['username'] = trim($_REQUEST['username']);
		$pass = trim($_REQUEST['pass']);
		$user['group_id'] = $_REQUEST['admin_group'];
		if('' != $pass){
			if($p_s!=''){$user['password']=$p_s($pass);}
			else{$user['password']=$pass;}
		}
		$this->db->where('id', $_REQUEST['id']);
		if($this->db->update($this->admin_user_table, $user)){
			return true;
		} 
		else{return false;}
	}
	/**
		根据id删除一个用户
	 */
	function admin_del($id){
		if($this->db->delete($this->admin_user_table, array('id' => $id))){
			return true;
		} 
		else{return false;}
		
	}

}// end of class
?>