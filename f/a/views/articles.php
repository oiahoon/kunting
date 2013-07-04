<?php include 'includes/core/document_head.php'?>
	<div id="pjax">
		<div id="wrapper" data-adminica-side-top="<?php echo $side_current_id ;?>">
			<?php include 'includes/components/topbar.php'?>
			<?php include 'includes/components/sidebar.php'?>
			<?php include 'includes/components/stackbar.php'?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->

			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php'?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php'?>
						</div>
					</h2>
					
				</div>
				<div class="box grid_16 single_datatable">
					<div id="dt1" class="no_margin">
						
						<table class=" article_datatable">
							<thead>
								<tr>
									<th>标题</th>
									<!-- <th>分类</th> -->
									<th>发布日期</th>
									<th>作者</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<!-- JQ加载数据 -->
							</tbody>
						</table>

					</div>
				</div>
				<SCRIPT LANGUAGE="JavaScript">
				<!--

					$('#dt1 .article_datatable').dataTable( {
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
						bServerSide: true,                    //指定从服务器端获取数据  
						sAjaxSource: '<?php echo site_url("/post/".$ctl."/articleList_dataTable");?>', //获取数据的url  
						
						fnInitComplete: function() {
							$("#dt1 .dataTables_length > label > select").uniform();
							$("#dt1 .dataTables_filter input[type=text]").addClass("text");
							$(".article_datatable").css("visibility", "visible")
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
							window.location = "<?php echo site_url('post/'.$ctl.'/delete/id/');?>/" + id;
						}
					}

					function ajax_push(id){
						$.ajax({ url: "<?php echo site_url('posts/push_new');?>"+'/'+id, success: function(data){
							alert("推送成功.\r\n{" + data + "}");
					    }});
					}
				//-->
				</SCRIPT>
				<style>
					a button span {
						font-size : 12px;
					}
				<style>
			</div>
		</div>

		<?php include 'includes/dialogs/dialog_welcome.php'?>
		<?php include 'includes/dialogs/dialog_logout.php'?>

<?php include 'includes/core/document_foot.php'?>
