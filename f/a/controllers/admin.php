<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * 用户管理controller
	 *
	 */
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(site_url());
		}
		$this->load->Model('admin_model');
	}

	function index(){
		
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
		$users = $this->admin_model->admin_list('admin/adminList','',0,'','id');
		$data['title']['top'] = "后台用户列表";
		$data['user'] = $users;
		$data['side_current_id'] = 7;
		$this->load->view('adminList',$data);
	}

	/**
		用户添加
	 */
	public function adminAdd(){
		$data['user_group'] = $this->admin_model->get_admin_group();
		$data['title']['small'] = '';
		$data['title']['top'] = '添加管理员';
		$data['ctl'] = 'admin';
		$data['action'] = 'adminAdd';
		$data['message_color'] = 'red';
		$this->load->helper(array('form', 'url'));
		if(!isset($_REQUEST['username'])){
			$data['message'] = '';
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]');
			$this->form_validation->set_rules('username', 'Username', 'min_length[3]|max_length[16]|is_unique[admin_users.username]');
			if ($this->form_validation->run() == FALSE){
				$data['message'] = '添加失败,请修改用户信息后再次提交';
			}
			else{
				$result = $this->admin_model->admin_add();
				if($result['status']=='1'){
					$data['message_color'] = 'green';
					$data['message'] = '添加<strong>'.$_REQUEST['username'].'</strong>成功';
				}
				else{
					$data['message'] = '添加<strong>'.$_REQUEST['username'].'</strong>失败。'.$result['message'];
				}
			}
		}
		$data['side_current_id'] = 7;
		$this->load->view('admineditor',$data);
	}

	/**
		用户信息保存
	 */
	public function adminEdit(){
		$data['user_group'] = $this->admin_model->get_admin_group();
		$data['title']['top'] = '编辑用户';
		$data['title']['small'] = '';
		$data['message'] = '';
		$data['message_color'] = 'red';
		$data['ctl'] = 'admin';
		$data['action'] = 'adminEdit';
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$id = $this->uri->segment(4);
		$data['admin_info'] = $this->admin_model->get_user_by_id($id);
		//print_r($data);die;
		if(isset($_POST['username'])){
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			
			if('' != trim($_REQUEST['password']) && '<不修改请留空>' != trim($_REQUEST['password'])){
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[36]');
			}
			if($data['admin_info']['username'] != trim($_REQUEST['username'])){
				$this->form_validation->set_rules('username', 'Username', 'min_length[1]|max_length[16]|is_unique[admin_users.username]');
			}
			
			if ($this->form_validation->run() == FALSE){
				$data['message'] = '更新<strong>'.$_REQUEST['username'].'</strong>失败,请修改用户信息后再次提交';
				if($data['admin_info']['username'] == trim($_REQUEST['username'])){
					if('' == trim($_REQUEST['password']) || '<不修改请留空>' == trim($_REQUEST['password'])){
						$data['message'] = '<strong>'.$_REQUEST['username'].'</strong>信息没有变化';
					}
				}
			}
			else{
				if($this->admin_model->admin_update()){
					$data['message_color'] = 'green';
					$data['admin_info']['username'] = trim($_REQUEST['username']);
					$data['message'] = '修改<strong>'.$_REQUEST['username'].'</strong>成功';
				}
				else{
					$data['message'] = '更新<strong>'.$_REQUEST['username'].'</strong>失败。';
				}
			}
		}
		$data['side_current_id'] = 7;
		$this->load->view('admineditor',$data);
	}
	/**
		删除用户
	 */
	public function adminDel(){
		$id = $this->uri->segment(4);
		$result = $this->admin_model->admin_del($id);
		redirect('/admin/adminList',"refresh");
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
