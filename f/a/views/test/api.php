<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
			</ul>
		</div>
	</div>
		<div class="content">
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody><caption><blockquote><p><h1>Inertface Test</h4></p></blockquote></caption>
				<thead>
					<th width="30%">应用接口名称</th>
					<th>测试应用接口</th>
					<th width="30%">参数&amp;说明</th>
				</thead>
				<!-- one line ############################################## //-->
				<tr>
					<td>用户报名/参团
					<br>
					url:/members/members/memberAdd </td>
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
							<li class="require">name-&gt; 用户名</li>
							<li class="require">email-&gt; 邮箱地址</li>
							<li class="require">phone-&gt; 电话号码</li>
							<li class="require">cate-&gt; 项目类型 <br/>(活动报名:actions; 参加团购:groupbuy)</li>
							<li class="require">objectid-&gt; 项目id<br/>(也就是活动的id或者团购的id)</li>
						</ol>
					</td>
				</tr>
				<!-- ################################################### //-->
			
				<!-- one line ########################################## //-->
				<tr>
					<td>获取文章列表
					<br>
					url:/posts/articlelists</td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('posts/articlelists');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputtype">分类:</label>
									<div class="controls">
										<select id="inputtype" name="type">
											<option value="1" selected="">活动</option>
											<option value="2">资讯</option>
											<option value="3">团购</option>
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
							<li class="require">type-&gt; 分类<br/>资讯:1;活动:2;团购:3;</li>
							<li class="require">perpage-&gt; 每页记录条数</li>
							<li class="require">page-&gt; 页码</li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>获取文章内容
					<br>
					url:/posts/articledetail</td>
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
							<li class="require">id-&gt; 文章的id</li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>获取团购开关
					<br>
					url:/settings/groupbuy_s</td>
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
							<li >Need none params.</li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>短链接
					<br>
					url:/adonice/short_url</td>
					<td>
						<form class="form-horizontal" method="get" action="<?php echo site_url('adonice/shorten');?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputurl">Url:</label>
									<div class="controls">
										<input id="inputurl" type="text" name="url" value="http://www.qq.com" placeholder="输入 Url">
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
							<li class="require">url-&gt; 准备转换的url</li>
							<li class="require">type-&gt; 转换的方式</li>
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ############################################## //-->
				<tr>
					<td>用户反馈
					<br>
					url:feedback/feedback </td>
					<td>
						<form class="form-horizontal" method="post" action="<?php echo site_url('feedback/newFeedback');?>">
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
										<input id="inputemail" type="text" name="email" value="kunting@test.com" placeholder="输入邮箱地址">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputphone">电话号码:</label>
									<div class="controls">
										<input id="inputphone" type="text" name="phone" value="13521214453" placeholder="输入电话号码">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputcontent">反馈信息</label>
									<div class="controls">
										<textarea rows="3" name="content" placeholder="输入反馈信息">测试-反馈信息。测试-反馈信息。测试-反馈信息。</textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputversion">版本信息</label>
									<div class="controls">
										<input id="inputversion" type="text" name="version" value="android 1.0" placeholder="输入版本信息">
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
							<li class="require">name-&gt; 用户名</li>
							<li class="require">email-&gt; 邮箱地址</li>
							<li class="require">phone-&gt; 电话号码</li>
							<li class="require">content-&gt; 反馈的内容</li>
							<li class="require">version-&gt; 用户的版本信息</li>
						</ol>
					</td>
				</tr>
				<!-- ################################################### //-->
				<!-- one line ########################################## //-->
				<tr>
					<td>发邮件测试
					<br>
					url:adonice/emailtest</td>
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
							<li class="require">title-&gt; 邮件的标题</li>
							<li class="require">content-&gt; 邮件的内容</li>
							<li class="require">emailto-&gt; 收件人地址</li>

							<br/>邮件的发送/接受邮箱地址密码，<br/>均在后台->后台设置里面配置
						</ol>
					</td>
				</tr>
			<!-- ################################################### //-->
			<!-- one line ########################################## //-->
				<tr>
					<td>推送测试
					<br>
					url:/test/push</td>
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
							<li class="require">content-&gt; 推送的内容</li>
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
			<pre></pre>
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
		var options = { 
			target: '#resultBox .modal-body pre',   // target element(s) to be updated with server response 
		}; 
	 
		// bind to the form's submit event 
		$("a[href='#resultBox']").bind("click", function(){
			var this_form = $(this).parents("form");
			this_form.ajaxSubmit(options); 
			//return false; 
		}); 
	}); 
	//-->
	</SCRIPT>
</body></html>
