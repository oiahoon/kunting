<?php include 'includes/core/document_head.php'?>

	<div id="pjax">
		<div id="wrapper">
			<div class="isolate">
				<div class="center narrow">
					<div class="main_container full_size container_16 clearfix">
						<div class="box">
							<div class="block">
								<div class="section">
									<div class="alert dismissible alert_light">
										<img width="24" height="24" src="images/icons/small/grey/locked.png">
										<strong>欢迎登录后台.</strong> 请输入帐号密码登录.
									</div>
								</div>
								<form action="<?php echo site_url();?>/admin/check_login" method="post" class="validate_form">
								<fieldset class="label_side top">
									<label for="username_field">用户名<span></span></label>
									<div>
										<input type="text" id="username_field" name="username_field" class="required">
									</div>
								</fieldset>
								<fieldset class="label_side bottom">
									<label for="password_field">密码<span></span></label>
									<div>
										<input type="password" id="password_field" name="password_field" class="required">
									</div>
								</fieldset>
								<div class="button_bar clearfix">
									<button class="wide" type="submit">
										<img src="images/icons/small/white/key_2.png">
										<span>登录</span>
									</button>
									<a>
										<a><wb:share-button size="middle" appkey="2855687947" language="zh_tw" relateuid="1524346093" ></wb:share-button></a>
									</a>
								</div>
								</form>
							</div>
						</div>
					</div>
					<a href="<?php echo site_url();?>" id="login_logo"><span>Kunting</span></a>
				</div>
			</div>
		<?php include 'includes/dialogs/dialog_register.php'?>
<?php include 'includes/core/document_foot.php'?>
