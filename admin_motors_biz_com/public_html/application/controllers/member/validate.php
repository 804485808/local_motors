<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Validate extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	//wl_validate.status:0=>being reviewed(未认证),1=>approved(已认证),-1=>rejected(拒绝认证)
	//wl_member.vcompany:-1=>rejected,0=>unapproved,1=>approved
	
	function search(){
		$site = $this->config->item("site");
		$data['site'] = $site;
		$dfields = array('','username', 'editor');
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		if ($this->uri->rsegment(3,'')){
			$str_url = $this->uri->rsegment(3,'');
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$fromtime,$totime,$type,$status,$psize) = $cond;
			if(preg_match("/BIZ/",$keyword)){
				$keyword = str_replace("BIZ","-",$keyword);
			}
		}
		if ($this->input->post('action')){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$fromtime = strtotime($this->input->post('fromtime',TRUE).' 00:00:00');
			$totime = strtotime($this->input->post('totime',TRUE).' 23:59:59');
			$type = trim($this->input->post('type',TRUE));
			$status = $this->input->post('status',TRUE);
			$psize = intval(strip_tags(trim($this->input->post('psize',TRUE))));
		}
		$condition = "type = 'company'";
		if ($keyword && $fields) $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($this->input->post('fromtime')) $condition .= " AND addtime > {$fromtime}";
		if($this->input->post('totime')) $condition .= " AND addtime < {$totime}";
		if ($type) $condition .= " AND type = {$type}";
		if ($status != '') $condition .= " AND status = {$status}";
		if($psize) $psizes = " {$page},{$psize}";
		$uri_segment = 5;
		$psize ? $page_size = $psize : $page_size = 20;
		$validate = $this->comm->findAll('validate',$condition,'','',$psizes);
		if (!$validate){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['val_count'] = $val_count=$this->comm->findCount('validate',$condition);
		$data['validate'] = $validate;
		if(preg_match("/-/",$keyword)){
			$keyword = str_replace("-","BIZ",$keyword);
		}
		$base_url = site_url("member/validate/search/".$fields.'-'.$keyword.'-'.$this->input->post('fromtime').'-'.$this->input->post('totime').'-'.$type.'-'.$status.'-'.$psize);
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $val_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($val_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		$this->load->view('member/relevance/validate_list',$data);
	}

	function validate_list2(){
		$site = $this->config->item("site");
		$data['site'] = $site;
		$page = $this->uri->rsegment(3,0);
		$page = intval($page);
		$uri_segment = 4;
		$page_size = 20;
		$data['validate'] = $validate = $this->comm->findAll('validate',array('type'=>'company'),'','',"{$page},{$page_size}");
		$data['val_count'] = $val_count = $this->comm->findCount('validate',array('type'=>'company'));
		$base_url = site_url("member/validate/validate_list2");
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $val_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($val_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		
		$this->load->view('member/relevance/validate_list',$data);
	}
	//wl_validate.status:0=>being reviewed(未认证),1=>approved(已认证),-1=>rejected(拒绝认证)
	//wl_member.vcompany:-1=>rejected,0=>unapproved,1=>approved
	function validate_do(){
		$this->config->load('uploader_settings', TRUE);
		$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
		$Va = array('company'=>'公司认证', 'truename'=>'实名认证', 'mobile'=>'手机认证', 'mail'=>'邮件认证');//暂时只有公司验证
		$action = $this->uri->rsegment(3,'');
		if ($action){
			$reason = strip_tags(trim($this->input->post('reason',TRUE)));
			$sendmsg = intval(trim($this->input->post('msg',TRUE)));
			$reason = isset($reason) ? ($reason == '操作原因' ? '' : $reason) : '';
			$sendmsg = isset($sendmsg) ? 1 : 0;
			$itemid = $this->input->post('itemid',TRUE);
			if(!$itemid) {
				$data['msg'] = "请选择记录";
				$url=$this->load->view('public/success',$data,TRUE);
				echo $url;
				die();
			}
			switch ($action) {
				case 'check':
					$count = 0;
					foreach ($itemid as $v){
						$v = trim($v);
						$temp = $this->comm->find('validate',array('itemid'=>$v));
						if ($temp['status'] == 1){
							$data['msg'] = "所选记录已认证,请重新选择";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						$rs = $this->comm->find('validate',array('itemid'=>$v,'status'=>0));
						if ($rs){
							$value = $rs['title'];
							$username = $rs['username'];
							$type = $rs['type'];
							$vtype = 'v'.$rs['type'];
							$this->comm->update('member',array('username'=>$username),array($type=>$value,$vtype=>1));
							if ($type == 'company'){
								$result = $this->comm->update('company',array('username'=>$username),array('company'=>$value));
							}
							$this->comm->update('validate',array('itemid'=>$v),array('status'=>1,'editor'=>$this->username,'edittime'=>time()));
							if ($sendmsg){
								$content = $title = "Your ".$type." has been audited successfully certified";
								if ($reason) {$content .= '<br />'.$reason;}
								$sql = array('title'=>$title,'typeid'=>3,'content'=>$content,'fromuser'=>$this->username,'touser'=>$username,'addtime'=>time(),'ip'=>$this->input->ip_address(),'isread'=>0,'status'=>1);
								$this->comm->create('message',$sql);
							}
							$count++;
						}
					}
					$count > 0 ? $msg = $count."条".$Va[$type]."成功" : $msg = "认证失败";
				break;
				case 'reject':
					$count = 0;
					foreach ($itemid as $v){
						$v = trim($v);
						$temp = $this->comm->find('validate',array('itemid'=>$v));
						if ($temp['status'] == 1){
							$data['msg'] = "所选记录已认证,请重新选择";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						$rs = $this->comm->find('validate',array('itemid'=>$v,'status'=>0),'','');
						if ($rs){
							$username = $rs['username'];
							$type = $rs['type'];
							//删除认证图片
							if ($rs['thumb']) {unlink($img_rootpath.$rs['thumb']);}
							if ($rs['thumb1']) {unlink($img_rootpath.$rs['thumb1']);}
							if ($rs['thumb2']) {unlink($img_rootpath.$rs['thumb2']);}
							
							$this->comm->delete('validate',array('itemid'=>$v));
							if ($sendmsg){
								$content = $title = "Your ".$type." has not passed certification audit";
								if ($reason) {$content .= '<br />The reason of failure: '.$reason;}
								$sql = array('title'=>$title,'typeid'=>3,'content'=>$content,'fromuser'=>$this->username,'touser'=>$username,'addtime'=>time(),'ip'=>$this->input->ip_address(),'isread'=>0,'status'=>1);
								$this->comm->create('message',$sql);
							}
							$count++;
						}
					}
					$count > 0 ? $msg = "成功拒绝".$count."条".$Va[$type] : $msg = "拒绝认证失败";
				break;
				case 'cancel':
					$count = 0;
					foreach ($itemid as $v){
						$v = trim($v);
						$temp = $this->comm->find('validate',array('itemid'=>$v));
						if ($temp['status'] == 0){
							$data['msg'] = "所选记录还未认证,请重新选择";
							$url=$this->load->view('public/success',$data,TRUE);
							echo $url;
							die();
						}
						$rs = $this->comm->find('validate',array('itemid'=>$v,'status'=>1),'','');
						if ($rs){
							$value = $rs['title'];
							$username = $rs['username'];
							$type = $rs['type'];
							$vtype = 'v'.$rs['type'];
							//删除认证图片
							if ($rs['thumb']) {unlink($img_rootpath.$rs['thumb']);}
							if ($rs['thumb1']) {unlink($img_rootpath.$rs['thumb1']);}
							if ($rs['thumb2']) {unlink($img_rootpath.$rs['thumb2']);}
							
							$this->comm->update('member',array('username'=>$username),array($vtype=>0));
							$this->comm->delete('validate',array('itemid'=>$v));
							if ($sendmsg){
								$content = $title = "Your ".$type." certification has been canceled";
								if ($reason) {$content .= '<br />The reason of cancellation: '.$reason;}
								$sql = array('title'=>$title,'typeid'=>3,'content'=>$content,'fromuser'=>$this->username,'touser'=>$username,'addtime'=>time(),'ip'=>$this->input->ip_address(),'isread'=>0,'status'=>1);
								$this->comm->create('message',$sql);
							}
							$count++;
						}
					}
					$count > 0 ? $msg = $count."条".$Va[$type]."取消成功" : $msg = "取消认证失败";
					
				break;
				
				}
		}else {
			$data['msg'] = "请选择记录";
			$url=$this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		$data['msg'] = $msg;
		$this->load->view('public/success',$data);
	}	
}