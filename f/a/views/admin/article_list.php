<!DOCTYPE html>
<html>
	<?php include 'header.php';?>
	<?php include 'wraper.php';?>		
		
			<?php include 'sider_bar.php';?>

		<div id="main_container" class="main_container container_16 clearfix">
			
			<?php include 'top_nav.php';?>

			<div class="flat_area grid_16">
				<h2><?php echo $title;?></h2>
				
			</div>
			<div class="box grid_16 round_all">
				<table class="display article"> 
					<thead> 
						<tr> 
							<th>ID</th> 
							<th>标题</th> 
							<th>二级</th>
							<th>类型</th>
							<th>发布时间</th> 						
							<th>操作</th> 
						</tr> 
					</thead> 
					<tbody>
					<!-- 由js自动加载 -->
					</tbody> 
				</table>

			<script>
				$('.article').dataTable( {
					"bJQueryUI": true,
					"bSortClasses": false,
					"aaSorting": [[0,'asc']],		//默认排序
					"bSort": true,					//是否使用排序 
					"bAutoWidth": true,
					"bInfo": true,
					"sScrollY": "100%",	
					"sScrollX": "100%",
					"bScrollCollapse": true,
					"bRetrieve": true,
					"bProcessing": true,                    //加载数据时显示正在加载信息  
					"bServerSide": true,                    //指定从服务器端获取数据  
					"bFilter": true,                       //不使用过滤功能  
					"bLengthChange": false,                 //用户不可改变每页显示数量  
					"iDisplayLength": 20,                    //每页显示8条数据  
					"sAjaxSource": "index.php/post/article/articleList_dataTable", //获取数据的url  
					//"fnServerData": retrieveData,           //获取数据的处理函数  
					"sPaginationType": "full_numbers",      //翻页界面类型  
					"oLanguage": {                          //汉化  
						"sLengthMenu": "每页显示 _MENU_ 条记录",  
						"sZeroRecords": "没有检索到数据",  
						"sInfo": "当前数据为从第 _START_ 到第 _END_ 条数据；总共有 _TOTAL_ 条记录",  
						"sInfoEmtpy": "没有数据",  
						"sProcessing": "正在加载数据...",  
						"oPaginate": {  
						"sFirst": "首页",  
						"sPrevious": "前页",  
						"sNext": "后页",  
						"sLast": "尾页"  
						}
					}
				} );
			</script>
			</div>
			
			</div>


		</body>
	</html>
