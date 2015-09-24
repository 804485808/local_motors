<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inquiry extends MY_Controller{
	function __construct(){
		parent::__construct();
	}	
	//wl_inquiry.status:0->未审核		1->审核通过		2->审核未通过
	//$sstatus=array("-1"=>"联系被拒","0"=>"未联系","1"=>"已联系(有意向)","2"=>"已联系(无意向)","3"=>"已联系(意向不明)");
	function search(){
		$tmp = '';
		$username = '';
		$data['class']=$data['type']='all';
		$dfields = array('','title', 'fromuser', 'touser', 'sid');
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
		if ($str_url){
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$postdate,$status,$typeid) = $cond;
		}
		$page = intval($page);
		if ($_POST){
			$tmp = $this->input->post('action');
			$username = $this->input->post('username','');
		}
		if ($tmp){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$postdate = $this->input->post('postdate',TRUE);
			$minpostdate = strtotime($postdate.' 00:00:00');
			$maxpostdate = strtotime($postdate.' 23:59:59');
			$status = $this->input->post('status',TRUE);
			$typeid = $this->input->post('typeid',TRUE);
		}
		$username ? $condition = "fromuser = '{$username}'" : $condition = '1';
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($postdate) $condition .= " AND postdate>{$minpostdate} OR postdate<{$maxpostdate}";
		if ($status != '') $condition .= " AND status={$status}";
		$typeid !='' ? ($typeid ? $condition .= " AND pid>0" : $condition .= " AND pid=0") : '';
		$page_size = 20;
		$inquiry=$this->comm->findAll("inquiry",$condition,"postdate desc","id,title,touser,fromuser,company,telephone,mobile,email,sid,ip,postdate,status,pid","{$page},{$page_size}");
		if (!$inquiry){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		foreach ($inquiry as $k=>$v){
			$inquiry[$k]['re_count']=$this->comm->findCount("inquiry",array("pid"=>$v["id"]));
			$item_url=$this->comm->find("sell",array("itemid"=>$v['sid']),"","linkurl");
			$inquiry[$k]['item_url']=$item_url['linkurl'];
			$rs=$this->db->query("select  *  from `wl_ip` where INET_ATON('{$v['ip']}') between INET_ATON(startIp) and INET_ATON(endIp);");
			$rs=$rs->result_array();
			$inquiry[$k]['ip']=$rs[0]['Country'];
			$inotice=$this->comm->find("inquiry_notice",array("id"=>$v['id']));
			$inquiry[$k]['assign']='未分配';
			$inquiry[$k]['salesman']='';
			$inquiry[$k]['sstatus']=0;
			$inquiry[$k]['note']='';
			if ($inotice){
				if ($inotice['username']){
					$inquiry[$k]['assign']='已分配';
					$inquiry[$k]['salesman']=$inotice['username'];
					$inquiry[$k]['sstatus']=$inotice['status'];
					$inquiry[$k]['note']=$inotice['note'];
				}
			}
		}
		$data['inquiry']=$inquiry;
		$data['username'] = $username;
		$data['inquiry_count']=$inquiry_count=$this->comm->findCount("inquiry",$condition);
		if ($username){
			$base_url = site_url("module/inquiry/search/".$username.'/'.$fields.'-'.$keyword.'-'.strtotime($postdate).'-'.$status.'-'.$typeid);
		}else {
			$base_url = site_url("module/inquiry/search/".$fields.'-'.$keyword.'-'.strtotime($postdate).'-'.$status.'-'.$typeid);
		}
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $inquiry_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($inquiry_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		if ($username){
			$this->load->view('member/member/view_inquiry',$data);
		}else {
			$this->load->view('module/inquiry/inquiry_list',$data);
		}
	}
	
	function inquiry_list2(){	
		$data=$this->lists(array(''),__FUNCTION__,'');
		$data['class']=$data['type']='all';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function view_list(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists(array('fromuser'=>$username),__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class']=$data['type']='all';
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list1(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists(array('status'=>0,'fromuser'=>$username),__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class']=$data['type']='need';
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list2(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists(array('status'=>1,'fromuser'=>$username),__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class']=$data['type']='approved';
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list3(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists(array('status'=>2,'fromuser'=>$username),__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class']=$data['type']='unapproved';
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list4(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists_1("status = 0 AND username = '{$username}'",__FUNCTION__,$username);
		$data['type']='all';
		$data['class']='unfinished';
		$data['username'] = $username;
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list5(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists_1("status = -1 AND username = '{$username}'",__FUNCTION__,$username);
		$data['type']='all';
		$data['class']='rejected';
		$data['username'] = $username;
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list6(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists_1("status = 1 AND username = '{$username}'",__FUNCTION__,$username);
		$data['type']='all';
		$data['class']='finished1';
		$data['username'] = $username;
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list7(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists_1("status = 2 AND username = '{$username}'",__FUNCTION__,$username);
		$data['type']='all';
		$data['class']='finished2';
		$data['username'] = $username;
		$this->load->view('member/member/view_inquiry',$data);
	}
	function view_list8(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists_1("status = 3 AND username = '{$username}'",__FUNCTION__,$username);
		$data['type']='all';
		$data['class']='finished3';
		$data['username'] = $username;
		$this->load->view('member/member/view_inquiry',$data);
	}
	
	function unapproved_list2(){
		$condition=array("status"=>0);
		$data=$this->lists($condition,__FUNCTION__,'');
		$data['class']=$data['type']='need';
		$this->load->view('module/inquiry/inquiry_list',$data);	
	}
	
	function app_list2(){
		$condition=array("status"=>1);
		$data=$this->lists($condition,__FUNCTION__,'');
		$data['class']=$data['type']='approved';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function rejected_list2(){
		$condition=array("status"=>2);
		$data=$this->lists($condition,__FUNCTION__,'');
		$data['class']=$data['type']='unapproved';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function lists($condition=array(),$fun_name,$username){		
		if ($username){
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
		}else {
			$page = $this->uri->rsegment(3,0);
			$uri_segment = 4;
		}
		if ($username){
			$base_url = site_url("module/inquiry/".$fun_name."/$username/");
		}else {
			$base_url = site_url("module/inquiry/".$fun_name);
		}
		$condition1=array();
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$pid = explode("-",$page);
			$pid = intval($pid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition1=array('pid'=>$pid);
			$base_url = site_url("module/inquiry/".$fun_name."/".$this->uri->rsegment(3,'')."/");
		}else {
			$condition1=array('pid'=>0);
		}
		$page = intval($page);
		$condition=array_merge($condition,$condition1);			
		$data['page_size']=$page_size=20;
		$inquiry=$this->comm->findAll("inquiry",$condition,"postdate desc","id,title,touser,fromuser,company,telephone,mobile,email,sid,ip,postdate,status,pid","{$page},{$page_size}");
		//$sstatus=array("0"=>"未联系","1"=>"已联系(有意向)","-1"=>"联系被拒","2"=>"已联系(无意向)","3"=>"已联系(意向不明)");
		foreach ($inquiry as $k=>$v){
			$inquiry[$k]['re_count']=$this->comm->findCount("inquiry",array("pid"=>$v["id"]));
			$item_url=$this->comm->find("sell",array("itemid"=>$v['sid']),"","linkurl");
			$inquiry[$k]['item_url']=$item_url['linkurl'];
			$rs=$this->db->query("select  *  from `wl_ip` where INET_ATON('{$v['ip']}') between INET_ATON(startIp) and INET_ATON(endIp);");
			$rs=$rs->result_array();
			$inquiry[$k]['ip']=$rs[0]['Country'];
			$inotice=$this->comm->find("inquiry_notice",array("id"=>$v['id']));
			$inquiry[$k]['assign']='未分配';
			$inquiry[$k]['salesman']='';
			$inquiry[$k]['sstatus']=0;
			$inquiry[$k]['note']='';
			if ($inotice){
				if ($inotice['username']){
					$inquiry[$k]['assign']='已分配';
					$inquiry[$k]['salesman']=$inotice['username'];
					$inquiry[$k]['sstatus']=$inotice['status'];
					$inquiry[$k]['note']=$inotice['note'];
				}
			}
		}
		$data['inquiry']=$inquiry;
		$data['inquiry_count']=$inquiry_count=$this->comm->findCount("inquiry",$condition);
		$data['total_page']=ceil($inquiry_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $inquiry_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$data['salesman']=$this->comm->findAll("member",array("groupid"=>5),"","userid,username");
		return $data;
	}
	
	function inq_show2(){
		$data['class']=$this->uri->rsegment(3,'all');
		$id=intval($this->uri->rsegment(4,0));
		$inq_detail=$this->comm->linker()->find('inquiry',array('id'=>$id));		
		$inotice=$this->comm->find("inquiry_notice",array("id"=>$inq_detail['id']));
		$inotice=$inotice?$inotice:array("id"=>"","username"=>"","note"=>"","status"=>"");
		$inq_detail['assign']='未分配';
		$inq_detail['salesman']='';
		$inq_detail['sstatus']='';
		$inq_detail['note']='';
		if ($inotice['username']){
			$inq_detail['assign']='已分配';
			$inq_detail['salesman']=$inotice['username'];
			$inq_detail['sstatus']=$inotice['status'];
			$inq_detail['note']=$inotice['note'];
		}
		$data['inq_detail']=$inq_detail;
		$data['status']=$status=array("-1"=>"联系被拒","0"=>"未联系","1"=>"已联系(有意向)","2"=>"已联系(无意向)","3"=>"已联系(意向不明)");
		$data['salesman']=$this->comm->findAll("member",array("groupid"=>5),"","userid,username");
		$this->load->view('module/inquiry/inquiry_show',$data);
	}
		
	function del_inquiry(){
		$id=intval($this->uri->rsegment(3,0));
		$del_id=array();
		if($id){
			$del_id=array($id);
		}elseif ($_POST){
			$del_id=$this->input->post('itemid',TRUE);
		}
		if ($del_id){
			$c=0;
			foreach ($del_id as $v){
				$findinq = $this->comm->findCount("inquiry",array("id"=>$v));
				if ($findinq){
					if ($temp=$this->comm->findCount("inquiry",array("pid"=>$v))){
						$data['msg']="此询单下有回复，不能删除!";
						echo $this->load->view('public/success',$data,TRUE);
						exit;
					}else{
						$delinq = $this->comm->linker()->delete("inquiry",array("id"=>$v));
						$c = $delinq ? $c+1 : $c;
					}					
				}else{
					$data['msg']="没有找到此询单!";
					echo $this->load->view('public/success',$data,TRUE);
					exit;
				}
			}
			$rs=$c==count($del_id)?"询单删除成功！":"询单删除失败，请重试!";
		}else{
			$rs="请选择询单";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}	
	
	function approve_inquiry(){
		$act = $this->uri->rsegment(3,'');
		$id=$this->uri->rsegment(4,'');
		$app_id=array();
		if($id){
			$app_id=array($id);
		}elseif ($_POST){
			$app_id=$this->input->post('itemid',TRUE);
		}
		if ($app_id){
			if ($act=='check'){
				$update=array('status'=>1);
			}elseif($act=='reject'){
				$update=array('status'=>2);
			}else{
				exit('act errors');
			}
			$c=0;
			foreach ($app_id as $v){
				$findinq = $this->comm->findCount("inquiry",array("id"=>$v));
				if ($findinq){
				$app_inq=$this->db->set($update,FALSE)->where("id",$v)->update("inquiry");
				if ($app_inq){
					if ($act=='check'){
						$inq = $this->comm->linker()->find("inquiry",array("id"=>$v));
						$message=array(
								'title'=>$inq['title'],
								'typeid'=>2,
								'content'=>$inq['inquiry_data']['message'],
								'fromuser'=>$inq['fromuser'],
								'touser'=>$inq['touser'],
								'addtime'=>$inq['postdate'],
								'ip'=>$inq['ip'],
								'issend'=>1,
								'status'=>1,
								'iid'=>$inq['id']
								);
						$mid=$this->comm->create('message',$message);
						$c = $mid ? $c+1 : $c;
					}
				}
				}else{
					$data['msg']="没有找到此询单!";
					echo $this->load->view('public/success',$data,TRUE);
					exit;
				}
			}
			$rs=$c==count($app_id)?"询单审核成功！":"询单审核失败，请重试!";
		}else{
			$rs="请选择询单";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	
	function inquiry_clear2(){
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
			$condition="postdate > {$fromtime} AND postdate < {$totime}";
			$keep=$this->input->post("status",TRUE);
			if ($keep){
				$condition.=" AND status <> 0";
			}
			$del_id=$this->comm->findAll("inquiry",$condition,"","id");
			if ($del_id){
				$j=0;
				foreach ($del_id as $v){
					$rs=$this->comm->linker()->delete("inquiry",array("id"=>$v['id']));
					$j = $rs ? $j+1 : $j;
					$this->comm->delete("inquiry_notice",array("id"=>$v['id']));
				}
				$msg = $j==count($del_id) ? "询单清理成功" : "询单清理失败，请重试";
			}else{
				$msg="在此期间内没有您所要找的询单";
			}
			$data['msg'] = $msg;
			echo $this->load->view("public/success",$data,TRUE);
			exit;			
		}
		$data['class']='clear';
		$this->load->view('module/inquiry/inquiry_clear',$data);
	}
		
	function unassign_list(){		
		$condition=array("username"=>'');
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='unassign';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function unfinished_list(){	
		$condition="username <>'' AND status = 0";
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='unfinished';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function rejected_list(){	
		$condition="username <>'' AND status = -1";
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='rejected';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function finished_list1(){	
		$condition="username <>'' AND status = 1";
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='finished1';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function finished_list2(){
		$condition="username <>'' AND status = 2";
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='finished2';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function finished_list3(){
		$condition="username <>'' AND status = 3";
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='finished3';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function one_list(){
		$salesman=$this->uri->rsegment(3,'');
		$condition=array("username"=>$salesman);
		$data=$this->lists_1($condition,__FUNCTION__,'');
		$data['type']='all';
		$data['class']='all';
		$this->load->view('module/inquiry/inquiry_list',$data);
	}
	
	function lists_1($condition=array(),$fun_name,$username){
		if ($username){
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
		}else {
			$page = $this->uri->rsegment(3,0);
			$uri_segment = 4;
		}
		$base_url = site_url("module/inquiry/".$fun_name."/$username/");
		$page = intval($page);
		$data['page_size']=$page_size=20;

		$inotice=$this->comm->findAll("inquiry_notice",$condition,"","","{$page},{$page_size}");
		foreach ($inotice as $k=>$v){
			$inquiry[$k]=$temp=$this->comm->find("inquiry",array("id"=>$v['id']),"postdate desc","id,title,touser,fromuser,company,telephone,mobile,email,sid,ip,postdate,status,pid");	
			if (!$inquiry[$k])	{
				continue;
			}else{
				$rs=$this->db->query("select  *  from `wl_ip` where INET_ATON('{$temp['ip']}') between INET_ATON(startIp) and INET_ATON(endIp);");
				$rs=$rs->result_array();
				$inquiry[$k]['ip']=$rs[0]['Country'];
				$inquiry[$k]['re_count']=$this->comm->findCount("inquiry",array("pid"=>$v["id"]));
				$item_url=$this->comm->find("sell",array("itemid"=>$inquiry[$k]['sid']),"","linkurl");
				$inquiry[$k]['item_url']=$item_url['linkurl'];				
				$inquiry[$k]['assign']='未分配';
				$inquiry[$k]['salesman']='';
				$inquiry[$k]['sstatus']=0;
				$inquiry[$k]['note']='';
				if ($v){
					if ($v['username']){
						$inquiry[$k]['assign']='已分配';
						$inquiry[$k]['salesman']=$v['username'];
						$inquiry[$k]['sstatus']=$v['status'];
						$inquiry[$k]['note']=$v['note'];
					}
				}
			}		
		}
			
			
		$inquiry=isset($inquiry)?$inquiry:array();
		foreach ($inquiry as $k=>$v){
			if (!is_array($v)){
				unset($inquiry[$k]);
			}
		}
		$data['inquiry_count']=$inquiry_count=$this->comm->findCount("inquiry_notice",$condition);

		$data['inquiry']=$inquiry;
				
		$data['total_page']=ceil($inquiry_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $inquiry_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();		
		$data['salesman']=$this->comm->findAll("member",array("groupid"=>5),"","userid,username");
		return $data;
	}
	
	
	function assign(){		
		$salesman=$this->input->post('salesman',TRUE);
		$id=$this->input->post('itemid',TRUE);
		if (!$id){
			$rs="请选择询单";
		}else{
			$c=0;
			foreach ($id as $v){
				$findinq=$this->comm->find("inquiry",array("id"=>$v));
				if (!$findinq){
					$data['msg']="没有找到此询单!";
					echo $this->load->view('public/success',$data,TRUE);
					exit;
				}else{
					$result=$this->comm->find("inquiry_notice",array("id"=>$v));
					if (!$result){						
						$this->comm->create("inquiry_notice",array("id"=>$v,"username"=>$salesman,"note"=>""));
						$temp=$this->db->affected_rows();
					}elseif ($result['username']!=''){
						$data['msg']="询单号为".$v."的询单已分配给业务员!".$result['username'];
						echo $this->load->view('public/success',$data,TRUE);
						exit;
					}elseif ($result['status']==1){
						$data['msg']="此询单已通知供应商!";
						echo $str=$this->load->view('public/success',$data,TRUE);
						exit;
					}else{
						$temp=$this->comm->update("inquiry_notice",array("id"=>$v),array("username"=>$salesman));						
					}
					$c = $temp ? $c+1 : $c;				
				}
			}
			$rs=$c==count($id)?"询单分配成功！":"询单分配失败，请重试!";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);						
	}
	
	function auto_assign(){
		$salesman=$this->comm->findAll("member",array("groupid"=>5),"","userid,username");
		$unassign=$this->comm->findAll("inquiry_notice",array("username"=>''));
		if (!$unassign){
			$data['msg']='没有未分配的询单';
			echo $this->load->view('public/success',$data,TRUE);
			exit;
		}

		$i=count($salesman);
		$j=count($unassign);		
		$m=$n=0;
		foreach ($unassign as $v){
			$this->comm->update("inquiry_notice",array("id"=>$v['id']),array("username"=>$salesman[$n]['username']));
			if ($this->db->affected_rows())	{
				$m++;
			}else{
				$data['msg']='自动分配失败，请重试';
				echo $this->load->view('public/success',$data,TRUE);
				exit;
			}
			$n++;
			if ($n>=$i){
				$n=0;
			}
		}
		$data['msg'] = $m==$j?'自动分配成功':'自动分配失败，请重试';
		$this->load->view('public/success',$data);
	}
	
	
	
	
	function save_notice(){
		$id=$this->input->post("itemid",TRUE);
		$id=$id[0];
		$inotice=array(
				'note'=>$this->input->post('note',TRUE),
				'status'=>$this->input->post('status',TRUE)
		);
		$findinquiry=$this->comm->find("inquiry",array("id"=>$id));
		if ($findinquiry){
			$rs=$this->comm->update("inquiry_notice",array("id"=>$id),$inotice);
			$msg=$rs?'保存成功':'保存失败，请重试';
		}else{
			$msg='没有找到此询单';
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	
}