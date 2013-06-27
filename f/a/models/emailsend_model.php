<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailsend_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    /* 获取数据库里面的配置 邮箱 密码 主题 */
    function getEmailConfig(){
    	$keys = array('emailusername', 'emailpassword', 'emailsubject', 'emailhost');

    	$this->db->or_where_in('key', $keys);
    	$this->db->from('settings');
		$query = $this->db->get();
		foreach ( $query->result_array() as $row){
			$result[$row['key']] = $row['value'];
		}
		return $result;
	}

	function sendEmail($config, $to, $from="昆廷", $title='',  $body='邮件正文'){

		$this->load->library('phpmailer/PHPmailer');
		$html_pre = '<STYLE type="text/css"> BODY { font-size: 14px; line-height: 1.5  } </STYLE><HTML><HEAD><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"></HEAD><BODY style="border-width:0px"><DIV>&nbsp;</DIV>';
		$html_sufix = '</BODY></html>';
		$html = $body;
		$this->phpmailer->IsSMTP(); 
		$this->phpmailer->Host 		= $config['emailhost'];  		// specify main and backup server
		$this->phpmailer->SMTPAuth 	= true;     					// turn on SMTP authentication
		$this->phpmailer->Username 	= $config['emailusername'];  	// SMTP username
		$this->phpmailer->Password 	= $config['emailpassword']; 	// SMTP password
		$this->phpmailer->From 		= $config['emailusername'];
		$this->phpmailer->FromName 	= $from;
		$this->phpmailer->AddAddress($to);
		$this->phpmailer->AddReplyTo("info@example.com", "请不要回复！");
		$this->phpmailer->WordWrap 	= 50;                                 // set word wrap to 50 characters
		$this->phpmailer->IsHTML(true);                                  // set email format to HTML
		$this->phpmailer->Subject 	= $config['emailsubject'] . " - ".$title;
		$this->phpmailer->Body    	= $html_pre.$html.$html_sufix;
		$this->phpmailer->AltBody 	= "";

		if(!$this->phpmailer->Send()){
		  return "Mailer Error: " . $this->phpmailer->ErrorInfo;
		}
		else{
			return true;
		}
	}

}