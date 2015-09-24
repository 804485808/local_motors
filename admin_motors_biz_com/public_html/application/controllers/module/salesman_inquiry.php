<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salesman_inquiry extends MY_Controller{
	function __construct(){
		parent::__construct();
	}	

	//wl_inquiry_notice.status:-1->联系被拒	0->未联系		1=>已联系(有意向)			2=>已联系(无意向)		3=>已联系(意向不明)
	function inquiry_list(){			
		$data=$this->lists(array('username'=>$this->username),__FUNCTION__);
		$data['type']='all';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}

	function unfinished_list(){
		$condition=array("username"=>$this->username,"status"=>0);
		$data=$this->lists($condition,__FUNCTION__);
		$data['type']='unfinished';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}
	
	function finished_list1(){
		$condition=array("username"=>$this->username,"status"=>1);
		$data=$this->lists($condition,__FUNCTION__);
		$data['type']='finished1';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}
	
	function finished_list2(){
		$condition=array("username"=>$this->username,"status"=>2);
		$data=$this->lists($condition,__FUNCTION__);
		$data['type']='finished2';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}
	
	function finished_list3(){
		$condition=array("username"=>$this->username,"status"=>3);
		$data=$this->lists($condition,__FUNCTION__);
		$data['type']='finished3';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}
	
	function rejected_list(){
		$condition=array("username"=>$this->username,"status"=>-1);
		$data=$this->lists($condition,__FUNCTION__);
		$data['type']='rejected';
		$this->load->view('module/inquiry/salesman_inquiry_list',$data);
	}
	
	function lists($condition=array(),$fun_name){	
		$data['username']=$this->username;	
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("module/salesman_inquiry/".$fun_name);
		$page = intval($page);	
		$data['page_size']=$page_size=20;
		$inquiry_notice=$this->comm->findAll("inquiry_notice",$condition,"addtime desc","","{$page},{$page_size}");
		
		$status=array("-1"=>"联系被拒","0"=>"未联系","1"=>"已联系(有意向)","2"=>"已联系(无意向)","3"=>"已联系(意向不明)");
		foreach ($inquiry_notice as $k=>$v){
			$inquiry_notice[$k]['status']=$status[$v['status']];			
			$inquiry=$this->comm->find("inquiry",array("id"=>$v['id']));
			$inquiry=$inquiry?$inquiry:array('title'=>'','sid'=>0,'touser'=>'','postdate'=>0,'ip'=>'');
			$inquiry_notice[$k]['title']=$inquiry['title'];
			$inquiry_notice[$k]['itemid']=$inquiry['sid'];
			$inquiry_notice[$k]['seller']=$inquiry['touser'];
			$inquiry_notice[$k]['postdate']=$inquiry['postdate'];
			$rs=$this->db->query("select  *  from `wl_ip` where INET_ATON('{$inquiry['ip']}') between INET_ATON(startIp) and INET_ATON(endIp);");
			$rs=$rs->result_array();
			$inquiry_notice[$k]['ip']=$rs[0]['Country'];
			$item_url=$this->comm->find("sell",array("itemid"=>$inquiry['sid']),"","linkurl");
			$inquiry_notice[$k]['item_url']=$item_url?$item_url['linkurl']:'';
		}		
		$data['inquiry_notice']=$inquiry_notice;
		$data['notice_count']=$notice_count=$this->comm->findCount("inquiry_notice",$condition);
		$data['total_page']=ceil($notice_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $notice_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		//dump($this->db->queries);
		//dump($inquiry_notice);
		//exit;
		return $data;
	}
		
	function inquiry_show(){
		$data['type']=$type=$this->uri->rsegment(3,'all');
		$id=intval($this->uri->rsegment(4,0));
		$inquiry_detail=$this->comm->linker()->find('inquiry',array('id'=>$id));
		$rs=$this->db->query("select  *  from `wl_ip` where INET_ATON('{$inquiry_detail['ip']}') between INET_ATON(startIp) and INET_ATON(endIp);");
		$rs=$rs->result_array();
		$inquiry_detail['ip']=$rs[0]['Country'];
		$item_url=$this->comm->find("sell",array("itemid"=>$inquiry_detail['sid']),"","linkurl");
		$inquiry_detail['item_url']=$item_url?$item_url['linkurl']:'';
		$inquiry_notice=$this->comm->find("inquiry_notice",array("id"=>$id,"username"=>$this->username));
		$inquiry_detail['username']=$inquiry_notice?$inquiry_notice['username']:'';
		$inquiry_detail['addtime']=$inquiry_notice?$inquiry_notice['addtime']:'';
		$inquiry_detail['note']=$inquiry_notice?$inquiry_notice['note']:'';
		$inquiry_detail['sstatus']=$inquiry_notice?$inquiry_notice['status']:'';
		$data['inquiry_detail']=$inquiry_detail;
		$data['status']=$status=array("-1"=>"联系被拒","0"=>"未联系","1"=>"已联系(有意向)","2"=>"已联系(无意向)","3"=>"已联系(意向不明)");
		$this->load->view('module/inquiry/salesman_inq_show',$data);
	}
	
	function save_inotice(){
		$id=$this->input->post("iid",TRUE);
		$inotice=array(
				'addtime'=>time(),
				'note'=>$this->input->post('note',TRUE),
				'status'=>$this->input->post('status',TRUE)
				);
		$findnotice=$this->comm->find("inquiry_notice",array("id"=>$id,"username"=>$this->username));
		if ($findnotice){
			$rs=$this->comm->update("inquiry_notice",array("id"=>$id,"username"=>$this->username),$inotice);
			$msg=$rs?'保存成功':'保存失败，请重试';
		}else{
			$msg='非法操作';
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	
	function change_pwd(){
		$data['type']='changepwd';
		$this->load->view('module/inquiry/salesman_change_pwd',$data);
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
		$query=$this->comm->update("member",array("username"=>$this->username,"password"=>$this->password),array("password"=>md5($pwd)));
		$data['msg']=$query?"密码修改成功，请重新登录":"密码修改失败，请重试";
		$this->load->view('public/success',$data);
	}
}