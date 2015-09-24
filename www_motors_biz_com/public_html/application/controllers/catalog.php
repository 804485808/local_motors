<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalog extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('comm_model','comm');
        $this->load->model('tagindex_model','tagindex');
	}
	
	public function index(){
        $data['url'] = "index";
		$site = $this->config->item("site");
		$data['site'] = $site;
		$catid = $this->uri->rsegment(3,0);
		$linkurl = $this->uri->rsegment(4,0);
		$catid = intval($catid);
		$thiscat = $this->comm->find("category",array("catid"=>$catid));
        $data['thiscat'] =  $thiscat;
		if(!$thiscat){
			show_404();
			die();
		}else{
			if($linkurl!==$thiscat['linkurl']){
				header("HTTP/1.1 301 Moved Permanently"); 
				header("Location: ".site_url("catalog/".__FUNCTION__."/".$thiscat['catid']."/".$thiscat['linkurl']));
				die();
			}
		}
        $this->load->library('Sphinx','sphinx');
        //关键词封装
        $re_tagindex = $this->tagindex->getRoundTagindex();

        $data['keywords'] = $re_tagindex;
		$data['title'] = $thiscat['catname']." Price, Information, Exhibitions, Suppliers, Buyers, Manufacturers on ".$site['site_name'];
        //点击量
		$this->db->set("hits","hits+1",FALSE);
		$this->db->where("catid",$thiscat['catid']);
		$this->db->update("category");

        //分类
		$second_cat=$this->comm->findAll("category","parentid = {$thiscat['catid']} AND item <> 0","hits desc,letter asc","","0,20");
		$third_cat=array();
		foreach($second_cat as $s=>$z){
			$third_cat[$s]=$this->comm->findAll("category","parentid = {$z['catid']} AND item <> 0","hits desc,letter asc");
		}
		$data['second_cat'] = $second_cat ? array_chunk($second_cat,ceil(count($second_cat)/2),true) : $second_cat;
		$data['third_cat'] = $third_cat;

        //供应商
		$data['senior_com'] = $this->comm->findAll("company","company!=''","vip desc","userid,username,company","0,9");
        $data['senior_new'] = $this->comm->findAll("company","company!=''","fromtime desc","userid,username,company","0,9");

        //Product Attributes
		$find_option = $this->comm->findAll("category_option",array("catid"=>$catid,"required"=>1,"listorder asc"));
		foreach($find_option as $k => $v){
			$op_value[$v['oid']] = $this->comm->findAll("category_option_value",array("oid"=>$v['oid']));
		}
		$data['option'] = $find_option;
		$data['op_value'] = $op_value;

        //属性
        $find_option = $this->comm->findAll("category_option","catid = ".$catid." and required > 0");
        $this->load->model('category_value_model','category_value');
        foreach($find_option as $k=>$v)
        {
            $find_option[$k][$v['name']]= $this->category_value->getValue('t1.id,t1.value name,count(t1.value) num',$v['oid'],'num desc','t1.value','0,16');
        }
        $data['value'] = $find_option;

        $area = $this->comm->findAll("area",'',"","areaname,areaid");
        foreach($area as $k=>$v)
        {
            $areas[$v['areaid']] = $v['areaname'];
        }
        $thiscat['arrchildid'] = $thiscat['arrchildid'] ? $thiscat['arrchildid'] : $thiscat['catid'];
        $cat_list = $thiscat['arrchildid'];

        $this->load->model("sell_model","sell");
        //热门产品
        $hot_pros = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"status = 3 and catid in({$cat_list})",'','hits DESC',"0,8");
        foreach($hot_pros as $k =>$v){
            $hot_pros[$k]['areaname'] = $areas[$v['areaid']];
        }
        $data['hot_pros'] = $hot_pros;

       //最新产品
       $new_sell = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
                ,"status = 3 and catid in({$cat_list})",'','addtime desc',"0,8");
        $data['new_sell'] = $new_sell;

        //特色产品
        $featured_Products = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"status = 3 and level = 1 and catid in({$cat_list})",'','addtime desc',"0,8");
        foreach($featured_Products as $k =>$v){
            $featured_Products[$k]['areaname'] = $areas[$v['areaid']];
        }
        $data['featured_Products'] = $featured_Products;

        //价格
        $this->load->model('sell_model','sell');
        $productPrice = $this->sell->getHotCategoryPrice('0,4');
        $data['productPrice'] = $productPrice;

        //新闻
        $this->load->model('news_model','news');
        $newsHot = $this->news->getNews('%Motor%','0,15');
        foreach($newsHot as $k =>$v){
            $newsHot[$k]['content'] = strip_tags($v['content']);
        }
        $data['newsHot'] = $newsHot;

        //推荐阅读
        $newsRecommend = $this->news->getNewsRecommend('1','0,15');
        foreach($newsRecommend as $k =>$v){
            $newsRecommend[$k]['content'] = strip_tags($v['content']);
        }
        $data['newsRecommend'] = $newsRecommend;

        //展会
        $exhibition = $this->news->getNewsDetail(4,'0,15');
        foreach($exhibition as $k =>$v){
            $exhibition[$k]['content'] = strip_tags($v['content']);
        }
        $data['exhibition'] = $exhibition;

        //获取最新询单信息
        $this->load->model('inquiry_model','inquiry');
        $data['newInquiry'] = $this->inquiry->getNewInquiry('0,13');

		header('Content-Language:en');
		$this->load->view('header',$data);	
		$this->load->view('second_cat');
		$this->load->view('footer');
	}	
}