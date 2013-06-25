<!DOCTYPE html>
<html>
	<?php include 'header.php';?>
	<body>
		<div id="wrapper">
			
			<?php include 'sider_bar.php';?>

		<div id="main_container" class="main_container container_16 clearfix">
			
			<?php include 'top_nav.php';?>

			<div class="flat_area grid_16">
				<h2><?php echo $action;?></h2>
				
			</div>

			<div class="box grid_8 round_all">
					<h2 class="box_head grad_colour">用户组信息</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
					<!--  错误提示  -->
					<?php if(''!=$message){?>
						<div class="alert alert_<?php $alert;?>">
						<img height="24" width="24" src="images/icons/small/white/Alarm%20Bell.png">
						<?php echo $message?>
						</div>
					<?php }?>

						<div class="block">
							<?php $hidden = array('id' => $group_info['id']);
								echo form_open('/admin/admin/groupEdit/','',$hidden); ?>
				
								<label>用户组名<?php echo form_error('group_name'); ?></label> 
								<input name="group_name" value="<?php echo $group_info['group_name']; ?>" title="输入用户组名,16个字符之内" type="text" class="large">

								<button class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span><?php echo $action;?> </span></button>
								<span style="float:right;color:#003366;font-size:16px;"><a href="index.php?/admin/admin/groups">←返回列表</a></span>
							</form>
						</div>
					</div>
				</div>
			
						

			</div>


		</body>
	</html>