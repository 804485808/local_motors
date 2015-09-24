<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stats extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$info = array();
		$from=time();
		$to=$from-24*60*60;
		$toweek=$from-24*60*60*7;
		$info['mumn'] = $this->comm->findCount('member');
		$info['mumn_on'] = $this->comm->findCount('member',array('online'=>1));
		$info['mumn_t'] = $this->comm->findCount('member',"regtime > {$to} AND regtime < {$from}");
		$info['mumn_w'] = $this->comm->findCount('member',"regtime > {$toweek} AND regtime < {$from}");
		$info['comn'] = $this->comm->findCount('company');

		$info['selln'] = $this->comm->findCount('sell');
		$info['selln_t'] = $this->comm->findCount('sell',"addtime > {$to} AND addtime < {$from}");
		$info['selln_w'] = $this->comm->findCount('sell',"addtime > {$toweek} AND addtime < {$from}");
		$info['selln_f'] = $this->comm->findCount('sell',array('status'=>3));
		$info['selln_p'] = $this->comm->findCount('sell',array('status'=>1));
		
		$info['inqn'] = $this->comm->findCount('inquiry');
		$info['inqn_t'] = $this->comm->findCount('inquiry',"postdate > {$to} AND postdate < {$from}");
		$info['inqn_w'] = $this->comm->findCount('inquiry',"postdate > {$toweek} AND postdate < {$from}");
		$info['inqn_p'] = $this->comm->findCount('inquiry',array('status'=>0));
		
		$info['inqn_p'] = $this->comm->findCount('inquiry_notice',array('status'=>0));
		$info['arean'] =$this->comm->findCount('area');
		$str = "";
		foreach ($info as $k=>$v){
			if ($k === "arean"){
				$str .= $k."=>".$v;
			}else{
				$str .= $k."=>".$v."##";
			}
		}
		echo $str;
		
	}
	
}