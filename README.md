Kunting
=======

###1上传全部代码带服务器web目录，
###2导入数据库
		/data_sql/kunting.sql 导入数据库
###3修改配置文件：
		a)网站基本配置<br />
		/f/a/config/config.php<br />
		<br /> 
		找不到本文件请复制 /f/a/config/config.example.php 为 /f/a/config/config.php<br />
		<br />
		$config['appname'] = ''; 		//网站名字<br />
		$config['base_url']	= '';		//网站访问地址 如 http://jiutianyoubang.cn/<br />
		<br />

		b)数据库配置<br />
		/f/a/config/database.php<br />
		<br />
		找不到本文件请复制 /f/a/config/database.example.php 为 /f/a/config/database.php<br />
		<br />
		$db['default']['hostname'] = '';	//数据库地址<br />
		$db['default']['username'] = '';	//数据库用户名<br />
		$db['default']['password'] = '';	//数据库密码<br />
		$db['default']['database'] = '';	//数据库名<br />

		c)邮箱配置<br />
		/f/a/config/kunting_setting.php<br />
		<br />
		$config['mail_name']	='';		//网站接收/发送用户名称<br />
		$config['mail_passwd']	='';	//邮箱密码<br />
		$config['mail_address']	='';	//邮箱地址<br />
		$config['mail_smtp']	=''; 		//邮箱服务器，如：smtp.qq.com<br />
