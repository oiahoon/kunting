<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(site_url());
		}
		$this->load->Model('post_model','actions_model');	
	}
	
	function index(){
		$viewdata = array( 
			'title' => array('top' => '活动列表','small' => '(点击标题查看预览页面)'),
			'ctl' => "actions",
			);
		$viewdata['side_current_id'] = 2;
		$this->load->view('articles',$viewdata);
	}
	
	/* 添加资讯 */
	function add(){
		$viewdata = array( 
			'title' => array('top' => '添加活动','small' => '(活动是图文结合的)'),
			'category' => '2',
			'ctl' => "actions",
			);
		if($_POST){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			$this->form_validation->set_rules('title[main]', 'Title', 'trim|required');
			$this->form_validation->set_rules('title[2nd]', 'Title2nd', 'trim');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[3]');
			if ($this->form_validation->run() == FALSE){
				$viewdata['message'] = '添加失败,请修改后再次提交';
			}
			else{
				$this->load->library('upload');
				if ( ! $this->upload->do_upload()){
					$action['imagecover'] = 0;
					$viewdata['error'] = $this->upload->display_errors();
				} 
				else{
					$uploaddata = $this->upload->data();
					$viewdata['status'] = 1;
					$action['imagecover'] = $uploaddata['file_name']; 
				}
				$action['title'] = quotes_to_entities($_POST['title']['main']);
				$action['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$action['content'] = quotes_to_entities($_POST['content']);
				$action['create_date'] =  date("Y-m-d H:i:s");
				$action['author'] = $this->session->userdata['manager'];
				$action['category_id'] = '2';
				foreach($action as $key => $row){ $viewdata[$key] = $row; }
				if($this->actions_model->insertOneArticle($action)){
					redirect("post/actions", "refresh");
				}
				else{
					$viewdata['message'] = "添加失败";
				}
			}
		}
		$viewdata['side_current_id'] = 2;
		$this->load->view('posteditor_tinymce',$viewdata);
	}
	/* 修改资讯 */
	function edit(){
		$viewdata = array( 
			'title' => array('top' => '修改活动','small' => '(活动是图文结合的)'),
			'category' => '2',
			'ctl' => "actions",
			);
		if($_POST){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<font color='red'><b> ", "</b></font>");
			$this->form_validation->set_rules('title[main]', 'Title', 'trim|required');
			$this->form_validation->set_rules('title[2nd]', 'Title2nd', 'trim');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[3]');
			if ($this->form_validation->run() == FALSE){
				$viewdata['message'] = '提交失败,请修改后再次提交';
			}
			else{
				$this->load->library('upload');
				if ( ! $this->upload->do_upload()){
					$viewdata['error'] = $this->upload->display_errors();
				} 
				else{
					$uploaddata = $this->upload->data();
					$viewdata['status'] = 1;
					$action['imagecover'] = $uploaddata['file_name']; 
				}
				$action['title'] = quotes_to_entities($_POST['title']['main']);
				$action['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$action['content'] = quotes_to_entities($_POST['content']);
				foreach($action as $key => $row){ $viewdata[$key] = $row; }
				if($this->actions_model->updateOneArticle($action,$_POST['id'])){
					redirect("post/actions", "refresh");
				}
				else{
					$viewdata['message'] = "提交失败";
				}
			}
		}
		$params = $this->uri->uri_to_assoc(4);
		if(isset($params['id'])) $viewdata['post'] = $this->actions_model->getById($params['id']);
		$viewdata['side_current_id'] = 2;
		$this->load->view('posteditor_tinymce',$viewdata);
	}

	/* 删除一条 */
	function delete(){
		$this->actions_model->deletArticleById($this->uri->segment(5));
		redirect("post/actions", "refresh");
	}
	//为活动页面提供表格数据
	function articleList_dataTable()
	{
		$where = 'category_id = 2'; //活动的分类id为2
		$category  = $this->actions_model->getTypes();//print_r($category);
		$result = $this->actions_model->getArticles($where);
		foreach($result['aaaData'] as $key => $value){
			//$result['aaData'][$key][] = $value['id'];
			$result['aaData'][$key][] = "&lt;".$value['title']."&gt;";//."<br />(".$value['title_2nd'].")";
			//$result['aaData'][$key][] = $value['title_2nd'];
			//$result['aaData'][$key][] = $category[$value['category_id']];
			$result['aaData'][$key][] = $value['create_date'];
			$result['aaData'][$key][] = $value['author'];

			if($this->session->userdata('group_name')){
				$result['aaData'][$key][] =  '<a href="'.site_url('post/actions/edit/id/'.$value['id']).'"><button class="blue tiny"><div class="ui-icon ui-icon-pencil"></div><span>修改</span></button></a>&nbsp;/&nbsp;<a onclick="delete_confirm('.$value['id'].')"><button class="red tiny"><div class="ui-icon ui-icon-trash"></div><span>删除</span></button></a>';
			}else{
				$result['aaData'][$key][] = '';
			}
		}
		
		unset($result["aaaData"]);
		echo json_encode($result);
	}

	/* 报名活动人员列表页 */
	function members(){
		$viewdata = array( 
			'title' => array('top' => '活动报名人员','small' => ''),
			'category' => '3',
			'ctl' => "actions",
			);
		$viewdata['side_current_id'] = 2;
		$this->load->view('members',$viewdata);
	}

	/* 为活动包名人员列表提供数据 */
	function members_dataTable(){
		$this->load->Model('members_model');	
		$where = 'type = "actions"'; //团购类型
		$category  = $this->actions_model->getTypes();//print_r($category);
		$result = $this->members_model->getmembers($where);
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][0] = $value['id'];
			$result['aaData'][$key][1] = $value['username'];
			$result['aaData'][$key][2] = $value['email'];
			$result['aaData'][$key][3] = $value['phone'];
			$post = $this->actions_model->getById($value['objectid']);
			$result['aaData'][$key][4] = isset($post['title']) ? $post['title'] : '';

		}
		unset($result["aaaData"]);
		echo json_encode($result);
	}
}
