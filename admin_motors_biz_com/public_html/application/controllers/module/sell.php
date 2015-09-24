<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sell extends MY_Controller{
	function __construct(){
		parent::__construct();
	}	

	//wl_sell.status:0->删除	1->待审核	2->审核未通过	 3->已发布  	4->审核通过	5->过期
	function search(){
		$this->load->service('pub_service','service');
		$tmp = '';
		$username = '';
		$data['class']=$data['type']='all';
		$data['site'] = $site = $this->config->item('site');
		$dfields = array('title','title', 'brand', 'unit', 'introduce', 'company', 'truename', 'telephone', 'address', 'email', 'username', 'ip');
		$dorder  = array('', 'edittime DESC', 'edittime ASC', 'addtime DESC', 'addtime ASC', 'vip DESC', 'vip ASC', 'price DESC', 'price ASC', 'amount DESC', 'amount ASC', 'minamount DESC', 'minamount ASC', 'hits DESC', 'hits ASC', 'itemid DESC', 'itemid ASC');
		if ($this->uri->rsegment(5,'')){
			$page = $this->uri->rsegment(5,0);
			$str_url = $this->uri->rsegment(4,'');
			$username = $this->uri->rsegment(3,'');
			$uri_segment = 6;
		}else {
			$page = $this->uri->rsegment(4,0);
			$str_url = $this->uri->rsegment(3,'');
			$uri_segment = 5;
		}
		if ($str_url){
			$cond = array();
			$cond = explode('-',$str_url);
			list($fields,$keyword,$level,$itemid,$order,$datetype,$fromdate,$todate,$minprice,$maxprice,$minamount,$maxamount,$minminamount,$maxminamount,$minvip,$maxvip,$thumb,$vip,$itemid,$psize) = $cond;
		}
		$page = intval($page);
		if ($_POST){
			$tmp = $this->input->post('action');
			$username = $this->input->post('username','');
		}
		if ($tmp){
			$fields = intval($this->input->post('fields',TRUE));
			$keyword = strip_tags(trim($this->input->post('kw',TRUE)));
			$level = $this->input->post('level',TRUE);
			$order = intval($this->input->post('order',TRUE));
			$datetype = $this->input->post('datetype',TRUE);
			$fromdate = strtotime($this->input->post('fromdate',TRUE).' 00:00:00');
			$todate = strtotime($this->input->post('todate',TRUE).' 23:59:59');
			$minprice = $this->input->post('minprice',TRUE);
			$maxprice = $this->input->post('maxprice',TRUE);
			$minamount = $this->input->post('minamount',TRUE);
			$maxamount = $this->input->post('maxamount',TRUE);
			$minminamount = $this->input->post('minamount',TRUE);
			$maxminamount = $this->input->post('maxamount',TRUE);
			$minvip = $this->input->post('minamount',TRUE);
			$maxvip = $this->input->post('maxamount',TRUE);
			$thumb = $this->input->post('thumb',TRUE);
			$vip = $this->input->post('vip',TRUE);
			$itemid = intval(strip_tags(trim($this->input->post('itemid',TRUE))));
			$psize = intval(strip_tags(trim($this->input->post('psize',TRUE))));
		}
		$username ? $condition = "username = '{$username}'" : $condition = '1';
		if ($keyword != '') $condition .= " AND {$dfields[$fields]} LIKE '%{$keyword}%'";
		if($level) $condition .= " AND level={$level}";
		if($thumb) $condition .= " AND thumb<>''";
		if($vip) $condition .= " AND vip>0";
		if($itemid) $condition .= " AND itemid='{$itemid}'";
		if($this->input->post('fromdate')) $condition .= " AND {$datetype}>{$fromdate}";
		if($this->input->post('todate')) $condition .= " AND {$datetype}<{$todate}";
		if($minprice)  $condition .= " AND price>=$minprice";
		if($maxprice)  $condition .= " AND price<=$maxprice";
		if($minamount)  $condition .= " AND amount>=$minamount";
		if($maxamount)  $condition .= " AND amount<=$maxamount";
		if($minminamount)  $condition .= " AND minamount>=$minminamount";
		if($maxminamount)  $condition .= " AND minamount<=$maxminamount";
		if($minvip)  $condition .= " AND vip>=$minvip";
		if($maxvip)  $condition .= " AND vip<=$maxvip";
		$order_by = $order ? $dorder[$order] : 'addtime desc';
		if($psize) $psizes = " {$page},{$psize}";
		$psize ? $page_size = $psize : $page_size = 20;
		$sell=$this->comm->findAll("sell",$condition,$order_by,"itemid,catid,level,title,unit,minprice,maxprice,currency,hits,thumb,username,adddate,linkurl","{$page},{$page_size}");

		if (!$sell){
			$data['msg']="搜索没有结果";
			$url = $this->load->view('public/success',$data,TRUE);
			echo $url;
			die();
		}
		foreach ($sell as $k=>$v){
			$cat=$this->comm->find('category',array('catid'=>$v['catid']),'','catid,catname,linkurl');
			$cat_tmp[0] = $cat;
			$cat = $this->service->all_linkurl($cat_tmp);
			$sell[$k]['catname'] =$cat[0]['catname'];
			$sell[$k]['all_linkurl'] =$cat[0]['all_linkurl'];
		}
		$data['sell']=$sell;
		$data['username'] = $username;
		$data['sell_count'] = $sell_count=$this->comm->findCount('sell',$condition);
		if ($username){
			$base_url = site_url("module/sell/search/".$username."/".$fields.'-'.$keyword.'-'.$level.'-'.$itemid.'-'.$order.'-'.$datetype.'-'.$this->input->post('fromdate').'-'.$minprice.'-'.$this->input->post('todate').'-'.$minprice.'-'.$maxprice.'-'.$minamount.'-'.$maxamount.'-'.$minminamount.'-'.$maxminamount.'-'.$minvip.'-'.$maxvip.'-'.$thumb.'-'.$vip.'-'.$itemid.'-'.$psize);
		}else {
			$base_url = site_url("module/sell/search/".$fields.'-'.$keyword.'-'.$level.'-'.$itemid.'-'.$order.'-'.$datetype.'-'.$this->input->post('fromdate').'-'.$minprice.'-'.$this->input->post('todate').'-'.$minprice.'-'.$maxprice.'-'.$minamount.'-'.$maxamount.'-'.$minminamount.'-'.$maxminamount.'-'.$minvip.'-'.$maxvip.'-'.$thumb.'-'.$vip.'-'.$itemid.'-'.$psize);
		}
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $sell_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 10;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$pages = $this->pagination->create_links();
		$data['pages'] = $pages;
		$data['total_page'] = ceil($sell_count/$page_size);
		$data['base_url'] = $base_url;
		$data['page_size'] = $page_size;
		if ($username){
			$this->load->view('member/member/view_sell',$data);
		}else {
			$this->load->view('module/sell/sell_list',$data);
		}
	}
	
	function edit_sell2(){
		$itemid = $this->uri->rsegment(3,0);
		$itemid = intval($itemid);
		if($itemid){
			$this->add_sell2($itemid);
		}else{
			show_error("Not found selling leads ");
		}
		
	}
	function save_sell(){
//        echo "<pre>";
//        print_r($_POST);die;
		$this->load->library('form_validation');
		$this->lang->load('form_validation', 'chinese');
		$this->form_validation->set_rules('post[title]', '产品标题', 'required|max_length[255]');
		$this->form_validation->set_rules('post[content]', '产品内容', 'required');
		$this->form_validation->set_rules('post[catid]', '所属分类ID', 'required|numeric');
		$this->form_validation->set_rules('post[minamount]', '最小起订量', 'required|numeric');
		$this->form_validation->set_rules('post[unit]', '产品单位', 'required');
		$this->form_validation->set_rules('post[minprice]', '最小产品价格', 'required|numeric');
		$this->form_validation->set_rules('post[minprice]', '最大产品价格', 'required|numeric');
		$this->form_validation->set_rules('post[currency]', '货币单位', 'required');
		if ($this->form_validation->run() == FALSE){
			$data['msg']=validation_errors();
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$post=$this->input->post("post",TRUE);		
		$sell=array(				
				'catid'=>$post['catid'],
				'typeid'=>$post['typeid'],
				'areaid'=>$post['areaid'],
				'level'=>$post['level'],
				'elite'=>$post['elite'],	
				'title'=>$post['title'],
				'style'=>$post['style'],
				'fee'=>$post['fee'],
				'introduce'=>substr(strip_tags($post['content']),0,255),
				'model'=>$post['model'],
				'standard'=>$post['standard'],
				'brand'=>$post['brand'],
				'unit'=>$post['unit'],
				'minprice'=>$post['minprice'],
				'maxprice'=>$post['maxprice'],
				'currency'=>$post['currency'],
				'minamount'=>$post['minamount'],
				'amount'=>$post['amount'],
				'days'=>$post['days'],
				//'keyword'=>$post['keyword'],
				'hits'=>$post['hits'],
				'thumb'=>$post['thumb'],
				'thumb1'=>$post['thumb1'],
				'thumb2'=>$post['thumb2'],
				'username'=>$post['username'],
				//'groupid'=>$post['groupid'],
				'company'=>$post['company'],
				//'vip'=>$post['vip'],
				//'validated'=>$post['validated'],
				'truename'=>$post['truename'],
				'telephone'=>$post['telephone'],
				'mobile'=>$post['mobile'],
				'address'=>$post['address'],
				'email'=>$post['email'],
				'ali'=>$post['ali'],
				'totime'=>$post['totime'],
				'edittime'=>time(),
				'editdate'=>date('Y-m-d'),
				'addtime'=>time($post['adddate']),
				'adddate'=>$post['adddate'],
				'ip'=>$this->input->ip_address(),
				'status'=>$post['status'],
				//'linkurl'=>$post['linkurl'],
				//'aliid'=>$post['aliid'],
				'sell_data'=>array('content'=>$post['content'])
				);


		if (isset($post['itemid'])){

			$sell['itemid']=$post['itemid'];			
			$rs=$this->comm->linker()->update('sell',array('itemid'=>$sell['itemid']), $sell);			
			$act_name="更新产品";
		}else{

            $this->load->model('sell_model','sell');
            $rs = $this->sell->addSell($post);

			$act_name="添加产品";
		}
		if ($rs){
			$msg=$act_name."成功";
		}else{
			$msg=$act_name."失败，请重试";
		}
		$data['msg']=$msg;
		$this->load->view('public/success',$data);
	}
	
		
	function add_sell2($itemid = 0){
		$data=$this->get_cat();
		$this->load->config("uploader_settings");
		$data['img_rootpath']=$this->config->item('img_rootpath');
		$data['title'] = 'Post selling leads ';
		$data['status']=$status=array(3=>'通过',1=>'待审',2=>'拒绝',5=>'过期',0=>'删除');
        $this->load->model('area_model','area');
        $data['areaname'] = $this->area->area_find_all();

        $this->load->model('member_model','member');
        $allMember = $this->member->getCompanyMember();
        $data['allMember'] = json_encode($allMember);

		if($itemid){
            $this->load->model("sell_model",'sell');
            $sell = $this->sell->sell_find($itemid);
			if(!$sell){
				show_error("Edit Error");
				die();
			}
            $this->load->model("category_model",'category');
            $thiscat = $this->category->category_find($sell['catid']);
			$sell['sell_data']['content'] = str_replace(array("<br>","<br/>"),"\n",$sell['sell_data']['content']);
			$data['sell'] = $sell;			
			$arrparentid=explode(",", $thiscat['arrparentid']);
			array_shift($arrparentid);
			$arrparentid[]=$sell['catid'];
			$data['arrparentid']=join(",", $arrparentid);
			if ($sell['pptword']){

				$op = $this->comm->findAll("category_option","oid in ({$sell['pptword']})","FIND_IN_SET(oid,'{$sell['pptword']}')");
				$op_value = $this->comm->findAll("category_value",array("itemid"=>$itemid),"FIND_IN_SET(oid,'{$sell['pptword']}')");
				foreach($op as $k => $v){
					$tmp[$v['oid']]['name'] = $v['name'];
					$tmp[$v['oid']]['value'] = $op_value[$k]['value'];
				}
				$option = $tmp;
				$data['option'] = $option;
			}else{
				$data['option'] = array(array('name'=>'','value'=>''));
			}
			$data['site'] = $site = $this->config->item('site');
			if ($sell['username']){
				$data['member']=$member=$this->comm->find('member',array('username'=>$sell['username']),'','qq,skype');
				$areaid=$this->comm->find('company',array('username'=>$sell['username']),'','areaid');
				$data['areaid']=$areaid['areaid'];
			}
			$this->load->view('module/sell/edit_sell',$data);
		}else{
			$this->load->view('module/sell/add_sell',$data);
		}
	}
	

	function cat_list2(){
		$data=$this->get_cat();
		$page = $this->uri->rsegment(3,0);
		$uri_segment = 4;
		$base_url = site_url("module/sell/".__FUNCTION__."/");
		$condition1=array();
		if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
			$pid = explode("-",$page);
			$pid = intval($pid[1]);
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
			$condition=array('parentid'=>$pid);
			$base_url = site_url("module/sell/".__FUNCTION__."/".$this->uri->rsegment(3,'')."/");
			if ($rs=$this->comm->find("category",array("catid"=>$pid),"","parentid,arrparentid")){
				$arrparentid=explode(",", $rs['arrparentid']);
				array_shift($arrparentid);
				$arrparentid[]=$pid;
				$data['parid']=$arrparentid[count($arrparentid)-1];
				$data['arrparentid']=join(",", $arrparentid);
			}
		}else {
			$condition=array('parentid'=>0);
		}
		$page = intval($page);
		$data['page_size']=$page_size=20;

		$top_cat = $this->comm->findAll("category",$condition,"listorder asc","","{$page},{$page_size}");
		$data['top_cat_count'] = count($top_cat);
		foreach ($top_cat as $k=>$v){
			$arrchildid=explode(',', $v['arrchildid']);
			array_shift($arrchildid);
			$top_cat[$k]['subcat_count']=count($arrchildid);
			$top_cat[$k]['attr_count']=$this->comm->findCount("category_option",array("catid"=>$v['catid']));
		}
		$this->load->service('pub_service','service');
		$data['top_cat'] = $this->service->all_linkurl($top_cat);
		$data['cat_count']=$cat_count=$this->comm->findCount("category",$condition);
		$data['total_page']=ceil($cat_count/$page_size);
		$this->load->library('pagination');
		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $cat_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
			
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		//$this->output->enable_profiler(TRUE);
		$this->load->view('module/sell/cat_list',$data);
	}
	
	function edit_cat(){
		$catid = $this->uri->rsegment(3,0);
		$catid = intval($catid);
		if($catid){
			$data=$this->get_cats();
			if ($rs=$this->comm->find("category",array("catid"=>$catid),"","parentid,arrparentid")){
				$arrparentid=explode(",", $rs['arrparentid']);
				array_shift($arrparentid);
				$data['parentid']=$rs['parentid'];
				$data['arrparentid']=join(",", $arrparentid);
			}
			$data['cat'] = $cat=$this->comm->find('category',array('catid'=>$catid));
			$this->load->view('module/sell/edit_cat',$data);
		}else{
			show_error("Not found category leads ");
		}
	}
	
	function add_cat2(){	
		$parentid = $this->uri->rsegment(3,0);	
		$data=$this->get_cats();
		if ($rs=$this->comm->find("category",array("catid"=>$parentid),"","parentid,arrparentid")){
			$arrparentid=explode(",", $rs['arrparentid']);
			array_shift($arrparentid);
			$arrparentid[]=$parentid;
			$data['parid']=$arrparentid[count($arrparentid)-1];
			$data['arrparentid']=join(",", $arrparentid);
		}

		$this->load->view('module/sell/add_cat',$data);
	}

    /**
     * 供应列表
     * @author:nice
     */
	function sell_list2(){
		$data=$this->lists('status = 3',__FUNCTION__,'');
		$data['class'] = "all";
		$this->load->view('module/sell/sell_list',$data);
	}

	function view_list(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists("status = 3 AND username = '{$username}'",__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class'] = "all";
		$this->load->view('member/member/view_sell',$data);
		
	}
	function view_list1(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists("status = 1 AND username = '{$username}'",__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class'] = "unapproved";
		$this->load->view('member/member/view_sell',$data);
	
	}
	function view_list2(){
		$nowtime=time();
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists("totime < {$nowtime} AND username = '{$username}'",__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class'] = "expire";
		$this->load->view('member/member/view_sell',$data);
	}
	function view_list3(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists("status = 2 AND username = '{$username}'",__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class'] = "rejected";
		$this->load->view('member/member/view_sell',$data);
	}
	function view_list4(){
		$username = $this->uri->rsegment(3,'');
		$data=$this->lists("status = 0 AND username = '{$username}'",__FUNCTION__,$username);
		$data['username'] = $username;
		$data['class'] = "trash";
		$this->load->view('member/member/view_sell',$data);
	}
	
	function unapproved_sell2(){
		$data=$this->lists(array('status'=>1),__FUNCTION__,'');
		$this->load->view('module/sell/unapproved_sell',$data);
	}

	function expire_sell2(){
		$nowtime=time();
		$data=$this->lists("totime < {$nowtime}",__FUNCTION__,'');
		$this->load->view('module/sell/expire_sell',$data);
	}
	
	function rejected_sell2(){
		$data=$this->lists(array('status'=>2),__FUNCTION__,'');
		$this->load->view('module/sell/rejected_sell',$data);
	}

	function trash2(){
		$data=$this->lists(array('status'=>0),__FUNCTION__,'');
		$this->load->view('module/sell/trash',$data);
	}

	function lists($condition="",$fun_name,$username){
		$this->load->service('pub_service','service');
		$data['site'] = $site = $this->config->item('site');
		if ($username){
			$page = $this->uri->rsegment(4,0);
			$uri_segment = 5;
		}else {
			$page = $this->uri->rsegment(3,0);
			$uri_segment = 4;
		}

		$page = intval($page);
		$data['page_size']=$page_size=20;
		$sell=$this->comm->findAll("sell",$condition,"addtime desc","itemid,catid,level,title,unit,minprice,maxprice,currency,hits,thumb,username,adddate,linkurl","{$page},{$page_size}");
		foreach ($sell as $k=>$v){
			$cat=$this->comm->find('category',array('catid'=>$v['catid']),'','catid,catname,linkurl');
			$cat_tmp[0] = $cat;
			$cat = $this->service->all_linkurl($cat_tmp);
			$sell[$k]['catname'] =$cat[0]['catname'];
			$sell[$k]['all_linkurl'] =$cat[0]['all_linkurl'];
		}
		$data['sell']=$sell;
		$data['type']='sell';
		$data['sell_count']=$sell_count=$this->comm->findCount("sell",$condition);
		$data['total_page']=ceil($sell_count/$page_size);
		$this->load->library('pagination');
		if ($username){
			$base_url = site_url("module/sell/".$fun_name."/$username/");
		}else {
			$base_url = site_url("module/sell/".$fun_name);
		}

		$data['base_url']=$config['base_url'] = $base_url;
		$config['total_rows'] = $sell_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();
		return $data;
	}
	
	
	function del_sell(){
		$act=$this->uri->rsegment(3,'');
		if ($act=='pack'){
			$del_itemid=$this->input->post('itemid',TRUE);
			$act_name='彻底删除';
		}elseif ($act=='delete'){
			$itemid = $this->uri->rsegment(4,0);
			$del_itemid=array(intval($itemid));
			$file = $this->uri->rsegment(5,'');
			$act = $file=='trash2' ? 'pack' : 'delete';
			$act_name='删除';
			$updata=array('status'=>0);
		}elseif ($act=='trash'){
			$del_itemid=$this->input->post('itemid',TRUE);
			$act_name='移到回收站';
			$updata=array('status'=>0);
		}elseif ($act=='restore'){
			$del_itemid=$this->input->post('itemid',TRUE);
			$act_name='还原';
			$updata=array('status'=>3);
		}elseif ($act=='clear'){
			$tempid=$this->comm->findAll("sell",array("status"=>0),"","itemid");			
			foreach ($tempid as $val){
				$del_itemid[]=$val['itemid'];
			}
			$act_name='清空';			
		}
		if (is_array($del_itemid) && $del_itemid!=array()){
			$c=0;
			foreach ($del_itemid as $v){
				$findsell = $this->comm->findCount("sell",array("itemid"=>$v));								
				if ($findsell){
					if ($act=='delete' || $act=='trash' || $act=='restore'){
						$delsell = $this->comm->update('sell',array("itemid"=>$v),$updata);						
					}elseif ($act=='pack' || $act=='clear'){					
						$delsell = $this->comm->delete("sell",array("itemid"=>$v));
						if($delsell){
							$catid=$this->comm->find("sell",array("itemid"=>$v),"","catid");
							$catid=$catid['catid'];
							$this->db->set("item","item-1",FALSE)->where("catid",$catid)->update("category");
							$this->comm->delete("category_value",array("itemid"=>$v));
							$this->comm->delete("sell_data",array("itemid"=>$v));
						}
					}
					$c = $delsell ? $c+1 : $c;					
				}else{
					$rs="没有找到此产品!";
					$data['msg']=$rs;
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				} 
			}
			if ($c==count($del_itemid)){
				$rs=$act_name."成功！";
			}else{
				$rs=$act_name."失败，请重试!";
			}
		}else{
			$rs="请选择供应产品";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
		
	}
	
	function modify_sell(){
		$this->load->library('form_validation');
		$this->lang->load('form_validation', 'chinese');
		$act = $this->uri->rsegment(3,'');
		$modify_sell=$this->input->post('itemid',TRUE);
		if ($act=='delay'){
			$this->form_validation->set_rules('days', '延期天数', 'required|is_natural_no_zero|greater_than[0]');
			if ($this->form_validation->run() == FALSE){
				$data['msg']=validation_errors();
				$str=$this->load->view('public/success',$data,TRUE);
				echo $str;
				exit;
			}
			$delay_days=$this->input->post('days',TRUE);
			$delay_time=intval($delay_days)*24*60*60;
			$update=array('totime'=>"totime+{$delay_time}");
			$act_name='延期';
		}elseif($act=='check'){
			$update=array('status'=>3);
			$act_name='通过审核';
		}elseif ($act=='reject'){
			$update=array('status'=>2);
			$act_name='拒绝';
		}elseif ($act=='set_status'){
			$status=intval($this->input->post('tid',TRUE));
			$update=array('status'=>$status);
			$act_name='设置状态';
		}elseif ($act=='set_level'){
			$level=intval($this->input->post('level',TRUE));
			$update=array('level'=>$level);
			$act_name='设置级别';
		}
		if (is_array($modify_sell) && $modify_sell!=array()){
			$c=0;
			foreach ($modify_sell as $v){
				$findsell = $this->comm->find("sell",array("itemid"=>$v));
				if ($findsell){
					/*
					if ($act=='check'){
						$groupid=$this->comm->find("member",array("username"=>$findsell['username']),"","groupid");
						if ($groupid['groupid']==4){
							$data['msg']="发布此产品的供应商还未通过审核，请先审核此会员";
							$str=$this->load->view('public/success',$data,TRUE);
							echo $str;
							exit;
						}
					}
					*/
					$delay_sell=$this->db->set($update,FALSE)->where("itemid",$v)->update("sell");
					if($delay_sell){
						$c++;
					}
				}else{
					$data['msg']="没有找到此产品!";
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}
			}
			if ($c==count($modify_sell)){
				$rs=$act_name."成功！";
			}else{
				$rs=$act_name."失败，请重试!";
			}
		}else{
			$rs="请选择供应产品";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);	
	}
	
	function move_cat2(){		
		$data=$this->get_cats();
		$itemid=$this->input->post('itemid',TRUE);
		$itemid=$itemid?$itemid:array();
		$data['itemid']=join(',', $itemid);
		$this->load->view('module/sell/move_cat',$data);
	}
	
	function move_sell_cat(){
		$itemid=$this->input->post('fromids',TRUE);		
		if($itemid){
			$catid=$this->input->post('catid',TRUE);
			if ($catid){
				$itemid=explode(',', $itemid);
				$c=0;
				foreach ($itemid as $v){
					$findsell = $this->comm->find("sell",array("itemid"=>$v));
					if ($findsell){
						$move_sell=$this->db->set(array('catid'=>$catid),FALSE)->where("itemid",$v)->update("sell");
						$this->db->set('item','item-1',FALSE)->where("catid",$findsell['catid'])->update("category");
						$c=$move_sell?$c+1:$c;
					}else{
						$data['msg']="没有找到此产品!";
						$str=$this->load->view('public/success',$data,TRUE);
						echo $str;
						exit;
					}
				}
				if ($c==count($itemid)){										
					$this->db->set("item","item+{$c}",FALSE)->where("catid",$catid)->update("category");
					$rs='产品类别移动成功';					
				}else{
					$rs='产品类别移动失败,请重试';
				}				
			}else{
				$rs='请先选择产品类别';
			}						
		}else{
			$rs='请先选择产品或者填写产品ID';
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function get_cats(){
		$this->load->driver('cache',array('adapter' => 'file'));
		//$this->cache->clean();
		if(!$cat1=$this->cache->get('cat1')){
			$cat1 = $this->comm->findAll("category",array("parentid"=>0),"letter asc");
			//$this->cache->save('cat1', $cat1, 60*60*24*30);
		}
		if(!$cat2=$this->cache->get('cat2')){
			foreach($cat1 as $k => $v){
				$cat2[$v['catid']] = $this->comm->findAll("category",array("parentid"=>$v['catid']));
			}
			//$this->cache->save('cat2', $cat2, 60*60*24*30);
		}
		if(!$cat3=$this->cache->get('cat3')){
			foreach($cat2 as $k => $v){
				foreach($v as $x => $s){
					$cat3[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']),"catid");
				}
			//	$this->cache->save('cat3', $cat3, 60*60*24*30);
			}
		}
//        print_r($cat3);
//        exit;
		if(!$cat4=$this->cache->get('cat4')){
			foreach($cat3 as $k => $v){
				foreach($v as $x => $s){
					$cat4[$s['catid']] = $this->comm->findAll("category",array("parentid"=>$s['catid']));

				}
			}
			//$this->cache->save('cat4', $cat4, 60*60*24*30);
		}

		$data['cat1'] = $cat1;
		$data['cat2'] = $cat2;
		$data['cat3'] = $cat3;
		$data['cat4'] = $cat4;
		return $data;
	}

    //重写分类查询
    function get_cat(){
        $this->load->driver('cache',array('adapter' => 'file'));
        //$this->cache->clean();
        if(!$cat1=$this->cache->get('cat1')){
            $cat1 = $this->comm->findAll("category",array("parentid"=>0),"letter asc");
            //$this->cache->save('cat1', $cat1, 60*60*24*30);
        }
        $data['cat1'] = $cat1;
        return $data;
    }

    //ajax分类查询
    function ajax_cats()
    {
        $catid=$this->input->post('catid',TRUE);
        $cat = $this->comm->findAll("category",array("parentid"=>$catid));
        $cat = json_encode($cat);
        echo $cat;
    }
	
	function check_sell_category(){
		$catid = $this->input->post("catid",TRUE);
		$catid = intval($catid);		
		$cat = $this->comm->find("category",array("catid"=>$catid));
		if(!$cat['child']){
			//表示最后一级分类
			echo "1";
		}else{
			echo "0";
		} 
	}

    /**
     * Sphinx品牌搜索
     */
    public function brand(){
        $brand_name = $this->input->post('brand_name');
        //搜索品牌
        $this->load->library('Sphinx','','sphinx');
        $res = $this->sphinx->getBrand($brand_name);

        $ids = '';
        foreach($res['matches'] as $k=>$v){
            $ids .= $v['id'].',';
        }

        if(!empty($ids)) {
            $ids = substr($ids, 0, -1);
            $this->load->model('brand_model', 'brand');
            $res = $this->brand->getBrandCommon('brandId,name', "brandId in ({$ids})");
            $re = array();
            foreach($res as $k=>$v){
                $re[$k]['name'] = $v['name'];
                $re[$k]['id'] = $v['brandId'];
            }
            echo json_encode($re);
        }else{
            echo '';
        }
    }

    /**
     * 查询分类下的Option
     */
    public function category(){

        $catid = $this->input->post('catid');
        $this->load->model('category_option_model','category_option');
        $res = $this->category_option->getCategoryOption($catid,"0,8");

        $this->load->model('area_model','area');
        $areaname = $this->area->area_find_all();

        foreach($res as $k=>$v){
            if(strtolower($v['name'])=='place of origin'){
                echo "<tr><td>".$v['name']."</td>";
                echo '<td><select name="post[option]['.$v["oid"].']"><option value="0">---Please Select---</option>'."\n";
                foreach($areaname as $a){
                    echo '<option  value="'.$a['areaid'].'" title="">'.$a['areaname'].'</option>'."\n";
                }
                echo "</select></td></tr>";
                unset($res[$k]);
            }
        }

        foreach($res as $k => $v){
            if($v['name']!='Brand Name') {
                echo '<tr><td>' . $v['name'] . '</td>';
                echo '<td><input name=post[option][' . $v["oid"] . '] value="" type="text" /></td></tr>';
            }
        }

    }

    /**
     * 查询会员详细信息
     */
    public function getMemberDetail(){

        $userid = $this->input->post('userid');
        $this->load->model('member_model','member');
        $re = $this->member->getMemberDetail($userid);
        echo json_encode($re);
    }

    /**
     * 获取会员自定义分类
     */
    public function getMemberType(){
        $userid = $this->input->post('userid');
        $this->load->model('type_model','type');
        $re = $this->type->getMemberType($userid);

        $str = "";
        foreach($re as $v){
            $str .= "<option value='".$v['tid']."'>".$v['tname']."</option>";
        }
        echo $str;
    }

	
}