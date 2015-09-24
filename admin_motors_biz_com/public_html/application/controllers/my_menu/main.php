<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Main extends MY_Controller{
	function __construct(){
		parent::__construct();
	} 
	
	function index(){
		$this->load->view('my_menu/main/main');
	}
	function index2(){
		$data['site'] = $site = $this->config->item('site');
		$data['language'] =  $this->config->item('language');
		$data['charset'] =  $this->config->item('charset');

        $this->load->model('member_model','member');

        $data['my_info'] = $this->member->member_user($this->username); //获取用户信息

		$this->load->view('my_menu/main/main_main',$data);
	}
	
	function change_pwd(){
		$data['site'] = $site = $this->config->item('site');
		$this->load->view('my_menu/main/change_pwd',$data);
	}
	function save_pwd(){
		$this->load->library('form_validation');
		$this->lang->load('form_validation', 'chinese');
		$this->form_validation->set_rules('password', '新密码', 'required|min_length[6]');
		$this->form_validation->set_rules('cpassword', '确认密码', 'required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('oldpassword', '旧密码', 'required|min_length[6]');
		if ($this->form_validation->run() == FALSE){
			$data['msg']=validation_errors();
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$pwd=$this->input->post("password",TRUE);
		$old_pwd=$this->input->post("oldpassword",TRUE);		
		if (md5($old_pwd)!=$this->password){
			$data['msg']="旧密码不正确";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		if ($old_pwd==$pwd){
			$data['msg']="旧密码与新密码不能相同，请重新输入密码";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$query=$this->comm->update("member",array("username"=>$this->username,"password"=>$this->password),array("password"=>md5($pwd)));
		$data['msg']=$query?"密码修改成功，请重新登录":"密码修改失败，请重试";
		$this->load->view('public/success',$data);
	}
	
	function center(){
		$file=$this->uri->rsegment(3,'');
		$url='user/user_main/index';
		if ($file=='inbox'){
			$url='user/message/inbox';
		}
		$rs=$this->comm->find("member", array('username'=>$this->username,'password'=>$this->password),"","userid,username,password,loginip,logintime,logintimes");
		if ($rs){
			$logintimes=intval($rs['logintimes'])+1;
			$udata=array('loginip'=>$_SERVER['REMOTE_ADDR'],'logintime'=>$_SERVER['REQUEST_TIME'],'lastip'=>$rs['loginip'],'lasttime'=>$rs['logintime'],'logintimes'=>$logintimes);
			$this->comm->update("member",array("userid"=>$rs['userid']), $udata);
			$this->load->library('encrypt');
			$hash_1 = $this->encrypt->sha1($rs['username'].time());
			$hash_2 = $this->encrypt->sha1($rs['password'].time());
			$username=$this->encrypt->encode($rs['username'],$hash_1);
			$password=$this->encrypt->encode($rs['password'],$hash_2);
			$this->load->helper('cookie');	
			$site = $this->config->item('site');
			set_cookie('username',$username,3600,".{$site['site_url']}");
			set_cookie('password',$password,3600,".{$site['site_url']}");
			set_cookie('hash_1',$hash_1,3600,".{$site['site_url']}");
			set_cookie('hash_2',$hash_2,3600,".{$site['site_url']}");
		}		
		redirect(main_url(site_url($url)));
	}
}