<!DOCTYPE html>
<html>
	<?php include 'header.php';?>
	<body>
		<div id="wrapper">
			<div id="topbar" class="clearfix">
				<a href="<?php echo base_url();?>" class="logo"><span>管理后台</span></a>
				<div class="user_box round_all">
					<img src="images/profile.jpg" width="55" alt="Profile Pic" />
					<h2><?php echo $user_group[-1];?></h2>
					<h3><a class="text_shadow" href="#"><?php echo $this->session->userdata('manager');?></a></h3>
					<ul>
						<li><a href="#">设置</a><span class="divider">|</span></li>
						<li><a href="<?php echo base_url();?>index.php/login/login/logout">退出系统</a></li>
					</ul>
				</div><!-- #user_box -->	
			</div><!-- #topbar -->		
		
			<?php include 'sider_bar.php';?>

		<div id="main_container" class="main_container container_16 clearfix">
			
			<?php include 'top_nav.php';?>

			<div class="flat_area grid_16">
				<h2><?php echo $title;?></h2>
				
			</div>
			<div class="box grid_16 round_all">
				<table class="display table"> 
					<thead> 
						<tr> 
							<th>ID</th> 
							<th>用户组</th> 
							<th>操作</th> 
						</tr> 
					</thead> 
					<tbody> 
					<?php if(!empty($admin_group)){
							foreach($admin_group as $k=>$v){?>
								<tr class="gradeX"> 
									<td><?php echo $k;?></td> 
									<td><?php echo $v;?></td> 
									<td><a href="index.php/admin/admin/groupDel/id/<?php echo $k;?>">删除</a>/<a href="index.php/admin/admin/groupEdit/id/<?php echo $k;?>">修改</a></td> 
								</tr> 
							<?php }}?>				
					</tbody> 
				</table>
			</div>
			
			</div>


		</body>
	</html>
