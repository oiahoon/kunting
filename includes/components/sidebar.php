<div id="sidebar" class="sidebar pjax_links">
	<div class="cog">+</div>

	<a href="index.php" class="logo"><span>Adminica</span></a>

	<div class="user_box dark_box clearfix">
		<img src="images/interface/profile.jpg" width="55" alt="Profile Pic" />
		<h2><?php echo $this->session->userdata('group_name');?></h2>
		<h3><a href="#"><?php echo $this->session->userdata('manager');?></a></h3>
		<ul>
			<li><a href="#">设置</a><span class="divider">|</span></li>
			<li><a href="login_slide.php" class="dialog_button" data-dialog="dialog_logout">登出</a></li>
		</ul>
	</div><!-- #user_box -->

	<ul class="side_accordion" id="nav_side"> <!-- add class 'open_multiple' to change to from accordion to toggles -->
		<li><a href="<?php echo site_url();?>"><img src="images/icons/small/grey/home.png"/>后台首页</a></li>

		<li><a href="#"><img src="images/icons/small/grey/documents.png"/>资讯/活动</a>
			<ul class="drawer">
				<li><a href="<?php echo site_url('post/article');?>" class="pjax">资讯列表</a></li>
				<li><a href="<?php echo site_url('post/article/add');?>" class="pjax">添加资讯</a></li>
				<li><a href="<?php echo site_url('post/actions');?>" class="pjax">活动列表</a></li>
				<li><a href="<?php echo site_url('post/actions/add');?>" class="pjax">添加活动</a></li>
				<li><a href="<?php echo site_url('post/actions/members');?>" class="pjax">报名人员</a></li>
			</ul>
		</li>
		<li><a href="#"><img src="images/icons/small/grey/shopping_cart_4.png"/>团购管理</a>
			<ul class="drawer">
				<li><a href="<?php echo site_url('post/groupbuy');?>" class="pjax">团购列表</a></li>
				<li><a href="<?php echo site_url('post/groupbuy/add');?>" class="pjax">添加团购</a></li>
				<li><a href="<?php echo site_url('post/groupbuy/members');?>" class="pjax">参团人员</a></li>
				<li><a href="<?php echo site_url('post/groupbuy/setting');?>" class="pjax">团购配置</a></li>
			</ul>
		</li>
		<li><a href="#"><img src="images/icons/small/grey/shuffle.png"/>分享网页</a>
			<ul class="drawer">
				<li><a href="<?php echo site_url('post/sharepage');?>" class="pjax">分享列表</a></li>
				<li><a href="<?php echo site_url('post/sharepage/add');?>" class="pjax">添加分享</a></li>
				<li><a href="<?php echo site_url('pull');?>" class="pjax">推送</a></li>
			</ul>
		</li>
		<li><a href="#"><img src="images/icons/small/grey/users.png"/>管理人员</a>
			<ul class="drawer">
				<li><a href="admin/adminAdd" class="pjax">添加人员</a></li>
				<li><a href="admin/adminList" class="pjax">人员列表</a></li>
			</ul>
		</li>

		<li><a href="#"><img src="images/icons/small/grey/cog_2.png"/>后台配置</a>
			<ul class="drawer">
				<li><a href="#">帐号</a></li>
				<li><a href="#">系统</a></li>
			</ul>
		</li>
	</ul>

	<div id="search_side" class="dark_box"><form><input class="" type="text" placeholder="Search Adminica..."></form></div>

	<ul id="side_links" class="side_links" style="margin-bottom:0;">
		<li><a href="#">Documentation</a>
		<li><a href="#">Support Forum</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">Subscribe</a></li>
	</ul>
</div><!-- #sidebar -->
