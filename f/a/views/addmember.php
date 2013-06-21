<!DOCTYPE html>
<html>
	
	<body>
		

						<div class="block">
						
							<?php echo form_open('/members/members/memberAdd'); ?>
							<label>类型</label>
							<input name="cate" type="text" value="actions" />

							<label>用户名</label> 
							<input name="name" value="dingj" type="text" />
						
							<label>Email</label> 
							<input name="email" value="ding@qq.com" type="text" />

							<label>电话</label> 
							<input name="phone" value="13115212649" type="text" />
							
							<label>Object</label> 
							<input name="objectid" value="12" type="text" />
							
							<input type="submit" value="提交">
							</form>
						</div>

		</body>
	</html>
