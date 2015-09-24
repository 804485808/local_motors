<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends CI_Controller {
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
		} elseif (!$rs=$this->comm->find('member',array("username"=>$this->username,"password"=>$this->password),'','userid,vmail,email')){
			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs['vmail']){
			$data['email'] = $rs['email'];
			$str = $this->load->view('user/vmail_notice',$data,TRUE);
			echo $str;
			die();
		} 
	}

	
	//status:	0->垃圾箱		1->已发送		2->草稿箱    其他->
	//isread:	0->未读		1->已读
	//issend:	0->未发送		1->已发送
	/**
	 *
	 * 发送信息
	 *
	 */
	public function check_name(){
	
		$user = $this->comm->find('member',array('username'=>$this->username),'','userid');
		$userid = $user['userid'];
		if ($this->input->post('touser',TRUE)){
			$ajax_touser = trim($this->input->post('touser',TRUE));
			$ajax_touser = explode(';',$ajax_touser);
			$ajax_touser = array_unique($ajax_touser);
	
			if (!end($ajax_touser)){
				array_pop($ajax_touser);
			}
			$count = count($ajax_touser);
			$i=0;
			foreach ($ajax_touser as $k=>$v){
				$res = $this->comm->findCount('friend',array('userid'=>$userid,'username'=>$v));
				$i++;
			}
			if ($i === $count && $res>0){
				$output = $res;
			}else {
				$output = 0;
			}
		}else{
			$output = 0;
		}
		echo $output;
	}
	
	public function mes_create(){
	
		$data['type'] = "";
		$data['resubject'] = "";
		$data['recontent'] = "";
		$data['reply_name'] = strip_tags(trim($this->uri->rsegment(3)));	//回复
	
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
		$site = $this->config->item('site');
		$data['title'] = "Newmessage Of ".$this->username." On ".$site['site_name'];
		$data['unread'] = $unread=$this->comm->findCount("message","touser = '{$this->username}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$this->username,"status"=>2,"isdel_s"=>0));
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$this->username,"status"=>0,"isdel_r"=>0));
		//接收者选项
		$data['touser'] = $this->comm->findAll('friend',array("userid"=>$userid),'','username','');
		if($_POST){
			$this->form_validation->set_rules('touser', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');
			if ($this->form_validation->run()==FALSE){
				$data['msg']="Send failed！";
			}else{
				$touser = strip_tags($this->input->post('touser',TRUE));
				$touser = explode(';',$touser);
				$touser = array_unique($touser);
				if (!end($touser)){
					array_pop($touser);
				}
				$count = count($touser);
	
				if ($count>=6){
					$data['msg'] = "No more than five contacts!";
				}else{
					foreach ($touser as $v){
						$result_1 = $this->comm->find('friend',array('userid'=>$userid,'username'=>$v),'','username');
						if (!$result_1){
							$data['msg'] = "Please enter the correct name!";
						}else {
							$res = $this->comm->findCount('member',array('username'=>$v));
							if ($res>0){
								$sql = array(
										'fromuser' => $this->username,
										'touser' => $v,
										'title'	=> strip_tags($this->input->post('title',TRUE)),
										'content' => strip_tags($this->input->post('content',TRUE)),
										'addtime' => time(),
										'ip' => $_SERVER["REMOTE_ADDR"],
										'issend'=>1,
										'status'=>1
								);
								$insert_id = $this->comm->create('message',$sql);
								if ($insert_id){
									$data['msg']="Send successfully!";
								}else {
									$data['msg']="Send failed!";
								}
							}else {
								$data['msg']="No contacts found!";
							}
						}
					}
				}
			}
		}
	
		$data['username'] = $this->username;
	
		$this->load->view("user/header",$data);
		$this->load->view('user/newmessage');
		$this->load->view("user/footer");
	}
	
	public function select_1(){
	
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
	
		//搜索联系人
		$keywords = strip_tags($this->input->post('keywords',TRUE));
		if ($keywords){
			$query = $this->db->query("select fid,username from wl_friend where userid='{$userid}' and username like '%{$keywords}%' order by fid desc");
			$friends = $query->result_array();
			$output =  "<ul id='friend_ul_1'>";
			foreach($friends as $k=>$v){
				$output .= "<li><input type='checkbox' onclick='getselected()'  id='username.'{$k}'.' name='username' value='{$v['username']}' />".$v['username']."<div class='clear'></div></li>";
			}
			$output .=  "</ul>";
		}else {
			$friends = $this->comm->findAll('friend',array("userid"=>$userid),'','fid,username','');
			$output =  "<ul id='friend_ul_1'>";
			foreach($friends as $k=>$v){
				$output .= "<li><input type='checkbox' onclick='getselected()'  id='username.'{$k}'.' name='username' value='{$v['username']}' />".$v['username']."<div class='clear'></div></li>";
			}
			$output .= "</ul>";
		}	
		echo $output;
	}
	
	/**
	 *
	 * 保存信息至草稿箱
	 *
	 */
	
	public function mes_save(){
	
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
		$touser = strip_tags($this->input->post('touser',TRUE));
		$touser = $touser?$touser:"";
		$title = strip_tags($this->input->post('title',TRUE));
		$content = strip_tags($this->input->post('content',TRUE));
		$sql = array(
				'title'	=> $title,
				'content' => $content,
				'fromuser' => $this->username,
				'touser' => $touser,
				'addtime' => time(),
				'ip' => $_SERVER["REMOTE_ADDR"],
				'issend' =>0,
				'status' =>2
		);
	
		$result = $this->comm->create('message',$sql);
		if ($result){
			$output = 1;
		}else {
			$output = 0;
		}
		echo $output;
	}
	/**
	 *
	 * 发送草稿箱
	 */
	public function send_draft(){
	
		$data['mid']= $mid = intval($this->uri->rsegment(3));//发送草稿
		$data['type'] = "drafts";
		$res = $this->comm->find('message',array('mid'=>$mid),'','touser,title,content');
		$data['reply_name'] = $res['touser'];
		$data['resubject'] = $res['title'];
		$data['recontent'] = $res['content'];
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
		$site = $this->config->item('site');
		$data['title'] = "Newmessage Of ".$this->username." On ".$site['site_name'];
		$data['unread'] = $unread=$this->comm->findCount("message","touser = '{$this->username}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$this->username,"status"=>2,"isdel_s"=>0));
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$this->username,"status"=>0,"isdel_r"=>0));
		//接收者选项
		$data['touser'] = $this->comm->findAll('friend',array("userid"=>$userid),'','username','');
		if($_POST){
			$this->form_validation->set_rules('touser', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');
			if ($this->form_validation->run()==FALSE){
				$data['msg']="Send failed！";
			}else{
				$touser = strip_tags($this->input->post('touser',TRUE));
				$touser = explode(';',$touser);
				$touser = array_unique($touser);
				if (!end($touser)){
					array_pop($touser);
				}
				$count = count($touser);
				if ($count>5){
					$data['msg'] = "No more than five contacts!";
				}else{
					foreach ($touser as $v){
						$result_1 = $this->comm->find('friend',array('userid'=>$userid,'username'=>$v),'','username');
						if (!$result_1){
							$data['msg'] = "Please enter the correct name!";
						}else {
							$res = $this->comm->findCount('member',array('username'=>$v));
							if ($res>0){
								$sql = array(
										'fromuser' => $this->username,
										'touser' => $v,
										'title'	=> strip_tags($this->input->post('title',TRUE)),
										'content' => strip_tags($this->input->post('content',TRUE)),
										'addtime' => time(),
										'ip' => $_SERVER["REMOTE_ADDR"],
										'issend'=>1,
										'status'=>1
								);
	
								$insert_id = $this->comm->create('message',$sql);
								if ($insert_id){
									$mid = intval($this->uri->rsegment(3));
									$this->comm->delete('message',array('mid'=>$mid,'fromuser'=>$this->username));
									$data['msg']="Send successfully!";
								}else {
									$data['msg']="Send failed!";
								}
							}else {
								$data['msg']="No contacts found!";
							}
						}
					}
				}
			}
	
		}
		$data['username'] = $this->username;
		$this->load->view("user/header",$data);
		$this->load->view('user/newmessage');
		$this->load->view("user/footer");
	
	}
	
	//删除一条信息
	public function mes_del(){
		$mid = intval($this->uri->rsegment(3,0));		
		$type=$this->uri->rsegment(4,"");
		if ($type==""){
			die();
		}
		$username = $this->username;
		$page = intval($this->uri->rsegment(5,0));
		if ($type=='inbox' || $type=='trash'){
			$count=$this->comm->findCount("message", array("mid"=>$mid,"touser"=>$username));
		}else{
			$count=$this->comm->findCount("message", array("mid"=>$mid,"fromuser"=>$username));
		}
		
		if ($count){
			if ($type=='inbox' || $type=='trash'){
				$query=$this->comm->update("message",array("mid"=>$mid,"touser"=>$username),array("isdel_r"=>1));
			}else{
				$query=$this->comm->update("message",array("mid"=>$mid,"fromuser"=>$username),array("isdel_s"=>1));
			}		
			$rs=$query?"delete successfully":"delete failed";
		}else{
			$rs="There's no this message!";
		}
		if($rs=="delete successfully"){
			redirect(site_url("user/message/".$type."/".$page));
		}else {
			redirect(site_url("user/message/mes_detail/".$page."/".$type."/".$mid));
		}				
	}
	
	
	//删除选中的信息
	public function mes_operate(){
		$username = $this->username;
		$act=$this->input->post('act',TRUE);	
		$curr_page=$this->input->post('curr_page',TRUE);
		$del_mid = $this->input->post('del_mid',TRUE);
		$type = $this->input->post('type',TRUE);		
		
		$del_mid=explode("-", $del_mid);
		array_pop($del_mid);	
		if (is_array($del_mid)){
			$c=0;
			foreach ($del_mid as $v){
				if ($type=='inbox' || $type=='trash'){
					$count=$this->comm->findCount("message", array("mid"=>intval($v),"touser"=>$username));
				}else{
					$count=$this->comm->findCount("message", array("mid"=>intval($v),"fromuser"=>$username));
				}
				if ($count){
					if ($type=='inbox' || $type=='trash'){
						$conditions=array("mid"=>intval($v),"touser"=>$username);
						$up=array("isdel_r"=>1);						
					}else{
						$conditions=array("mid"=>intval($v),"fromuser"=>$username);
						$up=array("isdel_s"=>1);
					}
					if ($act=='delete'){  						
						$query=$this->comm->update("message",$conditions,$up);
					}else if ($act=='report spam'){
						$query=$this->comm->update("message",$conditions, array("status"=>0));
					}					
					if ($query){$c++;}
				}else{
					$rs="There's no this message!";
				}
			}
			if ($c==count($del_mid)){
				$rs=$act." successfully";
			}else{
				$rs=$act." failed";
			}		
		}
		if ($type=='inbox'){
			$condi="touser = '{$username}' AND status = 1  AND isdel_r = 0";
		}elseif ($type=='sent_box'){
			$condi="fromuser = '{$username}' AND isdel_s = 0 and status <> 2";
		}elseif ($type=='trash'){
			$condi= array("touser"=>$username,"status"=>0);
		}elseif ($type=='drafts'){
			$condi=array("fromuser"=>$username,"status"=>2);
		}
		$total_count=$this->comm->findCount("message",$condi);
		$list=array("msg"=>$rs,"total_count"=>$total_count);
		$this->output->set_content_type('application/json')->set_output(json_encode($list));		
	}
				
	//收件箱
	public function inbox(){
		$data=$this->box('inbox');
		$this->load->view("user/header",$data);
		$this->load->view("user/mes_box");
		$this->load->view("user/footer");
	}
	
	
	//发件箱
	public function sent_box(){
		$data=$this->box('sent_box');
		$this->load->view("user/header",$data);
		$this->load->view("user/mes_box");
		$this->load->view("user/footer");
	}
	
	
	//垃圾箱
	public function trash(){
		$data=$this->box('trash');
		$this->load->view("user/header",$data);
		$this->load->view("user/mes_box");
		$this->load->view("user/footer");
	}
	
	
	//草稿箱
	public function drafts(){
		$data=$this->box('drafts');
		$this->load->view("user/header",$data);
		$this->load->view("user/mes_box");
		$this->load->view("user/footer");
	}
	
	//邮件详细信息
	//wl_message:定义typeid：0为普通通话，1为加好友，2为询单
	public function mes_detail(){
		$data['username'] = $username = $this->username;
		$site = $this->config->item('site');
		$data['title'] = "Mes_detail Of ".$username." On ".$site['site_name'];
		$data['mid'] = $mid = $this->uri->rsegment(3,2);
		$data['type'] = $type=$this->uri->rsegment(4,"inbox");
		$data['page'] = intval($this->uri->rsegment(5,0));
		$data['unread'] = $unread=$this->comm->findCount("message","touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$username,"status"=>0,"isdel_r"=>0));
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$username,"status"=>2,"isdel_s"=>0));
		
		if ($type=='inbox' || $type=='trash'){
			$data['mes_detail'] = $query = $this->comm->find("message",array("mid"=>$mid,"touser"=>$username),'','mid,title,typeid,content,fromuser,touser,addtime,feedback,iid');
			$other_friend=$query['fromuser'];
		}else{
			$data['mes_detail'] = $query = $this->comm->find("message",array("mid"=>$mid,"fromuser"=>$username),'','mid,title,typeid,content,fromuser,touser,addtime,feedback,iid');
			$other_friend=$query['touser'];
		}
		
		if ($type=="inbox" && $query){
			$this->db->update('message',array('isread'=>1),array('mid'=>$mid,"touser"=>$username));
		}
		if ($other_friend){
			$query_1 = $this->comm->find("member",array("username"=>$other_friend),'','company,truename,areaid');		
			$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
			$query_1 = $query_1?$query_1:array('company'=>'','truename'=>'','areaid'=>'');
			$query_1['areaid']=$query_2['areaname'];
			$data['his_detail'] =$query_1;
		}else{
			$data['his_detail'] =array('company'=>'','truename'=>'','areaid'=>'');
		}
		//message history
		$msg_history=$this->comm->findAll("message",array("fromuser"=>$username,"touser"=>$other_friend,"isdel_s"=>0),"addtime desc","mid,title,content,fromuser,touser","0,3");
		$msg_history_1=$this->comm->findAll("message",array("fromuser"=>$other_friend,"touser"=>$username,"isdel_r"=>0),"addtime desc","mid,title,content,fromuser,touser","0,3");
		$data['msg_history']=$msg_history?$msg_history:array();
		$data['msg_history1']=$msg_history_1?$msg_history_1:array();
		$this->load->view("user/header",$data);
		$this->load->view("user/mes_detail");
		$this->load->view("user/footer");
	}
	
	
	//联系人列表
	public function contacts_list(){
		$data['username'] = $username = $this->username;
		$site = $this->config->item('site');
		$data['title'] = "Contacts_list Of ".$username." On ".$site['site_name'];
		$page = $this->uri->rsegment(3,0);
		$data['page'] = $page = intval($page);
		$userid = $this->comm->find("member",array("username"=>$username),'','userid');
		$userid = $userid['userid'];
		$contacts=$this->comm->findAll("friend",array("userid"=>$userid),"username desc","fid,username,truename,typeid","{$page},4");
		$data['unread'] = $unread=$this->comm->findCount("message","touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$username,"status"=>0,"isdel_r"=>0));
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$username,"status"=>2,"isdel_s"=>0));
		foreach ($contacts as $k=>$v){
			if ($v['username']){
				$query_1 = $this->comm->find("member",array("username"=>$v['username']),'','areaid');
				$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
				$contacts[$k]['areaname']=$query_2?$query_2['areaname']:"";
			}else {
				$contacts[$k]['areaname']="";
			}
			if ($v['typeid']){
				$query_1 = $this->comm->find("friend_type",array("tid"=>$v['typeid'],"userid"=>$userid),'','tname');
				$contacts[$k]['tname']=$query_1?$query_1['tname']:"";
			}else {
				$contacts[$k]['tname']="";
			}
		}
		$data['contacts_list'] = $contacts;
		$contacts_count=$this->comm->findCount("friend", array("userid"=>$userid));
		$this->load->library('pagination');
		$base_url = site_url("/user/message/contacts_list/");
		$config['base_url'] = $base_url;
		$config['total_rows'] = $contacts_count;
		$config['per_page'] = $data['page_size']=4;
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		
		$this->load->view("user/header",$data);
		$this->load->view("user/contacts_list");
		$this->load->view("user/footer");
	}
	
	
	//联系人详情
	public function contacts_detail(){
		$data['my_name']=$my_name = $this->username;
		$data['reply_name']=$data['friend_name'] = $friend_name = $this->uri->rsegment(3,'');
		$site = $this->config->item('site');
		$data['title'] = "Contacts Detail Of ".$my_name." On ".$site['site_name'];
		$data['page'] = intval($this->uri->rsegment(4,0));
		$data['unread'] = $unread=$this->comm->findCount("message", "touser = '{$my_name}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$my_name,"status"=>0,"isdel_r"=>0));
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$my_name,"status"=>2,"isdel_s"=>0));
	
		$userid = $this->comm->find("member",array("username"=>$my_name),'','userid');
		$userid = $userid['userid'];
	
		//friend info	
		$friend_1 = $this->comm->find("friend",array("userid"=>$userid,"username"=>$friend_name),'','fid,username,truename,typeid');
		$friend_1 = $friend_1?$friend_1:array('fid'=>'','username'=>'','truename'=>'','typeid'=>'');
		$friend_2 = $this->comm->find("company",array("username"=>$friend_name),'','company,areaid,telephone,fax,mail');
		$friend_2 = $friend_2?$friend_2:array('company'=>'','areaid'=>'','telephone'=>'','fax'=>'','mail'=>'');
		$gender = $this->comm->find("member",array("username"=>$friend_name),'','gender');
		$data['gender'] = $gender=$gender['gender'];
		$query = $this->comm->find("area",array("areaid"=>$friend_2['areaid']),'','areaname');
		$friend_2['areaid']=$query['areaname'];
		$data['friend'] = $friend=array_merge($friend_1,$friend_2);
	
		//my detail
		$my_detail = $this->comm->find("company",array("username"=>$my_name),'','company,areaid,telephone,mail');
		$query_1 = $this->comm->find("area",array("areaid"=>$my_detail['areaid']),'','areaname');
		$my_detail['areaid']=$query_1['areaname'];
		$data['my_detail'] = $my_detail;
	
		//my ftype_lists
		$data['my_list'] = $my_list=$this->comm->findAll("friend_type",array("userid"=>$userid),"listorder desc","tname,listorder,tid");
	
		foreach ($my_list as $k=>$v){
			$my_list_count[$v['tid']]=$this->comm->findCount("friend",array("userid"=>$userid,"typeid"=>$v['tid']));
			$friends_list[$v['tid']]=$this->comm->findAll("friend",array("userid"=>$userid,"typeid"=>$v['tid']),"username desc","fid,username,truename");
			foreach($friends_list[$v['tid']] as $val){
				$friends[]=$val;
			}
		}
		$data['friends_list']=$friends_list;
		$data['my_list_count']=$my_list_count;
	
		$all_friends=$this->comm->findAll("friend",array("userid"=>$userid),"username desc","fid,username,truename");
		$other_friends=array();
		foreach ($all_friends as $value){
			if (!in_array($value, $friends)){
				$other_friends[]=$value;
			}
		}
		$data['others_count']=count($other_friends);
		//dump($other_friends);
		$data['other_friends']=$other_friends;
	
		//message history		
		$msg_history=$this->comm->findAll("message",array("fromuser"=>$my_name,"touser"=>$friend_name,"isdel_s"=>0),"addtime desc","mid,title,content,fromuser,touser","0,5");
		$msg_history_1=$this->comm->findAll("message",array("fromuser"=>$friend_name,"touser"=>$my_name,"isdel_r"=>0),"addtime desc","mid,title,content,fromuser,touser","0,5");
		if (!$msg_history && $msg_history_1){
			$data['msg_history'] =	$msg_history_1;
		}elseif ($msg_history && !$msg_history_1){
			$data['msg_history'] =	$msg_history;
		}elseif ($msg_history && $msg_history_1){
			$data['msg_history'] = array_merge($msg_history,$msg_history_1);
		}else{
			$data['msg_history'] = array();
		}
		$data['username'] = $this->username;
		$this->load->view("user/header",$data);
		$this->load->view("user/contacts_detail");
		$this->load->view("user/footer");
	}
	
	
	public function show_one_friend(){		
		$my_name = $this->username;
		$userid = $this->comm->find("member",array("username"=>$my_name),'','userid');
		$userid = $userid['userid'];
		$fid=$this->input->post('fid',TRUE)?$this->input->post('fid',TRUE):0;
		$page=$this->input->post('page',TRUE);
		$act=$this->input->post('act',TRUE);
		$friend_name = $this->input->post('friend_name',TRUE);
		if($act='msg_showfri'){
			$condition=array("userid"=>$userid,"username"=>$friend_name);
		}else{
			$condition=array("fid"=>$fid,"userid"=>$userid,"username"=>$friend_name);
		}
		if ($this->comm->findCount("friend", $condition)){
			$message=site_url("user/message/contacts_detail/".$friend_name."/".$page);
		}else{
			$message='0';
		}
		$this->output->set_output($message);
	}
	
	
	
	//删除一个好友
	public function friend_del(){
		$username = $this->username;
		$userid = $this->comm->find("member",array("username"=>$username),'','userid');
		$userid = $userid['userid'];
		$friend_name=$this->uri->rsegment(3,'');
		$page = intval($this->uri->rsegment(4,0));
		$count=$this->comm->findCount("friend", array("userid"=>$userid,"username"=>$friend_name));
		if ($count){
			$query=$this->comm->delete("friend", array("userid"=>$userid,"username"=>$friend_name));
			$rs=$query?"delete success":"delete failed";
		}else{
			$rs="There's no this friend in your friend_list!";
		}
		if($rs=="delete success"){
			redirect(site_url("user/message/contacts_list/".$page));
		}else {
			redirect(site_url("user/message/contacts_detail/".$friend_name."/".$page));
		}
	}
	
	//删除选中的好友
	public function friends_dels(){
		$my_name = $this->username;
		$userid = $this->comm->find("member",array("username"=>$my_name),'','userid');
		$userid = $userid['userid'];
		$del_username = $this->input->post('del_username',TRUE);
		$del_username=explode("-", $del_username);
		array_pop($del_username);
		if (is_array($del_username)){
			$c=0;
			foreach ($del_username as $v){
				$count=$this->comm->findCount("friend", array("userid"=>$userid,"username"=>$v));
				if ($count){
					$query=$this->comm->delete("friend", array("userid"=>$userid,"username"=>$v));
					if ($query){$c++;}
				}else{
					$rs="There's no this friend!";
				}
			}
			if ($c==count($del_username)){
				$rs="delete success";
			}else{
				$rs="delete failed";
			}
		}
		//echo $rs;
		
		$total_count=$this->comm->findCount("friend",array("userid"=>$userid));
		$list=array("msg"=>$rs,"total_count"=>$total_count);
		$this->output->set_content_type('application/json')->set_output(json_encode($list));
	}
	
	
	public function box($box){
		$data['username'] = $username = $this->username;
		$site = $this->config->item('site');
		$data['title'] = ucfirst($box)." Of ".$username." On ".$site['site_name'];
		$data['type'] = $box;
		$page = $this->uri->rsegment(3,0);
		$data['page'] = $page = intval($page);
		$uri_segment = 4;
		$base_url = site_url("/user/message/".$box."/");
		$data['typeid']=-1;		
		if ($box=='inbox'){
			$typeid = $this->uri->rsegment(3,0);			
			if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$typeid)){
				$tid = explode("-",$typeid);
				$tid = intval($tid[1]);
				$page = $this->uri->rsegment(4,0);
				$data['page'] = $page = intval($page);
				$uri_segment = 5;
				$condition="typeid = {$tid} AND touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0";
				$base_url = site_url("/user/message/".$box."/$typeid/");
				$data['typeid']=$tid;
			}else {
				$condition="touser = '{$username}' AND status = 1 AND isdel_r = 0";
			}
			$my_inbox=$this->comm->findAll("message",$condition,"addtime desc","mid,title,content,fromuser,touser,addtime,isread","{$page},4");			
			foreach ($my_inbox as $k=>$v){
				$query_1 = $this->comm->find("member",array("username"=>$v['fromuser']),'','areaid');
				$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
				$my_inbox[$k]['areaname']=$query_2['areaname'];
			}
			$data['my_box'] = $my_inbox;
			$count=$this->comm->findCount("message", $condition);
		}elseif ($box=='sent_box'){
			$sent_box=$this->comm->findAll("message","fromuser = '{$username}' AND isdel_s = 0 AND status <> 2","addtime desc","mid,title,content,fromuser,touser,addtime","{$page},4");
			foreach ($sent_box as $k=>$v){
				$query_1 = $this->comm->find("member",array("username"=>$v['touser']),'','areaid');
				$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
				$sent_box[$k]['areaname']=$query_2['areaname'];
			}
			$data['my_box'] = $sent_box;
			$count=$this->comm->findCount("message","fromuser = '{$username}' AND isdel_s = 0 AND status <> 2");
		}elseif ($box=='trash'){
			$trash=$this->comm->findAll("message",array("touser"=>$username,"status"=>0,"isdel_r"=>0),"addtime desc","mid,title,content,fromuser,touser,addtime","{$page},4");
			foreach ($trash as $k=>$v){
				if ($v['touser']){
					$query_1 = $this->comm->find("member",array("username"=>$v['touser']),'','areaid');
					$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
					$trash[$k]['areaname']=$query_2?$query_2['areaname']:"";
				}else {
					$trash[$k]['areaname']="";
				}
			}
			$data['my_box'] = $trash;
			$data['trash_count'] = $count=$this->comm->findCount("message", array("touser"=>$username,"status"=>0,"isdel_r"=>0));
		}elseif ($box=='drafts'){
			$drafts=$this->comm->findAll("message",array("fromuser"=>$username,"status"=>2,"isdel_s"=>0),"addtime desc","mid,title,content,fromuser,touser,addtime","{$page},4");
			foreach ($drafts as $k=>$v){
				if ($v['touser']){
					$query_1 = $this->comm->find("member",array("username"=>$v['touser']),'','areaid');
					$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
					$drafts[$k]['areaname']=$query_2?$query_2['areaname']:"";
				}else {
					$drafts[$k]['areaname']="";
				}
			}
			$data['my_box'] = $drafts;
			$data['drafts_count'] = $count=$this->comm->findCount("message", array("fromuser"=>$username,"status"=>2,"isdel_s"=>0));
		}
		$data['unread'] = $unread=$this->comm->findCount("message","touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0");
		$data['trash_count'] = $this->comm->findCount("message", array("touser"=>$username,"status"=>0,"isdel_r"=>0));
		$data['drafts_count'] = $this->comm->findCount("message", array("fromuser"=>$username,"status"=>2,"isdel_s"=>0));
		$this->load->library('pagination');		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $count;
		$config['per_page'] = $data['page_size']=4;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 4;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		
		return $data;
	}

	public function search(){
		$username = $this->username;
		$userid = $this->comm->find("member",array("username"=>$username),'','userid');
		$userid = $userid['userid'];
		$act=trim($this->input->post('act',TRUE));
		$keywords=trim($this->input->post('keywords',TRUE));
		$page = $this->input->post('page',TRUE)?$this->input->post('page',TRUE):1;
		$page_size=4;
		$offset=($page-1)*$page_size;
		$str="";
		if ($act=='search_friends'){
			$sql="SELECT username,truename,typeid FROM wl_friend WHERE userid = '{$userid}' AND username like '%{$keywords}%' ORDER BY username desc Limit {$offset},{$page_size}";
			$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_friend WHERE userid = '{$userid}' AND username like '%{$keywords}%'";
			$query = $this->db->query($sql);
			$query_1 = $this->db->query($sql_1);
			$contacts_list = $query->result_array();
			$count=$query_1->result_array();
			foreach ($contacts_list as $k=>$v){
				if ($v['username']){
					$query_1 = $this->comm->find("member",array("username"=>$v['username']),'','areaid');
					$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
					$contacts_list[$k]['areaname']=$query_2?$query_2['areaname']:"";
				}else {
					$contacts_list[$k]['areaname']="";
				}
				if ($v['typeid']){
					$query_1 = $this->comm->find("friend_type",array("tid"=>$v['typeid'],"userid"=>$userid),'','tname');
					$contacts_list[$k]['tname']=$query_1?$query_1['tname']:"";
				}else {
					$contacts_list[$k]['tname']="";
				}
			}
			$total_page=ceil($count[0]['COUNTER']/$page_size);
			$str.="<div class='inbox2_right4'>";
			if ($contacts_list){
				foreach ($contacts_list as $k=>$v){
					$str.="<div class='contact1'>";
					$str.="<div class='contact1_1'><input name='C".$k."' type='checkbox' value=".$v['username']." /></div>";
					$str.="<div class='contact1_2'><a href='#' rel='nofollow'><img src='".base_url('skin/images/lianxiren_06.jpg')."' width='32' height='32' /></a></div>";
					$str.="<div class='contact1_3'><img src='".base_url('skin/images/lianxiren_03.jpg')."' width='11' height='11' /></div>";
					$str.="<div class='contact1_4'><A href=".site_url("user/message/contacts_detail/".$v['username']."/".$page).">".$v['username']."</A><span>(".$v['username'].")</span></div>";
					$str.="<div class='contact1_5'><img src='".base_url("skin/images/registration_06.jpg")."' width='21' height='16' title=".$v['areaname']." /></div>";
					$str.="<div class='contact1_6'>".$v['tname']."</div>";
					$str.="<div class='contact1_7'>Good friend!</div>";
					$str.="<div class='clear'></div>";
					$str.="</div>";
				}
			}else {
				$str.="<br/><br/><br/><center>There's no any friend!</center>";
			}
			$str.="</div>";
			$str.="<div style='padding-top:5px;padding-bottom:5px;'>";
			$str.="<div class='black-red'><span class='disabled'>";
			if ($total_page>1){
				foreach(range(1,$total_page) as $v){
					if ($v==$page){
						$str.='&nbsp;&nbsp;<span class="current">'.$v.'</span>&nbsp;&nbsp;';
					}else{
						$str.='&nbsp;&nbsp;<span onclick="search(this.innerHTML)" style="cursor:pointer">'.$v.'</span>&nbsp;&nbsp;';
					}
				}
			}
			$str.="</span></div>";
			$str.="</div>";
		}elseif ($act=='search_msg'){
			$type=$this->input->post('type',TRUE);
			$typeid=intval($this->input->post('typeid',TRUE));
			if ($type=='inbox'){
				if ($typeid!=-1){
					$sql="SELECT mid,title,content,fromuser,touser,addtime,isread FROM wl_message WHERE typeid = {$typeid} AND touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0 AND title like '%{$keywords}%' ORDER BY addtime desc Limit {$offset},{$page_size}";
					$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_message WHERE typeid = {$typeid} AND touser = '{$username}' AND isread = 0 AND status = 1 AND isdel_r = 0 AND title like '%{$keywords}%'";
				}else{
					$sql="SELECT mid,title,content,fromuser,touser,addtime,isread FROM wl_message WHERE touser = '{$username}' AND status = 1 AND isdel_r = 0 AND title like '%{$keywords}%' ORDER BY addtime desc Limit {$offset},{$page_size}";
					$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_message WHERE touser = '{$username}' AND status = 1 AND isdel_r = 0 AND title like '%{$keywords}%'";
				}				
			}elseif ($type=='sent_box'){
				$sql="SELECT mid,title,content,fromuser,touser,addtime FROM wl_message WHERE fromuser = '{$username}' AND isdel_s = 0  AND status <> 2 AND title like '%{$keywords}%' ORDER BY addtime desc Limit {$offset},{$page_size}";
				$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_message WHERE fromuser = '{$username}' AND isdel_s = 0 AND status <> 2 AND title like '%{$keywords}%'";
			}elseif ($type=='trash'){
				$sql="SELECT mid,title,content,fromuser,touser,addtime FROM wl_message WHERE touser = '{$username}' AND status = 0 AND isdel_r = 0 AND title like '%{$keywords}%' ORDER BY addtime desc Limit {$offset},{$page_size}";
				$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_message WHERE touser = '{$username}' AND status = 0 AND isdel_r = 0 AND title like '%{$keywords}%'";
			}elseif ($type=='drafts'){
				$sql="SELECT mid,title,content,fromuser,touser,addtime FROM wl_message WHERE fromuser = '{$username}' AND status = 2 AND isdel_s = 0 AND title like '%{$keywords}%' ORDER BY addtime desc Limit {$offset},{$page_size}";
				$sql_1="SELECT COUNT(*) AS COUNTER FROM wl_message WHERE fromuser = '{$username}' AND status = 2 AND isdel_s = 0 AND title like '%{$keywords}%'";
			}
			$query = $this->db->query($sql);	
			$query_1 = $this->db->query($sql_1);
			$message_list = $query->result_array();
			$count=$query_1->result_array();			
			foreach ($message_list as $k=>$v){
				if ($type=='inbox' || $type=='trash'){
					if ($v['fromuser']){
						$query_1 = $this->comm->find("member",array("username"=>$v['fromuser']),'','areaid');
						$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
						$message_list[$k]['areaname']=$query_2?$query_2['areaname']:"";
					}else {
						$message_list[$k]['areaname']="";
					}
				}else{
					if ($v['touser']){
						$query_1 = $this->comm->find("member",array("username"=>$v['touser']),'','areaid');
						$query_2 = $this->comm->find("area",array("areaid"=>$query_1['areaid']),'','areaname');
						$message_list[$k]['areaname']=$query_2?$query_2['areaname']:"";
					}else {
						$message_list[$k]['areaname']="";
					}
				}
			}
			$total_page=ceil($count[0]['COUNTER']/$page_size);
			if ($message_list){
				foreach ($message_list as $k=>$v){
					$str.="<div class='inbox2_right4_1'>";
					$str.="<div class='inbox2_right41'>";
					$str.="<span id='inbox2_right41_1'><input type='checkbox' name='C".$k."' value='".$v['mid']."' /></span>";					
					if ($type=='inbox' && !$v['isread']){
						$str.="<span id='inbox2_right41_2'><img src='".base_url('skin/images/mm_45.jpg')."' /></span>";
					}else{
						$str.="<span id='inbox2_right41_2'><img src='".base_url('skin/images/inm_46.jpg')."' /></span>";
					}
					if ($type=='inbox' || $type=='trash'){												
						$str.="<span class='inbox2_right41_3' style='cursor:pointer;' onClick='show_friend(".$v['fromuser'].")'>".$v['fromuser']."</span>";
					}else{
						$str.="<span class='inbox2_right41_3' style='cursor:pointer;' onClick='show_friend(".$v['fromuser'].")'>".$v['touser']."</span>";
					}
					$str.="<span class='inbox2_right41_4'><a href='".site_url('user/message/mes_detail/'.$v['mid'].'/'.$type)."' style='color:black'><b>".strip_tags($v['title'])."</b></a></span>";
					$str.="<span>";
					if (date("Y-m-d",$v['addtime'])==date("Y-m-d")){
						$str.=date("H:i",$v['addtime']);
					}elseif (date("Y-m-d",$v['addtime'])==date("Y-m-d",strtotime("-1 day"))){
						$str.="Yesterday";
					}elseif (date("Y",$v['addtime'])==date("Y")){
						$str.=date("m-d",$v['addtime']);
					}else{
						$str.=date("Y",$v['addtime']);
					}
					$str.="</span>";
					$str.="<span class='inbox2_right41_5'><img src='".base_url('skin/images/inm_42.jpg')."' title='".$v['areaname']."'/></span>";
					$str.="<div class='clear'></div></div>";
					$str.="<div class='inbox2_right42'>".mb_substr(strip_tags($v['content']), 0,235,"utf-8")."......</div></div>";
				}
			}else {
				$str.="<br/><br/><br/><center>There's no any message matched!</center>";
			}
			$str.="<div style='padding-top:5px;padding-bottom:5px;'>";
			$str.="<div class='black-red'><span class='disabled'>";
			if ($total_page>1){
				foreach(range(1,$total_page) as $v){
					if ($v==$page){
						$str.='&nbsp;&nbsp;<span class="current">'.$v.'</span>&nbsp;&nbsp;';
					}else{
						$str.='&nbsp;&nbsp;<span onclick="search(this.innerHTML)" style="cursor:pointer">'.$v.'</span>&nbsp;&nbsp;';
					}
				}
			}
			$str.="</span></div></div>";
		}
	$this->output->set_output($str);
	}
		
	
	public function modify(){
		$act=$this->input->post('act',TRUE);
		$fid=$this->input->post('fid',TRUE)?$this->input->post('fid',TRUE):0;
		$fri_class=$this->input->post('fri_class',TRUE)?$this->input->post('fri_class',TRUE):0;
		$fri_username=$this->input->post('username',TRUE);		
		if($act=='modify'){
			$new_truename=$this->input->post('truename',TRUE);
			$rs=$this->comm->update('friend',array('fid'=>$fid,'username'=>$fri_username), array('truename'=>$new_truename,'typeid'=>$fri_class));
			$msg=$rs?'Modify successfully!':'Modify failed!';
		}elseif($act=='delete_class'){	
			$rs=$this->comm->findCount("friend_type", array("tid"=>$fri_class));
			if (!$rs){
				$msg='The classification your deleted is not existed,please try again!';
			}else{
				$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
				$userid = $userid['userid'];
				$rs_1=$this->comm->findCount("friend", array("userid"=>$userid,"typeid"=>$fri_class));
				if ($rs_1){
					$msg="The classification your deleted has friends under it,so it can't be deleted!";
				}else{
					$rs_2=$this->comm->delete("friend_type",array("tid"=>$fri_class,"userid"=>$userid));
					$msg=$rs_2?'Delete classification successfully!':'Delete classification failed!';
				}
			}
		}
		$this->output->set_output($msg);
	}
	
	
	//edit friend type
	public function edit_ftype(){
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
		$tid = strip_tags(trim($this->input->post('tid',TRUE)));
		$tname = strip_tags(trim($this->input->post('tname',TRUE)));
		$output=-1;
		if ($tname && $tname!='Others' && $tname!='others'){
			$rs_1 = $this->comm->findCount('friend_type',array('tname'=>$tname,'userid'=>$userid));
			$rs_2 = $this->comm->findCount('friend_type',array('tid'=>$tid,'userid'=>$userid));
			if ($rs_1==0 && $rs_2){
				$result = $this->comm->update('friend_type',array('tid'=>$tid,'userid'=>$userid),array('tname'=>$tname));
				$output=$result?$result:0;
			}
		}elseif($tname==''){
			$output=0;
		}
		echo $output;
	}
	
	
	//friend type
	public function create_ftype(){
		$userid = $this->comm->find("member",array("username"=>$this->username),'','userid');
		$userid = $userid['userid'];
		$type_name = strip_tags(trim($this->input->post('type_name',TRUE)));
		if ($type_name){
			$result_count = $this->comm->findCount('friend_type',array('tname'=>$type_name,'userid'=>$userid));
			if ($result_count==0 && $type_name!='Others' && $type_name!='others'){
				$result = $this->comm->create('friend_type',array('tname'=>$type_name,'listorder'=>'1','userid'=>$userid));
				if ($result){
					$output = $result;
				}else {
					$output = 0;
				}
			}else {
				$output = -1;
			}
		}else {
			$output = 0;
		}
	
		echo $output;
	}
	
	//wl_message:定义typeid：0为普通通话，1为加好友，2为询单
	function quick_reply(){
		$msg='0';
		if ($_POST){
			$site = $this->config->item('site');
			if($this->username==strip_tags($this->input->post('from',TRUE))){
				$content=strip_tags($this->input->post('content',TRUE));
				$content=preg_replace("/[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+/i", "*", $content);
				$content=str_replace(array("\r\n", "\n", "\r"), "<br />", $content);
				$typeid=intval($this->input->post('typeid',TRUE));
				if ($typeid==2){
					$auth=md5($this->config->item('encryption_key').mt_rand());
				}else{
					$auth='';
				}	
				$touser	= strip_tags($this->input->post('to',TRUE));				
				$iid=intval($this->input->post('inquiry_id',TRUE));		
				$message = array(
						'title'	=> strip_tags($this->input->post('subject',TRUE)),
						'typeid'=> $typeid,
						'content' => $content,
						'fromuser' => $this->username,
						'touser' => $touser,
						'addtime' => time(),
						'ip' => $this->input->ip_address(),
						'issend'=>1,
						'status'=>1,
						'auth'=>$auth
				);
				$insert_id = $this->comm->create('message',$message);
				if ($insert_id){
					$this->comm->update('message',array('mid'=>intval($this->input->post('mid',TRUE))),array('feedback'=>1));
					$count=$this->comm->findCount("member", array('email'=>$touser,'vmail'=>1));
					if($count){						
						echo $msg='1';
						exit;
					}
					if ($typeid==2 && !$touser){
						$uemail = $this->comm->find("inquiry",array("id"=>$iid),'','id,email,sid');
						if(!$uemail){							
							echo $msg='-1';
							exit;
						}							
						$frommsg=$this->comm->find("member",array("username"=>$this->username),"","company,truename,mobile,areaid");
						$frommsg_1=$this->comm->find("company",array("username"=>$this->username),"","telephone,mail");
						$frommsg_1=$frommsg_1?$frommsg_1:array('telephone'=>'','mail'=>'');
						$country=$this->comm->find("area",array("areaid"=>$frommsg['areaid']),"","areaname");
						$country=$country?$country['areaname']:'';
						$inquiry=array(
								'title'=>strip_tags($this->input->post('subject',TRUE)),
								'fromuser' => $this->username,
								'company' => $frommsg['company'],
								'country' => $country,
								'truename' => $frommsg['truename'],
								'telephone' => $frommsg_1['telephone'],
								'mobile' => $frommsg['mobile'],
								'email' => $frommsg_1['mail'],
								'sid'=>$uemail['sid'],
								'ip' => $this->input->ip_address(),
								'postdate' => time(),								
								'pid'=>$uemail['id'],
								'inquiry_data'=>array('message'=>$content)
						);												
						$inquiry_id = $this->comm->linker()->create('inquiry',$inquiry);
						$this->comm->update('message',array('mid'=>$insert_id),array('iid'=>$inquiry_id));
						$call=array_shift(explode('@', $uemail['email']));
						$this->load->config("email");
						$email = $this->config->item("email");
						$link=sell_url(site_url("supplier_connect/nomem_inquiry/".$insert_id."/".$auth));
						$this->load->library('email', $email);
						$this->email->set_newline("\r\n");
						$my_email = $email['smtp_user'];
						$this->email->from($my_email, strtoupper($site['site_name']));
						$this->email->to($uemail['email']);
						$this->email->subject('Information about reply for inquiry from '.ucfirst($site['site_name']));
						$str="Dear ".$call."<br/>Please click <a href='".$link."'>here</a> to read the information about reply of your inquiry.";
						$str.="<br/>The message is just a notification, not receiving any reply.";
						$str.="<br/>PLEASE DO NOT REPLY to this message.";
						$str.="<br/>If you have any questions, please do not hesitate to visit our official website.";
						$str.="<br/>If you can&#39;t click the link, please copy the following link to your address bar and visit it!<br/>";
						$str.=$link;
						$this->email->message($str);
						if($this->email->send()){
							$msg=1;
						}else{
							$msg=-1;
						}
					}else{
						echo $msg='1';
						exit;
					}
				}else {
					$msg=-1;
				}
			}			
		}		
		echo $msg;
	}	
}