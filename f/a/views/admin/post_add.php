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
							<?php echo form_open('/admin/admin/adminAdd'); ?>

								
								<label>标题<?php echo form_error('title'); ?></label> 
								<input name="title" value="<?php echo set_value('title'); ?>" title="16个字符之内" type="text" class="large required">
								
								<label>二级标题<?php echo form_error('title2nd'); ?></label> 
								<input name="title2nd" value="<?php echo set_value('title2nd'); ?>" title="16个字符之内,没有则留空" type="text" class="large">
								
								<label>详细内容<?php echo form_error('content'); ?></label>
								<textarea name="content" class="required"><?php echo set_value('content'); ?></textarea>
								<input name="content" value="<?php echo set_value('content'); ?>" title="密码需6到16位字符" type="text" maxlength="16" class="medium required">

								<button class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span><?php echo $action;?></span></button>
								<span style="float:right;color:#003366;font-size:16px;"><a href="<?php echo site_url('/post/article/articleList');?>">←返回列表</a></span>
							</form>
						</div>
					</div>
				</div>
			
			</div>


		</body>
	</html>
