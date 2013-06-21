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
				<table class="display product"> 
					<thead> 
						<tr> 
							<th>用户ID</th> 
							<th>设备ID</th> 
							<th>状态</th>
							<th>最后登陆时间</th> 
							<th>在线状态</th>
							<th>在线时长</th>
							<th>操作</th> 
						</tr> 
					</thead> 
					<tbody> <!--
					<?php if(!empty($products)){
							foreach($products as $k=>$v){?>
								<tr class="gradeX"> 
									<td><?php echo $v['id']?></td> 
									<td><?php echo $v['android_id']?></td> 
									<td><?php echo $v['type']?></td>
									<td><?php echo $v['login_time']?></td>
									<td><?php echo $v['online']?></td>
									<td><?php echo $v['sum_time']?></td>
									<td>
									<?php if($v['status']==1){?>
									<a href="index.php/product/product/kickUser/<?php echo $v['id'];?>"><font color="red">禁用</font></a>
									<?php }else{?>
									<a href="index.php/product/product/recoverUser/<?php echo $v['id'];?>"><font color="green">恢复</font></a>
									<?php }?>
									</td> 
								</tr> 
							<?php }}?>
							-->
					
					</tbody> 
				</table>

			<script>
				$('.product').dataTable( {
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
					"sAjaxSource": "index.php/product/product/productList_dataTable", //获取数据的url  
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
