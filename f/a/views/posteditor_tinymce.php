<?php include 'includes/core/document_head.php'?>
	<div id="pjax">
		<div id="wrapper" data-adminica-nav-top="3" data-adminica-nav-inner="5">
			<?php include 'includes/components/topbar.php'?>
			<?php include 'includes/components/sidebar.php'?>
			<?php include 'includes/components/stackbar.php'?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php'?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?> <small><?php echo $title['small'];?></small>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php'?>
						</div>
					</h2>
					<p><strong>资讯</strong> 是 <strong>图文结合的</strong>,图片需要先上传再 <strong>插入</strong> 到文章里面.</p>
				</div>
				<div class="box grid_16">
				
					<div class="block">
						<form id="article_editor" action="<?php echo site_url('post/'.$ctl.'/'.$this->uri->segment(3));?>" method="post" enctype="multipart/form-data">
						<?php if($this->uri->segment(3) == 'edit') {?>
							<INPUT TYPE="hidden" NAME="id" value="<?php echo $post['id'];?>">
						<?php }?>
						<fieldset class="label_side top">
							<label>主标题<span>列表页的标题</span></label>
							<div>
								<input type="text" name="title[main]" value="<?php echo empty($post['title'])?'':$post['title'];?>">
							</div>
						</fieldset>
						<fieldset class="label_side top">
							<label>副标题<span>(如果没有就留空)</span></label>
							<div>
								<input type="text" name="title[2nd]" value="<?php echo empty($post['title_2nd'])?'':$post['title_2nd'];?>">
							</div>
						</fieldset>
						<?php if($category != $this->config->item('category')['sharepage']['id']){?>
						<fieldset class="label_side top">
							<label>封面图片<span>(用于列表页显示)</span></label>
							<div> 								
								<div class="clearfix">
									<input type="file" name="userfile" id="fileupload" class="uniform"><span><?php echo empty($post['imagecover'])?'':$post['imagecover'];?></span>
								</div>
							</div>
						</fieldset>
						<?php }?>
						<?php if($category==$this->config->item('category')['groupbuy']['id']){?>
						<fieldset class="label_side top">
							<label>标题图片<span></span></label>
							<div> 
								<div class="clearfix">
									<input type="file" name="imagetitle" id="fileupload" class="uniform"><span><?php echo empty($post['imagetitle'])?'':$post['imagetitle'];?></span>
								</div>
							</div>
						</fieldset>
						<?php }?>
						<script src="scripts/tinymce/tinymce.min.js"></script>
						<textarea id="content" class="tinyeditor" name="content"><?php echo empty($post['content'])?'':$post['content'];?></textarea>
<SCRIPT LANGUAGE="JavaScript">
	<!--
		tinymce.PluginManager.load('moxiemanager', "<?php echo base_url('scripts/tinymce/plugins/moxiemanager/plugin.min.js');?>");
		tinymce.init({
			selector: "textarea",
				height: 380,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste moxiemanager"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		});
	//-->
</SCRIPT>			
						<div class="button_bar clearfix">
							<button type="submit" class="dark"  onclick='instance.post();'>
								<img src="images/icons/small/white/bended_arrow_right.png">
								<span>Submit</span>
							</button>
						</div>
					</div>
						</form>
				</div>
				

		</div>
		<?php include 'includes/dialogs/dialog_welcome.php'?>
		<?php include 'includes/dialogs/dialog_logout.php'?>
<?php include 'includes/core/document_foot.php'?>
