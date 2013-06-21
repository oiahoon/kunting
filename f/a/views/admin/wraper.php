<body>
		<div id="wrapper">
			<div id="topbar" class="clearfix">
				<a href="index.html" class="logo"><span>后台</span></a>
				<div class="user_box round_all">
					<img src="images/profile.jpg" width="55" alt="Profile Pic" />
					<h2><?php echo $this->session->userdata('group_name');?></h2>
					<h3><a class="text_shadow" href="#"><?php echo $this->session->userdata('manager');?></a></h3>
					<ul>
						<li><a href="#">个人资料</a><span class="divider">|</span></li>
						<li><a href="#">设置</a><span class="divider">|</span></li>
						<li><a href="<?php echo site_url();?>/admin/admin/logout">退出后台</a></li>
					</ul>
				</div><!-- #user_box -->	
			</div><!-- #topbar -->
