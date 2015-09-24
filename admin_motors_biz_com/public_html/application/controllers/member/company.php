<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper("getstr");
		$this->load->helper("checkhtml");
	}
	
	function search(){
		$data['site'] = $this->config->item('site');
		$dfields = array('','company', 'username','regyear');
		$dorder  = array('','vip DESC', 'vip ASC','fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC', 'vip DESC', 'vip ASC','hits DESC', 'hits ASC');
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		if ($this->uri->rsegment(3,'')){
			$str_url = $this->uri->rsegment(3,'');
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$order,$timetype,$fromtime,$totime,$vip,$username,$uid,$psize) = $cond;
			if(preg_match("/BIZ/",$keyword)){
				$keyword = str_replace("BIZ","-",$keyword);
			}
			if(preg_match("/BIZ/",$username)){
				$username = str_replace("BIZ","-",$username);
			}
		}
		if ($this->input->post('action')){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$order = intval($this->input->post('order',TRUE));
			$timetype = $this->input->post('timetype',TRUE);
			$fromtime = strtotime($this->input->post('fromtime',TRUE).' 00:00:00');
			$totime = strtotime($this->input->post('totime',TRUE).' 23:59:59');
			$vip = intval($this->input->post('vip',TRUE));
			$username = strip_tags(trim($this->input->post('username',TRUE)));
			$uid = intval(strip_tags(trim($this->input->post('uid',TRUE))));
			$psize = intval(strip_tags(trim($this->input->post('psize',TRUE))));
		}
		$condition = "groupid > 1";
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($uid) $condition .= " AND userid={$uid}";
		if($username) $condition .= " AND username='{$username}'";
		if($vip) $condition .= " AND vip={$vip}";
		if($this->input->post('fromtime')) $condition .= " AND {$timetype}>{$fromtime}";
		if($this->input->post('totime')) $condition .= " AND {$timetype}<{$totime}";
		$order_by = $order ? $dorder[$order] : 'userid DESC';
		if($psize) $psizes = " {$page},{$psize}";
		$uri_segment = 5;
		$psize ? $page_size = $psize : $page_size = 20;
		$company = $this->comm->linker()->findAll('company',$condition,$order_by,'',$psizes);
		if (!$company){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		foreach ($company as $k => $v){
			$vip_list[$k]['action'] = 'company_list2';
			$rs = $this->comm->find('area',array('areaid'=>$v['areaid']),'','areaname,areaid');
			$rs ? $company[$k]['areaname'] = $rs['areaname'] : $company[$k]['areaname'] = '';
		}
		$data['mem_count'] = $mem_count=$this->comm->findCount('company',$condition);
		$data['company'] = $company;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		if(preg_match("/-/",$username)){
			$username = str_replace("-","BIZ",$username);
		}
		$base_url = site_url("member/company/search/".$fields.'-'.$keyword.'-'.$order.'-'.$timetype.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$vip.'-'.$username.'-'.$uid.'-'.$psize);
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $mem_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($mem_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$this->load->view('member/company/company_list',$data);
	}

	function company_list2(){
		$data['site'] = $this->config->item('site');
		$page = $this->uri->rsegment(3,0);
		$page = intval($page);
		$company = $this->comm->findAll('company','groupid > 1','userid desc','',"{$page},20");
		foreach ($company as $k => $v){
			$rs = $this->comm->find('area',array('areaid'=>$v['areaid']),'','areaname,areaid');
			$rs ? $company[$k]['areaname'] = $rs['areaname'] : $company[$k]['areaname'] = '';
		}
		$data['company'] = $company;
		$page_size = 20;
		$data['mem_count'] = $com_count=$this->comm->findCount("company");
		$this->load->library('pagination');
		$base_url = site_url("member/company/company_list2");
		$config['base_url'] = $base_url;
		$config['total_rows'] = $com_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($com_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$this->load->view('member/company/company_list',$data);
	}
	
	function check(){
		$action = $this->uri->rsegment(3,'');
		if ($action==="forbid"){
			$groupid = 2;
			$str = "禁止访问";
		}else if($action==="verify"){
			$groupid = 0;
			$str = "审核";
		}else if($action==="move"){
			$groupid = $this->input->post('groupid');
			$str = "移动";
		}else {
			$data['msg']="操作错误,请重试";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$p_userid = $this->input->post('userid',TRUE);
		if ($p_userid){
			foreach ($p_userid as $v){
				$res = $this->comm->find('member',array('userid'=>$v),'','userid,username');
				if ($res){
					$this->comm->update('member',array('userid'=>$v),array('groupid'=>$groupid));
					$this->comm->update('company',array('userid'=>$v),array('groupid'=>$groupid));
					$msg = "{$str}成功";
				}else {
					$msg = "查无此会员";
				}
			}
		}else {
			$msg = "请选择会员";
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	
	function del(){
		$p_userid = $this->input->post('userid',TRUE);
 		if ($p_userid){
			foreach ($p_userid as $v){
				$v = trim($v);
				$res = $this->comm->find('company',array('userid'=>$v),'','userid,username,groupid,thumb');
				if ($res){
					if ($res['groupid'] == 1){
						$data['msg'] = "管理员公司不能删除.<br /><a href='".site_url('my_menu/manager/manager_list')."'>如果需要删除管理员公司, 请点这里进入管理员管理...</a>";
						$url=$this->load->view('public/success',$data,TRUE);
						echo $url;
						die();
					}
					$userid[] = $res['userid'];
					$username[] = $res['username'];
					foreach ($username as $v){
						$result = $this->comm->find('sell',array('username'=>$v),'','itemid,username,thumb','');
						if ($result){
							$data['msg'] = "此公司有发布供应信息, 要先删除对应的供应信息!";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						$this->comm->delete('member',array('username'=>$v));
						$this->comm->delete('company',array('username'=>$v));
						$this->comm->delete('friend',array('username'=>$v));
						$this->comm->delete('message',"fromuser = {$v} or touser = {$v}");
						$this->comm->delete('inquiry',"fromuser = {$v} or touser = {$v}");
						if ($result['thumb']){unlink("E:/web/ci_b2b{$result['thumb']}");}
						if ($res['thumb']){unlink("E:/web/ci_b2b{$res['thumb']}");}
					}
					$msg = "删除成功";
				}else {
					$msg = "查无此公司";
				}
			}
		}else {
			$userid = trim($this->uri->rsegment(3,0));
			$userid = intval($userid);
			$username = trim($this->uri->rsegment(4,''));
			$res = $this->comm->find('company',array('userid'=>$userid,'username'=>$username),'','userid,username,thumb');
			if ($res){
				if ($res['groupid'] == 1){
					$data['msg'] = "管理员公司不能删除.<br /><a href='".site_url('my_menu/manager/manager_list')."'>如果需要删除管理员公司, 请点这里进入管理员管理...</a>";
					$url=$this->load->view('public/success',$data,TRUE);
					echo $url;
					die();
				}
				$result = $this->comm->find('sell',array('username'=>$username),'','itemid,username,thumb','');
				if ($result){
					$data['msg'] = "此公司有发布供应信息, 要先删除对应的供应信息!";
					$url=$this->load->view('public/success',$data,TRUE);
					echo $url;
					die();
				}
				$this->comm->delete('member',array('userid'=>$userid));
				$this->comm->delete('company',array('userid'=>$userid));
				$this->comm->delete('friend',array('userid'=>$userid));
				$this->comm->delete('message',"fromuser = {$username} or touser = {$v}");
				$this->comm->delete('inquiry',"fromuser = {$username} or touser = {$username}");
				if ($result['thumb']){unlink("E:/web/ci_b2b{$result['thumb']}");}
				if ($res['thumb']){unlink("E:/web/ci_b2b{$res['thumb']}");}
				$msg = "删除公司成功";
			}else {
				$msg = "查无此公司";
			}
		}
	
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}				
}