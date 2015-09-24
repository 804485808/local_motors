<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sell_detail extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('comm_model','comm');
    }

    public function index(){

        $this->load->helper('inflector');
        $site = $this->config->item("site");
        $data['site'] = $site;

        $itemid = intval($this->uri->rsegment(3,0));
        if(!$itemid){
            show_404();
            die();
        }

        $this->load->model('sell_model','sell');
        $product = $this->sell->getSellCommon('*',"itemid='{$itemid}'",'','','',1);
		if($product){
			header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".main_url(site_url("sell_detail/".__FUNCTION__."/".$itemid."/".$product['linkurl'])));
            die();
		}else{
			show_404();
            die();
		}

        $sell_linkurl = $this->uri->rsegment(4,'');

        if(!$sell_linkurl or stripos($sell_linkurl,$product['linkurl'])===false){
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".main_url(site_url("sell_detail/".__FUNCTION__."/".$itemid."/".$product['linkurl'])));
            die();
        }

        //hits+1
        $this->sell->addSellHits($itemid);

        $this->load->model('category_model','category');
        $cat = $this->category->getCategoryCommon('*',"catid='{$product['catid']}'",'','',1);

        $pcat = $this->category->getCategoryCommon('*',"catid in ({$cat['arrparentid']})");


        $data['pcat'] = $pcat;
        $data['cat'] = $cat;


        $this->load->library('Sphinx','','seSphinx');

        $res = $this->seSphinx->getTagindex($cat['catname']);

        $keywords=array();
        if(isset($res['matches'])){
            foreach($res['matches'] as $jh){
                $keywords[] = $this->comm->find("tagindex",array("id"=>$jh['id']));
            }
        }else{
            $keywords = $this->comm->findAll("tagindex","","","","0,5");
        }
        $data['keywords'] = $keywords;
        $data['title'] = $product['title'].", buy ".$product['title'].", ".$product['title']." for sale, ".$keywords[0]['tag'].", ".$keywords[1]['tag'].", ".$keywords[2]['tag']." in ".$pcat[0]['catname']." On ".$site['site_name'];

        $com_data = $this->comm->find("company",array("username"=>$product['username']),"","userid,areaid,mode,address");


        $data['com_data'] = $com_data;

        $this->load->model('type_model','type');

        $res = $this->type->getTypeCommon('tname,tid',"userid='{$com_data['userid']}'");
        $types = '';
        $typesId = '';
        foreach(array_slice($res,0,10) as $v){
            $types .=$v['tname'].',';
            $typesId .=$v['tid'].',';
        }

        $data['types'] = $types;
        $data['com_type'] = $res;

        //供应商推荐商品
        $typesId = substr($typesId,0,-1);
        if($typesId) {
            $res = $this->sell->getSellCommon('*', "mycatid in ({$typesId})",'', 'hits desc', '0,6');
        }else{
            $res = '';
        }

        $data['com_products'] = $res;
        //dump($data['com_type']);
        $com_areaname = $this->comm->find("area",array("areaid"=>$com_data['areaid']),"","areaname");
        $product['com_areaname'] = $com_areaname['areaname'];

        $sell_areaname = $this->comm->find("area",array("areaid"=>$product['areaid']),"","areaname");
        $product['sell_areaname'] = $sell_areaname['areaname'];

        $product['typeid']=$this->comm->find("type",array("tid"=>$product['mycatid']));

        $sell_content=$this->comm->find("sell_data",array("itemid"=>$itemid));
        $product['content']=$sell_content['content'];

        $optionids=explode(",",$product['pptword']);
        $option_values=array();
        foreach($optionids as $gv){
            $temp_1=$this->comm->find("category_option",array("oid"=>$gv),"","name");
            $temp_2=$this->comm->find("category_value",array("oid"=>$gv,"itemid"=>$itemid),"","value");
            $option_values[]=array(
                "name"=>$temp_1['name'],
                "value"=>$temp_2['value']
            );
        }

        $data['option_values']=$option_values;

        $data['product'] = $product;



        //products vs
        $results  = $this->seSphinx->getSellTotal($product['title']);

        $like_arrids = array(0);
        if(isset($results['matches'])){
            foreach($results['matches'] as $x){
                if($x['id']!=$itemid){
                    $like_arrids[] = $x['id'];
                }
            }
            $like_ids = implode(",",$like_arrids);
            $like_sell = $this->comm->findAll("sell","itemid in({$like_ids})");
            $like_sell1 = array_slice($like_sell,0,4);
            $countlike = count($like_sell1);
            $data['like_sell'] = $like_sell1;
            $data['like_sell2'] = array_slice($like_sell,0,5);

            if(count($countlike >= 2)){
                foreach($like_sell as $ls){

                    $find_value = $this->comm->findAll("category_value",array("itemid"=>$ls['itemid']));
                    if($ls['maxprice']!=0.00){
                        $op_value['Price'][$ls['itemid']] = "USD ".$ls['minprice']."-".$ls['maxprice'];
                    }else{
                        $op_value['Price'][$ls['itemid']] = "Factory Price";
                    }

                    if(!empty($ls['minamount'])){
                        $op_value['Min Order'][$ls['itemid']] = $ls['minamount'];
                    }
                    foreach($find_value as $fv){
                        $option = $this->comm->find("category_option",array("oid"=>$fv['oid']));
                        $op_value[$option['name']][$ls['itemid']] = $fv['value'];
                    }
                }

                $i = 0;
                foreach($op_value as $op => $value){
                    $count_value = count($value);
                    if($count_value >= 2 && $i<10){
                        $sort_op_value[$count_value.$op] = $value;
                        $i++;
                    }

                }
                krsort($sort_op_value);
            }else{
                $sort_op_value = array();
            }
        }else{
            $sort_op_value = array();
        }


        $data['sort_op_value'] = $sort_op_value;

        $this->load->view('header',$data);
        $this->load->view('sell_detail');
        $this->load->view('footer');
    }
}