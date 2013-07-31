<!DOCTYPE html>
<html xmlns:wb=“http://open.weibo.com/wb”>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<script src=" http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=2855687947" type="text/javascript" charset="utf-8"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style>
		.content {
			width: 960px;
			position: relative;
			margin: 0 auto;
			line-height: 22px;
			font: 12px/1em "Microsoft Yahei", "冬青黑体简体中文 w3", Arial, Helvetica, sans-serif, "宋体"
		}
		.describe {
			font-size: 11px;
			color: #999;
		}
		.require {
			color: #f00;
		}
		
	</style>
		<title>接口测试 <?php echo @$title2nd;?> </title>
	</head>
	<body>
	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand" href="#">项目测试</a>
			<ul class="nav">
				<li class="active"><a href="#">api接口测试</a></li>
				<li><a href="#sina_shorten">sina短链接口</a></li>
			</ul>
			<ul class="nav pull-right">
				<li>
					<a><wb:follow-button uid="1524346093" type="red_1" width="67" height="24" ></wb:follow-button>	</a>
				</li>
				<li class="pull-right">
					<a><wb:share-button size="middle" appkey="2855687947" language="zh_tw" relateuid="1524346093" ></wb:share-button></a>
				</li>
			</ul>
		</div>
	</div>
		<div class="content">
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody><caption><span class="badge badge-inverse"><p><h1>Inertface Test</h4></p></span></caption>
				<thead>
					<th width="30%">应用接口名称</th>
					<th>测试应用接口</th>
					<th width="30%">参数&amp;说明</th>
				</thead>
				<!-- one line ############################################## //-->
				<tr>
					<td>用户报名/参团
					<br>
					url: <code>/members/members/memberAdd</code> </td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('members/members/memberAdd');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputname">用户名:</label>
									<div class="controls">
										<input id="inputname" type="text" name="name" value="" placeholder="输入用户名">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputemail">Email:</label>
									<div class="controls">
										<input id="inputemail" type="text" name="email" value="" placeholder="输入邮箱地址">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputphone">电话号码:</label>
									<div class="controls">
										<input id="inputphone" type="text" name="phone" value="" placeholder="输入电话号码">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputcate">选择类型:</label>
									<div class="controls">
										<select id="inputcate" name="cate">
										<option value="actions" selected="">活动报名</option>
										<option value="groupbuy">团购参团</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputobjectid">项目ID</label>
									<div class="controls">
										<input id="inputobjectid" type="text" name="objectid" value="" placeholder="输入项目ID">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputdatatype">数据类型：</label>
									<div class="controls">
									<select id="inputdatatype" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">用户名</span> <code>name</code></li>
							<li><span class="label label-important">邮箱地址</span> <code>email</code></li>
							<li><span class="label label-important">电话号码</span> <code>phone</code></li>
							<li><span class="label label-important">项目类型</span> <code>cate</code><p class="muted">(活动报名:actions; 参加团购:groupbuy)</p></li>
							<li><span class="label label-important">项目id</span> <code>objectid</code><p class="muted">(也就是活动的id或者团购的id)</p></li>
							
						</ol>
					</td>
				</tr>
				<!-- ################################################### //-->
			
				<!-- one line ########################################## //-->
				<tr>
					<td>获取文章列表
					<br>
					url: <code>/posts/articlelists</code></td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('posts/articlelists');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputtype">分类:</label>
									<div class="controls">
										<select id="inputtype" name="type">
											<option value="1" selected="">资讯</option>
											<option value="2">活动</option>
											<option value="3">团购</option>
											<option value="5">快报</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputdead">过期类型:</label>
									<div class="controls">
										<select id="inputdead" name="dead">
											<option value="" selected="">不限</option>
											<option value="expired">过期</option>
											<option value="ing">未过期</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputperpage">每页条数:</label>
									<div class="controls">
										<input id="inputperpage" type="text" name="perpage" value="20" placeholder="输入每页条数">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputpage">页码:</label>
									<div class="controls">
										<input id="inputpage" type="text" name="page" value="1" placeholder="输入页码">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="inputdatatype">数据类型：</label>
									<div class="controls">
									<select id="inputdatatype" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">分类</span> <code>type</code><p class="muted">资讯:1;活动:2;团购:3;快报:5;</p></li>
							<li><span class="label label-info">过期类型</span> <code>dead</code><p class="muted">不限:空(不传);未过期:ing;过期:expired;</p></li>
							<li><span class="label label-important">每页记录条数</span> <code>perpage</code></li>
							<li><span class="label label-important">页码</span> <code>page</code></li>
							<p><em>orders</em> 字段为<strong>1</strong>表示置顶</p>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>获取文章内容
					<br>
					url: <code>/posts/articledetail</code></td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('posts/articledetail');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputid">文章ID:</label>
									<div class="controls">
										<input id="inputid" type="text" name="id" value="10" placeholder="输入文章的ID">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="inputdatatype">数据类型：</label>
									<div class="controls">
									<select id="inputdatatype" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">文章的id</span> <code>id</code></li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>获取团购开关
					<br>
					url: <code>/settings/groupbuy_s</code></td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('settings/groupbuy_s');?>">
							<fieldset>

								<div class="control-group">
									<label class="control-label" for="inputdatatype">数据类型：</label>
									<div class="controls">
									<select id="inputdatatype" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><p class="info">不需要参数</p></li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr id="sina_shorten">
					<td>新浪短链接口
					<br>
					url: <code>/adonice/short_url</code></td>
					<td>
						<form class="form-horizontal" method="get" action="<?php echo site_url('adonice/shorten');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputurl">Url:</label>
									<div class="controls">
										<input id="inputurl" type="text" name="url" value="http://www.sina.com" placeholder="输入 Url">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="inputformat">数据类型：</label>
									<div class="controls">
									<select id="inputformat" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">准备转换的url</span> <code>url</code></li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ############################################## //-->
				<tr>
					<td>用户反馈
					<br>
					url: <code>feedback/newFeedback</code> </td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('feedback/newFeedback');?>">
							<fieldset>
								
								<div class="control-group">
									<label class="control-label" for="inputcontact">联系方式:</label>
									<div class="controls">
										<input id="inputcontacte" type="text" name="contact" value="13521214453" placeholder="输入联系方式">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputcontent">反馈信息</label>
									<div class="controls">
										<textarea rows="3" name="content" placeholder="输入反馈信息">测试-反馈信息。测试-反馈信息。测试-反馈信息。</textarea>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="inputdatatype">数据类型：</label>
									<div class="controls">
									<select id="inputdatatype" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">联系方式</span> <code>contact</code></li>
							<li><span class="label label-important">反馈的内容</span> <code>content</code></li>
						</ol>
					</td>
				</tr>
				<!-- ################################################### //-->
				<!-- one line ########################################## //-->
				<tr>
					<td>发邮件测试
					<br>
					url: <code>adonice/emailtest</code></td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('adonice/emailtest');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputtitle">标题:</label>
									<div class="controls">
										<input id="inputtitle" type="text" name="title" value="" placeholder="输入邮件标题">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputcontent">内容:</label>
									<div class="controls">
										<textarea rows="3" name="content" placeholder="输入邮件">测试-邮件内容。测试-邮件内容。测试-邮件内容。</textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputemailto">收件人:</label>
									<div class="controls">
										<input id="inputemailto" type="text" name="emailto" value="" placeholder="输入收件人地址">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputformat">数据类型：</label>
									<div class="controls">
									<select id="inputformat" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">邮件的标题</span> <code>title</code></li>
							<li><span class="label label-important">邮件的内容</span> <code>content</code></li>
							<li><span class="label label-important">收件人地址</span> <code>emailto</code></li>
							<p class="info">邮件的发送/接受邮箱地址、密码，</p><p class="info">均在<strong>后台</strong>-><strong>后台设置</strong>里面配置</p>

							<br/>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>推送测试
					<br>
					url: <code>/test/push</code></td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('test/push');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputcontent">内容:</label>
									<div class="controls">
										<textarea rows="3" name="content" placeholder="输入内容">测试-推送内容。测试-推送内容。测试-推送内容。</textarea>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="inputformat">数据类型：</label>
									<div class="controls">
									<select id="inputformat" name="format">
										<option value="json" selected="">JSON</option>
										<option value="array">PHP数组</option>
									</select>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<a href="#resultBox" role="button" class="btn" data-toggle="modal">提交</a>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
					<td>
						<ol>
							<li><span class="label label-important">推送的内容</span> <code>content</code></li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			</tbody></table>
		</div>

		<!-- 结果页面弹出层 -->
		<div id="resultBox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">测试结果</h3>
		  </div>
		  <div class="modal-body">
		  <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
		  </div>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
		  </div>
		</div>
		<!-- ################ -->
	<SCRIPT LANGUAGE="JavaScript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></SCRIPT>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="scripts/jquery.form.js"></script>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	$(document).ready(function() { 
		var options = { success: function(data) {
				$('#resultBox .modal-body').html('<pre>'+data+"</pre>");
			}
			//target: '#resultBox .modal-body pre',   // target element(s) to be updated with server response 
		}; 
		// bind to the form's submit event 
		$("a[href='#resultBox']").bind("click", function(){	
			//一个动画效果
			var progressbar = '<div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>';
			$('#resultBox .modal-body').html(progressbar);
			$('.bar').attr("style",'width: 0%;').animate({width: "100%"},"slow");	
			var this_form = $(this).parents("form");
			this_form.ajaxSubmit(options); 
			//return false; 
		}); 

	}); 

	//-->
	</SCRIPT>
</body></html>
