<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展公共函数
 * 在 config/autoload.php 里面添加
 * $autoload['helper'] = array(common');
 */

/* 自定义输出函数,主要用户api接口 */
function yaoprint($data, $format = 'json')
{
	switch (strtolower($format)) {
			case 'array':
				print_r($data);
				break;
			
			default:
				echo json_encode($data);
				break;
		}
}