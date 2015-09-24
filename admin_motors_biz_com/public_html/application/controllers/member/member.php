<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends MY_Controller{	
	function __construct(){
		parent::__construct();
		$this->load->helper("getstr");
		$this->load->helper("checkhtml");
	}
	
	function search(){
		$data['site'] = $this->config->item('site');
		$dfields = array('','company', 'username', 'passport', 'truename', 'mobile', 'department', 'career', 'email', 'qq', 'msn', 'ali', 'skype', 'regip', 'loginip', 'inviter');
		$dorder  = array('','regtime DESC', 'regtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC','userid DESC', 'userid ASC');
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		if ($this->uri->rsegment(3,'')){
			$str_url = $this->uri->rsegment(3,'');
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$groupid,$gender,$areaid,$order,$timetype,$fromtime,$totime,$vmail,$vtruename,$vcompany,$username,$uid,$psize) = $cond;
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
			$groupid = intval($this->input->post('groupid',TRUE));
			$gender = intval($this->input->post('gender',TRUE));
			$areaid = intval($this->input->post('areaid',TRUE));
			$order = intval($this->input->post('order',TRUE));
			$timetype = $this->input->post('timetype',TRUE);
			$fromtime = strtotime($this->input->post('fromtime',TRUE).' 00:00:00');
			$totime = strtotime($this->input->post('totime',TRUE).' 23:59:59');
			$vmail = intval($this->input->post('vmail',TRUE));
			$vtruename = intval($this->input->post('vtruename',TRUE));
			$vcompany = intval($this->input->post('vcompany',TRUE));
			$username = strip_tags(trim($this->input->post('username',TRUE)));
			$uid = intval(strip_tags(trim($this->input->post('uid',TRUE))));
			$psize = intval(strip_tags(trim($this->input->post('psize',TRUE))));
		}
		$condition = 'groupid <> 4';
		if($areaid) $condition .= " AND areaid = {$areaid}";
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($gender != '') $condition .= " AND gender={$gender}";
		if($groupid) $condition .= " AND groupid={$groupid}";
		if($uid) $condition .= " AND userid={$uid}";
		if($username) $condition .= " AND username='{$username}'";
		if($vmail) $condition .= $vmail == 1 ? " AND vmail>0" : " AND vmail=0";
		if($vtruename) $condition .= $vtruename == 1 ? " AND vtruename>0" : " AND vtruename=0";
		if($vcompany) $condition .= $vcompany == 1 ? " AND vcompany>0" : " AND vcompany=0";
		if($this->input->post('fromtime')) $condition .= " AND {$timetype}>{$fromtime}";
		if($this->input->post('totime')) $condition .= " AND {$timetype}<{$totime}";
		$order_by = $order ? $dorder[$order] : 'userid DESC';
		if($psize) $psizes = " {$page},{$psize}";
		$uri_segment = 5;
		$psize ? $page_size = $psize : $page_size = 20;
		$member = $this->comm->linker()->findAll('member',$condition,$order_by,'',$psizes);
	
		if (!$member){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['mem_count'] = $mem_count=$this->comm->findCount('member',$condition);
		foreach ($member as $k=>$v){
			$rs = $this->comm->find('area',array('areaid'=>$v['areaid']),'','areaname,areaid');
			$rs ? $member[$k]['areaname'] = $rs['areaname'] : $member[$k]['areaname'] = '';
			$member[$k]['action'] = 'member_list2';
		}
		$data['member'] = $member;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		if(preg_match("/-/",$username)){
			$username = str_replace("-","BIZ",$username);
		}
		$base_url = site_url("member/member/search/".$fields.'-'.$keyword.'-'.$groupid.'-'.$gender.'-'.$areaid.'-'.$order.'-'.$timetype.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$vmail.'-'.$vtruename.'-'.$vcompany.'-'.$username.'-'.$uid.'-'.$psize);
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
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$this->load->view('member/member/member_list',$data);
	}
	
	/*	用户组:
	 0-会员组	1-管理员	2-禁止访问	3-游客
	4-待审核会员	5-个人会员	6-企业会员	7-VIP会员
	*/

	function member_list2($action=''){
		$data['site'] = $this->config->item('site');
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$page_size = 20;
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$groupid = explode("-",$page);
			$groupid = intval($groupid[1]);
			$uri_segment = 5;
			$condition = "groupid={$groupid} AND groupid <> 4"; 
		}else {
			$condition = "groupid <> 4";
		}
		$page = intval($page);
		if ($action=='member_check2'){
			$member = $this->comm->findAll('member',array('vmail'=>0),'userid desc','',"{$page},{$page_size}");
			$data['mem_count'] = $mem_count=$this->comm->findCount("member",array('vmail'=>0));
		}elseif ($action=='member_online2'){
			$member = $this->comm->findAll('member',"online=1 AND groupid <> 4",'userid desc','',"{$page},{$page_size}");
			$data['mem_count'] = $mem_count=$this->comm->findCount("member","online=1 AND groupid <> 4");
		}else {
			$action = __FUNCTION__;
			$member = $this->comm->linker()->findAll('member',$condition,'userid desc','',"{$page},{$page_size}");
			$data['mem_count'] = $mem_count=$this->comm->findCount("member",$condition);
		}
		foreach ($member as $k=>$v){
			
			$rs = $this->comm->find('area',array('areaid'=>$v['areaid']),'','areaname,areaid');
			$rs ? $member[$k]['areaname'] = $rs['areaname'] : $member[$k]['areaname'] = '';
			if ($v['groupid']==4){
				$member[$k]['action'] = 'member_check2';
			}else {
				$member[$k]['action'] = 'member_list2';
			}
		}
		$data['member'] = $member;
		if ($condition != "groupid <> 4"){
			$base_url = site_url("member/member/{$action}/".$this->uri->rsegment(3,0));
		}else {
			$base_url = site_url("member/member/{$action}");
		}
		
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
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		if ($action=='member_contact2'){
			$this->load->view('member/member/member_contact',$data);
		}elseif ($action=='member_check2'){
			$this->load->view('member/member/member_check',$data);
		}elseif ($action=='member_online2'){
			$this->load->view('member/member/member_online',$data);
		}else {
			$this->load->view('member/member/member_list',$data);
		}
		
		
	}
	
	function member_check2(){
		$action = "member_check2";
		$this->member_list2($action);
	}
	
	function check(){
		
		$action = $this->uri->rsegment(3,'');
		$forbid_userid = $this->uri->rsegment(4,'');
		if ($action == "forbid"){
			$groupid = 2;
		}else if($action == "move"){
			$groupid = $this->input->post('groupid');
			if ($groupid == 1){
				$data['msg'] = "管理员不能移动.<br/><a href='".site_url('my_menu/manager/manager_add')."'>如果需要添加管理员, 请点这里进入管理员管理...</a>";
				$url=$this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			if ($groupid == 7){
				$data['msg'] = "VIP会员不能移动.<br/><a href='".site_url('member/vip/vip_add2')."'>如果需要添加VIP会员, 请点这里进入VIP管理...</a>";
				$url=$this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
		}else {
			$data['msg']="操作错误,请重试";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		if ($forbid_userid){
			$p_userid = array(0=>$forbid_userid);
		}else {
			$p_userid = $this->input->post('userid',TRUE);
		}
		if ($p_userid){
			foreach ($p_userid as $v){
				$res = $this->comm->find('member',array('userid'=>$v),'','userid,username,groupid');
				if ($res){
					if($action == "verify"){
						$this->comm->update('member',array('userid'=>$v),array("vmail"=>1));
					}else{
						$this->comm->update('member',array('userid'=>$v),array('groupid'=>$groupid));
						$this->comm->update('company',array('userid'=>$v),array('groupid'=>$groupid));
					}											
					$msg = "操作成功";
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
		$this->config->load('uploader_settings', TRUE);
		$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
		$userid = $this->input->post('userid',TRUE);
		if ($userid){
// 			if ($userid == 1){
// 				$data['msg']="网站创始人不可删除";
// 				$url = $this->load->view('public/success',$data,TRUE);
// 				echo $url;
// 				die();
// 			}
			foreach ($userid as $v){
				$v = trim($v);
				$res = $this->comm->find('member',array('userid'=>$v),'','userid,username,groupid');
				if ($res){
					if ($res['groupid'] == 1){
						$data['msg'] = "管理员不能删除.<br /><a href='".site_url('my_menu/manager/manager_list')."'>如果需要删除管理员, 请点这里进入管理员管理...</a>";
						$url=$this->load->view('public/success',$data,TRUE);
						echo $url;
						die();
					}
					$userid[] = $res['userid'];
					$username[] = $res['username'];
					foreach ($username as $v){
						$result = $this->comm->find('sell',array('username'=>$v),'','itemid,username,thumb','');
						if ($result){
							$data['msg'] = "此会员有发布供应信息, 要先删除对应的供应信息!";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						$this->comm->delete('member',array('username'=>$v));
						$this->comm->delete('company',array('username'=>$v));
						if ($this->comm->findCount("friend",array('username'=>$v))){
							$this->comm->delete('friend',array('username'=>$v));
						}
						if ($this->comm->findCount("message",array('fromuser'=>$v))){
							$this->comm->delete('message',array('fromuser'=>$v));
						}
						if ($this->comm->findCount("message",array('touser'=>$v))){
							$this->comm->delete('message',array('touser'=>$v));
						}
						if ($this->comm->findCount("inquiry",array('fromuser'=>$v))){
							$this->comm->delete('inquiry',array('fromuser'=>$v));
						}
						if ($this->comm->findCount("inquiry",array('touser'=>$v))){
							$this->comm->delete('inquiry',array('touser'=>$v));
						}
					
						if ($result['thumb']){
							if (file_exists($result['thumb'])){
								unlink($img_rootpath.$result['thumb']);
							}
						}
						$rs = $this->comm->find('company',array('username'=>$v),'','thumb');
						if ($rs['thumb']){
							if (file_exists($result['thumb'])){
								unlink($img_rootpath.$rs['thumb']);
							}
						}
					}
					$msg = "删除成功";
				}else {
					$msg = "查无此会员";
				}
			}
		}else {
			$userid = trim($this->uri->rsegment(3,0));
			$userid = intval($userid);
			$username = trim($this->uri->rsegment(4,''));
			$res = $this->comm->find('member',array('userid'=>$userid,'username'=>$username),'','userid,username,groupid');
			if ($res){
				if ($res['groupid'] == 1){
					$data['msg'] = "管理员不能删除.<br /><a href='".site_url('my_menu/manager/manager_list')."'>如果需要删除管理员, 请点这里进入管理员管理...</a>";
					$url=$this->load->view('public/success',$data,TRUE);
					echo $url;
					die();
				}
				$result = $this->comm->find('sell',array('username'=>$username),'','itemid,username,thumb','');
				if ($result){
					$data['msg'] = "此会员有发布供应信息, 要先删除对应的供应信息!";
					$url=$this->load->view('public/success',$data,TRUE);
					echo $url;
					die();
				}
				$this->comm->delete('member',array('username'=>$username));
				$this->comm->delete('company',array('username'=>$username));
				if ($this->comm->findCount("friend",array('username'=>$username))){
					$this->comm->delete('friend',array('username'=>$username));
				}
				if ($this->comm->findCount("message",array('fromuser'=>$username))){
					$this->comm->delete('message',array('fromuser'=>$username));
				}
				if ($this->comm->findCount("message",array('touser'=>$username))){
					$this->comm->delete('message',array('touser'=>$username));
				}
				if ($this->comm->findCount("inquiry",array('fromuser'=>$username))){
					$this->comm->delete('inquiry',array('fromuser'=>$username));
				}
				if ($this->comm->findCount("inquiry",array('touser'=>$username))){
					$this->comm->delete('inquiry',array('touser'=>$username));
				}
				$this->comm->delete('member',array('username'=>$username));
				$this->comm->delete('company',array('username'=>$username));
			
				if ($result['thumb']){unlink($img_rootpath.$result['thumb']);}
				$rs = $this->comm->find('company',array('username'=>$username),'','thumb');
				if ($rs['thumb']){unlink($img_rootpath.$rs['thumb']);}
				$msg = "删除会员成功";
			}else {
				$msg = "查无此会员";
			}
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	

	function member_add2(){
		
		$this->load->config("uploader_settings");
		$data['img_rootpath']=$this->config->item('img_rootpath');
		$top_cates = $this->comm->findAll('category',array('parentid'=>0),'letter asc','','','0,20');
		$data['top_cates'] = $top_cates;
		foreach($top_cates as $k=>$v){
			$sub_cate[$v['catid']] = $this->comm->findAll("category",array("parentid"=>$v['catid']),"","","0,3");
		}
		$data['sub_cate'] = $sub_cate;
		
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$this->load->view('member/member/member_add',$data);
	}
	/*	用户组:
	 	0-会员组	1-管理员	2-禁止访问	3-游客
		4-待审核会员	5-个人会员	6-企业会员	7-VIP会员
	*/
	function save_m(){
		$action = $this->uri->rsegment(3,'');
 		$this->load->helper(array('form', 'url'));
 		$this->load->library('form_validation');
 		$this->lang->load('form_validation','chinese');
 		$this->form_validation->set_rules('username', '会员名称', 'trim|required|min_length[2]|max_length[30]|xss_clean');
 		$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|xss_clean');
 		$this->form_validation->set_rules('cpassword', '重复密码', 'trim|required|min_length[6]|xss_clean');
 		$this->form_validation->set_rules('truename', '真实姓名', 'trim|required|min_length[2]|max_length[30]|xss_clean');
 		$this->form_validation->set_rules('phone_1', '手机号码', 'trim|required|max_length[4]|xss_clean');
 		$this->form_validation->set_rules('phone_2', '手机号码', 'trim|required|max_length[11]|xss_clean');
 		$this->form_validation->set_rules('address', '公司地址', 'trim|required|min_length[2]|max_length[200]|xss_clean');
 		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|valid_email|xss_clean');
 		$this->form_validation->set_rules('mail', 'Email', 'trim|required|max_length[50]|valid_email|xss_clean');
 		$this->form_validation->set_rules('company', '公司名称', 'trim|required|max_length[150]|xss_clean');
 		$this->form_validation->set_rules('telephone_1', '公司电话', 'trim|required|max_length[4]|xss_clean');
 		$this->form_validation->set_rules('telephone_2', '公司电话', 'trim|required|max_length[5]|xss_clean');
 		$this->form_validation->set_rules('telephone_3', '公司电话', 'trim|required|max_length[8]|xss_clean');
 		if ($this->form_validation->run() == FALSE){
 			$data['msg'] = validation_errors();
 			$url=$this->load->view('public/success',$data,TRUE);
 			echo $url;
 			die();
 		}else{
 			//member
 			$username = strip_tags(trim($this->input->post('username',TRUE)));;
 			$tmp = $this->comm->find('member',array('username'=>$username),'edittime DESC','userid,regid');
 			$userid = $tmp['userid'];
 			if ($action == "edit"){
 				if (!$tmp){
 					$data['msg']="会员不存在,请重新选择";
 					$url=$this->load->view('public/success',$data,TRUE);
 					echo $url;
 					die();
 				}
 				$sql['regid'] = $tmp['regid'];	//注册用户组ID
 				$sql['groupid'] = $groupid = $this->input->post('groupid',TRUE);//  当前用户组ID
 				$groupid = 1 ? $sql['admin'] = 1 : $sql['admin'] = 0;
 				$sql['vcompany'] = $this->input->post('vcompany',TRUE);
 				$sql['mcompany']['authority'] = $this->input->post('authority',TRUE);
 				$sql['vmail'] = $this->input->post('vmail',TRUE);
 				$sql['vtruename'] = $this->input->post('vtruename',TRUE);
 				$sql['black'] = $this->input->post('black',TRUE);
 				$sql['inviter'] = $this->input->post('inviter',TRUE);
 				$sql['mcompany']['vtruename'] = $this->input->post('vtruename',TRUE);
 			}else {
 				if ($tmp){
 					$data['msg']="已存在此会员,请重新选择";
 					$url=$this->load->view('public/success',$data,TRUE);
 					echo $url;
 					die();
 				}
 				$sql['regid'] = $this->input->post('regid',TRUE);	//注册用户组ID
 				$sql['mcompany']['groupid'] = $sql['groupid'] = 4;//待审核会员  当前用户组ID
 			}
 			$sql['regip'] = $this->input->ip_address();
 			$sql['regtime'] = time();
 			$sql['edittime'] = time();
 			$sql['mcompany']['username'] = $sql['username'] = $username;
 			$sql['password'] = md5(trim($this->input->post('password',TRUE)));
 			$sql['cpassword'] = md5(trim($this->input->post('password',TRUE)));
 			$sql['company']  = $this->input->post('company',TRUE);
 			$sql['passport'] = $this->input->post('passport',TRUE);
 			$sql['email'] = $this->input->post('email',TRUE);
 			$sql['truename'] = $this->input->post('truename',TRUE);
 			$sql['gender'] = $this->input->post('gender',TRUE);
 			$sql['mcompany']['areaid'] = $sql['areaid'] = $this->input->post('areaid',TRUE);
 			$sql['department'] = $this->input->post('department',TRUE);
 			$sql['career'] = $this->input->post('career',TRUE);
 			$sql['zipcode'] = $this->input->post('zipcode',TRUE);
 			$phone_1 = $this->input->post('phone_1',TRUE);
 			$phone_1 = $phone_1?$phone_1:"086";
 			$phone_2 = $this->input->post('phone_2',TRUE);
 			if ($phone_2){
 				$sql['mobile'] = $mobile = $phone_1.'-'.$phone_2;
 			}else {
 				$sql['mobile'] = "";
 			}
 			$sql['qq'] = $this->input->post('qq',TRUE);
 			$sql['ali'] = $this->input->post('ali',TRUE);
 			$sql['skype'] = $this->input->post('skype',TRUE);
 			$sql['mcompany']['company'] = $this->input->post('company',TRUE);
 			$sql['mcompany']['ctype'] = $this->input->post('type',TRUE);
 			$sql['mcompany']['thumb'] = $thumb = $this->input->post('thumb',TRUE);
 			$sql['mcompany']['catid'] = $catid = 0;
 			$sql['mcompany']['business'] = $business = $this->input->post('business',TRUE);
 			$mode = $this->input->post('mode',TRUE);
 			if (count($mode)>2){
 				$mode = array_slice($mode,0,2,true);
 			}
 			$mode = implode($mode, ",");
 			$sql['mcompany']['mode'] = $mode?$mode:"";
 			$sql['mcompany']['size'] = $this->input->post('size',TRUE);
 			$sql['mcompany']['capital'] = $this->input->post('capital',TRUE);
 			$sql['mcompany']['regunit'] = $this->input->post('regunit',TRUE);
 			$sql['mcompany']['regyear'] = $this->input->post('regyear',TRUE);
 			$sql['mcompany']['address'] = $this->input->post('address',TRUE);
 			$sql['mcompany']['zipcode'] = $this->input->post('zipcode',TRUE);
 			$sql['mcompany']['capital'] = $this->input->post('capital',TRUE);
 			$sql['mcompany']['regyear'] = $this->input->post('regyear',TRUE);
 			$telephone_1 = $this->input->post('telephone_1',TRUE);
 			$telephone_1 = $telephone_1?$telephone_1:"086";
 			$telephone_2 = $this->input->post('telephone_2',TRUE);
 			$telephone_3 = $this->input->post('telephone_3',TRUE);
 			if ($telephone_1 && $telephone_2 && $telephone_3){
 				$sql['mcompany']['telephone'] = $telephone = $telephone_1.'-'.$telephone_2.'-'.$telephone_3;
 			}else {
 				$sql['mcompany']['telephone'] = $telephone = "";
 			}
 			$sql['mcompany']['fax'] = $this->input->post('fax',TRUE);
 			$sql['mcompany']['mail'] = $this->input->post('mail',TRUE);
 			$sql['mcompany']['homepage'] = $this->input->post('homepage',TRUE);
 			$sql['company_data']['content'] = $content = checkhtml($this->input->post('content',TRUE));
 			$sql['mcompany']['introduce'] = getstr($content,255,0,0,-1);
			
 			if ($action == "edit"){
 				$res = $this->comm->linker()->update('member',array('userid'=>$userid),$sql);
 				if ($res){
 					if ($groupid == 1){
 						$msg = "修改会员资料成功.<br/><a href='".site_url('my_menu/manager/manager_add')."'>如果需要添加管理员, 请点这里进入管理员管理...</a>";
 					}else if ($groupid == 7){
 						$msg = "修改会员资料成功.<br/><a href='".site_url('member/vip/vip_add2')."'>如果需要添加VIP会员, 请点这里进入VIP会员管理...</a>";
 					}else {
 						$msg = "修改会员资料成功.<br/><a href='".site_url('member/vip/vip_add2')."'>如果需要添加VIP会员,请点这里进入VIP会员管理...</a>";
 					}
 				}else {
 					$msg = "修改会员资料失败";
 				}
 			}else {
 				$res = $this->comm->linker()->create('member',$sql);
 				if ($res){
 					$msg = "添加会员资料成功";
 				}else {
 					$msg = "添加会员资料失败";
 				}	
 			}	
 			$data['msg']=$msg;
 			$this->load->view('public/success',$data);
  		}
	}
	
	function member_edit2(){
		$userid = intval($this->uri->rsegment(3,0));
		$result = $this->comm->linker()->find('member',array('userid'=>$userid),'edittime DESC','');
		$user = array();
		$company = array();
		$data['user'] = $user[] = $result;
		$data['company'] = $company[] = $result['mcompany'];
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');
		$data['areaid'] = $result['areaid'];
		$phone = $result['mobile'];
		$phone = explode("-", $phone);
		if (count($phone)==2){
			$data['phone_1'] = isset($phone[0])?$phone[0]:"086";
			$data['phone_2'] = $phone[1];
		}else {
			$data['phone_1'] = '';
			$data['phone_2'] = '';
		}
		$data['groupid'] = $result['groupid'];
		$data['ctype'] = $result['mcompany']['ctype'];
		$data['thumb'] = $result['mcompany']['thumb'];
		$data['mode'] = $mode = $result['mcompany']['mode'];
		$data['size'] = $result['mcompany']['size'];
		$data['regunit'] = $result['mcompany']['regunit'];
		$telephone = $result['mcompany']['telephone'];
		$telephone = explode("-", $telephone);
		if ($telephone[0]){
			$data['telephone_1'] = isset($telephone[0])?$telephone[0]:"086";
			$data['telephone_2'] = $telephone[1];
			$data['telephone_3'] = $telephone[2];
		}else {
			$data['telephone_1'] = '';
			$data['telephone_2'] = '';
			$data['telephone_3'] = '';
		}
		$content = $result['company_data']['content'];
		$data['content'] = checkhtml($content);
		$this->load->view('member/member/member_edit',$data);
	}
	
	function get_detail(){
		$data['site'] = $this->config->item('site');
		$username = trim($this->uri->rsegment(3,''));
		$result = $this->comm->linker()->find('member',array('username'=>$username));
		if (!$result){
			$data['msg']="会员不存在,请重新选择";
			$url=$this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$user = array();
		$company = array();
		$data['user'] = $user[] = $result;
		$data['company'] = $company[] = $result['mcompany']; 
		$data['sell_count'] = $this->comm->findCount('sell',array('username'=>$username));
		$data['inquiry_count'] = $this->comm->findCount('inquiry',array('fromuser'=>$username));
		$data['msg_count'] = $this->comm->findCount('message',array('touser'=>$username));
		$data['friend_count'] = $this->comm->findCount('friend',array('userid'=>$result['userid']));
		$this->load->view('member/member/member_show',$data);
	}
	

	function member_contact2(){		
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$page_size = 20;
		$member = $this->comm->linker()->findAll('member','','userid desc','',"{$page},{$page_size}");
		$data['member'] = $member;
		$data['mem_count'] = $mem_count=$this->comm->findCount("member");
		$base_url = site_url("member/member/member_contact2");
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
		$data['area'] = $area = $this->comm->findAll('area','','listorder DESC','areaid,areaname','');

		$this->load->view('member/member/member_contact',$data);
	}

	function member_online2(){
	
		$action = "member_online2";
		$this->member_list2($action);
	}

	//进入会员后台中心
	function login(){
		
		$this->load->helper('cookie');
		$userid = intval($this->uri->rsegment(3,0));
		$username = trim($this->uri->rsegment(4,''));
		$rs=$this->comm->find('member',array('userid'=>$userid,'username'=>$username),'','userid,username,password');
		if (!$rs){
			$data['msg']="无此会员,请重新选择";
			$url=$this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$site = $this->config->item('site');
		$this->load->library('encrypt');
		$hash_1 = $this->encrypt->sha1($username.time());
		$hash_2 = $this->encrypt->sha1($username.time());
		$username=$this->encrypt->encode($username,$hash_1);
		$password=$this->encrypt->encode($rs['password'],$hash_2);
		set_cookie('username',$username,3600,".{$site['site_url']}");
		set_cookie('password',$password,3600,".{$site['site_url']}");
		set_cookie('hash_1',$hash_1,3600,".{$site['site_url']}");
		set_cookie('hash_2',$hash_2,3600,".{$site['site_url']}");
		$data['msg'] = "授权成功, 正转入会员中心...<br /><a href='".site_main(site_url('user/user_main/index'))."'>如果浏览器没有反应,请点这里进入</a>";
		$url=$this->load->view('public/success',$data,TRUE);
		echo $url;
		die();
		
	}

    public function selectMember(){
        $this->load->model('member_model','member');
        $username = $this->input->post('username');

        if($username){
            $this->load->library('Sphinx','','sphinx');
            $res = $this->sphinx->getMember($username);

            $ids = '';
            foreach($res['matches'] as $k=>$v){
                $ids .= $v['id'].",";
            }
            $ids = substr($ids,0,-1);

            $re = $this->member->getMemberCommon('company,username,userid,email',"userid in ({$ids})",'','0,10');

            $str = '';
            foreach($re as $k=>$v){
                $str .= "
                <tr>
                <td>".$k."</td>
                <td>".$v['userid']."</td>
                <td>".$v['username']."</td>
                <td>".$v['company']."</td>
                <td>".$v['email']."</td>
                </tr>
                ";
            }

            echo $str;die;
        }


        $re = $this->member->getMemberCommon('company,username,userid,email','','','0,10');
        $data['user'] = $re;
        $this->load->view('member/member/selectMember',$data);
    }
	
}