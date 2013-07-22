<?php include 'includes/core/document_head.php';?>
	<div id="pjax">
		<div id="wrapper" data-adminica-side-top="<?php echo $side_current_id;?>" data-adminica-nav-inner="1">
			<?php include 'includes/components/topbar.php';?>
			<?php include 'includes/components/sidebar.php';?>
			<?php include 'includes/components/stackbar.php';?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->

			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php';?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php';?>
						</div>
					</h2>
					
				</div>

				<div class="grid_16 box ">
					<a href="<?php echo site_url('admin/adminAdd') ;?>">
						<button class="green">
							<span>新建管理员</span>
						</button>
					</a>
				</div>

				<div class="box grid_16 single_datatable">
					<div id="dt1" class="no_margin">
						
						<table class=" admin_datatable"  style="text-align:center;">
							<thead>
								<tr>
									<th width="3%">ID</th>
									<th width="10%">用户名</th>
									<th width="25%">密码</th>
									<th width="10%">用户组</th>
									<th >上次登录日期</th>
									<th >操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($user['res'] as $key => $value) {?>
									 <tr>
									 	<td><?php echo $value['id'];?></td>
									 	<td><?php echo $value['username'];?></td>
									 	<td>密文：<?php echo str_shuffle($value['password']);?></td>
									 	<td><?php echo $admin_group[$value['group_id']];?></td>
									 	<td><?php echo $value['last_login'];?></td>
									 	<td>
									 		<?php if ($value['id'] <> 1){?>
									 		<a href="<?php echo site_url('admin/adminEdit/id/'.$value['id']);?>"><button class="blue tiny"><div class="ui-icon ui-icon-pencil"></div><span>修改</span></button></a>
									 		&nbsp;/&nbsp;<a onclick="delete_confirm(<?php echo $value['id'];?>)"><button class="red tiny"><div class="ui-icon ui-icon-trash"></div><span>删除</span></button></a>
									 		<?php }?>
									 	</td>
									 </tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
				<SCRIPT LANGUAGE="JavaScript">
				<!--

					$('#dt1 .admin_datatable').dataTable( {
						bJQueryUI: !0,
						sScrollX: "",
						bSortClasses: !1,
						aaSorting: [[0, "asc"]],
						bAutoWidth: !0,
						bInfo: !0,
						sScrollX: "101%",
						bScrollCollapse: !0,
						sPaginationType: "full_numbers",
						bRetrieve: !0,
						"bFilter": false,
						bLengthChange: false,                 //用户不可改变每页显示数量 
						bProcessing: true,                    //加载数据时显示正在加载信息  
						bServerSide: false,                    //指定从服务器端获取数据  
						//sAjaxSource: '', //获取数据的url  
						
						fnInitComplete: function() {
							$("#dt1 .dataTables_length > label > select").uniform();
							$("#dt1 .dataTables_filter input[type=text]").addClass("text");
							$(".admin_datatable").css("visibility", "visible")
						},
						oLanguage: {                          //汉化  
							"sLengthMenu": "每页显示 _MENU_ 条",  
							"sZeroRecords": "没有检索到数据",  
							"sInfo": "当前为第 _START_ 到第 _END_ 条数据；总共有 _TOTAL_ 条",  
							"sInfoEmtpy": "没有数据",  
							"sProcessing": "正在加载数据...",  
							"oPaginate": {  
								"sFirst": "首页",  
								"sPrevious": "前一页",  
								"sNext": "下一页",  
								"sLast": "尾页"  
							}
						}
					} );

					function delete_confirm(id){
						var r=confirm("确定删除?");
						if (r==true){
							window.location = "<?php echo site_url('admin/adminDel/id');?>/" + id;
						}
					}
				//-->
				</SCRIPT>
				
			</div>
		</div>

		<?php include 'includes/dialogs/dialog_welcome.php';?>
		<?php include 'includes/dialogs/dialog_logout.php';?>

<?php include 'includes/core/document_foot.php';?>
