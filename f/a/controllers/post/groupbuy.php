<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groupbuy extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(site_url());
		}
		$this->load->Model('post_model','groupbuy_model');	
	}
	
	function index(){
		$viewdata = array( 
			'title' => array('top' => '团购列表','small' => '(点击标题查看预览页面)'),
			'ctl' => "groupbuy",
			);
		$viewdata['side_current_id'] = 3;
		$this->load->view('articles',$viewdata);
	}
	
	/* 添加资讯 */
	function add(){
		$viewdata = array( 
			'title' => array('top' => '添加团购','small' => '(团购是图文结合的)'),
			'category' => '3',
			'ctl' => "groupbuy",
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
				if ( $this->upload->do_upload()){
					$uploaddata = $this->upload->data();
					$groupbuy['imagecover'] = $this->config->item('upload_path').$uploaddata['file_name']; 
				}
				if ( $this->upload->do_upload("imagetitle")){
					$uploaddata = $this->upload->data();
					$groupbuy['imagetitle'] = $this->config->item('upload_path').$uploaddata['file_name']; 
				}
				$groupbuy['title'] = quotes_to_entities($_POST['title']['main']);
				$groupbuy['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$groupbuy['content'] = quotes_to_entities($_POST['content']);
				$groupbuy['begin_date'] = $this->input->post('begin_date');
				$groupbuy['end_date'] = $this->input->post('end_date');
				$groupbuy['create_date'] =  date("Y-m-d H:i:s");
				$groupbuy['author'] = $this->session->userdata['manager'];
				$groupbuy['category_id'] = '3';
				if($this->groupbuy_model->insertOneArticle($groupbuy)){
					redirect("post/groupbuy", "refresh");
				}
				else{
					foreach($article as $key => $row){
						$viewdata[$key] = $row;
					}
					$viewdata['message'] = "添加失败";
				}
			}	
		}
		$viewdata['side_current_id'] = 3;
		$this->load->view('posteditor_tinymce',$viewdata);
	}
	/* 修改资讯 */
	function edit(){
		$viewdata = array( 
			'title' => array('top' => '修改团购','small' => '(团购是图文结合的)'),
			'category' => '3',
			'ctl' => "groupbuy",
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
				if ( $this->upload->do_upload()){
					$uploaddata = $this->upload->data();
					$groupbuy['imagecover'] = $this->config->item('upload_path').$uploaddata['file_name']; 
				}
				if ( $this->upload->do_upload("imagetitle")){
					$uploaddata = $this->upload->data();
					$groupbuy['imagetitle'] = $this->config->item('upload_path').$uploaddata['file_name']; 
				}
				$groupbuy['title'] = quotes_to_entities($_POST['title']['main']);
				$groupbuy['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$groupbuy['content'] = quotes_to_entities($_POST['content']);
				$groupbuy['begin_date'] = $this->input->post('begin_date');
				$groupbuy['end_date'] = $this->input->post('end_date');
				if($this->groupbuy_model->updateOneArticle($groupbuy,$_POST['id'])){
					redirect("post/groupbuy", "refresh");
				}
				else{
					foreach($article as $key => $row){
						$viewdata[$key] = $row;
					}
					$viewdata['message'] = "提交失败";
				}
			}
		}
		$params = $this->uri->uri_to_assoc(4);
		if(isset($params['id'])) $viewdata['post'] = $this->groupbuy_model->getById($params['id']);
		$viewdata['side_current_id'] = 3;
		$this->load->view('posteditor_tinymce',$viewdata);
	}

	/* 删除一条 */
	function delete(){
		$this->groupbuy_model->deletArticleById($this->uri->segment(5));
		redirect("post/groupbuy", "refresh");
	}
	
	//为资讯页面提供表格数据
	function articleList_dataTable()
	{
		$where = 'category_id = 3'; //团购的分类id为3
		$category  = $this->groupbuy_model->getTypes();//print_r($category);
		$result = $this->groupbuy_model->getArticles($where);
		foreach($result['aaaData'] as $key => $value){
			$title_color = $value['orders']==1? 'red' : 'blue';
			$result['aaData'][$key][] = '<a onclick="ajax_push('.$value['id'].')" title="推送"><button class="orange tiny has_text img_icon"><img src="images/icons/small/white/magic_mouse.png"><span>推送</span></button></a>&nbsp;' . "&lt;<font color=".$title_color.">".$value['title']."</font>&gt;"."<br /><a href='".$value['short_link']."' taget='_blank'>".$value['short_link']."</a>";
			$result['aaData'][$key][] = $value['orders'];
			$result['aaData'][$key][] = $value['create_date'];
			$result['aaData'][$key][] = $value['author'];

			if($this->session->userdata('group_name')){
				$result['aaData'][$key][] =  '<a href="'.site_url('post/groupbuy/edit/id/'.$value['id']).'"><button class="blue tiny"><div class="ui-icon ui-icon-pencil"></div><span>修改</span></button></a>&nbsp;/&nbsp;<a onclick="delete_confirm('.$value['id'].')"><button class="red tiny"><div class="ui-icon ui-icon-trash"></div><span>删除</span></button></a>';
			}else{
				$result['aaData'][$key][] = '';
			}
		}
		unset($result["aaaData"]);
		echo json_encode($result);
	}
	
	/* 参团人员列表页 */
	function members(){
		$viewdata = array( 
			'title' => array('top' => '参团人员','small' => ''),
			'category' => '3',
			'ctl' => "groupbuy",
			);
		$viewdata['side_current_id'] = 3;
		$this->load->view('members',$viewdata);
	}

	/* 为参团人员列表提供数据 */
	function members_dataTable(){
		$this->load->Model('members_model');	
		$where = 'type = "groupbuy"'; //团购类型
		$category  = $this->groupbuy_model->getTypes();//print_r($category);
		$result = $this->members_model->getmembers($where);
		foreach($result['aaaData'] as $key => $value){
			$result['aaData'][$key][0] = $value['id'];
			$result['aaData'][$key][1] = $value['username'];
			$result['aaData'][$key][2] = $value['email'];
			$result['aaData'][$key][3] = $value['phone'];
			$post = $this->groupbuy_model->getById($value['objectid']);
			$result['aaData'][$key][4] = isset($post['title']) ? $post['title'] : '';
		}
		unset($result["aaaData"]);
		echo json_encode($result);
	}
}
