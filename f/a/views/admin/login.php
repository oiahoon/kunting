<!DOCTYPE html>
<html>
	<head>
	<base href="<?php echo base_url();?>" />
		<meta charset="utf-8">

		<!-- iPhone, iPad and Android specific settings -->	
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1;">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		
		<title>后台登陆</title>
		
		<!-- Create an icon and splash screen for iPhone and iPad -->
		<link rel="apple-touch-icon" href="images/iOS_icon.png">
		<link rel="apple-touch-startup-image" href="images/iOS_startup.png"> 

		<link rel="stylesheet" type="text/css" href="css/all.css" media="screen">
		
		<!-- Style Switcher -->
		<link rel="stylesheet" type="text/css" href="css/theme/switcher.css" media="screen">
		<link rel="stylesheet" type="text/css" href="css/theme/switcher1.php?default=switcher.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/theme/switcher2.php?default=switcher.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/theme/switcher3.php?default=switcher.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/theme/switcher4.php?default=switcher.css" media="screen" />
		
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
			
		<!-- Load JQuery -->		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

		<!-- Load JQuery UI -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		
		<!-- Load Interface Plugins -->
		<script src="js/plugins.js"></script>
				
		<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.js"></script>
		<script type="text/javascript" src="js/quicksand/jquery.quicksand.js"></script>
		<script type="text/javascript" src="js/quicksand/custom_sorter.js"></script>
		<script type="text/javascript" src="js/quicksand/dash_sorter.js"></script>
		<script type="text/javascript" src="js/quicksand/jquery-css-transform.js"></script>
		<script type="text/javascript" src="js/quicksand/jquery-animate-css-rotate-scale.js"></script>
		<script type="text/javascript" src="js/tinyeditor/tinyeditor.js"></script>
		<script type="text/javascript" src="js/jqueryFileTree/jqueryFileTree.js"></script>
		<script type="text/javascript" src="js/DataTables/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/slidernav/slidernav.js"></script>
		

		<!-- This file configures the various jQuery plugins for Adminica. Contains links to help pages for each plugin. -->
		<script type="text/javascript" src="js/adminica/adminica_ui.js"></script>
		
	</head>
	<body>
	<form method="post" action="<?php echo site_url();?>/admin/admin/check_login" id="login_form">
		<div id="login_box" class="round_all clearfix">
		
			<label class="fields"><strong>帐号</strong><input type="text" id="username" name="username" class="indent round_all"></label>

			<label class="fields"><strong>密码</strong><input type="password" id="password" name="password" class="indent round_all"></label>
			<button class="button_colour round_all" onClick="login_form.submit()"><img width="24" height="24" alt="Locked 2" src="images/icons/small/white/Locked%202.png"><span>Login</span></button>
			
			<div id="bar" class="round_bottom">
				<label><input type="checkbox">Auto-login in future.</label>
				<a href="#">Forgot your password?</a>
			</div>		
			<a href="#" id="login_logo"><span>Adminica Pro II</span></a>
		</div>
	</form>
		<script type="text/javascript"> 
			// focus on first field in form
			$("input[type='text']:first", document.forms[0]).focus();
            
			var username = new LiveValidation('username');
			username.add( Validate.Presence );
			
            		var password = new LiveValidation('password');
			password.add( Validate.Presence );
		</script> 
	</body>
</html>
