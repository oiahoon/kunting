<?php include 'includes/core/document_head.php'?>
	<div id="pjax">
		<div id="wrapper" data-adminica-side-top="2">
			<?php include 'includes/components/topbar.php'?>
			<?php include 'includes/components/sidebar.php'?>
			<?php include 'includes/components/stackbar.php'?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->

			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php'?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?>
						<small><?php echo $title['small'];?></small>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php'?>
						</div>
					</h2>
					<p></p>
				</div>
				<div class="box grid_16">
					<h2 class="box_head">一些配置</h2>
					<div class="controls">
						<a href="#" class="grabber"></a>
						<a href="#" class="toggle"></a>
					</div>

					<div class="columns">
						<div class="col_30">
							<fieldset>
								<label>团购开关</label>
								<div>
									<div class="jqui_radios">
									<input type="radio" name="groupbuy_s" id="groupbuy_yes" jq-data="1" <?php if($settings['groupbuy_s']) echo 'checked="checked"';?>/><label for="groupbuy_yes">开启</label>
									<input type="radio" name="groupbuy_s" id="groupbuy_no" jq-data="0" <?php if(!$settings['groupbuy_s']) echo 'checked="checked"';?>/><label for="groupbuy_no">关闭</label>
									</div>
								</div>
							</fieldset>
							<SCRIPT LANGUAGE="JavaScript">
							<!--
								$(document).ready(function(){
									  $(".jqui_radios input[name='groupbuy_s']").change(function(){
										var val = $("input[name='groupbuy_s']:checked").attr("jq-data");//获得选中的radio的值
										$.post("<?php echo site_url('settings/groupbuy_s');?>", {groupbuy_s:val, format:'json'},  function(data) {
											//alert(data);
										});
									  });
								});
							//-->
							</SCRIPT>
						</div>
						<div class="col_70">
							<fieldset class="right">
								<label>当前置顶资讯</label>
								<div class="clearfix">
									<label><h2><a href="<?php echo site_url('post/article/edit/id/'.$top_article['id']);?>"  style="color:blue;"><?php echo $top_article['title'];?></a></h2></label>
								</div>
							</fieldset>
						</div>
					</div>
				</div>

			</div>
		</div>
<?php include 'includes/core/document_foot.php'?>