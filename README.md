kunting
=======

1		上传全部代码带服务器web目录，
2		导入数据库
		/data_sql/kunting.sql 导入数据库
3		修改配置文件：
	a)网站基本配置
		/f/a/config/config.php
		
		找不到本文件请复制 /f/a/config/config.example.php 为 /f/a/config/config.php
		
		$config['appname'] = ''; 		//网站名字
		$config['base_url']	= '';		//网站访问地址 如 http://jiutianyoubang.cn/
		
	b)数据库配置
		/f/a/config/database.php
		
		找不到本文件请复制 /f/a/config/database.example.php 为 /f/a/config/database.php
		
		$db['default']['hostname'] = '';	//数据库地址
		$db['default']['username'] = '';	//数据库用户名
		$db['default']['password'] = '';	//数据库密码
		$db['default']['database'] = '';	//数据库名
	
	c)邮箱配置
		/f/a/config/kunting_setting.php
		
		$config['mail_name']	='';		//网站接收/发送用户名称
		$config['mail_passwd']	='';	//邮箱密码
		$config['mail_address']	='';	//邮箱地址
		$config['mail_smtp']	=''; 		//邮箱服务器，如：smtp.qq.com

