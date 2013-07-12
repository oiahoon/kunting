<?php
/* 上传文件配置 */
$config['upload_path'] = './uploads/';
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = '5000'; //单位kb,为0则不限制大小, 同时受php.ini限制 
$config['max_width'] = '1024';
$config['max_height'] = '768';
$config['overwrite'] = FALSE; //不允许覆盖
$config['encrypt_name'] = TRUE; //自动加密重命名
$config['remove_spaces'] = TRUE; //将文件名的空格替换为下划线

	

		