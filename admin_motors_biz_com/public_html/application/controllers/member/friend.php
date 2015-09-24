<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Friend extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function search(){
		$tmp = '';
		$username = '';
		$dfields = array('','username', 'truename');
		if ($this->uri->rsegment(5,'')){
			$page = $this->uri->rsegment(5,0);
			$str_url = $this->uri->rsegment(4,'');
			$username = $this->uri->rsegment(3,'');
			$r=$this->comm->find("member",array("username"=>$username),"","userid");
			$userid = $r['userid'];
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
			list($fields,$keyword,$userid) = $cond;
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
			$userid = strip_tags(trim($this->input->post('userid',TRUE)));
		}
		$username ? $condition = "userid = '{$userid}'" : $condition = '1';
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if ($userid != '') $condition .= " AND userid = {$userid}";
		$page_size = 20;
		$friends = $this->comm->findAll('friend',$condition,'','',"{$page},{$page_size}");
		dump($this->db->queries);
		if (!$friends){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		foreach ($friends as $k=>$v){
			$rs=$this->comm->find("member",array("username"=>$v["username"]),"","company,email,mobile,qq,ali,skype,career");
			$rs_1=$this->comm->find("company",array("username"=>$v["username"]),"","homepage");
			$rs_2=$this->comm->find("friend_type",array("tid"=>$v["typeid"]),"","tname");
			$rs_3=$this->comm->find("member",array("userid"=>$v["userid"]),"","username");
			$friends[$k]['company']=$rs['company'];
			$friends[$k]['email']=$rs['email'];
			$friends[$k]['mobile']=$rs['mobile'];
			$friends[$k]['qq']=$rs['qq'];
			$friends[$k]['ali']=$rs['ali'];
			$friends[$k]['skype']=$rs['skype'];
			$friends[$k]['career']=$rs['career'];
			$friends[$k]['homepage']=$rs_1['homepage'];
			$friends[$k]['tname']=$rs_2['tname'];
			$friends[$k]['myname']=$rs_3['username'];
		}
		$data['friends_count'] = $friends_count=$this->comm->findCount('friend',$condition);
		$data['friends'] = $friends;
		$data['username'] = $username;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		if ($username){
			$base_url = site_url("member/friend/search/".$username.'/'.$fields.'-'.$keyword.'-'.$userid);
		}else {
			$base_url = site_url("member/friend/search/".$fields.'-'.$keyword.'-'.$userid);
		}
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $friends_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($friends_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		if ($username){
			$this->load->view('member/member/view_friend',$data);
		}else {
			$this->load->view('member/friend/friend_list',$data);
		}
	}
	
	function search_type(){
		$dfields = array('','tid', 'tname');
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		if ($this->uri->rsegment(3,'')){
			$str_url = $this->uri->rsegment(3,'');
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$userid) = $cond;
		}
		if ($this->input->post('action')){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$userid = strip_tags(trim($this->input->post('userid',TRUE)));
		}
		$condition = "tid > 0";
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if ($userid != '') $condition .= " AND userid = {$userid}";
		$uri_segment = 5;
		$page_size = 20;
		$type = $this->comm->findAll('friend_type',$condition,'listorder asc','',"{$page},{$page_size}");
		if (!$type){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		foreach ($type as $k=>$v){
			$type[$k]['friends_count']=$this->comm->findCount("friend",array("typeid"=>$v['tid']));
			$temp=$this->comm->find("member",array("userid"=>$v['userid']),"","username");
			$type[$k]['username']=$temp['username'];
		}
		$data['types']=$type;
		$data['type_count'] = $type_count=$this->comm->findCount('friend_type',$condition);
		$base_url = site_url("member/friend/search_type/".$fields.'-'.$keyword.'-'.$userid);
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $type_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($type_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$this->load->view('member/friend/type_list',$data);
	}
	
	function view_list(){
		$data['page_size']=$page_size=20;
		$username = $this->uri->rsegment(3,'');
		$data['username'] = $username;
		$r=$this->comm->find("member",array("username"=>$username),"","userid");
		$userid = $r['userid'];
		$page = $this->uri->rsegment(4,0);
		$uri_segment = 5;
		$base_url = site_url("member/friend/view_list/".$username);
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$tid = explode("-",$page);
			$tid = intval($tid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition=array('typeid'=>$tid,'userid'=>$userid);
			$base_url = site_url("member/friend/view_list/".$username.'/'.$this->uri->rsegment(3,'')."/");
		}else {
			$condition="userid = $userid";
		}
		$page = intval($page);
	
		$friends=$this->comm->findAll("friend",$condition,"addtime desc","fid,userid,username,truename,typeid,addtime","{$page},{$page_size}");
		foreach ($friends as $k=>$v){
			$rs=$this->comm->find("member",array("username"=>$v["username"]),"","company,email,mobile,qq,ali,skype,career");
			$rs_1=$this->comm->find("company",array("username"=>$v["username"]),"","homepage");
			$rs_2=$this->comm->find("friend_type",array("tid"=>$v["typeid"]),"","tname");
			$rs_3=$this->comm->find("member",array("userid"=>$v["userid"]),"","username");
			$friends[$k]['company']=$rs['company'];
			$friends[$k]['email']=$rs['email'];
			$friends[$k]['mobile']=$rs['mobile'];
			$friends[$k]['qq']=$rs['qq'];
			$friends[$k]['ali']=$rs['ali'];
			$friends[$k]['skype']=$rs['skype'];
			$friends[$k]['career']=$rs['career'];
			$friends[$k]['homepage']=$rs_1['homepage'];
			$friends[$k]['tname']=$rs_2['tname'];
			$friends[$k]['myname']=$rs_3['username'];
		}
		$data['friends']=$friends;
		$data['friends_count']=$friends_count=$this->comm->findCount("friend",$condition);
		$data['total_page']=ceil($friends_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $friends_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/member/view_friend',$data);
	}
	
	function friend_list2(){
		$data['page_size']=$page_size=20;	
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("member/friend/friend_list2");
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$tid = explode("-",$page);
			$tid = intval($tid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition=array('typeid'=>$tid);
			$base_url = site_url("member/friend/friend_list2/".$this->uri->rsegment(3,'')."/");
		}else {
			$condition="";
		}
		$page = intval($page);
		
		$friends=$this->comm->findAll("friend",$condition,"addtime desc","fid,userid,username,truename,typeid,addtime","{$page},{$page_size}");
		foreach ($friends as $k=>$v){
			$rs=$this->comm->find("member",array("username"=>$v["username"]),"","company,email,mobile,qq,ali,skype,career");
			$rs_1=$this->comm->find("company",array("username"=>$v["username"]),"","homepage");
			$rs_2=$this->comm->find("friend_type",array("tid"=>$v["typeid"]),"","tname");
			$rs_3=$this->comm->find("member",array("userid"=>$v["userid"]),"","username");
			$friends[$k]['company']=$rs['company'];
			$friends[$k]['email']=$rs['email'];
			$friends[$k]['mobile']=$rs['mobile'];
			$friends[$k]['qq']=$rs['qq'];
			$friends[$k]['ali']=$rs['ali'];
			$friends[$k]['skype']=$rs['skype'];
			$friends[$k]['career']=$rs['career'];
			$friends[$k]['homepage']=$rs_1['homepage'];
			$friends[$k]['tname']=$rs_2['tname'];
			$friends[$k]['myname']=$rs_3['username'];
		}
		$data['friends']=$friends;		
		$data['friends_count']=$friends_count=$this->comm->findCount("friend",$condition);
		$data['total_page']=ceil($friends_count/$page_size);
		$this->load->library('pagination');		
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $friends_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/friend/friend_list',$data);
	}
	
	function edit_friend2(){
		$fid=intval($this->uri->rsegment(3,0));
		$friend=$this->comm->find("friend",array("fid"=>$fid));		
		$temp=$this->comm->find("member",array("username"=>$friend["username"]),"","company,email,mobile,qq,ali,skype,career");
		$temp=$temp?$temp:array('company'=>'','email'=>'','mobile'=>'','qq'=>'','ali'=>'','skype'=>'','career'=>'');
		$temp_1=$this->comm->find("company",array("username"=>$friend["username"]),"","telephone,homepage");
		$temp_1=$temp_1?$temp_1:array('telephone'=>'','homepage'=>'');
		$data['friend']=array_merge($friend,$temp,$temp_1);
		//dump($data['friend']);
		$this->load->view('member/friend/edit_friend',$data);
	}
	
	function save_fri(){	
		$fid=intval($this->input->post("fid",TRUE));	
		$post=$this->input->post("post",TRUE);
		if (strlen($post['truename'])>100){
			$msg="真实姓名的长度不能大于100个字节!";
			$data['msg']=$msg;
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$friend=array(				
				'truename'=>$post['truename']
				);
		$rs=$this->comm->update('friend',array('fid'=>$fid), $friend);
		$data['msg']=$rs?'修改成功':'修改失败，请重试';
		$this->load->view('public/success',$data);
	}
	
	function del_fri(){
		$fid=intval($this->uri->rsegment(3,0));
		$del_fid=array();
		if($fid){
			$del_fid=array($fid);
		}elseif ($_POST){
			$del_fid=$this->input->post('itemid',TRUE);
		}
		if ($del_fid){
			$c=0;
			foreach ($del_fid as $v){
				$findfri = $this->comm->findCount("friend",array("fid"=>$v));
				if ($findfri){
					$delfri = $this->comm->delete("friend",array("fid"=>$v));
					$c = $delfri ? $c+1 : $c;
				}else{
					$rs="没有找到此商友!";
				}
			}
			$rs=$c==count($del_fid)?"商友删除成功！":"商友删除失败，请重试!";
		}else{
			$rs="请选择商友";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function type_list2(){
		$data['page_size']=$page_size=20;
		$page = $this->uri->rsegment(3,0);
		$page = intval($page);
		$type=$this->comm->findAll("friend_type","","listorder asc","","{$page},{$page_size}");
		
		foreach ($type as $k=>$v){
			$type[$k]['friends_count']=$this->comm->findCount("friend",array("typeid"=>$v['tid']));
			$temp=$this->comm->find("member",array("userid"=>$v['userid']),"","username");
			$type[$k]['username']=$temp['username'];
		}
		$data['types']=$type;
		$data['type_count']=$type_count=$this->comm->findCount("friend_type");
		$data['total_page']=ceil($type_count/$page_size);
		$this->load->library('pagination');
		$base_url = site_url("member/friend/type_list2");
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $type_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('member/friend/type_list',$data);
	}
	
	function edit_type2(){
		$tid=intval($this->uri->rsegment(3,0));
		$data['type']=$type=$this->comm->find("friend_type",array("tid"=>$tid));
		dump($type);
		$this->load->view('member/friend/edit_type',$data);
	}
	
	function save_type(){
		$tid=intval($this->input->post("tid",TRUE));
		$post=$this->input->post("post",TRUE);
		if (strlen($post['tname'])>100){
			$data['msg']="类别名称的长度不能大于100个字节!";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$type=array(
				'tname'=>$post['tname'],
				'listorder'=>$post['listorder']
		);
		$rs=$this->comm->update('friend_type',array('tid'=>$tid), $type);
		$data['msg']=$rs?'修改成功':'修改失败，请重试';
		$this->load->view('public/success',$data);
	}
	
	function del_type(){
		$tid=intval($this->uri->rsegment(3,0));
		$del_tid=array();
		if($tid){
			$del_tid=array($tid);
		}elseif ($_POST){
			$del_tid=$this->input->post('itemid',TRUE);
		}
		if ($del_tid){
			$c=0;
			foreach ($del_tid as $v){
				$findtype = $this->comm->findCount("friend_type",array("tid"=>$v));
				if ($findtype){
					$temp=$this->comm->findCount("friend",array("typeid"=>$v));
					if ($temp){
						$data['msg']='此类别下有好友，不能删除！';
						$str=$this->load->view('public/success',$data,TRUE);
						echo $str;
						exit;
					}
					$deltype = $this->comm->delete("friend_type",array("tid"=>$v));
					$c = $deltype ? $c+1 : $c;
				}else{
					$rs="没有找到此类别!";
				}
			}
			$rs=$c==count($del_tid)?"类别删除成功！":"类别删除失败，请重试!";
		}else{
			$rs="请选择类别";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
}