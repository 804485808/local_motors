<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sell_list extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('comm_model','comm');
	}

	public function index(){

        $this->load->helper('inflector');
        $this->load->model('category_model','category');
        $this->load->model('category_default_option_model','categoryDO');
        $this->load->model('sell_model','sell');


		$data['username'] = $this->username;
		$this->load->service("url_service","urls");
		$current_url = $this->urls->curPageURL();
		if($current_url){
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$current_url);
			die();
		}
		$site = $this->config->item("site");
		$data['site'] = $site;

        //did
        $did = $this->uri->rsegment(4,0);
        if(preg_match("/_oid_(\d+)/",$did)){
           $re = explode("_oid_",$did);
            $did = array($re[1]);
        }else{
            $did = '';
        }

        //分页
        if(strstr($this->uri->rsegment(4,0),'_ps_')){
            $re = explode('_ps_',$this->uri->rsegment(4,0));
            $page_size = $re[1];
        }else {
            $page_size = 20;
        }
        $data['page_size'] = $page_size;
        $page = $this->uri->rsegment(5,0);
        $data['page'] = $page = intval($page);
		
		 //catid
		$catid_0 = $this->uri->rsegment(3,0);
		
		$catid = str_ireplace("catid_","",$catid_0);
		$thiscat = $this->category->getCategoryCommon('catid,arrchildid,linkurl,catname,arrparentid',"catid={$catid}",'','',1);

		if(!$thiscat){
			show_404();
			die();
		}
		
       

        if (preg_match("/^[a-zA-Z]{1,}_[0-9]{1,}$/isU",$catid_0)) {
            $tid = explode("_",$catid_0);
            $catid = intval($tid[1]);
            if(!$catid){
                show_404();
                die();
            }
            $re = $this->category->getCategoryCommon('arrchildid,linkurl,catname,arrparentid',"catid={$catid}",'','',1);

            $parentid = explode(',',$re['arrparentid']);
            if(!$parentid[1]){
                $parentid = $catid;
            }else {
                $parentid = $parentid[1];
            }

            $pre = $this->category->getCategoryCommon('catname,linkurl,catid',"catid={$parentid}",'','',1);
            //二级分类
            $data['parent'] = $pre;

            $data['thisUrl'] = $re['linkurl'];
            $data['thisUrl1'] = str_replace('.html','',site_url("sell_list/index/catid_".$catid."/".$re['linkurl']));
           $data['catid'] = $catid;
            $data['nowcat'] = $re;

            if($re['arrchildid']){

                $data['pcat'] = $pcat = $this->comm->findAll("category","catid in({$re['arrchildid']})");
                $spChild = explode(',',$re['arrchildid']);
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


            //分类
            $cateChild = array();
            foreach(array_slice($res[0]['matches'],0,15) as $k=>$v){
                $catidd = $v['attrs']['catid'];
                $cateChild[$catidd] = $this->category->getCategoryCommon('catname,catid,linkurl',"catid='{$catidd}'",'','',1);
                $cateChild[$catidd]['cnum'] = $v['attrs']['@count'];
            }

            $data['cateChild'] = $cateChild;

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
            $re = $this->sphinx->getCategorySell($page,$page_size,$spChild,$did);

            $data['sell_count']=$re['total_found'];
            $sell_count=$re['total_found'];

            $country = file_get_contents('./skin/country.txt');
            $sellList = array();
            foreach($re['matches'] as $k=>$v){
                $itemid = $v['id'];
                $re = $this->sell->getSellCompany($itemid,$country);
                $sellList[$itemid] = $re;
            }

            $data['sellList'] = $sellList;
            //Product price
            $re = $this->sell->getRandSell();
            $data['randSellPrice'] = $re;


            //host products
            $re = $this->sell->getSellCommon('itemid,subtitle,title,linkurl,username,thumb,catid',"catid = {$catid}",'','hits desc','0,6');

            $data['hostProduct'] = $re;


            //分页
            $data['total_count']=$sell_count;
            $thislinkurl=$this->uri->rsegment(4,'');
            $base_url = site_url("sell_list/".__FUNCTION__."/".$catid_0."/".$thislinkurl);
            $data['total_page']=ceil($sell_count/$page_size);
            $this->load->library('pagination');
            $config['base_url'] = $base_url;
            $config['total_rows'] = $sell_count ? $sell_count : 0;
            $config['per_page'] = $page_size;
            $config['uri_segment'] = 4;
            $config['num_links'] = 4;
            $config['suffix'] = $this->config->item('url_suffix');
            $config['first_link']='first';
            $config['last_link']='last';
            $config['anchor_class'] = "class='pro_page' rel='nofollow'";
//            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $data['pages'] = $pages = $this->pagination->create_links();


        }
		
		
		
		//related searchs
		$attrlink = $this->comm->findAll("attrtag",array("catid"=>$pre['catid']),"id asc","","0,10");
		foreach($attrlink as $k =>$v){
			$attrlink[$k]['tag'] = $v['tag']." ".$pre['catname'];
		}
	
		$data['attrlink'] = $attrlink;

        //You like
        $re = $this->category->getCategoryCommon('parentid,catname',"catid = '{$catid}'",'','',1);
        $catname = $re['catname'];
        if($re['parentid']){
            $parentid = $re['parentid'];
        }else{
            $parentid = $catid;
        }

        $re = $this->category->getCategoryCommon('arrchildid',"catid = '{$parentid}'",'','',1);

        $sre = $this->sell->getSellCommonLink('t1.itemid,t1.subtitle,t1.title,t1.thumb,t1.minprice,t1.currency,t1.username,t1.unit,t1.minamount,t2.areaname',array('wl_sell'=>'t1'),
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
		
		$thiscat = $this->comm->find("category",array("catid"=>$catid));

        $data['title'] = $thiscat['catname']." Price, Suppliers, Manufacturers on ".$site['site_name'];



		$this->load->view('header1',$data);
		$this->load->view('sell_list');
		$this->load->view('footer');


	}

}