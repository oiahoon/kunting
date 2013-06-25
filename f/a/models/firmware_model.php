<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class firmware_model extends CI_Model {
	
	var $firmware_table = "firmware";
	var $primaryKey = "id";
	var $nameField = "name";
	var $versionField = "version";
	var $urlField = "url";
	var $upload_timeField = "upload_time";
	function __construct(){
		parent::__construct();
	}
	

	/**
		返回所有的固件信息 
		
	 */
	function getAll(){
		$query = $this->db->get($this->firmware_table);
		$result = $query->result_array();
		//print_r($result);exit;
		return $result;
	}
	
	/**
		为 jquery dataTable 提供数据
	 */
	 function getfirmwares($where,$order){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array('id', 'name', 'version', 'url', 'upload_time' );
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		
		/* DB table to use */
		$sTable = $this->firmware_table;
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

	 }// end of getfirmwares




	//通过 name 查询固件信息 失败时返回空数组
	function getByName($name){
		$query = $this->db->get_where($this->firmware_table, array($this->nameField => $name));
		return($query->result_array());
	}

	//新增一条firmware
	function insertOnefirmware($firmware){
		return $this->db->insert($this->firmware_table, $firmware);
	}
	
	//通过id更新一条firmware
	function updateOnefirmware($firmware,$id){
		if(isset($firmware['id'])){unset ($firmware['id']);}
		$this->db->where('id', $id);
		return $this->db->update($this->firmware_table, $firmware); 
	}
	
	//通过 android_id 更新一条firmware
	function updateOnefirmwareByAID($firmware,$android_id){
		$this->db->where($this->android_idField, $android_id);
		return $this->db->update($this->firmware_table, $firmware); 
	}
	
	
	



	}// end of class

?>