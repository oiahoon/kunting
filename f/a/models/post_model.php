<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model {
	
	var $post_table = "post";
	var $primaryKey = "id";
	var $titleField = "title";
	var $content_idField = "content_id";
	var $category_idField = 'category_id';
	var $short_linkField = 'short_link';

	function __construct(){
		parent::__construct();
	}
	
	//通过 id 查询一条资讯的信息 包括内容
	function getById($id, $obj = false){
		$this->db->select($this->post_table.'.*,content.content');
		$this->db->from($this->post_table);
		$this->db->where("`".$this->post_table."`.".$this->primaryKey , $id);
		$this->db->join('content', 'content.id = '.$this->post_table.'.content_id');
		$query = $this->db->get();
		//$query = $this->db->get_where($this->post_table, array($this->primaryKeyField => $id));
		if( $obj ) return($query->row());
		else return($query->row_array());
	}
	//get all post only from post table 
	function getAllPost(){
		$this->db->select('id');
		$this->db->from($this->post_table);
		$query = $this->db->get();
		return($query->result());
	}
	//新增一条资讯
	function insertOneArticle($article){
		$article['title'] =  str_replace('-', '_', $article['title']);
		$content = array('content' => $article['content']); //把文章里面的 单双引号都用html代码替换
		if($this->db->insert('content', $content)){
			$article['content_id'] = $this->db->insert_id();
			unset($article['content']);
			if(!$this->db->insert($this->post_table, $article)){
				$this->db->delete('content', array('id' => $article['content_id']));
			}
			else {
				$article_id = $this->db->insert_id();
				$short_link = short_url(base_url('v/'.$article_id));
				$this->putShortLinkById($article_id,$short_link);
				return true;
			}
		}
		return false;
	}
	
	//删除一条资讯
	function deletArticleById($id){
		$query = $this->db->get_where($this->post_table, array($this->primaryKey => $id));
		$result = $query->row_array();
		$this->db->delete($this->post_table, array('id' => $id)); 
		$this->db->delete('content', array('id' => $result['content_id'])); 
	}
	
	//通过id更新一条资讯 主要就是更新标题和内容
	function updateOneArticle($article,$id){
		if(isset($article['id'])) unset ($article['id']);
		
		$query = $this->db->get_where($this->post_table, array($this->primaryKey => $id));
		$result = $query->row_array();
		
		$this->db->where('id', $result['content_id']);
		$this->db->update('content', array('content' => $article['content'])); 
		
		unset($article['content']);
		if(isset($article['title'])) $article['title'] =  str_replace('-', '_', $article['title']);
		$this->db->where('id', $id);
		return $this->db->update($this->post_table, $article); 
	}
	
	/* update the short_link of one article */
	function putShortLinkById($id,$short_link)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->post_table, array($this->short_linkField => $short_link)); 
	}
	/* 置顶 */
	function topit($id,$category){
		$this->db->where('category_id', $category);
		$this->db->update($this->post_table, array("orders"=>"9")); 
		$this->db->where('id', $id);
		return $this->db->update($this->post_table, array("orders"=>"1")); 
	}
	/* 取消置顶 */
	function untopit($id,$category){
		$this->db->where('category_id', $category);
		$this->db->where('id', $id);
		return $this->db->update($this->post_table, array("orders"=>"9")); 
	}
	/* 获取置顶的文章 */
	function gettopbytype($type){
		$this->db->select("id,title");
		$this->db->from($this->post_table);
		$this->db->where($this->category_idField,  $type);
		$this->db->where("orders", "1"); 
		$this->db->limit(1);
		$query = $this->db->get();
		return($query->row_array());
	}
	// 获取所有的类型
	function getTypes($id = ''){
		$this->db->select('*');
		$this->db->from('category');
		if($id != ''){
			$this->db->where('id', $id);
		}
		$result = $this->db->get()->result_array();	
		foreach($result as $row){
			$tmp[$row['id']] = $row['name'];
		}
		return $tmp;
	}

	/* 获取分类的别名 */
	function getTypeAlias($id){
		$this->db->select('alias');
		$this->db->from('category');
		$this->db->where('id', $id);
		$result = $this->db->get()->row_array();
		if($result) return $result['alias'];
		else return false;
	}
	/**
	 * 返回文章列表
	 * 根据提交的category 来指定分类,不提供则默认所有
	 * perpage 每页条数 page 请求的页数 不提供默认第一页 20个
	 */
	function getArticlesList($category, $dead, $perpage , $page){
		$this->db->select('*');
		$this->db->from($this->post_table);
		$date_colum = 'end_date';
		if ($category != '') {
			$this->db->where($this->category_idField, $category );	
		}

		//快报的过期日期字段是holding_date
		if($category == 5){
			$date_colum = 'holding_date';
		}
		if($dead == 'expired') {
			$this->db->where($date_colum.' < ',date("Y-m-d"));
		}
		elseif($dead == 'ing') {
			$this->db->where($date_colum.' >= ',date("Y-m-d"));
		}
		$this->db->limit($perpage, ($page-1)*$perpage);
		$result['lists'] = $this->db->get()->result_array();
		/* 查询总数 */
		$this->db->from($this->post_table);
		if ($category != '') {
			$this->db->where($this->category_idField, $category );	
		}
		if($dead == 'expired') {
			$this->db->where('end_date < ',date("Y-m-d"));
		}
		elseif($dead == 'ing') {
			$this->db->where('end_date >= ',date("Y-m-d"));
		}
		$result['total'] = $this->db->count_all_results();
		return $result;
	}

	/**
	 *	为 jquery dataTable 提供数据
	 */
	 function getArticles($where,$order = ''){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array('id', 'title', 'title_2nd', 'category_id','holding_date', 'begin_date', 'end_date', 'create_date', 'author', 'orders', 'short_link');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		
		/* DB table to use */
		$sTable = $this->post_table;
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
				mysql_real_escape_string( $_GET['iDisplayLength'] );
		}
		
		
		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
						mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		//if($sOrder != '' && $order !='') $sOrder .= strireplace("ORDER BY  ", "ORDER BY  ".$order.", ", $sOrder);
		//elseif($sOrder == '' && $order !='') $sOrder = 'ORDER BY   '.$order;
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		if($sWhere != '' && $where !='') $sWhere .= " and ".$where;
		elseif($sWhere == '' && $where !='') $sWhere = ' where '.$where;
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
			FROM   $sTable
			$sWhere
			$sOrder
			$sLimit
			";
		//echo $sQuery;die;
		$rResult =  $this->db->query( $sQuery) or die(mysql_error());
		
		/* Data set length after filtering */
		$sQuery = "
			SELECT FOUND_ROWS() as total
		";
		$rResultFilterTotal =  $this->db->query( $sQuery) or die(mysql_error());
		$aResultFilterTotal = $rResultFilterTotal->result_array();
		$iFilteredTotal = $aResultFilterTotal[0]['total'];//print_r($iFilteredTotal);exit;
		
		/* Total data set length */
		$sQuery = "
			SELECT COUNT(`".$sIndexColumn."`) as total
			FROM   $sTable
		";
		$rResultTotal =  $this->db->query( $sQuery) or die(mysql_error());
		$aResultTotal = $rResultTotal->result_array();
		$iTotal = $aResultTotal[0]['total'];
		
		$result = array(
		"sEcho" => @intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaaData" =>  $rResult->result_array()
		);
		//print_r($result);exit;
		return $result;
	 }



	}// end of class

?>
