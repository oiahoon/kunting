<?php include 'includes/core/document_head.php';?>
	<div id="pjax">
		<div id="wrapper" data-adminica-side-top="<?php echo $side_current_id;?>" data-adminica-nav-inner="5">
			<?php include 'includes/components/topbar.php';?>
			<?php include 'includes/components/sidebar.php';?>
			<?php include 'includes/components/stackbar.php';?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php';?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?> <small><?php echo $title['small'];?></small>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php';?>
						</div>
					</h2>
				</div>
				<?php if(!empty($message)){?>
				<div class="section">
					<div class="alert dismissible alert_<?php echo $message_color;?>">
						<img width="24" height="24" src="images/icons/small/white/alert_2.png">
						<?php echo $message;?>
					</div>
				</div>	
				<?php }?>
				<div class="box grid_16">
				
					<div class="block">
						<form id="article_editor" action="" method="post" class='validate_form' enctype="multipart/form-data">
						<?php if(!empty($admin_info['id'])) echo form_hidden('id', $admin_info['id']);?>

						<fieldset class="label_side top">
							<label>帐号</label>
							<div>
								<input type="text" name="username" placeholder="请输入帐号..." value="<?php echo !empty($admin_info['username'])?$admin_info['username']:'';?>" class='required'>
								<div class="required_tag tooltip hover left" title="This field is required"></div>
							</div>
						</fieldset>
						<fieldset class="label_side top">
							<label>密码</label>
							<div>
								<input type="text" name="password" placeholder="请输入密码..." value="<?php echo !empty($admin_info['password'])?"<不修改请留空>":'';?>" class='required'>
								<div class="required_tag tooltip hover left" title="This field is required"></div>
							</div>
						</fieldset>
						<fieldset class="label_side top">
							<label>用户组</label>
							<div class="clearfix">
								<select name='group_id' class="required" >
									<?php foreach ($user_group as $key => $value) {?>
										<option value="<?php echo $key;?>" <?php if(!empty($admin_info['group_id']) && $admin_info['group_id'] == $key) echo 'selected'; ?>><?php echo $value;?></option>
									<?php }?>
					
								</select>
							</div>
						</fieldset>
						<div class="button_bar clearfix">

							<button type="submit" class="dark" >
								<img src="images/icons/small/white/bended_arrow_right.png">
								<span>保存</span>
							</button>
							
							<a href="<?php echo site_url($ctl.'/adminList');?>">
								<span style="font-size:16px;padding:0 0 0 40px;">&laquo;返回列表</span>
							</a>
						</div>
						</div>
					</div>
						</form>
				</div>
				

		</div>
		<?php include 'includes/dialogs/dialog_welcome.php';?>
		<?php include 'includes/dialogs/dialog_logout.php';?>
<?php include 'includes/core/document_foot.php';?>
