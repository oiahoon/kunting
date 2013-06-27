<?php
/**
	file 'user_group.php'
	
 */
$config['user_group'] = array(
	'-1' => '管理员',
	'1' => '普通用户',
	'0' => '未激活用户',
	);

$congfig['groupbuy_s'] = array(
	'1' => "开启",
	'0' => "关闭"
);
$config['category'] = array(
	'article' => array('id'=>'1','name' => "资讯"),
	'actions' => array('id'=>'2','name' => "活动"),
	'groupbuy' => array('id'=>'3','name' => "团购"),
	'sharepage' => array('id'=>'4','name' => "分享"),
);

$config['mail_name']='焦常云';
$config['mail_passwd']='19870511';
$config['mail_address']='4296411@qq.com';
$config['mail_smtp']='smtp.qq.com';
$config['mail_smtp_port']=25;