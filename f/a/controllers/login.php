<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * login
	 *
	 */
	function __construct(){
		parent::__construct();
		$this->load->Model('admin_model');
	}

	function index(){
		
	}

	function check_login(){

		if($_POST){
			$table="admin_users";
			//加密方式
			$p_s = trim($this->config->item('pass_security'));
			$where['username']=$this->input->post('username_field');
			$where['group_id'] = 1;
			if($p_s!=''){
				$password = $p_s($this->input->post('password_field'));
			}
			else{
				$password=$this->input->post('password_field');	
			}
			$query=$this->db->get_where($table,$where);
			$result = $query->row_array();
			if(count($result)>0 && $result['password'] == $password){
				$this->admin_model->admin_last_login($result['id']);
				$group = $this->admin_model->get_group_by_id($result['group_id']);
				$admin = array(
					'manager' => $result['username'],
					'login' => true,
					'last_login' => $result['last_login'],
					'group_name' => $group['group_name'],
					);
				$this->session->set_flashdata('msg', "登录成功");
				$this->session->set_userdata($admin);
				redirect(site_url());
			}
			else{	
				$this->session->set_flashdata('msg', "用户名密码错误");
				//$this->load->view('admin/login',$temp);
				redirect(site_url());
			}
		}
		if($this->session->userdata("login") == true){
			redirect(current_url());
		}
		else{
			redirect(site_url());
		}
	}
}