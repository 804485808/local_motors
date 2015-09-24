<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Single_page extends MY_Controller{
	function __construct(){
		parent::__construct();
		define("ROOT_PATH", "E:/soft/wamp/www/b2b/application/views/webpage/");
	}

	function page_list(){
		$data['path']=ROOT_PATH;
		$data['page_size']=$page_size=20;
		$page = $this->uri->rsegment(3,0);
		$data['webpages']=$this->comm->findAll("webpage","","","itemid,level,title,style,edittime,listorder,hits,linkurl","{$page},{$page_size}");
		$data['pages_count']=$pages_count=$this->comm->findCount("webpage");
		$data['total_page']=ceil($pages_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = site_url("my_menu/single_page/page_list");
		$config['total_rows'] = $pages_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		$this->load->view('my_menu/single_page/page_list',$data);
	}
	
	function add_page(){
		//$data['path']=ROOT_PATH;
		$this->load->view('my_menu/single_page/add_page');
	}
	
	function edit_page(){
		$itemid=$this->uri->rsegment(3,0);
		$page=$this->comm->find("webpage",array("itemid"=>$itemid));
		if (!$page){
			$data['msg']='没有找到所需的单页';
			echo $this->load->view('public/success',$data,TRUE);
			exit;
		}
		$data['page']=$page;
		$this->load->view('my_menu/single_page/edit_page',$data);
	}
	
	function save_page(){
		$itemid=$this->input->post("itemid",TRUE);
		$webpage=$this->input->post("post",TRUE);
		if ($itemid){
			$rs=$this->comm->update("webpage",array("itemid"=>$itemid),$webpage);
			$data['msg']=$rs?'修改成功,请重新生成单页':'修改失败';
		}else{			
			$webpage['edittime']=time();
			$rs=$this->comm->create("webpage",$webpage);
			$data['msg']=$rs?'添加成功，请生成单页':'添加失败';
		}		
		$this->load->view('public/success',$data);
	}
	
	function modify_page(){
		$act=$this->uri->rsegment(3,'');
		if ($act=='uplist'){
			$listorder=$this->input->post('listorder',TRUE);
			$m=0;
			foreach ($listorder as $k=>$v){
				$rs=$this->comm->update("webpage",array("itemid"=>$k),array("listorder"=>$v));
				$m = $rs ? $m+1 : $m;
			}
			$msg = $m==count($listorder) ? "已成功更新排序" : "排序更新失败，请重试";
		}elseif ($act=='set_level'){
			$itemid=$this->input->post('itemid',TRUE);
			$level=$this->input->post('level',TRUE);
			if (!is_array($itemid)){
				$msg="请先选择单页";
			}else{
				$n=0;
				foreach ($itemid as $v){
					$rs=$this->comm->update("webpage",array("itemid"=>$v),array("level"=>$level));
					$n = $rs ? $n+1 : $n;
				}
				$msg = $n==count($itemid) ? "级别设置成功" : "级别设置失败，请重试";
			}
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	
	function create_page(){
		$pages=$this->comm->findAll("webpage");
		$c=0;
		foreach ($pages as $v){
			$str=$this->load->view("my_menu/single_page/wp_header","",TRUE);
			$str.="<br/><center><h2 style='color:".$v['style']."'>".$v['title']."</h2>";
			$str.="<br/>".$v['content']."</center>";
			$str.=$this->load->view("my_menu/single_page/wp_footer","",TRUE);
			file_put_contents(ROOT_PATH.$v['linkurl'], $str);
			$c++;
		}
		$data['msg'] = $c==count($pages) ? "已成功生成单页" : "单页生成失败";
		$this->load->view('public/success',$data);
	}
	
	function del_page(){
		$itemid=intval($this->uri->rsegment(3,0));
		$del_id=array();
		if($itemid){
			$del_id=array($itemid);
		}elseif ($_POST){
			$del_id=$this->input->post('itemid',TRUE);
		}
		if ($del_id){
			$c=0;
			foreach ($del_id as $v){
				$findpage = $this->comm->find("webpage",array("itemid"=>$v));
				if ($findpage){
					if (is_file($findpage['linkurl'])){
						unlink($findpage['linkurl']);
					}
					$delpage = $this->comm->delete("webpage",array("itemid"=>$v));
					$c = $delpage ? $c+1 : $c;				
				}else{
					$data['msg']="没有找到此单页!";
					echo $this->load->view('public/success',$data,TRUE);
					exit;
				}
			}
			$rs=$c==count($del_id)?"单页删除成功！":"单页删除失败，请重试!";
		}else{
			$rs="请选择单页";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}	
}