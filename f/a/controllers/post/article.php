<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata("login")){
			redirect(site_url());
		}
		$this->load->Model('post_model','article_model');	
	}
	
	function index(){
		$viewdata = array( 
			'title' => array('top' => '资讯列表','small' => '(点击标题查看预览页面)'),
			'ctl' => "article",
			);
		$viewdata['side_current_id'] = 2;
		$this->load->view('articles',$viewdata);
	}

	function file_upload(){
		$this->load->library('upload');
		if ( ! $this->upload->do_upload("file")){
			$result['status'] = 0;
			$result['error'] = $this->upload->display_errors();
		} 
		else{
			$uploaddata = $this->upload->data();
			$result['status'] = 1;
			$result['filepath'] = $uploaddata['file_name']; 
		}
		echo json_encode($result);
	}
	/* 添加资讯 */
	function add(){
		
		$viewdata = array( 
			'title' => array('top' => '添加资讯','small' => '(资讯是图文结合的)'),
			'category' => '1',
			'ctl' => "article",
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
					$article['imagecover'] = $uploaddata['file_name']; 
				}
				$article['title'] = quotes_to_entities($_POST['title']['main']);
				$article['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$article['content'] = quotes_to_entities($_POST['content']);
				$article['create_date'] =  date("Y-m-d H:i:s");
				$article['author'] = $this->session->userdata['manager'];
				$article['category_id'] = '1';
				foreach($article as $key => $row){ $viewdata[$key] = $row; }
				if($this->article_model->insertOneArticle($article)){
					redirect("post/article", "refresh");
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
			'title' => array('top' => '修改资讯','small' => '(资讯是图文结合的)'),
			'category' => '1',
			'ctl' => "article",
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
					$article['imagecover'] = $this->config->item('upload_path').$uploaddata['file_name']; 
				}
				$article['title'] = quotes_to_entities($_POST['title']['main']);
				$article['title_2nd'] = quotes_to_entities($_POST['title']['2nd']);
				$article['content'] = quotes_to_entities($_POST['content']);
				foreach($article as $key => $row){ $viewdata[$key] = $row; }
				if($this->article_model->updateOneArticle($article,$_POST['id'])){
					redirect("post/article", "refresh");
				}
				else{
					$viewdata['message'] = "提交失败";
				}
			}
		}
		$params = $this->uri->uri_to_assoc(4);
		if(isset($params['id'])) $viewdata['post'] = $this->article_model->getById($params['id']);
		$viewdata['side_current_id'] = 2;
		$this->load->view('posteditor_tinymce',$viewdata);
	}

	/* 删除一条 */
	function delete(){
		$this->article_model->deletArticleById($this->uri->segment(5));
		redirect("post/article", "refresh");
	}
	
	/* 资讯置顶 只有一个置顶，其余的都恢复 */
	function topit(){
		$id = $this->uri->segment(4);
		$orders = $this->uri->segment(5);
		if($orders > 1) $this->article_model->topit($id,"1");
		else $this->article_model->untopit($id,"1");
		redirect("post/article", "refresh");
	}
	//为资讯页面提供表格数据
	function articleList_dataTable()
	{
		$where = 'category_id = 1'; //资讯的分类id为1
		$category  = $this->article_model->getTypes();//print_r($category);
		$result = $this->article_model->getArticles($where,"orders");
		foreach($result['aaaData'] as $key => $value){
			//$result['aaData'][$key][] = $value['id'];
			$result['aaData'][$key][] = "&lt;".$value['title']."&gt;";//."<br />(".$value['title_2nd'].")";
			//$result['aaData'][$key][] = $value['title_2nd'];
			//$result['aaData'][$key][] = $category[$value['category_id']];
			$result['aaData'][$key][] = $value['create_date'];
			$result['aaData'][$key][] = $value['author'];

			if($this->session->userdata('group_name')){
				$button_color = $value['orders']==1 ? "orange" : "green";
				$button_icon = $value['orders']==1 ? "minusthick" : "arrowthickstop-1-n";
				$button_text = $value['orders']==1 ? "取消置顶" : "置顶";
				$result['aaData'][$key][] =  '<a href="'.site_url('post/article/topit/'.$value['id'].'/'.$value['orders']).'"><button class="'.$button_color.' tiny"><div class="ui-icon ui-icon-'.$button_icon.'"></div><span>'.$button_text.'</span></button></a>&nbsp;/&nbsp;<a href="'.site_url('post/article/edit/id/'.$value['id']).'"><button class="blue tiny"><div class="ui-icon ui-icon-pencil"></div><span>修改</span></button></a>&nbsp;/&nbsp;<a onclick="delete_confirm('.$value['id'].')"><button class="red tiny"><div class="ui-icon ui-icon-trash"></div><span>删除</span></button></a>';
			}else{
				$result['aaData'][$key][] = '';
			}
		}
		unset($result["aaaData"]);
		//print_r($result);exit;
		echo json_encode($result);
	}
}
