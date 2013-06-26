<?php include 'includes/core/document_head.php'?>
	<div id="pjax">
		<div id="wrapper" data-adminica-nav-top="4" data-adminica-nav-inner="4">
			<?php include 'includes/components/topbar.php'?>
			<?php include 'includes/components/sidebar.php'?>
			<?php include 'includes/components/stackbar.php'?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php'?>
				<form class="validate_form" action="<?php echo base_url('adonice/systemsetting');?>" method="post">
				
			<div class="box grid_16">
				<div class="toggle_container">
					<div class="block">
						<h2 class="section">邮件配置</h2>
						<div class="columns clearfix">
							<div class="col_50">
								<fieldset class="label_side label_small top">
									<label for="text_field_inline">邮箱地址
										<span>用于发送和接收邮件的地址</span>
									</label>
									<div>
										<input type="text" name="email" id="email" value="<?php echo @$systemsetting['email']?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
							<div class="col_50">
								<fieldset class="label_side label_small top right">
									<label for="text_field_inline">邮箱密码
									<span>用于接收和发送邮件的邮箱密码</span>
									</label>
									<div>
										<input type="text" name="emailpassword" id="emailpassword" value="<?php echo @$systemsetting['emailpassword']?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="columns clearfix">
							<div class="col_50">
								<fieldset class="label_side label_small top">
									<label for="text_field_inline">邮件主题
										<span>邮件的标题</span>
									</label>
									<div>
										<input type="text" name="emailsubject" id="emailsubject" value="<?php echo @$systemsetting['emailsubject']?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box grid_16">
				<div class="toggle_container">
					<div class="block">
						<h2 class="section">系统配置</h2>
						<div class="columns clearfix">
							<div class="col_50">
								<fieldset class="label_side label_small top">
									<label for="text_field_inline">系统标题
										<span>用于标题栏显示,在config里面配置</span>
									</label>
									<div>
										<input type="text" name="systemtitle" id="systemtitle" disabled="disabled" value="<?php echo $this->config->item('appname');?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="columns clearfix">
							<div class="col_50">
								<fieldset class="label_side label_small top">
									<label for="text_field_inline">登陆帐号
										<span>用户登陆后台的帐号</span>
									</label>
									<div>
										<input type="text" name="systemuser" id="systemuser" value="<?php echo @$systemsetting['systemuser']?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
							<div class="col_50">
								<fieldset class="label_side label_small top right">
									<label for="text_field_inline">登陆密码
									<span>用于登陆后台的密码</span>
									</label>
									<div>
										<input type="text" name="systempassword" id="systempassword" value="<?php echo @$systemsetting['systempassword']?>" class="required">
										<div class="required_tag"></div>
									</div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
						
					
			<div class="box grid_16">
				<div class="toggle_container">
					<div class="block">
						<button class="dark" type="submit" onclick="javascript:'this.submit();'">
								<div class="ui-icon ui-icon-check"></div>
								<span>保存</span>
							</button>
					</div>
				</div>
			</div>
		</form>

			</div>
		</div>
		<?php include 'includes/dialogs/dialog_welcome.php'?>
		<?php include 'includes/dialogs/dialog_logout.php'?>
<?php include 'includes/core/document_foot.php'?>