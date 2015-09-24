<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_main extends CI_Controller {
	private $username;
	private $password;
	function __construct(){
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->model('comm_model','comm');
		$this->username = $this->input->cookie('username', TRUE);
		$this->password = $this->input->cookie('password', TRUE);

		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);	
 		if (!$this->username || !$this->password){
 			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs=$this->comm->findCount("member", array("username"=>$this->username,"password"=>$this->password))){
			redirect(site_url("reg_login/login_in"));
		}
		
	}

	//my 主页		wl_member.gender: 0->Mr.	1->Ms.
	public function index(){

		$data['username'] = $username = $this->username;
		$userid = $this->comm->find("member",array("username"=>$username),'','userid');
		$userid = $userid['userid'];
		if (!$userid){
			redirect(site_url("reg_login/login_in"));
		}
		$site = $this->config->item('site');
		$data['site'] = $site;
 		$data['title'] = "Homepage Of ".$username." On ".$site['site_name'];
		$data['user'] = $user = $this->comm->linker()->find("member",array("username"=>$username));
		if(!$user){
			show_error("There's no this member!");
			die();
		}
		$hour=date('H',time());
		if ($hour>5 && $hour<12){
			$show='Good morning!';
		}elseif ($hour>=12 && $hour<17){
			$show='Good afternoon!';
		}else{
			$show='Good evening!';
		}
		$data['show']=$show;
		if ($user['truename']){
			$call=$user['gender']?'Ms. ':'Mr. ';
			$data['call'] = $call.array_pop(explode(" ", $user['truename']));
		}else{
			$data['call'] = $user['username'];
		}		
		
		//calculate the completed info degree start
		$member=array_slice($user,0,count($user)-2,TRUE);
		$com_count=$user['mcompany']?count($user['mcompany']):33;
		$com_data_count=$user['company_data']?count($user['company_data']):2;
		$total_count=count($user)-2+$com_count+$com_data_count;		
		$unfinished=0;
		$a=array_count_values($member);	
		$b=$user['mcompany']?array_count_values($user['mcompany']):array('0'=>33);
		$c=$user['company_data']?array_count_values($user['company_data']):array('0'=>2);	
		$temp=array($a,$b,$c);
		foreach ($temp as $val){
			$unfinished+=isset($val[''])?$val['']:0;
			$unfinished+=isset($val['0'])?$val['0']:0;
		}
		$data['finished_perc']=($total_count-$unfinished)/$total_count;
		//calculate the completed info degree end
		
		//sell list start
		$supply_list=$this->comm->findAll("sell",array("username"=>$username),"addtime desc","itemid,title,introduce,hits,addtime,linkurl,username","0,3");
		foreach ($supply_list as $k=>$v){
			$supply_list[$k]['addtime']=date('jS F Y',$v['addtime']);			
			$supply_list[$k]['replies']=$com_count = $this->comm->findCount("comment", array("itemid_id"=>$v['itemid'],"itemid_username"=>$username));
		}
		$data['supply_list'] = $supply_list;
		//sell list end
		
		$data['buy_list'] =array();
		
		$unread=$this->comm->findCount("message","touser = '{$username}' AND typeid!=0 AND isread = 0 AND status not in (0,2)");
		$data['unread_nonfri'] = $unread>100?'99+':$unread;
		$data['total_msg_nonfri'] = $this->comm->findCount("message","touser = '{$username}' AND status not in (0,2)");				
		
		$unapproved=$this->comm->findCount("sell", array("username"=>$username,"status"=>2));		
		$data['unapproved'] = $unapproved>100?'99+':$unapproved;
		$data['total_sell'] = $this->comm->findCount("sell",array('username'=>$username));
				
		$unread_fri=$this->comm->findCount("message","touser = '{$username}' AND typeid=0 AND isread = 0 AND status not in (0,2)");
		$data['unread_fri'] = $unread_fri>100?'99+':$unread_fri;
		$data['total_msg_fri'] = $this->comm->findCount("friend", array("userid"=>$userid));
		$this->load->view('user/header',$data);
		$this->load->view('user/user_main_index');
		$this->load->view('user/footer');
	}
	
	
	function confirm_email(){
		$site = $this->config->item('site');
		$timestamp = time();
		$username=$this->username;
		if(!$user=$this->comm->find("member", array('username'=>$username),"","userid,username,password,email,auth,authtime")){
			$msg='There are no matches!';
			$list=array("msg"=>$msg,"email_url"=>"");
		}else{
			if($timestamp + 86400 - $user['authtime']  < 30){
				$msg='Confirmed email has been resent successfully. Your should login your email to confirm you '.ucfirst($site['site_name']).' account within 24 hours!';
			}else{
				/* set_cookie('userid',$user['userid'],time()+3600);
				//set_cookie('password',$user['password'],time()+3600);
				set_cookie('auth',$user['auth'],time()+3600); */
				$this->load->config("email");
				$email = $this->config->item("email");
				$my_email = $email['smtp_user'];
				$this->load->library('email', $email);
				$this->email->set_newline("\r\n");
				$this->email->from($my_email, '');
				$this->email->to($user['email']);
				$this->email->subject("Confirm Your ".ucfirst($site['site_name'])." Account");
				$link=site_url("reg_login/register_step3/".$user['username']."/".$user['auth']);
				$str="Dear ".$user['username']."<br/>Please click <a href='".$link."'>here</a> to confirm your email address and begin to login into your ".ucfirst($site['site_name'])." account within 24 hours.<br/>";
				$str.="This email is just a notification, not receiving any reply. <br/>";
				$str.="PLEASE DO NOT REPLY to this message.";
				$str.="If you have any questions, please do not hesitate to visit our official website.<br/>";
				$str.="please copy the following link to your address bar and visit it!<br/>";
				$str.=$link;
				$this->email->message($str);
				if($this->email->send()){
					$this->db->update('member', array('authtime'=>strtotime("+1 day")),array('userid'=>$user['userid'],'username'=>$username));
					$msg='Confirmed email has been resent successfully! Your should login your email to confirm you '.ucfirst($site['site_name']).' account within 24 hours!';
				}else{
					$msg='Resend failed,please try again!';
				}
			}	
			$email_url=array_pop(explode('@', $user['email']));
			if ($email_url=='gmail.com'){
				$email_url='google.com';
			}
			$list=array("msg"=>$msg,"email_url"=>$email_url);
		}		
		echo json_encode($list);
	}
	
}