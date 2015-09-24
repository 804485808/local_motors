<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attr_list extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('comm_model','comm');
	}

	public function index(){

		//error_reporting(E_ALL);
        $this->load->helper('inflector');
        $this->load->model('category_model','category');
        $this->load->model('category_default_option_model','categoryDO');
        $this->load->model('sell_model','sell');


		$data['username'] = $this->username;
		$site = $this->config->item("site");
		$data['site'] = $site;

		
		$catid = $this->uri->rsegment(3,0);
		$catid = intval($catid);

		$thiscat = $this->category->getCategoryCommon('catid,arrchildid,linkurl,catname,arrparentid',"catid={$catid}",'','',1);

		if(!$thiscat){
			show_404();
			die();
		}

		
		//Product Attributes
		$op = $this->uri->rsegment(4,0);

		if(strpos($op,"_")!==false){
			$tmp_option = explode("_",$op);
			foreach($tmp_option as $v){
				if(strpos($v,"-")!==false){
					$t = explode("-",$v);
					$vid[$t[0]] = $t[1];
				}
			}
		}else{
			if(strpos($op,"-")!==false){
				$t = explode("-",$op);
				$vid[$t[0]] = $t[1];
			}else{
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".site_url("sell_list/index/catid_".$catid."/".$thiscat['linkurl']));
				die();
			}
		}


		$data['vid'] = $vid;

		foreach($vid as $k => $v){
			$findov = $this->comm->find("category_option_value",array("id"=>$v));
			$searchword[] = $sublink[$k] = $findov['value'];
		}
		$data['sublink'] = $sublink;

		$searchword = implode(" ",$searchword);
		$data['searchword'] = $searchword;
		
		$this->load->library('Sphinxclient','','sphinx');
		$this->sphinx->SetServer ('127.0.0.1', 9312);
		$this->sphinx->SetConnectTimeout(1);
		$this->sphinx->SetArrayResult(true);
		$this->sphinx->SetMatchMode(SPH_MATCH_ALL);
		$this->sphinx->SetSortMode(SPH_SORT_EXTENDED,"@id ASC");
		$this->sphinx->SetLimits(0,1);
		$this->sphinx->SetFilter("catid",array($catid));

		$res = $this->sphinx->Query($searchword,"motors_attrtag");

		foreach($res['matches'] as $s){
			$attrid = $s['id'];
		}


		$find_attr = $this->comm->find("attrtag",array("id"=>$attrid));
		if($op != $find_attr['linkurl']){
			$link = "<link rel='canonical' href='".site_url("attr_list/index/".$catid."/".$find_attr['linkurl']."/".str_ireplace(" ","-",$find_attr['tag'])."-".$thiscat['linkurl'])."'/>\n";
		}else{
			$link = "<link rel='canonical' href='".site_url("attr_list/index/".$catid."/".$find_attr['linkurl']."/".str_ireplace(" ","-",$find_attr['tag'])."-".$thiscat['linkurl'])."'/>\n";
		}
		$data['link'] = $link;

		$find_option = $this->comm->findAll("category_option",array("catid"=>$catid,"required"=>1),"listorder asc");
		foreach($find_option as $k => $v){
			$op_value[$v['oid']] = $this->comm->findAll("category_option_value",array("oid"=>$v['oid']));
		}
		$data['option'] = $find_option;
		$data['op_value'] = $op_value;

		//end Product Attributes 
		
		
		
        //分页
        if(strstr($this->uri->rsegment(6,0),'_ps_')){
            $re = explode('_ps_',$this->uri->rsegment(5,0));
            $page_size = $re[1];
        }else {
            $page_size = 30;
        }
        $data['page_size'] = $page_size;
        $page = $this->uri->rsegment(6,0);
        $data['page'] = $page = intval($page);

     


	   $data['thisUrl1'] = str_replace('.html','',site_url("attr_list/index/".$catid."/".$find_attr['linkurl']."/".$thiscat['linkurl']));
	   $data['catid'] = $catid;
	   $data['thiscat'] = $thiscat;

		if($thiscat['arrchildid']){
			$data['pcat'] = $pcat = $this->comm->findAll("category","catid in({$thiscat['arrchildid']})");
			$spChild = explode(',',$thiscat['arrchildid']);
		}

		if(!$spChild){
			$spChild = array($catid);
		}


		//sphinx 属性 查询
		$this->load->library('Sphinx','sphinx');
		$res = $this->sphinx->getCategoryAttr(0,88,$spChild,$did1='');


		$attr = array();
		foreach($res[1]['matches'] as $k=>$v){
			$id = $v['attrs']['@groupby'];
			if($id) {
				$did_value = $this->comm->find("category_default_option",array("id"=>$id));
				$did_option = $this->comm->find("category_option",array("oid"=>$did_value['oid']));
				$attr[$did_option['name']][$k] = $did_value;
				$attr[$did_option['name']][$k]['cnum'] = $v['attrs']['@count'];
			}

		}


		//下级分类
		
		$subCategory = $this->comm->findAll("category",array("parentid"=>$catid),"item desc");
		$data['cateChild'] = $subCategory;

		//查询关键属性
		$attr1['Brand']=array();
		$attr1['Place Of Origin']=array();
		$attr1['Voltage']=array();
		$attr1['Power']=array();
		$i=0;
		foreach($attr as $k=>$v){

			//品牌
			if(strstr($k,'Brand')){
			  $attr1['Brand']=array_merge($attr1['Brand'],$v);
			}

			//产地
			if(strstr($k,'Place Of Origin')){
				$attr1['Place Of Origin']=array_merge($attr1['Place Of Origin'],$v);
			}

			//电压
			if(strstr($k,'Voltage')){
				$attr1['Voltage']=array_merge($attr1['Voltage'],$v);
			}

			//攻略
			if(strstr($k,'Power')){
				$attr1['Power']=array_merge($attr1['Power'],$v);
			}
			//根据量查询
			if($i<5){
				$attr1[$k]=$v;
			}
			$i++;
		}

		foreach($attr1 as $k=>$v){
			if(!$v){
				unset($attr1[$k]);
			}
		}

		$data['attr'] = $attr1;

		//sell
		$re = $this->sphinx->searchCategorySell($page,$page_size,$spChild,$searchword);
		if($re['total_found']==0){
			$googlebot = '<meta name="googlebot" content="noindex, nofollow" />'."\n";
			$data['googlebot'] = $googlebot;
		}
		$data['sell_count']=$re['total_found'];
		$sell_count=$re['total_found'];

        $country = file_get_contents('./skin/country.txt');
		$sellList = array();
		foreach($re['matches'] as $k=>$v){
            $citemid = '';
			$itemid = $v['id'];
			$re = $this->sell->getSellCompany($itemid,$country);
			$sellList[$itemid] = $re;

            //商家商品
            $userid = $v['attrs']['userid'];

            $cre = $this->sphinx->getCompanySell($searchword,$userid);


            if($cre['matches']){

                foreach($cre['matches'] as $kk=>$vv){
                    $citemid .= $vv['id'].",";
                }
                $citemid = substr($citemid,0,-1);

                $sellList[$itemid]['companySell']  = $this->sell->getSellCommon('itemid,thumb,title,subtitle,linkurl',"itemid in ({$citemid})");
            }

		}


		$data['sellList'] = $sellList;

		//分页
		$data['total_count']=$sell_count;
		$thislinkurl=$this->uri->rsegment(5,'');
		$base_url = site_url("attr_list/index/".$catid."/".$find_attr['linkurl']."/".$thislinkurl);
		$data['total_page']=ceil($sell_count/$page_size);
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $sell_count ? $sell_count : 0;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 5;
		$config['num_links'] = 4;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['first_link']='first';
		$config['last_link']='last';
		$config['anchor_class'] = "class='pro_page' rel='nofollow'";
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();



        //You like
        $re = $this->category->getCategoryCommon('parentid,catname',"catid = '{$catid}'",'','',1);
        $catname = $re['catname'];
        if($re['parentid']){
            $parentid = $re['parentid'];
        }else{
            $parentid = $catid;
        }

        $re = $this->category->getCategoryCommon('arrchildid',"catid = '{$parentid}'",'','',1);

        $sre = $this->sell->getSellCommonLink('t1.itemid,t1.title,t1.thumb,t1.minprice,t1.currency,t1.username,t1.unit,t1.minamount,t2.areaname,t1.linkurl',array('wl_sell'=>'t1'),
            array('Area'=>'t2'),"t1.catid in ({$re['arrchildid']})","t1.hits desc","","0,5");



        $data['mayLike'] = $sre;


        //keywords
        $re = $this->sphinx->getCategoryTag($catname);

        if(!empty($re['matches'])){
            foreach($re['matches'] as $jh){
                $kw1[] = $this->comm->find("tagindex",array("id"=>$jh['id']));
            }
        }

        //一级分类
        $re = $this->category->getCategoryCommon('catname,catid,linkurl','parentid=0','hits desc','0,30');
        $data['oneCategory'] = $re;
        $data['keywords'] = $kw1;
		$data['country'] = array("China","India","Japan","Malaysia","Thailand","Turkey","USA","Vietnam");

		$data['title'] = $searchword." ".$thiscat['catname']." Price, Suppliers, Manufacturers on ".$site['site_name'];
		
		
		//related searchs
		$tagids = array();
		$res = $this->sphinx->getTagindex($searchword.$thiscat['catname']);
		if(isset($res['matches'])){
			foreach($res['matches'] as $r){
				$tagids[] = $r['id'];
			}
			$tagids = implode(",",$tagids);
			$related_search = $this->comm->findAll("tagindex","id in({$tagids})");
			$data['related_search'] = $related_search;
		}


        $this->load->view('header1',$data);
		$this->load->view('attr_list_index');
		$this->load->view('footer');

		//$this->output->enable_profiler(TRUE);
	}

}