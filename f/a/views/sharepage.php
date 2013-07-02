<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php echo $title['small'];?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Kunting">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="kunting">

    <!-- Le styles -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet">
	<style>
    h1, h2, h3, .masthead p, .subhead p, .marketing h2, .lead
	{
	  font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
	  font-weight: normal;
	}
	.container {
			width: 100%;
			position: relative;
			margin: 0 auto;
	}

    </style>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.bootcss.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->
	<script>
		var _hmt = _hmt || [];
	</script>
</head>
<body>

<div class="navbar navbar-inverse navbar-static-top">
		<div class="navbar-inner">
			<a class="brand"><?php echo $title['small'];?></a>
		</div>
	</div>

<div class="container">
	<?php echo str_replace(array('&quot;','/..'),array('"',''),$share['content']);?>	
</div>
 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="//cdnjs.bootcss.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.bootcss.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstro.min.js')?>"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	$(document).ready(function(){
		$('img').each(function(){
			var link = '#';
			var img_lnk = $(this).parent('a').attr('href');
			if(img_lnk){link = img_lnk;}
			$(this).addClass("imgc").wrap('<ul class="thumbnails"></ul>').wrap('<li class="span4"></li>').wrap('<a href="'+ link +'" class="thumbnail"></div>');	
		});
		
	});
//-->
</SCRIPT>
</body>
</html>