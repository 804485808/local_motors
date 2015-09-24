<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vip extends MY_Controller{	
	function __construct(){
		parent::__construct();
	}
	
	function search(){
		$dfields = array('','company', 'username');
		$dorder  = array('','fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC', 'vip DESC', 'vip ASC','userid DESC', 'userid ASC');
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		if ($this->uri->rsegment(3,'')){
			$str_url = $this->uri->rsegment(3,'');
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$order,$timetype,$fromtime,$totime,$username,$uid,$psize) = $cond;
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
		$nowtime = time();
		$condition = "groupid = 7 AND totime>{$nowtime}";
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
		$vip_list = $this->comm->linker()->findAll('company',$condition,$order_by,'',$psizes);
		if (!$vip_list){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['vip_count'] = $mem_count=$this->comm->findCount('company',$condition);
		$data['vip_list'] = $vip_list;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		if(preg_match("/-/",$username)){
			$username = str_replace("-","BIZ",$username);
		}
		$base_url = site_url("member/vip/search/".$fields.'-'.$keyword.'-'.$order.'-'.$timetype.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$vip.'-'.$username.'-'.$uid.'-'.$psize);
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
		$this->load->view('member/vip/vip_list',$data);
	}
	
	
	function vip_list2($action='vip_list2'){
		$page = $this->uri->rsegment(3,0);
		$page = intval($page);
		$nowtime = time();
		if ($action=='vip_expire2'){
			$result = $this->comm->findAll('company',"groupid=7 AND totime<{$nowtime}",'userid desc','',"{$page},20");
			$condition = "groupid = 7 AND totime<{$nowtime}";
		}else {
			$result = $this->comm->findAll('company',"groupid=7 AND totime>{$nowtime}",'userid desc','',"{$page},20");
			$condition = "groupid = 7 AND totime>{$nowtime}";
		}
		
		$data['vip_list'] = $result;
		$page_size = 20;
		$data['vip_count'] = $vip_count=$this->comm->findCount("company",$condition);
		$this->load->library('pagination');
		$base_url = site_url("member/vip/$action");
		$config['base_url'] = $base_url;
		$config['total_rows'] = $vip_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($vip_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$action=='vip_list2'?$this->load->view('member/vip/vip_list',$data):$this->load->view('member/vip/vip_expire',$data);
	}
	
	function vip_add2(){
		
		$userid = $this->input->post('userid',TRUE);
		if ($userid){
			$username = array();
			foreach ($userid as $v){
				$result = $this->comm->find('member',array('userid'=>trim($v)),'edittime DESC','userid,username');
				$username[]=$result['username'];
			}
			$username = implode("\r\n", $username);
			$data['username'] = $username;
		}else {
			$data['username'] = "";
		}
		$this->load->view('member/vip/vip_add',$data);
	}
	
	function save_vip(){
		
		$action = $this->uri->rsegment(3,'');
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($_POST){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('fromtime', '请选择服务有效期', 'required');
			$this->form_validation->set_rules('totime', '请选择服务有效期', 'required');
			if ($this->form_validation->run() == FALSE){
				$data['msg']="表单提交出错";
				$url=$this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}else{
				
				$username = strip_tags(trim($this->input->post('username',TRUE)));
				$sql['groupid']  = $groupid = intval($this->input->post('groupid',TRUE));
				$sql_com['groupid'] = $groupid; 
				$fromtime = $this->input->post('fromtime',TRUE);
				$sql_com['fromtime']  = strtotime($fromtime);
				$totime = $this->input->post('totime',TRUE);
				$sql_com['totime']  = strtotime($totime);
				$sql['vcompany']  = $this->input->post('vcompany',TRUE);
				$sql_com['authority']  = $this->input->post('authority',TRUE);
				$sql_com['vipt'] = $vipt = 1;
				
				if ($action==="edit"){
					$user_check = $this->comm->find('member',array('username'=>$username),'edittime DESC','userid');
					$userid = $user_check['userid'];
					if (!$user_check){
						$data['msg']="无此会员,请重新选择";
						$url=$this->load->view('public/success',$data,TRUE);
						echo $url;
						die();
					}
					$sql_com['vipr']  = $vipr = intval($this->input->post('vipr',TRUE));
					$sql_com['vip'] = $vipt+$vipr;
					$result = $this->comm->update('member',array('userid'=>$userid),$sql);
					$result1 = $this->comm->update('company',array('userid'=>$userid),$sql_com);
				}else {
					$sql_com['vip'] = 1;
					$username = explode("\r\n", $username);
					foreach ($username as $v){
						$user_check = $this->comm->find('member',array('username'=>trim($v)),'edittime DESC','userid');
						$userid = $user_check['userid'];
						if (!$user_check){
							$data['msg']="无此会员,请重新选择";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						
						$result = $this->comm->update('member',array('userid'=>$userid),$sql);
						$result1 = $this->comm->update('company',array('userid'=>$userid),$sql_com);
						
					}
				}
				if ($result && $result1){
					$msg = "保存信息成功";
				}else {
					$msg = "保存信息失败";
				}
				$data['msg']=$msg;
				$this->load->view('public/success',$data);
			}
		}
	}
	
	function vip_edit2(){
		
		$userid = intval($this->uri->rsegment(3,0));
		$result = $this->comm->find('member',array('userid'=>$userid),'edittime DESC','userid,username,groupid,vcompany');
		$result_1 = $this->comm->find('company',array('userid'=>$userid),'','userid,username,groupid,authority,vipr,fromtime,totime');
		$data['member'] = $result;
		$data['company'] = $result_1;
		$data['vip_detail'] = array_merge($result,$result_1);
		$this->load->view('member/vip/vip_edit',$data);
	}
	
	function repeal(){
		$userid = $this->input->post('userid',TRUE);
		if(!$userid){
			$data['msg']="请选择要操作的VIP会员";
			$url = $this->load->view('public/success',$data);
			echo $url;
			die();
		}else {
			
			foreach ($userid as $v){

				$user_check = $this->comm->find('member',array('userid'=>trim($v)),'edittime DESC','userid,regid');
				$regid = $user_check['regid'];
				if (!$user_check){
					$data['msg']="无此会员,请重新选择";
					$url=$this->load->view('public/success',$data,TRUE);
					echo $url;
					die();
				}
				$sql = array('groupid'=>$regid);
				$sql_com = array('groupid'=>$regid,'vip'=>0,'vipt'=>0,'vipr'=>0);
				$result = $this->comm->update('member',array('userid'=>$v),$sql);
				$result1 = $this->comm->update('company',array('userid'=>$v),$sql_com);
			}
			if ($result && $result1){
				$data['msg']="撤销选中VIP会员成功";
			}else {
				$data['msg']="撤销选中VIP会员失败";
			}
			$this->load->view('public/success',$data);
		}
	}
	
	//过期VIP

	function vip_expire2(){
		$action = 'vip_expire2';
		$this->vip_list2($action);
	}
	
	
	
	
	
	
	
	
	
	
	
}