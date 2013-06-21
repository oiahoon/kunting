<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * 用户管理controller
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
	
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url());
	}

	/**
		用户列表
	 */
	public function adminList($start_row = 0){
		$data['admin_group'] = $this->admin_model->get_admin_group();
		$users = $this->admin_model->admin_list_all();
		$data['title']['top'] = "后台用户列表";
		$data['user'] = $users;
		$this->load->view('contact',$data);
	}

	/**
		用户添加
	 */
	public function adminAdd(){
		$data['user_group'] = $this->admin_model->get_admin_group();
		$users = $this->admin_model->admin_list_all();
		$data['user'] = $users;
		$data['title']['top'] = '添加人员';
		$this->load->helper(array('form', 'url'));
		if(!isset($_REQUEST['username'])){
			$data['message'] = '';
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|max_length[16]');
			$this->form_validation->set_rules('username', 'Username', 'min_length[3]|max_length[16]|is_unique[admin_users.username]');
			if ($this->form_validation->run() == FALSE){
				$data['message'] = '添加失败,请修改用户信息后再次提交';
			}
			else{
				$result = $this->admin_model->admin_add();
				if($result['status']=='1'){
					$data['message'] = '添加<b>'.$_REQUEST['username'].'</b>成功';
				}
				else{
					$data['message'] = '添加<b>'.$_REQUEST['username'].'</b>失败。'.$result['message'];
				}
			}
		}
		$this->load->view('contacts',$data);
	}

	/**
		用户信息保存
	 */
	public function adminEdit(){
		$data['user_group'] = $this->admin_model->get_admin_group();
		$data['title'] = '编辑用户';
		$data['message'] = '';
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$params = $this->uri->uri_to_assoc(4);
		$data['admin_info'] = $this->admin_model->get_user_by_id($params['id']);
		
		if(isset($_POST['username'])){
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			
			if('' != trim($_REQUEST['pass'])){
				$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|max_length[16]');
			}
			if($data['admin_info']['username'] != trim($_REQUEST['username'])){
				$this->form_validation->set_rules('username', 'Username', 'min_length[1]|max_length[16]|is_unique[admin_users.username]');
			}
			$this->form_validation->set_rules('admin_group', 'Group', 'trim|required');
			if ($this->form_validation->run() == FALSE){
				$data['message'] = '更新<b>'.$_REQUEST['email'].'</b>失败,请修改用户信息后再次提交';
			}
			else{
				if($this->admin_model->admin_update()){
					redirect('/admin/admin/adminlist');
				}
				else{
					$data['message'] = '更新<b>'.$_REQUEST['email'].'</b>失败。';
				}
			}
		}
		$this->load->view('/admin/admin_edit',$data);
	}
	/**
		删除用户
	 */
	public function adminDel(){
		$params = $this->uri->uri_to_assoc(4);
		$result = $this->admin_model->admin_del($params['id']);
		redirect('/admin/admin/adminlist',"refresh");
	}
	
	//*****************用户组************************//
	/**
		用户组列表
	 */
	public function groups($start_row = 0){
		$data['admin_group'] = $this->admin_model->get_admin_group();
		$data['title'] = '用户组';
		$this->load->view('/admin/groups',$data);
	}
	/**
		添加用户组
	 */
	function groupAdd(){
		$data['admin_group'] = $this->admin_model->get_admin_group();
		$data['action'] = '添加用户组';
		$data['message'] = '';
		$data['alert'] = 'red';
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if(!isset($_REQUEST['group_name'])){$this->load->view('/admin/group_add',$data);}
		else{
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|min_length[1]|max_length[16]|is_unique[admin_group.group_name]');
			if ($this->form_validation->run() == FALSE){
				$data['message'] = '添加<b>['.$_REQUEST['group_name'].']</b>失败,请修改信息后再次提交';
				$this->load->view('/admin/group_add',$data);
			}else{
				if($this->admin_model->group_add()){
					$data['alert'] = 'green';
					$data['action'] = '添加用户组';
					$data['message'] = '添加<b>['.$_REQUEST['group_name'].']</b>成功';
					$this->load->view('/admin/group_add',$data);
				}else{
					$data['action'] = '添加用户组';
					$data['message'] = '添加<b>['.$_REQUEST['group_name'].']</b>失败';
					$this->load->view('/admin/group_add',$data);
				}
			}
		}
	}
	/**
		修改用户组
	 */
	function groupEdit(){
		$data['admin_group'] = $this->admin_model->get_admin_group();
		$data['action'] = '编辑用户组';
		$data['message'] = '';
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$params = $this->uri->uri_to_assoc(4);
		$data['group_info'] = $this->admin_model->get_group_by_id($params['id']);
		if(isset($_REQUEST['group_name'])  && ''!=$_REQUEST['id']){
			if($this->admin_model->group_update()){
					redirect('/admin/admin/groups');
				}
				else{
					$data['message'] = '更新<b>'.$data['group_info']['group_name'].'</b>失败。';
				}
		}
		$this->load->view('/admin/group_edit',$data);
	}
	/**
		删除用户组
	 */
	public function groupDel(){
		$params = $this->uri->uri_to_assoc(4);
		$result = $this->admin_model->group_del($params['id']);
		redirect('/admin/admin/groups',"refresh");
	}
}// end of class
