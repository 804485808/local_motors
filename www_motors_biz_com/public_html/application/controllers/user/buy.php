<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Buy extends CI_Controller {
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
		echo "Coming Soon...";
		die();
	}


	//需求管理--需求列表
	public function manage_buy(){
		$data['username']=$username = $this->username;		
		$site = $this->config->item('site');
		$data['title'] = "Require Management Of ".$username." On ".$site['site_name'];
		$this->load->view('user/header',$data);
		$this->load->view('user/manage_buy');
		$this->load->view('user/footer');
	}
	
	
	//发布需求
	public function post_buy(){
		$data['username']=$username = $this->username;		
		$site = $this->config->item('site');
		$data['title'] = "Post Require Of ".$username." On ".$site['site_name'];
		//start categies
		$this->load->driver('cache',array('adapter' => 'file'));
		//$this->cache->clean();
		if(!$cat1=$this->cache->get('cat1')){
			$cat1 = $this->comm->findAll("category",array("parentid"=>0),"letter asc");
			$this->cache->save('cat1', $cat1, 300);
		}
		if(!$cat2=$this->cache->get('cat2')){
			foreach($cat1 as $k => $v){
				$cat2[$v['catid']] = $this->comm->findAll("category",array("parentid"=>$v['catid']));
			}
			$this->cache->save('cat2', $cat2, 300);
		}
		if(!$cat3=$this->cache->get('cat3')){			
			foreach($cat2 as $k => $v){
				foreach($v as $x => $s){
					$cat3[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']));
				}
				$this->cache->save('cat3', $cat3, 300);
		
			}
		}
		
		if(!$cat4=$this->cache->get('cat4')){
			foreach($cat3 as $k => $v){
				foreach($v as $x => $s){
					$cat4[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']));
		
				}
			}
			$this->cache->save('cat4', $cat4, 300);
		}
		
		$data['cat1'] = $cat1;
		$data['cat2'] = $cat2;
		$data['cat3'] = $cat3;
		$data['cat4'] = $cat4;		
		//end categies
	
		if ($_POST){
			//dump($_POST);
		}		
		$this->load->view('user/header',$data);
		$this->load->view('user/post_buy');
		$this->load->view('user/footer');
	}

}