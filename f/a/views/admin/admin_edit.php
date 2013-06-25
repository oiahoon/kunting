<!DOCTYPE html>
<html>
	<?php include 'header.php';?>
	<body>
		<div id="wrapper">
			
			<?php include 'sider_bar.php';?>

		<div id="main_container" class="main_container container_16 clearfix">
			
			<?php include 'top_nav.php';?>

			<div class="flat_area grid_16">
				<h2><?php echo $title;?></h2>
				
			</div>

			<div class="box grid_8 round_all">
					<h2 class="box_head grad_colour"><?php echo $title;?></h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
					<!--  错误提示  -->
					<?php if(''!=$message){?>
						<div class="alert alert_red">
						<img height="24" width="24" src="images/icons/small/white/Alarm%20Bell.png">
						<?php echo $message?>
						</div>
					<?php }?>

						<div class="block">
							<?php $hidden = array('id' => $admin_info['id']);
									echo form_open('/admin/admin/adminEdit/','',$hidden); ?>
							<label>用户类型</label>
								<div class="input_group">
									<select name="admin_group">
									<?php foreach($admin_group as $key => $value){?>
										<option value="<?php echo $key;?>" <?php if($admin_info['group_id'] == $key) echo "selected";?>><?php echo $value;?></option>
										<?php }?>
									</select> 
								</div>

								<label>用户名<?php echo form_error('username'); ?></label> 
								<input name="username" value="<?php echo $admin_info['username']; ?>" title="16个字符之内" type="text" class="large">
							
								<label>用户密码<?php echo form_error('pass'); ?></label> 
								<input name="pass" value="<?php echo set_value('password'); ?>" title="不需要修改则留空。密码需6到16位字符" type="text" maxlength="16" class="medium required">

								<button class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span><?php echo $title;?> </span></button>
								<span style="float:right;color:#003366;font-size:16px;"><a href="index.php?/admin/admin/adminlist">←返回列表</a></span>
							</form>
						</div>
					</div>
				</div>
			
						

			</div>


		</body>
	</html>