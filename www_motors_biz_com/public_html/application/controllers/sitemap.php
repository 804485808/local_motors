<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitemap extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('comm_model','comm');
	}
	
	public function index(){
		$this->load->library('encrypt');
		$username = $this->input->cookie('username', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$data['username'] = $this->encrypt->decode($username,$hash_1);
		$this->load->service("url_service","urls");
		$current_url = $this->urls->curPageURL();	
		if($current_url){
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: ".$current_url);
			die();
		}
		$site = $this->config->item('site');
		$data['site'] = $site;
		$letter=array("0-9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$data['letter'] = $letter;
		
		$kwtable=$this->db->dbprefix("tagindex");
		$sql="SELECT t1.id,t1.tag,t1.linkurl";
		$sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
		$sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data['keywords'] = $query->result_array();
		}else {
			$data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
		}
		
		$page = $this->uri->rsegment(4,0);
		$page = intval($page);
		$pagesize=19*4;
		
		$byname = $this->uri->rsegment(3,'A');
		$byname = substr($byname,0,1);
		$condition="byname = '{$byname}'";
		if(!preg_match("/^[a-z]/is",$byname)){
			$byname = '0';
			$condition="byname in ('0','1','2','3','4','5','6','7','8','9')";
		}
		
		if(!in_array($byname,$letter) and $byname !== "0"){
			$byname = strtoupper($byname);
			header("HTTP/1.1 301 Moved Permanently"); 
			header("Location: ".site_url("sitemap/index/".$byname));
			die();
		}
		$totalcount=$this->comm->findCount("tagindex",$condition);
		if($page > $totalcount){
			show_404();
			die();
		}
		
		$data["byname"] = $byname;
		$tag=array();
		$tag = $this->comm->findAll("tagindex",$condition,"","id,tag,linkurl","{$page},{$pagesize}");
		$titletag = array();
		foreach($tag as $k => $v){
			if($k<3){
				$titletag[]= $v['tag'];
			}else{
				break;
			}
		}
		$tag_count=count($tag);
		if($tag_count > 1){
			$stitle=$tag[0]['tag']." - ".$tag[$tag_count-1]['tag'];
		}else{
			//$stitle=$tag[0]['tag'];
			$stitle = "";
		}
		$titletag=join(",",$titletag);
		$data['title'] = "Products Directory on ".$site['site_name']." for ".$titletag." &amp; More";
		$data['stitle'] = $stitle;
		$data['tagindex'] = $tag=$tag ? array_chunk($tag,ceil(count($tag)/4)) : $tag;
			
		$this->load->library('pagination');
		
		$base_url = site_url("/sitemap/index/".$byname."/");
		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $totalcount;
		$config['per_page'] = $pagesize;
		$config['uri_segment'] = 3;
		$config['num_links'] = 9;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['prev_link'] = ' <  Prev';
		$config['next_link'] = 'Next  > ';

		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		
		$page = ($page / $pagesize) + 1;
		$otherpages = '';
		$start = floor(($page-1)/10)*10;
		for($i=$start-50;$i<floor($page/10)*10;$i=$i+10){
			$min =  $i+1 ;
			$max =  $i+10;
			$tmp = $min."-".$max;
			$href = site_url("/sitemap/index/".$byname."/".$i*$pagesize);
			if($i>=0){
				$otherpages.= "<a href=\"".$href."\">".$tmp."</a>";
			}
		}
		
		for($i=$start;$i<floor($page/10)*10+50;$i=$i+10){
			$min =  $i+1 ;
			$max =  $i+10;
			$tmp = $min."-".$max;
			$href = site_url("/sitemap/index/".$byname."/".$i*$pagesize);
			if($page>=$min and $page <= $max){
				$otherpages.= "<span class=\"current\">".$tmp."</span>";
			}else{
				if($i<ceil($totalcount/$pagesize)){
					$otherpages.= "<a href=\"".$href."\">".$tmp."</a>";
				}
			}
			
		}
		$data['otherpages'] = $otherpages;	
		$data['country'] = array("China","India","Japan","Malaysia","Thailand","Turkey","USA","Vietnam");
		header('Content-Language:en');		
		$this->load->view('header',$data);	
		$this->load->view('sitemap');
		$this->load->view('footer');
		
	}

}