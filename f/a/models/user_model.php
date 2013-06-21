<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	//返回用户组数组
	function get_user_group(){
		$table = 'user_group';
		$query = $this->db->get($table);
		foreach( $query -> result_array() as $row){
			$result[$row['id']] = $row['group_name'];
		}
		return $result;
	}
	/**
		根据id返回一个用户组的信息
	 */
	function get_group_by_id($id){
		$table = 'user_group';
		$query = $this->db->get_where($table, array('id' => $id));
		return($query->row_array());
	}
	/**
		添加用户组
	 */
	function group_add(){
		$table = 'user_group';
		$group['group_name'] = $_REQUEST['group_name'];
		return $this->db->insert($table, $group);
	}
	/**
		更新用户组信息
	 */
	function group_update(){
		$table = 'user_group';
		$this->db->where('id', $_REQUEST['id']);
		$group['group_name'] = trim($_REQUEST['group_name']);
		return $this->db->update($table, $group);
	}
	/**
		根据id删除一个用户组
	 */
	function group_del($id){
		$table = 'user_group';
		if($this->db->delete($table, array('id' => $id))){
			return true;
		} 
		else{return false;}
		
	}
	function user_list($table,$url,$uri,$start_row,$where,$order){
		if($where!=""){
			$this->db->get_where($where);
		}
		if(!is_numeric($start_row)){
			$start_row=0;
		}
		$query = $this->db->get($table);
		$num = $query->num_rows();

		$conf['per_page']=20;//每页显示数
		$conf['total_rows']=$num;//总共多少行
		$conf['base_url']=$url;
		$conf['uri_segment']=$uri;	
		$conf['prev_link']="上一页";
		$conf['next_link']="下一页";
		$conf['first_link']="首页";
		$conf['last_link']="尾页";
		$conf['num_links']=5;
		$this->load->library('pagination',$conf);
		$links=$this->pagination->create_links();
		$perpage=20;//
		$start=$start_row;
		$sqla="select * from $table  order by $order  desc limit ".$start_row.",".$perpage;
		//$sqla="select * from $table  order by $order ";
		$resa = $this->db->query($sqla);
		$res=$resa->result_array();		
		return array('res'=>$res,'total_rows'=>$conf['total_rows'],'links'=>$links,'per_page'=>$conf['per_page']);
	}
	
	/**
		用户注册
		$sendmail 为注册成功时是否发送邮件通知
		当管理员后台添加用户时，不发送通知
	 */
	function user_reg($sendmail = true){
		$table = 'users';
		$this->load->library('phpmailer/PHPmailer');
		$p_s = trim($this->config->item('pass_security'));
		$user['email'] = $_REQUEST['email'];
		$user['username'] = (!isset($_REQUEST['username']) || trim($_REQUEST['username']) =='')?$_REQUEST['email']:trim($_REQUEST['username']);
		//如果不是后台指定添加的用户组，用户注册的默认为未激活用户 status = 0
		$user['status'] = (!isset($_REQUEST['user_group']) || trim($_REQUEST['user_group']) =='')?0:trim($_REQUEST['user_group']);
		if($p_s!=''){$user['password']=$p_s($_REQUEST['pass']);}
		else{$user['password']=$_REQUEST['pass'];	}
		$query = $this->db->get_where($table,array('email'=>$user['email']));
		//email存在
		if($query->num_rows()>0){return array('status'=>'0','message'=>'邮箱已被使用');}
		$res = $this->db->insert($table,$user);
		//成功
		if($res){
			//是否发送邮件
			if($sendmail){
				$data = array('email' => $user['email']);
				$v = self::key_encode($data);
				$email_from = $this->config->item('email_from');
				$subject = '欢迎注册';
				$html = '你注册的邮箱地址为:'.$user['email']."<br><a href='http://android.1bo.tv/userSys/index.php?/adonice/activate/&v=".$v."'>激活邮箱</a><br/>";
				if(self::emailSend($user['email'],$email_from,$subject,$html)){
					return array('status'=>'1','message'=>'注册成功');
				}
				else{
					return array('status'=>'0','message'=>'注册失败');
				}
			}
			else{return array('status'=>'1','message'=>'注册成功');}
		}
		//失败
		else{return array('status'=>'0','message'=>'注册失败');}
	}
	/**
		用户激活
	 */
	function user_activate(){
		$table = 'users';
		$p_s = trim($this->config->item('pass_security'));
		$data = self::key_decode($_REQUEST['v']);
		$query = $this->db->get_where($table, array('email' => $data['email']));
		$temp = $query->row_array();
		if($p_s!=''){$password=$p_s($_REQUEST['pass']);}
		else{$password=$_REQUEST['pass'];}
		if($temp['status'] == 1){return array('status'=>'0','message'=>'已经激活过了');}
		if($temp['password'] == $password){
			$this->db->where('email', $data['email']);
			$user['status'] = '1';
			if($this->db->update($table, $user)){
				return array('status'=>'1','message'=>'激活成功');
			}
			else{
				return array('status'=>'0','message'=>'激活失败');
			}
		}
		else{
			return array('status'=>'0','message'=>'密码错误');
		}


	}
	/**
		用户信息更新
	 */
	function user_update(){
		$table = 'users';
		$p_s = trim($this->config->item('pass_security'));
		$p_s = trim($this->config->item('pass_security'));
		$user['email'] = $_REQUEST['email'];
		$user['username'] = (trim($_REQUEST['username']) =='')?$_REQUEST['email']:trim($_REQUEST['username']);
		$user['status'] = (!isset($_REQUEST['user_group']) || trim($_REQUEST['user_group']) =='')?1:trim($_REQUEST['user_group']);
		if('' != $_REQUEST['pass']){
			if($p_s!=''){$user['password']=$p_s($_REQUEST['pass']);}
			else{$user['password']=$_REQUEST['pass'];}
		}
		$this->db->where('uid', $_REQUEST['uid']);
		if($this->db->update($table, $user)){
			return true;
		} 
		else{return false;}
	}
	/**
		根据uid删除一个用hu
	 */
	function user_del($uid){
		$table = 'users';
		if($this->db->delete($table, array('uid' => $uid))){
			return true;
		} 
		else{return false;}
		
	}
	/**
		根据uid查询一个用户的信息
	 */
	function get_user_by_uid($uid){
		$table = 'users';
		if($query = $this->db->get_where($table,array('uid'=>$uid))){
			return $query->row_array();
		}
		else{
			return false;
		}
	}
	/**
		用户登录
	 */
	function user_login(){
		$table = 'users';
		$p_s = trim($this->config->item('pass_security'));
		$user['email'] = $_REQUEST['email'];
		if($p_s!=''){$user['password']=$p_s($_REQUEST['pass']);}
		else{$user['password']=$_REQUEST['pass'];	}
		$query = $this->db->get_where($table,array('email'=>$user['email'],'password'=>$user['password']));
		$result = $query->row_array();
		//用户密码正确
		if(!empty($result) && $result['status'] != 0){return array('status'=>'1','message'=>'登陆成功');}
		elseif(!empty($result) && $result['status'] == 0){return array('status'=>'0','message'=>'邮箱未激活');}
		//用户密码不配
		else{return array('status'=>'0','message'=>'请输入正确的email和密码');}
	}

	function user_reset(){
		//$this->load->library('email');
		$this->load->library('phpmailer/PHPmailer');
		$table = 'users';
		$user['email'] = $_REQUEST['email'];
		$reset_key = random_string('alnum',11);
		$query = $this->db->get_where($table,array('email'=>$user['email']));
		//用户存在
		if($query->num_rows()>0){
			$this->load->helper('email');
			if (valid_email($user['email'])){
				$data = array('email' => $user['email'],'reset_key' => $reset_key);
				$v = self::key_encode($data);
				$email_from = $this->config->item('email_from');
				$subject = '请重设密码';
				$html = "您提交了找回密码申请，请点击下面的链接进入设置新密码页面。<br/><a href='http://android.1bo.tv/userSys/index.php?/adonice/passReset/&v=".$v."'>重置密码</a><br/>您也可以复制下面的链接到浏览器，进行新密码的设置：<br/>http://android.1bo.tv/userSys/index.php?/adonice/passReset/&v=".$v;
				$result['status']=self::emailSend($user['email'],$email_from,$subject,$html,$reset_key);
				if($result['status'] == '0'){$result['message'] == '请重试';}
			}
			else{
				$result = array('status'=>'0','message'=>'请输入正确的邮箱地址');
			}
		}
		//用户不存在
		else{$result = array('status'=>'0','message'=>'该邮箱未注册');}
		return $result;
	}

	function reset_check(){
		$table = 'users';
		$p_s = trim($this->config->item('pass_security'));
		$data = self::key_decode($_REQUEST['v']);
		$email = $data['email'];
		$reset_key = $data['reset_key'];
		if($p_s!=''){$user['password']=$p_s($_REQUEST['pass']);}
		else{$user['password']=$_REQUEST['pass'];	}
		$this->db->select('reset_key');
		$query = $this->db->get_where($table, array('email' => $email));
		$temp = $query->row_array();
		if($temp['reset_key'] == $reset_key){
			$this->db->where('email',$email);
			if($this->db->update($table,$user)){
				self::reset_key($email,'');
				return '1';
			}else{
				return '0';
			}
		}
		else{
			return '0';
		}
	}

	function reset_key($email,$key){
		$table = 'users';
		$user['reset_key'] = $key;
		$this->db->where('email',$email);
		$this->db->update($table,$user);
	}
	
	function emailSend($email_to,$email_from = '丁继勇',$subject='邮件标题',$html='邮件正文',$reset_key=''){
		//$html_pre = '<STYLE type="text/css"> BODY { font-size: 14px; line-height: 1.5  } </STYLE><HTML><HEAD><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"></HEAD><BODY style="border-width:0px"><DIV>&nbsp;</DIV>';
		//$html_sufix = '</BODY></html>';
		$html = $html;
		$this->phpmailer->IsSMTP(); 
		$this->phpmailer->Host = "smtp.exmail.qq.com";  // specify main and backup server
		$this->phpmailer->SMTPAuth = true;     // turn on SMTP authentication
		$this->phpmailer->Username = $this->config->item('smtp_user');  // SMTP username
		$this->phpmailer->Password = $this->config->item('smtp_pass');; // SMTP password
		$this->phpmailer->From = $this->config->item('smtp_user');
		$this->phpmailer->FromName = $email_from;
		$this->phpmailer->AddAddress($email_to);
		$this->phpmailer->AddReplyTo("info@example.com", "请不要回复！");
		$this->phpmailer->WordWrap = 50;                                 // set word wrap to 50 characters
		$this->phpmailer->IsHTML(true);                                  // set email format to HTML
		$this->phpmailer->Subject = $subject;
		$this->phpmailer->Body    = $html;
		$this->phpmailer->AltBody = "";

		if(!$this->phpmailer->Send()){
		  // echo "Message could not be sent. <p>";
		  // echo "Mailer Error: " . $this->phpmailer->ErrorInfo;
		   return '0';
		}
		else{
			if(''!=$reset_key){self::reset_key($email_to,$reset_key);}
			return '1';
		}
	}
	function key_encode($data){
		return str_replace("=","_",base64_encode(json_encode($data)));
	}
	function key_decode($str){
		return json_decode(base64_decode(str_replace("_","=",$str)),true);
	}
}
