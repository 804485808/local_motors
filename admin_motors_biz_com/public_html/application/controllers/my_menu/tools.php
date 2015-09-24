<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Tools extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	

	function info_stats(){
		$stats=array();
		$stats['member_total']=$this->comm->findCount('member');
		$from=strtotime(date("Y-m-d"));
		$to=$from+24*60*60;
		$stats['member_add']=$this->comm->findCount('member',"regtime > {$from} AND regtime < {$to}");
		$stats['member_online']=$this->comm->findCount('member',array('online'=>1));
		$stats['company_total']=$this->comm->findCount('company');
		
		$stats['sell_total']=$this->comm->findCount('sell');
		$stats['sell_published']=$this->comm->findCount('sell',array('status'=>3));
		$stats['sell_unapproved']=$this->comm->findCount('sell',array('status'=>1));
		$stats['sell_add']=$this->comm->findCount('sell',"addtime > {$from} AND addtime < {$to}");
		
		$stats['inquiry_total']=$this->comm->findCount('inquiry');
		$stats['inquiry_unapproved']=$this->comm->findCount('inquiry',array('status'=>0));
		$stats['inquiry_unassigned']=$this->comm->findCount('inquiry_notice',array('username'=>''));
		$stats['inquiry_add']=$this->comm->findCount('inquiry',"postdate > {$from} AND postdate < {$to}");
		
		$stats['salesman_total']=$this->comm->findCount('member',array('groupid'=>5));
		$stats['inquiry_unnoticed']=$this->comm->findCount('inquiry_notice',array('status'=>0));
		$stats['inquiry_rejected']=$this->comm->findCount('inquiry_notice',array('status'=>-1));
		$stats['inquiry_finished1']=$this->comm->findCount('inquiry_notice',array('status'=>1));
		
		$stats['area_total']=$this->comm->findCount('area');
		$stats['manager_total']=$this->comm->findCount('member',array('groupid'=>1));
		
		$data['stats']=$stats;
		$this->load->view('my_menu/tools/info_stats',$data);
	}

	function banword(){
		$this->load->view('my_menu/tools/banword');
	}
	
	function banip(){
		$this->load->view('my_menu/tools/banip');
	}
	
}