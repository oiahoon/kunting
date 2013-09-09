<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Push_model extends CI_Model {
	
	var $this_table = "push";
	var $primaryKey = "id";
	var $titleField = "title";
	var $contentField = "content";
	var $commandField = "command";
	var $last_push_atField = "last_push_at";
	var $created_atField = "created_at";
	var $countField = 'count';
	
	function __construct(){
		parent::__construct();
	}

	function getbyid($id)
	{
		$query = $this->db->get_where($this->this_table, array('id' => $id), 1);
		$result = $query->result();
		return (isset($result[0])) ? $result[0] : false;
	}

	function insert()
	{
		$data = array(
			$this->titleField => $this->input->post('title'),
			$this->contentField => $this->input->post('content'),
			$this->commandField => $this->input->post('command'),
			$this->last_push_atField => date('Y-m-d h:i:s',0),
			$this->created_atField => date('Y-m-d h:i:s',time()),
			$this->countField => 0,
			);
		return $this->db->insert($this->this_table, $data); 
	}

	function update($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->this_table, $data); 
	}

	function pushcount($id){
		$date = date('Y-m-d h:i:s');
		$this->db->query("UPDATE {$this->this_table} SET {$this->countField} = {$this->countField} +1, {$this->last_push_atField} = '{$date}' WHERE {$this->primaryKey}={$id} LIMIT 1");
	}
	/**
		为 jquery dataTable 提供数据
	 */
	 function getpushs($where = '',$order = ''){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array($this->primaryKey, $this->titleField, $this->contentField, $this->commandField, $this->last_push_atField, $this->created_atField, $this->countField );
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = $this->primaryKey;
		
		/* DB table to use */
		$sTable = $this->this_table;
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

	 }// end of getmembers
}