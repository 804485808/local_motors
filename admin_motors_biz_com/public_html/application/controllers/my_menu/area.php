<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Area extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function area_list(){
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("my_menu/area/".__FUNCTION__."/");
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$pid = explode("-",$page);
			$pid = intval($pid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition=array('parentid'=>$pid);
			$base_url = site_url("my_menu/area/".__FUNCTION__."/".$this->uri->rsegment(3,'')."/");
		}else {
			$condition=array('parentid'=>0);
		}
		$page = intval($page);
		$data['page_size']=$page_size=20;
		
		$areas = $this->comm->findAll("area",$condition,"listorder asc","","{$page},{$page_size}");
		$data['cur_area_count'] = count($areas);
		foreach ($areas as $k=>$v){
			$arrchildid=explode(',', $v['arrchildid']);
			array_shift($arrchildid);
			$areas[$k]['subarea_count']=count($arrchildid);
		}
		$data['areas'] = $areas;
		$data['area_count']=$area_count=$this->comm->findCount("area",$condition);
		$data['total_page']=ceil($area_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $area_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('my_menu/area/area_list',$data);
	}
	
	function search_area(){
		$areaname=$this->input->post("kw",TRUE);		
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("my_menu/area/".__FUNCTION__."/".$areaname."/");
		if(preg_match("/^[a-zA-Z]{1,}$/isU",$page)){
			$areaname=$page;
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;			
			$base_url = site_url("my_menu/area/".__FUNCTION__."/".$this->uri->rsegment(3,'')."/");
		}
		if (!$areaname){
			redirect(site_url("my_menu/area/area_list"));
		}
		$condition="areaname like '%{$areaname}%'";
		$page = intval($page);
		$data['page_size']=$page_size=20;
		
		$areas = $this->comm->findAll("area",$condition,"listorder asc","","{$page},{$page_size}");
		$data['cur_area_count'] = count($areas);
		foreach ($areas as $k=>$v){
			$arrchildid=explode(',', $v['arrchildid']);
			array_shift($arrchildid);
			$areas[$k]['subarea_count']=count($arrchildid);
		}
		$data['areas'] = $areas;
		$data['area_count']=$area_count=$this->comm->findCount("area",$condition);
		$data['total_page']=ceil($area_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $area_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('my_menu/area/area_list',$data);
	}
	
		
	function add_area(){
		$data['parentid']=$parentid=$this->uri->rsegment(3,0);
		if ($parentid){
			$area=$this->comm->find("area",array("areaid"=>$parentid),"","areaname");
			$data['parentname']=$area['areaname'];
		}
		$this->load->view('my_menu/area/add_area',$data);
	}
		
	
	function update_area(){
		$area=$this->input->post("area",TRUE);
		if ($area && is_array($area)){
			$c=0;			
			foreach ($area as $k=>$v){
				$findarea=$this->comm->findCount("area",array("areaid"=>$k));
				if ($findarea){
					if ($this->comm->findCount("area",array("areaname"=>$v['areaname']))){
						$data['msg']="地区".$v['areaname']."已经存在";
						echo $this->load->view("public/success",$data,TRUE);
						exit;
					}else{
						$rs=$this->comm->update("area",array("areaid"=>$k),array("areaname"=>$v['areaname'],"listorder"=>$v['listorder']));
						$c=$rs?$c+1:$c;
					}					
				}else{
					$data['msg']="没有找到此地区";
					echo $this->load->view("public/success",$data,TRUE);
					exit;
				}				
			}
			$msg = $c==count($area) ? "更新成功" : "更新失败";
		}else{
			$msg="非法操作";
		}
		$data['msg']=$msg;
		$this->load->view("public/success",$data);
	}
		
	
	function save_area(){
		$area = $this->input->post("area",TRUE);
		if(empty($area['areaname'])){
			show_error("name can't empty");
		}
		$areaname=str_replace(array("\r\n", "\n", "\r"), "<br />", $area['areaname']);
		$areaname=explode("<br />",$areaname);
		$areaname=array_unique($areaname);
		
		$j=0;
		foreach ($areaname as $v){
			if ($this->comm->findCount("area",array("areaname"=>$v))){
				$data['msg']="地区".$v."已经存在";
				echo $this->load->view("public/success",$data,TRUE);
				exit;
			}
			$area['areaname']=$v;
			$rs=$this->comm->create("area",$area);
			$j = $rs ? $j+1 : $j;
			if ($area['parentid']){								
				$parent=$this->comm->find("area",array("areaid"=>$area['parentid']));
				if ($parent['child']==0){
					$this->comm->update("area",array("areaid"=>$area['parentid']),array("child"=>1,"arrchildid"=>$area['parentid'].",".$rs));
				}else{
					$this->comm->update("area",array("areaid"=>$area['parentid']),array("arrchildid"=>$parent['arrchildid'].",".$rs));
				}
				if (!$parent['arrparentid']){
					$this->comm->update("area",array("areaid"=>$rs),array("arrparentid"=>"0,".$parent['areaid']));
				}else{
					$arr=explode(",", $parent['arrparentid']);
					array_shift($arr);
					foreach ($arr as $v){
						$temp=$this->comm->find("area",array("areaid"=>$v));
						$temp=$temp['arrchildid'];
						$this->comm->update("area",array("areaid"=>$v),array("arrchildid"=>$temp.",".$rs));
					}
					$this->comm->update("area",array("areaid"=>$rs),array("arrparentid"=>$parent['arrparentid'].",".$parent['areaid']));
				}
				
			}
		}
		$msg = $j==count($areaname) ? "添加成功" : "添加失败，请重试";		
		$data['msg']=$msg;
		$this->load->view("public/success",$data);
	}
		
	
	function del_area(){
		$areaid=intval($this->uri->rsegment(3,0));
		$del_id=array();
		if($areaid){
			$del_id=array($areaid);
		}elseif ($_POST){
			$del_id=$this->input->post('areaids',TRUE);
		}
		if ($del_id){
			$c=0;
			foreach ($del_id as $v){
				$findarea = $this->comm->find("area",array("areaid"=>$v));
				if ($findarea){
					if ($findarea['child']){
						$data['msg']="此地区有子类，不能删除!";
						echo $this->load->view('public/success',$data,TRUE);
						exit;
					}
					if ($findarea['arrparentid']){
						$arr=explode(",", $findarea['arrparentid']);
						array_shift($arr);
						foreach ($arr as $val){
							$temp=$this->comm->find("area",array("areaid"=>$val),"","arrchildid");
							if(substr_count($temp['arrchildid'],',')>1){
								$n=strrpos($temp['arrchildid'], ",");
								$temp['arrchildid']=substr($temp['arrchildid'],0,$n);
								$this->comm->update("area",array("areaid"=>$val),array("arrchildid"=>$temp['arrchildid']));
							}else{
								$this->comm->update("area",array("areaid"=>$val),array("child"=>0,"arrchildid"=>""));
							}							
						}
					}
					$delarea = $this->comm->delete("area",array("areaid"=>$v));
					$c = $delarea ? $c+1 : $c;					
				}else{
					$data['msg']="没有找到此地区!";
					echo $this->load->view('public/success',$data,TRUE);
					exit;
				}
			}
			$rs=$c==count($del_id)?"地区删除成功！":"地区删除失败，请重试!";
		}else{
			$rs="请选择地区";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
}