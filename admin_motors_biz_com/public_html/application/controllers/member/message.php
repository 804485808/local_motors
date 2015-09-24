<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	//status:	0->垃圾箱		1->已发送		2->草稿箱    3->其他
	//isread:	0->未读		1->已读
	//issend:	0->未发送		1->已发送
	//wl_message:定义typeid：0为普通，1为加好友，2为询单
	
	function search(){
		$tmp = '';
		$username = '';
		$data['class']='sell';
		$dfields = array('title','fromuser', 'touser', 'ip', 'content');
		if ($this->uri->rsegment(5,'')){
			$page = $this->uri->rsegment(5,0);
			$str_url = $this->uri->rsegment(4,'');
			$username = $this->uri->rsegment(3,'');
			$uri_segment = 6;
		}else {
			$page = $this->uri->rsegment(4,0);
			$str_url = $this->uri->rsegment(3,'');
			$uri_segment = 5;
		}
		$page = intval($page);
		if ($str_url){
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$timetype,$fromtime,$totime,$type,$status,$read,$send,$psize) = $cond;
			if(preg_match("/BIZ/",$keyword)){
				$keyword = str_replace("BIZ","-",$keyword);
			}
		}
		if ($_POST){
			$tmp = $this->input->post('action');
			$username = $this->input->post('username','');
		}
		if ($tmp){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$timetype = $this->input->post('timetype',TRUE);
			$fromtime = strtotime($this->input->post('fromtime',TRUE).' 00:00:00');
			$totime = strtotime($this->input->post('totime',TRUE).' 23:59:59');
			$type = $this->input->post('type',TRUE);
			$status = $this->input->post('status',TRUE);
			$read = $this->input->post('read',TRUE);
			$send = $this->input->post('send',TRUE);
			$psize = intval(strip_tags(trim($this->input->post('psize',TRUE))));
		}
		$username ? $condition = "touser = '{$username}'" : $condition = '1';
		if ($keyword) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($this->input->post('fromtime')) $condition .= " AND {$timetype}>{$fromtime}";
		if($this->input->post('totime')) $condition .= " AND {$timetype}<{$totime}";
		if ($status != '') $condition .= " AND status = {$status}";
		if ($type !='') {
			if ($type==0){
				$condition .= " AND typeid = 0 AND isread = 1";
			}elseif ($type==1){
				$condition .= " AND typeid = 2 AND isread = 1";
			}elseif ($type==2){
				$condition .= " AND typeid = 2 AND isread = 0";
			}elseif ($type==3){
				$condition .= " AND typeid = 0 AND isread = 0";
			}
		}
		if ($read !='') $condition .= " AND isread = {$read}";
		if ($send !='') $condition .= " AND issend = {$send}";
		if($psize) $psizes = " {$page},{$psize}";
		$psize ? $page_size = $psize : $page_size = 20;
		$messages = $this->comm->findAll('message',$condition,'addtime desc','',$psizes);
		dump($this->db->queries);
		if (!$messages){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['messages_count'] = $messages_count=$this->comm->findCount('message',$condition);
		foreach ($messages as $k=>$v){
			$messages[$k]['action'] = 'msg_list2';
			if ($v['typeid']==0 && !$v['isread']){
				$messages[$k]['type_img']="message_4.gif";
				$messages[$k]['type_name']="信使";
			}elseif ($v['typeid']==0 && $v['isread']){
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="普通";
			}elseif ($v['typeid']==2 && !$v['isread']){
				$messages[$k]['type_img']="message_2.gif";
				$messages[$k]['type_name']="报价";
			}elseif ($v['typeid']==2 && $v['isread']){
				$messages[$k]['type_img']="message_1.gif";
				$messages[$k]['type_name']="询价";
			}else {
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="其他";
			}
			switch ($v['status']){
				case 0:
					$messages[$k]['status']='垃圾箱';
					break;
				case 2:
					$messages[$k]['status']='草稿箱';
					break;
				default:
					$messages[$k]['status']='收件箱';
					break;
			}
		}
		$data['messages'] = $messages;
		$data['username'] = $username;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		if ($username){
			$base_url = site_url("member/message/search/".$username.'/'.$fields.'-'.$keyword.'-'.$timetype.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$type.'-'.$status.'-'.$read.'-'.$send.'-'.$psize);
		}else {
			$base_url = site_url("member/message/search/".$fields.'-'.$keyword.'-'.$timetype.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$type.'-'.$status.'-'.$read.'-'.$send.'-'.$psize);
		}
		
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $messages_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($messages_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		if ($username){
			$this->load->view('member/member/view_msg',$data);
		}else {
			$this->load->view('member/message/msg_list',$data);
		}
	}
	
	function view_list(){
		$username = $this->uri->rsegment(3,'');
		$page = $this->uri->rsegment(4,0);
		$uri_segment = 5;
		$base_url = site_url("member/message/view_list/".$username);
		$data['username'] = $username;
		$data['class'] = "list";
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$typeid = explode("-",$page);
			$typeid = intval($typeid[1]);
			$isread = explode("-",$this->uri->rsegment(5,0));
			$isread = intval($isread[1]);
			$page = $this->uri->rsegment(6,0);
			$uri_segment = 7;
			$condition=array('typeid'=>$typeid,'isread'=>$isread,'touser'=>$username);
			$base_url = site_url("member/message/view_list/".$this->uri->rsegment(4,0)."/".$this->uri->rsegment(5,0)."/");
		}else {
			$condition="touser = '{$username}'";
		}
		$page = intval($page);
		$data['fun_name']=__FUNCTION__;
		$data['page_size']=$page_size=2;
		$messages=$this->comm->findAll("message",$condition,"addtime desc","mid,title,typeid,fromuser,touser,addtime,ip,isread,issend,status","{$page},{$page_size}");
		foreach ($messages as $k=>$v){
			if ($v['typeid']==0 && !$v['isread']){
				$messages[$k]['type_img']="message_4.gif";
				$messages[$k]['type_name']="信使";
			}elseif ($v['typeid']==0 && $v['isread']){
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="普通";
			}elseif ($v['typeid']==2 && !$v['isread']){
				$messages[$k]['type_img']="message_2.gif";
				$messages[$k]['type_name']="报价";
			}elseif ($v['typeid']==2 && $v['isread']){
				$messages[$k]['type_img']="message_1.gif";
				$messages[$k]['type_name']="询价";
			}else {
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="其他";
			}
			switch ($v['status']){
				case 0:
					$messages[$k]['status']='垃圾箱';
					break;
				case 2:
					$messages[$k]['status']='草稿箱';
					break;
				default:
					$messages[$k]['status']='收件箱';
					break;
			}
		}
		$data['messages']=$messages;
		$data['messages_count']=$messages_count=$this->comm->findCount("message",$condition);
		$data['total_page']=ceil($messages_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $messages_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/member/view_msg',$data);
	}
	function view_list1(){
		$data['page_size']=$page_size=20;
		$username = $this->uri->rsegment(3,'');
		$data['username'] = $username;
		$data['class'] = "system";
		$page = $this->uri->rsegment(4,0);
		$admin_1=$this->comm->findAll("member",array("groupid"=>1),"","username");
		foreach ($admin_1 as $v){
			$admin[]="'".$v['username']."'";
		}
		$admin=join(',', $admin);
		$data['msg_system']=$this->comm->findAll("message","fromuser in ({$admin}) AND touser = '{$username}'","addtime desc","mid,title,touser,addtime","{$page},{$page_size}");
		$data['msg_count']=$msg_count=$this->comm->findCount("message","fromuser in ({$admin}) AND touser = '{$username}'");
		dump($this->db->queries);
		$data['total_page']=ceil($msg_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = site_url("member/message/".__FUNCTION__.'/'.$username);
		$config['total_rows'] = $msg_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 5;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/member/view_msg_system',$data);
	}
	function view_msg_show(){
		$mid=intval($this->uri->rsegment(3,0));
		$data['username'] = trim($this->uri->rsegment(4,''));
		$data['msg_detail']=$msg_detail=$this->comm->find('message',array('mid'=>$mid),'','mid,title,content,fromuser,touser,addtime,ip');
		$this->load->view('member/member/view_msg_show',$data);
	}
	
	function msg_list2(){
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("member/message/msg_list2");
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$typeid = explode("-",$page);
			$typeid = intval($typeid[1]);
			$isread = explode("-",$this->uri->rsegment(4,0));
			$isread = intval($isread[1]);
			$page = $this->uri->rsegment(5,0);		
			$uri_segment = 6;
			$condition=array('typeid'=>$typeid,'isread'=>$isread);
			$base_url = site_url("member/message/msg_list2/".$this->uri->rsegment(3,0)."/".$this->uri->rsegment(4,0)."/");
		}else {
			$condition="";
		}	
		$page = intval($page);
		$data['fun_name']=__FUNCTION__;
		$data['page_size']=$page_size=20;
		$messages=$this->comm->findAll("message",$condition,"addtime desc","mid,title,typeid,fromuser,touser,addtime,ip,isread,issend,status","{$page},{$page_size}");		
		foreach ($messages as $k=>$v){
			if ($v['typeid']==0 && !$v['isread']){
				$messages[$k]['type_img']="message_4.gif";
				$messages[$k]['type_name']="信使";
			}elseif ($v['typeid']==0 && $v['isread']){
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="普通";
			}elseif ($v['typeid']==2 && !$v['isread']){
				$messages[$k]['type_img']="message_2.gif";
				$messages[$k]['type_name']="报价";
			}elseif ($v['typeid']==2 && $v['isread']){
				$messages[$k]['type_img']="message_1.gif";
				$messages[$k]['type_name']="询价";
			}else {
				$messages[$k]['type_img']="message_0.gif";
				$messages[$k]['type_name']="其他";
			}
			switch ($v['status']){
				case 0:
					$messages[$k]['status']='垃圾箱';
					break;
				case 2:
					$messages[$k]['status']='草稿箱';
					break;
				default:
					$messages[$k]['status']='收件箱';
					break;
			}
		}
		$data['messages']=$messages;		
		$data['messages_count']=$messages_count=$this->comm->findCount("message",$condition);
		$data['total_page']=ceil($messages_count/$page_size);
		$this->load->library('pagination');		
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $messages_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links(); 
		$this->load->view('member/message/msg_list',$data);
	}
	
	function msg_show2(){
		$mid=intval($this->uri->rsegment(3,0));
		$data['msg_detail']=$msg_detail=$this->comm->find('message',array('mid'=>$mid),'','mid,title,content,fromuser,touser,addtime,ip');
		$this->load->view('member/message/msg_show',$data);
	}
	
	function del_msg(){
		$mid=intval($this->uri->rsegment(3,0));
		$del_mid=array();
		if($mid){
			$del_mid=array($mid);
		}elseif ($_POST){
			$del_mid=$this->input->post('itemid',TRUE);
		}
		if ($del_mid){
			$c=0;
			foreach ($del_mid as $v){
				$findmsg = $this->comm->findCount("message",array("mid"=>$v));
				if ($findmsg){
					$delmsg = $this->comm->delete("message",array("mid"=>$v));
					$c = $delmsg ? $c+1 : $c;
				}else{
					$rs="没有找到此产品!";
					$data['msg']=$rs;
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}
			}
			$rs=$c==count($del_mid)?"信件删除成功！":"信件删除失败，请重试!";
		}else{
			$rs="请选择信件";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function msg_send2(){
		if ($_POST){
			$userid=$this->input->post('userid',TRUE);
			if (!is_array($userid)){
				$data['msg'] = '请选择收件人';
				$url=$this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			$username = array();
			foreach ($userid as $v){
				$rs = $this->comm->find('member',array('userid'=>$v),'','userid,username');
				$username[] = $rs['username'];
			}
			$data['touser'] = implode(";", $username).";";
		}else {
			$data['touser'] = $this->uri->rsegment(3,'');
		}
		$this->load->view('member/message/msg_send',$data);
	}
	
	function save_msg(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->lang->load('form_validation','chinese');
		$message = $this->input->post('message',TRUE);
		$type = $message['type'];
		if ($type){
			$this->form_validation->set_rules('message[groupids][]', '会员组', 'trim|required|xss_clean');
		}else {
			$this->form_validation->set_rules('message[touser]', '收件人', 'trim|required|min_length[2]|max_length[160]|xss_clean');
		}
		$this->form_validation->set_rules('message[title]', '信件标题', 'trim|required|min_length[2]|max_length[100]|xss_clean');
		$this->form_validation->set_rules('message[content]', '信件内容', 'trim|required|min_length[5]|max_length[3000]|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$data['msg'] = validation_errors();
			$url=$this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$title= strip_tags(trim($message['title']));
		$content = strip_tags(trim($message['content']));
		if ($type){
			$groupids = array();
			$username = array();
			$sql['groupids'] = $groupids[] = $message['groupids'];
			foreach ($groupids as $k=>$v){
				foreach ($v as $s){
					$rs = $this->comm->findAll('member',array('groupid'=>$s),'','userid,username');
					if (!$rs){
						$data['msg'] = '会员组没有会员,请重新选择';
						$url=$this->load->view('public/success',$data,TRUE);
						echo $url;
						die();
					}
					foreach ($rs as $m => $val){
						$username[$m] = $val['username'];
					}
				}
			}
		}else {
			$touser = strip_tags(trim($message['touser']));
			if ($touser){
				$username = explode(';', $touser);
				if (!$username[count($username)-1]) {array_pop($username);}
				foreach ($username as $v){
					$v = trim($v);
					$rs = $this->comm->findCount('member',array('username'=>$v));
					if (!$rs){
						$data['msg'] = '会员名称有误,请重新填写';
						$url=$this->load->view('public/success',$data,TRUE);
						echo $url;
						die();
					}
				}
			}
		}
		if ($username){
			$count = 0;
			foreach ($username as $k => $v){
				$v = trim($v);
				$tmp = $this->username;
				if($tmp == $v) unset($username[$k]);
			}
			foreach ($username as $val){
				$sql = array('title'=>$title,'typeid'=>3,'content'=>$content,'fromuser'=>$this->username,'touser'=>$val,'addtime'=>time(),'ip'=>$this->input->ip_address(),'isread'=>0,'issend'=>0,'status'=>1);
				$this->comm->create('message',$sql);
				$count++;
				$msg = '信件发送成功, 共发送'.$count.'封信件';
			}
		}else {
			$msg = '信件发送失败';
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	//数据恢复
	function get_data(){
		$rs = $this->comm->find('message',array('fromuser'=>$this->username,'status'=>2),'addtime DESC');
		$title = $rs['title'];
		$content = $rs['content'];
		echo json_encode(array('title'=>$title,'content'=>$content));
	}
	//暂存草稿
	function save_draft(){
		$act = $this->uri->rsegment(3,'');
		$title = strip_tags($this->input->post('title',TRUE));
		$content = strip_tags($this->input->post('content',TRUE));
		$sql = array('title'=>$title,'typeid'=>3,'content'=>$content,'fromuser'=>$this->username,'addtime'=>time(),'ip'=>$this->input->ip_address(),'isread'=>0,'issend'=>0,'status'=>2);
		$r = $this->comm->find('message',array('fromuser'=>$this->username,'status'=>2),'addtime DESC');
		if ($r){
			$rs = $this->comm->update('message',array('mid'=>$r['mid']),$sql);
		}else {
			$rs = $this->comm->create('message',$sql);
		}
		if ($act == 'auto'){
			echo date("Y-m-d H:i:s").", 草稿自动保存成功";
		}
		if ($rs){
			echo "草稿保存成功";
	
		}else {
			echo "草稿保存失败";
		}
	}
	
	function msg_system2(){
		$data['page_size']=$page_size=20;
		$page = $this->uri->rsegment(3,0);
		$admin_1=$this->comm->findAll("member",array("groupid"=>1),"","username");
		foreach ($admin_1 as $v){
			$admin[]="'".$v['username']."'";
		}
		$admin=join(',', $admin);		
		$data['msg_system']=$this->comm->findAll("message","fromuser in ({$admin})","addtime desc","mid,title,touser,addtime","{$page},{$page_size}");
		$data['msg_count']=$msg_count=$this->comm->findCount("message","fromuser in ({$admin})");
		$data['total_page']=ceil($msg_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = site_url("member/message/".__FUNCTION__);
		$config['total_rows'] = $msg_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/message/msg_system',$data);
	}

	function msg_clear2(){		
		if ($_POST){
			$fromdate=$this->input->post("fromdate",TRUE);
			$todate=$this->input->post("todate",TRUE);
			$fromtime=strtotime($fromdate);
			$totime=strtotime($todate);
			if (!$fromdate){$fromtime=0;}
			if (!$todate){$totime=time();}
			if ($fromtime>time() || $totime>time()){
				$data['msg']="截止日期或起始日期不能超过当前日期 ";
				echo $this->load->view("public/success",$data,TRUE);
				exit;
			}
			if ($totime<$fromtime){
				$data['msg']="截止日期不能小于起始日期";
				echo $this->load->view("public/success",$data,TRUE);
				exit;
			}elseif ($totime==$fromtime){
				$totime=$fromtime+24*60*60;
			}
			
			$condition="addtime > {$fromtime} AND addtime < {$totime}";
			$unread=$this->input->post("unread",TRUE);
			if ($unread){
				$condition.=" AND isread = 1";
			}
			$status=$this->input->post("status",TRUE);
			if ($status!=''){
				$condition.=" AND status = '{$status}'";
			}
			$del_id=$this->comm->findAll("message",$condition,"","mid");
			if ($del_id){
				$j=0;
				foreach ($del_id as $v){
					$rs=$this->comm->delete("message",array("mid"=>$v['mid']));
					$j = $rs ? $j+1 : $j;
				}
				$msg = $j==count($del_id) ? "信件清理成功" : "信件清理失败，请重试";
			}else{
				$msg="在此期间内没有您所要找的信件";
			}
			$data['msg'] = $msg;
			echo $this->load->view("public/success",$data,TRUE);
			exit;
		}
		$this->load->view('member/message/msg_clear');
	}
}