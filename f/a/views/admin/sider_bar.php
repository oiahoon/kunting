<div id="sidebar">
				<a href="<?php echo base_url();?>" class="logo"><span>后台测试</span></a>
				<div class="user_box round_all clearfix">
					<img src="images/profile.jpg" width="55" alt="Profile Pic" />
					<h2><?php echo $admin_group['1'];?></h2>
					<h3><a class="text_shadow" href="#"><?php echo $this->session->userdata('manager');?></a></h3>
					<ul>
						<li><a href="#">设置</a><span class="divider">|</span></li>
						<li><a href="<?php echo base_url();?>index.php/admin/admin/logout">退出系统</a></li>
					</ul>
				</div><!-- #user_box -->

				<ul id="accordion">
					<li><a href="<?php echo base_url();?>" class="top_level"><img src="images/icons/small/grey/Home.png"/>首页</a>
						<ul class="drawer">
							<li><a href="#">Activity</a></li>
							<li><a href="#">Events</a></li>
							<li><a href="#">Tasks</a></li>
						</ul>
					</li>
					<!-- 资讯管理  -->
					<li><a href="#" class="top_level"><img src="images/icons/small/grey/Users.png"/>资讯管理</a>
						<ul class="drawer">
							<li><a href="<?php echo site_url('post/article/articleAdd');?>">添加资讯</a></li>
							<li><a href="<?php echo site_url('post/article/articleList');?>">资讯列表</a></li>
						</ul>
					</li>

					<!-- 活动管理  -->
					<li><a href="#" class="top_level"><img src="images/icons/small/grey/Users.png"/>活动管理</a>
						<ul class="drawer">
							<li><a href="<?php echo site_url('post/actions/actionsList');?>">活动列表</a></li>
							<li><a href="<?php echo site_url('post/actions/actionsAdd');?>">添加活动</a></li>

						</ul>
					</li>
					
					<!-- 团购管理  -->
					<li><a href="#" class="top_level"><img src="images/icons/small/grey/Users.png"/>团购管理</a>
						<ul class="drawer">
							<li><a href="<?php echo site_url('post/groupbuy/groupbuyList');?>">团购列表</a></li>
							<li><a href="<?php echo site_url('post/groupbuy/groupbuyAdd');?>">添加团购</a></li>

						</ul>
					</li>

					<!-- 后台用户管理  -->
					<li><a href="#" class="top_level"><img src="images/icons/small/grey/Users.png"/>后台用户管理</a>
						<ul class="drawer">
							<li><a href="<?php echo site_url('admin/admin/adminAdd');?>">添加用户</a></li>
							<li><a href="<?php echo site_url('admin/admin/adminlist');?>">用户列表</a></li>
							<li><a href="<?php echo site_url('admin/admin/groups');?>">用户组管理</a></li>
							<li><a href="<?php echo site_url('admin/admin/groupAdd');?>">添加用户组</a></li>
						</ul>
					</li>
					<li><a href="#" class="top_level"><img src="images/icons/small/grey/Cog%202.png"/>后台设置</a>
						<ul class="drawer">
							<li><a href="#">菜单管理</a></li>
							<li><a href="#">系统信息</a></li>
						</ul>
					</li>
				</ul>
				
			</div><!-- #sidebar -->
