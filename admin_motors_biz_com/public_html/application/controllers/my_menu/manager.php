<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Manager extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	function manager_list(){
		$page = intval($this->uri->rsegment(3,0));
		$uri_segment = 4;
		$page_size = 20;
		$manager = $this->comm->findAll('member',array('admin'=>1,'groupid'=>1),'','',"{$page},{$page_size}");
		$data['man_count'] = $man_count=$this->comm->findCount("member",array('groupid'=>1,'admin'=>1));
		$base_url = site_url('my_menu/manager/manager_list');
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $man_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($man_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		
		foreach ($manager as $k=>$v){
			$r = $this->comm->find('area',array('areaid'=>$v['areaid']),'','areaname,areaid','');
			$manager[$k]['areaname'] = $r['areaname'];
		}
		$data['manager'] = $manager;
		
		$this->load->view('my_menu/manager/manager_list',$data);
	}
	

	function manager_add(){
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$this->load->view('my_menu/manager/manager_add',$data);
	}
	
	function save($action=''){
		
		//默认网站创始人 userid = 1;
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->lang->load('form_validation','chinese');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[30]|xss_clean');
		if ($this->form_validation->run() == FALSE){
			$data['msg'] = validation_errors();
			$url=$this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}else{
			$sql['username'] = $username = strip_tags(trim($this->input->post('username',TRUE)));
			$rs = $this->comm->find('member',array('username'=>$username),'','admin,userid','');
			$sql['admin'] = $admin = trim($this->input->post('admin',TRUE));
			if (!$rs){
				$data['msg']="会员不存在";
				$url = $this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			$userid = $rs['userid'];
			if ($userid == 1){
				$data['msg']="网站创始人不可改动";
				$url = $this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			if ($admin == $rs['admin'] && !$action == 'edit'){
				$admin == 1 ? $msg = "该会员已是超级管理员, 如果需要修改管理员<br /><a href='".site_url('my_menu/manager/manager_add')."'>请点这里进入管理员管理...</a>" : $msg = "该会员已是普通管理员, 可到管理员管理模块下修改";
				$data['msg']=$msg;
				$url = $this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			if ($admin == 2 || $action == 'edit'){
				$sql['aid'] = $aid = trim($this->input->post('aid',TRUE));
				//$sql['roles'] = $roles = $this->input->post('roles',TRUE);  无权限字段
			}
			if (!$action == 'edit'){
				$sql['groupid'] = 1;
			}
			$sql['role'] = strip_tags(trim($this->input->post('role',TRUE)));
			$res = $this->comm->update('member',array('userid'=>$userid),$sql);
			$res = $this->comm->update('company',array('userid'=>$userid),$sql);
			
			if ($res){
				$action == '' ? $msg = "添加管理员成功" : $msg = "修改管理员成功";
			}else {
				$action == '' ? $msg = "添加管理员失败" : $msg = "修改管理员失败";
			}
			
			$data['msg']=$msg;
			$this->load->view('public/success',$data);
		}
	}
	
	function manager_edit(){
		$userid = trim($this->uri->rsegment(3,0));
		if ($userid == 1){
			$data['msg']="网站创始人不可改动";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['user'] = $rs = $this->comm->find('member',array('userid'=>$userid),'','userid,groupid,admin,username','');
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$this->load->view('my_menu/manager/manager_edit',$data);
	}
	
	function del(){
		//--------------先查管理员有无登录--------------
		$userid = intval($this->uri->rsegment(3,0));
		if ($userid){
// 			if ($userid == 1){
// 				$data['msg']="网站创始人不可撤销";
// 				$url = $this->load->view('public/success',$data,TRUE);
// 				echo $url;
// 				die();
// 			}
			$rs = $this->comm->find('member',array('userid'=>$userid),'','groupid,userid,regid,admin','');
			$count_admin = $this->comm->findCount('member',array('admin'=>1,'groupid'=>1));
			if ($rs['admin'] == 1 && $count_admin < 3){
				$data['msg']="系统最少需要保留一位超级管理员";
				$url = $this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			$groupid = $rs['regid'] ? $rs['regid'] : 6;
			$res = $this->comm->update('member',array('userid'=>$userid),array('groupid'=>$groupid,'admin'=>0,'role'=>'','aid'=>0));
			$res = $this->comm->update('member',array('userid'=>$userid),array('groupid'=>$groupid));
			if ($res){
				$msg = "撤销管理员成功";
			}else {
				$msg = "撤销管理员失败";
			}
		}else {
			$msg = "会员不存在";
		}
		
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}

}