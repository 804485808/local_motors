<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reg_login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('comm_model','comm');
		$this->load->helper('cookie');
		$this->load->library('session');	
		$this->cookie_expire = $this->config->item('sess_expiration');
	}
	
	//register--step 1
	public function register(){				
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Register On ".$site['site_name']." For Step 1";
		$data['email']=$data['pwd']=$data['rpwd']=$data['cck']=$data['msg']='';		
		if($_POST){
			$user=array();
			$data['email'] = $user['email']=strip_tags(trim($this->input->post('email',TRUE)));
			$data['pwd'] = $user['password']=strip_tags(trim($this->input->post('pwd',TRUE)));
			$data['rpwd'] = strip_tags(trim($this->input->post('rpwd',TRUE)));
			$data['cck'] = strip_tags(trim($this->input->post('cck',TRUE)));
			if (strtolower($data['cck'])!=$this->session->userdata('myCode')){
				$data['msg']='The check code which you entered is wrong!';
				$string=$this->load->view('user/register_step1',$data,TRUE);
				echo $string;
				exit;
			}
			$rs=$this->comm->findAll("member",array('regip'=>$_SERVER['REMOTE_ADDR']),'regtime desc','regtime','1');
		 	if (($_SERVER['REQUEST_TIME']-$rs[0]['regtime'])<300){
				$data['msg']="You operate frequently so much, please try once more after 5 minutes!";
				$string=$this->load->view('user/register_step1',$data,TRUE);
				echo $string;
				exit;
			} 
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('rpwd', 'RePassword', 'matches[pwd]');					
			if ($this->form_validation->run() == FALSE){
				$data['msg'] = str_replace("<p>","",validation_errors());
				$data['msg'] = str_replace("</p>","",$data['msg']);
				$data['msg'] = str_replace(array("\r\n","\n"),"\\n",$data['msg']);
			}else {
				$count=$this->comm->findCount("member", array("email"=>$user['email'],'vmail'=>1));
				if($count){
					$data['msg']='The email has registerd!';
				}else{
					$user['username']=array_shift(explode('@', $user['email']));
					$user['username']=$user['username'];
					while ($rs=$this->comm->findCount("member", array("username"=>$user['username']))){
						$user['username'] = $user['username']."_".time();
					}
					if(strlen($user['username'])>30){
						$user['username'] = substr($user['username'],0,30);
					}
					$user['password']=md5($user['password']);
					$user['regip']=$_SERVER["REMOTE_ADDR"];
					$user['regtime']=time();
					$user['groupid']=6;
					$user['regid']=6;
					$user['auth']=md5($user['username'].$user['password']);					
					$user['authtime']=strtotime("+1 day");
					$userid = $this->comm->create('member',$user);
					if ($userid){
						$user['auth']=md5($user['username'].$user['password'].$userid);
						$this->comm->update("member",array('userid'=>$userid), array('auth'=>$user['auth']));
						set_cookie('userid',$userid,$this->cookie_expire,".{$site['site_url']}");
						set_cookie('password',$user['password'],$this->cookie_expire,".{$site['site_url']}");
						set_cookie('auth',$user['auth'],$this->cookie_expire,".{$site['site_url']}");

						$this->load->config("email");
						$email = $this->config->item("email");
						$my_email = $email['smtp_user'];
						$this->load->library('email', $email);
						$this->email->set_newline("\r\n");
						$this->email->from($my_email, "{$site['site_name']}");
						$this->email->to($user['email']);
						$this->email->subject('Confirm Your '.$site['site_name'].' Account');
						$link=site_url("reg_login/register_step3/".$user['username']."/".$user['auth']);
						$str="Dear ".$user['username']."<br/>Please click <a href='".$link."'>here</a> to confirm your email address and begin to login into your {$site['site_name']} account within 24 hours.";
						$str.="<br/>This email is just a notification, not receiving any reply.";
						$str.="<br/>PLEASE DO NOT REPLY to this message.";
						$str.="<br/>If you have any questions, please do not hesitate to visit our official website.";
						$str.="<br/>If you can&#39;t click the link, please copy the following link to your address bar and visit it!<br/>";
						$str.=$link;
						$this->email->message($str);
						if($this->email->send()){
							$data['msg']='Register successfully! Your should login your email to confirm you '.$site['site_name'].' account within 24 hours!';
						}else{
 							$data['msg']='Register successfully! But the confirmed email has not been sent,please resend again!';
						}
						
					}else {
						$data['msg']='Register faild,please try again!';
					}				
				}
			}		
		}
		$this->load->view('user/register_step1',$data);
	}
	
	public function register_step2(){
		$userid = $this->input->cookie('userid', TRUE);
		$password = $this->input->cookie('password', TRUE);
		$auth = $this->input->cookie('auth', TRUE);		
		if (!$rs=$this->comm->find("member",array('userid'=>$userid,'auth'=>$auth),'','email')){
			redirect(site_url("reg_login/register"));
		}else{
			$data['email']=$email =$rs['email'];
		}
		if (!$email || !$password){
			redirect(site_url("reg_login/register"));
		}
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Register On ".$site['site_name']." For Step 2";				
		$email_url=array_pop(explode('@', $email));
		if ($email_url=='gmail.com'){
			$data['email_url']='google.com';
		}else{
			$data['email_url']=$email_url;
		}
		$this->load->view('user/register_step2',$data);
	}
	
	public function register_step3(){
		/* $userid = $this->input->cookie('userid', TRUE);
		$password = $this->input->cookie('password', TRUE);
		$auth = $this->input->cookie('auth', TRUE);
		if (!$rs=$this->comm->find("member",array('userid'=>$userid,'auth'=>$auth),'','email')){
			redirect(site_url("reg_login/register"));
		}else{
			$email =$rs['email'];
		}
		if (!$email || !$password){
			redirect(site_url("reg_login/register"));
		} */
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Register On ".$site['site_name']." For Step 3";
		$confirm_user=$this->uri->rsegment(3,'');
		$confirm_auth=$this->uri->rsegment(4,'');	
		$data['act']=$this->uri->rsegment(5,'');
		$msg='';
		if($confirm_user && $confirm_auth){
			if ($rs=$this->comm->find("member",array('username'=>$confirm_user,'auth'=>$confirm_auth),'','userid,username,password,email,logintimes,authtime')){
				if($rs['authtime']>=time()){
					$logintimes=intval($rs['logintimes'])+1;					
					$this->comm->update('member',array('userid'=>$rs['userid'],'username'=>$confirm_user),array('loginip'=>$_SERVER['REMOTE_ADDR'],'logintime'=>$_SERVER['REQUEST_TIME'],'logintimes'=>$logintimes,'auth'=>md5($this->config->item('encryption_key').mt_rand()),'vmail'=>'1'));
					$this->comm->delete('member',array('email'=>$rs['email'],'vmail'=>0));	
					if (!$this->comm->findCount("company", array("userid"=>$rs['userid'])) && !$this->comm->findCount("company_data", array("userid"=>$rs['userid']))){
						$company_data['userid']=$company['userid']=$rs['userid'];
						$company_data['content'] = '';
						$company['username']=$rs['username'];
						$company['mail']=$rs['email'];
						$this->comm->create('company',$company);
						$this->comm->create('company_data',$company_data);
					}				
										
					$this->load->library('encrypt');
					$hash_1 = $this->encrypt->sha1($rs['username'].time());
					$hash_2 = $this->encrypt->sha1($rs['password'].time());
					$username=$this->encrypt->encode($rs['username'],$hash_1);
					$password=$this->encrypt->encode($rs['password'],$hash_2);
					set_cookie('username',$username,$this->cookie_expire,".{$site['site_url']}");
					set_cookie('password',$password,$this->cookie_expire,".{$site['site_url']}");
					set_cookie('hash_1',$hash_1,$this->cookie_expire,".{$site['site_url']}");
					set_cookie('hash_2',$hash_2,$this->cookie_expire,".{$site['site_url']}");
				}else{
					$msg='Your confirm email has expired,please login and Resend verification email!';
				}
			}else{
				redirect(site_url("reg_login/register"));
			}
		}else{
			redirect(site_url("reg_login/register"));
		}
		$data['msg']=$msg;
		$this->load->view('user/register_step3',$data);
	}
						
	//登陆
	public function login_in(){
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Login_in For My Biz On ".$site['site_name'];
		$data['username']=$data['password']=$msg='';
		if ($_POST){
			$data['username'] = $member['username']=$username=strip_tags($this->input->post('uname',TRUE));
			$data['password'] = $member['password']=strip_tags($this->input->post('pwd',TRUE));				
			$member['password']=$password=md5($member['password']);
			$fields="userid,username,password,loginip,logintime,logintimes";
			if (($rs=$this->comm->find("member", $member,"",$fields)) || ($rs=$this->comm->find("member", array('email'=>$username,'password'=>$password),"",$fields))){
				$logintimes=intval($rs['logintimes'])+1;
				$udata=array('loginip'=>$_SERVER['REMOTE_ADDR'],'logintime'=>$_SERVER['REQUEST_TIME'],'lastip'=>$rs['loginip'],'lasttime'=>$rs['logintime'],'logintimes'=>$logintimes);
				$this->comm->update("member",array("userid"=>$rs['userid']), $udata);
				$this->load->library('encrypt');
				$hash_1 = $this->encrypt->sha1($rs['username'].time());
				$hash_2 = $this->encrypt->sha1($rs['password'].time());
				$username=$this->encrypt->encode($rs['username'],$hash_1);
				$password=$this->encrypt->encode($rs['password'],$hash_2);
				set_cookie('username',$username,$this->cookie_expire,".{$site['site_url']}");
				set_cookie('password',$password,$this->cookie_expire,".{$site['site_url']}");
				set_cookie('hash_1',$hash_1,$this->cookie_expire,".{$site['site_url']}");
				set_cookie('hash_2',$hash_2,$this->cookie_expire,".{$site['site_url']}");
				$msg=array("code"=>1,"msg"=>'Login successfully!');
			}elseif ($this->comm->findCount("member", array('username'=>$member['username'])) || $this->comm->findCount("member", array('email'=>$member['username']))){
				$msg=array("code"=>0,"msg"=>'Your password is wrong!');
			}else {
				$msg=array("code"=>0,"msg"=>'The username which you entered is not exist!');					
			}	
		}		
		$data['msg']=$msg;
		$this->load->view('user/login',$data);
	}
	
	//退出
	public function login_out(){	
		$site = $this->config->item('site');
		delete_cookie("username",".{$site['site_url']}");
		delete_cookie("password",".{$site['site_url']}");
		delete_cookie("hash_1",".{$site['site_url']}");
		delete_cookie("hash_2",".{$site['site_url']}");
		redirect(site_url());
	}

	
	//发送注册激活邮件
	public function send_confirm_email(){
		$timestamp = time();
		$userid = $this->input->cookie('userid', TRUE);		
		$password = $this->input->cookie('password', TRUE);
		$auth = $this->input->cookie('auth', TRUE);
		$uemail_new=$this->input->post('email',TRUE);
		$username=array_shift(explode('@', $uemail_new));	
		while ($rs=$this->comm->findCount("member", array("username"=>$username))){
			$username = $username."_".time();
		}
		if(strlen($username)>30){
			$username = substr($username,0,30);
		}
		
		if($uemail_new){		
			if ($count=$this->comm->findCount("member", array("email"=>$uemail_new,'vmail'=>1))){
				$msg='The email has registerd!';
				$list=array("msg"=>$msg,"email_url"=>"");
				echo json_encode($list);
				exit;
			}else{
				if($rs=$this->comm->find("member",array('userid'=>$userid,'password'=>$password),'','email')){
					$rs=$this->comm->update("member",array('userid'=>$userid),array('username'=>$username,'email'=>$uemail_new));												
				}else{
					$msg='There are no matches!!';
					$list=array("msg"=>$msg,"email_url"=>"");
					echo json_encode($list);
					exit;
				}
			}						
		}		
		
		if(!$user=$this->comm->find("member", array('userid'=>$userid,'password'=>$password),"","userid,username,email,auth,authtime")){	
			$msg='There are no matches!';
			$list=array("msg"=>$msg,"email_url"=>"");
			echo json_encode($list);
			exit;
		}else{
			
			if($timestamp + 86400 - $user['authtime']  > 300){
				$data['site'] = $site = $this->config->item('site');
				$this->load->config("email");
				$email = $this->config->item("email");
				$my_email = $email['smtp_user'];
				$this->load->library('email', $email);
				$this->email->set_newline("\r\n"); 
				$this->email->from($my_email, "{$site['site_name']}");
				$this->email->to($user['email']);
				$this->email->subject('Confirm Your '.$site['site_name'].' Account');
				$link=site_url("reg_login/register_step3/".$user['username']."/".$user['auth']);
				$str="Dear ".$user['username']."<br/>Please click <a href='".$link."'>here</a> to confirm your email address and begin to login into your ".$site['site_name']." account within 24 hours.";
				$str.="<br/>This email is just a notification, not receiving any reply.";
				$str.="<br/>PLEASE DO NOT REPLY to this message.";
				$str.="<br/>If you have any questions, please do not hesitate to visit our official website.";	
				$str.="<br/>If you can&#39;t click the link, please copy the following link to your address bar and visit it!<br/>";
				$str.=$link;
				$this->email->message($str);
				if($this->email->send()){
					$this->db->update('member', array('authtime'=>strtotime("+1 day")),array('userid'=>$userid,'email'=>$uemail_new));
					$msg='Confirmed email has been resent successfully! Your should login your email to confirm you '.$site['site_name'].' account within 24 hours!';							
				}else{
					$msg='Resend failed,please try again!';
				}			
			}else{
				$msg='Send Mail is quickly , waiting...';
				$list=array("msg"=>$msg,"email_url"=>"");
				echo json_encode($list);
				exit;
			}
		}	
		$email_url=array_pop(explode('@', $email));
		if ($email_url=='gmail.com'){
			$email_url='google.com';
		}
		$list=array("msg"=>$msg,"email_url"=>$email_url);
		echo json_encode($list);
	}
	
	//忘记密码页面
	function forget_password(){
		$data['site']=$site = $this->config->item('site');
		$data['title'] = "Forget password On ".$site['site_name'];
		$act=$this->input->post('act',TRUE);
		if ($act=="send_password"){
			$uemail=$this->input->post('email',TRUE);
			$cck=$this->input->post('cck',TRUE);			
			$call=array_shift(explode('@', $uemail));	
			if (strtolower($cck)!=$this->session->userdata('myCode')){
				$msg='The check code which you entered is wrong!';
				$email_url='';
			}elseif (!$rs=$this->comm->findCount("member", array("email"=>$uemail))){
				$msg='The email which you entered is wrong!';
				$email_url='';
			}else{
				$this->comm->delete('password_find',array('email'=>$uemail));
				$auth=md5($this->config->item('encryption_key').mt_rand());
				$rs=$this->comm->create('password_find',array('email'=>$uemail,'auth'=>$auth,'totime'=>strtotime("+1 day")));
				$this->load->config("email");
				$email = $this->config->item("email");
				$my_email = $email['smtp_user'];
				$this->load->library('email', $email);
				$this->email->set_newline("\r\n");
				$this->email->from($my_email, "{$site['site_name']}");
				$this->email->to($uemail);
				$this->email->subject('NEW PASSWORD');
				$link=site_url("reg_login/show_set_password/".$auth);
				$str="Dear ".$call."<br/>For security’s sake,Please click <a href='".$link."'>here</a> to login into your ".$site['site_name']." and set your {$site['site_name']} account within 24 hours.";
				$str.="<br/>The message is just a notification, not receiving any reply.";
				$str.="<br/>PLEASE DO NOT REPLY to this message.";
				$str.="<br/>If you have any questions, please do not hesitate to visit our official website.";
				$str.="<br/>If you can&#39;t click the link, please copy the following link to your address bar and visit it!<br/>";
				$str.=$link;
				$this->email->message($str);
				if($this->email->send()){					
					$msg='The linking has been sent to your email ,plaese login your email to confirm your '.$site['site_name'].' linking within 24 hours!';
					$email_url=array_pop(explode('@', $uemail));
					if ($email_url=='gmail.com'){
						$email_url='google.com';
					}
				}else{
					echo $msg='The linking was sent failed,please try again!';
					$email_url='';
				}
			}
			$list=array("msg"=>$msg,"email_url"=>$email_url);
			echo json_encode($list);
			exit;
		}
		$this->load->view('user/forget_password',$data);
	}
	
	
	//显示设置新密码页面
	function show_set_password(){
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Set your new password On ".$site['site_name'];
		$auth=$this->uri->rsegment(3,'');
		$data['msg']='';
		if(!$auth || !$rs=$this->comm->find("password_find",array("auth"=>$auth))){
			$data['msg']='Your confirm message is wrong,please resend the confirm email again!';
		}elseif ($rs['totime']<=time()){
			$this->comm->delete('password_find',array('email'=>$rs['email']));
			$data['msg']='Your confirm email has expired,please resend the confirm email again!';
		}else{
			$this->comm->update('password_find',array('email'=>$rs['email']),array('auth'=>md5($this->config->item('encryption_key').mt_rand())));
			$data['email']=$rs['email'];
		}				
		$this->load->view('user/set_password',$data);
	}
	
	//设置新密码
	function set_password(){
		$act=$this->input->post('act',TRUE);
		if($act!='set_password'){
			echo 'The act was not valid!';
			exit;
		}
		$email=$this->input->post('email',TRUE);
		$pwd=$this->input->post('pwd',TRUE);
		$rpwd=$this->input->post('rpwd',TRUE);
		$cck=$this->input->post('cck',TRUE);
		if (strtolower($cck)!=$this->session->userdata('myCode')){
			echo 'Your check code was wrong,please try again!';
		}elseif($pwd!=$rpwd){
			echo 'Your passwords do not match. Please try again!';
		}elseif (!$rs=$this->comm->find("member",array("email"=>$email))){
			echo 'The email was wrong,please try again!';
		}else{
			$rs=$this->comm->update("member",array('email'=>$email), array('password'=>md5($pwd)));			
			if ($rs) {$this->comm->delete('password_find',array('email'=>$email));}
			echo $rs?'New password was set successfully,login in '.$site['site_name'].' now!':'New password was set failed,please try again!';
		}	
	}
	
	
	//显示快速注册页面
	function show_quick_reg(){
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Quick register On ".$site['site_name'];
		
		$data['mid']=$mid=$this->uri->rsegment(3,'');
		$data['auth']=$auth=$this->uri->rsegment(4,'');
		$rs_1 = $this->comm->find("message",array("mid"=>$mid,'auth'=>$auth),'','iid');
		if (!$rs_1['iid']){
			redirect(site_url());
		}		
		$rs_2 = $this->comm->find("inquiry",array("id"=>$rs_1['iid']),'','pid');
		$rs_3 = $this->comm->find("inquiry",array("id"=>$rs_2['pid']),'','email');
		$data['email']=$rs_3['email'];	
		
		$this->load->library('encrypt');
		$username = $this->input->cookie('username', TRUE);		
		$password = $this->input->cookie('password', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$username=$this->encrypt->decode($username,$hash_1);
		$password=$this->encrypt->decode($password,$hash_2);		
		if ($username && $password && $rs_4=$this->comm->find('member',array("username"=>$username,"password"=>$password),'','username')){
			$this->comm->update("message",array('mid'=>$mid,'auth'=>$auth), array('touser'=>$rs_4['username']));
			redirect(site_url("user/message/inbox"));
		}elseif ($rs_5=$this->comm->find("member", array("email"=>$rs_3['email'],"vmail"=>1),'','username')){
			$this->comm->update("message",array('mid'=>$mid,'auth'=>$auth), array('touser'=>$rs_5['username']));
			redirect(site_url("reg_login/login_in"));
		}else{
			$this->load->view('user/quick_reg',$data);
		}			
	}
	
	//快速注册
	function quick_reg(){
		$data['site'] = $site = $this->config->item('site');
		$user['email']=$this->input->post('email',TRUE);
		$pwd=$this->input->post('pwd',TRUE);
		$rpwd=$this->input->post('rpwd',TRUE);
		if ($pwd!=$rpwd){
			$msg='Your passwords do not match. Please try again!';
			$list=array("msg"=>$msg,"email_url"=>"");
			echo json_encode($list);
			exit;
		}
		$message['mid']=$this->input->post('mid',TRUE);
		$message['auth']=$this->input->post('auth',TRUE);
		$user['username']=array_shift(explode('@', $user['email']));
		$user['username']=$user['username'].mt_rand(0,9);
		while ($rs=$this->comm->findCount("member", array("username"=>$user['username']))){
			$user['username'].=mt_rand(0,9);
		}
		$user['password']=md5($pwd);
		$user['regip']=$_SERVER["REMOTE_ADDR"];
		$user['regtime']=time();
		$user['auth']=md5($user['username'].$user['password']);
		$user['authtime']=strtotime("+1 day");
		$userid = $this->comm->create('member',$user);
		if ($userid){	
			$new_auth=md5($this->config->item('encryption_key').mt_rand());
			while ($new_auth==$message['auth']){
				$new_auth=md5($this->config->item('encryption_key').mt_rand());
			}
			$this->comm->update("message",array('mid'=>$message['mid'],'auth'=>$message['auth']), array('touser'=>$user['username']));
			$this->comm->update("message",$message, array('auth'=>$new_auth));			
			$user['auth']=md5($user['username'].$user['password'].$userid);
			set_cookie('userid',$userid,$this->cookie_expire,".{$site['site_url']}");
			set_cookie('password',$user['password'],$this->cookie_expire,".{$site['site_url']}");
			set_cookie('auth',$user['auth'],$this->cookie_expire,".{$site['site_url']}");
			$this->comm->update("member",array('userid'=>$userid), array('auth'=>$user['auth']));	
			$this->load->config("email");
			$email = $this->config->item("email");
			$my_email = $email['smtp_user'];
			$this->load->library('email', $email);
			$this->email->set_newline("\r\n");
			$this->email->from($my_email, "{$site['site_name']}");
			$this->email->to($user['email']);
			$this->email->subject('Confirm Your '.$site['site_name'].' Account');
			$link=site_url("reg_login/register_step3/".$user['username']."/".$user['auth']."/quick_reg");
			$str="Dear ".$user['username']."<br/>Please click <a href='".$link."'>here</a> to confirm your email address and begin to login into your ".$site['site_name']." account within 24 hours.";
			$str.="<br/>This email is just a notification, not receiving any reply.";
			$str.="<br/>PLEASE DO NOT REPLY to this message.";
			$str.="<br/>If you have any questions, please do not hesitate to visit our official website.";
			$str.="<br/>If you can&#39;t click the link, please copy the following link to your address bar and visit it!<br/>";
			$str.=$link;
			$this->email->message($str);
			if($this->email->send()){
				$msg='Register successfully! Your should login your email to confirm you '.$site['site_name'].' account within 24 hours!';
				$email_url=array_pop(explode('@', $user['email']));
				if ($email_url=='gmail.com'){
					$email_url='google.com';
				}
			}else{
				$msg='Register successfully! But the confirmed email has not been sent,please resend again!';
				$email_url='';
			}
		}else {
			$msg='Register faild,please try again!';
			$email_url='';
		}
		$list=array("msg"=>$msg,"email_url"=>"");
		echo json_encode($list);
	}
	
	
}