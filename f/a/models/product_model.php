<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
	
	var $product_table = "product";
	var $primaryKey = "id";
	var $online_gap = 300;//在线间隔 5分钟
	var $onlineField = "online";
	var $android_idField = "android_id";
	function __construct(){
		parent::__construct();
	}
	

	/**
		返回所有的用户信息 
		$online 为是否按照在线状态
			'on'在线 'off'离线 'all'全部（默认）
	 */
	function getAll($online="all"){
		switch($online){
			//返回所有用户
			case "all" :
				break;
			//选择在线用户
			case "on" :
				$this->db->where("$this->onlineField >=", time()-$this->online_gap); //大于登陆当前时间 减去5分钟
				break;
			//选择离线用户
			case "off" :
				$this->db->where("$this->onlineField <", time()-$this->online_gap); //小于登陆当前时间 减去5分钟
				break;
		}
		$query = $this->db->get($this->product_table);
		$result = $query->result_array();
		//print_r($result);exit;
		return $result;
	}
	
	/**
		为 jquery dataTable 提供数据
	 */
	 function getProducts($where,$order){
		if($where!=""){
			$this->db->where($where);
		}
		$query = $this->db->get($this->product_table);
		$num = $query->num_rows();
        //print_r($_GET);
    	/* 
    	 * Paging
    	 */
    	$sLimit = "";
    	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
			$this->db->limit($_GET['iDisplayLength'], $_GET['iDisplayStart']);
    	}
		$resa = $this->db->get($this->product_table);
		$products = $resa->result_array();//print_r($products);exit;
		return array('products'=>$products,'total_rows'=>$num);
	 }
	
	 function getProducts2($where,$order){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array('id', 'android_id', 'status', 'login_time', 'online', 'onlinetime' );
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		
		/* DB table to use */
		$sTable = $this->product_table;
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
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaaData" =>  $rResult->result_array()
		);
		//print_r($result);exit;
		return $result;
	 }




	//通过 android_id 地址查询用户信息 失败时返回空数组
	function getByAID($android_id){
		$query = $this->db->get_where($this->product_table, array($this->android_idField => $android_id));
		return($query->row_array());
	}

	//新增一条product
	function insertOneProduct($product){
		return $this->db->insert($this->product_table, $product);
	}
	
	//通过id更新一条product
	function updateOneProduct($product,$id){
		if(isset($product['id'])){unset ($product['id']);}
		$this->db->where('id', $id);
		return $this->db->update($this->product_table, $product); 
	}
	
	//通过 android_id 更新一条product
	function updateOneProductByAID($product,$android_id){
		$this->db->where($this->android_idField, $android_id);
		return $this->db->update($this->product_table, $product); 
	}
	
	
	



	}// end of class

?>