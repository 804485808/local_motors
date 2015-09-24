<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier_connect extends CI_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->helper('cookie');
		$this->load->library('session');
		$this->load->model('sell_model');
		$this->load->model('comm_model','comm');
		$this->username = $this->input->cookie('username', TRUE);
		$this->password = $this->input->cookie('password', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);
		if (!$this->username || !$this->password){
			$this->username="";
		} elseif (!$rs=$this->comm->findCount("member", array("username"=>$this->username,"password"=>$this->password))){
			$this->username="";
		}
		//for test
		//$this->username='wamcl80';
	}
	
	//wl_message:定义typeid：0为普通通话，1为加好友，2为询单
	public function index(){
		$this->config->item('enable_query_strings',TRUE);
		$data['username']=$username=$this->username;
		$data['site'] = $site = $this->config->item('site');	
		$user_content = $this->input->cookie('sendmessage',TRUE)?$this->input->cookie('sendmessage',TRUE):'';
		$user_content = str_replace("<br/>", "\r\n", $user_content);
		$user_content=strip_tags($user_content);
		$data['user_content'] = $user_content;
 		$data['itemid'] = $itemid=intval($this->uri->rsegment(3,0));
		$data['title'] = "Inquiry Details to Manufacturer Directory - Suppliers, Manufacturers, Exporters & Importers On ".$site['site_name'];
		$result=$this->comm->find("sell", array("itemid"=>$itemid),"","title,username,thumb,itemid,linkurl");
		$data['sell']=$result;
		$result_1=$this->comm->find("member", array("username"=>$result['username']),"","truename");
		$data['truename']=$result_1['truename'];
		$area = $this->comm->findAll("area");
		foreach($area as $v){
			$areaname[]=$v['areaname'];
		}
		sort($areaname);
		$data['areaname'] = $areaname;
		if ($rs=$this->comm->find("member", array("username"=>$username),"","email")){
			$data['user_email']=$rs['email'];
		}else{
			$data['user_email']='';
		}

		$this->load->view('supplier_connect_index',$data);					
	}	

	function check_user(){
		$action = $this->input->post("check",TRUE);
		if($action == 'email'){
			$email = $this->input->post("email",TRUE);
			$finduser = $this->comm->find("member",array("email"=>$email,"vmail"=>1));
			if($finduser){
				echo 1;
				die();
			}else{
				echo 0;
				die();
			}
		}elseif($action == 'pass'){
			$email = $this->input->post("email",TRUE);
			$password = $this->input->post("password",TRUE);
			$password = md5($password);
			$finduser = $this->comm->find("member",array("email"=>$email,"password"=>$password));
			if($finduser){
				$hash_1 = $this->encrypt->sha1($finduser['username'].time());
				$hash_2 = $this->encrypt->sha1($finduser['password'].time());						
				$username=$this->encrypt->encode($finduser['username'],$hash_1);
				$password=$this->encrypt->encode($finduser['password'],$hash_2);
				set_cookie('username',$username,time()+3600);
				set_cookie('password',$password,time()+3600);
				set_cookie('hash_1',$hash_1,time()+3600);
				set_cookie('hash_2',$hash_2,time()+3600);
				echo 1;
				die();
			}else{
				echo 0;
				die();
			}
		}else{
			echo 0;
			die();
		}
		
	}
	
	
	public function inquiry(){		
		$email = strip_tags(trim($this->input->post('txtemail',TRUE)));
		$content = trim($this->input->post('message',TRUE));
		$content = strip_tags($content);
		$content =str_replace(array("\r\n", "\n", "\r"), "<br />", $content);
		$content = preg_replace("/[^\x{00}-\x{FF}]{1,}/u","",$content);
		$itemid=trim($this->input->post('sid'));
		$itemid = intval($itemid);
		if ($this->input->post('txtcode')!=$this->session->userdata('myCode')){
			$msg='Please enter a valid code.';
			echo json_encode(array("re"=>false,"msg"=>$msg));
			exit; 
		}		
		$last_time=$this->comm->findAll("inquiry",array('ip'=>$this->input->ip_address()),'postdate desc','postdate','1');		
		if (!$last_time){
			$last_time[0]['postdate']=0;
		}
		
		if (($_SERVER['REQUEST_TIME']-$last_time[0]['postdate'])<10){
			$msg='You operate frequently so much, please try once more after 10 seconds!';			
			echo json_encode(array("re"=>false,"msg"=>$msg));
			exit; 
		}else{
			if($this->username){
				$rs=$this->comm->find("member", array("username"=>$this->username),"","username,company,email,truename,mobile,areaid");
				$rs_1=$this->comm->find("company", array("username"=>$this->username),"","telephone");
				$country=$this->comm->find("area", array("areaid"=>$rs['areaid']),"","areaname");
				$inquiry['fromuser']=$rs['username'];
				$inquiry['company']=$rs['company'];
				$inquiry['country']=$country['areaname'];
				$inquiry['truename']=$rs['truename'];
				$inquiry['telephone']=$rs_1['telephone'];
				$inquiry['mobile']=$rs['mobile'];
				$inquiry['email']=$rs['email'];
				$inquiry['status']=0; //status = 0 未审核 
				$inquiry['pid']=0; // 询盘 主ID
			}else{
				$inquiry['fromuser']=' ';
				$inquiry['company']=' ';
				$inquiry['country']=' ';
				$inquiry['truename']=' ';
				$inquiry['telephone']=' ';
				$inquiry['mobile']=' ';
				$inquiry['email']=$email;
				$inquiry['status']=0;
				$inquiry['pid']=0;
			}
			
		}

		$sell_info=$this->comm->find("sell", array("itemid"=>$itemid),"","title,username");
		if(!$sell_info){
			show_404();
		}else{
			$inquiry['title']='Inquiry about '.$sell_info['title'];
			$inquiry['touser']=$sell_info['username'];
			$inquiry['sid']=$itemid;
			$inquiry['ip']=$this->input->ip_address();
			$inquiry['postdate']=time();
			$inquiry['inquiry_data']['message']=$content;
			$msg=$this->create_inquiry($inquiry);
			if($msg){
				$data['email'] = $inquiry['email'];
				$data['site'] = $this->config->item('site');
				$string = $this->load->view("supplier_connect_success",$data,TRUE);
				$this->input->set_cookie(array("name"=>'sendmessage',"value"=>''));
				echo $string;
				exit; 
			}else{
				echo json_encode(array("re"=>false,"msg"=>'Inquiry fail,please try again'));
				die();
			}
		}
		
	}
	
	
	public function create_inquiry($inquiry=array()){
		$inquiry_id = $this->comm->linker()->create('inquiry',$inquiry);
		if($inquiry_id){
			$this->comm->create("inquiry_notice",array("id"=>$inquiry_id,"note"=>""));
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	
	function nomem_inquiry(){
		$data['site']=$site = $this->config->item('site');				
		$data['mid']=$mid=$this->uri->rsegment(3,'');
		$data['auth']=$auth=$this->uri->rsegment(4,'');
		$rs = $this->comm->find("message",array("mid"=>$mid,'auth'=>$auth));
		if (!$rs){redirect(site_url());}
		$inquiry = $this->comm->linker()->find("inquiry",array("id"=>$rs['iid']));
		$sell=$this->comm->find('sell',array("itemid"=>$inquiry['sid']),"","title,username,company,linkurl");		
		$inquiry['product_name']=$sell['title'];
		$data['title'] = "Information About ".$sell['title']." On ".$site['site_name'];
		$inquiry['fromuser']=$sell['username'];
		$inquiry['company']=$sell['company'];
		$inquiry['linkurl']=$sell['linkurl'];
		$data['inquiry']=$inquiry;
		if ($_POST){
			$content=strip_tags($this->input->post("content",TRUE));
			$pid=$inquiry['pid'];			
			while($pid){
 				$rs_1=$this->comm->find("inquiry",array("id"=>$pid));
 				if (!$rs_1){
 					$pid=0;
 					break;
 				}else{
 					$pid=$rs_1['pid'];
 				}
			}
			$email=isset($rs_1)?$rs_1['email']:'';			
			$add=array(
					'title'=>'reply:'.$inquiry['title'],
					'touser'=>$inquiry['fromuser'],
					'email'=>$email,
					'sid'=>$inquiry['sid'],
					'ip'=>$this->input->ip_address(),
					'postdate'=>time(),
					'pid'=>$inquiry['id'],
					'inquiry_data'=>array('message'=>$content)
					);
			$result=$this->comm->linker()->create("inquiry",$add);
			$data['msg']=$result?'Reply successfully!':'Reply failed,please try again!';
		}
		$this->load->view("show_reinquiry",$data);
	}
}